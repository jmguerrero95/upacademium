<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {
	color: #CC0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//Gets
$serial_suc = $_GET['serial_suc'];
$serial_sec = $_GET['serial_sec'];
$serial_per = $_GET['serial_per'];

$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$fecha_act = date("Y")."-".date("m")."-".date("d");	
$per = explode('*',$serial_per);
$serial_per = $per[0];
//echo "<br>PERIODO: ".$serial_per."<br>";

if(strlen($fecha_ini)>0 or strlen($fecha_fin)>0){
	$periodo = "and fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' ";
}else{

	$sqPer = "
		SELECT
			fecfin_per 
		FROM
			periodo 
		WHERE	
	    serial_per = ".$serial_per.";
	";
	//echo "<br>SQLPERIODO: ".$sqPer."<br>";
	$arrPer = $dblink->GetAll($sqPer);
	$fecha_fin = $arrPer[0]['fecfin_per'];
	$periodo = "and periodo.serial_per = ".$serial_per;

}	
//sucursal
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = "and periodo.serial_suc = ".$serial_suc;
}
if($serial_sec=="T"){
	$seccion = " and periodo.serial_sec in (1,2) ";		
}else{
	$seccion = "and periodo.serial_sec = ".$serial_sec;
}


$sqlProf = "
SELECT 
	distinct (hrr.SERIAL_EPL) as serial_epl,
	'' as codInstitucion,
	'' as provincia,
	'' as canton,
	'' as parroquia,
	documentoidentidad_epl, 
	apellido_epl,
	'' as apellido_paterno,
	'' as apellido_materno,
	nombre_epl,
	concat_ws(' ',apellido_epl,nombre_epl) as nombre,
	direccion_epl,
	nombre_tct,
	epl.serial_tct,
	fechanacimiento_epl,
	'' as fechanacimiento,
	email_epl,
	emailuniv_epl,
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	FECHANACIMIENTO_EPL as fnacimiento,
	'' as sexo,
	sexo_epl,
	fechaingreso_epl,
	'' as fechaingresoinstitucion,
	concat_ws(' - ',catprof_epl,formaContrato_epl) as catprof_epl,
	nombre_fac,
	'' as formaciongen,
	formacontrato_epl,	
	fingresonomina_epl,
	nombre_car,
	niv.nombre_nac,
    nna.nombre_nac as nacionalidad,
	formaContrato_epl,
	nombre_fac,
	periodo.serial_suc,
	nombre_suc,
	UPPER(direccion_suc) as direccion_suc, 
	periodo.serial_sec

FROM
  	area,facultad,materia,periodo,empleado as epl, horario as hrr,sucursal as suc
	left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
	left join nivelacademico as niv on foa.serial_nac = niv.serial_nac	
	left join nacionalidad as nna on epl.serial_nac = nna.serial_nac
	left join tipocontratostrabajo as tct ON epl.serial_tct = tct.serial_tct
	left join escalafones as esc ON esc.serial_esc = epl.serial_esc
	left join cargos as car ON car.serial_car = esc.serial_car 
	left join tipoescalafones as tes ON tes.serial_tes = esc.serial_tes

WHERE
	hrr.serial_epl=epl.serial_epl
	and materia.serial_mat=hrr.serial_mat
	and area.serial_are=materia.serial_are
	and area.serial_fac=facultad.serial_fac
	and periodo.serial_per=hrr.serial_per
	and periodo.serial_suc = suc.serial_suc
	and tipoEmpleado_epl = 'PROFESOR' 
	and prospecto_epl = 'NO' 
	and fechaingreso_epl<='".$fecha_fin."'
	".$periodo."
	and estado_hrr='ACTIVO'
	".$sucursal."
	".$seccion."
	and hrr.serial_hrr in(select serial_hrr from detallemateriamatriculada)
	
GROUP BY
	hrr.serial_epl
ORDER BY
	nombre_suc	

";
//and hrr.serial_epl = 1556
//echo "<br>".$sqlProf."<br>";
$arrMain = $dblink->GetAll($sqlProf);
$totAll = count($arrMain);



