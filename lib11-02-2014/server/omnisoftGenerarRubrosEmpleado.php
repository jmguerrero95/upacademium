<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_epl=0;
$serial_erp=0;
$serial_rgr=0;
$fechaRolPagos='';
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function SI($condicion,$verdadero,$falso){
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


function APORTEPERSONALIESS($factor){

  return (INGRESOSIESS()+HORASEXTRAS50()+HORASEXTRAS100())*$factor;

 }


function INGRESOSIMPUESTORENTA() {
  global $serial_epl,$serial_erp,$dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='INGRESO' and afectaimpuesto_rgr='SI'  and detallerolpagos.serial_erp=".$serial_erp." and serial_epl=".$serial_epl;
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }
 
 function INGRESOSIMPUESTORENTA_PROFESOERES($serial_epl,$serial_epl1,$serial_perrol) {
  global $dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.tipo_rgr='INGRESO' and afectaimpuesto_rgr='SI'  and detallerolpagos.serial_erp=empleadorolpagos.serial_erp and serial_epl in (".$serial_epl.",".$serial_epl1.") and serial_perrol=".$serial_perrol;
 // echo $sql."<br>";
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }
 function APORTEPERSONALIESS_PROFESORES($serial_epl,$serial_epl1,$serial_perrol) {
  global $dblink;
  $sql="select  sum(valor_drp) from rubrogeneralrolpagos,empleadorolpagos,detallerolpagos 
where empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.CODIGO_RGR='IESSPER' and detallerolpagos.serial_erp=empleadorolpagos.serial_erp AND  serial_epl in (".$serial_epl.",".$serial_epl1.") and serial_perrol=".$serial_perrol;
  //echo $sql."<br>";
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function ANTIGUEDADFR() {
  global $serial_epl,$serial_erp,$dblink,$fechaRol;
 $sql="select MONTH('".$fechaRol."')- MONTH(fingresonomina_epl) as mes,YEAR('".$fechaRol."')- YEAR(fingresonomina_epl) as anio from empleado where  serial_epl=".$serial_epl;
//echo $sql;  
$rs=$dblink->Execute($sql);
  
  if (!$rs || $rs->RecordCount()<=0) return 0;
   if ($rs->fields[0]>1 && $rs->fields[1]>=1)
       return 1;
   else return 0;
 }
 
function ANTIGUEDAD() {
  global $serial_epl,$serial_erp,$dblink,$fechaRol;
  $sql="select YEAR('".$fechaRol."')- YEAR(fingresonomina_epl) as anio from empleado where  serial_epl=".$serial_epl;
//echo $sql;

  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }

function ANIVERSARIO() {
  global $serial_epl,$serial_erp,$dblink,$fechaRol;
  
  $sql="select MONTH('".$fechaRol."')- MONTH(fingresonomina_epl) as mes,YEAR('".$fechaRol."')- YEAR(fingresonomina_epl) as anio from empleado where  serial_epl=".$serial_epl;
//echo $sql;  
$rs=$dblink->Execute($sql);
  
  if (!$rs || $rs->RecordCount()<=0) return 0;
   if ($rs->fields[0]==0 && $rs->fields[1]>=1)
       return 1;
   else return 0;	   
 }
 
  function SIPROVISIONAFONDOSRESERVA() {
  global $serial_epl,$serial_erp,$dblink,$fechaRol;
  
  $sql="select retfondoreserva_epl from empleado where retfondoreserva_epl='SI' and SERIAL_EPL = ".$serial_epl;
//echo $sql;  
$rs=$dblink->Execute($sql);
  
  if (!$rs || $rs->RecordCount()<=0) return 0;
  else return 1;	   
 }

function NOPROFESOR() {
  global $serial_epl,$serial_erp,$dblink,$fechaRol;
  //A LOS EMPLEADOS QUE NO SON PROFESORES LES ASIGNA LOS VALORES DEL XIV
  $sql="select * from  empleado where prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and generarol_epl='SI' AND TIPOEMPLEADO_EPL<>'PROFESOR' 
			and DOCUMENTOIDENTIDAD_EPL in (select DOCUMENTOIDENTIDAD_EPL from empleado where prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and TIPOEMPLEADO_EPL='PROFESOR' AND GENERAROL_EPL='SI') and serial_epl=".$serial_epl;
//echo $sql;  
$rs=$dblink->Execute($sql);
  
  if (!$rs || $rs->RecordCount()<=0) return 0;
   return 1;
   
 }


function HORASEXTRAS($porcentaje) {

  global $serial_epl,$serial_erp,$dblink;
  $sql="select sum(hora_hex) from horasextra,empleadorolpagos where  porcentaje_hex='".$porcentaje."' and serial_erp=".$serial_erp. " AND horasextra.serial_perrol = empleadorolpagos.serial_perrol AND horasextra.serial_epl = empleadorolpagos.serial_epl";

//  echo $sql ."<br>";
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];


}

function HORASEXTRAS25() {
  return HORASEXTRAS(25);

}

function HORASEXTRAS50() {
  return HORASEXTRAS(50);

}

function HORASEXTRAS100() {
  return HORASEXTRAS(100);

}



function GASTOSDEDUCIBLES() {
  global $serial_epl,$serial_erp,$dblink,$fechaRolPagos;
  
 // echo "fecha77777777777:".$fecha."----".$fechaRolPagos;
  $sql="select  sum(valor_gde)/12 from gastosdeducibles where serial_epl=".$serial_epl." and anio_gde=YEAR('".$fechaRolPagos."')";
  $rs=$dblink->Execute($sql);
  return (!$rs || $rs->RecordCount()<=0)?0: $rs->fields[0];
 }


 function TERCERAEDAD($anios){
 	global $serial_epl,$serial_erp,$dblink;
 	 $sql="select round(DATEDIFF(now(),FECHANACIMIENTO_EPL)/365) as anios, 2 as factor from empleado where round(DATEDIFF(now(),FECHANACIMIENTO_EPL)/365)>=".$anios." and  serial_epl=".$serial_epl;
  	 $rs=$dblink->Execute($sql);
  	 return (!$rs || $rs->RecordCount()<=0)?1: $rs->fields[1];
  
  
  }
  function  SI_DISCAPACITADO(){
 	global $serial_epl,$serial_erp,$dblink;
 	 $sql="select DISCAPACITADO_EPL,2 as factor from empleado where DISCAPACITADO_EPL='SI' and  serial_epl=".$serial_epl;
  	 $rs=$dblink->Execute($sql);
  	 return (!$rs || $rs->RecordCount()<=0)?1: $rs->fields[1];
  
  
  }
 function CALCULARIMPUESTORENTA($factor,$anios) {

   global $serial_epl,$serial_erp,$dblink;
   
   $validacion=TERCERAEDAD($anios)*SI_DISCAPACITADO($anios);
   
   $ingresos=(INGRESOSIMPUESTORENTA()-GASTOSDEDUCIBLES()-APORTEPERSONALIESS($factor))*12;
     
   $sql="select  FRACCIONEXCEDENTE_TIR/100,FRACCIONBASICA_TIR,BASICA_TIR from tablaimpuestorenta where (".$validacion."*basica_tir)<=".$ingresos." and (".$validacion."*excedente_tir)>=".$ingresos." and ESTADO_TIR='VIGENTE'";

   $rs=$dblink->Execute($sql);
   if (!$rs|| $rs->RecordCount()<=0)
     return 0;

    $valor=(($ingresos-$rs->fields[2])*$rs->fields[0]+$rs->fields[1])/12;
    return $valor;

 }

function CALCULARIMPUESTORENTA_PROFESORES($serial_perrol,$serial_epl){
	global $dblink;
	$empleado="";
	if($serial_epl>0) $empleado=" and serial_epl=".$serial_epl;
	//Consulta de todos los administrativos que son profesores
	$sql="select * from  empleado where prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and generarol_epl='SI' AND TIPOEMPLEADO_EPL<>'PROFESOR' 
			and DOCUMENTOIDENTIDAD_EPL in (select DOCUMENTOIDENTIDAD_EPL from empleado where prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and TIPOEMPLEADO_EPL='PROFESOR' AND GENERAROL_EPL='SI')".$empleado;
	
	$rsempledo_profesor=$dblink->Execute($sql);
	 
   while (!$rsempledo_profesor->EOF) {
   	   //Consulta al profesor
	   $rsprofesor=$dblink->Execute("select * from empleado where DOCUMENTOIDENTIDAD_EPL='".$rsempledo_profesor->fields['DOCUMENTOIDENTIDAD_EPL']."' and
	   								prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and TIPOEMPLEADO_EPL='PROFESOR' AND GENERAROL_EPL='SI'");	
	   $ingresos=(INGRESOSIMPUESTORENTA_PROFESOERES($rsempledo_profesor->fields['SERIAL_EPL'],$rsprofesor->fields['SERIAL_EPL'],$serial_perrol)-GASTOSDEDUCIBLES()-APORTEPERSONALIESS_PROFESORES($rsempledo_profesor->fields['SERIAL_EPL'],$rsprofesor->fields['SERIAL_EPL'],$serial_perrol))*12;

	   	$sql="select  FRACCIONEXCEDENTE_TIR/100,FRACCIONBASICA_TIR,BASICA_TIR from tablaimpuestorenta where basica_tir<=".$ingresos.' and excedente_tir>='.$ingresos." and ESTADO_TIR='VIGENTE'";

   		$rs=$dblink->Execute($sql);
   //ACTUALIZA EL IMPUESTO A LA RENTA DEL ADMINISTRATIVO Y DEL PROFESOR LE PONE 0
   if ($rs->RecordCount()>0){
		   $valor=(($ingresos-$rs->fields[2])*$rs->fields[0]+$rs->fields[1])/12;
			$SQLUpdate="update rubrogeneralrolpagos,empleadorolpagos,detallerolpagos  set valor_drp=".$valor." where  empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.CODIGO_RGR='IRENT'  and detallerolpagos.serial_erp=empleadorolpagos.serial_erp 
	and serial_epl=".$rsempledo_profesor->fields['SERIAL_EPL']." and serial_perrol=".$serial_perrol;
		 //echo $SQLUpdate;
		 $dblink->Execute($SQLUpdate);
		 $SQLUpdate_p="update rubrogeneralrolpagos,empleadorolpagos,detallerolpagos  set valor_drp=0 where  empleadorolpagos.serial_erp=detallerolpagos.serial_erp and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and rubrogeneralrolpagos.CODIGO_RGR='IRENT'  and detallerolpagos.serial_erp=empleadorolpagos.serial_erp 
	and serial_epl=".$rsprofesor->fields['SERIAL_EPL']." and serial_perrol=".$serial_perrol;
		 //echo $SQLUpdate;
		 $dblink->Execute($SQLUpdate_p);
	}
	
   	$rsempledo_profesor->MoveNext();
   }

}


function VACIAR() {
 return 0;
}

function leerValorVariable($tabla,$nombre,$serial) {
  global $serial_epl,$dblink;
  $sql="select ".$tabla.".".$nombre." from ".$tabla."  where ".$serial."=".$serial_epl;
  $rs=$dblink->Execute($sql);
  
  //echo "</p> valor ".$sql;
  
  if (!$rs || $rs->RecordCount()<=0 )
      return 0;
  return $rs->fields[0];
}

function evaluarFormula($rubro_general, $pformula,$fecha,$empleado) {
  global $GModuloRRHH,$serial_epl,$dblink,$fechaRolPagos;
  
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
   //echo $SQLVariables."<br>";
   $rsVariables=$dblink->Execute($SQLVariables);
   while (!$rsVariables->EOF) {
   
       $valor=leerValorVariable($rsVariables->fields[1],$rsVariables->fields[2],$rsVariables->fields[3]);
       $formula=str_replace($rsVariables->fields[0],$valor,$formula);

       $rsVariables->MoveNext();
   }   
  
  /***SE EXTRAE  EL MES Y AÑO ACTUAL PARA COMPARAR CON EL AÑO Y MES DEINGRESO DEL EMPLEADO*******/  
  
  $fechaRolPagos=$fecha;
	
  $fechaRol=explode('-',$fecha);
//  echo "FECHAaaaaaaaaaaaaaaaaaaaaaaa:".$fecha;
   
  /*********SE EXTRAE LA FECHA DE INFRESO Y SALIDA DEL EMPLEADO*****/
  $EmpleadoFechas= "select fingresonomina_epl,fsalidanomina_epl, retfondoreserva_epl from empleado where SERIAL_EPL = ".$empleado;
  $rsEmpleadoFechas=$dblink->Execute($EmpleadoFechas);
 
 // echo $EmpleadoFechas;
//fsalidanomina_epl

  $fechaIngreso=explode('-',$rsEmpleadoFechas->fields['fingresonomina_epl']);
  $fechaSalida=explode('-',$rsEmpleadoFechas->fields['fsalidanomina_epl']);
  /*$fechaIngreso=$rsEmpleadoFechas->fields['fingresonomina_epl'];
  $fechaSalida=$rsEmpleadoFechas->fields['fsalidanomina_epl'];*/
//  echo  $fechaRolPagos."Rol----fecha---Ing".$rsEmpleadoFechas->fields['fingresonomina_epl'];
  
  $bandera= 0;
  $dia=0;
  $ingreso = 0;
  $salida = 0;

	//compara año y mes de ingreso con los del rol  
  if((int)$fechaRol[0]==(int)$fechaIngreso[0] and (int)$fechaRol[1]==(int)$fechaIngreso[1]){
  	$dia_ingreso=(int)$fechaIngreso[2];  
	$bandera = 1;
	$ingreso = 1;	 
  }

  //compara año y mes de salida con los del rol
  if((int)$fechaRol[0]==(int)$fechaSalida[0] and (int)$fechaRol[1]==(int)$fechaSalida[1]){
   	$dia_salida=(int)$fechaSalida[2];  		
	$bandera = 1;
	$salida = 1;
  }
  

 //echo "<br>Rubro - Formula: ".$rubro_general."-".$formula."<br>";	

//
echo '</p>'.$formula;
 //evaluar funciones
 $resultado=eval("return $formula;");
 
 
 
 //SI CALCULA EL PROPORCIONAL POR ENTRADA O SALIDA
  if($bandera==1){
//  echo "Entraaaaaaaaaaaaa";
  		 //CALCULA CUANTOS DIAS TIENE EL MES DEL ROL 
		 $month = $fechaRol[1];
		 $year  = $fechaRol[0]; 
		 $first_of_month = mktime (0,0,0, $month, 1, $year); 
		 $maxdays = date('t', $first_of_month);
		 if($ingreso == 1)//SI TIENE PROPORCIONAL DE INGRESO
		 	$diasrol=$maxdays-$dia_ingreso;
		 else// SI TIENE PROPORCIONAL DE SALIDA
		 	$diasrol=$dia_salida;
			
	//	echo "<br>RESULTADO: (".$resultado."/".$maxdays.") * ".$diasrol; "<br>";    
		 $resultado = ($resultado / $maxdays) * $diasrol; 
   } 
  
   
   
   return $resultado;

}



function omnisoftProcesarEmpleadoRolPagos($fecha,$serial_perrol,$empleado,$nombre_erp,$estado_erp,$tipogeneracion="INDIVIDUAL"){
   global $serial_epl,$serial_erp,$serial_rgr,$dblink,$fechaRol;
   
   $actualizacion=false;
   $sfecha=explode('-',$fecha);
   $SQLCmd="select serial_erp from empleadorolpagos where serial_perrol=".$serial_perrol." and serial_epl=".$empleado;
//   echo $SQLCmd. "<br>";;
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

   $fechaRol=$rsPeriodoRol->fields[0];


    $SQLCmd="select * from rubrogeneralrolpagos where (serial_tct=-99 or serial_tct = (select serial_tct from empleado where serial_epl=".$serial_epl.")) and estado_rgr='ACTIVO'";
	
//echo $SQLCmd."<br>";
    $resultSet=$dblink->Execute($SQLCmd);

    while (!$resultSet->EOF ) {
//    echo "formula =".$resultSet->fields['FORMULA_RGR']."<br>";
//echo "formula =".$fechaRol;

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
              $valor_drp=($frecuencia==0)? evaluarformula($resultSet->fields['SERIAL_RGR'], $resultSet->fields['FORMULA_RGR'],$fechaRol,$empleado):0;
             $SQLUpdate="update detallerolpagos set valor_drp=".$valor_drp." where serial_drp=".$rsSearch->fields[0];
            // echo "</p> uno :".$SQLUpdate;
             $dblink->Execute($SQLUpdate);
            }

    }

    if ($actualizacion==false) {
    $valor_drp=0;
    $cuota_drp=1;
    $valor_drp=($frecuencia==0)? evaluarformula($resultSet->fields['SERIAL_RGR'], $resultSet->fields['FORMULA_RGR'],$fechaRol,$empleado):0;
    $SQLCmd="insert into detallerolpagos (SERIAL_DRP, SERIAL_RGR, SERIAL_ERP, VALOR_DRP, CUOTA_DRP) values (0,".$resultSet->fields['SERIAL_RGR'].",".$serial_erp.",".$valor_drp.",".$cuota_drp.")";
    //echo "</p> dos :".$SQLCmd;
    $dblink->Execute($SQLCmd);
    }
      $resultSet->MoveNext();
    }

    if ($tipogeneracion=="INDIVIDUAL")
    echo $serial_erp."|";
}


   $query = $_REQUEST['query']; //defecto
