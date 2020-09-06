<?php

	require_once('Conexao.php');
	require_once('funcaoSistema.php');

	class FuncSysDao{ 


		public function delete(FuncaoSistema $f)
		{
  		 
			$sql = 'delete from public."S0002_FUNCAO" where D0002_id_funcao = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();

	            $sql = 'Delete FROM public."S0003_FUNCAO_ACAO" WHERE D0002_ID_FUNCAO=?';
				$stmt = Conexao::getConn()->prepare($sql); 
	 
	            $stmt->bindValue(1,$f->getId());   
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

		public function buscaFuncaoSistema(FuncaoSistema $f)
		{
 
			$sql = 'SELECT D0002_id_funcao id, D0002_FUNC_DESC descricao,D0001_ID_FUNC idfunc FROM public."S0002_FUNCAO" where D0002_id_funcao = ?';
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

		public function buscaChave(FuncaoSistema $f)
		{
 
			$sql = 'SELECT  D0003_ID_ACAO id   FROM public."S0003_FUNCAO_ACAO" f  WHERE D0003_chave = ?'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getChave());  
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


 		public function update(FuncaoSistema $f)
		{
  
		 
			$sql = 'update public."S0002_FUNCAO" set D0002_FUNC_DESC=?,D0001_ID_FUNC=? where D0002_id_funcao = ? ';			
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome());  
			$stmt->bindValue(2,$f->getFunc()); 
			$stmt->bindValue(3,$f->getId());   

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute(); 
				$this->createAcao($f); 
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


		public function createAcao(FuncaoSistema $f)
		{ 

            //var_dump($f->getAcao()); 


            $sql = 'Delete FROM public."S0003_FUNCAO_ACAO" WHERE D0002_ID_FUNCAO=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$f->getId());   
			$stmt->execute(); 

			foreach ($f->getAcao() as $acao)
			{

                $sql = 'Insert into public."S0003_FUNCAO_ACAO" (D0002_ID_FUNCAO,D0003_ID_ACAO ,D0003_chave ) values (?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$f->getId());  
                $stmt->bindValue(2,$acao); 
                $stmt->bindValue(3,$f->getChave()); 
			    $stmt->execute();  
			     
			}  

		}


		public function create(FuncaoSistema $f)
		{
  	  
			$sql = 'Insert into public."S0002_FUNCAO" (D0002_FUNC_DESC,D0001_ID_FUNC,D0002_CHAVE ) values (?,?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$f->getNome());  
			$stmt->bindValue(2,$f->getFunc()); 
			$stmt->bindValue(3,$f->getChave()); 


	 
			//$stmt->bindValue(2,$f->getSigla());  
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute(); 

	  			$sql = 'SELECT D0002_id_funcao id FROM public."S0002_FUNCAO" where D0002_chave = ?';

				$stmt = Conexao::getConn()->prepare($sql);  
				$stmt->bindValue(1,$f->getChave());  
				$stmt->execute();
				//Conexao::getConn()->commit(); 

				//Conexao::getConn()->beginTransaction();
				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 					 
					$f->setId($resultado[0]['id']);  
					$this->createAcao($f); 	 
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

		public function readItens(FuncaoSistema $f)
		{
 		 
			//$sql = 'Select * from usuario'; $sql = $sql . ' LEFT JOIN public."S0003_FUNCAO_ACAO" fa on fa.d0002_id_funcao = f.d0002_id_funcao
			$sql = 'SELECT  D0003_ID_ACAO id   FROM public."S0003_FUNCAO_ACAO" f  WHERE D0002_ID_FUNCAO = ?'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$f->getFunc());  
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


		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario'; $sql = $sql . ' LEFT JOIN public."S0003_FUNCAO_ACAO" fa on fa.d0002_id_funcao = f.d0002_id_funcao
			$sql = 'SELECT  f.D0002_ID_FUNCAO id, D0002_FUNC_DESC descricao   FROM public."S0002_FUNCAO" f  
			 order by D0002_FUNC_DESC LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
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

		public function readF(FuncaoSistema $f,$numPg)
		{  
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0002_id_funcao id, D0002_FUNC_DESC descricao FROM public."S0002_FUNCAO"';

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($f->getNome())   and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0002_FUNC_DESC) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0002_FUNC_DESC  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

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




		public function totRegistros(FuncaoSistema $f)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0002_FUNCAO"';

			if (!empty($f->getNome()) and  $f->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($f->getNome()) and  $f->getNome() != '' ):
				$sql =  $sql .  ' upper(D0002_FUNC_DESC) like ? ';
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
