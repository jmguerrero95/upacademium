<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$sucursal=0;
$programa=0;
$periodo=0;
$horario=0;
$empleado=0;
$serial_nts=0;
$ntotalclases=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;
$dblink = NewADOConnection($DBConnection);
}

function omnisoftProcesarAlumnosNotas($sucursal,$programa,$periodo,$horario,$empleado,$serial_nts,$ntotalclases) {
 global $dblink;
   $actualizacion=false;
   
/*  echo "sucursal: ".$sucursal."</p>";
  echo "programa: ".$programa."</p>";
  echo "periodo: ".$periodo."</p>";
  echo "horario: ".$horario."</p>";
  echo "empleado: ".$empleado."</p>";
  echo "serial_nts: ".$serial_nts."</p>";
  echo "ntotalclases: ".$ntotalclases."</p>";
*/
 

$SQLCmd_generar="insert into notasalumnos (serial_nal, serial_nts, serial_dmat, serial_cale, notatotal_nal, observaciones_nal) SELECT  0,".$serial_nts.",serial_dmat, serial_cale,0,'' FROM detallemateriamatriculada JOIN materiamatriculada ON detallemateriamatriculada.serial_mmat = materiamatriculada.serial_mmat JOIN alumno on alumno.serial_alu = materiamatriculada.serial_alu WHERE detallemateriamatriculada.serial_hrr =".$horario." and (serial_cale IS NOT NULL and serial_cale>0) and serial_dmat not in(select serial_dmat from notasalumnos ) and retiromateria_dmat!= 'SIN COSTO' ORDER BY apellidopaterno_alu, apellidomaterno_alu ";
	//echo "<br> SQLCmd_generar: ".$SQLCmd_generar. "<br>";  
 	 $resultSet=$dblink->Execute($SQLCmd_generar);	

    
	} 
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);

       omnisoftProcesarAlumnosNotas($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
//echo "|".$params[4]."|";
?>