<?php
 
   session_start();
 
   require_once '../config.php';

   require_once ROOT_PATH . '/controller/tabpadCtr.php';   
  require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;   

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00003');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Tabelas"'); 
     //exit; 
  endif;

  if(isset($_POST['selecioneTab'])):
     header('Location:lista_tabela.php?idTp=' .  $_POST['selecioneTab']  ); //+  $_POST['selecioneTab'] ); 
     exit; 
  endif;

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";
    $_SESSION['tabelaAtual'] ='';  

  ?>

<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style> 

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>  

<script> 
 // var vAltera = <?php echo isset($_POST['selecioneTab'])?$_POST['selecioneTab']:'Nada';  ?>;   
  //$(document).ready(function() {  
  //     window.open("lista_tabela.php?idTp=" + vAltera ,"_self" ); 
  //     exit;
  //});  
</script>

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

<form method="POST" > 
  <div class = 'container'> 

      <div id='modelo'>
          <div class="cabecalho">
              <h1 class="p-3 mb-2  text-dark cTitulo">Seleção de Tabelas</h1>
              <div id="grupoBotoes">                   
                 <button type="submit" name= "avancar" class="btn btn-primary paramBt">Avançar</button>
              </div> 

          </div> 
      </div> 

 

      <div class="form-row">


          <div class="form-group col-md-8"> 

          <label for="selecioneTab">Selecione a tabela que deseja manter</label>  
          <select class="form-control" id="selecioneTab" name="selecioneTab" >  
          
          <?php

              $tabpad = new tabpadCtr();

              foreach($tabpad->lerTodas() as $p_tabpad): 

                  if ($p_tabpad['id'] ==  $_POST['selecioneTab'] ):
                     echo ' <option value=' . $p_tabpad['id']  . ' selected >' . $p_tabpad['descricao']  .'</option>';  
                  else:  
                     echo ' <option value=' . $p_tabpad['id']  . ' >' . $p_tabpad['descricao']  .'</option>';  
                  endif; 

              endforeach;

              include_once "menuNavRodape.php";
              
          ?> 

          </select> 
 



          </div> 



      </div>  

  </div> 
</form> 