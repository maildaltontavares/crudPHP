<?php
#
#
$ci = curl_init();

//POST
//curl_setopt( $ci, CURLOPT_URL, "https://virtuax.herokuapp.com/view/webServiceSave.php" ); 
//curl_setopt( $ci, CURLOPT_POST, true);
//curl_setopt( $ci, CURLOPT_POSTFIELDS, array('id' => 44 ));

//GET
//curl_setopt( $ci, CURLOPT_URL, "https://virtuax.herokuapp.com/view/webServiceGet.php?id=44" ); 
curl_setopt( $ci,CURLOPT_URL,    "http://virtuax.herokuapp.com/view/wsFilial.php?wscd=1");    

curl_setopt( $ci, CURLOPT_HEADER, false );
curl_setopt( $ci, CURLOPT_RETURNTRANSFER, 1 );

$result = curl_exec( $ci );

$_retorno = json_decode( $result, true );
var_dump($_retorno);

#

?>

 