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
   $sqlCmd="select serial_epl from empleado where DOCUMENTOIDENTIDAD_EPL='".$params[3]."' and TIPOEMPLEADO_EPL='PROFESOR'";
  // echo "consulta:".$sqlCmd;
   $sqlCmd=strtoupper($sqlCmd);
   $rsUsuario=$dblink->Execute($sqlCmd);
   if (!$rsUsuario || $rsUsuario->RecordCount() <=0) {

    echo "Error: Clave incorrecta!|0";
    return;
   }
   $serial_id=0;
    $sqlCmd="select  serial_apro from asistenciaprofesor where serial_dho=".$params[0]." and fecha_apro='".$params[1]."' and (salida_apro='' or salida_apro='00:00:00' )order by salida_apro DESC";
    $rsAsistencia=$dblink->Execute($sqlCmd);
	if ($rsAsistencia && $rsAsistencia->RecordCount()>0) {
		$msgsalida="";
		if(!empty($params[4]))
		$msgsalida=" ,observaciones_apro=concat(observaciones_apro,'  /Msg Salida:','".$params[4]."')";
		
		if(!empty($params[5]))
		$msgsalidatem=" ,tema_apro=concat(tema_apro,'  /tema salida:','".$params[5]."')";
		
		 $sqlCmd="update asistenciaprofesor set salida_apro='".$params[2]."' ".$msgsalida.$msgsalidatem." where serial_apro=".$rsAsistencia->fields[0];
		 $dblink->Execute($sqlCmd);
		 $serial_id=$rsAsistencia->fields[0];
    }
    else {
     $sqlCmd="insert into asistenciaprofesor (serial_apro,serial_dho, fecha_apro, entrada_apro, salida_apro, tema_apro, observaciones_apro) values (0,";
     $sqlCmd.=$params[0].",'".$params[1]."','".$params[2]."','','".$params[5]."','".$params[4]."')";
	 
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
