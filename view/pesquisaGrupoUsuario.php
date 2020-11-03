<?php

    session_start();

    require_once '../config.php';
    require_once ROOT_PATH . '/controller/grupoUsuarioCtr.php';  

    $parametro = isset($_GET['pesquisaCmp']) ? $_GET['pesquisaCmp'] : null; 

    $msg = "";

    $grupoUsuario = new GrupoUsuarioCtr();    

    if (isset($_GET['pesquisaCmp'])):           
        $aGrupoUsuario = $grupoUsuario->buscaGrupoUsuarioF($_GET['pesquisaCmp']); 
    else:
        $aGrupoUsuario = $grupoUsuario->buscaGrupoUsuarioF(''); 
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
    foreach($aGrupoUsuario as $p_grupoUsuario):  
        $msg .="                <tr>";
        $msg .="                    <td><input type=\"radio\" name=\"radio\" nome=\"" . $p_grupoUsuario['descricao']. "\" value=\"" . $p_grupoUsuario['id'] . "\"    >" ."</td>";  
        $msg .="                    <td>". $p_grupoUsuario['descricao'] ."</td>";
        $msg .="                    <td>". $p_grupoUsuario['id'] ."</td>";
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