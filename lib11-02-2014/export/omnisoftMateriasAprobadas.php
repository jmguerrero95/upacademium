
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
						$seccionPregrado = "maa.serial_sec = 1 AND";
						$seccionMatPregrado = " AND mmat.serial_sec = 1";
						$periodoMalla="";
								
						break;
				case 2:						
						$seccionPostgrado = "maa.serial_sec = 2 AND";	
						$seccionMatPostgrado = " AND mmat.serial_sec = 2";	
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
	concat_ws(' ', alu.apellidopaterno_alu,	alu.apellidomaterno_alu, alu.nombre1_alu,alu.nombre2_alu) AS nombre,		
	alu.fecnac_alu,	
	sex.descripcion_sex,
	suc.nombre_suc                                  AS canton,
	UPPER(suc.direccion_suc) 						as direccion_suc ,
	nombre_car ,
	UPPER(subarea_aun) 								as subarea_aun,
	alu.ies_alu,
	alu.iece_alu,
	crp.nombre_crp,
	CASE 
		WHEN alu.mail_alu = ' ' 
		THEN LOWER(alu.mailuniv_alu) 
		ELSE LOWER(alu.mail_alu) 
	END                                                 AS email		                                                
FROM
	alumnomalla AS ama,
	periodo     AS per,
	malla       AS maa,
	carrera     AS car,
	carreraprincipal as crp,
	sucursal    AS suc,
	sexo        AS sex,
	area_unesco AS aun,
	alumno      AS alu 		
