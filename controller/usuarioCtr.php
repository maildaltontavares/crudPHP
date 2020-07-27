
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


		public function update($p_id,$p_usuario,$p_senha,$p_email,$p_fone){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setId($p_id);
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);


			//  Vzalida usuario
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->update($usuario); 
			return  $r;  
		 }


		public function create($p_usuario,$p_senha,$p_email,$p_fone){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setNome($p_usuario);
			$usuario->setSenha($p_senha);
			$usuario->setEmail($p_email);
			$usuario->setTel($p_fone);


			//  Vzalida usuario
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->create($usuario); 
			return  $r;  
		 }



		public function validaUsuario($p_usuario,$senha){


			// Prepara Bean usuario
			$usuario = new Usuario();
			$usuario->setNome($p_usuario);
			$usuario->setSenha($senha);

		 

			//  Vzalida usuario
			$usuarioDao = new UsuarioDao();
			$r = $usuarioDao->validaUsuario($usuario); 
			return  $r;  
		 }


		public function listaUsuario(){

			$usuarioDao = new UsuarioDao();
			return $usuarioDao->read();
			

		 } 


		public function listaUsuarioF($p_usuario,$email){

			// Prepara Bean usuario
			$usuario = new Usuario();

			$usuario->setNome($p_usuario);
			$usuario->setEmail($email);

			$usuarioDao = new UsuarioDao();
			return $usuarioDao->readF($usuario);
			

		 } 


	}	 

?>
