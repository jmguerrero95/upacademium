<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ERP::INGENIUM::ENTERPRISE RESOURCE PLANNING</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<script>

var useBSNns = true;
/*
$(document).ready(
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
	);*/

window.status='Diseñado y Desarrollado por Omnisoft Cia Ltda http://www.omnisoft.cc';

</script>

<link href='../lib/autosuggest2/css/autosuggest_inquisitor.css' rel="stylesheet" type="text/css">
<link href='../lib/aw/styles/xp/aw.css'rel="stylesheet" type="text/css">
<link href='../lib/grid/styles/omnisoftGrid.css'rel="stylesheet" type="text/css">

<script language="javascript1.2" src="../lib/zpmenu/utils/utils.js"></script>
<script language="javascript1.2" src="../lib/zpmenu/src/menu.js"></script>
<script language="javascript" src= "../lib/tools/cookies.js" ></script>
<script language='javascript' src="../lib/tools/omnisoftTools.js"></script>
<script language="javascript" src= "../lib/aw/lib/aw.js" ></script>
<link href="../lib/styles/omnisoft.css" rel="stylesheet" type="text/css">
<link href="../lib/tools/omnisoftValidar.css" rel="stylesheet" type="text/css">
<script language='javascript' src="../lib/tools/omnisoftValidar.js"></script>
<script language='javascript' src="../lib/tools/omnisoftAcciones.js"></script>
<script language="javascript" src="../lib/mask/event-listener.js"></script>
<script language="javascript" src="../lib/mask/masked-input.js"></script>
<script language="javascript" src="../lib/mask/enter-as-tab.js"></script>
<script language="javascript" src="../lib/mask/auto-tab.js"></script>
<script language='javascript' src="../lib/grid/omnisoftDB.js"></script>
<script language='javascript' src="../lib/combo/omnisoftComboBox.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../lib/jscalendar/calendar-blue2.css" title="win2k-cold-1" />
  <script type="text/javascript" src="../lib/jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../lib/jscalendar/lang/calendar-en.js"></script>
  <script type="text/javascript" src="../lib/jscalendar/calendar-setup.js"></script>

<script language="javascript" src="../lib/autosuggest2/js/bsn.AutoSuggest_2.1_comp_grid.js"> </script>
<script language="javascript" src="../lib/autosuggest2/js/bsn.AutoSuggest_2.1_comp.js"> </script>

<script language="javascript" src= "../lib/grid/omnisoftGridDetail.js" ></script>

<script>
function GuardarResgistros(){
	if(confirm('Esta seguro de guardar estos registros?'))
		document.PaginaDatos.submit();

}
var total=0;
function SumarValor(valor,obj){
	var valord=parseFloat(valor);
	if(obj.checked)	
		total=parseFloat(total)+valord;
	else
		total=parseFloat(total)-valord;
			document.getElementById('spanTotal').innerHTML=parseFloat(total).toFixed(2);;
}
</script>
<?
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');		
/*****************saca nombre de la sede y el periodo********************************/
$dblink = NewADOConnection($DBConnection);
//echo "<br>Guardar".$_POST['Grabar'];
if ($_POST['Grabar']=='SI'){
	
	foreach($_POST["chkAcreditacion"] as $valor)
	{
		//echo "preg".$valor."<br>";
		$chkAcreditacion = explode("|", $valor);
	//	echo $gpendiente[0];
		$serial_cdc=$chkAcreditacion[0];
		$serial_adc=$chkAcreditacion[1];
		$sql_insert="insert into cierredia_control_acreditacion( serial_cdca,serial_cdc,serial_acd) values (0,".$serial_cdc.",".$serial_adc.")";
		echo "<script> opener.omniObj.firstPage();
       window.close(); </script>";
	//	echo "<br>insert:".$sql_insert;
		$dblink->Execute($sql_insert);
	}	
}
/*"select serial_cdc,fechaefec_cdc,fdc.nombre_forc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid,acd.serial_acd ,'NO' as registrado,descripcion_cdc
from cierredia cid,cierredia_control cdc, formacobro fdc,acreditacion_cierredia acd 
where fdc.serial_forc = cdc.serial_forc and cid.serial_cid = cdc.serial_cid  
and cid.serial_suc=".$_COOKIE['serial_suc']." and fdc.serial_forc=acd.serial_forc 
and acd.serial_acd=".$_GET['serial_acd']." and cdc.serial_cdc not in (select serial_cdc from cierredia_control_acreditacion) and fechaefec_cdc<=fechaacre_acd";*/
			
$rs_acreditacion=$rs_respuesta=$dblink->Execute("select fechaacre_acd,formacobro.serial_forc,CONTROL_FORC from  acreditacion_cierredia,formacobro where acreditacion_cierredia.serial_forc=formacobro.serial_forc and serial_acd=".$_GET['serial_acd']);

//echo "select fechaacre_acd,formacobro.serial_forc,CONTROL_FORC from  acreditacion_cierredia,formacobro where acreditacion_cierredia.serial_forc=formacobro.serial_forc and serial_acd=".$_GET['serial_acd']."<br>";
if($rs_acreditacion->fields['CONTROL_FORC']<>'')
	$filtro=" cdc.serial_forc in (select serial_forc from formacobro where CONTROL_FORC='".$rs_acreditacion->fields['CONTROL_FORC']."') ";
else
	$filtro=" cdc.serial_forc=".$rs_acreditacion->fields['serial_forc']." ";	


 $SQLCommand="select serial_cdc,fechaefec_cdc,fdc.nombre_forc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid,acd.serial_acd ,'NO' as registrado,cdc.Observacion_cdc,cdc.descripcion_cdc
