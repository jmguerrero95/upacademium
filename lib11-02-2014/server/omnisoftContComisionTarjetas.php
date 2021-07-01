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
  
    $serial_suc=$_COOKIE['serial_suc'];
    $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
	
	$sql_reg="select comprobante.serial_com,serial_acd,formacobro.serial_forc,concepto_com,serial_age,codigo_com from acreditacion_cierredia,formacobro,comprobante
				where estado_acd='CERRADO'
				and acreditacion_cierredia.serial_forc=formacobro.SERIAL_FORC and CONTROL_FORC='TJ'
				and acreditacion_cierredia.serial_com=comprobante.serial_com 
				and comprobante.serial_com not in (select comprobante.serial_com from comprobante, detallecomprobante where  comprobante.serial_com=detallecomprobante.serial_com and detallecomprobante.serial_plc=665)
				and estado_com='N' ";
				//and comprobante.serial_com=30914
	$rs_reg=$dblink->Execute($sql_reg);			
	
	while (!$rs_reg->EOF){	
			
			switch($rs_reg->fields['serial_age']){
			   case 3: $serial_dep=3;break;
			   case 4: $serial_dep=8;break;
			   case 5: $serial_dep=24;break;
			   case 6: $serial_dep=244;break;
			}   
	
			$rs_control=$dblink->Execute("select cca.serial_acd,fechaefec_cdc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid,valor_cdc,descripcion_cdc from cierredia_control cdc,cierredia_control_acreditacion cca where cdc.serial_cdc=cca.serial_cdc and cca.serial_acd=".$rs_reg->fields['serial_acd']." and cdc.comision_cdc>0");
			
			//echo "<br> select cca.serial_acd,fechaefec_cdc,cdc.valor_cdc, cdc.comision_cdc,cdc.estado_cdc,cdc.serial_cid,valor_cdc,descripcion_cdc from cierredia_control cdc,cierredia_control_acreditacion cca where cdc.serial_cdc=cca.serial_cdc and cca.serial_acd=".$rs_reg->fields['serial_acd']." and cdc.comision_cdc>0";
			
			$valor_comision=0;
			if($rs_control->RecordCount()>0){
				while (!$rs_control->EOF){
					
					$rs_contable=$dblink->Execute("update detallecomprobante set haber_det=haber_det+".$rs_control->fields['comision_cdc']." where serial_com=".$rs_reg->fields['serial_com']." and trim(descripcion_det) like trim('".$rs_control->fields['descripcion_cdc']."') and haber_det>0");
					$valor_comision=$valor_comision+$rs_control->fields['comision_cdc'];
					//echo "<br> update detallecomprobante set haber_det=haber_det+".$rs_control->fields['comision_cdc']." where serial_com=".$rs_reg->fields['serial_com']." and trim(descripcion_det) like trim('".$rs_control->fields['descripcion_cdc']."') and haber_det>0";
					
					$rs_control->MoveNext();
				
				}
			
			}
			if($valor_comision>0){
					$sCuentaComisionTarjetas=omnisoftLeerParametro($dblink,"ctacomisiontc");
				    $CuentaComisionTarjetas=omnisoftLeerSerialCuentaContable($dblink,$sCuentaComisionTarjetas);
					$serial_debe_c=insertarDetalleComprobante($dblink,$rs_reg->fields['serial_com'],$CuentaComisionTarjetas,$valor_comision,0,$rs_reg->fields['concepto_com'],'-',$serial_dep);
					if ($serial_debe_c==0){
					   echo "!Error: ". $dblink->ErrorMsg();
					   return;
					}
			}		
			///////////////////////
			$rs_com=$dblink->Execute("select  sum(debe_det) deb, sum(haber_det) hab from detallecomprobante where serial_com=".$rs_reg->fields['serial_com']);
			
			
			$ms='';
			if($rs_com->fields['deb']==$rs_com->fields['hab']){
				$dblink->Execute("update comprobante set monto_com=".$rs_com->fields['hab']." where serial_com=".$rs_reg->fields['serial_com']);
				$ms='ok';
			}else{		
				$dblink->Execute("update comprobante set estado_com='P' where serial_com=".$rs_reg->fields['serial_com']);
				$ms='mal';
			}	
						
			echo "<br>".$rs_reg->fields['serial_com']."=>".$ms;			
			$rs_reg->MoveNext();
	}
    				
}
omnisoftContabilizar();
?>
