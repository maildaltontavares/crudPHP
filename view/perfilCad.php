<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/perfilCtr.php'; 
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00005');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Perfil de Acesso"'); 
     //exit; 
  endif; 
  
  include_once "menuNavCab.php";

  $Altera = "N";   
  $id = 0;
  $nomePerfil = '';
  $aIt = [];    
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     $_SESSION['aIt'] = "";

     $perfilCtr = new PerfilCtr();   
     $p_perfil = $perfilCtr->buscaPerfil($_GET['Id']);  
 
      if(!empty($p_perfil)): 

        $id = $p_perfil[0]['id'];  
        $nomePerfil = $p_perfil[0]['descricao'];  
        $aItem = $perfilCtr->listaItens($id);

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
      $perfilCtr = new PerfilCtr(); 
          
      if ($perfilCtr->delete($_POST['Idx'])== 'OK'):  
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

              $nomePerfil =  filter_input(INPUT_POST, 'nomePerfil',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nomePerfil,FILTER_SANITIZE_STRING)):
                     $erros[] = "Nome perfil inválido!";   
              elseif($nomePerfil==''):
                    $erros[] = "Nome perfil inválido!";                  
              endif;  

              if (empty($erros)):  // Nao tem erros de digitacao

                  $perfilCtr = new PerfilCtr();  
                  if ($Altera == "N"):

                      $date = date('YmdHis'); 
                      $chave =  '' . $date  ;
                      for ($i = 1; $i <= 3; $i++) {
                          $chave = $chave .  (string)random_int(100, 999);
                      }                     

                      if ($perfilCtr->create($nomePerfil,$aIt,$chave)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  

                          $aItem = $perfilCtr->buscaChave($chave);

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
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Perfil inválido!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($perfilCtr->update($id,$nomePerfil,$aIt)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $gravou = "S";  

                          $aItem = $perfilCtr->listaItens($id);

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
              addItem('','','Selecione a Função','Descrição da Função', 'pesquisaDescFuncSys','pesquisaFuncSys','ItFunc') ;
           });   

           
           array_itens = aItens.split("|");  

           var i=0;
           if (array_itens.length>1) {
               while (i < array_itens.length) {
                   
                        addItem(array_itens[i],array_itens[i+1],'Selecione a Função','Descrição da Função', 'pesquisaDescFuncSys','pesquisaFuncSys','ItFunc');
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
            <h1 class="p-3 mb-2  text-dark cTitulo">Perfis de acesso</h1>
            <div id="grupoBotoes">
 
               
              <?php 
                     $acesso->configura_botoes($validaAcesso,'perfilCad','lista_perfil',$excluiu,$Altera,$id,$gravou);
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 
        <div class="form-group col-md-8">
          <label for="perfil">Nome do perfil</label>  
          <input id="perfil" name ="nomePerfil" type="text" class="form-control"  required value="<?php  echo $nomePerfil;  ?>"       > 
          <input type="hidden"  class="form-control"  name="detalhe" id="detalhe" value=""  >
          <input type="hidden"  class="form-control"  name="numCampos" id="numCampos" value=""  >
        </div>   
    </div>    
    <label for="ItFunc">Funções</label> 
    <div class="form-row  dv-pesquisa">  
          <button type="button" id="novoItem" class="btn btn-primary " onclick="addItem('','','Selecione a Função','Descrição da Função', 'pesquisaDescFuncSys','pesquisaFuncSys','ItFunc')"  >Adicionar função</button>  
    </div>    
    <div class="nItem" id="ItFunc">
      

    </div> 
  </div> 

<?php

 
  include_once "menuNavRodape.php";
?>    
</form> 