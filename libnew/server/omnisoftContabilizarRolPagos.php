<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function leerSecuenciaTipoComprobante($dblink,$tipo) {

   $SQLSecuencia="select numero_tic from tipocomprobante where serial_tic=".$tipo;
   //echo $SQLSecuencia."<br>";
   $rsSecuencia=$dblink->Execute($SQLSecuencia);
   $resultado=(!$rsSecuencia || $rsSecuencia->RecordCount()<=0)? 1 : $rsSecuencia->fields[0]+1;
   return $resultado;
}


function actualizarSecuenciaTipoComprobante($dblink,$tipo,$numero_tic) {

   $SQLSecuencia="update tipocomprobante set numero_tic=".$numero_tic." where serial_tic=".$tipo;
   //echo $SQLSecuencia."<br>";
   $dblink->Execute($SQLSecuencia);

   return (strlen($dblink->ErrorMsg())<=0);

}


function insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$monto_com,$estado_com,$numero_com,$serial_tic,$serial_usr) {


   $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,numero_com,serial_usr,serial_tic) values (0,'".$fecha_com."','" .$concepto_com."',".$monto_com.",'".$estado_com."',".$numero_com.",".$serial_usr.",".$serial_tic.")";
   //echo $SQLCommand."<br>";

   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();

}


function insertarDetalleComprobante($dblink,$serial_com,$serial_plc,$debe,$haber,$descripcion,$referencia) {


   $SQLCommand="insert into detallecomprobante values (0,'".$serial_com."','" .$serial_plc."',".$debe.",".$haber.",'".$descripcion."','".$referencia."',5)";

   //echo $SQLCommand."<br>";
   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
}


function omnisoftContabilizar() {

  global  $_POST,$omnisoftCOMPROBANTEROLPAGOS;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->StartTrans();

   $params=explode('|',$query);
   $fecha_com=$params[0];
   $concepto_com=$params[1];
   $serial_perrol=$params[2];


  $SQLCommand="SELECT serial_plc, sum( valor_drp ),nombre_rgr as rubro FROM rubrogeneralrolpagos, empleadorolpagos, detallerolpagos  WHERE empleadorolpagos.serial_erp = detallerolpagos.serial_erp  AND rubrogeneralrolpagos.serial_rgr = detallerolpagos.serial_rgr AND empleadorolpagos.serial_perrol =".$serial_perrol." GROUP BY serial_plc";


   //echo $SQLCommand."<sql>";
   $rsMonto=$dblink->Execute($SQLCommand);

   $total=$rsMonto->fields[1];

   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;

   $numero_com=leerSecuenciaTipoComprobante($dblink,$omnisoftCOMPROBANTEROLPAGOS);
   //echo "numero_com=".$numero_com."<br>";
   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$total,'AUTOMATICO',$numero_com,$omnisoftCOMPROBANTEROLPAGOS,$serial_usr);

   if ($serial_com==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;

   }

   if (!actualizarSecuenciaTipoComprobante($dblink,$omnisoftCOMPROBANTEROLPAGOS,$numero_com)) {
        echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";

        return;

   }

   while (!$rsMonto->EOF) {

      $serial_det=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields[0],$rsMonto->fields[1],0,$rsMonto->fields[2],$numero_com);

   if ($serial_det==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;
   }

   $rsMonto->MoveNext();


   }

      $dblink->CompleteTrans();

    $resultData=$resultData.$serial_com."|";

    echo $resultData;
}

omnisoftContabilizar();
?>
