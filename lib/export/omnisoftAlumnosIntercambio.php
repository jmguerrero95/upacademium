<style>
.style1{ font-size:12px; font-family: Arial, Helvetica, sans-serif; font-style:inherit; text-align:center; font-weight: bold; }
</style>

<style>
H1.SaltoDePagina{
 
     PAGE-BREAK-AFTER: always
 }
  
</style>



<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
// $DBConnection="mysql://root:mysql@localhost/upacifico?persist";
$dblink = NewADOConnection($DBConnection);


/*EXTRAER VARIABLES*/
$serial_suc = $_GET['serial_suc'];
$serial_sec = $_GET['serial_sec'];
$intercambio_alu = $_GET['intercambio_alu'];
//$fecha_ini = $_GET['fecha_ini']."-01-01";
//$fecha_fin = $_GET['fecha_fin']."-12-31";

$nivelSeccion=$serial_sec;//si es pregrado o postgrado
//$facultad = "";
if($serial_alu<>'T'){
	$alumno = " AND alu.serial_alu=".$serial_alu;
}
else
	$alumno='';


if($serial_suc<>'T'){
	$sucursal = " and alu.serial_suc=".$serial_suc;
}
else
	$sucursal='';

if($serial_suc<>'T'){
	$seccion = " and alu.serial_sec=".$serial_sec;
}
else
	$seccion='';

if($intercambio_alu<>'T'){
	$intercambio = " and alu.intercambio_alu like'".$intercambio_alu."'";
}
else
	$intercambio='';


$sqlAlumnoIntercambio="select alu.serial_alu, concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre
							,intercambio_alu
							,direcciondomic_alu 
							,codigoIdentificacion_alu
							, nac.nombre_nac
							,sex.descripcion_sex
							,sex.serial_sex
							,fecnac_alu
							,fechaInscripcion_alu
							from alumno as alu,sexo as sex
							LEFT JOIN nacionalidad AS nac 
								 ON alu.serial_nac = nac.serial_nac
							where alu.serial_sex = sex.serial_sex
							and intercambio_alu <> ' '
							and intercambio_alu <> 'NINGUNO'
							".$alumno."
							".$sucursal."
							".$seccion."
							".$intercambio."							
							group by alu.serial_alu
							order by nombre";

//echo "<br>".$sqlAlumnoIntercambio."<br>";
$rsAlumnoInter = $dblink->Execute($sqlAlumnoIntercambio);
//$numAlum = $rsAlumnoInter->recordCount();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>

<link rel="stylesheet" type="text/css" href="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/css/defpei.css" media="screen" />
<link rel="stylesheet" href="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/themes/base/jquery.ui.all.css">	
<script src="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/jquery-1.5.1.js"></script>
<script src="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/ui/jquery.ui.core.js"></script>
<script src="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/ui/jquery.ui.accordion.js"></script>
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true
		});
	});
	</script>


</head>
<body>
<div id="content">
<div id="itsthetable">

