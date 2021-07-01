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

function SI($condicion,$verdadero,$falso) {

 return ($condicion)? $verdadero:$falso;

}
function TOTALDESCUENTOS() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='EGRESO'   and detallerolpagos.serial_erp=".$serial_erp." and serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }


function TOTALINGRESOS() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='INGRESO'   and detallerolpagos.serial_erp=".$serial_erp." and serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function INGRESOSIESS() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='INGRESO' and afectaiess_rgr='SI'  and detallerolpagos.serial_erp=".$serial_erp." and serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function INGRESOSIMPUESTORENTA() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='INGRESO' and afectaimpuesto_rgr='SI'  and detallerolpagos.serial_erp=".$serial_erp." and serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function ANTIGUEDAD() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select YEAR(CURRENT_DATE)- YEAR(fechaingreso_epl) as anio from empleado where  serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function HORASEXTRAS($anioini,$mesini,$diaini,$aniofin,$mesfin,$diafin) {
  global $serial_epl,$serial_erp,$dblink;
//  $sql="select YEAR(CURRENT_DATE)- YEAR(fechaingreso_epl) as anio from empleado where  serial_epl=".$serial_epl;
//  return $anioini;
  return 0;

}

function VACIAR() {
 return 0;
}

function leerValorVariable($tabla,$nombre,$serial) {
  global $serial_epl,$dblink;
  $sql="select ".$tabla.".".$nombre." from ".$tabla."  where ".$serial."=".$serial_epl;
  $rs=$dblink->Execute($sql);
  if (!$rs || $rs->RecordCount()<=0 )
      return 0;
  return $rs->fields[0];
}

function evaluarFormula($pformula) {
  global $GModuloRRHH,$serial_epl,$dblink;
// chequeo si la formula esta en blanco
  if ($pformula=='')
      return 0;
// verifico si la formula no se debe evaluar
  if (is_numeric($pformula))
     return $pformula;
// proceso de evaluacion de la formula

   $formula=strtoupper($pformula);
   // evaluar variables
   $SQLVariables='select nombreLogico_vam, tabla_vam,nombreFisico_vam,primaryKey_vam from variablesModulo where serial_mod='.$GModuloRRHH;
   $rsVariables=$dblink->Execute($SQLVariables);

   while (!$rsVariables->EOF) {

       $valor=leerValorVariable($rsVariables->fields[1],$rsVariables->fields[2],$rsVariables->fields[3]);
       $formula=str_replace($rsVariables->fields[0],$valor,$formula);

       $rsVariables->MoveNext();
   }

   //evaluar funciones
   $resultado=eval("return $formula;");
   return $resultado;
}

