<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_epl=0;
$serial_erp=0;
$serial_rgr=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function omnisoftProcesarEmpleadoEvaluacion($serial_eva,$fecha,$serial_tst,$serial_epl,$evaluador_eva,$calificacion_eva,$observaciones_eva) {

  global $dblink;

   $actualizacion=false;

   $sfecha=explode('-',$fecha);
   if ($serial_eva!='')       {
   $SQLCmd="select serial_eva from evaluacion where serial_eva=".$serial_eva;
   //echo $SQLCmd. "<br>";;
   $resultSet=$dblink->Execute($SQLCmd);
   }
   if ($serial_eva!='' && $resultSet->RecordCount() >0)   {


    $SQLCmd="update evaluacion set serial_epl=".$serial_epl.", serial_tst=".$serial_tst.",fecha_eva='".$fecha."',calificacion_eva='".$calificacion_eva."',observaciones_eva='".$observaciones_eva."',evaluador_eva='".$evaluador_eva."' where serial_eva=".$resultSet->fields[0];
    //echo $SQLCmd  . "<br>";

    $dblink->Execute($SQLCmd);
    $serial_erp=$resultSet->fields[0];
    $actualizacion=true;
   }
    else {
    $SQLCmd="insert into evaluacion (SERIAL_EVA, SERIAL_EPL, SERIAL_TST, FECHA_EVA, CALIFICACION_EVA, OBSERVACIONES_EVA, evaluador_eva) values (0,'".$serial_epl."','".$serial_tst."','".$fecha."','".$calificacion_eva."','".$observaciones_eva."','".$evaluador_eva."')";
    //echo $SQLCmd. "<br>";

    $dblink->Execute($SQLCmd);
    $serial_eva=$dblink->Insert_ID();

    }

    $SQLCmd="select * from detalletest where serial_tst=".$serial_tst ;
   // echo $SQLCmd."<br>";
    $resultSet=$dblink->Execute($SQLCmd);

    while (!$resultSet->EOF ) {



    if ($actualizacion==true) {
        $SQLSearch="select SERIAL_DEV, SERIAL_EVA, SERIAL_DTS, CALIFICACION_DTS, DESCRIPCION_DEV from detalleevaluacion where serial_eva=".$serial_eva." and serial_dts=".$resultSet->fields['serial_dts'];

        $rsSearch=$dblink->Execute($SQLSearch);
        if (!$rsSearch || $rsSearch->RecordCount() <=0)
        $actualizacion=false;
    }

    if ($actualizacion==false) {
    $SQLCmd="insert into detalleevaluacion (SERIAL_DEV, SERIAL_EVA, SERIAL_DTS, CALIFICACION_DTS, DESCRIPCION_DEV) values (0,".$serial_eva.",".$resultSet->fields[0].",0,'')";
    //echo $SQLCmd;
    $dblink->Execute($SQLCmd);
    }
      $resultSet->MoveNext();
    }

    echo $serial_eva."|";
}


   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
       omnisoftProcesarEmpleadoEvaluacion($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);


?>
