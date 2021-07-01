<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftContabilidad.inc.php');

function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

function omnisoftContabilizar() {

  global  $_POST,$omnisoftCOMPROBANTEFACTURACION;

   $query = $_POST['query'];
   //$query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   
   $params=explode('|',$query);
   
   $fecha_com=$params[0];
   $serial_age=$_COOKIE['serial_age'];
   $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
	$dblink->StartTrans();
   //$concepto_com=$params[1];
   //$serial_caf=$params[1];
   //VERIFICA QUE ESTEN TODAS LAS FACTURAS COBRADAS
   
   //'select cabecerarecibo.serial_caf,sum(total_caf),sum(valor_cre) as total_cob from cabecerafactura left join cabecerarecibo on cabecerafactura.serial_caf=cabecerarecibo.serial_caf where cabecerafactura.serial_caf='+document.PaginaDatos.serial_caf.value+' group by cabecerafactura.serial_caf';
   
 //VERIFICA QUE NO EXISTA UNA FECHA INCLUIDA EN ESTE CIERRE DE CAJA
   $rscierrdia=$dblink->Execute("select * from cierredia where ('".$params[0]."'  between fechainicio_cid and fechafin_cid
 or  '".$params[1]."'  between fechainicio_cid and fechafin_cid) and serial_suc=".$serial_suc);
 //echo "select * from cierredia where ('".$params[0]."'  between fechainicio_cid and fechafin_cid or  '".$params[1]."'  between fechainicio_cid and fechafin_cid) and serial_suc=".$serial_suc;
 if($rscierrdia->RecordCount()==0){
     $rs_periodo=omnisoftLeerPeriodoContable($dblink,$fecha_com); 
   //echo "serial_per:".$rs_periodo."<br>";

   if($rs_periodo>0){
   		//VERIFICACIÓN QUE EXISTA LAS CUENTAS CONTABLES 
		 $rsdebe=$dblink->Execute("select * from detallefactura,cabecerafactura where cabecerafactura.serial_caf=detallefactura.serial_caf and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and detallefactura.serial_dar<>0 and serial_plc not in (select serial_plc from plancontable) and serial_suc=".$serial_suc);
		 $rshaber=$dblink->Execute("select * from detallefactura,cabecerafactura where cabecerafactura.serial_caf=detallefactura.serial_caf and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and detallefactura.serial_dar<>0 and serial_plce not in (select serial_plc from plancontable) and serial_suc=".$serial_suc);
		 
		 //echo "select * from detallefactura,cabecerafactura where cabecerafactura.serial_caf=detallefactura.serial_caf and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and detallefactura.serial_dar<>0 and serial_plc not in (select serial_plc from plancontable) and serial_suc=".$serial_suc;
		 
		 //echo "</p>"."select * from detallefactura,cabecerafactura where cabecerafactura.serial_caf=detallefactura.serial_caf and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and detallefactura.serial_dar<>0 and serial_plce not in (select serial_plc from plancontable) and serial_suc=".$serial_suc;		 
		 
		 
		   if($rsdebe->RecordCount()==0 && $rshaber->RecordCount()==0){	   				   
				   $serial_per=$rs_periodo;
				   $filtro_rubros="";
				  
				   //echo "agencia:***********************".$_COOKIE['serial_age'];
				//and sucursal.serial_suc=1
			//saca los detalles de todas las tablas cabecera y detalle factura
							$SQLCommand="select cabecerafactura.serial_caf,detallefactura.serial_alu,fecha_caf,estado_caf,numero_caf,cliente_caf,cedula_caf,observaciones_caf,serial_dep,valor_aal,valorajuste_aal,detallefactura.serial_plc,detallefactura.serial_plce,cantidad_dfa,descripcion_dar,descuento_dfa,detallefactura.serial_caa,serial_com,concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) alumno,codigo_alu, tipo_caf from cabecerafactura,detallefactura, detallearancel,alumno
		where cabecerafactura.serial_caf=detallefactura.serial_caf  and detallefactura.serial_dar=detallearancel.serial_dar
		and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and alumno.serial_alu=cabecerafactura.serial_alu  and cabecerafactura.serial_suc=".$serial_suc." ORDER BY tipo_caf, cabecerafactura.serial_caf,fecha_caf asc";						
						 //  echo $SQLCommand."<br>";						 
						   $rsMonto=$dblink->Execute($SQLCommand);
						   $inicio=0;						   
						   $tipo_cafaux = "";
				/*****************EMPIEZA A CONTABILIZAR EL COMPROBANTE DE FACTURA VENTAS***********/			   
				while (!$rsMonto->EOF) {
							//Inserta cabecera de comprobante
							if($rsMonto->fields['tipo_caf']!=$tipo_cafaux){														
									   //INSERTA EL REGISTRO DE CIERRE DE CAJA
									if($inicio==0){	
									   $sql_insertcierredia="insert into cierredia (serial_cid,fechainicio_cid,fechafin_cid,valorfac_cid,valorcob_cid,serial_suc,serial_usr,fecha_cid) values (0,'".$params[0]."','".$params[1] ."',0,0,".$serial_suc.",".$serial_usr.",NOW())";
									   $dblink->Execute($sql_insertcierredia);
									  
									   if (strlen($dblink->ErrorMsg())>0){
										   echo "!Error: ". $dblink->ErrorMsg();
										   return;
									   }else $serial_cid=$dblink->Insert_ID();
								  }
		   
								//   $serial_age=$_COOKIE['serial_age'];
								   $sserial_tic=omnisoftLeerParametro($dblink, $rsMonto->fields['tipo_caf']);
								   $serial_tic=omnisoftLeerSerialTipoComprobante($dblink,$sserial_tic);
								   $rsSecuencia=omnisoftLeerSecuenciaComprobante($dblink,$fecha_com,$serial_tic,$serial_age);
								   $numero_com=$rsSecuencia[0];
								   $codigo_com=$sserial_tic.$rsSecuencia[1];
								   $concepto_final='CIERRE FIN DE DIA FACTURACION '.$params[0].' AL '.$params[1];
								  
								  
								   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_final,0,'P',$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,'PENSIONES');
								
								   if ($serial_com==0) {
									   echo "!Error: ". $dblink->ErrorMsg();
									   return;
								   }
								
								   if (!actualizarSecuenciaTipoComprobante($dblink,$serial_tic,$numero_com)) {
										echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";
										return;
								   }	
								   if($inicio>0){			
									    //inserta el comprobante en el detalle de cierre de día
										$SQLInsert="insert into detallecierredia (serial_dcid,serial_cid,serial_tic
										,serial_com, valor_dcid) 
										values(0,".$serial_cid.",".$serial_tic.",".$serial_comaux.",".$total_fac.")";
										$rsinsert=$dblink->Execute($SQLInsert);			
										$total_fac=0;		
									}
									
									$inicio=1;
						

							}	   
						    
							
							//Cuenta contable del Rol de Pagos
		/*	 			   $sCuentaRolPagos=omnisoftLeerParametro($dblink,"ctarol");
						   $cuentaRolPagos=omnisoftLeerSerialCuentaContable($dblink,$sCuentaRolPagos);*/
						   	   
					  
								//////INGRESOS		
								$descripcion=$rsMonto->fields['descripcion_dar']."(".$rsMonto->fields['cliente_caf']."-".$rsMonto->fields['cedula_caf'].")-".$rsMonto->fields['numero_caf'];
								$valor=$rsMonto->fields['valor_aal']*$rsMonto->fields['cantidad_dfa'];
								if($valor<0) $valor_cont=$valor*-1;
									else $valor_cont=$valor;
									
								$total_fac=$total_fac+$valor+$rsMonto->fields['descuento_dfa'];
										//Busca la cuenta de la categoria
									   if($rsMonto->fields['descuento_dfa']!=0){
											$sql_cat="select serial_plc from categoriaalumno where serial_caa=".$rsMonto->fields['serial_caa'];
											$rs_cat=$dblink->Execute($sql_cat);
										if(!$rs_cat->EOF)
											$serialDetalle_debe_descuento=insertarDetalleComprobante($dblink,$serial_com,$rs_cat->fields['serial_plc'],$rsMonto->fields['descuento_dfa']*-1,0,$descripcion,$rsMonto->fields['codigo_alu'],$rsMonto->fields['serial_dep']);
										}	
										
										  $serial_debe=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plc'],$valor_cont+$rsMonto->fields['descuento_dfa'],0,$descripcion,$rsMonto->fields['codigo_alu'],$rsMonto->fields['serial_dep']);
										
										if ($serial_debe==0) {
										   echo "!Error: ". $dblink->ErrorMsg();
										   return;
											}
																   
										$serial_haber=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plce'],0,$valor_cont,$descripcion,$rsMonto->fields['codigo_alu'],$rsMonto->fields['serial_dep']);
										if ($serial_haber==0) {
												   echo "!Error: ". $dblink->ErrorMsg();
										   return;
										}	   
										//$totalfac=$totalfac+$valor;	
										$tipo_cafaux=$rsMonto->fields['tipo_caf'];
										$serial_comaux=$serial_com;
										
										//ACTUALIZA LA CABECERA CON CO SERIAL DEL COMPROBANTE
										//ACTUALIZA LAS FACTURAS CON EL COMPROBANTE CONTABLE QUE SE CONTABILIZO
										$SQLUpdate="update cabecerafactura set serial_com=".$serial_com."  where serial_caf=".$rsMonto->fields['serial_caf'];
										$rsupdate=$dblink->Execute($SQLUpdate);
									
						
										
						   $rsMonto->MoveNext();
						   }
					
					
							//inserta el comprobante en el detalle de cierre de día del ultimo grupo de tipo_fac
							$SQLInsert="insert into detallecierredia (serial_dcid,serial_cid,serial_tic
							,serial_com, valor_dcid) 
							values(0,".$serial_cid.",".$serial_tic.",".$serial_comaux.",".$total_fac.")";
							$rsinsert=$dblink->Execute($SQLInsert);			
							$total_fac=0;	
							
							omnisoftContabilizarRecibosCobro($dblink,$serial_per,$serial_cid);
				 			omnisoftGeneracionCierreDiaControl($dblink,$serial_per,$serial_cid);
							
					$resultData=$resultData.$serial_com."|";
					echo $resultData;
					$dblink->CompleteTrans();
					return;
		}else	{ echo "!Error: No se puede contabilizar existen cuentas contables que no existen|";
			return;
		}				
		
			
	}else { echo "!Error: No se puede contabilizar el periodo contable no esta abierto o no existe|";
			return;
		}		
	}else { echo "!Error: No se puede cerrar la caja existe una fecha incluida en otro cierre de caja|";
			return;
		}					
