<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$arrMain = array();

$arrCarreras = 
	array
	(
	0 => 'SISTEMAS',
	1 => 'COMERCIO',
	2 => 'DESARROLLO',
	3 => 'NEGOCIOS'
	 );

$arrMain['SISTEMAS'][0]['nombre'] = 'JUANITO';
$arrMain['SISTEMAS'][0]['cedula'] = '1';
$arrMain['SISTEMAS'][1]['nombre'] = 'PABLITO';
$arrMain['SISTEMAS'][1]['cedula'] = '1';
$arrMain['COMERCIO'][1]['nombre'] = 'PEPITO';
$arrMain['COMERCIO'][1]['cedula'] = '2';
$arrMain['DESARROLLO'][2]['nombre'] = 'LUCHITO';
$arrMain['DESARROLLO'][2]['cedula'] = '3';
$arrMain['NEGOCIOS'][3]['nombre'] = 'LUCHITO';
$arrMain['NEGOCIOS'][3]['cedula'] = '3';

print "<pre>"; print_r($arrMain); print "<pre>";

$tot = count($arrMain);
$totCarr = count($arrCarreras);
echo $tot; 
$val = 1;
echo " <table width='200' border='1'>";
for($i=0;$i<$totCarr;$i++){
	echo "
	  <tr>
		<td>".$arrCarreras[$i]."</td>
		<td>".$val."</td>
	  </tr>	
	";	
}
echo "</table>";

/*echo " <table width='200' border='1'>";
$numAlu = 4;
for( $i = 0 ; $ i< $numAlu ; $i++){
	$keyCar = $arrCarreras[$j];
	echo "
	  <tr>
		<td>".$arrMain[$i][$keyCar]['nombre']."</td>
		<td>".$arrMain[$i][$keyCar]['cedula']."</td>
	  </tr>	
	";	
}
echo "</table>";
*/

/*for( $i = 0 ; $i < 4 ; $i++ ){
	for( $j = 0 ; $j < 2 ; $j++ ){
		$keyCar = $arrCarreras[$j];
		echo $arrMain[$i][$keyCar]['nombre']."<br>";
	}
}
*/

?>