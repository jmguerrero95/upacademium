<?php
	$serial_alu = $_GET['serial_alu'];
	$serial_sec = $_GET['serial_sec'];
	$serial_car = $_GET['serial_car'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NOTAS DEL ESTUDIANTE</title>
<style type="text/css">
<!--
.style2 {font-weight: bold}
-->

</style>
<script>
function fbuscar(){
	var query='omnisoftNotasAlumnoPeriodoFM.php?serial_alu=<?php echo $serial_alu;?>&serial_sec=<?php echo $serial_sec;?>&serial_car=<?php echo $serial_car;?>';
	var attributes='width=1020,height=650,scrollbars=yes,resizable=no,toolbar=no,location=no,status=no,menubar=no';
    window.open(query,"mat","width=850,height=650,scrollbars=YES"); 
}
</script>

</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//$serial_alu = $_GET['serial_alu'];
//$serial_sec = $_GET['serial_sec'];
//Get Datos de Alumnos
$sqlAlu = "
SELECT
	codigoIdentificacion_alu,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,
	nombre2_alu) AS alumno,
	direcciondomic_alu,
	lugartrabajo_alu,
	direcciontrabajo_alu,
	mail_alu,
	mailuniv_alu,
	telefodomic_alu,
	telefotrabajo_alu,
	nombre_maa,
	celular_alu,
	creditomax_maa,
	nombre_crp
FROM
	alumno,
	alumnomalla,
	malla 
	LEFT JOIN carrera ON carrera.serial_car=malla.serial_car 
	LEFT JOIN carreraprincipal ON carreraprincipal.serial_crp=carrera.serial_crp 
	LEFT JOIN facultad ON facultad.serial_fac=carrera.serial_fac 
WHERE
	alumno.serial_alu = alumnomalla.serial_alu 
	AND alumnomalla.serial_maa = malla.serial_maa 
	AND serial_maa_p = 0 
	AND malla.serial_sec = ".$serial_sec." 
	AND alumno.serial_alu = ".$serial_alu."
	AND malla.serial_car = ".$serial_car."
";
$arrAlu = $dblink->GetAll($sqlAlu);
//echo "ALUMNO: <br>".$sqlAlu."<br>";
//Get Materias tomadas de la malla 
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
	notasalumnos.serial_cale, case  seccion_hrr when 'AVANZADA' then seccion_hrr when 'UBICACION' then seccion_hrr else ' ' end as seccion_hrr 
FROM
	notasalumnos ,
	materia,
	materiamatriculada,
	detallemateriamatriculada,
	periodo,
	alumno,horario
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
	AND horario.serial_hrr=detallemateriamatriculada.serial_hrr
	AND estado_hrr = 'ACTIVO'
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
			and maa.serial_car = ".$serial_car." 		

	)	

ORDER BY
	fecini_per,
	materia

";
//echo "MATERIA: <b   r>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

if($totAll<=0){
	echo "<br>El alumno no tiene registro alguno de notas en su vida académica...<br>";
	exit(0);
}

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

