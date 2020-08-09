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
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
     

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
    <link href="carousel.css" rel="stylesheet">
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
 
    <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="  background-image: url('Preto.jpg'); 
  background-repeat: repeat-x; "> <img src="LogoVirtuaX2.png">
    <a class="navbar-brand" href="login.php">Login</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Lojas <span class="sr-only"> </span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="#">Promoções <span class="sr-only"> </span></a>
        </li>        

        <li class="nav-item active">
          <a class="nav-link" href="#">Eventos <span class="sr-only"> </span></a>
        </li>  

        <li class="nav-item active">
          <a class="nav-link" href="#">Contato <span class="sr-only"> </span></a>
        </li>  
 


        <!--

        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
        -->


      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</header>


  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>

    

 
</html>