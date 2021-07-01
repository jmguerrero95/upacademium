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

$serial_sec = $_GET['serial_sec'];
$serial_suc = $_GET['serial_suc'];
$per = explode('*',$_GET['serial_per']);
$serial_per = $per[0];
$anio = explode('-',$per[1]);
$anio = $anio[0];
$fechaTipoAlumno = '2009-01-01';
//Validaciones


//Get Datos de Alumnos

//Get Materias tomadas de la malla 
$serial_alu = $_GET['serial_alu'];
$sqlMainP = "
SELECT
    alu.serial_alu,
    concat_ws(' ',apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) as alumno,
    per.serial_per,
	'' as tipo_alu,
	mmat.serial_suc,
	mmat.serial_sec,
	mmat.serial_mmat,
    per.nombre_per,
	suc.nombre_suc,
	sex.descripcion_sex 
FROM
    materiamatriculada AS mmat,
    periodo AS per,
    alumno AS alu,
	sucursal as suc,
	sexo as sex
WHERE
    mmat.serial_per = per.serial_per 
	AND alu.serial_suc = suc.serial_suc
    AND mmat.serial_alu = alu.serial_alu 
    AND alu.serial_sex = sex.serial_sex	
	and per.serial_per = ".$serial_per."
	AND mmat.serial_alu = ".$serial_alu."	
GROUP BY
	alu.serial_alu

";
echo "<br>".$sqlMainP."<br>";

//	AND mmat.serial_alu = ".$serial_alu."	
//AND mmat.serial_alu = ".$serial_alu."	
$arrMainP = $dblink->GetAll($sqlMainP);
$totAllP = count($arrMainP);
//Parametrizacion
$arrAluCuadroHonor = array();
$j = 0;
//echo "<br>totAllP: ".$totAllP."<br>";
for($i=0;$i<$totAllP;$i++){
	//echo "<br>I: ".$i."<br>";
	$nom = $arrMainP[$i]['alumno'];
	$suc = $arrMainP[$i]['nombre_suc'];
	$sex = $arrMainP[$i]['descripcion_sex'];
	$arrT = getTipoAlumno($arrMainP[$i]['serial_alu'],$serial_sec,$dblink);	
	if($arrT){
		$arrMainP[$i]['tipo_alu'] = $arrT[0]['tipo_alu']; 
	}
	$arr = evaluarAlumno($arrMainP[$i]['serial_alu'],$arrMainP[$i]['tipo_alu'],$arrMainP[$i]['serial_suc'],$arrMainP[$i]['serial_sec'],$anio,$dblink);
	if($arr){
		$arrAluCuadroHonor[$j]['nombre'] = $nom;
		$arrAluCuadroHonor[$j]['nombre_suc'] = $suc;
		$arrAluCuadroHonor[$j]['descripcion_sex'] = $sex;		
		$arrAluCuadroHonor[$j]['serial_alu'] = $arr[0]['serial_alu'];
		$arrAluCuadroHonor[$j]['serial_mmat'] = $arr[0]['serial_mmat'];
		$arrAluCuadroHonor[$j]['serial_per'] = $arr[0]['serial_per'];
		$arrAluCuadroHonor[$j]['tcreditos_pregulares'] = $arr[0]['tcreditos_pregulares'];
		$arrAluCuadroHonor[$j]['tcreditos_pintensivos'] = $arr[0]['tcreditos_pintensivos'];
		$arrAluCuadroHonor[$j]['consecutivo'] = $arr[0]['consecutivo'];
		$arrAluCuadroHonor[$j]['promedio'] = $arr[0]['promedio'];
		$arrAluCuadroHonor[$j]['honor'] = $arr[0]['honor'];
		$arrAluCuadroHonor[$j]['acumulado'] = $arr[0]['acumulado'];
		$arrAluCuadroHonor[$j]['nombre_maa'] = $arrMainP[$i]['tipo_alu'];
		$arrAluCuadroHonor[$j]['nombre_crp'] = $arrMainP[$i]['serial_alu'];
		$j++;
		//echo "...EVALUAR...";
	}else{
		//echo "...DESCARTAR...";
	}

}
$totCuadroHonor = count($arrAluCuadroHonor);
//print "<pre>CUADRO HONOR: ";print_r($arrAluCuadroHonor);print "<pre>";	

