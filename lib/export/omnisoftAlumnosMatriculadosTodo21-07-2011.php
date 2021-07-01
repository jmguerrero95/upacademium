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
//Gets
$serial_alu = $_GET['serial_alu'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_crp = $_GET['serial_crp'];
$serial_per = $_GET['serial_per'];
$serial_suc=$_GET['serial_suc'];
$per = explode('*',$serial_per);
$serial_per = $per[0];

//Encabezados
if($serial_suc <> "T"){
	$sqlSuc = "select nombre_suc from sucursal where serial_suc = " . $serial_suc;
	$arrSuc = $dblink->GetAll($sqlSuc);	
	$nombre_suc = $arrSuc[0]['nombre_suc'];
}else{
	$nombre_suc = "TODAS";
}
if($serial_sec <> "T"){
	$sqlSec = "select nombre_sec from seccion where serial_sec = " . $serial_sec;
	$arrSec = $dblink->GetAll($sqlSec);	
	$nombre_sec = $arrSec[0]['nombre_sec'];

}else{
	$nombre_sec = "TODAS";
}
//Validaciones
if(strlen($fecha_ini)>0 and strlen($fecha_fin)>=0){
	$periodo = " AND per.fecini_per >= '".$fecha_ini."' AND per.fecini_per <= '".$fecha_fin."'";
	$fechas = "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;
	$final = $fecha_fin;
	$inicial=$fecha_ini;
}else{
	$periodo = " AND per.serial_per = ".$serial_per; 
	$sqlPer = "select nombre_per,fecini_per,fecfin_per from periodo where serial_per = " . $serial_per;
	$arrPer = $dblink->GetAll($sqlPer);	
	$fechas = $arrPer[0]['nombre_per']."  =>  DESDE: ".$arrPer[0]['fecini_per']." HASTA: ".$arrPer[0]['fecfin_per'];
	$final = $arrPer[0]['fecfin_per'];	
	$inicial=$arrPer[0]['fecini_per'];
}
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = "AND per.serial_suc = ".$serial_suc; 
}
if($serial_sec=="T"){
	$seccion = "";		
}else{
	$seccion = "AND per.serial_sec = ".$serial_sec;
}
//Carrera
if($serial_sec == 2){
	$carrera = "AND car.serial_car = ".$serial_crp;
}else{
	$carrera = "AND crp.serial_crp = ".$serial_crp;
}
if($serial_crp== 'T'){
	$carrera = "";
}

//Get Datos de Alumnos

//Get Materias tomadas de la malla 
$sqlMain = "
SELECT
	mmat.serial_mmat,
	mmat.serial_alu,
	concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
	per.nombre_per,
	nombre_suc,
	per.serial_suc,
	sec.serial_sec,
	nombre_maa,
	'' as trimestre,
	'' as creditostomados,
	maa.totalcreditos_maa AS creditosmalla,
	maa.serial_maa,
	crp.nombre_crp,
	nombre_fac 
FROM
	alumno             AS alu,
	materiamatriculada AS mmat,
	detallemateriamatriculada AS dmat,
	periodo            AS per,
	sucursal           AS suc,
	seccion            AS sec,
	malla              AS maa,
	sexo               AS sex,
	alumnomalla        AS ama 
	LEFT JOIN carrera AS car ON car.serial_car = maa.serial_car 
	LEFT JOIN carreraprincipal AS crp ON crp.serial_crp = car.serial_crp 
	LEFT JOIN facultad ON facultad.serial_fac = car.serial_fac 
WHERE
	mmat.serial_alu = alu.serial_alu 
	AND maa.serial_maa = ama.serial_maa 
	AND mmat.serial_alu = ama.serial_alu
	AND mmat.serial_mmat = dmat.serial_mmat 
	AND per.serial_sec = sec.serial_sec 
	AND per.serial_sec = maa.serial_sec 
	AND per.serial_suc = suc.serial_suc 
	AND per.serial_per = mmat.serial_per 
	AND maa.serial_maa_p = 0 
	AND alu.serial_sex = sex.serial_sex
	and (intercambio_alu<>'COMUNIDAD')	
	".$periodo."
	".$carrera."
	".$sucursal."
	".$seccion."
