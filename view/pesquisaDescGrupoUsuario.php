<?php  

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/grupoUsuarioCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = ""; 
    $grupoUsuario = new GrupoUsuarioCtr();   

    if (isset($_GET['pesquisaCmp'])):           
        $aGrupoUsuario = $grupoUsuario->buscaGrupoUsuario($_GET['pesquisaCmp']); 
    else:
        $aGrupoUsuario = $grupoUsuario->buscaGrupoUsuario(''); 
    endif; 

    if($aGrupoUsuario!=[]):
       $msg=$aGrupoUsuario[0]['descricao']; 
    endif;   
 
 
    echo $msg;
?>