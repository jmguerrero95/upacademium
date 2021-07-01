<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$arrMainPrior = 
	array
	(
		0	=>	"DOCTORADO",
		1	=>	"MAGISTER",
		2	=>	"IV DOCTOR EN JURISPRUDENCIA O FILOSOFÍA",
		3	=>	"ESPECIALISTA",
		4	=>	"DIPLOMADO",
		5	=>	"TERCER NIVEL",
		6	=>	"III DOCTOR EN JURISPRUDENCIA O FILOSOFÍA",
		7	=>	"TECNOLOGO",
		8	=>	"TECNICO SUPERIOR",
		9	=>	"TITULO TEMPORAL",
		10	=>	"SIN TITULO"	
	 );
verArray();


/*$reg = '37393';
$showList = verificarPagoCreditos($reg,$dblink);	

if($showList=="SHOW"){
	echo "MOSTRAR";
}else{
	echo "NO MOSTRAR";
}*/

function verArray(){
	$arrPr = $GLOBALS['arrMainPrior'];	
	for($i=0;$i<count($arrPr);$i++){
		$key = $arrPr[$i];
		$totFormacion[$key]=0;	
		echo "<br>".$totFormacion[$key]."<br>";
	}
	//echo "<pre>".print_r($totFormacion)."<pre>";
}

	
/*
	Funcion que muestra o no un estudiante basado en un numero de registro
*/

function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;
	$credito_normal = "157";
	//echo "<br>Registro#: ".$serial_mmat."<br>";
	$sqlCred = "
		SELECT
			mmat.serial_mmat,
			serial_alu,
			sum(numerocreditos_dmat+creditosequivalentes_dmat) as totalcreditos 
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			and mmat.serial_mmat = ".$serial_mmat."
		GROUP BY
			mmat.serial_mmat

	";
	$rsCreditos = $dblink->Execute($sqlCred);
	while(!$rsCreditos->EOF){
		$creditosTomados = $rsCreditos->fields['totalcreditos'];
		$rsCreditos->MoveNext();
	}
	echo "<br>Creditos Tomados: ".$creditosTomados."<br>";
	//Verificar  si hay un pago de los creditos tomados
	$sqlCredFac = "
		SELECT 
			* 
		FROM 
			cabecerafactura 
		WHERE 
			serial_mmat = ".$serial_mmat
			;
	$rsCredFac = $dblink->Execute($sqlCredFac);
	$numRows = $rsCredFac->recordCount();
	if($numRows>0){
		//echo "<br>VAMOS A MATRICULAR<br>";
		//Verificar si credito tomado y pagado es el mismo
		$sqlCredNorm = "
		SELECT
			caf.serial_mmat,
			ara.nombre_ara,
			caf.serial_caf, 
			dcaf.serial_dar,
			cantidad_dfa as tcreditonormal
		FROM
			cabecerafactura as caf,
			detallefactura as dcaf,
			detallearancel as dar,
			aranceles as ara
		WHERE
			caf.serial_caf = dcaf.serial_caf 
			and dcaf.serial_dar = dar.serial_dar
			and ara.serial_ara = dar.serial_ara
			and caf.serial_mmat = ".$serial_mmat."
			and ara.serial_ara = ".$credito_normal."
		    and ara.credito_ara = 'SI'
		";
		$rsCredNorm = $dblink->Execute($sqlCredNorm);
		while(!$rsCredNorm->EOF){
			$creditosPagados = $rsCredNorm->fields['tcreditonormal'];
			$rsCredNorm->MoveNext();
		}
		//$creditosPagadosNew = (string)$creditosTomados;
		//echo "<br>Creditos Tomados: ".$creditosTomados."<br>";
		//echo "<br>Creditos Pagados: ".$creditosPagados."<br>";		
		if($creditosPagados>=$creditosTomados){
			echo "<br>Todos los creditos tomados estan pagados...<br>";
			return "SHOW";		
		}else{
			echo "<br>No ha pagado todos los creditos tomados en el registro a Financiero<br>";
			return "NOSHOW";		
		}

	}else{
		//echo "<br>No se hallan datos en cabecera factura verificar el cruce<br>";
		$sqlCruce = "
			SELECT
				cpt.serial_cpt,
				cpt.estado_cpt,
				sum(dcpt.creditos_dcpt) as creditosdevengados,
				dcpt.serial_mmat 
			FROM
				cabeceracreditosportomar as cpt,
				detallecreditoportomar as dcpt 
			WHERE
				cpt.serial_cpt = dcpt.serial_cpt
				and dcpt.serial_mmat = ".$serial_mmat."
			GROUP BY
				dcpt.serial_mmat

		"; 
		$rsCruce = $dblink->Execute($sqlCruce);		
		$numR = $rsCruce->recordCount();
		if($numR>0){
			while(!$rsCruce->EOF){
				$creditosDevengados = $rsCruce->fields['creditosdevengados'];
				$rsCruce->MoveNext();
			}
			if($creditosDevengados>=$creditosTomados){
				echo "<br>El estudiante pagó los creditos correctos puede salir en las listas...<br>";
				return "SHOW";
			}else{
				echo "<br>El numero de creditos que tomo no es el mismo que pago a Financiero...<br>";
				return "NOSHOW";
				
			}
		}else{
			echo "<br>Acerquese a Financiero a legalizar su registro...<br>";
			return "NOSHOW";
		}		
	}
}
?>

