<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//comente el algoritmo para ver los creditos tomados vs los creditos facturados


//$showList = verificarPagoCreditos(38113,$dblink);	
/*if($showList == "SHOW"){
	echo "el alumno se se puede mostrar";
}else{
	echo "El alumno NO se mostrará";
}*/

/*
function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;
	$credito_normal = "157";
	echo "<br>Registro#: ".$serial_mmat."<br>";
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
	echo "<br>CRED TOMADOS: ".$sqlCred."<br>";
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
		echo "<br>VAMOS A VERIFICAR CREDITOS PAGADOS<br>";
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
			
		    and ara.credito_ara = 'SI'
		";
		$rsCredNorm = $dblink->Execute($sqlCredNorm);
		while(!$rsCredNorm->EOF){
			$creditosPagados = $rsCredNorm->fields['tcreditonormal'];
			$rsCredNorm->MoveNext();
		}
		echo "<br>SQL Pagados: ".$sqlCredNorm."<br>";
		//$creditosPagadosNew = (string)$creditosTomados;
		echo "<br>Creditos Tomados: ".$creditosTomados."<br>";
		echo "<br>Creditos Pagados: ".$creditosPagados."<br>";		
		if($creditosPagados>=$creditosTomados){
			echo "<br>Todos los creditos tomados estan pagados...<br>";
			//return "SHOW";		
		}else{
			echo "<br>No ha pagado todos los creditos tomados en el registro a Financiero<br>";
			//return "NOSHOW";		
		}

	}else{
		echo "<br>No se hallan datos en cabecera factura verificar el cruce<br>";
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
				//return "SHOW";
			}else{
				//return "NOSHOW";
				echo "<br>El numero de creditos que tomo no es el mismo que pago a Financiero...<br>";
			}
		}else{
			echo "<br>Acerquese a Financiero a legalizar su registro...UR<br>";
			//return "NOSHOW";
		}		
	}
}
*/
//////////////
$sqlMain = "
SELECT
	detallemateriamatriculada.serial_mat,	
	nombre_mat                                                                 
	AS materia,		
	estado_nal,
	'4' as creditomalla,
	'3.3' as notanumerica
	
FROM
	notasalumnos ,
	materia,
	materiamatriculada,
	detallemateriamatriculada,
	periodo,
    alumno
		JOIN detallenotasalumnos AS dnal_1 
		ON dnal_1.serial_nal = notasalumnos.serial_nal 
		AND dnal_1.serial_acal=1 
			JOIN detallenotasalumnos AS dnal_2 
			ON dnal_2.serial_nal = notasalumnos.serial_nal 
			AND dnal_2.serial_acal=2 
				JOIN detallenotasalumnos AS dnal_3 
				ON dnal_3.serial_nal = notasalumnos.serial_nal 
				AND dnal_3.serial_acal=3 
					JOIN detallenotasalumnos AS dnal_4 
					ON dnal_4.serial_nal = notasalumnos.serial_nal 
					AND dnal_4.serial_acal=4 
WHERE
	materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
	AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
	AND materiamatriculada.serial_alu = alumno.serial_alu 
	AND periodo.serial_per = materiamatriculada.serial_per 
	AND materiamatriculada.serial_alu = 1886
	AND periodo.serial_sec = 1 
	AND (fecharetiro_dmat ='000-00-00' 
	AND retiromateria_dmat <>'SIN COSTO') 
	AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	AND detallemateriamatriculada.serial_mat IN (	SELECT
														dma.serial_mat 
													FROM
														malla        AS maa,
														alumnomalla  AS ama,
														detallemalla AS dma,
														materia      AS mat 
													WHERE
														maa.serial_maa = ama.
														serial_maa 
														AND dma.serial_maa = maa
														.serial_maa 
														AND mat.serial_mat = dma
														.serial_mat 
														AND ama.serial_alu = 1886
	)
ORDER BY
	fecini_per,
	materia


";
echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);


//$arr[0]['materia'] = 'A'
//$arr[0]['materia'] = 'B'
//$arr[1]['materia'] = 'A'

