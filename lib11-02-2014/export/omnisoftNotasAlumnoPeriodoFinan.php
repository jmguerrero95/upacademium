<?php
	$serial_alu = $_GET['serial_alu'];
	$serial_sec = $_GET['serial_sec'];
	$serial_car = $_GET['serial_car'];

?>

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
	AND malla.serial_car = ".$serial_car."
";
$arrAlu = $dblink->GetAll($sqlAlu);
//echo "ALUMNO: <br>".$sqlAlu."<br>";
//Get Materias tomadas de la malla 
$sqlMain = "
	SELECT
		detallemateriamatriculada.serial_mat,
		codigo_mat,
		nombre_mat AS materia,
		''                                                                         
		AS creditomalla,
		''                                                                         
		AS tipomateria,    
		nombre_per,
		'' 
		AS notatotal_nal,
		materiamatriculada.serial_mmat,
		numerocreditos_dmat,
		fecini_per,
		creditosequivalentes_dmat,
		periodo.serial_sec,
		numerocreditos_dmat creditosmateria,
		(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados,    
		CASE seccion_hrr 
			WHEN 'AVANZADA' 
			THEN seccion_hrr 
			WHEN 'UBICACION' 
			THEN seccion_hrr 
			ELSE ' ' 
		END                                                                            
		AS seccion_hrr 
	FROM
		materiamatriculada,
		detallemateriamatriculada,
		periodo,
		alumno,
		horario,
		materia 
	WHERE
		materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat     
		AND materiamatriculada.serial_alu = alumno.serial_alu 
		AND periodo.serial_per = materiamatriculada.serial_per 
		AND materiamatriculada.serial_alu = ".$serial_alu." 
		AND periodo.serial_sec = ".$serial_sec." 
		AND horario.serial_hrr=detallemateriamatriculada.serial_hrr 
		AND estado_hrr = 'ACTIVO' 		
		AND retiromateria_dmat <>'SIN COSTO' 
		AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	ORDER BY
		fecini_per,
		materia
";
//echo "SQL: <br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

if($totAll<=0){
	echo "<br>El alumno no tiene registro alguno de notas en su vida académica...<br>";
	exit(0);
}

$totalCreditosRegistrados = 0;
$totalCreditosMalla = 0;

for($i=0;$i<$totAll;$i++){		
	$arr = getCredito($serial_alu,$arrMain[$i]['serial_mat'],$serial_sec,$serial_car,$dblink);
	if($arr){
		$arrMain[$i]['creditomalla'] = $arr[0]['numerocreditos_dma'];		
		$arrMain[$i]['tipomateria'] = "DM";
	}else{
		$arrMain[$i]['creditomalla'] = 0;
		$arrMain[$i]['tipomateria'] = "FM";
	}
	
	$arrNota = getNota($serial_alu,$serial_sec,$arrMain[$i]['serial_mat'],$dblink);
	if($arrNota){
		$arrMain[$i]['notatotal_nal'] = $arrNota[0]['notatotal_nal'];	

	}else{
		$arrMain[$i]['notatotal_nal'] = "<font color='red'>S/N</font>";
	}

	$totalCreditosRegistrados = $totalCreditosRegistrados + $arrMain[$i]['creditostomados'];		
	$totalCreditosMalla = $totalCreditosMalla + $arrMain[$i]['creditomalla'];		
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
      
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th>Nº.</th>
          <th>Periodo</th>
          <th>Fecha Periodo </th>
          <th>Cod. </th>
		  <th>Materia </th>
		  <th>#Registro</th>
		  <th>Creditos Registro </th>
		  <th>Creditos Malla </th>
		  <th>Tipo Materia </th>
  		  <th>Nota</th>
  		  <th>Horario Especial </th>
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
		    <td  align="left" nowrap><? echo $arrMain[$i]['fecini_per']; ?></td>
		    <td  align="left" nowrap><? echo $arrMain[$i]['codigo_mat']; ?></td>
		    <td align="left" nowrap><? echo $arrMain[$i]['materia'];?></td>
		    <td align="right"><? echo $arrMain[$i]['serial_mmat'];?></td>
		    <td align="right"><? echo $arrMain[$i]['creditostomados'];?></td>
		    <td  align="left" nowrap><? echo $arrMain[$i]['creditomalla'];?></td>
		    <td  align="left" nowrap><? echo $arrMain[$i]['tipomateria'];?></td>
		    <td align="right"><? echo $arrMain[$i]['notatotal_nal'];?></td>
		    <td align="right"><? echo " <font color='red'>".$arrMain[$i]['seccion_hrr']."</font>";?></td>
	    </tr>
		  <?php 
			}
			?> 
		  <tr>
		     <td  align="left" nowrap>&nbsp;</td>
             <td  align="left" nowrap>&nbsp;</td>
             <td  align="left" nowrap>&nbsp;</td>
             <td  align="left" nowrap>&nbsp;</td>
		     <td align="left" nowrap>TOTAL</td>		   	
		     <td align="right">&nbsp;</td>
		     <td align="right"><?php echo $totalCreditosRegistrados; ?></td>
		
		     <td  align="left" nowrap><?php echo $totalCreditosMalla; ?></td>
		     <td  align="left" nowrap>&nbsp;</td>		 
		     <td align="right">&nbsp;</td>
		     <td align="right">&nbsp;</td>
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


/*
* Get Credito de la Malla
*/
function getCredito($serial_alu,$serial_mat,$serial_sec,$serial_car,$dblink){
	$sqlGet = "
	SELECT	
		maa.serial_maa,
		dma.serial_dma,
		nombre_maa,
		dma.serial_mat,
		mat.nombre_mat,
		dma.numerocreditos_dma
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
		AND maa.serial_car = ".$serial_car." 		
	";	
	//echo "<br>CRED: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

function getNota($serial_alu,$serial_sec,$serial_mat,$dblink){
	$sqlGet = "
		SELECT
			detallemateriamatriculada.serial_mat,
			notasalumnos.serial_dmat,
			codigo_mat,
			nombre_mat                                                                 
			AS materia,
			notatotal_nal,
			notaalfabetica_nal,
			''                                                                         
			AS notanumerica,
			''                                                                         
			AS creditomalla,
			''                                                                         
			AS tipomateria,
			estado_nal,
			nombre_per,
			periodo.serial_sec,
			numerocreditos_dmat creditosmateria,
			(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados,
			notasalumnos.serial_cale,
			CASE seccion_hrr 
				WHEN 'AVANZADA' 
				THEN seccion_hrr 
				WHEN 'UBICACION' 
				THEN seccion_hrr 
				ELSE ' ' 
			END                                                                            
			AS seccion_hrr 
		FROM
			notasalumnos ,
			materia,
			materiamatriculada,			
			periodo,
			alumno,
			horario 				
				LEFT JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
		WHERE
			materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
			
			AND materiamatriculada.serial_alu = alumno.serial_alu 
			AND periodo.serial_per = materiamatriculada.serial_per 
			AND materiamatriculada.serial_alu = ".$serial_alu." 
			AND periodo.serial_sec = ".$serial_sec." 
			AND horario.serial_hrr=detallemateriamatriculada.serial_hrr 
			AND estado_hrr = 'ACTIVO' 
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO') 
			AND materia.serial_mat=detallemateriamatriculada.serial_mat 
			AND materia.serial_mat = ".$serial_mat."
		ORDER BY
			fecini_per,
			materia

	";	
	//echo "<br>CRED: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}


/*
*/

?>