<?php

	require_once('Conexao.php');
	require_once('grupoTabela.php');

	class GrupoTabelaDao{ 


		public function delete(GrupoTabela $g)
		{
  		 
			$sql = 'delete from public."S0010_GRUTAB_TABELA" where D0009_ID_GRUPO_TABELA = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();

	            $sql = 'Delete FROM public."S0009_GRUPO_TABELA" WHERE D0009_ID_GRUPO_TABELA=?';
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

		public function buscaGrupoTabela(GrupoTabela $g)
		{
 
			$sql = 'SELECT D0009_ID_GRUPO_TABELA id, D0009_DESC_GRUPO_TABELA descricao FROM public."S0009_GRUPO_TABELA" where D0009_ID_GRUPO_TABELA = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId());

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

		public function buscaChave(GrupoTabela $g)
		{
 
			$sql = 'SELECT  D0001_ID id   FROM public."S0010_GRUTAB_TABELA" f  WHERE D0010_CHAVE = ?'  ;
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


 		public function update(GrupoTabela $g)
		{
  
		 
			$sql = 'update public."S0009_GRUPO_TABELA" set D0009_DESC_GRUPO_TABELA=?  where D0009_ID_GRUPO_TABELA = ? ';			
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$g->getNome());   
			$stmt->bindValue(2,$g->getId());   

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute(); 
				$this->createAcao($g); 
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


		public function createAcao(GrupoTabela $g)
		{ 

            //var_dump($g->getAcao()); 


            $sql = 'Delete FROM public."S0010_GRUTAB_TABELA" WHERE D0009_ID_GRUPO_TABELA=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$g->getId());   
			$stmt->execute(); 

			foreach ($g->getTabela() as $acao)
			{

                $sql = 'Insert into public."S0010_GRUTAB_TABELA" (D0009_ID_GRUPO_TABELA,D0001_ID ,D0010_CHAVE ) values (?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$g->getId());  
                $stmt->bindValue(2,$acao); 
                $stmt->bindValue(3,$g->getChave()); 
			    $stmt->execute();  
			     
			}  

		}


		public function create(GrupoTabela $g)
		{
  	  
			$sql = 'Insert into public."S0009_GRUPO_TABELA" (D0009_DESC_GRUPO_TABELA, D0009_chave ) values (?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$g->getNome());  
			$stmt->bindValue(2,$g->getChave()); 


	 
			//$stmt->bindValue(2,$g->getSigla());  
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute(); 

	  			$sql = 'SELECT D0009_ID_GRUPO_TABELA id FROM public."S0009_GRUPO_TABELA" where D0009_chave = ?';

				$stmt = Conexao::getConn()->prepare($sql);  
				$stmt->bindValue(1,$g->getChave());  
				$stmt->execute();
				//Conexao::getConn()->commit(); 

				//Conexao::getConn()->beginTransaction();
				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 					 
					$g->setId($resultado[0]['id']);  
					$this->createAcao($g); 	 
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

		public function readItens(GrupoTabela $g)
		{
 		 
			//$sql = 'Select * from usuario'; $sql = $sql . ' LEFT JOIN public."S0010_GRUTAB_TABELA" fa on fa.D0009_ID_GRUPO_TABELA = f.D0009_ID_GRUPO_TABELA
			$sql = 'SELECT  D0001_ID id   FROM public."S0010_GRUTAB_TABELA" f  WHERE D0009_ID_GRUPO_TABELA = ?'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$g->getId());  
			
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
 		 
			//$sql = 'Select * from usuario'; $sql = $sql . ' LEFT JOIN public."S0010_GRUTAB_TABELA" fa on fa.D0009_ID_GRUPO_TABELA = f.D0009_ID_GRUPO_TABELA
			$sql = 'SELECT  f.D0009_ID_GRUPO_TABELA id, D0009_DESC_GRUPO_TABELA descricao   FROM public."S0009_GRUPO_TABELA" f  
			 order by D0009_DESC_GRUPO_TABELA LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
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

		public function readF(GrupoTabela $g,$numPg)
		{  
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0009_ID_GRUPO_TABELA id, D0009_DESC_GRUPO_TABELA descricao FROM public."S0009_GRUPO_TABELA"';

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql =  $sql .  ' upper(D0009_DESC_GRUPO_TABELA) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0009_DESC_GRUPO_TABELA  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);  
			$bind = 1;
			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($g->getNome()));
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



		public function readGrupoTabela(GrupoTabela $g)
		{  
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0009_ID_GRUPO_TABELA id, D0009_DESC_GRUPO_TABELA descricao FROM public."S0009_GRUPO_TABELA"';

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql  = $sql . ' where ';
			endif;

			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$sql =  $sql .  ' upper(D0009_DESC_GRUPO_TABELA) like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by D0009_DESC_GRUPO_TABELA';

			$stmt = Conexao::getConn()->prepare($sql);  
			$bind = 1;
			if (!empty($g->getNome())   and  $g->getNome() != '' ):
				$stmt->bindValue($bind,strtoupper($g->getNome()));
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







		public function totRegistros(GrupoTabela $g)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0009_GRUPO_TABELA"';

			if (!empty($g->getNome()) and  $g->getNome() != ''    ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($g->getNome()) and  $g->getNome() != '' ):
				$sql =  $sql .  ' upper(D0009_DESC_GRUPO_TABELA) like ? ';
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
