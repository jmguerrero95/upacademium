<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CIERRE DE DIA</title>
<style type="text/css">
<!--

.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>
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
		//echo "->".$fecha_ini;
		//echo "->".$fecha_fin;
		
		 $resul_age=$dblink->Execute("select nombre_suc from sucursal where serial_suc=".$_COOKIE['serial_suc']);
		
		$resul_usuario=$dblink->Execute("select concat_ws(' ', NOMBRE_USR,NOMBRE2_USR,APELLIDO_USR,APELLIDO2_USR) usuario from upusuario where serial_usr=".$_COOKIE['serial_usr']);
		
$result_facturacion=$dblink->Execute("select serial_caf,concat_ws('-',serie_caf,numero_caf) as factura,codigo_alu,cedula_caf,cliente_caf,estado_caf,total_caf,fecha_caf
from cabecerafactura
left join alumno on alumno.serial_alu=cabecerafactura.serial_alu
 where fecha_caf>='".$fecha_ini."' and fecha_caf<='".$fecha_fin."' and tipo_caf='FAC' and cabecerafactura.serial_suc=".$_COOKIE['serial_suc']);
 


$result_cobros =$dblink->Execute("select numero_cre,NOMBRE_FORC,concat_ws('-',serie_caf,numero_caf) numfac,valor_dre,numeroDocumento_dre,fecha_dre,nombre_ban, plazo_dre,referencia_dre,lote_dre,tarjetahabiente_dre,fecha_cre,estado_caf  
from formacobro,cabecerarecibo,detallerecibo,cabecerafactura
left join banco on banco.serial_ban=detallerecibo.serial_ban
 where cabecerarecibo.serial_cre=detallerecibo.serial_cre
and detallerecibo.serial_forc=formacobro.serial_forc
and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
and fecha_cre>='".$fecha_ini."' and fecha_cre<='".$fecha_fin."' and tipo_caf='FAC' and cabecerafactura.serial_suc=".$_COOKIE['serial_suc']."
order by nombre_forc,numfac");


?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
 H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }

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

<? 	
	/*$j=0;	
	while (!$rshorario_temp->EOF) {
	if($j>0) echo "<H1 class=SaltoDePagina> </H1>";*/
	?>
<BR>

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">CIERRE DE CAJA </span></th>
  </tr>
  
  <tr>
    <th colspan="2"> DEL <? echo $fecha_ini;?> AL <? echo $fecha_fin;?> </th>
  </tr>
  
  <tr>
    <th width="18%" align="right">SUCURSAL:</th>
    <th width="61%" align="left"><? echo  $resul_age->fields['nombre_suc'];?></th>
  </tr>
  <tr>
    <th colspan="2" align="center">
      
      FACTURADO
    </th>
    <th align="center">
      COBRADO </th>
  </tr>
  
  

  <tr>
    <td height="67" colspan="2" valign="top" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
      <tr>
        <th width="1%" class="style5"  style="">No</th>
        <th width="12%" class="style5">Fecha</th>
        <th width="12%" class="style5">C&oacute;digo</th>
        <th width="12%"><span class="style5">N&ordm;. Factura </span></th>
        <th width="4%" ><span class="style5">Codigo</span></th>
        <th width="4%" ><span class="style5">Cedula</span></th>
        <th width="4%" ><span class="style5">Cliente</span></th>
        <th width="4%" ><span class="style5">Estado</span></th>
        <th width="4%" ><span class="style5">Valor</span></th>
		 </tr>
        <? 
		 $i=0;
		//$result_facturacion->MoveFirst();
		$total_fac=0;
		while (!$result_facturacion->EOF) {
		$i=$i+1;
			?>
      <tr>
        <td class="style2"><? echo $i;?></td>
        <td class="style2"><? echo $result_facturacion->fields['fecha_caf'];?></td>
        <td class="style2"><? echo $result_facturacion->fields['serial_caf'];?></td>
        <td class="style2"><? echo $result_facturacion->fields['factura'];?></td>
        <td class="style2"><? echo $result_facturacion->fields['codigo_alu'];?> </td>
        <td class="style2"><? echo $result_facturacion->fields['cedula_caf'];?>  </td>
        <td class="style2"><? echo $result_facturacion->fields['cliente_caf'];?></td>
        <td class="style2"><? echo $result_facturacion->fields['estado_caf'];?></td>
        <td class="style2"><? echo $result_facturacion->fields['total_caf'];?> </td>
		</tr>
        <?
			if($result_facturacion->fields['estado_caf']<>'ANULADO')
				$total_fac=$total_fac+$result_facturacion->fields['total_caf'];	
			
			
			$result_facturacion->MoveNext();
	  	}
		?>
      
    </table></td>
    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
      <tr>
        <th width="1%" class="style5"  style="">No</th>
        <th width="12%" class="style5">Fecha</th>
		<th width="12%" class="style5">N&ordm;.Ing.caja</th>
        <th width="12%" class="style5">Forma de Cobro</th>
        <th width="4%" class="style5" >N&ordm;. Factura</th>
        <th width="4%" class="style5" >Valor</th>
        <th width="4%" class="style5" >N&ordm;. Documento </th>
        <th width="4%" class="style5" >Fecha documento </th>
        <th width="4%" class="style5" >Banco</th>
        <th width="4%" class="style5" >Plazo</th>
        <th width="4%" class="style5" >Referencia</th>
        <th width="4%" class="style5" >Lote</th>
        <th width="4%" class="style5" >Tarjeta Habiente </th>
		</tr>
        <? //$i=1;
		 $m = 0;
		 $f = 0;
		 $i=0;
		$result_cobros->MoveFirst();
		while (!$result_cobros->EOF) {
			$i=$i+1;
			if($result_cobros->fields['NOMBRE_FORC']!=$forma_cobro && $i>1){
			?>
			<tr>
        	<td class="style2" colspan="5"><? echo "TOTAL ".$forma_cobro;?></td>
			<td class="style2" ><? echo  $total_tipo;?></td>
			<td class="style2" colspan="7">&nbsp;</td>
			</tr>
			<?
			$total_tipo=0;
			}
		?>
      <tr>
        <td class="style2"><? echo $i;?></td>
		 <td class="style2"><? echo $result_cobros->fields['fecha_cre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['numero_cre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['NOMBRE_FORC'];?></td>
        <td class="style2"><? echo $result_cobros->fields['numfac'];?></td>
        <td class="style2"><? echo $result_cobros->fields['valor_dre'];?> </td>
        <td class="style2"><? echo $result_cobros->fields['numeroDocumento_dre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['fecha_dre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['nombre_ban'];?></td>
        <td class="style2"><? echo $result_cobros->fields['plazo_dre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['referencia_dre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['lote_dre'];?></td>
        <td class="style2"><? echo $result_cobros->fields['tarjetahabiente_dre'];?></td>
		</tr>
        <?
			
			if($result_cobros->fields['estado_caf']<>'ANULADO'){
				$total_cob=$total_cob+$result_cobros->fields['valor_dre'];	
				$total_tipo=$total_tipo+$result_cobros->fields['valor_dre'];				
			}
			$forma_cobro=$result_cobros->fields['NOMBRE_FORC'];
			
			$result_cobros->MoveNext();
	  	}
		?>
      
	  <tr>
        	<td class="style2" colspan="5"><? echo "TOTAL ".$forma_cobro;?></td>
			<td class="style2" ><? echo  $total_tipo;?></td>
			<td class="style2" colspan="7">&nbsp;</td>
			</tr>
    </table></td>
  </tr>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>

          <td width="51%" align="center"><div align="left">
			<p>TOTAL FACTURADO : <? echo " ".$total_fac;?></p>
            <p>TOTAL COBRADO:  <? echo " ".$total_cob;?></p>            
			
          </div></td>
          <td width="49%" align="center"><div align="left">REVISADO POR:&nbsp;&nbsp;&nbsp;  <? echo $resul_usuario->fields['usuario']."<br><br>".date('Y-m-d');?></div></td>
        </tr>
      </table></td>
	  
  </tr>
</table>

</body>
</html>