<?php

	require_once('Conexao.php');
	require_once('tabpad.php');

	class PerfilDao{

		public function buscaPerfil(Perfil $t)
		{
 
			$sql = 'SELECT d0004_id_perfil id, d0004_desc_perfil descricao FROM public."S0004_PERFIL" where d0004_id_perfil = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId());

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}



		public function delete(Perfil $t)
		{
  
		 
			$sql = 'delete from public."S0005_PERFIL_FUNCAO" where d0004_id_perfil = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();


                $sql = 'Delete FROM public."S0004_PERFIL" WHERE d0004_id_perfil=?';
				$stmt = Conexao::getConn()->prepare($sql); 
	 
	            $stmt->bindValue(1,$t->getId());   
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

		public function readItens(Perfil $t)
		{ 
			 

		    $sql = 'SELECT  p.d0002_id_funcao id ,f.D0002_FUNC_DESC descricao  FROM public."S0005_PERFIL_FUNCAO" p inner join public."S0002_FUNCAO" f on p.d0002_id_funcao = f.d0002_id_funcao   WHERE p.d0004_id_perfil = ? order by D0005_ordem' 	;		
			
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId());  
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


		public function buscaChave(Perfil $t)
		{
 
			$sql = 'SELECT  p.d0002_id_funcao id ,f.D0002_FUNC_DESC descricao  FROM public."S0005_PERFIL_FUNCAO" p inner join public."S0002_FUNCAO" f on p.d0002_id_funcao = f.d0002_id_funcao   WHERE p.D0005_chave = ? order by D0005_ordem'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getChave());  
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



		public function update(Perfil $t)
		{
  
		     
			$sql = 'update public."S0004_PERFIL" set d0004_desc_perfil=?  where d0004_id_perfil = ? '; 

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome()); 			 
			$stmt->bindValue(2,$t->getId());   

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				$this->createItens($t); 	 
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

		public function createItens(Perfil $t)
		{ 

            //var_dump($f->getAcao()); 


            $sql = 'Delete FROM public."S0005_PERFIL_FUNCAO" WHERE d0004_id_perfil=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$t->getId());   
			$stmt->execute(); 

			$z = 0;
			foreach ($t->getItens() as $itens)
			{
				$z++;
                $sql = 'Insert into public."S0005_PERFIL_FUNCAO" (d0004_id_perfil,d0002_id_funcao ,D0005_chave,D0005_ordem ) values (?,?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$t->getId());  
                $stmt->bindValue(2,$itens); 
                $stmt->bindValue(3,$t->getChave()); 
                $stmt->bindValue(4,$z );
			    $stmt->execute();  
			     
			}  

		}
		public function create(Perfil $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."S0004_PERFIL" (d0004_desc_perfil,D0004_CHAVE ) values (?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome());  
			$stmt->bindValue(2,$t->getChave()); 
	 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();

                $sql = 'SELECT d0004_id_perfil id FROM public."S0004_PERFIL" where D0004_chave = ?';

				$stmt = Conexao::getConn()->prepare($sql);  
				$stmt->bindValue(1,$t->getChave());  
				$stmt->execute();
				//Conexao::getConn()->commit(); 

				//Conexao::getConn()->beginTransaction();
				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 					 
					$t->setId($resultado[0]['id']);  
					$this->createItens($t); 	 
				endif; 

				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação aaaa: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			}	
		 
		} 

		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT d0004_id_perfil id, d0004_desc_perfil descricao  FROM public."S0004_PERFIL" order by d0004_desc_perfil LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(Perfil $t,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT d0004_id_perfil id, d0004_desc_perfil descricao    FROM public."S0004_PERFIL"';

			if (!empty($t->getNome())   and  $t->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($t->getNome())   and  $t->getNome() != '' ):
				$sql =  $sql .  ' upper(d0004_desc_perfil) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by d0004_desc_perfil  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if (!empty($t->getNome())   and  $t->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($t->getNome()));
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




		public function totRegistros(Perfil $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0004_PERFIL"';

			if (!empty($t->getNome()) and  $t->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($t->getNome()) and  $t->getNome() != '' ):
				$sql =  $sql .  ' upper(d0004_desc_perfil) like ? ';
				$prim_filtro = True;
			endif;  
 
   
			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if(!empty($t->getNome())  and  $t->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($t->getNome()));
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
