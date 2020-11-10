
<?php

	require_once "../model/usuario.php";
	require_once "../model/usuarioDao.php";
	
	class UsuarioCtr{

		public function delete($p_id){

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

		public function buscaFilialUsuario($p_id){

			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuarioDao = new UsuarioDao();  
			return $usuarioDao->buscaFilialUsuario($usuario);  
 
		 } 		 


		public function update($p_id,$p_usuario,$p_senha,$p_email,$p_fone,$p_itens){ 

			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);
			$usuario->setItens($p_itens);  

			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->update($usuario); 
			return  $r;  
		 }


		public function create($p_usuario,$p_senha,$p_email,$p_fone,$p_itens,$p_chave){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);
			$usuario->setItens($p_itens); 
			$usuario->setChave($p_chave);    
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->create($usuario); 
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
