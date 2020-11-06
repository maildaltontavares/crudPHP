
<?php

	require_once "../model/grupoEmpresa.php";
	require_once "../model/grupoEmpresaDao.php";
	
	class GrupoEmpresaCtr{

		public function delete($p_id){

			$grupoEmpresa = new GrupoEmpresa();
			$grupoEmpresa->setId($p_id);

			$grupoEmpresaDao = new GrupoEmpresaDao();  
			return $grupoEmpresaDao->delete($grupoEmpresa); 


		}		

		 


		public function buscaGrupoEmpresa($p_id){

			$grupoEmpresa = new GrupoEmpresa();  
			$grupoEmpresa->setId($p_id);

			$grupoEmpresaDao = new GrupoEmpresaDao();  
			return $grupoEmpresaDao->buscaGrupoEmpresa($grupoEmpresa); 


		 }  


		public function update($p_id,$p_grupoEmpresa){


			// Prepara Bean tabpad
			$grupoEmpresa = new GrupoEmpresa();
			$grupoEmpresa->setId($p_id);
			$grupoEmpresa->setNome($p_grupoEmpresa);  

			//  Vzalida tabpad
			$grupoEmpresaDao = new GrupoEmpresaDao();
			$r = $grupoEmpresaDao->update($grupoEmpresa); 
			return  $r;  
		 }


		public function create($p_grupoEmpresa ){


			// Prepara Bean tabpad
			$grupoEmpresa = new GrupoEmpresa();
			$grupoEmpresa->setNome($p_grupoEmpresa);  
 
			$grupoEmpresaDao = new GrupoEmpresaDao();
			$r = $grupoEmpresaDao->create($grupoEmpresa); 
			return  $r;  
		 }
 
		public function lerTodas(){

			
			$grupoEmpresaDao = new GrupoEmpresaDao();  
			return $grupoEmpresaDao->lerTodas();
			

		 } 

 
		public function listaGrupoEmpresa($numPg){

			
			$grupoEmpresaDao = new GrupoEmpresaDao();  
			return $grupoEmpresaDao->read($numPg);
			

		 } 


		public function listaGrupoEmpresaF($p_grupoEmpresa,$numPg){

			// Prepara Bean tabpad
			$grupoEmpresa = new GrupoEmpresa();

			$grupoEmpresa->setNome($p_grupoEmpresa);
			 
			$grupoEmpresaDao = new GrupoEmpresaDao();
			return $grupoEmpresaDao->readF($grupoEmpresa,$numPg);
			

		 } 

		public function totRegistros($p_grupoEmpresa){ 

			// Prepara Bean tabpad
			$grupoEmpresa = new GrupoEmpresa();
			$grupoEmpresa->setNome($p_grupoEmpresa);
			 
			$grupoEmpresaDao = new GrupoEmpresaDao();
			return $grupoEmpresaDao->totRegistros($grupoEmpresa);
			
			

		 } 




	}	 

?>
