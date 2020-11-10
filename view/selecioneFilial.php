<?php
 
   session_start();
 
   require_once '../config.php';

   require_once ROOT_PATH . '/controller/filialCtr.php';   
  require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;   

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00013');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Seleção de Filiais"'); 
     //exit; 
  endif;
  

  if(isset($_POST['selecioneFilial'])):
        $filial = new FilialCtr();   
        $aFilial = $filial->buscaFilial($_POST['selecioneFilial']);

        //var_dump($aFilial);

        $_SESSION['filial'] = $_POST['selecioneFilial'];  
        $_SESSION['nomeFilial'] = $aFilial[0]['descricao']; 
        $_SESSION['grupoEmpresa'] = $aFilial[0]['idgrupo'];

        include_once "menuNavCab.php";
        echo '<div class="alert alert-primary" role="alert"><li>' . "Filial alterada com sucesso!"  . '</li></div>';
  else:
       include_once "menuNavCab.php";
  endif;

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  
  $_SESSION['tabelaAtual'] ='';  

  ?>

<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style> 

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>  

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

<form method="POST" > 
  <div class = 'container'> 

      <div id='modelo'>
          <div class="cabecalho">
              <h1 class="p-3 mb-2  text-dark cTitulo">Seleção de Filial</h1>
              <div id="grupoBotoes">                   
                 <button type="submit" name= "btGravar" class="btn btn-primary paramBt">Gravar</button>
              </div>  
          </div> 
      </div>  

      <div class="form-row">


          <div class="form-group col-md-8"> 

          <label for="selecioneFilial">Selecione a filial</label>  
          <select class="form-control" id="selecioneFilial" name="selecioneFilial" >
          
          <?php

              $filial = new FilialCtr();   
              foreach($filial->lerFilialUsuario() as $p_filial): 

                  var_dump($p_filial) ;
                  if ($p_filial['id'] ==  $_SESSION['filial']):
                     echo ' <option value=' . $p_filial['id']  . ' selected >' . $p_filial['descricao']  .'</option>';  
                  else:  
                     echo ' <option value=' . $p_filial['id']  . ' >' . $p_filial['descricao']  .'</option>';  
                  endif; 

              endforeach;
 
              include_once "menuNavRodape.php";
              
          ?> 

         </select>

          </div> 



      </div>  

  </div> 
</form> 