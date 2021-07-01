<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftSecuenciaDocumentos.php');
function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);	
	return $dblink;
}

function validarEstado($validar, $fac){
//echo $validar[1]."--";
//echo "entrooo";
$dblink=omnisoftConnectDB();
$ncRealizadas = "select serial_dar, serial_caf, sum(cantidad_dfa) as cantidad_dfa from detallefactura
where serial_caf in(select serial_caf from cabecerafactura where documento_caf = $fac and tipo_caf = 'NC')
group by serial_dar";
//echo "</p>".$ncRealizadas;
$retncRealizadas = $dblink->Execute($ncRealizadas);
	$vec = count($validar);
	for($i=1;$i<=$vec;$i++){
		//echo "</p>".$validar[$i];
		$retncRealizadas->MoveFirst();
		while(!$retncRealizadas->EOF ){
			if($validar[$i][1]==$retncRealizadas->fields['serial_dar']){			
					$validar[$i][2]=$validar[$i][2]-$retncRealizadas->fields['cantidad_dfa'];					
					//echo "</p>".$validar[$i][2];								
			}			
			$retncRealizadas->MoveNext();
		 }		
	}	
	
	for($i=1;$i<=$vec;$i++){				
				$cantidad = $cantidad + $validar[$i][2];			
				
	}	
	if($cantidad == 0){	
				 $actualiza = "update cabecerafactura set actividad_caf = 'cerrada' where serial_caf = ".$fac;
				 $dblink->Execute($actualiza);				
	}	
	
}


