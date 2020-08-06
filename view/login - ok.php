<?php

  //require_once './../../controller/usuarioCtsr.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php'; 

  session_start();
  //session_unset();
  //session_destroy();
  //session_start(); 
?> 

<!DOCTYPE html>
<html>
<head>
  <title>VirtuaX - Shopping Virtual</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
      
        #container{
            position: relative;
            top: 100px; 
            left:100px;             
            padding:40px;
             
        }
      /*  #login,#loginh1{
          background-color: #836FFF;
          
        }*/

        #lb_username,.btn-primary,#lb_passw{
          position: relative;
          top:8px;
        }

    </style>

</head>
<body>

  <header>
    
    <?php
      include "topo.php";
    ?>

 </header>

  
  <section id="main">    
      <?php

        if(isset($_POST['login'])):
 
          $erros = array();

          $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_SPECIAL_CHARS); 
          if(!filter_var($username,FILTER_SANITIZE_STRING)):
              $erros[] = "Usuario inválido!";
              
          endif;    

          $pwd = $_POST['senha'];

          if (empty($pwd) or is_null($pwd)):
              $erros[] = "Senha inválida!";
          endif;


          if (empty($erros)):  // Nao tem erros de digitacao

              $usuarioCtr = new UsuarioCtr(); 
          
              //var_dump($usuarioCtr);
        


              if ($usuarioCtr->validaUsuario($username,$pwd)== 'OK'):  
                  $_SESSION['user'] = $username;
                  //echo '<div class="alert alert-primary" role="alert"><li>' . $_SESSION['user']  . '</li></div>';
                  header('Location:principal.php');   
              else:  
                  echo '<div class="alert alert-primary" role="alert"><li>' . "Usuario ou senha inválido!!"  . '</li></div>';                  
              endif;  

          else:

              foreach ($erros as $erro):                 
                  echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
              endforeach;  

          endif;
        endif; 

      ?> 

    <form method="POST">
      
      <div class = 'container' id="container">   

                <div class="row" >
                        <div class="col-3"> </div>
                        <div class="col-3" id="login"><h1 id="loginh1" >Login</h1></div>
                </div>

                <div class="row">                         
                        <div class="col-3"> </div>     
                        <div class="col-3"><label for="exampleInputEmail1" id="lb_username">Usuario</label></div>
                </div>   

                <div class="row">      
                        <div class="col-3"> </div>    
                        <div class="col-3"><input name="username" type="text" class="form-control"  ></div> 
                </div>     

                <div class="row">                         
                        <div class="col-3"> </div>     
                        <div class="col-3"><label for="exampleInputPassword1" id="lb_passw">Senha</label></div>
                </div>   

                <div class="row">      
                        <div class="col-3"> </div>    
                        <div class="col-3"><input type="password"  name="senha" class="form-control" id="exampleInputPassword1"></div> 
                </div>                                          
    

                <div class="row">
                        <div class="col-3"> </div>
                        <div class="col-3"><button type="submit" name= "login" class="btn btn-primary">Entrar</button></div>
                </div>     
      </div>        

    </form>
  </section>  
 

</body>
</html>