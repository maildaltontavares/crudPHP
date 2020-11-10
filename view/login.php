<?php

  //require_once './../../controller/usuarioCtsr.php';
require_once '../config.php';
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
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
        <title>Santana Textiles</title> 

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

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
         <link href="carousel.css" rel="stylesheet">
          
    </head> 

      <?php

        if(isset($_POST['login'])): 

          $erros = array();

          $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL); 
          if(!filter_var($email,FILTER_SANITIZE_EMAIL)):
              $erros[] = "E-mail inválido!";              
          endif;  

          $pwd = $_POST['senha'];

          if (empty($pwd) or is_null($pwd)):
              $erros[] = "Senha inválida!";
          endif;


          if (empty($erros)):  // Nao tem erros de digitacao

              $usuarioCtr = new UsuarioCtr();   
              $p_usu = $usuarioCtr->validaUsuario($email,$pwd);  
              if(!empty($p_usu)):  

                  $_SESSION['email'] = $email;
                  $_SESSION['perfil'] = $usuarioCtr->montaPerfil($email);  
                  $_SESSION['filial'] = $p_usu[0]['filial'];  
                  $_SESSION['nomeFilial'] = $p_usu[0]['nome_filial'];
                  $_SESSION['grupoEmpresa'] = $p_usu[0]['idGrupo'];
                  $_SESSION['user'] = $p_usu[0]['nome'];


                  header('Location:principal.php');   
              else:  
                  echo '</br>';
                  echo '<div class="alert alert-primary" role="alert"><li>' . "E-mail ou senha inválido!!"  . '</li></div>';                  
              endif;  

          else:
 
              foreach ($erros as $erro): 
                  echo '</br>';                
                  echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
              endforeach;  

          endif;  
        endif; 

      ?>       
 
 
    <header>
      <?php
        include "menuHome.php";
      ?>
    </header>


    <div class="blocos1">

        <div id="formp" class="text-center">
            <form class="form-signin" method="POST">
                <!--<img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
                <h1 class="h3 mb-3 font-weight-normal">Login</h1>
               
                <label for="email" class="sr-only">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
               
                <label for="senha" class="sr-only">Senha</label>
                <input type="password"  name="senha" class="form-control" placeholder="Senha" required>
                
                <div class="checkbox mb-3">
                  <label>
                    <input type="checkbox" value=""> Lembrar de mim
                  </label>
                </div>
            
                <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Entrar</button>
                <a href="#">Esqueceu sua senha?</a><br>
                <a href="#">Não tem conta? Cadastre-se.</a>
                <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
            </form>
        </div>  
 
    </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>


    

 
</html>