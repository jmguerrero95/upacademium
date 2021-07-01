<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seguimiento a Graduados CPA</title>
<style type="text/css">
<!--
.style3 {font-weight: bold}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
//Definicion
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$serial_suc=$_GET['serial_suc'];
$serial_sec=$_GET['serial_sec'];
$fecha_ini =$_GET['fecha_ini']; 
$fecha_fin =$_GET['fecha_fin']; 
//sucursal
if($serial_suc == "T"){
	$sucursal = "";		
}else{
	$sucursal = "AND alu.serial_suc = ".$serial_suc; 
}
//seccion
if($serial_sec == "T"){
	$seccion = "";		
}else{	
	$seccion = "AND malla.serial_sec = ".$serial_sec;
}

$sqlMain = "
SELECT
	alu.serial_alu,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
	CASE
			WHEN carrera.nombre_car LIKE 'ASOCIADO%' 
			THEN 'TECNICO SUPERIOR'
			ELSE 'TERCER NIVEL'
	END as nivel,
	
	codigoIdentificacion_alu AS identificacion,
	fecnac_alu,
	codigo_alu,
	
	'' as cumple,
	celular_alu,
	direcciondomic_alu,
	direcciontrabajo_alu,
	telefodomic_alu,
	telefotrabajo_alu,
	sex.descripcion_sex AS sexo,
	alu.serial_sex,
	mailuniv_alu,
	mail_alu,
	nombre_fac,
	fectitulacion_ama AS ftitulacion,
	fecegresamiento_ama AS fegresamiento,
	carreraprincipal.nombre_crp AS carrera,
	nombre_crp,
	nombre_car,
	malla.serial_sec,
	nombre_suc 
FROM
	alumno AS alu,
	sucursal AS suc,
	sexo   AS sex 
	LEFT JOIN alumnomalla ON alumnomalla.serial_alu=alu.serial_alu 
	LEFT JOIN malla ON malla.serial_maa=alumnomalla.serial_maa AND serial_maa_p=0 
	LEFT JOIN carrera ON carrera.serial_car=malla.serial_car 
	LEFT JOIN carreraprincipal ON carreraprincipal.serial_crp=carrera.serial_crp 
	LEFT JOIN facultad ON facultad.serial_fac=carrera.serial_fac 
WHERE
	alu.serial_sex = sex.serial_sex 
	AND suc.serial_suc = alu.serial_suc
	".$seccion."
	".$sucursal."
	AND fectitulacion_ama >= '".$fecha_ini."' 
	AND fectitulacion_ama <='".$fecha_fin."' 
	AND (intercambio_alu<>'VIENE INTERCAMBIO' 
	AND intercambio_alu<>'COMUNIDAD') 
ORDER BY
	alu.fectitulo_alu
";
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

$sqlPer = "
	SELECT
		serial_per,
		nombre_per,
		fecini_per,
		fecfin_per 
	FROM
		periodo 
	WHERE
		serial_per = ".$serial_per."
";

$arrPer = $dblink->GetAll($sqlPer);
$totAllPer = count($arrPer);

//ASIGNACION Y TOTALIZACION
$totMasculino = 0;
$totFemenino = 0;
$totSxNoDef = 0;
$totCumple = 0;

for($i=0;$i<$totAll;$i++){	
	//alu.serial_sex
	$sec = $arrMain[$i]['serial_sec'];

$nivelPre=$arrMain[$i]['nivel'];

	switch($sec){
		case 1: 
			$arrMain[$i]['nivel'] = $nivelPre; 
			break;
		case 2:
			$arrMain[$i]['nivel'] = "CUARTO NIVEL"; 
			break;
		default:
			$arrMain[$i]['nivel'] = "OTRO"; 
	}
	
	$arr = getEsp($arrMain[$i]['serial_alu'],$dblink);
	if($arr){
		$arrMain[$i]['nombre_car'] = $arrMain[$i]['nombre_car']." MENCION: ".$arr;		
	}
	$arrMain[$i]['mail_alu'] = strtolower($arrMain[$i]['mail_alu']);
}



?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
 H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }

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

