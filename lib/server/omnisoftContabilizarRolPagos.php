<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftContabilidad.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

/*
function leerSecuenciaTipoComprobante($dblink,$tipo) {

   $SQLSecuencia="select numero_tic from tipocomprobante where serial_tic=".$tipo;
   $rsSecuencia=$dblink->Execute($SQLSecuencia);
   $resultado=(!$rsSecuencia || $rsSecuencia->RecordCount()<=0)? 1 : $rsSecuencia->fields[0]+1;
   return $resultado;
}


function actualizarSecuenciaTipoComprobante($dblink,$tipo,$numero_tic) {

   $SQLSecuencia="update tipocomprobante set numero_tic=".$numero_tic." where serial_tic=".$tipo;
   //echo $SQLSecuencia;
   $dblink->Execute($SQLSecuencia);

   return (strlen($dblink->ErrorMsg())<=0);

}


function insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$monto_com,$estado_com,$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per) {


   $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,usuario_com,serial_tic,modulo_com,serial_age,codigo_com,numero_com,serial_per) values (0,'".$fecha_com."','" .$concepto_com."',".$monto_com.",'".$estado_com."',".$serial_usr.",".$serial_tic.",'NOMINA',".$serial_age.",'".$codigo_com."',".$numero_com.",".$serial_per.")";
  //echo $SQLCommand."<br>";

  

   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();

}


function insertarDetalleComprobante($dblink,$serial_com,$serial_plc,$debe,$haber,$descripcion,$referencia,$serial_dep) {

   //$serial_desc=(strlen($_COOKIE['serial_desc'])>0)? $_COOKIE['serial_desc']:1;
   //$serial_desc=1;
   $SQLCommand="insert into detallecomprobante (serial_det, serial_plc, serial_com, debe_det, haber_det, descripcion_det, referencia_det, serial_dep) values (0,'" .$serial_plc."','".$serial_com."',".$debe.",".$haber.",'".$descripcion."','".$referencia."',".$serial_dep.")";
  //echo $SQLCommand."<br>";
   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
}
*/

