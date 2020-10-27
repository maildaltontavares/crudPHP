
<?php

	require_once "../model/grupoTabela.php";
	require_once "../model/grupoTabelaDao.php";
	
	class GrupoTabelaCtr{

		public function delete($p_id){

			$grupoTab = new GrupoTabela();
			$grupoTab->setId($p_id);

			$grupoTabDao = new GrupoTabelaDao();  
			return $grupoTabDao->delete($grupoTab); 


		}		
 

		public function buscaGrupoTabela($p_id){

			$grupoTab = new GrupoTabela();  
			$grupoTab->setId($p_id);

			$grupoTabDao = new GrupoTabelaDao();  
			return $grupoTabDao->buscaGrupoTabela($grupoTab); 


		 }  

		public function buscaChave($p_chave){

			$grupoTab = new GrupoTabela();  
			$grupoTab->setChave($p_chave);

			$grupoTabDao = new GrupoTabelaDao();  
			return $grupoTabDao->buscaChave($grupoTab); 


		 }  		 

		public function update($p_id,$p_GrupoTab,$p_tab){


			// Prepara Bean tabpad
			$grupoTab = new GrupoTabela();
			$grupoTab->setId($p_id);
			$grupoTab->setNome($p_GrupoTab); 
			$grupoTab->setTabela($p_tab); 


			//  Vzalida tabpad
			$grupoTabDao = new GrupoTabelaDao();
			$r = $grupoTabDao->update($grupoTab); 
			return  $r;  
		 }


		public function create($p_GrupoTab,$p_tab, $p_chave ){  

			$grupoTab = new GrupoTabela();
			$grupoTab->setNome($p_GrupoTab);  
			$grupoTab->setTabela($p_tab);  
			$grupoTab->setChave($p_chave);

			$grupoTabDao = new GrupoTabelaDao();
			$r = $grupoTabDao->create($grupoTab); 
			return  $r;  
		 }

 
		public function listaGrupoTabela($numPg){
			
			$grupoTabDao = new GrupoTabelaDao();  
			return $grupoTabDao->read($numPg);
			

		 } 

		public function listaTabelas($p_tab){

			$grupoTab = new GrupoTabela();
			$grupoTab->setId($p_tab); 

			$grupoTabDao = new GrupoTabelaDao();  
			return $grupoTabDao->readItens($grupoTab);
			

		 } 		 


		public function listaGrupoTabelaF($p_GrupoTab,$numPg){

			// Prepara Bean tabpad
			$grupoTab = new GrupoTabela(); 
			$grupoTab->setNome($p_GrupoTab); 
			$grupoTabDao = new GrupoTabelaDao();
			return $grupoTabDao->readF($grupoTab,$numPg);
			

		 } 

		public function totRegistros($p_GrupoTab){ 

			// Prepara Bean tabpad
			$grupoTab = new GrupoTabela();
			$grupoTab->setNome($p_GrupoTab);
			 
			$grupoTabDao = new GrupoTabelaDao();
			return $grupoTabDao->totRegistros($grupoTab);
			
			

		 } 



		public function buscaGrupoTabelaF($p_GrupoTab){

			// Prepara Bean tabpad
			$grupoTab = new GrupoTabela();

			$grupoTab->setNome($p_GrupoTab);
			 
			$grupoTabDao = new GrupoTabelaDao();
			return $grupoTabDao->readGrupoTabela($grupoTab);
			

		 } 





	}	 

?>
