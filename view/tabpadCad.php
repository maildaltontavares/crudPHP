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
  $validaAcesso = $acesso->validaAcesso('00001');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Cadastro de grupo de tabela"'); 
     //exit; 
  endif; 


  //include_once "menuPrincipal.php";
  //include_once "menu.php";   

  include_once "menuNavCab.php";
  $Altera = "N"; 

  $id = 0;
  $nometabpad = '';
  $sigla  = '';
  $tabsys = '';
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $tabpadCtr = new tabpadCtr();   
     $p_tabpad = $tabpadCtr->buscatabpad($_GET['Id']);  

     //var_dump($p_tabpad);

      if(!empty($p_tabpad)): 
        $id = $p_tabpad[0]['id'];  
        $nometabpad = $p_tabpad[0]['descricao'];    
        $sigla = $p_tabpad[0]['sigla'];    
        $tabsys = $p_tabpad[0]['tab_sistema'];  
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $tabpadCtr = new tabpadCtr(); 
          
      if ($tabpadCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nometabpad =  filter_input(INPUT_POST, 'nometabpad',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nometabpad,FILTER_SANITIZE_STRING)):
                     $erros[] = "Nome grupo de Tabela inválido!";   
              elseif($nometabpad==''):
                    $erros[] = "Nome grupo de Tabela inválido!";                  
              endif;   


              $sigla =  filter_input(INPUT_POST, 'sigla',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($sigla,FILTER_SANITIZE_STRING)):
                  $erros[] = "Sigla inválida!";          
              elseif($sigla==''):
                  $erros[] = "Sigla inválida!";                             
              endif; 

              $tabsys = '';
              if (isset($_POST['Tabsys'])):
                  $tabsys = 'S';
              endif;  
 
              //var_dump($tabsys);

              if (empty($erros)):  // Nao tem erros de digitacao

                  $tabpadCtr = new tabpadCtr();  
                  if ($Altera == "N"):

                      if ($tabpadCtr->create($nometabpad,$sigla,$tabsys)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Grupo inválido!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($tabpadCtr->update($id,$nometabpad,$sigla,$tabsys)== 'OK'):  
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

<script>  

  $(document).ready(function(){  
    

 })
</script> 

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupo de Tabelas</h1>
            <div id="grupoBotoes">  
               
              <?php



                     $acesso->configura_botoes($validaAcesso,'tabpadCad','lista_tp',$excluiu,$Altera,$id,$gravou);
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="tabpad">Nome Grupo Tabela</label> 

          <input id="tabpad" name ="nometabpad" type="text" class="form-control"   value="<?php  echo $nometabpad;  ?>"       >

        </div>
    </div>  

    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="sigla">Sigla</label> 

          <input id="sigla" name ="sigla" type="text" class="form-control"   value="<?php  echo $sigla;  ?>"       >

        </div>
    </div>     

   <div class="form-row"> 

        <div class="form-group col-md-4">
          <?php
          if ($tabsys =="S"):
             echo '<input type="checkbox" name="Tabsys"  checked  >';
          else:
             echo '<input type="checkbox" name="Tabsys"   >';
          endif;
          ?>

          <label for="sigla">Tabela de configuração</label> 
        </div>
    </div>       


  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>    
</form>

