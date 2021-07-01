<?php

//include('../config/config.seguridadesplus.inc.php');
//include('ssmItems.php');

/*if($enviar=='A')
{
  header("Content-disposition: filename=Detalle-Facturas y Depositos.xls");
  header("Content-type: application/octetstream");
  header("Pragma: no-cache");
  header("Expires: 0");
}*/
	//include('../lib/adodb/adodb.inc.php');
	//include('../config/config.inc.php');

	//include_once('../config/config.tesoreria.inc.php');

      /*include_once('variablesTesoreria.php');
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
	
	//include_once('../config/cabecera.php'); /// me coloca el grafico de cabecera
  //include_once('../config/config.inc.php');
	
	 //include('variablesTesoreria.php');
   	 //   include_once('../config/config.tesoreria.inc.php');
     //   include_once('../config/formatos.php');
     //   include_once('sFacturaInventarios.php');
		//include('../config/config.seguridadesplus.inc.php'); // coloca los botones 
//		include('ssmItems.php');
	//	$imprimir="<a href=\"#\" onClick=\"validar()\">";
    //include_once('../config/botones.php');
	
	//172.20.3.236\htdocs\upacifico\academico-financiero\config
	
	
	require('../adodb/adodb.inc.php');
    require('../../config2/config.inc.php');

//require('../adodb/adodb.inc.php');
   // require('../upacifico/academico-financiero/config/config.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script>
function validar()
{
	/*if(document.reporte.serial_age.value=='T'){
		//alert('Balance General Consolidado, en construcción');
		document.reporte.action='ReporteDepositosFacturacion.php';
		document.reporte.target="_blank";
		document.reporte.submit();
	}
	else
		if (document.frmGeneral.serial_age.value!='' && document.frmGeneral.serial_dep.value!='')
		{
			document.frmGeneral.action='fVistaBalanceGeneral.php';
			document.frmGeneral.target="_blank";
			document.frmGeneral.submit();
		}else
			mensaje(1,0);*/
	/*document.reporte.action='ConsolidadoDepositoFacturacion.php';
	document.reporte.target="_selft";
	document.reporte.submit();*/
	
	var alumno1=document.reporte.alumno.value;
//alert(alumno1);
//alert (document.reporte.alumno.value);
var pagina = '../tesoreria/ConsolidadoDepositoFacturacion.php?alumno=' + alumno1 + '&fechaini=' + document.reporte.fechaini.value + '&fechafin=' + document.reporte.fechafin.value + '&sede=' + document.reporte.sede.value+'&enviar='+document.reporte.enviar.value;
//document.location.href=pagina;

window.open(pagina, "Consolidado" , "width=1024,height=600,scrollbars=YES")

}

function sede1(){
	//
	//alert(document.reporte.sede.value)
	document.reporte.action="ReporteDepositosFacturacion.php"
	document.reporte.submit();
//	document.reporte.sede.value
}
function alu(){
//	alert(document.reporte.alumno.value)
}
function consolidar(){
/*if (alumno1 = "undefined"){
	alumno1=document.reporte.alumno.value;
}*/	
if (document.reporte.codigo.value != ''){
	var alumno1=document.reporte.codigo.value;
	//alert(alumno1)
}else
	var alumno1=document.reporte.alumno.value;
//alert(alumno1);
//alert (document.reporte.alumno.value);
var pagina = '../tesoreria/ConsolidadoDepositoFacturacion.php?alumno=' + alumno1 + '&fechaini=' + document.reporte.fechaini.value + '&fechafin=' + document.reporte.fechafin.value + '&sede=' + document.reporte.sede.value+'&enviar='+document.reporte.enviar.value;
//document.location.href=pagina;

window.open(pagina, "Consolidado" , "width=1024,height=600,scrollbars=YES")
 
}

</script>
 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="menues.css" type="text/css">
<STYLE>
<!--
A.ssmItems:link                {color:black;text-decoration:none;}
A.ssmItems:hover        {color:black;text-decoration:none;}
A.ssmItems:active        {color:black;text-decoration:none;}
A.ssmItems:visited        {color:black;text-decoration:none;}
//-->
</STYLE>

<script src="../config/fJavaScript.js"></script>
<SCRIPT language="JavaScript1.2">bloquear_click_derecho()</SCRIPT>
<SCRIPT SRC="../config/ssm.js" language="JavaScript1.2"></SCRIPT>
<SCRIPT SRC="ssmItems.js" language="JavaScript1.2"></SCRIPT>

