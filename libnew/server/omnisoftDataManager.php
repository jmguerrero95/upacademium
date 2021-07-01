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
   $aSQL=explode('|',$query);
   $serial_id=0;
   $i=1;

     $dblink->Execute($aSQL[0]);
     $resultData=$dblink->ErrorMsg()."|";
     if (strlen($dblink->ErrorMsg())>0) {
        echo "!".$dblink->ErrorMsg();
        return;
     }
    if (stripos($aSQL[0],'INTO')!=false)
        $serial_id=$dblink->Insert_ID();
    else if (count($aSQL)>1) {
          $serial_id=$aSQL[1];
          $i++;
    }
    //echo "arreglo[0]=".$aSQL[0]."<br>";

    for (; $i < count($aSQL);$i++)  {
         $aquery=str_replace( "MASTERKEY",$serial_id,$aSQL[$i]);
  //       echo "arreglo[$i]=".$aquery."<br>";
         $dblink->Execute($aquery);
    }

    $resultData=$resultData.$serial_id."|";

    echo $resultData;
}

omnisoftExecuteUpdate();
?>
