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
 		$serial_per = $_GET['serial_per'];
		$serial_sec = $_GET['serial_sec'];
		$serial_fac = $_GET['serial_fac'];
		$fecha_ini = $_GET['fecha_ini'];
		$fecha_fin = $_GET['fecha_fin'];
		$serial_suc = $_GET['serial_suc'];
		
		//Parametrizacion
		if($serial_sec==2){
			$carrera=" concat_ws('-',nombre_crp,nombre_car) as carrera ";			
		}else{
			$carrera=" concat_ws('-',nombre_crp) as carrera ";
		}
		//echo "<br>".$serial_fac."<br>";	
		if ($serial_fac == "T"){
			$facultad = "";
			//echo "entro";
		}else{
			if($serial_sec==2)
				$facultad = " and carrera.serial_car = ".$serial_fac;
			else	
				$facultad = " and facultad.serial_fac = ".$serial_fac;				
			
		}
		//echo "<br>COUNT: ".count($fecha_ini)."<br>";
		//echo "<br>STRLEN: ".strlen($fecha_ini)."<br>";
		if((strlen($fecha_ini)>0  and strlen($fecha_fin)>0) or $serial_suc == "T"){
			$periodo = "and fecini_per>='".$fecha_ini."' and fecini_per<='".$fecha_fin."'";
		}else{			
			$periodo = " and alumnomalla.serial_per = ".$serial_per;	
		}
	$sqlAlumno = "
	SELECT 
		concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre,
		codigoIdentificacion_alu as identificacion, 
		codigo_alu, 
		sex.descripcion_sex as sexo, 
		alu.serial_sex,mailuniv_alu,nombre_fac,".$carrera." 
	FROM 
		alumno as alu, sexo as sex,periodo
		left join alumnomalla on alumnomalla.serial_alu=alu.serial_alu
        left join malla on malla.serial_maa=alumnomalla.serial_maa and serial_maa_p=0   
        left join carrera on carrera.serial_car=malla.serial_car 
        left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
        left join facultad on facultad.serial_fac=carrera.serial_fac
	WHERE 
		periodo.serial_per=alumnomalla.serial_per	
		and alu.serial_sex = sex.serial_sex
		
		".$periodo."
		and malla.serial_sec=".$serial_sec."
		".$facultad."						
	ORDER BY  
		nombre asc
		
		";
	echo "<br>".$sqlAlumno."<br>";	
	$rsalumnos =$dblink->Execute($sqlAlumno);


//COnsulta del Periodo Academico
	$rsPeriodo=$dblink->Execute('select serial_per, nombre_per, fecini_per, fecfin_per from periodo where serial_per = '.$serial_per);



?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
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
    <td width="21%" rowspan="6" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">LISTA DE ALUMNOS INGRESADOS POR PERIODO</span></th>
  </tr>
  <tr >
    <th colspan="2"><?
	   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "&nbsp;";
	   }else{
			echo "PERIODO: " . $rsPeriodo->fields['nombre_per'];
	   }
	
	 ?></th>
  </tr>
  <tr>
    <th colspan="2"> <?
		   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "FECHAS DESDE : ".$fecha_ini." <==> ";
			echo " HASTA : ".$fecha_fin;
	   }else{
			echo "&nbsp;";	
	   }	
	?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROGRAMA:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">SUCURSAL:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
	
  </tr>
  

  <tr>
    <td colspan="3" bgcolor="#FFFFFF">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
       
        
		
				 <tr>
		  <th width="1%"  style=""><? echo "No"; ?></th>		 
          <th width="20%"><? echo "Nombre."; ?></th>
		  <th width="7%">E-mail</th>
          <th width="4%" >Identificación</th>		 
          <th width="4%" >Código</th>
          <th width="4%" >Sexo</th>          
		  <th width="20%" >Facultad</th>
          <th width="20%" >Carrera</th>   
		 <? //$i=1;
		 $m = 0;
		 $f = 0;
		 $i=0;
		$rsalumnos->MoveFirst();
		while (!$rsalumnos->EOF) {
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
				<td nowrap="nowrap" ><span class="style2"><? echo $rsalumnos->fields['nombre'];?></span></td>
				<td ><span class="style2"><? echo strtolower($rsalumnos->fields['mailuniv_alu']);?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['identificacion'];?> </span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['codigo_alu'];?> </span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['sexo'];?></span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_fac'];?></span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['carrera'];?></span> </td>
				
				<?
				 if ($rsalumnos->fields['serial_sex']==1){
				 	$m=$m+1;
				 }else 	$f=$f+1;
				?>
				 
				
			
		<? 
			//}
			//$i=$i+1;
			$rsalumnos->MoveNext();
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