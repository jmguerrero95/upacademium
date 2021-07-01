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

$fechaPublicacion = "AND (fecha_pbl >= '".$fecha_ini."' AND fecha_pbl <= '".$fecha_fin."')";




$sqlPublicacionesProfesor = "SELECT epl.serial_epl,
	concat_ws(' ',epl.APELLIDO_EPL,epl.NOMBRE_EPL) as nombre,
	nombre_pbl,
	fecha_pbl,
	pbl.forma_pbl,
	pbl.observacion_pbl,
    pmod.descripcion_pmod,
	pmod.serial_pmod
FROM
	publicacionesprofesor AS pbl,
	empleado              AS epl, 
    publicacionmodalidad as pmod
WHERE
	pbl.serial_epl = epl.SERIAL_EPL AND
    pbl.serial_pmod = pmod.serial_pmod 	
	".$fechaPublicacion."
	".$sucursal."
order by epl.APELLIDO_EPL,epl.NOMBRE_EPL";

//echo "<br>".$sqlPublicacionesProfesor."<br>";

$rsPublicacionesProfesor = $dblink->Execute($sqlPublicacionesProfesor);

$numPublicaciones = $rsPublicacionesProfesor->recordCount();

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
		Listado de Profesores con Publicaciones <?php echo " (".$numPublicaciones." Publicaciones). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>
	</caption>

  <thead>
    <tr>	
      <th scope="col">PROFESOR</th>
      <th scope="col">PUBLICACION</th>
	  <th scope="col">FECHA</th>
      <th scope="col">FORMA-PUBLICACION</th>
      <th scope="col">OBSERVACION</th>
	  <th scope="col">MODALIDAD</th>
    </tr>
	</thead>
	
	<tbody>
    <?php 	

	$i=0;

	if($rsPublicacionesProfesor->recordCount()>0){
		while(!$rsPublicacionesProfesor->EOF){
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
	 	if($rsPublicacionesProfesor->fields['nombre'] <> $profesor){
		$i++;
	?>
	 
      	<th scope="row" id="<?php echo "r".$j+1;?>"><?php echo $rsPublicacionesProfesor->fields['nombre'];?></th>
	<?php
		}
		 else{
	?>    <th scope="row" id="<?php //echo "r".$j+1;?>"></th>
	<? } ?>
      	<td><?php echo $rsPublicacionesProfesor->fields['nombre_pbl'];?></td>
		<td><?php echo $rsPublicacionesProfesor->fields['fecha_pbl']?></td>
		<td><?php echo $rsPublicacionesProfesor->fields['forma_pbl'];?></td>
		<td><a href="#" title="Sucursal"><?php echo $rsPublicacionesProfesor->fields['observacion_pbl'];?></a></td>
		<td><?php echo $rsPublicacionesProfesor->fields['descripcion_pmod'];?></td>	
    </tr>
	</tbody>	
	<?php	
			$profesor = $rsPublicacionesProfesor->fields['nombre'];
			$rsPublicacionesProfesor->MoveNext();
			//$i++;
		}
	}
	else
	echo "No se encontraron Publicaciones";
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
if($rsPublicacionesProfesor->recordCount()>0){
	$vector=funEstadistica($rsPublicacionesProfesor);	
	$publicacionesProfesor=$vector[0];
	$cuantos = (count($publicacionesProfesor,1)/count($publicacionesProfesor,0))-1; // cuantas filas tiene el vector	
}	
  	
  ?>
  </p>
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Número de Profesores Según la Modalidad de la Publicación</a></h3>
	<div>
		<p>
  <table>
  <tr>
  	<td width="80%">Modalidad</td>
  	<td>Publicaciones</td>	
  </tr>
  <?php 
  
  for($j=0;$j<=$cuantos;$j++){
  ?>	
  <tr>
  	<td><?php echo $publicacionesProfesor[1][$j];?> </td>
	<td><?php echo $publicacionesProfesor[2][$j];?> </td>  	
  </tr>
  <?php
  }
  ?>
  <tr>
	
  	<td align="right">Total:</td>
  	<td><?php echo $numPublicaciones;?></td>	
  </tr>
  </table>

		</p>
	</div>
	
	
	
</div>

</div><!-- End demo -->


 

</body>
</html>
<?php

function funEstadistica($rsPublicacionesProfesor){

//$vacModalidad;
//$vecAlumnosCarrera;

$hombres=0;
$mujeres=0;
$cuantos=0;
$bandera=0;//activa para ingresar una nueva carrera



		$rsPublicacionesProfesor->MoveFirst();
		while(!$rsPublicacionesProfesor->EOF){			
			
					
			//ALUMNOS POR CARRERA
			/*if($rsPublicacionesProfesor->fields['serial_sec']==2){
				$carrera = $rsPublicacionesProfesor->fields['nombre_maa'];			
			}else	
				$carrera = $rsPublicacionesProfesor->fields['nombre_car'];			
			
			$subArea = $rsPublicacionesProfesor->fields['subarea_aun'];			*/
			
			$modalidad = $rsPublicacionesProfesor->fields['descripcion_pmod'];
						
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
			$rsPublicacionesProfesor->MoveNext();
		}
	$vector = array($vacModalidad);
	return $vector; 

}

?>



