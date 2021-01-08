<?php
#

require_once 'webservice_ini.php';
require_once '../config.php';
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 

# verificando se estamos recebendo um POST. Não aceitamos GET
//"http://localhost:8080"
//"http://localhost:4200/" 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST'); 

//$v=$_SERVER['HTTP_ORIGIN'];  

$postdata = file_get_contents("php://input");  
if(isset($postdata)   && !empty($postdata))
{
  // Extract the data.    

	$request = json_decode($postdata,true); 
    $usr = $request;
    
    $usuario = new UsuarioCtr();
    //create($nome,md5($senha),                                        $email,$tel,$aIt,  $chave,$vFilUsu,$filPad)=
	$usuario->create($usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",[5],"9999",[1],1); 
	 
	__output_users3__($request);


  // Validate.
  //if( $request->data->nome == '')
  //{
    //return http_response_code(400);
  //  $aUsu = $usuario->buscaUsuario(88);
  //}
	
}


//if($v=="http://localhost:4200"): 
     //$aUsu[0]['nome']=$_SERVER['HTTP_ORIGIN'] . ' - ' .  $_SERVER['HTTP_REFERER']; 
//endif; 


 $usuario = new UsuarioCtr();
 
//$usuario->create("AAAAA",md5("aaa"),"WebEmail","9999",[5],"9999",1,1); 

  if (isset($_POST['param1'])):  
        $aUsu = $usuario->buscaUsuario(86);
  else:
        $aUsu = $usuario->buscaUsuario(88);  
  endif;



 __output_users2__($aUsu);



if( $_SERVER['REQUEST_METHOD'] !== "POST" ):	 
    __output_header__( false, "Método de requisição GET não aceito.", null ); 
endif;

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
   // __output_header__( false, 'Usuário GET não encontrado.', null);
    __output_header__( false, 'Usuário GET não encontrado.', null);
?>