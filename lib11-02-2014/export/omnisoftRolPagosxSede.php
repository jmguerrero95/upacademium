<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ROL DE PAGOS</title>
</head>

<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<style type="text/css">
<!--
.style3 {font-size:11px}
.style2 {font-size: 10px}
H1.SaltoDePagina
 {
 page-break-after:always;

   

 }
-->
</style>
<body>
<p>
  <?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 	 	 $serial_suc=$_GET['serial_suc'];
 		 $serial_perrol=$_GET['serial_perrol'];;
		//echo "provi:".$provision;
//echo "<H1 class='SaltoDePagina'></H1>";	
			

$rsEmpleado=$dblink->Execute('select * from sucursal,departamentos,agencia,cargos,escalafones,periodorol,empleado,empleadorolpagos where sucursal.serial_age=agencia.serial_age and empleado.serial_dep=departamentos.serial_dep and agencia.serial_age=departamentos.serial_age and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol='.$serial_perrol.' and sucursal.serial_suc='.$serial_suc.' order by apellido_epl,nombre_epl');
 $i=0;
 echo "<p>";
 $cont=0;
 
 while (!$rsEmpleado->EOF){
	$cont=$cont+1;
//echo "id:".$i."<br>";
	//if($i==2) { //echo "salto de hoja <H1 class=SaltoDePagina> </H1>";	 $i=0;} else echo "<br><br>";
	
		/* $rsIngresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and  desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$rsEmpleado->fields['SERIAL_ERP']);
		 
			$rsEgresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$rsEmpleado->fields['SERIAL_ERP']);
	*/
	
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
	
	
	
	
		//echo "Ingresos:".$rsIngresos->RecordCount();
		//echo "Egresos:".$rsEgresos->RecordCount();
		$totalIngresos=0;
		$totalEgresos=0;
		$total_nomina=0;
		?>


<table width="80%" align="center"  <? if($i==1){ echo "style='page-break-after:always'"; $i=-1;} ?>>
		  <tr bgcolor="#FFFFFF">
			<td width="27%"  rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
			<th width="73%" align="center" class="style2"><? echo 'ROL DE PAGOS DE '.$rsEmpleado->fields['DESCRIPCION_PERROL'];?></th>
		  </tr>
		  <tr>
			<th class="style2">EMPLEADO: <? echo $rsEmpleado->fields['APELLIDO_EPL']." ".$rsEmpleado->fields['NOMBRE_EPL']; ?></th>
		  </tr>
		  <tr>
			<th align="right" class="style3"><? echo date("Y-m-d"); ?></th>
		  </tr>
		  <tr class="style2">
			<th colspan="2"><table width="100%" class="style2">
			  <tr class="style2">
				<th >CARGO</th>
				<td><? echo $rsEmpleado->fields['NOMBRE_CAR'];?></td>
				<th>DEPARTAMENTO</th>
				<td><? echo $rsEmpleado->fields['descripcion_dep'];?></td>
				<th>AREA FUNCIONAL</th>
				<td><? echo  $rsEmpleado->fields['NOMBRE_SUC'] ?></td>
			  </tr>
		
			</table></th>
		  </tr>
		 
		   <tr  class="style2">
			<th colspan="2"><table width="100%"  class="style2" >
			  <tr>
				<th colspan="2">INGRESOS</th>
			  </tr>
		   <?
		  while (!$rsIngresos->EOF){
				$totalIngresos+= $rsIngresos->fields['VALOR_DRP'];
				?>
			<tr >
			<td><? echo $rsIngresos->fields['NOMBRE_RGR']; ?></td>
			<td class="style3"><? echo $rsIngresos->fields['VALOR_DRP']; ?></td>
			</tr>
			<?
			$rsIngresos->MoveNext();
				
			}
		  ?>
		  <tr>
			<td>Total Ingresos:</td>
			<td  class="style3"><? echo $totalIngresos; ?></td>
			</tr>
		<tr>
				<th colspan="2">EGRESOS</th>
			  </tr>
			  <?
		  while (!$rsEgresos->EOF){
				$totalEgresos+= $rsEgresos->fields['VALOR_DRP'];
				?>
			<tr>
			<td><? echo $rsEgresos->fields['NOMBRE_RGR']; ?></td>
			<td class="style3"><? echo $rsEgresos->fields['VALOR_DRP']; ?></td>
			</tr>
			<?
			$rsEgresos->MoveNext();
				
			}
		  ?>
		  <tr>
			<td>Total Egresos:</td>
			<td class="style3"><? echo $totalEgresos; ?></td>
			</tr>
			   <td><strong>NETO A RECIBIR:</strong></td>
				 <td class="style3"><strong><? echo $totalIngresos-$totalEgresos; ?></strong></td>
			</tr>
			</table>     
			<br><br>
			________________________________________<br>
			RECIBI CONFORME<br>
			<? echo $rsEmpleado->fields['APELLIDO_EPL']." ".$rsEmpleado->fields['NOMBRE_EPL']; ?><br>
			C.I. : <? echo $rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']; ?>
			  </th>
		  </tr>
</table>
<?
	if($cont==1){
		echo "<p>&nbsp;</p>";
		
			}
		
	if($cont==2){
		$cont=0;
	}
		
?>
		
<? 
$i++;
echo "</br>";
	$rsEmpleado->MoveNext();
	
   }
//echo "</p>";
//echo "</p>";
?>
</body>
</html>