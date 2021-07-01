<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$serial_alu=$_GET['serial_alu'];
		$serial_sec=$_GET['serial_sec'];
		//echo($serial_maa);

$sqlAlu = 'select codigoIdentificacion_alu, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno,direcciondomic_alu,lugartrabajo_alu,direcciontrabajo_alu, mail_alu,mailuniv_alu,telefodomic_alu,telefotrabajo_alu,celular_alu,nombre_crp from alumno,alumnomalla,malla 
	left join carrera on carrera.serial_car=malla.serial_car
	left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
	left join facultad on facultad.serial_fac=carrera.serial_fac 
	where  
	 alumno.serial_alu=alumnomalla.serial_alu
	and alumnomalla.serial_maa=malla.serial_maa
	and serial_maa_p=0
	and malla.serial_sec='.$serial_sec.'
	and alumno.serial_alu='.$serial_alu;
$result_alumnos=$dblink->Execute($sqlAlu);
	

//Consulta de materias de registro
$sqlNot = "SELECT notasalumnos.serial_dmat, codigo_mat, nombre_mat as materia, 
 dnal_1.nota_dnal as actividades_clase, dnal_2.nota_dnal as trabajos, 
dnal_3.nota_dnal as ex_parcial, dnal_4.nota_dnal as ex_final, (dnal_1.nota_dnal + dnal_2.nota_dnal +dnal_3.nota_dnal + dnal_4.nota_dnal) as TOTAL, 
notatotal_nal,notaalfabetica_nal,estado_nal,nombre_per,(numerocreditos_dmat+creditosequivalentes_dmat) creditos
FROM notasalumnos , materia
JOIN detallenotasalumnos as dnal_1 on dnal_1.serial_nal = notasalumnos.serial_nal and dnal_1.serial_acal=1
 JOIN detallenotasalumnos as dnal_2 on dnal_2.serial_nal = notasalumnos.serial_nal and dnal_2.serial_acal=2 
JOIN detallenotasalumnos as dnal_3 on dnal_3.serial_nal = notasalumnos.serial_nal and dnal_3.serial_acal=3 
JOIN detallenotasalumnos as dnal_4 on dnal_4.serial_nal = notasalumnos.serial_nal and dnal_4.serial_acal=4 
JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu 
JOIN periodo ON periodo.serial_per=materiamatriculada.serial_per
WHERE materiamatriculada.serial_alu =".$serial_alu."
and periodo.serial_sec=".$serial_sec."
and materia.serial_mat=detallemateriamatriculada.serial_mat order by nombre_per,materia";
$rsNOTAS=$dblink->Execute($sqlNot);

//echo "<br>".$sqlNot."<br>"; 
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
        <th ><span class="style1">NOTAS ACADEMICAS OBTENIDAS EN LA CARRERA </span></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class="style1"><? echo $result_alumnos->fields['nombre_crp'];?> </span></th>
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
        <td width="35%"><span class='style2'><? echo $result_alumnos->fields['codigoIdentificacion_alu'];?> </span></td>
        <th width="17%" align="right">Fono Casa: </th>
        <td width="33%"><span class="style2"><? echo $result_alumnos->fields['telefodomic_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Nombre:</th>
        <td><span class="style2"><? echo $result_alumnos->fields['alumno'];?></span></td>
        <th align="right">Celular:</th>
        <td><span class="style2"><? echo $result_alumnos->fields['celular_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Direcci&oacute;n:</th>
        <td><span class="style2"><? echo $result_alumnos->fields['direcciondomic_alu'];?></span></td>
        <th align="right">Email:</th>
        <td><span class="style2"><? echo $result_alumnos->fields['mailuniv_alu']."<br>".$result_alumnos->fields['mail_alu'];?></span></td>
      </tr>
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th >Nº.</th>
          <th >Periodo</th>
		  <th >Creditos</th>
          <th >Cod. </th>
		  <th >Materia </th>
		  <th >Actividad Clase </th>
		  <th >Trabajos </th>
		  <th >Examen Parcial </th>
		  <th >Examen Final </th>
		  <th >TOTAL </th>
		  <th >Nota Final </th>
		  <th >Nota Alfabetica </th>
		  <th >Estado </th>
		  </tr>
   
		<? $total_creditos=0;
		
			$num_mat=1;
			while (!$rsNOTAS->EOF) { 
			?>
		   <tr>
		     <td  align="left" nowrap><? echo $num_mat;?></td>
             <td  align="left" nowrap><? echo $rsNOTAS->fields['nombre_per'];?></td>
			 <td  align="left" nowrap><? echo $rsNOTAS->fields['creditos'];?> </td>
             <td  align="left" nowrap><? echo $rsNOTAS->fields['codigo_mat'];?> </td>
		  <td align="left" nowrap><? echo $rsNOTAS->fields['materia'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['actividades_clase'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['trabajos'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['ex_parcial'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['ex_final'];?></td>
		  <td align="right"><? echo $rsNOTAS->fields['TOTAL'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['notatotal_nal'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['notaalfabetica_nal'];?></td>
		  <td align="right"><? echo $rsNOTAS->fields['estado_nal'];?></td>
		  </tr>
				
			<?
			if($rsNOTAS->fields['estado_nal']=='APRUEBA')
				$total_creditos=$total_creditos+$rsNOTAS->fields['creditos'];
			$total_notas=$total_notas+$rsNOTAS->fields['notatotal_nal'];
			$num_mat++;
			
			//echo "promedio:".$promedio;
			$rsNOTAS->MoveNext();
			}
			$promedio=number_format($total_notas/($num_mat-1),2);
		?> 
		<tr>
          <th colspan="10" >PROMEDIO </th>
		  <th ><? echo $promedio; ?> </th>
		  <th >&nbsp; </th>
		  <th >&nbsp; </th>
		  </tr>
		  <tr>
          <th colspan="10" >CREDITOS APROBADOS </th>
		  <th ><? echo $total_creditos; ?> </th>
		  <th >&nbsp; </th>
		  <th >&nbsp; </th>
		  </tr>
    </table>
      <BR><BR>
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>