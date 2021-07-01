
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
//$facultad = "";

if($serial_suc<>'T'){
	$sucursal = " alu.serial_suc=".$serial_suc." AND";
}
else
	$sucursal='';

//maa.serial_sec = 2 AND
//$vecNivel=()

$vecNivel = array('DIPLOMADO', 'MAESTRIA', 'TECNICO SUPERIOR','TERCER NIVEL');

//$periodo = " and (fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."')";
$periodo = " and ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."'))";

//$periodo = " and (fecini_per >='".$fecha_ini."' or fecfin_per>='".$fecha_fin."')";

switch($nivelSeccion){
				case 1: 
						$nivel=" CASE 
								WHEN car.nombre_car LIKE 'ASOCIADO%' 
									THEN '".$vecNivel[2]."' 
								ELSE '".$vecNivel[3]."' 
		 						END 
								AS nivel";
						$seccionPregrado = "maa.serial_sec = 1 AND";
						$seccionMatPregrado = " AND mmat.serial_sec = 1";
						$periodoMalla="";
								
						break;
				case 2:
						$nivel=" CASE 
								WHEN car.nombre_car LIKE 'DIPLOMA%' 
									THEN '".$vecNivel[0]."'
								ELSE '".$vecNivel[1]."' 
		 						END 
								AS nivel";
						$seccionPostgrado = "maa.serial_sec = 2 AND";	
						$seccionMatPostgrado = " AND mmat.serial_sec = 2";	
						$periodoMalla=" ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."')) AND ";
						break;
						
				case 'T':
						/*$nivel=" CASE 
									WHEN maa.serial_sec = 2 
									THEN 
									CASE 
										WHEN car.nombre_car LIKE 'DIPLOMA%' 
										THEN '".$vecNivel[0]."' 
										ELSE '".$vecNivel[1]."' 
									END 
									ELSE 
									CASE 
										WHEN maa.serial_sec = 1 
										THEN 
										CASE
											WHEN car. nombre_car LIKE 'ASOCIADO%' 
											THEN '".$vecNivel[2]."'
											ELSE '".$vecNivel[3]."'
										END    
									END 
								END
								AS nivel";*/
								 
						//$seccion = "maa.serial_sec = 2 AND";		
						$nivel=" CASE 
								WHEN car.nombre_car LIKE 'ASOCIADO%' 
									THEN '".$vecNivel[2]."' 
								ELSE '".$vecNivel[3]."' 
		 						END 
								AS nivel";								
						$seccionPregrado = "maa.serial_sec = 1 AND";
						$seccionMatPregrado = " AND mmat.serial_sec = 1";

						$nivel2=" CASE 
									WHEN maa.serial_sec = 2 
									THEN 
									CASE 
										WHEN car.nombre_car LIKE 'DIPLOMA%' 
										THEN '".$vecNivel[0]."' 
										ELSE '".$vecNivel[1]."' 
									END 
									ELSE 
									CASE 
										WHEN maa.serial_sec = 1 
										THEN 
										CASE
											WHEN car. nombre_car LIKE 'ASOCIADO%' 
											THEN '".$vecNivel[2]."'
											ELSE '".$vecNivel[3]."'
										END    
									END 
								END
								AS nivel";						
						$seccionPostgrado = "maa.serial_sec <> 1 AND";
						$seccionMatPostgrado = " AND mmat.serial_sec <> 1";
						$seccionMatPostgrado = "";
						$periodoMalla=" ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."')) AND ";
						break;		
			}
//$fecha_act = date("Y")."-".date("m")."-".date("d");	

