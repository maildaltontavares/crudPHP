<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/funcaoSistemaCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menuPrincipal.php";
  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
  $funcaoSistema = '';
  $sigla  = '';

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $funcaoSistema = new FuncaoSistemaCtr();   
     $p_funcaoSistema = $funcaoSistema->buscaFuncSys($_GET['Id']);  

     //var_dump($p_funcaoSistema);

      if(!empty($p_funcaoSistema)): 
        $id = $p_funcaoSistema[0]['id'];  
        $funcaoSistema = $p_funcaoSistema[0]['descricao'];    
       // $sigla = $p_funcaoSistema[0]['sigla'];    
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $funcaoSistema = new FuncaoSistemaCtr(); 
          
      if ($funcaoSistema->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $funcaoSistema =  filter_input(INPUT_POST, 'funcaoSistema',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($funcaoSistema,FILTER_SANITIZE_STRING)):
                     $erros[] = "Descrição inválida!";   
              elseif($funcaoSistema==''):
                    $erros[] = "Descrição inválida!";                  
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

                  $funcaoSistema = new FuncaoSistemaCtr();  
                  if ($Altera == "N"):

                      if ($funcaoSistema->create($funcaoSistema)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $_SESSION['gravou'] = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Grupo inválido!!"  . '</li></div>';                        
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  else:

                      if ($funcaoSistema->update($id,$funcaoSistema)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $_SESSION['gravou'] = "S"; 
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';
                          $_SESSION['gravou'] = "N";                  
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
          
          var vGrava    = "<?=((isset($_POST['gravar']))?"S":"N");?>";  
          var vCommit   = "<?=((isset($_SESSION['gravou']))?"S":"N");?>";
          var vAlterac  = "<?=((isset($_GET['Altera']   ))?"S":"N");?>";  
          var vNovo     = "<?=((isset($_GET['novo']))?"S":"N");?>";  
          var vExcluir  = "<?=$excluiu=='S'?"S":"N";?>";  

          if(vNovo=="S"){
            $('#btExcluir').attr('hidden', true);
          }   

          if(vExcluir=="S"){
            $('#btGravar').attr('disabled', true);
            $('#btExcluir').attr('disabled', true);
          }  

          if(vCommit=="S") {      
               vCommit = "<?=$_SESSION['gravou']?>";
          }  

          if(vGrava=="S"){    

               <?php $_SESSION['gravou'] = "N";?>

               if(vCommit=="S"){
                  //alert('Registro gravado com sucesso!');
                  $('#btGravar').attr('disabled', true); 

                  if(vAlterac=="S"){
                    $('#btGravar').attr('disabled', false);
                  }  
               }  
          }  

 })
</script> 

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class = 'container'>
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Funções do Sistema</h1>
            <div id="grupoBotoes">
               <a href="funcaoSistemaCad.php?novo=S" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>
 <!-- Button trigger modal -->
              <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" >
                Excluir
              </button> 
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
                                  <input type="hidden"  name="Idx" value= <?php echo $id;?>  >
                                  <button type="submit" class="btn btn-primary"  name="excluir" >Confirmar</button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>                
               <a href="lista_funcao.php" class="btn btn-primary  paramBt">Pesquisar</a> 
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="funcaoSistema">Descrição</label> 

          <input id="funcaoSistema" name ="funcaoSistema" type="text" class="form-control"   value="<?php  echo $funcaoSistema;  ?>"       >

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
</form>

