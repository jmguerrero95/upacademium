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
   $params=explode('|',$query);
   $serial_orp=($params[0]=='')?0:$params[0];

  //echo "serial_orp=$serial_orp<br>";


   if ($serial_orp>0) {

    $SQLCmd="update ordenpedido  set    FECHA_ORP='".$params[2]."',numero_orp='".$params[3]."', numerofactura_orp='".$params[4]."', serial_cli='".$params[5]."', ordencliente_orp='".$params[6]."',  direccionentrega_orp='".$params[7]."', fechapago_orp='".$params[8]."',vendedor_orp='".$params[9]."',estado_orp='".$params[10]."',cobrador_orp='".$params[11]."',serial_forc='".$params[12]."',nombre_orp='".$params[13]."',cedula_orp='".$params[14]."',observaciones_orp='".$params[15]."' where serial_orp=".$serial_orp;
    //echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
   }

   else {
    $SQLCmd="insert into ordenpedido (serial_orp,fecha_orp,numero_orp,numerofactura_orp,serial_cli,ordencliente_orp,direccionentrega_orp,fechapago_orp,vendedor_orp,estado_orp,cobrador_orp,serial_forc,nombre_orp,cedula_orp,observaciones_orp,tipocliente_orp) ";
    $SQLCmd.=" values (0,'".$params[2]."','" .$params[3]."','".$params[4]."','".$params[5]."','".$params[6]."','".$params[7]."','".$params[8]."','".$params[9]."','".$params[10]."','".$params[11]."','".$params[12]."','".$params[13]."','".$params[14]."','".$params[15]."','".$params[16]."')";
   // echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
    $serial_orp=$dblink->Insert_ID();


   }
   if (trim($params[16])=='EMPLEADO')
   $SQLCmd="select producto.serial_prd,valor_lpr from categoriaproducto,tipoproducto,producto,listaprecios,cliente where producto.serial_tpo=tipoproducto.serial_tpo and estado_prd='ACTIVO' and categoriaproducto.serial_cap=tipoproducto.serial_cap and tipoproducto.serial_cap=".$params[1]." and producto.serial_prd=listaprecios.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and stockactual_prd> 0 and cliente.razonSocial_cli='EMPLEADO'" ;
   else
   if (trim($params[16])=='PROVEEDOR')
   $SQLCmd="select producto.serial_prd,valor_lpr from categoriaproducto,tipoproducto,producto,listaprecios,cliente where producto.serial_tpo=tipoproducto.serial_tpo and estado_prd='ACTIVO' and categoriaproducto.serial_cap=tipoproducto.serial_cap and tipoproducto.serial_cap=".$params[1]." and producto.serial_prd=listaprecios.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and stockactual_prd> 0 and cliente.razonSocial_cli='PROVEEDOR'" ;
   else
   $SQLCmd="select producto.serial_prd,valor_lpr from categoriaproducto,tipoproducto,producto,listaprecios,cliente where producto.serial_tpo=tipoproducto.serial_tpo and estado_prd='ACTIVO' and categoriaproducto.serial_cap=tipoproducto.serial_cap and tipoproducto.serial_cap=".$params[1]." and producto.serial_prd=listaprecios.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and stockactual_prd> 0 and cliente.serial_cli=".$params[5] ;
     //     echo $SQLCmd."<br>";

   $rsProducto=$dblink->Execute($SQLCmd);

    while (!$rsProducto->EOF ) {

    $SQLCmd="select serial_dorp from detalleordenpedido where serial_orp=".$serial_orp. " and serial_prd=".$rsProducto->fields[0];
//          echo $SQLCmd."<br>";

    $rsDetalleOrdenPedido=$dblink->Execute($SQLCmd);

    if (!$rsDetalleOrdenPedido || $rsDetalleOrdenPedido->RecordCount() <=0) {

         $SQLCmd="insert into detalleordenpedido (SERIAL_DORP, SERIAL_PRD, SERIAL_ORP, CANTIDAD_DORP, PRECIOUNITARIO_DORP, ICE_DORP, DESCUENTODOLARES_DORP, DESCUENTOPORCENTAJE_DORP, VALORIVA12_DORP, VALORIVA0_DORP, TOTAL_DORP, COMISION_DORP, CANTIDADUNIDADES_DORP, CANTIDADSOLICITADA_DORP, CANTIDADDESPACHAR_DORP) values
            (0,'".$rsProducto->fields[0]."','".$serial_orp."','0','".$rsProducto->fields[1]."',0,0,0,0,0,0,0,0,0,0)";
   //       echo $SQLCmd."<br>";
          $dblink->Execute($SQLCmd);
    }
    else {
         $SQLCmd="update detalleordenpedido set  PRECIOUNITARIO_DORP=".$rsProducto->fields[1]." where serial_dorp=".$rsDetalleOrdenPedido->fields[0];
     //     echo $SQLCmd."<br>";

          $dblink->Execute($SQLCmd);
    }

     $rsProducto->MoveNext();
    }


    echo $serial_orp."|";
}

omnisoftExecuteUpdate();
?>
