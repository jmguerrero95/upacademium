<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
//require('../server/funciones.php');

$dblink='';

function SI($condicion,$verdadero,$falso){
return($condicion?$verdadero:$falso);
}

function REDONDEAR($numero,$decimales=0){
return(round($numero,$decimales));
}

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}
 										//serial_suc+"|"+serial_sec+"|"+serial_per+"|"+serial_hrr+"|"+serial_epl+"|"+serial_nts+"|"+ntotalclases_nts+"|";
function omnisoftCalcularNotasTerminales($sucursal,$seccion,$periodo,$materia,$horario,$serial_epl,$serial_nts,$ntotalclases_nts,$aporte) {
   /*echo "sucursal: ".$sucursal."</p>";  
AND detalleponderacion.serial_dpon =2
   echo "seccion: ".$seccion."</p>";
   echo "periodo: ".$periodo."</p>";
   echo "materia: ".$materia."</p>";
   echo "horario: ".$horario."</p>";
   echo "serial_epl: ".$serial_epl."</p>";
   echo "serial_nts: ".$serial_nts."</p>";
   echo "ntotalclases_nts: ".$ntotalclases_nts."</p>";
   echo "aporte: ".$aporte."</p>";*/
   

  global $dblink;
  $actualizacion=false;

  //if($profesor=='TODOS' && $materia=='TODOS')
  
	$SQLCmd_alu="insert into detallenotasalumnos (serial_dnal, serial_nal, serial_acal, nota_dnal, notaponderada_dnal) select 0,serial_nal,".$aporte.",0,0 from notasalumnos,notas where notasalumnos.serial_nts=notas.serial_nts and notas.serial_nts=".$serial_nts." and serial_nal not in (select serial_nal from detallenotasalumnos where serial_acal = ".$aporte.")"; 
				 //echo "profesor_materiaTODOS:.... ".$SQLCmd_alu."<br>";	 
  $rsAlumnoMateriaProfesor=$dblink->Execute($SQLCmd_alu);

 
	 

}
 $query = $_REQUEST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

    omnisoftConnectDB();
    $params=explode('|',$query);

	                               //$sucursal,$seccion,$periodo,$materia,$horario,$serial_epl,$serial_nts,$ntotalclases_nts,$aporte
   omnisoftCalcularNotasTerminales($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);
//echo "|".$params[8]."|"
?>