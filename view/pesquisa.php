<?php
    //recebemos nosso parâmetro vindo do form
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = "";
    //começamos a concatenar nossa tabela
    $msg .="<table class='table table-hover'>";
    $msg .="    <thead>";
    $msg .="        <tr>";
    $msg .="            <th>#</th>";
    $msg .="            <th>Nome:</th>";
    $msg .="            <th>E-mail:</th>";
    $msg .="            <th>Ação</th>";    
    $msg .="        </tr>";
    $msg .="    </thead>";
    $msg .="    <tbody>";
     

    $msg .="                <tr>";
    $msg .="                    <td>".'1'."</td>";
    $msg .="                    <td>".'Cadastros Gerais'."</td>";
    $msg .="                    <td>".'zaz@zaz.com'."</td>";
    $msg .="                    <td><input type=\"radio\" name=\"Cadastros Gerais\" value=\"1\"    >" ."</td>";  
    $msg .="                </tr>";

    $msg .="                <tr>";
    $msg .="                    <td>".'2'."</td>";
    $msg .="                    <td>".'Tabelas 2'."</td>";
    $msg .="                    <td>".'zaz@zazeee.com'."</td>";
    $msg .="                    <td><input type=\"radio\" name=\"Tabelas 2\" value=\"2\"    >" ."</td>";  
    $msg .="                </tr>";

    $msg .="                <tr>";
    $msg .="                    <td>".'8'."</td>";
    $msg .="                    <td>".'Parametros 8'."</td>";
    $msg .="                    <td>".'zaz@zazeee.com'."</td>";
    $msg .="                    <td><input type=\"radio\" name=\"Parametros 8\" value=\"8\"    >" ."</td>";    
    $msg .="                </tr>";

    


    /*            
                //requerimos a classe de conexão
                require_once('class/Conexao.class.php');
                    try {
                        $pdo = new Conexao(); 
                        $resultado = $pdo->select("SELECT * FROM cliente WHERE nome LIKE '$parametro%' ORDER BY nome ASC");
                        $pdo->desconectar();
                                 
                        }catch (PDOException $e){
                            echo $e->getMessage();
                        }   
                        //resgata os dados na tabela
                        if(count($resultado)){
                            foreach ($resultado as $res) {
 
    $msg .="                <tr>";
    $msg .="                    <td>".$res['idCliente']."</td>";
    $msg .="                    <td>".$res['nome']."</td>";
    $msg .="                    <td>".$res['email']."</td>";
    $msg .="                </tr>";
                            }   
                        }else{
                            $msg = "";
                            $msg .="Nenhum resultado foi encontrado...";
                        }

   */                        
    $msg .="    </tbody>";
    $msg .="</table>";
    //retorna a msg concatenada
    echo $msg;
?>