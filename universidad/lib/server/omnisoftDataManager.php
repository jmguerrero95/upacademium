<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {

  global  $HTTP_POST_VARS;

   $query = $HTTP_POST_VARS['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $serial_id=0;


    $dblink->Execute($query);
     $resultData=$dblink->ErrorMsg()."|";
    if (stripos($query,'into')!=false)
    $serial_id=$dblink->Insert_ID();

    $resultData=$resultData.$serial_id."|";

    echo $resultData;
}

omnisoftExecuteUpdate();
?>
