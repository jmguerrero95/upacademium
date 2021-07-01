<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
</head>
<body>
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
 		$serial_suc=$_GET['serial_suc'];
		$desde=$_GET['desde'];
		$hasta=$_GET['hasta'];
		
		
		/*echo "->".$desde;
		echo "->".$hasta;
		echo "->".$serial_suc;*/
		
$sede = "select nombre_suc from sucursal where serial_suc = ".$serial_suc;
$rsSede=$dblink->Execute($sede);
		
$contrato="select distinct epl.serial_epl, concat_ws(' ',epl.APELLIDO_EPL,epl.NOMBRE_EPL)as nombre
			, tct.NOMBRE_TCT, erp.FECHA_ERP, erp.NOMBRE_ERP, epl.EMAIL_EPL,SEXO_EPL, dep.descripcion_dep, epl.FECHAINGRESO_EPL
			from empleado as epl, tipocontratostrabajo as tct, empleadorolpagos as erp, departamentos as dep
			where epl.SERIAL_TCT = tct.SERIAL_TCT
			and epl.SERIAL_EPL = erp.SERIAL_EPL
			AND epl.SERIAL_DEP= dep.SERIAL_dep
			and erp.FECHA_ERP >= '".$desde."' and erp.FECHA_ERP <= '".$hasta."'
			and epl.SERIAL_SUC = ".$serial_suc." 
			group by epl.SERIAL_EPL order by nombre";
			
$rsContrato=$dblink->Execute($contrato);


?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px; font-family:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
 H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }

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

<? 	
	/*$j=0;	
	while (!$rshorario_temp->EOF) {
	if($j>0) echo "<H1 class=SaltoDePagina> </H1>";*/
	?>
<BR>

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">TIPO DE CONTRATO DE EMPLEADOS </span></th>
  </tr>
  <tr >
    <th colspan="2"><? echo $rsPeriodo->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> DEL <? echo $desde;?> AL <? echo $hasta;?> </th>
  </tr>
  
  <tr>
    <th width="18%" align="right">SEDE:</th>
    <th width="61%" align="left"><span class='style3'><?  echo $rsSede->fields['nombre_suc'];?> </span></th>
  </tr>
  <tr>
	
  </tr>
  

  <tr>
    <td colspan="3" bgcolor="#FFFFFF">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
       
        
		
				 <tr>
		  <th width="5%"  style=""><? echo "No"; ?></th>		 
          <th width="25%"><? echo "Nombre."; ?></th>
		  <th width="20%">E-mail</th>
		  <th width="20%">Unidad Académica</th>
          <th width="20%" >Tipo de Contrato</th>	
		   <th width="10%" >Fecha de Ingreso</th>	 
                   
		 <? //$i=1;
		 $m = 0;
		 $f = 0;
		 $i=0;
		$rsContrato->MoveFirst();
		while (!$rsContrato->EOF) {
		$i=$i+1;
			//if($i==1){
		?> 
        </tr>
			<?
			//}
			//if($rshorario_temp->fields['mes']==$rshorario->fields['mes']){
			?>
		
				<tr> 
				<td ><span class="style2"><? echo $i;?></span></td>
				<td ><span class="style2"><? echo $rsContrato->fields['nombre'];?></span></td>
				<td ><span class="style2"><? echo strtolower($rsContrato->fields['EMAIL_EPL']);?></span></td>
				<td ><span class="style2"><? echo $rsContrato->fields['descripcion_dep'];?></span></td>
				<td ><span class="style2"><? echo $rsContrato->fields['NOMBRE_TCT'];?> </span></td>
				<td ><span class="style2"><? echo $rsContrato->fields['FECHAINGRESO_EPL'];?> </span></td>
				
				
				<?
				 if ($rsContrato->fields['SEXO_EPL']=='MASCULINO'){
				 	$m=$m+1;
				 }else 	$f=$f+1;
				?>
				 
				
			
		<? 
			//}
			//$i=$i+1;
			$rsContrato->MoveNext();
	  	}
		?>
		
    </table>
    </td>
  </tr>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>

          <td width="51%" align="center"><div align="left">
			<p>TOTAL MUJERES : <? echo " ".$f;?></p>
            <p>TOTAL VARONES:  <? echo " ".$m;?></p>            
			<p>TOTAL : <? echo " ".$i;?></p>
          </div></td>
          <td width="49%" align="center"><div align="left">REVISADO POR: </div></td>
        </tr>
      </table></td>
  </tr>
</table>

<? 		/*$j++;
		$rshorario_temp->MoveNext();
	  	}*/
		?>
</body>
</html>