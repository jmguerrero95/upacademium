<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FACTURA</title>
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
.style3 {font-family: Arial; font-size: 9px; }
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
		//echo "provi:".$provision;
//echo "<H1 class='SaltoDePagina'></H1>";	
			$resultEmpresa=$dblink->Execute('select * from empresa');
			
			
$resultSede=$dblink->Execute('select * from cabecerafactura,alumno,sucursal,secuenciadocumentos
left join alumnomalla on alumno.serial_alu=alumnomalla.serial_alu
left join malla on alumnomalla.serial_maa=malla.serial_maa and serial_maa_p=0
where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$serial_caf.' and cabecerafactura.serial_suc=sucursal.serial_suc and sucursal.serial_suc=secuenciadocumentos.serial_suc');


//echo $sql;
  $resultSetFactura=$dblink->Execute('select serial_dfa, nombre_ara, cantidad_dfa,valor_aal,(cantidad_dfa*valor_aal) as subtotal, descuento_dfa,detallefactura.serial_caf, detallearancel.serial_dar,iva_ara from aranceles,detallearancel,detallefactura where detallearancel.serial_dar=detallefactura.serial_dar  and aranceles.serial_ara=detallearancel.serial_ara and detallefactura.serial_caf='.$serial_caf.' order by nombre_ara');
   
  //echo "echo".$resultSetFactura->RecordCount();
 	
 //$sub=$resultSetFactura->fields[4];	
 //echo "subbbbbbbbbb:". $sub; 
 
	$baseimponible=0;
	$descuentos=0;
//    $totalgeneral=0;
//	$subtotalgeneral=0;
$rsIngCaja=$dblink->Execute('select serial_cre,numero_cre from cabecerarecibo where serial_caf='.$serial_caf);
$numero_caja='';
  while(!$rsIngCaja->EOF){
  
  		$numero_caja=$numero_caja.$rsIngCaja->fields['numero_cre']." - ";
		
  	$rsIngCaja->MoveNext();
  }

		?>
