<?php
#

require_once 'webservice_ini.php'; 
require_once '../config.php';  
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/controller/FilialCtr.php';    


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE'); 

if( $_SERVER['REQUEST_METHOD'] === "GET" ):


	$filial = new FilialCtr();	       
    $aFilial = $filial->listaFilial(0);   
    __output_users__($aFilial); 
 
/*

    $usuario = new UsuarioCtr();	 
    if (isset($_GET['nome'])):   
        $aUsu = $usuario->listaUsuarioF($_GET['nome'],$_GET['email'],$_GET['pagina']) ; 
       // var_dump($_GET['pagina']) ;
        __output_users__($aUsu);
    else:
		if (isset($_GET['id'])): 
           if (isset($_GET['wscd'])):  

              if ($_GET['wscd']=='1'):
                   $aDetalhe = $usuario->listaItens($_GET['id']); 
              elseif ($_GET['wscd']=='2'):   
                   $aDetalhe = $usuario->buscaFilialUsuario($_GET['id']); 
              elseif ($_GET['wscd']=='3'):   
                   $aDetalhe  = $usuario->buscaFiliaisValidasUsuario($_GET['id']);                                 
              endif; 

              //var_dump($aDetalhe);
              __output_users__($aDetalhe);
		  
		      
           else:	
		      $aUsu = $usuario->buscaUsuario($_GET['id']); 
		      __output_users2__($aUsu);
		   endif;   
		else:
		     $aUsu = $usuario->listaUsuario(0);   
		     __output_users__($aUsu);  
		endif;   
    endif;
*/
elseif ( $_SERVER['REQUEST_METHOD'] === "POST" ): 

	$postdata = file_get_contents("php://input");  
	if(isset($postdata)   && !empty($postdata)):
	
	  // Extract the data.     
		$request = json_decode($postdata,true); 
	    $usr = $request;

	     $date = date('YmdHis'); 
	     $chave =  '' . $date  ;
	      for ($i = 1; $i <= 3; $i++) {
	          $chave = $chave .  (string)random_int(100, 999);
	      }  	

	    $max = sizeof($usr['d']['filiais']['filiais']);
	    //var_dump($max);  
	    //var_dump($usr['d']['filiais']['filiais']);  
        
        $filial = [];
     
         $i = 0;
		while ($i <= $max):
			if($usr['d']['filiais']['filiais'][$i]["todos"]==true):
		       array_push($filial , $usr['d']['filiais']['filiais'][$i]["id_filial"]);
		    endif;
		    $i++;
		endwhile;	      

	    $usuario = new UsuarioCtr();
	    //create($nome,md5($senha),     
        $usuario->create( $usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",$usr['d']["grupos"] ,$chave ,$filial,$usr['d']["filpad"]);  

		__output_users3__($request);


	  // Validate.
	  //if( $request->data->nome == '')
	  //{
	    //return http_response_code(400); 
	  //}
		
	endif;

elseif ( $_SERVER['REQUEST_METHOD'] === "PUT" ): 

	$postdata = file_get_contents("php://input");  
	if(isset($postdata)   && !empty($postdata)):
	
	  // Extract the data.     
		$request = json_decode($postdata,true); 
	    $usr = $request;  
	    $usuario = new UsuarioCtr();   

	   // var_dump('expression altera');
	    $max = sizeof($usr['d']['filiais']['filiais']);
	    //var_dump($max);  
	    //var_dump($usr['d']['filiais']['filiais']);  
        
        $filial = [];
     
         $i = 0;
		while ($i <= $max):
			if($usr['d']['filiais']['filiais'][$i]["todos"]==true):
		       array_push($filial , $usr['d']['filiais']['filiais'][$i]["id_filial"]);
		    endif;
		    $i++;
		endwhile;
	    //var_dump($filial);
 
	  //  $fil = $usr['d']['filiais']['filiais'][0]["id_filial"];
	   // var_dump($fil);  

        $usuario->update($usr['d']["id"],$usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",$usr['d']["grupos"] , $filial,$usr['d']["filpad"]); 
		
		__output_users3__($request);


	  // Validate.
	  //if( $request->data->nome == '')
	  //{
	    //return http_response_code(400); 
	  //}
		
	endif;
 
elseif ( $_SERVER['REQUEST_METHOD'] === "DELETE" ): 

   $postdata = file_get_contents("php://input");  
   if(isset($postdata)   && !empty($postdata)):
   			 $request = json_decode($postdata,true); 
	         $usr = $request;
             $usuario = new UsuarioCtr();	  
		     $aUsu = $usuario->buscaUsuario($usr['d']["id"]); 
		      __output_users2__($aUsu);  
   endif;

   $usuario = new UsuarioCtr();	 
 
   if (isset($_GET['id'])): 
		 $usuario->delete($_GET['id']); 	     
	     __output_header__( true, 'Registro Deletado.', null);
	    
   endif;

else:
	    __output_header__( false, 'Usuário GET não encontrado.', null);

endif;  
  
?>