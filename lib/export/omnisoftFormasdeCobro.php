<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {
	color: #CC0000;
	font-weight: bold;
}
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
//Gets
$serial_alu = $_GET['serial_alu'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_forc = $_GET['serial_forc'];
$serial_per = $_GET['serial_per'];
$serial_suc=$_GET['serial_suc'];
$per = explode('*',$serial_per);
$serial_per = $per[0];

//Encabezados
if($serial_suc <> "T"){
	$sqlSuc = "select nombre_suc from sucursal where serial_suc = " . $serial_suc;
	$arrSuc = $dblink->GetAll($sqlSuc);	
	$nombre_suc = $arrSuc[0]['nombre_suc'];
}else{
	$nombre_suc = "TODAS";
}
if($serial_sec <> "T"){
	$sqlSec = "select nombre_sec from seccion where serial_sec = " . $serial_sec;
	$arrSec = $dblink->GetAll($sqlSec);	
	$nombre_sec = $arrSec[0]['nombre_sec'];

}else{
	$nombre_sec = "TODAS";
}
//Validaciones
if(strlen($fecha_ini)>0 and strlen($fecha_fin)>=0){
	$periodo = " AND fecha_caf >= '".$fecha_ini."' AND fecha_caf <= '".$fecha_fin."'";
	$fechas = "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;
	$final = $fecha_fin;
	$inicial=$fecha_ini;
}else{
	$periodo = " AND per.serial_per = ".$serial_per; 
	$sqlPer = "select nombre_per,fecini_per,fecfin_per from periodo where serial_per = " . $serial_per;
	$arrPer = $dblink->GetAll($sqlPer);	
	$fechas = $arrPer[0]['nombre_per']."  =>  DESDE: ".$arrPer[0]['fecini_per']." HASTA: ".$arrPer[0]['fecfin_per'];
	$final = $arrPer[0]['fecfin_per'];	
	$inicial=$arrPer[0]['fecini_per'];
}
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = "AND alu.serial_suc = ".$serial_suc; 
}
if($serial_sec=="T"){
	$seccion = "";		
}else{
	$seccion = "AND alu.serial_sec = ".$serial_sec;
}

if($serial_forc=="T"){
	$formaCobro = "";		
}else{
	$formaCobro = "AND dre.serial_forc = ".$serial_forc;
}


//Rubro
/*if($serial_sec == 2){
	$carrera = "AND car.serial_car = ".$serial_crp;
}else{
	$carrera = "AND crp.serial_crp = ".$serial_crp;
}
if($serial_crp== 'T'){
	$carrera = "";
}*/

//Get Datos de Alumnos

//Get Materias tomadas de la malla 

$sqlFormasCobros="select caf.serial_caf, caf.fecha_caf,caf.numero_caf,cre.fecha_cre,numero_cre, forc.DESCRIPCION_FORC, alu.codigo_alu
,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre
,cdc.valor_cdc,cdc.fechaefec_cdc, cdc.estado_cdc 
from formacobro as forc,  alumno as alu
,cabecerarecibo as cre
		LEFT JOIN cabecerafactura AS caf
		ON caf.serial_caf=cre.serial_caf,
        cierredia_control as cdc
        LEFT JOIN detallerecibo AS dre
		ON cdc.serial_dre=dre.serial_dre
where dre.serial_cre=cre.serial_cre
and cre.serial_alu = alu.serial_alu
and dre.serial_forc = forc.SERIAL_FORC 
and estado_cre <> 'ANULADO'
and estado_caf <> 'ANULADO'
and tipo_caf like 'FAC'
".$periodo."
".$sucursal."
".$seccion."
".$formaCobro." order by numero_caf";


//echo '</p>'.$sqlFormasCobros;
$rsRubros = $dblink->Execute($sqlFormasCobros);

?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px}

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

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF">
	<table width="100%" border="0">
      <tr>
        <th >
          <p class="">LISTADO DE (<?php echo $totAll;?>)ALUMNOS</p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_suc;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_sec;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $fechas;?></span></th>
      </tr>
      
    </table>
	</td>
  </tr>
  
  <tr>
    <td colspan="2">
	
	
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
            <th width="2%">No</th>
			<th width="9%">Fecha Factura</th>
			<th width="4%">No Factura</th>
            <th width="10%">Fecha de Cobro </th>
            <th width="4%">No de Cobro  </th>
			<th width="22%">Tipo de Cobro  </th>
			<th width="6%">Código de estudiante </th>
			<th width="18%">Nombre</th>
			<th width="6%">Fecha de Efectivización</th>
			<th width="11%">Acreditación</th>
			<th width="9%">valor</th>			
	    </tr>
        <?php 
			if($rsRubros->recordCount()>0){										
				while(!$rsRubros->EOF){
				$i++;			
		?>
				<tr>
				
				<td <?php echo $fondo; ?>><?php echo $i;?></td>
				<?php
				
				if ($fc==$rsRubros->fields['serial_caf']){				
						echo "<td>"." "."</td>";						
						echo "<td>"." "."</td>";						
						//echo "<td class='style2'>"."&nbsp"."</td>";
					}
					else{
						echo "<td>".$rsRubros->fields['fecha_caf']."</td>";
						echo "<td>".$rsRubros->fields['numero_caf']."</td>";
						
					}					

					$fc=$rsRubros->fields['serial_caf'];
					
				?>	
				
				
				<td><?php echo $rsRubros->fields['fecha_cre'];?></td>
				<td><?php echo $rsRubros->fields['numero_cre'];?></td>
				<td><?php echo $rsRubros->fields['DESCRIPCION_FORC'];?></td>
				<td><?php echo $rsRubros->fields['codigo_alu'];?></td>
				<td><?php echo $rsRubros->fields['nombre'];?></td>				
				<td><?php echo $rsRubros->fields['fechaefec_cdc'];?></td> 				
				<td><?php echo $rsRubros->fields['estado_cdc'];?></td> 		
				<td><?php echo $rsRubros->fields['valor_cdc'];?></td>
						
				</tr>		
		<?php				
				
				if($rsRubros->fields['estado_cdc']=='PENDIENTE')
					$totalP = $totalP + $rsRubros->fields['valor_cdc'];
				if($rsRubros->fields['estado_cdc']=='CERRADO')
					$totalC = $totalC + $rsRubros->fields['valor_cdc'];
					
				$rsRubros->MoveNext();				
				}
			}
		?>		       
         <tr>
          <th colspan="10" ><div align="right">TOTAL PENDIENTE:</div></th>
		  <th ><?php  echo $totalP; ?> </th>
		  </tr>
		  
		  <tr>
          <th colspan="10" ><div align="right">TOTAL CERRADO:</div></th>
		  <th ><?php  echo $totalC; ?> </th>
		  </tr>
		  
		  <tr>
          <th colspan="10" ><div align="right">TOTAL :</div></th>
		  <th ><?php  echo $totalC + $totalP; ?> </th>
		  </tr>
		 	 
      </table>
       </td>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>

