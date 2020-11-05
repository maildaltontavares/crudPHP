<?php
 
  session_start(); 

?>


 
<?php
  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";
  if (isset($_GET['tela'])):
      echo '<div class="alert alert-primary" role="alert"><li>' .$_GET['tela'] . ' - ' .  "Usuario não possui acesso!"  . '</li></div>'; 
  endif;
  //include_once "footer.php";
  include_once "menuNavRodape.php";

?>  

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