//Contabilizar
$totalCreditosRegistro = 0;
$totalCreditosRegistroHom = 0;
$totalCreditosMalla = 0;
$totalNotaNumericaPorCredito = 0;
$totalNotaNumericaPorCreditoHom = 0;
$totalNotaFinal = 0;
$totalNotasAprueba = 0;
$totalCreditosHomologados = 0;
$totalCreditosRevalidados = 0;
$totalCreditosEspeciales = 0;
$totalCreditosNormales = 0;
$totalCreditosAprueba = 0;
$totalCreditosReprueba = 0;
$totalCreditos = 0;
$totalRestarCredito = 0;
$totalRestarMultiplicacion = 0;
$totalNotaSobreCuatro = 0;
$totalCreditosMalla = 0;
$totalIRA = 0;
$arr = getRepMat();
if($arr){
	//print "<pre>";print_r($arr);print "<pre>";
	for($i=0;$i<count($arr);$i++){
			$totalRestarCredito = $totalRestarCredito + $arr[$i]['devengarcreditos'];
			$totalRestarMultiplicacion = $totalRestarMultiplicacion + $arr[$i]['devengartotal'];
	}
	//echo "totalRestarCredito: ".$totalRestarCredito;
	//echo "totalRestarMultiplicacion: ".$totalRestarMultiplicacion;
				
}
for($i=0;$i<count($arr);$i++){
	if(strlen($arr[$i]['indiceok'])>0){
		$num = strlen($arr[$i]['posicion']);		
		$num = $num -1;
		$newCad = substr($arr[$i]['posicion'],0,$num);
		$arr[$i]['posicion'] = $newCad;		
		$posiciones  = explode('.',$arr[$i]['posicion']);
		//print "<pre>";print_r($posiciones);print "<pre>";
		$indice = $arr[$i]['indiceok'];		
		foreach($posiciones as $value){ 
			if (key($posiciones)!= $indice){
				//echo "<br>MARCAR: ".$posiciones[key($posiciones)]."<br>";
				$marcar = $posiciones[key($posiciones)];
				$arrMain[$marcar]['materia'] = "<font color='red'> ".$arrMain[$marcar]['materia']." (Materia Repetida.)"."</font>";	
			}
			next($posiciones); 
		} 
	
	}
	
	//echo "i: ".$i."<br>";

}	
//echo "<br>TCREDITOS: ".$totalRestarCredito."<br>";
//echo "<br>A RESTAR: ".$totalRestarMultiplicacion."<br>";
for($i=0;$i<$totAll;$i++){		
	$totalCreditosRegistro = $totalCreditosRegistro + $arrMain[$i]['creditomalla'];		
	$totalCreditosMalla = $totalCreditosMalla + $arrMain[$i]['creditomalla'];	
	$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito +($arrMain[$i]['creditomalla']*$arrMain[$i]['notanumerica']);			
	switch($arrMain[$i]['estado_nal']){
		case 'APRUEBA':
			$totalNotaFinal = $totalNotaFinal + $arrMain[$i]['notatotal_nal'];
			$totalNotaSobreCuatro = $totalNotaSobreCuatro +  $arrMain[$i]['notanumerica'];	
			$totalCreditosAprueba = $totalCreditosAprueba + $arrMain[$i]['creditomalla'];	
			$totalNotasAprueba++;
			break;
		case 'REPRUEBA':
			$totalCreditosReprueba = $totalCreditosReprueba + $arrMain[$i]['creditomalla'];	
			break;			
	}	
}
//devengar los creditos que no se tomaran en cuenta
$totalCreditosAprueba = ($totalCreditosAprueba + $totalCreditosReprueba) - $totalRestarCredito;


//TRATAMIENTO HOMOLOGACIONES
$sqlHom = "
	SELECT
		hom.serial_hom,
		dhom.serial_mat,
		serial_alu,
		tipo_hom,
		hom.serial_sec,
		nombre_mat,
		revalida_hom,
		'' as creditohom,
		'' as notaalfabeticah,
		'' as notanumericah,
		'' as estadoh,
		'' as tipo,
		fecha_hom,
		codigo_mat,
		notafinal_dhom
	FROM
		homologacion        AS hom,
		detallehomologacion AS dhom,
		materia              AS mat 
	WHERE
		hom.serial_hom = dhom.serial_hom 
		AND mat.serial_mat = dhom.serial_mat 
		AND hom.serial_alu = ".$serial_alu."
		AND hom.serial_sec = ".$serial_sec."
		AND hom.serial_car = ".$serial_car."
";
//echo "<br>".$sqlHom."<br>";

$arrHom = $dblink->GetAll($sqlHom);
$totHom = count($arrHom);
for($i=0;$i<$totHom;$i++){		
	$arr = getCredito($arrHom[$i]['serial_alu'],$arrHom[$i]['serial_mat'],$arrHom[$i]['serial_sec'],$dblink);
	if($arr){
		$arrHom[$i]['creditohom'] = $arr[0]['numerocreditos_dma'];		
	}
	$arr = getNotaHomologada($arrHom[$i]['serial_alu'],$arrHom[$i]['notafinal_dhom'],$dblink);
	if($arr){
		$arrHom[$i]['notaalfabeticah'] = $arr[0]['notaalfabeticah'];		
		$arrHom[$i]['notanumericah'] = $arr[0]['notanumericah'];		
		$arrHom[$i]['estadoh'] = $arr[0]['estadoh'];		
	}	

	switch($arrHom[$i]['tipo_hom']){
		case 'HOMOLOGACION':
			$totalCreditosHomologados = $totalCreditosHomologados + $arrHom[$i]['creditohom'];		
			$arrHom[$i]['tipo'] = 'HM->HOM';
			break;
		case 'REVALIDACION':
			if($arrHom[$i]['revalida_hom']=='NO'){
				$arrHom[$i]['estadoh'] = 'APRUEBA';
				$arrHom[$i]['notaalfabeticah'] = "";		
				$arrHom[$i]['notanumericah'] = "";	
				$arrHom[$i]['notafinal_dhom'] = "";	
			}			
			$totalCreditosRevalidados = $totalCreditosRevalidados + $arrHom[$i]['creditohom'];				
			$arrHom[$i]['tipo'] = 'HM->RVL'.'/'.$arrHom[$i]['revalida_hom'];
			break;			
	}
	
}

