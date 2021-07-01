<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {

  global  $_POST;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $serial_id=0;
   $params=explode('|',$query);

   $SQLCmd="select * from comisiones where fecha_cms>='".$params[2]."' and  fecha_cms <='".$params[3]."'";
   //echo $SQLCmd;
   $resultSet=$dblink->Execute($SQLCmd);

   if ($resultSet->RecordCount() >0)   {

    $SQLCmd="delete from detallecomisiones where serial_cms in (select serial_cms from comisiones where fecha_cms>='".$params[2]."' and  fecha_cms <='".$params[3]."')";
    $dblink->Execute($SQLCmd);

    $SQLCmd="delete from comisiones where fecha_cms>='".$params[2]."' and  fecha_cms <='".$params[3]."'";
    $dblink->Execute($SQLCmd);

   }

    $SQLCmd="insert into comisiones (SERIAL_CMS, NUMERO_CMS, FECHA_CMS, FECHAINICIO_CMS, FECHAFIN_CMS) values (0,'".$params[1]."','".$params[0]."','".$params[2]."','" .$params[3]."')";
//    echo $SQLCmd. "<br>";

    $dblink->Execute($SQLCmd);
    $serial_cms=$dblink->Insert_ID();

    $SQLCmd="select cobrador_rut,sum(valor_lpr*comision_cop*(@unidades:=if(cantidad_dorp is NULL or cantidad_dorp=0,if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp=0,cantidadunidades_dorp,cantidaddespachar_dorp),cantidad_dorp*unidadesembalaje_prd))) as comision from cliente,clienteruta,clientesucursal,producto,ruta,tablacomisionesproducto,ordenpedido,detalleordenpedido,listaprecios where clienteruta.serial_scl=clientesucursal.serial_scl and ruta.serial_rut=clienteruta.serial_rut and clientesucursal.serial_cli=cliente.serial_cli and  tablacomisionesproducto.serial_tip=cliente.serial_tip and detalleordenpedido.serial_orp=ordenpedido.serial_orp and producto.serial_prd=detalleordenpedido.serial_prd and ordenpedido.cobrador_orp=ruta.cobrador_rut and detalleordenpedido.serial_prd=tablacomisionesproducto.serial_prd and listaprecios.serial_prd=tablacomisionesproducto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and ordenpedido.estado_orp='FACTURADO' and ordenpedido.fecha_orp>='".$params[2]."' and ordenpedido.fecha_orp <='".$params[3]."' group by cobrador_rut";
    $resultSet=$dblink->Execute($SQLCmd);

    while (!$resultSet->EOF ) {


    $SQLCmd="insert into detallecomisiones (SERIAL_DCO, SERIAL_CMS, COBRADOR_DCO, COMISION_DCO) values (0,".$serial_cms.",'".$resultSet->fields[0]."',".$resultSet->fields[1].")";
//    echo $SQLCmd;
    $dblink->Execute($SQLCmd);
      $resultSet->MoveNext();
    }


    echo $serial_cms;
}

omnisoftExecuteUpdate();
?>
