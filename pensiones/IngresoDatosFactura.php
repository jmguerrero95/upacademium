<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftSecuenciaDocumentos.php');
function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);	
	return $dblink;
}

function datosInsertar(){

	global $serial_tic;
//	$query = $_POST['query'];
//	$query = $_GET['query'];

  $query = $_REQUEST['query'];
  
   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   	   $serial_alu=$params[0];	   
	   $serial_cliu=$params[1];
		$fecha_caf=$params[2];
		$estado_caf=$params[3];
		$numero_caf=$params[4];
		$total_caf=$params[5];
		$abono_caf=$params[6];
		$iva_caf=$params[7];
		$cliente_caf=$params[8];
		$cedula_caf=$params[9];
		$observaciones_caf=$params[10];
		$serial_dep=$params[11];
		$serial_ama=$params[12];
		$serial_per=$params[13];
		$serial_com=$params[14];
		$serial_suc=$params[15];
		$fechacaducidad_caf=$params[16];
		$autorizacion_caf=$params[17];
		$serie_caf=$params[18];
		$tipo_caf=$params[19];
		$documento_caf=$params[20];
		$actividad_caf=$params[21];
		$serial_mmat=$params[22];
		$fechaemision_caf=$params[23];
	
  //CONSULTA LA SECUANCIA DE LA FACTURA PARA INSERTAR EL NUMERO//
  $secuenciaDocumento = "SELECT    
							 SERIAL_SDO,
							(numero_sdo + 1) as numero
						FROM
							tipocomprobante,
							parametros,
							secuenciadocumentos 
						WHERE
							serial_suc = ".$serial_suc." AND
							tipocomprobante.serial_tic=secuenciadocumentos.serial_tic AND
							tipocomprobante.codigo_tic=parametros.valor_pag AND
							parametros.codigo_pag='".$tipo_caf."'"; 
   	//echo "</p>".$secuenciaDocumento;
				   
				   $retsecuenciaDocumento=$dblink->Execute($secuenciaDocumento);						   
				   $numero_fac = $retsecuenciaDocumento->fields['numero'];	
   
//INSERTA LA CABECERAFACTURA//

  $insertarPortomar = "insert into cabecerafactura (serial_alu, serial_cliu, fecha_caf, estado_caf, numero_caf, total_caf, abono_caf, iva_caf, cliente_caf, cedula_caf, observaciones_caf, serial_dep, serial_ama, serial_per, serial_com, serial_suc, fechacaducidad_caf, autorizacion_caf, serie_caf, tipo_caf, serial_mmat, fechaemision_caf ) 
  
  values(".$serial_alu.",".$serial_cliu.",'".$fecha_caf."','".$estado_caf."',".$numero_fac.",".$total_caf.",".$abono_caf.",".$iva_caf.",'".$cliente_caf."','".$cedula_caf."',".$observaciones_caf.",".$serial_dep.",".$serial_ama.",".$serial_per.",".$serial_com.",".$serial_suc.",'".$fechacaducidad_caf."', ".$autorizacion_caf.", ".$serie_caf.",'".$tipo_caf."',".$serial_mmat.",'".$fechaemision_caf."')"; 
   	
	
	
	$retInsertarPorTomar=$dblink->Execute($insertarPortomar);	
	
	
	//$id=$retInsertarPorTomar->Insert_ID();
	
	
//ACTUALIZA LA SECUANCIA//

	 $actualizarSecuencia="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$serial_suc." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag = '".$tipo_caf."'";	  
 
	$dblink->Execute($actualizarSecuencia);
	
//CONSULTA LA ULTIMA FACTURA PARA ENVIAR COMO PARAMETRO//

$serialFactura="SELECT
					serial_caf 
				FROM
					cabecerafactura 
				WHERE
					numero_caf = ".$numero_fac." AND
					serial_alu=".$serial_alu." AND
					fecha_caf = '".$fecha_caf."' AND
					tipo_caf LIKE 'FAC' AND
					serial_suc= ".$serial_suc." AND
					estado_caf <> 'ANULADO'";
					
  $retserialFactura=$dblink->Execute($serialFactura);						   
  $serial_caf = $retserialFactura->fields['serial_caf'];					
	
  
  echo $serial_caf;
}

datosInsertar();

?>
