<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
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

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $usuarioCtr = new UsuarioCtr();     
     $p_usuario = $usuarioCtr->buscaUsuario($_GET['Id']);   
      
      if(!empty($p_usuario)):
          $nome = $p_usuario[0]['nome'];
          $senha = $p_usuario[0]['senha'];
          $email = $p_usuario[0]['email'];
          $tel= $p_usuario[0]['tel'];
          $id = $_GET['Id'];       
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

              if (empty($erros)):  // Nao tem erros de digitacao

                  $usuarioCtr = new UsuarioCtr(); 
                  if ($Altera == "N"):

                      if ($usuarioCtr->create($nome,$senha,$email,$tel)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                          $_SESSION['gravou'] = "S";
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Usuario ou senha inválido!!"  . '</li></div>';           
                          $_SESSION['gravou'] = "N";       
                      endif;  

                  else:

                      if ($usuarioCtr->update($id,$nome,$senha,$email,$tel)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>';  
                          $_SESSION['gravou'] = "S";
                   
                          //header('Location:principal.php');   
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

<link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
<script type="text/javascript">
    function fAbrejan(){
      window.open("pesquisa.php","_blank","width=600,height=300,top=100,left=300");
    }

</script>

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script> 
  
  
  $(document).ready(function() { 

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
 
 
  }); 
</script>
<style>

  #frmcad{
    z-index: 1; 
  } 

</style>

 
<form method="POST" id="frmcad"> 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
      <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Usuarios</h1>
            <div id="grupoBotoes">
               <a href="usuarioCad.php?novo=S" class="btn btn-primary paramBt">Novo</a>                       
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

               <a href="lista_usuarios.php" class="btn btn-primary  paramBt">Pesquisar</a> 
            </div> 

        </div> 
      </div>
 
      <div class="form-row">


        <div class="form-group col-md-8">
          <label for="inputPassword4">Nome usuario</label>
          <input id="username" name ="username" type="text" class="form-control" value="<?php echo $nome;?>">
        </div>
       <!-- <div class="form-group col-md-1">
            <a href="" class="btn btn-primary" onclick="fAbrejan()" >Busca</a>
        </div>     -->

      </div>


      <div class="form-row"> 
        <div class="form-group col-md-6">
          <label for="inputPassword4">Password</label>
          <input type="password" name = "password" class="form-control" id="inputPassword4" value="<?php echo $senha;?>" > 
        </div>  
      </div>

      <div class="form-row">  
        <div class="form-group col-md-6">
          <label for="inputEmail4">Email</label>
          <input type="email" name = "email" class="form-control" id="inputEmail4" value="<?php echo $email;?>">       
        </div> 
      </div>


      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">Fone</label>
          <input name ="tel" type="text" class="form-control" value="<?php echo $tel;?>"> 
        </div> 
      </div>


  </div> 
</form>

<!--
<div class="form-row" id="painel">
  <div class="form-group col-md-6" >  
      <p id="col1">xxx</p>
  </div>
  <div class="form-group col-md-6">  
    <p id="col2">yyy</p>
  </div>
  <div class="form-group col-md-6">  
    <p id="col3"></p>
  </div>  
 
</div>
-->

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";

?>  