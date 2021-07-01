<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_epl=0;
$fechainicio=0;
$fechafin=0;
$dblink='';



function workingdays($startdate, $enddate){
        $startdate = explode("-", $startdate); //format dd/mm/YYYY
        $enddate = explode("-", $enddate); //format dd/mm/YYYY
        $starttime = mktime('0', '0', '0', $startdate[1], $startdate[2], $startdate[0]);
        $endtime = mktime('0', '0', '0', $enddate[1], $enddate[2], $enddate[0]);

        $noofdays = ceil(($endtime - $starttime) / (60 * 60 * 24)) + 1;
        $sundaycounter = 0;
        $saturdaycounter = 0;
        $weekdaycounter = 0;
        $holidaycounter = 0;

//        echo "No. of days = ".$noofdays."<br>";

        for ($i = 0; $i < $noofdays; $i++){
            $ts = mktime('0', '0', '0', $startdate[1], ($startdate[0] + $i), $startdate[2]);
     //       $test=CheckHolidays($ts);
            $test=FALSE;
            if($test == TRUE) {
                $holidaycounter++;
            } else {
                if (date("l", $ts) == "Sunday"){
                    $sundaycounter ++;
                } elseif (date("l", $ts) == "Saturday"){
                    $saturdaycounter ++;
                } else {
                    $weekdaycounter ++;
                }
            }
        }

        //echo "stats are<br>~~~~~~~~~<br>Sundays = ".$sundaycounter."<br>Saturdays = ".$saturdaycounter."<br> Weekdays = ".$weekdaycounter."<br> Bank holidays = ".$holidaycounter;
        return  $sundaycounter."|".$saturdaycounter."|".$weekdaycounter;
    }



function diasPermiso($serial_epl,$fecha) {
 global $dblink;
 $SQLCmd="select serial_per from  permisos  where serial_epl=".$serial_epl ." and fechainicio_per<='".$fecha."' and  fechafin_per>='".$fecha."'";
// echo $SQLCmd."<br>";

    $rsDiasPermiso=$dblink->Execute($SQLCmd);
 return ($rsDiasPermiso && $rsDiasPermiso->RecordCount()>0)? true: false;

}

function diaFeriadoFinSemana($fecha) {
  global $dblink;
 $SQLCmd="select fecha_dfe from  diasferiados where (MONTH(fecha_dfe)=MONTH('".$fecha."')  and  DAY(fecha_dfe)=DAY('".$fecha."')) or  (DAYOFWEEK('".$fecha."')=1 or DAYOFWEEK('".$fecha."')=7 ) ";
 //echo $SQLCmd;
       $rsDiasFeriados=$dblink->Execute($SQLCmd);
 return ($rsDiasFeriados && $rsDiasFeriados->RecordCount()>0)? true: false;
}


function finesSemana($serial_epl,$fechaInicio,$fechaFin) {

  global $dblink;

  $SQLCmd="select count(*) from asistencia where fecha_asi>='".$fechaInicio."' and fecha_asi<='".$fechaFin."' and (DAYOFWEEK(fecha_asi)=1 or DAYOFWEEK(fecha_asi)=7 ) and serial_epl=".$serial_epl;
  $rsFinSemana=$dblink->Execute($SQLCmd);
 return ($rsFinSemana && $rsFinSemana->RecordCount()>0)? $rsFinSemana->fields[0]: 0;
}

function diaFeriado($fecha) {
  global $dblink;
 $SQLCmd="select fecha_dfe from  diasferiados where (MONTH(fecha_dfe)=MONTH('".$fecha."')  and  DAY(fecha_dfe)=DAY('".$fecha."'))  ";
// echo $SQLCmd;
       $rsDiasFeriados=$dblink->Execute($SQLCmd);
 return ($rsDiasFeriados && $rsDiasFeriados->RecordCount()>0)? true: false;
}


function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function incrementarDia($my_date,$numdays) {
  $date_t = strtotime($my_date.' UTC');
  return gmdate('Y-m-d',$date_t + ($numdays*86400));
}

function greaterDate($start_date,$end_date)
{
  $start = strtotime($start_date);
  $end = strtotime($end_date);
  if ($start-$end >= 0)
    return 1;
  else
   return 0;
}


