

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
 		$serial_maa=$_GET['serial_maa'];
		//echo($serial_maa);

$result=$dblink->Execute('SELECT maa.serial_maa, codigo_maa, nombre_maa, nombre_fac, nombre_esp, nombre_car, totalcreditostitulo_maa, fecini_maa, fecfin_maa, activo_maa, observaciones_maa, car.serial_car, esp.serial_esp,fac.serial_fac FROM malla AS maa,  facultad as fac, carrera AS car, especialidad AS esp WHERE car.serial_car = maa.serial_car AND esp.serial_esp = maa.serial_esp and fac.serial_fac=car.serial_fac and maa.serial_maa='.$serial_maa);

//COnsulta de areas de acuerdo a la malla
$rsArea=$dblink->Execute('SELECT distinct nombre_are,are.serial_are FROM area AS are, nivel AS niv, detallemalla AS dma, materia AS mat, malla as maa, especialidad as esp WHERE are.serial_are = mat.serial_are AND niv.serial_niv = dma.serial_niv AND mat.serial_mat = dma.serial_mat AND maa.serial_maa=dma.serial_maa AND esp.serial_esp=maa.serial_esp and dma.serial_maa='.$serial_maa.' order by ubicacion_are');
//Consulta de Niveles
$rsNivel=$dblink->Execute('SELECT nombre_niv,anio_niv,serial_niv FROM nivel AS niv order by codigo_niv');

//COnsulta de Materias de acuerdo a la malla y al area
	$rsMaterias=$dblink->Execute('SELECT mat.serial_are,codigo_mat,nombre_mat, niv.serial_niv FROM area AS are, materia as mat, detallemalla as dtm, malla as maa, nivel as niv WHERE are.serial_are = mat.serial_are AND dtm.serial_maa=maa.serial_maa AND dtm.serial_niv=niv.serial_niv AND dtm.serial_mat=mat.serial_mat AND maa.serial_maa='.$serial_maa);
?>
<style type="text/css">
<!--
.style1 {font-size: 36px}
.style2 {font-size: 13px}

-->
</style>
<table width="100%">
  <tr bgcolor="#FFFFFF">
    <td rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
    <th><span class="style1"><? echo $result->fields['nombre_fac'];?></span></th>
  </tr>
  <tr>
    <th><? echo $result->fields['nombre_maa'];?></th>
  </tr>
  <tr>
    <th>ESPECIALIZACION:<? echo $result->fields['nombre_esp'];?></th>
  </tr>
</table>
<br />
<br />
<table width="100%" border="1">
  <tr>
    <th >UBICACI&Oacute;N</td>
	<? while (!$rsArea->EOF)
		{
		?>
    <th  align="center"><? echo $rsArea->fields['nombre_are'];?></th>
	<? 
	$rsArea->MoveNext();
	}
	?>
  </tr>
  
  <? while (!$rsNivel->EOF)
	  {
		?>
	<tr>
    <th><? echo $rsNivel->fields['nombre_niv']; ?></th>
	<? 
	 $rsArea->MoveFirst();
	 while (!$rsArea->EOF)
	  {	
		  $rsMaterias->MoveFirst(); 
		  $mat="";
		  while (!$rsMaterias->EOF)
		  {
		  $i++;
			if($rsNivel->fields['serial_niv']==$rsMaterias->fields['serial_niv'] && $rsArea->fields['serial_are']==$rsMaterias->fields['serial_are'] ){
			 	$mat=$mat.$rsMaterias->fields['codigo_mat']."-".$rsMaterias->fields['nombre_mat']."<br>";
				}
	  	    $rsMaterias->MoveNext();
		 }
		 
		 if($mat!="")
			echo "<span class='style2'><td align='center'>".$mat."</td></span>";
		 else
		   echo "<td>&nbsp;</td>";
		   
		  $rsArea->MoveNext();
		 }
		$rsNivel->MoveNext();
		?>
  </tr>
		<?
	  }
	?>
  
</table>
