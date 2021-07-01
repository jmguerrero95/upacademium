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

   $query = $_POST['query'];
  // echo "parametros:".$_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $params=explode('|',$query);

   $dblink=omnisoftConnectDB();

   //$sqlCmd="select serial_epl from usuario where serial_epl=".$params[0]." and clave_usr=md5('".$params[5]."')";
   $sqlCmd="select serial_epl from empleado where serial_epl=".$params[0]." and DOCUMENTOIDENTIDAD_EPL='".$params[5]."'";
  // echo "consulta:".$sqlCmd;
   $sqlCmd=strtoupper($sqlCmd);
   $rsUsuario=$dblink->Execute($sqlCmd);
   if (!$rsUsuario || $rsUsuario->RecordCount() <=0) {

    echo "Error: Clave incorrecta!|0";
    return;
   }
   $serial_id=0;
    $sqlCmd="select serial_asi from asistencia where serial_epl=".$params[0]." and fecha_asi='".$params[1]."' and (salida_asi='' or salida_asi='00:00:00' )order by salida_asi DESC";
    $rsAsistencia=$dblink->Execute($sqlCmd);
	if ($rsAsistencia && $rsAsistencia->RecordCount()>0) {
		$msgsalida="";
		if(!empty($params[6]))
		$msgsalida=" ,observaciones_asi=concat(observaciones_asi,'  /Msg Salida:','".$params[6]."')";
		
		 $sqlCmd="update asistencia set salida_asi='".$params[2]."' ".$msgsalida." where serial_asi=".$rsAsistencia->fields[0];
		 $dblink->Execute($sqlCmd);
		 $serial_id=$rsAsistencia->fields[0];
    }
    else {
     $sqlCmd="insert into asistencia (SERIAL_ASI,SERIAL_EPL, FECHA_ASI, ENTRADA_ASI, SALIDA_ASI, ESTADO_ASI, atraso_asi, permiso_asi, observaciones_asi) values (0,";
     $sqlCmd.=$params[0].",'".$params[1]."','".$params[2]."','','".$params[3]."',".$params[4].",0,'".$params[6]."')";
	 
	// echo "<br>inserta:<br>".$sqlCmd."******termina";
	 
     $dblink->Execute($sqlCmd);
    $serial_id=$dblink->Insert_ID();

    }

     $resultData=$dblink->ErrorMsg()."|";

    $resultData=$resultData.$serial_id."|";

    echo $resultData;
}

omnisoftExecuteUpdate();
?>
