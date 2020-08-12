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



		public function read(Tabela $t)
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
			$sql = $sql . '  order by d0004_string1 ';

			//var_dump($sql);

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

		public function readF(Tabela $t)
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
				$sql =  $sql .  '  d0004_string1 like ? ';
				$prim_filtro = True;
			endif; 

            $sql = $sql . '  order by d0004_string1 ';
			
			$stmt = Conexao::getConn()->prepare($sql);

			//var_dump($sql);
			$bind = 1;
            $stmt->bindValue($bind,$t->getSigla());
			$bind++; 

			if(!empty($t->getStr1())):
				$stmt->bindValue($bind,$t->getStr1());
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