/*
for($i=0;$i<$totAll;$i++){	
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
          <p class="">CUADROS DE (<?php echo $totAll;?>)HONOR </p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo "AÑO ACADEMICO: ".$anio;?> </span></th>
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
            <th>Alumno</th>
			<th>Sexo</th>
            <th>Tipo Honor </th>
            <th>Promedio Acumulado </th>
			<th>Sucursal </th>
		    <th>Tipo Alumno </th>
		    <th>Serial Alumno </th>
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
		 for($i=0;$i<$totCuadroHonor;$i++){	
		?>
        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td  align="left" nowrap><? echo $arrAluCuadroHonor[$i]['nombre']?></td>
			   <td  align="left" nowrap><? echo $arrAluCuadroHonor[$i]['descripcion_sex'];?></td>
               <td  align="left" nowrap><? echo $arrAluCuadroHonor[$i]['honor'];?></td>
               <td  align="left" nowrap><? echo $arrAluCuadroHonor[$i]['acumulado'];?></td>
			   
			   <td align="left" nowrap><? echo $arrAluCuadroHonor[$i]['nombre_suc'];?> </td>		   	
		       <td align="right"><? echo $arrAluCuadroHonor[$i]['nombre_maa']; ?> </td>
		       <td align="right"><? echo $arrAluCuadroHonor[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrAluCuadroHonor[$i]['nombre_fac'];?></td>
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
function evaluarAlumno($serial_alu,$tipo_alu,$serial_suc,$serial_sec,$anio,$dblink){
	//Evaluacion segun tipo alumno
	echo "<br>Tipo Alu: ".$tipo_alu."<br>";	
	switch($tipo_alu){
		case 'NUEVO':			
			$condicion = "";
			$sumPerRegularPlanificado = 12;
			$sumPerIntensivoPlanificado = 6;
			break;			
		case 'ANTIGUO':
			$condicion = "AND intensivo_per = 'NO'";
			$sumPerRegularPlanificado = 12;
			$sumPerIntensivoPlanificado = 0;
			break;
		case 'NO DEFINIDO':
			return false;
			break;
	}
	//Periodos Proyectados para Evaluacion
	$sqlPer = "
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
			".$condicion." 			
		ORDER BY
			fecini_per
		";
	echo "<br>SQL PERIODO PROYECTADO: ".$sqlPer."<br>";
	$arrPer = $dblink->GetAll($sqlPer);
	$totPer = count($arrPer);	
	//Tomar el periodo de referencia y buscarlo dentro del arreglo de periodos para recorrerlos hacia atras 4
	//echo "<br>Per: ".$sqlPer."<br>";
	for($i=0;$i<$totPer;$i++){
		if($arrPer[$i]['serial_per']== $GLOBALS['serial_per']){
			$posSearch = $i;
			//echo "El periodo buscado es: ".$arrPer[$i]['serial_per']." Se Llama: ".$arrPer[$i]['nombre_per']." y esta en la posicion: ".$posSearch."<br>";
	
		}
	}	
	$totEvPer = 3;	
	$posStart = ($posSearch - $totEvPer);	
	$arrPerEval = array();
	$cont = 0;
	//echo "<br>POS: ".$posSearch."<br>";
	//echo "<br>COMIENZA: ".$posStart."<br>";
	$cad = "";
	$coma = ",";	
	//Sacar toda la informacion de los periodos a evaluar
	for($i=$posStart;$i<$posSearch;$i++){
		$arrPerEval[$cont]['posicion'] = $i;
		$arrPerEval[$cont]['serial_per'] = $arrPer[$i]['serial_per'];
		$arrPerEval[$cont]['nombre_per'] = $arrPer[$i]['nombre_per'];	
		$arrPerEval[$cont]['fecini_per'] = $arrPer[$i]['fecini_per'];
		$arrPerEval[$cont]['fecfin_per'] = $arrPer[$i]['fecfin_per'];
		$arrPerEval[$cont]['intensivo_per'] = $arrPer[$i]['intensivo_per'];		
		$arrPerEval[$cont]['serial_suc'] = $arrPer[$i]['serial_suc'];	
		$arrPerEval[$cont]['serial_sec'] = $arrPer[$i]['serial_sec'];	
		if($i==$posSearch ){
			$coma = "";
		}
		$cad = $cad . $arrPer[$i]['serial_per'] . $coma;
		$cont++;
		//echo "<br>Planificado: ".$arrPer[$i]['nombre_per']."<br>";
	}
	$nPerPlanificados = count($arrPerEval);	
	//print "<pre>";print_r($arrPerEval);print "<pre>";


	//$arr = getTipoAlumno($serial_alu,$serial_sec,$dblink);
	//echo "<br>ANIO: ".$anio."<br>";
	$minCreditosRegulares = 5;
	$minCreditosIntensivos = 0;
	//Evaluacion de Periodos Ejecutados
	$sqlReg = "
	SELECT
		detallemateriamatriculada.serial_mat,
		periodo.serial_per,
		materiamatriculada.serial_alu,
		materiamatriculada.serial_mmat,		
		periodo.nombre_per,
		SUM(numerocreditos_dmat) totalcredito,
		'' as totalcreditosperiodo,
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
	WHERE
		materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
		AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
		AND materiamatriculada.serial_alu = alumno.serial_alu 
		AND periodo.serial_per = materiamatriculada.serial_per 
		AND materiamatriculada.serial_alu = ".$serial_alu." 
		AND periodo.serial_sec = ".$serial_sec." 
		AND (fecharetiro_dmat ='000-00-00' 
		AND retiromateria_dmat <>'SIN COSTO') 
		AND periodo.serial_per IN (".$cad.")
		AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	GROUP BY
		periodo.serial_per 
	ORDER BY
		fecini_per
	";
	//echo "<br>EJECUTADO REGISTRO: ".$sqlReg."<br>";
	$arrReg = $dblink->GetAll($sqlReg);
	//if(count($arrReg)<=0 or count($arrReg)<$nPerPlanificados){
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
	//echo "<br>PERIODOS REGISTRADOS: ".count($arrReg)."<br>";
	//alumno antiguo sin periodos intensivos
	$arrPRegulares = array();
	$arrPIntensivos = array();
	for($i=0;$i<count($arrReg);$i++){			
		//$arrReg[$i]['totalcreditosperiodo'] = getEvalPeriodo($serial_alu,$serial_sec,$arrReg[$i]['serial_per'],$dblink);
		switch($arrReg[$i]['intensivo_per']){
			case 'NO':
					$arrPRegulares[$contPerRegularEjec] = $arrReg[$i]['serial_per'];
					$contPerRegularEjec++;
					$sumPerRegularEjec = $sumPerRegularEjec + $arrReg[$i]['totalcredito'];
				break;
			case 'SI':
					$arrPIntensivos[$contPerIntensivoEjec] = $arrReg[$i]['serial_per'];
					$contPerIntensivoEjec++;
					$sumPerIntensivoEjec = $sumPerIntensivoEjec + $arrReg[$i]['totalcredito'];
				break;
		}		
		//echo "<br> Ejecutado: ".$arrReg[$i]['nombre_per']."<br>";
	}
	//echo "<br> SUM REGULAR ANTES: ".$sumPerRegularEjec."<br>";
	//echo "<br> SUM REGULAR ANTES: ".$sumPerIntensivoEjec."<br>";

	//Validacion todos los periodos regulares ejecutados deben ser mayores a 12 creditos
	for($i=0;$i<count($arrReg);$i++){
		if($arrReg[$i]['totalcredito']<$sumPerRegularPlanificado){
			return false;
		}
	}	

	//Validacion division por 0
	if($contPerRegularEjec==0){
		$contPerRegularEjec = 1;
	}
	if($contPerIntensivoEjec==0){
		$contPerIntensivoEjec = 1;
	}
	$sumPerRegularEjec = $sumPerRegularEjec / $contPerRegularEjec;
	$sumPerIntensivoEjec = $sumPerIntensivoEjec / $contPerIntensivoEjec;
	//Validacion la suma de los periodos intensivos ejecutados deben ser mayores a 6 creditos
	if($sumPerIntensivoEjec<$sumPerIntensivoPlanificado){
		return false;
	}
	//echo "<br> SUM REGULAR DESPUES: ".$sumPerRegularEjec."<br>";
	//echo "<br> SUM REGULAR DESPUES: ".$sumPerIntensivoEjec."<br>";


	//print "<pre>ARREGLO CON PERIODOS: ";print_r($arrReg);print "<pre>";	
			
	
	//Verificar Consecutivo.
	$sumPerConsecutivo = 0;
	for($i=0;$i<count($arrPerEval);$i++){			
		if($arrPerEval[$i]['serial_per'] == $arrReg[$i]['serial_per']){			
			$sumPerConsecutivo++;			
		}		
	}
	if($sumPerConsecutivo>=3){
		$consecutivoOk = 'SI';
	}else{
		$consecutivoOk = 'NO';
	}
	//echo "<br>CONSECUTIVO: ".$consecutivoOk."<br>";
	//echo "<br>PERIODOS REGULARES: ".$contPerRegularEjec." TOTAL CREDITOS REGULARES: ".$sumPerRegularEjec."<br>";
	//echo "<br>PERIODOS INTENSIVOS: ".$contPerIntensivoEjec."TOTAL CREDITOS INTENSIVOS: ".$sumPerIntensivoEjec."<br>";
	
	//Obtener Promedios por Periodos Regulares
	for($i=0;$i<count($arrPRegulares);$i++){
		$serial_per = $arrPRegulares[$i];		
		$promedioAcumuladoReg[$i]['promedio'] = getPromedioTrimestre($serial_alu,$serial_per,$serial_sec,$dblink);	
	}
	//Obtener Promedios por Periodos Intensivos
	$cadInt = "";
	$comaInt = ",";
	for($i=0;$i<count($arrPIntensivos);$i++){
		if($arrPIntensivos == count($arrPIntensivos)){
			$comaInt = "";
		}
		$cadInt = $cadInt . $arrPIntensivos[$i] .$comaInt;
		//$serial_per = $arrReg[$i]['serial_per'];		
		//$promedioAcumuladoReg[$i]['promedio'] = getPromedioTrimestre($serial_alu,$serial_per,$serial_sec,$dblink);	
	}	
	$promedioAcumuladoInt[0]['promedio'] = getPromedioTrimestre($serial_alu,$cadInt,$serial_sec,$dblink);	
	
	//
	//obtengan por trimestre un Promedio Acumulado de entre 3.500 o más, serán nominados en el Cuadro de Cancillería, Cuadro de Altos Honores o Cuadro de Honores, según corresponda: 
//Cancillería 4.000
//Altos Honores 3.700 a 3.999
//Honores 3.500 a 3.699
	//Sumar los promedios de los periodos regulares
	$arr = array();
	$totAcumulado = 0;
	$contAcumulado = count(promedioAcumuladoReg);
	for($i=0;$i<$contAcumulado;$i++){
		$totAcumulado = $totAcumulado + $promedioAcumuladoReg[$i]['promedio'];	
	}
	//Sumar el acumulado del trimestre unico intensivo
	$totAcumulado = $totAcumulado + $promedioAcumuladoInt[0]['promedio'];	
	
	if($contAcumulado>0){
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
	if($finalAcumulado<3.500){
		$tipoHonor = "ES UNA VERGUENZA DE ESTUDIANTE COMUN";
	}
	$creditosTotal = 0;	
	$creditosTotal = $sumPerRegularEjec + $sumPerIntensivoEjec;
	if($sumPerRegularEjec>=$sumPerRegularPlanificado and $sumPerIntensivoEjec>=$sumPerIntensivoPlanificado and $consecutivoOk == 'SI' and $finalAcumulado>=3.500){
		$arr[0]['serial_alu'] = $arrReg[0]['serial_alu'];
		$arr[0]['serial_mmat'] = $arrReg[0]['serial_mmat'];
		$arr[0]['serial_per'] = $arrReg[0]['serial_per'];
		$arr[0]['tcreditos_pregulares'] = $sumPerRegularEjec;
		$arr[0]['tcreditos_pintensivos'] = $sumPerIntensivoEjec;
		$arr[0]['consecutivo'] = $consecutivoOk;
		$arr[0]['promedio'] = $promedioAcumuladoReg;
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
		AND materiamatriculada.serial_per in( ".$serial_per.")
	
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
			//echo "DE LA MALLA";
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
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

function getTipoMalla($serial_alu,$serial_mat,$serial_sec,$dblink){
	$sqlGet = "
			SELECT
			maa.serial_maa,
			dma.serial_dma,
			nombre_maa,
			dma.serial_mat,
			mat.nombre_mat,
			dma.numerocreditos_dma, 
			totalcreditos_maa
		FROM
			malla        AS maa,
			alumnomalla  AS ama,
			detallemalla AS dma,
			materia      AS mat 
		WHERE
			maa.serial_maa = ama.serial_maa 
			AND dma.serial_maa = maa.serial_maa 
			AND mat.serial_mat = dma.serial_mat 
			AND serial_maa_p = 0
			AND ama.serial_alu = 2416 	
			AND maa.serial_sec = 1

	";	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

/*
* Funcion que devuelve alumno antiguo o nuevo basado en la fecha de inicio de malla
*/
function getTipoAlumno($serial_alu,$serial_sec,$dblink){
	//echo "hello"."<br>";
	$sqlGet = "
		SELECT
			maa.serial_maa,
			dma.serial_dma,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
			nombre_maa,
			maa.fecini_maa,
			nombre_suc,
			CASE 
				WHEN fecini_maa >='".$GLOBALS['fechaTipoAlumno']."' 
				THEN 'NUEVO' 
				ELSE 'ANTIGUO' 
			END                                                                                
			AS tipo_alu			 
		FROM
			malla        AS maa,
			alumnomalla  AS ama,
			sucursal     AS suc,
			alumno       AS alu,
			detallemalla AS dma,
			materia      AS mat 
		WHERE
			maa.serial_maa = ama.serial_maa 
			AND dma.serial_maa = maa.serial_maa 
			AND mat.serial_mat = dma.serial_mat 
			AND alu.serial_alu = ama.serial_alu 
			AND alu.serial_suc = suc.serial_suc 			
			AND ama.serial_alu = ".$serial_alu." 
			AND maa.serial_sec = ".$serial_sec." 
			AND serial_maa_p = 0 
		GROUP BY
			serial_maa

	";	
	echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		//echo "<br>FECINI_MAA: ".$arr[0]['fecini_maa']."<br>";
		if($arr[0]['fecini_maa']=='0000-00-00'){			
			$arr[0]['tipo_alu'] =  'NO DEFINIDO';
		}
		return $arr;
	}else{
		return false;
	}
}

