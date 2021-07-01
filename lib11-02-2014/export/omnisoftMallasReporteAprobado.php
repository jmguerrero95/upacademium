<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Evolucion de Mallas</title>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
    <link href="tooltip/theme/style.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="tooltip/js/jquery-1.3.1.min.js"></script>
    <script type="text/javascript" src="tooltip/js/jquery.betterTooltip.js"></script>

    <script type="text/javascript">
		$(document).ready(function(){
			$('.tTip').betterTooltip({speed: 150, delay: 300});
		});
	</script>

 <style type="text/css">
<!--
.style1 {font-size: 36px}
.style2 {font-size: 13px}

-->
</style>


    
</head>


<?php
	require('../adodb/adodb.inc.php');
    require('../../config/config.inc.php');
	global $DBConnection;
    $dblink = NewADOConnection($DBConnection);
 	$serial_maa = $_GET['serial_maa'];
	$serial_alu = $_GET['serial_alu'];
	//Titulos de Alumno
	$sqlAlumno = "
		SELECT
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS alumno,
			serial_suc
			 
		FROM
			alumno 
		WHERE
			serial_alu = ".$serial_alu."
	";
	$arrAlumno = $dblink->GetAll($sqlAlumno);
	$serial_suc = $arrAlumno[0]['serial_suc'];
	//Titulos de Malla y Facultad
	$sqlMalla = "
		SELECT
			maa.serial_maa,
			codigo_maa,
			nombre_maa,
			nombre_fac,
			nombre_esp,
			nombre_car,
			totalcreditostitulo_maa,
			fecini_maa,
			fecfin_maa,
			activo_maa,
			observaciones_maa,
			car.serial_car,
			esp.serial_esp,
			fac.serial_fac,
			serial_sec 
		FROM
			malla AS maa,
			facultad AS fac,
			carrera AS car,
			especialidad AS esp 
		WHERE
			car.serial_car = maa.serial_car 
			AND esp.serial_esp = maa.serial_esp 
			AND fac.serial_fac = car.serial_fac 
			AND maa.serial_maa = ".$serial_maa."	
	";	
	$arrMalla = $dblink->GetAll($sqlMalla);
	$serial_sec = $arrMalla[0]['serial_sec'];
	//Areas de la malla
	$sqlArea = "
		SELECT
			DISTINCT nombre_are,
			ARE.serial_are 
		FROM
			area AS ARE,
			nivel AS niv,
			detallemalla AS dma,
			materia AS mat,
			malla AS maa,
			especialidad AS esp 
		WHERE
			ARE.serial_are = mat.serial_are 
			AND niv.serial_niv = dma.serial_niv 
			AND mat.serial_mat = dma.serial_mat 
			AND maa.serial_maa = dma.serial_maa 
			AND esp.serial_esp = maa.serial_esp 
			AND dma.serial_maa = ".$serial_maa."
		ORDER BY
			ubicacion_are
	";
	$arrArea = $dblink->GetAll($sqlArea);
	$totArea = count($arrArea);
	//Niveles
	$sqlNivel = "
		SELECT
			nombre_niv,
			anio_niv,
			serial_niv 
		FROM
			nivel AS niv 
		ORDER BY
			codigo_niv
	";
	$arrNivel = $dblink->GetAll($sqlNivel);
	$totNivel = count($arrNivel);
	$fecha_act = date("Y")."-".date("m")."-".date("d");	
	$sqlPerAct = "
		SELECT
			serial_per,
			nombre_per,
			fecini_per,
			fecfin_per,
			DATEDIFF(DATE_FORMAT('".$fecha_act."','%Y-%m-%d'),DATE_FORMAT(fecini_per,'%Y-%m-%d')) AS diff 
		FROM
			periodo 
		WHERE
			serial_suc = ".$serial_suc." 
		HAVING
			diff > 0 
		ORDER BY
			diff ASC
	";
	//echo "<br>".$sqlPerAct."<bt>";
	$arrPerAct = $dblink->GetAll($sqlPerAct);
	$totPerAct = count($arrPerAct);
	if($totPerAct>0){
		//echo "<br>PERIODO ACTUAL ES: ".$arrPerAct[0]['nombre_per']."<br>INICIO: ".$arrPerAct[0]['fecini_per']."<br>FINALIZA: ".$arrPerAct[0]['fecfin_per']."<br>";
		$periodo_actual = $arrPerAct[0]['serial_per'];
	}else{
		//echo "PERIODO INDETERMINADO <br>";
		$periodo_actual = "";
	}
	
