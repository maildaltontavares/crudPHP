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

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="generator" content="Jekyll v4.0.1">
        <title>VirtuaX - Shopping Virtual</title> 

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

        <!-- Bootstrap core CSS -->
        <link href="../assets/dist/css/bootstrap.css" rel="stylesheet">

        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
          }

          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
         </style>
        <!-- Custom styles for this template -->
         <link href="signin.css" rel="stylesheet">
          
    </head> 

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
   <body> 
  <div   class="blocos">
      <section id="logo_topo"> </section>  

  </div>


  


    <div class="blocos1">

        <div id="formp" class="text-center">
            <form class="form-signin" method="POST">
                <!--<img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
               
                <label for="username" class="sr-only">Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Usuário" required autofocus>
               
                <label for="senha" class="sr-only">Senha</label>
                <input type="password"  name="senha" class="form-control" placeholder="Senha" required>
                
                <div class="checkbox mb-3">
                  <label>
                    <input type="checkbox" value=""> Esqueci a senha
                  </label>
                </div>

                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Entrar</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
            </form>
        </div>  
   
    </div>
        
   </body>
    

 
</html>