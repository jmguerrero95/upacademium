<html>
<head>


</head>

<body background="../../images/bg_blue_v.jpg">
<form name="fImportar" method="post">
<table><tr>
<td>
Archivo:</td><td><input type="text" name="archivo" readonly  size=100></td>
</tr>
<tr><td>
Generando:</td>
<td><input type="text" name="mensaje" readonly size=100></td>
</table>

<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');



function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExportFile() {
  global  $_FILES,$_GET;


$dir_generacion=$_SERVER['DOCUMENT_ROOT'].'/salesianas/anexos/';

if (!is_dir($dir_generacion) && !@mkdir($dir_generacion,0755)) {
    echo "<script>document.fImportar.mensaje.value='Error: No se puede crear el directorio anexos para generar el anexo transaccional';</script>";
    return 0;
}


$archivo=$dir_generacion.'AT'.$_GET['serial_mes'].$_GET['serial_per'].'.xml';
echo "<script>document.fImportar.archivo.value='".$archivo."';</script>";

   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);

    if (!($fp = fopen($archivo, "w"))) {
   echo "<script>document.fImportar.mensaje.value='Error: No se puede crear el archivo:".$archivo."';</script>";

      return 0;
     }

     fwrite($fp,'<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>\r\n');
     echo "<script>document.fImportar.mensaje.value='Registros=".$numeroTotalRegistros_ctran."Monto=".$montoTotalCobranza_ctran."';</script>";

    $selectCmd="select sum(total_caf) as total,codigoIdentificacion_pad,count(codigoIdentificacion_pad) from cabecerafactura,paralelo_alumno,padres,padres_alumno  where padres_alumno.serial_alu=paralelo_alumno.serial_alu and padres.serial_pad=padres_alumno.serial_pad and paralelo_alumno.serial_paralu=cabecerafactura.serial_paralu and YEAR(fecha_caf)=".$_GET['serial_per'].' and MONTH(fecha_caf)='.$_GET['serial_mes']." group by codigoIdentificacion_pad";
//    echo $selectCmd;
    $rs=$dblink->Execute($selectCmd);

     while (!$rs->EOF) {
       //  echo "<script>document.fImportar.mensaje.value='TIPO DEBITO=".$TIPODEBITO_TRA.",VALOR DEBITADO=".$VALORDEBITO_TRA."';</script>";
         if (strlen($rs->fields[1])>10)
         $tipo="04";
         else $tipo="05";
         $cadena="<detalleVentas> <tpIdCliente>".$tipo."</tpIdCliente> <idCliente>".$rs->fields[1]."</idCliente> <tipoComprobante>18</tipoComprobante><numeroComprobantes>".$rs->fields[2]."</numeroComprobantes><baseNoGraIva>".$rs->fields[0]."</baseNoGraIva><baseImponible>0.00</baseImponible><baseImpGrav>0.00</baseImpGrav><montoIva>0.00</montoIva><valorRetIva>0.00</valorRetIva><valorRetRenta>0.00</valorRetRenta></detalleVentas>\r\n";
         fwrite($fp,$cadena);
         $rs->MoveNext();
     }

   fclose($fp);

 echo "<script>document.fImportar.mensaje.value='Generacion terminada por favor revise el archivo:".$archivo."';</script>";


  return 1;
}


  if (omnisoftExportFile()==1)
   echo "<script> alert('Generacion terminada exitosamente'); </script>";
  else
   echo "<script> alert('Errores en la generacion, por favor revise el archivo e intente nuevamente' ); </script>";




?>
			<center><div align="center" id="divGuardar" style="visibility:visible"><a href="#" onClick="javascript:window.close();"><img src="../../images/aceptar.gif" width="52" height="49" border="0" align="left"></a></div></center>
</form>
</body>
</html>