//Parametrizacion
$arrAluCuadroHonor = array();
$j = 0;
/*for($i=0;$i<$totAll;$i++){
	//echo "<br>ANIOOO INICIAL: ".$anio."<br>";
	$arr = evaluarAlumno($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_suc'],$arrMain[$i]['serial_sec'],$anio,$dblink);
	if ($arr){
		$arrAluCuadroHonor[$j]['serial_alu'] = $arr[0]['serial_alu'];
		$arrAluCuadroHonor[$j]['serial_mmat'] = $arr[0]['serial_mmat'];
		$arrAluCuadroHonor[$j]['serial_per'] = $arr[0]['serial_per'];
		$arrAluCuadroHonor[$j]['tcreditos_pregulares'] = $arr[0]['tcreditos_pregulares'];
		$arrAluCuadroHonor[$j]['tcreditos_pintensivos'] = $arr[0]['tcreditos_pintensivos'];
		$arrAluCuadroHonor[$j]['consecutivo'] = $arr[0]['consecutivo'];
		$arrAluCuadroHonor[$j]['promedio'] = $arr[0]['promedio'];
		$arrAluCuadroHonor[$j]['honor'] = $arr[0]['honor'];
		$arrAluCuadroHonor[$j]['acumulado'] = $arr[0]['acumulado'];
		$j++;
		//echo "...EVALUAR...";
	}else{
		//echo "...DESCARTAR...";
	}

}*/
//$totCuadroHonor = count($arrAluCuadroHonor);
//print "<pre>";print_r($arrAluCuadroHonor);print "<pre>";	


/*for($i=0;$i<$totAll;$i++){	
	$arr = getTrimestre($arrMain[$i]['serial_alu'],$inicial,$final,$arrMain[$i]['serial_sec'],$dblink);
	if($arr){
		$arrMain[$i]['trimestre'] = $arr[0]['trimestre']."<br>".$arr[0]['msg'];
	}else{
		$arrMain[$i]['trimestre'] = "NO IDENTIFICADO";
	}
	$arrCT = getCreditosTomados($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_suc'],$arrMain[$i]['serial_sec'],$final,$dblink);
	if($arrCT){	
		//print "<pre>";print_r($arrCT);print "<pre>";
		$arrMain[$i]['creditostomados'] = $arrCT;
	}
	
	
}

*/
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px}

-->
</style>
<script>
function hideboton() {
	//document.getElementById('boton').style.visibility='hidden';  
}
//...........................................................
function showboton() {
	//document.getElementById('boton').style.visibility='visible';
}
function imprimir() {
 print ();
/*  if (factory.printing.Print(true)){
    //factory.printing.WaitForSpoolingComplete()
	cerrarV();
	}*/
 }
</script>
<div id="boton" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103" class="p1">
	<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">
</div>

