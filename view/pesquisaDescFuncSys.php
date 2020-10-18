<?php  

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/funcaoSistemaCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = ""; 
    $tabela = new funcaoSistemaCtr();   

    if (isset($_GET['pesquisaCmp'])):           
        $aTabFunc = $tabela->buscaFuncaoSistema($_GET['pesquisaCmp']); 
    else:
        $aTabFunc = $tabela->buscaFuncaoSistema(''); 
    endif; 

    if($aTabFunc!=[]):
       $msg=$aTabFunc[0]['descricao']; 
    endif;   
 
 
    echo $msg;
?>