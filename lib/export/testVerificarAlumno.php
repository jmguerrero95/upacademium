<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$showList = verificarPagoCreditos(40293,$dblink);	
if($showList[0]['show'] == "SI"){
	echo "el alumno SI se puede mostrar porque:<br> ".$showList[0]['msg'];
	//$showList[0]['show']
}else{
	echo "El alumno NO se mostrará porque:<br> ".$showList[0]['msg'];
}


function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;
	//echo "<br>Registro#: ".$serial_mmat."<br>";
	//Buscar Creditos Tomados con el serial de materia matriculada
	$sqlCred = "
		SELECT
			mmat.serial_mmat,
			serial_alu,
			sum(numerocreditos_dmat+creditosequivalentes_dmat) as totalcreditos 
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO')     

			and mmat.serial_mmat = ".$serial_mmat."
		GROUP BY
			mmat.serial_mmat

	";
	echo "<br>CRED TOMADOS: ".$sqlCred."<br>";
	$rsCreditos = $dblink->Execute($sqlCred);
	while(!$rsCreditos->EOF){
		$creditosTomados = $rsCreditos->fields['totalcreditos'];
		$rsCreditos->MoveNext();
	}
	//Validacion Materia Toelf
	$sqlToefl = "
		SELECT
			mmat.serial_mmat,
			dmat.serial_mat,
			serial_alu
					
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			and mmat.serial_mmat = ".$serial_mmat."

	";
	//echo "<br>TOEFL: ".$sqlToefl."<br>";
	$rsToefl = $dblink->Execute($sqlToefl);
	$matToefl = 0;
	while(!$rsToefl->EOF){
		if($rsToefl->fields['serial_mat'] == 218){
			$matToefl = 1;	
		}		
		$rsToefl->MoveNext();
	}
	if($matToefl==1){
		$msg = "Es la materia TOEFL asi que debe salir obligatoriamente";
		$arrLista[0]['show'] = "SI";
		$arrLista[0]['msg'] = $msg;
		return $arrLista;		
	}
	//END


	//echo "<br>Creditos Tomados en el registro: ".$creditosTomados."<br>";
	//Verificar  si hay un pago de los creditos tomados
	$sqlCredFac = "
		SELECT 
			* 
		FROM 
			cabecerafactura 
		WHERE 
			serial_mmat = ".$serial_mmat
			;
	//echo "<br>SQL FACTURACION: ".$sqlCredFac."<br>";
	$rsCredFac = $dblink->Execute($sqlCredFac);
	$numRows = $rsCredFac->recordCount();
	if($numRows>0){
		//Verificar si credito tomado y pagado es el mismo
		$sqlCredNorm = "
		SELECT
			caf.serial_mmat,
			ara.nombre_ara,
			caf.serial_caf, 
			dcaf.serial_dar,
			cantidad_dfa as tcreditonormal
		FROM
			cabecerafactura as caf,
			detallefactura as dcaf,
			detallearancel as dar,
			aranceles as ara
		WHERE
			caf.serial_caf = dcaf.serial_caf 
			and dcaf.serial_dar = dar.serial_dar
			and ara.serial_ara = dar.serial_ara
			and caf.serial_mmat = ".$serial_mmat."			
		    and ara.credito_ara = 'SI'
		";
		//echo "<br>SQL Pagados: ".$sqlCredNorm."<br>";
		$creditosPagados = 0;
		$rsCredNorm = $dblink->Execute($sqlCredNorm);
		while(!$rsCredNorm->EOF){
			$creditosPagados = $creditosPagados +$rsCredNorm->fields['tcreditonormal'];
			$rsCredNorm->MoveNext();
		}		
		if($creditosPagados>=$creditosTomados){			
			$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, \n	
				  	ha Pagado: ".$creditosPagados." créditos, \n
				    Los créditos pagados son mayores o iguales que los créditos tomados, \n
 				    En consecuencia SI aparecerá en las listas...\n
			";					
			$arrLista[0]['show'] = "SI";
			$arrLista[0]['msg'] = $msg;
			return $arrLista;				
		}else{
			//Verificar si hay cruze para sumar creditos a los creditos ya pagados
			$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			//echo "<br>SQL CRUCE : ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				$totalCreditosAFavor = $creditosDevengados + $creditosPagados;
				if($totalCreditosAFavor>=$creditosTomados){
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, \n	
							ha Pagado: ".$creditosPagados." créditos, \n
						    ha Cruzado: ".$creditosDevengados." créditos, \n 
 					        tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, \n
							Los créditos a favor son mayores o iguales que los créditos tomados, \n
							En consecuencia SI aparecerá en las listas...\n
					";					
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;					
				}else{
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados."créditos, \n	
						  	Ha Pagado: ".$creditosPagados." créditos, \n
						    Ha Cruzado: ".$creditosDevengados." créditos, \n 
 					        Tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, \n
						    Los créditos a favor son menores que los créditos tomados, \n
 						    En consecuencia NO aparecerá en las listas, \n
						    Favor Comunicarse con el departamento Financiero...
					";					
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;	

				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados."créditos, \n	
					   Ha Pagado: ".$creditosPagados." créditos, \n
					   No registra cruzes de créditos, \n 
					   Los créditos pagados son menores alos créditos tomados, \n
 					   En consecuencia NO aparecerá en las listas, \n
					   Favor Comunicarse con el departamento Financiero...";
				$arrLista[0]['show'] = "NO";
				$arrLista[0]['msg'] = $msg;
				return $arrLista;	
				
			}		


		}

	}else{
		//No se hallan datos en cabecera factura verificar el cruce el alumno";
		$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			//echo "<br>SQL CRUCE: ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				if($creditosDevengados>=$creditosTomados){
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, \n	
						   No ha Pagado directamente créditos de este registro, \n
						   Ha cruzado ".$creditosDevengados.", créditos, \n 
						   Los créditos cruzados son mayores o iguales alos créditos tomados, \n
 					 	   En consecuencia SI aparecerá en las listas...				  	  
					";
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						

				}else{
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, \n	
						   No ha Pagado directamente créditos de este registro, \n
						   Ha cruzado ".$creditosDevengados.", créditos, \n 
						   Los créditos cruzados son menores alos créditos tomados, \n
 					 	   En consecuencia NO aparecerá en las listas, \n
						   Favor Comunicarse con el departamento Financiero...					  	  
					";
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						
				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, \n	
					   No ha Pagado directamente créditos de este registro, \n
					   No tiene registro de créditos cruzados, \n 
					   No se ha ha pagado los créditos tomados, \n 
 				 	   En consecuencia NO aparecerá en las listas, \n
					   Favor Comunicarse con el departamento Financiero...					  	  
				";
				$arrLista[0]['show'] = "NO";
				$arrLista[0]['msg'] = $msg;
				return $arrLista;						
			}		
	}
}











