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
 		$serial_hrr=$_GET['serial_hrr'];
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$result_horario=$dblink->Execute('SELECT serial_hrr, NOMBREHORARIO_HRR FROM horario where serial_hrr='.$serial_hrr);

$result_alumnos=$dblink->Execute('select alumno.serial_alu, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno from alumno,materiamatriculada,detallemateriamatriculada where alumno.serial_alu=materiamatriculada.SERIAL_ALU and materiamatriculada.serial_mmat=detallemateriamatriculada.serial_mmat and serial_hrr='.$serial_hrr.' order by alumno');

//COnsulta las mallas de especialización
$rshorario=$dblink->Execute('select FECHACLASE_DHO, MONTH(FECHACLASE_DHO) as mes, entrada_apro,salida_apro,tema_apro,observaciones_apro from detallehorario left join asistenciaprofesor on detallehorario.serial_dho=asistenciaprofesor.serial_dho where serial_hrr='.$serial_hrr.' order by FECHACLASE_DHO');
$rshorario_temp=$dblink->Execute('select distinct(MONTH(FECHACLASE_DHO)) as mes from detallehorario where serial_hrr='.$serial_hrr.' order by FECHACLASE_DHO');

//COnsulta del Periodo Academico
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per from periodo,horario where periodo.serial_per=horario.serial_per  and horario.serial_hrr='.$serial_hrr);
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

<? 	
	$j=0;	
	while (!$rshorario_temp->EOF) {
	if($j>0) echo "<H1 class=SaltoDePagina> </H1>";
	?>
<BR>

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="6" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">FORMULARIO DE REGISTRO DE PROFESOR POR MATERIA</span></th>
  </tr>
  <tr >
    <th colspan="2"><? echo $rsPeriodo->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> DEL <? echo $rsPeriodo->fields['fecini_per'];?> AL <? echo $rsPeriodo->fields['fecfin_per'];?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROFESOR:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_epl.options[window.opener.document.PaginaDatos.serial_epl.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">MATERIA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_hrr.options[window.opener.document.PaginaDatos.serial_hrr.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
   <th align="right">HORARIO:</th>
    <th align="left"><span class='style3'> <? echo $result_horario->fields['NOMBREHORARIO_HRR'];?> </span></th>
	
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><span class="style3"><ol>
      <li>&nbsp;Tomar Asistencia a los alumnos presentes</li>
      <li>Se&ntilde;alar en su registro hora de entrada y salida</li>
      <li>Escribir el tema tratado diariamente</li>
      <li>Es necesaria su colaboraci&oacute;n para registrar sus horas en el rol de pago  </li>
    </ol></span></td>
  </tr>

  <tr>
    <td colspan="3" bgcolor="#FFFFFF">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
       
        
		<? $i=1;
		$rshorario->MoveFirst();
		while (!$rshorario->EOF) {
			if($i==1){
			?>
				 <tr>
          <th width="4%"  style=""><? echo "Nro."; ?></th>
          <th width="8%" >Fecha</th>
		 
          <th width="8%" >Entrada</th>
          <th width="8%" >Salida</th>
          <th width="37%" >Tema Tratado </th>
          <th width="18%" >Firma Profesor  </th>
          <th width="17%" >Observaciones</th>
        </tr>
			<?
			}
			if($rshorario_temp->fields['mes']==$rshorario->fields['mes']){
			?>
		
				<tr> 
				<td height="30"><span class="style2"><? echo $i;?></span></td>
				<td NOWRAP><span class="style2"><? echo $rshorario->fields['FECHACLASE_DHO'];?> </span></td>
				<td ><span class="style2"><? echo $rshorario->fields['entrada_apro'];?> </span></td>
				<td ><span class="style2"><? echo $rshorario->fields['salida_apro'];?> </span></td>
				<td ><span class="style2"><? echo $rshorario->fields['tema_apro'];?> </span></td>
				<td >&nbsp;</td>
				<td ><span class="style2"><? echo $rshorario->fields['observaciones_apro'];?> </span></td>
				</tr>
			
		<? 
			}
			$i=$i+1;
			$rshorario->MoveNext();
	  	}
		?>
		
    </table>
    </td>
  </tr>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>


          <td width="51%" align="center"><div align="left">
            <p>TOTAL HORAS PROGRAMADAS:</p>
            <p>TOTAL HORAS DICTADAS : </p>
          </div></td>
          <td width="49%" align="center"><div align="left">REVISADO POR: </div></td>
        </tr>
      </table></td>
  </tr>
</table>

<? 		$j++;
		$rshorario_temp->MoveNext();
	  	}
		?>
</body>
</html>