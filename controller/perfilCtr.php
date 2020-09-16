
<?php

	require_once "../model/perfil.php";
	require_once "../model/perfilDao.php";
	
	class PerfilCtr{

		public function buscaPerfil($p_id){

			$perfil = new Perfil();
			$perfil->setId($p_id);

			$perfilDao = new PerfilDao();  
			return $perfilDao->buscaPerfil($perfil); 


		 } 


		public function delete($p_id){

			$perfil = new Perfil();
			$perfil->setId($p_id);

			$perfilDao = new PerfilDao();  
			return $perfilDao->delete($perfil); 


		}		

		  
  
		public function update($p_id,$p_perfil){


			// Prepara Bean perfil
			$perfil = new Perfil();
			$perfil->setId($p_id);
			$perfil->setNome($p_perfil); 
			 

			//  Vzalida perfil
			$perfilDao = new PerfilDao();
			$r = $perfilDao->update($perfil); 
			return  $r;  
		 }


		public function create($p_perfil){


			// Prepara Bean perfil
			$perfil = new Perfil();
			$perfil->setNome($p_perfil); 
			$perfilDao = new PerfilDao();
			$r = $perfilDao->create($perfil); 
			return  $r;  
		 }
  
 
		public function listaPerfil($numPg){

			
			$perfilDao = new PerfilDao();  
			return $perfilDao->read($numPg);
			

		 } 


		public function listaPerfilF($p_perfil,$numPg){

			// Prepara Bean perfil
			$perfil = new Perfil();

			$perfil->setNome($p_perfil);
			 
			$perfilDao = new PerfilDao();
			return $perfilDao->readF($perfil,$numPg);
			

		 } 

		public function totRegistros($p_perfil){ 

			// Prepara Bean perfil
			$perfil = new Perfil();
			$perfil->setNome($p_perfil);
			 
			$perfilDao = new PerfilDao();
			return $perfilDao->totRegistros($perfil);
			
			

		 } 




	}	 

?>
