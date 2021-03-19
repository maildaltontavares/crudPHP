<?php
# 
 
require_once 'webservice_ini.php'; 
require_once '../config.php'; 
require_once ROOT_PATH . '/controller/usuarioCtr.php';  
require_once ROOT_PATH . '/bibliotecas/funcoes.php'; 
require_once ROOT_PATH . '/bibliotecas/phpjasper/src/PHPJasper.php';  

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: POST, GET , PUT, DELETE');  


use PHPJasper\PHPJasper;  
if( $_SERVER['REQUEST_METHOD'] === "GET" ):   

		$input =  ROOT_PATH . '/reports/rptLeituras.jrxml';     
		$output = ROOT_PATH . '/reports'; 	

  //  $postdata = file_get_contents("php://input");  
	//if(isset($postdata)   && !empty($postdata)):
	
	  // Extract the data.     
//		$request = json_decode($postdata,true); 
	//    $usr = $request;  

/*
        $options = [ 
            'format' => ['pdf','xlsx','csv','rtf'] ,
            'params' => [
                 'p_filial' => 1,
                 'P_DTINI'  => date_format(date_create($_GET["dt_leitura_inicial"]),'Ymd'),
                 'P_DTFIM'  => date_format(date_create($_GET["dt_leitura_final"]),'Ymd'),
                 'P_DTI'    => date_format(date_create($_GET["dt_leitura_inicial"]),'d/m/Y'),
                 'P_DTF'    => date_format(date_create($_GET["dt_leitura_final"]),'d/m/Y')
            ],
            'db_connection' => [
                'driver'   => 'postgres', //mysql, ....
                'username' => K_USERNAME,
                'password' => K_PASSWORD,
                'host'     => K_HOST ,
                'database' => K_DATABASE,
                'port' => '5432'
            ]
        ];

  */       


        $options = [ 
            'format' => ['pdf','xlsx','csv','rtf'] ,
            'params' => [
                 'p_filial' => 1,
                 'P_DTINI'  => date_format(date_create("2020-11-24"),'Ymd'),
                 'P_DTFIM'  => date_format(date_create("2022-01-01"),'Ymd'),
                 'P_DTI'    => date_format(date_create("2020-11-24"),'d/m/Y'),
                 'P_DTF'    => date_format(date_create("2022-01-01"),'d/m/Y')
            ],
            'db_connection' => [
                'driver'   => 'postgres', //mysql, ....
                'username' => K_USERNAME,
                'password' => K_PASSWORD,
                'host'     => K_HOST ,
                'database' => K_DATABASE,
                'port' => '5432'
            ]
        ];


        $jasper = new PHPJasper; 

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();

        $filename = 'rptLeituras.pdf';
        header('Content-Type: application/pdf');
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
        header('Content-Disposition:; filename=' . $filename);
        readfile($output . '/' . $filename);
        unlink($output . '/' . $filename);
        flush(); 


	    //$usuario = new UsuarioCtr();  
        //$usuario->create( $usr['d']["nome"],$usr['d']["senha"],$usr['d']["email"],"9999",$usr['d']["grupos"] ,$chave ,$filial,$usr['d']["filpad"]);  

		//__output_users3__(['ok']); 
		//__output_users1__();

 
else:
	    __output_header__( false, 'Usuário GET não encontrado  1.', null);

endif;  
  
?> 