<style type="text/css">
<!--
.style1 {
font-weight:bold;
background:#666666;
color:#FFFFFF;
}
-->
</style>
</head>
<body>
<iframe width=168 height=202 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../lib/calen/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:hidden; z-index:65535; position:absolute; top:0px; border:2px ridge;"></iframe>
<script>
	document.onclick=function(e){
		var t=!e?self.event.srcElement.name:e.target.name;
		if (t!="popcal") gfPop.fHideCal();
	}
</script>
<form name="reporte" method="post" action="ReporteDepositosFacturacion.php">
  <p align="center">&nbsp;</p>
  <p align="center" style="size:20; font-family:Arial, Helvetica, sans-serif; font-weight:bold">Estado de Cuenta </p>
  
  <p>
  
  </p>
  
  <p>  
  
    <?
	//if($_POST['buscar']=='Detallar') 	
		if ($_POST['codigo']==""){
			$_POST['hdncodigo'] = $_POST['alumno'];
		}
		else
			$_POST['hdncodigo'] = $_POST['codigo'];
		
	/*echo "hd:  ".$_POST['hdncodigo']." ";
	echo "alu: ".$_POST['alumno']." ";
	echo "cod: ".$_POST['codigo']." ";		*/
	
//		
		
		$retfactura = consultaFacturacion($_REQUEST['serial_alu']);  
		
		
		
	 $totalf = 0;
	 $totald = 0;	 
  ?>
  </p>
 
  <p align="center" style="size:14; font-family:Arial, Helvetica, sans-serif;"> <strong>Detalle Facturas y Depositos </strong>&nbsp;</p>
  <table border="1" align="center" width="875">  
  	<tr class="style1">
		<td> No </td>
		<td> Serial </td>
		<td width="25"> Tipo. </td>
		<td width="25"> No. Doc. </td>		
		<td> Código </td>
		<td> Cédula </td>
		<td> Nombre </td>		
		<td> Fecha </td>
		<td> Facturado </td>
		<td> Cobrado </td>
	</tr>
    <? 
	//echo $retfactura->RecordCount();	
	if(!empty($retfactura)){
	while (!$retfactura->EOF ){
	 $i++;	
	 ?>		
<!--	style="cursor:hand" onMouseOver="this.style.background='#000080'; this.style.color='white'" onMouseOut="this.style.background='#FFFFFF'; this.style.color='black'" onclick="location.replace('<? //echo '../tesoreria/ReporteFacturas.php?factura='.$retfactura->fields['serial_caf'] ?>')"-->
	<tr style="font-size:11px">			
	<td><? echo $i; ?></td>
		<td height="28"> 
		<? if($retfactura->fields['tipo'] <> ' ' and $retfactura->fields['tipo'] <> 'Dep.' and $retfactura->fields['tipo'] <> 'Acre.'){
	
				$numeroDoc = $retfactura->fields['numero_caf'];
		echo '<a href="../../../academico-financiero/tesoreria/ReporteFacturas.php?factura='.$retfactura->fields['serial_caf'].'&fechaini='.$_POST['fechaini'].'&fechafin='.$_POST['fechafin'].'&alumno='.$_POST['alumno'].'&sede='.$_POST['sede'].'" target="_blank">'; echo $retfactura->fields['serial_caf']; 
		}
		
		if($retfactura->fields['tipo'] == 'Dep.'){		
			if($retfactura->fields['numero_caf']>0){
				$numeroDoc = $retfactura->fields['numero_caf'];
			}else $numeroDoc=0;
		
		echo '<a href="../../../academico-financiero/tesoreria/ReporteDepositos.php?recibo='.$retfactura->fields['serial_caf'].'&fechaini='.$_POST['fechaini'].'&fechafin='.$_POST['fechafin'].'&alumno='.$_POST['alumno'].'&sede='.$_POST['sede'].'" target="_blank">'; echo $retfactura->fields['serial_caf']; 
		}
		
		if($retfactura->fields['tipo'] == 'Acre.'){		
			if($retfactura->fields['numero_caf']>0){
				$numeroDoc = $retfactura->fields['numero_caf'];
			}else $numeroDoc=0;		
		echo '<a href="../../../academico-financiero/tesoreria/ReporteAcreditaciones.php?acreditacion='.$retfactura->fields['serial_caf'].'&fechaini='.$_POST['fechaini'].'&fechafin='.$_POST['fechafin'].'&alumno='.$_POST['alumno'].'&sede='.$_POST['sede'].'" target="_blank">'; echo $retfactura->fields['serial_caf']; 
		}
		
		?> </a>		</td>
		<td><? echo $retfactura->fields['tipo']; ?></td>
		<td><? echo $numeroDoc; ?></td>				
		<td><? echo $retfactura->fields['codigo_alu']; ?></td>
		<td><? echo $retfactura->fields['codigoIdentificacion_alu']; ?></td>
		<td><? echo $retfactura->fields['nombre']; ?></td>		
		<td><? echo $retfactura->fields['fecha']; ?></td>	
			
		<td align="right"><? echo number_format($retfactura->fields['totalF'],2); ?></td>
		<td align="right"><? echo number_format($retfactura->fields['totalD'],2); ?></td>
		<? 
		   $totalf1 = $totalf1 + $retfactura->fields['totalF'];
		   $totald1 = $totald1 + $retfactura->fields['totalD'];
		?>
	<tr>	
	<? $retfactura->MoveNext(); 
	}
	?>
	<tr style="font-size:11px">			
		<td colspan="8" align="right">Total Facturas y Depositos</td>
		<td align="right"><? echo number_format($totalf1,2); ?></td>
		<td align="right"><? echo number_format($totald1,2); ?></td>
	</tr	
	><?
	}
	?>
	<tr>		
		<td colspan="9" align="right">  <em><strong>Saldo: </strong> </em></td>
		<td align="right"><? echo number_format(($totalf1)-($totald1),2); ?></td>
	</tr>
	
  </table>
  
  <p align="center" style="size:14; font-family:Arial, Helvetica, sans-serif;">&nbsp;</p>  
  <table width="100%">
  <tr  class="style1"><td><p align="center" style="size:50; font-weight:bold"> Saldo: &nbsp;<? echo number_format(($totalf1)-($totald1),2); ?></p></td></tr>  
    
  </table>
 
