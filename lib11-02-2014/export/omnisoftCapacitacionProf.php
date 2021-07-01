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



if($serial_suc<>'T'){
	$sucursal = "AND  epl.serial_suc = ".$serial_suc;
}
else{
	$sucursal='';
}
if($serial_sec=="T"){
	$seccion = " and per.serial_sec in (1,2) ";		
}else{
	$seccion = "and per.serial_sec = ".$serial_sec;
}

$periodo = "AND ((fechainicio_cap >= '".$fecha_ini."' AND fechainicio_cap <= '".$fecha_fin."') and (fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' ))";

$sqlMain = "
SELECT
	distinct(epl.serial_epl),
	concat_ws(' ',apellido_epl,nombre_epl) AS nombre,
	fechainicio_cap,
	descripcion_cap,
	duracionhoras_cap,
	descripcion_tcap,
	institucion_cap,
	tipo_cap,
	nombre_suc 
FROM
	capacitacionpersonal AS cap,
	empleado             AS epl,
	tipocapacitacion     AS tcap, 
	sucursal             AS suc,   
	horario				 AS hrr	,
	periodo				 AS per	
WHERE
	cap.serial_epl = epl.serial_epl 
	AND tcap.serial_tcap = cap.serial_tcap 
	AND epl.serial_suc = suc.serial_suc
	AND epl.serial_epl=hrr.serial_epl
	and per.serial_per=hrr.serial_per
	and tipoEmpleado_epl = 'PROFESOR' 
	and prospecto_epl = 'NO' 
	and estado_hrr='ACTIVO'
	".$periodo."
	".$sucursal."
	".$seccion."
	and hrr.serial_hrr in(select serial_hrr from detallemateriamatriculada)
ORDER BY
	apellido_epl

";

//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Reportes Investigadores</title>
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
		Listado de Profesores de Eventos Académicos  <?php echo " (".$totAll." Programas). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>
	</caption>
  <thead>
    <tr>	
      <th scope="col">No.</th>
	  <th scope="col">PROFESOR</th>
      <th scope="col">EVENTO</th>
	  <th scope="col">FECHA</th>
      <th scope="col">HORAS</th>
      <th scope="col">TIPO</th>
	  <th scope="col">INSTITUCION</th>
	  <th scope="col">SUCURSAL</th>	  
    </tr>
	</thead>
	
	<tbody>
    <?php 	
	$swCont = 0;
	//$n = 0;
	//$i=0;

	for($i=0;$i<$totAll;$i++){		
			/*if($i%2==0){
				$class = "";
			}else{
				$class = " class=\"odd\"";
			}		*/
	?>	
	 <tr <?php //echo $class;?>>
	 <?php // $j=$i;?>
	 
						
	 <?php 
//	 	$profesor = 
	 	if($arrMain[$i]['serial_epl'] <> $profesor){
			$swCont++;			
	?>
	 
      	<th scope="row" id="<?php ?>"><?php echo $swCont; ?></th>
		<th scope="row" id="<?php ?>"><?php echo $arrMain[$i]['nombre']?></th>
		
	<?php
		}
		 else{ echo "<th scope='row' id=''>&nbsp;</th>"; echo "<th scope='row' id=''>&nbsp;</th>";}  ?>

	
      	<td><?php echo $arrMain[$i]['descripcion_cap'];?></td>
		<td><?php echo $arrMain[$i]['fechainicio_cap']?></td>
		<td><?php echo $arrMain[$i]['duracionhoras_cap'];?></td>
		<td><a href="#" title="Sucursal"><?php echo $arrMain[$i]['descripcion_tcap'];?></a></td>
		<td><?php echo $arrMain[$i]['institucion_cap'];?></td>	
		<td><?php echo $arrMain[$i]['nombre_suc'];?></td>			
    </tr>
	</tbody>	
	<?php	
			$profesor = $arrMain[$i]['serial_epl'];
	}
	?>	
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="30"><?php //echo $i." Profesores";?></td>
		</tr>
	</tfoot>
  </table>
</div>
</div>
  <p>
    <?php
/*
if($rsVinculacionesProfesor->recordCount()>0){
	$vector=funEstadistica($rsVinculacionesProfesor);	
	$publicacionesProfesor=$vector[0];
	$cuantos = (count($publicacionesProfesor,1)/count($publicacionesProfesor,0))-1; // cuantas filas tiene el vector	
}*/	
  	
  ?>
  </p>
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Número de Profesores que participaron en eventos academicos </a></h3>
	<div>
		<p>
  <table>
  <tr>
  	<td width="80%">Profesores </td>
  	<td><?php echo "<strong>".$swCont."</strong>";?> </td>	
  </tr>
  <?php 
  
/* $arrTipoInv = array(
 	0 => 'BASICA',
 	1 => 'EXPERIMENTAL',
	 2 => 'APLICADA'
 );
 $nTipoInv = count($arrTipoInv);
 $arrCount = array();
 for($i=0;$i<$nTipoInv;$i++ ){
	 $key = $arrTipoInv[$i];
	 $arrCount[$key] = 0;
 }	
 for($i=0;$i<$totAll;$i++ ){ 	 
	 for($j=0;$j<$nTipoInv;$j++){	
		$key = $arrTipoInv[$j];
		if($arrMain[$i]['tipo_inv'] == $key){
			$arrCount[$key]++;
		} 
	 }
	
 }
 for($i=0;$i<$nTipoInv;$i++){
 	 $key = $arrTipoInv[$i];*/
  ?>	
  <tr>
  	<td><?php // echo $arrTipoInv[$i];?> </td>
	<td><?php //echo $arrCount[$key];?> </td>  	
  </tr>
  <?php
  //}
  ?>
  <tr>
	
  	<td align="right">Total:</td>
  	<td><?php echo "<strong>".$swCont."</strong>";?></td>	
  </tr>
  </table>

		</p>
	</div>
	
	
	
</div>

</div><!-- End demo -->


 

</body>
</html>
<?php
/*
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
			
			$subArea = $rsVinculacionesProfesor->fields['subarea_aun'];			*//*
			
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
		///************************FIN ALUMNOS POR CARRERA**************//*/				
			/*$rsVinculacionesProfesor->MoveNext();
		}
	$vector = array($vacModalidad);
	return $vector; */

//}

?>



