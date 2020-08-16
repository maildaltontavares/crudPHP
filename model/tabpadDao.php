<?php

	require_once('Conexao.php');
	require_once('tabpad.php');

	class tabpadDao{



		public function delete(TabPad $t)
		{
  
		 
			$sql = 'delete from public."E0001_tabela_padrao" where d0001_id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
			$stmt->execute();  

			return 'OK';
		 
		}

		public function buscatabpad(TabPad $t)
		{
 
			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao" where d0001_id = ?';
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

		public function buscatpSigla(TabPad $t)
		{
 
			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao" where upper(d0001_sigla) = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,strtoupper($t->getSigla()));

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 

 		public function buscaTpCad()
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao"  where  d0001_id in (SELECT d0001_id id  FROM public."E0003_config_tp") order by d0001_descricao';
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 

		public function update(TabPad $t)
		{
  
		 
			$sql = 'update public."E0001_tabela_padrao" set d0001_descricao=?,d0001_sigla =? where d0001_id = ? ';
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome()); 
			$stmt->bindValue(2,$t->getSigla()); 
			$stmt->bindValue(3,$t->getId()); 


			//var_dump($t->getSigla());

			$stmt->execute();  

			return 'OK';
		 
		}


		public function create(TabPad $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."E0001_tabela_padrao" (d0001_descricao,d0001_sigla) values (?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getNome());  
			$stmt->bindValue(2,$t->getSigla());  
			$stmt->execute();  

			return 'OK';
		 
		}

		public function lerTodas()
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao" order by d0001_descricao' ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}


		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao" order by d0001_descricao LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(TabPad $t,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT d0001_id id, d0001_descricao descricao,d0001_sigla sigla  FROM public."E0001_tabela_padrao"';

			if (!empty($t->getNome())):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($t->getNome())):
				$sql =  $sql .  ' upper(d0001_descricao) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by d0001_descricao  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if(!empty($t->getNome())):
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




		public function totRegistros(TabPad $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."E0001_tabela_padrao"';

			if (!empty($t->getNome()) and  $t->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($t->getNome()) and  $t->getNome() != '' ):
				$sql =  $sql .  ' upper(d0001_descricao) like ? ';
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
