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

function omnisoftCalcularHorasExtras($serial_epl,$fechainicio,$fechafin) {

  global $dblink,$omnisoftHORASMES,$omnisoftHORASEXTRAS;
  $arregloDias= Array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");

  $SQLCmd="select serial_asi,asistencia.serial_epl,fecha_asi,entrada1_asi,salida1_asi,horasdia_epl,entrada2_asi,salida2_asi,entrada3_asi,salida3_asi,sueldo_epl,horasMes_epl from  empleado,asistencia where empleado.serial_epl=asistencia.serial_epl and asistencia.serial_epl=".$serial_epl ." and fecha_asi>='".$fechainicio."' and  fecha_asi<='".$fechafin."' order by fecha_asi  DESC";


   echo $SQLCmd."<br>";
   $rsAsistencia=$dblink->Execute($SQLCmd);
   $fechaactual='';
   $thoras50=0;
   $thoras100=0;
   $horasLaborables=0;
   $thorasLaboradas=0;
   $horas100=0;
   $horas50=0;
   $dias=0;
   $feriado=false;

   while (!$rsAsistencia->EOF) {

        $horasTrabajo=($rsAsistencia->fields[5]==0)?8:$rsAsistencia->fields[5];

         if ( $fechaactual!=$rsAsistencia->fields[2])
             $fechaactual=$rsAsistencia->fields[2];
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
                 //  echo "entro";
                   $estado="FALTA MARCA";
                  return "FALTAN MARCAS|0|0";
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
                   return "FALTAN MARCAS|0|0";
              }
         }


         $horas=$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3;
         $horasLaboradas=$horas;
         echo "fechaactual=".$fechaactual."entrada1=".$entrada1." ,salida1=".$salida1."entrada2=".$entrada2." ,salida2=".$salida2."entrada3=".$entrada3." ,salida3=".$asalida3." horas=$horas<br>";

         if (!$feriado && diaFeriadoFinSemana($fechaactual))  {
             $horas100=$salida1-$entrada1+$salida2-$entrada2+$salida3-$entrada3;
             $horas50=0;
             $thoras100+=($horas100>($omnisoftHORASEXTRAS*60))? $horas100/3600:0;
             $thoras50+=($horas50 >($omnisoftHORASEXTRAS*60))?  $horas50/3600:0;
             $feriado=true;
             $nombreDia="FERIADO";
             echo $nombreDia."<br>";
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
             echo "horas100=".$horas100."horas50=".$horas50."horastrabajo=".$horas."<br>";
             $thoras100+=($horas100>($omnisoftHORASEXTRAS*60))? $horas100/3600:0;
             $thoras50+=($horas50 >($omnisoftHORASEXTRAS*60))?  $horas50/3600:0;

             }
             else
             $horas100=$horas50=0;

         }
         else {
  //             echo "entro".$horas;
                $estado="FALTA MARCA";
                return "FALTAN MARCAS|0|0";
      }
         if ($nombreDia=="FERIADO") {
             $afechaactual=explode("-",$fechaactual);
             $nombreDia=date("w",mktime(0,0,0,$afechaactual[1],$afechaactual[2],$afechaactual[0]));
             if ($nombreDia==0)
                 $nombreDia="DOMINGO";
            else if ($nombreDia==6)
                    $nombreDia="SABADO";


         }
         else {
             $horasTrabajo=($rsAsistencia->fields[5]==0)?8:$rsAsistencia->fields[5];
             $horasLaborables+=$horasTrabajo;
             $dias++;
             $thorasLaboradas+=$horas;
             $feriado=false;
         }

         $SQLCommand="update asistencia set estado_asi='".$estado."' ,nombreDia_asi='".$nombreDia."' where serial_epl=".$serial_epl." and fecha_asi='".$fechaactual."'";
         $dblink->Execute($SQLCommand);
         $nombreDia="";
         if ($estado=="FALTA MARCA") {
             $horas100=$horas50=0;
             return "FALTAN MARCAS|0|0";

         }
        $rsAsistencia->MoveNext();
       }

    if ($horasLaborables>$thorasLaboradas) {
        $thoras100=$thoras100-($horasLaborables-$thorasLaboradas);

        if ($thoras100<0)  {
            $thoras50=$thoras50+$thoras100;
            $thoras100=0;
            if ($thoras50<0)
                $thoras50=0;

        }

    }
    $thoras50=round($thoras50,2);
    $thoras100=round($thoras100,2);

    return "PROCESAMIENTO CORRECTO|".$thoras50."|".$thoras100;
}



   $query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_epl=$params[0];

   $fechainicio=$params[1];
   $fechafin=$params[2];
echo   omnisoftCalcularHorasExtras($serial_epl,$fechainicio,$fechafin);



?>