function calcularHorasNormales($serial_epl,$fechaInicio,$fechaFin) {
 global $dblink;
 $fecha=$fechaInicio;

 $dias=0;

 while (greaterDate($fechaFin,$fecha)) {
        $afechaactual=explode("-",$fecha);
        $dia_semana=date("w",mktime(0,0,0,$afechaactual[1],$afechaactual[2],$afechaactual[0]));
        $lv_festivo=diaFeriado($fecha);
        $lv_permiso=diasPermiso($serial_epl,$fecha);

 if ($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo && !$lv_permiso)
     $dias=$dias+1;
 $sqlDate="SELECT DATE_ADD('".$fecha."', INTERVAL 1 DAY)";
 $rsDate=$dblink->Execute($sqlDate);
 $fecha=$rsDate->fields[0];

 }

 return $dias;
}


//omnisoftConnectDB();
//$dias =calcularHorasNormales(323,"2008-08-01","2008-08-06");



function omnisoftCalcularHorasExtras($serial_epl,$fechainicio,$fechafin) {

  global $dblink,$omnisoftHORASMES,$omnisoftHORASEXTRAS;
  $arregloDias= Array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");

  $SQLCmd="select serial_asi,asistencia.serial_epl,fecha_asi,entrada1_asi,salida1_asi,entrada2_asi,salida2_asi,entrada3_asi,salida3_asi,sueldo_epl,horasMes_epl,horasDia_epl,justificarPermiso_asi,datediff('".$fechafin."','".$fechainicio."') as fecha,asistencia_epl,codigoAnterior_epl from  empleado,asistencia where empleado.serial_epl=asistencia.serial_epl and asistencia.serial_epl=".$serial_epl ." and fecha_asi>='".$fechainicio."' and  fecha_asi<='".$fechafin."' order by fecha_asi";


 // echo $SQLCmd."<br>";
   $rsAsistencia=$dblink->Execute($SQLCmd);
//   echo $SQLCmd."<br>";
   if (!$rsAsistencia || $rsAsistencia->RecordCount()==0 || trim($rsAsistencia->fields[14])=='NO') {

//   echo "$serial_epl -- ".$rsAsistencia->fields[14]."<br>";

    return "0^0";
   }

   $diasATrabajar=$rsAsistencia->fields[13]+1;
   $wkdays= workingdays($fechainicio, $fechafin);
   $wkdays=explode('|',$wkdays);


    $cf_horas_normales=calcularHorasNormales($serial_epl,$fechainicio,$fechafin);


   $diasTrabajados=0;

   $fechaactual='';
   $thoras50=0;
   $thoras100=0;
   $horasLaborables=$rsAsistencia->fields[11]>0?$rsAsistencia->fields[11]:8;
   $thorasLaboradas=0;
   $horas100=0;
   $horas50=0;
   $feriado=false;
   $lv_error='N';
   $ln_horas_total=0;
   $ln_minutos_total=0;
   $ln_minutos_total50=0;
   $ln_minutos_total100=0;
   $n_minutos=0;
   $dias=0;
   $dias1=0;
   $ln_minutos50=0;
   $ln_minutos100=0;


  while (!$rsAsistencia->EOF) {
        $dias=$dias+1;
        $diasTrabajados+=1;
        $ld_hora1=6*60;
        $ld_hora2=18*60;
        $ln_minutos=0;
        $ln_minutos50=0;
        $ln_minutos100=0;
        $lv_festivo=0;
        $fechaactual=$rsAsistencia->fields[2];
        $afechaactual=explode("-",$rsAsistencia->fields[2]);
        $dia_semana=date("w",mktime(0,0,0,$afechaactual[1],$afechaactual[2],$afechaactual[0]));
        $lv_festivo=diaFeriado($fechaactual);


        $marca1=trim($rsAsistencia->fields[3]);
        $marca2=trim($rsAsistencia->fields[4]);
        $marca3=trim($rsAsistencia->fields[5]);
        $marca4=trim($rsAsistencia->fields[6]);
        $marca5=trim($rsAsistencia->fields[7]);
        $marca6=trim($rsAsistencia->fields[8]);

        //echo "$marca1-$marca2-$marca3-$marca4-$marca5-$marca6<br>";
        if (strlen($marca1)>0 && strlen($marca2)>0) :

            $ld_marca1=explode(":",$marca1);
            $ld_marca1=$ld_marca1[0]*60+$ld_marca1[1];

            $ld_marca2=explode(":",$marca2);
            $ld_marca2=$ld_marca2[0]*60+$ld_marca2[1];
           // echo "$ld_hora1-$ld_marca1 - $ld_marca2<br>";
           if (($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo)  ) :
                 $dias1=$dias1+1;

                 if ($ld_marca1>=$ld_hora1 && $ld_marca2<=$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_marca2-$ld_marca1;
                 elseif ($ld_marca1>$ld_hora1 && $ld_marca2>$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca1;
                     $ln_minutos100=$ln_minutos100+$ld_marca2-$ld_hora2;
                     elseif ($ld_marca1<$ld_hora1 && $ld_marca2<$ld_hora2) :

                     $ln_minutos50=$ln_minutos50+$ld_marca2-$ld_marca1;

                         else  :
                                $ln_minutos100=$ln_minutos100+$ld_marca2-$ld_hora2;
                                $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca1;
                         endif;
                 else:
                         $dias=$dias-1;

                      $ln_minutos100=$ln_minutos100+$ld_marca2-$ld_marca1;


                 endif;
                    // echo "minutos 50 :$ln_minutos50<br>";

        if (strlen($marca3)>0 && strlen($marca4)>0) :
            $ld_marca3=explode(":",$marca3);
            $ld_marca3=$ld_marca3[0]*60+$ld_marca3[1];

            $ld_marca4=explode(":",$marca4);
            $ld_marca4=$ld_marca4[0]*60+$ld_marca4[1];

           if ($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo) :
                 $feriado=false;
                 if ($ld_marca3>=$ld_hora1 && $ld_marca4<=$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_marca4-$ld_marca3;
                 elseif ($ld_marca3>$ld_hora1 && $ld_marca4>$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca3;
                     $ln_minutos100=$ln_minutos100+$ld_marca4-$ld_hora2;
                     elseif ($ld_marca3<$ld_hora1 && $ld_marca4<$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_marca4-$ld_marca3;
                         else  :
                                $ln_minutos100=$ln_minutos100+$ld_marca4-$ld_hora2;
                                $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca3;
                         endif;
                 else:
                      $ln_minutos100=$ln_minutos100+$ld_marca4-$ld_marca3;
                   //  if ($feriado)
                    //  $ln_minutos100=$ln_minutos100-$horasLaborables*60;
                    $feriado=true;

                      endif;
                      if (strlen($marca3)>0 && strlen($marca4)<=0) :
                        // echo "entro 1";
                          $lv_error='S';
                      endif;
                 endif;

               if (strlen($marca5)>0 && strlen($marca6)<=0) :
                   $ld_marca5=explode(":",$marca5);
                   $ld_marca5=$ld_marca5[0]*60+$ld_marca5[1];

                   $ld_marca6=explode(":",$marca6);
                   $ld_marca6=$ld_marca6[0]*60+$ld_marca6[1];
               if ($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo) :
                   $feriado=$false;
                 if ($ld_marca5>=$ld_hora1 && $ld_marca6<=$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_marca6-$ld_marca5;
                 elseif ($ld_marca5>$ld_hora1 && $ld_marca6>$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca5;
                     $ln_minutos100=$ln_minutos100+$ld_marca6-$ld_hora2;
                     elseif ($ld_marca5<$ld_hora1 && $ld_marca6<$ld_hora2) :
                     $ln_minutos50=$ln_minutos50+$ld_marca6-$ld_marca5;
                         else  :
                                $ln_minutos100=$ln_minutos100+$ld_marca6-$ld_hora2;
                                $ln_minutos50=$ln_minutos50+$ld_hora2-$ld_marca5;
                         endif;
                 else:
                      $ln_minutos100=$ln_minutos100+$ld_marca6-$ld_marca5;
                                        //   if ($feriado)
                      //$ln_minutos100=$ln_minutos100-$horasLaborables*60;
                    $feriado=true;

                      endif ;
                      if (strlen($marca5)>0 && strlen($marca6)<=0) :
                          $lv_error='S';
                      endif ;
                 endif;
                 $ln_minutos_laborables=$horasLaborables*60;
                 $ln_minutos=$ln_minutos50+$ln_minutos100;
                 if($ln_minutos-$ln_minutos_laborables>=30):
                 //echo "ln_minutos=$ln_minutos $ln_minutos_laborables $ln_minutos50<br>";

                     if($ln_minutos50<$ln_minutos_laborables):
                        if ($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo) :
                            $ln_minutos100=$ln_minutos100-($ln_minutos_laborables-$ln_minutos50);
                            $ln_minutos50=$ln_minutos_laborables;
                          //  $dias=$dias-1;
                        endif;
                        endif;

                            $ln_minutos_total50=$ln_minutos_total50+$ln_minutos50;
                            //echo "ln_minutos_total50=$ln_minutos_total50<br>";
                            $ln_minutos_total100=$ln_minutos_total100+$ln_minutos100;
                    else :
                                 if ($dia_semana<>0 && $dia_semana<>6 && !$lv_festivo) :
                                    $dias=$dias-1;
                                    if ($ln_minutos-$ln_minutos_laborables<0):
                                        if ($rsAsistencia->fields[13]=='NO'):
                                            $ln_minutos_total50=$ln_minutos_total50-($ln_minutos_laborables-($ln_minutos50+$ln_minutos100));
                                        endif;
                                    endif;
                                else :
                                            $ln_minutos_total100=$ln_minutos_total100+$ln_minutos100;
                                     endif;
                      endif;
                                else :
                                    if (strlen($marca2)==0 && strlen($marca1)>0):
                                        $lv_error='S';
                                    endif;
                                endif;
       $rsAsistencia->MoveNext();
   }
                            //echo "ln_minutos_total50=$ln_minutos_total50<br>";

                    if ($ln_minutos_total50 >=60):

                        $ln_horas_total=floor($ln_minutos_total50/60);
                        $ln_minutos_total=$ln_minutos_total50%60 ;
                        //echo "total minutos $ln_horas_total $ln_minutos_total -";

                    else :
                          $ln_minutos_total=$ln_minutos_total50;
                          $ln_horas_total=0;
                    endif;

                    $ln_minutos_laborables=$ln_minutos_laborables*$dias;

                    $ln_extras50=$ln_minutos_total50-$ln_minutos_laborables;
                    if ($ln_extras50<0)
                        $ln_extras50=0;
                  //  echo "dias1=$dias1 dias=$dias extras50=$ln_extras50=$ln_minutos_total50-$ln_minutos_laborables<br>";

                    if ($ln_extras50>=60) :
                        $ln_horas_total=floor($ln_extras50/60);
                        if (($ln_extras50-(floor($ln_extras50/60)*60))<0) :
                           $ln_minutos_total=0;
                        else :
                               $ln_minutos_total=($ln_extras50-((floor($ln_extras50/60))*60));
                        endif;
                   else :
                          $ln_horas_total=0;
                          if ($ln_extras50<0) :
                              $ln_minutos_total=0;
                          else :
                              $ln_minutos_total=$ln_extras50;
                          endif;
                   endif;
                   //echo "minutos total $ln_horas_total: $ln_minutos_total ";
                   $lv_horas_extras=$ln_horas_total.':'.$ln_minutos_total;
                     //echo "horas".$lv_horas_extras;

                   if ($ln_minutos_total100>=60) :
                       $ln_horas_total=floor($ln_minutos_total100/60);
                       $ln_minutos_total=($ln_minutos_total100-((floor($ln_minutos_total100/60))*60));

                   else:
                       $ln_horas_total=0;
                       $ln_minutos_total=$ln_minutos_total100;
                   endif;
//                    echo "normales=$cf_horas_normales diastrabajados=$diasTrabajados dias=$dias dias1=$dias1 horas_total=".$ln_horas_total." <br>" ;

                  $ln_horas_total=$ln_horas_total-($cf_horas_normales-$dias1)*($horasLaborables);

                  if ($ln_horas_total<0) $ln_horas_total=0;
                   $lv_horas_extras=$ln_horas_total.':'.round($ln_minutos_total/60,2)*100;

                   if ($lv_error=='S'):
  //                     echo "faltan marcas<br>";
                       return 'FALTAN MARCAS^';
                   else :
                     $lv_horas_extras50=floor($ln_extras50/60). ":".round((( $ln_extras50%60)/60)*100);
   //                 echo "normales=$cf_horas_normales dias=$dias dias1=$dias1 horas50=".$lv_horas_extras50." horas 100=".$lv_horas_extras ."<br>" ;
                     return  $lv_horas_extras50."^".$lv_horas_extras;
                   endif;

   }


      omnisoftConnectDB();


  /*

   $query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $params=explode('|',$query);
   $serial_epl=$params[0];

   $fechainicio=$params[1];
   $fechafin=$params[2];
 /*
  $SQLCmd="select serial_epl,apellido_epl,nombre_epl from empleado where prospecto_epl='NO' order by apellido_epl,nombre_epl" ;
  $rsEmpleado=$dblink->Execute($SQLCmd);
   while (!$rsEmpleado->EOF) {
     echo $rsEmpleado->fields[0]."  ".$rsEmpleado->fields[1]."  ".$rsEmpleado->fields[2]. "  ";
   omnisoftCalcularHorasExtras($rsEmpleado->fields[0],$fechainicio,$fechafin);

  $rsEmpleado->MoveNext();
   }
   */

   // omnisoftCalcularHorasExtras($params[0],$fechainicio,$fechafin);

?>