$sqlAlumnoMalla[1] = "SELECT
	maa.nombre_maa,
	maa.serial_maa,
	maa.serial_sec,
	alu.serial_alu,
	sex.serial_sex,
	car.serial_car,
	car.serial_fac,
	per.fecini_per,
	per.fecfin_per,
	ama.fecharegistro_ama,
	alu.codigoIdentificacion_alu,
	alu.apellidopaterno_alu,
	alu.apellidomaterno_alu ,
	concat_ws(' ', alu.nombre1_alu,alu.nombre2_alu) AS nombre,
	prv.NOMBRE_PRV,
	can.nombre_can ,
	alu.fecnac_alu,
	nac.nombre_nac,
	sex.descripcion_sex,
	suc.nombre_suc                                  AS canton,
	suc.direccion_suc,
	nombre_car ,
	subarea_aun,
	alu.ies_alu,
	alu.iece_alu,
	CASE 
		WHEN alu.mail_alu = ' ' 
		THEN LOWER(alu.mailuniv_alu) 
		ELSE LOWER(alu.mail_alu) 
	END                                                 AS email ,
	CASE 
		WHEN alu.serial_caa = 1 
		THEN 'NO' 
		ELSE 'SI' 
	END                                                 AS BECAC ,
	CASE 
		WHEN alu.serial_caa = 1 
		THEN 'NO' 
		WHEN alu.serial_caa IN(2, 3, 4, 5, 6) 
		THEN 'SI' 
	END                                                 AS becaparcial ,
	CASE 
		WHEN alu.serial_suc = 2 
		THEN 'PICHINCHA' 
		WHEN alu.serial_suc=3 
		THEN 'GUAYAS' 
		WHEN alu.serial_suc=4 
		THEN 'AZUAY' 
	END                                                 AS provincia ,
	CASE 
		WHEN alu.serial_suc = 2 
		THEN 'CHAUPICRUZ' 
		WHEN alu.serial_suc=3 
		THEN 'TARQUI' 
		WHEN alu.serial_suc=4 
		THEN 'MISICATA' 
	END                                                 AS parroquia ,
	";
	
	//.$nivel.
	
$sqlAlumnoMalla[2]= "                                                
FROM
	alumnomalla AS ama,
	periodo     AS per,
	malla       AS maa,
	carrera     AS car,
	sucursal    AS suc,
	sexo        AS sex,
	area_unesco AS aun,
	alumno      AS alu 
		LEFT JOIN canton AS can 
		ON can.serial_can=alu.serial_can 
			LEFT JOIN provincia AS prv 
			ON alu.serial_prv = prv.SERIAL_PRV 
				LEFT JOIN nacionalidad AS nac 
				ON alu.serial_nac = nac.serial_nac 
WHERE
	ama.serial_alu = alu.serial_alu AND
	alu.serial_suc = suc.SERIAL_SUC AND
	alu.serial_sex = sex.serial_sex AND
	maa.serial_maa = ama.serial_maa AND
	maa.serial_car = car.serial_car AND
	car.serial_aun = aun.serial_aun AND
	ama.serial_per = per.serial_per AND
	maa.serial_maa_p = 0 AND ";
	//.$seccion."
$sqlAlumnoMalla[3] = $sucursal."
	alu.serial_alu IN (	SELECT
							DISTINCT SERIAL_ALU 
						FROM
							materiamatriculada AS mmat,
							periodo            AS per 
						WHERE
							mmat.serial_per = per.serial_per
							";
//							.$seccionMat."							

$sqlAlumnoMalla[4] = $periodo."
							)
						GROUP BY
							alu.serial_alu,
							car.serial_car";
	
	
switch($nivelSeccion){
				case 1: 						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$seccionMatPregrado.$sqlAlumnoMalla[4]; //pregrado
						break;
				case 2:
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPostgrado.$periodoMalla.$sqlAlumnoMalla[3].$seccionMatPostgrado.$sqlAlumnoMalla[4]; //postgrado
						break;					
				case 'T':
						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$seccionMatPregrado.$sqlAlumnoMalla[4]." UNION ".$sqlAlumnoMalla[1].$nivel2.$sqlAlumnoMalla[2].$seccionPostgrado.$periodoMalla.$sqlAlumnoMalla[3].$seccionMatPostgrado.$sqlAlumnoMalla[4];
						break;
				}

	
//and hrr.SERIAL_EPL = 259
$sqlAlumnoMallaMatricula=$sqlAlumnoMalla[0];

	echo "<br>".$sqlAlumnoMallaMatricula."<br>";

