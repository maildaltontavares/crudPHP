<?php

	require_once('Conexao.php');
	require_once('leitura.php');

	class LeituraDao{



		public function delete(Leitura $t)
		{
  
		 
			$sql = 'delete from public."E0100_LEITURA" where D0100_ID_LEITURA = ? ';  
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

		public function buscaLeitura(Leitura $t)
		{ 

 
			$sql = 'SELECT D0100_ID_LEITURA id, d0006_id_filial filial,d0100_tear tear,d0100_dt_leitura dt_leitura,d0100_turno turno,d0100_leitura leitura,d0100_rpm rpm,d0100_par_trama par_trama,d0100_par_urdume par_urdume,d0100_par_outros par_outros,d0100_dt_inclusao dt_inclusao,d0100_dt_alteracao dt_alteracao,d0100_id_usr_inclusao usr_inclusao,d0100_id_usr_alteracao usr_alteracao FROM public."E0100_LEITURA" where D0100_ID_LEITURA = ?  ';
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
 

		public function update(Leitura $t)
		{
		 
			$sql = 'update public."E0100_LEITURA" set  d0006_id_filial=?,d0100_tear=?,d0100_dt_leitura=?,d0100_turno=?,d0100_leitura=?,d0100_rpm=?,d0100_par_trama=?,d0100_par_urdume=?,d0100_par_outros=?,d0100_dt_alteracao=?,d0100_id_usr_alteracao=? where D0100_ID_LEITURA = ?      ';
			//$sql = 'Insert into usuario (nome,senha,email,tel) values(?,?,?,?)';

			$stmt = Conexao::getConn()->prepare($sql);  
		     $stmt->bindValue(1,$t->getFilial()); 
		     $stmt->bindValue(2,$t->getTear()); 
		     $stmt->bindValue(3,$t->getDtLeitura()); 
		     $stmt->bindValue(4,$t->getTurno()); 
		     $stmt->bindValue(5,$t->getLeitura()); 
		     $stmt->bindValue(6,$t->getRpm()); 
		     $stmt->bindValue(7,$t->getParTrama()); 
		     $stmt->bindValue(8,$t->getParUrdume()); 
		     $stmt->bindValue(9,$t->getParOutros()); 
		     $stmt->bindValue(10,$t->getDtAlteracao()); 
		     $stmt->bindValue(11,$t->getUsrAlteracao());   
		 	 $stmt->bindValue(12,$t->getId()); 
	 

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

		public function create(Leitura $t)
		{  
			$sql = 'Insert into public."E0100_LEITURA" (  d0006_id_filial, d0100_tear,  d0100_dt_leitura,  d0100_turno,  d0100_leitura,  d0100_rpm ,  d0100_par_trama,  d0100_par_urdume,  d0100_par_outros,  d0100_dt_inclusao,    d0100_id_usr_inclusao ) values (?,?,?,?,?,?,?,?,?,?,?)';  
			$stmt = Conexao::getConn()->prepare($sql); 
		 
			 $stmt->bindValue(1,$t->getFilial()); 
		     $stmt->bindValue(2,$t->getTear()); 
		     $stmt->bindValue(3,$t->getDtLeitura()); 
		     $stmt->bindValue(4,$t->getTurno()); 
		     $stmt->bindValue(5,$t->getLeitura()); 
		     $stmt->bindValue(6,$t->getRpm()); 
		     $stmt->bindValue(7,$t->getParTrama()); 
		     $stmt->bindValue(8,$t->getParUrdume()); 
		     $stmt->bindValue(9,$t->getParOutros()); 
		     $stmt->bindValue(10,$t->getDtInclusao()); 
		     $stmt->bindValue(11,$t->getUsrInclusao());  
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

		public function lerTodas(Leitura $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT D0100_ID_LEITURA id, d0006_id_filial filial,d0100_tear tear,d0100_dt_leitura dt_leitura,d0100_turno turno,d0100_leitura leitura,d0100_rpm rpm,d0100_par_trama par_trama,d0100_par_urdume par_urdume,d0100_par_outros par_outros,d0100_dt_inclusao dt_inclusao,d0100_dt_alteracao dt_alteracao,d0100_id_usr_inclusao usr_inclusao,d0100_id_usr_alteracao usr_alteracao   FROM public."E0100_LEITURA   where d0006_id_filial = ? " order by d0100_dt_leitura' ;
			$stmt = Conexao::getConn()->prepare($sql); 
			$stmt->bindValue(1,$t->getFilial()); 
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		 

		public function read(Leitura $t,$numPg)
		{
 		 
			//$sql = 'Select * from usuario';
			$sql = 'SELECT D0100_ID_LEITURA id, d0006_id_filial filial,d0100_tear tear,d0100_dt_leitura dt_leitura,d0100_turno turno,d0100_leitura leitura,d0100_rpm rpm,d0100_par_trama par_trama,d0100_par_urdume par_urdume,d0100_par_outros par_outros,d0100_dt_inclusao dt_inclusao,d0100_dt_alteracao dt_alteracao,d0100_id_usr_inclusao usr_inclusao,d0100_id_usr_alteracao usr_alteracao   FROM public."E0100_LEITURA"  where d0006_id_filial = ?   order by d0100_dt_leitura LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg  ;
			$stmt = Conexao::getConn()->prepare($sql); 

 

			$stmt->bindValue(1,$t->getFilial()); 
			$stmt->execute();  
			if($stmt->rowCount() > 0):
				$resultado=$stmt->fetchAll(\PDO::FETCH_ASSOC); 
				return $resultado;	
			else:
				return [];				
			endif;

		 
		}

		public function readF(Leitura $t,$numPg)
		{
 		 
 

			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT D0100_ID_LEITURA id, d0006_id_filial filial,d0100_tear tear,d0100_dt_leitura dt_leitura,d0100_turno turno,d0100_leitura leitura,d0100_rpm rpm,d0100_par_trama par_trama,d0100_par_urdume par_urdume,d0100_par_outros par_outros,d0100_dt_inclusao dt_inclusao,d0100_dt_alteracao dt_alteracao,d0100_id_usr_inclusao usr_inclusao,d0100_id_usr_alteracao usr_alteracao   FROM public."E0100_LEITURA"';

			if (!empty($t->getTear())   and  $t->getTear() != '' ):
				$sql  = $sql . ' where d0006_id_filial = ? ';
			endif;

			if (!empty($t->getTear())   and  $t->getTear() != '' ):
				$sql =  $sql .  ' and d0100_tear  like ? ';
				$prim_filtro = True;
			endif;  

            $sql  = $sql . ' order by d0100_dt_leitura  LIMIT ' . QTDE_REGISTROS . ' OFFSET ' . $numPg;

			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 2;


            $stmt->bindValue(1,$t->getFilial()); 

			if (!empty($t->getTear())   and  $t->getTear() != '' ):
				$stmt->bindValue($bind,strtoupper($t->getTear()));
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




		public function totRegistros(Leitura $t)
		{
 		 
			//$sql = 'Select * from usuario';
			$prim_filtro = false;

			$sql = 'SELECT count(*) totReg  FROM public."E0100_LEITURA"'; 
			$sql  = $sql . ' where  d0006_id_filial = ? ';
		 

			if(!empty($t->getTear()) and  $t->getTear() != '' ):
				$sql =  $sql .  '  and d0100_tear  like ? ';
				$prim_filtro = True;
			endif;  
 
   
			$stmt = Conexao::getConn()->prepare($sql);

	 
			$bind = 2;

            $stmt->bindValue(1,$t->getFilial()); 

			if(!empty($t->getTear())  and  $t->getTear() != '' ):
				$stmt->bindValue($bind,strtoupper($t->getTear()));
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