from cierredia cid,cierredia_control cdc, formacobro fdc,acreditacion_cierredia acd 
where ".$filtro."
and fdc.serial_forc=cdc.serial_forc 
and cid.serial_suc=".$_COOKIE['serial_suc']."  and cid.serial_cid = cdc.serial_cid  
and acd.serial_acd=".$_GET['serial_acd']." and cdc.serial_cdc not in (select serial_cdc from cierredia_control_acreditacion) and fechaefec_cdc<='".$rs_acreditacion->fields['fechaacre_acd']."'
union
select cdc.serial_cdc,fechaefec_cdc,fdc.nombre_forc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid ,acd.serial_acd,'SI' as registrado,cdc.Observacion_cdc,cdc.descripcion_cdc
from formacobro fdc,cierredia_control cdc, cierredia_control_acreditacion cdca,acreditacion_cierredia acd 
where  fdc.serial_forc = acd.serial_forc 
and cdca.serial_cdc=cdc.serial_cdc
and cdca.serial_acd=acd.serial_acd
and acd.serial_acd=".$_GET['serial_acd']." order by fechaefec_cdc asc";

 // echo "serial_forc:".$_GET['serial_acd'];
 // echo $SQLCommand."<br>";
  $rs_respuesta=$dblink->Execute($SQLCommand);
?>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
<body  scroll = "auto"> 

<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" onClick="highlight(event)" onKeyUp="highlight(event)">
<input name="action" type="hidden" id="action">
<input name="serial_suc" type="hidden" id="serial_suc" class="hidden">
<input name="serial_usr" type="hidden" id="serial_usr" class="hidden">
<input name="Grabar" type="hidden"  value="SI">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr  >
      <td width="212" height="52"  class="ingeniumtoptitle"></td>
      <td width="370"  class="maintoptitle fonttitle"><center>
          MODULO PENSIONES<br>
         COTROL DE ACREDITACION
      </center></td>
      <td width="127"  class="logotoptitle"></td>
    </tr>
    <tr>
      <td  colspan="3"> <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolorlight="#000000"  bordercolordark="#FFFFFF"class="formtable">
          <tr>
      		 <td height="24" colspan="7" class="formtitle"><div align="center"><span class="style1">DETALLE DE VALORES A ACREDITAR</span></div><div align="right"><span id="spanTotal" class="totales">0.00 </span></div></td>
		  </tr>
		  
		 <tr>
            <td class="inputtitle">F.Efectivisacion</td>
            <td width="120" class="inputtitle">TCobro</td>
			<td width="89" class="inputtitle">Valor</td>
            <td width="151" class="inputtitle">Comision</td>
            <td width="97" class="inputtitle">Estado</td>
		    <td width="97" class="inputtitle">Acreditado</td>
			<td width="97" class="inputtitle">Descripción</td>
			<td width="97" class="inputtitle">Observacion</td>
		 </tr>
		  <? 
		//$rs_respuesta->MoveFirst();
		$i=0;
		while (!$rs_respuesta->EOF) {
			$check='';
			if ($rs_respuesta->fields['registrado']=='SI'){ 
				$check='checked';
				echo "<script> total=total+".$rs_respuesta->fields['valor_cdc']."; </script>";
			}	
			
		?>
	      <tr>
            <td><? echo $rs_respuesta->fields['fechaefec_cdc'];?></td>
            <td><? echo $rs_respuesta->fields['nombre_forc'];?></td>
			<td><? echo $rs_respuesta->fields['valor_cdc'];?></td>
			<td><? echo $rs_respuesta->fields['comision_cdc'];?></td>
            <td><? echo $rs_respuesta->fields['estado_cdc'];?></td>
            <td><input type="checkbox" name="<? echo "chkAcreditacion[".$i."]";?>" value="<? echo $rs_respuesta->fields['serial_cdc']."|".$rs_respuesta->fields['serial_acd'];?>" onClick="SumarValor(<? echo $rs_respuesta->fields['valor_cdc']?>,this)"   <? echo $check;?>>
            </td>
			<td><? echo $rs_respuesta->fields['descripcion_cdc'];?></td>
			 <td><? echo $rs_respuesta->fields['Observacion_cdc'];?></td>
          </tr>
		  <? 
		  $i++;
			$rs_respuesta->MoveNext();
	  	}
		?>
        
		           <!-- <tr>
            <td height="25"  class="inputtitle">Cuenta:</td>
            <td colspan="2">&nbsp;</td>
			<td height="25"  class="inputtitle">Comprobante:</td>
            <td colspan="3" ><a href="" onclick="imprimir()">Imprimir</a></td>
          </tr>-->
		
        </table></td>
    </tr>
    <tr>
		<td height="30" colspan="3" align="center" class="menuborder"> <table width="707" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="168" height="31">
<div  id="divGuardar" style="visibility:visible"><a href="#"  onClick="javascript:GuardarResgistros()"><img src="../images/save.png" width="48" height="48" border="0" align="middle">Grabar</a></div></td>
            <td width="165"></td>
            <td width="158"><a href="#"  onClick="javascript:ImprimirRegistro();"></a></td>
            <td width="162"><a href="#"  onClick="javascript:omnisoftGrabar()"></a></td>
            <td width="54"><div  id="divCancelar" style="visibility:visible"><a href="javascript:omnisoftCancelar()"><img src="../images/cancel.png" width="48" height="48" border="0" align="middle">Cancelar</a></div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
<script>
//procesarTotales();
	omnisoftLoadData(document.PaginaDatos);
	document.PaginaDatos.serial_suc.value=getCookie('serial_suc');
	document.PaginaDatos.serial_usr.value=getCookie('serial_usr');
//	if (getURLParam('action')=='insert')
</script>
</body>
</html>