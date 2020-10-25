
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

		public function buscaChave($p_chave){

			$perfil = new Perfil();  
			$perfil->setChave($p_chave);

			$perfilDao = new PerfilDao();  
			return $perfilDao->buscaChave($perfil); 


		 }  		
  
		public function update($p_id,$p_perfil,$p_itens){


			// Prepara Bean perfil
			$perfil = new Perfil();
			$perfil->setId($p_id);
			$perfil->setNome($p_perfil); 
			$perfil->setItens($p_itens); 

			//  Vzalida perfil
			$perfilDao = new PerfilDao();
			$r = $perfilDao->update($perfil); 
			return  $r;  
		 }


		public function create($p_perfil,$p_itens,$p_chave){


			// Prepara Bean perfil
			$perfil = new Perfil();
			$perfil->setNome($p_perfil); 
			$perfil->setItens($p_itens); 
			$perfil->setChave($p_chave); 

			$perfilDao = new PerfilDao();
			$r = $perfilDao->create($perfil); 
			return  $r;  
		 }
  
 
		public function listaPerfil($numPg){

			
			$perfilDao = new PerfilDao();  
			return $perfilDao->read($numPg);
			

		 } 

		public function listaItens($p_id){

			$perfil = new Perfil();
			$perfil->setId($p_id); 

			$perfilDao = new PerfilDao();  
			return $perfilDao->readItens($perfil);
			

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

		public function buscaPerfilF($p_perfil){

			// Prepara Bean tabpad
			$perfil = new Perfil();

			$perfil->setNome($p_perfil);
			 
			$perfilDao = new PerfilDao();
			return $perfilDao->readPerfil($perfil);
			

		 } 		 




	}	 

?>