//omnisoftExecuteUpdate();
}
//***********************************CONTABILIZACION DE LOS COBROS****************************************************///
function omnisoftContabilizarRecibosCobro($dblink,$serial_per,$serial_cid) {

  global  $_POST;
  //,$dblink;
   $query = $_POST['query'];
   //$query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   //$dblink=omnisoftConnectDB();
   //$dblink->StartTrans();
   
   $fecha_com=$params[0];
   $serial_age=$_COOKIE['serial_age'];
   $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;

   $params=explode('|',$query);
   //$concepto_com='CIERRE FIN DE DIA RECAUDACION '.$params[0].' AL '.$params[1];
   $fecha_com=$params[0];

//VERIFICACIÓN QUE EXISTA LAS CUENTAS CONTABLES 
		 $rsctas=$dblink->Execute("select formacobro.serial_forc
from formacobro,cabecerarecibo,detallerecibo,cabecerafactura
 where cabecerarecibo.serial_cre=detallerecibo.serial_cre
and detallerecibo.serial_forc=formacobro.serial_forc
and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' 
and formacobro.serial_plc not in (select serial_plc from plancontable)
and formacobro.serial_tic not in (select serial_tic from tipocomprobante) and cabecerafactura.serial_suc=".$serial_suc);

 if($rsctas->RecordCount()==0){ 
		$SQLCommand="select cabecerarecibo.serial_cre,numero_cre,NOMBRE_FORC,concat_ws('-',serie_caf,numero_caf) numfac,valor_dre,numeroDocumento_dre,fecha_dre,nombre_ban, plazo_dre,referencia_dre,lote_dre,tarjetahabiente_dre,formacobro.serial_tic,formacobro.serial_plc,codigo_tic ,serial_dep,concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) alumno,codigo_alu,codigoIdentificacion_alu  
		from formacobro,cabecerarecibo,detallerecibo,cabecerafactura,alumno
		left join banco on banco.serial_ban=detallerecibo.serial_ban
		left join tipocomprobante on tipocomprobante.serial_tic=formacobro.serial_tic
		 where cabecerarecibo.serial_cre=detallerecibo.serial_cre
		and detallerecibo.serial_forc=formacobro.serial_forc
		and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
		and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."'
		and alumno.serial_alu=cabecerafactura.serial_alu
		and cabecerafactura.serial_suc=".$serial_suc." 
		order by formacobro.serial_tic,numfac";

		//Cuenta de Estudiantes Cuentas por Cobrar
		$sCuentaEstudiantes=omnisoftLeerParametro($dblink,"ctaxcobrarestudiantes");
		$CuentaEstudiantes=omnisoftLeerSerialCuentaContable($dblink,$sCuentaEstudiantes);

		 //  echo $SQLCommand."<br>";
			   $rsCobros=$dblink->Execute($SQLCommand);
			   $inicio=0;
				/*****************EMPIEZA A CONTABILIZAR EL COMPROBANTE DE FACTURA VENTAS***********/			   
				while (!$rsCobros->EOF) {
							//Inserta cabecera de comprobante
							if($serial_tic_ant!=$rsCobros->fields['serial_tic']){
													  				
								   //$sserial_tic=omnisoftLeerParametro($dblink,"FAC");
								   $sserial_tic=$rsCobros->fields['codigo_tic'];
								   //$serial_tic=omnisoftLeerSerialTipoComprobante($dblink,$sserial_tic);
								   $serial_tic=$rsCobros->fields['serial_tic'];
								   $rsSecuencia=omnisoftLeerSecuenciaComprobante($dblink,$fecha_com,$serial_tic,$serial_age);
								   $numero_com=$rsSecuencia[0];
								   $codigo_com=$sserial_tic.$rsSecuencia[1];
								   $concepto_final='CIERRE DE DIA RECAUDACION '.$params[0].' AL '.$params[1];
							  
								   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_final,0,'P',$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,'PENSIONES');
								
								   if ($serial_com==0) {
									   echo "!Error: ". $dblink->ErrorMsg();
									   return;
								   }
								
								   if (!actualizarSecuenciaTipoComprobante($dblink,$serial_tic,$numero_com)) {
										echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";
										return;
								   }
								
								  
													
									//inserta el comprobante en el detalle de cierre de día
									$SQLInsert="insert into detallecierredia (serial_dcid,serial_cid,serial_tic,serial_com,valor_dcid) values(0,".$serial_cid.",".$serial_tic.",".$serial_comaux.",".$total_cob.")";				   	$rsinsert=$dblink->Execute($SQLInsert);
								   $inicio=1;
								   $total_cob=0;
							}	   
						   
							//Cuenta contable del Rol de Pagos
		/*	 			   $sCuentaRolPagos=omnisoftLeerParametro($dblink,"ctarol");
						   $cuentaRolPagos=omnisoftLeerSerialCuentaContable($dblink,$sCuentaRolPagos);*/
						   	   
					              
								//////INGRESOS	
								$descripcion=$rsCobros->fields['NOMBRE_FORC']."(".$rsCobros->fields['alumno']."-".$rsCobros->fields['codigoIdentificacion_alu'].")-".$rsCobros->fields['numfac'];	
								$valor=$rsCobros->fields['valor_dre'];
																										
										  $serial_debe=insertarDetalleComprobante($dblink,$serial_com,$rsCobros->fields['serial_plc'],$valor,0,$descripcion,$rsCobros->fields['codigo_alu'],$rsCobros->fields['serial_dep']);
										
										if ($serial_debe==0) {
										   echo "!Error: ". $dblink->ErrorMsg();
										   return;
											}
																   
										$serial_haber=insertarDetalleComprobante($dblink,$serial_com,$CuentaEstudiantes,0,$valor,$descripcion,$rsCobros->fields['codigo_alu'],$rsCobros->fields['serial_dep']);
										if ($serial_haber==0) {
												   echo "!Error: ". $dblink->ErrorMsg();
										   return;
										}	   
							
						   $serial_tic_ant=$rsCobros->fields['serial_tic'];
						   				$total_cob=$total_cob+$valor;
						    //ACTUALIZA LA CABECERA CON CO SERIAL DEL COMPROBANTE
									//ACTUALIZA LAS FACTURAS CON EL COMPROBANTE CONTABLE QUE SE CONTABILIZO
									$SQLUpdate="update cabecerarecibo set serial_com=".$serial_com."  where serial_cre=".$rsCobros->fields['serial_cre']."";
									$rsupdate=$dblink->Execute($SQLUpdate); 
									
									
									$serial_comaux=$serial_com;
						   
						   $rsCobros->MoveNext();
						   }
						  
   
	    //echo $resultData;
	}else	{ echo "!Error: No se puede contabilizar existen cuentas contables que no existen|";
			return;
		}			
	
}
//**********GENERACION	PARA EL CONTROL DE CHQUES POSFECHADOS Y TARJETAS DE CREDITO********///
function omnisoftGeneracionCierreDiaControl($dblink,$serial_per,$serial_cid) {
   global  $_POST;
  //,$dblink;

   $query = $_POST['query'];
 // $query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   //$dblink=omnisoftConnectDB();
   //$dblink->StartTrans();
   
   $fecha_com=$params[0];
   $serial_age=$_COOKIE['serial_age'];
   $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;

   $params=explode('|',$query);
  //INSERTA EL REGISTRO DE CIERRE DE CAJA
   $sql_insertcierredia_control="insert into cierredia_control (serial_cdc,serial_cid,serial_forc,serial_dre,valor_cdc,estado_cdc,fecha_cdc,fechaefec_cdc) select 0,".$serial_cid.",detallerecibo.serial_forc,0,sum(valor_dre),'PENDIENTE',NOW(),NOW()
	from formacobro,cabecerarecibo, detallerecibo,cabecerafactura 
	where 
	cabecerarecibo.serial_cre=detallerecibo.serial_cre
	and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
	and detallerecibo.serial_forc=formacobro.serial_forc
	and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."'
    and (control_forc is null or control_forc='')
	group by detallerecibo.serial_forc
union 
  select 0,".$serial_cid.",detallerecibo.serial_forc,serial_dre,valor_dre,'PENDIENTE',NOW(),fecha_dre
	from formacobro,cabecerarecibo, detallerecibo,cabecerafactura 
	where 
	cabecerarecibo.serial_cre=detallerecibo.serial_cre
	and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
	and detallerecibo.serial_forc=formacobro.serial_forc
	and  fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."'
    and control_forc='CH' ";
	
	//echo $sql_insertcierredia_control;
    $dblink->Execute($sql_insertcierredia_control);
  
   if (strlen($dblink->ErrorMsg())>0){
	   echo "!Error: ". $dblink->ErrorMsg();
	   return;
   }else $serial_cdc=$dblink->Insert_ID();

		   //*****INSERTCION PARA CONTROL DE VOUCHERS DE TARJETAS********/
			   $SQLCommand="select serial_dre,detallerecibo.serial_forc,NOMBRE_FORC,valor_dre,plazo_dre,fecha_dre,comisiontarjetacredito_forc,control_forc 
			from formacobro,cabecerarecibo, detallerecibo,cabecerafactura 
			where 
			cabecerarecibo.serial_cre=detallerecibo.serial_cre
			and cabecerafactura.serial_caf=cabecerarecibo.serial_caf
			and detallerecibo.serial_forc=formacobro.serial_forc
			and control_forc='TJ'
			and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."'
			order by fecha_dre";
			
			$rsTarjetas=$dblink->Execute($SQLCommand);
		
			while (!$rsTarjetas->EOF) {
				$fecha_efe=$rsTarjetas->fields['fecha_dre'];
				if($rsTarjetas->fields['plazo_dre']>0) $plazo=$rsTarjetas->fields['plazo_dre'];
				else $plazo=1;
				$comision=($rsTarjetas->fields['valor_dre']/$plazo)*$rsTarjetas->fields['comisiontarjetacredito_forc']/100;
				$valor=($rsTarjetas->fields['valor_dre']/$plazo)-$comision;
				for($i=1;$i<=$plazo;$i++){
					
					$sql="INSERT INTO cierredia_control (serial_cdc,serial_cid,serial_forc,serial_dre,fecha_cdc,fechaefec_cdc,valor_cdc,comision_cdc,estado_cdc) VALUES(0,".$serial_cid.",".$rsTarjetas->fields['serial_forc'].",".$rsTarjetas->fields['serial_dre'].",NOW(),'".$fecha_efe."',".$valor.",".$comision.",'PENDIENTE') ";
					$dblink->Execute($sql);
					$fecha_efe=date("Y-m-d",strtotime($fecha_efe." + 30 days"));
				}
			
			 $rsTarjetas->MoveNext();
			}
			
}
	
omnisoftContabilizar();
?>