function omnisoftProcesarEmpleadoRolPagos($fecha,$serial_perrol,$empleado,$nombre_erp,$estado_erp,$tipogeneracion="INDIVIDUAL") {

  global $serial_epl,$serial_erp,$serial_rgr,$dblink;

   $actualizacion=false;

   $sfecha=explode('-',$fecha);

   $SQLCmd="select serial_erp from empleadorolpagos where serial_perrol=".$serial_perrol." and serial_epl=".$empleado;
  // echo $SQLCmd. "<br>";;
   $resultSet=$dblink->Execute($SQLCmd);

   if ($resultSet->RecordCount() >0)   {

//    $SQLCmd="delete from detallerolpagos where serial_erp =".$resultSet->fields[0];
//    echo $SQLCmd  . "<br>";
//    $dblink->Execute($SQLCmd);

    $SQLCmd="update empleadorolpagos set serial_epl=".$empleado.", serial_perrol=".$serial_perrol.",fecha_erp='".$fecha."',nombre_erp='".$nombre_erp."',estado_erp='".$estado_erp."',observacion_erp='".$observaciones_erp."' where serial_erp=".$resultSet->fields[0];
//    echo $SQLCmd  . "<br>";

    $dblink->Execute($SQLCmd);
    $serial_erp=$resultSet->fields[0];
    $actualizacion=true;
   }
    else {
    $SQLCmd="insert into empleadorolpagos (SERIAL_ERP, SERIAL_EPL, SERIAL_PERROL, FECHA_ERP, NOMBRE_ERP, ESTADO_ERP, OBSERVACION_ERP) values (0,'".$empleado."','".$serial_perrol."','".$fecha."','".$nombre_erp."','".$estado_erp."','".$observaciones_erp."')";
    //echo $SQLCmd. "<br>";

    $dblink->Execute($SQLCmd);
    $serial_erp=$dblink->Insert_ID();
    }
    $serial_epl=$empleado;
    $SQLCmd="select fechainicio_perrol from periodorol where serial_perrol=".$serial_perrol;
    $rsPeriodoRol=$dblink->Execute($SQLCmd);

    $SQLCmd="select * from rubrogeneralrolpagos where (serial_tct=-99 or serial_tct = (select serial_tct from empleado where serial_epl=".$serial_epl.")) and estado_rgr='ACTIVO'" ;
//    echo $SQLCmd."<br>";
    $resultSet=$dblink->Execute($SQLCmd);

    while (!$resultSet->EOF ) {
//    echo "formula =".$resultSet->fields['FORMULA_RGR']."<br>";

      $serial_rgr=$resultSet->fields['SERIAL_RGR'];
      $sfechaInicio=explode("-",$resultSet->fields['FECHAINICIO_RGR']);
      $mesInicio=$sfechaInicio[1]+0;
      $sfechaPeriodo=explode("-",$rsPeriodoRol->fields[0]);
      $mesPeriodo=$sfechaPeriodo[1]+1;
      $frecuencia=($mesPeriodo-$mesInicio)%$resultSet->fields['FRECUENCIA_RGR'];

    if ($actualizacion==true) {
        $SQLSearch="select serial_drp,valor_drp from detallerolpagos where serial_erp=".$serial_erp." and serial_rgr=".$resultSet->fields['SERIAL_RGR'];

        $rsSearch=$dblink->Execute($SQLSearch);
        if (!$rsSearch || $rsSearch->RecordCount() <=0)
        $actualizacion=false;
        else
              if ($resultSet->fields['FORMULA_RGR']!='' && $resultSet->fields['FORMULA_RGR']!='0' && ($tipogeneracion=='INDIVIDUAL' || (is_numeric($resultSet->fields['FORMULA_RGR'])&& $rsSearch->fields[1]==0)) ) {
              $valor_drp=($frecuencia==0)? evaluarformula($resultSet->fields['FORMULA_RGR']):0;
             $SQLUpdate="update detallerolpagos set valor_drp=".$valor_drp." where serial_drp=".$rsSearch->fields[0];
             //echo $SQLUpdate;
             $dblink->Execute($SQLUpdate);
            }

    }

    if ($actualizacion==false) {
    $valor_drp=0;
    $cuota_drp=1;
    $valor_drp=($frecuencia==0)? evaluarformula($resultSet->fields['FORMULA_RGR']):0;
    $SQLCmd="insert into detallerolpagos (SERIAL_DRP, SERIAL_RGR, SERIAL_ERP, VALOR_DRP, CUOTA_DRP) values (0,".$resultSet->fields['SERIAL_RGR'].",".$serial_erp.",".$valor_drp.",".$cuota_drp.")";
    //echo $SQLCmd;
    $dblink->Execute($SQLCmd);
    }
      $resultSet->MoveNext();
    }

    if ($tipogeneracion=="INDIVIDUAL")
    echo $serial_erp."|";
}


   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   if ($params[0]=='INDIVIDUAL')
       omnisoftProcesarEmpleadoRolPagos($params[1],$params[2],$params[3],$params[5],$params[6]);
   else {

       if ($params[3]!=0) {

           $SQLCmd="update rolpagosgeneral set  serial_perrol=".$params[2].",fecha_rop='".$params[1]."',estado_rop='".$params[4]."',observaciones_rop='".$params[5]."' where serial_rop=".$params[3];
           $dblink->Execute($SQLCmd);
           $serial_rop=$params[3];

       }
       else {

           $SQLCmd="insert into rolpagosgeneral (serial_rop, serial_perrol,fecha_rop,estado_rop,observaciones_rop) values (0,".$params[2].",'".$params[1]."','".$params[4]."','".$params[5]."')" ;
//           echo $SQLCmd;
           $dblink->Execute($SQLCmd);
           $serial_rop=$dblink->Insert_ID();

       }

       $SQLCmd="select * from  empleado where prospecto_epl='NO' and estado_epl='ACTIVO'";
       $rsEmpleado=$dblink->Execute($SQLCmd);

       while (!$rsEmpleado->EOF) {
         omnisoftProcesarEmpleadoRolPagos($params[1],$params[2],$rsEmpleado->fields['SERIAL_EPL'],$params[5],$params[4],"GENERAL");
         $rsEmpleado->MoveNext();
       }
      echo $serial_rop."|";
   }

?>