function omnisoftContabilizar() {

  global  $_POST,$omnisoftCOMPROBANTEROLPAGOS;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   
   $params=explode('|',$query);
   
   $fecha_com=$params[0];
   $concepto_com=$params[1];
   $serial_perrol=$params[2];
   $rs_periodo=omnisoftLeerPeriodoContable($dblink,$fecha_com); 
   //echo "serial_per:".$rs_periodo."<br>";

   if($rs_periodo>0){
   		//VALIDACION PARA VERIFICAR QUE TODOS LOS EMPLEADOS TENGAN ASIGNADO UN DEPARTAMETO
		$RS_DEP=$dblink->Execute("select COUNT(serial_dep) DEP,concat(APELLIDO_EPL,' ',NOMBRE_EPL) nombre from empleado,empleadorolpagos
where empleadorolpagos.SERIAL_EPL=empleado.SERIAL_EPL 
AND serial_perrol =".$serial_perrol." 
and serial_dep<=0 group by nombre");
	 if($RS_DEP->fields['DEP']==0){		
		   $dblink->StartTrans();
		   $serial_per=$rs_periodo;
		   $filtro_rubros="";
		   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
		//and sucursal.serial_suc=1
			$SQL_agencias="select serial_suc,sucursal.serial_age from sucursal,agencia
			WHERE sucursal.SERIAL_AGE=agencia.serial_age  order by serial_suc";
			$rsAgencias=$dblink->Execute($SQL_agencias);
			for ($i=1;$i<=2;$i++){
				if($i==1) { 
					$filtro_rubros =" and codigo_rgr not like 'PRV-%'";
					$concepto_final=$concepto_com;
				}else{
					$filtro_rubros =" and codigo_rgr like 'PRV-%'";
					$concepto_final="PROVISIONES ".$concepto_com;
				}	
			$rsAgencias->MoveFirst();
			while (!$rsAgencias->EOF) {
					$SQLCommand="SELECT serial_plc, sum( valor_drp ) as valor,concat_ws(' - ',concat(APELLIDO_EPL,' ',NOMBRE_EPL),nombre_rgr) as rubro,tipo_rgr,codigo_rgr,departamentos.serial_dep,empleado.SERIAL_EPL,empleado.SERIAL_SUC,concat_ws('-',NOMBRE_SUC,codigo_rgr) as sucursal 
					FROM rubrogeneralrolpagos, empleadorolpagos,empleado, detallerolpagos ,sucursal,departamentos
					 WHERE empleadorolpagos.serial_erp = detallerolpagos.serial_erp  
					AND rubrogeneralrolpagos.serial_rgr = detallerolpagos.serial_rgr ".$filtro_rubros."
					AND empleadorolpagos.SERIAL_EPL=empleado.SERIAL_EPL 
					AND departamentos.serial_age=sucursal.serial_age
					 AND empleadorolpagos.serial_perrol =".$serial_perrol." 
					 AND departamentos.serial_dep=empleado.serial_dep  
					 and departamentos.serial_age=".$rsAgencias->fields['serial_age']."
					 GROUP BY serial_epl,serial_plc,nombre_rgr,departamentos.SERIAL_DEP
					having valor>0
					order by serial_suc, serial_epl,TIPO_RGR";
				 // AND TIPOEMPLEADO_EPL<>'PROFESOR'
				  // echo $SQLCommand."<br>";
				   $rsMonto=$dblink->Execute($SQLCommand);
				   
				   $serial_age=$rsAgencias->fields['serial_age'];
				   $sserial_tic=omnisoftLeerParametro($dblink,"ROL");
				   $serial_tic=omnisoftLeerSerialTipoComprobante($dblink,$sserial_tic);
				   $rsSecuencia=omnisoftLeerSecuenciaComprobante($dblink,$fecha_com,$serial_tic,$serial_age);
				   $numero_com=$rsSecuencia[0];
				   $codigo_com=$sserial_tic.$rsSecuencia[1];
				  /* $serial_pco=omnisoftLeerPeriodoContable($dblink,$fecha_com);
				
				   if ($serial_pco==0) {
						echo "!Error: No se puede contabilizar el periodo contable no esta abierto o no existe|";
						return;
					}*/
				
				   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_final,0,'P',$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,'NOMINA');
				
				   if ($serial_com==0) {
					   echo "!Error: ". $dblink->ErrorMsg();
					   return;
				   }
				
				   if (!actualizarSecuenciaTipoComprobante($dblink,$serial_tic,$numero_com)) {
						echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";
						return;
				   }
				   
					//Cuenta contable del Rol de Pagos
				   $sCuentaRolPagos=omnisoftLeerParametro($dblink,"ctarol");
				   $cuentaRolPagos=omnisoftLeerSerialCuentaContable($dblink,$sCuentaRolPagos);
				   
					
				   $sCuentaVacaciones=omnisoftLeerParametro($dblink,"ctavacaciones");
				   $cuentaVacaciones=omnisoftLeerSerialCuentaContable($dblink,$sCuentaVacaciones);
				
					$sCuentaXIII=omnisoftLeerParametro($dblink,"ctaxiii");
					$cuentaXIII=omnisoftLeerSerialCuentaContable($dblink,$sCuentaXIII);
					$sCuentaXIV=omnisoftLeerParametro($dblink,"ctaxiv");
					$cuentaXIV=omnisoftLeerSerialCuentaContable($dblink,$sCuentaXIV);
					$sCuentaFondosReserva=omnisoftLeerParametro($dblink,"ctafondosreserva");
					$cuentaFondosReserva=omnisoftLeerSerialCuentaContable($dblink,$sCuentaFondosReserva);
					$sCuentaAportePatronal=omnisoftLeerParametro($dblink,"ctaiess1215");
					$cuentaAportePatronal=omnisoftLeerSerialCuentaContable($dblink,$sCuentaAportePatronal);
					
					   ////////////////////////////////////////
					  $totaldebe=0;
					  $totalhaber=0;
					  $debeanticipo=0;
					  $debeprestamo=0;
					  $haberxiii=0;
					  $haberxiv=0;
					  $haberfondosreserva=0;
					  $haberaportepatronal=0;
					  $habervaciones=0;
					  $serial_epl=0;
				/*****************EMPIEZA LO DE LOS RUBROS POR EMPLEADO***********/	  	
				   while (!$rsMonto->EOF) {
					//		echo "<br>".$serial_epl."!=".$rsMonto->fields['SERIAL_EPL']."<br>";
						if($serial_epl!=$rsMonto->fields['SERIAL_EPL'] && $serial_epl>0){
							 
								$total=$totaldebe-$totalhaber-$haberxiii-$haberxiv-$haberfondosreserva-$haberaportepatronal;
								//-$debeprestamo-$debeanticipo;
							   /************************BENEFICIOS SOCIALES *************/
								/**********Esto se va ejecutar en el ROL del Provisiones cuando $i sea igual a 2***********************/
								if ($haberxiii>0)	$serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaXIII,0,$haberxiii,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR XIII",$serial_dep);
								if ($haberxiv>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaXIV,0,$haberxiv,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR XIV",$serial_dep);
								if ($haberfondosreserva>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaFondosReserva,0,$haberfondosreserva,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR FONDOS DE RESERVA",$serial_dep);
								
								if ($habervaciones>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaVacaciones,0,$habervaciones,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR VACACIONES",$serial_dep);
								/************************ FIN BENEFICIOS SOCIALES *************/
								if ($haberaportepatronal>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaAportePatronal,0,$haberaportepatronal,substr($rubro,0,strpos($rubro,"-")),"GASTO APATRONAL",$serial_dep);
								//REGISTRA LA CUENTA POR PAGAR PARA EL EMPLEADO SOLO CUANDO ES EL ROL NORMAL (1)
								if($i==1)
									$serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaRolPagos,0,$total,substr($rubro,0,strpos($rubro,"-")+1),"CTAXPAGAR", $serial_dep);
								
								$totaldebe=0;
								$totalhaber=0;
								$haberxiii=0;
								$haberxiv=0;
								$haberfondosreserva=0;
								$haberaportepatronal=0;
								$habervaciones=0;
								$total=0;
						 }
						//////INGRESOS		
						if ( $rsMonto->fields[3]=='INGRESO' ) {
								  $serial_det=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plc'],$rsMonto->fields['valor'],0,$rsMonto->fields['rubro'],$rsMonto->fields['sucursal'],$rsMonto->fields['serial_dep']);
								
								  $totaldebe=$totaldebe+$rsMonto->fields[1];
								 //echo "RUBRO:".$rsMonto->fields[4]."<br>";
								  if($rsMonto->fields[4]=='PRV-XIII') $haberxiii=$haberxiii+$rsMonto->fields[1];
								  else
									if($rsMonto->fields[4]=='PRV-XIV') $haberxiv=$haberxiv+$rsMonto->fields[1];
								  else
									if($rsMonto->fields[4]=='PRV-FR') $haberfondosreserva=$haberfondosreserva+$rsMonto->fields[1];
								  else
									if($rsMonto->fields[4]=='PRV-VACACIONES') $habervaciones=$habervaciones+$rsMonto->fields[1];
								  else						
								  	if($rsMonto->fields[4]=='PRV-IEESPAT')  $haberaportepatronal=$haberaportepatronal+$rsMonto->fields[1];
						
						}else {
						//////EGRESOS				   
								$serial_det=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plc'],0,$rsMonto->fields['valor'],$rsMonto->fields['rubro'],$rsMonto->fields['sucursal'],$rsMonto->fields['serial_dep']);
									$totalhaber=$totalhaber+$rsMonto->fields[1];
							}
							 $serial_dep=$rsMonto->fields['serial_dep'];
							 $serial_epl=$rsMonto->fields['SERIAL_EPL'];
							 $rubro=$rsMonto->fields['rubro'];
							 $sucursal=$rsMonto->fields['sucursal'];
							   if ($serial_det==0) {
								   echo "!Error: ". $dblink->ErrorMsg();
								   return;
					   }
				
				   $rsMonto->MoveNext();
				   }
			/****************FIN DE LOS RUBROS POR EMPLEADO***********/		
					$total=$totaldebe-$totalhaber-$haberfondosreserva-$haberaportepatronal;
					//-$haberxiii-$haberxiv-$debeprestamo-$debeanticipo-$haberaportepatronal;
					/************************BENEFICIOS SOCIALES *************/
					/**********Esto se va ejecutar en el ROL del Provisiones cuando $i sea igual a 2***********************/
					if ($haberxiii>0)	$serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaXIII,0,$haberxiii,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR XIII",$serial_dep);
					if ($haberxiv>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaXIV,0,$haberxiv,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR XIV",$serial_dep);
					if ($haberfondosreserva>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaFondosReserva,0,$haberfondosreserva,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR FONDOS DE RESERVA",$serial_dep);
					
					if ($habervaciones>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaVacaciones,0,$habervaciones,substr($rubro,0,strpos($rubro,"-")),"CTAXPAGAR VACACIONES",$serial_dep);
					/************************ FIN BENEFICIOS SOCIALES *************/
					
					if ($haberaportepatronal>0) $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaAportePatronal,0,$haberaportepatronal,substr($rubro,0,strpos($rubro,"-")),"GASTO APATRONAL",$serial_dep);
					
					//REGISTRA LA CUENTA POR PAGAR PARA EL EMPLEADO SOLO CUANDO ES EL ROL NORMAL (1)
					if($i==1)
						$serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaRolPagos,0,$total,substr($rubro,0,strpos($rubro,"-")+1),"CTAXPAGAR", $serial_dep);
					
			$resultData=$resultData.$serial_com."|";
			$rsAgencias->MoveNext();
		  }	
		  
		  }//FIN FOR 
		
			echo $resultData;
			$dblink->CompleteTrans();
	}else { echo "!Error: No se puede contabilizar existe empleados que no tienen asignado el departamento:".$RS_DEP->fields['nombre']."|";
			return;
		}
			
	}else { echo "!Error: No se puede contabilizar el periodo contable no esta abierto o no existe|";
			return;
		}				

}

omnisoftContabilizar();
?>