<table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="90%" align="left"  >
              <tr bgcolor="#FFFFFF">
                <td width="27%"  rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="115" height="49" /></td>
                <th width="56%" colspan="2" align="left" class="style1">Universidad del Pac&iacute;fico - Escuela de Negocios </th>
                <th width="17%" rowspan="3" align="center" class="style3">CONTRIBUYENTE <br />
                  ESPECIAL RESOLUCI&Oacute;N <br />
                  N&ordm; 636 del 29/12/2005<br />
                  FACTURA </th>
              </tr>
              <tr>
                <th colspan="2" align="left" class="style1">R.U.C.: <? echo $resultEmpresa->fields['RUC_EMP']; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="left"  class="style1">SEDE <? echo $resultSede->fields['NOMBRE_SUC']; ?>: </th>
              </tr>
              <tr>
                <th align="left"  class="style2"><? echo $resultSede->fields['DIRECCION_SUC']."<br> Telf:".$resultSede->fields['TELEFONO_SUC']."/".$resultSede->fields['TELEFONO_SUC2']."Fax:".$resultSede->fields['FAX_SUC']."<br> Email:".$resultEmpresa->fields['EMAIL_EMP']."<br>".$resultEmpresa->fields['WEB_EMP']; ?></th>
                <th align="center"  class="style2" nowrap="nowrap">S&nbsp;<? echo $resultSede->fields['SECUENCIALSUCURSAL_SDO']."-".$resultSede->fields['SECUENCIALACTIVIDAD_SDO']; ?> </th>
                <th align="center" class="style1">N&ordm;.&nbsp;<? echo $numerofactura; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="center"  class="style2"><span class="style1"><? echo $resultSede->fields['NOMBRE_SUC']." - ECUADOR"; ?></span></th>
                <th width="17%" align="left" class="style3">AUT.S.R.I.:&nbsp;<? echo $resultSede->fields['AUTORIZACIONSRI_SDO']; ?></th>
              </tr>
              <tr >
                <th colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                          <tr>
                            <td width="12%" align="left" class="style3">Programa:</td>
                            <td width="52%" align="left" class="style2"><? echo $resultSede->fields['nombre_maa']; ?></td>
                            <td width="13%" align="left" class="style3">C&oacute;digo:</td>
                            <td width="23%" align="left" class="style2"><? echo $resultSede->fields['codigo_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Cliente:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['cliente_caf']; ?></td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['cedula_caf']; ?></td>
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
                            <td align="left" class="style3">Ing.Caja N&ordm;: </td>
                            <td align="left" class="style2"><? echo $numero_caja; ?></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="57%" class="style3">CONCEPTO</td>
                      <td width="13%" class="style3">CREDITOS</td>
                      <td width="16%" class="style3">VALOR UNITARIO </td>
                      <td width="14%" class="style3">VALOR TOTAL </td>
                    </tr>
                    <? 
			  $cont=0;
			  while(!$resultSetFactura->EOF){
				   ?>
                    <tr>
                      <td align="left" class="style2"><? echo $resultSetFactura->fields['nombre_ara']; ?></td>
                      <td class="style2"><? echo $resultSetFactura->fields['cantidad_dfa']; ?></td>
                      <td class="style2"><? echo number_format($resultSetFactura->fields['valor_aal'],2); ?></td>
                      <td align="right" class="style2"><? echo number_format($resultSetFactura->fields[4],2); ?></td>
                    </tr>
                    <?
			  $totalgeneral+=$resultSetFactura->fields[4];
			  $subtotalgeneral+=$resultSetFactura->fields[4];
		
		 		$baseimponible+=$resultSetFactura->fields[4];
				//echo "base:".$baseimponible;
				$descuentos+=$resultSetFactura->fields['descuento_dfa'];
			 
			$cont++;
			$resultSetFactura->MoveNext();
    	}
		//$total=number_format($baseimponible+$descuentos,2);
		$total=$baseimponible+$descuentos;
			while($cont<=15){
			  ?>
                    <tr>
                      <td align="left" class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                    </tr>
                    <? $cont++; }?>
                    <tr>
                      <td rowspan="4" align="left" valign="top" class="style3">Son: <?  echo numerosDecimal($total);?>  USD</td>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL 0% </td>
                      <td align="right" class="style2"><? echo number_format($baseimponible,2); ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">BECA-DESCUENTO</td>
                      <td align="right" class="style2"><? echo number_format($descuentos,2); ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL</td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                    <tr>
                      <td rowspan="2" class="style4" align="left">Debo y pagar&eacute; sin protesto el valor constante en esa factura. En caso de mora reconocer&eacute; el porcentaje anual del inter&eacute;s comercial vigente a la fecha de emisi&oacute;n de la misma. renuncio domicilio y me someto al tramite legal correspondiente.<BR><BR> 
                      La emisión de este comprobante no certifica su cancelación.<BR><BR> Para cada pago parcial debe exigir su Comprobante de Ingreso.</td>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">I.V.A. 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">VALOR TOTAL </td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                </table></th>
              </tr>
              <tr  class="style2">
                <th colspan="4"><table width="100%" border="0">
                    <tr align="center">
                      <td colspan="3" align="right"><table width="50%" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="57%" align="left">TOTAL A PAGAR </td>
                          <td width="43%"><? echo number_format($total,2); ?></td>
                        </tr>
                          <tr>
                            <td align="left">PAGO A LA FECHA </td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="left">SALDO A PAGAR </td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr align="center">
                      <td><br /><br />
                        ________________________<br />
                        RECIBIDO</td>
                      <td><br /><br />
                        ________________________<br />
                        APROBADO</td>
                      <td><br /><br />
                        ________________________<br />
                        ESTUDIANTE/REPRESENTANTE</td>
                    </tr>
                    <tr align="center">
                      <td colspan="3" class="style2"><hr />
                          </HR>
						  ORIGINAL CLIENTE * COPIA 1:EMISOR * COPIA 2,3 Y 4: SIN DERECHO A CREDITO TRIBUTARIO - ARCHIVO <BR>
                        &quot;LA UNIVERSIDAD DEL PACIFICO NO ES SUJETO DE RETENCI&Oacute;N DE IMPUESTO A LA RENTA NI DEL I.V.A&quot;</td>
                    </tr>
                </table></th>
              </tr>
            </table></td>
            <td><table width="90%" align="right"  >
              <tr bgcolor="#FFFFFF">
                <td width="27%"  rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg"  width="115" height="49" /></td>
                <th width="56%" colspan="2" align="left" class="style1">Universidad del Pac&iacute;fico - Escuela de Negocios </th>
                <th width="17%" rowspan="3" align="center" class="style3">CONTRIBUYENTE <br />
                  ESPECIAL RESOLUCI&Oacute;N <br />
                  N&ordm; 636 del 29/12/2005<br />
                  FACTURA </th>
              </tr>
              <tr>
                <th colspan="2" align="left" class="style1">R.U.C.: <? echo $resultEmpresa->fields['RUC_EMP']; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="left"  class="style1">SEDE <? echo $resultSede->fields['NOMBRE_SUC']; ?>: </th>
              </tr>
              <tr>
                <th align="left"  class="style2"><? echo $resultSede->fields['DIRECCION_SUC']."<br> Telf:".$resultSede->fields['TELEFONO_SUC']."/".$resultSede->fields['TELEFONO_SUC2']."Fax:".$resultSede->fields['FAX_SUC']."<br> Email:".$resultEmpresa->fields['EMAIL_EMP']."<br>".$resultEmpresa->fields['WEB_EMP']; ?></th>
                <th align="center"  class="style2" nowrap="nowrap">S&nbsp;<? echo $resultSede->fields['SECUENCIALSUCURSAL_SDO']."-".$resultSede->fields['SECUENCIALACTIVIDAD_SDO']; ?> </th>
                <th align="center" class="style1">N&ordm;.&nbsp;<? echo $numerofactura; ?></th>
              </tr>
              <tr>
                <th colspan="2" align="center"  class="style2"><span class="style1"><? echo $resultSede->fields['NOMBRE_SUC']." - ECUADOR"; ?></span></th>
                <th width="17%" align="left" class="style3">AUT.S.R.I.:&nbsp;<? echo $resultSede->fields['AUTORIZACIONSRI_SDO']; ?></th>
              </tr>
              <tr >
                <th colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                          <tr>
                            <td width="12%" align="left" class="style3">Programa:</td>
                            <td width="46%" align="left" class="style2"><? echo $resultSede->fields['nombre_maa']; ?></td>
                            <td width="19%" align="left" class="style3">C&oacute;digo:</td>
                            <td width="23%" align="left" class="style2"><? echo $resultSede->fields['codigo_alu']; ?></td>
                          </tr>
                          <tr>
                            <td align="left" class="style3">Cliente:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['cliente_caf']; ?></td>
                            <td align="left" class="style3">R.U.C./C.I.:</td>
                            <td align="left" class="style2"><? echo $resultSede->fields['cedula_caf']; ?></td>
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
                            <td  align="left" class="style3">Ing.Caja N&ordm;: </td>
                            <td align="left" class="style2"><? echo $numero_caja; ?></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="57%" class="style3">CONCEPTO</td>
                      <td width="13%" class="style3">CREDITOS</td>
                      <td width="16%" class="style3">VALOR UNITARIO </td>
                      <td width="14%" class="style3">VALOR TOTAL </td>
                    </tr>
                    <? 
					
					$baseimponible=0;
					$descuentos=0;
			  $cont=0;
			  $resultSetFactura->MoveFirst();
			 while(!$resultSetFactura->EOF ){
			   ?>
                    <tr>
                      <td align="left" class="style2"><? echo $resultSetFactura->fields['nombre_ara']; ?></td>
                      <td class="style2"><? echo $resultSetFactura->fields['cantidad_dfa']; ?></td>
                      <td class="style2"><? echo number_format($resultSetFactura->fields['valor_aal'],2); ?></td>
                      <td align="right" class="style2"><? echo number_format($resultSetFactura->fields[4],2); ?></td>
                    </tr>
                    <?
			  $totalgeneral+=$resultSetFactura->fields[4];
			  $subtotalgeneral+=$resultSetFactura->fields[4];
			
			$baseimponible+=$resultSetFactura->fields[4];
			$descuentos+=$resultSetFactura->fields['descuento_dfa'];
						
			$cont++;
			
			$resultSetFactura->MoveNext();
    }
	
	//$total=number_format($baseimponible-$descuentos,2);
	$total=$baseimponible+$descuentos;
			while($cont<=15){
			  ?>
                    <tr>
                      <td align="left" class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                      <td class="style2">&nbsp;</td>
                    </tr>
                    <? $cont++; }?>
                    <tr>
                      <td rowspan="4" align="left" valign="top" class="style3">Son: <? echo numerosDecimal($total);?> USD</td>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL 0% </td>
                      <td align="right" class="style2"><? echo number_format($baseimponible,2); ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">DESCUENTO</td>
                      <td align="right" class="style2"><? echo number_format($descuentos,2); ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">SUBTOTAL</td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                    <tr>
                      <td rowspan="2" class="style4" align="left">Debo y pagar&eacute; sin protesto el valor constante en esa factura. En caso de mora reconocer&eacute; el porcentaje anual del inter&eacute;s comercial vigente a la fecha de emisi&oacute;n de la misma. renuncio domicilio y me someto al tramite legal correspondiente. </td>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">I.V.A. 12% </td>
                      <td align="right" class="style2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left" class="style2">VALOR TOTAL </td>
                      <td align="right" class="style2"><? echo number_format($total,2); ?></td>
                    </tr>
                </table></th>
              </tr>
              <tr  class="style2">
                <th colspan="4"><table width="100%" border="0">
                    <tr align="center">
                      <td><br /><br />
                        ________________________<br />
                        RECIBIDO</td>
                      <td><br /><br />
                        ________________________<br />
                        APROBADO</td>
                      <td><br /><br />
                        ________________________<br />
                        ESTUDIANTE/REPRESENTANTE</td>
                    </tr>
                    <tr align="center">
                      <td colspan="3" class="style2"><hr />
                          </HR>
                          ORIGINAL CLIENTE * COPIA 1:EMISOR * COPIA 2,3 Y 4: SIN DERECHO A CREDITO TRIBUTARIO - ARCHIVO <BR>
                          &quot;LA UNIVERSIDAD DEL PACIFICO NO ES SUJETO DE RETENCI&Oacute;N DE IMPUESTO A LA RENTA NI DEL I.V.A&quot;</td>
                    </tr>
                </table></th>
              </tr>
            </table></td>
          </tr>
        </table>
		<br><br>
		

</body>
</html>