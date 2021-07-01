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
$fecha_act = date("Y")."-".date("m")."-".date("d");	
if(strlen($fecha_ini)<=0 or strlen($fecha_fin)<=0){
	$fecha_ini = $fecha_act;
	$fecha_fin = $fecha_act;
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
	$carrera = "AND serial_car = ".$serial_crp;
}else{
	$carrera = "AND serial_crp = ".$serial_crp;
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
	nombre_maa,
	crp.nombre_crp,
	nombre_fac 
FROM
	alumno             AS alu,
	materiamatriculada AS mmat,
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
	AND per.serial_sec = sec.serial_sec 
	AND per.serial_suc = suc.serial_suc 
	AND per.serial_per = mmat.serial_per 
	AND maa.serial_maa_p = 0 
	AND alu.serial_sex = sex.serial_sex 
	AND per.fecini_per >='".$fecha_ini."' 
	AND per.fecini_per <='".$fecha_fin."' 
	".$carrera."
	".$sucursal."
	".$seccion."
GROUP BY
	mmat.serial_alu 
ORDER BY
	nombre

";
echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);
//Parametrizacion
for($i=0;$i<$totAll;$i++){	

	$nombre = "<a href='www.google.com' title='"."Ver detalle de: ".$arrMain[$i]['nombre']."' target='_blank'>".$arrMain[$i]['nombre']."</a>";
	$arrMain[$i]['nombre'] = $nombre;
/*	$arr = getEq($arrMain[$i]['serial_cale'],$arrMain[$i]['notaalfabetica_nal'],$dblink);
	if($arr){
		$arrMain[$i]['notanumerica'] = $arr[0]['numerica_dcale'];
	}
	$arr = getCredito($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_mat'],$dblink);
	if($arr){
		$arrMain[$i]['creditomalla'] = $arr[0]['numerocreditos_dma'];
		$arrMain[$i]['tipomateria'] = "DM";
	}else{
		$arrMain[$i]['tipomateria'] = "FM";
	}*/
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
        <th ><span class=""><? echo "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;?></span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><? echo "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;?></th>
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
               <td  align="left" nowrap><a href='www.google.com' title='Hola' target='_blank'><? echo $arrMain[$i]['nombre'];?></a></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['nombre_per']; ?> </td>
		       <td align="left" nowrap><? echo $arrMain[$i]['nombre_suc'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['nombre_maa']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrMain[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="6" ><div align="right">TOTAL MATRICULADOS : </div></th>
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
* Get Credito de la Malla
*/
function getCredito($serial_alu,$serial_mat,$dblink){
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
		AND ama.serial_alu = ".serial_alu."
		and mat.serial_mat = ".$serial_mat."
	";	
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
				$arrDefMatCont[$pointerA]['credito'] = $arr[$j]['creditosmateria']; 
				$arrDefMatCont[$pointerA]['posicion'] =  $arrDefMatCont[$pointerA]['posicion'].$j.".";
				$arrDefMatCont[$pointerA]['estado'] =  $arrDefMatCont[$pointerA]['estado'].$estado.".";
				$arrDefMatCont[$pointerA]['notanumerica'] = $arrDefMatCont[$pointerA]['notanumerica'] .$arr[$j]['notanumerica'].'*'; ;
				$arrDefMatCont[$pointerA]['devengartotal'] = 0;
				$arrDefMatCont[$pointerA]['devengarcreditos'] = 0;
				$arrDefMatCont[$pointerA]['procesar'] = '';
			}		
		}						
	}
	$arrFin = array_values($arrDefMatCont);
	//Get de las materias repetidas que hayan aprobado con totales. 
	$totCont = count($arrFin);
	$sw = 0;
	for($i=0;$i<$totCont;$i++){
		$num = strlen($arrFin[$i]['estado']);
		$num = $num -1;
		$newCad = substr($arrFin[$i]['estado'],0,$num);
		$arrFin[$i]['estado'] = $newCad;
		$est = explode('.',$arrFin[$i]['estado']);
		$notan = explode('*',$arrFin[$i]['notanumerica']);
		for($j=0;$j<count($est);$j++){
			if($est[$j] == 'APRUEBA'){
				$arrFin[$i]['procesar'] = 'SI';
			}else{
				$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] + ($arrFin[$i]['credito']*$notan[$j]);
				$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] + $arrFin[$i]['credito'];
			}
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