?>


<body>
<table width="100%">
  <tr bgcolor="#FFFFFF">
    <td rowspan="4" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
    <th><strong><? echo $arrAlumno[0]['alumno'];?></strong></th>
  </tr>
  <tr>
    <th><? echo $arrMalla[0]['nombre_fac'];?></th>
  </tr>
  <tr>
    <th><? echo $arrMalla[0]['nombre_maa'];?></th>
  </tr>
  <tr>
    <th>ESPECIALIZACION:<? echo $result->fields['nombre_esp'];?></th>
  </tr>
</table>
<br />


<table width='200' border='1'>
  <tr>
  <?php 
	  echo "<th>&nbsp;</th>"; 
	  for($i=0;$i<$totArea;$i++){
		echo "<th>".$arrArea[$i]['nombre_are']."</th>";
	  }  
  ?>
  </tr>

  <?php 
	  //echo ".";
	  for($i=0;$i<$totNivel;$i++){
		echo 
		 "<tr>
			  <th>".$arrNivel[$i]['nombre_niv']."</th>";
			  for($j=0;$j<$totArea;$j++){
					$arr = getMat($serial_maa,$arrArea[$j]['serial_are'],$arrNivel[$i]['serial_niv'],$dblink);
					if($arr){
						echo "<td nowrap>";
						for($k=0;$k<count($arr);$k++){
							echo ($k+1)." ) ".$arr[$k]['nombre_mat']."<br>";
						}
						echo "</td>";
					}else{
						echo "<td>&nbsp;</td>";
					}
			  }
			  
		  echo "</tr>
		   ";
	  }  
  ?>

</table>
<br>
<table width="383" border="1" align="center">
  <tr>
    <td colspan="2"><div align="center"><strong>Leyenda</strong></div></td>
  </tr>
  <tr>
    <td width="54"><strong><font color='blue'>Azul</font></strong></td>
    <td width="270">Materia Aprobada </td>
  </tr>
  <tr>
    <td><strong><font color='green'>Verde</font></strong></td>
    <td>Materia Registrada en Curso </td>
  </tr>
  <tr>
    <td><strong><font color='orange'>Naranja</font></strong></td>
    <td>Materia Registrada Abandonada (ver Lupa <img src='../../images/buscar.png' width='20' height='20' border='0'/>)</td>
  </tr>
  <tr>
    <td><strong><font color='brown'>Cafe</font></strong></td>
    <td>Materia Planificada (ver Lupa <img src='../../images/buscar.png' width='20' height='20' border='0'/>) </td>
  </tr>
  <tr>
    <td><strong><font color='black'>Negro</font></strong></td>
    <td>Materia No Planificada </td>
  </tr>
</table>
</body>
</html>

