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


   if ($serial_orp>0) {

    $SQLCmd="update ordenpedido  set    FECHA_ORP='".$params[2]."',numero_orp='".$params[3]."', numerofactura_orp='".$params[4]."', serial_cli='".$params[5]."', ordencliente_orp='".$params[6]."',  direccionentrega_orp='".$params[7]."', fechapago_orp='".$params[8]."',vendedor_orp='".$params[9]."',estado_orp='".$params[10]."',cobrador_orp='".$params[11]."',serial_forc='".$params[12]."',nombre_orp='".$params[13]."',cedula_orp='".$params[14]."',observaciones_orp='".$params[15]."', tipocliente_orp='".$params[16]."' where serial_orp=".$serial_orp;
  //  echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
   }

   else {
    $SQLCmd="insert into ordenpedido (serial_orp,fecha_orp,numero_orp,numerofactura_orp,serial_cli,ordencliente_orp,direccionentrega_orp,fechapago_orp,vendedor_orp,estado_orp,cobrador_orp,serial_forc,nombre_orp,cedula_orp,observaciones_orp,tipocliente_orp) ";
    $SQLCmd.=" values (0,'".$params[2]."','" .$params[3]."','".$params[4]."','".$params[5]."','".$params[6]."','".$params[7]."','".$params[8]."','".$params[9]."','".$params[10]."','".$params[11]."','".$params[12]."','".$params[13]."','".$params[14]."','".$params[15]."','".$params[16]."')";
//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
    $serial_orp=$dblink->Insert_ID();
   }

   if ($params[16]=="EMPLEADO")
   $SQLCmd="update producto,cliente,listaprecios,detalleordenpedido set cantidadunidades_dorp=if(cantidad_dorp is NULL or cantidad_dorp=0,cantidadunidades_dorp,cantidad_dorp*unidadesembalaje_prd), cantidad_dorp=if(cantidad_dorp=NULL or cantidad_dorp=0,cantidadunidades_dorp/unidadesembalaje_prd,cantidad_dorp),stockactual_prd=stockactual_prd-cantidadunidades_dorp,cantidadcompensada_dorp=round(cantidadunidades_dorp*(select if(descuento_dca is NULL,0,descuento_dca) from cliente,descuentocanal where descuentocanal.serial_tpr=cliente.serial_tpr and descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd  and descuento_dca is NOT NULL) ,0), valoriva12_dorp=if (grabaiva_prd ='SI',0.12*cantidadunidades_dorp*preciounitario_dorp,0),descuentodolares_dorp=preciounitario_dorp*if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),total_dorp=preciounitario_dorp*(cantidadunidades_dorp+if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp))+valorIva12_dorp,cantidaddespachar_dorp=if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp =0,cantidadunidades_dorp+if (cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),cantidaddespachar_dorp) WHERE producto.serial_prd=detalleordenpedido.serial_prd and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and  cliente.razonSocial_cli='EMPLEADO' and detalleordenpedido.serial_orp=".$serial_orp;
   else  if ($params[16]=="PROVEEDOR")
   $SQLCmd="update producto,cliente,listaprecios,detalleordenpedido set cantidadunidades_dorp=if(cantidad_dorp is NULL or cantidad_dorp=0,cantidadunidades_dorp,cantidad_dorp*unidadesembalaje_prd), cantidad_dorp=if(cantidad_dorp=NULL or cantidad_dorp=0,cantidadunidades_dorp/unidadesembalaje_prd,cantidad_dorp),stockactual_prd=stockactual_prd-cantidadunidades_dorp,cantidadcompensada_dorp=round(cantidadunidades_dorp*(select if(descuento_dca is NULL,0,descuento_dca) from cliente,descuentocanal where descuentocanal.serial_tpr=cliente.serial_tpr and descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd  and descuento_dca is NOT NULL) ,0), valoriva12_dorp=if (grabaiva_prd ='SI',0.12*cantidadunidades_dorp*preciounitario_dorp,0),descuentodolares_dorp=preciounitario_dorp*if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),total_dorp=preciounitario_dorp*(cantidadunidades_dorp+if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp))+valorIva12_dorp,cantidaddespachar_dorp=if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp =0,cantidadunidades_dorp+if (cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),cantidaddespachar_dorp) WHERE producto.serial_prd=detalleordenpedido.serial_prd and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and  cliente.razonSocial_cli='PROVEEDOR' and detalleordenpedido.serial_orp=".$serial_orp;
   else
      $SQLCmd="update producto,cliente,listaprecios,detalleordenpedido set cantidadunidades_dorp=if(cantidad_dorp is NULL or cantidad_dorp=0,cantidadunidades_dorp,cantidad_dorp*unidadesembalaje_prd), cantidad_dorp=if(cantidad_dorp=NULL or cantidad_dorp=0,cantidadunidades_dorp/unidadesembalaje_prd,cantidad_dorp),stockactual_prd=stockactual_prd-cantidadunidades_dorp,cantidadcompensada_dorp=round(cantidadunidades_dorp*(select if(descuento_dca is NULL,0,descuento_dca) from cliente,descuentocanal where descuentocanal.serial_tpr=cliente.serial_tpr and descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd  and descuento_dca is NOT NULL) ,0), valoriva12_dorp=if (grabaiva_prd ='SI',0.12*cantidadunidades_dorp*preciounitario_dorp,0),descuentodolares_dorp=preciounitario_dorp*if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),total_dorp=preciounitario_dorp*(cantidadunidades_dorp+if(cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp))+valorIva12_dorp,cantidaddespachar_dorp=if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp =0,cantidadunidades_dorp+if (cantidadcompensada_dorp is NULL,0,cantidadcompensada_dorp),cantidaddespachar_dorp) WHERE producto.serial_prd=detalleordenpedido.serial_prd and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and  cliente.serial_cli=".$params[5]." and detalleordenpedido.serial_orp=".$serial_orp;


//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);

    $SQLCmd="update ordenpedido set subtotal_orp=(select sum(cantidadunidades_dorp*preciounitario_dorp) from detalleordenpedido where serial_orp=".$serial_orp."),sumaiva12_orp=(select sum(valoriva12_dorp) from detalleordenpedido where serial_orp=".$serial_orp."),sumaiva0_orp=(select sum(valoriva0_dorp) from detalleordenpedido where serial_orp=".$serial_orp."),total_orp=(select sum(total_dorp) from detalleordenpedido where serial_orp=".$serial_orp."),descuento_orp=(select sum(descuentodolares_dorp) from detalleordenpedido where serial_orp=".$serial_orp.") where serial_orp=".$serial_orp;
//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);

    echo  "|".$serial_orp."|";
}

omnisoftExecuteUpdate();
?>
