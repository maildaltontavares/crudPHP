<?php

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/tabelaCtr.php';   

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = "";

    $tabela = new tabelaCtr();    

    if (isset($_GET['pesquisaCmp'])):           
        $aTabFunc = $tabela->buscaTabelaSiglaF('funcSys',$_GET['pesquisaCmp']); 
    else:
        $aTabFunc = $tabela->buscaTabelaSiglaF('funcSys',''); 
    endif;


    $msg .="<table class='table table-hover'>";
    $msg .="    <thead>";
    $msg .="        <tr>";
    $msg .="            <th>#</th>";
    $msg .="            <th>Função:</th>";
    $msg .="            <th>id</th>";    
    $msg .="        </tr>";
    $msg .="    </thead>";
    $msg .="    <tbody>";

    foreach($aTabFunc as $p_tabela):  
        $msg .="                <tr>";
        $msg .="                    <td><input type=\"radio\" name=\"radio\" nome=\"" . $p_tabela['descricao']. "\" value=\"" . $p_tabela['id'] . "\"    >" ."</td>";  
        $msg .="                    <td>". $p_tabela['descricao'] ."</td>";
        $msg .="                    <td>". $p_tabela['id'] ."</td>";
        $msg .="                </tr>";  
    endforeach; 
    
    $msg .="    </tbody>";
    $msg .="</table>";
 
    echo $msg;
?>