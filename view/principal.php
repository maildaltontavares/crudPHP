<?php
 
  session_start();

  /*
  if (!isset($_SESSION['user'])) :

        echo '<div class="alert alert-primary" role="alert"><li>' . " Nao achei sessao!!"  . '</li></div>';

  else:
  	    echo '<div class="alert alert-primary" role="alert"><li>' . $_SESSION['user']  . '</li></div>';
  endif;
 */

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

?>


 
<?php
  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";
  
  //include_once "footer.php";
  include_once "menuNavRodape.php";

?>  

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