////
//Tratamiento de los creditos de graduacion
$totalCreditosGraduacionMalla = 0;
$totArrGradMalla = 0;
$arrCreditoGraduacionMalla = getCreditosGraduacionMalla($serial_alu,$serial_sec,$dblink);
if($arrCreditoGraduacionMalla){
	$totalCreditosGraduacionMalla = $arrCreditoGraduacionMalla['ncred']['ncred'];			
	//echo "entro";
	$totArrGradMalla = count($arrCreditoGraduacionMalla);
}else{
	$totalCreditosGraduacionMalla = 0;
	$totArrGradMalla = 0;
	
			
	
}

///


//INCLUSION DE CALCULO DE PROMEDIOS DE NOTAS DE HOMOLOGADAS
for($i=0;$i<$totHom;$i++){		
	if($arrHom[$i]['tipo_hom'] == 'HOMOLOGACION' or ($arrHom[$i]['tipo_hom'] == 'REVALIDACION' and $arrHom[$i]['revalida_hom']=='SI')){
		$totalCreditosRegistroHom = $totalCreditosRegistroHom + $arrHom[$i]['creditohom'];		
		$totalNotaNumericaPorCreditoHom = $totalNotaNumericaPorCreditoHom +($arrHom[$i]['creditohom']*$arrHom[$i]['notanumericah']);			
	}
}
$totalCreditosMalla = $totalCreditosHomologados + $totalCreditosRevalidados + $totalCreditosAprueba + $totalCreditosGraduacionMalla;
//Restar Creditos de Materias Repetidas solo se toma la nota aprobada
$totalCreditosRegistro = $totalCreditosRegistro - $totalRestarCredito;
//Sumar Creditos de Homologación
$totalCreditosRegistro = $totalCreditosRegistro + $totalCreditosRegistroHom; 
//Restar Creditos de Materias Repetidas solo se toma la nota aprobada
$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito - $totalRestarMultiplicacion;
//Sumar Total NotaNumerica por Credito de Homologacion
$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito +  $totalNotaNumericaPorCreditoHom;
//Format
$promedioSobreCuatro = number_format($totalNotaNumericaPorCredito/$totalCreditosRegistro,3);
$promedioSobreCien = number_format($totalNotaFinal/$totalNotasAprueba,2);
$totalCreditosAprueba = number_format($totalCreditosAprueba,2);
$totalCreditosReprueba = number_format($totalCreditosReprueba,2);
$totalCreditosNormales = number_format(($totalCreditosReprueba + $totalCreditosAprueba),2);
$totalIRA = number_format($totalNotaSobreCuatro/$totalCreditosAprueba,3);
//Resumen
$totalCreditosHomologados = number_format($totalCreditosHomologados,2);
$totalCreditosRevalidados = number_format($totalCreditosRevalidados,2);
$totalCreditosEspeciales = number_format(($totalCreditosHomologados + $totalCreditosRevalidados),2);
$totalCreditos = number_format(($totalCreditosEspeciales + $totalCreditosNormales),2);
$totalCreditosMalla = number_format(($totalCreditosMalla),2);
//Materias retiradas
$sqlMatRetiradas = "
SELECT
	serial_alu,
	nombre_per,
	codigo_mat,
	nombre_mat,
	numerocreditos_dmat,
	fecharetiro_dmat,
	retiromateria_dmat,
	per.serial_sec 
FROM
	materiamatriculada AS mmat,
	detallemateriamatriculada dmat,
	periodo            AS per,
	materia            AS mat 
WHERE
	mmat.serial_mmat = dmat.serial_mmat 
	AND mat.serial_mat = dmat.serial_mat 
	AND mmat.serial_per = per.serial_per 
	AND (fecharetiro_dmat <>'000-00-00' 
	AND retiromateria_dmat ='SIN COSTO') 
	AND mmat.serial_sec = ".$serial_sec." 
	AND mmat.serial_alu = ".$serial_alu."
	AND dmat.serial_mat in (
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
";
//echo "<br>".$sqlMatRetiradas."<br>";
$arrMatRetiradas = $dblink->GetAll($sqlMatRetiradas);
$totMatRetiradas = count($arrMatRetiradas);
//echo "<br>TOTAL RETIRADAS: ".$totMatRetiradas."<br>";




?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px}

