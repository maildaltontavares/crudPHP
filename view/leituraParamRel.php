<?php
 
  session_start();

  require_once '../config.php'; 
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00015');  
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Leituras"'); 
  endif;     

  include_once "menuNavCab.php";
   
  $paramDt =  $_SESSION['paramDt']; // Parametro de formato de data do banco de dados
 
  ?> 

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>
   
 
<form method="POST"  action="rptLeitura.php" > 
  <div class="container" >
 
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Relatório de leitura dos teares</h1> 
        </div> 
    </div>   

    <button type="submit" name= "listar" class="btn btn-primary paramBt" id="listar">Imprimir</button>
    
    <div class="form-row"> 
        <div class="form-group col-md-4">
          <label for="dt_leitura">Data da Leitura Inicial</label> 
          <input id="dt_leitura" name ="dt_leitura_inicial" type="date" required class="form-control"   >  
        </div> 
    </div>  

    <div class="form-row"> 
        <div class="form-group col-md-4">
          <label for="dt_leitura">Data da Leitura Final</label> 
          <input id="dt_leitura" name ="dt_leitura_final" type="date" required class="form-control"   >  
        </div> 
    </div>    

  </div> 

<?php
 
  include_once "menuNavRodape.php";
?> 

</form>
 
 
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/src/jquery.mask.js"></script>
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/test/jquery.mask.test.js"></script>
