<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$sucursal=0;
$programa=0;
$periodo=0;
$horario=0;
$empleado=0;
$serial_nts=0;
$ntotalclases=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;
$dblink = NewADOConnection($DBConnection);
}

function omnisoftProcesarAlumnosNotas($serial_cre,$serial_caf,$serial_alu){
 global $dblink;
   $actualizacion=false;
   
/*  echo "serial cre: ".$serial_cre."</p>";
  echo "serial caf: ".$serial_caf."</p>";
  echo "serial alu: ".$serial_alu."</p>";*/
  
  $detalleCobro = "SELECT	serial_dre,	serial_cre,	valor_dre,	iva_dre, descuento_dre,	subtotal_dre, total_dre, pago_dre, descripcion_dre, serial_dar,	codigo_dre,	estado_dre,	tipo_dre, serial_forc,
  	numeroDocumento_dre, fecha_dre,	serial_ban,	plazo_dre,	referencia_dre,	lote_dre,	tarjetahabiente_dre ,	serial_plc,	actividad_dre 
FROM
	detallerecibo 
WHERE
	serial_cre = ".$serial_cre." AND
	serial_forc = 2 and plazo_dre <> 0";
   $resdetalleCobro=$dblink->Execute($detalleCobro);	    
//    echo $detalleCobro."</p>";

	if(!empty($resdetalleCobro)){

		  while(!$resdetalleCobro->EOF){
		  $i=1;

			
						$fecha = $resdetalleCobro->fields['fecha_dre'];			  
//						$valor = $resdetalleCobro->fields['valor_dre']/$resdetalleCobro->fields['plazo_dre'];			
						$valor = number_format(($resdetalleCobro->fields['valor_dre']/$resdetalleCobro->fields['plazo_dre']),2);
						$actualizaCobro1="update detallerecibo set valor_dre = ".$valor.", plazo_dre= 0, referencia_dre = 'Cuota ".$i."' where serial_dre = ".$resdetalleCobro->fields['serial_dre'];
						$dblink->Execute($actualizaCobro1);			
						  for($i=2;$i<=$resdetalleCobro->fields['plazo_dre'];$i++){
							 $fecha=date("Y-m-d",strtotime($fecha." + 1 month"));				  		
			
			
							$insertarCreditoDirecto="INSERT INTO detallerecibo(serial_dre, serial_cre, valor_dre, iva_dre, descuento_dre, subtotal_dre, total_dre, pago_dre, descripcion_dre, serial_dar, codigo_dre
													, estado_dre, tipo_dre, serial_forc, numeroDocumento_dre, fecha_dre, serial_ban, plazo_dre, referencia_dre, lote_dre, tarjetahabiente_dre 
													, serial_plc, actividad_dre)
													SELECT 0, serial_cre, ".$valor.", iva_dre, descuento_dre, subtotal_dre, total_dre, pago_dre, descripcion_dre, serial_dar, codigo_dre
													, estado_dre, tipo_dre, serial_forc, numeroDocumento_dre, '".$fecha."', serial_ban, 0, 'Cuota ".$i."', lote_dre, tarjetahabiente_dre 
													, serial_plc, actividad_dre FROM detallerecibo WHERE serial_dre = ".$resdetalleCobro->fields['serial_dre'];
							$dblink->Execute($insertarCreditoDirecto);
			
						  }
						  
		  
		  
		  $resdetalleCobro->MoveNext(); 		  
		  }
	}
  


} 		
  $query = $_POST['query']; //DEFECTO
   
  // $query = $_GET['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);

       omnisoftProcesarAlumnosNotas($params[0],$params[1],$params[2],$params[3]);

?>