<?php

  //require_once './../../controller/usuarioCtsr.php';
require_once '../config.php';
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/bibliotecas/phpmailer/class.phpmailer.php';
require_once ROOT_PATH . '/controller/tabelaCtr.php';  
require_once ROOT_PATH . '/controller/usuarioCtr.php'; 

  session_start();
  //session_unset();
  //session_destroy();
  //session_start();  

if(isset($_POST["recuperaSenha"])):

      $erros = array();
      

      $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL); 
      if(!filter_var($email,FILTER_SANITIZE_EMAIL)):
          $erros[] = "E-mail inválido!";              
      endif;    
     

      if (empty($erros)):  

            $tabelaCtr = new TabelaCtr();    
            $p_tabela = $tabelaCtr->buscaParametro('T',2); 
            $dominio =  $p_tabela[0]['pt'];   
            $dominioValido = strpos($_POST["email"]  , $dominio); 

            echo '<br><br><br>';

            if($dominioValido>0):    

                          $envEmail='nOK';
                          $usuarioCtr = new UsuarioCtr();
                          $p_usu = $usuarioCtr->validaUsuario($_POST["email"],''); 

                          if(empty($p_usu)):  
                              echo '<div class="alert alert-primary" role="alert"><li>' . "Email não localizado."  . '</li></div>';
                          else:
                             if ($p_usu[0]['bloqueado']=='S' and strlen($p_usu[0]['chave_atenticacao'])>5):  
                                    echo '<div class="alert alert-primary" role="alert"><li>' . "Conta ainda não confirmada. Recrie sua conta." .'</li></div>';
                             else:   
                                if ($p_usu[0]['bloqueado']=='S' and strlen($p_usu[0]['chave_atenticacao'])<5):   // Esta sem chave de atenticacao
                                    echo '<div class="alert alert-primary" role="alert"><li>' . "Email bloqueado. Contate o administrador do sistema." .'</li></div>';
                                else:
                                    $envEmail='OK';  
                                endif;
                             endif;   
                          endif;

                          if($envEmail=='OK'):
                                
                                    $date = date('YmdHis'); 
                                    $chave =  '' . $date  ;
                                    for ($i = 1; $i <= 10; $i++) {
                                        $chave = $chave .  (string)random_int(100, 999);
                                    }  

                        
                                  $p_tabela = $tabelaCtr->buscaParametro('T',1); 
                                  $paramDt =  $p_tabela[0]['pt'];   

                                if ($usuarioCtr->createChaveAltSenha($p_usu[0]['id_usu'], $chave, date($paramDt) )!= 'OK'): 
                                    echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao recuperar senha!!"  . '</li></div>';  
                                else:  
     
                                    $txtAssunto = "Santana Textiles - Recuperacao de senha";
                                    $txtEmail = $_POST["email"]; 
                                    $txtMensagem = "";  
                                 
                                    // local
                                    //$corpoMensagem = '<b>Sistema Santana Textiles Web</b></b><br><b>Recupere sua senha clicando no link abaixo</b> <br> <a href="http://localhost:8080/crudphp/view/alterarSenha.php?id='. $chave.'">Recuperar senha</a> ' ;
                                
                                    //Nuvem
                                    $corpoMensagem = '<b>Sistema Santana Textiles Web</b></b><br><b>Recupere sua senha clicando no link abaixo</b> <br> <a href="https://virtuax.herokuapp.com/view/alterarSenha.php?id='. $chave.'">Recuperar senha</a> ' ;
                                   
                                  
                                    /* Definir Usuário e Senha do Gmail de onde partirá os emails*/
                                    define('GUSER', 'mail.tavaresdalton@gmail.com');
                                    define('GPWD', 'App!@#2020');

                                    if(smtpmailer($txtEmail, $txtEmail, '', $txtAssunto, $corpoMensagem)):
                                          Header("location: emailCadastro.php"); // Redireciona para uma página de Sucesso.
                                    else:
                                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao enviar email!!"  . '</li></div>';  
                                    endif; 

                                endif;
                          endif;  
                         
            else:
                 echo '<div class="alert alert-primary" role="alert"><li>' . "Dominio do email inválido! Entre com email da Empresa."  . '</li></div>';  
            endif;
      else:

          foreach ($erros as $erro):                 
              echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
          endforeach;  

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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperar senha</h3></div>
                                    <div class="card-body">
                                        <form method="POST">

                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp"required placeholder="Digite email para recuperar senha" name="email"/>
                                            </div>
                                             
                                        
                                            <button class="btn btn-lg btn-primary btn-block" name="recuperaSenha" type="submit">Enviar e-mail</button>
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
