<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftSecuenciaDocumentos.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

function omnisoftExecuteUpdate() {
   global $serial_tic;
   
   $serial_tic=2;

  $query = $_POST['query'];
 //$query = $_GET['query'];


   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_cre=($params[0]=='')?0:$params[0];
   
   $serial_caf=($params[4]=='')?0:$params[4]; ///parametro  ala nota de credito que afecte.

   if ($serial_cre>0) {
		//VERIFICA QUE ESTE GUARDADO EL RECIBO DE COBRO 
		$rsNumRecibo= $dblink->Execute("select fechacaducidad_cre from cabecerarecibo where serial_cre=".$serial_cre);
	 	if ($rsNumRecibo->RecordCount()>0){
			if($rsNumRecibo->fields['fechacaducidad_cre']!='0000-00-00'){
				$SQLCmd="update cabecerarecibo  set  valor_cre=(select sum(valor_dre) from detallerecibo  where serial_cre=".$serial_cre.") ,serial_alu='".$params[2]."' where serial_cre=".$serial_cre;	
				}
			else{
			  $numero_caf=leerSecuenciaDocumentos($dblink,$params[3],$serial_tic);
          	  
			  $SQLCmd="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$params[3]." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag='ING'";
			  
        //  echo $SQLCmd;

			$dblink->Execute($SQLCmd);
			
			$dblink->Execute("update cierredia_control set estado_cdc = 'CERRADO' where serial_cdc = ".$params[5]);
			
			//echo "numero:".$numero_caf[3]->fields['FECHACADUCIDAD_SDO'];
			if ($numero_caf[0]==0) {
			   echo $numero_caf[1]."|0|";
			   
			   return;
			}		
			$SQLCmd="update cabecerarecibo  set  valor_cre=(select sum(valor_dre) from detallerecibo  where serial_cre=".$serial_cre.") ,serial_alu='".$params[2]."', numero_cre='".$numero_caf[0]."',fechacaducidad_cre='".$numero_caf[3]->fields['FECHACADUCIDAD_SDO']."'  where serial_cre=".$serial_cre;	

			
			if($serial_caf>0){
   		          $rsNotaCredito= $dblink->Execute("update cabecerafactura set actividad_caf = 'cerrada' where serial_caf = ".$serial_caf);		

				  //echo "</p>"."update cabecerafactura set actividad_caf = 'cerrada' where serial_caf = ".$serial_caf."</p>";		
   			}		
			}
			    $dblink->Execute($SQLCmd);	
		}	
  }
    echo  "|".$serial_cre."|".$numero_caf[0];
}
omnisoftExecuteUpdate();
?>