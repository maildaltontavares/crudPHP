<?php

	require_once('Conexao.php');
	require_once('usuario.php');

	class UsuarioDao{



		public function delete(Usuario $u)
		{
  
		 
			$sql = 'delete from public."S0001_usuario" where d0001_id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getId()); 
			$stmt->execute();  

			return 'OK';
		 
		}

		public function buscaUsuario(Usuario $u)
		{
 
			$sql = 'SELECT d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel  FROM public."S0001_usuario"  where d0001_id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getId());
			//$stmt->bindValue(2,$u->getSenha());
			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}


		public function validaUsuario(Usuario $u)
		{
 		 
			//$sql = 'Select * from usuario';
			//$sql = 'SELECT * FROM public."S0001_usuario" where d0001_nome = ? and d0001_senha = ?';
			$sql = 'SELECT  d0001_nome nome,d0001_senha senha  FROM public."S0001_usuario" where d0001_nome = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getNome());
			//$stmt->bindValue(2,$u->getSenha());
			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return 'OK';	
			else:
				return 'NOK';				
			endif;

		 
		}


		public function update(Usuario $u)
		{
  
		 
			$sql = 'update public."S0001_usuario" set d0001_nome = ?,d0001_senha=?,d0001_email=?,d0001_tel=? where d0001_id = ? ';
			//$sql = 'Insert into usuario (nome,senha,d0001_email,d0001_tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$u->getNome());
			$stmt->bindValue(2,$u->getSenha());
			$stmt->bindValue(3,$u->getEmail());			
			$stmt->bindValue(4,$u->getTel()); 
			$stmt->bindValue(5,$u->getId()); 

			$stmt->execute();  

			return 'OK';
		 
		}


		public function create(Usuario $u)
		{
  
		 
			$sql = 'Insert into public."S0001_usuario" (d0001_nome,d0001_senha,d0001_email,d0001_tel) values(?,?,?,?)';
			//$sql = 'Insert into usuario (nome,senha,d0001_email,d0001_tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$u->getNome());
			$stmt->bindValue(2,$u->getSenha());
			$stmt->bindValue(3,$u->getEmail());			
			$stmt->bindValue(4,$u->getTel()); 

			$stmt->execute();  

			return 'OK';
		 
		}


		public function read()
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT  d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel   FROM public."S0001_usuario"'; 
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
				return $resultado;	
			else: 
				return [];				
			endif;

		 
		}

		public function readF(Usuario $u)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT  d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel   FROM public."S0001_usuario"';

 
			if (!empty($u->getNome()) or !empty($u->getEmail())):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($u->getNome())):
				$sql =  $sql .  ' d0001_nome like ? ';
				$prim_filtro = True;
			endif;


			if(!empty($u->getEmail())):
				if($prim_filtro):
					$sql =  $sql . ' and d0001_email like ? ';
				else:
					$sql =  $sql . ' d0001_email like ? ';
					$prim_filtro = True;
				endif;		
			endif;
 
			$stmt = Conexao::getConn()->prepare($sql);
 
			$prim_filtro = false;
			$bind = 1;

			if(!empty($u->getNome())):
				$stmt->bindValue($bind,$u->getNome());;
				$prim_filtro = True;
				$bind++;
			endif;


			if(!empty($u->getEmail())):				 
				$stmt->bindValue($bind,$u->getEmail());				 
			endif; 
 

 			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				//var_dump($resultado);
				return $resultado;	
			else:
				//var_dump(111);
				return [];				
			endif;

		 
		}	 

	}




?>