//   $query = $_GET['query']; //defecto

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
//echo "******Fecha*****"."|".;   
    if ($params[0]=='INDIVIDUAL'){
	//$dblink->debug=true;
       omnisoftProcesarEmpleadoRolPagos($params[1],$params[2],$params[3],$params[5],$params[6]);
	   CALCULARIMPUESTORENTA_PROFESORES($params[2],$params[3]);
	  // $dblink->debug=false;
   }else {

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

       //$SQLCmd="select * from  empleado where prospecto_epl='NO' and estadonomina_epl='ACTIVO' and generarol_epl='SI' AND TIPOEMPLEADO_EPL<>'PROFESOR'";
	   $SQLCmd="select * from  empleado where prospecto_epl='NO' and ESTADOEMPLEADO_EPL='ACTIVO' and generarol_epl='SI' AND (TIPOEMPLEADO_EPL<>'PROFESOR' or  (TIPOEMPLEADO_EPL='PROFESOR' AND GENERAROL_EPL='SI')) order by APELLIDO_EPL";
       $rsEmpleado=$dblink->Execute($SQLCmd);
//echo  "</p> empl :".$SQLCmd;
       //$i=1;
	   while (!$rsEmpleado->EOF) {
	   	 //echo "TOTAL DE EMPLEADOS: ".$i;	
         omnisoftProcesarEmpleadoRolPagos($params[1],$params[2],$rsEmpleado->fields['SERIAL_EPL'],$params[5],$params[4],"GENERAL");
         $rsEmpleado->MoveNext();
		 $i++;
       }
	   //TOTALIZAR IMPUESTO A LA RENTA ADMINISTRATIVO Y PROFESOR
    	CALCULARIMPUESTORENTA_PROFESORES($params[2],0);
      ////echo $serial_rop."|";
   }
   
   
   
   

?>

