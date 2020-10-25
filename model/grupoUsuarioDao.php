<?php

	require_once('Conexao.php');
	require_once('grupoUsuario.php');

	class GrupoUsuarioDao{

		public function buscaGrupoUsuario(GrupoUsuario $g)
		{
 
			$sql = 'SELECT D0006_ID_GRUPO id, d0006_desc_grupo descricao FROM public."S0006_GRUPO" where D0006_ID_GRUPO = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId());

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}



		public function delete(GrupoUsuario $g)
		{
  
		 
			$sql = 'delete from public."S0007_GRUPO_PERFIL" where D0006_ID_GRUPO = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();


                $sql = 'Delete FROM public."S0006_GRUPO" WHERE D0006_ID_GRUPO=?';
				$stmt = Conexao::getConn()->prepare($sql); 
	 
	            $stmt->bindValue(1,$g->getId());   
				$stmt->execute(); 



				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			}	
		 
		} 

		public function readItens(GrupoUsuario $g)
		{ 
			 

		    $sql = 'SELECT  p.D0004_ID_PERFIL id ,f.D0004_DESC_PERFIL descricao  FROM public."S0007_GRUPO_PERFIL" p inner join public."S0004_PERFIL" f on p.D0004_ID_PERFIL = f.D0004_ID_PERFIL   WHERE p.D0006_ID_GRUPO = ? order by D0007_ordem' 	;		
			
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId());  
			try{
				 
				$stmt->execute();
				 
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na pesquisa: " . $e->getMessage() . '</li></div>'; 
			 
			}	
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);   
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}


		public function buscaChave(GrupoUsuario $g)
		{
 
			$sql = 'SELECT  p.D0004_ID_PERFIL id ,f.D0004_DESC_PERFIL descricao  FROM public."S0007_GRUPO_PERFIL" p inner join public."S0004_PERFIL" f on p.D0004_ID_PERFIL = f.D0004_ID_PERFIL   WHERE p.D0007_CHAVE = ? order by D0007_ordem'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getChave());  
			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				Conexao::getConn()->commit();  
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na pesquisa: " . $e->getMessage() . '</li></div>'; 
			 
			}	
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);   
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}	



		public function update(GrupoUsuario $g)
		{
  
		     
			$sql = 'update public."S0006_GRUPO" set d0006_desc_grupo=?  where D0006_ID_GRUPO = ? '; 

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$g->getNome()); 			 
			$stmt->bindValue(2,$g->getId());   

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				$this->createItens($g); 	 
				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação  111: " . $e->getMessage() . '</li></div>'; 
			     
			    return 'nOK';
			}	
		 
		}

		public function createItens(GrupoUsuario $g)
		{ 

            //var_dump($f->getAcao()); 


            $sql = 'Delete FROM public."S0007_GRUPO_PERFIL" WHERE D0006_ID_GRUPO=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$g->getId());   
			$stmt->execute(); 

			$z = 0;
			foreach ($g->getItens() as $itens)
			{
				$z++;
                $sql = 'Insert into public."S0007_GRUPO_PERFIL" (D0006_ID_GRUPO,D0004_ID_PERFIL ,D0007_CHAVE,D0007_ordem ) values (?,?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$g->getId());  
                $stmt->bindValue(2,$itens); 
                $stmt->bindValue(3,$g->getChave()); 
                $stmt->bindValue(4,$z );
			    $stmt->execute();  
			     
			}  

		}
		public function create(GrupoUsuario $g)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."S0006_GRUPO" (d0006_desc_grupo,D0006_CHAVE ) values (?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$g->getNome());  
			$stmt->bindValue(2,$g->getChave()); 
	 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();

                $sql = 'SELECT D0006_ID_GRUPO id FROM public."S0006_GRUPO" where D0006_CHAVE = ?';

				$stmt = Conexao::getConn()->prepare($sql);  
				$stmt->bindValue(1,$g->getChave());  
				$stmt->execute();
				//Conexao::getConn()->commit(); 

				//Conexao::getConn()->beginTransaction();
				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 					 
					$g->setId($resultado[0]['id']);  
					$this->createItens($g); 	 
				endif; 

				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			}	
		 
		} 

		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT D0006_ID_GRUPO id, d0006_desc_grupo descricao  FROM public."S0006_GRUPO" order by d0006_desc_grupo LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(GrupoUsuario $g,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0006_ID_GRUPO id, d0006_desc_grupo descricao    FROM public."S0006_GRUPO"';

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql =  $sql .  ' upper(d0006_desc_grupo) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by d0006_desc_grupo  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($g->getNome()));
				$prim_filtro = True;
				$bind++;
			endif; 
			
         

			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}	 

		public function totRegistros(GrupoUsuario $g)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0006_GRUPO"';

			if (!empty($g->getNome()) and  $g->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($g->getNome()) and  $g->getNome() != '' ):
				$sql =  $sql .  ' upper(d0006_desc_grupo) like ? ';
				$prim_filtro = True;
			endif;  
 
   
			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if(!empty($g->getNome())  and  $g->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($g->getNome()));
				$prim_filtro = True;
				$bind++;
			endif;  

			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}		



	}




?>
