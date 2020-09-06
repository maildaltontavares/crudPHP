
<?php

	require_once "../model/funcaoSistema.php";
	require_once "../model/funcaoSistemaDao.php";
	
	class FuncaoSistemaCtr{

		public function delete($p_id){

			$funcSys = new FuncaoSistema();
			$funcSys->setId($p_id);

			$funcSysDao = new FuncSysDao();  
			return $funcSysDao->delete($funcSys); 


		}		
 

		public function buscaFuncaoSistema($p_id){

			$funcSys = new FuncaoSistema();  
			$funcSys->setId($p_id);

			$funcSysDao = new FuncSysDao();  
			return $funcSysDao->buscaFuncaoSistema($funcSys); 


		 }  

		public function update($p_id,$p_funcSys,$p_func,$p_acao){


			// Prepara Bean tabpad
			$funcSys = new FuncaoSistema();
			$funcSys->setId($p_id);
			$funcSys->setNome($p_funcSys); 
			$funcSys->setFunc($p_func); 
			$funcSys->setAcao($p_acao);

			//  Vzalida tabpad
			$funcSysDao = new FuncSysDao();
			$r = $funcSysDao->update($funcSys); 
			return  $r;  
		 }


		public function create($p_funcSys,$p_func,$p_acao ){ 

			$date = date('YmdHis'); 
			$chave =  '' . $date  ;
			for ($i = 1; $i <= 3; $i++) {
  			  $chave = $chave .  (string)random_int(100, 999);
			}  	 

			$funcSys = new FuncaoSistema();
			$funcSys->setNome($p_funcSys);  
			$funcSys->setFunc($p_func); 
			$funcSys->setAcao($p_acao); 
			$funcSys->setChave($chave);

			$funcSysDao = new FuncSysDao();
			$r = $funcSysDao->create($funcSys); 
			return  $r;  
		 }

 
		public function listaFuncaoSistema($numPg){
			
			$funcSysDao = new FuncSysDao();  
			return $funcSysDao->read($numPg);
			

		 } 

		public function listaAcao($p_func){
			
			$funcSys = new FuncaoSistema();
			$funcSys->setFunc($p_func); 

			$funcSysDao = new FuncSysDao();  
			return $funcSysDao->readItens($funcSys);
			

		 } 		 


		public function listaFuncSysF($p_funcSys,$numPg){

			// Prepara Bean tabpad
			$funcSys = new FuncaoSistema();

			$funcSys->setNome($p_funcSys);
			 
			$funcSysDao = new FuncSysDao();
			return $funcSysDao->readF($funcSys,$numPg);
			

		 } 

		public function totRegistros($p_funcSys){ 

			// Prepara Bean tabpad
			$funcSys = new FuncaoSistema();
			$funcSys->setNome($p_funcSys);
			 
			$funcSysDao = new FuncSysDao();
			return $funcSysDao->totRegistros($funcSys);
			
			

		 } 




	}	 

?>
