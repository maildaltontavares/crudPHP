<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/grupoUsuarioCtr.php'; ;
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00006');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Grupo de tabela de usuario"'); 
     //exit; 
  endif;
  
  include_once "menuNavCab.php";

  $Altera = "N";   
  $id = 0;
  $nomeGrupoUsuario = '';
  $aIt = [];    
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     $_SESSION['aIt'] = "";

     $grupoUsuarioCtr = new GrupoUsuarioCtr();   
     $p_grupoUsuario = $grupoUsuarioCtr->buscaGrupoUsuario($_GET['Id']);  
 
      if(!empty($p_grupoUsuario)): 

        $id = $p_grupoUsuario[0]['id'];  
        $nomeGrupoUsuario = $p_grupoUsuario[0]['descricao'];  
        $aItem = $grupoUsuarioCtr->listaItens($id);

        //var_dump($aItem);
        $string_array = "";
        $z=0;

        foreach ($aItem as $itens)
        {  
             
            if ( $z!=0):
              $string_array = $string_array . '|';
            endif;
            $string_array = $string_array . implode("|", $itens);
            $z = $z + 1; 
        }  

        //var_dump($itens);
        //var_dump($string_array);
        $_SESSION['aIt'] = $string_array;    
        
      endif;  
  endif;  


  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $grupoUsuarioCtr = new GrupoUsuarioCtr(); 
          
      if ($grupoUsuarioCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):   
              
              //Monta Array com campos dinamicos
              $nIt = $_POST['numCampos'];  
              $nIt = trim($nIt); 
              $aIt = [];
              $inicio = 0; 
              $nInd=0;
             

              while ( strlen($nIt) > 0) { 
                  $car = "*;*"; 
                  $fim = strpos($nIt  , $car);   
                  $vIt = substr($nIt, $inicio,$fim);   
                  if (isset($_POST['fItem' . $vIt])):                     
                      $aIt[$nInd] = $_POST['fItem' . $vIt]; 
                      if($aIt[$nInd]!=""):
                         $nInd = $nInd + 1 ;
                    endif;
                  endif;    
                  if(strlen($nIt) > 3):
                     $nIt = substr($nIt,$fim+3,strlen($nIt)-3); 
                  else:    
                     $nIt = '';
                  endif;   
                 
              }; 
              //var_dump($aIt);

              $erros = array();

              $nomeGrupoUsuario =  filter_input(INPUT_POST, 'nomeGrupoUsuario',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nomeGrupoUsuario,FILTER_SANITIZE_STRING)):
                     $erros[] = "Nome grupo inválido!";   
              elseif($nomeGrupoUsuario==''):
                    $erros[] = "Nome grupo inválido!";                  
              endif;  

              if (empty($erros)):  // Nao tem erros de digitacao

                  $grupoUsuarioCtr = new GrupoUsuarioCtr();  
                  if ($Altera == "N"):

                      $date = date('YmdHis'); 
                      $chave =  '' . $date  ;
                      for ($i = 1; $i <= 3; $i++) {
                          $chave = $chave .  (string)random_int(100, 999);
                      }                     

                      if ($grupoUsuarioCtr->create($nomeGrupoUsuario,$aIt,$chave)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  

                          $aItem = $grupoUsuarioCtr->buscaChave($chave);

                          $string_array = "";
                          $z=0;

                          foreach ($aItem as $itens)
                          {  
                              //var_dump($itens);
                              if ( $z!=0):
                                $string_array = $string_array . '|';
                              endif;
                              $string_array = $string_array . implode("|", $itens);
                              $z = $z + 1; 
                          }  

                          //var_dump($itens);
                          //var_dump($string_array);
                          $_SESSION['aIt'] = $string_array;
                          
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "grupo inválido!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($grupoUsuarioCtr->update($id,$nomeGrupoUsuario,$aIt)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $gravou = "S";  

                          $aItem = $grupoUsuarioCtr->listaItens($id);

                          //var_dump($aItem);
                          $string_array = "";
                          $z=0;

                          foreach ($aItem as $itens)
                          {  
                               
                              if ( $z!=0):
                                $string_array = $string_array . '|';
                              endif;
                              $string_array = $string_array . implode("|", $itens);
                              $z = $z + 1; 
                          }  

                          //var_dump($itens);
                          //var_dump($string_array);
                          $_SESSION['aIt'] = $string_array;                          


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
  else: 
     $_SESSION['numFunc'] =0;  
     if (!isset($_GET['Altera'])):     
         $_SESSION['aIt'] = "";
     endif;    
  endif;  


  ?>

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous">
  
 </script>

<script type="text/javascript" src="pesqItem.js"></script>  

<script> 

  /* NOVOiTEM*/
function addItem(p_id,p_descricao, p_descSelecione, p_descPlacHld,pageDesc,pageDiv,divDetalhe){
    novoItem(p_id,p_descricao, p_descSelecione, p_descPlacHld,pageDesc,pageDiv,divDetalhe) ;

}
var numCampo;
$(document).ready(function(){

          numCampo      = "<?php echo $_SESSION['numFunc']; ?>";   
          var aItens    = "<?php echo $_SESSION['aIt']; ?>";

          $("#novoItem").bind("click", function(){
              addItem('','','Selecione o perfil','Descrição do Grupo', 'pesquisaDescPerfil','pesquisaPerfil','nItem') ;
           });   

           
           array_itens = aItens.split("|");  
           var i=0;
           if (array_itens.length>1) {
               while (i < array_itens.length) {                   
                        addItem(array_itens[i],array_itens[i+1],'Selecione o perfil','Descrição do perfil', 'pesquisaDescPerfil','pesquisaPerfil','nItem');
                        i=i+2;  
                } 
           }
                
                  
 })


    </script> 
 

<link rel="stylesheet" type="text/css" href="estiloVirtuax.css"> 

<form method="POST" onsubmit="montaItens();" id="formCadastro"> 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupo de Perfil</h1>
            <div id="grupoBotoes">
              <?php 

                     $acesso->configura_botoes($validaAcesso,'grupoUsuarioCad','lista_grupoUsuario',$excluiu,$Altera,$id,$gravou);
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="grupo">Nome do grupo</label>  
          <input id="grupo" name ="nomeGrupoUsuario" type="text" class="form-control"  required value="<?php  echo $nomeGrupoUsuario;  ?>"       > 
          <input type="hidden"  class="form-control"  name="detalhe" id="detalhe" value=""  >
          <input type="hidden"  class="form-control"  name="numCampos" id="numCampos" value=""  >
        </div>   
    </div>    
    <label for="nItem">Perfis</label> 
    <div class="form-row  dv-pesquisa">  
          <button type="button" id="novoItem" class="btn btn-primary " onclick="addItem('','','Selecione o perfil','Descrição do perfil', 'pesquisaDescPerfil','pesquisaPerfil','nItem')"  >Adicionar Perfil</button>  
    </div>    
    <div class="nItem" id="nItem">
      

    </div> 
  </div> 

<?php

 
  include_once "menuNavRodape.php";
?>    
</form> 