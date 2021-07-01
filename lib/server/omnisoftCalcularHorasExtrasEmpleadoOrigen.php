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

  global $dblink,$omnisoftHORASMES,$omnisoftHORASEXTRAS;
  $arregloDias= Array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");

   $SQLCmdPeriodoRol="select serial_perrol from periodorol where fechainicio_perrol <='".$fechainicio."' and fechafin_perrol>='".$fechainicio."' and fechafin_perrol>='".$fechafin."' and cerrado_perrol<>'SI'";
//   echo $SQLCmdPeriodoRol. "<br>";
   $rsPeriodoRol=$dblink->Execute($SQLCmdPeriodoRol);
   if ($rsPeriodoRol && $rsPeriodoRol->RecordCount() >0)
      $serial_perrol=$rsPeriodoRol->fields[0];
   else {
         echo "0|Error: PERIODO DE ROL DE PAGOS NO EXISTE!";
         return false;
   }

   $SQLCmd="select serial_asi,asistencia.serial_epl,fecha_asi,entrada1_asi,salida1_asi,horasdia_epl,entrada2_asi,salida2_asi,entrada3_asi,salida3_asi,sueldo_epl,horasMes_epl from  empleado,asistencia where empleado.serial_epl=asistencia.serial_epl and fecha_asi>='".$fechainicio."' and  fecha_asi<='".$fechafin."' order by fecha_asi";


