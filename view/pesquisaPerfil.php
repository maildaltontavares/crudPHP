<?php

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/perfilCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = "";

    $perfil = new PerfilCtr();    

    if (isset($_GET['pesquisaCmp'])):           
        $aPerfil = $perfil->buscaPerfilF($_GET['pesquisaCmp']); 
    else:
        $aPerfil = $perfil->buscaPerfilF(''); 
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
    foreach($aPerfil as $p_perfil):  
        $msg .="                <tr>";
        $msg .="                    <td><input type=\"radio\" name=\"radio\" nome=\"" . $p_perfil['descricao']. "\" value=\"" . $p_perfil['id'] . "\"    >" ."</td>";  
        $msg .="                    <td>". $p_perfil['descricao'] ."</td>";
        $msg .="                    <td>". $p_perfil['id'] ."</td>";
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