-->
</style>
<script>
function hideboton() {
	document.getElementById('boton').style.visibility='hidden';  
}
//...........................................................
function showboton() {
	document.getElementById('boton').style.visibility='visible';
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
          <p class="">CERTIFICACION DE MATERIAS REGISTRADAS</p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $arrAlu[0]['nombre_crp'];?> </span></th>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th align="right">&nbsp;
          <script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></th>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1">
      <tr>
        <th width="15%" align="right">C&eacute;dula #: </th>
        <td width="35%"><span class='style2'><? echo $arrAlu[0]['codigoIdentificacion_alu'];?> </span></td>
        <th width="17%" align="right">Fono Casa: </th>
        <td width="33%"><span class="style2"><? echo $arrAlu[0]['telefodomic_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Nombre:</th>
        <td><span class="style2"><? echo $arrAlu[0]['alumno'];?></span></td>
        <th align="right">Celular:</th>
        <td><span class="style2"><? echo $arrAlu[0]['celular_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Direcci&oacute;n:</th>
        <td><span class="style2"><? echo $arrAlu[0]['direcciondomic_alu'];?></span></td>
        <th align="right">Email:</th>
        <td><span class="style2"><? echo $arrAlu[0]['mailuniv_alu']."<br>". $arrAlu[0]['mail_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Malla: </th>
        <th align="right"><div align="left"><span class="style2"><? echo $arrAlu[0]['nombre_maa'];?></span></div></th>
        <th align="right">Ver Materias  Fuera de Malla:</th>
        <td><a href="#" onclick="fbuscar()"><img src="../../images/buscar.png" alt="Mostrar Materias Fuera de la Malla" width="20" height="20" border="0" /></a></td>
      </tr>
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th colspan="10">CREDITOS REGISTRO MALLA </th>
        </tr>
        <tr>
          <th>Nº.</th>
          <th>Periodo</th>
          <th>Cod. </th>
		  <th>Materia </th>
		  <th>Nota Final </th>
		  <th>Nota Alfabetica </th>
  		  <th>Nota Numérica </th>
		  <th>Creditos Malla </th>
  		  <th>Estado </th>
		  <th>Tipo</th>
	    </tr>
   
		<?php  
		 $total_creditos_materia = 0;
		 $tot = 0;
		 $totreprobados = 0;
		 $num_mat=0;
		 $nota_final = 0;
		 $total_aprueba=0;
		   
		 for($i=0;$i<$totAll;$i++){	

			?>
		 
		  <tr>
		     <td  align="left" nowrap><? echo $i + 1; ?></td>
             <td  align="left" nowrap><?  echo $arrMain[$i]['nombre_per'];?></td>
             <td  align="left" nowrap><? echo $arrMain[$i]['codigo_mat']; ?> </td>
		     <td align="left" nowrap><? echo $arrMain[$i]['materia'];?> </td>		   	
		     <td align="right"><? echo $arrMain[$i]['notatotal_nal']; ?> </td>
		     <td align="right"><? echo $arrMain[$i]['notaalfabetica_nal'];?></td>
		     <td align="right"><? echo $arrMain[$i]['notanumerica'];?></td>
		     <td  align="left" nowrap><? echo $arrMain[$i]['creditomalla'];?> </td>		 
		     <td align="right"><? echo $arrMain[$i]['estado_nal'];?></td>
		     <td align="right"><? echo $arrMain[$i]['tipomateria']." <font color='red'>".$arrMain[$i]['seccion_hrr']."</font>";?></td>
		  </tr>
				
			<?php 
			}
			?> 
		<!--MATERIA HOMOLOGADAS-->		    

		<?php 
			if($totHom>0){			
		?>
		<tr>
	   	        <th colspan="10"  align="left" nowrap><div align="center"><strong>CREDITOS HOMOLOGACIONES</strong> </div></th>
        </tr>
		     <tr>
          <th>Nº.</th>
          <th>Periodo</th>
          <th>Cod. </th>
		  <th>Materia </th>
		  <th>Nota Final </th>
		  <th>Nota Alfabetica </th>
  		  <th>Nota Numérica </th>
		  <th>Creditos Malla </th>
  		  <th>Estado </th>
		  <th>Tipo</th>
	    </tr>
		<?php 
			}
		?>    
		<?php 
		$sw = $i+1;
		 for($j=0;$j<$totHom;$j++){	
		?>
	   	      
	   	 
	   	      <tr>
		    <td  align="left" nowrap><? echo $sw; ?></td>
		    <td  align="left" nowrap><?  echo $arrHom[$j]['fecha_hom'];?></td>
		    <td  align="left" nowrap><? echo $arrHom[$j]['codigo_mat']; ?></td>
		    <td align="left" nowrap><? echo $arrHom[$j]['nombre_mat'];?></td>
		    <td align="right"><? echo $arrHom[$j]['notafinal_dhom']; ?></td>
		    <td align="right"><? echo $arrHom[$j]['notaalfabeticah'];?></td>
		    <td align="right"><? echo $arrHom[$j]['notanumericah'];?></td>
		    <td  align="left" nowrap><? echo $arrHom[$j]['creditohom'];?></td>
		    <td align="right"><? echo $arrHom[$j]['estadoh'];?></td>
		    <td align="right" nowrap><? echo $arrHom[$j]['tipo'];?></td>
	    </tr>   

		<?php 
			$sw++;
		}			
		?>
		<!--MATERIA RETIRADAS-->
		<?php 
			if($totMatRetiradas>0){			
		?>

		<tr>
	        <th colspan="10"  align="left" nowrap><div align="center"><strong>CREDITOS RETIROS </strong></div></th>
        </tr>
		  <tr>
          <th>Nº.</th>
          <th>Periodo</th>
          <th>Cod. </th>
		  <th>Materia </th>
		  <th>Nota Final </th>
		  <th>Nota Alfabetica </th>
  		  <th>Nota Numérica </th>
		  <th>Creditos Malla </th>
  		  <th>Estado </th>
		  <th>Tipo</th>
	    </tr>
		<?php 
			}
		?>

				    
		<?php 
		$sw2 = $sw;
		 for($f=0;$f<$totMatRetiradas;$f++){	
		?>
	      
	    
	      <tr>
		    <td  align="left" nowrap><? echo $sw2; ?></td>
		    <td  align="left" nowrap><?  echo $arrMatRetiradas[$f]['nombre_per'];?></td>
		    <td  align="left" nowrap><? echo $arrMatRetiradas[$f]['codigo_mat']; ?></td>
		    <td align="left" nowrap><? echo $arrMatRetiradas[$f]['nombre_mat'];?></td>
		    <td align="right"><? echo 0; ?></td>
		    <td align="right"><? echo 0;?></td>
		    <td align="right"><? echo 0;?></td>
		    <td  align="left" nowrap><? echo $arrMatRetiradas[$f]['numerocreditos_dmat'];?></td>
		    <td align="right"><? echo "ABANDONO";?></td>
		    <td align="right"><? echo "W";?></td>
	    </tr>   
		<?php 
			$sw2++;
		}			
		?>
		
		<?php 
			//print "<pre>";print_r($arrCreditoGraduacionMalla);print "<pre>";
			//echo "cont: ". count($arrCreditoGraduacionMalla);
			
			if($totArrGradMalla>0){			
		?>

        <tr>
          <th colspan="10" >CREDITOS ADICIONALES </th>
        </tr>
		       <tr>
          <th>Nº.</th>
          <th colspan="6">Requerimiento</th>
          <th>Creditos</th>
  		  <th>Se suma cr&eacute;dito  </th>
		  <th>Tipo</th>
	    </tr>

		<?php 
			}
		?>
		
		<?php 
		$sw3 = $sw2;
		 for($g=0;$g<$totArrGradMalla;$g++){	
		?>
        <tr>
          <td  align="left" nowrap><? echo $sw3; ?></td>
          <td colspan="6"  align="left" nowrap><? echo $arrCreditoGraduacionMalla[$g]['nombre_dad'];?></td>
          <td  align="left" nowrap><? echo $arrCreditoGraduacionMalla[$g]['ncreditos'];?></td>
          <td  align="left" nowrap><? echo $arrCreditoGraduacionMalla[$g]['aplicacredito'];?></td>
          <td  align="left" nowrap><? echo "Ad";?></td>
        </tr>
		<?php 
			$sw3++;
		}			
		?>

        <tr>
          <th colspan="7" ><div align="right">PROMEDIO / 4 : </div></th>
		  <th><?php echo $promedioSobreCuatro; ?></th>
		  <th>&nbsp;</th>
		  <th>&nbsp; </th>
	    </tr>
		 <!-- <tr>
          <th colspan="7" ><div align="right">PROMEDIO / 100: </div></th>
		  <th ><?php  //echo $promedioSobreCien; ?> </th>
		  <th >&nbsp; </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>
		  </tr>	-->	 
		  <tr>
		    <th colspan="7" ><div align="right">TOTAL CREDITOS HOMOLOGADOS:  </div></th>
		    <th ><?php echo $totalCreditosHomologados;?></th>
		    <th >&nbsp;</th>
		    <th >&nbsp;</th>
	    </tr>
		  <tr>
		    <th colspan="7" ><div align="right">TOTAL CREDITOS REVALIDADOS:  </div></th>
		    <th ><?php echo $totalCreditosRevalidados;?></th>
		    <th >&nbsp;</th>
		    <th >&nbsp;</th>
	    </tr>
		  <tr>
          <th colspan="7" ><div align="right">TOTAL CREDITOS APROBADOS:  </div></th>
		  <th ><?php echo $totalCreditosAprueba;?> </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>		  
		  </tr>
		  <tr>
          <th colspan="7" ><div align="right">TOTAL CREDITOS REPROBADOS:  </div></th>
		  <th ><?php echo $totalCreditosReprueba; ?> </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>		  
		  </tr>
		   <tr>
          <th colspan="7" ><div align="right">INDICE I.R.A.:  </div></th>
		  <th ><?php echo $totalIRA;?> </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>		  
		  </tr>
		   <tr>
		     <th colspan="7" ><div align="right">TOTAL CREDITOS ADICIONALES:</div></th>
		     <th ><?php echo $totalCreditosGraduacionMalla;?></th>
		     <th >&nbsp;</th>
		     <th >&nbsp;</th>
        </tr>
		   <tr>
		     <th colspan="7" ><div align="right">TOTAL CREDITOS TOMADOS (Aprobados / Reprobados/Homologados/Revalidados) </div></th>
		     <th ><?php echo $totalCreditos; ?></th>
		     <th >&nbsp;</th>
		     <th >&nbsp;</th>
        </tr>
	      <tr>
          <th colspan="7" ><div align="right">TOTAL CREDITOS MALLA(Total): </div></th>
		  <th ><?php echo $totalCreditosMalla; ?>/<?php echo $arrAlu[0]['creditomax_maa'];?> </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>		  
		  </tr>
    </table>
      <div align="center"><BR>
        <BR>
        <br />
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>

<?php 
//Funciones
/*
* Get notanumerica
*/
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
//	echo $sqlGet."</p>";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

/*
* Get Credito de la Malla Main
*/
function getCreditoMain($serial_alu,$serial_mat,$dblink){
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
	";	
	
	
	
//	echo "<br>CRED: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}


/*
* Get Credito de la Malla
*/
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
				$arrDefMatCont[$pointerA]['indiceok'] = '';
			}		
		}						
	}
	$arrFin = array_values($arrDefMatCont);
	//print "<pre>";print_r($arrFin);print "<pre>";
	//Get de las materias repetidas que hayan aprobado con totales. 
	$totCont = count($arrFin);
	$sw = 0;
	/*
	[18] => Array
        (
            [nveces] => 2
            [materia] => 405
            [nombremateria] => CONTRATACION CIVIL
            [credito] => 3.00
            [posicion] => 18.32.
            [estado] => APRUEBA.APRUEBA.
            [notanumerica] => 2.000*3.667*
            [devengartotal] => 0
            [devengarcreditos] => 0
            [procesar] => 
        )
	*/
	for($i=0;$i<$totCont;$i++){
		$swAp = 0;
		$swRep = 0;
		$posAp = array();
		$posRep = array();
		//Quitar el punto que se pone al final de estado 
		$num = strlen($arrFin[$i]['estado']);		
		$num = $num -1;
		$newCad = substr($arrFin[$i]['estado'],0,$num);
		$arrFin[$i]['estado'] = $newCad;
		$est = explode('.',$arrFin[$i]['estado']);
		//Dividir los estados concatenados por el punto
		$notan = explode('*',$arrFin[$i]['notanumerica']);
		$cont = count($est);
		//echo "<br>CONT: ".$cont."<br>";
		//pueden existir el caso de materias repetidas
		//de la forma 
		//MATEMATICAS  	REPRUEBA 	0
		//MATEMATICAS	APRUEBA 97
		//MATEMATICAS	APRUEBA 98
		//MATEMATICAS	APRUEBA 99
		
	 	
		//Casos
		//1) Que haya un reprueba y varios aprueba
			//buscar el aprueba con mayor nota y devolver todos menos ese que ya esta incluido en al caculo de arriba
		//2) Que todos sean reprueba
			//No procesar 
		// Que todos sean aprueba
		
		//Generar el arreglo de materias repetidas 
		$swContAprueba = 0;
		$swContReprueba = 0;
		if($arrFin[$i]['nveces'] > 1){
			//echo "<br>entro:".$cont;
			for($orden=0;$orden<$cont;$orden++){
				$arrOrden[$orden]['estado'] = $est[$orden];
				$arrOrden[$orden]['notanumerica'] = $notan[$orden];
				$arrOrden[$orden]['credito'] = $arrFin[$i]['credito'];
				$arrOrden[$orden]['nombremateria'] = $arrFin[$i]['nombremateria'];
				switch($arrOrden[$orden]['estado']){
					case 'APRUEBA':
							$swContAprueba++;
						break;
					case 'REPRUEBA':
							$swContReprueba++;							
						break;
				
				}						
			}
			//Todos son 
			if($swContAprueba == $cont){
				echo "todos iguales aprueba";//buscar mayor
			}
			if($swContReprueba == $cont){
				$arrFin[$i]['procesar'] = 'NO';
			}
			
			/*
			if($swContAprueba != swContReprueba and $swContAprueba !=0 and $swContReprueba!=0){
			
			}*/
			
			
			//print "<pre>";print_r($arrOrden);print "<pre>";			
		}
		$arrTest[0]['estado'] = 'APRUEBA';
		$arrTest[0]['notanumerica'] = 2;
		$arrTest[0]['credito'] = 3;
		$arrTest[0]['nombremateria'] = 'A';						

		$arrTest[1]['estado'] = 'APRUEBA';
		$arrTest[1]['notanumerica'] = 2;
		$arrTest[1]['credito'] = 3;
		$arrTest[1]['nombremateria'] = 'A';						

		$arrTest[2]['estado'] = 'APRUEBA';
		$arrTest[2]['notanumerica'] = 2;
		$arrTest[2]['credito'] = 3;
		$arrTest[2]['nombremateria'] = 'A';						

		$arrTest[3]['estado'] = 'APRUEBA';
		$arrTest[3]['notanumerica'] = 2;
		$arrTest[3]['credito'] = 3;
		$arrTest[3]['nombremateria'] = 'A';						
		$max = "";
		for($mayor = 0 ; $mayor<count($arrTest) ; $mayor++){			
			if($arrTest[$mayor]['notanumerica']>$arrTest[$mayor+1]['notanumerica']){
				$max = $arrTest[$mayor]['notanumerica'];
			}else{
				$max = $arrTest[$mayor+1]['notanumerica'];
			}
		} 
		echo "<br>El mayor de todos es: ".$max;
		
				
		for($j=0;$j<count($est);$j++){   			//ubicar 
						
			$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] + ($arrFin[$i]['credito']*$notan[$j]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] + $arrFin[$i]['credito'];
			//buscar el primer aprueba
			switch($est[$j]){
					case 'APRUEBA':
							$posAp[$swAp] = $j;
							$swAp++;				
						break;
					case 'REPRUEBA':
							$posRep[$swRep] = $j;
							$swRep++;							
						break;
				
			}
		}
		//echo "<br>APRUEBA: ".$swAp."<br>";
		//echo "<br>REPRUEBA: ".$swRep."<br>";
			
		if($cont == $swAp){
			//echo "<br>todas son aprueba, tomar la primera<br>";			
			$arrFin[$i]['procesar'] = 'SI';
			$arrFin[$i]['indiceok'] = $posAp[0];
			$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] - $arrFin[$i]['credito'];
			

		}
		if($cont == $swRep){
			$arrFin[$i]['procesar'] = 'NO';
		}
		if($swAp>=1 and $swRep>=1){
			//echo "<br>Hay un aprueba, en la posicion ".$posAp[0]." evaluar solo este aprueba<br>";
			$arrFin[$i]['procesar'] = 'SI';
			//$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			$arrFin[$i]['devengartotal'] = 1 - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] - $arrFin[$i]['credito'];
			
			//print "<pre>";print_r($posAp);print "<pre>";	
			//echo "<br>DEVENGAR TOTAL ANTES: ".$arrFin[$i]['devengartotal'];
			//echo "<br>CALCULADO: ".($arrFin[$i]['credito']*$notan[$posAp[0]]);
			//echo "<br>NOTA NUMERICA: ".$notan[$posAp[0]];
			//echo "<br>NOTA CREDITO: ".$arrFin[$i]['credito'];			
		}
		
		if($arrFin[$i]['nveces'] > 1 and $arrFin[$i]['procesar'] == 'SI'){
			$arrTot[$sw]['nveces'] = $arrFin[$i]['nveces'];
			$arrTot[$sw]['materia'] = $arrFin[$i]['materia'];
			$arrTot[$sw]['nombremateria'] =  $arrFin[$i]['nombremateria'];
			$arrTot[$sw]['credito'] = $arrFin[$i]['credito'];
			$arrTot[$sw]['posicion'] = $arrFin[$i]['posicion'];
			$arrTot[$sw]['estado'] =  $arrFin[$i]['estado'];
			$arrTot[$sw]['notanumerica'] =  $arrFin[$i]['notanumerica'];
			$arrTot[$sw]['devengartotal'] =  $arrFin[$i]['devengartotal'];
			$arrTot[$sw]['devengarcreditos'] =  $arrFin[$i]['devengarcreditos'];
			$arrTot[$sw]['procesar'] =  $arrFin[$i]['procesar'];
			$arrTot[$sw]['indiceok'] =  $arrFin[$i]['indiceok'];			
			$sw++;
		}				
	}
	//print "<pre>";print_r($arrTot);print "<pre>";	
	return $arrTot;
}

