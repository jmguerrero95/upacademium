<?
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
// $DBConnection="mysql://root:mysql@localhost/upacifico?persist";
$dblink = NewADOConnection($DBConnection);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


<title>ERP::INGENIUM::ENTERPRISE RESOURCE PLANNING</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<script>
window.status='Diseñado y Desarrollado por Omnisoft Cia Ltda http://www.omnisoft.cc';
omnisoftLoadData(document.PaginaDatos);

</script>

<link href='../autosuggest2/css/autosuggest_inquisitor.css' rel="stylesheet" type="text/css">
<link href='../aw/styles/xp/aw.css'rel="stylesheet" type="text/css">
<link href='../grid/styles/omnisoftGrid.css'rel="stylesheet" type="text/css">

<script language="javascript1.2" src="../zpmenu/utils/utils.js"></script>
<script language="javascript1.2" src="../zpmenu/src/menu.js"></script>

<script language="javascript" src= "../tools/cookies.js" ></script>
<script language='javascript' src="../tools/omnisoftTools.js"></script>
<script language="javascript" src= "../aw/lib/aw.js" ></script>
<link href="../styles/omnisoft.css" rel="stylesheet" type="text/css">
<link href="../tools/omnisoftValidar.css" rel="stylesheet" type="text/css">
<script language='javascript' src="../tools/omnisoftValidar.js"></script>
<script language="javascript" src="../mask/event-listener.js"></script>
<script language="javascript" src="../mask/masked-input.js"></script>
<script language="javascript" src="../mask/enter-as-tab.js"></script>
<script language="javascript" src="../mask/auto-tab.js"></script>
<script language='javascript' src="../grid/omnisoftDB.js"></script>
<script language='javascript' src="../combo/omnisoftComboBox.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../jscalendar/calendar-blue2.css" title="win2k-cold-1" />
  <script type="text/javascript" src="../jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../jscalendar/lang/calendar-en.js"></script>
  <script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>

<script language="javascript" src="../autosuggest2/js/bsn.AutoSuggest_2.1_comp_grid.js"> </script>
<script language="javascript" src="../autosuggest2/js/bsn.AutoSuggest_2.1_comp.js"> </script>
<script language="javascript" src= "../grid/omnisoftGridDetail.js" ></script> 

<link rel="stylesheet" href="../lib/export/jqueryuin/development-bundle/themes/base/jquery.ui.all.css">
<script src="../lib/export/jqueryuin/development-bundle/jquery-1.5.1.js"></script>
<script src="../lib/export/jqueryuin/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../lib/export/jqueryuin/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../lib/export/jqueryuin/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="../lib/export/jqueryuin/development-bundle/ui/i18n/jquery.ui.datepicker-es.js"></script>
<script language='javascript' src="../lib/jqinc/jquery.maskedinput.js"></script>
<link rel="stylesheet" href="../lib/export/jqueryuin/development-bundle/demos.css">


<!--DATE PICKER-->

