<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftContabilidad.inc.php');

function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);
	return $dblink;
}

function omnisoftContabilizar(){

	global  $_POST;
	$query = $_POST['query'];
	//$query = $_GET['query'];
    $query=str_replace("\"", "'",$query);
    $query=str_replace("\'", "'",$query);
    $query=str_replace("\x5C", "\x5C\x5C",$query);
    $dblink=omnisoftConnectDB();    
    //Parametros
	$params=explode('|',$query);   
    $serial_acd = $params[0];
    $tipo_com = $params[1];
    $fecha_cdc = $params[2];
    $serial_age=$_COOKIE['serial_age'];   
    switch($serial_age){
	   case 3: $serial_dep=3;break;
	   case 4: $serial_dep=8;break;
	   case 5: $serial_dep=24;break;
	   case 6: $serial_dep=244;break;
    }   
    $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
    $dblink->StartTrans();
	$rsValida=$dblink->Execute("select * from  acreditacion_cierredia where serial_acd=".$serial_acd." and serial_com=0");
	
	if($rsValida->RecordCount()>0){
	
		$sqlMain = "select acd.serial_acd,fechaefec_cdc,fdc.nombre_forc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid,
		ndeposito_acd,
							descripcion_acd,
							valor_cdc,
							bancotesoreria.serial_plc as serial_plc_debe,
							fdc.serial_plc as serial_plc_haber,
							concat_ws(' ',bancotesoreria.cuenta_bat,banco.nombre_ban) as cuenta_banco ,descripcion_cdc,codigo_alu
		from formacobro fdc,cierredia_control cdc, cierredia_control_acreditacion cdca,acreditacion_cierredia acd ,bancotesoreria,banco
		left join detallerecibo on cdc.serial_dre=detallerecibo.serial_dre
		left join cabecerarecibo on cabecerarecibo.serial_cre=detallerecibo.serial_cre
		left join cabecerafactura on cabecerafactura.serial_caf=cabecerarecibo.serial_caf 
		left join alumno on alumno.serial_alu=cabecerafactura.serial_alu
		where  
		bancotesoreria.serial_ban=banco.serial_ban 
		AND acd.serial_bat=bancotesoreria.serial_bat 
		and fdc.serial_forc = cdc.serial_forc 
		and cdca.serial_cdc=cdc.serial_cdc
		and cdca.serial_acd=acd.serial_acd and acd.serial_acd=".$serial_acd."
		";
							//echo "<br>".$sqlMain.'<br>';
			$rscontrol=$dblink->Execute($sqlMain);
			//echo "<br>RECORDCOUNT: ".$rscontrol->RecordCount()."<br>";
			if($rscontrol->RecordCount()>0){
				$rs_periodo=omnisoftLeerPeriodoContable($dblink,$fecha_cdc); 
				if($rs_periodo>0){
					$sserial_tic=omnisoftLeerParametro($dblink, $tipo_com);
					$serial_tic=omnisoftLeerSerialTipoComprobante($dblink,$sserial_tic);
					$rsSecuencia=omnisoftLeerSecuenciaComprobante($dblink,$fecha_cdc,$serial_tic,$serial_age);
					$numero_com=$rsSecuencia[0];
					$codigo_com=$sserial_tic.$rsSecuencia[1];						            
					$concepto_final='ACREDITACION '.$rscontrol->fields['nombre_forc'].' '.$fecha_cdc.' A LA CUENTA '.$rscontrol->fields['cuenta_banco'];
					$serial_per=$rs_periodo;				  
					//CABECERA COMPROBANTE						  
					
					$serial_com=insertarCabeceraComprobante($dblink,$fecha_cdc,$concepto_final,0,'N',$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,'PENSIONES');
											
					if ($serial_com==0){
					   echo "!Error: ". $dblink->ErrorMsg();
					   return;
					}
						
					if (!actualizarSecuenciaTipoComprobante($dblink,$serial_tic,$numero_com)){
						echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";
						return;
					}					   										   	   
					$valor_total=0;
					$valor_comision=0;
					//$concepto_descripcion='';
					while (!$rscontrol->EOF) {			  
						$valor_cont = $rscontrol->fields['valor_cdc']+$rscontrol->fields['comision_cdc'];	
						$valor_comision=$valor_comision+$rscontrol->fields['comision_cdc'];
						$descripcion =$rscontrol->fields['descripcion_cdc'];
						
						//DETALLE HABER
						$serial_haber=insertarDetalleComprobante($dblink,$serial_com,$rscontrol->fields['serial_plc_haber'],0,$valor_cont,$descripcion,$rscontrol->fields['codigo_alu'],$serial_dep);
						if ($serial_haber==0){
							echo "!Error: ". $dblink->ErrorMsg();
							return;
						}
						
						
						$valor_total=$valor_total+$rscontrol->fields['valor_cdc'];
						$cta_debe=$rscontrol->fields['serial_plc_debe'];
						$ndeposito=$rscontrol->fields['ndeposito_acd'];
						
						$concepto_descripcion = $concepto_descripcion." | ".$descripcion;
						
						$rscontrol->MoveNext();
					}
					//DETALLE DEBE		
					//concepto_final
													
						$serial_debe=insertarDetalleComprobante($dblink,$serial_com,$cta_debe,$valor_total,0,$concepto_descripcion,$ndeposito,$serial_dep);
						
						if ($serial_debe==0){
						   echo "!Error: ". $dblink->ErrorMsg();
						   return;
						}
					if($valor_comision>0){
							$sCuentaComisionTarjetas=omnisoftLeerParametro($dblink,"ctacomisiontc");
							$CuentaComisionTarjetas=omnisoftLeerSerialCuentaContable($dblink,$sCuentaComisionTarjetas);
							$serial_debe_c=insertarDetalleComprobante($dblink,$serial_com,$CuentaComisionTarjetas,$valor_comision,0,$concepto_final,$ndeposito,$serial_dep);
							if ($serial_debe_c==0){
							   echo "!Error: ". $dblink->ErrorMsg();
							   return;
							}
					}		
					
					//ACTUALIZAR EL NUMERO DE COMPROBANTE CONTABLE
					$SQLUpdate="update acreditacion_cierredia set serial_com=".$serial_com.",estado_acd='CERRADO', valor_acd=".$valor_total." where serial_acd=".$serial_acd;
					$rsupdate=$dblink->Execute($SQLUpdate);	   
					
					$estado = "CERRADO";
					$SQLUpdate="update cierredia_control, cierredia_control_acreditacion set estado_cdc='".$estado."' where cierredia_control_acreditacion.serial_acd=".$serial_acd." and  cierredia_control.serial_cdc=cierredia_control_acreditacion.serial_cdc ";
					$rsupdate=$dblink->Execute($SQLUpdate);	   
		
					
					//echo "<br>".$SQLUpdate."<br>";
					$resultData=$resultData.$serial_com."|";
					echo $resultData;
					$dblink->CompleteTrans();
					return;
					
				}
				else{ 
					echo "!Error: No se puede contabilizar el periodo contable no esta abierto o no existe|";
					return;
				}		
		
			}else{ 
				echo "!Error: No existen registros|";
				return;
			}	
	}else{ 
				echo "!Error: Ya esta contabilizado|";
				return;
			}						
}
omnisoftContabilizar();
?>
