 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">


<?php

        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);

	$serial_nts=$_GET['serial_nts'];
	$serial_mat=$_GET['serial_mat'];
	$apellido_epl=$_GET['apellido_epl'];
	$nombre_epl=$_GET['nombre_epl'];
	
	
	
	//echo "serial_nts:.... ".$serial_nts. "<br>";  
/*	$serial_sec=$_GET['serial_sec'];
	//echo "serial_sec:.... ".$serial_sec. "<br>";  
 	$nombre_sec=$_GET['nombre_sec'];
	//echo "nombre_sec:.... ".$nombre_sec. "<br>";  
    $serial_per=$_GET['serial_per'];
	//echo "serial_per:.... ".$serial_per. "<br>";  
    $nombre_per=$_GET['nombre_per'];
	//echo "nombre_per:.... ".$nombre_per. "<br>";  
    
	//echo "serial_mat:.... ".$serial_mat. "<br>";  
    $nombre_mat=$_GET['nombre_mat'];
	//echo "nombre_mat:.... ".$nombre_mat. "<br>";  
    //echo "nombre_epl:.... ".$nombre_epl. "<br>";  
    $serial_suc=$_GET['serial_suc'];
	//echo "serial_suc:.... ".$serial_suc. "<br>";  
     
    $ntotalclases_nts=$_GET['ntotalclases_nts'];
    //echo "ntotalclases_nts:.... ".$ntotalclases_nts. "<br>";  
	*/
	
	$serial_hrr=$_GET['serial_hrr'];
	
	
	
	$sql='SELECT notasalumnos.serial_dmat, concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombres,notatotal_nal,estado_nal FROM notasalumnos JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu WHERE notasalumnos.serial_nts = '.$serial_nts.' GROUP BY notasalumnos.serial_dmat order by nombres';
   $rsAlumno=$dblink->Execute($sql);

 //COnsulta del Periodo Academico
 
 $rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per,tothoras_hrr from periodo,horario where periodo.serial_per=horario.serial_per  and horario.serial_hrr='.$serial_hrr);

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
<table width="85%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="4">ACTA DE CALIFICACIONES </th>
  </tr>
  <tr >
    <th colspan="4"><? echo $rsPeriodo->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="4"> DEL <? echo $rsPeriodo->fields['fecini_per'];?> AL <? echo $rsPeriodo->fields['fecfin_per'];?>  </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROFESOR:</th>
    <th width="30%" align="left"><span class='style3'><? echo $nombre_epl." ".$apellido_epl; ?></span></th>
    <th width="15%" align="left">TOTAL HORAS MATERIA :</th>
    <th width="16%" align="left"><? echo $rsPeriodo->fields['tothoras_hrr'];//echo $ntotalclases_nts;?></th>
  </tr>
  <tr>
    <th align="right">MATERIA:</th>
    	
	<th align="left"><span class='style3'>  <? echo $nombre_mat; ?> </span></th>
	<th align="left">PROGRAMA:</th>
    <th align="left"><? echo $nombre_sec; ?></th>
  </tr>
 
 
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"  ><span class='style3'>A: Act. en clases  T: Trabajos  EP: Examen Parcial  EF: Examen Final</span></td>
  </tr>
 
  
  <tr>
        <td colspan="5" bgcolor="#FFFFFF">
		
		<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        
		<tr>
          <th width="1%" rowspan="2"  style="">Nro.</th>
          <th width="80%" rowspan="2">Alumnos </th>
		  
		  <th width="80%" rowspan="2">Estado</th>
         </tr>
		 <tr>
		 </tr>
		
		
		
		
		
		
		
		<? $i=1;
		while (!$rsAlumno->EOF) {?>
			<tr>
			  <td><span class="style2"><? echo $i;?></span></td>
			  <td NOWRAP><span class="style2"><? echo $rsAlumno->fields['nombres'];?></span></td>
			
			  <td ><span class="style2"><? echo $rsAlumno->fields['estado_nal'];?></span></td>
	    </tr>
		<? 
			$i=$i+1;
			$rsAlumno->MoveNext();
	  	}
		?>	
	
		
    </table>    </td>
  </tr>
  
  <tr>
    <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>
          <td colspan="2" align="center"><div align="left">
            <p>Observaciones:............................................................................................................................................................................................................</p>
            <p>...................................................................................................................................................................................................................................</p>
            <p>..................................................................................................................................................................................................................................</p>
          </div></td>
        </tr>
        <tr>
          <td align="center"><span class="style2"><BR>
            ______________________
            <BR>
            FIRMA DEL PROFESOR
          </span></td>

          <td width="50%" align="center"><span class="style2"><BR>
            ____________________________<BR>COORDINACION ACADEMICA</span></td>
        </tr>
      </table></td>
  </tr>
</table>

</body>
</html>