$rsAlumnoMalla = $dblink->Execute($sqlAlumnoMallaMatricula);
$numAlum = $rsAlumnoMalla->recordCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alumnos MTN</title>

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
	Listado Estudiantes Matriculados <?php echo " (".$numAlum."). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>
	</caption>

  <thead>
    <tr>
      <th scope="col">INSTITUCION</th>
      <th scope="col">PROVINCIA</th>
      <th scope="col">CANTON</th>
      <th scope="col">PARROQUIA</th>
	  <th scope="col">SEDE</th>
      <th scope="col">DIRECCION</th>
      <th scope="col">CARRERA</th>
      <th scope="col">LUGAR</th>
      <th scope="col">SUB-AREA-UNESCO</th>
      <th scope="col">NIVEL</th>
      <th scope="col">MODALIDAD</th>
      <th scope="col">ORGANIZ_CP</th>
      <th scope="col">CREDITOS TOMADOS</th>
      <th scope="col">BECA COMPLETA</th>
      <th scope="col">BECA PARCIAL</th>
      <th scope="col">AYUDA FINANCIERA</th>
      <th scope="col">CREDITO IES</th>
      <th scope="col">CREDITO IECE</th>
      <th scope="col">INICIO DE ESTUDIOS</th>
      <th scope="col">CEDULA</th>
      <th scope="col">APELLIDO PATERNO</th>
      <th scope="col">APELLIDO MATERNO</th>
	  <th scope="col">NOMBRES</th>
      <th scope="col">PROVINCIA DE NACIMIENTO</th>
      <th scope="col">CANTON DE NACIMIENTO</th>
      <th scope="col">FECHA DE NACIMIENTO</th>
      <th scope="col">NUMERO DE MATRICULA</th>
      <th scope="col">NACIONALIDAD</th>
	  <th scope="col">SEXO</th>
	  <th scope="col">E-MAIL</th>		  
    </tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="30"><?php echo $numAlum." Alumnos";?></td>
		</tr>
	</tfoot>
	<tbody>
    <?php 
	
	$modalidad='PRESENCIAL';
	$organiz_cp='TRIMESTRAL';
	$beca_completa='NO';
	$ayuda_financiera='NO';
   
	$hombres=0;
	$mujeres=0;
	$i=0;
	if($rsAlumnoMalla->recordCount()>0){
		while(!$rsAlumnoMalla->EOF){
			if($i%2==0){
				$class = "";		
			}else{
				$class = " class=\"odd\"";
			}
			
			
			if($rsAlumnoMalla->fields['serial_sec']==2){
				$carreraMalla = $rsAlumnoMalla->fields['nombre_maa'];			
			}else	
				$carreraMalla = $rsAlumnoMalla->fields['nombre_car'];	
				

			$vecCreditos = funCreditos($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu']);			
			$creditos=$vecCreditos[0];
			$matricula=$vecCreditos[1];
				
		
			
		/*switch($rsAlumnoMalla->fields['serial_maa']){
				case 1: 
						$hombres=$hombres+1;
						break;
				case 2:
						$mujeres=$mujeres+1;
						break;
		}*/
		
	?>	
	 <tr <?php echo $class;//?>>
	 <?php $j=$i;?>
      	<th scope="row" id="<?php echo "r".$j+1;?>"><?php echo $codigoInstitucion;?></th>
      	<td><?php echo $rsAlumnoMalla->fields['provincia'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['canton']?></td>
		<td><?php echo $rsAlumnoMalla->fields['parroquia'];?></td>
		<td><a href="#" title="Sucursal"><?php echo $rsAlumnoMalla->fields['canton'];?></a></td>
		<td><?php echo $rsAlumnoMalla->fields['direccion_suc'];?></td>
		<td><?php echo $carreraMalla;?></td>
		<td><?php echo $rsAlumnoMalla->fields['canton']." - ".$rsAlumnoMalla->fields['direccion_suc'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['subarea_aun'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['nivel'];?></td>
		<td><?php echo $modalidad;?></td>
		<td><?php echo $organiz_cp;?></td>
		<td><?php echo $creditos; ?></td>		
		<td><?php echo $beca_completa; ?></td>
		<td><?php echo $rsAlumnoMalla->fields['becaparcial'];?></td>
		<td><?php echo $ayuda_financiera; ?></td>
		<td><?php echo $rsAlumnoMalla->fields['ies_alu']?></td>
		<td><?php echo $rsAlumnoMalla->fields['iece_alu'];?></td>		
		<td><?php echo $rsAlumnoMalla->fields['fecini_per']." / ".$rsAlumnoMalla->fields['fecfin_per'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['codigoIdentificacion_alu'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['apellidopaterno_alu'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['apellidomaterno_alu'];?></td>		
		<td><?php echo $rsAlumnoMalla->fields['nombre'];?></td>				
		<td><?php echo $rsAlumnoMalla->fields['NOMBRE_PRV'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['nombre_can'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['fecnac_alu'];?></td>
		<td><?php echo $matricula; ?></td>
		<td><?php echo $rsAlumnoMalla->fields['nombre_nac'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['descripcion_sex'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['email'];?></td>
    </tr>
	</tbody>
		
		
	<?php	
			$rsAlumnoMalla->MoveNext();
			$i++;
		}
	}
	else
	echo "No se encontraron Alumnos";
	?>	
  </table>
</div>
</div>
  <p>
    <?php
  
  	$vector=funEstadistica($rsAlumnoMalla,$vecNivel);	

			$genero=$vector[0];
//			$mujeres=$vector[1];
			$alumnoXcarrera=$vector[1];
			$alumnoXseccion=$vector[2];
			
			
			$cuantos = (count($alumnoXcarrera,1)/count($alumnoXcarrera,0))-1; // cuantas filas tiene el vector	
			
		/*for($j=0;$j<=$cuantos;$j++){
			echo "</p> Ca-> ".$alumnoXcarrera[1][$j];//Carrera
			echo " - Al-> ".$alumnoXcarrera[2][$j];//Total Alumnos x carrera
			echo " ---------- H-> ".$alumnoXcarrera[3][$j]; //hombres x carrera
			echo " - M-> ".$alumnoXcarrera[4][$j];//mujereres x carrera
		}*/
			
//			echo $hombres

  ?>
  </p>
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Alumnos Unesco</a></h3>
	<div>
		<p>
		  <table>
  <tr>
  	<td>Sub - Area Unesco</td>
  	<td>Carrera</td>
  	<td>Hombres</td>
	<td>Mujeres</td>
	<td>Total Carrera</td>
  </tr>
  <?php 
  for($j=0;$j<=$cuantos;$j++){
  ?>	
  <tr>
  	<td><?php echo $alumnoXcarrera[5][$j];//Sub Area Unesco ?></td>
	<td><?php echo $alumnoXcarrera[1][$j];//Carrera ?></td>
  	<td><?php echo $alumnoXcarrera[3][$j]; //hombres x carrera ?></td>
	<td><?php echo $alumnoXcarrera[4][$j];//mujereres x carrera ?></td>
	<td><?php echo $alumnoXcarrera[2][$j];//Total Alumnos x carrera ?></td>
  </tr>
  <?php
  }
  ?>
  <tr>
	<td></td>
  	<td>Total:</td>
  	<td><?php echo $genero[0]; ?></td>
	<td><?php echo $genero[1]; ?></td>
	<td><?php echo $genero[0] + $genero[1]; ?></td>
  </tr>
  </table>

		</p>
	</div>
	<h3><a href="#">Por Nivel y Genero</a></h3>
	<div>
		<p>
  <table>
 <tr>
	<td>Nivel</td>
 	<td>Hombres</td>
	<td>Mujeres</td>
	<td>Total Nivel</td>
 </tr>
 
 <?php for($y=0;$y<count($vecNivel);$y++){?>
	 <tr>
		<td><?php echo $alumnoXseccion[1][$y]; ?></td>
 		<td><?php echo $alumnoXseccion[3][$y]; ?></td>
		<td><?php echo $alumnoXseccion[4][$y]; ?></td>
		<td><?php if(($alumnoXseccion[4][$y] + $alumnoXseccion[3][$y])<>0) echo $alumnoXseccion[4][$y] + $alumnoXseccion[3][$y]; ?>		</td>
	 </tr>
	 
<?php
}
?>
	  <tr>		
		<td>Total:</td>
		<td><?php echo $genero[0]; ?></td>
		<td><?php echo $genero[1]; ?></td>
		<td><?php echo $genero[0] + $genero[1]; ?></td>
	  </tr>	 
 </table >
		</p>
	</div>
	<h3><a href="#">Total Pregrado Postgrado</a></h3>
	<div>
		<p>
 <table>
 
 <tr>
	<td>Programa</td>
	<td>Hombres</td>
	<td>Mujeres</td>
	<td>Total Sección</td>
  </tr>	 
 <tr>	
  	<td>Pregrado</td>
	<td><?php echo $genero[3]; ?></td>
	<td><?php echo $genero[5]; ?></td>
	<td><?php echo $genero[5] + $genero[3]; ?></td>
  </tr>	 
   <tr>	
  	<td>Postgrado</td>
	<td><?php echo $genero[2]; ?></td>
	<td><?php echo $genero[4]; ?></td>
	<td><?php echo $genero[4] + $genero[2]; ?></td>	
  </tr>	 
  <tr>		
	<td>Total:</td>
	<td><?php echo $genero[0]; ?></td>
	<td><?php echo $genero[1]; ?></td>
	<td><?php echo $genero[0] + $genero[1]; ?></td>
   </tr>	 	

 </table> 

		</p>
	</div>
</div>

</div><!-- End demo -->


 

</body>
</html>
<?php

function funEstadistica($rsAlumnoMalla,$vecNivel){

$vecCarrera;
$vecAlumnosCarrera;

$hombres=0;
$mujeres=0;
$cuantos=0;
$bandera=0;//activa para ingresar una nueva carrera



		$rsAlumnoMalla->MoveFirst();
		while(!$rsAlumnoMalla->EOF){			
			/********************TOTAL ALUMNOS	***************************/
			switch($rsAlumnoMalla->fields['serial_sex']){
				case 1: 
						/************Alumnos Por Seccion****************/
						if($rsAlumnoMalla->fields['serial_sec']==1){
							$hombresPre=$hombresPre+1;
						}
						if($rsAlumnoMalla->fields['serial_sec']==2){
							$hombresPost=$hombresPost+1;
						}
						
				
						$hombres=$hombres+1;
						break;
				case 2:
						/************Alumnos Por Seccion****************/				
						if($rsAlumnoMalla->fields['serial_sec']==1){
							$mujeresPre=$mujeresPre+1;
						}
						if($rsAlumnoMalla->fields['serial_sec']==2){
							$mujeresPost=$mujeresPost+1;
						}
						$mujeres=$mujeres+1;
						break;
			}		
			$genero = array($hombres, $mujeres, $hombresPost,$hombresPre,$mujeresPost,$mujeresPre);	
			
			//ALUMNOS POR CARRERA
			if($rsAlumnoMalla->fields['serial_sec']==2){
				$carrera = $rsAlumnoMalla->fields['nombre_maa'];			
			}else	
				$carrera = $rsAlumnoMalla->fields['nombre_car'];			
			
			$subArea = $rsAlumnoMalla->fields['subarea_aun'];			
			
						
			if($cuantos==0){
				$vecCarrera[1][0]=$carrera;
				$vecCarrera[2][0]=1;
				$carrera ='';								
				if($rsAlumnoMalla->fields['serial_sex']==1){
									$vecCarrera[3][0]=1;
									$vecCarrera[4][0]=0;
				}
				if($rsAlumnoMalla->fields['serial_sex']==2){
									$vecCarrera[4][0]=1;
									$vecCarrera[3][0]=0;	
				}
				$vecCarrera[5][0]=$subArea;
				
			}
	if($carrera <> ''){	
			for($i=0;$i<=$cuantos;$i++){			
						if($vecCarrera[1][$i]==$carrera){		
							$vecCarrera[1][$i]=$carrera;
							$vecCarrera[2][$i]=$vecCarrera[2][$i]+1;							
							
								
							if($rsAlumnoMalla->fields['serial_sex']==1){
									$vecCarrera[3][$i]=$vecCarrera[3][$i]+1; 
								}
								if($rsAlumnoMalla->fields['serial_sex']==2){
									$vecCarrera[4][$i]=$vecCarrera[4][$i]+1;	
								}
							$vecCarrera[5][$i]=$subArea;	
							//$vecCarrera[3][$i]=777;
							$i=$cuantos+5000;
							$bandera=0;	
								
								
						}
						else{ 							
							$bandera=1 ;
						}
						
													
			}
			
			if($bandera==1){	
				$vecCarrera[1][$cuantos]=$carrera;
				$vecCarrera[2][$cuantos]=1;		
									
							if($rsAlumnoMalla->fields['serial_sex']==1){
									$vecCarrera[3][$cuantos]=1; 
									$vecCarrera[4][$cuantos]=0;
							}
							if($rsAlumnoMalla->fields['serial_sex']==2){
									$vecCarrera[4][$cuantos]=1;	
									$vecCarrera[3][$cuantos]=0;
							}
				$vecCarrera[5][$cuantos]=$subArea;			
				 }
	}						
			$bandera=0;				
			$carrera='';
			
		$cuantos = (count($vecCarrera,1)/count($vecCarrera,0))-1; // cuantas filas tiene el vector			
		///************************FIN ALUMNOS POR CARRERA**************//				
		
		/***********ALUMNOS POR NIVEL*************/		
		for($n=0;$n<count($vecNivel);$n++){	
			//$vecNIvelProfecional[1][$n]=$rsAlumnoMalla->fields['nivel'];					
			if($vecNivel[$n]==$rsAlumnoMalla->fields['nivel']){
				$vecNIvelProfecional[1][$n]=$rsAlumnoMalla->fields['nivel'];
				$vecNIvelProfecional[2][$n]=$vecNIvelProfecional[2][$n]+1;	
				if($rsAlumnoMalla->fields['serial_sex']==1){
					$vecNIvelProfecional[3][$n]=$vecNIvelProfecional[3][$n]+1; 
				}
				if($rsAlumnoMalla->fields['serial_sex']==2){
					$vecNIvelProfecional[4][$n]=$vecNIvelProfecional[4][$n]+1;	
				}										
			}				
							
		}	
			
		
		
		
		/***********FIN ALUMNOS POR NIVEL**************/
		
			$rsAlumnoMalla->MoveNext();
		}
	$vector = array($genero, $vecCarrera, $vecNIvelProfecional);
	return $vector; 

}



function funCreditos($malla, $alumno){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
		$creditos=0;	
		$matricula=0;		
			//MATERIAS POR MALLA
			$sqlMateriaXmalla="SELECT
				serial_mat,
				numerocreditos_dma 
			FROM
				malla        AS maa,
				detallemalla AS dma ,
				alumnomalla   AS ama 
			WHERE
				maa.serial_maa = dma.serial_maa AND
				ama.serial_maa=maa.serial_maa AND
				maa.serial_maa = ".$malla." AND
				ama.serial_alu = ".$alumno;	
				//echo $sqlMateriaXmalla."</p>";
				
			$rsMateriaXmalla = $dblink->Execute($sqlMateriaXmalla);	
			
			if($rsMateriaXmalla->recordCount()>0){
			while(!$rsMateriaXmalla->EOF){			
						/*echo $alumno;
						echo "----";
						echo $malla;
						echo "</p>";*/
						//CREDITOS POR MATERIA
						$sqlmateriasXalumno="SELECT
							(numerocreditos_dmat + creditosequivalentes_dmat) AS creditos,
							mmat.SERIAL_MMAT,
							serial_mat,
							dmat.serial_dmat 
						FROM
							materiamatriculada        AS mmat,
							detallemateriamatriculada AS dmat,
							notasalumnos              AS nal 
						WHERE
							mmat.serial_mmat = dmat.serial_mmat AND
							dmat.serial_dmat = nal.serial_dmat AND
							estado_nal LIKE 'APRUEBA' AND 						
							dmat.serial_mat = ".$rsMateriaXmalla->fields['serial_mat']." AND
							mmat.serial_alu=".$alumno;
						
						//echo $sqlmateriasXalumno."</p>";						
						$rsmateriasXalumno = $dblink->Execute($sqlmateriasXalumno);
						if($rsmateriasXalumno->recordCount()>0){						
							while(!$rsmateriasXalumno->EOF){
									$creditos =	 $creditos + $rsmateriasXalumno->fields['creditos'];
							//		echo $rsMateriaXmalla->fields['serial_mat']." -> A ".$alumno." ->C ".$rsmateriasXalumno->fields['creditos'];
								//	echo "</p>";
								$matricula=$rsmateriasXalumno->fields['SERIAL_MMAT'];
								
								$rsmateriasXalumno->MoveNext();
							}
						}else{
								//MATERIA HOMOLOGADAS
								$sqlmateriasHomologadas="SELECT
								serial_mat 
							FROM
								homologacion        AS hom,
								detallehomologacion AS dhom 
							WHERE
								dhom.serial_hom = hom.serial_hom AND
								hom.serial_alu = ".$alumno." AND
								dhom.serial_mat = ".$rsMateriaXmalla->fields['serial_mat'];
							
							//echo $sqlmateriasHomologadas."</p>";						
							$rsmateriasHomologadas = $dblink->Execute($sqlmateriasHomologadas);
							if($rsmateriasHomologadas->recordCount()>0){						
								while(!$rsmateriasHomologadas->EOF){
										$creditos =	 $creditos + $rsMateriaXmalla->fields['numerocreditos_dma'];

										$rsmateriasHomologadas->MoveNext();
								}

							}else{	
									
									//echo $rsMateriaXmalla->fields['serial_mat']."->No encontro MISMO";
									//echo "</p>";
									}
						}
							
							
						//echo "Total".$creditos;
						//echo "</p>";																							
						
						$rsMateriaXmalla->MoveNext();
					}
	
			}
			
	$vector = array($creditos, $matricula );		
	//echo $vector[0];
	return $vector; 
}


?>



