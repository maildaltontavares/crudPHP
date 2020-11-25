<?php

	require_once('Conexao.php');
	require_once('tabela.php');

	class TabelaDao{ 

		public function delete(Tabela $t)
		{ 
			$sql = 'delete from public."E0004_tabela" where d0004_id = ? '; 

			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getId()); 
			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			} 
		 
		}

		public function buscaTabelaSigla(Tabela $t)
		{
  
 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
   			$sql = $sql . ' ctp.d0004_string1 descricao, ';
			$sql = $sql . ' d0004_string1 str1,';
			$sql = $sql . ' d0004_string2  str2,';
			$sql = $sql . ' d0004_string3  str3,';
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
			$sql = $sql . ' inner join public."E0001_tabela_padrao" tp';
            $sql = $sql . ' on ctp.d0001_id  = tp.d0001_id  ';
			$sql = $sql . ' where tp.d0001_sigla = ? order by d0004_string1';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getSigla());  
			try{ 
				$stmt->execute(); 

				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
					return $resultado;	
				else:
					return [];				
				endif;
			}
			  catch (\PDOException $e) {  
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			        return [];	;
			}	
			


		 
		}



		public function buscaTabelaSiglaF(Tabela $t,$p_desc)
		{
  
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
   			$sql = $sql . ' ctp.d0004_string1 descricao, ';
			$sql = $sql . ' d0004_string1 str1,';
			$sql = $sql . ' d0004_string2  str2,';
			$sql = $sql . ' d0004_string3  str3,';
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
			$sql = $sql . ' inner join public."E0001_tabela_padrao" tp';
            $sql = $sql . ' on ctp.d0001_id  = tp.d0001_id  ';
			$sql = $sql . ' where tp.d0001_sigla = ? ';

            if (!empty($p_desc)):
			    $sql = $sql . ' and upper(ctp.d0004_string1) like ? ';
		    endif;
			

			$sql = $sql . '  order by d0004_string1';
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getSigla());  

            if  (!empty($p_desc)):
			     $stmt->bindValue(2,strtoupper($p_desc));  
		    endif;	 

			try{ 
				$stmt->execute(); 

				if($stmt->rowCount() > 0):
					$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
					return $resultado;	
				else:
					return [];				
				endif;
			}
			  catch (\PDOException $e) {  
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			        return [];	;
			}	
			


		 
		}

		public function buscaParametro(Tabela $t)
		{
   
			$sql = 'select  d0004_string2 pT,d0004_num1 pN,d0004_data1 pD  from public."E0001_tabela_padrao" tp ';
   			$sql = $sql . ' inner join public."E0004_tabela" t on tp.d0001_id = t.d0001_id ';
			$sql = $sql . ' WHERE tp.D0001_SIGLA = ? ';
			$sql = $sql . ' and d0004_num3 = ?';
			 
			$stmt = Conexao::getConn()->prepare($sql);  
			//var_dump($sql);

			if($t->getTpParam()=='T'){
                  $stmt->bindValue(1,'sysparamT');
			}
			elseif($t->getTpParam()=='N') {
				  $stmt->bindValue(1,'sysparamN');
			}
			elseif($t->getTpParam()=='D') {
			 	  $stmt->bindValue(1,'sysparamD');
			};			

			if($t->getTpParam()=='T'){
                  $stmt->bindValue(2,$t->getParamT());
			}
			elseif($t->getTpParam()=='N') {
				  $stmt->bindValue(2,$t->getParamN());
			}
			elseif($t->getTpParam()=='D') {
			 	  $stmt->bindValue(2,$t->getParamD());
			};


			$stmt->execute();  
			
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC);   
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}



		public function buscaTabela(Tabela $t)
		{
  
 
			$sql = 'SELECT ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_string1 str1,';
			$sql = $sql . ' d0004_string2  str2,';
			$sql = $sql . ' d0004_string3  str3,';
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
			$sql = $sql . ' d0004_string1 = ?, ';
			$sql = $sql . ' d0004_string2 = ?, ';
			$sql = $sql . ' d0004_string3 = ?, ';	
			$sql = $sql . ' d0004_flag1 = ?, ';
			$sql = $sql . ' d0004_flag2 = ?, ';
			$sql = $sql . ' d0004_flag3 = ?,  ';		
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
			if($t->getData1()!=''):
			   	$stmt->bindValue(11,$t->getData1()); 
			else:
				$stmt->bindValue(11,null); 
			endif;		
			if($t->getData2()!=''):
			   	$stmt->bindValue(12,$t->getData2()); 
			else:
				$stmt->bindValue(12,null); 
			endif;			
 
			if($t->getData3()!=''):
			   	$stmt->bindValue(13,$t->getData3()); 
			else:
				$stmt->bindValue(13,null); 
			endif;	
			$stmt->bindValue(14,$t->getId()); 

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			}	
		 
		}


		public function create(Tabela $t)
		{
  	
  			//var_dump($t);
		                       
			$sql = 'Insert into public."E0004_tabela" (';
			$sql = $sql . ' d0001_id , ';
			$sql = $sql . ' d0004_string1,  ';			
			$sql = $sql . ' d0004_string2 , ';
			$sql = $sql . ' d0004_string3 , ';
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

			if($t->getData1()!=''):
			   	$stmt->bindValue(11,$t->getData1()); 
			else:
				$stmt->bindValue(11,null); 
			endif;		
			if($t->getData2()!=''):
			   	$stmt->bindValue(12,$t->getData2()); 
			else:
				$stmt->bindValue(12,null); 
			endif;			
 
			if($t->getData3()!=''):
			   	$stmt->bindValue(13,$t->getData3()); 
			else:
				$stmt->bindValue(13,null); 
			endif;	

			Conexao::getConn()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try{
				Conexao::getConn()->beginTransaction();
				$stmt->execute();
				Conexao::getConn()->commit(); 
				return 'OK';
			}
			  catch (\PDOException $e) {
			    Conexao::getConn()->rollBack(); 
			    //throw $e;
			    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro na gravação: " . $e->getMessage() . '</li></div>'; 
			    return 'nOK';
			}	
		 
		}


		public function read(Tabela $t,$numPg)
		{ 
			$sql = 'SELECT ';
            $sql = $sql . ' ctp.d0004_id id, ';
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_string1 str1,';
			$sql = $sql . ' d0004_string2  str2,';
			$sql = $sql . ' d0004_string3  str3,';
			$sql = $sql . ' d0004_flag1  flag1,';
			$sql = $sql . ' d0004_flag2 flag2,';			
			$sql = $sql . ' d0004_flag3 flag3,';
			$sql = $sql . ' d0004_num1 num1,';
			$sql = $sql . ' d0004_num2 num2,';
			$sql = $sql . ' d0004_num3 num3,';
		    $sql = $sql . ' d0004_data1 data1,';	
			$sql = $sql . ' d0004_data2 data2,';
			$sql = $sql . ' d0004_data3 data3,';
			$sql = $sql . ' tp.d0001_sigla sigla,';			
			$sql = $sql . ' d0001_descricao nome_grupo '  ;
			$sql = $sql . ' FROM public."E0004_tabela" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id and tp.d0001_sigla = ? '; 
			$sql = $sql . '  order by d0004_string1  LIMIT ' .QTDE_REGISTROS . ' OFFSET ' . $numPg  ;

			//var_dump($t->getSigla());

			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getSigla());
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(Tabela $t,$numPg)
		{
 		 


			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT ';
            $sql = $sql . ' ctp.d0004_id id, ';			
   			$sql = $sql . ' ctp.d0001_id id_tp, ';
			$sql = $sql . ' d0004_string1 str1,';
			$sql = $sql . ' d0004_string2  str2,';
			$sql = $sql . ' d0004_string3  str3,';
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
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id and tp.d0001_sigla = ? ';  
			
			$prim_filtro = false;
			if (!empty($t->getStr1())):
				$sql  = $sql . ' and ';
			endif;

			if(!empty($t->getStr1())):
				$sql =  $sql .  '   upper(d0004_string1) like ? ';
				$prim_filtro = True;
			endif; 

            $sql = $sql . '  order by d0004_string1   LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;
			
			$stmt = Conexao::getConn()->prepare($sql);

			//var_dump($sql);
			$bind = 1;
            $stmt->bindValue($bind,$t->getSigla());
			$bind++; 

			if(!empty($t->getStr1())):
				$stmt->bindValue($bind,strtoupper($t->getStr1()));
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


		public function totRegistros(Tabela $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."E0004_tabela" ctp, public."E0001_tabela_padrao" tp ';
			$sql = $sql . ' where tp.d0001_id = ctp.d0001_id and tp.d0001_sigla = ? ';  

			$prim_filtro = false;
			if (!empty($t->getStr1())  and  $t->getStr1() != '' ):
				$sql  = $sql . ' and ';
			endif;

			if(!empty($t->getStr1()) and  $t->getStr1() != '' ):
				$sql =  $sql .  ' upper(d0004_string1) like ? ';
				$prim_filtro = True;
			endif;  
 
   
			$stmt = Conexao::getConn()->prepare($sql);

			$bind = 1;
            $stmt->bindValue($bind,$t->getSigla());
			$bind++; 

			if(!empty($t->getStr1())  and  $t->getStr1() != '' ):
				$stmt->bindValue($bind,strtoupper($t->getStr1()));
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