function getNotaHomologada($serial_alu,$resultado,$dblink){
	$sqlCale = "
		SELECT
			serial_cale 
		FROM
			alumno 
		WHERE
			serial_alu = ".$serial_alu."	
	";
	//echo "<br>".$sqlCale."<br>";
	$arrCale = $dblink->GetAll($sqlCale);	
	$sqlGet = "
		SELECT
			serial_dcale,
			serial_cale,
			alfabetica_dcale,
			numerica_dcale,
			relativa_dcale,
			rangocalificacionini_dcale,
			rangocalificacionfin_dcale,
			estado_dcale 
		FROM
			detallecalificacionequivalencia 
		WHERE
			serial_cale = ".$arrCale[0]['serial_cale']." 
			AND estado_dcale IS NOT NULL
	";	
	//echo "<br>".$sqlGet."<br>";
	$rsNotaEq=$dblink->Execute($sqlGet);
	while (!$rsNotaEq->EOF) { 
		if($rsNotaEq->fields["rangocalificacionini_dcale"]<=$resultado && $rsNotaEq->fields["rangocalificacionfin_dcale"]>=$resultado){	
			$serial_dcale = $rsNotaEq->fields[0];
			$nota_alfab = $rsNotaEq->fields[2];
	 		$nota_numerica = $rsNotaEq->fields[3];
			$nota_relativa = $rsNotaEq->fields[4];	
			$nota_fin = $rsNotaEq->fields[6];
			$nota_ini = $rsNotaEq->fields[5];
			$estado = $rsNotaEq->fields[7];
			$arr[0]['notaalfabeticah'] = $nota_alfab;
			$arr[0]['notanumericah'] =  $nota_numerica;
			$arr[0]['estadoh'] =  $estado;
		}	
		$rsNotaEq->MoveNext();	
	}
	if($arr){		
		return $arr;
	}else{
		return false;
	}
}


