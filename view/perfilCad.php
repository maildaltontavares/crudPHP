<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/perfilCtr.php'; ;
  
   

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";

  $Altera = "N"; 

  $id = 0;
  $nomePerfil = '';
   

  if (isset($_GET['Altera'])):
     $Altera = "S";

     
  /*
   echo '<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';
 
    */ 
     $perfilCtr = new PerfilCtr();   
     $p_perfil = $perfilCtr->buscaPerfil($_GET['Id']);  

//     var_dump($_GET['Id']);

      if(!empty($p_perfil)): 
        $id = $p_perfil[0]['id'];  
        $nomePerfil = $p_perfil[0]['descricao'];    
        
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $perfilCtr = new PerfilCtr(); 
          
      if ($perfilCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nomePerfil =  filter_input(INPUT_POST, 'nomePerfil',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nomePerfil,FILTER_SANITIZE_STRING)):
                     $erros[] = "Nome perfil inválido!";   
              elseif($nomePerfil==''):
                    $erros[] = "Nome perfil inválido!";                  
              endif;  

              if (empty($erros)):  // Nao tem erros de digitacao

                  $perfilCtr = new PerfilCtr();  
                  if ($Altera == "N"):

                      if ($perfilCtr->create($nomePerfil)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $_SESSION['gravou'] = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Perfil inválido!!"  . '</li></div>';                        
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  else:

                      if ($perfilCtr->update($id,$nomePerfil)== 'OK'):  
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

 
    function fAbrejan(){
      window.open("pesquisa.php","_blank",'width=400px,height=300px');


    }

 </script>  

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Perfis de usuários</h1>
            <div id="grupoBotoes">
               <a href="perfilCad.php?novo=S" class="btn btn-primary paramBt">Novo</a>                       
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
               <a href="lista_perfil.php" class="btn btn-primary  paramBt">Pesquisar</a> 
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="perfil">Nome do perfil</label> 

          <input id="perfil" name ="nomePerfil" type="text" class="form-control"   value="<?php  echo $nomePerfil;  ?>"       >

        </div> 
 
      
    </div>   

    <div class="form-row"> 
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Adicionar função</button>

          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Selecione a Função</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <div class="modal-body">
                        
 
                              <form>
                                <div class="form-group"> 
                                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Descrição da Função">
                                </div>  
                              </form>


                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><a href="perfilCad.php?Id='  . $p_perfil['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>                                    
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td><a href="perfilCad.php?Id='  . $p_perfil['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>
                                    <td>Thornton</td>
                                    <td>@fat Mark Mark Mark </td>
                                    <td>Mark Mark Mark Mark </td>
                                    <td>Otto</td>
                                    <td>@mdo</td>                                    
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td><a href="perfilCad.php?Id='  . $p_perfil['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>                                    
                                  </tr>
                                </tbody>
                              </table>



                          Confirma ?
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <form >   
                                  <button type="submit" class="btn btn-primary"  name="excluir" >Confirmar</button> 
                          </form>
                        </div>


              </div>
            </div>
          </div>
    </div>   

<!--    
    <div class="form-row">       
 
           <a class="btn btn-primary" href="#abrirModal">Adicionar Função</a>
 
          <div id="abrirModal" class="modal1">
            <a href="#fechar" title="Fechar" class="fechar">x</a>
                  <div class="form-group col-md-8">
                    <label for="tabpad">Nome Grupo Tabela</label>

                    <input id="tabpad" name ="nometabpad" type="text" class="form-control"   value="zzz"       >

                  </div>

            <h2>Janela Modal</h2>
            <p>Esta é uma simples janela de modal.</p>
            <p>Você pode fazer qualquer coisa aqui, página de Login, pop-ups, ou formulários</p>

            <a class="btn btn-primary fechar" href="#fechar" title="Fechar" >Fechar</a>      


          </div>
    </div>                
-->
  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>    
</form>
<!--
         <div class="form-group col-md-8">
            <a href="" class="btn btn-primary" onclick="fAbrejan()">Adicionar Função</a>
        </div>    