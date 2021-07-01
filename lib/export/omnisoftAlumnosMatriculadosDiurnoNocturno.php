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
$per = explode('*',$serial_per);
$serial_per = $per[0];
//echo "<br>serial_per: ".$serial_per."<br>";
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
	$periodo = "AND per.fecini_per >= '".$fecha_ini."' AND per.fecini_per <= '".$fecha_fin."'";
	$fechas = "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;
}else{
	$periodo = "AND per.serial_per = ".$serial_per; 
	$sqlPer = "select nombre_per,fecini_per,fecfin_per from periodo where serial_per = " . $serial_per;
	$arrPer = $dblink->GetAll($sqlPer);	
	$fechas = $arrPer[0]['nombre_per']."  =>  DESDE: ".$arrPer[0]['fecini_per']." HASTA: ".$arrPer[0]['fecfin_per'];	
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
//Get Horarios
$sqlMain = "
SELECT
	mmat.serial_mmat,
	mmat.serial_alu,
	concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
	per.nombre_per,
	nombre_sec,
	nombre_suc,
	nombre_maa,
	'' as trimestre,
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
	AND mmat.serial_mmat = dmat.serial_dmat 
	AND per.serial_sec = sec.serial_sec 
	AND per.serial_suc = suc.serial_suc 
	AND per.serial_per = mmat.serial_per 
	AND maa.serial_maa_p = 0 
	AND alu.serial_sex = sex.serial_sex
	AND (fecharetiro_dmat ='000-00-00' 
	AND retiromateria_dmat <>'SIN COSTO') 	 
	".$periodo."
	".$carrera."
	".$sucursal."
	".$seccion."
GROUP BY
	mmat.serial_alu 
ORDER BY
	nombre

";

//AND mmat.serial_alu = 2612 
//AND mmat.serial_alu = 1774
//AND mmat.serial_alu = 3425
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);
$totDiurna = 0;
$totNocturna = 0;
$totDiurnaNoctura = 0;
$totNoDef = 0;

//Parametrizacion
for($i=0;$i<$totAll;$i++){	
	$arr = getTipoSeccionAlumno($arrMain[$i]['serial_alu'],$periodo,$dblink);
	if($arr){
		$arrMain[$i]['seccion_hrr'] = $arr;
	}else{
		$arrMain[$i]['seccion_hrr'] = "NO IDENTIFICADO";
	}	
	switch($arrMain[$i]['seccion_hrr']){
		case "DIURNA":
			$totDiurna++;	
			break;		
		case "NOCTURNA":
			$totNocturna++;	
			break;		
		case "DIURNA-NOCTURNA":
			$totDiurnaNoctura++;	
			break;		
		default:
			$totNoDef++;	
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
          <p class="">LISTADO DE (<?php echo $totAll;?>)ALUMNOS DIURNO NOCTURNO </p></th>
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
          <!--
	   	    mmat.serial_alu,
			dmat.serial_hrr,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
			nombrehorario_hrr,
			seccion_hrr,
			nombre_suc,
			nombre_sec 
		  -->
		  <th>Nº.</th>
            <th>Alumno</th>
            <th>Secci&oacute;n</th>
            <th>Sucursal</th>
		    <th>Malla</th>
		    <th>Carrera</th>
		    <th>Facultad</th>
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
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre'];?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre_sec']; ?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre_suc']; ?> </td>
		       <td align="left" nowrap><? echo $arrMain[$i]['nombre_maa']; ?></td>
		       <td align="left" nowrap><? echo $arrMain[$i]['nombre_crp']; ?></td>
		       <td align="left" nowrap><? echo $arrMain[$i]['nombre_fac'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['seccion_hrr']; ?> </td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="7" ><div align="right">TOTAL ALUMNOS : </div></th>
		  <th ><?php  echo $totAll; ?> </th>
		  </tr>	
		   <tr>
          <th colspan="7" ><div align="right">TOTAL ALUMNOS DIURNO : </div></th>
		  <th ><?php  echo $totDiurna;?> </th>
		  </tr>	
		   <tr>
          <th colspan="7" ><div align="right">TOTAL ALUMNOS NOCTURNO : </div></th>
		  <th ><?php  echo $totNocturna; ?> </th>
		  </tr>	
		   <tr>
          <th colspan="7" ><div align="right">TOTAL ALUMNOS DIURNO - NOCTURNA: </div></th>
		  <th ><?php  echo  $totDiurnaNoctura; ?> </th>
		  </tr>		 
		    <tr>
          <th colspan="7" ><div align="right">TOTAL NO DEFINIDO: </div></th>
		  <th ><?php  echo  $totNoDef; ?> </th>
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
//Funciones
/*
* Función que devuelve que tipo de estudiante es
	Diurno
	Nocturno
	Ambiguo
*/
function getTipoSeccionAlumno($serial_alu,$periodo,$dblink){
	$sqlGet = "
		SELECT
			mmat.serial_alu,
			dmat.serial_hrr,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
			nombrehorario_hrr,
			seccion_hrr,
			nombre_suc,
			nombre_sec 
		FROM
			materiamatriculada AS mmat,
			alumno             AS alu,
			detallemateriamatriculada dmat,
			periodo            AS per,
			materia            AS mat,
			horario            AS hrr,
			sucursal           AS suc,
			seccion            AS sec 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND alu.serial_alu = mmat.serial_alu 
			AND mat.serial_mat = dmat.serial_mat 
			AND mmat.serial_per = per.serial_per 
			AND hrr.serial_hrr = dmat.serial_hrr 
			AND suc.serial_suc = per.serial_suc 
			AND sec.serial_sec = per.serial_sec 
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO') 
			".$periodo."
			AND mmat.serial_alu = ".$serial_alu."
			".$GLOBALS['sucursal']." 
			".$GLOBALS['seccion']."
		ORDER BY
			nombre

	";
	//echo "<br>".$sqlGet."<br>";
	$arr = $dblink->GetAll($sqlGet);
	$tot = count($arr);
	$arrTotSeccion['seccion']['diurna'] = 0;
	$arrTotSeccion['seccion']['nocturna'] = 0;
	$arrTotSeccion['seccion']['nodefinida'] = 0;
	for($i=0;$i<$tot;$i++){
		switch($arr[$i]['seccion_hrr']){
			case 'DIURNA':
				$arrTotSeccion['seccion']['diurna']++;	
				break;		
			case 'NOCTURNA':
				$arrTotSeccion['seccion']['nocturna']++;	
				break;		
			default:
				$arrTotSeccion['seccion']['nodefinida']++;	
		}	
	}
	//echo "<br>Diurna: ".$arrTotSeccion['seccion']['diurna']."<br>";
	//echo "<br>Nocturna: ".$arrTotSeccion['seccion']['nocturna']."<br>";
	//echo "<br>Otras: ".$arrTotSeccion['seccion']['nodefinida']."<br>";
	$totNorm = $arrTotSeccion['seccion']['diurna'] + $arrTotSeccion['seccion']['nocturna'];
	if($arrTotSeccion['seccion']['nodefinida']>$totNorm){
		return "NO DEFINIDO";
	}	
	if($arrTotSeccion['seccion']['diurna']>$arrTotSeccion['seccion']['nocturna']){
		return "DIURNA";
	}else{
		if($arrTotSeccion['seccion']['diurna']==$arrTotSeccion['seccion']['nocturna']){
			return "DIURNA-NOCTURNA";
		}else{
			return "NOCTURNA";
		}	
	}
}


?>