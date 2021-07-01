<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$sqlMain = "
	SELECT
		per.serial_per,
		alu.serial_alu,
		nombre_per,
		concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,
		nombre2_alu) AS nombre 
	FROM
		materiamatriculada        AS mmat,
		alumno                    AS alu,
		detallemateriamatriculada AS dmat,
		periodo                   AS per,
		materia                   AS mat,
		horario                   AS hrr,
		notas                     AS nts 
	WHERE
		mmat.serial_mmat = dmat.serial_mmat 
		AND mmat.serial_per = per.serial_per 
		AND mmat.serial_alu = alu.serial_alu 
		AND hrr.serial_hrr = dmat.serial_hrr 
		AND dmat.serial_mat = mat.serial_mat 
		AND nts.serial_hrr = hrr.serial_hrr 
		AND per.serial_sec = 1 
		AND fecini_per>='2011-01-01' and fecini_per<='2011-12-31'
		AND per.serial_suc=3
		AND estado_hrr = 'ACTIVO' 
		
	GROUP BY
		alu.serial_alu 
	ORDER BY
		nombre
";
$arrMain = $dblink->GetAll($sqlMain);
//echo "<br>SQL<br> : ".$sqlMain."<br>";
//and alu.serial_alu = 3924
$totAll = count($arrMain);
/*AND per.serial_per IN (298,
		299,
		310,
		307,
		308,
		309) */

//print "<pre>ANTES: ";print_r($arr);print "<pre>";	
//$arrN = orderMultiDimensionalArray ($arr, $field, true);   
//print "<pre>DESPUES: ";print_r($arrN);print "<pre>";	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reporte Notas 2010</title>
<style type="text/css">
<!--
.style1 {font-size: 10px}
-->
</style>
</head>

<body>
<table width="200" border="1" cellpadding="1">
  <tr>
    <td><strong>#</strong></td>
	<td><strong>Nombre</strong></td>   
	<td><strong>Malla</strong></td>
    <td><strong>Materia</strong></td>
    <td><strong>Nota/4</strong></td>
    <td><strong>Nota/100</strong></td>
    <td><strong># Credito</strong></td>
    <td><strong>Periodo</strong></td>
    <td><strong>Estado</strong></td>
  </tr>
 <?php 
  for($i=0;$i<$totAll;$i++){	
	$arrMat = getMat($arrMain[$i]['serial_alu'],$dblink);
  	$totMat = count($arrMat);
	for($j=0;$j<$totMat;$j++){		

  ?>
  <tr>
    <td><div align="center" class="style1"><?php echo $i + 1;?></div></td>
    	
	<td nowrap="nowrap"><div align="center" class="style1"><?php echo $arrMain[$i]['nombre'];?></div></td>
	<td nowrap="nowrap"><div align="center" class="style1"><?php echo $arrMat[$j]['nombre_maa'];?></div></td>
	<td ><div align="center" class="style1"><?php echo $arrMat[$j]['materia'];?></div></td>
    <td><div align="center" class="style1"><?php echo "&nbsp;";?></div></td>
    <td><div align="center" class="style1"><?php echo $arrMat[$j]['notatotal_nal']?></div></td>
    <td><div align="center" class="style1"><?php echo $arrMat[$j]['creditomalla']?></div></td>
    <td><div align="center" class="style1"><?php echo $arrMat[$j]['nombre_per'];?></div></td>
    <td><div align="center" class="style1"><?php echo $arrMat[$j]['estado_nal'];?></div></td>
  </tr>
 <?php 
  	}
  }
  ?>
</table>

</body>
</html>

<?php 
function getMat($serial_alu,$dblink){
	$sqlGet = "
		SELECT
			detallemateriamatriculada.serial_mat,
			notasalumnos.serial_dmat,
			codigo_mat,			
			nombre_mat                                                                 
			AS materia,
			dnal_1.nota_dnal                                                           
			AS actividades_clase,
			dnal_2.nota_dnal                                                           
			AS trabajos,
			dnal_3.nota_dnal                                                           
			AS ex_parcial,
			dnal_4.nota_dnal                                                           
			AS ex_final,
			(dnal_1.nota_dnal + dnal_2.nota_dnal +dnal_3.nota_dnal + dnal_4.nota_dnal) 
			AS TOTAL,
			notatotal_nal,
			'' as nombre_maa,
			notaalfabetica_nal,
			''                                                                         
			AS notanumerica,
			''                                                                         
			AS creditomalla,
			''                                                                         
			AS tipomateria,
			estado_nal,
			nombre_per,
			periodo.serial_sec,
			numerocreditos_dmat creditosmateria,
			(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados,
			notasalumnos.serial_cale 
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
			AND materiamatriculada.serial_alu = ".$serial_alu." 
			AND periodo.serial_sec = 1 
			AND fecini_per>='2011-01-01' and fecini_per<='2011-12-31'
			AND periodo.serial_suc=3
			
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO') 
			AND materia.serial_mat=detallemateriamatriculada.serial_mat 
			AND detallemateriamatriculada.serial_mat IN (   SELECT
																mat.serial_mat 
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
																AND ama.serial_alu = ".$serial_alu."
																AND maa.serial_sec = 1 
			)
		ORDER BY
			fecini_per,
			materia
		

	";
	if($arr = $dblink->GetAll($sqlGet)){
		for($i=0;$i<count($arr);$i++){	
			$arrMalla = getCredito($serial_alu,$arr[$i]['serial_mat'],$dblink);
			if($arrMalla){
				$arr[$i]['creditomalla'] = $arrMalla[0]['numerocreditos_dma'];
				$arr[$i]['nombre_maa'] = $arrMalla[0]['nombre_maa'];
			}
			
		}
	return $arr;	
	}else{
		return false;
	}
}

//creditos malla
function getCredito($serial_alu,$serial_mat,$dblink){
	$sqlGet = "
	SELECT	
		maa.serial_maa,dma.serial_dma,nombre_maa,dma.serial_mat,mat.nombre_mat,dma.numerocreditos_dma
	FROM
		malla       AS maa,
		alumnomalla  AS ama,
		detallemalla AS dma,
		materia     AS mat 
	WHERE
		maa.serial_maa = ama.serial_maa 
		AND dma.serial_maa = maa.serial_maa 
		AND mat.serial_mat = dma.serial_mat 
		AND ama.serial_alu = ".$serial_alu."
		AND mat.serial_mat = ".$serial_mat."
		AND maa.serial_sec = 1
	";	
//echo "<br>CRED: ".$sqlGet."<br>";
	//echo "<br>CRED: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}



?>

