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

   $params=explode('|',$query);

   $dblink=omnisoftConnectDB();

   $sqlCmd="select serial_epl from usuario where serial_epl=".$params[0]." and clave_usr=md5('".$params[5]."')";
   $sqlCmd=strtoupper($sqlCmd);
   $rsUsuario=$dblink->Execute($sqlCmd);
   if (!$rsUsuario || $rsUsuario->RecordCount() <=0) {

    echo "Error: Clave incorrecta!|0";
    return;
   }
   $serial_id=0;
    $sqlCmd="select serial_asi from asistencia where serial_epl=".$params[0]." and fecha_asi='".$params[1]."' and (salida_asi is NULL or salida_asi='00:00:00' )order by salida_asi DESC";
    $rsAsistencia=$dblink->Execute($sqlCmd);
    if ($rsAsistencia && $rsAsistencia->RecordCount()>0) {
     $sqlCmd="update asistencia set salida_asi='".$params[2]."' where serial_asi=".$rsAsistencia->fields[0];
     $dblink->Execute($sqlCmd);
     $serial_id=$rsAsistencia->fields[0];
    }
    else {
     $sqlCmd="insert into asistencia (SERIAL_ASI,SERIAL_EPL, FECHA_ASI, ENTRADA_ASI, SALIDA_ASI, ESTADO_ASI, atraso_asi, permiso_asi, observaciones_asi) values (0,";
     $sqlCmd.=$params[0].",'".$params[1]."','".$params[2]."',NULL,'".$params[3]."',".$params[4].",0,'')";
     $dblink->Execute($sqlCmd);
    $serial_id=$dblink->Insert_ID();

    }

     $resultData=$dblink->ErrorMsg()."|";

    $resultData=$resultData.$serial_id."|";

    echo $resultData;
}

omnisoftExecuteUpdate();
?>
