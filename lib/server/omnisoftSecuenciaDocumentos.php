<?php

/*
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
	global $DBConnection;
	
	$dblink = NewADOConnection($DBConnection);
	
	return $dblink;
}
*/
function leerSecuenciaDocumentos($dblink,$serial_suc,$serial_tic) {

 $SQLCmd="select SERIAL_SDO, SERIAL_TIC, SERIAL_SUC, AUTORIZASRI_SDO, NUMERO_SDO, TALONARIODESDE_SDO, TALONARIOHASTA_SDO, FECHACADUCIDAD_SDO, AUTORIZACIONSRI_SDO, concat_ws('-',SECUENCIALSUCURSAL_SDO, SECUENCIALACTIVIDAD_SDO) serie, COPIASAUTORIZADAS_SDO, ESTADO_SDO, STOCKMINIMO_SDO from secuenciaDocumentos where serial_tic=".$serial_tic ." and serial_suc=".$serial_suc." and fechaCaducidad_sdo>=CURRENT_DATE and estado_sdo='ACTIVO'";
//echo $SQLCmd."<br>";

 $rs=$dblink->Execute($SQLCmd);

 if (!$rs && $rs->RecordCount() <=0)
     return Array(0,"Error: No existe secuencia definida! o la secuencia de facturacion esta caducada!");

 $numero_sdo=($rs->fields[4]+1<$rs->fields[5])?$rs->fields[5]:$rs->fields[4]+1;
 //echo $numero_sdo."<br>";
 if ($rs->fields[6]<$numero_sdo)
    return Array(0,"Error: Ya no existen facturas disponibles en el talonario!");

 $advertencia="";
 if ($rs->fields[13]>($rs->fields[6]-$numero_sdo))
    $advertencia="Advertencia: El numero de facturas disponibles esta bajo el stock minimo";

// $SQLCmd="update  secuenciaDocumentos  set numero_sdo=".$numero_sdo."+1 where serial_tic=".$serial_tic ." and serial_suc=".$serial_suc." and fechaCaducidad_sdo>=CURRENT_DATE and estado_sdo='ACTIVO'";
// echo $SQLCmd."<br>";

// $dblink->Execute($SQLCmd);

 return Array($numero_sdo,'',$advertencia,$rs);

}

?>
