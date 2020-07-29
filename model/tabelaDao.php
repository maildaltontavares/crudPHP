<?php

	require_once('Conexao.php');
	require_once('tabela.php');

	class TabelaDao{ 

		public function delete(Tabela $t)
		{
  
		 
			$sql = 'delete from public."E0004_tabela" where d0004_id = ? ';  
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
			$stmt->execute();  

			return 'OK';
		 
		}

		public function buscaTabela(Tabela $t)
		{
  
 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_str1 str1,';
			$sql = $sql . ' d0004_str2  str2,';
			$sql = $sql . ' d0004_str3  str3,';
			$sql = $sql . ' d0004_flag1  flag1,';
			$sql = $sql . ' d0004_flag2 flag2,';			
			$sql = $sql . ' d0004_flag3 flag3,';
			$sql = $sql . ' d0004_num1 num1,';
			$sql = $sql . ' d0004_num2 num2,';
			$sql = $sql . ' d0004_num3 num3,';
		    $sql = $sql . ' d0004_data1 data1,';	
			$sql = $sql . ' d0004_data2 data2,';
			$sql = $sql . ' d0004_data3 data3,';
			$sql = $sql . ' d0004_id id  '  ;
			$sql = $sql . ' FROM public."E0004_tabela" ctp';
			$sql = $sql . ' where d0004_id = ?';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId());

			//var_dump($sql);

			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 

				return $resultado;	
			else:
				return [];				
			endif;

		 
		}
 


		public function update(Tabela $t)
		{ 
		 
			$sql = 'update public."E0004_tabela" set d0001_id=?, ';
			$sql = $sql . ' d0004_str1 = ?, ';
			$sql = $sql . ' d0004_str2 = ?, ';
			$sql = $sql . ' d0004_str3 = ?, ';	
			$sql = $sql . ' d0004_flag1 = ?, ';
			$sql = $sql . ' d0004_flag2 = ?, ';
			$sql = $sql . ' d0004_flag3 = ?, ';
			$sql = $sql . ' d0004_num1 = ?,';
 			$sql = $sql . ' d0004_num2 = ?,';
			$sql = $sql . ' d0004_num3 = ?,';
			$sql = $sql . ' d0004_data1 = ?,';
			$sql = $sql . ' d0004_data2 = ?,';
			$sql = $sql . ' d0004_data3 = ?';
			$sql = $sql . ' where d0004_id = ? '; 


			$stmt = Conexao::getConn()->prepare($sql); 

			$stmt->bindValue(1,$t->getIdTp()); 
			$stmt->bindValue(2,$t->getStr1()); 
			$stmt->bindValue(3,$t->getStr2()); 
			$stmt->bindValue(4,$t->getStr3()); 
			$stmt->bindValue(5,$t->getFlag1()); 
			$stmt->bindValue(6,$t->getFlag2()); 
			$stmt->bindValue(7,$t->getFlag3()); 
			$stmt->bindValue(8,$t->getNum1()); 
			$stmt->bindValue(9,$t->getNum2()); 
			$stmt->bindValue(10,$t->getNum3()); 
			$stmt->bindValue(11,$t->getData1()); 
			$stmt->bindValue(12,$t->getData2()); 
			$stmt->bindValue(13,$t->getData3());  
 
			$stmt->bindValue(14,$t->getId()); 

            //var_dump($t);

			$stmt->execute();  
			return 'OK';
		 
		}


		public function create(Tabela $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."E0004_tabela" (';
			$sql = $sql . ' d0001_id , ';
			$sql = $sql . ' d0004_str1,  ';			
			$sql = $sql . ' d0004_str2 , ';
			$sql = $sql . ' d0004_str3 , ';
			$sql = $sql . ' d0004_flag1 , ';
			$sql = $sql . ' d0004_flag2 , ';
			$sql = $sql . ' d0004_flag3 , ';
			$sql = $sql . ' d0004_num1,';
			$sql = $sql . ' d0004_num2,';
			$sql = $sql . ' d0004_num3,';
			$sql = $sql . ' d0004_data1,';
			$sql = $sql . ' d0004_data2,';
     		$sql = $sql . ' d0004_data3';
			$sql = $sql . ' )' ; 
			$sql = $sql . '    values (?,?,?,?,?,?,?,?,?,?,?,?,?)';  



    		//var_dump($sql);

			$stmt = Conexao::getConn()->prepare($sql); 
		 
			$stmt->bindValue(1,$t->getIdTp()); 
			$stmt->bindValue(2,$t->getStr1()); 
			$stmt->bindValue(3,$t->getStr2()); 			
			$stmt->bindValue(4,$t->getStr3()); 			
			$stmt->bindValue(5,$t->getFlag1()); 
			$stmt->bindValue(6,$t->getFlag2()); 
			$stmt->bindValue(7,$t->getFlag3()); 
			$stmt->bindValue(8,$t->getNum1()); 
			$stmt->bindValue(9,$t->getNum2()); 
			$stmt->bindValue(10,$t->getNum3()); 
			$stmt->bindValue(11,$t->getData1()); 
			$stmt->bindValue(12,$t->getData2()); 
			$stmt->bindValue(13,$t->getData3()); 


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


		public function read()
		{ 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_str1 str1,';
			$sql = $sql . ' d0004_str2  str2,';
			$sql = $sql . ' d0004_str3  str3,';
			$sql = $sql . ' d0004_flag1  flag1,';
			$sql = $sql . ' d0004_flag2 flag2,';			
			$sql = $sql . ' d0004_flag3 flag3,';
			$sql = $sql . ' d0004_num1 num1,';
			$sql = $sql . ' d0004_num2 num2,';
			$sql = $sql . ' d0004_num3 num3,';
		    $sql = $sql . ' d0004_data1 data1,';	
			$sql = $sql . ' d0004_data2 data2,';
			$sql = $sql . ' d0004_data3 data3,';
			$sql = $sql . ' d0001_descricao nome_grupo '  ;
			$sql = $sql . ' FROM public."E0004_tabela" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id '; 
			$sql = $sql . '  order by d0001_descricao ';

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

		public function readF(Tabela $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_str1 str1,';
			$sql = $sql . ' d0004_str2  str2,';
			$sql = $sql . ' d0004_str3  str3,';
			$sql = $sql . ' d0004_flag1  flag1,';
			$sql = $sql . ' d0004_flag2 flag2,';			
			$sql = $sql . ' d0004_flag3 flag3,';
			$sql = $sql . ' d0004_num1 num1,';
			$sql = $sql . ' d0004_num2 num2,';
			$sql = $sql . ' d0004_num3 num3,';
		    $sql = $sql . ' d0004_data1 data1,';	
			$sql = $sql . ' d0004_data2 data2,';
			$sql = $sql . ' d0004_data3 data3,';
			$sql = $sql . ' d0001_descricao nome_grupo '  ;
			$sql = $sql . ' FROM public."E0004_tabela" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id '; 
 
			

			if (!empty($t->getDescTabPad())):
				$sql  = $sql . ' and ';
			endif;

			if(!empty($t->getDescTabPad())):
				$sql =  $sql .  '  d0001_descricao like ? ';
				$prim_filtro = True;
			endif; 

            $sql = $sql . '  order by d0001_descricao ';
			
			$stmt = Conexao::getConn()->prepare($sql);

			$prim_filtro = false;
			$bind = 1;

			if(!empty($t->getDescTabPad())):
				$stmt->bindValue(1,$t->getDescTabPad());;
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





	}




?>
