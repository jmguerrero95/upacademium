<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
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
 	$serial_suc = $_GET['serial_suc'];
	$serial_sec = $_GET['serial_sec'];
	$periodo = explode("*",$_GET['serial_per']);
	$serial_per = $periodo[0];
	
	$sqlAlu = "
	SELECT 
		materiamatriculada.serial_alu, 
		concat_ws(' ', nombre1_alu,nombre2_alu,apellidopaterno_alu,apellidomaterno_alu) as nombre 
	
	FROM 
		materiamatriculada,periodo,detallemateriamatriculada,alumno,alumnomalla,malla 
		left join carrera on carrera.serial_car=malla.serial_car 
		left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp 
		left join facultad on facultad.serial_fac=carrera.serial_fac 
		left join sexo on alumno.serial_sex = sexo.serial_sex 
	WHERE 
		materiamatriculada.SERIAL_MMAT=detallemateriamatriculada.serial_mmat 
		and alumno.serial_alu=materiamatriculada.serial_alu 
		and periodo.serial_per=materiamatriculada.serial_per 
		and periodo.serial_suc = ".$serial_suc." 
		and periodo.serial_sec = ".$serial_sec." 
		and malla.serial_sec = ".$serial_sec." 
		and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD') 
		and alumno.serial_alu=alumnomalla.serial_alu 
		and periodo.serial_per = ".$serial_per."
		and alumnomalla.serial_maa=malla.serial_maa 
	GROUP BY 
		serial_alu 
	ORDER BY 
	nombre
	";
		$resultAlumno=$dblink->Execute($sqlAlu);
	//echo "<br>".$sqlAlu."<br>";
	//Consulta de notas por periodo
	//$resultAlumno=$dblink->Execute($sqlNot);
	
	//echo "<br>".$sqlNot."<br>"; 
	//print_r($resultAlumno);



//COnsulta del Periodo Academico
/*
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per from periodo,materiamatriculada where periodo.serial_per=materiamatriculada.serial_per  and materiamatriculada.SERIAL_MMAT='.$serial_mmat);*/
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
      <tr bgcolor="#FFFFFF">
        <th >PROMEDIO  BECAS POR TRIMESTRE </th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class="style1"><? ?> </span></th>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th align="right">Periodo&nbsp;
          <script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></th>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1">
      <tr>
        <th width="15%" align="right">Periodos: </th>
        <td width="35%">&nbsp;</td>
        <th width="17%" align="right">Sucursal</th>
        <td width="33%">&nbsp;</td>
      </tr>
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="5%" >Nº.</th>
          <th width="26%" >Alumno</th>
          <th width="17%" >#Per </th>


		  <th width="13%" >T. Cred Mat. </th>
		  <th width="20%" >T. Nota N&uacute;merica </th>
  		  <th width="19%" >Promedio /4 </th>
	    </tr>
   
		<? 
			$i=1;
			while (!$resultAlumno->EOF) { 
			
			$sqlNot = "
				SELECT 		
					materiamatriculada.serial_alu,
					count(detallemateriamatriculada.serial_mat) as nmaterias,
					count(periodo.serial_per) as nperiodos,
					sum(numerocreditos_dmat) as creditosmateria,
					sum(numerocreditos_dmat+creditosequivalentes_dmat) as tcreditostomados,
					sum(numerica_dcale)as tnotanumerica        					
				FROM notasalumnos, materia 
					JOIN detallenotasalumnos as dnal_1 on dnal_1.serial_nal = notasalumnos.serial_nal and dnal_1.serial_acal=1 
					JOIN detallenotasalumnos as dnal_2 on dnal_2.serial_nal = notasalumnos.serial_nal and dnal_2.serial_acal=2 
					JOIN detallenotasalumnos as dnal_3 on dnal_3.serial_nal = notasalumnos.serial_nal and dnal_3.serial_acal=3 
					JOIN detallenotasalumnos as dnal_4 on dnal_4.serial_nal = notasalumnos.serial_nal and dnal_4.serial_acal=4 
					JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
					JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
					JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu 
					JOIN periodo ON periodo.serial_per=materiamatriculada.serial_per 
					JOIN detallecalificacionequivalencia as dcal ON dcal.serial_cale = notasalumnos.serial_cale
				WHERE materiamatriculada.serial_alu = ".$resultAlumno->fields['serial_alu']." 
					and periodo.serial_sec=".$serial_sec." 
					and notaalfabetica_nal = alfabetica_dcale
					and (fecharetiro_dmat ='000-00-00' and retiromateria_dmat <>'SIN COSTO') 
					and nombre_per not like '%INTENSIVO%'
					and estado_nal not like 'REPRUEBA'
					and materia.serial_mat=detallemateriamatriculada.serial_mat 
				GROUP BY
					materiamatriculada.serial_alu
				ORDER BY
					nombre_per
				";
				$resNot=$dblink->Execute($sqlNot);
				$numRows = $resNot->RecordCount();
				if($numRows>0){						
					while(!$resNot->EOF){
						$numPer = $resNot->fields['nperiodos'];
						$tcredidosMateria = $resNot->fields['creditosmateria'];
						$tnotaNumerica = $resNot->fields['tnotanumerica'];						
						$resNot->MoveNext();
					}
				}else{
						$numPer = "&nbsp";
						$tcredidosMateria = "&nbsp";
						$tnotaNumerica = "&nbsp";				
				}
			?>
		   <tr>
		     <td  align="left" nowrap><span class="style2"><? echo $i;?></span></td>
             <td  align="left" nowrap><span ><? echo "<a href='omnisoftPromedioNotasAlumnoBecaRespaldo.php?serial_alu=".$resultAlumno->fields['serial_alu']."' title='Ver Detalle de ".$resultAlumno->fields['nombre']."'>".$resultAlumno->fields['nombre']."</a>";?></span></td>

             <td align="left" nowrap><span class="style2"><?php echo $numPer;?></span></td>
		   	
		  <td align="right"><span class="style2"><?php echo $tcredidosMateria;?></span></td>
		  <td align="right"><span class="style2"><?php echo $tnotaNumerica; ?></span></td>
		  <td  align="left" nowrap><span class="style2"><? echo number_format($tcredidosMateria/$tnotaNumerica,2);?></span></td>		 
		 </tr>
				
			<?

			$i++;
			$resultAlumno->MoveNext();
		}?> 
    </table>
	<br>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>


</body>
</html>