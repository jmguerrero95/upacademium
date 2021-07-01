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
	$query = $_POST['query']; //defect
	//$query = $_GET['query'];
  	$serial_plc_haber=317; //SERIAL DEL LA CUENTA CREDITOS PARA EL HEBER
    $query=str_replace("\"", "'",$query);
    $query=str_replace("\'", "'",$query);
    $query=str_replace("\x5C", "\x5C\x5C",$query);
    $dblink=omnisoftConnectDB();    
    //Parametros
	$params=explode('|',$query);   
    $serial_dcpt = $params[0];
    $tipo_com = $params[1];
    $fecha_cdc = $params[2];
	$serial_cpt = $params[3];
	$creditos = $params[4];
    $serial_age=$_COOKIE['serial_age'];   
    
	/*switch($serial_age){
	   case 3: $serial_dep=3;break;
	   case 4: $serial_dep=8;break;
	   case 5: $serial_dep=24;break;
	   case 6: $serial_dep=244;break;
    } */  
	
    $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
    $dblink->StartTrans();
	$sqlMain = "select dcp.serial_dcpt, ((dfa.valor_aal - dfa.descuento_dfa) *  creditos_dcpt) as valor, dar.serial_plc,dcp.fecha_dcpt,serial_dep
			,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre, codigo_alu, dcp.observacion_dcpt
			from cabeceracreditosportomar as cpt, detallecreditoportomar as dcp,detallefactura as dfa,cabecerafactura as caf,alumno as alu, detallearancel as dar
			where cpt.serial_cpt=dcp.serial_cpt
			and cpt.serial_dfa=dfa.serial_dfa
			and dfa.serial_caf=caf.serial_caf
			and alu.serial_alu = caf.serial_alu
			and dfa.serial_dar=dar.serial_dar
			and dcp.serial_dcpt = ".$serial_dcpt;
	
					//echo "<br>".$sqlMain.'<br>';
	$rscontrol=$dblink->Execute($sqlMain);
 	//echo "<br>RECORDCOUNT: ".$rscontrol->RecordCount()."<br>";
	if($rscontrol->RecordCount()>0){
    	$rs_periodo=omnisoftLeerPeriodoContable($dblink,$fecha_cdc); //FECHA DEL PERIODO CONTABLE
		if($rs_periodo>0){
			$sserial_tic=omnisoftLeerParametro($dblink, $tipo_com); //TIPO DE COMPROBANTE DIA
			$serial_tic=omnisoftLeerSerialTipoComprobante($dblink,$sserial_tic);
			$rsSecuencia=omnisoftLeerSecuenciaComprobante($dblink,$fecha_cdc,$serial_tic,$serial_age);
			$numero_com=$rsSecuencia[0];
			$codigo_com=$sserial_tic.$rsSecuencia[1];						   
			$concepto_final='CREDITOS EFECTIVIZADOS PERTENECIENTES A '.$rscontrol->fields['nombre'].' CON FECHA '.$fecha_cdc.' Y CODIGO '.$rscontrol->fields['codigo_alu'];
			$serial_per=$rs_periodo;				  
			//CABECERA COMPROBANTE						  
			
			$serial_com=insertarCabeceraComprobante($dblink,$fecha_cdc,$concepto_final,0,'P',$serial_tic,$serial_usr,$serial_age,$numero_com,$codigo_com,$serial_per,'PENSIONES');
								
			
			 	
			if ($serial_com==0){
			   echo "!Error: ". $dblink->ErrorMsg();
			   echo "</p> COMPROBANTE:".$serial_com;
			   return;
			}
				
			if (!actualizarSecuenciaTipoComprobante($dblink,$serial_tic,$numero_com)){
				echo "!Error: NO se pudo actualizar la secuencia del tipo de comprobante!";
				return;
			}					
			   					
			$departamento=$rscontrol->fields['serial_dep'];									   	   
			$valor_total=0;			
				  
				$valor_cont = $rscontrol->fields['valor'];		
				$descripcion =$rscontrol->fields['observacion_dcpt']." | ".$rscontrol->fields['nombre'];
				
				//DETALLE HABER				
				
				
				$serial_haber=insertarDetalleComprobante($dblink,$serial_com,$serial_plc_haber,0,$valor_cont,$descripcion,$rscontrol->fields['codigo_alu'],$departamento);
				if ($serial_haber==0){
					echo "!Error: ". $dblink->ErrorMsg();
				   //echo "</p> haber:".$serial_haber;
					return;
				}
				$serial_debe=insertarDetalleComprobante($dblink,$serial_com,$rscontrol->fields['serial_plc'],$valor_cont,0,$descripcion,$rscontrol->fields['codigo_alu'],$departamento);
				if ($serial_debe==0){
				   echo "!Error: ". $dblink->ErrorMsg();
			//	   echo "</p> debe:".$serial_debe;
				   return;
				}
			
			//DETALLE DEBE		
		
			//ACTUALIZAR EL NUMERO DE COMPROBANTE CONTABLE
			//$estado = "CERRADO";
			/*$SQLUpdate="update cierredia_control, cierredia_control_acreditacion set estado_cdc='".$estado."' where cierredia_control_acreditacion.serial_acd=".$serial_acd." and  cierredia_control.serial_cdc=cierredia_control_acreditacion.serial_cdc ";
			$rsupdate=$dblink->Execute($SQLUpdate);	   */

			$SQLUpdate="update detallecreditoportomar set serial_com =".$serial_com." where serial_dcpt=".$serial_dcpt;
//			$SQLUpdate="update acreditacion_cierredia set serial_com=".$serial_com.",estado_acd='CERRADO', valor_acd=".$valor_total." where serial_acd=".$serial_acd;
			$rsupdate=$dblink->Execute($SQLUpdate);	  
			
// = $params[3];
	// = $params[4];
	
		/*	$afavor="select afavor_cpt from cabeceracreditosportomar where serial_cpt = ".$serial_cpt;
			$rsafavor=$dblink->Execute($SQLUpdate);	  
		
			$saldo = $rsafavor->fields['afavor_cpt']- $creditos;
			
			$dblink->Execute("update cabeceracreditosportomar set afavor_cpt = ".$saldo." where serial_cpt = ".$serial_cpt);	  
			*/
			
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
}
omnisoftContabilizar();
?>
