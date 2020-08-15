<?php  

  /* Recebe o número da página via parâmetro na URL */  
  $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;   
  
  /* Calcula a linha inicial da consulta */  
 
  $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;   

 ?>