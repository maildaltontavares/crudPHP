
<?php

	require_once "../model/leitura.php";
	require_once "../model/leituraDao.php";
	
	class LeituraCtr{


			/*
			$leitura->setFilial($p_filial); 
			$leitura->setTear($p_tear); 
			$leitura->setDtLeitura($p_dtLeitura);		 
			$leitura->setTurno($p_turno); 
			$leitura->setLeitura($p_leitura); 
			$leitura->setRpm($p_rpm); 
	        $leitura->setParTrama($p_par_Trama); 
	        $leitura->setParUrdume($p_par_urdume); 	
			$leitura->setParOutros($p_par_outros); 	
			$leitura->setDtInclusao($p_dtInclusao) 
			$leitura->setUsrInclusao($p_usrInclusao); 
			$leitura->setDtAlteracao($p_dtAlteracao);  
			$leitura->setUsrAlteracao($p_usrAlteracao); 
            */

		public function delete($p_id){

			$leitura = new Leitura();
			$leitura->setId($p_id);

			$leituraDao = new LeituraDao();  
			return $leituraDao->delete($leitura);    

		} 

		public function buscaLeitura($p_id){

			$leitura = new Leitura();  
			$leitura->setId($p_id);  

			$leituraDao = new LeituraDao();  
			return $leituraDao->buscaLeitura($leitura);  

		 }  


		public function update($p_id,$p_filial,$p_tear,$p_dtLeitura,$p_turno,$p_leitura,$p_rpm,$p_par_Trama,$p_par_urdume,$p_par_outros,$p_dtAlteracao,$p_usrAlteracao){


			// Prepara Bean tabpad
			$leitura = new Leitura();
			$leitura->setId($p_id);
			$leitura->setFilial($p_filial); 
			$leitura->setTear($p_tear); 
			$leitura->setDtLeitura($p_dtLeitura);		 
			$leitura->setTurno($p_turno); 
			$leitura->setLeitura($p_leitura); 
			$leitura->setRpm($p_rpm); 
	        $leitura->setParTrama($p_par_Trama); 
	        $leitura->setParUrdume($p_par_urdume); 	
			$leitura->setParOutros($p_par_outros); 	
			$leitura->setDtAlteracao($p_dtAlteracao);  
			$leitura->setUsrAlteracao($p_usrAlteracao); 			

			//  Vzalida tabpad
			$leituraDao = new LeituraDao();
			$r = $leituraDao->update($leitura); 
			return  $r;  
		 }


		public function create($p_filial,$p_tear,$p_dtLeitura,$p_turno,$p_leitura,$p_rpm,$p_par_Trama,$p_par_urdume,$p_par_outros,$p_dtInclusao,$p_usrInclusao){


			// Prepara Bean tabpad
			$leitura = new Leitura();
			$leitura->setFilial($p_filial); 
			$leitura->setTear($p_tear); 
			$leitura->setDtLeitura($p_dtLeitura);		 
			$leitura->setTurno($p_turno); 
			$leitura->setLeitura($p_leitura); 
			$leitura->setRpm($p_rpm); 
	        $leitura->setParTrama($p_par_Trama); 
	        $leitura->setParUrdume($p_par_urdume); 	
			$leitura->setParOutros($p_par_outros); 	
			$leitura->setDtInclusao($p_dtInclusao) ;
			$leitura->setUsrInclusao($p_usrInclusao); 			
 
			$leituraDao = new LeituraDao();
			$r = $leituraDao->create($leitura); 
			return  $r;  
		 }
 
		public function lerTodas(){

			
			$leituraDao = new LeituraDao();  
			return $leituraDao->lerTodas();
			

		 } 

 
		public function listaLeitura($numPg){

			
			$leituraDao = new LeituraDao();  
			return $leituraDao->read($numPg);
			

		 } 


		public function listaLeituraF($p_tear,$numPg){

			// Prepara Bean tabpad
			$leitura = new Leitura();
			$leitura->setTear($p_tear);
			 
			$leituraDao = new LeituraDao();
			return $leituraDao->readF($leitura,$numPg);
			

		 } 

		public function totRegistros($p_tear){ 

			// Prepara Bean tabpad
			$leitura = new Leitura();
			$leitura->setTear($p_tear);
			 
			$leituraDao = new LeituraDao();
			return $leituraDao->totRegistros($leitura);
			
			

		 } 




	}	 

?>