<?php 	
   
	$hombres=0;
	$mujeres=0;
	
	$i=0; //contador
	$bandera=0;//bandera para saltar pagina
	
	if($rsAlumnoInter->recordCount()>0){
		while(!$rsAlumnoInter->EOF){
		//configurar contadores
		$i++;
		if($rsAlumnoInter->fields['serial_sex']==1)
			$hombres++;
		else	
			$mujeres++;
		
		if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";
		
	?>
		 
	<?php		
			//asigna del periodo el nombre y la fecha
			$vecPeriodo = funPeriodo($rsAlumnoInter->fields['serial_alu']);		
			$nombrePeriodo=$vecPeriodo[0];
			$fechaPeriodo=$vecPeriodo[1];			
	?>	


<table width="80%" align="center">
  <tr >
    <td rowspan="2" ><img src="../../images/themes/csg/logo.jpg" width="199" height="61" /></td>    
	<td colspan="2" class="style1">ALUMNOS DE MODALIDAD ESPECIAL</td>
  </tr>
  <tr >     
	<td class="style1">FICHA PERSONAL </td>	
  </tr>
</table>
        
         <p>&nbsp;</p>
         
   <table width="80%" align="center">  
  <!--Datos Personals-- <thead> -->
    <thead>
	
	<tr>  
	  	
		<td colspan="2" width="78%" align="center" class="style1"><?php echo $i.".- ".$rsAlumnoInter->fields['nombre'];?></td>
	</tr> 
	
	<tr>
	  	<th width="22%" align="left">Modalidad</th>	
		<td width="78%"><?php echo $rsAlumnoInter->fields['intercambio_alu'];?></td>
	</tr> 	
	<tr>
	  	<th scope="col"  align="left">Nacionalidad</th>
		<td><?php echo $rsAlumnoInter->fields['nombre_nac'];?></td>
	 </tr>
	 <tr>
	  	<th scope="col" align="left">Cédula / Pasaporte</th>		  
		 <td><?php echo $rsAlumnoInter->fields['codigoIdentificacion_alu'];?></td>
	 </tr>
	 <tr> 
	  	<th scope="col"  align="left">sexo</th>
	 <td><?php echo $rsAlumnoInter->fields['descripcion_sex'];?></td>		  
	 </tr>	 
	 <tr> 
	  	<th scope="col"  align="left">Fecha de Nacimiento</th>
	 <td><?php echo $rsAlumnoInter->fields['fecnac_alu'];?></td>		  
	 </tr>
	 
	 <tr> 
	  	<th scope="col"  align="left">Fecha de Ingreso</th>
	 <td><?php echo $rsAlumnoInter->fields['fechaInscripcion_alu'];?></td>		  
	 </tr>
	 
	 
	 <tr> 
	  	<th scope="col"  align="left">Ultimo Periodo Inscrito</th>
	 <td><?php echo $nombrePeriodo;?></td>		  
	 </tr>
	 
	 <tr> 
	  	<th scope="col"  align="left">Fecha del Periodo</th>
	 <td><?php echo $fechaPeriodo;?></td>		  
	 </tr>
	 </thead>
</table>	 




<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <?php	
			$bandera=1;
			$rsAlumnoInter->MoveNext();			
		}
	}
	else
	echo "No se encontraron Alumnos";
	?>	
</p>		
	<table width="25%" align="center">  
  <!--Estadistica-->  
    <thead>	
	<tr>
		<td colspan="2" width="78%" align="center" class="style1">Resumen:</td>		
	</tr> 
	<tr>
		<td width="78%" class="style1">Total Alumnos:</td> 	  	
		<td width="78%" align="center" ><?php echo $i;?></td>
	</tr> 
	<tr>
		<td width="78%"  class="style1">Total Mujeres:</td> 	  	
		<td width="78%" align="center" ><?php echo $mujeres;?></td>
	</tr> 
	<tr>
		<td width="78%"  class="style1">Total Hombres:</td> 	  	
		<td width="78%" align="center" ><?php echo $hombres; ?></td>
	</tr>
	</thead>
</table>	
  
</body>
</html>
<?php

function funPeriodo($alumno){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
		$creditos=0;
		$creditosHom=0;	
		$matricula=0;		
		
	
		$sqlUltimoPeriodo="select per.SERIAL_PER,nombre_per,fecini_per
							from materiamatriculada as mmat,periodo as per
							where mmat.SERIAL_PER=PER.serial_per
							and mmat.ACTIVO_MMAT='SI'
							and mmat.serial_alu = ".$alumno." 
							order by per.fecini_per desc
							limit 1";
					
		 $rsUltimoPeriodo=$dblink->Execute($sqlUltimoPeriodo);	
		 if($rsUltimoPeriodo->recordCount()>0){
			while(!$rsUltimoPeriodo->EOF){			
						
						
					$nombrePeriodo = $rsUltimoPeriodo->fields['nombre_per'];
					$FechaInicio =	$rsUltimoPeriodo->fields['fecini_per'];
							
						
						$rsUltimoPeriodo->MoveNext();
					}
	
			}										
	$vector = array($nombrePeriodo, $FechaInicio);			
	return $vector; 
}


?>



