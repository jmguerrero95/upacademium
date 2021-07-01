

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
and serial_rop=".$serial_rop."    order by sucursal.NOMBRE_SUC,apellido_epl,nombre_epl");

 $rsIngresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol ".$desplega_rol." and serial_rop=".$serial_rop);
 
    $rsEgresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol ".$desplega_rol." and serial_rop=".$serial_rop);

//echo "Ingresos:".$rsIngresos->RecordCount();
//echo "Egresos:".$rsEgresos->RecordCount();
$total_nomina=0;
?>
<style type="text/css">
<!--
.style1 {font-size: 20px}
.style2 {font-size: 7px}

-->
</style>
<table width="80%" align="center">
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
<table width="80%" border="1" align="center">
  <tr>
  <th rowspan="2" >Nro.</th>
  <th rowspan="2" >SEDE</th>
    <th rowspan="2" >EMPLEADO</th>
    <th rowspan="2" >FECHA INGRESO </th>
    <th  align="center" colspan="<? echo $rsIngresos->RecordCount()+1;?>" class="style2">INGRESOS</th>
	<? if($rsEgresos->RecordCount()>0){?>
    <th  align="center" colspan="<? echo $rsEgresos->RecordCount()+1;?>"class="style2">EGRESOS</th>
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
	?>
	<th  align="center" class="style2">TOTAL ING. </th>
	<?
	while (!$rsEgresos->EOF){
	?>
	<th class="style2"><? echo $rsEgresos->fields['codigo_rgr']; ?></th>
	<? 
		$rsEgresos->MoveNext();
	}
	
	?>
	<th  align="center" class="style2">TOTAL EGR. </th>
  </tr>
  
  <? 
  $i=1;
  while (!$rsEmpleado->EOF){ 
  //IMPRIME LOS TOTALES POR CADA SEDE
  
  if ($i>1 && $sucursal!=$rsEmpleado->fields['NOMBRE_SUC'] ) {
      ?>
			<tr>
		  <th class="style2" colspan="4">TOTAL  <? echo  $sucursal; ?></th>
		  <? $ting=0; for($m=0;$m<count($sede_ing);$m++){ $ting=$ting+$sede_ing[$m]; ?>
				 <th class="style2"><? echo $sede_ing[$m]; ?></th>
		  <? $sede_ing[$m]=0;} ?>
		  <th class="style2"><? echo  $ting; ?></th>
		  <? $tegr=0; for($n=0;$n<count($sede_egr);$n++){ $tegr=$tegr+$sede_egr[$n]; ?>
				 <th class="style2"><? echo $sede_egr[$n]; ?></th>
		  <? $sede_egr[$n]=0; } ?>
		  <th class="style2"><? echo  $tegr; ?></th>
		  <th class="style2"><? echo $total_sede; ?></th>
		  </tr>

  <?
  $total_sede=0;
  //$sede_ing[]=0;
  //$sede_egr[]=0;
  }
  ?>
  <tr>
  <td class="style2"><? echo $i; ?></td>
  <td class="style2"><? echo $rsEmpleado->fields['NOMBRE_SUC']; ?></td>
  <td  class="style2"><? echo $rsEmpleado->fields['APELLIDO_EPL']."  ".$rsEmpleado->fields['NOMBRE_EPL']; ?></td>
  <td  class="style2"><? echo $rsEmpleado->fields['FECHAINGRESO_EPL']; ?></td>
  <?
    $serial_erp=$rsEmpleado->fields['SERIAL_ERP']; 
    $totalIngresos=0;
	$totalEgresos=0;
	$rsIngresos->MoveFirst();
	$i1=0;
	while (!$rsIngresos->EOF){
	//and tipo_rgr='INGRESO' and
		$rsIngresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0  and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr  and serial_erp=".$serial_erp." and codigo_rgr='".$rsIngresos->fields['codigo_rgr']."'" );
		$totalIngresos+= $rsIngresosVal->fields['VALOR_DRP'];
		$ing[$i1]=$ing[$i1]+$rsIngresosVal->fields['VALOR_DRP'];
		$sede_ing[$i1]=$sede_ing[$i1]+$rsIngresosVal->fields['VALOR_DRP'];
		$i1++;
		?>
    <td class="style2"><? echo $rsIngresosVal->fields['VALOR_DRP']; ?></td>
	<?
	$rsIngresos->MoveNext();
	}
	?>
	<td class="style2"><? echo $totalIngresos; ?></td>
	<?
	//Cuando No existe registros de provisiones no muestra los egeresos
	if($rsEgresos->RecordCount()>0){
			$j=0;
			$rsEgresos->MoveFirst();
			while (!$rsEgresos->EOF){
				//and tipo_rgr='EGRESO'
				$rsEgresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0  and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr  and serial_erp=".$serial_erp." and codigo_rgr='".$rsEgresos->fields['codigo_rgr']."'" );
				$totalEgresos+= $rsEgresosVal->fields['VALOR_DRP'];
				$egr[$j]=$egr[$j]+$rsEgresosVal->fields['VALOR_DRP'];
				$sede_egr[$j]=$sede_egr[$j]+$rsEgresosVal->fields['VALOR_DRP'];
				$j++;
			?>
			<td class="style2"><? echo $rsEgresosVal->fields['VALOR_DRP']; ?></td>
			<? 
				$rsEgresos->MoveNext();
			}
	}
	?>
	<td class="style2"><? echo $totalEgresos; ?></td>
	<th class="style2"><? $total_nomina=$total_nomina+($totalIngresos-$totalEgresos); $total_sede=$total_sede+($totalIngresos-$totalEgresos); echo $totalIngresos-$totalEgresos; ?></th>
  </tr>	
   <?
   
  	  $sucursal=$rsEmpleado->fields['NOMBRE_SUC'];	
	  $rsEmpleado->MoveNext();
	  $i++;
	}
	?>
	 <tr>
	  <th class="style2" colspan="4">TOTAL  <? echo  $sucursal; ?></th>
	  <? $ting=0; for($m=0;$m<count($sede_ing);$m++){ $ting=$ting+$sede_ing[$m]; ?>
			 <th class="style2"><? echo $sede_ing[$m]; ?></th>
	  <? } ?>
	  <th class="style2"><? echo  $ting; ?></th>
	  <? $tegr=0; for($n=0;$n<count($sede_egr);$n++){ $tegr=$tegr+$sede_egr[$n]; ?>
			 <th class="style2"><? echo $sede_egr[$n]; ?></th>
	  <? } ?>
	  <th class="style2"><? echo  $tegr; ?></th>
	  <th class="style2"><? echo $total_sede; ?></th>
	 
	  </tr>
		  	
	 <tr>
  <th class="style2" colspan="4">TOTAL NACIONAL</th>
  <? $tning=0; for($i1=0;$i1<count($ing);$i1++){ $tning=$tning+$ing[$i1];?>
  		 <th class="style2"><? echo $ing[$i1]; ?></th>
  <? } ?>
  <th class="style2"><? echo  $tning; ?></th>
  <? $tnegr=0; for($j=0;$j<count($egr);$j++){ $tnegr=$tnegr+$egr[$j];?>
  		 <th class="style2"><? echo $egr[$j]; ?></th>
  <? } ?>
  <th class="style2"><? echo $tnegr; ?></th>
  <th class="style2"><? echo $total_nomina; ?></th>
  	  
  </tr>
</table>