<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <th >
          <p class="">PROFESORES TIEMPO REAL (<?php echo $totAll;?>)</p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_suc;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_sec;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $fechas;?></span></th>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th>Nº.</th>
            <th>Profesor</th>
			<th>Sexo</th>
            <th>Ingreso a Upac. </th>
            <th>Categoria</th>
			<th>Sucursal </th>
		    <th>Edad</th>
		    <th>Nivel Academico </th>
  		    <th>Facultad</th>
	    </tr>
        
        <?php  
		 /*
		 $arrAluCuadroHonor[$j]['serial_alu'] = $arr[0]['serial_alu'];
		$arrAluCuadroHonor[$j]['serial_mmat'] = $arr[0]['serial_mmat'];
		$arrAluCuadroHonor[$j]['serial_per'] = $arr[0]['serial_per'];
		$arrAluCuadroHonor[$j]['tcreditos_pregulares'] = $arr[0]['tcreditos_pregulares'];
		$arrAluCuadroHonor[$j]['tcreditos_pintensivos'] = $arr[0]['tcreditos_pintensivos'];
		$arrAluCuadroHonor[$j]['consecutivo'] = $arr[0]['consecutivo'];
		$arrAluCuadroHonor[$j]['promedio'] = $arr[0]['promedio'];
		$arrAluCuadroHonor[$j]['honor'] = $arr[0]['honor'];
		$arrAluCuadroHonor[$j]['acumulado'] = $arr[0]['acumulado'];
		$j++;
		//echo "...EVALUAR...";
	}else{
		//echo "...DESCARTAR...";
	}

}
$totCuadroHonor = count($arrAluCuadroHonor);
		 */
		 for($i=0;$i<$totAll;$i++){	
		?>
        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre']?></td>
			   <td  align="left" nowrap><? echo $arrMain[$i]['sexo_epl'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['fechaingreso_epl'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['catprof_epl'];?></td>
			   
			   <td align="left" nowrap><? echo $arrMain[$i]['nombre_suc'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['edad']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_nac'];?></td>
		       <td align="right"><? echo $arrMain[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="8" ><div align="right">TOTAL BECADOS : </div></th>
		  <th ><?php  echo $totCuadroHonor; ?> </th>
		  </tr>
		  <tr>
          <th colspan="9" align="center" ><div align="right">
           
            : </div>            </th>
		  </tr>		 
      </table>
        <BR><BR>
      <br /></td></tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>

<?php 
function evaluarAlumno($serial_alu,$serial_suc,$serial_sec,$anio,$dblink){
	//echo "<br>ANIO: ".$anio."<br>";
	$minCreditosRegulares = 5;
	$minCreditosIntensivos = 0;
	$sqlAnioAcademico = "
	SELECT
		serial_per,
		nombre_per,
		fecini_per,
		fecfin_per,
		serial_suc,
		serial_sec,
		intensivo_per 
	FROM
		periodo 
	WHERE
		serial_sec = ".$serial_sec." 
		AND serial_suc = ".$serial_suc." 
		AND nombre_per LIKE '%PERIODO%".$anio."%' 
		AND nombre_per NOT LIKE '%".($anio + 1 )."%' 
	ORDER BY
		fecini_per
	";
	//echo "<br>PLANIFICADO";
	//echo "<br>".$sqlAnioAcademico."<br>";

	

	$sqlRegistro = "
	SELECT
		detallemateriamatriculada.serial_mat,
		periodo.serial_per,
		materiamatriculada.serial_alu,
		materiamatriculada.serial_mmat,		
		periodo.nombre_per,
		SUM(numerocreditos_dmat) totalcredito,
		periodo.intensivo_per,
		fecini_per,
		fecfin_per 
	FROM
		notasalumnos ,
		materia,
		materiamatriculada,
		detallemateriamatriculada,
		periodo,
		alumno 
		JOIN detallenotasalumnos AS dnal_1 ON dnal_1.serial_nal = notasalumnos.serial_nal AND dnal_1.serial_acal=1 
		JOIN detallenotasalumnos AS dnal_2 ON dnal_2.serial_nal = notasalumnos.serial_nal AND dnal_2.serial_acal=2 
		JOIN detallenotasalumnos AS dnal_3 ON dnal_3.serial_nal = notasalumnos.serial_nal AND dnal_3.serial_acal=3 
		JOIN detallenotasalumnos AS dnal_4 ON dnal_4.serial_nal = notasalumnos.serial_nal AND dnal_4.serial_acal=4 
	WHERE
		materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
		AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
		AND materiamatriculada.serial_alu = alumno.serial_alu 
		AND periodo.serial_per = materiamatriculada.serial_per 
		AND materiamatriculada.serial_alu = ".$serial_alu." 
		AND periodo.serial_sec = ".$serial_sec." 
		AND (fecharetiro_dmat ='000-00-00' 
		AND retiromateria_dmat <>'SIN COSTO') 
		AND periodo.serial_per IN ( SELECT
										serial_per 
									FROM
										periodo 
									WHERE
										serial_sec = ".$serial_sec." 
										AND serial_suc = ".$serial_suc." 
											AND nombre_per LIKE '%PERIODO%".$anio."%' 
										AND nombre_per NOT LIKE '%".($anio + 1 )."%' 
									ORDER BY
										fecini_per 
		)
		AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	GROUP BY
		periodo.serial_per 
	ORDER BY
		fechamatricula_mmat
	";
	//echo "<br>EJECUTADO: ".$sqlRegistro."<br>";
	$arrReg = $dblink->GetAll($sqlRegistro);
	if(count($arrReg)<=0){
		//echo "RETORNAR false";
		return false;
	}		
	$contPerRegularPlan = 0;
	$contPerIntensivoPlan = 0;
	$contPerRegularEjec = 0;
	$sumPerRegularEjec = 0;
	$contPerIntensivoEjec = 0;
	$sumPerIntensivoEjec = 0;

	for($i=0;$i<count($arrReg);$i++){			
		switch($arrReg[$i]['intensivo_per']){
			case 'NO':
					$contPerRegularEjec++;
					$sumPerRegularEjec = $sumPerRegularEjec + $arrReg[$i]['totalcredito'];
				break;
			case 'SI':
					$contPerIntensivoEjec++;
					$sumPerIntensivoEjec = $sumPerIntensivoEjec + $arrReg[$i]['totalcredito'];
				break;
		}		
		
		//echo "<br> Ejecutado".$arrReg[$i]['nombre_per']."<br>";
	}
	
	$arrPlanificado = $dblink->GetAll($sqlAnioAcademico);		
	$sumPerConsecutivo = 0;
	for($i=0;$i<count($arrPlanificado);$i++){			
		if($arrPlanificado[$i]['serial_per'] == $arrReg[$i]['serial_per']){			
			$sumPerConsecutivo++;
			//echo "<br>Planificado: ".$arrPlanificado[$i]['nombre_per']."<br>";
		}		
	}
	if($sumPerConsecutivo>=3){
		$consecutivoOk = 'SI';
	}else{
		$consecutivoOk = 'NO';
	}
	//echo "<br>PERIODOS REGULARES: ".$contPerRegularEjec." TOTAL CREDITOS REGULARES: ".$sumPerRegularEjec."<br>";
	//echo "<br>PERIODOS INTENSIVOS: ".$contPerIntensivoEjec."TOTAL CREDITOS INTENSIVOS: ".$sumPerIntensivoEjec."<br>";
	
	for($i=0;$i<count($arrReg);$i++){
		$serial_per = $arrReg[$i]['serial_per'];
		$promedioAcumulado[$i]['promedio'] = getPromedioTrimestre($serial_alu,$serial_per,$serial_sec,$dblink);	
	}	
	//
	//obtengan por trimestre un Promedio Acumulado de entre 3.500 o más, serán nominados en el Cuadro de Cancillería, Cuadro de Altos Honores o Cuadro de Honores, según corresponda: 
//Cancillería 4.000
//Altos Honores 3.700 a 3.999
//Honores 3.500 a 3.699
	$arr = array();
	$totAcumulado = 0;
	$contAcumulado = count($promedioAcumulado);
	for($i=0;$i<$contAcumulado;$i++){
		$totAcumulado = $totAcumulado + $promedioAcumulado[$i]['promedio'];	
	}
	if(contAcumulado>0){
		$finalAcumulado = number_format($totAcumulado/$contAcumulado,3);
	}else{
		$finalAcumulado = 0;
	}
	
	
	if($finalAcumulado>=4.000){
		$tipoHonor = "CANCILLERIA";				
	}
	if($finalAcumulado>=3.700 and $finalAcumulado<=3.999){
		$tipoHonor = "ALTOS HONORES";				
	}
	if($finalAcumulado>=3.500 and $finalAcumulado<=3.699){
		$tipoHonor = "HONORES";
	}
		
	if($sumPerRegularEjec>=12 and $sumPerIntensivoEjec>=0 and $consecutivoOk == 'SI' and $finalAcumulado>=1.500){
		$arr[0]['serial_alu'] = $arrReg[0]['serial_alu'];
		$arr[0]['serial_mmat'] = $arrReg[0]['serial_mmat'];
		$arr[0]['serial_per'] = $arrReg[0]['serial_per'];
		$arr[0]['tcreditos_pregulares'] = $sumPerRegularEjec;
		$arr[0]['tcreditos_pintensivos'] = $sumPerIntensivoEjec;
		$arr[0]['consecutivo'] = $consecutivoOk;
		$arr[0]['promedio'] = $promedioAcumulado;
		$arr[0]['acumulado'] = $finalAcumulado;		
		$arr[0]['honor'] = $tipoHonor;
		return $arr;
	}else {
		return false;
	}
}
  

function getPromedioTrimestre($serial_alu,$serial_per,$serial_sec,$dblink){

	$sqlMain = "
	SELECT
		detallemateriamatriculada.serial_mat,
		notasalumnos.serial_dmat,
		codigo_mat,
		nombre_mat AS materia,
		dnal_1.nota_dnal AS actividades_clase,
		dnal_2.nota_dnal AS trabajos,
		dnal_3.nota_dnal AS ex_parcial,
		dnal_4.nota_dnal AS ex_final,
		(dnal_1.nota_dnal + dnal_2.nota_dnal +dnal_3.nota_dnal + dnal_4.nota_dnal) AS TOTAL,
		notatotal_nal,
		notaalfabetica_nal,
		'' as notanumerica,
		'' as creditomalla,
		'' as tipomateria,
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
		JOIN detallenotasalumnos AS dnal_1 ON dnal_1.serial_nal = notasalumnos.serial_nal AND dnal_1.serial_acal=1 	
		JOIN detallenotasalumnos AS dnal_2 ON dnal_2.serial_nal = notasalumnos.serial_nal AND dnal_2.serial_acal=2 
		JOIN detallenotasalumnos AS dnal_3 ON dnal_3.serial_nal = notasalumnos.serial_nal AND dnal_3.serial_acal=3 
		JOIN detallenotasalumnos AS dnal_4 ON dnal_4.serial_nal = notasalumnos.serial_nal AND dnal_4.serial_acal=4
	WHERE
		materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
		AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
		AND materiamatriculada.serial_alu = alumno.serial_alu 
		AND periodo.serial_per = materiamatriculada.serial_per 
		AND materiamatriculada.serial_alu = ".$serial_alu." 
		AND periodo.serial_sec = ".$serial_sec." 
		AND (fecharetiro_dmat ='000-00-00' 
		AND retiromateria_dmat <>'SIN COSTO') 
		AND materia.serial_mat=detallemateriamatriculada.serial_mat 		 
		AND detallemateriamatriculada.serial_mat in (
			SELECT	
				mat.serial_mat
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
				and maa.serial_sec = ".$serial_sec." 		
	
		)
		AND materiamatriculada.serial_per = ".$serial_per."
	
	ORDER BY
		fecini_per,
		materia
	
	";
	//echo "<br>NOTAS: ".$sqlMain."<br>";
	$arrMain = $dblink->GetAll($sqlMain);
	$totAll = count($arrMain);
//
	//Parametrizacion
	for($i=0;$i<$totAll;$i++){	
		$arr = getEq($arrMain[$i]['serial_cale'],$arrMain[$i]['notaalfabetica_nal'],$dblink);
		if($arr){
			$arrMain[$i]['notanumerica'] = $arr[0]['numerica_dcale'];
		}
		$arr = getCredito($serial_alu,$arrMain[$i]['serial_mat'],$serial_sec,$dblink);
		if($arr){
			$arrMain[$i]['creditomalla'] = $arr[0]['numerocreditos_dma'];
			//echo "DEL LA MALLA";
			$arrMain[$i]['tipomateria'] = "DM";
		}else{
			$arrMain[$i]['creditomalla'] = $arrMain[$i]['creditosmateria'];
			//echo "DEL REGISTRO";
			$arrMain[$i]['tipomateria'] = "FM";
		}
	}
	//print "<pre>";print_r($arrMain);print "<pre>";	
	$totalCreditosRegistro = 0;
	for($i=0;$i<$totAll;$i++){		
		$totalCreditosRegistro = $totalCreditosRegistro + $arrMain[$i]['creditomalla'];				
		$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito +($arrMain[$i]['creditomalla']*$arrMain[$i]['notanumerica']);			
	}
	if($totalCreditosRegistro>0){
		$promedioSobreCuatro = number_format($totalNotaNumericaPorCredito/$totalCreditosRegistro,3);
	}else{
		$promedioSobreCuatro = 0.000;
	}
	
	
	//echo "<br>promedioSobreCuatro: ".$promedioSobreCuatro."<br>";	

	return $promedioSobreCuatro;
}

function getEq($serial_cale,$notaalfabetica_nal,$dblink){
	$sqlGet = "
	SELECT
		numerica_dcale 
	FROM 
		detallecalificacionequivalencia 
	WHERE 
	serial_cale = ".$serial_cale."
	AND alfabetica_dcale ='".$notaalfabetica_nal."'
	";	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}
//
function getCredito($serial_alu,$serial_mat,$serial_sec,$dblink){
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
		AND maa.serial_sec = ".$serial_sec."
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