//   echo $SQLCmd."<br>";
   $rsAsistencia=$dblink->Execute($SQLCmd);
   $fechaactual='';
   $serial_epl=0;
   $horasExtras50=0;
   $horasExtras100=0;
   $valor50=0;
   $valor100=0;


   while (!$rsAsistencia->EOF) {

         if ($serial_epl!=$rsAsistencia->fields[1] ) {
             if ($serial_epl!=0 && ($horas100>0 ||$horas50>0)) {
                 if ($estado!="FALTA MARCA")  {
                 $thoras100=($horas100>($omnisoftHORASEXTRAS*60))? $horas100/3600:0;
                 $thoras50=($horas50 >($omnisoftHORASEXTRAS*60))?  $horas50/3600:0;
                 $horasmes= ($rsAsistencia->fields[11]>0)?$rsAsistencia->fields[11]:$omnisoftHORASMES;
                 $valor100=($rsAsistencia->fields[10]/$horasmes)*$thoras100;
                 $valor50=($rsAsistencia->fields[10]/$horasmes)*$thoras50;
                 $observacion="PROCESADO";
                 $horasLaboradas=$horasLaboradas/3600;
                 }
                 else {
                  $observacion="FALTA MARCA";
                  $thoras100=$thoras50=$valor100=$valor50;
                  $horasLaboradas=0;
                 }
                 $SQLcommand="select serial_hex from horasextras where serial_epl=".$serial_epl. " and serial_perrol=".$serial_perrol." and fecha_hex='".$fechaactual."'";
//                 echo $SQLcommand."<br>";
                 $rsVerifica=$dblink->Execute($SQLcommand);
                 if (!$rsVerifica || $rsVerifica->RecordCount()<=0)     {
                 $SQLCmdHorasExtras="insert into horasextras (SERIAL_HEX, SERIAL_EPL, SERIAL_PERROL, HORA50_HEX, HORA100_HEX, FECHA_HEX, OBSERVACION_HEX, valor50_hex,valor100_hex,horasLaboradas_hex) values (0,";
                 $SQLCmdHorasExtras.=$serial_epl.",".$serial_perrol.",". $thoras50 .",".$thoras100 .",'".$fechaactual."', '".$observacion."', ".$valor50.",".$valor100.",".$horasLaboradas.")";
                // echo $SQLCmdHorasExtras."<br>";
                 $dblink->Execute($SQLCmdHorasExtras);
                 }
             }

             $fechaactual=$rsAsistencia->fields[2];
             $serial_epl=$rsAsistencia->fields[1];
             $horasExtras50=0;
             $horasExtras100=0;
             $horasTrabajo=($rsAsistencia->fields[5]==0)?8:$rsAsistencia->fields[5];
         }
         else
         if ( $fechaactual!=$rsAsistencia->fields[2])
             $fechaactual=$rsAsistencia->fields[1];
         $aentrada1=explode(":", $rsAsistencia->fields[3]);
         //echo $aentrada[0].":".$aentrada[1].":".$aentrada[2]."<br>";
         $entrada1=$aentrada1[0]*3600+$aentrada1[1]*60; //+$aentrada1[2];

         if (strlen($rsAsistencia->fields[6])>0  ) {

             $aentrada2=explode(":", $rsAsistencia->fields[6]);
             $entrada2=$aentrada2[0]*3600+$aentrada2[1]*60;//+$aentrada2[2];

         }
         else $entrada2=0;

         if (strlen($rsAsistencia->fields[8])>0 ) {
         $aentrada3=explode(":", $rsAsistencia->fields[8]);
         $entrada3=$aentrada3[0]*3600+$aentrada3[1]*60;//+$aentrada3[2];
         }
         else $entrada3=0;

         if (strlen($rsAsistencia->fields[4])>0) {
         $asalida1=explode(":", $rsAsistencia->fields[4]);
         //echo $asalida[0].":".$asalida[1].":".$asalida[2]."<br>";

         $salida1=$asalida1[0]*3600+$asalida1[1]*60;//+$asalida1[2];
         $estado="PROCESADO";

         if ($entrada2>0)  {
            if (strlen($rsAsistencia->fields[7])>0) {
              $asalida2=explode(":", $rsAsistencia->fields[7]);
              $salida2=$asalida2[0]*3600+$asalida2[1]*60;//+$asalida2[2];
 }
            else {
                   $entrada2=0;
                   $salida2=0;
                   $salida3=0;
                   $estado="FALTA MARCA";
            }
         }
         if ($entrada3>0)  {
            if (strlen($rsAsistencia->fields[9])>0) {
              $asalida3=explode(":", $rsAsistencia->fields[9]);
              $salida3=$asalida3[0]*3600+$asalida3[1]*60;//+$asalida3[2];
             }
            else {
                   $entrada3=0;
                   $salida3=0;
                   $estado="FALTA MARCA";
            }
         }


         $horas=$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3;
         $horasLaboradas=$horas;
         //echo "entrada1=".$entrada1." ,salida1=".$salida1."entrada2=".$entrada2." ,salida2=".$salida2."entrada3=".$entrada3." ,salida3=".$asalida3." horas=$horas<br>";

         if (diaFeriadoFinSemana($fechaactual))  {
             $horas100=$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3;
             $horas50=0;
             $nombreDia="FERIADO";
         }
         else

         if ($horas>$horasTrabajo) {
             $horas100=0;
             if ($salida1>=18*3600 && $salida1<=24*3600)
             $horas100=($entrada1>18*3600)? $salida1-$entrada1:$salida1-18*3600;
             if ($salida2>=18*3600 && $salida2<=24*3600)
             $horas100+=($entrada2>18*3600)? $salida2-$entrada2:$salida2-18*3600;
             if ($salida3>=18*3600 && $salida3<=24*3600)
             $horas100+=($entrada3>18*3600)? $salida3-$entrada3:$salida3-18*3600;

             $horas50=$horas-$horasTrabajo*3600-$horas100;
             if ($horas50<0){
                $horas100=($horas100>0)? $horas100+$horas50:0;
                $horas50=0;
             }
           //  echo "horas100=".$horas100."horas50=".$horas50."horastrabajo=".$horasTrabajo."<br>";

             }
             else
             $horas100=$horas50=0;

         }
         else $estado="FALTA MARCA";
         if ($nombreDia=="FERIADO") {
             $afechaactual=explode("-",$fechaactual);
             $nombreDia=date("w",mktime(0,0,0,$afechaactual[1],$afechaactual[2],$afechaactual[0]));
             if ($nombreDia==0)
                 $nombreDia="DOMINGO";
            else if ($nombreDia==6)
                    $nombreDia="SABADO";


         }

         $SQLCommand="update asistencia set estado_asi='".$estado."' ,nombreDia_asi='".$nombreDia."' where serial_epl=".$serial_epl." and fecha_asi='".$fechaactual."'";
         $nombreDia="";
         if ($estado=="FALTA MARCA") {
             $horas100=$horas50=0;

         }


         $dblink->Execute($SQLCommand);
    //     echo $SQLCommand."<br>";
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
