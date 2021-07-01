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
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		$serial_sec	=$_GET['serial_sec'];
		$fecha_ini 	= $_GET['fecha_ini'];
		$fecha_fin 	= $_GET['fecha_fin'];	
		$serial_suc	=$_GET['serial_suc'];
		$serial_sec = $_GET['serial_sec'];
		$serial_crp = $_GET['serial_crp'];
		$per = explode('*',$_GET['serial_per']);
		$serial_per = $per[0];
		$equivalencia = $_GET['ncreditosequi'];
		$ncreditos = $_GET['ncreditos'];
/*
         <option value="0">Igual que</option>
         <option value="1">Menor que</option>
         <option value="2">Menor o igual que</option>
         <option value="3">Mayor que</option>
         <option value="4">Mayor o igual que</option>

*/
		switch($equivalencia){
				case '111': $comp = ""; break;
				case '0': $comp = "HAVING creditosaprobados =".$ncreditos;	break;
				case '1': $comp = "HAVING creditosaprobados <".$ncreditos;	break;
				case '2': $comp = "HAVING creditosaprobados <=".$ncreditos;	break;
				case '3': $comp = "HAVING creditosaprobados >".$ncreditos;	break;
				case '4': $comp = "HAVING creditosaprobados >=".$ncreditos;	break;				
		}
		//Fechas
		if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
				$periodo = "and per.fecini_per>='".$fecha_ini."' and per.fecini_per<='".$fecha_fin."'";
			}else{			
				$periodo = " and mmat.serial_per = ".$serial_per;	
			}
		//Sucursal
		if($serial_suc=="T"){
			$sucursal = "";		
		}else{
			$sucursal = "and alu.serial_suc=".$serial_suc;
		}	
		//Carrera
		if($serial_crp=="T"){		
				$carrera = "";
		}else{
			if($serial_sec==2){
				$carrera = " AND car.serial_car = ".$serial_crp;
			}else{
				$carrera = " AND crp.serial_crp = ".$serial_crp;
			}			
		}



//Consulta de materias
$sqlNot = "
SELECT 
	mmat.serial_alu,
	concat_ws(' ', alu.apellidopaterno_alu,alu.apellidomaterno_alu,alu.nombre1_alu,alu.nombre2_alu) as nombre,
	maa.totalcreditos_maa as creditosmalla,
	sum(dmat.numerocreditos_dmat) creditosaprobados, 
	sex.descripcion_sex,
	fac.nombre_fac,
	crp.nombre_crp,
	suc.nombre_suc,
	per.serial_per
FROM 
	materiamatriculada as mmat, 
	detallemateriamatriculada as dmat,
	alumno as alu,
	periodo as per,
	sucursal as suc,
	notasalumnos as nal
	JOIN alumnomalla as ama on ama.serial_alu=alu.serial_alu
	JOIN malla as maa on maa.serial_maa=ama.serial_maa and serial_maa_p=0 and maa.serial_sec=".$serial_sec."
	left join carrera as car on car.serial_car=maa.serial_car
	left join carreraprincipal as crp on crp.serial_crp=car.serial_crp ".$carrera." 
	left join facultad as fac on fac.serial_fac=car.serial_fac
	left join sexo as sex on alu.serial_sex = sex.serial_sex 
WHERE
	mmat.serial_mmat = dmat.serial_mmat
	and alu.serial_alu = mmat.serial_alu
	and mmat.serial_per = per.serial_per
	and alu.serial_suc = suc.serial_suc
	and dmat.serial_dmat = nal.serial_dmat
	and alu.serial_alu=ama.serial_alu 
	and per.serial_sec=".$serial_sec."
	".$periodo."
	".$sucursal."
	and nal.estado_nal='APRUEBA'
	and (dmat.fecharetiro_dmat ='0000-00-00' and dmat.retiromateria_dmat <>'SIN COSTO') 
GROUP BY
	mmat.serial_alu
".$comp."
ORDER
	by nombre
";
$rsNOTAS=$dblink->Execute($sqlNot);

echo "<br>".$sqlNot."<br>"; 
//SQL AUX

//print_r($rsNOTAS);



//COnsulta del Periodo Academico
/*
$rsPeriodo=$dblink->Execute('select nombre_per,  fecini_per,     fecfin_per ,fechaCambioFin_per from periodo,materiamatriculada where periodo.serial_per=materiamatriculada.serial_per  and materiamatriculada.SERIAL_MMAT='.$serial_mmat);*/
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

<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr bgcolor="#FFFFFF">
        <th ><span class="style1">CREDITOS APROBADOS ALUMNOS </span></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class="style1"><? echo $result_alumnos->fields['nombre_crp'];?> </span></th>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th align="right">&nbsp;<script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></th>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1">
      
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th >Nº.</th>
          <th >Nombre</th>
          <th >CM. </th>
		  <th >Creditos Tomados  </th>


		  <th >Sexo</th>
		  <th >Facultad </th>
  		  <th >Carrera</th>
		  <th >Sede</th>
	    </tr>
   
		<? 
			$i=0;
			while (!$rsNOTAS->EOF) { 
			?>
		   <tr>
		     <td  align="left" nowrap><? echo $i +1;?></td>
             <td  align="left" nowrap><? echo $rsNOTAS->fields['nombre'];?></td>

             <td  align="left" nowrap><? echo $rsNOTAS->fields['creditosmalla'];?> </td>
		  <td align="left" nowrap> <? echo $rsNOTAS->fields['creditosaprobados']?> </td>
		   	
		  <td align="right"><? echo $rsNOTAS->fields['descripcion_sex'];?> </td>
		  <td align="right"><? echo $rsNOTAS->fields['nombre_fac'];?></td>
		  <td align="right"><? echo $rsNOTAS->fields['descripcion_sex'];?></td>
		 <td  align="left" nowrap><? echo $rsNOTAS->fields['nombre_suc'];?> </td>		 
		 </tr>
				
			<?
			$i++;
			$rsNOTAS->MoveNext();
		}?>
    </table>
      <BR><BR>
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>