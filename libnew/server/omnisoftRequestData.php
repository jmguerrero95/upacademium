<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');



function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteQuery() {
  global  $HTTP_POST_VARS;

   $query = $HTTP_POST_VARS['query'];
   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $recno=$HTTP_POST_VARS['startIndex'];
   $rows=$HTTP_POST_VARS['rowCount'];

   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);

       $end=$recno+$rows;

       $query.=" limit ".$recno.",".$end;
  $RecordSet=$dblink->Execute($query);

   $resultData="|";

  $RecordSet->MoveFirst();

  while (($recno < $end) && !$RecordSet->EOF) {

      $resultData .= join( $RecordSet->fields, '~') . "|";
      $RecordSet->MoveNext();
      $recno++;
  }
  echo $resultData;

}


  omnisoftExecuteQuery();




?>
