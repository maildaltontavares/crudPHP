<?php

  //require_once './../../controller/usuarioCtsr.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php'; 

  session_start();
  //session_unset();
  //session_destroy();
  //session_start(); 

  include_once "menu.php"; 

  if (isset($_POST['excluir'])):
        $usuarioCtr = new UsuarioCtr(); 
          
        if ($usuarioCtr->delete($_POST['Idexc'])== 'OK'):  
           echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!!"  . '</li></div>';
        endif;	 
  	 	
  endif;

  $p_id = 0;
  if (isset($_GET['Id'])):

  	$p_id = $_GET['Id'];

  	echo '<form method= "POST">';
	  	echo '<h1>Confirma exclusao do registro >> ' . $_GET['Id'] . ' ?</h1>';
	  	echo '
	        <div class="form-row">
	          <div class="form-group col-md-1">  
				  <input type="hidden"  name="Idexc" value='  . $p_id . '>
	              <div class="col-3"><button type="submit" name= "excluir" class="btn btn-primary">Excluir</button></div>
	          </div> 
	          <div class="form-group col-md-1">

	              <a href="lista_usuarios.php" class="btn btn-primary">Voltar</a>
	          </div> 
	 
	        </div>'; 


	echo '</form>';
  endif;

?> 




<?php

  include_once "footer.php";

?>  