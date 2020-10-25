
<?php

	require_once "../model/grupoUsuario.php";
	require_once "../model/grupoUsuarioDao.php";
	
	class GrupoUsuarioCtr{

		public function buscaGrupoUsuario($p_id){

			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setId($p_id);

			$grupoUsuarioDao = new GrupoUsuarioDao();  
			return $grupoUsuarioDao->buscaGrupoUsuario($grupoUsuario); 


		 } 


		public function delete($p_id){

			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setId($p_id);

			$grupoUsuarioDao = new GrupoUsuarioDao();  
			return $grupoUsuarioDao->delete($grupoUsuario); 


		}		 

		public function buscaChave($p_chave){

			$grupoUsuario = new GrupoUsuario();  
			$grupoUsuario->setChave($p_chave);

			$grupoUsuarioDao = new GrupoUsuarioDao();  
			return $grupoUsuarioDao->buscaChave($grupoUsuario); 


		 }  		
  
		public function update($p_id,$p_grupoUsuario,$p_itens){


			// Prepara Bean perfil
			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setId($p_id);
			$grupoUsuario->setNome($p_grupoUsuario); 
			$grupoUsuario->setItens($p_itens); 

			//  Vzalida perfil
			$grupoUsuarioDao = new GrupoUsuarioDao();
			$r = $grupoUsuarioDao->update($grupoUsuario); 
			return  $r;  
		 }


		public function create($p_grupoUsuario,$p_itens,$p_chave){


		 
			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setNome($p_grupoUsuario); 
			$grupoUsuario->setItens($p_itens); 
			$grupoUsuario->setChave($p_chave); 

			$grupoUsuarioDao = new GrupoUsuarioDao();
			$r = $grupoUsuarioDao->create($grupoUsuario); 
			return  $r;  
		 }
  
 
		public function listaGrupoUsuario($numPg){

			
			$grupoUsuarioDao = new GrupoUsuarioDao();  
			return $grupoUsuarioDao->read($numPg);
			

		 } 

		public function listaItens($p_id){

			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setId($p_id); 

			$grupoUsuarioDao = new GrupoUsuarioDao();  
			return $grupoUsuarioDao->readItens($grupoUsuario);
			

		 } 		 


		public function listaGrupoUsuarioF($p_grupoUsuario,$numPg){

			// Prepara Bean perfil
			$grupoUsuario = new GrupoUsuario();

			$grupoUsuario->setNome($p_grupoUsuario);
			 
			$grupoUsuarioDao = new GrupoUsuarioDao();
			return $grupoUsuarioDao->readF($grupoUsuario,$numPg);
			

		 } 

		public function totRegistros($p_grupoUsuario){ 

			// Prepara Bean perfil
			$grupoUsuario = new GrupoUsuario();
			$grupoUsuario->setNome($p_grupoUsuario);
			 
			$grupoUsuarioDao = new GrupoUsuarioDao();
			return $grupoUsuarioDao->totRegistros($grupoUsuario);
			
			

		 }  


	}	 

?>
