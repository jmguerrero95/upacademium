<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$sucursal=0;
$programa=0;
$periodo=0;
$horario=0;
$empleado=0;
$serial_nts=0;
$ntotalclases=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;
$dblink = NewADOConnection($DBConnection);
}

function omnisoftProcesarRequisitos($serial_ama,$serial_sec) {
 global $dblink;
   $actualizacion=false;
   
$SQLCmd_generar = "
	INSERT
	INTO
		requisitosgraduacion 
		(
			serial_ama,serial_dad,entregado_rgra
		)
	
	SELECT   
		".$serial_ama.",serial_dad,'NO' 
	FROM
		documentosadmision 
	WHERE
		tipo_dad = 'GRADUACION'
		and serial_sec = ".$serial_sec." 
		AND serial_dad NOT IN ( SELECT
											serial_dad 
										FROM
											requisitosgraduacion 
										WHERE
										   serial_ama = ".$serial_ama."
		)
	ORDER BY
		serial_dad	

 ";
	//echo "<br> SQLCmd_generar: ".$SQLCmd_generar. "<br>";  
 	 $resultSet=$dblink->Execute($SQLCmd_generar);	

    
	} 
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);

       omnisoftProcesarRequisitos($params[0],$params[1]);
//echo "|".$params[0]."|";
?>