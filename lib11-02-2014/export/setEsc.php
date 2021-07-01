<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
/*VARIABLES GLOBALES*/
$fechaAct = date("Y")."-".date("m")."-".date("d");	
$ArrHistorico = array(); 
$sqlRec = "
	SELECT
		* 
	FROM
		histrelacionlaboral
	WHERE
		serial_hrl = -1
";

$rs = $dblink->Execute($sqlRec); 
$dat = procesar($dblink);		
if($dat){
	$totDat = count($dat);
	for ($i=0;$i<$totDat;$i++){		
		$ArrHistorico['serial_epl'] = $dat[$i]['serial_epl']; 
		$ArrHistorico['serial_tct'] = $dat[$i]['serial_tct'];  
		$ArrHistorico['estado_hrl'] = 'ACTIVO'; 
		$ArrHistorico['observacion_hrl'] = 'INICIAL';   
		$ArrHistorico['fecha_hrl'] = $fechaAct; 
		$insertSql = $dblink->GetInsertSQL($rs,$ArrHistorico);
		$dblink->Execute($insertSql); 
		echo "<br>".$i." -> ".$insertSql."<br>";				
   	}
}
//update empleado set serial_tct = -99 where serial_tct is null
function procesar($dblink){
	$sqlMain = "
		SELECT
			serial_epl,
			serial_tct 
		FROM
			empleado 
	";	
	echo "<br>".$sqlMain."<br>";
	if($arr = $dblink->GetAll($sqlMain)){
		return $arr;
	}else{
		return false;
	}

}

?>

<?php
/*require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
/*VARIABLES GLOBALES*/
/*$fechaAct = date("Y")."-".date("m")."-".date("d");	
$ArrHistorico = array(); 
$sqlRec = "
	SELECT
		* 
	FROM
		histescalafon 
	WHERE
		serial_esc = -1
";

$rs = $dblink->Execute($sqlRec); 
$dat = procesar($dblink);		
if($dat){
	$totDat = count($dat);
	for ($i=0;$i<$totDat;$i++){		
		$ArrHistorico['serial_epl'] = $dat[$i]['serial_epl']; 
		$ArrHistorico['serial_esc'] = $dat[$i]['serial_esc'];  
		$ArrHistorico['estado_hes'] = 'ACTIVO'; 
		$ArrHistorico['observacion_hes'] = 'INICIAL';   
		$ArrHistorico['fecha_hes'] = $fechaAct; 
		$insertSql = $dblink->GetInsertSQL($rs,$ArrHistorico);
		$dblink->Execute($insertSql); 
		echo "<br>".$i." -> ".$insertSql."<br>";				
   	}
}
//update empleado set serial_tct = -99 where serial_tct is null
function procesar($dblink){
	$sqlMain = "
		SELECT
			serial_epl,
			serial_esc 
		FROM
			empleado 
	";	
	echo "<br>".$sqlMain."<br>";
	if($arr = $dblink->GetAll($sqlMain)){
		return $arr;
	}else{
		return false;
	}

}
*/
?>



