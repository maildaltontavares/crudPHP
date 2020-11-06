<?php

	require_once('Conexao.php');
	require_once('grupoEmpresa.php');

	class GrupoEmpresaDao{



		public function delete(GrupoEmpresa $t)
		{
  
		 
			$sql = 'delete from public."E0005_GRUPO_EMPRESA" where d0005_grupo_empresa = ? ';  
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

		public function buscaGrupoEmpresa(GrupoEmpresa $t)
		{
 
			$sql = 'SELECT d0005_grupo_empresa id, d0005_nome_grupo descricao  FROM public."E0005_GRUPO_EMPRESA" where d0005_grupo_empresa = ?';
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
 

		public function update(GrupoEmpresa $t)
		{
  
		 
			$sql = 'update public."E0005_GRUPO_EMPRESA" set d0005_nome_grupo=? where d0005_grupo_empresa = ? ';
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


		public function create(GrupoEmpresa $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."E0005_GRUPO_EMPRESA" (d0005_nome_grupo ) values (?)';  
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

		public function lerTodas()
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT d0005_grupo_empresa id, d0005_nome_grupo descricao  FROM public."E0005_GRUPO_EMPRESA" order by d0005_nome_grupo' ;
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
			$sql = 'SELECT d0005_grupo_empresa id, d0005_nome_grupo descricao  FROM public."E0005_GRUPO_EMPRESA" order by d0005_nome_grupo LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(GrupoEmpresa $t,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT d0005_grupo_empresa id, d0005_nome_grupo descricao   FROM public."E0005_GRUPO_EMPRESA"';

			if (!empty($t->getNome())   and  $t->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($t->getNome())   and  $t->getNome() != '' ):
				$sql =  $sql .  ' upper(d0005_nome_grupo) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by d0005_nome_grupo  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

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




		public function totRegistros(GrupoEmpresa $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."E0005_GRUPO_EMPRESA"';

			if (!empty($t->getNome()) and  $t->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($t->getNome()) and  $t->getNome() != '' ):
				$sql =  $sql .  ' upper(d0005_nome_grupo) like ? ';
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
