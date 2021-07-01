<style>
.style1{ font-size:12px; font-family: Arial, Helvetica, sans-serif; font-style:inherit; text-align:center; font-weight: bold }
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
$fecha_ini = $_GET['fecha_ini']."-01-01";
$fecha_fin = $_GET['fecha_fin']."-12-31";

$nivelSeccion=$serial_sec;//si es pregrado o postgrado
//$facultad = "";
if($serial_alu<>'T'){
	$alumno = " AND alu.serial_alu=".$serial_alu." ";
}
else
	$alumno='';


if($serial_suc<>'T'){
	$sucursal = " alu.serial_suc=".$serial_suc." ";
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
						$nivel="CASE 
								WHEN car.nombre_car LIKE 'ASOCIADO%' 
									THEN '".$vecNivel[2]."' 
								ELSE '".$vecNivel[3]."' 
		 						END 
								AS nivel";
						$seccionPregrado = "maa.serial_sec = 1 AND";
								
						break;
				case 2:
						$nivel=" CASE 
								WHEN car.nombre_car LIKE 'DIPLOMA%' 
									THEN '".$vecNivel[0]."'
								ELSE '".$vecNivel[1]."' 
		 						END 
								AS nivel";
						$seccionPostgrado = "maa.serial_sec = 2 AND";							
						break;
						
				case 'T':
							
						$nivel=" CASE 
								WHEN car.nombre_car LIKE 'ASOCIADO%' 
									THEN '".$vecNivel[2]."' 
								ELSE '".$vecNivel[3]."' 
		 						END 
								AS nivel";								
						$seccionPregrado = "maa.serial_sec = 1 AND";
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
	ama.fectitulacion_ama,
	ama.numacta_ama,
	alu.codigoIdentificacion_alu,	
	fecharegistro_ama,
	numrefrendacion_ama,
	proyectotitulacion_ama,
	concat_ws(' ', alu.apellidopaterno_alu,	alu.apellidomaterno_alu ,alu.nombre1_alu,alu.nombre2_alu) AS nombre,		
	nac.nombre_nac,
	sex.descripcion_sex,
	suc.nombre_suc                                  AS canton,
	nombre_car ,
	crp.nombre_crp,	";	
		
$sqlAlumnoMalla[2]= "                                                
FROM
	alumnomalla AS ama,
	periodo     AS per,
	malla       AS maa,
	carrera     AS car,
	carreraprincipal as crp,
	sucursal    AS suc,
	sexo        AS sex,	
	alumno      AS alu 		
	   LEFT JOIN nacionalidad AS nac 
	   ON alu.serial_nac = nac.serial_nac 
WHERE
	ama.serial_alu = alu.serial_alu AND
	alu.serial_suc = suc.SERIAL_SUC AND
	alu.serial_sex = sex.serial_sex AND
	maa.serial_maa = ama.serial_maa AND
	maa.serial_car = car.serial_car AND
	car.serial_crp = crp.serial_crp AND
	ama.serial_per = per.serial_per AND
	maa.serial_maa_p = 0 AND 
	ama.fectitulacion_ama <> '0000-00-00' AND 
	fectitulacion_ama>='".$fecha_ini."' AND fectitulacion_ama<='".$fecha_fin."' AND ";	
	//.$seccion."
	//1979
$sqlAlumnoMalla[3] = $sucursal.$alumno;
//							.$seccionMat."							

$sqlAlumnoMalla[4] = " GROUP BY
							alu.serial_alu,
							car.serial_car";
$sqlAlumnoMalla[5] = " order by canton, nombre";
	
	
switch($nivelSeccion){
				case 1: 						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //pregrado
						break;
				case 2:
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPostgrado.$sqlAlumnoMalla[3].$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //postgrado
						break;					
				case 'T':						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$sqlAlumnoMalla[4]." UNION ".$sqlAlumnoMalla[1].$nivel2.$sqlAlumnoMalla[2].$seccionPostgrado.$sqlAlumnoMalla[3].$sqlAlumnoMalla[4].$sqlAlumnoMalla[5];
						break;
				}

	
//and hrr.SERIAL_EPL = 259
$sqlAlumnoMallaMatricula=$sqlAlumnoMalla[0];


//echo "<br>".$sqlAlumnoMallaMatricula."<br>";

$rsAlumnoMalla = $dblink->Execute($sqlAlumnoMallaMatricula);
$numAlum = $rsAlumnoMalla->recordCount();

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
	
	$modalidad='PRESENCIAL';
	//$organiz_cp='TRIMESTRAL';
	//$beca_completa='NO';
	//$ayuda_financiera='NO';
   
	$hombres=0;
	$mujeres=0;
	$i=0;
	$bandera=0;
	if($rsAlumnoMalla->recordCount()>0){
		while(!$rsAlumnoMalla->EOF){
		
		if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";
		
	?>
		 
	<?php
			if($i%2==0){
				$class = "";		
			}else{
				$class = " class=\"odd\"";
			}
			
			
			if($rsAlumnoMalla->fields['serial_sec']==2){
//				$carreraMalla = $rsAlumnoMalla->fields['nombre_car'];			
				$carreraMalla = $rsAlumnoMalla->fields['nombre_crp'];	
			}else	
				$carreraMalla = $rsAlumnoMalla->fields['nombre_crp'];	
				

			$vecCreditos = funCreditos($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu']);			
			$creditos=$vecCreditos[0];
			$matricula=$vecCreditos[1];
			$creditosHom=$vecCreditos[2];
			$instiCarrera=$vecCreditos[3];
				

		
	?>	


<table width="100%" align="center">
  <tr >
    <td rowspan="2" ><img src="../../images/themes/csg/logo.jpg" width="199" height="61" /></td>    
	<td colspan="2" class="style1">FORMULARIO PARA EL REGISTRO  DE TITULOS SENESCYT</td>
  </tr>
  <tr >     
	<td class="style1">FICHA PERSONAL DEL GRADUADO</td>	
  </tr>
</table>


         <BR> <span class="style1"> DATOS PERSONALES </span> 
         <table>  
  <!--Datos Personals-- <thead> -->
    <thead>
	<tr>  
	  	<th width="22%" align="left">Apellidos y Nombre</th>	
		<td width="78%"><?php echo $rsAlumnoMalla->fields['nombre'];?></td>
	</tr> 
	<tr>
	  	<th scope="col"  align="left">Nacionalidad</th>
		<td><?php echo $rsAlumnoMalla->fields['nombre_nac'];?></td>
	 </tr>
	 <tr>
	  	<th scope="col" align="left">Cédula / Pasaporte</th>		  
		 <td><?php echo $rsAlumnoMalla->fields['codigoIdentificacion_alu'];?></td>
	 </tr>
	 <tr> 
	  	<th scope="col"  align="left">sexo</th>
	 <td><?php echo $rsAlumnoMalla->fields['descripcion_sex'];?></td>		  
	 </tr>
	 </thead>
</table>	 

<BR> <span class="style1">DATOS ACADEMICO </span>
	<!--Datos acdemicos-->
<table>		
 <thead> 
	 <tr>	 
	  	<th width="43%" align="left" scope="col">Lugar</th>
		<td width="57%"><a href="#" title="Sucursal"><?php echo $rsAlumnoMalla->fields['canton'];?></a></td>
	 </tr>	 
	 <tr> 
	  	<th scope="col"  align="left">Modalidad</th>
		<td><?php echo $modalidad;?></td>
	 </tr>	 
	 <tr> 
	  	<th scope="col"  align="left">Nivel</th>
        <td><?php echo $rsAlumnoMalla->fields['nivel'];?></td>
	 </tr>
	 <tr>
	  	<th scope="col" align="left">Carrera</th>
		<td><?php echo $carreraMalla;?></td>
	 </tr>
	 <tr> 
	  	<th scope="col" align="left">Fecha Inicio Estudios</th>
		<td><?php echo $rsAlumnoMalla->fields['fecini_per'];?></td>		
	 </tr>
	 <tr>	 
	  	<th scope="col" align="left">Fecha Egresamiento</th>
		<td><?php echo "FECHA DE EGRASMINETO";?></td>	
    </tr>
	  <tr>
	  	<th scope="col" align="left">Duración Carrera:</th>
		<td><?php echo $creditos; ?></td>

      </tr>	   
	  <tr> 	
	  	<th scope="col" align="left">Titulo de Admision</th>
		<td><?php echo "Titulo de Admision";?></td>	

	  </tr>
	  <tr>
	  	<th scope="col" align="left">Procedencia Titulo de Admision</th> 
		<td><?php echo "Procedencia";?></td>	
	  </tr>
  </thead> 
</table>

<BR> <span class="style1">HOMOLOGACION Y/O REVALIDACION DE ESTUDIOS</span>
 	<!--Homologacion y/o revalidacion de estudio-->	   
<table>	
 <thead>
	<tr>
	  <th scope="col" align="left">Institución Estudios Previos:</th>
	   <td><?php echo  $instiCarrera[0];?></td>	
	</tr>
	<tr>  
	  <th scope="col" align="left">Carrera Estudios Previos</th>
	 <td><?php echo  $instiCarrera[1];?></td>	
	</tr> 
	<tr>
	  <th scope="col" align="left">Tiempo de Estudios</th>	    
	 <td><?php echo $creditosHom;?></td>
    </tr> 
  </thead>
</table>
<BR><span class="style1"> DOCUMENTOS UPACIFICO </span>
	<!--Documentos Upacifico-->
<table>	
 <thead>
	<tr>
		<th scope="col" align="left">Fecha de Acta de Grado:</th>
		<td><?php echo  $rsAlumnoMalla->fields['fectitulacion_ama'];?></td>			

	</tr>
	<tr>
		<th scope="col" align="left">No. De Acta de Grado</th>
    	<td><?php echo $rsAlumnoMalla->fields['numacta_ama'];?></td>	
	</tr>
	
	<tr>
		<th scope="col" align="left">Nombre de Título</th>
		<td><?php echo $rsAlumnoMalla->fields['nombre_car'];?></td>	
	</tr>
	<tr>
		<th scope="col" align="left">Fecha de Refrendación</th>	
		<td><?php echo $rsAlumnoMalla->fields['fecharegistro_ama'];?></td>			  

	</tr>	
	<tr>
		<th scope="col" align="left">No. De Refrendación</th>
		 <td><?php echo $rsAlumnoMalla->fields['numrefrendacion_ama'];?></td>	
	</tr>
	<tr>
		<th scope="col" align="left">Proyecto de Titulación:</th>
		 <td><?php echo $rsAlumnoMalla->fields['proyectotitulacion_ama'];?></td>
	</tr>
  </thead>					  
</table>

<BR> <BR> <BR> <BR> 

<table border="1" width="35%" align="left">
  <tr >
    <td class="style1">Responsable de Coordinación</td>    	
  </tr>
  <tr>     
	<td align="left">Fecha:</td>	
  </tr>
  <tr>     
	<td align="left">Nombre:</td>	
  </tr>
  <tr >     
	<td height="58" align="left">Firma:</td>	
  </tr>
</table>

<table border="1" width="45%" align="right" >
  <tr >
    <td class="style1" > Auditor Interno </td>    	
  </tr>
  <tr>     
	<td align="left">Expediente Revisado:</td>	
  </tr>
  <tr>     
	<td align="left">Nombre:</td>	
  </tr>
  <tr >     
	<td height="58"  align="left">Firma:</td>	
  </tr>  
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

		
	<?php	
			$bandera=1;
			$rsAlumnoMalla->MoveNext();
			$i++;
		}
	}
	else
	echo "No se encontraron Alumnos";
	?>	


    <?php
	
  if($rsAlumnoMalla->recordCount()>0){
  	$vector=funEstadistica($rsAlumnoMalla,$vecNivel);	

			$genero=$vector[0];
//			$mujeres=$vector[1];
			$alumnoXcarrera=$vector[1];
			$alumnoXseccion=$vector[2];
			
			
			$cuantos = (count($alumnoXcarrera,1)/count($alumnoXcarrera,0))-1; // cuantas filas tiene el vector	
	}		
			
	

  ?>
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
			/*if($rsAlumnoMalla->fields['serial_sec']==2){
				$carrera = $rsAlumnoMalla->fields['nombre_maa'];			
			}else	
				$carrera = $rsAlumnoMalla->fields['nombre_car'];			
			*/
			
			if($rsAlumnoMalla->fields['serial_sec']==2){
//				$carrera = $rsAlumnoMalla->fields['nombre_car'];		//ASIGNA EL  NOMBRE D LA CARRERA PARA POSGRADO	
				$carrera = $rsAlumnoMalla->fields['nombre_crp']; 		//ASIGNA EL  NOMBRE D LA CARRERA PARA PREGRADO
			}else	
				$carrera = $rsAlumnoMalla->fields['nombre_crp']; 		//ASIGNA EL  NOMBRE D LA CARRERA PARA PREGRADO
			
			$serialCarrera = $rsAlumnoMalla->fields['serial_car'];
			
			$subArea = $rsAlumnoMalla->fields['subarea_aun'];			
			
						
			if($cuantos==0){
				$vecCarrera[0][0]=$serialCarrera;
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
							$vecCarrera[0][$i]=$serialCarrera;
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
				$vecCarrera[0][$cuantos]=$serialCarrera;			
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
		for($n=0;$n<=count($vecNivel);$n++){	
		
			//$vecNIvelProfecional[1][$n]=$rsAlumnoMalla->fields['nivel'];					
			if($vecNivel[$n]==$rsAlumnoMalla->fields['nivel']){
				//echo "</P> NIVEL........ ".$vecNivel[$n].".  .";
				
				$vecNIvelProfecional[1][$n]=$rsAlumnoMalla->fields['nivel'];
				$vecNIvelProfecional[2][$n]=$vecNIvelProfecional[2][$n]+1;	
				if($rsAlumnoMalla->fields['serial_sex']==1){
					$vecNIvelProfecional[3][$n]=$vecNIvelProfecional[3][$n]+1; 
				}
				if($rsAlumnoMalla->fields['serial_sex']==2){
					$vecNIvelProfecional[4][$n]=$vecNIvelProfecional[4][$n]+1;	
				}		
				$vecNIvelProfecional[5][$n]=$rsAlumnoMalla->fields['serial_sec'];//asignamos el serial de la seccioon al que pertenese								
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
		$creditosHom=0;	
		$matricula=0;		
		
//		echo "<br>".$malla." -- ".$alumno;
		//Para la obtencion de la matricula
		
		$sqlMatricula="select fecini_per,SERIAL_MMAT from materiamatriculada,alumnomalla,malla,periodo where 
						materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu 
						and  alumnomalla.serial_maa=malla.serial_maa and malla.serial_maa=".$malla." and alumnomalla.serial_alu=".$alumno."
						and materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu
						and malla.serial_sec=materiamatriculada.SERIAL_SEC
						and periodo.serial_per=materiamatriculada.SERIAL_PER
						order by fecini_per desc";
						
//		echo $sqlMatricula;
						
		 $rsMatricula=$dblink->Execute($sqlMatricula);	
		 if($rsMatricula->recordCount()>0) $matricula=$rsMatricula->fields['SERIAL_MMAT'];
		
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
									//$creditos =	 $creditos + $rsmateriasXalumno->fields['creditos'];
									$creditos =	 $creditos +  $rsMateriaXmalla->fields['numerocreditos_dma'];
									
							//		echo $rsMateriaXmalla->fields['serial_mat']." -> A ".$alumno." ->C ".$rsmateriasXalumno->fields['creditos'];
								//	echo "</p>";
								//$matricula=$rsmateriasXalumno->fields['SERIAL_MMAT'];
								
								$rsmateriasXalumno->MoveNext();
							}
						}else{
								//MATERIA HOMOLOGADAS
								$sqlmateriasHomologadas="SELECT
								serial_mat, tipo_hom, intitucionprevia_hom,	carreraprevia_hom
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
										$creditosHom =	 $creditosHom + $rsMateriaXmalla->fields['numerocreditos_dma'];
										$instiCarrera[0]=$rsmateriasHomologadas->fields['intitucionprevia_hom'];
										$instiCarrera[1]=$rsmateriasHomologadas->fields['carreraprevia_hom'];
										//echo "<br> TIPO:  ".$rsmateriasHomologadas->fields['intitucionprevia_hom'];
										//echo "<br> TIPO:  ".$rsmateriasHomologadas->fields['carreraprevia_hom'];
										
										$rsmateriasHomologadas->MoveNext();
								}

							}else{	
									
									}
						}
							
							
							
						
						$rsMateriaXmalla->MoveNext();
					}
	
			}
			
	//echo "<br> Inst:  ".$instiCarrera[0];
	//echo "<br> Carrera:  ".$instiCarrera[1];
	
	
										
	$vector = array($creditos, $matricula, $creditosHom,$instiCarrera);		
	//echo $vector[0];
	return $vector; 
}


?>



