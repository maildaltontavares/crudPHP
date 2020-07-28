
<?php

	require_once "../model/paramtp.php";
	require_once "../model/paramtpDao.php";
	
	class ParamTpCtr{

		public function delete($p_id){

			$paramtp = new ParamTp();
			$paramtp->setId($p_id);

			$paramtpDao = new paramtpDao();  
			return $paramtpDao->delete($paramtp); 

		}		

		public function buscaParamTb($p_id){

			$paramtp = new ParamTp();
			$paramtp->setId($p_id);

			$paramtpDao = new paramtpDao();   
			return $paramtpDao->buscaParamTb($paramtp); 
		 }  

		public function update($p_id,$p_idTp,$p_str1,$p_descStr1,$p_str2,$p_descStr2 ,$p_str3,$p_descStr3,$p_flag1,$p_descFlag1,$p_flag2,$p_descFlag2,$p_flag3,$p_descFlag3,$p_num1,$p_descNum1,$p_num2,$p_descNum2,$p_num3,$p_descNum3,$p_data1,$p_descData1,$p_data2,$p_descData2,$p_data3,$p_descData3 ){

 
			// Prepara Bean ParamTp
			$paramtp = new ParamTp(); 

			$paramtp->setId($p_id);
			$paramtp->setIdTp($p_idTp); 
			$paramtp->setStr1($p_str1); 
			$paramtp->setDescStr1($p_descStr1); 
			$paramtp->setStr2($p_str2); 
			$paramtp->setDescStr2($p_descStr2); 			
			$paramtp->setStr3($p_str3); 
			$paramtp->setDescStr3($p_descStr3); 			
			$paramtp->setFlag1($p_flag1); 
			$paramtp->setDescFlag1($p_descFlag1); 			
			$paramtp->setFlag2($p_flag2); 
			$paramtp->setDescFlag2($p_descFlag2); 		
			$paramtp->setFlag3($p_flag3); 
			$paramtp->setDescFlag3($p_descFlag3); 	 
			$paramtp->setNum1($p_num1); 
			$paramtp->setDescNum1($p_descNum1); 	


			$paramtp->setNum2($p_num2); 
			$paramtp->setDescNum2($p_descNum2); 	
			$paramtp->setNum3($p_num3); 
			$paramtp->setDescNum3($p_descNum3); 	


			$paramtp->setData1($p_data1); 
			$paramtp->setDescData1($p_descData1); 
			$paramtp->setData2($p_data2); 
			$paramtp->setDescData2($p_descData2); 	
 			$paramtp->setData3($p_data3); 
			$paramtp->setDescData3($p_descData3); 	

			//  Vzalida ParamTp

			//var_dump($paramtp);
			$paramtpDao = new paramtpDao();    
			$r = $paramtpDao->update($paramtp); 
			return  $r;  
		 }
                                 

		public function create($p_idTp,$p_str1,$p_descStr1,$p_str2,$p_descStr2 ,$p_str3,$p_descStr3,$p_flag1,$p_descFlag1,$p_flag2,$p_descFlag2,$p_flag3,$p_descFlag3,$p_num1,$p_descNum1,$p_num2,$p_descNum2,$p_num3,$p_descNum3,$p_data1,$p_descData1,$p_data2,$p_descData2,$p_data3,$p_descData3){

			//var_dump($p_flag3);
			//var_dump($p_descStr2);
			//var_dump($p_descStr3);
			// Prepara Bean ParamTp
			$paramtp = new ParamTp(); 
			$paramtp->setIdTp($p_idTp); 
			$paramtp->setStr1($p_str1); 
			$paramtp->setDescStr1($p_descStr1); 
			$paramtp->setStr2($p_str2); 
			$paramtp->setDescStr2($p_descStr2); 			
			$paramtp->setStr3($p_str3); 
			$paramtp->setDescStr3($p_descStr3); 			
			$paramtp->setFlag1($p_flag1); 
			$paramtp->setDescFlag1($p_descFlag1); 			
			$paramtp->setFlag2($p_flag2); 
			$paramtp->setDescFlag2($p_descFlag2); 		
			$paramtp->setFlag3($p_flag3); 
			$paramtp->setDescFlag3($p_descFlag3); 	 
			$paramtp->setNum1($p_num1); 
			$paramtp->setDescNum1($p_descNum1); 	
			$paramtp->setNum2($p_num2); 
			$paramtp->setDescNum2($p_descNum2); 	
			$paramtp->setNum3($p_num3); 
			$paramtp->setDescNum3($p_descNum3); 	
			$paramtp->setData1($p_data1); 
			$paramtp->setDescData1($p_descData1); 
			$paramtp->setData2($p_data2); 
			$paramtp->setDescData2($p_descData2); 	
 			$paramtp->setData3($p_data3); 
			$paramtp->setDescData3($p_descData3); 	



			//  Vzalida ParamTp
 /*
			var_dump($paramtp->getIdTp()); 
			var_dump($paramtp->getStr1()); 
			var_dump($paramtp->getDescStr1()); 
			var_dump($paramtp->getStr2()); 
			var_dump($paramtp->getDescStr2()); 			
			var_dump($paramtp->getStr3()); 
			var_dump($paramtp->getDescStr3()); 			
			var_dump($paramtp->getFlag1()); 
			var_dump($paramtp->getDescFlag1()); 			
			var_dump($paramtp->getFlag2()); 
			var_dump($paramtp->getDescFlag2()); 		
			var_dump($paramtp->getFlag3()); 
			var_dump($paramtp->getDescFlag3()); 
			var_dump($paramtp->getDescTabPad()); 

 */


			$paramtpDao = new paramtpDao();    
			$r = $paramtpDao->create($paramtp); 
			return  $r;  
		 }
 


		public function listaParamTb(){  
			$paramtpDao = new paramtpDao();  
			return $paramtpDao->read();  
		 } 


		public function listaParamTbF($p_tabpad){ 
 
			$paramtp = new ParamTp(); 
			$paramtp->setDescTabPad($p_tabpad);   

			$paramtpDao = new paramtpDao(); 
			return $paramtpDao->readF($paramtp); 

		 } 


	}	 

?>
