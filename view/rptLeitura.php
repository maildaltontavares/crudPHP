<?php


require_once '../config.php';   

//require_once ROOT_PATH . '/vendor/autoload.php';

//C:\xampp\htdocs\crudphp\bibliotecas\phpjasper\src

require_once ROOT_PATH . '/bibliotecas/phpjasper/src/PHPJasper.php';  

use PHPJasper\PHPJasper;

//$input =  ROOT_PATH .  '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';  
//$output = ROOT_PATH .  '/vendor/geekcom/phpjasper/examples';    

$input =  ROOT_PATH . '/bibliotecas/phpjasper/examples/rptHtml.jrxml';  
$output = ROOT_PATH . '/bibliotecas/phpjasper/examples'; 

/*
$options = [ 
    'format' => ['pdf', 'rtf'] ,
        'db_connection' => [
        'driver' => 'postgres', //mysql, ....
        'username' => 'postgres',
        'password' => 'admin',
        'host' => '127.0.0.1',
        'database' => 'Main',
        'port' => '5432'
    ]
];

*/

$options = [ 
    'format' => ['pdf', 'rtf'] ,
        'db_connection' => [
        'driver' => 'postgres', //mysql, ....
        'username' => 'pfsutquhhyymuc',
        'password' => 'ce5946f1f936ef51bf124faffcb3d65aafb886b4dcf321e15e7407a690e8069c',
        'host' => 'ec2-3-211-48-92.compute-1.amazonaws.com',
        'database' => 'd52bo506a9mii',
        'port' => '5432'
    ]
];

//pgsql:host=ec2-3-211-48-92.compute-1.amazonaws.com
 //       ;port=5432;dbname=d52bo506a9mii;user=pfsutquhhyymuc;password=ce5946f1f936ef51bf124faffcb3d65aafb886b4dcf321e15e7407a690e8069c"
/*
$options = [
    'format' => ['pdf', 'rtf'] ,
    //'locale' => 'en',
    //'params' => [],
    'db_connection' => [
        'driver' => 'postgres', //mysql, ....
        'username' => 'postgres',
        'password' => 'admin',
        'host' => '127.0.0.1',
        'database' => 'Main',
        'port' => '5432'
    ]
];
*/
$jasper = new PHPJasper;
 
//shell_exec('java -version');
  
//$output = shell_exec('java -version');
//echo "<pre>$output</pre>";

$jasper->process(
    $input,
    $output,
    $options
)->execute();

$filename = 'rptHtml.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition:; filename=' . $filename);
//include_once "menuNavCab.php";

readfile($output . '/' . $filename);
unlink($output . '/' . $filename);
flush();
 
/*
require_once '../config.php';
require_once ROOT_PATH . '/vendor/autoload.php';

use PHPJasper\PHPJasper;

$input = ROOT_PATH . '/vendor/geekcom/phpjasper/examples/hello_world.jrxml';   

$jasper = new PHPJasper;
$jasper->compile($input)->execute();

 
session_start();

 
require_once '../config.php'; 



require_once ROOT_PATH .  '/vendor/autoload.php';  

use PHPJasper\PHPJasper;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$input =  ROOT_PATH . '/vendor/geekcom/phpjasper/examples/rptUsuario.jasper'; //hello_world.jasper'; 
$output =  ROOT_PATH . '/vendor/geekcom/phpjasper/examples';  
 
$options = [ 
    'format' => ['pdf', 'rtf'] 
];

$filename = $input;

if (file_exists($filename)) {
    echo " ------- The file $filename exists      ------ ";
} else {
    echo "The file $filename does not exist";
}

var_dump($input);
var_dump($output);



$jasper = new PHPJasper;

/*
$output = $jasper->listParameters($input)->execute();

foreach($output as $parameter_description)
    print $parameter_description . '<pre>';

 


$jasper->process(
    $input,
    $output,
    $options
)->execute();

$filename = 'hello_world.pdf';
header('Content-Description: application/pdf');
header('Content-Type: application/pdf');
header('Content-Disposition:; filename=' . $filename);
readfile($output . '/' . $filename);
unlink($output . '/' . $filename);
flush();

?>

<?php
/*

session_start();

 
require_once '../config.php'; 
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/vendor/autoload.php';
 

use PHPJasper\PHPJasper;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$input = ROOT_PATH .  '/reports/rptUsuario.jrxml';  
//$output = __DIR__ . '/vendor/geekcom/phpjasper/examples';    
$output = ROOT_PATH  . '/reports';
$options = [ 
    'format' => ['pdf', 'rtf'] 
];

$jasper = new PHPJasper;

$jasper->process(
    $input,
    $output,
    $options
)->execute();

$filename = 'rptUsuario.pdf';
header('Content-Description: application/pdf');
header('Content-Type: application/pdf');
header('Content-Disposition:; filename=' . $filename);
readfile($output . '/' . $filename);
unlink($output . '/' . $filename);
flush();
*/
?>