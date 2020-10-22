<?php
    //recebemos nosso parâmetro vindo do form
    $msg = "";
    //começamos a concatenar nossa tabela
    $msg .="<table class='table table-hover'>";
    $msg .="    <thead>";
    $msg .="            <th>#</th>";
    $msg .="            <th>Descrição</th>";
    $msg .="            <th>Id</th>";    
 
    $msg .="    </thead>";
    $msg .="    <tbody>";
                       
    $msg .="    </tbody>";
    $msg .="</table>";
    //retorna a msg concatenada
    echo $msg;
?>

 