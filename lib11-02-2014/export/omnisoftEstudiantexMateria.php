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
		include('../server/funciones.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$serial_hrr=$_GET['serial_hrr'];
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)

$sqlAlm = 'select alumno.serial_alu,materiamatriculada.serial_mmat, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno,mailuniv_alu from alumno,materiamatriculada,detallemateriamatriculada where alumno.serial_alu=materiamatriculada.SERIAL_ALU and materiamatriculada.serial_mmat=detallemateriamatriculada.serial_mmat and serial_hrr='.$serial_hrr.' and retiromateria_dmat!= \'SIN COSTO\'order by alumno';
$result_alumnos=$dblink->Execute($sqlAlm);
//echo "<br>".$sqlAlm;
//COnsulta las mallas de especialización
$rshorario=$dblink->Execute('select FECHACLASE_DHO from detallehorario where serial_hrr='.$serial_hrr.' order by FECHACLASE_DHO');

//Email de profesor
$rsprofesor=$dblink->Execute('select emailuniv_epl from empleado,horario where empleado.serial_epl=horario.serial_epl and serial_hrr='.$serial_hrr);

//COnsulta del Periodo Academico
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per from periodo,horario where periodo.serial_per=horario.serial_per  and horario.serial_hrr='.$serial_hrr);
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:12px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.style4 {font-size:14px; font:Arial, Helvetica, sans-serif}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
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
<table width="85%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="4"><span class="style1">FORMULARIO DE REGISTRO DE ESTUDIANTES POR MATERIA</span></th>
  </tr>
  <tr >
    <th colspan="4"><? echo $rsPeriodo->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="4"> DEL <? echo $rsPeriodo->fields['fecini_per'];?> AL <? echo $rsPeriodo->fields['fecfin_per'];?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROFESOR:</th>
    <th width="30%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_epl.options[window.opener.document.PaginaDatos.serial_epl.selectedIndex].text);
		</script></span></th>
    <th width="15%" align="left">E-mail:</th>
    <th width="16%" align="left"><? echo strtolower($rsprofesor->fields['emailuniv_epl']);?></th>
  </tr>
  <tr>
    <th align="right">MATERIA:</th>
    <th colspan="3" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_hrr.options[window.opener.document.PaginaDatos.serial_hrr.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="1%"  style="">Nro.</th>
          <th width="25%">Alumnos </th>
		  <th width="20%">E-mail </th>
		<?php 
		$celdas = "";
		while (!$rshorario->EOF) {
		?>
          
		  <th width="2%"  class="textovertical"><span class='style2'><? echo $rshorario->fields['FECHACLASE_DHO'];?> </span> </th>
		 <?php 
		  	$celdas=$celdas."<td >&nbsp;</td>";
			$rshorario->MoveNext();
	  	}
		?>
        </tr>
        
		<?php  
		$i=1;
		$fecha_periodo = $rsPeriodo->fields['fecini_per'];
		$fecha_inicio = "2011-07-01";
		if($fecha_periodo >= $fecha_inicio){
			echo "<span class='style2'>NOTA: Los Estudiantes que tengan obligaciones pendientes con Financiero serán excluidos de este listado...</span>";
			while (!$result_alumnos->EOF) {				
				$showList = verificarPagoCreditos($result_alumnos->fields['serial_mmat'],$dblink);					
				if($showList[0]['show'] == "SI"){
					$val =  "
						<tr> 
							<td><span class='style2'>".$i."</span></td>
							<td NOWRAP><span class='style2'>".$result_alumnos->fields['alumno']."</span></td>
							<td NOWRAP><span class='style4'>".strtolower($result_alumnos->fields['mailuniv_alu'])."</span></td>
							".$celdas."</tr>";
					echo $val;
					$i++;
				}				
				
				$result_alumnos->MoveNext();						
			}
		
		}else{
			//NO Habilitar la funcion
			while (!$result_alumnos->EOF) {	
				$val =  "
					<tr> 
						<td><span class='style2'>".$i."</span></td>
						<td NOWRAP><span class='style2'>".$result_alumnos->fields['alumno']."</span></td>
						<td NOWRAP><span class='style4'>".strtolower($result_alumnos->fields['mailuniv_alu'])."</span></td>
						".$celdas."</tr>";
				echo $val;
				$i=$i+1;
				$result_alumnos->MoveNext();
			}				
		}
		?>
		
	
		
    </table>    </td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>


          <td align="center"><span class="style2"><BR><BR>COORDINACION ACADEMICA</span></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>