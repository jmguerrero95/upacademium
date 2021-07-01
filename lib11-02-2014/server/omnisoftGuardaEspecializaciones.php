<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftContabilidad.inc.php');

function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);
	return $dblink;
}

function omnisoftGuardarEspecializacion(){

	global  $_POST;
	$query = $_POST['query'];
	//$query = $_GET['query'];
    $query=str_replace("\"", "'",$query);
    $query=str_replace("\'", "'",$query);
    $query=str_replace("\x5C", "\x5C\x5C",$query);
    $dblink=omnisoftConnectDB();    
    //Parametros
	$params=explode('|',$query);   
    $serial_alu = $params[0];
    $serial_maa = $params[1];
    $fecha = $params[2];
	 
	 
	$sqlMain = "insert into alumnomalla (serial_alu, serial_maa, fechacreacion_ama) values (".$serial_alu.",".$serial_maa.",'".$fecha."')";
					//echo "<br>".$sqlMain.'<br>';
	$rscontrol=$dblink->Execute($sqlMain);
	//echo "mensaje:".$dblink->ErrorMsg();
 	
	/*if (strlen($dblink->ErrorMsg())>0)
     $resul=0;
 else $resul=$dblink->Insert_ID();*/
 
	$resul=(strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
	echo $resul."|";
					
}
	omnisoftGuardarEspecializacion();
?>
