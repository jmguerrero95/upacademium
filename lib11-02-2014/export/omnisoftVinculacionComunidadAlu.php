<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
// $DBConnection="mysql://root:mysql@localhost/upacifico?persist";
$dblink = NewADOConnection($DBConnection);

/*EXTRAER VARIABLES*/

$serial_suc = $_GET['serial_suc'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];


$nivelSeccion=$serial_sec;//si es pregrado o postgrado

if($serial_suc<>'T'){
	$sucursal = "AND  SERIAL_SUC = ".$serial_suc;
}
else
	$sucursal='';

$fechaVinculacion = "AND (fecha_vca >= '".$fecha_ini."' AND fecha_vca <= '".$fecha_fin."')";


$sqlVinculacionAlumno ="SELECT
						alu.serial_alu,
						concat_ws(' ',alu.apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
						vca.programa_vca,
						vca.fecha_vca,
						vca.horadedicacion_vca,
						vca.tipo_vca,
						vca.observacion_vca 
					FROM
						vincucomunidadalumno AS vca,
						alumno               AS alu 
					WHERE
						vca.serial_alu = alu.SERIAL_alu
						".$fechaVinculacion."
						".$sucursal."
					ORDER BY nombre";

//echo "<br>".$sqlVinculacionAlumno."<br>";

$rsVinculacionesAlumno = $dblink->Execute($sqlVinculacionAlumno);

$numVinculaciones = $rsVinculacionesAlumno->recordCount();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Alumnos PBP</title>
<link rel="stylesheet" type="text/css" href="jqueryuin/css/defpei.css" media="screen" />
<link rel="stylesheet" href="jqueryuin/development-bundle/themes/base/jquery.ui.all.css">	
<script src="jqueryuin/development-bundle/jquery-1.5.1.js"></script>
<script src="jqueryuin/development-bundle/ui/jquery.ui.core.js"></script>
<script src="jqueryuin/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="jqueryuin/development-bundle/ui/jquery.ui.accordion.js"></script>
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

  <table summary="Alumnos PEI">
	<caption>
		Listado de Estudiantes con Vinculacion en la Comunidad <?php echo " (".$numVinculaciones." Programas). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>
	</caption>
  <thead>
    <tr>	
      <th scope="col">ESTUDIANTE</th>
      <th scope="col">PROGRAMA</th>
	  <th scope="col">FECHA</th>
      <th scope="col">HORAS</th>
      <th scope="col">TIPO</th>
	  <th scope="col">OBSERVACION</th>
    </tr>
	</thead>
	
	<tbody>
    <?php 	

	$i=0;

	if($rsVinculacionesAlumno->recordCount()>0){
		while(!$rsVinculacionesAlumno->EOF){
			if($i%2==0){
				$class = "";
			}else{
				$class = " class=\"odd\"";
			}		
	?>	
	 <tr <?php echo $class;?>>
	 <?php $j=$i;?>
	 
						
	 <?php 
//	 	$profesor = 
	 	if($rsVinculacionesAlumno->fields['serial_alu'] <> $alumno){
		$i++;
	?>
	 
      	<th scope="row" id="<?php echo "r".$j+1;?>"><?php echo $rsVinculacionesAlumno->fields['nombre'];?></th>
	<?php
		}
		 else{
	?>    <th scope="row" id="<?php //echo "r".$j+1;?>"></th>
	<? } ?>
	
      	<td><?php echo $rsVinculacionesAlumno->fields['programa_vca'];?></td>
		<td><?php echo $rsVinculacionesAlumno->fields['fecha_vca']?></td>
		<td><?php echo $rsVinculacionesAlumno->fields['horadedicacion_vca'];?></td>
		<td><a href="#" title="Sucursal"><?php echo $rsVinculacionesAlumno->fields['tipo_vca'];?></a></td>
		<td><?php echo $rsVinculacionesAlumno->fields['observacion_vca'];?></td>	
    </tr>
	</tbody>	
	<?php	
			$alumno = $rsVinculacionesAlumno->fields['serial_alu'];
			$rsVinculacionesAlumno->MoveNext();
			//$i++;
		}
	}
	else
	echo "No se encontraron Programas";
	?>	
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="30"><?php echo $i." Estudiantes";?></td>
		</tr>
	</tfoot>
  </table>
</div>
</div>
  <p>
    <?php
if($rsVinculacionesAlumno->recordCount()>0){
	$vector=funEstadistica($rsVinculacionesAlumno);	
	$publicacionesAlumno=$vector[0];
	$cuantos = (count($publicacionesAlumno,1)/count($publicacionesAlumno,0))-1; // cuantas filas tiene el vector	
}	
  	
  ?>
  </p>
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Número de Estudiantes Según el Tipo de Programa en la Vinculación</a></h3>
	<div>
		<p>
  <table>
  <tr>
  	<td width="80%">Tipo de Vinculacion</td>
  	<td>Número de Vinculaciones </td>	
  </tr>
  <?php 
  $arr_nuevo=array();
  for($j=0;$j<=$cuantos;$j++){
  	$arr_nuevo[$publicacionesAlumno[1][$j]]=$publicacionesAlumno[2][$j];
  }
  
  ksort($arr_nuevo);
  foreach ($arr_nuevo as $clave => $valor){

  ?>	
  <tr>
  	<td><?php echo $clave;?> </td>
	<td><?php echo $valor;?> </td>  	
  </tr>
  <?php
  }
  ?>
  <tr>
	
  	<td align="right">Total:</td>
  	<td><?php echo $numVinculaciones;?></td>	
  </tr>
  </table>

		</p>
	</div>
	
	
	
</div>

</div><!-- End demo -->


 

</body>
</html>
<?php

function funEstadistica($rsVinculacionesAlumno){

//$vacModalidad;
//$vecAlumnosCarrera;

$hombres=0;
$mujeres=0;
$cuantos=0;
$bandera=0;//activa para ingresar una nueva carrera



		$rsVinculacionesAlumno->MoveFirst();
		while(!$rsVinculacionesAlumno->EOF){			
			
					
			//ALUMNOS POR CARRERA
			/*if($rsVinculacionesAlumno->fields['serial_sec']==2){
				$carrera = $rsVinculacionesAlumno->fields['nombre_maa'];			
			}else	
				$carrera = $rsVinculacionesAlumno->fields['nombre_car'];			
			
			$subArea = $rsVinculacionesAlumno->fields['subarea_aun'];			*/
			
			$modalidad = $rsVinculacionesAlumno->fields['tipo_vca'];
						
			if($cuantos==0){
				$vacModalidad[1][0]=$modalidad;
				$vacModalidad[2][0]=1;
				$modalidad ='';								
				//$vacModalidad[5][0]=$subArea;
				
			}
	if($modalidad <> ''){	
			for($i=0;$i<=$cuantos;$i++){			
						if($vacModalidad[1][$i]==$modalidad){		
							$vacModalidad[1][$i]=$modalidad;
							$vacModalidad[2][$i]=$vacModalidad[2][$i]+1;											
							//$vacModalidad[5][$i]=$subArea;	
							$i=$cuantos+5000;
							$bandera=0;								
						}
						else{ 							
							$bandera=1 ;
						}											
			}
			
			if($bandera==1){	
				$vacModalidad[1][$cuantos]=$modalidad;
				$vacModalidad[2][$cuantos]=1;										
							
//				$vacModalidad[5][$cuantos]=$subArea;			
				 }
	}						
			$bandera=0;				
			$modalidad='';
			
		$cuantos = (count($vacModalidad,1)/count($vacModalidad,0))-1; // cuantas filas tiene el vector			
		///************************FIN ALUMNOS POR CARRERA**************//				
			$rsVinculacionesAlumno->MoveNext();
		}
	$vector = array($vacModalidad);
	return $vector; 

}

?>


