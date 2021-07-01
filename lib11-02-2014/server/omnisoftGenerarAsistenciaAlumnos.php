<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_dho_aux=0;
$dblink='';

function omnisoftConnectDB() {
	global $DBConnection,$dblink;
	$dblink = NewADOConnection($DBConnection);
}

   $query = $_POST['query']; //defecto
  // $query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   omnisoftProcesarAsistenciaAlumno($params[0],$params[1]);
   

function omnisoftProcesarAsistenciaAlumno($serial_dho,$fecha_aasi) {

  global $serial_dho_aux,$dblink;

   $actualizacion=false;
$estuidiantes="select concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, nombre2_alu) as nombre, materiamatriculada.serial_mmat,serial_dho,detallemateriamatriculada.serial_dmat,now() as fecha,'' as observacion
			from detallemateriamatriculada,materiamatriculada,alumno,horario,detallehorario
			where detallemateriamatriculada.serial_mmat=materiamatriculada.SERIAL_MMAT
			and materiamatriculada.SERIAL_ALU=alumno.serial_alu
			and horario.SERIAL_HRR=detallemateriamatriculada.serial_hrr
			and horario.SERIAL_HRR=detallehorario.SERIAL_HRR
			and retiromateria_dmat=''
			and SERIAL_DHO=".$serial_dho."
			order by   apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu";
	
	//echo $estuidiantes."</p>";		
		
	$resultEstuidiantes=$dblink->Execute($estuidiantes);		
	
		$vecNombres="";
		
		$cont = $resultEstuidiantes->recordCount();
		if($cont>0){
			while(!$resultEstuidiantes->EOF){
			
					$showList = verificarPagoCreditos($resultEstuidiantes->fields['serial_mmat'],$dblink);	
								//echo "</p>".$showList[0]['show']."</p>";
//					if($showList[0]['show'] == "SI" or $programa == 2)
				  if($showList[0]['show'] == "SI"){
				
				   $SQLCmd="insert into asistenciaalumno (serial_dho,serial_dmat,fecha_aalu,observaciones_aalu) 
				   			values(".$resultEstuidiantes->fields['serial_dho'].",".$resultEstuidiantes->fields['serial_dmat'].",'".$resultEstuidiantes->fields['fecha']."','".$resultEstuidiantes->fields['observacion']."')";
				   
				 //  echo $SQLCmd."</p>";
				   
				   //. "<br>";;117009and serial_dmat not in (select serial_dmat from asistenciaalumno) 
				   $resultSet=$dblink->Execute($SQLCmd);
				   }
				   else{
				   		$vecNombres = $vecNombres.$resultEstuidiantes->fields['nombre']." | ";
						
						
				   }
				   
				   $resultEstuidiantes->MoveNext();
			}
			echo $vecNombres;
		}   
 
 	
   // echo $serial_dho."|";
}  



function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;
	//echo "<br>Registro#: ".$serial_mmat."<br>";
	
	$intercambio="SELECT
						* 
					FROM
						alumno as alu, materiamatriculada as mmat 
					WHERE alu.serial_alu=mmat.serial_alu and
						intercambio_alu LIKE 'VIENE%' and
						mmat.SERIAL_MMAT=".$serial_mmat;					
						$rsIntercambio = $dblink->Execute($intercambio);		
						$numI = $rsIntercambio->recordCount();
						if($numI>0){						
							$arrLista[0]['show'] = "SI";
							//$arrLista[0]['msg'] = $msg;
							return $arrLista;
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
			AND serial_mat not in(375,578,579) 	
		GROUP BY
			mmat.serial_mmat

	";
	//echo "<br>CRED TOMADOS: ".$sqlCred."<br>";
	$rsCreditos = $dblink->Execute($sqlCred);
	while(!$rsCreditos->EOF){
		$creditosTomados = $rsCreditos->fields['totalcreditos'];
		$rsCreditos->MoveNext();
	}
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
			$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, ha Pagado: ".$creditosPagados." créditos, Los créditos pagados son mayores o iguales que los créditos tomados,  				    En consecuencia SI aparecerá en las listas...";					
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
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, ha Pagado: ".$creditosPagados." créditos, ha Cruzado: ".$creditosDevengados." créditos, tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, Los créditos a favor son mayores o iguales que los créditos tomados, En consecuencia SI aparecerá en las listas...";					
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;					
				}else{
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados."créditos,	Ha Pagado: ".$creditosPagados." créditos, Ha Cruzado: ".$creditosDevengados." créditos, Tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, Los créditos a favor son menores que los créditos tomados, En consecuencia NO aparecerá en las listas, 
						    Favor Comunicarse con el departamento Financiero...";					
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;	

				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados."créditos, Ha Pagado: ".$creditosPagados." créditos, No registra cruzes de créditos, Los créditos pagados son menores alos créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...";
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
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, Ha cruzado ".$creditosDevengados.", créditos, Los créditos cruzados son mayores o iguales alos créditos tomados, En consecuencia SI aparecerá en las listas...				  	  
					";
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						

				}else{
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, Ha cruzado ".$creditosDevengados.", créditos, Los créditos cruzados son menores alos créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...					  	  					";
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						
				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, No tiene registro de créditos cruzados, No ha pagado los créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...";
				$arrLista[0]['show'] = "NO";
				$arrLista[0]['msg'] = $msg;
				return $arrLista;						
			}		
	}
}
 

?>
