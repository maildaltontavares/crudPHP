<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  include_once "menuHome.php";
  include_once "menu.php"; 

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



  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nome = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);  
              if(!filter_var($nome,FILTER_SANITIZE_STRING)):
                  $erros[] = "Usuario inválido!";              
              endif;    


              $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL); 
              if(!filter_var($email,FILTER_SANITIZE_EMAIL)):
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
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Usuario ou senha inválido!!"  . '</li></div>';                  
                      endif;  

                  else:

                      if ($usuarioCtr->update($id,$nome,$senha,$email,$tel)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>';  
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';                  
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

<style>

  #frmcad{
    z-index: 1; 
  }
  

</style>

 
<form method="POST" id="frmcad"> 
  <div class = 'container'>
    
      <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Usuarios</h1>
            <div id="grupoBotoes">
               <a href="usuarioCad.php" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt">Gravar</button>
               <a href="lista_usuarios.php" class="btn btn-primary  paramBt">Voltar</a> 
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

  include_once "footer.php";

?>  