function omnisoftExecuteUpdate() {
   global $serial_tic;
	$query = $_POST['query'];
	//$query = $_GET['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
   $serial_caf=($params[0]=='')?0:$params[0];   
  
  $tipo = $params[14];//si es ND,NC, FACTURA
  $serial_tic=$params[15];//tipo de comprovante para
  $valornegativo = $params[16];//para que sume o resreste en la facturacion
  $sede = " ,serial_suc = ".$params[7];
  $documento = " ,documento_caf = ".$params[13];//numero de la factura alaque se realiza la ND
  
if($tipo=='NC'){
//nota de credito actual		
$ncActual="select serial_dar, cantidad_dfa,serial_caf from detallefactura where serial_caf = $serial_caf";
$retncActual= $dblink->Execute($ncActual);
//echo "</p>".$ncActual;

//facturas hechas 
$ncFactura="select serial_dar, cantidad_dfa, serial_caf from detallefactura where serial_caf = $params[13]
and serial_caf in(select serial_caf from cabecerafactura where tipo_caf = 'FAC')";
$retncFactura = $dblink->Execute($ncFactura);
//echo "</p>".$ncFactura;
//notas de credito hechas anteriormente
$ncRealizadas = "select serial_dar, serial_caf, sum(cantidad_dfa) as cantidad_dfa from detallefactura
where serial_caf in(select serial_caf from cabecerafactura where documento_caf =$params[13] and tipo_caf = 'NC')
group by serial_dar";
//echo "</p>".$ncRealizadas;

$retncRealizadas = $dblink->Execute($ncRealizadas);

$f=0;
$c=0;
$cont = 0;

//COMPARA CANTIDADES ENTERE FACTURA Y NOTAS DE CREDITO HECHAS
if($retncFactura->RecordCount()>0){
					//$bandera =0;
					 while(!$retncFactura->EOF ){		
					 			$f=$f+1;
								$retncRealizadas->MoveFirst();
								while(!$retncRealizadas->EOF ){					
	 			
									if($retncFactura->fields['serial_dar']==$retncRealizadas->fields['serial_dar']){	
											$c=1;//bandera
											$ncRealizada[$f][2]=$retncFactura->fields['cantidad_dfa']-$retncRealizadas->fields['cantidad_dfa'];
											$ncRealizada[$f][1]=$retncFactura->fields['serial_dar'];
											//echo "</p> -";
									}
									
									$retncRealizadas->MoveNext();
								 }
					 					 
								$cont=$cont+1;
								$validar[$cont][1] = $retncFactura->fields['serial_dar'];
								$validar[$cont][2] = $retncFactura->fields['cantidad_dfa'];
//								echo $validar[$cont];
					 	$retncFactura->MoveNext();
					 }
}

//$vec = count($validar);
//echo "////".$vec;

if($c>0)
	//$vec = (count($ncRealizada,1)/count($ncRealizada,0))-1;
	
	$vec = count($ncRealizada);
//echo "////".$vec;
$c=0;

if($retncActual->RecordCount()>0){										
		while(!$retncActual->EOF){		
					 for($i=1;$i<=$vec;$i++){
					 	if($retncActual->fields['serial_dar']==$ncRealizada[$i][1]){
							if($retncActual->fields['cantidad_dfa']>$ncRealizada[$i][2]){
								echo "No se puede guardar, es posible que la cantidad de uno de los rubros sea mayor a la realizada en la factura o ya se realizaron notas de crédito por este rubro o  la cantidad sumada sobrepasa la de la factura.";
								return;
							}
						}
					 }
		 	$retncActual->MoveNext();
		 }
	}
 
}

//valida si hay creditos por tomar
$creditosporTomar="select dfa.serial_dfa,dfa.cantidad_dfa, ara.portomar_ara, ara.serial_ara
					from cabecerafactura as caf, detallefactura as dfa, detallearancel as dar, aranceles as ara
					where caf.serial_caf = dfa.serial_caf
					and dfa.serial_dar = dar.serial_dar
					and dar.serial_ara = ara.serial_ara 
					and caf.serial_caf = ".$serial_caf."
					and ara.portomar_ara like 'SI'";
//echo "</p>".$creditosporTomar;
$retcreditosporTomar = $dblink->Execute($creditosporTomar);

if($retcreditosporTomar->RecordCount()>0){
			while(!$retcreditosporTomar->EOF ){
				/*echo "</p> CREDITOS: ".$retcreditosporTomar->fields['cantidad_dfa'];
				echo "</p> ARANCEL: ".$retcreditosporTomar->fields['serial_ara'];
				echo "</p> detalle fact: ".$retcreditosporTomar->fields['serial_dfa'];*/
				
				//INSERTA CREDITOS POR TOMAR EN LA TABLA CREDITOS POR TOMAR
				$insertarPortomar = "insert into cabeceracreditosportomar(serial_ara, serial_dfa, afavor_cpt,fechaabierta_cpt,estado_cpt) values(".$retcreditosporTomar->fields['serial_ara'].",".$retcreditosporTomar->fields['serial_dfa'].",".$retcreditosporTomar->fields['cantidad_dfa'].",current_date(),'ABIERTA')";
				$dblink->Execute($insertarPortomar);				
				$retcreditosporTomar->MoveNext();
			 }	
}

  // echo "|1|";
  if($serial_caf>0){
		//VERIFICA QUE ESTE GUARDADO EL RECIBO DE COBRO 
		$rsNumRecibo= $dblink->Execute("select fechacaducidad_caf from cabecerafactura where serial_caf=".$serial_caf);
	 	if ($rsNumRecibo->RecordCount()>0){
			if($rsNumRecibo->fields['fechacaducidad_caf']!='0000-00-00'){
					$SQLCmd="update cabecerafactura set serial_suc=".$params[7].",  total_caf=(select sum(valor_dar*cantidad_dfa) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_alu='".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."', serial_dep='".$params[5]."',estado_caf='".$params[6]."' ,tipo_caf='".$tipo."' where serial_caf=".$serial_caf;
	//echo "</p> 1 -> ".$SQLCmd;
	}
    else{
          $numero_caf=leerSecuenciaDocumentos($dblink,$params[7],$serial_tic);		  
          $SQLCmd="update parametros,tipocomprobante,secuenciadocumentos set numero_sdo = numero_sdo + 1 where serial_suc=".$params[7]." and tipocomprobante.serial_tic=secuenciadocumentos.serial_tic and tipocomprobante.codigo_tic=parametros.valor_pag and parametros.codigo_pag = '".$tipo."'";	  
    $dblink->Execute($SQLCmd);

    if ($numero_caf[0]==0){
       echo $numero_caf[1]."|0|";
       return;
    }
    $SQLCmd="update cabecerafactura  set   serial_suc=".$params[7].", total_caf=(select sum(valor_dar*cantidad_dfa) from detallefactura,detallearancel  where detallearancel.serial_dar=detallefactura.serial_dar and detallefactura.serial_caf=".$serial_caf.") ,serial_alu='".$params[1]."', serial_ama='".$params[2]."', serial_per='".$params[3]."', numero_caf='".$numero_caf[0]."',  serial_dep='".$params[5]."',estado_caf='".$params[6]."' ,fechacaducidad_caf='".$numero_caf[3]->fields['FECHACADUCIDAD_SDO']."' ,autorizacion_caf='".$numero_caf[3]->fields['AUTORIZACIONSRI_SDO']."', fechaemision_caf = CURRENT_DATE(), serie_caf='".$numero_caf[3]->fields['serie']."' , tipo_caf = '".$tipo."'".$sede.$documento." where serial_caf=".$serial_caf;
    }
    $dblink->Execute($SQLCmd);
	
   }

   $SQLSelect="SELECT if( porcentaje_dde IS NULL , 1, porcentaje_dde ),detalle_descuento.serial_caa FROM detalle_descuento, detallefactura WHERE detalle_descuento.serial_caa =".$params[10]. " AND detalle_descuento.serial_dar = detallefactura.serial_dar AND detallefactura.serial_caf = ".$params[0];
  
    
$rsDescuento= $dblink->Execute($SQLSelect);
$descuento=0;
$serial_caa=0;
if(!empty($rsDescuento->fields[0])) $descuento="if (credito_ara = 'SI',(1-".$rsDescuento->fields[0]."),0)";
if(!empty($rsDescuento->fields[1])) $serial_caa=$rsDescuento->fields[1];

$params[11]=trim($params[11]);
$params[12]=trim($params[12]);
if(!empty($params[11])) $cliente="'".$params[11]."'";
	else $cliente=" concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) ";
if(!empty($params[12])) $cedula="'".$params[12]."'";
	else $cedula=" codigoIdentificacion_alu ";	
	
if(!empty($params[17])) $matricula=$params[17];
	else $matricula = 0 ;	

if(!empty($params[18])) $cliente_upac=$params[18];
	else $cliente_upac = 0 ;	
	
	
		
/***************************************Actualiza Cuantas contables segun los ranceles*******************************************/
if($tipo=='NC'){
  $cuantaContable = "detallefactura.serial_plc=detallearancel.serial_plcncd, detallefactura.serial_plce=detallearancel.serial_plcnch";
}else{
  $cuantaContable = "detallefactura.serial_plc=detallearancel.serial_plcfd, detallefactura.serial_plce=detallearancel.serial_plcfh";
} 
 
$SQLCmd="update aranceles,cabecerafactura,detallefactura,detallearancel,alumno set ".$cuantaContable.", valor_aal = (valor_dar * ".$valornegativo."), valorajuste_aal=".$descuento.",descuento_dfa=-(valor_dar*cantidad_dfa*".$descuento."),detallefactura.serial_caa=  if (credito_ara = 'SI',".$serial_caa.",0),cliente_caf=".$cliente.",cedula_caf=".$cedula.", serial_mmat=".$matricula." ,serial_cliu=".$cliente_upac." where aranceles.serial_ara=detallearancel.serial_ara and detallearancel.serial_dar=detallefactura.serial_dar and alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf=detallefactura.serial_caf and detallefactura.serial_caf=".$serial_caf;
     $dblink->Execute($SQLCmd);
	//echo $tipo."</p>";
	if($tipo=='ND'){
		$SQLCmd="update detallefactura,detallearancel set  valor_aal = (select valor_dre from detallerecibo where serial_dre =".$params[13].") where detallearancel.serial_dar=detallefactura.serial_dar and descripcion_dar  like 'CHD%' and detallefactura.serial_caf=".$serial_caf."  "; 
		  $dblink->Execute($SQLCmd);
		//echo $SQLCmd;
		  $SQLCmd="update cabecerafactura  set   total_caf=(select sum(valor_aal*cantidad_dfa) from detallefactura  where  detallefactura.serial_caf=".$serial_caf.")  where serial_caf=".$serial_caf;
		  $dblink->Execute($SQLCmd);
		  
		 //echo "entro al ND".$params[13];		  
		  $actividad = "update detallerecibo set actividad_dre = 'cerrada' where serial_dre =".$params[13];
		  $dblink->Execute($actividad);
		//echo $SQLCmd;  
}
	//ACTUALIZA EL TOTAL DE LA FACTURA SI EXISTE ALGUN DESCUENTO
	if(!empty($rsDescuento->fields[0])){	
		$SQLCmd="update cabecerafactura  set  total_caf=(total_caf+(select sum(descuento_dfa) from detallefactura  where  detallefactura.serial_caf=".$serial_caf."))  where serial_caf=".$serial_caf;
		$dblink->Execute($SQLCmd);
		
		
	}
}
// cambia es estado para la factura ala que se hizo la nota de credito
	if($tipo=='NC'){
		validarEstado($validar, $params[13]);
	}
}
  
omnisoftExecuteUpdate();

?>
