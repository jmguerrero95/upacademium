<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$_SESSION['orden'][0] = "Dato 1"; 



/*$nombres = showTables($dblink); 
//Campo buscado
$campo = 'serial_epl';
//Valor
$valor = '1594';
$swi = 0;
$sw2 = 0;
	for ($i=0;$i<count($nombres);$i++){
		$dat = procesar($nombres[$i][0],$campo,$valor,$dblink);		
		if($dat){
			$arrDef[$swi] = $dat[0]['numero'];
			$arrDefSql[$swi] = $dat['sql']['sql'];
			$swi++;
		}
	}
echo "<br><br><br>LISTA DE TABLAS DONDE ESTA EL SQL<br>";
for ($i=0;$i<count($arrDef);$i++){	
	echo "NVeces: ".$arrDef[$i].     " SQL: ".$arrDefSql[$i]."<br>"; 
}
*/

function procesar($table,$campo,$valor,$dblink){
	$sqlMain = "
	SELECT
		count(*) as numero
	FROM
		".$table."
	WHERE
		".$campo."= ".$valor."";
	
	if($arr = $dblink->GetAll($sqlMain)){
		arr[]
		if(count($arr)>){
			$arr['sql']['sql'] = $sqlMain;
			return $arr;
		}else{
			return false;
		}
		
	}else{
		return false;
	}

}
function showTables($dblink){
	$sqlMain = "
		show tables
	";	
	if($arr = $dblink->GetAll($sqlMain)){		
		return $arr;
	}else{
		return false;
	}

}


?>

