<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftContabilizar() {

  global  $_POST;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_com=0;
   $numero_com=22;
   $SQLCommand="select sum(costo_dodc*cantidadrecibidaunidades_dodc) from detalleordendecompra where serial_odc=".$params[3];
//   echo $SQLCommand;
   $rsMonto=$dblink->Execute($SQLCommand);
   $total=$rsMonto->fields[0];
   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
   $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,numero_com,serial_usr,serial_tic) values (0,'".$params[0]."','" .$params[1]."',".$total.",'AUTOMATICO',".$numero_com.",".$serial_usr.",".$params[2].")";

//     $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,numero_com,serial_usr,serial_tic) select 0,'".$params[0]."','" .$params[1]."',sum(costo_dodc*cantidadrecibida_dodc),'AUTOMATICO',".$numero_com.",".$_COOKIE['serial_usr'].",".$params[2]." from detalleordendecompra where serial_odc=".$params[3];


   $dblink->Execute($SQLCommand);

     $resultData=$dblink->ErrorMsg()."|";
     if (strlen($dblink->ErrorMsg())>0) {
        echo "!".$dblink->ErrorMsg();
        return;
     }
        $serial_com=$dblink->Insert_ID();
     $SQLCommand="select serial_plc,retencioniva_tpd,retencionirf_tpd from tipoproveedor,proveedor where tipoproveedor.serial_tpd=proveedor.serial_tpd and proveedor.serial_pvd=".$params[4];
   //  echo $SQLCommand."<br>";
     $rstipoProveedor=$dblink->Execute($SQLCommand);

     if (!$rstipoProveedor && $rstipoProveedor->RecordCount() <=0) {
        echo "!Error: El proveedor no tiene asignado tipo de retencion al IVA e IRF";
        return;
     }

     $SQLRIVA="select serial_plc,valor_imp,nombre_imp from impuestos where serial_imp=".$rstipoProveedor->fields[1];
     $rsRetencionIVA=$dblink->Execute($SQLRIVA);
     //echo $SQLRIVA;
     $cuentaRetencionIVA=$rsRetencionIVA->fields[0];

     $SQLRIRF="select serial_plc,valor_imp from impuestos where serial_imp=".$rstipoProveedor->fields[2];
     $rsRetencionIRF=$dblink->Execute($SQLRIRF);
     $totalRetencionIRF=($rsRetencionIRF->fields[1]*$total)/100;
     $cuentaRetencionIRF=$rsRetencionIRF->fields[0];

   // $serial_desc=(strlen($_COOKIE['serial_desc'])>0)? $_COOKIE['serial_desc']:15;
   $serial_desc=15;
    //CUENTA PROVISION PROVEEDORES
    $SQLCommand="insert into detallecomprobante values (0,".$serial_com.",".$rstipoProveedor->fields[0].",".$total.",0,'".$params[1]."','".$params[4]."',".$serial_desc.")";

   // echo $SQLCommand;
    $dblink->Execute($SQLCommand);

    $valorIVA12=$total*0.12;
     $totalRetencionIVA=($rsRetencionIVA->fields[1]*$valorIVA12)/100;

    // CUENTA IVA POR PAGAR 12%
    $cuentaIVA12=53;
    $SQLCommand="insert into detallecomprobante values (0,".$serial_com.",".$cuentaIVA12.",".$valorIVA12.",0,'".$params[1]."','".$params[4]."',".$serial_desc.")";

//    echo $SQLCommand;
    $dblink->Execute($SQLCommand);
    // CUENTA POR PAGAR PROVEEDORES%

    $cuentaxPagar=98;
    $valorxPagar=$valorIVA12+$total-$totalRetencionIVA-$totalRetencionIRF;
    $SQLCommand="insert into detallecomprobante values (0,".$serial_com.",".$cuentaxPagar.",0,".$valorxPagar.",'".$params[1]."','".$params[4]."',".$serial_desc.")";
    $dblink->Execute($SQLCommand);




    $SQLCommand="insert into detallecomprobante values (0,".$serial_com.",".$cuentaRetencionIVA.",0,".$totalRetencionIVA.",'".$params[1]."','".$params[4]."',".$serial_desc.")";
//    echo $SQLCommand;
       $dblink->Execute($SQLCommand);

    $SQLCommand="insert into detallecomprobante values (0,".$serial_com.",".$cuentaRetencionIRF.",0,".$totalRetencionIRF.",'".$params[1]."','".$params[4]."',".$serial_desc.")";
    $dblink->Execute($SQLCommand);
//    echo $SQLCommand;


    $resultData=$resultData.$serial_com."|";

    echo $resultData;
}

omnisoftContabilizar();
?>
