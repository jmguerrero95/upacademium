<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftLeerPeriodoContable($dblink,$fecha_com) {
  $SQLCommand="select serial_per from periodocontable where estado_per<>'C' and YEAR(inicio_per)=YEAR('".$fecha_com."') and MONTH(inicio_per)=MONTH('".$fecha_com."')";
  $rs=$dblink->Execute($SQLCommand);
//echo $SQLCommand;
 if ($rs->EOF || $rs->RecordCount()<=0)
     $serial_pco=0;
 else $serial_pco=$rs->fields[0];
 return $serial_pco;
}

function omnisoftLeerSecuenciaComprobante($dblink,$fecha_com,$serial_tic,$serial_age){

 $sqlCommand="select max(numero_com) from comprobante where serial_tic=".$serial_tic." and YEAR(fecha_com)=YEAR('".$fecha_com."') and MONTH(fecha_com)=MONTH('".$fecha_com."') AND serial_age=\"$serial_age\"";
 echo $sqlCommand;
 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     $numero_com=1;
 else $numero_com=$rs->fields[0]+1;

  $afecha=explode('-',$fecha_com);
  $sfecha= mktime(0, 0, 0, $afecha[1]  , $afecha[2], $afecha[0]);
  $dia=date('w',$sfecha)+2;

 $codigo_com=date("y",$sfecha).date("m",$sfecha).sprintf("%05d",$numero_com);

 return Array($numero_com,$codigo_com);
}

function omnisoftLeerParametro($dblink,$parametro){

 $sqlCommand="select valor_pag from parametros where codigo_pag='".$parametro."'";
 //echo $sqlCommand."<br>";
 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     $valor="";
 else $valor=$rs->fields[0];

 return $valor;
}

function omnisoftLeerSerialCuentaContable($dblink,$codigo_plc){

 $sqlCommand="select serial_plc from plancontable where codigo_plc='".$codigo_plc."'";
 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     $valor=0;
 else $valor=$rs->fields[0];

 return $valor;
}

function omnisoftLeerSerialTipoComprobante($dblink,$codigo_tic){

 $sqlCommand="select serial_tic from tipocomprobante where codigo_tic='".$codigo_tic."'";
// echo $sqlCommand."<br>";
 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     $valor=0;
 else $valor=$rs->fields[0];

 return $valor;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function leerSecuenciaTipoComprobante($dblink,$tipo) {

   $SQLSecuencia="select numero_tic from tipocomprobante where serial_tic=".$tipo;
   $rsSecuencia=$dblink->Execute($SQLSecuencia);
   $resultado=(!$rsSecuencia || $rsSecuencia->RecordCount()<=0)? 1 : $rsSecuencia->fields[0]+1;
   return $resultado;
}


function actualizarSecuenciaTipoComprobante($dblink,$tipo,$numero_tic) {

   $SQLSecuencia="update tipocomprobante set numero_tic=".$numero_tic." where serial_tic=".$tipo;
   //echo $SQLSecuencia;
   $dblink->Execute($SQLSecuencia);

   return (strlen($dblink->ErrorMsg())<=0);

}


function insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$monto_com,$estado_com,$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,$modulo) {


   $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,usuario_com,serial_tic,modulo_com,serial_age,codigo_com,numero_com,serial_per) values (0,'".$fecha_com."','" .$concepto_com."',".$monto_com.",'".$estado_com."',".$serial_usr.",".$serial_tic.",'".$modulo."',".$serial_age.",'".$codigo_com."',".$numero_com.",".$serial_per.")";
  //echo $SQLCommand."<br>";

  

   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();

}


function insertarDetalleComprobante($dblink,$serial_com,$serial_plc,$debe,$haber,$descripcion,$referencia,$serial_dep) {

   //$serial_desc=(strlen($_COOKIE['serial_desc'])>0)? $_COOKIE['serial_desc']:1;
   //$serial_desc=1;
   $SQLCommand="insert into detallecomprobante (serial_det, serial_plc, serial_com, debe_det, haber_det, descripcion_det, referencia_det, serial_dep) values (0,'" .$serial_plc."','".$serial_com."',".$debe.",".$haber.",'".$descripcion."','".$referencia."',".$serial_dep.")";
  echo $SQLCommand."<br>";
   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

function omnisoftLeerTotalFacturaCompraServicios($dblink,$serial_facc) {
 $sqlCommand="select sum(costo_dodc*(1-DESCUENTOPORCENTAJE_DODC)*CANTIDADRECIBIDAUNIDADES_DODC) as costo,grabaIva_dodc from detalleordendecompra where serial_facc=".$serial_facc." group by grabaIva_dodc order by grabaIva_dodc";
 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     return Array(0,0,0);

 if ($rs->RecordCount() <2) {
 $totaliva0=($rs->fields[1]=="NO")? $rs->fields[0]:0;
 $totaliva12=($rs->fields[1]=="SI")? $rs->fields[0]:0;
 $iva12=($rs->fields[1]=="SI")? $rs->fields[0]*omnisoftLeerParametro($dblink,"IVA"):0;

 }
 else {
        $totaliva0=$rs->fields[0];
        $rs->MoveNext();
        $totaliva12=$rs->fields[0];
        $iva12=$totaliva12*omnisoftLeerParametro($dblink,"IVA");
 }
 return Array($totaliva12+$totaliva0,$totaliva12,$totaliva0,$iva12);

}

function omnisoftLeerTotalFacturasVentaPeriodo($dblink,$fechaInicio,$fechaFin){

 $sqlCommand="select sum(total_dorp-valoriva12_dorp) as valor, sum(valoriva12_dorp) as iva from ordenpedido,detalleordenpedido where detalleordenpedido.serial_orp=ordenpedido.serial_orp and estado_orp='FACTURADO' and fecha_orp >='".$fechaInicio."' and fecha_orp <='".$fechaFin."'";

// echo $sqlCommand."<br>";

 $rs=$dblink->Execute($sqlCommand);

 if ($rs->EOF || $rs->RecordCount()<=0)
     return Array(0,0,0,0);

        $total=$rs->fields[0];
        $totaliva12=$rs->fields[1];
        $iva=
        $base12=(($totaliva12*100)/omnisoftLeerParametro($dblink,"IVA"))/100;
        //echo "totaiva=$totaliva12- base 12=$base12 <br>";
        $base0=$total-$base12;

 return Array($total,$totaliva12,$base12,$base0);


}
/*
function omnisoftActualizarEstadoFacturasVentaPeriodo($dblink,$fechaInicio,$fechaFin){
 $sqlCommand="update ordenpedido set estado_orp='CONTABILIZADA' where estado_orp='FACTURADO' and fecha_orp >='".$fechaInicio."' and fecha_orp <='".$fechaFin."'";
// echo $sqlCommand."<br>";
 $dblink->Execute($sqlCommand);
}
*/
?>