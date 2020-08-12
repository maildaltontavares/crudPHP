<?php
 
  session_start();

  require_once '../config.php';
 require_once ROOT_PATH . '/controller/tabelaCtr.php';  
 require_once ROOT_PATH . '/controller/tabpadCtr.php';    
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	
  
   

  ?>  
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

  	<style type="text/css">
  		.container{
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container">  
		<?php   
 

		echo 'Hello World';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  