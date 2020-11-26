<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/leituraCtr.php'; 
  require_once ROOT_PATH . '/controller/tabelaCtr.php'; 
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
  $Altera = "N";    
  $paramDt =  $_SESSION['paramDt']; // Parametro de formato de data do banco de dados

  $id = 0;
  $tear = '';
  $filial = $_SESSION['filial'];
  $dt_leitura = date($paramDt);
  $turno ='';
  $leitura=0;
  $rpm=0;
  $par_trama=0;
  $par_urdume=0;
  $par_outros=0;
  $dt_inclusao = date($paramDt);
  $dt_alteracao = date($paramDt);
  $usr_inclusao = $_SESSION['id_usu'];
  $usr_alteracao = $_SESSION['id_usu'];

  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $leituraCtr = new leituraCtr();   
     $p_leitura = $leituraCtr->buscaLeitura($_GET['Id']);  

     //var_dump($p_leitura);

      if(!empty($p_leitura)): 

        $id           = $p_leitura[0]['id'];  
        $tear         = $p_leitura[0]['tear']; 
        $filial       = $p_leitura[0]['filial'];  
        $dt_leitura   = $p_leitura[0]['dt_leitura']; 
        $turno        = $p_leitura[0]['turno']; 
        $leitura      = $p_leitura[0]['leitura']; 
        $rpm          = $p_leitura[0]['rpm']; 
        $par_trama    = $p_leitura[0]['par_trama']; 
        $par_urdume   = $p_leitura[0]['par_urdume']; 
        $par_outros   = $p_leitura[0]['par_outros']; 
        $dt_inclusao  = $p_leitura[0]['dt_inclusao']; 
        $dt_alteracao = $p_leitura[0]['dt_alteracao']; 
        $usr_inclusao = $p_leitura[0]['usr_inclusao']; 
        $usr_alteracao= $p_leitura[0]['usr_alteracao'];  

      endif;  

  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])):

      $leituraCtr = new leituraCtr(); 
          
      if ($leituraCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $tear =  filter_input(INPUT_POST, 'tear',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($tear,FILTER_SANITIZE_STRING)):
                    $erros[] = "Tear inválido!";   
              elseif($tear==''):
                    $erros[] = "Tear inválido!";                  
              endif;    


              if(isset($_POST['dt_leitura']) and !EMPTY($_POST['dt_leitura'])):    
                  $dt_leitura = $_POST['dt_leitura']; //filter_input(INPUT_POST, 'data2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($dt_leitura,FILTER_SANITIZE_STRING)):
                      $erros[] = "Data inválida!";              
                  endif; 
              else:
                  $dt_leitura = ''; 
              endif; 

               $turno =  filter_input(INPUT_POST, 'turno',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($turno,FILTER_SANITIZE_STRING)):
                    $erros[] = "Turno inválido!";   
              elseif($tear==''):
                    $erros[] = "Turno inválido!";                  
              endif;   

              if(isset($_POST['leitura']) and !EMPTY($_POST['leitura'])):    
                  $leitura = filter_input(INPUT_POST, 'leitura',FILTER_SANITIZE_NUMBER_INT);    
                  if(!filter_var($leitura,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Leitura inválida!";              
                  endif; 
              else:
                  $leitura = 0; 
              endif;    
              
             if(isset($_POST['rpm']) and !EMPTY($_POST['rpm'])):    
                  $rpm = filter_input(INPUT_POST, 'rpm',FILTER_SANITIZE_NUMBER_INT);    
                  if(!filter_var($rpm,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "RPM inválido!";              
                  endif; 
              else:
                  $rpm = 0; 
              endif;    
                   
              if(isset($_POST['par_trama']) and !EMPTY($_POST['par_trama'])):    
                  $par_trama = filter_input(INPUT_POST, 'par_trama',FILTER_SANITIZE_NUMBER_INT);    
                  if(!filter_var($par_trama,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Parada de Trama inválida!";              
                  endif; 
              else:
                  $par_trama = 0; 
              endif;   
             
              if(isset($_POST['par_urdume']) and !EMPTY($_POST['par_urdume'])):    
                  $par_urdume = filter_input(INPUT_POST, 'par_urdume',FILTER_SANITIZE_NUMBER_INT);    
                  if(!filter_var($par_urdume,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Parada de urdume inválida!";              
                  endif; 
              else:
                  $par_urdume = 0; 
              endif;   
              
              if(isset($_POST['par_outros']) and !EMPTY($_POST['par_outros'])):    
                  $par_outros = filter_input(INPUT_POST, 'par_outros',FILTER_SANITIZE_NUMBER_INT);    
                  if(!filter_var($par_outros,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Parada outros inválida!";              
                  endif; 
              else:
                  $par_outros = 0; 
              endif;   

              if (empty($erros)):  // Nao tem erros de digitacao

                  $leituraCtr = new leituraCtr();  
                  if ($Altera == "N"):

                      if ($leituraCtr->create($filial,$tear,$dt_leitura,$turno,$leitura,$rpm,$par_trama,$par_urdume,$par_outros,$dt_inclusao,$usr_inclusao )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Leitura inválida!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  
                  else:
                      if ($leituraCtr->update($id,$filial,$tear,$dt_leitura,$turno,$leitura,$rpm,$par_trama,$par_urdume,$par_outros,$dt_alteracao,$usr_alteracao )== 'OK'):  

                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $gravou = "S"; 
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';
                          $gravou = "N";                  
                      endif;  

                  endif;    

              else:

                  foreach ($erros as $erro):                 
                      echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
                  endforeach;  

              endif;
 

  endif; 


  ?>

  

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>
   
 
<form method="POST" > 
  <div class="limiteTela" >
 
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Leitura dos teares</h1>
            <div id="grupoBotoes">  
              <?php
                     $acesso->configura_botoes($validaAcesso,'leituraCad','lista_leitura',$excluiu,$Altera,$id,$gravou);
               ?>
            </div> 

        </div> 
    </div>   

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="tear">Tear</label> 
          <input id="tear" name ="tear" type="number" class="form-control simple-field-data-mask-selectonfocus" required data-mask="000000" type="text"  data-mask-selectonfocus="true"  value="<?php  echo $tear;  ?>" >
        </div> 
    </div>  
    
    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="dt_leitura">Data da Leitura</label> 
          <input id="dt_leitura" name ="dt_leitura" type="date" class="form-control" required  value="<?php  echo $dt_leitura;?>" >  
        </div> 
    </div>  




    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="turno">Turno</label> 
          <!--<input id="turno" name ="turno" type="text" class="form-control simple-field-data-mask-selectonfocus" data-mask="S" required  value="<?php  echo $turno;  ?>" > -->


          <select class="form-control" id="selecioneTurno" name="turno" >  
          
          <?php 

                if ($turno ==  'A' ):
                   echo ' <option value="A" selected >A</option>';  
                else:  
                   echo ' <option value="A">A</option>';  
                endif; 

                if ($turno ==  'B' ):
                   echo ' <option value="B" selected >B</option>';  
                else:  
                   echo ' <option value="B">B</option>';  
                endif;     
               
                if ($turno ==  'C' ):
                   echo ' <option value="C" selected >C</option>';  
                else:  
                   echo ' <option value="C">C</option>';  
                endif;  
              
              
          ?> 

          </select> 



        </div> 
    </div>  

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="leitura">Leitura</label>   
          <input id="leitura" name ="leitura" type="number" class="form-control simple-field-data-mask-selectonfocus" data-mask="000"  required  value="<?php  echo $leitura;  ?>" >
        </div> 
    </div> 

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="rpm">RPM</label> 
          <input id="rpm" name ="rpm" type="number" class="form-control simple-field-data-mask-selectonfocus" data-mask="000"  required  value="<?php  echo $rpm;  ?>" >
        </div> 
    </div> 

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="par_trama">Num. paradas de trama</label> 
          <input id="par_trama" name ="par_trama" type="number" class="form-control  simple-field-data-mask-selectonfocus" data-mask="000"  required  value="<?php  echo $par_trama;  ?>" >
        </div> 
    </div> 

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="par_urdume">Num. paradas de urdume</label> 
          <input id="par_urdume" name ="par_trama" type="number" class="form-control  simple-field-data-mask-selectonfocus" data-mask="000"  required  value="<?php  echo $par_urdume;  ?>" >
        </div> 
    </div> 

    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="par_outros">Num. paradas outros</label> 
          <input id="par_outros" name ="par_outros" type="number" class="form-control  simple-field-data-mask-selectonfocus" data-mask="000"  required  value="<?php  echo $par_outros;  ?>" >
        </div> 
    </div>     


  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?> 

</form>
<!--
  <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script> 

  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/test/sinon-1.10.3.js"></script>
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/test/sinon-qunit-1.0.0.js"></script>
-->
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/src/jquery.mask.js"></script>
  <script type="text/javascript" src="../bibliotecas/jQuery-Mask/test/jquery.mask.test.js"></script>
