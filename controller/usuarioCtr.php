
<?php 

	require_once "../model/usuario.php"; 
	require_once "../model/usuarioDao.php"; 
	
	class UsuarioCtr{

		public function delete($p_id){


			//var_dump($p_id);	
			$usuario = new Usuario();
			$usuario->setId($p_id);

			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->delete($usuario);  

		}		

		public function buscaUsuario($p_id){

			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaUsuario($usuario);  

 
		 } 


		public function buscaUsuarioItens($p_id){

			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuarioDao = new UsuarioDao();  
			
            $aFiliais = $usuarioDao->buscaFilialUsuario($usuario);        
            $aGrupos  = $usuarioDao->readItens($usuario);
            $aUser    = $usuarioDao->buscaUsuario($usuario);
            array_push($aUser[0],$aGrupos);
            array_push($aUser[0],$aFiliais); 


            //var_dump($aUser);


			return $aUser;  

 
		 } 

		public function buscaFiliaisValidasUsuario($p_id){

			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaFiliaisValidasUsuario($usuario);  
 
		 } 	


		public function buscaFilialUsuario($p_id){

			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaFilialUsuario($usuario);  
 
		 } 		 


		public function update($p_id,$p_usuario,$p_senha,$p_email,$p_fone,$p_itens,$p_filial,$p_filPad){ 

			// Prepara Bean usuario 
			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);
			$usuario->setItens($p_itens);  
			$usuario->setFilial($p_filial);  
			$usuario->setFilialPad($p_filPad);  

           //var_dump('$usuario');
			//var_dump($usuario);			

			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->update($usuario); 
			return  $r;  
		 }


		public function create($p_usuario,$p_senha,$p_email,$p_fone,$p_itens,$p_chave,$p_filial,$p_filPad){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);
			$usuario->setItens($p_itens); 
			$usuario->setChave($p_chave);    
			$usuario->setFilial($p_filial);  
			$usuario->setFilialPad($p_filPad); 


           //var_dump('$usuario');
			//var_dump($usuario);


			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->create($usuario); 
			return  $r;  
		 }

		public function createConta($p_usuario,$p_senha,$p_email,$p_dt_inc,$p_filPad,$p_chaveAutentic,$p_bloq){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setFilialPad($p_filPad);   
            $usuario->setBloqueado($p_bloq);
		    $usuario->setDtInclusao($p_dt_inc);  
		    $usuario->setChaveAutenticacao($p_chaveAutentic);  

			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->createConta($usuario); 
			return  $r;  
		 }

		public function createChaveAltSenha($p_usuario, $p_chaveAltSenha,$p_dtAlt){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setId($p_usuario);
			$usuario->setDtAlteracao($p_dtAlt);   
		    $usuario->setChaveAltSenha($p_chaveAltSenha);  

			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->createChaveAltSenha($usuario); 
			return  $r;  
		 }

		public function alteraSenha($p_usuario,$p_senha ,$p_dtAlt){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setId($p_usuario);
			$usuario->setDtAlteracao($p_dtAlt);   			 
			$usuario->setSenha($p_senha); 

			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->alteraSenha($usuario); 
			return  $r;  
		 }

 	 

		public function validaChaveAutenticacao($p_chaveAutentic){  
			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setChaveAutenticacao($p_chaveAutentic);
			 
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->validaChaveAutenticacao($usuario); 
			return  $r;  
		 }	


		public function validaChaveAltSenha($p_chaveAltSenha){  
			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setChaveAltSenha($p_chaveAltSenha);
			 
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->validaChaveAltSenha($usuario); 
			return  $r;  
		 }	

		 public function confirmaConta($p_usuario,$p_dtAlt,$p_itens,$p_filial){  
		 
			$usuario = new Usuario();
			$usuario->setId($p_usuario);			
			$usuario->setDtAlteracao($p_dtAlt); 
			$usuario->setItens($p_itens);  
			$usuario->setFilial($p_filial);  
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->confirmaConta($usuario); 
			return  $r;  
		 }	 
		 

		public function validaUsuario($p_email,$senha){  
			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setEmail($p_email);
			$usuario->setSenha($senha); 
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->validaUsuario($usuario); 
			return  $r;  
		 }


		public function listaUsuario($numPg){

			$usuarioDao = new UsuarioDao();
			return $usuarioDao->read($numPg);
			

		 } 
		public function buscaChave($p_chave){

			$usuario = new Usuario();  
			$usuario->setChave($p_chave);

			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaChave($usuario); 


	    } 	
	     public function buscaChaveFilialUsuario($p_chave){

			$usuario = new Usuario();  
			$usuario->setChave($p_chave);

			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaChaveFilialUsuario($usuario); 


	    } 


		public function listaUsuarioF($p_usuario,$email,$numPg){

			// Prepara Bean usuario
			$usuario = new Usuario();

			$usuario->setNome($p_usuario);
			$usuario->setEmail($email);

			$usuarioDao = new UsuarioDao();
			return $usuarioDao->readF($usuario,$numPg);
			

		 } 
		public function totRegistros($p_usuario,$email){ 

			// Prepara Bean tabpad

			$usuario = new Usuario();

			$usuario->setNome($p_usuario);
			$usuario->setEmail($email);

			$usuarioDao = new UsuarioDao(); 
			return $usuarioDao->totRegistros($usuario);
			
			

		 } 

		public function listaItens($p_id){
 
			$usuario = new Usuario();
			$usuario->setId($p_id); 

			$usuarioDao = new UsuarioDao(); 

			//var_dump('expression');
            // var_dump($usuarioDao->readItens($usuario));

			return $usuarioDao->readItens($usuario);
			

		 } 	


		public function montaPerfil($p_email){ 
			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setEmail($p_email); 
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->montaPerfil($usuario); 
			return  $r;  
		 }   

	}	 

?>
