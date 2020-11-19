<?php 
 
  session_start(); 

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioCtr.php';  
  require_once ROOT_PATH . '/controller/filialCtr.php';  
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00008');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Cadastro de usuarios"'); 
     //exit; 
  endif; 

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";

  $Altera = "N";

  $nome = '';
  $senha = '';
  $email = '';
  $tel = '';
  $id = 0;   
  $aIt = [];  
  $filPad = 0;
  $aFilialUsu = [];
  $filPad=0;
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     $_SESSION['aIt'] = "";
     $_SESSION['aFilUsu'] = "";
     
     $usuarioCtr = new UsuarioCtr();     
     $p_usuario = $usuarioCtr->buscaUsuario($_GET['Id']);   

      if(!empty($p_usuario)):
          $nome = $p_usuario[0]['nome'];
          $senha = $p_usuario[0]['senha'];
          $email = $p_usuario[0]['email'];
          $tel= $p_usuario[0]['tel'];
          $id = $_GET['Id'];   
          $filPad =$p_usuario[0]['filpad']; 

          $aItem = $usuarioCtr->listaItens($id);

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

        $aFilialUsuario = $usuarioCtr->buscaFilialUsuario($_GET['Id']);    
        $aFilialUsu = [];
        
        for($i=0;$i<count($aFilialUsuario);$i++)

          
          { 
             $aFilialUsu[$i] = $aFilialUsuario[$i]['id'];
          } 

        //var_dump($filPad);
        //var_dump($string_array);
        $_SESSION['aIt'] = $string_array;
        $_SESSION['aFilUsu'] = $aFilialUsu;

        //var_dump($aFilialUsu);


      endif;  

  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
     $usuarioCtr = new UsuarioCtr();   

      if ($usuarioCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 
  endif;


  if (isset($_POST['gravar'])):
     
              $nIt = $_POST['numCampos'];  
              $nIt = trim($nIt); 
              $aIt = [];
              $inicio = 0; 
              $nInd=0;             

              //var_dump($_POST['numCampos']);
              //var_dump($_POST['fItem1']);
              //var_dump($_POST['fItem2']);

              while ( strlen($nIt) > 0) { 
                  $car = "*;*"; 
                  $fim = strpos($nIt  , $car);   
                  $vIt = substr($nIt, $inicio,$fim);   

                               //var_dump($vIt);

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

              $erros = array();
              $nome = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);  
              if(!filter_var($nome,FILTER_SANITIZE_STRING)):
                  $erros[] = "Usuario inválido!";              
               elseif($nome==''):
                    $erros[] = "Usuario inválido!";                 
              endif;     


              $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL); 
              if(!filter_var($email,FILTER_SANITIZE_EMAIL)):
                  $erros[] = "Email inválido!";              
               elseif($email==''):
                    $erros[] = "Email inválido!";                 
              endif;    


              $senha = $_POST['password'];  
              if (empty($senha) or is_null($senha)):
                  $erros[] = "Senha inválida!";
              endif;

     
              $tel = $_POST['tel'];  
              if (empty($tel) or is_null($tel)):
                  $erros[] = "Fone inválido!";
              endif;

               if (isset($_POST['FilialUsu'])):
                   $vFilUsu =  $_POST['FilialUsu'];  
               else:
                    $vFilUsu =  [];
              endif; 

              $filPad =  $_POST['filialPad'];  

               

              //var_dump($vFilUsu);

              if (empty($erros)):  // Nao tem erros de digitacao

                  $usuarioCtr = new UsuarioCtr(); 
                  if ($Altera == "N"):

                      $date = date('YmdHis'); 
                      $chave =  '' . $date  ;
                      for ($i = 1; $i <= 3; $i++) {
                          $chave = $chave .  (string)random_int(100, 999);
                      }                      


                      //var_dump($aIt);
                      //var_dump($chave);

                      if ($usuarioCtr->create($nome,md5($senha),$email,$tel,$aIt,$chave,$vFilUsu,$filPad)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                          //$gravou = "S";
                          $gravou = 'S';

                          $aItem = $usuarioCtr->buscaChave($chave);   
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

                          //var_dump("xxx");
                          //var_dump($string_array );


                          $aFilialUsuario = $usuarioCtr->buscaChaveFilialUsuario($chave);    
                          $aFilialUsu = [];
                          
                          for($i=0;$i<count($aFilialUsuario);$i++)   
                            { 
                               $aFilialUsu[$i] = $aFilialUsuario[$i]['id'];
                            }                           
  
                          $_SESSION['aIt'] = $string_array;
                          $_SESSION['aFilUsu'] = $aFilialUsu;
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Usuario ou senha inválido!!"  . '</li></div>';           
                          $gravou = "N";       
                      endif;  

                  else:

                      //var_dump($aIt);
              
                      if ($usuarioCtr->update($id,$nome,md5($senha),$email,$tel,$aIt,$vFilUsu,$filPad )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>';  
                          //$gravou = "S";
                          $gravou = 'S';


                          $aItem = $usuarioCtr->listaItens($id);

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

                          $aFilialUsuario = $usuarioCtr->buscaFilialUsuario($_GET['Id']);    
                          $aFilialUsu = [];
                          
                          for($i=0;$i<count($aFilialUsuario);$i++)  
                            {
                              

                               $aFilialUsu[$i] = $aFilialUsuario[$i]['id'];
                            }                           
 
                          $_SESSION['aIt'] = $string_array;
                          $_SESSION['aFilUsu'] = $aFilialUsu; 

                   
                          //header('Location:principal.php');   
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

<link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
<script type="text/javascript">
    function fAbrejan(){
      window.open("pesquisa.php","_blank","width=600,height=300,top=100,left=300");
    }

</script>

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script type="text/javascript" src="pesqItem.js"></script>  

<script> 
  
  function addItem(p_id,p_descricao, p_descSelecione, p_descPlacHld,pageDesc,pageDiv,divDetalhe){
    novoItem(p_id,p_descricao, p_descSelecione, p_descPlacHld,pageDesc,pageDiv,divDetalhe) ;

  }
  var numCampo;
  
  $(document).ready(function() { 

        numCampo      = "<?php echo $_SESSION['numFunc']; ?>";    
        var aItens    = "<?php echo $_SESSION['aIt']; ?>";  

        $("#novoItem").bind("click", function(){
            addItem('','','Selecione o Grupo','Descrição do grupo', 'pesquisaDescGrupoUsuario','pesquisaGrupoUsuario','nGrupo') ;
        }); 
           
        array_itens = aItens.split("|");  

        var i=0;
        if (array_itens.length>1) {
               while (i < array_itens.length) {                   
                  addItem(array_itens[i],array_itens[i+1],'Selecione o Grupo','Descrição do grupo', 'pesquisaDescGrupoUsuario','pesquisaGrupoUsuario','nGrupo');
                        i=i+2; 
                } 
          }  
 
 
  }); 
</script>
<style>

  #frmcad{
    z-index: 1; 
  } 

</style>

 
<form method="POST" onsubmit="montaItens();" id="formCadastro"> 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
      <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Usuarios</h1>
            <div id="grupoBotoes">
               
              <?php

                   $acesso->configura_botoes($validaAcesso,'usuarioCad','lista_usuarios',$excluiu,$Altera,$id,$gravou);
              
               ?>
            </div> 

        </div> 
      </div>
 
      <div class="form-row">


        <div class="form-group col-md-8">
          <label for="inputPassword4">Nome usuario</label>
          <input id="username" name ="username" type="text" class="form-control" required value="<?php echo $nome;?>">
        </div>
       <!-- <div class="form-group col-md-1">
            <a href="" class="btn btn-primary" onclick="fAbrejan()" >Busca</a>
        </div>     -->

      </div>


      <div class="form-row"> 
        <div class="form-group col-md-6">
          <label for="inputPassword4">Password</label>
          <input type="password" name = "password" class="form-control" required  id="inputPassword4" value="<?php echo $senha;?>" > 
        </div>  
      </div>

      <div class="form-row">  
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" name = "email" class="form-control" required  id="inputEmail4" value="<?php echo $email;?>">       
        </div> 
      </div>


      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">Fone</label>
          <input name ="tel" type="text" class="form-control" required  value="<?php echo $tel;?>"> 
        </div> 
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
      

            <label for="filialPad">Filial Padrão</label>  
            <select class="form-control" id="filialPad" name="filialPad" >  
            <?php 

                 $filial = new FilialCtr();               
                 $aFilP = $filial->lerTodas();  

                //var_dump($aFilP) ;
                //var_dump($filPad) ;
  
                foreach($aFilP as $p_f): 

                    if ($p_f['id'] ==  $filPad ):
                      echo ' <option value=' . $p_f['id']  . ' selected >' . $p_f['descricao']  .'</option>';  
                    else:  
                      echo ' <option value=' . $p_f['id']  . ' >' . $p_f['descricao']  .'</option>';  
                    endif;  

                endforeach;
  
            ?>             


            </select> 
        </div>                    
    </div>        

          <input type="hidden"  class="form-control"  name="detalhe" id="detalhe" value=""  >
          <input type="hidden"  class="form-control"  name="numCampos" id="numCampos" value=""  >



        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#grupos" role="tab" aria-controls="home" aria-selected="true">Grupos</a>
          </li>

        <!--  
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#perfis" role="tab" aria-controls="profile" aria-selected="false">Perfis</a>
          </li>
          -->          
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#filiais" role="tab" aria-controls="profile" aria-selected="false">Filiais</a>
          </li>   
      
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="grupos" role="tabpanel" aria-labelledby="home-tab">
              
              <div class="form-row  dv-pesquisa">  
                    <button type="button" id="novoItem" class="btn btn-primary " onclick="addItem('','','Selecione o Grupo','Descrição do grupo', 'pesquisaDescGrupoUsuario','pesquisaGrupoUsuario','nGrupo')"  >Novo Grupo</button>  
              </div>    
              <div class="nGrupo" id="nGrupo"> 
              </div> 


          </div>  

          <div class="tab-pane fade" id="filiais" role="tabpanel" aria-labelledby="home-tab">
              
              <div class="form-row  dv-pesquisa">   


                 <?php   

                      Echo '<table class="table table-hover">    
                      <thead>
                        <tr>
                          <th scope="col-1">Ação</th>  
                          <th scope="col-1"></th>  
                        </tr>
                      </thead>
                      <tbody>';  

                      //$filial = new FilialCtr();               
                      $aFil = $filial->lerTodas();  


                      foreach($aFil as $p_fil):  
                          $key = array_search($p_fil['id'],  $aFilialUsu);  
                          if (false !== $key): 
                           
                              echo '<tr>' . 
                              '<td>  ' . $p_fil['descricao']  .'  </td>';
                              echo '' .
                              '<td> <input type="checkbox" name="FilialUsu[]" value=' . $p_fil['id'] . ' checked  ></td>' . 
                              '</tr>   ';  
                          else:
                        
                              echo '<tr>' . 
                              '<td>  ' . $p_fil['descricao']  .'  </td>';
                              echo '' .
                              '<td> <input type="checkbox" name="FilialUsu[]" value=' . $p_fil['id'] . '    ></td>' . 
                              '</tr>   ';                    
                          
                          endif;  

                      endforeach; 


                     echo ' </tbody> </table>';  
                     include_once "menuNavRodape.php";  
                     //$gravou = "N"; // Novo Metodo seguranca
                  ?>  


              </div>   


              <div class="nFiliais" id="nFiliais"> 




              </div> 


          </div>      

             
<!--
        </div> 
-->

  </div> 

 


</div>

</form>

 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";

?>  