WHERE
	ama.serial_alu = alu.serial_alu AND
	alu.serial_suc = suc.SERIAL_SUC AND
	alu.serial_sex = sex.serial_sex AND
	maa.serial_maa = ama.serial_maa AND
	maa.serial_car = car.serial_car AND
	car.serial_crp = crp.serial_crp AND
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
$sqlAlumnoMalla[5] = " order by canton, nombre";
	
	
switch($nivelSeccion){
				case 1: 						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$seccionPregrado.$sqlAlumnoMalla[3].$seccionMatPregrado.$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //pregrado
						break;
				case 2:
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$seccionPostgrado.$periodoMalla.$sqlAlumnoMalla[3].$seccionMatPostgrado.$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //postgrado
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
<title>Alumnos MTN</title>

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
	
	$(function() {
		$( "#accordion1" ).accordion({
			collapsible: true
		});
	});
	</script>
    <style type="text/css">
<!--
.style1 {
	font-size: 12;
	font-weight: bold;
}
-->
    </style>
    </head>
<body>




  <table width="100%" >
		<tr>
			<td align="center">
				<span class="style1">Listado de Materias por Estudiante<br>
			Matriculados <?php echo " (".$numAlum."). Desde: ".$fecha_ini."  Hasta: ".$fecha_fin;?>			    </span></td>
		</tr>
  </table>
	
	<tbody>
    <?php 	
	
   
	$hombres=0;
	$mujeres=0;
	$i=0;
	$q=0;
	$var=2;
	$cont=$rsAlumnoMalla->recordCount();
	if($rsAlumnoMalla->recordCount()>0){
		while(!$rsAlumnoMalla->EOF){
		$i++;
		
		/*	if($i%2==0){
				$class = "";		
			}else{
				$class = " class=\"odd\"";
			}*/
			
			
			if($rsAlumnoMalla->fields['serial_sec']==2){
				$carreraMalla = $rsAlumnoMalla->fields['nombre_car'];			
			}else	
				$carreraMalla = $rsAlumnoMalla->fields['nombre_crp'];	
				

			$vecCreditos = funCreditos($rsAlumnoMalla->fields['serial_car'], $rsAlumnoMalla->fields['serial_alu']);			
//			$creditos=$vecCreditos[0];
	//		$matricula=$vecCreditos[1];
			$count1=0;
			$count2=0;
			$count3=0;
				
			$materiasTomadas=$vecCreditos[0];
			if((count($materiasTomadas,0))>0)
				$count1 = (count($materiasTomadas,1)/count($materiasTomadas,0))-1;	
			
			$materiasHomologadas=$vecCreditos[1];
			if((count($materiasHomologadas,0))>0)
				$count2 = (count($materiasHomologadas,1)/count($materiasHomologadas,0))-1;	
			
			$materiasNoTomadas=$vecCreditos[2];
			if((count($materiasNoTomadas,0))>0)	
				$count3 = (count($materiasNoTomadas,1)/count($materiasNoTomadas,0))-1;	
				
			switch($rsAlumnoMalla->fields['descripcion_sex']){
				case 'MASCULINO': 						
						$generoEst='HOMBRE';
						break;
				case 'FEMENINO':
						$generoEst='MUJER';
						break;									
				}		
		
		
	?>
	<p>&nbsp;</p>
	
	<table width="100%" border="1px">
	
	   <tr style=" background-color:#6699FF">	  
	  	<!-- <td align="center" colspan="4"><?php //echo $i.".- ".$rsAlumnoMalla->fields['nombre'];?></td>	-->
	   </tr>
	   <!--
	   <tr>
			
			
			  <td width="30%">MALLA</td>          
			  <td width="13%">SEDE</td>      
			  <td width="21%">CARRERA</td>      
			 <td width="22%">INICIO DE ESTUDIOS</td>  
			        	
	  </tr>
	  
	  
	  
			<tr>
				
				<td><?php //echo $rsAlumnoMalla->fields['nombre_maa'];?></td>		
				<td><?php //echo $rsAlumnoMalla->fields['canton'];?></td>
				<td><?php //echo $carreraMalla;?></td>							
				<td><?php //echo $rsAlumnoMalla->fields['fecini_per'];?></td>							
			</tr>	
			
			-->
	</table>
	
	
	<table width="100%" border="1px">
		   <tr>	  
		     <td width="28%" style="background:bottom"><div align="center"><strong>Materias Tomadas</strong></div></td>          
		     <td width="39%"><div align="center"><strong>Materias Homologadas o Revalidadas</strong></div></td>      
			  <td width="33%"><div align="center"><strong>Materias sin Tomar</strong></div></td> 
			   <td width="22%">INICIO DE ESTUDIOS</td>
			   <td width="33%"><div align="center"><strong>ESTUDIANTE</strong></div></td> 
			   <td width="33%"><div align="center"><strong>MALLA</strong></div></td> 
			   <td width="33%"><div align="center"><strong>SEDE</strong></div></td> 
			    <td width="33%"><div align="center"><strong>CARRERA</strong></div></td>
	  </tr>
		<tr>
		<td valign="top">
			<table width="100%">
				<?php
				//style="position:fixed"
				// echo $count1;	
				for($x=1;$x<=$count1;$x++){
				?>	
				<tr>		
<!--					<td width="21%"><?php echo " ".$x." ";?> </td>-->

				  <td width="79%"> <?php echo " ".$x.".- ".$materiasTomadas[1][$x];?></td>
				  <td width="79%"> <?php echo $materiasTomadas[2][$x]?></td>
				</tr>
				<?php
					}
				?>
			</table>	
		</td>
		<td valign="top">
			<table width="100%">
				<?php
				// echo $count1;	
				for($y=1;$y<=$count2;$y++){
				?>	
				<tr>		
				  <td width="95%"> <?php echo  " ".$y.".- ".$materiasHomologadas[1][$y];?> </td>
				   <td width="95%"> <?php echo $materiasHomologadas[2][$y];?> </td>
				</tr>
				<?php
					}
				?>
			</table>	
		</td>
		<td valign="top">
			<table width="100%">
				<?php
				// echo $count1;	
				for($z=1;$z<=$count3;$z++){
				?>	
				<tr>		
					<td width="95%"> <?php echo  " ".$z.".- ".$materiasNoTomadas[1][$z];?> </td>
					
				</tr>
				<?php
						//$q++;
						//$estadisticasNoTomadas[1][$q]=$materiasNoTomadas[1][$z];						
					}
					?>
					
			
			</table>	
			
			<td valign="top">
			<table width="100%">
			
				<tr>				
				  <td width="95%"><?php echo $rsAlumnoMalla->fields['fecini_per'];?></td>
				</tr>
				
			</table>	
		</td>
			
		<td valign="top">
			<table width="100%">
				
				<tr>		
				  <td width="95%"><?php echo $i.".- ".$rsAlumnoMalla->fields['nombre'];?></td>
				</tr>
				
			</table>	
		</td>	
		
		<td valign="top">
			<table width="100%">
				
				<tr>		
				  <td width="95%"><?php echo $rsAlumnoMalla->fields['nombre_maa'];?></td>
				</tr>
				
			</table>	
		</td>	
				
		<td valign="top">
			<table width="100%">
				
				<tr>		
				  <td width="95%"><?PHP echo $rsAlumnoMalla->fields['canton'];?></td>
				</tr>
				
			</table>	
		</td>		
		
		<td valign="top">
			<table width="100%">
				
				<tr>		
				  <td width="95%"><? echo $carreraMalla;?></td>
				</tr>
				
			</table>	
		</td>		
			
		</td>		
		</tr>
	</table>	
		
		
	<?php			
		
		$rsAlumnoMalla->MoveNext();		
	}
		
	

	

	}
	else
	echo "No se encontraron Alumnos";
	?>	



</body>
</html>
<?php
function funEstadisticas($estadisticasNoTomadas,$q){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
	//$count = (count($estadisticasNoTomadas,1)/count($estadisticasNoTomadas,0))-1;	
	//echo $q." ------ ".$count;
	
	/********************Crea un atbla temporal*************************************************/
//	$bandera=1;
	$tabla = "CREATE TEMPORARY TABLE temporalEstadistica(
    materia int(11) NOT NULL    
    , nombre VARCHAR(250) NOT NULL    
	)ENGINE=MEMORY ;";	
	$dblink->Execute($tabla);	
	
	
	
	
	for($r=1;$r<=$q;$r++){
//		echo "</p>".$r." -> ".$estadisticasNoTomadas[1][$r];
		
		$temporal = "INSERT INTO temporalEstadistica
			(materia, nombre) values(".$r.",'".$estadisticasNoTomadas[1][$r]."')";
		$dblink->Execute($temporal);			
		
	}
	
	$sqlMateriasFaltantes="SELECT
							count(materia) as cuantos,nombre
						FROM
							temporalEstadistica
						group by nombre";
			$s=0;									
						$rssqlMateriasFaltantes = $dblink->Execute($sqlMateriasFaltantes);
						if($rssqlMateriasFaltantes->recordCount()>0){												
							while(!$rssqlMateriasFaltantes->EOF){
								$s++;	
								$materiasFaltante[1][$s]=$rssqlMateriasFaltantes->fields['nombre'];
								$materiasFaltante[2][$s]=$rssqlMateriasFaltantes->fields['cuantos'];								
								
								//echo "</p> MAterias: ".$rssqlMateriasFaltantes->fields['nombre']."Cuantos: ".$rssqlMateriasFaltantes->fields['cuantos'];													
								$rssqlMateriasFaltantes->MoveNext();
							}
						}
	
	$destruir="DROP TABLE temporalEstadistica";
	$dblink->Execute($destruir);
	
	
	return $materiasFaltante;
}

