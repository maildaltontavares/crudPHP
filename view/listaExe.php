<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php';  
  require_once ROOT_PATH . '/controller/tabpadCtr.php';    
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	
  
  include_once "menuPrincipal.php";
  include_once "menu.php"; 
  
  $id = 0;
  $nometabpad = '';
  $sigla  = ''; 
  
  if ((!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) )     ): 
   	   
       if(isset($_GET['idTp'])): //Executa apenas a primeira vez
	       $tabpadCtr = new tabpadCtr();   
	       $p_tabpad = $tabpadCtr->buscatabpad($_GET['idTp']);  
	       $_SESSION['tabelaAtual'] = $p_tabpad[0]['sigla'];  
	      // var_dump($_SESSION['tabelaAtual']);  
	    else:
	       $tabpadCtr = new tabpadCtr();   
	       $tb =  $_SESSION['tabelaAtual'] ;
	       $p_tabpad = $tabpadCtr->buscatpSigla($tb);   	       
	   endif;    

  else:
       $tabpadCtr = new tabpadCtr();   
       $tb =  $_SESSION['tabelaAtual'] ;
       $p_tabpad = $tabpadCtr->buscatpSigla($tb);   
  endif;	  

  if(!empty($p_tabpad)): 
     $id = $p_tabpad[0]['id'];  
     $nometabpad = $p_tabpad[0]['descricao'];    
     $sigla = $p_tabpad[0]['sigla'];    
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