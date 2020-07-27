<?php 


class Conexao
{
	private static $instance;

	public static function getConn(){

		if(!isset(self::$instance)):
			//self::$instance = new  \PDO("pgsql:host=127.0.0.1;port=5432;dbname=Main;user=postgres;password=admin");		ok	
			self::$instance = new  \PDO("pgsql:host=127.0.0.1;port=5432;dbname=Main;user=postgres;password=admin");			
			//self::$instance = new  \PDO('mysql:host=localhost;dbname=seguranca;charset=utf8','root','');
 		endif;
 		return self::$instance;



	}

}









 ?>