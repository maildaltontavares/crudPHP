<?php
  
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php'; 
  require_once ROOT_PATH . '/controller/grupoTabelaCtr.php';   
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00007');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Grupo de tabela de usuario"'); 
     //exit; 
  endif;  


 // include_once "menuPrincipal.php";
 // include_once "menu.php"; 
  include_once "menuNavCab.php";
  $Altera = "N"; 

  $id = 0;
  $grupoTabela = ''; 
  $aTabela = [];
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $grupoTabelaCtr = new GrupoTabelaCtr();   
     $p_grupoTabela = $grupoTabelaCtr->buscaGrupoTabela($_GET['Id']);  

     //var_dump($p_grupoTabela);

      if(!empty($p_grupoTabela)):

        $id = $p_grupoTabela[0]['id'];  
        $grupoTabela = $p_grupoTabela[0]['descricao']; 
        $idTabela = $grupoTabelaCtr->listaTabelas($id);   
        
        $aTabela = [];

        for($i=0;$i<count($idTabela);$i++)
          {
             $aTabela[$i] = $idTabela[$i]['id'];
          } 
 
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $grupoTabelaCtr = new GrupoTabelaCtr(); 
          
      if ($grupoTabelaCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])): 


              $erros = array();              

              $grupoTabela =  filter_input(INPUT_POST, 'grupoTabela',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($grupoTabela,FILTER_SANITIZE_STRING)):
                     $erros[] = "Descrição inválida!";   
              elseif($grupoTabela==''):
                    $erros[] = "Descrição inválida!";                  
              endif;  

               if (isset($_POST['Tabela'])):
                   $idTabela =  $_POST['Tabela'];  
               else:
                    $idTabela =  [];
              endif; 

              if (empty($erros)):  // Nao tem erros de digitTabela

                  $grupoTabelaCtr = new GrupoTabelaCtr();  
                  if ($Altera == "N"):


                      $date = date('YmdHis'); 
                      $chave =  '' . $date  ;
                      for ($i = 1; $i <= 3; $i++) {
                          $chave = $chave .  (string)random_int(100, 999);
                      }                        

                      if ($grupoTabelaCtr->create($grupoTabela, $idTabela,$chave)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S"; 


                          $idTabela = $grupoTabelaCtr->buscaChave($chave);   

                          $aTabela = [];

                          for($i=0;$i<count($idTabela);$i++)
                            {
                               $aTabela[$i] = $idTabela[$i]['id'];
                            } 

                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro não gravado!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($grupoTabelaCtr->update($id,$grupoTabela, $idTabela)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $gravou = "S"; 


                          $idTabela = $grupoTabelaCtr->listaTabelas($id);   

                          $aTabela = [];

                          for($i=0;$i<count($idTabela);$i++)
                            {
                               $aTabela[$i] = $idTabela[$i]['id'];
                            } 

                          
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
   
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupo de Tabelas</h1>
            <div id="grupoBotoes">
            
              <?php

              $vBtNovo    = strpos($validaAcesso,"btNovo");
              $vBtExcluir = strpos($validaAcesso,"btExcluir");
              $vBtGravar  = strpos($validaAcesso,"btGravar");  
              
              if($vBtNovo>=0  and $vBtNovo!=false): 
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem" href="grupoTabelaCad.php?novo=S" role="button" id="btNovo" >Novo</a> ';

              else:
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem disabled" href="grupoTabelaCad.php?novo=S" role="button" id="btNovo"  >Novo</a> ';

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
                                  <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';
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
              else:
                          Echo '
                               <!-- Button trigger modal -->
                               <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" disabled>
                               Excluir
                              </button> ';                 
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
               <a href="lista_grupoTabela.php" class="btn btn-primary  paramBt">Pesquisar</a> ';
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="grupoTabela">Descrição</label>  
          <input id="grupoTabela" name ="grupoTabela" type="text" class="form-control"  required value="<?php  echo $grupoTabela;  ?>"       >   
        </div>

    </div>


    <div class="form-row"> 
        <div class="form-group col-md-6"> 
            <?php   

                Echo '<table class="table table-hover">    
                <thead>
                  <tr>
                    <th scope="col-4">Tabela</th>  
                    <th scope="col-1">De configuração</th>  
                    <th scope="col-1"></th>  
                  </tr>
                </thead>
                <tbody>';  
                 
                $tabela = new tabpadCtr();
                $aTabPad = $tabela->lerTodasGeral();    
                foreach($aTabPad as $p_tabela):  

                    $key = array_search($p_tabela['id'],  $aTabela);  

                    if (false !== $key):                      
                        echo '<tr>' . 
                        '<td>  ' . $p_tabela['descricao']  .'  </td>';
                        echo '<td>  ' . $p_tabela['tab_sistema']  .'  </td>';
                        echo '' .
                        '<td> <input type="checkbox" name="Tabela[]" value=' . $p_tabela['id'] . ' checked  ></td>' . 
                        '</tr>   '; 
                    else:                     
                        echo '<tr>' . 
                        '<td>  ' . $p_tabela['descricao']  .'  </td>';
                        echo  '<td>  ' . $p_tabela['tab_sistema']  .'  </td>';
                        echo '' .
                        '<td> <input type="checkbox" name="Tabela[]" value=' . $p_tabela['id'] . '    ></td>' . 
                        '</tr>   ';  
                    endif;  

                endforeach;   
               echo ' </tbody> </table>';  
               include_once "menuNavRodape.php";  
            ?>    

            
        </div>

        

    </div>  


  </div> 
</form>


