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
  
     $perfilCtr = new PerfilCtr();   
     $p_perfil = $perfilCtr->buscaPerfil($_GET['Id']);  
 
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

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous">
  
 </script>

<script type="text/javascript" src="func.js"></script>    
<script>

var numCampo  = 0;    
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

   

    function novaFuncao(){ 

      numCampo = numCampo + 1; 

      var TxtBtTxt = '<div class="form-row">'+ 
      '<div class="form-inline ">' +
        '<input type="text" id= "func' + numCampo.toString() + '" class="form-control btPesq  " >' +
      '</div>'+
       '<button type="button" class="btn btn-primary btPesq" data-toggle="modal" data-target=".bd-example-modal-lg' + numCampo.toString() + '" onclick="limpaTela(\''+ numCampo.toString() + '\')" id= "funcao' + numCampo.toString() + '"  >...</button></br> '   +
      '<div class="col-md-3">'+
        '<input class="form-control " type="text" id="desc' + numCampo.toString() + '" value="" disabled>'+ 
      '</div>';


      var pesq = TxtBtTxt + //'<div class="form-row">'+
        //'<div class="form-group col-md-2">'+               
                //'<input type="text" id= "func' + numCampo.toString() + '" class="form-control" >' +  
               // '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg' + numCampo.toString() + '" onclick="limpaTela(\''+ numCampo.toString() + '\')" id= "funcao' + numCampo.toString() + '"  >...</button></br> '+
                '<div class="modal fade bd-example-modal-lg' + numCampo.toString() + '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                   '<div class="modal-dialog modal-lg">'+
                       '<div class="modal-content"><div class="modal-header">'+
                           '<h5 class="modal-title" id="exampleModalLabel">Selecione a Função</h5>'+
                           '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                           '<span aria-hidden="true">&times;</span></button>'+
                       '</div>'+
                       '<div class="modal-body">'+  
                                      '<form name="form_pesquisa" id="form_pesquisa" method="post" action=""> '+ 
                                          '<fieldset> ' +
                                              ' <legend>Digite o nome da função a pesquisar</legend> ' +
                                                  ' <div class="input-prepend"> ' +
                                                      ' <span class="add-on"><i class="icon-search"></i></span> ' +

                                                       '<div class="form-row">'+
                                                             '<div class="form-group col-md-10">'+
                                                                 ' <input type="text" class="form-control" name="pesquisaCmp' + numCampo.toString() + '" id="pesquisaCmp' + numCampo.toString() + '" value=""  ' +
                                                                 'tabindex="1" placeholder="Descrição da Função" /> ' +
                                                             '</div>'+
                                                       '</div>'+  
                                                      
                                                   '</div> ' +

                                                   '<div class="form-group col-md-2">'+
                                                   '      <button type="button" class="btn btn-primary" onclick="buscarDado(\''+ numCampo.toString() + '\')" id="busca"  >Pesquisar</button>'+
                                                   '</div>'+                                                    
                                          '</fieldset>'+
                                      '</form>' + 
                                      '<div id="contentLoading"> ' +
                                          '<div id="loading"></div> '+
                                      '</div> '+
                                      '<section class="jumbotron"> '+
                                          ' <div id="MostraPesq' + numCampo.toString() + '"></div>'+
                                      '</section> '+ 
                       '</div>'+
                       '<div class="modal-footer">'+
                      '       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>'+
                            '<button type="button" class="btn btn-primary" data-dismiss="modal" name="confirmar" onclick="gravaNum(\''+ numCampo.toString() + '\')" >Confirmar</button>'+
  
                      ' </div>'+
                   '</div>'+                 
                '</div>'+ 
            '</div>'+             
        '</div>'+
  '</div>' ;
  
    $(".nFuncao").append(pesq); 
     
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

   

 

    <div class="form-row  dv-pesquisa"> 

          <button type="button" class="btn btn-primary "   onclick="novaFuncao()">Adicionar função</button>
       
    </div>   

    <div class="nFuncao">
      

    </div> 
  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>    
</form> 