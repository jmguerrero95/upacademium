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
$result_alumnos=$dblink->Execute('select alumno.serial_alu, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno,mailuniv_alu from alumno,materiamatriculada,detallemateriamatriculada where alumno.serial_alu=materiamatriculada.SERIAL_ALU and materiamatriculada.serial_mmat=detallemateriamatriculada.serial_mmat and serial_hrr='.$serial_hrr.' and retiromateria_dmat!= \'SIN COSTO\'order by alumno');

//COnsulta de credito de materia segun horario
$rscredito=$dblink->Execute("select numerocreditos_dmat from detallemateriamatriculada where serial_hrr =".$serial_hrr." group by serial_hrr");

//Email de profesor
$rsprofesor=$dblink->Execute("select concat_ws(' ',apellido_epl,nombre_epl) as nombre,emailuniv_epl from empleado,horario where empleado.serial_epl=horario.serial_epl and serial_hrr=".$serial_hrr);

//COnsulta del Periodo Academico
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per from periodo,horario where periodo.serial_per=horario.serial_per  and horario.serial_hrr='.$serial_hrr);

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
<table width="72%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="99%" border="0">
      <tr bgcolor="#FFFFFF">
        <th >UNIVERSIDAD DEL PACIFICO - ESCUELA DE NEGOCIOS </th>
      </tr>
      <tr>
        <th><? echo $rsPeriodo->fields['nombre_per'];?></th>
      </tr>
      <tr>
        <th> DEL <? echo $rsPeriodo->fields['fecini_per'];?> AL <? echo $rsPeriodo->fields['fecfin_per'];?> </th>
      </tr>
      <tr>
        <th> </th>
      </tr>
      <tr>
        <th align="right"><div align="center">Acta de Calificaciones &nbsp;
            <script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script>
        </div></th>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="99%" border="1">
      <tr>
        <th width="22%" align="right">Profesor </th>
        <td width="41%"> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_epl.options[window.opener.document.PaginaDatos.serial_epl.selectedIndex].text);
		</script></td>
        <th width="37%" rowspan="3" align="right"><div align="left">A = <strong>Act.en Clase...............20% </strong><br />
          T = Trabajos......................30% <br />
          E.P. = EX. Parcial..............20% <br />
          E.F. = EX. Final.................30% </div></th>
        </tr>
      <tr>
        <th align="right">Materia</th>
        <td><script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_hrr.options[window.opener.document.PaginaDatos.serial_hrr.selectedIndex].text);
		</script></td>
        </tr>
      <tr>
        <th align="right">Creditos </th>
        <td><span class="style2"><? echo $rscredito->fields['numerocreditos_dmat'];?></span></td>

        </tr>
    </table>
	<br>
	<table width="99%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="11%" >No. </th>
		  <th width="18%" >Alumno </th>
		  <th width="13%" >A</th>
		  <th width="14%" >T </th>
		  <th width="14%" >EP</th>
		  <th width="15%" >E.F.</th>
		  <th width="15%" >Prom. P </th>
	    </tr>
   
		<? 
			$num_mat=0;
			while (!$result_alumnos->EOF) { 
			?>
		   <tr>
          <td  align="left" nowrap><? echo $num_mat+1;$num_mat++;//$rsNOTAS->fields['codigo_mat'];?> </td>
		  <td align="left" nowrap><? echo $result_alumnos->fields['alumno'];?> </td>
		  <td align="right">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  </tr>
							
			<?
			//$total_notas=$total_notas+$rsNOTAS->fields['notatotal_nal'];

			//$promedio=number_format($total_notas/$num_mat,2);
			//echo "promedio:".$promedio;
			$result_alumnos->MoveNext();
			}
		?> 
		    <tr>
		      <th colspan="7" >&nbsp;</th>
        </tr>
	    <tr>
          <th colspan="7" ><div align="left">Observaciones:</div></th>
	    </tr>
		  <tr>
          <th colspan="7" ><div align="left"></div></th>
		  </tr>
		  <tr>
          <th colspan="7" ><div align="left"></div></th>
		  </tr>
		  <tr>
          <th colspan="7" >&nbsp;</th>
		  </tr>
    </table>
      <BR>
      <table width="675" border="1">
        <tr>
          <td width="288">&nbsp;</td>
          <td width="52">&nbsp;</td>
          <td width="266">&nbsp;</td>
        </tr>
        <tr>
          <td><div align="center"><strong>Firma Profesor </strong></div></td>
          <td>&nbsp;</td>
          <td><div align="center"><strong>Firma Coordinaci&oacute;n Acad&eacute;mica </strong></div></td>
        </tr>
      </table>
      <BR>
    <br /></td>
  </tr>
  <tr>
    <td height="2" colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>