<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');


$serial_horario=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}


function omnisoftProcesarHorarios($serial_hrr,$fecha,$intervalo,$serial_hora,$serial_per) {
	   
/*	   echo $serial_hrr."|";
	   echo $fecha."|";
	   echo $intervalo."|"; 
	   echo $serial_hora."|";
	   echo $serial_per."|";*/
	   //echo $_POST['serial_per'];

 global $serial_horario;
 global $dblink;
     $SQLCmd_periodo="SELECT serial_per, fecfin_per, fecini_per 
			from periodo
			WHERE serial_per = ".$serial_per;
			//echo $serial_per;

//echo "esto pregunta por orario ---"."<br> SQLCmd_generar: ".$SQLCmd_periodo. "<br>";
   
$resultSet=$dblink->Execute($SQLCmd_periodo);

if ($resultSet->RecordCount()>0){
		//echo $resultSet;
		$fecha_ini=$fecha;
		$salir=0;
		$i=0;
		$error=0;
		do{	
				$SQLCmd_fecha="SELECT case when  max(FECHACLASE_DHO) is null then '".$fecha."' else  DATE_ADD(max(FECHACLASE_DHO), INTERVAL ".$intervalo." DAY) end fecha_hrr  from detallehorario WHERE serial_hrr=".$serial_hrr." and FECHAINICIO_DHO='".$fecha."'";

//			   echo "esto pregunta por fecha ---"."<br> SQLCmd_generar: ".$SQLCmd_fecha. "<br>";
			   $resultfecha=$dblink->Execute($SQLCmd_fecha);
			   if ($resultfecha->RecordCount() >0){
				   //echo "paso 1";
					if($resultfecha->fields['fecha_hrr']<=$resultSet->fields['fecfin_per'] && $resultfecha->fields['fecha_hrr']!="" && $resultfecha->fields['fecha_hrr']>=$resultSet->fields['fecini_per']){
						//echo"paso 2";
						$error=1;
						$SQLCmd_insertDETALLE=" insert into detallehorario ( SERIAL_HRR,SERIAL_HORA, FECHACLASE_DHO,FECHAINICIO_DHO,GENERADO_DHO) values(".$serial_hrr.",".$serial_hora.",'".$resultfecha->fields['fecha_hrr']."','".$fecha_ini."','SI')";
						//echo "esto Inserta ---"."<br> SQLCmd_generar: ".$SQLCmd_insertDETALLE. "<br>";
						 //echo "<br> SQLCmd_insertMAB: ".$SQLCmd_insertDETALLE. "<br>";
						$dblink->Execute($SQLCmd_insertDETALLE);
						//$serial_mab=$dblink->Insert_ID();						
					}else{ 
						if($error==0){echo "Ingrese una fecha dentro del periodo académico";}else {echo "Los horarios se guardaron satisfactoriamente";}
					};
					
				}else {$salir=1;}	
			if($i==1000){ $salir=1;	break;}
		} while ($resultfecha->fields['fecha_hrr']<=$resultSet->fields['fecfin_per'] && $resultfecha->fields['fecha_hrr']>=$resultSet->fields['fecini_per'] && $salir==0);	
 		
   }
   $serial_horario=$serial_hrr;
 }
 //$resultfecha->field['fecha_hrr']<=$resultSet->field['fecfin_per'] ||
 
   
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
    /* echo $params[0];
  	 echo ' <br><br><br> sucursal '.$params[0]; 
	   //echo '<br>  minimo_inscritos nada';
	   echo '<br>  periodo '.$params[1];
	   echo '<br>  seccion '.$params[2];
	   echo '<br>  observaciones '.$params[3]; */  
	//  $serial=$params[4];
//	settype($serial,"integer");
 	//echo '<br>  serial '.$serial;
  
       omnisoftProcesarHorarios($params[0],$params[1],$params[2],$params[3],$params[4]);

	   
?>