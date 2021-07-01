<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
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
 	
	$sql = "select * from temporal";
	$rsSql=$dblink->Execute($sql);
	

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
<form name="reporte" method="post" action="subirArchivos.php">
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr bgcolor="#FFFFFF">
        <th >TABLA TEMPORAL </th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th >SUBIR ARCHIVOS </th>
      </tr>
    
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">			
		
		
        <tr>
          <th >Nº.</th>
            <th >serial_tmp</th>
            <th >Campo1 </th>
  

		    <th >Campo2 </th>
		    <th >Campo3 </th>
  		    <th >Campo4 </th>
			<th >Campo5 </th>
        </tr>
        
        <? 
			$i=1;
		//	$rsSql->MoveFirst();
			while(!$rsSql->EOF) { 
			?>
        <tr>
          <td  align="left" nowrap><span class="style2"><? echo $i;?></span></td>
              <td  align="left" nowrap><span class="style2"><? echo $rsSql->fields['serial_tmp'];?></span></td>
		  	  <td align="right"><span class="style2"><? echo $rsSql->fields['campo1_tmp'];?></span></td>
		      <td align="right"><span class="style2"><? echo $rsSql->fields['campo2_tmp'];?></span></td>
		      <td align="right"><span class="style2"><? echo $rsSql->fields['campo3_tmp'];?></span></td> 
			  <td align="right"><span class="style2"><? echo $rsSql->fields['campo4_tmp'];?></span></td> 
  			  <td align="right"><span class="style2"><? echo $rsSql->fields['campo5_tmp'];?></span></td> 			  
			  
	    </tr>
		<tr>
			<td colspan="5"><?php 
			if($rsSql->fields['campo1_tmp']<>''){
		
$sqlCambio="update periodo set fecini_per='".$rsSql->fields['campo1_tmp']."', fecfin_per='".$rsSql->fields['campo2_tmp']."' WHERE serial_per LIKE '%".$rsSql->fields['serial_tmp']."'";
			
			//$sqlCambio="insert into publicacionesprofesor(serial_epl, nombre_pbl, fecha_pbl,participacion_pbl,revision_pbl, numero_ISBN_pbl) values((select serial_epl from empleado where DOCUMENTOIDENTIDAD_EPL like '%".$rsSql->fields['serial_tmp']."'), '".$rsSql->fields['campo1_tmp']."', ".$rsSql->fields['campo2_tmp'].", '".$rsSql->fields['campo3_tmp']."','".$rsSql->fields['campo4_tmp']."','".$rsSql->fields['campo5_tmp']."')";
			
			
		//	"update alumno AS alu, alumnomalla AS ama, requisitosgraduacion AS rgra set entregado_rgra='".$rsSql->fields['campo1_tmp']."', horaspasantias='".$rsSql->fields['campo2_tmp']."', institucionpasantias='".$rsSql->fields['campo3_tmp']."' WHERE codigoIdentificacion_alu like '%".$rsSql->fields['serial_tmp']."' AND alu.serial_alu=ama.serial_alu AND rgra.serial_ama=ama.serial_ama and rgra.serial_dad=17";
			
	/*		
			"SELECT
codigoIdentificacion_alu,    
entregado_rgra,   
    horaspasantias, 
    institucionpasantias
 FROM
    alumno               AS alu,
    alumnomalla          AS ama,
    requisitosgraduacion AS rgra 
WHERE
codigoIdentificacion_alu like '%".$rsSql->fields['serial_tmp']."'
    AND alu.serial_alu=ama.serial_alu 
    AND rgra.serial_ama=ama.serial_ama and rgra.serial_dad=17 ";
			
			$sqlCambio= "insert into periodo_sabatico (serial_epl,periodo_psa) values('".$rsSql->fields['serial_tmp']."', '".$rsSql->fields['campo1_tmp']."')";
			
			"update periodo_sabatico SET serial_epl='".$rsSql->fields['serial_tmp']."',periodo_psa='".$rsSql->fields['campo1_tmp']."' where DOCUMENTOIDENTIDAD_EPL like '%".$rsSql->fields['serial_tmp']."'";
			*/
			
			
		
	//echo $sqlCambio;		
		//$rsSql1=$dblink->Execute($sqlCambio);
		}
		?>    </td>
		</tr>
        
        <?

			$i++;
			$rsSql->MoveNext();
		}?> 
      </table>
	  <br>
      
      
    </td></tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>
</form>

</body>
</html>  
