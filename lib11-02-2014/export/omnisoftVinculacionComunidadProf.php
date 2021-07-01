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

$fechaVinculacion = "AND (fecha_vcp >= '".$fecha_ini."' AND fecha_vcp <= '".$fecha_fin."')";


$sqlVinculacionProfesor ="SELECT
							epl.serial_epl,
							concat_ws(' ',epl.APELLIDO_EPL,epl.NOMBRE_EPL) AS nombre,
							vcp.programa_vcp,
							vcp.fecha_vcp,
							vcp.horadedicacion_vcp,
							vcp.tipo_vcp,
							vcp.observacion_vcp 
						FROM
							vincucomunidadprofesor AS vcp,
							empleado               AS epl 
						WHERE
							vcp.serial_epl = epl.SERIAL_EPL 
							".$fechaVinculacion."
							".$sucursal."
						order by APELLIDO_EPL,nombrecomp_epl";
//echo "<br>".$sqlVinculacionProfesor."<br>";

$rsVinculacionesProfesor = $dblink->Execute($sqlVinculacionProfesor);

$numVinculaciones = $rsVinculacionesProfesor->recordCount();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Profesores PBP</title>
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

  <table summary="Profesores PEI">
	<caption>
		Listado de Profesores con Vinculacion en la Comunidad <?php echo " (".$numVinculaciones." Programas). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>
	</caption>
  <thead>
    <tr>	
      <th scope="col">PROFESOR</th>
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

	if($rsVinculacionesProfesor->recordCount()>0){
		while(!$rsVinculacionesProfesor->EOF){
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
	 	if($rsVinculacionesProfesor->fields['serial_epl'] <> $profesor){
		$i++;
	?>
	 
      	<th scope="row" id="<?php echo "r".$j+1;?>"><?php echo $rsVinculacionesProfesor->fields['nombre'];?></th>
	<?php
		}
		 else{
	?>    <th scope="row" id="<?php //echo "r".$j+1;?>"></th>
	<? } ?>
	
      	<td><?php echo $rsVinculacionesProfesor->fields['programa_vcp'];?></td>
		<td><?php echo $rsVinculacionesProfesor->fields['fecha_vcp']?></td>
		<td><?php echo $rsVinculacionesProfesor->fields['horadedicacion_vcp'];?></td>
		<td><a href="#" title="Sucursal"><?php echo $rsVinculacionesProfesor->fields['tipo_vcp'];?></a></td>
		<td><?php echo $rsVinculacionesProfesor->fields['observacion_vcp'];?></td>	
    </tr>
	</tbody>	
	<?php	
			$profesor = $rsVinculacionesProfesor->fields['serial_epl'];
			$rsVinculacionesProfesor->MoveNext();
			//$i++;
		}
	}
	else
	echo "No se encontraron Programas";
	?>	
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="30"><?php echo $i." Profesores";?></td>
		</tr>
	</tfoot>
  </table>
</div>
</div>
  <p>
    <?php
if($rsVinculacionesProfesor->recordCount()>0){
	$vector=funEstadistica($rsVinculacionesProfesor);	
	$publicacionesProfesor=$vector[0];
	$cuantos = (count($publicacionesProfesor,1)/count($publicacionesProfesor,0))-1; // cuantas filas tiene el vector	
}	
  	
  ?>
  </p>
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Número de Profesores Según el Tipo de Programa en la Vinculación</a></h3>
	<div>
		<p>
  <table>
  <tr>
  	<td width="80%">Tipo de Vinculacion</td>
  	<td>Nùmero de Vinculaciones</td>	
  </tr>
  <?php 

  
  $arr_nuevo=array();
  for($j=0;$j<=$cuantos;$j++){
  	$arr_nuevo[$publicacionesProfesor[1][$j]]=$publicacionesProfesor[2][$j];
  }
  //print "<pre>ANTES: ";print_r($arr_nuevo);print "<pre>";
    
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

function funEstadistica($rsVinculacionesProfesor){

//$vacModalidad;
//$vecAlumnosCarrera;

$hombres=0;
$mujeres=0;
$cuantos=0;
$bandera=0;//activa para ingresar una nueva carrera



		$rsVinculacionesProfesor->MoveFirst();
		while(!$rsVinculacionesProfesor->EOF){			
			
					
			//ALUMNOS POR CARRERA
			/*if($rsVinculacionesProfesor->fields['serial_sec']==2){
				$carrera = $rsVinculacionesProfesor->fields['nombre_maa'];			
			}else	
				$carrera = $rsVinculacionesProfesor->fields['nombre_car'];			
			
			$subArea = $rsVinculacionesProfesor->fields['subarea_aun'];			*/
			
			$modalidad = $rsVinculacionesProfesor->fields['tipo_vcp'];
						
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
			$rsVinculacionesProfesor->MoveNext();
		}
	$vector = array($vacModalidad);
	return $vector; 

}

?>



