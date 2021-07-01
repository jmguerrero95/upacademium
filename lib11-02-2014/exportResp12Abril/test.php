<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$nombres = 
array(
0=>'ABAD VALLEJO FABIAN ALBERTO',
1=>'ABAD VALLEJO FABIAN ALBERTO',
2=>'ABAD VALLEJO FABIAN ALBERTO',
3=>'ABAD VALLEJO FABIAN ALBERTO',
4=>'ABAD VALLEJO FABIAN ALBERTO',
5=>'AGUIRRE ROMAN PATRICIO ABELARDO',
6=>'ALBUJA SALAZAR JOSE NICOLAS',
7=>'ALCIVAR LOOR KATIUSKA MONCERRATE',
8=>'AMORES ABELLO EUGENIA VICTORIA',
9=>'ANDRADE COBA JORGE HUMBERTO',
10=>'ANDRADE SANCHEZ ALVARO PATRICIO',
11=>'ASTUDILLO ZHINDON KATHERINE',
12=>'BALCAZAR CRUZ EMMA LUZ',
13=>'BASABE MORENO GEOVANNI',
14=>'CARDENAS PESANTEZ ERIKA GABRIELA',
15=>'CHAVEZ CHAVEZ JOHANNA DEL ROCIO',
16=>'COELLO GUILLEN MARIA XIMENA',
17=>'CORTEZ SALCEDO FRANKLIN MIGUEL',
18=>'CUICHAN CAIZA JULIO CESAR',
19=>'DARQUEA LOPEZ HUGO ORLANDO',
20=>'DELUGO VERA ANA MARIA',
21=>'DIAZ PATIÑO MARCO ANTONIO',
22=>'ESPINOZA AVECILLAS KATIUSHKA ELIZABETH',
23=>'ESPINOZA RIVERA EDWIN PATRICIO',
24=>'GORTAIRE-JATIVA ALVARO DANILO',
25=>'GRIJALVA LOPEZ JOSE VICENTE',
26=>'GUERRERO ARDITTO ERIKA PIERINA',
27=>'HERNANDEZ SALTOS NADIA ROMINA',
28=>'JERVES NARVAEZ DANIELA PRISCILA',
29=>'MARTINEZ LEON MARJORIE ELIZABETH',
30=>'MARTINEZ NIETO MILTON EDUARDO',
31=>'MARTRUS GRANDA JEANNINE ALEXANDRA',
32=>'MAYA GOMEZ GEORGE JONATHAN',
33=>'MEDINA NAZARENO SARA ELIZABETH',
34=>'MENDOZA ANTONIO',
35=>'MERIZALDE HUILCAPI WILLIAM SANTIAGO',
36=>'MONCAYO GORTAIRE CARLOS ALBERTO',
37=>'MORA HAROLD',
38=>'MORILLO VILLEGAS JUAN CARLOS',
39=>'OLMEDO MORAN JOSE ALBERTO',
40=>'ONATE QUEZADA DIEGO JAVIER',
41=>'ORDEÑANA RODRIGUEZ XAVIER',
42=>'ORMAZA ORMAZA RITA DEL ROCIO',
43=>'PALACIOS MORENO MARIO ALBERTO',
44=>'QUINDE PIHUAVE ALEX VIDAL',
45=>'RIBADENEIRA LOPEZ LEONARDO MAURICIO',
46=>'SALTOS PEREZ ANGELA JACQUELINE',
47=>'SOSA BOLAÑOS VERONICA KARINA',
48=>'SPERBER DAVID',
49=>'WILLIAMS JAIRALA JADDYK ENRIQUE'


);
$per= 'FEBRERO-2010';
/*$arrDef = array();
$swDef = 0;
$tot = count($nombres);
for ($i=0;$i<$tot;$i++){
	for ($j=$i+1;$j<=$tot+1;$j++){
		if($nombres[$i]==$nombres[$j]){
			$arrDefRep1[$swDefRep]=$i;  			
			$arrDefRep2[$swDefRep]=$j;  			
			$swDefRep++;	
			echo "REPETIDO:$i ".$nombres[$i]."$j<br>";
		}
	}
}

*/

$swi = 0;
$sw2 = 0;
	for ($i=0;$i<count($nombres);$i++){
		$dat = procesar($nombres[$i],$per,$dblink);		
		if($dat){
			$arrDef[$swi] = $dat[0]['SERIAL_ERP'].$dat[0]['nombrecomp_epl'];
			$swi++;
		}else{
			$arrDef2[$sw2] = $nombres[$i];			
				$sw2++;
		}
	}
echo "<br><br><br>LISTA DE SERIAL_ERP A BORRAR:<br>";
for ($i=0;$i<count($arrDef);$i++){
	echo $arrDef[$i].","; 
}
echo "<br><br><br>LISTA DE NO ENCONTRADOS:<br>";
for ($i=0;$i<count($arrDef2);$i++){
	echo "$i: ".$arrDef2[$i]."<br>"; 
}

///fucnt
function procesar($nombre,$per,$dblink){
	$sqlMain = "
	SELECT
		SERIAL_ERP,
		empleado.serial_epl,
		nombrecomp_epl,	
		descripcion_perrol,
		FECHA_ERP,
		NOMBRE_ERP,
		ESTADO_ERP,
		OBSERVACION_ERP,
		empleadorolpagos.SERIAL_EPL,
		periodorol.SERIAL_PERROL 
	FROM
		periodorol,
		empleado,
		empleadorolpagos 
	WHERE
		empleado.serial_epl=empleadorolpagos.serial_epl 
		AND periodorol.serial_perrol=empleadorolpagos.serial_perrol 
		AND descripcion_perrol = '".$per."' 
		AND nombrecomp_epl ='".$nombre."'
	order by nombrecomp_epl";	
	//echo "<br>".$sqlMain."<br>";
	if($arr = $dblink->GetAll($sqlMain)){
		return $arr;
	}else{
		return false;
	}

}


?>