GROUP BY
	mmat.serial_alu 
ORDER BY
	nombre

";
/*AND (fecharetiro_dmat ='000-00-00' 
	AND retiromateria_dmat <>'SIN COSTO') */
//AND mmat.serial_alu = 2073
//	AND mmat.serial_alu = 5122	
//echo "<br>FINAL: ".$final."<br>";
//AND alu.serial_alu = 3425
//AND alu.serial_alu = 5008
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);
//Parametrizacion
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
          <p class="">LISTADO DE (<?php echo $totAll;?>)ALUMNOS MATRICULADOS </p></th>
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
            <th>Alumno</th>
            <th>Creditos Malla </th>
            <th>Creditos Aprobados  </th>
            <th>Nivel Actual </th>
            <th>Sucursal </th>
		    <th>Malla</th>
		    <th>Carrera</th>
  		    <th>Facultad</th>
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
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre'];//."<-->".$arrMain[$i]['serial_alu'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['creditosmalla'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['creditostomados'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['trimestre']; ?></td>
               <td align="left" nowrap><? echo $arrMain[$i]['nombre_suc'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['nombre_maa']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrMain[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="8" ><div align="right">TOTAL MATRICULADOS : </div></th>
		  <th ><?php  echo $totAll; ?> </th>
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
// Poner los creditos tomados y de malla del alumno
function getCreditosTomados($serial_alu,$serial_suc,$serial_sec,$fecha_fin,$dblink){
	$sqlGet = "
		SELECT
			SUM(numerocreditos_dma) AS creditostomados
			
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			notasalumnos              AS nal,
			alumnomalla               AS ama ,
			malla                     AS maa,
			detallemalla              AS dma 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat AND
			mmat.serial_per = per.serial_per AND
			ama.serial_alu= mmat.serial_alu AND
			dmat.serial_dmat = nal.serial_dmat AND
			maa.serial_maa=ama.serial_maa AND
			maa.serial_maa=dma.serial_maa AND
			dmat.serial_mat=dma.serial_mat AND
			per.serial_sec=maa.serial_sec AND
			nal.estado_nal = 'APRUEBA' AND
			mmat.serial_alu = ".$serial_alu." AND
			per.serial_sec = ".$serial_sec."  AND
			per.fecini_per>='1960-01-01' AND
			per.fecini_per<='".$fecha_fin."'  AND
			(dmat.fecharetiro_dmat ='0000-00-00' AND
			dmat.retiromateria_dmat <>'SIN COSTO') 
			
		UNION
		SELECT
			SUM(numerocreditos_dma) AS creditostomados
			 
		FROM
			homologacion        AS hom,
			detallehomologacion AS dhom,
			periodo             AS per,
			malla               AS maa,
			detallemalla        AS dma,
			alumnomalla         AS ama
			
		WHERE
			hom.serial_hom = dhom.serial_hom AND
			dhom.serial_mat = dma.serial_mat AND
			hom.serial_per = per.serial_per AND
			hom.serial_alu = ama.serial_alu AND
			maa.serial_maa = dma.serial_maa AND
			ama.serial_maa = maa.serial_maa AND
			ama.serial_alu = ".$serial_alu." AND
			per.serial_sec =".$serial_sec."  AND
			per.fecini_per >= '1960-01-01' AND
			per.fecini_per <= '".$fecha_fin."' 
	";
	//echo "<br>".$sqlGet."<br>";
	
	if($arr = $dblink->GetAll($sqlGet)){
		 count($arrTrimestresDef);
		for($i=0;$i<count($arr);$i++){			
			$ret =$ret+$arr[$i]['creditostomados'];
		}		
		//$ret = $arr[0]['creditostomados'];
		return $ret;
	}else{
		return false;
	}
}

/*
* Función que devuelve del el trimestre de un alumno
*/
function getTrimestre($serial_alu,$inicial,$final,$serial_sec,$dblink){
	$sqlMalla = "
		SELECT
			nombre_mat,
			mat.serial_mat,
			nombre_niv,
			niv.serial_niv	
		FROM
			area         AS ARE,
			nivel        AS niv,
			detallemalla AS dma,
			alumnomalla as ama,
			materia      AS mat,
			malla        AS maa,
			especialidad AS esp 
		WHERE
			ARE.serial_are = mat.serial_are 
			AND niv.serial_niv = dma.serial_niv 
			AND mat.serial_mat = dma.serial_mat 			
			AND maa.serial_maa = dma.serial_maa 
			AND ama.serial_maa = maa.serial_maa
			AND esp.serial_esp = maa.serial_esp 
			AND ama.serial_alu = ".$serial_alu."
			AND maa.serial_sec = ".$serial_sec." 
		ORDER BY
			niv.serial_niv";	
	$arrMalla = $dblink->GetAll($sqlMalla);
	//echo "<br>".$sqlMalla."<br>";
	/*Sql que toma las materias :
		a) Materias aprobadas			
		b) que esten dentro de la malla del alumno
		c) que tambien esten homologadas	
		d) 
	*/	
	$sqlRegistroAlumno = "
	SELECT
	dmat.serial_mat
	
FROM
	materiamatriculada        AS mmat,
	detallemateriamatriculada AS dmat,
	periodo                   AS per,
	notasalumnos              AS nal,
	alumnomalla               AS ama ,
	malla                     AS maa,
	detallemalla              AS dma 
WHERE
	mmat.serial_mmat = dmat.serial_mmat AND
	mmat.serial_per = per.serial_per AND
    ama.serial_alu= mmat.serial_alu AND
	dmat.serial_dmat = nal.serial_dmat AND
	maa.serial_maa=ama.serial_maa AND
	maa.serial_maa=dma.serial_maa AND
	dmat.serial_mat=dma.serial_mat AND
    per.serial_sec=maa.serial_sec AND
    nal.estado_nal = 'APRUEBA' AND
    mmat.serial_alu = ".$serial_alu." AND
	per.serial_sec = ".$serial_sec."  AND
	per.fecini_per>='".$inicial."' AND
	per.fecini_per<='".$final."'  AND
	(dmat.fecharetiro_dmat ='0000-00-00' AND
	dmat.retiromateria_dmat <>'SIN COSTO') 
	
UNION
SELECT
	dhom.serial_mat
	 
FROM
	homologacion        AS hom,
	detallehomologacion AS dhom,
	periodo             AS per,
	malla               AS maa,
	detallemalla        AS dma,
	alumnomalla         AS ama
	
WHERE
	hom.serial_hom = dhom.serial_hom AND
	dhom.serial_mat = dma.serial_mat AND
	hom.serial_per = per.serial_per AND
	hom.serial_alu = ama.serial_alu AND
	maa.serial_maa = dma.serial_maa AND
	ama.serial_maa = maa.serial_maa AND
	ama.serial_alu = ".$serial_alu." AND
	per.serial_sec =".$serial_sec."  AND
	per.fecini_per >= '1960-01-01' AND
	per.fecini_per <= '".$final."' 
	
	";	
	//echo "<br>".$sqlRegistroAlumno."<br>";
	$arrRegistroAlumno = $dblink->GetAll($sqlRegistroAlumno);	
	$totMalla = count($arrMalla);
	$totRegistroAlumno = count($arrRegistroAlumno);
	//Crear contador unico para trimestres
	for($i=0;$i<$totMalla;$i++){			
		$arrTrimestres[$i] = $arrMalla[$i]['nombre_niv'];			
	}	
	$arrTrimestresTemp= array_unique($arrTrimestres);	
	$arrTrimestresDef = array_values($arrTrimestresTemp);
	$totTrim = count($arrTrimestresDef);
	for($i=0;$i<$totTrim;$i++){			
		$contTrimestres[$arrTrimestresDef[$i]] = 0;
	}
	//echo "Contador de trimestres: <br>";
	//print "<pre>";print_r($contTrimestres);print "<pre>";		
	//Crear array de materias de malla
	//echo "<br>TOTMALLA: ".$totMalla."<br>";
	for($i=0;$i<$totMalla;$i++){			
		$arrMallaDef[$i]['serial_mat'] = $arrMalla[$i]['serial_mat'];			
		$arrMallaDef[$i]['nombre_niv'] = $arrMalla[$i]['nombre_niv'];			
	}
		
	//echo "Valores de malla: <br>";
	//print "<pre>";print_r($arrMallaDef);print "<pre>";		
	//echo "Valores de REGISTRO: <br>";
	//print "<pre>";print_r($arrRegistroAlumno);print "<pre>";		

	for($i=0;$i<$totRegistroAlumno;$i++){			
		$pointerA = $arrRegistroAlumno[$i]['serial_mat'];
		for($j=0;$j<$totMalla;$j++){
			$pointerB = $arrMallaDef[$j]['serial_mat'];		
				if($pointerA == $pointerB){
					$index = $arrMallaDef[$j]['nombre_niv'];		
					$contTrimestres[$index]++; 
					$j = $totMalla;	
				}
		}						
	}
	//echo "CONTADOR DESPUES: <br>";
	//print "<pre>";print_r($contTrimestres);print "<pre>";
	//return $arrTot;
	//Set de arr unidimensional a bidimensional
	$i = 0;
	foreach ($contTrimestres as $key => $value){		
		if($value>0){
			$contTrim[$i]['trimestre'] = $key;
			$contTrim[$i]['cont'] = $value;
			$contTrim[$i]['pos'] = $i;
			$i++;
		}

	}
	
	//echo "CONTADOR LISTO: <br>";
	//print "<pre>";print_r($contTrim);print "<pre>";
	//Verificar si todos los elementos son repetidos
/*	$contTrim[0]['trimestre'] = "PRIMER TRIMESTRE";
	$contTrim[0]['cont'] = 1;
	$contTrim[1]['trimestre'] = "SEGUNDO TRIMESTRE";
	$contTrim[1]['cont'] = 2;
	$contTrim[2]['trimestre'] = "TERCER TRIMESTRE";
	$contTrim[2]['cont'] = 3;
*/
		
	$swRep = 0;
	$tot = count($contTrim);
	for($i=0;$i<$tot-1;$i++){
		$a = $contTrim[$i]['cont'];
		$b = $contTrim[$i+1]['cont'];
		
		//echo $a."<----->".$b."<br>";
		if($a<>$b){			
			$swRep=1;
			$i = $tot;	
		}		
	}
	//echo "CONTADOR LISTO: <br>";
	//print "<pre>";print_r($contTrim);print "<pre>";
			
	if($swRep==0){				
	    $arrFin[0]['trimestre'] = $contTrim[0]['trimestre'];
		$arrFin[0]['msg'] = "Igual No de materias por Trim se toma el primero";
		return $arrFin;
		//echo "entro<br>";
	}else{		
		$mayor = $contTrim[0]['cont'];
		$indiceMayor = 0;
		for($i=1;$i<=$tot;$i++){						
			$b = $contTrim[$i]['cont'];
			//echo "<br>mayor: ".$mayor."<br>";
			//echo "<br>b: ".$b."<br>";
			if($mayor<$b){
				$mayor = $contTrim[$i]['cont'];
				$indiceMayor = $i;
			}
			//echo "<br>MAYORINDICE: ".$indiceMayor."<br>";
		}
	    $arrFin[0]['trimestre'] = $contTrim[$indiceMayor]['trimestre'];
		$arrFin[0]['msg'] = "(".$contTrim[$indiceMayor]['cont']." Materias en ".$contTrim[$indiceMayor]['trimestre'].")";
		return $arrFin;
		
	}
    
}

?>