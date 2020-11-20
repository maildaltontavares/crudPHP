<?php 


class Conexao
{
	private static $instance;

	public static function getConn(){

		if(!isset(self::$instance)):
 
			try {  //Local
				   //self::$instance = new  \PDO("pgsql:host=127.0.0.1;port=5432;dbname=Main;user=postgres;password=admin");	
				
					//Nuvem
					self::$instance = new  \PDO("pgsql:host=ec2-3-211-48-92.compute-1.amazonaws.com
		;port=5432;dbname=d52bo506a9mii;user=pfsutquhhyymuc;password=ce5946f1f936ef51bf124faffcb3d65aafb886b4dcf321e15e7407a690e8069c");	  

			 	}
					 catch (Exception $e) 
					 {
					  die("Erro de Conexão: " . $e->getMessage());
					 }         
				  

      			//self::$instance = new  \PDO('mysql:host=localhost;dbname=seguranca;charset=utf8','root','');
 		endif;
 		return self::$instance;



	}

}



 





 ?>