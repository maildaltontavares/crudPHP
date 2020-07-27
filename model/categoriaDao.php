<?php

	require_once('Conexao.php');
	require_once('categoria.php');

	class CategoriaDao{



		public function delete(Categoria $c)
		{
  
		 
			$sql = 'delete from public."categoria" where id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$c->getId()); 
			$stmt->execute();  

			return 'OK';
		 
		}

		public function buscaCategoria(Categoria $c)
		{
 
			$sql = 'SELECT * FROM public."categoria" where id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$c->getId());

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 


		public function update(Categoria $c)
		{
  
		 
			$sql = 'update public."categoria" set nome_categ=? where id = ? ';
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$c->getNome()); 
			$stmt->bindValue(2,$c->getId()); 

			$stmt->execute();  

			return 'OK';
		 
		}


		public function create(Categoria $c)
		{
  
		 
			$sql = 'Insert into public."categoria" (nome_categ) values(?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$c->getNome());  
			$stmt->execute();  

			return 'OK';
		 
		}


		public function read()
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT * FROM public."categoria"';
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(Categoria $c)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT * FROM public."categoria"';

			if (!empty($c->getNome())):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($c->getNome())):
				$sql =  $sql .  ' nome_categ = ? ';
				$prim_filtro = True;
			endif; 

			$stmt = Conexao::getConn()->prepare($sql);

			$prim_filtro = false;
			$bind = 1;

			if(!empty($c->getNome())):
				$stmt->bindValue($bind,$c->getNome());;
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
