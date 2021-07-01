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
//	AND alu.serial_alu = 3076	
//	AND alu.serial_alu = 3076
//	AND alu.serial_alu = 2425	
//	AND alu.serial_alu = 2425	
//AND alu.serial_alu = 2410	
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
	
	
}*/


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
          <p class="">LISTADO DE (<?php echo $totAll;?>)ALUMNOS CON MATERIAS FUERA DE LA MALLA </p></th>
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
            <th>Periodo</th>
            <th>Materia</th>
            <th>Nota</th>
            <th>Creditos Registrados  </th>
		    <th>Estado</th>
		    <th>Malla</th>
		    <th>Carrera</th>
  		    <th>Facultad</th>
	    </tr>       
       
        <?php  		   
		 for($i=0;$i<$totAll;$i++){	
			?>        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre']."<-->".$arrMain[$i]['serial_alu'];?></td>
               <td  align="left" nowrap>&nbsp;</td>
               <td  align="left" nowrap>&nbsp;</td>
               <td  align="left" nowrap>&nbsp;</td>
               <td align="left" nowrap>&nbsp;</td>		   	
		       <td align="right">&nbsp;</td>
		       <td align="right"><? echo $arrMain[$i]['nombre_maa']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrMain[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			$arrMatSinMalla = getMateriaFueraMalla($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_sec'],$dblink);
			$totMatSinMalla = count($arrMatSinMalla);
				for($j=0;$j<$totMatSinMalla;$j++){	
				  $num = $j + 1;
				  echo "
					<tr>
					  <td  align='left' nowrap></td>
						   <td  align='left' nowrap>".$num."</td>
						   <td  align='left' nowrap>".$arrMatSinMalla[$j]['nombre_per']."</td>
						   <td  align='left' nowrap>".$arrMatSinMalla[$j]['materia']."</td>
						   <td  align='left' nowrap>".$arrMatSinMalla[$j]['notatotal_nal']." </td>
						   <td align='left' nowrap>".$arrMatSinMalla[$j]['creditosmateria']."</td>		   	
						   <td align='right'>".$arrMatSinMalla[$j]['estado_nal']."</td>
						   <td align='right'></td>
						   <td align='right'></td>
						   <td align='right'></td>
					</tr>
					";				
				}
			}
		?> 



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
function getMateriaFueraMalla($serial_alu,$serial_sec,$dblink){
	$sqlGet = "
		SELECT
			detallemateriamatriculada.serial_mat ,	
			nombre_per,	
			nombre_mat AS materia,	
			estado_nal,
			notatotal_nal,	
			periodo.serial_sec,
			numerocreditos_dmat creditosmateria ,
			(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados
			
		FROM
			notasalumnos ,
			materia ,
			materiamatriculada ,
			detallemateriamatriculada ,
			periodo ,
			alumno 
				JOIN detallenotasalumnos AS dnal_1 	ON dnal_1.serial_nal = notasalumnos.serial_nal AND dnal_1.serial_acal=1 
				JOIN detallenotasalumnos AS dnal_2 	ON dnal_2.serial_nal = notasalumnos.serial_nal AND dnal_2.serial_acal=2 
				JOIN detallenotasalumnos AS dnal_3 	ON dnal_3.serial_nal = notasalumnos.serial_nal AND dnal_3.serial_acal=3 
				JOIN detallenotasalumnos AS dnal_4 	ON dnal_4.serial_nal = notasalumnos.serial_nal AND dnal_4.serial_acal=4 
		WHERE
			materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
			AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
			AND materiamatriculada.serial_alu = alumno.serial_alu 
			AND periodo.serial_per = materiamatriculada.serial_per 
			AND materiamatriculada.serial_alu = ".$serial_alu." 
			AND periodo.serial_sec = ".$serial_sec." 
			AND (fecharetiro_dmat ='000-00-00' 
			AND estado_nal <> 'REPRUEBA'
			AND retiromateria_dmat <>'SIN COSTO') 
			AND materia.serial_mat=detallemateriamatriculada.serial_mat 
			AND detallemateriamatriculada.serial_mat NOT IN (	SELECT
																	dma.serial_mat 
																FROM
																	malla AS maa ,
																	alumnomalla AS ama ,
																	detallemalla AS dma,
																	materia AS mat 
																WHERE
																	maa.serial_maa = ama.serial_maa 
																	AND dma.serial_maa = maa.serial_maa 
																	AND mat.serial_mat = dma.serial_mat 
																	AND ama.serial_alu = ".$serial_alu." 
																	AND maa.serial_sec = ".$serial_sec." 
			)
		ORDER BY
			fecini_per ,
			materia
		
			";
	//echo "<br>".$sqlGet."<br>";			
	if($arr = $dblink->GetAll($sqlGet)){
		return $arr;
	}else{
		return false;
	}
}
		
    


?>