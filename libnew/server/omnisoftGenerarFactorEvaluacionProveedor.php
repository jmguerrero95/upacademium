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

   if ($params[0]==0) {

//       $SQLCmd="insert into calificacionproveedor (SERIAL_CPVD, SERIAL_PVD, SERIAL_NIVCP, FECHA_CPVD, CREADOPOR_CPVD, COMENTARIO_CPVD, TOTAL_CPVD,SERIAL_TEP) values (0,'".$params[2]."','".$params[3]."','".$params[1]."','" .$_COOKIE['serial_usr']."','".$params[4]."',0,".$params[6].")";
       $SQLCmd="insert into calificacionproveedor (SERIAL_CPVD, SERIAL_PVD, SERIAL_NIVCP, FECHA_CPVD, CREADOPOR_CPVD, COMENTARIO_CPVD, TOTAL_CPVD,SERIAL_TEP) values (0,'".$params[3]."','".$params[2]."','".$params[1]."','1','".$params[4]."',0,".$params[6].")";
 //echo $SQLCmd;  
       $dblink->Execute($SQLCmd);
       $serial_cpvd=$dblink->Insert_ID();


   }
   else $serial_cpvd=$params[0];


   $SQLCmd="select serial_ptp from puntosproveedor where serial_tep=".$params[6];
 //  echo $SQLCmd;
   $resultSet=$dblink->Execute($SQLCmd);

    while (!$resultSet->EOF ) {


    $SQLCmd="insert into detallecalificacionproveedor (SERIAL_DCP,SERIAL_PTP, SERIAL_CPVD, VALOR_DCP) values (0,".$resultSet->fields[0].",".$serial_cpvd.",0)";
//    echo $SQLCmd."<br>";
    $dblink->Execute($SQLCmd);
      $resultSet->MoveNext();
    }


    echo $serial_cpvd;

    }

omnisoftExecuteUpdate();
?>
