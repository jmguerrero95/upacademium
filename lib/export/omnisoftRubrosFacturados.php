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
$serial_ara = $_GET['serial_ara'];
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

if($serial_ara=="T"){
	$arancel = "";		
}else{
	$arancel = "AND dar.serial_ara = ".$serial_ara;
}

if($serial_alu=="T"){
	$alumno = "";		
}else{
	$alumno = "AND alu.serial_alu = ".$serial_alu;
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
$sqlRubros = "select fecha_caf,numero_caf,dfa.serial_dar,dfa.serial_dfa, dar.descripcion_dar, codigo_alu
				,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS 			                 nombre,alu.fecnac_alu,caf.serial_alu,dfa.valor_aal,dfa.cantidad_dfa
				,caf.serial_per, codigoIdentificacion_alu,
				alu.serial_caa, alu.fechaInscripcion_alu
				from cabecerafactura  as caf, detallefactura as dfa,detallearancel as dar, alumno as alu
				where caf.serial_caf=dfa.serial_caf
				and dfa.serial_dar=dar.serial_dar
				and alu.serial_alu=caf.serial_alu				
				and caf.estado_caf <> 'ANULADO'
				and caf.tipo_caf like 'FAC'
				".$periodo."
				".$sucursal."
				".$seccion."
				".$arancel."
				".$alumno."
				".$caa."
				order by numero_caf, descripcion_dar, fecha_caf";
//echo $sqlRubros."</p>
$rsRubros = $dblink->Execute($sqlRubros);

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

<p>&nbsp;</p>
<table width="625" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="176" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="170" height="81" /></td>
    <td width="437" bgcolor="#FFFFFF"><table width="100%" border="0">
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
      
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th>Nº.</th>
            <th width="12%">Fecha Factura</th>
			<th>No Factura</th>
            <th>Rubro </th>
            <th>Código </th>
			<th>Identificación  </th>
			<th>Fecha Inscripción</th>
			<th>Nombre Estudiante</th>
            <th>Fecha de nacimiento</th>
			<th>Valor </th>
			<th>Cantidad</th>
			<th>Total</th>
			<th>Categoria</th>
	    </tr>
        <?php 
			if($rsRubros->recordCount()>0){
				//$fondo='style="background-color:#FFFFF0"';
				//$j=0;
				$numero=$rsRubros->fields['numero_caf'];							
				while(!$rsRubros->EOF){
				$i++;
				//$j=$j+10;				

					
				/*if($rsRubros->fields['numero_caf']<>$numero){
					$fondo='style="background-color:#FFFF'.$j.'"';	
					$j=0;
				}*/			
		?>
				<tr>		
				<td <?php echo $fondo; ?>><?php echo $i;?></td>
				<td><?php echo $rsRubros->fields['fecha_caf'];?></td>
				<td><?php echo $rsRubros->fields['numero_caf']?></td>
				<td><?php echo $rsRubros->fields['descripcion_dar'];?></td>
				<td><?php echo $rsRubros->fields['codigo_alu'];?></td>
				<td><?php echo $rsRubros->fields['codigoIdentificacion_alu'];?></td>
				<td><?php echo $rsRubros->fields['fechaInscripcion_alu'];?></td>
				<td><?php echo $rsRubros->fields['nombre'];?></td>
                <td><?php echo $rsRubros->fields['fecnac_alu'];?></td>
				<td><?php echo $rsRubros->fields['valor_aal'];?></td>
 				<td><?php echo number_format($rsRubros->fields['cantidad_dfa'],0);?></td>
				<td align="right"><?php echo ($rsRubros->fields['cantidad_dfa']*$rsRubros->fields['valor_aal']);?></td>
				<td><?php echo $rsRubros->fields['serial_caa'];?></td>
				
				</tr>		
		<?php						
					
				$total = $total+($rsRubros->fields['cantidad_dfa']*$rsRubros->fields['valor_aal']);
				$numero=$rsRubros->fields['numero_caf'];
				$rsRubros->MoveNext();				
				}
			}
		?>		
       
         <tr>
          <th colspan="9" ><div align="right">TOTAL FACTURADO:</div></th>
		  <th ><?php  echo $total; ?> </th>
		  </tr>
		  <tr>
          <th colspan="13" align="center" ><div align="right">: </div>            </th>
		  </tr>		 
      </table>
        <BR><BR>
      <br /></td></tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>

