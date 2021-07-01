<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {


   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $serial_id=0;
   $params=explode('|',$query);
   $sfecha=explode('-',$params[0]);


   $SQLCmd="select * from producto where serial_pvd=".$params[4];
   $rsProducto=$dblink->Execute($SQLCmd);

   $SQLCmd="select serial_odc from ordendecompra where numeroDocumento_odc=".$params[1];
   $rsOrdenCompra=$dblink->Execute($SQLCmd);

   if ($rsOrdenCompra->RecordCount() >0)   {

    $SQLCmd="delete from detalleordendecompra where serial_odc = ".$rsOrdenCompra->fields[0];
    $dblink->Execute($SQLCmd);

    //$SQLCmd="delete from ordendecompra where serial_odc=".$rsOrdenCompra->fields[0];
   // $dblink->Execute($SQLCmd);

    $SQLCmd="update ordendecompra  set    FECHA_ODC='".$params[0]."', FECHAENTREGA_ODC='".$params[2]."', OBSERVACIONES_ODC='".$params[9]."', ESTADO_ODC='".$params[8]."', MODIFICADOPOR_ODC=".$_COOKIE['serial_usr'].",  serial_pvd=".$params[4].", plazoDias_odc=".$params[3].",diasReposicion_odc=".$params[7].",fechaInicio_odc='".$params[5]."',fechaFin_odc='".$params[6]."' where serial_odc=".$rsOrdenCompra->fields[0];
   //echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
    $serial_odc=$rsOrdenCompra->fields[0];
   }

   else {
    $SQLCmd="insert into ordendecompra (SERIAL_ODC, SERIAL_FORP, NUMERODOCUMENTO_ODC, TIPOORDENCOMPRA_ODC, FECHA_ODC, TOTAL_ODC, FECHAENTREGA_ODC, OBSERVACIONES_ODC, ESTADO_ODC, ELABORADOPOR_ODC,  serial_pvd, plazoDias_odc,diasReposicion_odc,fechaInicio_odc,fechaFin_odc)
     values (0,1,'".$params[1]."','KARDEX','" .$params[0]."',0,'".$params[2]."','".$params[9]."','".$params[8]."','".$_COOKIE['serial_usr']."','".$params[4]."','".$params[3]."','".$params[7]."','".$params[5]."','".$params[6]."')";
    //echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
    $serial_odc=$dblink->Insert_ID();


   }
  //  echo "serial_odc=".$serial_odc."<br>";
    $SQLCmd="select * from producto where estado_prd='ACTIVO' and serial_pvd=".$params[4];
    $rsProducto=$dblink->Execute($SQLCmd);
    $stockActual=$diasStock=0;
    $promedioVentas=0;
    while (!$rsProducto->EOF ) {
    $stockActual=$rsProducto->fields['STOCKACTUAL_PRD'];
    $SQLCmd="select * from ingresoegresobodega,detalleingresoegresobodega where fecha_ieb>='".$params[0]. " and  fecha_ieb <='".$params[1]." and detalleingresoegresobodega.serial_ieb=ingresoegresobodega.serial_ieb and producto_dieb=".$rsProducto->fields['SERIAL_PRD'];
    $rsIEB=$dblink->Execute($SQLCmd);

//     if (!$rsIEB) {
         $SQLCmd="insert into detalleordendecompra (SERIAL_DODC, SERIAL_PRD, SERIAL_ODC, OTROSPRODUCTOS_DODC, COSTO_DODC, CANTIDADREQUERIDA_DODC, SUBTOTAL_DODC, DESCUENTODOLARES_DODC, DESCUENTOPORCENTAJE_DODC, IVA_DODC, IVA0_DODC, TOTAL_DODC, OBSERVACIONES_DODC, ESTADO_DODC, CANTIDADRECIBIDA_DODC, CANTIDADSUGERIDA_DODC,STOCKACTUAL_DODC,DIASSTOCK_DODC,PROMEDIOVENTAS_DODC) values
            (0,'".$rsProducto->fields['SERIAL_PRD']."','".$serial_odc."',' ','".$rsProducto->fields['COSTOUNITARIO_PRD']."',0,0,0,0,0,0,0,0,' ','GENERADO','".$rsProducto->fields['STOCKMINIMO_PRD']."',".$stockActual.",".$diasStock.",".$promedioVentas.")";

          $dblink->Execute($SQLCmd);

        //echo $SQLCmd."<br>";


  //   }


     $rsProducto->MoveNext();
    }


    echo $serial_odc."|";
}

omnisoftExecuteUpdate();
?>
