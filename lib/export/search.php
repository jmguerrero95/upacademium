<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$nombres = showTables($dblink); 
//Campo buscado
$campo = 'serial_dmat';
//Valor1887
$valor = '150874';

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
echo "<br>LISTA DE TABLAS DONDE ESTA EL VALOR Y CAMPO<br>";
echo "======================================================<br>";
echo "<br>CAMPO BUSCADO: ".$campo;
echo "<br>VALOR BUSCADO: ".$valor."<br><br>";

for ($i=0;$i<count($arrDef);$i++){          
      echo "NVeces: ".$arrDef[$i]." SQL: ".$arrDefSql[$i]."<br>"; 
}

function procesar($table,$campo,$valor,$dblink){
	$sqlMain = "
		SELECT
			count(*) as numero
		FROM
		".$table."
		WHERE
		".$campo."= ".$valor."
	";                
	if($arr = $dblink->GetAll($sqlMain)){
		$arr['sql']['sql'] = $sqlMain;
		return $arr;
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

