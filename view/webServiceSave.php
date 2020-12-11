<?php
# 
# obtendo nosso arquivo de configuracões
require_once 'webservice_ini.php'; 
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 

# verificando se o método de envio é mesmo  POST.
if( $_SERVER['REQUEST_METHOD'] !== "POST" )
    __output_header__( false, "Método de requisição SAVE GET não aceito.", null );


 $usuario = new UsuarioCtr();	 
 //$aUsu = $usuario->listaUsuario(1); 
 
 if (isset($_POST['id'])):
     $aUsu = $usuario->buscaUsuario($_POST['id']);
      __output_users__($aUsu);
 endif;    
    

  __output_header__( false, 'Usuário inválido.', null);	

#
?>