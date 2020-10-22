<?php

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/funcaoSistemaCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = "";

    $tabela = new funcaoSistemaCtr();    

    if (isset($_GET['pesquisaCmp'])):           
        $aTabFunc = $tabela->buscaFuncSysF($_GET['pesquisaCmp']); 
    else:
        $aTabFunc = $tabela->buscaFuncSysF(''); 
    endif;


    $msg .="<table class='table table-hover'>";
    $msg .="    <thead>";
    $msg .="        <tr>";
    $msg .="            <th>#</th>";
    $msg .="            <th>Descrição</th>";
    $msg .="            <th>Id</th>";    
    $msg .="        </tr>";
    $msg .="    </thead>";
    $msg .="    <tbody>";

    $cont =0;
    foreach($aTabFunc as $p_tabela):  
        $msg .="                <tr>";
        $msg .="                    <td><input type=\"radio\" name=\"radio\" nome=\"" . $p_tabela['descricao']. "\" value=\"" . $p_tabela['id'] . "\"    >" ."</td>";  
        $msg .="                    <td>". $p_tabela['descricao'] ."</td>";
        $msg .="                    <td>". $p_tabela['id'] ."</td>";
        $msg .="                </tr>";  

        $cont++;        
        if($cont>60):
            break;
        endif;

    endforeach; 
    
    $msg .="    </tbody>";
    $msg .="</table>";
 
    echo $msg;
?>