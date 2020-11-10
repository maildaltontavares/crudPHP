
<?php

	require_once "../model/filial.php";
	require_once "../model/filialDao.php";
	
	class FilialCtr{

		public function delete($p_id){

			$filial = new Filial();
			$filial->setId($p_id);

			$filialDao = new FilialDao();  
			return $filialDao->delete($filial); 


		}		
 

		public function buscaFilial($p_id){

			$filial = new Filial();  
			$filial->setId($p_id);

			$filialDao = new FilialDao();  
			return $filialDao->buscaFilial($filial); 


		 }  

		public function buscaChave($p_chave){

			$filial = new Filial();  
			$filial->setChave($p_chave);

			$filialDao = new FilialDao();  
			return $filialDao->buscaChave($filial); 


		 } 


		 public function lerFilialUsuario(){

			//$filial = new Filial();  
			//$filial->setChave($p_chave);

			$filialDao = new FilialDao();  
			return $filialDao->lerFilialUsuario(); 


		 } 

		public function update($p_id,$p_filial,$p_grupo){


			// Prepara Bean tabpad
			$filial = new Filial();
			$filial->setId($p_id);
			$filial->setNome($p_filial); 
			$filial->setGrupo($p_grupo); 
			 

			//  Vzalida tabpad
			$filialDao = new FilialDao();
			$r = $filialDao->update($filial); 
			return  $r;  
		 }


		public function create($p_filial,$p_grupo){ 



			$filial = new Filial();
			$filial->setNome($p_filial);  
			$filial->setGrupo($p_grupo);   
			$filialDao = new FilialDao();
			$r = $filialDao->create($filial); 
			return  $r;  
		 }

 
		public function listaFilial($numPg){
			
			$filialDao = new FilialDao();  
			return $filialDao->read($numPg);
			

		 }  


		public function listaFilialF($p_filial,$numPg){

			// Prepara Bean tabpad
			$filial = new Filial();

			$filial->setNome($p_filial);
			 
			$filialDao = new FilialDao();
			return $filialDao->readF($filial,$numPg);
			

		 } 

		public function totRegistros($p_filial){ 

			// Prepara Bean tabpad
			$filial = new Filial();
			$filial->setNome($p_filial);
			 
			$filialDao = new FilialDao();
			return $filialDao->totRegistros($filial);
			
			

		 } 



		public function buscaFilialF($p_filial){

			// Prepara Bean tabpad
			$filial = new Filial();

			$filial->setNome($p_filial);
			 
			$filialDao = new FilialDao();
			return $filialDao->readGrupo($filial);
			

		 } 





	}	 

?>
