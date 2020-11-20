<?php

	require_once('Conexao.php');
	require_once('usuario.php');

	class UsuarioDao{  

		public function delete(Usuario $u)
		{     
			$sql1 = 'delete from public."S0012_USUARIO_FILIAL" where d0001_id = ? ';  
			$stmt1 = Conexao::getConn()->prepare($sql1); 
			$stmt1->bindValue(1,$u->getId()); 
			 

			$sql = 'delete from public."S0011_USUARIO_GRUPO" where d0001_id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 

			try{
				Conexao::getConn()->beginTransaction();
                $stmt1->execute();
				$stmt->execute();


                $sql = 'delete from public."S0001_usuario" where d0001_id = ? ';  
				$stmt = Conexao::getConn()->prepare($sql); 
	 
	            $stmt->bindValue(1,$u->getId());   
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

		public function buscaUsuario(Usuario $u)
		{
 
			$sql = 'SELECT d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel,d0001_filial_default filPad   FROM public."S0001_usuario"  where d0001_id = ?';
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

		public function validaChaveAutenticacao(Usuario $u)
		{
 		 
			//$sql = 'Select * from usuario';
			//$sql = 'SELECT * FROM public."S0001_usuario" where d0001_nome = ? and d0001_senha = ?';
			$sql = 'SELECT d0001_id id_usu,d0001_nome nome,d0001_senha senha, fil.D0006_id_filial filial,d0006_nome_filial nome_filial,D0005_grupo_empresa                 idGrupo,d0001_filial_default filPad , d0001_bloqueado bloqueado,d0001_chave_atenticacao chave_atenticacao 
			    FROM    public."S0001_usuario" usu                     
                    INNER JOIN  public."E0006_FILIAL" fil on fil.d0006_id_filial = usu.d0001_filial_default  where d0001_chave_atenticacao = ?'; 
               

             


			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getChaveAutenticacao());
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
			$sql = 'SELECT d0001_id id_usu,d0001_nome nome,d0001_senha senha, fil.D0006_id_filial filial,d0006_nome_filial nome_filial,D0005_grupo_empresa                 idGrupo,d0001_filial_default filPad , d0001_bloqueado bloqueado,d0001_chave_atenticacao chave_atenticacao 
			    FROM    public."S0001_usuario" usu                     
                    INNER JOIN  public."E0006_FILIAL" fil on fil.d0006_id_filial = usu.d0001_filial_default  where d0001_email = ?'; 
               

               //INNER JOIN public."S0012_USUARIO_FILIAL" usuf on usu.d0001_id = usuf.d0001_id 


			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getEmail());
			//$stmt->bindValue(2,$u->getSenha());
			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);   
				return $resultado;

			else:
				return [];				
			endif;

		 
		}


		public function buscaChaveFilialUsuario(Usuario $u)
		{
 
			$sql = 'SELECT  p.d0006_id_filial id ,p.d0001_id idUsuario FROM public."S0012_USUARIO_FILIAL" p  WHERE p.d0012_chave = ?'    ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getChave());  
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

		public function buscaFilialUsuario(Usuario $u)
		{
 
			$sql = 'SELECT  p.d0006_id_filial id ,p.d0001_id idUsuario FROM public."S0012_USUARIO_FILIAL" p  WHERE p.d0001_id = ?'    ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getId());  
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


		public function buscaChave(Usuario $u)
		{
 
			$sql = 'SELECT  p.d0006_id_grupo id ,f.d0006_desc_grupo descricao   FROM public."S0011_USUARIO_GRUPO" p inner join public."S0006_GRUPO" f on p.d0006_id_grupo = f.d0006_id_grupo   WHERE p.D0011_CHAVE = ? order by D0011_ordem'  ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getChave());  
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



		public function confirmaConta(Usuario $u)
		{  
		 
			$sql = 'update public."S0001_usuario" set d0001_bloqueado=?,d0001_dt_alteracao =?,d0001_chave_atenticacao =' . '\'\'' .'  where d0001_id = ? ';
			//$sql = 'Insert into usuario (nome,senha,d0001_email,d0001_tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 		 
			$stmt->bindValue(1,' ');
			$stmt->bindValue(2,$u->getDtAlteracao());  
			$stmt->bindValue(3,$u->getId());  

    
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				//$this->createItens($u); 	 
				//$this->createFilial($u); 
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

		public function update(Usuario $u)
		{
  
		 
			$sql = 'update public."S0001_usuario" set d0001_nome = ?,d0001_senha=?,d0001_email=?,d0001_tel=?,d0001_filial_default =? where d0001_id = ? ';
			//$sql = 'Insert into usuario (nome,senha,d0001_email,d0001_tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$u->getNome());
			$stmt->bindValue(2,$u->getSenha());
			$stmt->bindValue(3,$u->getEmail());			
			$stmt->bindValue(4,$u->getTel()); 
			$stmt->bindValue(5,$u->getFilialPad());
			$stmt->bindValue(6,$u->getId()); 
			 

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				$this->createItens($u); 	 
				$this->createFilial($u); 
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

		public function createFilial(Usuario $u)
		{ 

            $sql = 'Delete FROM public."S0012_USUARIO_FILIAL" WHERE D0001_ID=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$u->getId());   
			$stmt->execute(); 

			$z = 0;
			//var_dump($u->getItens());
		 
			foreach ($u->getFilial() as $itens)
			{
				$z++;
                $sql = 'Insert into public."S0012_USUARIO_FILIAL" (D0001_ID,D0006_ID_FILIAL,D0012_CHAVE,D0012_ordem ) values (?,?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$u->getId());  
                $stmt->bindValue(2,$itens); 
                $stmt->bindValue(3,$u->getChave()); 
                $stmt->bindValue(4,$z );
			    $stmt->execute();  
			     
			}  
			 
		}


		public function createItens(Usuario $u)
		{ 

            $sql = 'Delete FROM public."S0011_USUARIO_GRUPO" WHERE D0001_ID=?';
			$stmt = Conexao::getConn()->prepare($sql); 
 
            $stmt->bindValue(1,$u->getId());   
			$stmt->execute(); 

			$z = 0;
			//var_dump($u->getItens());
		 
			foreach ($u->getItens() as $itens)
			{
				$z++;
                $sql = 'Insert into public."S0011_USUARIO_GRUPO" (D0001_ID,D0006_ID_GRUPO,D0011_CHAVE,D0011_ordem ) values (?,?,?,?)';   
			    $stmt = Conexao::getConn()->prepare($sql); 
 
                $stmt->bindValue(1,$u->getId());  
                $stmt->bindValue(2,$itens); 
                $stmt->bindValue(3,$u->getChave()); 
                $stmt->bindValue(4,$z );
			    $stmt->execute();  
			     
			}  
			 
		}

		public function create(Usuario $u)
		{  

			$sql = 'Insert into public."S0001_usuario" (d0001_nome,d0001_senha,d0001_email,d0001_tel,d0001_chave,d0001_filial_default) values(?,?,?,?,?,?)';
			//$sql = 'Insert into usuario (nome,senha,d0001_email,d0001_tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$u->getNome());
			$stmt->bindValue(2,$u->getSenha());
			$stmt->bindValue(3,$u->getEmail());			
			$stmt->bindValue(4,$u->getTel()); 
			$stmt->bindValue(5,$u->getChave()); 
			$stmt->bindValue(6,$u->getFilialPad()); 

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();

                $sql = 'SELECT D0001_ID id FROM public."S0001_usuario" where d0001_chave = ?';

				$stmt = Conexao::getConn()->prepare($sql);  
				$stmt->bindValue(1,$u->getChave());  
				$stmt->execute();
				//Conexao::getConn()->commit(); 

				//Conexao::getConn()->beginTransaction();
				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 					 
					$u->setId($resultado[0]['id']);  
					$this->createItens($u); 
					$this->createFilial($u); 

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


		
 /*
		public function criaPerfil(Usuario $u)
		{  
 
			try{
				Conexao::getConn()->beginTransaction();	 
					$this->createItens($u); 
					$this->createFilial($u);   
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
*/

		public function createConta(Usuario $u)
		{  

			$sql = 'Insert into public."S0001_usuario" (d0001_nome,d0001_senha,d0001_email,d0001_dt_inclusao,d0001_filial_default,d0001_bloqueado,d0001_chave_atenticacao) values(?,?,?,?,?,?,?)'; 

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$u->getNome());
			$stmt->bindValue(2,$u->getSenha());
			$stmt->bindValue(3,$u->getEmail());		
			$stmt->bindValue(4,$u->getDtInclusao());	
			$stmt->bindValue(5,$u->getFilialPad());
			$stmt->bindValue(6,$u->getBloqueado());
			$stmt->bindValue(7,$u->getChaveAutenticacao());  

			//Gravar data de inclusao e alteracao, validado			 

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute(); 

				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
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


		public function read($numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT  d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel   FROM public."S0001_usuario" order by d0001_nome LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ; 
			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
				return $resultado;	
			else: 
				return [];				
			endif;

		 
		}

		public function readF(Usuario $u,$numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT  d0001_id id,d0001_nome nome,d0001_senha senha,d0001_email email,d0001_tel tel   FROM public."S0001_usuario"';

 
			if((!empty($u->getNome()) and  $u->getNome() != '') or (!empty($u->getEmail()) and  $u->getEmail() != '')  ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($u->getNome()) and  $u->getNome() != ''):
				$sql =  $sql .  ' upper(d0001_nome) like ? ';
				$prim_filtro = True;
			endif;


			if(!empty($u->getEmail())  and  $u->getEmail() != '' ):	
				if($prim_filtro):
					$sql =  $sql . ' and upper(d0001_email) like ? ';
				else:
					$sql =  $sql . ' upper(d0001_email) like ? ';
					$prim_filtro = True;
				endif;		
			endif;

			 $sql  = $sql . ' order by d0001_nome  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;
 
			$stmt = Conexao::getConn()->prepare($sql);
 
			$prim_filtro = false;
			$bind = 1;

			if(!empty($u->getNome()) and  $u->getNome() != ''  ):
				$stmt->bindValue($bind,strtoupper($u->getNome()));
				$prim_filtro = True;
				$bind++;
			endif;


			if(!empty($u->getEmail())  and  $u->getEmail() != '' ):				 
				$stmt->bindValue($bind,strtoupper($u->getEmail()));				 
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

		public function totRegistros(Usuario $u)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."S0001_usuario" ';

 
			if(!empty($u->getNome()) and  $u->getNome() != ''  ):
				$sql  = $sql . ' where ';
			endif;

			if(!empty($u->getNome())):
				$sql =  $sql .  ' upper(d0001_nome) like ? ';
				$prim_filtro = True;
			endif;


			if(!empty($u->getEmail())  and  $u->getEmail() != '' ):	
				if($prim_filtro):
					$sql =  $sql . ' and upper(d0001_email) like ? ';
				else:
					$sql =  $sql . ' upper(d0001_email) like ? ';
					$prim_filtro = True;
				endif;		
			endif;

		 
 
			$stmt = Conexao::getConn()->prepare($sql);
 
			$prim_filtro = false;
			$bind = 1;

			if(!empty($u->getNome()) and  $u->getNome() != ''  ):
				$stmt->bindValue($bind,strtoupper($u->getNome()));
				$prim_filtro = True;
				$bind++;
			endif;


			if(!empty($u->getEmail())  and  $u->getEmail() != '' ):				 
				$stmt->bindValue($bind,strtoupper($u->getEmail()));				 
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


		public function readItens(Usuario $u)
		{ 
			 
 
			$sql = 'SELECT  p.d0006_id_grupo id ,f.d0006_desc_grupo descricao  FROM public."S0011_USUARIO_GRUPO" p inner join public."S0006_GRUPO" f on p.d0006_id_grupo = f.d0006_id_grupo   WHERE p.d0001_id = ? order by D0011_ordem'  ;	
			
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getId());  
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


		public function montaPerfil(Usuario $u)
		{
 		 
			//$sql = 'Select * from usuario';
			//$sql = 'SELECT * FROM public."S0001_usuario" where d0001_nome = ? and d0001_senha = ?';
			$sql = 'SELECT  d0001_nome nome,d0001_senha senha  FROM public."S0001_usuario" where d0001_email = ?';
 

			$sql = 'SELECT DISTINCT SIGLA,NOME_BOTAO ';
			$sql =  $sql . ' FROM ';
			$sql =  $sql . ' ( ';
			$sql =  $sql . ' SELECT USU.D0001_ID,USU_G.D0006_ID_GRUPO,GRP_FUNC.D0004_ID_PERFIL,PER_FUNC.D0002_ID_FUNCAO ,  ';
			$sql =  $sql . ' FUNC_ACAO.D0003_ID_ACAO, FUNC.D0001_ID_FUNC,tab.d0004_string2 sigla ,tab_acao.d0004_string2 nome_botao  ';
			$sql =  $sql . ' FROM PUBLIC."S0011_USUARIO_GRUPO" USU_G ';
			$sql =  $sql . ' INNER JOIN PUBLIC."S0001_usuario" USU ON USU_G.D0001_ID = USU.D0001_ID  ';
			$sql =  $sql . ' INNER JOIN PUBLIC."S0007_GRUPO_PERFIL" GRP_FUNC ON GRP_FUNC.D0006_id_grupo = USU_G.D0006_ID_GRUPO   ';
			$sql =  $sql . ' INNER JOIN PUBLIC."S0005_PERFIL_FUNCAO" PER_FUNC ON PER_FUNC.D0004_ID_PERFIL = GRP_FUNC.D0004_ID_PERFIL  ';
			$sql =  $sql . ' INNER JOIN PUBLIC."S0003_FUNCAO_ACAO" FUNC_ACAO ON FUNC_ACAO.D0002_ID_FUNCAO = PER_FUNC.D0002_ID_FUNCAO ';
			$sql =  $sql . ' INNER JOIN PUBLIC."S0002_FUNCAO" FUNC ON FUNC_ACAO.D0002_ID_FUNCAO = FUNC.D0002_ID_FUNCAO  ';
			$sql =  $sql . ' inner join public."E0004_tabela" tab on tab.d0004_id = FUNC.D0001_ID_FUNC  ';
			$sql =  $sql . ' inner join public."E0004_tabela" tab_acao on tab_acao.d0004_id = FUNC_ACAO.D0003_ID_ACAO ';
			$sql =  $sql . ' WHERE USU.d0001_email = ?   ';
			$sql =  $sql . ' ) P ';
			$sql =  $sql . ' WHERE  LENGTH(NOME_BOTAO) > 0 ';
	 


			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$u->getEmail());
			//$stmt->bindValue(2,$u->getSenha());
			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
				return $resultado;		
			else:
				return 'NOK';				
			endif;

		 
		}



	}




?>
