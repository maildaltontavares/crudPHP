
<?php

	require_once "../model/tabela.php";
	require_once "../model/TabelaDao.php";
	
	class tabelaCtr{

		public function delete($p_id){

			$tabela = new tabela();
			$tabela->setId($p_id);

			$TabelaDao = new TabelaDao();  
			return $TabelaDao->delete($tabela); 


		}		

		public function buscatabela($p_id){

			$tabela = new tabela();
			$tabela->setId($p_id);

			$TabelaDao = new TabelaDao();  
			return $TabelaDao->buscaTabela($tabela); 


		 } 


		public function update($p_id,$p_idTp,$p_str1,$p_str2,$p_str3,$p_flag1,$p_flag2,$p_flag3,$p_num1,$p_num2,$p_num3,$p_data1,$p_data2,$p_data3 ){


			// Prepara Bean tabela
			$tabela = new Tabela();
			$tabela->setId($p_id);
			$tabela->setIdTp($p_idTp); 
			$tabela->setStr1($p_str1); 
			$tabela->setStr2($p_str2); 		
			$tabela->setStr3($p_str3); 	
			$tabela->setFlag1($p_flag1); 		
			$tabela->setFlag2($p_flag2); 	
			$tabela->setFlag3($p_flag3); 
			$tabela->setNum1($p_num1); 
			$tabela->setNum2($p_num2); 
			$tabela->setNum3($p_num3); 
			$tabela->setData1($p_data1); 
			$tabela->setData2($p_data2); 
 			$tabela->setData3($p_data3); 


			//  Vzalida tabela
			$TabelaDao = new TabelaDao();
			$r = $TabelaDao->update($tabela); 
			return  $r;  
		 }


		public function create($p_idTp,$p_str1,$p_str2,$p_str3,$p_flag1,$p_flag2,$p_flag3,$p_num1,$p_num2,$p_num3,$p_data1,$p_data2,$p_data3){


			// Prepara Bean tabela
			$tabela = new Tabela(); 
			$tabela->setIdTp($p_idTp); 
			$tabela->setStr1($p_str1); 
			$tabela->setStr2($p_str2); 
			$tabela->setStr3($p_str3); 
			$tabela->setFlag1($p_flag1); 
			$tabela->setFlag2($p_flag2); 
			$tabela->setFlag3($p_flag3); 
     		$tabela->setNum1($p_num1); 
			$tabela->setNum2($p_num2); 
			$tabela->setNum3($p_num3); 
			$tabela->setData1($p_data1); 
			$tabela->setData2($p_data2); 
 			$tabela->setData3($p_data3); 

			$TabelaDao = new TabelaDao();
			$r = $TabelaDao->create($tabela); 
			return  $r;  
		 }
 


		public function listatabela(){

			
			$TabelaDao = new TabelaDao();  
			return $TabelaDao->read();
			

		 } 


		public function listaTabelaF($p_tabela){

			// Prepara Bean tabela
			$tabela = new Tabela(); 
			$tabela->setDescTabPad($p_tabela);   
			 
			$TabelaDao = new TabelaDao();
			return $TabelaDao->readF($tabela);
			

		 } 


	}	 

?>
