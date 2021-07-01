<?php
	include('../lib/adodb/adodb.inc.php');
	include('../config/config.inc.php');
	
	function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);
	return $dblink;
	}
?>
<script language="javascript" type="text/javascript">
function proceso(){
					document.deposito.action="depositos2008.php"					
			 		document.deposito.submit();
					//alert ("hola Mundo")
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<form name="deposito" method="post">
<table>	
	<tr>
		<td>Procesar Depósoito</td>	
		<td> <input type="text" name="archivo" /> </td>	
		<td> <input type="button" value="Procesar" onClick="proceso()" /></td>
		
	</tr>	
</table>
<table>
	<tr>
		<td> <?php procesoDeposito($_POST['archivo']); ?>  </td>
	</tr>
</table>
</form>
</body>
</html>

<?php 
function  procesoDeposito($archi)
      {	  			
				//echo $archi;
				$dblink=omnisoftConnectDB();				
				if($archi != ""){
						$sqlvalidaexistenciaalumno="SELECT * FROM depositos2008	WHERE trim( depCodigoCliente ) NOT IN (SELECT trim( codigo_alu ) FROM alumno WHERE trim(codigo_alu) IS NOT NULL)	AND deparchivo LIKE '".$archi."' ORDER BY deparchivo, depNo ASC ";
															
															
						$retvalida=$dblink->Execute($sqlvalidaexistenciaalumno);						
						
						if($retvalida->RecordCount()>0){
							echo "Copiar SQL:"."</p>";							
							echo $sqlvalidaexistenciaalumno."</p>";
							
								echo "<table border='1'>";
										
								while (!$retvalida->EOF ){
										echo "<tr>";
										echo "<td>".$retvalida->fields['depNo']."</td>";
										echo "<td>".$retvalida->fields['depCedula']."</td>";
										echo "<td>".$retvalida->fields['depCodigoCliente']."</td>";
										echo "<td>".$retvalida->fields['depNombre']."</td>";
										echo "<td>".$retvalida->fields['depNombreCuenta']."</td>";
										echo "<td>".$retvalida->fields['depCodigoCuenta']."</td>";
										echo "<td>".$retvalida->fields['depFecha']."</td>";
										echo "<td>".$retvalida->fields['depParcial']."</td>";
										echo "<td>".$retvalida->fields['deparchivo']."</td>";
										echo "<td>".$retvalida->fields['depFechaDocumento']."</td>	";									
										echo "</tr>";
										$retvalida->MoveNext();					
								}//fin  del while (!$retvalida->EOF ) {
								echo "</table>";
							
						}//fin del if($retvalida->RecordCount()>0){
						else{  
						
								$sqldeposito2008 = "select * from Depositos2008 where deparchivo like '".$archi."'";
								$retDeposito=$dblink->Execute($sqldeposito2008);						
								
								while (!$retDeposito->EOF ) {								
										$sqlalumno = "select * from alumno where codigo_alu like '".$retDeposito->fields['depCodigoCliente']."'";//consulta en la tabla alumno
										$retalumno=$dblink->Execute($sqlalumno);
																								
										//echo "serial_alu: ".$retalumno->fields['serial_alu']." Cod_alu/codigo cliente:".$retDeposito->fields['depCodigoCliente']." Fecha Documento: ".$retDeposito->fields['depFechaDocumento ']." Nombre: ".$retDeposito->fields['depCedula'].$retDeposito->fields['depNombre']." Parcial: ".$retDeposito->fields['depParcial']."</p>";
										$descripcion = $retDeposito->fields['deparchivo']." - ".$retDeposito->fields['depNombre']." - ".$retDeposito->fields['depCedula'];														
																		
										$sqlcabecerarecibo = "INSERT INTO `cabecerarecibo` (`serial_caf`, `fecha_cre`, `estado_cre`, `numero_cre`, `descripcion_cre`, `valor_cre`, `serial_alu`, `contabilizado_cre`, `serial_com`) VALUES (0,'".$retDeposito->fields['depFechaDocumento']."', 'PAGADO','".$retDeposito->fields['depCodigoCliente']."','".$descripcion."',".$retDeposito->fields['depParcial'].",".$retalumno->fields['serial_alu'].", '', NULL)";					
										$dblink->Execute($sqlcabecerarecibo);
										
										//echo "--> ".$sqlcabecerarecibo."</p>";							
										
										$sqlserial_cre = "select max(serial_cre) from cabecerarecibo";
										$retserial_cre=$dblink->Execute($sqlserial_cre);
										echo "serie ingresada:****".$retserial_cre->fields[0]."</p>";
										
										$sqlcontable = "select serial_plc from plancontable where codigo_plc like '".$retDeposito->fields['depCodigoCuenta']."'";
										$retcontable=$dblink->Execute($sqlcontable);

										echo "cuenta:  ".$retDeposito->fields['depCodigoCuenta'];
										echo "seri:  ".$retcontable->fields['serial_plc'];
										
										if($retDeposito->field['depCodigoCuenta']=="1.1.2.01.01.001"){
											$formacobro=1;
										}else {
											$formacobro=6;
										}
										
							//depTipoPago			
										$sqldetallerecibo ="INSERT INTO `detallerecibo` (`serial_cre`, `valor_dre`, `iva_dre`, `descuento_dre`, `subtotal_dre`, `total_dre`, `pago_dre`, `descripcion_dre`, `serial_dar`, `codigo_dre`, `estado_dre`, `tipo_dre`, `serial_forc`, `numeroDocumento_dre`, `fecha_dre`, `serial_ban`, `plazo_dre`, `referencia_dre`, `lote_dre`, `tarjetahabiente_dre`,`serial_plc`) VALUES (".$retserial_cre->fields[0].", ".$retDeposito->fields['depParcial'].", 0, 0, 0, 0, 0, '".$retDeposito->fields['depTipoPago']."', 0, '', '', '0', ".$formacobro.", '".$retDeposito->fields['depCodigoCliente']."', '".$retDeposito->fields['depFecha']."', 0, 0, '0', '0', '0',".$retcontable->fields['serial_plc'].")";								
										$dblink->Execute($sqldetallerecibo);								
										//echo "--> ".$sqldetallerecibo."</p>";							
										$retDeposito->MoveNext();					
								} //fin del while (!$retDeposito->EOF )
								
													
						/*if ($retDeposito->RecordCount()>0){
							echo "Procesar";
							$sqlalumno = 
						}*/	
					}// fin else						
				}//fin del if($archi != "")
				
				else{
					$SQLCmd = "select * from Depositos2008";
					echo "Ingrese valores para Procesar";
				}	
						
						//$retDeposito=$dblink->Execute($SQLCmd);						
						//echo $retDeposito->RecordCount();
						/*echo "<table border='1'>";
						while (!$retDeposito->EOF ) {								
							echo "<tr>";	
								echo "<td>".$retDeposito->fields['depNo']." "."</td>"	;
								echo "<td>".$retDeposito->fields['depCedula']." "."</td>";	
								echo "<td>".$retDeposito->fields['depNombre']." "."</td>";	
							echo "</tr>";	
								$retDeposito->MoveNext();								
						}
						echo "</table>";*/
							
      }
?>