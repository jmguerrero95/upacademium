<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recibo de Cobro</title>
<style type="text/css">
<!--
INPUT.b 
{
	 FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; BACKGROUND-COLOR: #ffcc00; color:#CC0000; border-style:solid; border-color:#FFFFFF; font-style:italic;
}
th 
{font-family:Arial;
font-size:11px;
color:#000000; 
}
th.r
{font-family: Arial;
font-size:11px;
color:#000000; 
text-align:right; 
}
-->
</style>
</head>

</style>

<body>
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		require('numeroLetras.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 	 	 $numerofactura=$_GET['numerofactura'];
		 $serial_caf=$_GET['serial_caf'];
		 $serial_cre=$_GET['serial_cre'];
		//echo "provi:".$provision;
//echo "<H1 class='SaltoDePagina'></H1>";	
			$resultEmpresa=$dblink->Execute('select * from empresa');
			
			
/*$resultSede=$dblink->Execute('select * from cabecerafactura,alumno,sucursal,secuenciadocumentos,alumnomalla,malla where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$serial_caf.' and cabecerafactura.serial_suc=sucursal.serial_suc and sucursal.serial_suc=secuenciadocumentos.serial_suc and alumno.serial_alu=alumnomalla.serial_alu and alumnomalla.serial_maa=malla.serial_maa and serial_maa_p=0');
*/
$resultSede=$dblink->Execute('select * from cabecerafactura,alumno,sucursal,secuenciadocumentos where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$serial_caf.' and cabecerafactura.serial_suc=sucursal.serial_suc and sucursal.serial_suc=secuenciadocumentos.serial_suc');
 
 $sql="select serial_dfa, nombre_ara, cantidad_dfa,valor_aal,cantidad_dfa*valor_aal as subtotal,cantidad_dfa*valor_aal as total,detallefactura.serial_caf, detallearancel.serial_dar from aranceles,detallearancel,detallefactura where detallearancel.serial_dar=detallefactura.serial_dar  and aranceles.serial_ara=detallearancel.serial_ara and detallefactura.serial_caf=".$serial_caf." order by nombre_ara ";
  //echo $sql;
  
$cabeceraRecibo = "select * from cabecerarecibo where serial_caf = ".$serial_caf;

$detalleRecibo = "SELECT ban.nombre_ban, forc.NOMBRE_FORC,dre.* 
					FROM  detallerecibo as dre LEFT JOIN banco as ban 
					on dre.serial_ban= ban.serial_ban
					LEFT JOIN formacobro as forc on dre.serial_forc = forc.SERIAL_FORC 
					where serial_cre = ".$serial_cre;
//numero_cre
//echo $detalleRecibo;

$resulcabeceraRecibo=$dblink->Execute($cabeceraRecibo);

$resuldetalleRecibo=$dblink->Execute($detalleRecibo);
$resultSetFactura=$dblink->Execute($sql);
		
		?>
<table width="682" align="left"  >
  <tr bgcolor="#FFFFFF">
    <th width="776" height="150" colspan="2" bgcolor="#FFFFFF">&nbsp;</th>
  </tr>
 
  <tr>
    <th colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th height="90" colspan="13" ><table width="115%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
          <tr>
            <th width="19%" height="12" align="left" valign="bottom" >&nbsp;</th>
            <th width="60%" height="12" align="left" valign="bottom" ><? echo $resultSede->fields['nombre_maa']; ?></th>
            <th width="21%" height="12" align="left" valign="bottom" ><? echo $resultSede->fields['codigo_alu']; ?></th>
          </tr>
          <tr>
            <th height="12" align="left" valign="bottom" >&nbsp;</th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['cliente_caf']; ?></th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['cedula_caf']; ?></th>
          </tr>
          <tr>
            <th height="12" align="left" valign="bottom" >&nbsp;</th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['apellidopaterno_alu']." ".$resultSede->fields['apellidomaterno_alu']." ".$resultSede->fields['nombre1_alu']." ".$resultSede->fields['nombre2_alu']; ?>&nbsp;</th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['codigoIdentificacion_alu']; ?></th>
          </tr>
          <tr>
            <th height="12" align="left" valign="bottom" >&nbsp;</th>
            <th height="12" align="left" valign="bottom" ><? echo $resulcabeceraRecibo->fields['fecha_cre']; ?></th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['telefodomic_alu']; ?></th>
          </tr>
          <tr>
            <th height="12" align="left" valign="bottom" >&nbsp;</th>
            <th height="12" align="left" valign="bottom" ><? echo $resultSede->fields['direcciondomic_alu']; ?></th>
            <th height="12" align="left" valign="bottom" ><? echo $numerofactura; ?></th>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th width="12%" height="25" >&nbsp;</th>
        <th width="3%" height="25" >&nbsp;</th>
        <th width="13%" height="25" >&nbsp;</th>
        <th width="15%" height="25" >&nbsp;</th>
        <th width="8%" height="25" >&nbsp;</th>
        <th width="11%" height="25" >&nbsp;</th>
        <th width="4%" height="25" >&nbsp;</th>
        <th width="7%" height="25" >&nbsp;</th>
        <th width="9%" height="25" >&nbsp;</th>
        <th width="6%" height="25" >&nbsp;</th>
        <th width="6%" height="25" >&nbsp;</th>
        <th width="6%" height="25" >&nbsp;</th>
      </tr>
      <? 
			  $cont=0;
			  while(!$resuldetalleRecibo->EOF ){
			 // if ($resuldetalleRecibo->fields['valor_dre'] > 0){
			  $cont++;
			   ?>
      <tr>
        <th align="left" >&nbsp;</th>
        <th height="18" align="left" ><? echo $cont; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['NOMBRE_FORC']; ?></th>
        <th align="left" >&nbsp;<? echo $resuldetalleRecibo->fields['nombre_ban']; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['numeroDocumento_dre']; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['tarjetahabiente_dre']; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['plazo_dre']; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['lote_dre']; ?></th>
        <th align="left" ><? echo $resuldetalleRecibo->fields['fecha_dre']; ?></th>
        <th align="right" ><? echo $resuldetalleRecibo->fields['valor_dre']; ?></th>
        <th align="right" >&nbsp;</th>
        <th align="right" >&nbsp;</th>
      </tr>
      <?
			
			$total+=$resuldetalleRecibo->fields['valor_dre'];
			
			//}
			$resuldetalleRecibo->MoveNext();
    }
	//$total=number_format($baseimponible0-$descuentos0,2);
			while($cont<=6){
			  ?>
      <tr>
        <th align="left" >&nbsp;</th>
        <th height="14" align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="left" >&nbsp;</th>
        <th align="right" >&nbsp;</th>
        <th align="right" >&nbsp;</th>
        <th align="right" >&nbsp;</th>
      </tr>
      <? $cont++; }?>
      <tr>
        <th   align="left" valign="top" >&nbsp;</th>
        <th  colspan="9" align="left" valign="bottom" ><? echo numerosDecimal($total);?></th>
        <th align="right" >&nbsp;</th>
        <th align="right" valign="bottom" ><? echo number_format($total,2); ?></th>
      </tr>
    
    </table></th>
  </tr>
  <tr  >
    <th colspan="2">&nbsp;</th>
  </tr>
</table>

		

</body>
</html>
