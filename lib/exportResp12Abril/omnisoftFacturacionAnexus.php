<?php
if($exportar=='Exportar')
{
  header("Content-disposition: filename=Ventas.xls");
  header("Content-type: application/octetstream");
  header("Pragma: no-cache");
  header("Expires: 0");
}
?>

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
 		$fecha_ini=$_GET['fecha_ini'];
		$fecha_fin=$_GET['fecha_fin'];		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
$sql_alumno="
select 
cab.fecha_caf as fecha,
month(cab.fecha_caf) as mes,
year(cab.fecha_caf)as anio,
cab.cedula_caf as descripcion,
cab.cliente_caf as razon_social,
cab.numero_caf nro_factura,
sum(det.valor_aal*det.cantidad_dfa+det.descuento_dfa) as basetarifacero,
sum(0) as base_imponible,
sum(0) as monto_iva,
sum(0) as base_imponible_ice,
sum(0) as monto_ice
from cabecerafactura cab, detallefactura det
where cab.serial_caf=det.serial_caf
and cab.fecha_caf>='$fecha_ini' and cab.fecha_caf<='$fecha_fin'
and cab.serial_suc = $serial_suc
and cab.estado_caf <> 'ANULADO'
group by det.serial_caf
";

//echo "<br>".$sql_alumno."<br>";
$rsalumno=$dblink->Execute($sql_alumno); 
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
<form name="reporte" method="post" action="omnisoftFacturacionAnexus.php">
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">REPORTE FACTURACI&Oacute;N ANEXUS </th>
  </tr>
  <tr >
    <th colspan="2"></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE SELECCI&Oacute;N: desde <? echo $fecha_ini;?>&lt;=&gt; hasta <? echo $fecha_fin;?> </th>
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
		  <th width="5%"  style="">No.</th>
		  <th width="5%"  style="">Fecha.</th>
          <th width="4%">Mes</th>
		  <th width="5%">A&ntilde;o </th>
		  <th width="17%">ID</th>
		  <th width="12%">Razon Social </th>
		  <th width="9%">Nro. Factura  </th>
		  <th width="7%">Base Tarifa 0 </th>
		  <th width="10%">Base Imponible </th>
		  <th width="8%">Monto IVA </th>
		  <th width="8%">Base Imponible ICE </th>
		  <th width="15%">Monto ICE </th>
		</tr>
        
		<? $i=1;
			$sumbtc = 0;
			
			while (!$rsalumno->EOF) {
			   //echo $alumnos."<br>"; 
			   $sumbtc = $sumbtc + $rsalumno->fields['basetarifacero'];
			?>			

				
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td><span class="style2"><? echo $rsalumno->fields['fecha'];?></span></td>
				<td  ><span class="style2"><? echo $rsalumno->fields['mes'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['anio'];?></span></td>
				<td nowrap="nowrap" ><span class="style2"><? echo $rsalumno->fields['descripcion'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['razon_social'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['nro_factura'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['basetarifacero'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['base_imponible'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['monto_iva'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['base_imponible_ice'];?></span></td>
				<td ><span class="style2"><? echo $rsalumno->fields['monto_ice'];?></span></td>
				</tr>
			
		<?
		$i++;
				$rsalumno->MoveNext();
		}
		?>
    </table>    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="952" border="1">
        <tr>
          <td width="367"><input type="submit" name="exportar" value="Exportar" /></td>
          <td width="240"><div align="right"><strong>Total Base Tarifa 0 : </strong></div></td>
          <td width="323"><?php echo $sumbtc;?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>