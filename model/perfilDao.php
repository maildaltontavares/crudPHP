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
  
		 
			$sql = 'delete from public."S0004_PERFIL" where d0004_id_perfil = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
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

		public function update(Perfil $t)
		{
  
		 
			$sql = 'update public."S0004_PERFIL" set d0004_desc_perfil=?  where d0004_id_perfil = ? ';
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome()); 			 
			$stmt->bindValue(2,$t->getId()); 


			//var_dump($t->getSigla());

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


		public function create(Perfil $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."S0004_PERFIL" (d0004_desc_perfil) values (?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome());  
	 
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
