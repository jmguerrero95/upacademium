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
   global $dblink;
  $actualizacion=false;
  //echo "Entro:.... ";
$sql="select formula_acal from aportescalificacion where tipo_acal = 'CALCULADO'";
	//echo "FoRMULA:.... ".$sql."<br>";
	$rsFormula=$dblink->Execute($sql); 
	$formulaaux=$rsFormula->fields[0];
	$formula=$formulaaux;
	//echo "formula_acal:.... ".$rsFormula->fields[0]. "<br>";
	//echo "formula:.... ".$formula. "<br>";	

/****AQUI INGRESO LOS APORTES PARCIALES, CON EL ROUND LE MODIFIQUE PARA QUE EL ROUND LES INGRESE CON UN DECIMAL Y POR ENDE CALCULE EL TOTAL CON UNO
****/
   $SQLCmd_parcial="SELECT serial_dnal, detallenotasalumnos.serial_nal, detallenotasalumnos.serial_acal, nota_dnal, aportescalificacion.codigo_acal, 
					@notaponderada:=(nota_dnal * (0.01 * valor_dpon )) AS notaponderada_dnal, notas.serial_suc, notas.serial_per, notas.serial_hrr,notasalumnos.serial_dmat,notasalumnos.serial_cale
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
		 
	 while (!$rsParcial->EOF) {
		 
		if($rsParcial->fields['serial_dmat']<>$serial_dmat && $serial_dmat<>0){
			$resultado=eval("return $formula;");
			$resultado=round($resultado,2);
			//echo "Total_Ponderado555:.... ".$resultado."<br>";
			 //echo "serial_dmat:.... ".$serial_dmat. "<br>";
   //echo "serial_dmat:.... ".$rsParcial->fields['serial_dmat']. "<br>";
   //echo "serial_dnal:.... ".$rsParcial->fields['serial_dnal']. "<br>";
   //echo "nota_dnal:.... ".$rsParcial->fields['nota_dnal']. "<br>";
   //echo "notaponderada_dnal:.... ".$rsParcial->fields['notaponderada_dnal']. "<br>";
   //echo "codigo_acal:.... ".$rsParcial->fields['codigo_acal']. "<br>";
   //echo "serial_acal:.... ".$rsParcial->fields['serial_acal']. "<br>";
   //echo "Total_Ponderado:.... ".$resultado."<br>";	
			//Obtiene la nota alfabetica equivalente al resultado
			$equivalencia = "SELECT serial_dcale, serial_cale, alfabetica_dcale, numerica_dcale, relativa_dcale,rangocalificacionini_dcale,
 rangocalificacionfin_dcale, estado_dcale FROM detallecalificacionequivalencia where serial_cale=".$serial_cale." and estado_dcale is not null";
				//echo "equivalencia:.... ".$equivalencia."<br>";
	$rsNotaEq=$dblink->Execute($equivalencia); 
	
		//	$rsNotaEq->MoveFirst();
				while (!$rsNotaEq->EOF) { 
				//echo "ENTRO nota alfabetica";
						if($rsNotaEq->fields["rangocalificacionini_dcale"]<=$resultado && $rsNotaEq->fields["rangocalificacionfin_dcale"]>=$resultado){	
						//echo "ENTRO nota alfabetica equivalente al resultado";
						$serial_dcale=$rsNotaEq->fields[0];
						$nota_alfab=$rsNotaEq->fields[2];
						 //echo "**********nota_alfab:.... ".$nota_alfab."<br>";
						 //echo $nota_alfab.'<br>';
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
				//Actualiza la tabla notasalumnos con el total ponderado del alumno
				$SQLCmd_UpdateNOTATOTAL="UPDATE notasalumnos SET notatotal_nal = ".$resultado.", notaalfabetica_nal = '".$nota_alfab."', estado_nal = '".$estado."' WHERE serial_nts = ".$serial_nts." and serial_dmat = ".$serial_dmat."";
				 // echo "<br> SQLCmd_UpdateNOTATOTAL: ".$SQLCmd_UpdateNOTATOTAL. "<br>";
					$dblink->Execute($SQLCmd_UpdateNOTATOTAL);
					   $formula=$formulaaux;
		} 
		
  		$SQLCmd_UpdateNOTAPONDERADA="UPDATE detallenotasalumnos SET notaponderada_dnal = ".$rsParcial->fields['notaponderada_dnal']."  WHERE serial_dnal = ".$rsParcial->fields['serial_dnal']."";
		//echo "<br> NOTA_PONDERADA: ".$rsParcial->fields['serial_dmat']."------".$SQLCmd_UpdateNOTAPONDERADA. "<br>";
		$dblink->Execute($SQLCmd_UpdateNOTAPONDERADA);   
								
        $formula=str_replace($rsParcial->fields['codigo_acal'],$rsParcial->fields['notaponderada_dnal'],$formula);
 /*  echo "serial_dmat:.... ".$rsParcial->fields['serial_dmat']. "<br>";
       echo "serial_dnal:.... ".$rsParcial->fields['serial_dnal']. "<br>";
       echo "nota_dnal:.... ".$rsParcial->fields['nota_dnal']. "<br>";
       echo "notaponderada_dnal:.... ".$rsParcial->fields['notaponderada_dnal']. "<br>";
	   echo "codigo_acal:.... ".$rsParcial->fields['codigo_acal']. "<br>";
	   echo "serial_acal:.... ".$rsParcial->fields['serial_acal']. "<br>";
	   echo "Total_Ponderado:.... ".$resultado."<br>";*/
	   $serial_dmat=$rsParcial->fields['serial_dmat'];
	   $serial_cale=$rsParcial->fields['serial_cale'];
	   
     $rsParcial->MoveNext();	
	 
	 
   	}
	
	
			$resultado=eval("return $formula;");
			//echo "Total_Antes:.... ".$resultado."<br>";
			$resultado=round($resultado,2);
			//echo "Total_Ponderado555:.... ".$resultado."<br>";
			//echo "NUSSDKJ: ".round(84.29765767,2);
   //echo "-----------------------------------------------------------------------------------------------------------------";		
   /*echo "serial_dnal111:.... ".$rsParcial->fields['serial_dnal']. "<br>";
   echo "nota_dnal1111:.... ".$rsParcial->fields['nota_dnal']. "<br>";
   echo "notaponderada_dnal1111:.... ".$rsParcial->fields['notaponderada_dnal']. "<br>";
   echo "codigo_acal1111:.... ".$rsParcial->fields['codigo_acal']. "<br>";
   echo "serial_acal1111:.... ".$rsParcial->fields['serial_acal']. "<br>";
   echo "Total_Ponderado555:.... ".$resultado."<br>";
			
			echo "Total_Ponderado000000:.... ".$resultado."<br>";	*/
			
			//Obtiene la nota alfabetica equivalente al resultado
			$equivalencia = "SELECT serial_dcale, serial_cale, alfabetica_dcale, numerica_dcale, relativa_dcale,rangocalificacionini_dcale,
 rangocalificacionfin_dcale, estado_dcale FROM detallecalificacionequivalencia where serial_cale=".$serial_cale." and estado_dcale is not null";
				//echo "equivalencia:.... ".$equivalencia."<br>";
	$rsNotaEq=$dblink->Execute($equivalencia); 

		//	$rsNotaEq->MoveFirst();
				while (!$rsNotaEq->EOF) { 
						if($rsNotaEq->fields["rangocalificacionini_dcale"]<=$resultado && $rsNotaEq->fields["rangocalificacionfin_dcale"]>=$resultado){	
						$serial_dcale=$rsNotaEq->fields[0];
						$nota_alfab=$rsNotaEq->fields[2];
						//echo "**********nota_alfab:.... ".$nota_alfab."<br>";
						 //echo $nota_alfab.'<br>';
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
				//Actualiza la tabla notasalumnos con el total ponderado del alumno
				$SQLCmd_UpdateNOTATOTAL="UPDATE notasalumnos SET notatotal_nal = ".$resultado.", notaalfabetica_nal = '".$nota_alfab."', estado_nal = '".$estado."'  WHERE serial_nts = ".$serial_nts." and serial_dmat = ".$serial_dmat."";
				 //echo "<br> SQLCmd_UpdateNOTATOTAL000000: ".$SQLCmd_UpdateNOTATOTAL. "<br>";
					$dblink->Execute($SQLCmd_UpdateNOTATOTAL);
					   $formula=$formulaaux;
					     //echo "|".$serial_nts."|"
		}

 $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

    omnisoftConnectDB();
    $params=explode('|',$query);

   omnisoftCalcularNotasTerminales($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
   //echo "|".$params[5]."|"
?>