<BR>

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="6" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><strong>LISTA GENERAL DE ALUMNOS GRADUADOS </strong></th>
  </tr>
  <tr >
    <th colspan="2"><? echo $arrPer[0]['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> PERIODOS DESDE: <? echo $fecha_ini;?> HASTA <? echo $fecha_fin?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROGRAMA:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">SUCURSAL:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
	
  </tr>
  

  <tr>
    <td colspan="3" bgcolor="#FFFFFF">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
       
        
		
		<tr>
		  <th width="1%"  style="">Nro</th>		 
          <th width="20%">CODE</th>
          <th width="20%">NOMBRE</th>
		  <th width="7%">EMAIL</th>
		  <th width="7%">EMAIL UNIV </th>
		  <th width="7%">CELULAR </th>
		  <th width="7%"><p># TRABAJO </p>	      </th>
          <th width="4%" ># DOMICILIO </th>
          <th width="4%" >IDENTIFICACION</th>		 
          <th width="4%" >CODIGO</th>
          <th width="4%" >SEXO</th>          
		  <th width="20%" >DIR. DOM. </th>
		  <th width="20%" >DIR. TRABAJO. </th>
		  <th width="20%" >FACULTAD</th>
          <th width="20%" >FEGRESAMIENTO</th>
          <th width="20%" >FTITULACION</th>
          <th width="20%" >TITULO </th>
          <th width="20%" >NIVEL </th>
          <th width="20%" >CARRERA</th>
          <th width="20%" >SEDE</th>   
		 
		 <?php  
			for($i=0;$i<$totAll;$i++){		
		?> 
		<tr> 
				<td ><span><?php echo $i+1;?></span></td>
				<td nowrap="nowrap" ><?php echo $arrMain[$i]['serial_alu'];?></td>
				<td nowrap="nowrap" ><span><?php echo $arrMain[$i]['nombre'];?></span></td>
				<td ><?php echo strtolower($arrMain[$i]['mail_alu']);?></td>
				<td ><?php echo strtolower($arrMain[$i]['mailuniv_alu']);?></td>
				<td ><?php echo $arrMain[$i]['celular_alu'];?></td>
				<td ><span><?php echo $arrMain[$i]['telefotrabajo_alu'];?></span></td>
				<td ><?php echo $arrMain[$i]['telefodomic_alu'];?></td>
				<td ><span><?php echo $arrMain[$i]['identificacion'];?> </span></td>
				<td ><span><?php echo $arrMain[$i]['codigo_alu'];?> </span> </td>
				<td ><span><?php echo $arrMain[$i]['sexo'];?></span> </td>
				<td ><?php echo $arrMain[$i]['direcciondomic_alu'];?></td>
				<td ><?php echo $arrMain[$i]['direcciontrabajo_alu'];?></td>
				<td ><span><?php echo $arrMain[$i]['nombre_fac'];?></span> </td>
				<td ><span><?php echo $arrMain[$i]['fegresamiento'];?></span></td>
				<td ><span><?php echo $arrMain[$i]['ftitulacion'];?></span></td>
				<td ><span><?php echo $arrMain[$i]['nombre_car'];?></span></td>
				<td ><span><?php echo $arrMain[$i]['nivel']; ?></span></td>
				<td ><?php echo $arrMain[$i]['carrera'];?></td>
				<td ><?php echo $arrMain[$i]['nombre_suc'];?></td>
				
		<?php
			}
		?>
    </table>
    </td>
  </tr>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>

          <td width="51%" align="center"><div align="left">
			<p>TOTAL MUJERES : <?php  echo $totFemenino;?></p>
            <p>TOTAL VARONES:  <?php echo $totMasculino; ?></p>            
			<p>TOTAL NO DEFINIDOS:  <?php echo $totSxNoDef;?></p>            			
			<p>TOTAL : <?php echo $i;?></p>
			
          </div></td>
          <td width="49%" align="center"><div align="left">REVISADO POR:</div></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>
<?php
/*
* Funcion Poner Mencion en titulos
*/
function getEsp($serial_alu,$dblink){
	$sqlEsp = "
	SELECT
		a.serial_alu,
		nombre_esp 
	FROM
		especializacion AS eal 
		LEFT JOIN seccion AS sec ON eal.serial_sec = sec.serial_sec,
		alumnomalla  AS ama 
		LEFT JOIN alumno AS a ON ama.serial_alu = a.serial_alu,
		malla AS maa,
		especialidad AS esp 
	WHERE
		eal.serial_ama = ama.serial_ama 
		AND eal.serial_maa = maa.serial_maa 
		AND esp.serial_esp = eal.serial_esp 		
		AND a.serial_alu = ".$serial_alu." 
		AND tipo_eal = 'MAYOR'
	";	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr[0]['nombre_esp'];
	}else{
		return false;
	}
}
/*
* Funcion cumpleaños
*/
function getCumple($fecnac_alu,$dblink){
	$fecha = explode("-",$fecnac_alu);
	//if($fecha[1] == "10" and $fecha[2]== "2"){
	//if($fecha[1] == date("m") and $fecha[2]== date("d")){
	if($fecha[1] == date("m")){
		return "SI";
	}else{
		return false;
	}	

}
?>