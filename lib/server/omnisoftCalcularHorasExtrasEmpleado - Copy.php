<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_epl=0;
$fechainicio=0;
$fechafin=0;
$dblink='';

function diaFeriadoFinSemana($fecha) {
  global $dblink;
 $SQLCmd="select fecha_dfe from  diasferiados where (MONTH(fecha_dfe)=MONTH('".$fecha."')  and  DAY(fecha_dfe)=DAY('".$fecha."')) or  (DAYOFWEEK('".$fecha."')=1 or DAYOFWEEK('".$fecha."')=7 ) ";
// echo $SQLCmd;
       $rsDiasFeriados=$dblink->Execute($SQLCmd);
 return ($rsDiasFeriados && $rsDiasFeriados->RecordCount()>0)? true: false;
}


function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function omnisoftCalcularHorasExtras($fechainicio,$fechafin) {

  global $dblink;

   $SQLCmdPeriodoRol="select serial_perrol from periodorol where fechainicio_perrol <='".$fechainicio."' and fechafin_perrol>='".$fechainicio."' and fechafin_perrol>='".$fechafin."' and cerrado_perrol<>'SI'";
//   echo $SQLCmdPeriodoRol. "<br>";
   $rsPeriodoRol=$dblink->Execute($SQLCmdPeriodoRol);
   if ($rsPeriodoRol && $rsPeriodoRol->RecordCount() >0)
      $serial_perrol=$rsPeriodoRol->fields[0];
   else {
         echo "0|Error: PERIODO DE ROL DE PAGOS NO EXISTE!";
         return false;
   }

   $SQLCmd="select serial_asi,asistencia.serial_epl,fecha_asi,entrada1_asi,salida1_asi,horasdia_epl,entrada2_asi,salida2_asi,entrada3_asi,salida3_asi from  empleado,asistencia where empleado.serial_epl=asistencia.serial_epl and fecha_asi>='".$fechainicio."' and  fecha_asi<='".$fechafin."' order by fecha_asi";


//   echo $SQLCmd."<br>";
   $rsAsistencia=$dblink->Execute($SQLCmd);
   $fechaactual='';
   $serial_epl=0;
   $horasExtras50=0;
   $horasExtras100=0;
   $valor=0;

   while (!$rsAsistencia->EOF) {

         if ($serial_epl!=$rsAsistencia->fields[1] ) {
             if ($serial_epl!=0 && ($horas100>0 ||$horas50>0)) {
                 if ($horas100>0) {
                   $thoras100=$horas100/3600;

                 $SQLCmdHoras100="insert into horasextra (SERIAL_HEX, SERIAL_EPL, SERIAL_PERROL, HORA_HEX, PORCENTAJE_HEX, FECHA_HEX, OBSERVACION_HEX, valor_hex) values (0,";
                 $SQLCmdHoras100.=$serial_epl.",".$serial_perrol.",". $thoras100 .", 100,'".$fechaactual."', '', ".$valor.")";
  //               echo $SQLCmdHoras100."<br>";
                 $dblink->Execute($SQLCmdHoras100);
                 }
                 if ($horas50 >0) {
                   $thoras50=$horas50/3600;

                 $SQLCmdHoras50="insert into horasextra (SERIAL_HEX, SERIAL_EPL, SERIAL_PERROL, HORA_HEX, PORCENTAJE_HEX, FECHA_HEX, OBSERVACION_HEX, valor_hex) values (0,";
                 $SQLCmdHoras50.=$serial_epl.",".$serial_perrol.",". $thoras50 .", 50,'".$fechaactual."', '', ".$valor.")";
 //                echo $SQLCmdHoras50."<br>";
                 $dblink->Execute($SQLCmdHoras50);

                 }

             }

             $fechaactual=$rsAsistencia->fields[2];
   //          echo "entro=$fechaactual<br>";
             $serial_epl=$rsAsistencia->fields[1];
             $horasExtras50=0;
             $horasExtras100=0;
             $horasTrabajo=($rsAsistencia->fields[5]==0)?8:$rsAsistencia->fields[5];
         }
         else
         if ( $fechaactual!=$rsAsistencia->fields[2])
             $fechaactual=$rsAsistencia->fields[1];
         $aentrada1=explode(":", $rsAsistencia->fields[3]);
        // echo $aentrada[0].":".$aentrada[1].":".$aentrada[2]."<br>";
         $entrada1=$aentrada1[0]*3600+$aentrada1[1]*60+$aentrada1[2];

         if (strlen($rsAsistencia->fields[6])>0) {
         $aentrada2=explode(":", $rsAsistencia->fields[6]);
         $entrada2=$aentrada2[0]*3600+$aentrada2[1]*60+$aentrada2[2];
         }
         else $entrada2=0;

         if (strlen($rsAsistencia->fields[8])>0) {
         $aentrada3=explode(":", $rsAsistencia->fields[8]);
         $entrada3=$aentrada3[0]*3600+$aentrada3[1]*60+$aentrada3[2];
         }
         else $entrada3=0;

         if (strlen($rsAsistencia->fields[4])>0) {
         $asalida1=explode(":", $rsAsistencia->fields[4]);
         //echo $asalida[0].":".$asalida[1].":".$asalida[2]."<br>";

         $salida1=$asalida1[0]*3600+$asalida1[1]*60+$asalida1[2];
         $estado="PROCESADO";

         if ($entrada2>0)  {
            if (strlen($rsAsistencia->fields[7])>0) {
              $asalida2=explode(":", $rsAsistencia->fields[7]);
              $salida2=$asalida2[0]*3600+$asalida2[1]*60+$asalida2[2];
             }
            else {
                   $salida2=0;
                   $salida3=0;
                   $estado="MARCA INCOMPLETA";
            }
         }
         if ($entrada3>0)  {
            if (strlen($rsAsistencia->fields[9])>0) {
              $asalida3=explode(":", $rsAsistencia->fields[9]);
              $salida3=$asalida3[0]*3600+$asalida3[1]*60+$asalida3[2];
             }
            else {
                   $salida3=0;
                   $estado="MARCA INCOMPLETA";
            }
         }


         $horas=($salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3)>$horasTrabajo*3600)?$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3-$horasTrabajo*3600:0;

       //  echo "entrada=".$entrada." ,salida=".$salida."<br>";

         if (diaFeriadoFinSemana($fechaactual))  {
             $horas100=$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3;
             $horas50=0;
         }
         else

         if ($horas>$horasTrabajo) {
             
             if ($salida1>=18*3600 && $salida1<=24*3600) {
             $horas50=$salida1-$entrada1-$horasTrabajo*3600-($salida1-18*3600);
             $horas100=$horas-$horas50;

             }
             else {
             $horas50=$salida1-$entrada1-$horasTrabajo*3600;
             //echo "entro =".$horas50;
             $horas100=0;
             }




         }
         }
         else $estado="MARCA INCOMPLETA";
         $rsAsistencia->MoveNext();
       }
    echo "1|PROCESAMIENTO CORRECTO";
}



   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   $fechainicio=$params[0];
   $fechafin=$params[1];
   omnisoftCalcularHorasExtras($fechainicio,$fechafin);



?>