/*require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$showList = verificarPagoCreditos(39013,$dblink);	
//if($showList == "SHOW"){
	//echo "el alumno se se puede mostrar";
//}else{
//	echo "El alumno NO se mostrará";
//}


function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;
	echo "<br>Registro#: ".$serial_mmat."<br>";
	//Buscar Creditos Tomados con el serial de materia matriculada
	$sqlCred = "
		SELECT
			mmat.serial_mmat,
			serial_alu,
			sum(numerocreditos_dmat+creditosequivalentes_dmat) as totalcreditos 
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			and mmat.serial_mmat = ".$serial_mmat."
		GROUP BY
			mmat.serial_mmat

	";
	//echo "<br>CRED TOMADOS: ".$sqlCred."<br>";
	$rsCreditos = $dblink->Execute($sqlCred);
	while(!$rsCreditos->EOF){
		$creditosTomados = $rsCreditos->fields['totalcreditos'];
		$rsCreditos->MoveNext();
	}
	echo "<br>Creditos Tomados en el registro: ".$creditosTomados."<br>";
	//Verificar  si hay un pago de los creditos tomados
	$sqlCredFac = "
		SELECT 
			* 
		FROM 
			cabecerafactura 
		WHERE 
			serial_mmat = ".$serial_mmat
			;
	//echo "<br>SQL FACTURACION: ".$sqlCredFac."<br>";
	$rsCredFac = $dblink->Execute($sqlCredFac);
	$numRows = $rsCredFac->recordCount();
	if($numRows>0){
		echo "<br>VAMOS A VERIFICAR CREDITOS PAGADOS<br>";
		//Verificar si credito tomado y pagado es el mismo
		$sqlCredNorm = "
		SELECT
			caf.serial_mmat,
			ara.nombre_ara,
			caf.serial_caf, 
			dcaf.serial_dar,
			cantidad_dfa as tcreditonormal
		FROM
			cabecerafactura as caf,
			detallefactura as dcaf,
			detallearancel as dar,
			aranceles as ara
		WHERE
			caf.serial_caf = dcaf.serial_caf 
			and dcaf.serial_dar = dar.serial_dar
			and ara.serial_ara = dar.serial_ara
			and caf.serial_mmat = ".$serial_mmat."
			
		    and ara.credito_ara = 'SI'
		";
		echo "<br>SQL Pagados: ".$sqlCredNorm."<br>";
		$creditosPagados = 0;
		$rsCredNorm = $dblink->Execute($sqlCredNorm);
		while(!$rsCredNorm->EOF){
			$creditosPagados = $creditosPagados +$rsCredNorm->fields['tcreditonormal'];
			$rsCredNorm->MoveNext();
		}
		
		//$creditosPagadosNew = (string)$creditosTomados;
		echo "<br>Creditos Tomados: ".$creditosTomados."<br>";
		echo "<br>Creditos Pagados: ".$creditosPagados."<br>";		
		if($creditosPagados>=$creditosTomados){
			echo "<br>Todos los creditos tomados estan pagados puede aparecer en listas...<br>";
			//return "SHOW";		
		}else{
			echo "<br>No ha pagado todos los creditos tomados en el registro a Financiero Vamos a verificar en cruce...<br>";
		//BEGIN
			$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			echo "<br>SQL CRUCE : ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				$totalCreditosAFavor = $creditosDevengados + $creditosPagados;
				echo "<br>Creditos Devengados: ".$creditosDevengados."<br>";
				echo "<br>Creditos Devengados + Pagados: ".$totalCreditosAFavor."<br>";

				if($totalCreditosAFavor>=$creditosTomados){
					echo "<br>El estudiante pagó los creditos correctos puede salir en las listas...<br>";
					//return "SHOW";
				}else{
					//return "NOSHOW";
					echo "<br>Sumando el numero de creditos pagados contra los devengados no ha pagado los creditos tomados no aparecera en la lista...<br>";
				}
			}else{
				echo "<br>No hay datos de cruce tomo:  ".$creditosTomados." Creditos y solo pago: ".$creditosPagados." Creditos /n Acerquese a Financiero a legalizar su registro...UR<br>";
				//return "NOSHOW";
			}		

		//END

			//return "NOSHOW";		
		}

	}else{
		echo "<br>No se hallan datos en cabecera factura verificar el cruce el alumno<br>";
		$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			//echo "<br>SQL CRUCE: ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				if($creditosDevengados>=$creditosTomados){
					echo "<br>El estudiante pagó los creditos correctos puede salir en las listas...<br>";
					//return "SHOW";
				}else{
					//return "NOSHOW";
					echo "<br>El numero de creditos que tomo no es el mismo que pago a Financiero...<br>";
				}
			}else{
				echo "<br>No hay datos de cruce el alumno tomo:  ".$creditosTomados." Creditos y solo pago: ".$creditosPagados." Creditos /n Acerquese a Financiero a legalizar su registro...UR<br>";
				//return "NOSHOW";
			}		
	}
}*/

//////////////
?>