function funCreditos($carrera, $alumno){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
		$creditos=0;	
		$matricula=0;		
		$i=0;
			//MATERIAS POR MALLA
			$sqlMateriaXmalla="SELECT
				mat.serial_mat,
				numerocreditos_dma,nombre_maa,nombre_mat 
			FROM
				malla        AS maa,
				detallemalla AS dma ,
				alumnomalla  AS ama,
				materia      as mat  
			WHERE
				maa.serial_maa = dma.serial_maa AND
				ama.serial_maa=maa.serial_maa AND
				dma.serial_mat=mat.serial_mat and
				maa.serial_car = ".$carrera." AND
				ama.serial_alu = ".$alumno;	
				///////echo $sqlMateriaXmalla."</p>";
			//echo $sqlMateriaXmalla;	
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
							dmat.serial_dmat,
							 notatotal_nal 
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
												
						$rsmateriasXalumno = $dblink->Execute($sqlmateriasXalumno);
						//echo $sqlmateriasXalumno;
						if($rsmateriasXalumno->recordCount()>0){												
							while(!$rsmateriasXalumno->EOF){
										$i++;
										if($alumno==6673){
											echo $rsMateriaXmalla->fields['nombre_mat'].'</p>';
											echo $rsmateriasXalumno->fields['notatotal_nal'];
											
										}
									
								$materiasTomadas[1][$i]=$rsMateriaXmalla->fields['nombre_mat'];
								$materiasTomadas[2][$i]=$rsmateriasXalumno->fields['notatotal_nal'];
								$rsmateriasXalumno->MoveNext();
								
							}
						}else{
								//MATERIA HOMOLOGADAS
								$sqlmateriasHomologadas="SELECT
								serial_mat,
								notafinal_dhom
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
										$j++;
										$materiasHomologadas[1][$j]=$rsMateriaXmalla->fields['nombre_mat'];
										$materiasHomologadas[2][$j]=$rsmateriasHomologadas->fields['notafinal_dhom'];
										//$creditos =	 $creditos + $rsMateriaXmalla->fields['numerocreditos_dma'];

										$rsmateriasHomologadas->MoveNext();
								}

							}else{	
									$n++;
									$materiasNoTomadas[1][$n]=$rsMateriaXmalla->fields['nombre_mat'];
									//Materia no tomadas
									
									
								  }
						}
							
							
						//echo "Total".$creditos;
						//echo "</p>";																							
						
						$rsMateriaXmalla->MoveNext();
					}
	
			}
			/*if($creditos==0){
				echo '</p> sqlMalla-> '.$sqlMateriaXmalla.' ALUMNO: '.$alumno.' --- MMAT: '.$sqlmateriasXalumno.'  ---HOM '.$sqlmateriasHomologadas;				
			}*/
			
//	$vector = array($creditos, $matricula );		
	$vector = array($materiasTomadas, $materiasHomologadas, $materiasNoTomadas);		
	//echo $vector[0];
	return $vector; 
}


?>



