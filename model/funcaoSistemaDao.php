<?php

	require_once('Conexao.php');
	require_once('funcaoSistema.php');

	class FuncSysDao{



		public function delete(FuncaoSistema $f)
		{
  
		 
			$sql = 'delete from public."S0002_FUNCAO" where D0002_id = ? ';  
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

		public function buscaFuncSys(FuncaoSistema $f)
		{
 
			$sql = 'SELECT D0002_id id, D0002_descricao descricao FROM public."S0002_FUNCAO" where D0002_id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getId());

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
/*
		public function buscatpSigla(FuncaoSistema $f)
		{
 
			$sql = 'SELECT D0002_id id, D0002_descricao descricao,D0002_sigla sigla  FROM public."S0002_FUNCAO" where upper(D0002_sigla) = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,strtoupper($f->getSigla()));

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
			$sql = 'SELECT D0002_id id, D0002_descricao descricao,D0002_sigla sigla  FROM public."S0002_FUNCAO"  where  D0002_id in (SELECT D0002_id id  FROM public."E0003_config_tp") order by D0002_descricao';
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 
*/
		public function update(FuncaoSistema $f)
		{
  
		 
			$sql = 'update public."S0002_FUNCAO" set D0002_descricao=? where D0002_id = ? ';
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome()); 
			//$stmt->bindValue(2,$f->getSigla()); 
			$stmt->bindValue(2,$f->getId()); 


			//var_dump($f->getSigla());

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


		public function create(FuncaoSistema $f)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."S0002_FUNCAO" (D0002_descricao ) values (?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome());  
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
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT D0002_id id, D0002_descricao descricao FROM public."S0002_FUNCAO" order by D0002_descricao LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(FuncaoSistema $f,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0002_id id, D0002_descricao descricao   FROM public."S0002_FUNCAO"';

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0002_descricao) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0002_descricao  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 1;

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
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




		public function totRegistros(FuncaoSistema $f)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0002_FUNCAO"';

			if (!empty($f->getNome()) and  $f->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($f->getNome()) and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0002_descricao) like ? ';
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



	}




?>
