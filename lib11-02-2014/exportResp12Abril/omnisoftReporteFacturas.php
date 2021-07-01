<?php
	//include('../lib/adodb/adodb.inc.php');
	//include('../config/config.inc.php');
	
	/*include_once('../config/config.tesoreria.inc.php');
	  include_once('../config/config.inc.php');
      include_once('variablesTesoreria.php');
      include_once('../config/formatos.php');
      include_once('../config/mensaje.php');
   	  //include_once('sBancoTesoreria.php');
	  //include_once('sDepositos.php');
	  include_once('../parametros/sAgencia.php');
  	  include_once('../parametros/sParametros.php');
  	  include_once('../contabilidad/sPlanContable.php');
	  include_once('../contabilidad/sComprobante.php');
	  include_once('../contabilidad/sDetalleComprobante.php');
	  include_once('../contabilidad/sPeriodoContable.php');
	  include_once('../contabilidad/sTipoComprobante.php');
	 // include_once('sComprobanteFactura.php');
	  include_once('../config/config.seguridadesplus.inc.php');
	  include_once('ssmItems.php');*/
      //require_once('../lib/excel/reader.php');
		  
	
	/*function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);
	return $dblink;
	}*/
	
	
	//include_once('../config/cabecera.php');
    //$guardar="<a href=\"#\" onClick=\"validar(); return false\">";
    //$cancelar="<a href=\"fDepositos.php\">";
    //include_once('../config/botones.php');
	require('../adodb/adodb.inc.php');
    require('../../config2/config.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.style1 {
font-weight:bold;
background:#666666;
color:#FFFFFF;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estado de Cuenta Factura</title>
</head>
<body>
<form method="get" action="ReporteDepositosFacturacion.php">
	<p align="center"; style="size:25; font-weight:bold; font:Arial, Helvetica, sans-serif"> FACTURA &nbsp;</p>
	<table align="center">
	  <? $retcabecera = consultaCabecera($_GET['factura']);?>
	  <tr>
	    <td colspan="2"><div align="center"><strong>Nombre Estudiante: <? echo $retcabecera->fields['nombre1_alu']." ".$retcabecera->fields['nombre2_alu']." ".$retcabecera->fields['apellidopaterno_alu']." ".$retcabecera->fields['apellidomaterno_alu']; ?></strong></div></td>
      </tr>
	  <tr>
	  <td>
		<table width="410">	
			<tr>  
				<td width="88"> Factura No: </td>
				<td width="100" style="size:20; font-weight:bold"> <? echo $_GET['factura'] ?></td>
				<td width="38">Sede: </td>
				<td width="53"> <? echo $retcabecera->fields['NOMBRE_SUC'] ?></td>
			</tr>
		</table>	  </td>
	  <td>
		Fecha:	<? echo $retcabecera->fields['fecha_caf'] ?>	  </td>
	  </tr>
	  
		<tr>
			<td>
				<table border="1" width="410">
					<? while (!$retcabecera->EOF ){ ?>
					<tr>
						<td class="style1"> Nombre: </td>													
						<td> <? echo $retcabecera->fields['nombre1_alu']." ".$retcabecera->fields['nombre2_alu']." ".$retcabecera->fields['apellidopaterno_alu']." ".$retcabecera->fields['apellidomaterno_alu']; ?> </td>							
					</tr>					
					<tr>		
						<td class="style1"> Dirección: </td>
						<td> <? echo $retcabecera->fields['direcciondomic_alu']; ?> </td>
					</tr>					
					<tr>		
						<td class="style1"> Teléfono: </td>
						<td> <? echo $retcabecera->fields['telefodomic_alu']; ?> </td>
					</tr>					
					<? $retcabecera->MoveNext(); }?>
				</table>			</td>
			<td> 
				<table border="1" width="410">
				<? $retcabecera = consultaCabecera($_REQUEST['factura']);?>				
					<? while (!$retcabecera->EOF ){ ?>
					<tr>		
						<td class="style1"> Identificación: </td>
						<td> <? echo $retcabecera->fields['codigoIdentificacion_alu']; ?> </td>						
					</tr>
					<tr>		
						<td class="style1"> Correo Electrónico: </td>
						<td> <? echo $retcabecera->fields['mail_alu']; ?> </td>
					</tr>
					<tr>
						<td class="style1"> Código del alumno: </td>
						<td> <? echo $retcabecera->fields['codigo_alu']; ?> </td>
					</tr>
					<? $retcabecera->MoveNext(); }?>
				</table>			</td>
		</tr>		
	</table>
	<p align="center"; style="size:25; font-weight:bold; font:Arial, Helvetica, sans-serif">Detalle&nbsp;</p>
	<table align="center" border="1" width="820">
		  <? $retdetalle = consultaDetalle($_GET['factura']); 
		  	$total=0;
		  ?>	
	    <tr class="style1">
		  <td>No</td>	
		  <td>Descripción</td>					
		  <td>Valor</td>	
		  <td>Cantidad</td>	
		  <td>Descuento</td>
		  <td>SubTotal</td>			
		</tr>		  
		  <? while (!$retdetalle->EOF ){ ?>
	  <tr>		
		<td><? echo $retdetalle->fields['serial_dfa']; ?></td>	
		<td><? echo $retdetalle->fields['descripcion_dar']; ?></td>					
		<td><? echo $retdetalle->fields['valor_aal']; ?></td>	
		<td><? echo $retdetalle->fields['cantidad_dfa']; ?></td>	
		<td><? echo $retdetalle->fields['descuento_dfa']; ?></td>			
		<td><? echo ($retdetalle->fields['valor_aal']*$retdetalle->fields['cantidad_dfa']) + $retdetalle->fields['descuento_dfa'];?></td>			
		<? $total = $total + (($retdetalle->fields['valor_aal']*$retdetalle->fields['cantidad_dfa']) + $retdetalle->fields['descuento_dfa']);?>
	  </tr>	
	  	 <? $retdetalle->MoveNext(); }?>
		 
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td style="font-style:italic; font-weight:bold">TOTAL:</td>
		<td><? echo $total; ?>   </td>
	</tr>	 
	</table>
	<? //echo '<a href="../tesoreria/ReporteDepositosFacturacion.php?alumno='.$_GET['alumno'].'&fechaini='.$_GET['fechaini'].'&fechafin='.$_GET['fechafin'].'&sede='.$_GET['sede'].'"> Volver <a>'; ?> 
</form>
<? //echo $_GET['factura']; ?>
</body>
</html>


<?php

function consultaCabecera($factura){
  global $_FILES;
  global $gConexionDB;
  //echo "//".$factura;
$cabecera = "select *
from cabecerafactura, alumno, sucursal  
where serial_caf = ".$factura." and cabecerafactura.serial_alu = alumno.serial_alu and alumno.serial_suc = sucursal.SERIAL_SUC";
  $retcabecera=$gConexionDB->Execute($cabecera);						   
  return $retcabecera;
}

function consultaDetalle($factura){
  global $_FILES;
  global $gConexionDB;
    
  $detalle = "select * from detallefactura, detallearancel where serial_caf = ".$factura." and detallefactura.serial_dar = detallearancel.serial_dar";
  //$detalle = "select * from detallefactura where serial_caf =".$factura;
  $retdetalle=$gConexionDB->Execute($detalle);						   
  return $retdetalle;
}
?>
