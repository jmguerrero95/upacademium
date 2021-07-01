

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
 	 	 $serial_rop=$_GET['serial_rop'];
		 $provision=$_GET['provision'];
		//echo "provi:".$provision;
		$desplega_rol="";
		if($provision=='si')
			$desplega_rol= " and desplegarrol_rgr='NO' ";
		else
			$desplega_rol= " and desplegarrol_rgr='SI' ";
			

$rsEmpleado=$dblink->Execute("select *,sucursal.NOMBRE_SUC from periodorol,rolpagosgeneral,empleado,empleadorolpagos,departamentos,agencia
left join sucursal on sucursal.serial_age=agencia.serial_age
 where  
  empleado.serial_dep=departamentos.serial_dep and agencia.serial_age=departamentos.serial_age 
 and empleado.serial_epl=empleadorolpagos.serial_epl 
and periodorol.serial_perrol=empleadorolpagos.serial_perrol 
and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol 
and serial_rop=".$serial_rop."  order by sucursal.NOMBRE_SUC,apellido_epl,nombre_epl");
//and generaRol_epl='SI'

 $rsIngresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol ".$desplega_rol." and serial_rop=".$serial_rop);
 
    $rsEgresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol ".$desplega_rol." and serial_rop=".$serial_rop);

//echo "Ingresos:".$rsIngresos->RecordCount();
//echo "Egresos:".$rsEgresos->RecordCount();
$total_nomina=0;
?>
<style type="text/css">
<!--
.style1 {font-size: 36px}
.style2 {font-size: 10px}

-->
</style>
<table width="100%">
  <tr bgcolor="#FFFFFF">
    <td width="44%" rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
    <th width="56%"><? if($provision=='si') echo "PROVISIONES"; ?></th>
  </tr>
  <tr>
    <th><? echo 'ROL DE PAGOS DE '.$rsEmpleado->fields['DESCRIPCION_PERROL'];?></th>
  </tr>
  <tr>
    <th align="right"><? echo date("Y-m-d"); ?></th>
  </tr>
</table>
<br />
<br />
<table width="100%" border="1">
  <tr>
  <th rowspan="2" >Nro.</th>
  <th rowspan="2" >SEDE</th>
    <th rowspan="2" >EMPLEADO</th>
    <th  align="center" colspan="<? echo $rsIngresos->RecordCount();?>" class="style2">INGRESOS</th>
	<? if($rsEgresos->RecordCount()>0){?>
    <th  align="center" colspan="<? echo $rsEgresos->RecordCount();?>"class="style2">EGRESOS</th>
	<? }?>
    <th rowspan="2"  align="center" class="style2">TOTAL RECIBIR </th>
 </tr>
 <tr>
 <? while (!$rsIngresos->EOF){
		?>
    <th class="style2"><? echo $rsIngresos->fields['codigo_rgr']; ?></th>
	<?
	$rsIngresos->MoveNext();
		
	}
	while (!$rsEgresos->EOF){
	?>
	<th class="style2"><? echo $rsEgresos->fields['codigo_rgr']; ?></th>
	<? 
		$rsEgresos->MoveNext();
	}
	
	?>
	
  </tr>
  
  <? 
  $i=1;
  while (!$rsEmpleado->EOF){ ?>
  
  <tr>
  <td class="style2"><? echo $i; ?></td>
  <td class="style2"><? echo $rsEmpleado->fields['NOMBRE_SUC']; ?></td>
  <td class="style2"><? echo $rsEmpleado->fields['APELLIDO_EPL']."  ".$rsEmpleado->fields['NOMBRE_EPL']; ?></td>
  <?
    $serial_erp=$rsEmpleado->fields['SERIAL_ERP']; 
    $totalIngresos=0;
	$totalEgresos=0;
	$rsIngresos->MoveFirst();
	$i1=0;
	while (!$rsIngresos->EOF){
	//and tipo_rgr='INGRESO' and
		$rsIngresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0  and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr  and serial_erp=".$serial_erp." and codigo_rgr='".$rsIngresos->fields['codigo_rgr']."'" );		
		
		//echo "select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0  and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr  and serial_erp=".$serial_erp." and codigo_rgr='".$rsIngresos->fields['codigo_rgr']."'";
		
		$totalIngresos+= $rsIngresosVal->fields['VALOR_DRP'];
		$ing[$i1]=$ing[$i1]+$rsIngresosVal->fields['VALOR_DRP'];
		$i1++;
		
		?>
    <td class="style2"><? echo $rsIngresosVal->fields['VALOR_DRP']; ?></td>
	<?
	$rsIngresos->MoveNext();
		
	}
	//Cuando No existe registros de provisiones no muestra los egeresos
	if($rsEgresos->RecordCount()>0){
			$j=0;
			$rsEgresos->MoveFirst();
			while (!$rsEgresos->EOF){
				//and tipo_rgr='EGRESO'
				
				$rsEgresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0  and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp." and codigo_rgr='".$rsEgresos->fields['codigo_rgr']."'" );
				
				
				$totalEgresos+= $rsEgresosVal->fields['VALOR_DRP'];
				$egr[$j]=$egr[$j]+$rsEgresosVal->fields['VALOR_DRP'];
				$j++;
			?>
			<td class="style2"><? echo $rsEgresosVal->fields['VALOR_DRP']; ?></td>
			<? 
				$rsEgresos->MoveNext();
			}
	}
	?>
	<th class="style2"><? $total_nomina=$total_nomina+($totalIngresos-$totalEgresos); echo $totalIngresos-$totalEgresos; ?></th>
  </tr>	
  <? $rsEmpleado->MoveNext();
  $i++;
	}
	?>
	 <tr>
  <th class="style2" colspan="3">TOTAL</th>
  <? for($i1=0;$i1<count($ing);$i1++){?>
  		 <th class="style2"><? echo $ing[$i1]; ?></th>
  <? } ?>
  
  <? for($j=0;$j<count($egr);$j++){?>
  		 <th class="style2"><? echo $egr[$j]; ?></th>
  <? } ?>
  <th class="style2"><? echo $total_nomina; ?></th>
  </tr>
</table>
