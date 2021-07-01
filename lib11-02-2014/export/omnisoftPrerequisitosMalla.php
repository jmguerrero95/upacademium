<?php 
//MPC: 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {color: #999999}
.style2 {color: #000000}
-->
</style>
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
$serial_maa = $_GET['serial_maa'];
$sqlMaa = "
	SELECT
		nombre_maa
	FROM 
		malla
	WHERE
		serial_maa = ".$serial_maa."
	";
	$rsMaa = $dblink->Execute($sqlMaa); 
	while(!$rsMaa->EOF){
		$nombremaa = $rsMaa->fields['nombre_maa'];
		$rsMaa->MoveNext();
	}

	$sqlMain = "
		SELECT
			nombre_mat,
			dma.serial_mat,
			nombre_are 
		FROM
			malla as maa, 
			detallemalla as dma,
			materia as mat,
			area as are
		WHERE 
			maa.serial_maa=dma.serial_maa
			and mat.serial_mat=dma.serial_mat
			and mat.serial_are = are.serial_are
			and maa.serial_maa = ".$serial_maa."
			
		ORDER BY
		    nombre_are
	";
	$rsMain=$dblink->Execute($sqlMain); 

	//echo "<br>".$sqlMain;
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
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
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">PREREQUISITOS MALLA </span></th>
  </tr>
  <tr >
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2">MALLA: <?php echo $nombremaa;?></th>
  </tr>
  <tr>
    <th width="18%" align="right">&nbsp;</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="1%" bgcolor="#999999"><span class="style2">Nro.</span></th>
          <th width="5%" bgcolor="#999999">Area</th>
          <th width="5%" bgcolor="#999999">Asignatura</th>
		  <th width="20%" bgcolor="#999999">Prerequisito</th>
		  <th width="10%" bgcolor="#999999"># de Cred Asignat. </th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Nivel </span></th>
	    </tr>
        
		<? 
			$i = 0;
			$sum = 0;
			$j = 0;
			$sw = 0;
			$totmatpreq = 0;
			while(!$rsMain->EOF){ 
			?>
			
				<?php 
					$sqlPrerequisito = "
						SELECT 
							nombre_mat,
							dma.serial_mat,
							numerocreditos_dma,
							nombre_niv,nombre_are 
						FROM 
							detallemalla as dma,
							materia as mat,
							nivel as niv,
							prerequisito as pma,
							area as are
						WHERE 
							pma.serial_dma = dma.serial_dma
							and pma.serial_mat = mat.serial_mat
							and mat.serial_are = are.serial_are
							and niv.serial_niv = dma.serial_niv
							and dma.serial_maa = ".$serial_maa."
							and dma.serial_mat = ".$rsMain->fields['serial_mat']."
						ORDER BY
							nombre_mat
					";
					$rsPrerequisito=$dblink->Execute($sqlPrerequisito); 
					$numReg = $rsPrerequisito->RecordCount();
					if($numReg == 0){
						$numReg = 1;
						$sum = $sum + 1;
						$sw = 1;
					}
					
				?>
				
				<tr> 
				<?php 
				for($k=0;$k<$numReg;$k++){
				?>
				<?php
				
				?>
				<td><span class="style2"><? 
				if($j==0){
					echo $i+1;	
				}else{
					echo "&nbsp;";
				}
				
				?></span></td>				
				<td NOWRAP ><span class="style2">
				  <? 
				if($j==0){
					echo $rsMain->fields['nombre_are'];	
				}else{
					echo "&nbsp;";
				}
				?>
				</span></td>
				<td NOWRAP ><span class="style2"><? 
				if($j==0){
					echo $rsMain->fields['nombre_mat'];	
				}else{
					echo "&nbsp;";
				}
				?></span></td>
				<td NOWRAP><span class="style2"><? 
				if($sw==1){
					echo "<center>N/A</center>";
				}else{
					$a=$i+1;$b=$j+1;echo $a.".".$b." ".$cont.$rsPrerequisito->fields['nombre_mat'];
				}
				
				
				?></span></td>
				<td NOWRAP><span class="style2"><? 
				if($j==0){
					echo $rsPrerequisito->fields['numerocreditos_dma'];
				}else{
					echo "&nbsp;";
				}
				?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsPrerequisito->fields['nombre_niv'];?></span></td>
				</tr>

				<?php 
					$j++;
					$rsPrerequisito->MoveNext();	

				}
				?>	
			<? 
			$i++;
			$j=0;
			$sw=0;
			$rsMain->MoveNext();		
			}
		?>
		
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">Total Materias con Prerequisito: <?php $totmatpreq=$i-$sum; echo $totmatpreq?> </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>