<?php
#

require_once 'webservice_ini.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 

# verificando se estamos recebendo um POST. Não aceitamos GET

header('Access-Control-Allow-Origin: *');

$v=$_SERVER['HTTP_ORIGIN'];  
if($v=="http://localhost:4200"): 
     //$aUsu[0]['nome']=$_SERVER['HTTP_ORIGIN'] . ' - ' .  $_SERVER['HTTP_REFERER']; 
endif;

if( $_SERVER['REQUEST_METHOD'] !== "GET" )
    __output_header__( false, "Método de requisição POST não aceito.", null );  
 
$usuario = new UsuarioCtr();	 

 
//if($v=="http://localhost:4200"): 
if (isset($_GET['id'])): 
     $aUsu = $usuario->buscaUsuario($_GET['id']); 
      __output_users2__($aUsu);

else:
     $aUsu = $usuario->listaUsuario(0); 
    // var_dump($aUsu ) ;
     __output_users__($aUsu);
endif;   

 //__output_users__($aUsu);
/*
# criando uma instancia da nossa tabela usuarios
$vita->usuarios = new SYS_Table( 'usuarios' );

# setando o que sera pesquisado no banco de dados
$_where = array(
    'email' => $vita->post->email,
    'senha' => md5($vita->post->senha)
);

# realizando consulta SQL
$r = $vita->usuarios->select()->where( $_where )->single();

# se erro
if( $r === false )
    __output_header__( false, 'Usuário não encontrado.', null);

# se sucesso
__output_header__( true, null, $r );

#
*/
 
    __output_header__( false, 'Usuário GET não encontrado.', null);
?>