<?php
function getMat($serial_maa,$serial_are,$serial_niv,$dblink){
	$sqlGet = "
	SELECT
		mat.serial_mat,
		mat.serial_are,
		codigo_mat,
		nombre_mat,
		niv.serial_niv,
		numerocreditos_dma 
	FROM
		area         AS ARE,
		materia      AS mat,
		detallemalla AS dtm,
		malla        AS maa,
		nivel        AS niv 
	WHERE
		ARE.serial_are = mat.serial_are 
		AND dtm.serial_maa = maa.serial_maa 
		AND dtm.serial_niv = niv.serial_niv 
		AND dtm.serial_mat = mat.serial_mat 
		AND maa.serial_maa = ".$serial_maa." 
		AND ARE.serial_are = ".$serial_are."  
		AND niv.serial_niv = ".$serial_niv." 
	";

	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		for($i=0;$i<count($arr);$i++){
			$arrAp = getMatAprobada($arr[$i]['serial_mat'],$dblink);
			//Verificar Aprobada
			if($arrAp){
				$arr[$i]['nombre_mat'] = "<strong><font color='blue'>".$arr[$i]['nombre_mat']." => ".$arr[$i]['codigo_mat']." => ".$arr[$i]['numerocreditos_dma']."</font></strong>";
			}else{
				//Verificar si esta cursando Actualmente o esta abandonada
				$arrReg = getMatRegistrada($arr[$i]['serial_mat'],$dblink);
				if($arrReg){
					switch($arrReg[0]['type']){
						case 'REGISTRADA': 
								$arr[$i]['nombre_mat'] = "<strong><font color='green'>".$arr[$i]['nombre_mat']." => ".$arr[$i]['codigo_mat']." => ".$arr[$i]['numerocreditos_dma']."</font></strong>";
								break;								
						case 'ABANDONADA':
								$cadr = "<div class='tTip' id='cloudd".$i."'"; 
								$cadr = $cadr . " title='"."Materia Abandonada en: <p>".$arrReg[0]['nombre_per']."'><img src='../../images/buscar.png' width='20' height='20' border='0'/></div>";
								$arr[$i]['nombre_mat'] = "<strong><font color='orange'>".$arr[$i]['nombre_mat']." => ".$arr[$i]['codigo_mat']." => ".$arr[$i]['numerocreditos_dma'].$cadr."</font></strong>";
								break;
					}					
				}else{
					//Por ultimo Verificar cuando se abre
					$arrAper = getMatApertura($arr[$i]['serial_mat'],$dblink);
					if($arrAper){						
						$cad = "<div class='tTip' id='cloud".$i."'";
						//echo "CONT ARR : ".count($arrAper);
						//print "<pre>";print_r($arrAper);print "<pre>";
						$cadM = "Materia Planificada Para: <p>";
						for($m=0;$m<count($arrAper);$m++){							
							$cadM = $cadM .($m+1).") ".$arrAper[$m]['nombre_per']."<p>";
							//echo "M: ".$m;
							
						}
						$cad = $cad . " title='".$cadM."'><img src='../../images/buscar.png' width='20' height='20' border='0'/></div>";
						$arr[$i]['nombre_mat'] = "<strong><font color='brown'>".$arr[$i]['nombre_mat']." => ".$arr[$i]['codigo_mat']." => ".$arr[$i]['numerocreditos_dma'].$cad."</font></strong>";
						//echo "cad: ".$cad;
					}else{
						$arr[$i]['nombre_mat'] = "<strong><font color='black'>".$arr[$i]['nombre_mat']." => ".$arr[$i]['codigo_mat']." => ".$arr[$i]['numerocreditos_dma']."</font></strong>";
					}
					
					
				}
			}
				
		}
		return $arr;
	}else{
		return false;
	}
}

