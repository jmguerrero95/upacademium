<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftSecuenciaDocumentos.php');
function omnisoftConnectDB() {
	global $DBConnection;
	
	$dblink = NewADOConnection($DBConnection);
	
	return $dblink;
}

/*function leerSecuenciaDocumentos($dblink,$serial_suc,$serial_tic) {

 $SQLCmd="select SERIAL_SDO, SERIAL_TIC, SERIAL_SUC, AUTORIZASRI_SDO, NUMERO_SDO, TALONARIODESDE_SDO, TALONARIOHASTA_SDO, FECHACADUCIDAD_SDO, AUTORIZACIONSRI_SDO, concat_ws('-',SECUENCIALSUCURSAL_SDO, SECUENCIALACTIVIDAD_SDO) serie, COPIASAUTORIZADAS_SDO, ESTADO_SDO, STOCKMINIMO_SDO from secuenciaDocumentos where serial_tic=".$serial_tic ." and serial_suc=".$serial_suc." and fechaCaducidad_sdo>=CURRENT_DATE and estado_sdo='ACTIVO'";
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

}*/


function omnisoftExecuteUpdate() {
   global $serial_tic;
   
   $serial_tic=10;

  $query = $_POST['query'];
	//$query = $_GET['query'];


   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_caf=($params[0]=='')?0:$params[0];

   if ($serial_caf>0) {

	//VERIFICA QUE ESTE GUARDADO EL RECIBO DE COBRO 
		$rsNumRecibo= $dblink->Execute("select fechacaducidad_caf from cabecerafactura where serial_caf=".$serial_caf);
	 	if ($rsNumRecibo->RecordCount()>0){
			if($rsNumRecibo->fields['fechacaducidad_caf']!='0000-00-00'){
					$SQLCmd="update cabecerafactura  set  serial_suc=".$params[7].",  total_caf=(select sum(valor_dar*cantidad_dfa) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_alu='".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."',   serial_dep='".$params[5]."',estado_caf='".$params[6]."' ,tipo_caf='FAC' where serial_caf=".$serial_caf;
	//echo $SQLCmd;
	}
    else    {
          $numero_caf=leerSecuenciaDocumentos($dblink,$params[7],$serial_tic);
          $SQLCmd="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$params[7]." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag='FACTURAVENTA'";
         // echo $SQLCmd;
    $dblink->Execute($SQLCmd);
	//echo "numero:".$numero_caf[3]->fields['FECHACADUCIDAD_SDO'];
    if ($numero_caf[0]==0) {
       echo $numero_caf[1]."|0|";
       return;
    }

    $SQLCmd="update cabecerafactura  set   serial_suc=".$params[7].", total_caf=(select sum(valor_dar*cantidad_dfa) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_alu='".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."', numero_caf='".$numero_caf[0]."',  serial_dep='".$params[5]."',estado_caf='".$params[6]."' ,fechacaducidad_caf='".$numero_caf[3]->fields['FECHACADUCIDAD_SDO']."' ,autorizacion_caf='".$numero_caf[3]->fields['AUTORIZACIONSRI_SDO']."' , serie_caf='".$numero_caf[3]->fields['serie']."' , tipo_caf='FAC' where serial_caf=".$serial_caf;
	//echo "</p> cabecera factura:  ".$SQLCmd;
    }
//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
   }

   $SQLSelect=" SELECT if( porcentaje_dde IS NULL , 1, porcentaje_dde ),detalle_descuento.serial_caa FROM detalle_descuento, detallefactura WHERE detalle_descuento.serial_caa =".$params[10]. "  AND detalle_descuento.serial_dar = detallefactura.serial_dar AND detallefactura.serial_caf = ".$params[0];
  //echo "</p> aranceles:  ".$SQLSelect."<br>";

  
   $rsDescuento= $dblink->Execute($SQLSelect);
$descuento=0;
$serial_caa=0;
if(!empty($rsDescuento->fields[0])) $descuento="if (credito_ara = 'SI',(1-".$rsDescuento->fields[0]."),0)";
if(!empty($rsDescuento->fields[1])) $serial_caa=$rsDescuento->fields[1];

$params[11]=trim($params[11]);
$params[12]=trim($params[12]);
if(!empty($params[11])) $cliente="'".$params[11]."'";
	else $cliente=" concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) ";
if(!empty($params[12])) $cedula="'".$params[12]."'";
	else $cedula=" codigoIdentificacion_alu ";	
  
   $SQLCmd="update aranceles,cabecerafactura,detallefactura,detallearancel,alumno set detallefactura.serial_plc=detallearancel.serial_plcfd, detallefactura.serial_plce=detallearancel.serial_plcfh, valor_aal=valor_dar,valorajuste_aal=".$descuento.",descuento_dfa=-(valor_dar*cantidad_dfa*".$descuento."),detallefactura.serial_caa=  if (credito_ara = 'SI',".$serial_caa.",0),cliente_caf=".$cliente.",cedula_caf=".$cedula." where aranceles.serial_ara=detallearancel.serial_ara and detallearancel.serial_dar=detallefactura.serial_dar and alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf=detallefactura.serial_caf and detallefactura.serial_caf=".$serial_caf;
   // echo $SQLCmd;
  //echo "</p> aranceles 2:  ".$SQLCmd."</p>";
    $dblink->Execute($SQLCmd);
	
	//ACTUALIZA EL TOTAL DE LA FACTURA SI EXISTE ALGUN DESCUENTO
	if(!empty($rsDescuento->fields[0])){	
		$SQLCmd="update cabecerafactura  set  total_caf=(total_caf+(select sum(descuento_dfa) from detallefactura  where  detallefactura.serial_caf=".$serial_caf."))  where serial_caf=".$serial_caf;
	   // echo $SQLCmd;
	  //echo "</p> aranceles 2:  ".$SQLCmd."</p>";
		$dblink->Execute($SQLCmd);
	}

    echo  "|".$serial_caf."|".$numero_caf[2];
}
}
omnisoftExecuteUpdate();
?>
