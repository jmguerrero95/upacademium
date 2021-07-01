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
   $serial_caf=$query;

   $SQLCmd="UPDATE cabecerafactura SET total_caf=(SELECT sum(valor_aal) from detallefactura where serial_caf=".$serial_caf."), abono_caf = ( SELECT sum( valor_cre ) FROM cabecerarecibo WHERE serial_caf =".$serial_caf." ) , estado_caf = IF( abono_caf >= total_caf, 'PAGADA', IF(abono_caf=0 or abono_caf is NULL,'EMITIDA','ABONADA') ) WHERE serial_caf =".$serial_caf;
   $dblink->Execute($SQLCmd);

   echo $serial_caf."|";
}

omnisoftExecuteUpdate();
?>