/*
* Funcion que devuelve un array con la sumatoria de periodos
*/
function getEvalPeriodo($serial_alu,$serial_sec,$serial_per,$dblink){
	//echo "hello"."<br>";
	$sqlGet = "
		SELECT
			detallemateriamatriculada.serial_mat,
			periodo.serial_per,
			materiamatriculada.serial_alu,
			materiamatriculada.serial_mmat,		
			periodo.nombre_per,
			numerocreditos_dmat,
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
		WHERE
			materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
			AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
			AND materiamatriculada.serial_alu = alumno.serial_alu 
			AND periodo.serial_per = materiamatriculada.serial_per 
			AND materiamatriculada.serial_alu = ".$serial_alu." 
			AND periodo.serial_sec = ".$serial_sec." 
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO') 
			AND periodo.serial_per = ".$serial_per."
			AND materia.serial_mat=detallemateriamatriculada.serial_mat 
		ORDER BY
			fecini_per		
	";	
	//echo "<br>FUNCION UNO A UNO POR PERIODO: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		$totCred = 0;
		for($i=0;$i<count($arr);$i++){
			$totCred = $totCred + $arr[$i]['numerocreditos_dmat'];
		}
		return $totCred;
	}else{
		return 0;
	}
}




/*

*/
/*
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
		AND periodo.serial_per IN (".$cad.")
		AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	GROUP BY
		periodo.serial_per 
	ORDER BY
		fecini_per
	";

*/



?>