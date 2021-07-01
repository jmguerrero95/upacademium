<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

function leerSecuenciaDocumentos($dblink,$serial_suc,$serial_tic) {

 $SQLCmd="select SERIAL_SDO, SERIAL_TIC, SERIAL_SUC, AUTORIZASRI_SDO, NUMERO_SDO, TALONARIODESDE_SDO, TALONARIOHASTA_SDO, FECHACADUCIDAD_SDO, AUTORIZACIONSRI_SDO, concat_ws('-',SECUENCIALSUCURSAL_SDO, SECUENCIALACTIVIDAD_SDO) serie, COPIASAUTORIZADAS_SDO, ESTADO_SDO, STOCKMINIMO_SDO from secuenciaDocumentos where serial_tic=".$serial_tic." and serial_suc=".$serial_suc." and fechaCaducidad_sdo>=CURRENT_DATE and estado_sdo='ACTIVO'";
//echo $SQLCmd."<br>";

 $rs=$dblink->Execute($SQLCmd);

 if (!$rs && $rs->RecordCount() <=0)
     return Array(0,"Error: No existe secuencia definida! o la secuencia de facturacion esta caducada!");

 $numero_sdo=($rs->fields[4]+1<$rs->fields[5])?$rs->fields[5]:$rs->fields[4]+1;
 //echo $numero_sdo."<br>";
 if ($rs->fields[6]<$numero_sdo)
    return Array(0,"Error: Ya no existen facturas disponibles en el talonario!");

 $advertencia="";
 if ($rs->fields[13]>($rs->fields[6]-$numero_sdo))
    $advertencia="Advertencia: El numero de facturas disponibles esta bajo el stock minimo";

// $SQLCmd="update  secuenciaDocumentos  set numero_sdo=".$numero_sdo."+1 where serial_tic=".$serial_tic ." and serial_suc=".$serial_suc." and fechaCaducidad_sdo>=CURRENT_DATE and estado_sdo='ACTIVO'";
// echo $SQLCmd."<br>";

// $dblink->Execute($SQLCmd);

 return Array($numero_sdo,'',$advertencia,$rs);

}


function omnisoftExecuteUpdate() {
   global $serial_tic;
   
   $serial_tic=12;

  $query = $_POST['query'];
  //$query = $_GET['query'];
//echo $query;

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_caf=($params[0]=='')?0:$params[0];

   if ($serial_caf>0) {

/*for($i=0;$i<10;i++){
	echo "</p> I: ".$i;
	echo " -> ".$params[$i];
}*/

    if ($params[8]=="EDIT"){
	//AQUI ES PARA EDITAR
    $SQLCmd="update cabecerafactura  set  serial_suc=".$params[7].", total_caf=(select sum(valor_dar) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_caf='".$params[0]."',serial_alu='".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."',   serial_dep='".$params[5]."',estado_caf='".$params[6]."', documento_caf = ".$params[11]." where serial_caf=".$serial_caf;
	//echo $SQLCmd;
	}
    else    {
          $numero_caf=leerSecuenciaDocumentos($dblink,$params[7],$serial_tic);
          $SQLCmd="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$params[7]." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag='NOTACREDITO'";
          //echo $SQLCmd;
    $dblink->Execute($SQLCmd);
	//echo "numero:".$numero_caf[3]->fields['FECHACADUCIDAD_SDO'];
    if ($numero_caf[0]==0) {
       echo $numero_caf[1]."|0|";
       return;
    }
//AQUI ES PARA GUARDAR
    $SQLCmd="update cabecerafactura  set   serial_suc=".$params[7].", total_caf=(select sum(valor_dar) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_caf='".$params[0]."',serial_alu='	".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."', numero_caf='".$numero_caf[0]."',  serial_dep='".$params[5]."',estado_caf='".$params[6]."' ,fechacaducidad_caf='".$numero_caf[3]->fields['FECHACADUCIDAD_SDO']."' ,autorizacion_caf='".$numero_caf[3]->fields['AUTORIZACIONSRI_SDO']."' , serie_caf='".$numero_caf[3]->fields['serie']."' , tipo_caf='NC', documento_caf = ".$params[11]." where serial_caf=".$serial_caf;
	//echo "</p> cabecera factura:  ".$SQLCmd;
    }
//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
   }

   $SQLSelect=" SELECT if( porcentaje_dde IS NULL , 1, porcentaje_dde ),detalle_descuento.serial_caa FROM detalle_descuento, detallefactura WHERE detalle_descuento.serial_caa =".$params[10]. "  AND detalle_descuento.serial_dar = detallefactura.serial_dar AND detallefactura.serial_caf = ".$params[0];
  // echo "</p> aranceles:  ".$SQLSelect;

  
   $rsDescuento= $dblink->Execute($SQLSelect);

   $SQLCmd="update aranceles,detallefactura,detallearancel set detallefactura.serial_plc=detallearancel.serial_plcfd, detallefactura.serial_plce=detallearancel.serial_plcfh, valor_aal=(valor_dar * -1),valorajuste_aal=if (credito_ara = 'SI','1-".$rsDescuento->fields[0]."','0'),detallefactura.serial_caa=if (credito_ara = 'SI','".$rsDescuento->fields[1]."','0') where aranceles.serial_ara=detallearancel.serial_ara and detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf;
  //
  // echo $SQLCmd;
  //echo "</p> aranceles 2:  ".$SQLCmd."</p>";
    $dblink->Execute($SQLCmd);


    echo  "|".$serial_caf."|".$numero_caf[2];
}

omnisoftExecuteUpdate();
?>
