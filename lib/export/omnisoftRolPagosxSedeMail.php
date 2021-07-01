  <?php
//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 	 	$serial_suc=$_GET['serial_suc'];
 		$serial_perrol=$_GET['serial_perrol'];;
		
		$rsEmpleado=$dblink->Execute('SELECT DISTINCT(DOCUMENTOIDENTIDAD_EPL), sucursal.*,departamentos.*,agencia.*,cargos.*,escalafones.*,periodorol.*,empleado.*,empleadorolpagos.* from sucursal,departamentos,agencia,cargos,escalafones,periodorol,empleado,empleadorolpagos where sucursal.serial_age=agencia.serial_age and empleado.serial_dep=departamentos.serial_dep and agencia.serial_age=departamentos.serial_age and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol='.$serial_perrol.' and sucursal.serial_suc='.$serial_suc.' order by DOCUMENTOIDENTIDAD_EPL');
 
ini_set("SMTP","WEBMAIL.upacifico.edu.ec");
ini_set("smtp_port",25);
 ini_set ( 'sendmail_from' ,  'thania.pastor@upacifico.edu.ec' ); 
 
 

 while (!$rsEmpleado->EOF)
{
 	$destinatario = $rsEmpleado->fields['EMAILUNIV_EPL'];
	//echo "</br>".$destinatario;
	//$destinatario = "maria.yumbay@upacifico.edu.ec"; 
	$asunto = "ROL DE PAGO MES DE : ".$rsEmpleado->fields['DESCRIPCION_PERROL'];
	$cont=$cont+1;
	//echo "SELECT empleadorolpagos.SERIAL_ERP as SERIAL_ERP  FROM empleado, empleadorolpagos WHERE empleado.serial_epl=empleadorolpagos.serial_epl AND empleadorolpagos.serial_perrol=".$serial_perrol."  AND DOCUMENTOIDENTIDAD_EPL =".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL'];
	
	$sqlerp="SELECT empleadorolpagos.SERIAL_ERP as SERIAL_ERP  FROM empleado, empleadorolpagos WHERE empleado.serial_epl=empleadorolpagos.serial_epl AND empleadorolpagos.serial_perrol=".$serial_perrol."  AND DOCUMENTOIDENTIDAD_EPL ='".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']."'";
	
	//echo $sqlerp;
	
	$rserp=$dblink->Execute($sqlerp);


	
$rsIngresos=$dblink->Execute("SELECT
    *
FROM
    rubrogeneralrolpagos,
    detallerolpagos 
WHERE
    valor_drp>0 
    AND tipo_rgr='INGRESO' 
    AND desplegarrol_rgr='SI' 
    AND rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr 
    AND serial_erp  IN ( SELECT
                            empleadorolpagos.SERIAL_ERP 
                        FROM
                            empleado,
                            empleadorolpagos 
                        WHERE
                            empleado.serial_epl=empleadorolpagos.serial_epl 
                            AND empleadorolpagos.serial_perrol=".$serial_perrol." 
                            AND DOCUMENTOIDENTIDAD_EPL = '".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']."')");
							
														
$rsEgresos=$dblink->Execute("SELECT
    *
FROM
    rubrogeneralrolpagos,
    detallerolpagos 
WHERE
    valor_drp>0 
    AND tipo_rgr='EGRESO' 
    AND desplegarrol_rgr='SI' 
    AND rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr 
    AND serial_erp IN ( SELECT
                            empleadorolpagos.SERIAL_ERP 
                        FROM
                            empleado,
                            empleadorolpagos 
                        WHERE
                            empleado.serial_epl=empleadorolpagos.serial_epl 
                            AND empleadorolpagos.serial_perrol=".$serial_perrol." 
                            AND DOCUMENTOIDENTIDAD_EPL = '".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']."')");
	

	
		$totalIngresos=0;
		$totalEgresos=0;
		$total_nomina=0;

$cuerpo="
		<head>
		<title>ROL DE PAGOS</title>
		</head>
		<body>\n
		<table align='center' width='80%' border='1'>\n
		<tr >
		<td width='20%'  rowspan='3' bgcolor='#FFFFFF'><img src='http://sifa.upacifico.edu.ec/upacifico/upacademium/images/themes/csg/logo.jpg' width='231' height='81' /></td>
		<th width='53%' align='center'>ROL DE PAGOS DE  ".$rsEmpleado->fields['DESCRIPCION_PERROL']."</th>
		 </tr>

		 <tr><th >EMPLEADO:".$rsEmpleado->fields['APELLIDO_EPL'].' '.$rsEmpleado->fields['NOMBRE_EPL']."</th>
		 </tr>
				  
		<tr><th align='right' >".date('Y-m-d')."</th>
		</tr>
		<tr>		<th colspan='2'><table width='80%' >
					  		<tr >
						<th ><b>CARGO</b></th>
						<td > ".$rsEmpleado->fields['NOMBRE_CAR']."</td>
						<th><b>DEPARTAMENTO</b></th>
						<td>".$rsEmpleado->fields['descripcion_dep']."</td>
						<th><b>AREA FUNCIONAL</b></th>
						<td>".$rsEmpleado->fields['NOMBRE_SUC']."</td>
					  </tr>		
			  </table>
			  
			  </tr>";
			  
 
 $cuerpo.="
 <tr>
		   <td colspan='2'><table width='80%' align='center' bordercolor='#000000'>
				<tr>
				<th  colspan='2'><b>INGRESOS </b></th>
			  </tr>";

	  while (!$rsIngresos->EOF){
				$totalIngresos+= $rsIngresos->fields['VALOR_DRP'];
 
			$cuerpo.="
			<tr >
			<td > ".$rsIngresos->fields['NOMBRE_RGR']."</td>
			<td >".$rsIngresos->fields['VALOR_DRP']."</td>
			</tr>";
			
			$rsIngresos->moveNext();
				
			}
		  
$cuerpo.="
		  <tr>
			<td >Total Ingresos:</td>
			<td></td>
			<td  >".$totalIngresos."</td>
			
			</tr>
			<tr>
				<th  colspan='2'><b>EGRESOS </b></th>
			  </tr>";
			 
	while (!$rsEgresos->EOF){
				$totalEgresos+= $rsEgresos->fields['VALOR_DRP'];
				
 $cuerpo.="
			<tr>
			<td >".$rsEgresos->fields['NOMBRE_RGR']."</td>
			<td >".$rsEgresos->fields['VALOR_DRP']."</td>
			</tr>";
			
			$rsEgresos->moveNext();
				
			}

$cuerpo.="
		  <tr>
			<td >Total Egresos:</td>
			<td></td>
			<td >".$totalEgresos."</td>
			
			</tr>
			";
		$neto=$totalIngresos-$totalEgresos;
		$cuerpo.="
		  <tr>
			<td >NETO A RECIBIR:</td>
			<td></td>
			<td ><b><u>".$neto."</u></b></td>
			</tr>
			
			</tr>
			
			";
$cuerpo.="
			   <tr >	
			
			<td border='0'>		
			<center><br><br>
			 
			________________________________________<br> 
			RECIBI CONFORME<br>
			". $rsEmpleado->fields['APELLIDO_EPL']." ".$rsEmpleado->fields['NOMBRE_EPL']."<br>
			C.I. :".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']." </center>
			</td></tr>
			</table>
</table>
 </body>
";

 //echo $destinatario;
// echo $asunto;
//echo $headers;
//echo $cuerpo;
//Envío en formato HTML 

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//Dirección del remitente 
$headers .= "From:thania.pastor@upacifico.edu.ec\r\n"; 

//Dirección de respuesta (Puede ser una diferente a la de pepito@mydomain.com)
$headers .= "Reply-To: thania.pastor@upacifico.edu.ec\r\n"; 

//Ruta del mensaje desde origen a destino 
$headers .= "Return-path: thania.pastor@upacifico.edu.ec\r\n"; 

//direcciones que recibián copia 
//$headers .= "Cc: maria.yumbay@upacifico.edu.ec,evelyn.gomez@upacifico.edu.ec,cristina.hidalgo@upacifico.edu.ec\r\n"; 

//Direcciones que recibirán copia oculta 
//$headers .= "Bcc: ivan.jacome@upacifico.edu.ec, ivan.jacome@upacifico.edu.ec\r\n"; 
//$headers .= "Bcc: evelyn.gomez@upacifico.edu.ec\r\n"; 
//ini_set('sendmail_from','ivan.jacome@upacifico.edu.ec');
//$texto = strtolower($texto) para pasar a minuscula un texto
//ucwords($texto) // pasar  la primera a mayuscula
//echo strtolower($destinatario)."</p>";


		if(mail($destinatario,$asunto,$cuerpo,$headers)){ 
			//echo strtolower($destinatario)."</p>";
			echo "<br> Enviado a:  ".strtolower($destinatario)."  ".ucfirst($rsEmpleado->fields['APELLIDO_EPL'])."  ".ucfirst($rsEmpleado->fields['NOMBRE_EPL'])." ".$rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']; 
			}else{ 
			echo "Ha ocurrido un error y no se puede enviar el correo"; 
		}
		
 $rsEmpleado->moveNext();

 }		
		
//mail($destinatario,$asunto,$cuerpo,$headers);

//mail("ivan.jacome@upacifico.edu.ec","asunto","hola a todos",$headers); 
?>