$arr = getRepMat();	
switch($arr){
	case 1: echo "NO HAY ELEMENTOS EN LA LISTA";
		break;
	case 2: echo "NO HAY REPETIDOS";
		break; 
	default: print "<pre>";print_r($arr);print "<pre>";		
}

//

/*
* Función que busca las materias repetidas dentro de una lista de materias
* Devuelve un nuevo array con:
*     Materia, Cuantas veces se repite y si entre las repetidas hay o no
	  una materia aprobada SI/NO		
*/

function getRepMat(){
	$arr = $GLOBALS['arrMain'];			
	$tot = count($arr);
	$arrMat = array();
	$arrDef = array();
	//Crear array unico
	for($i=0;$i<$tot;$i++){			
		$arrMat[$i] = $arr[$i]['serial_mat'];			
	}	
	$arrNewMat = array_unique($arrMat);	
	$arrDefMat = array_values($arrNewMat);
	$totDef = count($arrDefMat);
	for($i=0;$i<$totDef;$i++){			
		$arrDefMatCont[$arrDefMat[$i]]['nveces'] = 0;
	}		
	//Search de elementos repetidos dentro del array
	for($i=0;$i<$totDef;$i++){			
		$pointerA = $arrDefMat[$i];	
		for($j=0;$j<$tot;$j++){	
			$pointerB =  $arr[$j]['serial_mat'];
			$estado =  $arr[$j]['estado_nal'];
			if($pointerA == $pointerB){								
				$arrDefMatCont[$pointerA]['nveces']++;
				$arrDefMatCont[$pointerA]['materia'] = $pointerB;
				$arrDefMatCont[$pointerA]['nombremateria'] = $arr[$j]['materia']; 
				$arrDefMatCont[$pointerA]['credito'] = $arr[$j]['creditomalla']; 
				$arrDefMatCont[$pointerA]['posicion'] =  $arrDefMatCont[$pointerA]['posicion'].$j.".";
				$arrDefMatCont[$pointerA]['estado'] =  $arrDefMatCont[$pointerA]['estado'].$estado.".";
				$arrDefMatCont[$pointerA]['notanumerica'] = $arrDefMatCont[$pointerA]['notanumerica'] .$arr[$j]['notanumerica'].'*'; ;
				$arrDefMatCont[$pointerA]['devengartotal'] = 0;
				$arrDefMatCont[$pointerA]['devengarcreditos'] = 0;
				$arrDefMatCont[$pointerA]['procesar'] = '';
			}		
		}						
	}
	$arrFin = array_values($arrDefMatCont);
	//Get de las materias repetidas que hayan aprobado. 
	$totCont = count($arrFin);
	$sw = 0;
	for($i=0;$i<$totCont;$i++){
		$num = strlen($arrFin[$i]['estado']);
		$num = $num -1;
		$newCad = substr($arrFin[$i]['estado'],0,$num);
		$arrFin[$i]['estado'] = $newCad;
		$est = explode('.',$arrFin[$i]['estado']);
		$notan = explode('*',$arrFin[$i]['notanumerica']);
		for($j=0;$j<count($est);$j++){
			if($est[$j] == 'APRUEBA'){
				$arrFin[$i]['procesar'] = 'SI';
			}else{
				$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] + ($arrFin[$i]['credito']*$notan[$j]);
				$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] + $arrFin[$i]['credito'];
			}
		}
		if($arrFin[$i]['nveces'] > 1 and $arrFin[$i]['procesar'] == 'SI'){
			$arrTot[$sw]['nveces'] = $arrFin[$i]['nveces'];
			$arrTot[$sw]['materia'] = $arrFin[$i]['materia'];
			$arrTot[$sw]['credito'] = $arrFin[$i]['credito'];
			$arrTot[$sw]['posicion'] = $arrFin[$i]['posicion'];
			$arrTot[$sw]['estado'] =  $arrFin[$i]['estado'];
			$arrTot[$sw]['notanumerica'] =  $arrFin[$i]['notanumerica'];
			$arrTot[$sw]['devengartotal'] =  $arrFin[$i]['devengartotal'];
			$arrTot[$sw]['devengarcreditos'] =  $arrFin[$i]['devengarcreditos'];
			$arrTot[$sw]['nombremateria'] =  $arrFin[$i]['nombremateria'];
			$arrTot[$sw]['procesar'] =  $arrFin[$i]['procesar'];
			$sw++;
		}	
		
	}
	return $arrTot;
}
/*
function getRepMat(){
	$arr = $GLOBALS['arrMain'];			
	$tot = count($arr);
	$arrRep = array();		
	$arrDefMatCont = array();
	$arrMat = array();
	$arrDef = array();
	$arrOk = array();
	//Crear array unico
	for($i=0;$i<$tot;$i++){			
		$arrMat[$i] = $arr[$i]['serial_mat'];			
	}	
	$arrNewMat = array_unique($arrMat);	
	$arrDefMat = array_values($arrNewMat);
	$totDef = count($arrDefMat);
	for($i=0;$i<$totDef;$i++){			
		$arrDefMatCont[$arrDefMat[$i]] = 0;
	}	
	//Search de cuantas veces se repite en cada elemento en el array
	for($i=0;$i<$totDef;$i++){			
		$pointerA = $arrDefMat[$i];	
		for($j=0;$j<$tot;$j++){	
			$pointerB =  $arr[$j]['serial_mat'];
			if($pointerA == $pointerB){								
				$arrDefMatCont[$pointerA]++;			
			}		
		}						
	}
	$totDefCont = count($arrDefMatCont);
	$totalRep = $totDefCont;
	//Verificar cuantas veces se repite en cada elemento en el array
	if($totalRep>0){
		$sw = 0;
		//Filtrar los repetidos mas de dos veces solo de los repetidos		
		foreach($arrDefMatCont as $key => $val) {
			$rep = $val;
			if($rep>1){
				$arrOk[$key] = $rep;			
				$sw++;
			}		
		}
		if(count($arrOk)>0){
		//BEGIN
			//Buscar las materias repetidas las que Aprueba
			foreach($arrOk as $key => $val) {
				for($i=0;$i<$tot;$i++){			
					if($key == $arr[$i]['serial_mat']){
						if($arr[$i]['estado_nal']=='APRUEBA'){
							$arrProbe[$key]= 'SI';
						}				
					}			
				}			
			}
			//print "<pre>";print_r($arrProbe);print "<pre>";						
			//print "<pre>";print_r($arrOk);print "<pre>";						
			$totRepMatAprueba = count($arrProbe);
			if($totRepMatAprueba>0){
				//Separa del array principal arrok los que si han aprobado y construye un array con los que no
				$arrTrue = array_diff_key($arrOk, $arrProbe);
				if(count($arrTrue)>0){
					$s = 0;				
					foreach($arrTrue as $key => $val) {
						$arrResult[$s] = $key;
						$s++;		
					}
				}else{
					$arrResult = array(-1 => -1);
				}				
			}else{
				$arrResult = array(-1 => -1);
			}
			$i=0;			
			//echo "<br>TOTAL REPETIDOS".$totRepMatAprueba."<br>";	
			//Construir Array Final
			foreach($arrOk as $key => $val) {
				$arrDevOk[$i]['materia'] = $key;
				$arrDevOk[$i]['nveces'] = $val;
				$credito = array_search($key,$arr);
				$credDef = $arr[$credito]['creditomalla'];
				$arrDevOk[$i]['creditos'] = $credDef;
				if(array_search($key,$arrResult)){
					$test = "NO";
				}else{
					$test = "SI";
				}
				$arrDevOk[$i]['aprueba']= $test;
				$i++;		 
			}	
			//print "<pre>";print_r($arrDevOk);print "<pre>";							
			return $arrDevOk;			
		//END		
		}else{
			//No hay elementos repetidos dentro del array
			return 2;
		}		
	}else{
		//No hay elementos en el array principal
		return 1 ;
	}
}

*/

?>