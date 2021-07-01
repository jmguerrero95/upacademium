<?php 
	//Revisado por Paty 16:57
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>REPORTE MATRICULADOS</title>
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
/*//Gets
$serial_sec = $_GET['serial_sec'];
$serial_suc=$_GET['serial_suc'];

//Encabezados
if($serial_suc <> "T"){
	$sqlSuc = "select nombre_suc from sucursal where serial_suc = " . $serial_suc;
	$arrSuc = $dblink->GetAll($sqlSuc);	
	$nombre_suc = $arrSuc[0]['nombre_suc'];
	$sucursal = "";		
	$sucursal = "AND per.serial_suc = ".$serial_suc; 
}else{
	$nombre_suc = "TODAS";
}

if($serial_sec <> "T"){
	$sqlSec = "select nombre_sec from seccion where serial_sec = " . $serial_sec;
	$arrSec = $dblink->GetAll($sqlSec);	
	$seccion = "AND per.serial_sec = ".$serial_sec;
	$nombre_sec = $arrSec[0]['nombre_sec'];	
}else{
	$nombre_sec = "TODAS";
	
}*/

//Gets
$serial_alu = $_GET['serial_alu'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_crp = $_GET['serial_crp'];
$serial_per = $_GET['serial_per'];
$serial_suc=$_GET['serial_suc'];
$forzar = $_GET['forzar'];

$serial_car = $_GET['serial_crp'];
//echo "<br>forzar:<br>".$forzar."<br>";
//$periodo = "AND per.serial_per in(360,376,372)";
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
	if($serial_sec == "1"){
		$periodo = " AND per.fecini_per >= '".$fecha_ini."' AND per.fecini_per <= '".$fecha_fin."'";
	}else{
		$periodo = " AND(('".$fecha_ini."' BETWEEN fecini_per AND fecfin_per) OR ('".$fecha_fin."' BETWEEN fecini_per  AND fecfin_per )) ";
	}
	
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
//echo "periodo:".$periodo;
if($forzar == true and $serial_sec<>2 and $serial_sec=="T"){
		$periodo = "AND per.serial_per in(360,376,372)";		
	}else if($forzar == true and $serial_sec<>2 and $serial_sec!="T"){
		switch($serial_suc){
			case 2: 
				$periodo = "AND per.serial_per in(376)";		
				break;
				
			case 3: 
				$periodo = "AND per.serial_per in(372)";		
				break;

			case 4: 
				$periodo = "AND per.serial_per in(360)";		
				break;
		}
	}
/*
1	NIVEL CENTRAL
2	QUITO
3	GUAYAQUIL
4	CUENCA
*/	


if($serial_sec=="T"){
	$seccion = "";
}else{
	$seccion = "AND per.serial_sec = ".$serial_sec;
}
//Carrera
/*if($serial_sec == 2){
	$carrera = "AND car.serial_car = ".$serial_crp;
}else{
	$carrera = "AND crp.serial_crp = ".$serial_crp;
}
if($serial_crp== 'T'){
	$carrera = "";
}*/


	$carrera = "AND maa.serial_car = ".$serial_crp;

//	$carrera = "AND crp.serial_crp = ".$serial_crp;

if($serial_crp== 'T'){
	$carrera = "";
}


//Get Materias tomadas de la malla 
$sqlMain = "
SELECT
	mmat.serial_mmat,
	mmat.serial_alu,
	codigoIdentificacion_alu,
	concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
	per.nombre_per,
	nombre_suc,
	nombre_sec,
	per.serial_suc,
	per.fecini_per,
	per.fecfin_per,
	sec.serial_sec,
	nombre_maa,
	maa.serial_maa,
	'' as trimestre,
	'' as creditostomados,
	'' as creditosnivelactual,
	maa.totalcreditos_maa AS creditosmalla,
	maa.creditomax_maa as creditosTotal,
	maa.serial_maa,
	crp.nombre_crp,
	maa.serial_car,
	nombre_fac,descripcion_sex,INTERCAMBIO_ALU

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
	
	".$periodo."
	".$carrera."
	".$sucursal."
	".$seccion."

GROUP BY
	mmat.serial_alu
	,maa.serial_car 
ORDER BY
	nombre

";


//echo "<br>Mainnnn:<br>".$sqlMain."<br>";
/*AND mmat.serial_alu NOT IN(
									SELECT
										serial_alu 
									FROM
										alumno 
									WHERE
										intercambio_alu = 'VIENE INTERCAMBIO' 
										OR intercambio_alu = 'VIENE DOBLE TIT' 
										OR intercambio_alu = 'COMUNIDAD'
			)*/

//AND mmat.serial_alu = 5155				AND mmat.serial_alu = 3425	AND mmat.serial_alu = 3425
//AND mmat.serial_alu = 6673
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);
//Parametrizacion
for($i=0;$i<$totAll;$i++){	
//	$carrera1 =
	$carreraCreditos = "AND maa.serial_car = ".$arrMain[$i]['serial_car'];
	$arrCT = getCreditosAprobadosALaFecha($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_suc'],$arrMain[$i]['serial_sec'],$arrMain[$i]['fecfin_per'],$arrMain[$i]['serial_maa'],$dblink,$carreraCreditos);
	if($arrCT){	
		//print "<pre>";print_r($arrCT);print "<pre>";
		$arrMain[$i]['creditosaprobadosalafecha'] = $arrCT;
	}

	$arrCNA = getCreditosNivelActual($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_suc'],$arrMain[$i]['serial_sec'],$arrMain[$i]['fecini_per'],$arrMain[$i]['fecfin_per'],$dblink);
	if($arrCNA){	
		//print "<pre>";print_r($arrCT);print "<pre>";
		$arrMain[$i]['creditosnivelactual'] = $arrCNA;
	}	
	
	$arr = getTrimestre($arrMain[$i]['serial_alu'],$arrMain[$i]['serial_sec'],$arrMain[$i]['creditosaprobadosalafecha'],$arrMain[$i]['creditosnivelactual'],$dblink);
	//function getTrimestre($serial_alu,serial_sec,$creditosAprobados,$creditosActuales,$dblink){
	if($arr){
		$arrMain[$i]['trimestre'] = $arr;
	}else{
		$arrMain[$i]['trimestre'] = "NO IDENTIFICADO";
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
	<!--<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">-->
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
        <th ><span class=""><? echo "SUCURSAL: ".$nombre_suc;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo "SECCION: ".$nombre_sec;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo "SELECCIONADOS LOS PERIODOS ACTUALES DE LAS SEDES EN CUESTION";?></span></th>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th>N�.</th>
		  	
            <th>Apellidos Y nombres</th>
			<th>N. C�dula</th>
			<th>Tipo</th>
            <th>Nivel Matriculado </th>
            <th>Creditos Aprobados a la Fecha </th>
			<th># Cr&eacute;ditos en Nivel Actual </th>
            <th>Creditos Malla </th>
			<th>Creditos TOTAL </th>
            <th>Programa</th>
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
		 $ultimo_periodom=0; 
		 $ultimo_periodof=0;  
		 for($i=0;$i<$totAll;$i++){	
		 	
			$diferencia=$arrMain[$i]['creditosmalla']-$arrMain[$i]['creditostomados'];
			 if($diferencia<=15){
			  $nombre="<span class='style1'>".$arrMain[$i]['nombre']."</span>";
			  $falta="<span class='style1'>".$diferencia."</span>";
			  if($arrMain[$i]['descripcion_sex']=='MASCULINO')
			   	$ultimo_periodom++;	
			   else
			   	$ultimo_periodof++;	
			 }else{
			  
			  $nombre=$arrMain[$i]['nombre'];
			  $falta= $diferencia;
			  
			 }
			
			?>
        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td  align="left" nowrap><? echo $nombre;//." <--> ".$arrMain[$i]['serial_alu'];?></td>
			   <td  align="left" nowrap><? echo $arrMain[$i]['codigoIdentificacion_alu'];?></td>
               <td  align="left" nowrap><? if($arrMain[$i]['INTERCAMBIO_ALU']=='NINGUNO') echo "&nbsp;"; else echo $arrMain[$i]['INTERCAMBIO_ALU'];?></td>
               <td  align="left" nowrap><?  echo $arrMain[$i]['trimestre']; ?></td>
               <td  align="left" nowrap><? echo $arrMain[$i]['creditosaprobadosalafecha'];?></td>
			   
			   <td  align="left" nowrap><? echo $arrMain[$i]['creditosnivelactual'];?></td>
			   
               <td  align="left" nowrap><? echo $arrMain[$i]['creditosmalla'];?></td>
			   <td  align="left" nowrap><? echo $arrMain[$i]['creditosTotal'];?></td>
               <td align="left" nowrap><? echo $arrMain[$i]['nombre_sec'];?></td>
               <td align="left" nowrap><? echo $arrMain[$i]['nombre_suc'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['nombre_maa']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_crp'];?></td>
		       <td align="right"><? echo $arrMain[$i]['nombre_fac'];?></td>
        </tr>
        
        <?php 
			}
			?> 
        
         <tr>
          <th colspan="12" ><div align="right">TOTAL MATRICULADOS : </div></th>
		  <th ><?php  echo $totAll; ?> </th>
		  </tr>
		  <tr>
          <th colspan="12" align="center" ><div align="right">
            <table width="200" border="1" align="center">
              <tr>
                <th colspan="2" align="center">Alumnos en Ultimo Nivel </th>
                </tr>
              <tr>
                <td width="112">Masculino</td>
                <td width="72"><?php  echo $ultimo_periodom; ?></td>
              </tr>
              <tr>
                <td>Femenino</td>
                <td><?php  echo $ultimo_periodof; ?></td>
              </tr>
            </table>
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
// Poner los creditos tomados y de malla del alumno
function getCreditosAprobadosALaFecha($serial_alu,$serial_suc,$serial_sec,$fecha_fin,$serial_maa,$dblink,$carrera){
	$sqlGet = "
		SELECT
		    dma.serial_dma,
			numerocreditos_dma AS creditostomados
			
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
			".$carrera."
			AND dmat.serial_mat IN (SELECT
										mat.serial_mat 
									FROM
										malla        AS maa,
										alumnomalla  AS ama,
										detallemalla AS dma,
										materia      AS mat 
									WHERE
										maa.serial_maa = ama.serial_maa 
										AND dma.serial_maa = maa.serial_maa 
										AND mat.serial_mat = dma.serial_mat 
										AND ama.serial_alu = ".$serial_alu." 
										AND maa.serial_sec = ".$serial_sec." 	
										".$carrera."
										
			)
		GROUP BY
			dma.serial_mat	
			
		UNION
		SELECT
			 serial_dma,
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
			".$carrera."
			group by dma.serial_mat
	";
	//maa.serial_maa = ".$serial_maa." AND
	//if ($serial_alu==2328)
	//echo "<br>getCreditosAprobadosALaFecha:<br>".$sqlGet."<br>";
	$sqlGetOther = "
		SELECT    
			serial_ama,
			nombre_dad,    
			ncreditos,    
			aplicacredito    
		FROM
			requisitosgraduacion AS rqg,
			documentosadmision   AS dad 
		WHERE
			rqg.serial_dad = dad.serial_dad 
			AND aplicacredito = 'SI'     
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
										AND ama.serial_alu = ".$serial_alu." 
										AND maa.serial_sec = ".$serial_sec."							
										".$carrera."
										
									GROUP BY
										serial_ama 
			)  	
	";
	//if ($serial_alu==2328) echo "<br>sqlGetOther:<br>".$sqlGetOther."<br>";
	$ncredOther = 0;
	if($arrOther = $dblink->GetAll($sqlGetOther)){
		for($i=0;$i<count($arrOther);$i++){
			$ncredOther = $ncredOther + $arrOther[$i]['ncreditos'];
		}			
	}	
	if($arr = $dblink->GetAll($sqlGet)){
		 count($arrTrimestresDef);
		for($i=0;$i<count($arr);$i++){			
			$ret =$ret+$arr[$i]['creditostomados'];
		}		
		$ret = $ret +$ncredOther;
		return $ret;
	}else{
		if($ncredOther>0){
			return $ncredOther;	
		}else{
			return false;
		}
		
	}
}

function getCreditosNivelActual($serial_alu,$serial_suc,$serial_sec,$fecha_ini,$fecha_fin,$dblink){
	$sqlGet = "
		SELECT
		    distinct dma.serial_mat,
			numerocreditos_dma AS creditostomados			
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,			
			alumnomalla               AS ama ,
			malla                     AS maa,
			detallemalla              AS dma 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat AND
			mmat.serial_per = per.serial_per AND
			ama.serial_alu= mmat.serial_alu AND			
			maa.serial_maa=ama.serial_maa AND
			maa.serial_maa=dma.serial_maa AND
			dmat.serial_mat=dma.serial_mat AND
			per.serial_sec=maa.serial_sec AND			
			mmat.serial_alu = ".$serial_alu." AND
			per.serial_sec = ".$serial_sec."  AND
			per.fecini_per>='".$fecha_ini."' AND
			per.fecini_per<='".$fecha_fin."'  AND
			(dmat.fecharetiro_dmat ='0000-00-00' AND
			dmat.retiromateria_dmat <>'SIN COSTO') 
			AND mmat.serial_alu NOT IN(
									SELECT
										serial_alu 
									FROM
										alumno 
									WHERE
										intercambio_alu = 'VIENE INTERCAMBIO' 
										OR intercambio_alu = 'VIENE DOBLE TIT' 
										OR intercambio_alu = 'COMUNIDAD'
			)
		GROUP BY
			dma.serial_mat	
			
	UNION
	SELECT
		dmat.serial_mat,
		sum(numerocreditos_dmat+creditosequivalentes_dmat) AS creditostomados 
	FROM
		materiamatriculada        AS mmat,
		detallemateriamatriculada AS dmat,
		periodo                   AS per    
	WHERE
		mmat.serial_mmat = dmat.serial_mmat 
		AND mmat.serial_per = per.serial_per
		AND mmat.serial_alu = ".$serial_alu." 
		AND per.serial_sec = ".$serial_sec."
		AND per.fecini_per>='".$fecha_ini."' 
		AND per.fecini_per<='".$fecha_fin."' 
		AND (dmat.fecharetiro_dmat ='0000-00-00' 
		AND dmat.retiromateria_dmat <>'SIN COSTO') 
		AND dmat.serial_mat NOT IN (SELECT
										mat.serial_mat 
									FROM
										malla        AS maa,
										alumnomalla  AS ama,
										detallemalla AS dma,
										materia      AS mat 
									WHERE
										maa.serial_maa = ama.serial_maa 
										AND dma.serial_maa = maa.serial_maa 
										AND mat.serial_mat = dma.serial_mat 
										AND ama.serial_alu = ".$serial_alu." 
										AND maa.serial_sec = ".$serial_sec."
    )

		AND mmat.serial_alu NOT IN( SELECT
										serial_alu 
									FROM
										alumno 
									WHERE
										intercambio_alu = 'VIENE INTERCAMBIO' 
										OR intercambio_alu = 'VIENE DOBLE TIT' 
										OR intercambio_alu = 'COMUNIDAD' 
		)
	GROUP BY
		dmat.serial_mat 
	
	";
	//if ($serial_alu==2330)
	//echo "<br>getCreditosNivelActual: ".$sqlGet."<br>";
	
	if($arr = $dblink->GetAll($sqlGet)){
		for($i=0;$i<count($arr);$i++){			
			$ret = $ret + $arr[$i]['creditostomados'];
		}		
		//$ret = $arr[0]['creditostomados'];
		return $ret;
	}else{
		return false;
	}
}




/*
* Funci�n que retorna el Trimestre en el que se encuentra matriculado un alumno actualmente
*	Tomando como base los siguientes items
*		a) Cr�ditos de Materias aprobadas			
*		b) Cr�ditos de Materias que esten dentro de la malla del alumno
*		c) Cr�ditos de Materias que tambien esten homologadas			
*/	


function getTrimestre($serial_alu,$serial_sec,$creditosAprobados,$creditosActuales,$dblink){
	$sqlMalla = "
		SELECT 			
			niv.serial_niv,
			nombre_niv,
			nombre_maa,
			sum(numerocreditos_dma) as tcredit,
			'' as totsum
		FROM
			area         AS ARE,
			nivel        AS niv,
			detallemalla AS dma,
			alumnomalla  AS ama,
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
		group by
			niv.serial_niv
		ORDER BY
			niv.serial_niv
	";
	$arrMalla = $dblink->GetAll($sqlMalla);
	$totArrMalla = count($arrMalla);
	//A�adiendo el campo de creditos a aprobar por nivel
	for($i=0;$i<$totArrMalla;$i++){
		//echo "<br>I: ".$i."NIVEL: ".$arrMalla[$i]['nombre_niv'];
		if($i==0){
			$arrMalla[$i]['totsum'] = $arrMalla[$i]['tcredit'];
		}else{
			$arrMalla[$i]['totsum'] = 	$arrMalla[$i-1]['totsum'] + $arrMalla[$i]['tcredit'];
		}	

	}	


	$sum = $creditosAprobados + $creditosActuales;

	//print "<pre>";print_r($arrMalla);print "<pre>";		

	//echo "<br>CreditosAprobados + Creditos Actuales: ".$sum."<br>";
	$pos = -100;
	$a = 0;
	$b = 0;
	$c = 0;
	for($i=0;$i<$totArrMalla;$i++){
		//echo "<br>POS :".$i."SUM: ".$sum." INTERVALO A: ".$arrMalla[$i]['totsum']." INTERVALO B: ".$arrMalla[$i+1]['totsum']."NIVEL: ".$arrMalla[$i]['nombre_niv']."<br>";
		if($sum >= $arrMalla[$i]['totsum'] and $sum < $arrMalla[$i+1]['totsum']){			
			//$pos = $i;
			$a = $arrMalla[$i]['totsum'];					
			$b = $arrMalla[$i+1]['totsum'];
			$c = ($a + $b) / 2;
			/*echo "<br>a: ".$a;
			echo "<br>b: ".$b;
			echo "<br>c: ".$c;*/
			/*if($sum==0){
				return $arrMalla[0]['nombre_niv'];
			}*/
			if($sum<$c){
				$pos = $i;
			}else{
				$pos = $i +1;
			}
		}
	}	
	//echo "<br>ULTIMA POSICION DEL ARREGLO: ".$arrMalla[$totArrMalla - 1]['totsum'];
	//Si esta desbordado poner el ultimo nivel del arreglo
	if($sum>$arrMalla[$totArrMalla - 1]['totsum']){
		return $arrMalla[$totArrMalla - 1]['nombre_niv'];
	}
	if($pos<>-100){
		//echo "<br>EL ALUMNO ESTA EN: ".$arrMalla[$pos]['nombre_niv'];		
		return $arrMalla[$pos]['nombre_niv'];
	}else{
		return $arrMalla[0]['nombre_niv'];
	}
	
    
}
/*
* Function que convierte un array en tabla
*/
function arrayToTable($arr){
  $filas = count($arr);
  $elementos = count($arr, COUNT_RECURSIVE) - $filas;
  $columnas = ($elementos / $filas) / 2;
  $i = 0;
  $temp = array();
  foreach ($arr as $key => $value) {
      foreach ($value as $key2 => $value2) {
          if (!is_int($key2)) {
              $temp[$i] = $key2;
              $i++;
          }
      }
  }
  $temp = array_unique($temp);
  $titleRows = count($temp);
  $tableImp = "<table summary='Submitted table designs'>";
  $tableImp = $tableImp . "<caption>ArrayToTable</caption><thead><tr>";
  for ($i = 0; $i < $titleRows; $i++) {
      $tableImp = $tableImp . "<th scope='col'>" . trim($temp[$i]) . "</th>";
  }
  $tableImp = $tableImp . "</tr></thead><tfoot><tr><th scope='row'>Total</th><td colspan='" . $i . "'>" . $filas . " Registros</td></tr></tfoot><tbody>";
  for ($i = 0; $i < $filas; $i++) {
      if ($i % 2 == 0) {
          $class = "";
      } else {
          
          $class = "class ='odd'";
      }
      $tableImp = $tableImp . "<tr " . $class . ">";
      for ($j = 0; $j < $columnas; $j++) {
          if ($j == 0) {
              $tableImp = $tableImp . "<th scope='row'><a href='#'>" . $arr[$i][$j] . "</a> </th>";
          } else {
              
              $tableImp = $tableImp . "<td>" . $arr[$i][$j] . "</td>";
          }
      }
      $tableImp = $tableImp . "</tr>";
  }
  $tableImp = $tableImp . "</tbody></table>";
  return $tableImp;
  //echo "<br>".$tableImp;
  //print "<pre>"; print_r($temp); print "<pre>";
}

function array2table($array, $recursive = false, $return = false, $null = '&nbsp;'){
    // Sanity check
    if(empty($array) || !is_array($array)){ return false; }
    if(!isset($array[0]) || !is_array($array[0])){ $array = array($array); }
 
    // Start the table
    $table = "<table>\n";
    // The header
    $table .= "\t<tr>";
    // Take the keys from the first row as the headings
    foreach (array_keys($array[0]) as $heading) {
        $table .= '<th>' . $heading . '</th>';
    }
    $table .= "</tr>\n";
 
    // The body
    foreach ($array as $row) {
        $table .= "\t<tr>" ;
        foreach ($row as $cell) {
            $table .= '<td>';
           
            // Cast objects
            if (is_object($cell)) { $cell = (array) $cell; }
            if ($recursive === true && is_array($cell) && !empty($cell)) {
                // Recursive mode
                $table .= "\n" . array2table($cell, true, true) . "\n";
            } else {
                $table .= (strlen($cell)> 0) ?
                    htmlspecialchars((string) $cell) :
                    $null;
            }
            $table .= '</td>';
        }
        $table .= "</tr>\n";
    }
    // End the table
    $table .= '</table>';
    // Method of output
    if ($return === false) {
        echo $table;
    } else {
        return $table;
    }
}
?>