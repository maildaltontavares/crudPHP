<?php
#

require_once 'webservice_ini.php'; 
require_once '../config.php';  
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE'); 

if ( $_SERVER['REQUEST_METHOD'] === "POST" ): 

	$postdata = file_get_contents("php://input");  
	if(isset($postdata)   && !empty($postdata)):
	
	  // Extract the data.     
		$request = json_decode($postdata,true); 
	    $usr = $request;
	     
	    var_dump($usr);  
	    //$usuario = new UsuarioCtr(); 

        //$usuario->create( $usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",$usr['d']["grupos"] ,$chave ,$filial,$usr['d']["filpad"]);  

		__output_users3__($request); 
		
	endif;  

else:
	    __output_header__( false, 'Usuário GET não encontrado.', null);

endif;  
  
?>