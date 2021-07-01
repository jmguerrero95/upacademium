<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 	 	 $serial_epl=$_GET['serial_epl'];
 		 $serial_erp=$_GET['serial_erp'];;
		//echo "provi:".$provision;
				
$empleado='select * from sucursal,departamentos,agencia,cargos,escalafones,periodorol,empleado,empleadorolpagos where sucursal.serial_age=agencia.serial_age and empleado.serial_dep=departamentos.serial_dep and agencia.serial_age=departamentos.serial_age and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_erp='.$serial_erp;
$rsEmpleado=$dblink->Execute($empleado);
//echo "</p>".$empleado;

$ingresos="select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and  desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp;
$rsIngresos=$dblink->Execute($ingresos);
//echo "</p>".$ingresos;

$egresos="select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp;
$rsEgresos=$dblink->Execute($egresos);
//echo "</p>".$egresos;
//echo "Ingresos:".$rsIngresos->RecordCount();
//echo "Egresos:".$rsEgresos->RecordCount();
$total_nomina=0;
?>
<style type="text/css">
<!--
.style2 {font-size: 10px}

-->
</style>
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="27%"  rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
    <th width="73%" align="center" class="style2"><? echo 'ROL DE PAGOS DE '.$rsEmpleado->fields['DESCRIPCION_PERROL'];?></th>
  </tr>
  <tr>
    <th class="style2">EMPLEADO: <? echo $rsEmpleado->fields['APELLIDO_EPL']." ".$rsEmpleado->fields['NOMBRE_EPL']; ?></th>
  </tr>
  <tr>
    <th align="right" class="style2"><? echo date("Y-m-d"); ?></th>
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
    <td class="style2"><? echo $rsIngresos->fields['VALOR_DRP']; ?></td>
    </tr>
	<?
	$rsIngresos->MoveNext();
		
	}
  ?>
  <tr>
    <td>Total Ingresos:</td>
    <td  class="style2"><? echo $totalIngresos; ?></td>
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
    <td class="style2"><? echo $rsEgresos->fields['VALOR_DRP']; ?></td>
    </tr>
	<?
	$rsEgresos->MoveNext();
		
	}
  ?>
  <tr>
    <td>Total Egresos:</td>
    <td class="style2"><? echo $totalEgresos; ?></td>
    </tr>
	   <td><strong>NETO A RECIBIR:</strong></td>
         <td  ><strong><? echo $totalIngresos-$totalEgresos; ?></strong></td>
    </tr>
    </table>     <br><br>
	________________________________________<br>
	RECIBI CONFORME<br>
	<? echo $rsEmpleado->fields['APELLIDO_EPL']." ".$rsEmpleado->fields['NOMBRE_EPL']; ?><br>
	C.I. : <? echo $rsEmpleado->fields['DOCUMENTOIDENTIDAD_EPL']; ?>
      </th>
  </tr>
</table>
