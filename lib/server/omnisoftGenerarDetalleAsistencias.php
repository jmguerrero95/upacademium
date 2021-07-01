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

function omnisoftCalcularNotasTerminales($seccion,$serial_nts) {
   /*echo "seccion: ".$seccion."</p>";
   echo "serial_nts: ".$serial_nts."</p>";*/

  global $dblink;
  $actualizacion=false;
  
  $SQLCmd_asis="SELECT serial_aalu, asistenciaalumno.serial_dho, asistenciaalumno.serial_dmat, fecha_aalu,
	   sum(asiste_aalu = 'SI') AS SI_ASISTE,
	   sum(asiste_aalu = '') AS NO_ASISTE,
	   sum(fjust_aalu= 'SI') AS F_JUSTIFICADAS,
	   count(asiste_aalu) AS TOTAL_ASISTENCIA,
	   round(((count(asiste_aalu)*porcentajefj_pcal )/100),2) AS PORCENTAJE_JUST,
	   round(((count(asiste_aalu)*porcentajefinj_pcal )/100),2) AS PORCENTAJE_INJUST,
	   if(sum(fjust_aalu = 'SI') >= ((count( asiste_aalu )*porcentajefj_pcal )/100),'REPRUEBA','APRUEBA'),
	   if((sum(asiste_aalu = '') - sum(fjust_aalu= 'SI')) >= ((count( asiste_aalu )*porcentajefinj_pcal )/100),'REPRUEBA','APRUEBA'),
	   if(sum(fjust_aalu= 'SI') + ((sum(asiste_aalu = '') - sum(fjust_aalu= 'SI'))) >= ((porcentajefj_pcal + porcentajefinj_pcal)*count( asiste_aalu )/100),'REPRUEBA','APRUEBA'),
					   sum(asiste_aalu = '') AS NO_ASISTE
 				FROM asistenciaalumno
				join detallehorario on asistenciaalumno.serial_dho = detallehorario.serial_dho
				join horario on detallehorario.serial_hrr = horario.serial_hrr
				join notas on horario.serial_hrr = notas.serial_hrr
				join periodo on horario.serial_per = periodo.serial_per
				join ponderacioncalificacion on periodo.serial_sec = ponderacioncalificacion.serial_sec
				WHERE notas.serial_nts = ".$serial_nts."
				GROUP BY serial_dmat";
		 
		 //echo "asistencias:.... ".$SQLCmd_asis."<br>";	
  $rsAsistenciasAlumnos=$dblink->Execute($SQLCmd_asis);
  

	  while (!$rsAsistenciasAlumnos->EOF) {
//chequea que si esta algun alumno se actualice (UPDATE), si es nuevo lo inserte

$sql_verifica=" SELECT serial_das, serial_dho, serial_dmat, serial_nts FROM detalleasistencia WHERE serial_nts = ".$serial_nts." AND serial_dho = ".$rsAsistenciasAlumnos->fields['serial_dho']." AND serial_dmat = ".$rsAsistenciasAlumnos->fields['serial_dmat']."";
	//echo "<br> sql_verifica: ".$sql_verifica. "<br>";
 $rsVerifica=$dblink->Execute($sql_verifica);		
	if ($rsVerifica->RecordCount() >0){	
	//echo "<br> SQLCmd_ASIS: ".$sql_verifica. "<br>";

	$SQLCmd_UpdateASIS="update detalleasistencia set totalclases_das = ".$rsAsistenciasAlumnos->fields[7].", asistencias_das = ".$rsAsistenciasAlumnos->fields[4].",fjust_das = ".$rsAsistenciasAlumnos->fields[6].", finjust_das = ".$rsAsistenciasAlumnos->fields[5].", estadofjust_das = '".$rsAsistenciasAlumnos->fields[10]."', estadofinjust_das = '".$rsAsistenciasAlumnos->fields[11]."', estadototalclases_das = '".$rsAsistenciasAlumnos->fields[12]."' where serial_das = ".$rsVerifica->fields['serial_das']." and serial_dho = ".$rsAsistenciasAlumnos->fields['serial_dho']."  and serial_nts = ".$serial_nts." and serial_dmat = ".$rsAsistenciasAlumnos->fields['serial_dmat']."";
				  //echo "<br> SQLCmd_UpdateASIS: ".$SQLCmd_UpdateASIS. "<br>";
					$dblink->Execute($SQLCmd_UpdateASIS);
			}else{		
			
	$SQLCmd_insertASIS="insert into detalleasistencia (serial_das, serial_dho, serial_dmat, serial_nts, totalclases_das, asistencias_das, fjust_das, finjust_das, estadofjust_das, estadofinjust_das, estadototalclases_das) values (0,".$rsAsistenciasAlumnos->fields['serial_dho'].",".$rsAsistenciasAlumnos->fields['serial_dmat'].",".$serial_nts.",".$rsAsistenciasAlumnos->fields[7].",".$rsAsistenciasAlumnos->fields[4].",".$rsAsistenciasAlumnos->fields[6].",".$rsAsistenciasAlumnos->fields[5].",'".$rsAsistenciasAlumnos->fields[10]."','".$rsAsistenciasAlumnos->fields[11]."','".$rsAsistenciasAlumnos->fields[12]."')";
				  //echo "<br> SQLCmd_insertASIS: ".$SQLCmd_insertASIS. "<br>";
					$dblink->Execute($SQLCmd_insertASIS);
			}
					$rsAsistenciasAlumnos->MoveNext();
	}

}
 $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

    omnisoftConnectDB();
    $params=explode('|',$query);

	                               //$sucursal,$seccion,$periodo,$materia,$horario,$serial_epl,$serial_nts,$ntotalclases_nts,$aporte
   omnisoftCalcularNotasTerminales($params[0],$params[1]);
//echo "|".$params[6]."|"
?>