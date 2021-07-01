<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recibo de Cobro</title>
<style type="text/css">
<!--
.style2 {
font-family: Arial;
font-size: 8px}
-->
</style>
</head>
<style>
.style1 {
	font-family: Arial;
	font-size: 12px;
}
.style3 {font-family: Arial; font-size: 8px; }
.style4 {font-family: Arial; font-size: 6px;}
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
			
			
$resultSede=$dblink->Execute('select * from cabecerafactura,alumno,sucursal,secuenciadocumentos,alumnomalla,malla where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$serial_caf.' and cabecerafactura.serial_suc=sucursal.serial_suc and sucursal.serial_suc=secuenciadocumentos.serial_suc and alumno.serial_alu=alumnomalla.serial_alu and alumnomalla.serial_maa=malla.serial_maa and serial_maa_p=0');

 
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
<table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="97%" align="left"  >
              <tr bgcolor="#FFFFFF">
                <td width="27%"  rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="115" height="49" /></td>
                <th width="56%" colspan="2" align="left" class="style1">Universidad del Pac&iacute;fico - Escuela de Negocios </th>
                <th width="17%" rowspan="3" align="center" class="style3">COMPROBANTE DE CAJA </th>
              </tr>
              <tr>
                <th colspan="2" align="left" class="style1">R.U.C.: <? echo $resultEmpresa->fields['RUC_EMP']; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="left"  class="style1">SEDE <? echo $resultSede->fields['NOMBRE_SUC']; ?>: </th>
              </tr>
             
              <tr>
                <th align="left"  class="style2"><? echo $resultSede->fields['DIRECCION_SUC']."<br> Telf:".$resultSede->fields['TELEFONO_SUC']."/".$resultSede->fields['TELEFONO_SUC2']."Fax:".$resultSede->fields['FAX_SUC']."<br> Email:".$resultEmpresa->fields['EMAIL_EMP']."<br>".$resultEmpresa->fields['WEB_EMP']; ?></th>
                <th align="center"  class="style2" nowrap="nowrap">SERIE &nbsp;&nbsp; <? echo $resultSede->fields['SECUENCIALSUCURSAL_SDO']."-".$resultSede->fields['SECUENCIALACTIVIDAD_SDO']; ?> </th>
				
                <th align="center" class="style1" colspan="2">Nº. &nbsp;<? echo $resulcabeceraRecibo->fields['numero_cre']; ?></th>
              </tr>			  
			   <tr>
                <th colspan="2" align="left"  class="style2"><span class="style1"><? echo $resultSede->fields['NOMBRE_SUC']." - ECUADOR"; ?></span></th>
                <th align="center" class="style1" colspan="2">&nbsp;</th>
              </tr>
             
              <tr >
                <th colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="12" ><table width="115%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                          <tr>
                            <td width="12%" align="left" class="style3">Programa:</td>
                            <td width="50%" align="left" class="style2"><? echo $resultSede->fields['nombre_maa']; ?></td>
                            <td width="19%" align="left" class="style3">C&oacute;digo:</td>
                            <td width="19%" align="left" class="style2"><? echo $resultSede->fields['codigo_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Cliente:</td>
                            <td align="left" class="style2">&nbsp;</td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Alumno:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['nombre1_alu']." ".$resultSede->fields['nombre2_alu']." ".$resultSede->fields['apellidopaterno_alu']." ".$resultSede->fields['apellidomaterno_alu']; ?>&nbsp;</td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['codigoIdentificacion_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Fecha:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['fecha_caf']; ?></td>
                            <td align="left" class="style3">Telfs:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['telefodomic_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Direcci&oacute;n:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['direcciondomic_alu']; ?></td>
                            <th align="left" class="style1">FAC:</th>
							
							<th align="left" class="style1"><? echo $numerofactura; ?></th>
                            <td align="left" class="style2">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="2%" class="style3">No </td>
					  <td width="20%" class="style3">FORMA DE COBRO </td>					  
                      <td width="20%" class="style3">BANCO</td>
					  <td width="10%" class="style3">VOUCHER</td>					  
					  <td width="15%" class="style3">TARJETA HABIENTE</td>
					  <td width="10%" class="style3">PLAZO EN MESES </td>
					  <td width="10%" class="style3">LOTE</td>					  
					  <td width="15%" class="style3">FECHA VENCIMIENTO </td>
                      <td width="5%" class="style3"><span class="style2">VALOR DE PAGO </span></td>
                      <td width="5%" class="style3">VALOR DE FACTURA </td>
                      <td width="5%" class="style3">SALDO</td>                    
                    </tr>
                    <? 
			  $cont=0;
			  while(!$resuldetalleRecibo->EOF ){
			  if ($resuldetalleRecibo->fields['valor_dre'] > 0){
			  $cont++;
			   ?>
                    <tr>
					  <td align="left" class="style2"><? echo $cont; ?></td>
                       <td align="left" class="style2"><? echo $resuldetalleRecibo->fields['NOMBRE_FORC']; ?></td>
                       <td class="style2">&nbsp;<? echo $resuldetalleRecibo->fields['nombre_ban']; ?></td>
                       <td class="style2"><? echo $resuldetalleRecibo->fields['numeroDocumento_dre']; ?></td>
					   <td class="style2"><? echo $resuldetalleRecibo->fields['tarjetahabiente_dre']; ?></td>
					  <td class="style2"><? echo $resuldetalleRecibo->fields['plazo_dre']; ?></td>
  					  <td class="style2"><? echo $resuldetalleRecibo->fields['lote_dre']; ?></td>
					  <td class="style2"><? echo $resuldetalleRecibo->fields['fecha_dre']; ?></td>
                      <td class="style2"><? echo $resuldetalleRecibo->fields['valor_dre']; ?></td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>   	                     
                    </tr>
                    <?
			
			$total+=$resuldetalleRecibo->fields['valor_dre'];
			
			}
			$resuldetalleRecibo->MoveNext();
    }
	//$total=number_format($baseimponible0-$descuentos0,2);
			while($cont<=7){
			  ?>
                    <tr>
                      <td align="left" class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                    </tr>
                    <? $cont++; }?>                    
                    <tr>
		              <td rowspan="3" colspan="7" align="left" valign="top" class="style3">Son: <? echo numerosDecimal($total);?> </td>					
                      
                      <td align="left" class="style2">TOTAL </td>
                      <td align="right" class="style2">&nbsp;</td>
                      <td align="right" class="style2">&nbsp;</td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                   <!-- <tr>
                      
                      <td align="left" class="style2">DESCUENTO</td>
                      <td align="right" class="style2"><? echo number_format($descuentos0,2); ?></td>
                    </tr>
                    <tr>
                      
                      <td align="left" class="style2">SUBTOTAL</td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                    
					<tr>
                      <td rowspan="2" colspan="2" class="style4" align="left">Debo y pagar&eacute; sin protesto el valor constante en esa factura. En caso de mora reconocer&eacute; el porcentaje anual del inter&eacute;s comercial vigente a la fecha de emisi&oacute;n de la misma. renuncio domicilio y me someto al tramite legal correspondiente. </td>
                     
                      <td align="left" class="style2">I.V.A. 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    
					<tr>                     
					 
                      <td align="left" class="style2">VALOR TOTAL </td>
                      <td align="right" class="style2"><? echo $total; ?></td>
                    </tr>
					
			-->		
                </table></th>
              </tr>
              <tr  class="style2">
                <th colspan="4"><table width="100%" border="0">
                    <tr align="center">
                      <td width="50%"><p>&nbsp;</p>
                        <p><br />
                        ________________________<br />
                      RECIBIDO</p></td>
                      
                      <td width="50%"><p>&nbsp;</p>
                        <p><br />
                        
                      ________________________________<br />
                      ESTUDIANTE/REPRESENTANTE</p></td>
                    </tr>
                    <tr align="center"><TD colspan="4">
					<hr />
                          </HR>
						  ESTE DOCUMENTO ES EL &Uacute;NICO COMPROBANTE V&Aacute;LIDO DE PAGO</TD>                    
                    </tr>
                </table></th>
              </tr>
            </table></td>
 <!---------------------------------------------------------------------------------------------------->    
 
 
			<td><td><table width="97%" align="left"  >
              <tr bgcolor="#FFFFFF">
                <td width="27%"  rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="115" height="49" /></td>
                <th width="56%" colspan="2" align="left" class="style1">Universidad del Pac&iacute;fico - Escuela de Negocios </th>
                <th width="17%" rowspan="3" align="center" class="style3">COMPROBANTE DE INGRESO </th>
              </tr>
              <tr>
                <th colspan="2" align="left" class="style1">R.U.C.: <? echo $resultEmpresa->fields['RUC_EMP']; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="left"  class="style1">SEDE <? echo $resultSede->fields['NOMBRE_SUC']; ?>: </th>
              </tr>
             
              <tr>
                <th align="left"  class="style2"><? echo $resultSede->fields['DIRECCION_SUC']."<br> Telf:".$resultSede->fields['TELEFONO_SUC']."/".$resultSede->fields['TELEFONO_SUC2']."Fax:".$resultSede->fields['FAX_SUC']."<br> Email:".$resultEmpresa->fields['EMAIL_EMP']."<br>".$resultEmpresa->fields['WEB_EMP']; ?></th>
                <th align="center"  class="style2" nowrap="nowrap">SERIE &nbsp;&nbsp;<? echo $resultSede->fields['SECUENCIALSUCURSAL_SDO']."-".$resultSede->fields['SECUENCIALACTIVIDAD_SDO']; ?> </th>
				
                <th align="center" class="style1" colspan="2">Nº. &nbsp;<? echo $resulcabeceraRecibo->fields['numero_cre']; ?></th>
              </tr>	
			   <tr>
                <th colspan="2" align="left"  class="style2">&nbsp;</th>
                <th align="center" class="style1" colspan="2">&nbsp;</th>
              </tr>		  
			  <tr>
                <th colspan="2" align="left"  class="style2"><span class="style1"><? echo $resultSede->fields['NOMBRE_SUC']." - ECUADOR"; ?></span></th>
                <th align="center" class="style1" colspan="2">&nbsp;</th>
              </tr>
              <tr>
                <th colspan="2" align="center"  class="style2"><span class="style1"><? echo $resultSede->fields['NOMBRE_SUC']." - ECUADOR"; ?></span></th>
				
                <th width="56%" align="left" class="style3">&nbsp;</th>
              </tr>
              <tr >
                <th colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="10" ><table width="115%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                          <tr>
                            <td width="12%" align="left" class="style3">Programa:</td>
                            <td width="50%" align="left" class="style2"><? echo $resultSede->fields['nombre_maa']; ?></td>
                            <td width="19%" align="left" class="style3">C&oacute;digo:</td>
                            <td width="19%" align="left" class="style2"><? echo $resultSede->fields['codigo_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Cliente:</td>
                            <td align="left" class="style2">&nbsp;</td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Alumno:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['nombre1_alu']." ".$resultSede->fields['nombre2_alu']." ".$resultSede->fields['apellidopaterno_alu']." ".$resultSede->fields['apellidomaterno_alu']; ?>&nbsp;</td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['codigoIdentificacion_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Fecha:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['fecha_caf']; ?></td>
                            <td align="left" class="style3">Telfs:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['telefodomic_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Direcci&oacute;n:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['direcciondomic_alu']; ?></td>
                            <th align="left" class="style1">FAC:</th>
							
							<th align="left" class="style1"><? echo $numerofactura; ?></th>
                            <td align="left" class="style2">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="2%" class="style3">No </td>
					  <td width="20%" class="style3">FORMA DE COBRO </td>					  
                      <td width="20%" class="style3">BANCO</td>
					  <td width="10%" class="style3">VOUCHER</td>					  
					  <td width="15%" class="style3">TARJETA HABIENTE</td>
					  <td width="10%" class="style3">PLAZO EN MESES </td>
					  <td width="10%" class="style3">LOTE</td>					  
					  <td width="15%" class="style3">FECHA</td>
                      <td width="5%" class="style3">VALOR</td>                    
                    </tr>
                    <? 
			  $cont=0;
			  $resuldetalleRecibo->MoveFirst();
			  while(!$resuldetalleRecibo->EOF ){			  
			  if ($resuldetalleRecibo->fields['valor_dre'] > 0){
			  $cont++;
			   ?>
                    <tr>
					<td align="left" class="style2"><? echo $cont; ?></td>
                      <td align="left" class="style2"><? echo $resuldetalleRecibo->fields['NOMBRE_FORC']; ?></td>
                      <td class="style2">&nbsp;<? echo $resuldetalleRecibo->fields['nombre_ban']; ?></td>
                       <td class="style2"><? echo $resuldetalleRecibo->fields['numeroDocumento_dre']; ?></td>
					   <td class="style2"><? echo $resuldetalleRecibo->fields['tarjetahabiente_dre']; ?></td>
					  <td class="style2"><? echo $resuldetalleRecibo->fields['plazo_dre']; ?></td>
  					  <td class="style2"><? echo $resuldetalleRecibo->fields['lote_dre']; ?></td>
					  <td class="style2"><? echo $resuldetalleRecibo->fields['fecha_dre']; ?></td>
                      <td class="style2"><? echo $resuldetalleRecibo->fields['valor_dre']; ?></td>                      
                    </tr>
                    <?
			
			$total+=$resuldetalleRecibo->fields['valor_dre'];
			
			}
			$resuldetalleRecibo->MoveNext();
    }
	//$total=number_format($baseimponible0-$descuentos0,2);
			while($cont<=7){
			  ?>
                    <tr>
                      <td align="left" class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
					  <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                    </tr>
                    <? $cont++; }?>                    
                    <tr>
		              <td rowspan="3" colspan="7" align="left" valign="top" class="style3">Son: <? echo numerosDecimal($total);?> </td>					
                      
                      <td align="left" class="style2">TOTAL </td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                   <!-- <tr>
                      
                      <td align="left" class="style2">DESCUENTO</td>
                      <td align="right" class="style2"><? echo number_format($descuentos0,2); ?></td>
                    </tr>
                    <tr>
                      
                      <td align="left" class="style2">SUBTOTAL</td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                    
					<tr>
                      <td rowspan="2" colspan="2" class="style4" align="left">Debo y pagar&eacute; sin protesto el valor constante en esa factura. En caso de mora reconocer&eacute; el porcentaje anual del inter&eacute;s comercial vigente a la fecha de emisi&oacute;n de la misma. renuncio domicilio y me someto al tramite legal correspondiente. </td>
                     
                      <td align="left" class="style2">I.V.A. 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    
					<tr>                     
					 
                      <td align="left" class="style2">VALOR TOTAL </td>
                      <td align="right" class="style2"><? echo $total; ?></td>
                    </tr>
					
			-->		
                </table></th>
              </tr>
              <tr  class="style2">
                <th colspan="4"><table width="100%" border="0">
                    <tr align="center">
                      <td width="50%"><p>&nbsp;</p>
                        <p><br />
                        ________________________<br />
                      ENTREGA</p></td>
                      
                      <td width="50%"><p>&nbsp;</p>
                        <p><br />
                        
                      ________________________________<br />
                      ESTUDIANTE/REPRESENTANTE</p></td>
                    </tr>
                    <tr align="center">                    </tr>
                </table></th>
              </tr>
            </table></td>
          </tr>
		  
<!------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------->
        </table>
		<br><br>
		

</body>
</html>
