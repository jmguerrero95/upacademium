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


//var useBSNns = true;

/*$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

*/
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
</script>

<table><tr valign="top"><td>
<div id="boton" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103" class="p1">
	<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">
</div>
</td></tr></table>


<style type="text/css">
<!--
.style1 {font-weight: bold; background-color:#BED5EF}
.style2 { color:#FF0000}
.style4 { font-weight: bold; font-size:11px; font-style:italic}
-->
</style>
<body scroll="yes"> 

<form name="PaginaDatos" method="post" action="">
<!-- <input name="action" type="hidden" id="action">-->
<input name="refrescar" type="hidden" id="refrescar" value="<? echo $_POST['refrescar']; ?>">



<?php 	
//CONSULTA LA CARRERA DEL ALUMNO
$carrera="select crp.nombre_crp,car.nombre_car, maa.serial_sec,nombre_maa,nombre_sec
			from alumnomalla as ama, malla as maa, carrera as car,carreraprincipal as crp,seccion AS sec
			where ama.serial_maa = maa.serial_maa
			and maa.serial_car=car.serial_car
			and car.serial_crp=crp.serial_crp
			and maa.serial_sec=sec.serial_sec
			and ama.serial_alu=".$_COOKIE['alumnoCreditoDirecto'];
			
	$retcarrera = $dblink->Execute($carrera);
	
//	echo '</p> carrera: '.$carrera;
	//CREDITOS DIRECTOS REALIZADOS POR ALUMNO	
	$creditoDirecto="SELECT cre.serial_caf,
	concat_ws(' ',apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) AS nombre ,
	(dre.valor_dre - dre.descuento_dre)	AS valor,
	cre.fecha_cre,
	numero_caf,
	caf.fecha_caf, 
    caf.total_caf, 
	codigo_alu,
	codigoIdentificacion_alu
FROM
	detallerecibo   AS dre,
	cabecerarecibo  AS cre,
	alumno           AS alu,
	cabecerafactura AS caf 
WHERE
	dre.serial_cre=cre.serial_cre AND
	cre.serial_alu=alu.serial_alu AND
	cre.serial_caf=caf.serial_caf AND
	serial_forc = 2 AND
	cre.serial_alu=".$_COOKIE['alumnoCreditoDirecto']." GROUP BY cre.serial_caf";	
	
	//echo '</p> Credito Directo: '.$creditoDirecto;
	
	$retcreditoDirecto = $dblink->Execute($creditoDirecto);		
	//echo $creditoDirecto;	
	if($retcarrera->fields['serial_sec']==2)
				$carreraMalla = $retcarrera->fields['nombre_car'];			
			else	
				$carreraMalla = $retcarrera->fields['nombre_crp'];	
	
?>


<br>
<table border="1" align="center" width="800" >
<tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span >CREDITOS DIRECTOS PAGADOS </span></th>
  </tr>
  <tr >
    <th colspan="2"><?php echo $retcarrera->fields['nombre_maa'];?></th>
  </tr>
  <tr>
   <th width="18%" align="right">SEDE:</th>
	
    <th width="61%" align="left"><span class='style3'>  <script>document.write(top.opener.omniObj.grid.getCellText(5,top.opener.omniObj.grid.selectedRow));		
		</script></span></th>
  </tr>
  <tr>
    <th width="18%" align="right">CARRERA:</th>
	
    <th width="61%" align="left"><span class='style3'> <?php echo $carreraMalla;?></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <?php echo $retcarrera->fields['nombre_sec'];?></span></th>
  </tr>
 
</table>

 <br>
   <table border="1" align="center" width="800" >
    <tr>
    <td colspan="10" bgcolor="#FFFFFF"><div align="center"><strong><?php echo $retcreditoDirecto->fields['nombre'].' ('.$retcreditoDirecto->fields['codigo_alu'].')';?></strong></div></td>
  </tr>
  </table>
  
<?php	
		
  		if(!empty($retcreditoDirecto)){
		  while(!$retcreditoDirecto->EOF){ 
?>
	<table border="1" align="center" width="800">
<?php		  
		  	$cobrosAcreditaciones="SELECT numero_cre,
							valor_dre,
							cdc.valor_cdc,
							descuento_dre, 
							fecha_cre, 
							fechaacre_acd,
							dre.serial_forc,
							forc.DESCRIPCION_FORC,
							cdc.estado_cdc							
						FROM
							cabecerarecibo AS cre,
							formacobro     AS forc,
						    detallerecibo  AS dre
							LEFT JOIN cierredia_control AS cdc
								ON dre.serial_dre=cdc.serial_dre
					        left join cierredia_control_acreditacion as cda    
					    	    on cdc.serial_cdc=cda.serial_cdc 
					        left join acreditacion_cierredia as acd
						        on cda.serial_acd=acd.serial_acd           
						WHERE
						dre.serial_cre=cre.serial_cre 
						AND dre.serial_forc=forc.SERIAL_FORC
						and dre.serial_forc <> 2
						AND cre.serial_caf = ".$retcreditoDirecto->fields['serial_caf']."
						order by fecha_cre";
			$retfacturas = $dblink->Execute($cobrosAcreditaciones);	
			
		
			$var=0;	
			$totalCobrado=0;
			$totalAcreditacion=0;
			?>
			<tr>
				<td class="style1">Factura</td>
				<td class="style1">Fecha de Facturación</td>
				<td class="style1">Total Facturado</td>
				<td class="style1">Comprobante de Caja</td>
				<td class="style1">Fecha de Cobro</td>
				<td class="style1">Total Cobrado</td>				
				<td class="style1">Forma de Cobro</td>
				<td class="style1">Estado de la Acreditación</td>				
				<td class="style1">Fecha de Acreditación</td>								
				<td class="style1">Total Acreditado</td>				
				
		   </tr> 

			<?php
//			echo "</p> Facturas:".$cobrosAcreditaciones;
//			echo "</p> Cuantos:".$retfacturas->RecordCount();
			
			if($retfacturas->RecordCount()>0){
					
			  while(!$retfacturas->EOF){ 			  
			?>
				<tr>
				
			<?php	
			
				if($var==0){
			?>
				<td class="style4"><?php echo $retcreditoDirecto->fields['numero_caf'];?></td>
				<td><?php echo $retcreditoDirecto->fields['fecha_caf'];?></td>
				<td><?php echo $retcreditoDirecto->fields['total_caf'];?></td>
				
			<?php
				$var=1;
				}else{
			?>	
				<td colspan="2">&nbsp;</td>	
				<td>&nbsp;</td>	
			<?php
				}
			?>
			<td><?php echo $retfacturas->fields['numero_cre'];?></td>
			<td><?php echo $retfacturas->fields['fecha_cre'];?></td>
			<td><?php echo $retfacturas->fields['valor_dre'];?></td>
			
			<td><?php echo $retfacturas->fields['DESCRIPCION_FORC'];?></td>
			<?php
				if($retfacturas->fields['estado_cdc']=='PENDIENTE'){
			?>	
				<td class="style2"><?php echo $retfacturas->fields['estado_cdc'];?></td>			
			<?php }else{
			?>
				<td ><?php echo $retfacturas->fields['estado_cdc'];?></td>			
			<?php }
			?>	
				
			
			<td><?php echo $retfacturas->fields['fechaacre_acd'];?></td>			
			<td><?php echo $retfacturas->fields['valor_cdc'];?></td>
			
			<tr>

		   
		  <? 
		  		$totalCobrado=$totalCobrado+$retfacturas->fields['valor_dre'];
				
				if($retfacturas->fields['estado_cdc']<>'PENDIENTE')
					$totalAcreditacion=$totalAcreditacion+$retfacturas->fields['valor_cdc'];
				
				$retfacturas->MoveNext(); 
			   }	
			  } 			  
			 else{			  
			 		//echo "</p> NOOOOOOOOOOOOOOOOOOOOOOOOOO Facturas:";

			  ?>
				<td class="style4"><?php echo $retcreditoDirecto->fields['numero_caf'];?></td>
				<td><?php echo $retcreditoDirecto->fields['fecha_caf'];?></td>
				<td><?php echo $retcreditoDirecto->fields['total_caf'];?></td>
				
			<?php
			}
			   ////////////////////////////////	  
			 ?>
 	 			<!--<tr>
					<td colspan="2" >Total Cobrado: </td>
					<td><?php echo $totalCobrado; ?></td>										
					 <td colspan="7">&nbsp; </td>
	 			</tr>
				
				
				<tr>
					<td colspan="2" > Saldo de la Fac No <? echo $retcreditoDirecto->fields['numero_caf']; ?> </td>
					<td><?php echo ($retcreditoDirecto->fields['total_caf']-$totalCobrado); ?></td>
					<td colspan="7">&nbsp; </td>
				</tr>
				-->
				<tr>
					<td colspan="2" >Total Acreditado : </td>
					<td><?php echo $totalAcreditacion; ?></td>					
					<td colspan="7">&nbsp; </td>
				</tr>				
				
				<tr>
					<td colspan="2" >Por Acreditar: </td>
					<td><?php echo ($retcreditoDirecto->fields['total_caf']-$totalAcreditacion); ?></td>
					<td colspan="7">&nbsp; </td>
				</tr>
							  	
			
			</table>    
			
			 <p>&nbsp;</p>
 
		 <?php 
				
		   $retcreditoDirecto->MoveNext(); 
		   }		  
		}		 
		 ?>
  
  

</form>

<script>

if(document.PaginaDatos.refrescar.value!=1){	
	document.PaginaDatos.refrescar.value=1;
	document.PaginaDatos.submit();
}
</script>



</body>
</html>