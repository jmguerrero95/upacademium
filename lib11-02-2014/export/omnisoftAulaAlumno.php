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
	$fecha_ini = $_GET['fecha_ini'];
	$fecha_fin = $_GET['fecha_fin'];	
	$serial_suc=$_GET['serial_suc'];
	$serial_sec = $_GET['serial_sec'];
	$serial_crp = $_GET['serial_crp'];
	$per = explode('*',$_GET['serial_per']);
	$serial_per = $per[0];
	
	//Fechas
	if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
		$periodo = " and fecini_per>='".$fecha_ini."' and fecini_per<='".$fecha_fin."'";
	}else{			
		$periodo = " and per.serial_per = ".$serial_per;	
	}
	//sucursal
	if($serial_suc=="T"){
		$sucursal = "";		
	}else{
		$sucursal = " and per.serial_suc = ".$serial_suc;
	}
	//seccion
	if($serial_sec=="T"){
		$seccion = "";		
	}else{
		$seccion = " and per.serial_sec = ".$serial_sec;
	}
		
	//and per.serial_per = ".$serial_per." 
	$sqlPer = "
		SELECT 
			serial_per,
			serial_suc,
			nombre_per  
		FROM 
			periodo 		
		WHERE 
			fecini_per between '".$fecha_ini."' 
			and '".$fecha_fin."' 
			and serial_suc=".$serial_suc." 
			and serial_sec=".$serial_sec." 
		ORDER BY 
			fecini_per
	";
	$result_periodos=$dblink->Execute($sqlPer);
	$SQLalulas = "
	SELECT
		hrr.SERIAL_HRR, 
		hrr.SERIAL_PER as hrrper, 
		per.serial_per as permat, 
		per.nombre_per as periodo, 
		mat.serial_mat, 
		mat.nombre_mat as materia, 
		aul.nombre_aul as aula , 
		count(mmat.SERIAL_ALU) as alumnos, 
		per.fecini_per as inicio, 
		per.fecfin_per as final, 
		aul.serial_aul, 
		codigo_mat,seccion_hrr,
		fac.nombre_fac as facultad 
	FROM
		materiamatriculada as mmat,
		detallemateriamatriculada as dmat,
		horario as hrr,
		aulas as aul, 
		periodo as per, 
		alumno as alu,
		materia as mat,
		facultad as fac 
	WHERE
		hrr.serial_hrr=dmat.serial_hrr 
		and hrr.SERIAL_PER = per.serial_per 
		and mmat.serial_mmat = dmat.serial_mmat 
		and hrr.serial_aul = aul.serial_aul 
		and alu.serial_alu = mmat.SERIAL_ALU 
		and dmat.serial_mat = mat.serial_mat 
		and hrr.serial_fac = fac.serial_fac
		".$periodo."
		".$sucursal."
		".$seccion."		 
	GROUP BY
		hrr.SERIAL_PER, 
		dmat.serial_mat, 
		hrr.SERIAL_AUL 
	ORDER BY
		per.serial_per, 
		mat.nombre_mat, 
		hrr.SERIAL_AUL
	";
	$rsAlulas=$dblink->Execute($SQLalulas);
	echo "<br>".$SQLalulas."<br>";

?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.style4 {font-size:14px; font-family:Arial, Helvetica, sans-serif}
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
    <th colspan="2">Estudiantes por Aula </th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde: <? echo $fecha_ini;?>&lt;=&gt;hasta: <? echo $fecha_fin;?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">SEDE:</th>
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
          					<th width="1%"  style="">Nro.</th>
							<th width="5%">Código</th>
					        <th width="25%">Materia</th>
		  					<th width="10%">Número de Estudiantes</th>
		  					<th width="20%">Aula</th>
							<th width="20%">Periodo</th>
		 				    <th width="20%">Facultad</th>
	</tr>	
        		 
		 
        
		<? $i=1;
		  $per = 0;
		  $bandera = 0;		  
		  
		  $total = $rsAlulas->RecordCount();
		  
		  //echo "T : ".$total;
		  
			while (!$rsAlulas->EOF) {
			   //echo $alumnos."<br>"; 
			   
			 
			?>
				<? 
					if($rsAlulas->fields['serial_per']!=$per){					
						if($bandera == 1){
				?>
						<tr>
						<td colspan="3" ><span class="style4"><? echo "Total de Alumnos:  ".$totalAlumnos;?></span></td>
						<td colspan="2" ><span class="style4"><? echo "Promedio de Alumno por Aula:  ".number_format($totalAlumnos/$i,1);?></span></td>						
						</tr>
						<?
						}
						?>	
						<tr>
						<td align="center" colspan="5"><span class="style1"><? echo $rsAlulas->fields['periodo']." Inició: ".$rsAlulas->fields['inicio'].""." Finalizó: ".$rsAlulas->fields['final'];
						$i=1;
						$totalAlumnos = 0;
						?></span></td>
						<tr>
							 
				<?	
					}		
					
						
									
					$per = $rsAlulas->fields['serial_per'];
				?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td><span class="style2"><? echo $rsAlulas->fields['codigo_mat'];?></span></td>				
				<td><span class="style2"><? echo $rsAlulas->fields['materia']."=>".$rsAlulas->fields['seccion_hrr'];?></span></td>
				<td nowrap="nowrap"><span class="style2"><? echo $rsAlulas->fields['alumnos'];?></span></td>
				<td><span class="style2"><? echo $rsAlulas->fields['aula'];?></span></td>				
				<td><span class="style2"><? echo $rsAlulas->fields['periodo'];?></span></td>				
				<td><span class="style2"><? echo $rsAlulas->fields['facultad'];?></span></td>
				</tr>				
				
			
		<?
//		echo "<td>".$rsAlulas->CurrentRow()."---".$total."</td>";
				
		
		
		$bandera=1;
		$totalAlumnos =  $totalAlumnos + $rsAlulas->fields['alumnos'];
		$i++;
		
		
		if($rsAlulas->CurrentRow()==$rsAlulas->RecordCount()-1){
		//	 echo "<td>"."Salio"."</td>";
		?>	 
			 <tr>
						<td colspan="3" ><span class="style4"><? echo "Total de Alumnos:  ".$totalAlumnos;?></span></td>
						<td colspan="4" ><span class="style4"><? echo "Promedio de Alumno por Aula:  ".number_format($totalAlumnos/$i,1);?></span></td>						
						</tr>
			
		<?	 
		}
				$rsAlulas->MoveNext();
		}
		
	//if ($rsAlulas->MoveLast()==1)
			  // echo $rsAlulas->EOF."<- </p>";

		
		?>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>

</body>
</html>