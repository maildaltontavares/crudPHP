<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/funcaoSistemaCtr.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php';  

  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menuPrincipal.php";
  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
  $funcaoSistema = '';
  $sigla  = '';
  $idfunc =0;
  $aAcao = [];

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $funcaoSistemaCtr = new FuncaoSistemaCtr();   
     $p_funcaoSistema = $funcaoSistemaCtr->buscaFuncaoSistema($_GET['Id']);  

     //var_dump($p_funcaoSistema);

      if(!empty($p_funcaoSistema)):

        $id = $p_funcaoSistema[0]['id'];  
        $funcaoSistema = $p_funcaoSistema[0]['descricao']; 
        $idfunc = $p_funcaoSistema[0]['idfunc'];
        $idAcao = $funcaoSistemaCtr->listaAcao($id);   

        $aAcao = [];

        for($i=0;$i<count($idAcao);$i++)
          {
             $aAcao[$i] = $idAcao[$i]['id'];
          } 
 
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $funcaoSistemaCtr = new FuncaoSistemaCtr(); 
          
      if ($funcaoSistemaCtr->delete($_POST['Idx'])== 'OK'):  
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

               $idfunc =  $_POST['Funcao'];  

               if (isset($_POST['Acao'])):
                   $idAcao =  $_POST['Acao'];  
               else:
                    $idAcao =  [];
              endif; 

              if (empty($erros)):  // Nao tem erros de digitacao

                  $funcaoSistemaCtr = new FuncaoSistemaCtr();  
                  if ($Altera == "N"):


                      $date = date('YmdHis'); 
                      $chave =  '' . $date  ;
                      for ($i = 1; $i <= 3; $i++) {
                          $chave = $chave .  (string)random_int(100, 999);
                      }                        

                      if ($funcaoSistemaCtr->create($funcaoSistema,$idfunc,$idAcao,$chave)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $_SESSION['gravou'] = "S"; 


                          $idAcao = $funcaoSistemaCtr->buscaChave($chave);   

                          $aAcao = [];

                          for($i=0;$i<count($idAcao);$i++)
                            {
                               $aAcao[$i] = $idAcao[$i]['id'];
                            } 

                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro não gravado!!"  . '</li></div>';                        
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  else:

                      if ($funcaoSistemaCtr->update($id,$funcaoSistema,$idfunc,$idAcao)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $_SESSION['gravou'] = "S"; 


                          $idAcao = $funcaoSistemaCtr->listaAcao($id);   

                          $aAcao = [];

                          for($i=0;$i<count($idAcao);$i++)
                            {
                               $aAcao[$i] = $idAcao[$i]['id'];
                            } 

                          
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



        <div class="form-group col-md-8">
            <label for="selecioneFuncao">Função</label>  
            <select class="form-control" id="selecioneFuncao" name="Funcao" >  
            <?php 

                $tabela = new tabelaCtr();               
                $aTabFunc = $tabela->buscaTabelaSigla('funcSys'); 

                //var_dump($aTab) ;
  
                foreach($aTabFunc as $p_tabela):

                    if ($p_tabela['id'] ==  $idfunc ):
                      echo ' <option value=' . $p_tabela['id']  . ' selected >' . $p_tabela['descricao']  .'</option>';  
                    else:  
                      echo ' <option value=' . $p_tabela['id']  . ' >' . $p_tabela['descricao']  .'</option>';  
                    endif;  

                endforeach;
  
            ?>             


            </select> 
        </div>  
    </div>
    <div class="form-row"> 
        <div class="form-group col-md-1"> 
            <?php   

                Echo '<table class="table table-hover">    
                <thead>
                  <tr>
                    <th scope="col-1">Ação</th>  
                    <th scope="col-1"></th>  
                  </tr>
                </thead>
                <tbody>';  

                $aTabBot = $tabela->buscaTabelaSigla('botSys');  
                foreach($aTabBot as $p_tabela):  
                    $key = array_search($p_tabela['id'],  $aAcao);  
                    if (false !== $key):
                   //   echo '<tr>' .
                  //'<td> <input type="checkbox" name="Acao[]" value=' . $p_tabela['id'] . ' checked  ><label>' . $p_tabela['descricao']  .'</label> </td></tr> ';
                     
                      echo '<tr>' . 
                      '<td>  ' . $p_tabela['descricao']  .'  </td>';
                      echo '' .
                      '<td> <input type="checkbox" name="Acao[]" value=' . $p_tabela['id'] . ' checked  ></td>' . 
                      '</tr>   ';
    

                     //echo ' <option value=' . $p_tabela['id']  . ' selected >' . $p_tabela['descricao']  .'</option>';  
                    else:
                      //echo '<tr>' .
                    //'<td> <input type="checkbox" name="Acao[]" value=' . $p_tabela['id']  . ' ><label>' . $p_tabela['descricao']  .'</label> </td></tr>';
                      echo '<tr>' . 
                      '<td>  ' . $p_tabela['descricao']  .'  </td>';
                      echo '' .
                      '<td> <input type="checkbox" name="Acao[]" value=' . $p_tabela['id'] . '    ></td>' . 
                      '</tr>   ';                    
                    
                    endif;  

                endforeach; 


               echo ' </tbody> </table>';    
            ?>    

            
        </div>

        

    </div>  


  </div> 
</form>

