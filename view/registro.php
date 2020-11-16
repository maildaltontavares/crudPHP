<?php

  //require_once './../../controller/usuarioCtsr.php';
require_once '../config.php';
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/bibliotecas/phpmailer/class.phpmailer.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php'; 

  session_start();
  //session_unset();
  //session_destroy();
  //session_start(); 
if(isset($_POST["criarConta"])):


      $date = date('YmdHis'); 
      $chave =  '' . $date  ;
      for ($i = 1; $i <= 10; $i++) {
          $chave = $chave .  (string)random_int(100, 999);
      }   

    $usuarioCtr = new UsuarioCtr(); 
    //if ($usuarioCtr->create($nome,$senha,$email,'',[],$chave,[],'')== 'OK'):      


    $txtNome = $_POST["nome"];
    $txtAssunto = "Santana Textiles - Validacao de cadastro";
    $txtEmail = $_POST["email"];
    $txtMensagem = "";
 
    /* Montar o corpo do email*/
    //$corpoMensagem = '<b>Sistema Santana Textiles Web</b></b><br><b>Confirme sua conta clicando no link abaixo</b> <br> <a href="http://localhost:8080/crudphp/view/emailValidado.php?id='. $chave.'">Validar Conta</a> ' ;


    $corpoMensagem = '<b>Sistema Santana Textiles Web</b></b><br><b>Confirme sua conta clicando no link abaixo</b> <br> <a href="https://virtuax.herokuapp.com/view/emailValidado.php?id='. $chave.'">Validar Conta</a> ' ;
   
  
    /* Definir Usuário e Senha do Gmail de onde partirá os emails*/
    define('GUSER', 'mail.tavaresdalton@gmail.com');
    define('GPWD', 'App!@#2020');


    if(smtpmailer($txtEmail, $txtEmail, $txtNome, $txtAssunto, $corpoMensagem)):
        Header("location: emailCadastro.php"); // Redireciona para uma página de Sucesso.
    else:
          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao enviar email!!"  . '</li></div>';  
    endif;
     
 endif;
?> 


<!DOCTYPE html>
<html lang="en">

    <header>
      <?php
        include "menuHome.php";
      ?>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Santana Textiles</title>
        <link href="css/styles.css" rel="stylesheet" />
        script>
    </head>


    </header>
    </br></br></br>

    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Criar conta</h3></div>
                                    <div class="card-body">
                                        <form method="POST">

                                            <div class="form-group">
                                                   <label class="small mb-1" for="inputFirstName">Nome</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Digite seu nome" name="nome" />
                                            </div> 
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Digite seu email" name="email"/>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Senha</label>
                                                        <input class="form-control py-4" id="inputPassword" type="password" placeholder="Digite a senha" name="senha" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirme a senha</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirme a senha" name="confirmaSenha"/>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <button class="btn btn-lg btn-primary btn-block" name="criarConta" type="submit">Criar conta</button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Ir para login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Santana Textiles 2020</div>
                            <div>
                                <a href="#">Políticas</a>
                                &middot;
                                <a href="#">Termos &amp; Condições</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
