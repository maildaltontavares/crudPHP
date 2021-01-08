<?php
#

require_once 'webservice_ini.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE'); 

if( $_SERVER['REQUEST_METHOD'] === "GET" ):

	$usuario = new UsuarioCtr();	 
 
	if (isset($_GET['id'])): 
	     $aUsu = $usuario->buscaUsuario($_GET['id']); 
	      __output_users2__($aUsu);
	else:
	     $aUsu = $usuario->listaUsuario(0);   
	     __output_users__($aUsu);
	endif;   


elseif ( $_SERVER['REQUEST_METHOD'] === "POST" ): 

	$postdata = file_get_contents("php://input");  
	if(isset($postdata)   && !empty($postdata)):
	
	  // Extract the data.     
		$request = json_decode($postdata,true); 
	    $usr = $request;
	    
	    $usuario = new UsuarioCtr();
	    //create($nome,md5($senha),                                        $email,$tel,$aIt,  $chave,$vFilUsu,$filPad)=
		$usuario->create($usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",[5],"9999",[1],1); 
		 
		__output_users3__($request);


	  // Validate.
	  //if( $request->data->nome == '')
	  //{
	    //return http_response_code(400); 
	  //}
		
	endif;
 
elseif ( $_SERVER['REQUEST_METHOD'] === "DELETE" ): 

	$usuario = new UsuarioCtr();	 
 
	if (isset($_GET['id'])): 
		 $usuario->delete($_GET['id']); 	     
	     __output_header__( true, 'Registro Deletado.', null);
	    
    endif;

else:
	    __output_header__( false, 'Usuário GET não encontrado.', null);

endif;  
  
?>