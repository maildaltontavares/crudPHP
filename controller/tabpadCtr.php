
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

		public function buscatabpad($p_id){

			$tabpad = new TabPad();
			$tabpad->setId($p_id);

			$tabpadDao = new tabpadDao();  
			return $tabpadDao->buscatabpad($tabpad); 


		 } 


		public function update($p_id,$p_tabpad){


			// Prepara Bean tabpad
			$tabpad = new TabPad();
			$tabpad->setId($p_id);
			$tabpad->setNome($p_tabpad); 

			//  Vzalida tabpad
			$tabpadDao = new tabpadDao();
			$r = $tabpadDao->update($tabpad); 
			return  $r;  
		 }


		public function create($p_tabpad){


			// Prepara Bean tabpad
			$tabpad = new TabPad();
			$tabpad->setNome($p_tabpad);  

			$tabpadDao = new tabpadDao();
			$r = $tabpadDao->create($tabpad); 
			return  $r;  
		 }
 


		public function listatabpad(){

			
			$tabpadDao = new tabpadDao();  
			return $tabpadDao->read();
			

		 } 


		public function listatabpadF($p_tabpad){

			// Prepara Bean tabpad
			$tabpad = new TabPad();

			$tabpad->setNome($p_tabpad);
			 
			$tabpadDao = new tabpadDao();
			return $tabpadDao->readF($tabpad);
			

		 } 


	}	 

?>
