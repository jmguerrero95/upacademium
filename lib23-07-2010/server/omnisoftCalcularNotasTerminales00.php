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
 	                                    
function omnisoftCalcularNotasTerminales($sucursal,$seccion,$periodo,$horario,$serial_epl,$serial_nts,$ntotalclases_nts) {
   echo "sucursal: ".$sucursal."</p>";
   echo "seccion: ".$seccion."</p>";
   echo "periodo: ".$periodo."</p>";
   echo "horario: ".$horario."</p>";
   echo "serial_epl: ".$serial_epl."</p>";
   echo "serial_nts: ".$serial_nts."</p>";
   echo "ntotalclases_nts: ".$ntotalclases_nts."</p>";

  global $dblink;
  $actualizacion=false;
  
  		$SQLCmd_alu="SELECT serial_nal, concat(apellidopaterno_alu, ' ', apellidomaterno_alu) AS apellidos, concat(nombre1_alu, ' ', nombre2_alu) AS nombres, materiamatriculada.serial_alu, notasalumnos.serial_dmat, notatotal_nal, notasalumnos.serial_nts, alumno.serial_cale
	FROM notasalumnos JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat
				  	  JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat
				      JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu
	WHERE proceso_alu = 'REGISTRO'
	AND notasalumnos.serial_nts =".$serial_nts." ORDER BY apellidos";
	echo "Alumnos:.... ".$SQLCmd_alu."<br>";
   $rsAlumno=$dblink->Execute($SQLCmd_alu);

  
    	$SQLCmd="SELECT acal.serial_acal, codigo_acal, abrevia_acal, valor_dpon, (0.01*valor_dpon) as ponderacion, pcal.serial_pcal, serial_sec, fecha_pcal, 					activo_pcal, tipo_acal, formula_acal, serial_dpon, dpon.serial_acal,pcal.porcentajefj_pcal, pcal.porcentajefinj_pcal
		FROM ponderacioncalificacion as pcal
     		 left join  detalleponderacion as dpon on dpon.serial_pcal = pcal.serial_pcal
      		 left join  aportescalificacion AS acal on dpon.serial_acal = acal.serial_acal
	  where  tipo_acal = 'DIGITADO'
      		 and serial_sec= ".$seccion."";
  	echo "APORTE:.... ".$SQLCmd."<br>";
   $rsAporte=$dblink->Execute($SQLCmd);
   
   
$sql="select formula_acal from aportescalificacion where tipo_acal = 'CALCULADO'";
	//echo "FoRMULA:.... ".$sql."<br>";
	$rsFormula=$dblink->Execute($sql); 
	$formulaaux=$rsFormula->fields[0];
echo "formula_acal:.... ".$rsFormula->fields[0]. "<br>";
	echo "formula:.... ".$formula. "<br>";	
	   
   while (!$rsAlumno->EOF) { 
   $formula=$formulaaux;
   
   //$rsAporte->MoveFirst();		
	 	 while (!$rsAporte->EOF) {
		 
    $codigo_acal=$rsAporte->fields['codigo_acal'];

	$SQLCmd_parcial="SELECT serial_dnal, detallenotasalumnos.serial_nal, detallenotasalumnos.serial_acal, nota_dnal, aportescalificacion.codigo_acal, 
					@notaponderada:= (nota_dnal * (0.01 * valor_dpon )) AS notaponderada_dnal, notas.serial_suc, notas.serial_per, notas.serial_hrr
			 		FROM    detallenotasalumnos JOIN detalleponderacion ON detalleponderacion.serial_acal = detallenotasalumnos.serial_acal
												JOIN ponderacioncalificacion ON ponderacioncalificacion.serial_pcal = detalleponderacion.serial_pcal
												JOIN aportescalificacion ON aportescalificacion.serial_acal = detalleponderacion.serial_acal, 
							notasalumnos 	JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat
											JOIN notas ON notas.serial_nts = notasalumnos.serial_nts
											JOIN materiamatriculada ON detallemateriamatriculada.serial_mmat = materiamatriculada.serial_mmat
					WHERE   detallenotasalumnos.serial_nal = notasalumnos.serial_nal
						    AND notasalumnos.serial_dmat = detallemateriamatriculada.serial_dmat
						    AND ponderacioncalificacion.serial_sec = materiamatriculada.serial_sec
						    AND notasalumnos.serial_nts = ".$serial_nts."
							AND aportescalificacion.codigo_acal = '".$codigo_acal."'
						    AND detallenotasalumnos.serial_acal = ".$rsAporte->fields['serial_acal']."
							AND notasalumnos.serial_dmat = ".$rsAlumno->fields['serial_dmat']."";
	echo "Parcial_Alumno:.... ".$SQLCmd_parcial."<br>";
   $rsParcial=$dblink->Execute($SQLCmd_parcial);
   
    if ($rsParcial && $rsParcial->RecordCount()>0) 
                		 $formula=str_replace($codigo_acal,$rsParcial->fields[5],$formula);
   
   /*echo "serial_dnal:.... ".$rsParcial->fields['serial_dnal']. "<br>";
   echo "nota_dnal:.... ".$rsParcial->fields['nota_dnal']. "<br>";
   echo "notaponderada_dnal:.... ".$rsParcial->fields['notaponderada_dnal']. "<br>";
   echo "codigo_acal:.... ".$rsParcial->fields['codigo_acal']. "<br>";
   echo "serial_acal:.... ".$rsParcial->fields['serial_acal']. "<br>";*/
     $rsAporte->MoveNext();	
   								}
	$resultado=eval("return $formula;");
	//echo "Total_Ponderado:.... ".$resultado."<br>";	
	
	 $equivalencia = "SELECT serial_dcale, serial_cale, alfabetica_dcale, numerica_dcale, relativa_dcale,rangocalificacionini_dcale,
 rangocalificacionfin_dcale, estado_dcale FROM detallecalificacionequivalencia where serial_cale=".$rsAlumno->fields['serial_cale']."";
				  echo "equivalencia:.... ".$equivalencia."<br>";
	$rsNotaEq=$dblink->Execute($equivalencia); 
	
	$rsNotaEq->MoveFirst();
	while (!$rsNotaEq->EOF) { 
	
if($rsNotaEq->fields[5]<=$resultado && $rsNotaEq->fields[6]>=$resultado){	
	$serial_dcale=$rsNotaEq->fields[0];
	$nota_alfab=$rsNotaEq->fields[2];
	echo $nota_alfab.'<br>';
	 $nota_numerica=$rsNotaEq->fields[3];
	 //echo $nota_numerica.'<br>';
	 $nota_relativa=$rsNotaEq->fields[4];
	 //echo $nota_relativa.'<br>';
	 $nota_fin=$rsNotaEq->fields[6];
	 //echo $nota_fin.'<br>';	 
	 $nota_ini=$rsNotaEq->fields[5];
	 //echo $nota_ini.'<br>';
	 $estado=$rsNotaEq->fields[7];
	 //echo $estado.'<br>';
	}	
	  $rsNotaEq->MoveNext();	
	}
	
	
  if (!$rsAlumno || $rsAlumno->RecordCount()>0 ) {

	$SQLCmd_VerificaNOTATOTAL="SELECT serial_nal, serial_nts, serial_dmat, serial_cale 
				FROM notasalumnos 
				WHERE serial_nts = ".$serial_nts." 
					  and serial_dmat = ".$rsAlumno->fields['serial_dmat']." 
					  and serial_cale = ".$rsAlumno->fields['serial_cale']."";
	echo "<br> SQLCmd_VerificaNOTATOTAL: ".$SQLCmd_VerificaNOTATOTAL."<br>";
	$rsVerificaNOTATOTAL=$dblink->Execute($SQLCmd_VerificaNOTATOTAL);
	
	if ($rsVerificaNOTATOTAL->RecordCount() >0){	

	$SQLCmd_UpdateNOTATOTAL="UPDATE notasalumnos SET notatotal_nal = ".$resultado.", notaalfabetica_nal = '".$nota_alfab."' WHERE serial_nts = ".$serial_nts." and serial_dmat = ".$rsAlumno->fields['serial_dmat']."";
			  echo "<br> SQLCmd_UpdateNOTATOTAL: ".$SQLCmd_UpdateNOTATOTAL. "<br>";
					$dblink->Execute($SQLCmd_UpdateNOTATOTAL);
					//echo "serial_aluuu8u:.... ".$rsAlumnoMateriaProfesor->fields['serial_alu']. "<br>";
					//$serial_dnal=".$rsVerifica->fields['serial_dnal'].";
					}else{
echo "<br> entro_insertarNOTALU";
	$SQLCmd_insertNOTATOTAL="INSERT INTO  notasalumnos ( serial_nal, serial_nts, serial_dmat, serial_cale, notatotal_nal, notaalfabetica_nal) VALUES (0,".$serial_nts.",".$rsAlumno->fields['serial_dmat'].",".$rsAlumno->fields['serial_cale'].",".$resultado.",'".$nota_alfab."' )";
				  echo "<br> SQLCmd_insertNOTATOTAL: ".$SQLCmd_insertNOTATOTAL. "<br>";
					$dblink->Execute($SQLCmd_insertNOTATOTAL);	
					}
	
		}			
			
			$rsAlumno->MoveNext();
		}

      echo $serial_prc."|";
	}

 $query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

    omnisoftConnectDB();
    $params=explode('|',$query);

   omnisoftCalcularNotasTerminales($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
?>