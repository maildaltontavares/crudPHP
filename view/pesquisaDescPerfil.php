<?php  

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/perfilCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = ""; 
    $perfil = new PerfilCtr();   

    if (isset($_GET['pesquisaCmp'])):           
        $aPerfil = $perfil->buscaPerfil($_GET['pesquisaCmp']); 
    else:
        $aPerfil = $perfil->buscaPerfil(''); 
    endif; 

    if($aPerfil!=[]):
       $msg=$aPerfil[0]['descricao']; 
    endif;   
 
 
    echo $msg;
?>