function getMatAprobada($serial_mat,$dblink){
	$sqlGet = "
		SELECT
			detallemateriamatriculada.serial_mat,
			nombre_mat AS materia,
			estado_nal 
		FROM
			notasalumnos ,
			materia 
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
				JOIN detallemateriamatriculada 
				ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
				JOIN materiamatriculada 
				ON materiamatriculada.serial_mmat = detallemateriamatriculada.
				serial_mmat 
				JOIN alumno 
				ON materiamatriculada.serial_alu = alumno.serial_alu 
				JOIN periodo 
				ON periodo.serial_per=materiamatriculada.serial_per 
		WHERE
			materiamatriculada.serial_alu = ".$GLOBALS['serial_alu']."		
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO') 
			AND materia.serial_mat=detallemateriamatriculada.serial_mat 
			AND detallemateriamatriculada.serial_mat =
			".$serial_mat." 
			AND estado_nal='APRUEBA' 
			AND periodo.serial_sec = ".$GLOBALS['serial_sec']." 
		UNION
		SELECT
			dhom.serial_mat,
			nombre_mat AS materia,
			'APRUEBA' AS estado_nal 
		FROM
			homologacion hom,
			detallehomologacion dhom ,
			materia mat 
		WHERE
			hom.serial_hom=dhom.serial_hom 
			AND dhom.serial_mat = ".$serial_mat." 
			AND dhom.serial_mat = mat.serial_mat 
			AND serial_alu = ".$GLOBALS['serial_alu']." 
			AND hom.serial_sec = ".$GLOBALS['serial_sec']." 
		ORDER BY
			materia
	";

	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		return true;
	}else{
		return false;
	}
}

function getMatRegistrada($serial_mat,$dblink){
	$sqlGet = "
		SELECT
			dmat.serial_dmat,
			dmat.serial_mat,
			per.serial_per,
			nombre_per,
			'' as type,
			numerocreditos_dma AS creditostomados 
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			alumnomalla               AS ama ,
			malla                     AS maa,
			detallemalla              AS dma 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND mmat.serial_per = per.serial_per 
			AND ama.serial_alu= mmat.serial_alu 
			AND dmat.serial_dmat NOT IN (   SELECT
												serial_dmat 
											FROM
												notasalumnos 
			)
			AND maa.serial_maa = ama.serial_maa 
			AND maa.serial_maa = dma.serial_maa 
			AND dmat.serial_mat = dma.serial_mat 
			AND per.serial_sec = maa.serial_sec 
			AND mmat.serial_alu = ".$GLOBALS['serial_alu']."
			AND per.serial_sec = ".$GLOBALS['serial_sec']." 
			AND dmat.serial_mat = ".$serial_mat." 
			AND (dmat.fecharetiro_dmat ='0000-00-00' 
			AND dmat.retiromateria_dmat <>'SIN COSTO') 
	";

	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		//echo "<br>".$sqlGet."<br>";
		if($arr[0]['serial_per'] == $GLOBALS['periodo_actual']){
			$arr[0]['type'] = 'REGISTRADA';
		}else{			
			$arr[0]['type'] = 'ABANDONADA';
			
			//echo "<br>".$sqlGet."<br>";
		}	
		return $arr;
	}else{
		return false;
	}
}

function getMatApertura($serial_mat,$dblink){
	$sqlGet = "
		SELECT
			serial_dcun,
			nombre_mat,
			per.nombre_per,
			per.fecini_per,
			per.fecfin_per,
			estado_dcun 
		FROM
			detallecalendariounificado 
				LEFT JOIN calendariounificado 
				ON detallecalendariounificado.serial_cun = calendariounificado. 
				serial_cun 
				LEFT JOIN seccion 
				ON seccion.serial_sec = calendariounificado.serial_sec 
				LEFT JOIN materia 
				ON detallecalendariounificado.serial_mat = materia.serial_mat 
				LEFT JOIN area 
				ON materia.serial_are = area.serial_are 
				LEFT JOIN facultad 
				ON area.serial_fac = facultad.serial_fac 
				JOIN periodo AS per 
				ON per.serial_per = calendariounificado.serial_per 
		WHERE
			materia.serial_mat = ".$serial_mat." 
			AND estado_dcun = 'ABIERTA' 
			AND fecini_per >= '".$GLOBALS['fecha_act']."' 
			AND per.serial_suc = ".$GLOBALS['serial_suc']." 
		ORDER BY
			fecini_per
	";

	
	if($arr = $dblink->GetAll($sqlGet)){
		//echo "<br>".$sqlGet."<br>";
		return $arr;
	}else{
		return false;
	}
}





?>