function getCreditosGraduacionMalla($serial_alu,$serial_sec,$dblink){

	$sqlGetOther = "
		SELECT    
			serial_ama,
			nombre_dad,    
			ncreditos, 
			case aplicacredito when 'SI' then aplicacredito else 'NO' end as aplicacredito    
		FROM
			requisitosgraduacion AS rqg,
			documentosadmision   AS dad 
		WHERE
			rqg.serial_dad = dad.serial_dad 
			and entregado_rgra = 'SI'			
			AND rqg.serial_ama IN ( SELECT
										ama.serial_ama 
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
										AND maa.serial_maa_p = 0
										AND ama.serial_alu = ".$serial_alu." 
										AND maa.serial_sec = ".$serial_sec."
										AND maa.serial_car = ".$GLOBALS['serial_car']."
									GROUP BY
										serial_ama 
			)  	
	";
	//echo "<br>sqlGetOther:<br>".$sqlGetOther."<br>";
	//if ($serial_alu==2328) echo "<br>sqlGetOther:<br>".$sqlGetOther."<br>";
	$ncredOther = 0;
	if($arrOther = $dblink->GetAll($sqlGetOther)){
		for($i=0;$i<count($arrOther);$i++){
			if($arrOther[$i]['aplicacredito']=='SI'){
				$ncredOther = $ncredOther + $arrOther[$i]['ncreditos'];
			}
		}			
		$arrOther['ncred']['ncred'] = $ncredOther;					
		return $arrOther;
		
	}else{
		//echo 'ES FALSO';
		return false;

	}

}

/*
    AND detallemateriamatriculada.serial_mat in 
    (
        SELECT
            dma.serial_mat	
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
			
    ) 
*/


?>