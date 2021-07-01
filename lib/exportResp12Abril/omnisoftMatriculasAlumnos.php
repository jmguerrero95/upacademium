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
		//echo "periodo_inicial:".$_GET['fecha_ini']."<br>";
		
		/*$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];*/
 		$fecha_ini=$_GET['fecha_ini'];
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		/*$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];*/
		$fecha_fin=$_GET['fecha_fin'];
		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
			//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per between '".$fecha_ini."' and '".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");
// and intensivo_per='".$tipo."' 
//COnsulta 
//echo "<br>".$inicio_carrera;	
//,carrera  --, nombre_car --and facultad.serial_fac=carrera.serial_fac
$sql_alumno="select distinct(alumno.serial_alu),codigo_alu,max(cabecerafactura.serial_caf), max(fecha_caf),codigoIdentificacion_alu,concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu, nombre1_alu,nombre2_alu) nombres
,mailuniv_alu,telefodomic_alu, telefotrabajo_alu,celular_alu,nombre_fac  
from alumno,detallearancel,aranceles,cabecerafactura,detallefactura  
left join alumnomalla on  alumno.serial_alu=alumnomalla.serial_alu 
left join malla on alumnomalla.serial_maa=malla.serial_maa and malla.serial_maa_p=0
left join  carrera on malla.serial_car=carrera.serial_car
left join facultad on  carrera.serial_fac=facultad.serial_fac
where 
 detallearancel.serial_ara=aranceles.serial_ara 
and detallefactura.serial_dar=detallearancel.serial_dar
and cabecerafactura.serial_caf=detallefactura.serial_caf
and (nombre_ara like 'MATRICULA%'  or nombre_ara like 'INSCRIPC%')
and aranceles.serial_ara<>69
and fecha_caf>='".$fecha_ini."'  and fecha_caf<='".$fecha_fin."'
and alumno.serial_alu=cabecerafactura.serial_alu
and cabecerafactura.serial_suc=".$serial_suc."
and alumno.serial_sec=".$serial_sec."
group by alumno.serial_alu
order by nombres
";
echo $sql_alumno;
$rsalumno=$dblink->Execute($sql_alumno); 
//mssql_free_result($resultado);
//COnsulta del Periodo Academico Inicial
/*$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per_ini);

$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas   from periodo where serial_per=".$serial_per_fin);*/
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
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
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">ALUMNOS POR MATRICULA </th>
  </tr>
  <tr >
    <th colspan="2"></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde <? echo $fecha_ini;?>&lt;=&gt; hasta <? echo $fecha_fin;?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">SEDE:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
		  <th width="3%"  style="">Nro.</th>
          <th width="5%">Código</th>
		  <th width="6%">C.I. </th>
		  <th width="18%">Alumno</th>
		  <th width="7%">E-mail</th>
		  <th width="13%">Fecha </th>
		  <th width="6%">Matricula</th>
		  <th width="7%">Tlf.Domicilio</th>
		  <th width="8%">Tlf.Trabajo</th>
		  <th width="10%">Celular</th>
		  <th width="17%">Facultad</th>
		</tr>
        
		<? $i=1;
			
			while (!$rsalumno->EOF) {
			   //echo $alumnos."<br>"; 
			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td  ><span class="style2"><? echo $rsalumno->fields['codigo_alu'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['codigoIdentificacion_alu'];?></span></td>
				<td nowrap="nowrap" ><span class="style2"><? echo $rsalumno->fields['nombres'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['mailuniv_alu'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['fecha_caf'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['serial_caf'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['telefodomic_alu'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['telefotrabajo_alu'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['celular_alu'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['nombre_fac'];?></span></td>
			
			
				</tr>
			
		<?
		$i++;
				$rsalumno->MoveNext();
		}
		?>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>

</body>
</html>