<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/grupoEmpresaCtr.php'; 
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00009');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Grupo de Empresarial"'); 
     //exit; 
  endif; 


  //include_once "menuPrincipal.php";
  //include_once "menu.php";   

  include_once "menuNavCab.php";
  $Altera = "N"; 

  $id = 0;
  $nomeGrupoEmpresa = '';
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $grupoEmpresarialCtr = new grupoEmpresaCtr();   
     $p_grupoEmpresa = $grupoEmpresarialCtr->buscaGrupoEmpresa($_GET['Id']);  

     //var_dump($p_grupoEmpresa);

      if(!empty($p_grupoEmpresa)): 
        $id = $p_grupoEmpresa[0]['id'];  
        $nomeGrupoEmpresa = $p_grupoEmpresa[0]['descricao'];    
        
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $grupoEmpresarialCtr = new grupoEmpresaCtr(); 
          
      if ($grupoEmpresarialCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nomeGrupoEmpresa =  filter_input(INPUT_POST, 'nomeGrupoEmpresa',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nomeGrupoEmpresa,FILTER_SANITIZE_STRING)):
                    $erros[] = "Nome grupo Empresarial inválido!";   
              elseif($nomeGrupoEmpresa==''):
                    $erros[] = "Nome grupo Empresarial inválido!";                  
              endif;   

              /*
              $sigla =  filter_input(INPUT_POST, 'sigla',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($sigla,FILTER_SANITIZE_STRING)):
                  $erros[] = "Sigla inválida!";          
              elseif($sigla==''):
                  $erros[] = "Sigla inválida!";                             
              endif; 
              */


              if (empty($erros)):  // Nao tem erros de digitacao

                  $grupoEmpresarialCtr = new grupoEmpresaCtr();  
                  if ($Altera == "N"):

                      if ($grupoEmpresarialCtr->create($nomeGrupoEmpresa )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Grupo inválido!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($grupoEmpresarialCtr->update($id,$nomeGrupoEmpresa )== 'OK'):  
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

 

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupo Empresarial</h1>
            <div id="grupoBotoes">  
              <?php


              $vBtNovo    = strpos($validaAcesso,"btNovo");
              $vBtExcluir = strpos($validaAcesso,"btExcluir");
              $vBtGravar  = strpos($validaAcesso,"btGravar");  
              
              if($vBtNovo>=0  and $vBtNovo!=false): 
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem" href="grupoEmpresaCad.php?novo=S" role="button" id="btNovo" >Novo</a> ';

              else:
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem disabled" href="grupoEmpresaCad.php?novo=S" role="button" id="btNovo"  >Novo</a> ';

              endif;

              if($vBtGravar>=0 and $vBtGravar!=false):
                  if($excluiu=='S'):
                     Echo ' 
                      <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';
                  else:
                      if($Altera == "S"):  
                            Echo ' 
                                     <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>'; 
                      else: // Inclusão

                         //if ($gravou)=='S'):
                        if ($gravou == "S"):
                             if($Altera == "S"):
                                 Echo ' 
                                  <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar"   >Gravar</button>';
                             else:
                                 Echo ' 
                                  <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';                             
                             endif;      
                         else:
                              Echo ' 
                             <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>';
                         endif;   
                      endif;
                  endif;   
              else:
                     Echo ' 
                      <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';
              endif; 

 


              if($vBtExcluir>=0 and $vBtExcluir!=false):   
                   if(isset($_GET['novo'])):   

                   
                       if ($_GET['novo']!='S'):
                             Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal"  disabled>
                                   Excluir
                                  </button> ';
                       endif;
                   
                   else:
                       if($excluiu=='S'):
                              Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" disabled>
                                   Excluir
                                  </button> ';

                       else:
                              Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" >
                                   Excluir
                                  </button> ';
                       endif;           
                   endif; 
                              
               endif;

              echo '
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Exclusão</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Confirma ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <form >
                                  <input type="hidden"  name="Idx" value= ' .   $id    . '>
                                  <button type="submit" class="btn btn-primary"  name="excluir" >Confirmar</button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>                
               <a href="lista_grupoEmpresa.php" class="btn btn-primary  paramBt">Pesquisar</a> ';
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="grupoEmpresa">Nome Grupo Empresarial</label> 
          <input id="grupoEmpresa" name ="nomeGrupoEmpresa" type="text" class="form-control" required  value="<?php  echo $nomeGrupoEmpresa;  ?>" >
        </div>
    </div>  
    <!--
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="sigla">Sigla</label> 

          <input id="sigla" name ="sigla" type="text" class="form-control"   value="<?php  echo $sigla;  ?>"       >

        </div>
    </div>      
    -->

  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>    
</form>

