<?php
 
	
	class Funcao{ 
 
		 public function validaAcesso($p_funcao){ 
                  $aAcesso = "";
                  $z=0;                  

                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';echo '</br>';
                  //echo '</br>';


                  for($i=0;$i<count($_SESSION['perfil']);$i++)
                    { 
                       if ($_SESSION['perfil'][$i]['sigla']==$p_funcao):
	                          //var_dump($_SESSION['perfil'][$i]['nome_botao']);   
		                      if ($z!=0):
		                          $aAcesso = $aAcesso . '|';
		                      endif;
		                      $aAcesso = $aAcesso . implode("|", $_SESSION['perfil'][$i]);
		                      $z = $z + 1;                       
	                   endif;   

                    }   
                    return   $aAcesso;  
                    var_dump($aAcesso);  

		 }  
 
	}



?>
 