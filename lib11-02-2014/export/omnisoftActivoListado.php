
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$serial_dep = $_GET['serial_dep'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_cla = $_GET['serial_cla'];

//Parametrizacion
if($serial_dep == "T"){
	$departamento = "";	
	$dpto = "TODOS";
}else{
	$departamento = "AND detalleactivo.serial_dep = ".$serial_dep;
	"";
	$sqlDep = "
		select 
			serial_dep,concat_ws(' - ',descripcion_dep,descripcion_age) as departamento 
		from 
			departamentos,agencia 
		where 
		departamentos.serial_age = agencia.serial_age 
		and serial_dep in (3,8,24,244) 
		and serial_dep = " . $serial_dep;
	$arrDep = $dblink->GetAll($sqlDep);	
	$dpto = $arrDep[0]['departamento'];  

}
if($serial_cla == "T"){
	$clase = "";	
	$tipoclase = "TODAS";
}else{
	$clase = "AND claseactivo.serial_cla = ".$serial_cla;
	$sqlCla = "
		select 
			serial_cla,
			nombre_plc 
		from 
			claseactivo cla,plancontable plc 
		where 
			cla.serial_plc = plc.serial_plc
			and cla.serial_cla = ".$serial_cla;
	$arrCla = $dblink->GetAll($sqlCla);	
	$tipoclase = $arrCla[0]['nombre_plc'];  

	
}
if(strlen($fecha_ini)>0 and strlen($fecha_fin)>0){
	$periodo = "AND FADQUISICION_CBF >='".$fecha_ini."' and FADQUISICION_CBF<='".$fecha_fin."'";
	$fechas = "DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;
}else{
	$periodo = "";
	$fechas = "TODO";
}



$sqlMain = "
	SELECT
		' ' as id, 
		cabeceraactivo.serial_cbf,
		nombre_plc clase,
		nombre_daf descripcion,
		descripcion_tap as parte,
		fadquisicion_cbf  as fecha_compra,
		costo_cbf as costo,
		concat_ws(' - ',descripcion_dep,descripcion_age) as departamento,
		nombre_ubi as ubicacion,
		concat_ws(' ',apellido_epl, nombre_epl) as empleado,
		codigo_com as comprobante,
		codbarras_cbf,
		nombre_pvd as proveedor,
		estado_daf as estado,
		serie_daf as serie,
		tangible_daf as tangible,
		marca_daf as marca,
		modelo_daf as modelo,
		fechabaja_daf as fecha_baja,
		motivobaja_daf as motivo_baja
	FROM
		detalleactivo,
		ubicacion,
		departamentos,
		agencia,
		empleado,
		cabeceraactivo,
		tipoactivoproducto,
		claseactivo,
		plancontable,
		comprobante,
		proveedor
	WHERE 
		detalleactivo.serial_ubi=ubicacion.serial_ubi
		and detalleactivo.serial_dep = departamentos.serial_dep
		and detalleactivo.serial_epl = empleado.serial_epl
		and detalleactivo.serial_cbf = cabeceraactivo.serial_cbf
		and detalleactivo.serial_tap = tipoactivoproducto.serial_tap
		and cabeceraactivo.serial_cla = claseactivo.serial_cla
		and departamentos.serial_age = agencia.serial_age
		and claseactivo.serial_plc = plancontable.serial_plc
		and cabeceraactivo.serial_com = comprobante.serial_com
		and cabeceraactivo.serial_pvd = proveedor.serial_pvd		
		".$clase."			
		".$departamento."
		".$periodo."
		

	ORDER BY
		cabeceraactivo.serial_cbf

	";
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

for ($i=0;$i<$totAll;$i++){	
 	//$arrMain[$i]['estado'] = "_                       _";
}
	

?>

<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
-->
</style>
<script>
function hideboton() {
	document.getElementById('boton').style.visibility='hidden';  
}
//...........................................................
function showboton() {
	document.getElementById('boton').style.visibility='visible';
}
function imprimir() {
 print ();
/*  if (factory.printing.Print(true)){
    //factory.printing.WaitForSpoolingComplete()
	cerrarV();
	}*/
 }
</script>
<div id="boton" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103" class="p1">
	<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">
</div>
<BR>
<BR>
<BR>
<BR>
<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="4" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th width="79%" colspan="2"><span class="style1">LISTADO DE BIENES </span></th>
  </tr>
  <tr >
    <th colspan="2">CLASE:  <?php echo $tipoclase;?></th>
  </tr>
  <tr >
    <th colspan="2">DEPARTAMENTO:  <?php echo $dpto;?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS:  <?php echo $fechas;?></th>
  </tr>
  
  <tr>
  <td colspan="3" bgcolor="#FFFFFF"  ><table width="1286" cellpadding="0" cellspacing="0">
      <col width="19" />
      <col width="68" />
      <col width="255" />
      <col width="366" />
      <col width="68" />
      <col width="94" />
      <col width="46" />
      <col width="180" />
      <col width="124" />
      <col width="205" />
      <col width="132" />
      <col width="158" />
      <col width="52" />
      <col width="117" />
      <col width="58" />
      <col width="72" />
      <col width="99" />
      <col width="74" />
      <col width="84" />
  
      <tr height="20">
        <td height="20" width="24"><strong>No.</strong></td>
		<td width="79"><strong>Descripción</strong></td>
        <td width="84"><strong>Clase</strong></td>
        <td width="40"><strong>Parte</strong></td>
        <td width="97"><strong>Fecha_compra</strong></td>
        <td width="39"><strong>Costo</strong></td>
        <td width="107"><strong>Departamento</strong></td>
        <td width="73"><strong>Ubicacion</strong></td>
        <td width="85"><strong>Empleado</strong></td>
        <td width="89"><strong>Estado</strong></td>
        <td width="65"><strong>Serie</strong></td>
        <td width="46"><strong>Tang</strong></td>
        <td width="45"><strong>Marca</strong></td>
        <td width="52"><strong>Modelo</strong></td>
        <td width="71"><strong>FechaBaja</strong></td>
        <td width="49"><strong>Motivo</strong></td>
        <td width="63"><strong>Codigo Barras </strong></td>
      </tr>
 <? 
/*echo dateDifference('10-28-2009','11-28-2010'); 
function dateDifference($d1, $d2){   
    $v1 = explode("-", $d1);   
    $date1 = mktime(0, 0, 0, intval($v1[1]), intval($v1[0]), intval($v1[2]));   
  
    $v2 = explode("-", $d2);   
  $date2 = mktime(0, 0, 0, intval($v2[1]), intval($v2[0]), intval($v2[2]));   
  
  $dateDiff = $date2 - $date1;   
  
  return floor($dateDiff/(60*60*24));   
}  
*/
?> 
      
		 <?php  
		 $cont = 0;
		 
		 for ($i=0;$i<$totAll;$i++){	
			//echo "<br>I = ".$i."<br>";
		 ?>
      
		  <tr height="20">
			<td><?php 
					
					$pointerA = $arrMain[$i-1]['serial_cbf'];
					$pointerB = $arrMain[$i]['serial_cbf'];				
					if($pointerA != $pointerB){						
						$descripcion = $arrMain[$i]['descripcion'];
						$cont ++;
						echo $cont;
					}else{

						$descripcion = "";
						
					}
					
				?>			</td>        
			<td><?php echo $descripcion;?></td>
			<td><?php echo $arrMain[$i]['clase'];?></td>
			<td><?php echo $arrMain[$i]['parte'];?></td>
			<td><?php echo $arrMain[$i]['fecha_compra'];?></td>
			<td><?php echo $arrMain[$i]['costo'];?></td>
			<td><?php echo $arrMain[$i][''];?></td>
			<td><?php echo $arrMain[$i][''];?></td>
			<td><?php echo $arrMain[$i][''];?></td>
			<td width="15%"><?php echo $arrMain[$i]['estado'];?></td>
			<td width="15%"><?php echo $arrMain[$i]['serie'];?></td>
			<td ><?php echo $arrMain[$i]['tangible'];?></td>
			<td width="15%"><?php echo $arrMain[$i]['marca'];?></td>
			<td width="15%"><?php echo $arrMain[$i]['modelo'];?></td>
			<td><?php echo $arrMain[$i]['fecha_baja'];?></td>
			<td><?php echo $arrMain[$i]['motivo_baja'];?></td>
			<td><?php echo $arrMain[$i]['codbarras_cbf'];?></td>
		  </tr>
	  <?php 

  		}
	  ?>
    </table>	</td>
  </tr>
</table>

</body>
</html>