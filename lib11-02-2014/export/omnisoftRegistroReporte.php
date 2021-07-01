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
 		$serial_mmat=$_GET['serial_mmat'];
		//echo($serial_maa);

$result_alumnos=$dblink->Execute('select codigoIdentificacion_alu, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno,direcciondomic_alu,lugartrabajo_alu,direcciontrabajo_alu, mail_alu,telefodomic_alu,telefotrabajo_alu,celular_alu from alumno,materiamatriculada where alumno.serial_alu=materiamatriculada.SERIAL_ALU and SERIAL_MMAT='.$serial_mmat);

//COnsulta las mallas de especialización
$rsEspecializacion=$dblink->Execute('select nombre_maa,\'\' as tipo
 from  alumnomalla,materiamatriculada,malla
where alumnomalla.serial_alu=materiamatriculada.SERIAL_ALU and malla.serial_maa=alumnomalla.serial_maa  and serial_maa_p=0 and materiamatriculada.SERIAL_MMAT='.$serial_mmat.'  and malla.serial_sec<>7 
union
select nombre_maa, tipo_eal
from  alumnomalla,materiamatriculada,malla,especializacion
where alumnomalla.serial_alu=materiamatriculada.SERIAL_ALU  
and especializacion.serial_ama=alumnomalla.serial_ama and  especializacion.serial_maa=malla.serial_maa and materiamatriculada.SERIAL_MMAT='.$serial_mmat);


$programa='';
$mayor='';
$menor='';

 while (!$rsEspecializacion->EOF) {
 	if($rsEspecializacion->fields['tipo']=='') 
			 $programa=$rsEspecializacion->fields['nombre_maa'];
	if($rsEspecializacion->fields['tipo']=='MAYOR') 
			 $mayor=$rsEspecializacion->fields['nombre_maa'];
	if($rsEspecializacion->fields['tipo']=='MENOR') 
			 $menor=$rsEspecializacion->fields['nombre_maa'];		 		 
		 $rsEspecializacion->MoveNext();
}

//Consulta de materias de registro
$rsMaterias=$dblink->Execute('select nombre_mat, NOMBREHORARIO_HRR, observaciones_dmat, seccion_hrr, if( fecharetiro_dmat=\'0000-00-00\', retiromateria_dmat, concat(\'( \', if( creditosequivalentes_dmat IS NULL , numerocreditos_dmat ,  numerocreditos_dmat+ creditosequivalentes_dmat),\' ) \',retiromateria_dmat))  retiromateria_dmat, if( fecharetiro_dmat=\'0000-00-00\', \'\',fecharetiro_dmat) as fecharetiro_dmat,  if( fecharetiro_dmat=\'0000-00-00\', numerocreditos_dmat,0) + if( fecharetiro_dmat=\'0000-00-00\', creditosequivalentes_dmat,0) as creditos   from detallemateriamatriculada,materia,horario
 where detallemateriamatriculada.serial_mat=materia.serial_mat and horario.serial_hrr=detallemateriamatriculada.serial_hrr and  serial_mmat='.$serial_mmat);

//COnsulta del Periodo Academico
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per,FECHAMATRICULA_MMAT,fechamatriculaordini_per,fechamatriculaordfin_per, fechamatriculaextraordini_per, fechamatriculaextraordfin_per ,fechaCambioFin_per from periodo,materiamatriculada where periodo.serial_per=materiamatriculada.serial_per  and materiamatriculada.SERIAL_MMAT='.$serial_mmat);
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
<BR>
<BR>
<BR>
<BR>
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="4" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th width="79%"><span class="style1">FORMULARIO DE REGISTRO DE MATERIAS</span></th>
  </tr>
  <tr>
    <th><? echo $rsPeriodo->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th> DEL <? echo $rsPeriodo->fields['fecini_per'];?> AL <? echo $rsPeriodo->fields['fecfin_per'];?> </th>
  </tr>
  <tr>
    <th> N.- 0000<? echo $serial_mmat;?> </th>
  </tr>
  <tr>
    <th colspan="2" bgcolor="#FFFFFF">
	<table border="0" width="100%" >
	<tr><td>FECHA DEL REGISTRO:&nbsp;&nbsp;&nbsp;<? echo $rsPeriodo->fields['FECHAMATRICULA_MMAT'];?></td>
	<td>&nbsp;&nbsp;&nbsp;<?
		 if($rsPeriodo->fields['FECHAMATRICULA_MMAT']>=$rsPeriodo->fields['fechamatriculaextraordini_per'] )
			echo "EXTRAORDINARIO"; 
		 else 	echo "ORDINARIO"; 
	
	?>
	</td></tr>
	</table>
	</th>
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
        <td><span class="style2"><? echo $result_alumnos->fields['mail_alu'];?></span></td>
      </tr>
      <tr>
       <th align="right">Lugar de Oficina: </th>
        <td><span class="style2"><? echo $result_alumnos->fields['lugartrabajo_alu'];?></span></td>
        <th align="right">Fono Oficina: </th>
        <td><span class="style2"><? echo $result_alumnos->fields['telefotrabajo_alu'];?></span></td>
      </tr>
      <tr>
        <th align="right">Direcci&oacute;n Oficina: </th>
        <td><span class="style2"><? echo $result_alumnos->fields['direcciontrabajo_alu'];?></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th align="right">PROGRAMA:</th>
        <td colspan="3"><span class="style2"><? echo $programa;?></span></td>
        </tr>
      <tr>
        <th align="right">MAYOR:</th>
        <td><span class="style2"><? echo $mayor;?></span></td>
        <th align="right">MENOR:</th>
        <td><span class="style2"><? echo $menor;?></span></td>
      </tr>
    </table>
	<br>
	<br />
      <table width="100%" border="1">
        <tr>
          <th>MATERIAS </th>
          <th>HORARIOS </th>
          <th>RETIRO</th>
          <th>FECHA RETIRO </th>
          <th>CREDITOS </th>
        </tr>
        
		<? $total=0;
		while (!$rsMaterias->EOF) {
		
		if($rsMaterias->fields['observaciones_dmat']=='NINGUNA')
			$horario=$rsMaterias->fields['NOMBREHORARIO_HRR']." - ".$rsMaterias->fields['seccion_hrr'];
		else	
			$horario=$rsMaterias->fields['NOMBREHORARIO_HRR']." - ".$rsMaterias->fields['seccion_hrr']."<strong>=>(".$rsMaterias->fields['observaciones_dmat'].")</strong>";
		
		?>
			<tr> 
			<td><span class="style2"><? echo $rsMaterias->fields['nombre_mat'];?></span></td>
			<td><span class="style2"><? echo $horario;?></span></td>
			<td align="center"> <span class="style2"><? echo $rsMaterias->fields['retiromateria_dmat'];?></span></td>
			<td align="center"><span class="style2"><? echo $rsMaterias->fields['fecharetiro_dmat'];?></span></td>
			<td align="center"><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>
			</tr>
			
		<? 
			$total=$total+$rsMaterias->fields['creditos'];
			$rsMaterias->MoveNext();
	  	}
		?>
		<tr>
			  <th colspan="2" align="right">Total:</th>
			  <td align="center">&nbsp;</td>
			  <td align="center">&nbsp;</td>
			  <td align="center"><span class="style2"><? echo $total;?></span></td>
	    </tr>
    </table>
      <BR><BR>
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><span class="style2">El alumno y esta deacuerdo con las disposiciones con que acontinuación se detallan:
	<li>1.- Nota .- Todo cambio ó retiro de materia debe ser comunicado con solicitud escrita en coordinación en el Registro respectivo hasta el <? echo $rsPeriodo->fields['fechaCambioFin_per'];?> (sin recargo).</li>	
	<li>2.- Las materias deben ser aprobadas con un mínimo de 85% de asistencia.</li>
	<li>3.- Es responsabilidad del alumno haber aprobado el prerequisito de materia a tomar.</li>
	<li>4.- Acepto el total de créditos, los mismo que me comprometo a pagar.</li></span></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>


          <td align="center"><span class="style2"><BR><BR>FIRMA ESTUDIANTE</span></td>
          <td align="center"><span class="style2"><BR><BR>COORDINACION ACADEMICA</span></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>