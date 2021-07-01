<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {color: #CC0000}
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
$serial_alu = $_GET['serial_alu'];
$serial_sec = $_GET['serial_sec'];
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
	celular_alu,
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
";
$arrAlu = $dblink->GetAll($sqlAlu);

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

ORDER BY
	fecini_per,
	materia

";
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

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
$totalCreditosMalla = 0;
$totalNotaNumericaPorCredito = 0;
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
$totalIRA = 0;
$arr = getRepMat();
if($arr){
	//print "<pre>";print_r($arr);print "<pre>";
	for($i=0;$i<count($arr);$i++){
			$totalRestarCredito = $totalRestarCredito + $arr[$i]['devengarcreditos'];
			$totalRestarMultiplicacion = $totalRestarMultiplicacion + $arr[$i]['devengartotal'];
	}			
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
//echo "<br>TOTAL SIN RESTA: ".$totalNotaNumericaPorCredito."<br>";
$totalCreditosRegistro = $totalCreditosRegistro - $totalRestarCredito;
$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito - $totalRestarMultiplicacion;

//echo "<br>TOTAL RESTADO: ".$totalNotaNumericaPorCredito."<br>";
//Resumen Totales
$promedioSobreCuatro = number_format($totalNotaNumericaPorCredito/$totalCreditosRegistro,3);
$promedioSobreCien = number_format($totalNotaFinal/$totalNotasAprueba,2);
$totalCreditosAprueba = number_format($totalCreditosAprueba,2);
$totalCreditosReprueba = number_format($totalCreditosReprueba,2);
$totalCreditosNormales = number_format(($totalCreditosReprueba + $totalCreditosAprueba),2);
$totalIRA = number_format($totalNotaSobreCuatro/$totalCreditosAprueba,3);
//Tratamiento Homologaciones
$sqlHom = "
SELECT
	hom.serial_hom,
	dhom.serial_mat,
	serial_alu,
	tipo_hom,
	hom.serial_sec,
	nombre_mat,
	'' as creditohom,
	fecha_hom,
	codigo_mat 
FROM
	homologacion        AS hom,
	detallehomologacion AS dhom,
	materia              AS mat 
WHERE
	hom.serial_hom = dhom.serial_hom 
	AND mat.serial_mat = dhom.serial_mat 
	AND hom.serial_alu = ".$serial_alu."
";
//echo "<br>".$sqlHom."<br>";
$arrHom = $dblink->GetAll($sqlHom);
$totHom = count($arrHom);
for($i=0;$i<$totHom;$i++){	
	$arr = getCredito($arrHom[$i]['serial_alu'],$arrHom[$i]['serial_mat'],$arrHom[$i]['serial_sec'],$dblink);
	if($arr){
		$arrHom[$i]['creditohom'] = $arr[0]['numerocreditos_dma'];		
	}
	switch($arrHom[$i]['tipo_hom']){
		case 'HOMOLOGACION':
			$totalCreditosHomologados = $totalCreditosHomologados + $arrHom[$i]['creditohom'];		
			break;
		case 'CONVALIDACION':
			$totalCreditosRevalidados = $totalCreditosRevalidados + $arrHom[$i]['creditohom'];
			break;			
	}
	
}
//Resumen
$totalCreditosHomologados = number_format($totalCreditosHomologados,2);
$totalCreditosRevalidados = number_format($totalCreditosRevalidados,2);
$totalCreditosEspeciales = number_format(($totalCreditosHomologados + $totalCreditosRevalidados),2);
$totalCreditos = number_format(($totalCreditosEspeciales + $totalCreditosNormales),2);

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
        <th align="right">&nbsp;<script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></th>
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
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
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
		  <th>T</th>
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
		     <td align="right"><? echo $arrMain[$i]['tipomateria'];?></td>
		  </tr>
				
			<?php 
			}
			?> 
		<!--MATERIA HOMOLOGADAS-->		    
		    
		<?php 
		$sw = $i+1;
		 for($j=0;$j<$totHom;$j++){	
		?>
	      <tr>
		    <td  align="left" nowrap><? echo $sw; ?></td>
		    <td  align="left" nowrap><?  echo $arrHom[$j]['fecha_hom'];?></td>
		    <td  align="left" nowrap><? echo $arrHom[$j]['codigo_mat']; ?></td>
		    <td align="left" nowrap><? echo $arrHom[$j]['nombre_mat'];?></td>
		    <td align="right"><? echo 0; ?></td>
		    <td align="right"><? echo 0;?></td>
		    <td align="right"><? echo 0;?></td>
		    <td  align="left" nowrap><? echo $arrHom[$j]['creditohom'];?></td>
		    <td align="right"><? echo $arrHom[$j]['tipo_hom'];?></td>
		    <td align="right"><? echo "HM";?></td>
	    </tr>   
		<?php 
			$sw++;
		}			
		?>
		<!--MATERIA RETIRADAS-->		    
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
          <th colspan="7" ><div align="right">TOTAL CREDITOS: </div></th>
		  <th ><?php echo $totalCreditos; ?> </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>		  
		  </tr>
    </table>
      <BR><BR>
    <br /></td>
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
		for($j=0;$j<count($est);$j++){   
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
			$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] - $arrFin[$i]['credito'];
			
			//print "<pre>";print_r($posAp);print "<pre>";	
			
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
	return $arrTot;
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