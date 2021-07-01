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

function omnisoftConnectDB() {  // funcion para conectar a base de datos
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection); // variable con el que me conectare a base de datos

}
 	                                    
function omnisoftCalcularNotasTerminales($sucursal,$seccion,$periodo,$horario,$serial_epl,$serial_nts,$ntotalclases_nts) {
global $dblink;
$actualizacion=false;
//echo "Entro:.... ";
$sql="select formula_acal from aportescalificacion where tipo_acal = 'CALCULADO'";
	
$rsFormula=$dblink->Execute($sql);// ejecucion de la sentencia 
$formulaaux=$rsFormula->fields[0]; // elije el primer registro  asi+ ti+ expart+ exfin
//echo "FoRMULA:.... ".$formulaaux."<br>";
$formula=$formulaaux; // guarda  SI+TI+ EXPART + EXFIN EN esta variable
//echo "formula_acal:.... ".$rsFormula->fields[0]. "<br>";
//echo "formula:.... ".$formula. "<br>";	
/****AQUI INGRESO LOS APORTES PARCIALES, CON EL ROUND LE MODIFIQUE PARA QUE EL ROUND LES INGRESE CON UN DECIMAL Y POR ENDE CALCULE EL TOTAL CON UNO
****/
$SQLCmd_parcial="SELECT serial_dnal, detallenotasalumnos.serial_nal, detallenotasalumnos.serial_acal, nota_dnal, aportescalificacion.codigo_acal, 
					@notaponderada:=(nota_dnal * (0.01 * valor_dpon )) AS notaponderada_dnal, notas.serial_suc, notas.serial_per, notas.serial_hrr,notasalumnos.serial_dmat,notasalumnos.serial_cale,nota_dnal
			 		FROM    detallenotasalumnos,notasalumnos JOIN detalleponderacion ON detalleponderacion.serial_acal = detallenotasalumnos.serial_acal
											JOIN ponderacioncalificacion ON ponderacioncalificacion.serial_pcal = detalleponderacion.serial_pcal
											JOIN aportescalificacion ON aportescalificacion.serial_acal = detalleponderacion.serial_acal 
							 				JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat
											JOIN notas ON notas.serial_nts = notasalumnos.serial_nts
											JOIN materiamatriculada ON detallemateriamatriculada.serial_mmat = materiamatriculada.serial_mmat
					WHERE   detallenotasalumnos.serial_nal = notasalumnos.serial_nal
						    AND ponderacioncalificacion.serial_sec = materiamatriculada.serial_sec
						    AND notas.serial_nts = ".$serial_nts." order by notasalumnos.serial_dmat,aportescalificacion.codigo_acal";	
//	echo "Parcial_Alumno:.... ".$SQLCmd_parcial."<br>";
$rsParcial=$dblink->Execute($SQLCmd_parcial);
$serial_dmat=0;	
	$cont=1;	 
	 
	while (!$rsParcial->EOF) {
	
			 
			     if($rsParcial->fields['serial_dmat']<>$serial_dmat && $serial_dmat<>0){
			       $resultado=eval("return $formula;");
				echo "<br>";
				 echo "resultado".$resultado."seria_dmat".$serial_dmat;
				   if($resultado>='70')
				   {
				   $nota_alfab="A";
				     $estado="APRUEBA";
				   echo $estado;
				   
				   } elseif($resultado<=69){
				   
				    $nota_alfab="C";
					echo $estado; 
				     $estado="REPRUEBA1";
				   
				   }
				
		  $SQLCmd_UpdateNOTATOTAL="UPDATE notasalumnos SET notatotal_nal = ".$resultado.", notaalfabetica_nal = '".$nota_alfab."', estado_nal = '".$estado."' WHERE serial_nts = ".$serial_nts." and serial_dmat = ".$serial_dmat."";
				 // echo "<br> SQLCmd_UpdateNOTATOTAL: ".$SQLCmd_UpdateNOTATOTAL. "<br>";
		  $dblink->Execute($SQLCmd_UpdateNOTATOTAL);
		 
		  $formula=$formulaaux;
		
		} //FINAL  if($rsParcial->fields['serial_dmat']<>$serial_dmat && $serial_dmat<>0
		
		
$SQLCmd_UpdateNOTAPONDERADA="UPDATE detallenotasalumnos SET notaponderada_dnal = ".$rsParcial->fields['notaponderada_dnal']."  WHERE serial_dnal = ".$rsParcial->fields['serial_dnal']."";
//echo "<br> NOTA_PONDERADA: ".$rsParcial->fields['serial_dmat']."------".$SQLCmd_UpdateNOTAPONDERADA. "<br>";
$dblink->Execute($SQLCmd_UpdateNOTAPONDERADA);   
$formula=str_replace($rsParcial->fields['codigo_acal'],$rsParcial->fields['nota_dnal'],$formula);

$serial_dmat=$rsParcial->fields['serial_dmat'];
$serial_cale=$rsParcial->fields['serial_cale'];
	
$rsParcial->MoveNext();	
	 
	 
} //FINAL   while (!$rsParcial->EOF
	
//echo "resultado".$resultado;  	
	$resultado=eval("return $formula;");
	$resultado=round($resultado,2);
	   
			       
				   if($resultado>=70)
				   {
				   
				   $nota_alfab="A";
				     $estado="APRUEBA";
				   
				   
				   }elseif($resultado<=69){
				   
				    $nota_alfab="C";
				     $estado="REPRUEBA2";
				   
				   }

//Actualiza la tabla notasalumnos con el total ponderado del alumno
$SQLCmd_UpdateNOTATOTAL="UPDATE notasalumnos SET notatotal_nal = ".$resultado.", notaalfabetica_nal = '".$nota_alfab."', estado_nal = '".$estado."'  WHERE serial_nts = ".$serial_nts." and serial_dmat = ".$serial_dmat."";
//echo "<br> SQLCmd_UpdateNOTATOTAL000000: ".$SQLCmd_UpdateNOTATOTAL. "<br>";
$dblink->Execute($SQLCmd_UpdateNOTATOTAL);
$formula=$formulaaux;
 //echo "|".$serial_nts."|"
		
		
	/////////////////////////////// FINAL DE LA FUNCION ////////////////	
		
}// final de la funcion

 $query = $_POST['query'];
 echo  $query;

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);
echo  $query;
    omnisoftConnectDB();
    $params=explode('|',$query);

   omnisoftCalcularNotasTerminales($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
   //echo "|".$params[5]."|"
?>