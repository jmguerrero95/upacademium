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
 		$serial_alu=$_GET['serial_alu'];
		$serial_sec=$_GET['serial_sec'];
	$sqlAlu = "
	SELECT 
		codigoIdentificacion_alu, 
		concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno,
		direcciondomic_alu,
		lugartrabajo_alu,
		direcciontrabajo_alu,
		mail_alu,mailuniv_alu,
		telefodomic_alu,
		telefotrabajo_alu,
		celular_alu,
		nombre_crp 
	FROM
		alumno,
		alumnomalla,
		malla 
		left join carrera on carrera.serial_car=malla.serial_car
		left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
		left join facultad on facultad.serial_fac=carrera.serial_fac 
	WHERE
		alumno.serial_alu=alumnomalla.serial_alu
		and alumnomalla.serial_maa=malla.serial_maa
		and serial_maa_p=0
		and malla.serial_sec=".$serial_sec."
		and alumno.serial_alu=".$serial_alu;
		$resultAlumno=$dblink->Execute($sqlAlu);
	//echo "<br>".$sqlAlu;	
	//Consulta de notas por periodo
	$sqlNot = "
	SELECT 
		detallemateriamatriculada.serial_mat,
		nombre_per, 
		nombre_mat as materia, 
		(dnal_1.nota_dnal + dnal_2.nota_dnal +dnal_3.nota_dnal + dnal_4.nota_dnal) as TOTAL, 
		notatotal_nal,notaalfabetica_nal,numerica_dcale,estado_nal,numerocreditos_dmat creditosmateria,
		(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados,notasalumnos.serial_cale 
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
	WHERE materiamatriculada.serial_alu = ".$serial_alu." 
		and periodo.serial_sec=1 
		and notaalfabetica_nal = alfabetica_dcale
		and (fecharetiro_dmat ='000-00-00' and retiromateria_dmat <>'SIN COSTO') 
		and nombre_per not like '%INTENSIVO%'
		and estado_nal not like 'REPRUEBA'
		and materia.serial_mat=detallemateriamatriculada.serial_mat 
	ORDER BY
		nombre_per
	";
	$rsNotas=$dblink->Execute($sqlNot);
	
	//echo "<br>".$sqlNot."<br>"; 
	//print_r($rsNotas);



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
        <th >PROMEDIO NOTAS BECAS POR TRIMESTRE </th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class="style1"><? echo $resultAlumno->fields['nombre_crp'];?> </span></th>
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
        <td width="35%"><span class='style2'><? echo $resultAlumno->fields['codigoIdentificacion_alu'];?> </span></td>
        <th width="17%" align="right">Fono Casa: </th>
        <td width="33%"><span class="style2"><? echo $resultAlumno->fields['telefodomic_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Nombre:</th>
        <td><span class="style2"><? echo $resultAlumno->fields['alumno'];?></span></td>
        <th align="right">Celular:</th>
        <td><span class="style2"><? echo $resultAlumno->fields['celular_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Direcci&oacute;n:</th>
        <td><span class="style2"><? echo $resultAlumno->fields['direcciondomic_alu'];?></span></td>
        <th align="right">Email:</th>
        <td><span class="style2"><? echo $resultAlumno->fields['mailuniv_alu']."<br>".$resultAlumno->fields['mail_alu'];?></span></td>
      </tr>
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th >Nº.</th>
          <th >Periodo</th>
          <th >Materia </th>


		  <th >T. Creditos Materia </th>
		  <th >T. Nota N&uacute;merica </th>
  		  <th >Promedio /4 </th>
	    </tr>
   
		<? 
			$i=1;
			while (!$rsNotas->EOF) { 
			?>
		   <tr>
		     <td  align="left" nowrap><span class="style2"><? echo $i;?></span></td>
             <td  align="left" nowrap><span class="style2"><? echo $rsNotas->fields['nombre_per'];?></span></td>

             <td align="left" nowrap><span class="style2"><? echo $rsNotas->fields['materia'];?></span></td>
		   	
		  <td align="right"><span class="style2"><? echo $rsNotas->fields['creditosmateria'];?></span></td>
		  <td align="right"><span class="style2"><? echo $rsNotas->fields['numerica_dcale'];?></span></td>
		  <td  align="left" nowrap><span class="style2"><? echo $promedio;?></span></td>		 
		 </tr>
				
			<?

			$i++;
			$rsNotas->MoveNext();
		}?> 
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th >Nº.</th>
          <th >Periodo</th>
          <th >T. Creditos Materia </th>
		  <th >T. Nota N&uacute;merica </th>
  		  <th >Promedio /4 </th>
	    </tr>
   
		<? 
			$i=1;
			$sqlPeriodo = "
				SELECT 
					detallemateriamatriculada.serial_mat,
					nombre_per, 
					sum(numerica_dcale) as total_nota_numerica,
					sum(numerocreditos_dmat) as total_creditos_materia    
					
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
				WHERE materiamatriculada.serial_alu =".$serial_alu."
					and periodo.serial_sec=1 
					and notaalfabetica_nal = alfabetica_dcale
					and (fecharetiro_dmat ='000-00-00' and retiromateria_dmat <>'SIN COSTO') 
					and nombre_per not like '%INTENSIVO%'
					and estado_nal not like 'REPRUEBA'
					and materia.serial_mat=detallemateriamatriculada.serial_mat 
				GROUP BY
					periodo.serial_per
				ORDER BY
					nombre_per			
			"; 
			$rsPeriodo = $dblink->Execute($sqlPeriodo);
			while (!$rsPeriodo->EOF) { 			?>
		   <tr>
		     <td  align="left" nowrap><span class="style2"><? echo $i;?></span></td>
             <td  align="left" nowrap><span class="style2"><? echo $rsPeriodo->fields['nombre_per'];?></span></td>

             <td align="right"><span class=""><? echo $rsPeriodo->fields['total_nota_numerica'];?></span></td>
		  <td align="right"><span class=""><? echo $rsPeriodo->fields['total_nota_numerica'];?></span></td>
		  <td  align="left"><span class=""><? echo $rsPeriodo->fields['total_nota_numerica'];?></span></td>		 
		 </tr>
				
			<?

			$i++;
			$rsPeriodo->MoveNext();
		}?> 
    </table>

 </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>


</body>
</html>