<?php
 
   session_start();

   require_once '../config.php';

   require_once ROOT_PATH . '/controller/tabpadCtr.php';  
 
   if(!isset($_SESSION['user'])):
       header('Location:login.php');  
       exit();      
   endif;  
   include "menuHome.php";
   include_once "menu.php"; 
    $_SESSION['tabelaAtual'] ='';  

  ?>

<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style> 

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>  

<script> 
  var vAltera = <?php echo isset($_POST['selecioneTab'])?$_POST['selecioneTab']:'Nada';  ?>;   
  $(document).ready(function() {     
      window.open("lista_tabela.php?idTp=" + vAltera ,"_self" );  
  });  
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
              foreach($tabpad->buscaTpCad() as $p_tabpad):        
                    echo " <option value='" . $p_tabpad['id']  . "' > " . $p_tabpad['descricao']  . "</option>";   
              endforeach;
          ?>
          </select> 


          </div> 



      </div>  

  </div> 
</form> 