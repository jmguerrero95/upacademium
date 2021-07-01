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
 // $query = $_GET['query'];


   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_cre=($params[0]=='')?0:$params[0];

   if ($serial_cre>0) {
		//VERIFICA QUE ESTE GUARDADO EL RECIBO DE COBRO 
		$rsNumRecibo= $dblink->Execute("select fechacaducidad_cre from cabecerarecibo where serial_cre=".$serial_cre);
	 	if ($rsNumRecibo->RecordCount()>0){
			if($rsNumRecibo->fields['fechacaducidad_cre']!='0000-00-00')
				$SQLCmd="update cabecerarecibo  set  valor_cre=(select sum(valor_dre) from detallerecibo  where serial_cre=".$serial_cre.") ,serial_alu='".$params[2]."' where serial_cre=".$serial_cre;	
			else{
			  $numero_caf=leerSecuenciaDocumentos($dblink,$params[3],$serial_tic);
          	  $SQLCmd="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$params[3]." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag='ING'";
        //  echo $SQLCmd;
			$dblink->Execute($SQLCmd);
			//echo "numero:".$numero_caf[3]->fields['FECHACADUCIDAD_SDO'];
			if ($numero_caf[0]==0) {
			   echo $numero_caf[1]."|0|";
			   return;
			}
		
			$SQLCmd="update cabecerarecibo  set  valor_cre=(select sum(valor_dre) from detallerecibo  where serial_cre=".$serial_cre.") ,serial_alu='".$params[2]."', numero_cre='".$numero_caf[0]."',fechacaducidad_cre='".$numero_caf[3]->fields['FECHACADUCIDAD_SDO']."'  where serial_cre=".$serial_cre;
			
			}
			    $dblink->Execute($SQLCmd);	
		}
	

  }

    echo  "|".$serial_cre."|".$numero_caf[0];
}

omnisoftExecuteUpdate();
?>
