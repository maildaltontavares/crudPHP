<?php
#

require_once 'webservice_ini.php'; 
require_once '../config.php'; 
require_once ROOT_PATH . '/controller/FilialCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE'); 

if( $_SERVER['REQUEST_METHOD'] === "GET" ):


	$filial = new FilialCtr();	    
   if (isset($_GET['wscd'])):  

      if ($_GET['wscd']=='1'):
      	     //var_dump('expression');
            $aFilial = $filial->listaFilial(0);                                
      endif; 
      //var_dump($aDetalhe);
      __output_users__($aFilial); 
   endif;   
 
else:
	    __output_header__( false, 'Usuário GET não encontrado  1.', null);

endif;  
  
?> 