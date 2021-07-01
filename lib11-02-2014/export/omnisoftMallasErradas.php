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
$serial_suc = $_GET['serial_suc'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_crp = $_GET['serial_crp'];
$serial_per = $_GET['serial_per'];
$per = explode('*',$serial_per);
$serial_per = $per[0];

//Encabezados
if($serial_suc <> "T"){
	$sqlSuc = "select nombre_suc from sucursal where serial_suc = " . $serial_suc;
	//echo "<br>SUCURSAL: ".$serial_suc."<br>";
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
	$final = $fecha_fin;
}else{
	$periodo = "AND per.serial_per = ".$serial_per; 
	$sqlPer = "select nombre_per,fecini_per,fecfin_per from periodo where serial_per = " . $serial_per;
	$arrPer = $dblink->GetAll($sqlPer);	
	$fechas = $arrPer[0]['nombre_per']."  =>  DESDE: ".$arrPer[0]['fecini_per']." HASTA: ".$arrPer[0]['fecfin_per'];
	$final = $arrPer[0]['fecfin_per'];	
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
	maa.serial_maa,
	concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
	per.nombre_per,
	'' as mallaerrada,
	nombre_suc,
	per.serial_suc,
	sec.serial_sec,
	nombre_maa,
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
	AND per.serial_sec = maa.serial_sec 
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
//AND mmat.serial_alu = 2073
//	AND mmat.serial_alu = 5122	
//echo "<br>FINAL: ".$final."<br>";
//AND alu.serial_alu = 3425
//AND alu.serial_alu = 5008
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);
//Parametrizacion
$z = 0;
for($i=0;$i<$totAll;$i++){	
	$arr = getMallaErronea($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_maa'],$arrMain[$i]['serial_sec'],$dblink);
	if($arr){
		for($j=0;$j<count($arr);$j++){	
			$arrMain[$i]['mallaerrada'] = $arrMain[$i]['mallaerrada'] .$arr[$j]['nombre_maa']."<br>";
		}
		$arrRes[$z]['nombre'] =	$arrMain[$i]['nombre'];
		$arrRes[$z]['nombre_maa'] =	$arrMain[$i]['nombre_maa'];
		$arrRes[$z]['mallaerrada'] = $arrMain[$i]['mallaerrada'];
		$arrRes[$z]['nombre_suc'] = $arrMain[$i]['nombre_suc'];
		$arrRes[$z]['nombre_crp'] = $arrMain[$i]['nombre_crp'];
		$arrRes[$z]['nombre_fac'] = $arrMain[$i]['nombre_fac'];
		$z++;
	}else{
		$arrMain[$i]['mallaerrada'] = "";
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
          <p class="">LISTADO DE (<?php echo $totAll;?>)ALUMNOS CON MALLA ERRONEA </p></th>
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
            <th>Malla</th>
            <th>Malla Errada  </th>
		    <th>Sucursal</th>
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
		   
		 for($i=0;$i<count($arrRes);$i++){	
			?>
        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td  align="left" nowrap><? echo $arrRes[$i]['nombre'];//."<-->".$arrMain[$i]['serial_alu'];?></td>
               <td  align="left" nowrap><? echo $arrRes[$i]['nombre_maa']; ?></td>
               <td align="left" nowrap><? echo $arrRes[$i]['mallaerrada'];?> </td>		   	
		       <td align="right"><? echo $arrRes[$i]['nombre_suc'];?></td>
		       <td align="right"><? echo $arrRes[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrRes[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="6" ><div align="right">TOTAL ERRADOS : </div></th>
		  <th ><?php  echo $z; ?> </th>
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
function getMallaErronea($serial_alu,$serial_maa,$serial_sec,$dblink){
	$sqlGet = "
		SELECT
			ama.serial_alu,
			maa.serial_maa,
			nombre_maa 
		FROM
			alumnomalla AS ama,
			malla       AS maa 
		WHERE
			ama.serial_maa = maa.serial_maa 
			AND ama.serial_alu = ".$serial_alu." 
			AND maa.serial_maa NOT IN(	SELECT
											serial_maa 
										FROM
											malla 
										WHERE
											serial_maa = ".$serial_maa." 
											OR serial_maa_p = ".$serial_maa." 
			)
			AND maa.serial_sec = ".$serial_sec."
			AND nombre_maa not like '%PREUNI%'			
		ORDER BY
			nombre_maa	
	";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}


?>