<?php

	require_once('Conexao.php');
	require_once('paramtp.php');

	class ParamTpDao{



		public function delete(ParamTp $t)
		{
  
		 
			$sql = 'delete from public."E0003_config_tp" where d0003_id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
			$stmt->execute();  

			return 'OK';
		 
		}


		public function buscaParamTbPd(ParamTp $t)
		{
  
 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0003_str1 str1,';
			$sql = $sql . ' d0003_desc_str1 desc_str1 ,';
			$sql = $sql . ' d0003_str2  str2,';
			$sql = $sql . ' d0003_desc_str2  desc_str2,';
			$sql = $sql . ' d0003_str3  str3,';
			$sql = $sql . ' d0003_desc_str3  desc_str3,'			;
			$sql = $sql . ' d0003_flag1  flag1,';
			$sql = $sql . ' d0003_desc_flag1 desc_flag1 ,';
			$sql = $sql . ' d0003_flag2 flag2,';
			$sql = $sql . ' d0003_desc_flag2  desc_flag2,';
			
			$sql = $sql . ' d0003_flag3 flag3,';
			$sql = $sql . ' d0003_desc_flag3 desc_flag3,';

			$sql = $sql . ' d0003_num1 num1,';
			$sql = $sql . ' d0003_desc_num1 desc_num1,';

			$sql = $sql . ' d0003_num2 num2,';
			$sql = $sql . ' d0003_desc_num2 desc_num2,';

			$sql = $sql . ' d0003_num3 num3,';
			$sql = $sql . ' d0003_desc_num3 desc_num3,';

			$sql = $sql . ' d0003_data1 data1,';
			$sql = $sql . ' d0003_desc_data1 desc_data1,';
			
			$sql = $sql . ' d0003_data2 data2,';
			$sql = $sql . ' d0003_desc_data2 desc_data2,';

			$sql = $sql . ' d0003_data3 data3,';
			$sql = $sql . ' d0003_desc_data3 desc_data3,';


			$sql = $sql . ' d0003_id id  '  ;
			$sql = $sql . ' FROM public."E0003_config_tp" ctp';
			$sql = $sql . ' where d0001_id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getIdTp());

			//var_dump($sql);

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}


		public function buscaParamTb(ParamTp $t)
		{
  
 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0003_str1 str1,';
			$sql = $sql . ' d0003_desc_str1 desc_str1 ,';
			$sql = $sql . ' d0003_str2  str2,';
			$sql = $sql . ' d0003_desc_str2  desc_str2,';
			$sql = $sql . ' d0003_str3  str3,';
			$sql = $sql . ' d0003_desc_str3  desc_str3,'			;
			$sql = $sql . ' d0003_flag1  flag1,';
			$sql = $sql . ' d0003_desc_flag1 desc_flag1 ,';
			$sql = $sql . ' d0003_flag2 flag2,';
			$sql = $sql . ' d0003_desc_flag2  desc_flag2,';
			
			$sql = $sql . ' d0003_flag3 flag3,';
			$sql = $sql . ' d0003_desc_flag3 desc_flag3,';

			$sql = $sql . ' d0003_num1 num1,';
			$sql = $sql . ' d0003_desc_num1 desc_num1,';

			$sql = $sql . ' d0003_num2 num2,';
			$sql = $sql . ' d0003_desc_num2 desc_num2,';

			$sql = $sql . ' d0003_num3 num3,';
			$sql = $sql . ' d0003_desc_num3 desc_num3,';

			$sql = $sql . ' d0003_data1 data1,';
			$sql = $sql . ' d0003_desc_data1 desc_data1,';
			
			$sql = $sql . ' d0003_data2 data2,';
			$sql = $sql . ' d0003_desc_data2 desc_data2,';

			$sql = $sql . ' d0003_data3 data3,';
			$sql = $sql . ' d0003_desc_data3 desc_data3,';


			$sql = $sql . ' d0003_id id  '  ;
			$sql = $sql . ' FROM public."E0003_config_tp" ctp';
			$sql = $sql . ' where d0003_id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId());
			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 


		public function update(ParamTp $t)
		{ 
		 
			$sql = 'update public."E0003_config_tp" set d0001_id=?, ';
			$sql = $sql . ' d0003_str1 = ?, ';
			$sql = $sql . ' d0003_desc_str1 = ?, ';
			$sql = $sql . ' d0003_str2 = ?, ';
			$sql = $sql . ' d0003_desc_str2 = ?, ';
			$sql = $sql . ' d0003_str3 = ?, ';
			$sql = $sql . ' d0003_desc_str3 = ?,  ';
			
			$sql = $sql . ' d0003_flag1 = ?, ';
			$sql = $sql . ' d0003_desc_flag1 = ?, ';
			$sql = $sql . ' d0003_flag2 = ?, ';
			$sql = $sql . ' d0003_desc_flag2 = ?, ';
			$sql = $sql . ' d0003_flag3 = ?, ';
			$sql = $sql . ' d0003_desc_flag3 = ?, ';

			$sql = $sql . ' d0003_num1 = ?,';
			$sql = $sql . ' d0003_desc_num1 = ?, ';
 			$sql = $sql . ' d0003_num2 = ?,';
			$sql = $sql . ' d0003_desc_num2 = ?,';

			$sql = $sql . ' d0003_num3 = ?,';
			$sql = $sql . ' d0003_desc_num3 = ?,';

			$sql = $sql . ' d0003_data1 = ?,';
			$sql = $sql . ' d0003_desc_data1 = ?,';
			
			$sql = $sql . ' d0003_data2 = ?,';
			$sql = $sql . ' d0003_desc_data2 = ?,';

			$sql = $sql . ' d0003_data3 = ?,';
			$sql = $sql . ' d0003_desc_data3 = ? '; 			
 
			$sql = $sql . ' where d0003_id = ? '; 

			//var_dump($t);





			$stmt = Conexao::getConn()->prepare($sql); 

			$stmt->bindValue(1,$t->getIdTp()); 
			$stmt->bindValue(2,$t->getStr1()); 
			$stmt->bindValue(3,$t->getDescStr1()); 
			$stmt->bindValue(4,$t->getStr2()); 
			$stmt->bindValue(5,$t->getDescStr2()); 			
			$stmt->bindValue(6,$t->getStr3()); 
			$stmt->bindValue(7,$t->getDescStr3()); 
			$stmt->bindValue(8,$t->getFlag1()); 
			$stmt->bindValue(9,$t->getDescFlag1()); 			
			$stmt->bindValue(10,$t->getFlag2()); 
			$stmt->bindValue(11,$t->getDescFlag2()); 		
			$stmt->bindValue(12,$t->getFlag3()); 
			$stmt->bindValue(13,$t->getDescFlag3()); 

			$stmt->bindValue(14,$t->getNum1()); 
    		$stmt->bindValue(15,$t->getDescNum1()); 

 
			$stmt->bindValue(16,$t->getNum2()); 
			$stmt->bindValue(17,$t->getDescNum2()); 



			$stmt->bindValue(18,$t->getNum3()); 
			$stmt->bindValue(19,$t->getDescNum3()); 

			$stmt->bindValue(20,$t->getData1()); 
			$stmt->bindValue(21,$t->getDescData1()); 
			$stmt->bindValue(22,$t->getData2()); 
			$stmt->bindValue(23,$t->getDescData2()); 			
			$stmt->bindValue(24,$t->getData3()); 
			$stmt->bindValue(25,$t->getDescData3()); 	

    		//var_dump($t->getData3());
    		//var_dump($t->getDescData3());

 
			$stmt->bindValue(26,$t->getId()); 

            //var_dump($t);

			$stmt->execute();  
			return 'OK';
		 
		}


		public function create(ParamTp $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."E0003_config_tp" (';
			$sql = $sql . ' d0001_id , ';
			$sql = $sql . ' d0003_str1,  ';			
			$sql = $sql . ' d0003_desc_str1, ';
			$sql = $sql . ' d0003_str2 , ';
			$sql = $sql . ' d0003_desc_str2 , ';
			$sql = $sql . ' d0003_str3 , ';
			$sql = $sql . ' d0003_desc_str3,  ';			
			$sql = $sql . ' d0003_flag1 , ';
			$sql = $sql . ' d0003_desc_flag1, '; 		
			$sql = $sql . ' d0003_flag2 , ';
			$sql = $sql . ' d0003_desc_flag2 , ';
			$sql = $sql . ' d0003_flag3 , ';
			$sql = $sql . ' d0003_desc_flag3,'; 


			$sql = $sql . ' d0003_num1,';
			$sql = $sql . ' d0003_desc_num1,';

			$sql = $sql . ' d0003_num2,';
			$sql = $sql . ' d0003_desc_num2,';

			$sql = $sql . ' d0003_num3,';
			$sql = $sql . ' d0003_desc_num3,';

			$sql = $sql . ' d0003_data1,';
			$sql = $sql . ' d0003_desc_data1,';
			
			$sql = $sql . ' d0003_data2,';
			$sql = $sql . ' d0003_desc_data2,';

			$sql = $sql . ' d0003_data3,';
			$sql = $sql . ' d0003_desc_data3'; 


			$sql = $sql . ' )' ; 
			$sql = $sql . '    values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';  



    		//var_dump($sql);

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getIdTp()); 
			$stmt->bindValue(2,$t->getStr1()); 
			$stmt->bindValue(3,$t->getDescStr1());  
			$stmt->bindValue(4,$t->getStr2()); 
			$stmt->bindValue(5,$t->getDescStr2()); 			
			$stmt->bindValue(6,$t->getStr3()); 
			$stmt->bindValue(7,$t->getDescStr3()); 	 
			$stmt->bindValue(8,$t->getFlag1()); 
			$stmt->bindValue(9,$t->getDescFlag1());  
			$stmt->bindValue(10,$t->getFlag2()); 
			$stmt->bindValue(11,$t->getDescFlag2()); 		
			$stmt->bindValue(12,$t->getFlag3()); 
			$stmt->bindValue(13,$t->getDescFlag3());  
			$stmt->bindValue(14,$t->getNum1()); 
			$stmt->bindValue(15,$t->getDescNum1());  
			$stmt->bindValue(16,$t->getNum2()); 
			$stmt->bindValue(17,$t->getDescNum2()); 
			$stmt->bindValue(18,$t->getNum3()); 
			$stmt->bindValue(19,$t->getDescNum3()); 

			$stmt->bindValue(20,$t->getData1()); 
			$stmt->bindValue(21,$t->getDescData1()); 
			$stmt->bindValue(22,$t->getData2()); 
			$stmt->bindValue(23,$t->getDescData2()); 			
			$stmt->bindValue(24,$t->getData3()); 
			$stmt->bindValue(25,$t->getDescData3()); 			

/*			$stmt->bindValue(14,$t->getDescTabPad()); 
  
				
			var_dump($t->getIdTp()); 
			var_dump($t->getStr1()); 
			var_dump($t->getDescStr1());  
 */			
	        //var_dump($stmt);

			try {
				$stmt->execute(); 
			} catch (Exception $e) {
			    return $e->getMessage();
			    //var_dump($e->getMessage());
			}

			//var_dump('OK');

			return 'OK';
		 
		}


		public function read($numPg)
		{ 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0003_str1 str1,';
			$sql = $sql . ' d0003_desc_str1 desc_str1 ,';
			$sql = $sql . ' d0003_str2  str2,';
			$sql = $sql . ' d0003_desc_str2  desc_str2,';
			$sql = $sql . ' d0003_str3  str3,';
			$sql = $sql . ' d0003_desc_str3  desc_str3,'			;
			$sql = $sql . ' d0003_flag1  flag1,';
			$sql = $sql . ' d0003_desc_flag1 desc_flag1 ,';
			$sql = $sql . ' d0003_flag2 flag2,';
			$sql = $sql . ' d0003_desc_flag2  desc_flag2,';
			$sql = $sql . ' d0003_flag3 flag3,';
			$sql = $sql . ' d0003_desc_flag3 desc_flag3,';
			$sql = $sql . ' d0003_id id ,'  ;

			$sql = $sql . ' d0003_num1 num1,';
			$sql = $sql . ' d0003_desc_num1 desc_num1,';

			$sql = $sql . ' d0003_num2 num2,';
			$sql = $sql . ' d0003_desc_num2 desc_num2,';

			$sql = $sql . ' d0003_num3 num3,';
			$sql = $sql . ' d0003_desc_num3 desc_num3,';

			$sql = $sql . ' d0003_data1 data1,';
			$sql = $sql . ' d0003_desc_data1 desc_data1,';
			
			$sql = $sql . ' d0003_data2 data2,';
			$sql = $sql . ' d0003_desc_data2 desc_data2,';

			$sql = $sql . ' d0003_data3 data3,';
			$sql = $sql . ' d0003_desc_data3 desc_data3,'; 

			$sql = $sql . ' d0001_descricao nome_grupo '  ;
			$sql = $sql . ' FROM public."E0003_config_tp" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id '; 
			$sql = $sql . '  order by d0001_descricao  LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;

			//var_dump($sql);

			$stmt = Conexao::getConn()->prepare($sql); 
			
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(ParamTp $t,$numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0003_str1 str1,';
			$sql = $sql . ' d0003_desc_str1 desc_str1 ,';
			$sql = $sql . ' d0003_str2  str2,';
			$sql = $sql . ' d0003_desc_str2  desc_str2,';
			$sql = $sql . ' d0003_str3  str3,';
			$sql = $sql . ' d0003_desc_str3  desc_str3,'		;	
			$sql = $sql . ' d0003_flag1  flag1,';
			$sql = $sql . ' d0003_desc_flag1 desc_flag1 ,';
			$sql = $sql . ' d0003_flag2 flag2,';
			$sql = $sql . ' d0003_desc_flag2  desc_flag2,';
			$sql = $sql . ' d0003_flag3 flag3,';
			$sql = $sql . ' d0003_desc_flag3 desc_flag3,';

			$sql = $sql . ' d0003_num1 num1,';
			$sql = $sql . ' d0003_desc_num1 desc_num1,';

			$sql = $sql . ' d0003_num2 num2,';
			$sql = $sql . ' d0003_desc_num2 desc_num2,';

			$sql = $sql . ' d0003_num3 num3,';
			$sql = $sql . ' d0003_desc_num3 desc_num3,';

			$sql = $sql . ' d0003_data1 data1,';
			$sql = $sql . ' d0003_desc_data1 desc_data1,';
			
			$sql = $sql . ' d0003_data2 data2,';
			$sql = $sql . ' d0003_desc_data2 desc_data2,';

			$sql = $sql . ' d0003_data3 data3,';
			$sql = $sql . ' d0003_desc_data3 desc_data3,';


			$sql = $sql . ' d0003_id id ,'  ;
			$sql = $sql . ' d0001_descricao nome_grupo '  ;
			$sql = $sql . ' FROM public."E0003_config_tp" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id ';
			

			if (!empty($t->getDescTabPad())):
				$sql  = $sql . ' and ';
			endif;

			if(!empty($t->getDescTabPad())):
				$sql =  $sql .  '   upper(d0001_descricao) like ? ';
				$prim_filtro = True;
			endif; 

            $sql = $sql . '  order by d0001_descricao   LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;
			
			$stmt = Conexao::getConn()->prepare($sql);

			$prim_filtro = false;
			$bind = 1;

			if(!empty($t->getDescTabPad())):
				$stmt->bindValue(1,strtoupper($t->getDescTabPad()));
				$prim_filtro = True;
				$bind++;
			endif; 
			//var_dump($t->getDescTabPad());
			//var_dump($stmt);
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}		

		public function totRegistros(ParamTp $t )
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg ';
			$sql = $sql . ' FROM public."E0003_config_tp" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id ';
			

			if(!empty($t->getDescTabPad())  and  $t->getDescTabPad() != '' ):
				$sql  = $sql . ' and ';
			endif;

			if(!empty($t->getDescTabPad())  and  $t->getDescTabPad() != '' ):
				$sql =  $sql .  '   upper(d0001_descricao) like ? ';
				$prim_filtro = True;
			endif;  
			
			$stmt = Conexao::getConn()->prepare($sql);

			$prim_filtro = false;
			$bind = 1;

			if(!empty($t->getDescTabPad())  and  $t->getDescTabPad() != '' ):
				$stmt->bindValue(1,strtoupper($t->getDescTabPad()));
				$prim_filtro = True;
				$bind++;
			endif; 
 
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}	



	}




?>
