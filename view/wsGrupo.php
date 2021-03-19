<?php
#

require_once 'webservice_ini.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/grupoUsuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE'); 

if( $_SERVER['REQUEST_METHOD'] === "GET" ):  

    $grupoUsuarioCtr = new GrupoUsuarioCtr(); 	

    if (isset($_GET['wscd'])):   

    	if($_GET['wscd']==='1'): 
    		$aGrupo = $grupoUsuarioCtr->buscaGrupoUsuario($_GET['id']);
        endif;
    else:     
	    if (!isset($_GET['nome'])):             
	    	$aGrupo = $grupoUsuarioCtr->listaGrupoUsuario(0);	    	 
	    else:
	    	$aGrupo = $grupoUsuarioCtr->listaGrupoUsuarioF($_GET['nome'],0);   
	    endif ;   
    endif;

    __output_users__($aGrupo); 
 

else:
    __output_header__( false, 'Usuário GET não encontrado.', null);

endif;  
  
?>