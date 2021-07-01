<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

function insertarDetalleFactura($dblink,$serial_caf,$rsAlumno,$rsArancel)
{
       $montototal=0;
       while (!$rsArancel->EOF)   {

             $montodescuento=0;

            if ($rsAlumno->fields[5]!=0)   {
              $SQLDescuento="select porcentaje_dde from detalle_descuento where serial_ara=".$rsArancel->fields['serial_ara'] ." and detalle_descuento.serial_dde=".$rsAlumno->fields[5];
              $rsDescuento=$dblink->Execute($SQLDescuento);

              if ($rsDescuento && $rsDescuento->RecordCount()>0)
                  $montodescuento=($rsDescuento->fields[0]*$rsArancel->fields['valor_dar'])/100;
            }
              $monto=$rsArancel->fields['valor_dar']-$montodescuento;
              $montotal=$montototal+$monto;
              $SQLInsert="insert into detallefactura (serial_dfa, serial_caf, serial_ara, serial_alu, valor_aal, valorajuste_aal, serial_plc, serial_plce) values (0,";
              $SQLInsert.=$serial_caf.",".$rsArancel->fields['serial_ara'].",".$rsAlumno->fields['serial_alu'].",".$monto.",0,".$rsArancel->fields['serial_plcfd'].",".$rsArancel->fields['serial_plcfh'].")";
              $dblink->Execute($SQLInsert);
              $rsArancel->MoveNext();

          }


}

function omnisoftExecuteUpdate() {


   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $serial_id=0;
   $params=explode('|',$query);

   $serial_mes=$params[0];
   $numero_caf=$params[1];

   $serial_sec=($params[2]=='TODOS' || $params[2]=='')?0:$params[2] ;
   $serial_niv=($params[3]=='TODOS' || $params[3]=='')?0:$params[3] ;
   $serial_par=($params[4]=='TODOS' || $params[4]=='')?0:$params[4] ;
   $serial_alu=($params[5]=='TODOS' || $params[5]=='')?0:$params[5] ;
   $serial_per=$params[6];

   //$serial_per=2;
   $SQLCmd="select paralelo_alumno.serial_alu,paralelo_alumno.serial_par,paralelo_alumno.serial_paralu,nivel.serial_niv,nivel.serial_sec,paralelo_alumno.serial_des  from nivel,paralelo,alumno,paralelo_alumno where estado_alu='ACTIVO' and alumno.serial_alu=paralelo_alumno.serial_alu and paralelo_alumno.serial_alu and activo_paralu='S' and paralelo.serial_par=paralelo_alumno.serial_par and nivel.serial_niv=paralelo.serial_niv and paralelo.serial_per=".$serial_per;
    if ($serial_alu!=0)
       $SQLCmd.=" and paralelo_alumno.serial_alu=".$serial_alu;
    if ($serial_par!=0)
       $SQLCmd.=" and paralelo_alumno.serial_par=".$serial_par;
    if ($serial_niv!=0)
       $SQLCmd.=" and paralelo.serial_niv=".$serial_niv;
    if ($serial_sec!=0)
       $SQLCmd.=" and nivel.serial_sec=".$serial_sec;
//    echo $SQLCmd;

    $rsAlumno=$dblink->Execute($SQLCmd);
    $mes=($serial_mes<10)?'0'.$serial_mes:$serial_mes;
    $fecha_caf=Date("Y-")."-".$mes."-01";

    while (!$rsAlumno->EOF ) {
    $serial_caf='';
    $SQLCmd="select serial_caf,estado_caf from cabecerafactura where  mes_caf=".$serial_mes." and  serial_paralu=".$rsAlumno->fields[2];
  //  echo $SQLCmd;
    $rsVerificarFactura=$dblink->Execute($SQLCmd);

    if (!$rsVerificarFactura or $rsVerificarFactura->RecordCount()<=0)  {

         $SQLCmd="insert into cabecerafactura (SERIAL_CAF, SERIAL_PARALU, FECHA_CAF, ESTADO_CAF, MES_CAF,NUMERO_CAF,TOTAL_CAF,ABONO_CAF) values
            (0,'".$rsAlumno->fields[2]."',CURRENT_DATE,'EMITIDA','".$serial_mes."','".$numero_caf."',0,0 )";

          $dblink->Execute($SQLCmd);
          $serial_caf=$dblink->Insert_ID();
          $estado_caf='EMITIDA';
          $numero_caf=$numero_caf+1;
  //         echo $SQLCmd."<br>";


     }
     else {
               $serial_caf=$rsVerificarFactura->fields[0];
               $estado_caf=$rsVerificarFactura->fields[1];
     }

     if ($estado_caf=='EMITIDA') {
          $SQLFactura="update cabecerafactura set total_caf=0,abonos_caf=0 where serial_caf=". $serial_caf;
          $dblink->Execute($SQLFactura);


          $SQLCmd="delete from detallefactura where serial_caf=".$serial_caf;
          $dblink->Execute($SQLCmd);

          // Aranceles del Alumno
          $SQLArancel="select * from mesesarancel,detallearancel where mesesarancel.serial_ara=detallearancel.serial_ara and mesesarancel.serial_mes=".$serial_mes. " and detallearancel.serial_alu=".$rsAlumno->fields[0];
          $rsArancel=$dblink->Execute($SQLArancel);
          insertarDetalleFactura($dblink,$serial_caf,$rsAlumno,$rsArancel);

          // Aranceles del Paralelo

          $SQLArancel="select * from mesesarancel,detallearancel where mesesarancel.serial_ara=detallearancel.serial_ara and mesesarancel.serial_mes=".$serial_mes. " and detallearancel.serial_alu=0 and detallearancel.serial_par=".$rsAlumno->fields[1];
          $rsArancel=$dblink->Execute($SQLArancel);
          insertarDetalleFactura($dblink,$serial_caf,$rsAlumno,$rsArancel);

          // Aranceles del Nivel

          $SQLArancel="select * from mesesarancel,detallearancel where mesesarancel.serial_ara=detallearancel.serial_ara and mesesarancel.serial_mes=".$serial_mes. " and detallearancel.serial_alu=0 and detallearancel.serial_par=0 and detallearancel.serial_niv=".$rsAlumno->fields[3];
          $rsArancel=$dblink->Execute($SQLArancel);
          insertarDetalleFactura($dblink,$serial_caf,$rsAlumno,$rsArancel);


          // Aranceles de la Seccion

          $SQLArancel="select * from mesesarancel,detallearancel where mesesarancel.serial_ara=detallearancel.serial_ara and mesesarancel.serial_mes=".$serial_mes. " and detallearancel.serial_alu=0 and detallearancel.serial_par=0 and detallearancel.serial_niv=0 and detallearancel.serial_sec=".$rsAlumno->fields[4];
          $rsArancel=$dblink->Execute($SQLArancel);
          insertarDetalleFactura($dblink,$serial_caf,$rsAlumno,$rsArancel);


     }
     if ($serial_caf!='') {
          $SQLFactura="update cabecerafactura set total_caf=(select sum(valor_aal) from detallefactura where serial_caf=".$serial_caf.") where serial_caf=". $serial_caf;
          $dblink->Execute($SQLFactura);

     }
     $rsAlumno->MoveNext();
    }



    echo $serial_caf."|";
}

omnisoftExecuteUpdate();
?>