<!--PICKER-->
	<script>
	$(function() {
		$( "#serial_per1" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
		$( "#serial_per1" ).datepicker( $.datepicker.regional[ "es" ] );
		$( "#serial_per1" ).datepicker( "option",
				$.datepicker.regional[ "es" ] );
		$( "#serial_per1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		
	});

	</script>
	<script>
	$(function() {
		$( "#serial_per2" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
		$.datepicker.setDefaults( $.datepicker.regional[ "" ] );
		$( "#serial_per2" ).datepicker( $.datepicker.regional[ "es" ] );
		$( "#serial_per2" ).datepicker( "option",
				$.datepicker.regional[ "es" ] );
		$( "#serial_per2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );		
	});

	</script>


<!--PICKER-->
<script type="text/javascript">
	 jQuery(function($){   
	 $("#serial_per1").mask("9999-99-99");   
	 $("#serial_per2").mask("9999-99-99");   
	 });
</script>

<script>
var alumno = top.opener.omniObj.grid.getCellText(0,top.opener.omniObj.grid.selectedRow);
setCookie('alumnoCreditoDirecto',alumno);
</script>
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
 }
 
function todos(){
//	alert("salio");
	document.PaginaDatos.todosAlumnos.value='todos';
	document.PaginaDatos.submit();	
}

</script>

<table><tr valign="top"><td>
<div id="boton" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103" class="p1">
	<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">
</div>
</td></tr></table>

 
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<body scroll="yes"> 

<form name="PaginaDatos" method="post" action="">
<!-- <input name="action" type="hidden" id="action">-->
<input name="refrescar" type="hidden" id="refrescar" value="<? echo $_POST['refrescar']; ?>">
<input name="todosAlumnos" type="hidden" id="todosAlumnos" value="<? echo $_POST['todosAlumnos']; ?>">



<?php 	
		$fecha=$_GET['fecha'];
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];	
		$serial_forc=$_GET['serial_forc'];	
		$serial_alu = $_GET['serial_alu'];


$retprograma = $dblink->Execute("select nombre_sec from seccion where serial_sec = ".$serial_sec);
$retsede = $dblink->Execute("select NOMBRE_SUC from sucursal where SERIAL_SUC = ".$serial_suc);


if ($serial_suc!='T'){
	$sucursal= " and alu.serial_suc = ".$serial_suc;	
	$sede =	$retsede->fields['NOMBRE_SUC'];
	}else{
		$sucursal= "";
		$sede="TODAS LAS SEDES";
	}
	

if ($serial_sec!='T'){
	$seccion= " and alu.serial_sec = ".$serial_sec;	
	$programa=$retprograma->fields['nombre_sec'];
	}else{
		$seccion= "";
		$programa = "TODOS LOS PROGRAMAS";
	}
	
if ($serial_forc!='T'){
	$formaCobro= " and cdc.serial_forc = ".$serial_forc;	
	//$programa=$retprograma->fields['nombre_sec'];
	}else{
		$formaCobro= "";
//		$formaCobro = "TODOS LOS PROGRAMAS";
	}	

if($serial_alu=="T"){
	$alumno = "";		
}else{
	$alumno = "AND alu.serial_alu = ".$serial_alu;
}


//LISTADO DE ALUMNOS DE ACUERDO A SU FORMA DE COBRO AGRUPADO POR FACTURA


	$antiguedadCartera="select caf.serial_caf,numero_caf,total_caf,NOMBRE_FORC,forc.serial_forc,fecha_caf
						, concat_ws(' ',alu.apellidopaterno_alu,alu.apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre,NOMBRE_SUC    
						from cabecerafactura as caf, cabecerarecibo as cre
						, detallerecibo as dre,formacobro as forc,alumno as alu, sucursal as suc
						where caf.serial_caf=cre.serial_caf 
						and cre.serial_cre=dre.serial_cre 
						and dre.serial_forc=forc.SERIAL_FORC
						and caf.serial_alu=alu.serial_alu
						and alu.serial_suc= suc.SERIAL_SUC 
						and tipo_caf like 'FAC' and estado_caf <> 'ANULADO' and fecha_caf >= '2011-01-01'
						and forc.NOMBRE_FORC not like '%TRANSFEREN%'
						and forc.NOMBRE_FORC not like '%SALDOS%'
						and forc.NOMBRE_FORC not like '%CRUCE%'
						".$sucursal."
					    ".$seccion."
						".$alumno."						
						group by caf.serial_caf
						order by alu.serial_suc, nombre";
							
	$retantiguedadCartera = $dblink->Execute($antiguedadCartera);	
	
//	echo $antiguedadCartera;	
	
?>
<br>
<table border="1" align="center" width="900" >
<tr bgcolor="#FFFFFF">
    <td width="23%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="3"><span class="style1">ANTIGUEDAD DE CARTERA </span></th>
	
</tr>
  <tr >
    <th colspan="3"><?php echo  "AL ".$fecha;?></th>
  </tr>
  <tr>
   <th width="17%" align="right">SEDE:</th>
	
    <th colspan="2" align="left"><span class='style3'>  <?php echo $sede;?> </span></th>
  </tr>
  <tr>
    <th width="17%" align="right">PROGRAMA:</th>
	
    <th align="left" colspan="2"><span class='style3'> <?php echo $programa;?></span></th>
  </tr>
  <tr>
    <th align="right">&nbsp;</th>
    <th width="51%" align="left">&nbsp;</th>
	
	
  </tr>
</table>

 <br>
   <table border="1" align="center" width="900" >
   <tr>
   				<th width="2%">No</th>
          		<th width="30%">Estudiante</th>		  											
				<th width="5%">No Factura</th>							
				<th width="5%">Total Factura</th>
				<th width="20%">Forma de Cobro</th>
				<th width="7%">Fecha a Efectivizarse </th>
				<th width="5%">Valor a Efectivizarse</th>				
				
				<th width="5%">Meses Vencidos</th>
				<th width="8%">Sede</th>
   </tr>
   
<?	 	$serial_alu=0;	
		$i=0;
		$totalFacturado=0;
		$totalEfectivizar=0;
  		if(!empty($retantiguedadCartera)){
						
		  while(!$retantiguedadCartera->EOF){
		  		$acreditaciones="select dre.serial_dre, cdc.serial_cdc,valor_dre,valor_cdc,fecha_dre,fechaefec_cdc, estado_cdc,cdc.serial_forc,forc.NOMBRE_FORC
									 , datediff('".$fecha."',DATE_FORMAT(fechaefec_cdc,'%Y-%m-%d')) / 30  as meses
									from detallerecibo as dre,cierredia_control as cdc, formacobro as forc
									where dre.serial_dre=cdc.serial_dre
									and dre.serial_forc=forc.SERIAL_FORC
									and cdc.estado_cdc like 'PENDIENTE'	
									and fechaefec_cdc < '".$fecha."' 
									".$formaCobro."
									and serial_cre in (select serial_cre from cabecerarecibo where serial_caf = ".$retantiguedadCartera->fields['serial_caf'].")";
				$retacreditaciones = $dblink->Execute($acreditaciones);	
				
									
			
				if(!empty($retacreditaciones)){
				  while(!$retacreditaciones->EOF){				  
				 		if(floor($retacreditaciones->fields['meses']) >= 1 ){
								 $i++;	
								 $valorFacturado = $retantiguedadCartera->fields['total_caf'];
								 $valorEfectivizar = $retacreditaciones->fields['valor_cdc'];
								// echo "</p>".$acreditaciones."</p>";	
				  ?>
				  	<tr>
				  <?php		
										?>
										<td><?php echo $i ?></td>
										<td><?php echo $retantiguedadCartera->fields['nombre']; ?></td>
										<td><?php echo $retantiguedadCartera->fields['numero_caf']; ?></td>
										<td><?php echo $valorFacturado; ?></td>
										<td><?php echo $retacreditaciones->fields['NOMBRE_FORC']; ?></td>
										<td><?php echo $retacreditaciones->fields['fechaefec_cdc']; ?></td>
										<td><?php echo $valorEfectivizar; ?></td>										
																				
										<td><?php echo floor($retacreditaciones->fields['meses']); ?></td>
										<td><?php echo $retantiguedadCartera->fields['NOMBRE_SUC']; ?></td>																																	
										
										<?php												
											$totalFacturado = $totalFacturado + $valorFacturado;				
											$totalEfectivizar = $totalEfectivizar + $valorEfectivizar;				
										?>
						<!--<td><?php //echo $i."-".$totalFacturado ?></td>-->
						
					</tr>
					<?php
								
					}							
				
					$retacreditaciones->MoveNext(); 	  					
				  }				  
				
				 }								 
				
			$retantiguedadCartera->MoveNext(); 
   }		  
}
		 
	 ?>
	 <tr>
	 	<th colspan="3" align="right">Total Facturado:</th>
		<td> <?php echo $totalFacturado; ?> </td>
		<th colspan="2" align="right">Total a Efectivizar:</th>
		<td> <?php echo $totalEfectivizar; ?> </td>
		<td colspan="2" align="right"> &nbsp </td>
		
	</tr>	
		
  </table>    

</form>

<script>

if(document.PaginaDatos.refrescar.value!=1){	
	document.PaginaDatos.refrescar.value=1;
	document.PaginaDatos.submit();
}
</script>
</body>
</html>
<?php

?>