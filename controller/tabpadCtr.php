
<?php

	require_once "../model/tabpad.php";
	require_once "../model/tabpadDao.php";
	
	class tabpadCtr{

		public function delete($p_id){

			$tabpad = new TabPad();
			$tabpad->setId($p_id);

			$tabpadDao = new tabpadDao();  
			return $tabpadDao->delete($tabpad); 


		}		

		public function buscatpSigla($p_sigla){

           // echo 'Aqquiiii';
            

			$tabpad = new TabPad();  
			$tabpad->setSigla($p_sigla);

            //var_dump($tabpad->getSigla());

			$tabpadDao = new tabpadDao();  
			return $tabpadDao->buscatpSigla($tabpad); 


		 } 


		public function buscatabpad($p_id){

			$tabpad = new TabPad();  
			$tabpad->setId($p_id);

			$tabpadDao = new tabpadDao();  
			return $tabpadDao->buscatabpad($tabpad); 


		 } 


		public function buscaTpCad(){

			
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->buscaTpCad();
			

		 }  


		public function update($p_id,$p_tabpad,$p_sigla,$p_tbsys){


			// Prepara Bean tabpad
			$tabpad = new TabPad();
			$tabpad->setId($p_id);
			$tabpad->setNome($p_tabpad); 
			$tabpad->setSigla($p_sigla); 
			$tabpad->setSistema($p_tbsys);  

			//  Vzalida tabpad
			$tabpadDao = new tabpadDao();
			$r = $tabpadDao->update($tabpad); 
			return  $r;  
		 }


		public function create($p_tabpad,$p_sigla,$p_tbsys){


			// Prepara Bean tabpad
			$tabpad = new TabPad();
			$tabpad->setNome($p_tabpad);  
			$tabpad->setSigla($p_sigla);  
			$tabpad->setSistema($p_tbsys);  

			$tabpadDao = new tabpadDao();
			$r = $tabpadDao->create($tabpad); 
			return  $r;  
		 }
 
		public function lerTodas(){
 
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->lerTodas();
			

		 } 

		public function lerTodasGeral(){
 
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->lerTodasGeral();
			

		 } 

		public function lerTodasSistema(){
 
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->lerTodasSistema();
			

		 } 		 


		public function lerNParam(){

      
			$tabpadDao = new tabpadDao();    
			return $tabpadDao->lerNParam();
			

		 } 				 

		public function listatabpad($numPg){

			
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->read($numPg);
			

		 } 


		public function listatabpadF($p_tabpad,$numPg){

			// Prepara Bean tabpad
			$tabpad = new TabPad();

			$tabpad->setNome($p_tabpad);
			 
			$tabpadDao = new tabpadDao();
			return $tabpadDao->readF($tabpad,$numPg);
			

		 } 

		public function totRegistros($p_tabpad){ 

			// Prepara Bean tabpad
			$tabpad = new TabPad();
			$tabpad->setNome($p_tabpad);
			 
			$tabpadDao = new tabpadDao();
			return $tabpadDao->totRegistros($tabpad);
			
			

		 } 




	}	 

?>