</form>

</body>

</html>


<?php
/**************************************************************PARA FACTURAS***********************************************************************************/
function consultaFacturacion($alumno){
  global $_FILES;
  global $gConexionDB;
  
  //echo '</p> alu: '.$alumno;
//  echo "</p> PARAMETRO ".$alumno."</p>";
/*if($alumno=="T" and $sede=="T" ){
 $condicion = "";
 $condicion2 = ""; 
}else{
	if($alumno=="T"){
		$condicion = " and alumno.serial_suc=".$sede;
		$condicion2 = " and alumno.serial_suc=".$sede;
	}else{//
		if($sede=="T"){
			$condicion = " and (cabecerafactura.serial_alu =".$alumno."or cabecerafactura.cedula_caf=".$alumno.")";
			$condicion2 = " and (cabecerarecibo.serial_alu =".$alumno."or cabecerarecibo.numero_cre=".$alumno.")";			
		}else{
			$condicion = " and (cabecerafactura.serial_alu=".$alumno."or cabecerafactura.cedula_caf=".$alumno.")"." and alumno.serial_suc=".$sede;			
			$condicion2 = " and cabecerarecibo.serial_alu=".$alumno."or cabecerarecibo.numero_cre=".$alumno.")"." and alumno.serial_suc=".$sede;
			}
		}	
	 }*/
	 
/*if($alumno=="T" and $sede=="T" ){
 $condicion = "";
 $condicion2 = ""; 
}else{
	if($alumno=="T"){
		$condicion = " and alumno.serial_suc=".$sede;
		$condicion2 = " and alumno.serial_suc=".$sede;
	}else{//
		if($sede=="T"){
			$condicion = " and (cabecerafactura.serial_alu ='".$alumno."' or cabecerafactura.cedula_caf='".$alumno."')";
			$condicion2 = " and (cabecerarecibo.serial_alu ='".$alumno."' or cabecerarecibo.numero_cre='".$alumno."')";			
			
			//$condicion = " and (cabecerafactura.serial_alu ='".$alumno."' or alumno.codigo_alu='".$alumno."')";
			//$condicion2 = " and (cabecerarecibo.serial_alu ='".$alumno."' or alumno.codigo_alu='".$alumno."')";			
			
			//$condicion = " and cabecerafactura.serial_alu ='".$alumno."'";
			//$condicion2 = " and cabecerarecibo.serial_alu ='".$alumno."'";			
		}else{
			$condicion = " and (cabecerafactura.serial_alu='".$alumno."' or cabecerafactura.cedula_caf='".$alumno."')"." and alumno.serial_suc=".$sede;			
			$condicion2 = " and (cabecerarecibo.serial_alu='".$alumno."' or cabecerarecibo.numero_cre='".$alumno."')"." and alumno.serial_suc=".$sede;
			
			//$condicion = " and (cabecerafactura.serial_alu='".$alumno."' or alumno.codigo_alu='".$alumno."')"." and alumno.serial_suc=".$sede;			
			//$condicion2 = " and (cabecerarecibo.serial_alu='".$alumno."' or alumno.codigo_alu='".$alumno."')"." and alumno.serial_suc=".$sede;

			//$condicion = " and cabecerafactura.serial_alu='".$alumno."'"." and alumno.serial_suc=".$sede;			
			//$condicion2 = " and cabecerarecibo.serial_alu='".$alumno."'"." and alumno.serial_suc=".$sede;

			}
		}	
	 }*/
	 
	 $condicion = " and cabecerafactura.serial_alu=".$alumno;			
     $condicion2 = " and cabecerarecibo.serial_alu=".$alumno;
	 
	 
	 	
		$factura = 	"select cabecerafactura.serial_caf
					, tipo_caf AS tipo,cabecerafactura.numero_caf
					, fecha_caf as fecha, codigoIdentificacion_alu
					, codigo_alu,concat_ws(' ', apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) as nombre
					, SUM((detallefactura.cantidad_dfa*detallefactura.valor_aal)+(detallefactura.descuento_dfa)) AS totalF
					,0 as totalD
					,0
		 			from cabecerafactura,detallefactura
					,alumno
					where cabecerafactura.serial_caf = detallefactura.serial_caf 
					and alumno.serial_alu = cabecerafactura.serial_alu 
					and cabecerafactura.tipo_caf not like '' 
					and cabecerafactura.tipo_caf NOT LIKE 'NC'
					AND cabecerafactura.estado_caf <> 'ANULADO'
					".$condicion."
					group by cabecerafactura.serial_caf
					
				union
				select cabecerafactura.serial_caf
					, tipo_caf AS tipo,cabecerafactura.numero_caf
					, fecha_caf as fecha, codigoIdentificacion_alu
					, codigo_alu,concat_ws(' ', apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) as nombre
					, SUM((detallefactura.cantidad_dfa*detallefactura.valor_aal)-(detallefactura.descuento_dfa)) AS totalF
					,0 as totalD
					,0
		 			from cabecerafactura,detallefactura
					,alumno
					where cabecerafactura.serial_caf = detallefactura.serial_caf 
					and alumno.serial_alu = cabecerafactura.serial_alu 
					and cabecerafactura.tipo_caf not like '' 
					and cabecerafactura.tipo_caf LIKE 'NC'
					AND cabecerafactura.estado_caf <> 'ANULADO' 
					".$condicion."
					group by cabecerafactura.serial_caf
				union		
					select cabecerarecibo.serial_cre
						,'Dep.' as tipo
						, numero_cre
						, fecha_cre as fecha
						, codigoIdentificacion_alu
						, codigo_alu,concat_ws(' ', apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) as nombre
						,0 as totalF
						, sum(valor_dre) as totalD
						, 0 from cabecerarecibo, detallerecibo , alumno
						where cabecerarecibo.serial_cre = detallerecibo.serial_cre 
						and cabecerarecibo.serial_alu = alumno.serial_alu 
						and  cabecerarecibo.estado_cre <> 'ANULADO' 
						and cabecerarecibo.serial_caf not in(select serial_caf from cabecerafactura where estado_caf like 'ANULADO') 
						and serial_caf < 1 ".$condicion2."
						group by cabecerarecibo.serial_cre 
					union		
						select cdc.serial_cdc 
						,	'Acre.' AS tipo
						,cabecerarecibo.numero_cre
						,acd.fechaacre_acd as fecha
						,codigoIdentificacion_alu,codigo_alu
						, concat_ws(' ', apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) AS nombre
						, 0   AS totalF
						, sum(cdc.valor_cdc+cdc.comision_cdc) AS totalD
						,cdc.serial_cdc 
						from cierredia_control as cdc
							,detallerecibo as dre
							,cierredia_control_acreditacion as cdca
							,acreditacion_cierredia as acd
							,cabecerarecibo,alumno 
					where estado_cdc like 'cerrado'
						and cdc.serial_dre=dre.serial_dre
						and cabecerarecibo.serial_cre=dre.serial_cre
						and cabecerarecibo.serial_alu=alumno.serial_alu
						and cdc.serial_cdc=cdca.serial_cdc
						and cdca.serial_acd=acd.serial_acd
						and cabecerarecibo.serial_caf > 0
						and cdc.serial_forc<>21						
						".$condicion2."
					group by cdc.serial_cdc
				order by nombre, fecha";
//echo $factura;					
  $retfactura=$gConexionDB->Execute($factura);						   
  return $retfactura;
}
?> 