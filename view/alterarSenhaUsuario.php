<?php
  
require_once '../config.php';
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/bibliotecas/phpmailer/class.phpmailer.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php'; 
require_once ROOT_PATH . '/controller/tabelaCtr.php'; 

  session_start();
   
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  include_once "menuNavCab.php";
 

  //echo '<br><br><br><br>';
  if(isset($_SESSION['id_usu'])):

          $usuarioCtr = new UsuarioCtr();   
          $p_usu = $usuarioCtr->buscaUsuario($_SESSION['id_usu']);

          $nome =$p_usu[0]['nome'];
          $email=$p_usu[0]['email'];
 
          if(empty($p_usu)): 
              header('Location:semAcesso.php?tela="Alteração de Senha"'); 
          endif; 

  else:        

     header('Location:semAcesso.php?tela="Alteração de Senha"'); 
  
   
  endif; 
 
$alt=false;

if(isset($_POST["criarConta"])):

      $erros = array();
      
      $nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);  

      //var_dump($_POST);

      
      if(!filter_var($nome,FILTER_SANITIZE_STRING)):
          $erros[] = "Nome inválido!";              
      endif;  

      $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL); 
      if(!filter_var($email,FILTER_SANITIZE_EMAIL)):
          $erros[] = "E-mail inválido!";              
      endif;    
     

      if (empty($erros)):  

            $tabelaCtr = new TabelaCtr();    
            $p_tabela = $tabelaCtr->buscaParametro('T',2); 
            $dominio =  $p_tabela[0]['pt'];   
            $dominioValido = strpos($_POST["email"]  , $dominio);  

            if($dominioValido>0):   

                    if($_POST["senha"] == $_POST["confirmaSenha"]): 
                         
                          $usuarioCtr = new UsuarioCtr();
                          $p_usu = $usuarioCtr->validaUsuario($_POST["email"],''); 

                          if(!empty($p_usu)):    

                                if(md5($_POST["senhaAtual"]) == $p_usu[0]['senha']):

                                    $p_tabela = $tabelaCtr->buscaParametro('T',1); 
                                    $paramDt =  $p_tabela[0]['pt']; 
                                  
                                    if ($usuarioCtr->alteraSenha($p_usu[0]['id_usu'],md5($_POST["senha"]), date($paramDt)  )!= 'OK'): 
                                        echo '<br><br><br>';
                                        echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar senha!!"  . '</li></div>';  
                                    else:     
                                        $alt=true;  
                                            // header('Location:mensagem.php?msg="Senha alterada com sucesso."');  
                                    endif;  

                                else:
                                        echo '<br><br><br>';
                                        echo '<div class="alert alert-primary" role="alert"><li>' . "Senha atual não confere!!"  . '</li></div>';  
                                endif;
                          else:
                                        echo '<br><br><br>';
                                        echo '<div class="alert alert-primary" role="alert"><li>' . "Email não localizado!"  . '</li></div>';  
                          endif;


                     else:
                        echo '<br><br><br>';
                        echo '<div class="alert alert-primary" role="alert"><li>' . "Senhas não conferem."  . '</li></div>';  
                                
                     endif;       
            else:
                 echo '<br><br><br>';
                 echo '<div class="alert alert-primary" role="alert"><li>' . "Dominio do email inválido! Entre com email da Empresa."  . '</li></div>';  
            endif;
      else:

          foreach ($erros as $erro):  
              echo '<br><br><br>';               
              echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
          endforeach;  

      endif;
 endif;
 
        //include "menuHome.php";

   echo '
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Santana Textiles</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
         
    </head> 

   </br></br></br>

  
        <div id="layoutAuthentication"> 

            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">';


if($alt!=true):

    echo '

  
 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Alterar Senha</h3></div>
                                    <div class="card-body"> 
                                        <form method="POST">
                                            
                                            <div class="form-group">
                                                 <label class="small mb-1" for="inputFirstName">Nome</label>
                                                      <input class="form-control py-4" id="inputFirstName" type="text" disabled placeholder="Digite seu nome" name="nome1"  value="' . $nome . '"/>
                                            </div>  

                                            <input type="hidden"    name="nome"   value="' . $nome . '"/>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" disabled placeholder="Digite seu email1" name="email" value="' . $email . '"/>
                                            </div>

                                            <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Senha atual</label>
                                                    <input class="form-control py-4" id="inputPassword" type="password" required placeholder="Digite a senha atual" name="senhaAtual" />
                                            </div>

                                            <input type="hidden"    name="email"  value="' . $email . '"/>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Nova Senha</label>
                                                        <input class="form-control py-4" id="inputPassword" type="password" required placeholder="Digite a nova senha" name="senha" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirme a nova senha</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" required type="password" placeholder="Confirme a nova senha" name="confirmaSenha"/>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <button class="btn btn-lg btn-primary btn-block" name="criarConta" type="submit">Confirmar alteração</button>
                                        </form>';


 
 else:
                 echo '
                                      <div class="card-header"><h3 class="text-center font-weight-light my-4">Atenção</h3></div>
                                    <div class="card-body">' ;
                 echo '<br><br><br>';
                 echo '<div class="alert alert-primary" role="alert"><li>' . "Senha alterada com sucesso."  . '</li></div>';   
 endif;

       echo '

                                    </div>
                                    <div class="card-footer text-center">
                                  
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
        <script src="js/scripts.js"></script>';

?>