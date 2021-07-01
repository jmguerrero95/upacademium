<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function biciesto($anio) {
$es_bisiesto=0;
$dos_ultimas_cifras = $anio % 100;
if ($dos_ultimas_cifras != 0)
{
if ($dos_ultimas_cifras%4==0)
$es_bisiesto = 1;
}
else
{
if ($anio%400 == 0)
$es_bisiesto = 1;
}
return $es_bisiesto;
}


function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftExecuteUpdate() {

  $DIASMES=Array(0,'01'=>31,'02'=>28,'03'=>31,'04'=>30,'05'=>31,'06'=>30,'07'=>31,'08'=>31,'09'=>30,'10'=>31,'11'=>30,'12'=>31);

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $serial_id=0;
   $params=explode('|',$query);
   $sfecha=explode('-',$params[0]);

   $SQLCmd="select * from depreciaciones where fecha_depr>='".$sfecha[0].'-'.$sfecha[1]."-01' and  fecha_depr <='".$sfecha[0].'-'.$sfecha[1]."-31' and estado_depr='CONTABILIZADO'";
//   echo $SQLCmd. "<br>";;
   $resultSet=$dblink->Execute($SQLCmd);
   if ($resultSet->RecordCount() >0)
      return 0;

      $SQLCmd="select * from depreciaciones where fecha_depr>='".$sfecha[0].'-'.$sfecha[1]."-01' and  fecha_depr <='".$sfecha[0].'-'.$sfecha[1]."-31' and estado_depr<>'CONTABILIZADO'";
//   echo $SQLCmd. "<br>";;
   $resultSet=$dblink->Execute($SQLCmd);


   if ($resultSet->RecordCount() >0)   {

    $SQLCmd="delete from detalledepreciaciones where serial_depr in (select serial_depr from depreciaciones where fecha_depr>='".$sfecha[0].'-'.$sfecha[1]."-01' and  fecha_depr <='".$sfecha[0].'-'.$sfecha[1]."-31')";
    $dblink->Execute($SQLCmd);

    $SQLCmd="delete from depreciaciones where fecha_depr>='".$sfecha[0].'-'.$sfecha[1]."-01' and  fecha_depr <='".$sfecha[0].'-'.$sfecha[1]."-31'";
    $dblink->Execute($SQLCmd);

   }

    $estado_ddp=($params[2]=='SI')? 'CONTABILIZADO' : 'PROCESADO';
    $diafinmes=$DIASMES[$sfecha[1]];
//    echo "fecha".$sfecha[1];
//    echo "diasfinmes".$DIASMES[$sfecha[1]];
    $diafinmes=(($sfecha[1]==2) && biciesto($sfecha[0])==1)? $diafinmes+1: $diafinmes;

    $SQLCmd="insert into depreciaciones (SERIAL_DEPR, NUMERODOCUMENTO_DEPR, FECHA_DEPR, ESTADO_DEPR, ELABORADOPOR_DEPR) values (0,'".$params[1]."','".$sfecha[0].'-'.$sfecha[1]."-".$diafinmes."','".$estado_ddp."',".$_COOKIE['serial_usr'].")";
//    echo $SQLCmd. "<br>";

    $dblink->Execute($SQLCmd);
    $serial_depr=$dblink->Insert_ID();

    $SQLCmd="select * from activosfijos where estado_acf='ACTIVO'";
    $resultSet=$dblink->Execute($SQLCmd);


    while (!$resultSet->EOF ) {

      $vidaUtil=$resultSet->fields['VIDAUTIL_ACF']*12;
      $depreciacion=$resultSet->fields['VALOR_ACF']/$vidaUtil;
      $depreciacion=round($depreciacion,2);
      $fechaDepreciacion=explode('-',$resultSet->fields['FECHADEPRECIACION_ACF']);

      $mesActual=($sfecha[0]-$fechaDepreciacion[0])*12;
     // echo $mesActual. "<br>";
     // echo "mes=".$sfecha[1]."-".$fechaDepreciacion[1]. "<br>";
      $difmes=$sfecha[1]-$fechaDepreciacion[1]+1;
     // echo 'difmes='.$difmes. "<br>";

      if ($difmes<0)  {
         $difmes=12+$difmes;
         $mesActual-=12;
      }
     // echo 'difmes='.$difmes. "<br>";

      $mesActual=$mesActual+ $difmes;
      $depreciacionAcumulada=$depreciacion*$mesActual;

      $valor_ddp=$resultSet->fields['VALOR_ACF']-$depreciacionAcumulada;

    if ($valor_ddp>0) {
    $SQLCmd="insert into detalledepreciaciones (SERIAL_DDP, SERIAL_DEPR, SERIAL_ACF, VALOR_DDP, DEPRECIACIONMENSUAL_DDP, ESTADO_DDP,DEPRECIACIONACUMULADA_DDP) values (0,".$serial_depr.",".$resultSet->fields['SERIAL_ACF'].",".$valor_ddp.",".$depreciacion.",'".$estado_ddp."',".$depreciacionAcumulada.")";
   // echo $SQLCmd. "<br>";
    $dblink->Execute($SQLCmd);
    }
      //echo "Activo=".$resultSet->fields['NOMBRE_ACF']." mes=".$mesActual." depacum=".$depreciacionAcumulada." valor=".$valor_ddp."<br>";


     $resultSet->MoveNext();
    }


    echo $serial_depr;
}

omnisoftExecuteUpdate();
?>
