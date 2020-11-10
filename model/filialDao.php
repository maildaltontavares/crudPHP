<?php

	require_once('Conexao.php');
	require_once('filial.php');

	class FilialDao{ 


		public function delete(Filial $f)
		{
  		 
			$sql = 'delete from public."E0006_FILIAL" where D0006_id_filial = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
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

		public function buscaFilial(Filial $f)
		{
 
			$sql = 'SELECT D0006_id_filial id, D0006_nome_filial descricao,D0005_grupo_empresa idGrupo FROM public."E0006_FILIAL" where D0006_id_filial = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getId());

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

		 

 		public function update(Filial $f)
		{
  
		 
			$sql = 'update public."E0006_FILIAL" set D0006_nome_filial=?,D0005_grupo_empresa=? where D0006_id_filial = ? ';			
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome());  
			$stmt->bindValue(2,$f->getGrupo()); 
			$stmt->bindValue(3,$f->getId());   

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
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

  

		public function create(Filial $f)
		{
  	  
			$sql = 'Insert into public."E0006_FILIAL" (D0006_nome_filial,D0005_grupo_empresa ) values (?,? )';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome());  
			$stmt->bindValue(2,$f->getGrupo());  

	 
			//$stmt->bindValue(2,$f->getSigla());  
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
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

		
		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario'; $sql = $sql . ' LEFT JOIN public."S0003_FUNCAO_ACAO" fa on fa.D0006_id_filial = f.D0006_id_filial
			$sql = 'SELECT  f.D0006_id_filial id, D0006_nome_filial descricao   FROM public."E0006_FILIAL" f  
			 order by D0006_nome_filial LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
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

		public function readF(Filial $f,$numPg)
		{  
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0006_id_filial id, D0006_nome_filial descricao FROM public."E0006_FILIAL"';

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0006_nome_filial) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0006_nome_filial  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);  
			$bind = 1;
			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($f->getNome()));
				$prim_filtro = True;
				$bind++;
			endif; 			
         
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
 


		public function readFilial(Filial $f)
		{  
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0006_id_filial id, D0006_nome_filial descricao FROM public."E0006_FILIAL"';

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0006_nome_filial) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0006_nome_filial';

			$stmt = Conexao::getConn()->prepare($sql);  
			$bind = 1;
			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($f->getNome()));
				$prim_filtro = True;
				$bind++;
			endif; 			
         
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







		public function totRegistros(Filial $f)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."E0006_FILIAL"';

			if (!empty($f->getNome()) and  $f->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($f->getNome()) and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0006_nome_filial) like ? ';
				$prim_filtro = True;
			endif;  
 
   
			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if(!empty($f->getNome())  and  $f->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($f->getNome()));
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



		public function lerFilialUsuario()
		{
 
			$sql = 'SELECT fil.D0006_id_filial id, D0006_nome_filial descricao,D0005_grupo_empresa idGrupo 
                     FROM public."E0006_FILIAL"  fil inner join public."S0012_USUARIO_FILIAL" usuf on usuf.D0006_id_filial = fil.D0006_id_filial inner join public."S0001_usuario" USU on usu.d0001_id = usuf.d0001_id where usu.d0001_email =' . '\'' . $_SESSION['email'] . '\'';  


			$stmt = Conexao::getConn()->prepare($sql);


			//$stmt->bindValue(1,$f->getId());

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


		public function lerTodas()
		{
 
			$sql = 'SELECT  f.D0006_id_filial id, D0006_nome_filial descricao   FROM public."E0006_FILIAL" f order by D0006_nome_filial  ';
			$stmt = Conexao::getConn()->prepare($sql); 
			
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




	}




?>
