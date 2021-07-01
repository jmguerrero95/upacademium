<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_ceva=0;
$serial_eva=0;
$codigo_are='';
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function omnisoftRegistrarEvaluacion($serial_teva,$serial_per,$cedula,$materia_profesor) {
 global $serial_ceva;
 global $serial_eva;
 global $codigo_are;
 global $dblink;
  
     $SQLCmd_generar="select serial_eva from evaluacion where SERIAL_TEVA=".$serial_teva." and ESTADO_EVA='ACTIVA'";
 //echo "<br> SQLCmd_generar: ".$SQLCmd_generar. "<br>";
     $resultTipo=$dblink->Execute($SQLCmd_generar);
	 $datos=explode('*',$materia_profesor);
	 $serial_hrr=$datos[0];
	 $serial_mat=$datos[1];
	 $serial_epl=$datos[2];
	 
	 //Para saber si es una materia de Lenguas and codigo_are='LEN'
	 
	   $SQLCmd_generar_area="select trim(codigo_are) as codigo_are,serial_mat from materia, area where materia.serial_are=area.serial_are and serial_mat=".$serial_mat;
//echo "<br> SQLCmd_generar: ".$SQLCmd_generar_area. "<br>";
     $resultArea=$dblink->Execute($SQLCmd_generar_area);
	 $codigo_are=$resultArea->fields["codigo_are"];
	 
	 /////////////////////////////////////
//concat(dmat.serial_hrr,\'*\',dmat.serial_mat,\'*\',e.serial_epl,\'*\',serial_dmat,\'*\',ama.serial_ama)

   if ($resultTipo->RecordCount()>0){
				$serial_eva=$resultTipo->fields["serial_eva"];
				//Consulta para verificar si ya tiene registrado la cabecera de la evaluacion
				$sqlQuery="select serial_ceva from cabecera_evaluacion where serial_eva=".$serial_eva."  and  serial_teva=".$serial_teva."  and identificacion_ceva='".$cedula."' and serial_per='".$serial_per."' and serial_mat=".$serial_mat." and serial_epl=".$serial_epl." and serial_hrr=".$serial_hrr."";
				//echo "<br>".$sqlQuery."<br>";
				$resultQuery=$dblink->Execute($sqlQuery);
				//Pregunta si hay registro de la evaluacion
					$serial_ceva=0;	
				 if ($resultQuery->RecordCount()>0){
				 		$serial_ceva=$resultQuery->fields["serial_ceva"];
					//	echo "obtiene_serial:".$serial_ceva;
				      //Elimina los datos de la evaluacion 
						$sqlDelete="delete from detalle_evaluacion where serial_ceva=".$serial_ceva."";
				        $dblink->Execute($sqlDelete);
				 }else{
						if($serial_teva==1){//ALUMNO
							$serial_dmat=$datos[3];
							$serial_alu=$datos[4];
							$SQLCmd_cabevaluacion="insert into cabecera_evaluacion (serial_eva,serial_alu,serial_dmat,serial_teva,fecha_ceva,identificacion_ceva,serial_per,serial_hrr,serial_mat,serial_epl) values (".$resultTipo->fields["serial_eva"].",".$serial_alu.",".$serial_dmat.",".$serial_teva.",now(),'".$cedula."',".$serial_per.",".$serial_hrr.",".$serial_mat.",".$serial_epl.")  ";
						
						}else{
							$SQLCmd_cabevaluacion="insert into cabecera_evaluacion (serial_hrr,serial_mat,serial_epl,serial_eva,serial_teva,fecha_ceva,identificacion_ceva,serial_per) values (".$serial_hrr.",".$serial_mat.",".$serial_epl.",".$resultTipo->fields["serial_eva"].",".$serial_teva.",now(),'".$cedula."',".$serial_per.")  ";
						}
						
						//echo "insert:<br>".$SQLCmd_cabevaluacion;
						//echo $serial_eva."|".$serial."|".$serial_mmat."|";
						
						$dblink->Execute($SQLCmd_cabevaluacion);
						$serial_ceva=(strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
						
					}		
		
    }  

 }
 
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   	omnisoftRegistrarEvaluacion($params[0],$params[1],$params[2],$params[3]);
	
	echo $serial_ceva."|".$serial_eva."|".$codigo_are."|";

	   
?>