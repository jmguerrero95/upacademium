
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
	include('../adodb/adodb.inc.php');
	include('../../config/config.inc.php');
	
	function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);
	return $dblink;
	}

?>

<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
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
<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">DEPRECIACION DE BIENES </span></th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  </th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde  </th>
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
  
  <td colspan="3" bgcolor="#FFFFFF"  >
<table width="856" cellpadding="0" cellspacing="0">
  <col width="19" />
  <col width="97" />
  <col width="108" />
  <col width="46" />
  <col width="63" />
  <col width="35" />
  <col width="32" />
  <tr height="20">
    <td height="20" width="48"><div align="center">ID</div></td>
    <td width="148" ><div align="center">C&oacute;digo Contable</div></td>
    <td width="170" ><div align="center">Fecha    Adquisici&oacute;n</div></td>
    <td width="173"><div align="center">Detalle</div></td>
    <td width="150"><div align="center">Proveedor</div></td>
    <td width="77"><div align="center">Sede</div></td>
    <td width="87"><div align="center">Total</div></td>
  </tr>
  <tr height="20">
  <?php 
	$dblink = omnisoftConnectDB();		
	$sqlCab = "
    	SELECT	        	
            codigo_com as comprobante,            
            fadquisicion_cbf,
            nombre_cbf as activo,            
            nombre_pvd as proveedor,
			nombre_daf as nombre,
            costo_cbf,
            descripcion_age as agencia,
            claseactivo.prctdepreciacion_cla,
            claseactivo.serial_cla    
		FROM
			detalleactivo,
			ubicacion,
			departamentos,
			agencia,
			empleado,
			cabeceraactivo,
			tipoactivoproducto,
			claseactivo,
			plancontable,
			comprobante,
			proveedor
		WHERE 
			detalleactivo.serial_ubi=ubicacion.serial_ubi
			and detalleactivo.serial_dep = departamentos.serial_dep
			and detalleactivo.serial_epl = empleado.serial_epl
			and detalleactivo.serial_cbf = cabeceraactivo.serial_cbf
			and detalleactivo.serial_tap = tipoactivoproducto.serial_tap
			and cabeceraactivo.serial_cla = claseactivo.serial_cla
			and departamentos.serial_age = agencia.serial_age
			and claseactivo.serial_plc = plancontable.serial_plc
			and cabeceraactivo.serial_com = comprobante.serial_com
			and cabeceraactivo.serial_pvd = proveedor.serial_pvd			
		GROUP BY
            cabeceraactivo.serial_cbf
        ORDER BY
			detalleactivo.serial_daf
	";
	$rsActCab = $dblink->Execute($sqlCab);							
	$nRowsCab = $rsActCab->RecordCount(); 
	for ($i=0;$i<$nRowsCab;$i++){		
  		echo "<tr>";	
		$dia = explode("/",$rsActCab->fields['fadquisicion_cbf']);
		$dif = 30 - $dia[0];
		//$depreciacion = $dif;
		//echo  
		$depreciacion = ($rsActCab->fields['costo_cbf']*$rsActCab->fields['prctdepreciacion_cla'])/(12/30*$dif);
  ?>
    <td height="20"><div align="center"><?php echo $i+1;?></div></td>
    <td><div align="center"><?php echo $rsActCab->fields['comprobante'];?></div></td>
    <td><div align="center"><?php echo $rsActCab->fields['fadquisicion_cbf'];?></div></td>
    <td><div align="center"><?php echo $rsActCab->fields['nombre'];?></div></td>
    <td><div align="center"><?php echo $rsActCab->fields['proveedor'];?></div></td>
    <td><div align="center"><?php echo $rsActCab->fields['agencia'];?></div></td>
    <td><div align="center"><?php echo $depreciacion;?></div></td>
<?php
	$rsActCab->MoveNext();	
  		echo "</tr>";	
	}

?>
  </tr>
</table>  
  
  </td>
</table>



</body>
</html>