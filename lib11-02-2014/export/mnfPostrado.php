
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
$nivelSeccion=2;
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

$periodoHasta = " and ((fecini_per<='".$fecha_fin."') or (fecfin_per<='".$fecha_fin."'))";

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
						//$periodoMalla=" ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."')) AND ";
						//$periodoMalla=" (('".$fecha_ini."'  BETWEEN fecini_per AND  fecfin_per) or ('".$fecha_fin."' BETWEEN fecini_per AND  fecfin_per )) AND ";
						//$periodo=" and (('".$fecha_ini."'  BETWEEN fecini_per AND  fecfin_per) or ('".$fecha_fin."' BETWEEN fecini_per AND  fecfin_per )) ";
						//$periodoMalla=" (('".$fecha_ini."'  BETWEEN fecini_per AND  fecfin_per) or ('".$fecha_fin."' BETWEEN fecini_per AND  fecfin_per )) and";
						
						$periodo=" and (fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') ";
						$periodoMalla=" (fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') and";
						//$periodoMalla = " (fecini_per >='".$fecha_ini."' or fecfin_per>='".$fecha_fin."') and ";
						
//						echo "ENTRASAAAAAAAAAAAAAAAAAA".$periodoMalla."<br>";
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
	creditomax_maa,
 	totalcreditos_maa,
	alu.fechaInscripcion_alu,
	alu.codigoIdentificacion_alu,
	alu.apellidopaterno_alu,
	alu.apellidomaterno_alu ,
	concat_ws(' ', alu.nombre1_alu,alu.nombre2_alu) AS nombre,	

	CASE 
		WHEN alu.serial_nac  <> 1
		THEN 'NO CORRESPONDE'
		ELSE UPPER(prv.NOMBRE_PRV) 
	END                                             AS provinciaNac,
CASE 
		WHEN alu.serial_nac  <> 1
		THEN 'NO CORRESPONDE'
		ELSE UPPER(ciu.nombre_ciu) 
	END                                             AS ciudadNac,
	CASE 
		WHEN observacion_alu = 'NINGUNA' 
		THEN '' 
		ELSE UPPER(observacion_alu) 
	END 											AS observacion_alu,
		
	alu.fecnac_alu,
	nac.nombre_nac,
	sex.descripcion_sex,
	suc.nombre_suc                                  AS canton,
	UPPER(suc.direccion_suc) 						as direccion_suc ,
	nombre_car ,
	UPPER(subarea_aun) 								as subarea_aun,
	alu.ies_alu,
	alu.iece_alu,
	crp.nombre_crp,
	ama.fectitulacion_ama,
	ama.fecegresamiento_ama,
	CASE 
		WHEN alu.tipoIdentificacion_alu ='CI' 
		THEN 'CEDULA' 
		ELSE 'PASAPORTE'
	END AS tipoIdentificacion,
	CASE 
		WHEN ama.fectitulacion_ama <> '0000-00-00' 
            THEN 'GRADUADO' 
		ELSE 
            CASE 
                WHEN ama.fecegresamiento_ama <> '0000-00-00' 
                    THEN 'EGRESADO' 
                ELSE 'ESTUDIANDO'
            END
	END as EstadoEstudiante,		 
		 LOWER(alu.mailuniv_alu) AS emailI, 
		 LOWER(alu.mail_alu)     AS emailP ,
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
		THEN 'COCHAPAMBA' 
		WHEN alu.serial_suc=3 
		THEN 'TARQUI' 
		WHEN alu.serial_suc=4 
		THEN 'YANUNCAY' 
	END                                                 AS parroquia ,
	";
	
//echo $sqlAlumnoMalla[1];	//.$nivel.
	
$sqlAlumnoMalla[2]= "                                                
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
		LEFT JOIN ciudad AS ciu 
		ON ciu.serial_ciu=alu.serial_ciu 
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
	car.serial_crp = crp.serial_crp AND
	car.serial_aun = aun.serial_aun AND
	ama.serial_per = per.serial_per AND
	maa.serial_maa_p = 0 AND	
	";
//	ama.serial_alu=2281 and  	
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
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$seccionMatPregrado.$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //pregrado
						break;
				case 2:
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPostgrado.$periodoMalla.$sqlAlumnoMalla[3].$seccionMatPostgrado.$sqlAlumnoMalla[4].$sqlAlumnoMalla[5]; //postgrado
						break;					
				case 'T':						
						$sqlAlumnoMalla[0] = $sqlAlumnoMalla[1].$nivel.$sqlAlumnoMalla[2].$seccionPregrado.$sqlAlumnoMalla[3].$seccionMatPregrado.$sqlAlumnoMalla[4]." UNION ".$sqlAlumnoMalla[1].$nivel2.$sqlAlumnoMalla[2].$seccionPostgrado.$periodoMalla.$sqlAlumnoMalla[3].$seccionMatPostgrado.$sqlAlumnoMalla[4].$sqlAlumnoMalla[5];
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
	</script>


    <style type="text/css">
<!--
.style1 {color: #993300}
.style2 {color: #FF0000}
.style3 {color: #0000CC}
.style4 {color: #000000}
.style6 {color: #0000FF}
-->
    </style>
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
	 <th scope="col"><span class="style1">SERIAL(ocultar)</span></th>
      <th scope="col">INSTITUCION(NO EXISTE) </th>
      <th scope="col">CODIGO cAMPUS </th>
      <th scope="col">SEDE(CAMPUS)</th>
      <th scope="col">PROVINCIA</th>
      <th scope="col">CANTON</th>
      <th scope="col">PARROQUIA</th>
	  <th scope="col">DIRECCION</th>
	  <th scope="col">codigo de Oferta </th>
      <th scope="col">ofereta academica</th>
      <th scope="col">SUB-AREA-UNESCO</th>
      <th scope="col">NIVEL</th>
      <th scope="col">MODALIDAD</th>
      
      <th scope="col">organizació malla curricular </th>
      <th scope="col">jornada carrera programa </th>
      <th scope="col">practicas pre-profesionales </th>
      <th scope="col">HORAS_practicas profesionales</th>
      <th scope="col">Nombre entidad pasantias </th>
      <th scope="col">numeros_creditos</th>
      <th scope="col">Fecha inicio primer nivel</th>
      <th scope="col">fecha_inicio_convalidación </th>
      <th scope="col">BECA TOTAL </th>
      <th scope="col">monto de beca total </th>
      <th scope="col">BECA PARCIAL</th>
      <th scope="col">monto beca parcial </th>
      <th scope="col">AYUDA  econOmica</th>
      <th scope="col">monto ayuda econOmica </th>
      <th scope="col">CREDITO IES (credito económico) </th>
      <th scope="col">monto de credito economico </th>
      <th scope="col">ayuda arancel </th>
      <th scope="col">monto arancel </th>
      <th scope="col">manuntencion</th>
      <th scope="col">monto manuntencion </th>
      <th scope="col">beca socio economica </th>
      <th scope="col">beca excelencia economica </th>
      <th scope="col">beca discapacidad </th>
      <th scope="col">beca deportiva </th>
      <th scope="col">sistema registro consultas academicas </th>
      <th scope="col">correo electronico institucional </th>
      <th scope="col">sistema de matriculacion en linea </th>
      <th scope="col">servico de biblioteca virtual </th>
      <th scope="col">plataforma de enseñanza virtual </th>
      <th scope="col">email institucional </th>
      <th scope="col">docuemnto de identificacion </th>
      <th scope="col">CEDULA</th>
      <th scope="col"><p>PRIMER APELLIDO</p>
        </th>
      <th scope="col">SEGUNDO APELLIDO</th>
      <th scope="col">NOMBRES</th>
      <th scope="col">PROVINCIA_NACIMIENTO</th>
      <th scope="col">CANTON_NACIMIENTO</th>
      <th scope="col">FECHA_NACIMIENTO</th>
      <th scope="col">tipo_discapacidad </th>
      <th scope="col">carnet_conadis </th>
      <th scope="col">numero_cartet_conadis </th>
      <th scope="col">PORCENTAJE_discapacidad </th>
      <th scope="col">NUMERO DE MATRICULA</th>
      <th scope="col">NACIONALIDAD</th>
      <th scope="col">SEXO</th>
      <th scope="col">autoidentificacion_etnia </th>
      <th scope="col">ingreso familiar </th>
      <th scope="col">E-MAIL</th>
      <th scope="col">OBSERVACIONES</th>
	  
	  <th scope="col" >numeros_creditos hasta <?php echo " ".$fecha_fin;?></th>
	  <th scope="col">PORCENTAJE HASTA <?php echo " ".$fecha_fin;?> vs CREDITOS DE LA MALLA</th>
	  <th scope="col">PORCENTAJE HASTA <?php echo " ".$fecha_fin;?> vs CREDITOS TOTALES</th>        
	  
      <th scope="col">CREDITOS TOMADOS ACTUALMENTE </th>   
	  <th scope="col">PORCENTAJE ACTUALMENTE vs CREDITOS DE LA MALLA</th>
	  <th scope="col">PORCENTAJE ACTUALMENTE vs CREDITOS TOTALES</th> 
	     
      <th scope="col">CREDITOS DE LA MALLA</th>
      <th scope="col">TOTAL DE CREDITOS</th>
      <th scope="col">ESTADO</th>
	  <th scope="col">FECHA EGRESAMIENTO</th>
	  <th scope="col">FECHA TITULACION</th>
    </tr>
	</thead>
	<tfoot>
		<tr>
		  <th scope="row">&nbsp;</th>
			<th scope="row">Total</th>
				<td colspan="81"><?php echo $numAlum." Alumnos";?></td>
		</tr>
	</tfoot>
	<tbody>
    <?php 
	
	$modalidad='PRESENCIAL';
	$organiz_cp='TRIMESTRAL';
	
	
	
	$ayuda_financiera='NO';
   
	$hombres=0;
	$mujeres=0;
	$i=0;
	 //$sql="DELETE FROM auxiliar_ntn";
	if($rsAlumnoMalla->recordCount()>0){
	// borrar el contenido de la tabla
		// $dblink->Execute($sql); // ejecutar la consulta
		 
		while(!$rsAlumnoMalla->EOF){
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
				

			$beca_completa=funBecas($rsAlumnoMalla->fields['serial_alu'],$periodo);
			
			$jornadaEstudio=funJornada($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu'],$periodo);
			
			
			$vecCreditos = funCreditos($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu'],$rsAlumnoMalla->fields['serial_car'],$periodoHasta);			
			$creditos=$vecCreditos[0];
			$matricula=$vecCreditos[1];
			$pasantia=$vecCreditos[2];
			$convalidacion=$vecCreditos[3];
			
			//$vecCreditosFacturados = funCreditosFacturados($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu'],$rsAlumnoMalla->fields['serial_car']);			
			//$creditosFacturados=$vecCreditosFacturados[0];
			
			
			$vecCreditosActuales = funCreditos($rsAlumnoMalla->fields['serial_maa'], $rsAlumnoMalla->fields['serial_alu'],$rsAlumnoMalla->fields['serial_car']," ");			
			$creditosActuales=$vecCreditosActuales[0];
			
//			$matricula=$vecCreditos[1];
	//		$pasantia=$vecCreditos[2];
				
/*		if(echo $rsAlumnoMalla->fields['descripcion_sex']==''){	
		
		}*/
		//////////ubica campus////////////////
		
		
		switch($rsAlumnoMalla->fields['canton']){
				case 'QUITO': 						
						$codigocampus='1044-17-01-EX-001';
						$nombreCampus='UNIVERSIDAD DEL PACIFICO ESCUELA DE NEGOCIOS - CAMPUS QUITO PINAR';
						break;
				case 'GUAYAQUIL':
						$codigocampus='1044-09-01-MA-001';
						$nombreCampus='UNIVERSIDAD DEL PACIFICO ESCUELA DE NEGOCIOS - CAMPUS GUAYAQUIL';
						break;	
				case 'CUENCA':
						$codigocampus='1044-01-01-UA-001';
						$nombreCampus='UNIVERSIDAD DEL PACIFICO ESCUELA DE NEGOCIOS - UNIDAD ACADEMICA CUENCA';
						break;			
														
				}
		
		/////////ubica sexo////////////////
		
		switch($rsAlumnoMalla->fields['descripcion_sex']){
				case 'MASCULINO': 						
						$generoEst='HOMBRE';
						break;
				case 'FEMENINO':
						$generoEst='MUJER';
						break;									
				}
	?>	
	 <tr>
	 <td><?php echo $rsAlumnoMalla->fields['serial_alu'];?></td>
	   <td><?php echo $codigoInstitucion;?></td>
	 <?php $j=$i;?>
      	<td><?php echo $codigocampus;?></td>
      	<td><?php echo $nombreCampus;?></a></td>
      	<td><?php echo $rsAlumnoMalla->fields['provincia'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['canton']?></td>
		<td><?php echo $rsAlumnoMalla->fields['parroquia'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['direccion_suc'];?></td>
		<td>campo tabla carreras </td>
		<td><?php echo $carreraMalla;//carrera?></td>		
		<td><?php echo $rsAlumnoMalla->fields['subarea_aun'];?> Verificar Nombres </td>
		<td><?php echo $rsAlumnoMalla->fields['nivel'];?></td>
		<td><?php echo $modalidad;?></td>
		
		<td><?php echo $organiz_cp;?></td>
		<td><?php echo $jornadaEstudio;?></td>
		<td><?php echo $pasantia;?></td>
		<td></td>
		<td></td>
		<td><?php echo $creditos; ?></td>
		<td><?php echo $rsAlumnoMalla->fields['fecini_per'];?></td>
		<td><?php echo $convalidacion[0]; ?></span></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo $rsAlumnoMalla->fields['ies_alu']?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>NO</td>
		<td>SI</td>
		<td>NO</td>
		<td>SI</td>
		<td>SI</td>
		<td><?php echo $rsAlumnoMalla->fields['emailI'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['tipoIdentificacion'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['codigoIdentificacion_alu'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['apellidopaterno_alu'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['apellidomaterno_alu'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['nombre'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['provinciaNac'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['ciudadNac'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['fecnac_alu'];?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo $matricula;?></td>
		<td><?php echo $rsAlumnoMalla->fields['nombre_nac'];?></td>
		<td><?php echo $generoEst;?></td>
		<td></td>
		<td></td>
		<td><?php echo $rsAlumnoMalla->fields['emailP'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['observacion_alu'];?></td>
		
		<!--------------------------HASTA AQUI PARA EL SENECYT---------------------------------------->
		
		<td style="background-color:#66CCFF"><?php echo $creditos; ?></td>		
		<td style=" background-color:#66CCFF; font-style:inherit"><?php echo number_format(($creditos*100)/$rsAlumnoMalla->fields['totalcreditos_maa'],2); ?></td>
		<td style="background-color:#66CCFF"><?php echo number_format(($creditos*100)/$rsAlumnoMalla->fields['creditomax_maa'],2); ?></td>
		
		
		<td style="background-color:#FFFF99"><?php echo $creditosActuales; ?></td>	
		<td style="background-color:#FFFF99"><?php echo number_format(($creditosActuales*100)/$rsAlumnoMalla->fields['totalcreditos_maa'],2); ?></td>
		<td style="background-color:#FFFF99"><?php echo number_format(($creditosActuales*100)/$rsAlumnoMalla->fields['creditomax_maa'],2); ?></td>
		<!--<td style="color:#FF0000"><?php //echo $creditosFacturados; ?></td>	--->
		
		
		<td style="background-color:#00FF99"><?php echo $rsAlumnoMalla->fields['totalcreditos_maa']; ?></td>
		<td style="background-color:#00FF99"><?php echo $rsAlumnoMalla->fields['creditomax_maa']; ?></td>
		<td><span style="color:#FF0000"><?php echo $rsAlumnoMalla->fields['EstadoEstudiante']; ?></span></td>
		<td><?php echo $rsAlumnoMalla->fields['fecegresamiento_ama'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['fectitulacion_ama'];?></td>
		
	<?php 

//$insert="insert into `auxiliar_ntn`(INSTITUCION, PROVINCIA, CANTON, PARROQUIA, SEDE, DIRECCION, CARRERA, LUGAR, SUB_AREA_UNESCO, NIVEL, MODALIDAD, ORGANIZ_CP, CREDITOS_TOMADOS_APROBADOS, BECA_COMPLETA, BECA_PARCIAL, AYUDA_FINANCIERA, CREDITO_IES, CREDITO_IECE, INICIO_DE_ESTUDIOS, INSCRIPCION, CEDULA, APELLIDO_PATERNO, APELLIDO_MATERNO, NOMBRES, PROVINCIA_DE_NACIMIENTO, CANTON_DE_NACIMIENTO, FECHA_DE_NACIMIENTO, NUMERO_DE_MATRICULA, NACIONALIDAD, SEXO, E_MAIL, PASANTIAS, OBSERVACIONES, CREDITOS_DE_MALLA, TOTA_CREDITOS, ESTADO) values ( '".($codigoInstitucion)."','".($rsAlumnoMalla->fields['provincia'])."', '".($rsAlumnoMalla->fields['canton'])."','".( $rsAlumnoMalla->fields['parroquia'])."','".($rsAlumnoMalla->fields['canton'])."','". $rsAlumnoMalla->fields['direccion_suc']."','".($rsAlumnoMalla->fields['canton']." - ".$rsAlumnoMalla->fields['direccion_suc'])."','".($rsAlumnoMalla->fields['subarea_aun'])."','".($rsAlumnoMalla->fields['nivel'])."','".$modalidad."','".($organiz_cp)."','".($creditos)."','".($creditosFacturados)."','".($beca_completa)."','".($rsAlumnoMalla->fields['becaparcial'])."','".($ayuda_financiera)."','".($rsAlumnoMalla->fields['ies_alu'])."','".($rsAlumnoMalla->fields['iece_alu'])."','".($rsAlumnoMalla->fields['fecini_per'])."','".$rsAlumnoMalla->fields['fechaInscripcion_alu']."','".($rsAlumnoMalla->fields['codigoIdentificacion_alu'])."','".($rsAlumnoMalla->fields['apellidopaterno_alu'])."','".($rsAlumnoMalla->fields['apellidomaterno_alu'])."','".($rsAlumnoMalla->fields['nombre'])."','".($rsAlumnoMalla->fields['provinciaNac'])."','".($rsAlumnoMalla->fields['ciudadNac'])."','".($rsAlumnoMalla->fields['fecnac_alu'])."','".($matricula)."','".($rsAlumnoMalla->fields['nombre_nac'])."','".($generoEst)."','".($rsAlumnoMalla->fields['email'])."','".($pasantia)."','".($rsAlumnoMalla->fields['observacion_alu'])."','".($rsAlumnoMalla->fields['totalcreditos_maa'])."','".($rsAlumnoMalla->fields['creditomax_maa'])."','".($rsAlumnoMalla->fields['EstadoEstudiante'])."')";

//echo "</p>".$insert."</p>";
//$dblink->Execute($insert);
?>			
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
 /* if($rsAlumnoMalla->recordCount()>0){
  	$vector=funEstadistica($rsAlumnoMalla,$vecNivel);	

			$genero=$vector[0];
//			$mujeres=$vector[1];
			$alumnoXcarrera=$vector[1];
			$alumnoXseccion=$vector[2];
			
			
			$cuantos = (count($alumnoXcarrera,1)/count($alumnoXcarrera,0))-1; // cuantas filas tiene el vector	
	}		*/
			
		/*for($j=0;$j<=$cuantos;$j++){
			echo "</p> Ca-> ".$alumnoXcarrera[1][$j];//Carrera
			echo " - Al-> ".$alumnoXcarrera[2][$j];//Total Alumnos x carrera
			echo " ---------- H-> ".$alumnoXcarrera[3][$j]; //hombres x carrera
			echo " - M-> ".$alumnoXcarrera[4][$j];//mujereres x carrera
		}*/
			
//			echo $hombres

  ?>
  </p>
 <!-- 
  <p>&nbsp;</p>
<div class="demo">

<div id="accordion">
	<h3><a href="#">Alumnos Unesco</a></h3>
	<div>
		<p>
	  <table>
  <tr>
  	<td>￬</td>
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
	<td><?php echo "<a href='omnisoftmtn.php?bandera=C&serial_car=".$alumnoXcarrera[1][$j]."&fecha_ini=".$fecha_ini."&serial_suc=".$serial_suc."&serial_sec=".$serial_sec."&fecha_fin=".$fecha_fin."' target='_blank'>"."VER </a>"; //Sub Area Unesco a bandera le asigna C para filtrar por sub areas ?></td>
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
	 <td>￬</td>
	<td>Nivel</td>
 	<td>Hombres</td>
	<td>Mujeres</td>
	<td>Total Nivel</td>
 </tr>
 
 <?php for($y=0;$y<count($vecNivel);$y++){?>
	 <tr>
 		<td><?php echo "<a href='omnisoftmtn.php?bandera=N&nivel=".$alumnoXseccion[1][$y]."&fecha_ini=".$fecha_ini."&serial_suc=".$serial_suc."&serial_sec=".$alumnoXseccion[5][$y]."&fecha_fin=".$fecha_fin."' target='_blank'>"."VER </a>"; //Sub Area Unesco bandera con N filtra por niveles?></td>
		<td><?php echo $alumnoXseccion[1][$y]; //NIVEL?></td>
 		<td><?php echo $alumnoXseccion[3][$y]; //HOMBRES NIVEL?></td>
		<td><?php echo $alumnoXseccion[4][$y]; //MUJERES NIVEL?></td>
		<td><?php if(($alumnoXseccion[4][$y] + $alumnoXseccion[3][$y])<>0) echo $alumnoXseccion[4][$y] + $alumnoXseccion[3][$y]; //TOTAL?>		</td>
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


 

<?php echo $rsAlumnoMalla->fields['iece_alu'];?>
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



function funCreditos($malla, $alumno,$carrera,$periodoHasta){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
		$creditos=0;	
		$matricula=0;		
		//Para la obtencion de la matricula
		
		$sqlMatricula="select fecini_per,materiamatriculada.SERIAL_MMAT from materiamatriculada, detallemateriamatriculada, alumnomalla,malla,periodo where 
						materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu 
						and detallemateriamatriculada.serial_mmat=materiamatriculada.SERIAL_MMAT and 
						alumnomalla.serial_maa=malla.serial_maa and malla.serial_maa=".$malla." and alumnomalla.serial_alu=".$alumno."
						and materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu
						and malla.serial_sec=materiamatriculada.SERIAL_SEC
						and periodo.serial_per=materiamatriculada.SERIAL_PER".$periodoHasta."
						group by materiamatriculada.SERIAL_MMAT
						order by fecini_per desc";
						
		//echo "</p> MATRICULA 1 ".$sqlMatricula;
						
		 $rsMatricula=$dblink->Execute($sqlMatricula);	
		 if($rsMatricula->recordCount()>0) $matricula=$rsMatricula->fields['SERIAL_MMAT'];

		//echo "</p> numero MATRICULA 1 ".$matricula;
			
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
				maa.serial_car = ".$carrera." AND
				ama.serial_alu = ".$alumno;	
				
//	echo "</p> MATerias 2 ".$sqlMateriaXmalla."</p>";
				// maa.serial_car=$carrera  and
				//maa.serial_maa = ".$malla." AND
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
							dmat.serial_mat,
							dmat.serial_dmat
						FROM
							materiamatriculada        AS mmat,
							detallemateriamatriculada AS dmat,
							notasalumnos              AS nal,
							horario 				  as hrr,
							periodo 				  as per  
						WHERE
							mmat.serial_mmat = dmat.serial_mmat AND
							dmat.serial_dmat = nal.serial_dmat AND
							hrr.SERIAL_HRR=dmat.serial_hrr AND
							per.serial_per=mmat.SERIAL_PER and 
							estado_nal LIKE 'APRUEBA' AND 	
							seccion_hrr <> 'UBICACION' AND
							dmat.serial_mat = ".$rsMateriaXmalla->fields['serial_mat']." AND
							mmat.serial_alu=".$alumno.$periodoHasta;
						
						//echo "</p> MATRICULDAS:  ".$sqlmateriasXalumno."</p>";						
				
						$rsmateriasXalumno = $dblink->Execute($sqlmateriasXalumno);
						if($rsmateriasXalumno->recordCount()>0){					
							while(!$rsmateriasXalumno->EOF){
									//$creditos =	 $creditos + $rsmateriasXalumno->fields['creditos'];
									$creditos =	 $creditos +  $rsMateriaXmalla->fields['numerocreditos_dma'];
									
							//		echo $rsMateriaXmalla->fields['serial_mat']." -> A ".$alumno." ->C ".$rsmateriasXalumno->fields['creditos'];
									//echo "</p> Creditos m1 ".$creditos;
								//$matricula=$rsmateriasXalumno->fields['SERIAL_MMAT'];
								
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
							
							//echo "HOMOLOGADAS".$sqlmateriasHomologadas."</p>";						
							
							$rsmateriasHomologadas = $dblink->Execute($sqlmateriasHomologadas);
							if($rsmateriasHomologadas->recordCount()>0){						
								while(!$rsmateriasHomologadas->EOF){
										$creditos =	 $creditos + $rsMateriaXmalla->fields['numerocreditos_dma'];
										//echo "</p> Creditos H ".$creditos;
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
			
			//echo "Total".$creditos;
			//			echo "</p>";
			/*******PASANTIAS***********/
			$sqlPasantia="select nombre_dad,reg.entregado_rgra
							from alumnomalla as ama, requisitosgraduacion as reg, documentosadmision as dad
							where ama.serial_ama=reg.serial_ama
							and reg.serial_dad=dad.serial_dad
							and nombre_dad like '%pasantia%'
							and ama.serial_maa = ".$malla."
							and serial_alu = ".$alumno;
							
			$rsPasantia = $dblink->Execute($sqlPasantia);					
			
			if($rsPasantia->recordCount()>0)
				$pasantia=$rsPasantia->fields['entregado_rgra'];
			else
				$pasantia='NO';		
				
			/*******CONVALIDACIONES***********/
			$sqlconvalidacion="select min(fecha_hom) as fecha from homologacion where serial_alu = ".$alumno." and serial_car=".$carrera." and tipo_hom like 'REVALIDACION'";
							
						
			//echo "</p>".$sqlconvalidacion;				
			$rsConvalidacion = $dblink->Execute($sqlconvalidacion);					
			
			if($rsConvalidacion->recordCount()>0){
				$convalidacion[0]=$rsConvalidacion->fields['fecha'];				
				}
			else{
				$convalidacion[0]='NO APLICA';
				
				}		
				
				
			/*************SUMA LOS CREDITOS DE LOS REQUISITOS****************/
			/*$sqlCreditosRequisitos="select  sum(ncreditos) as creditos
									from alumnomalla as ama, requisitosgraduacion as reg
									, documentosadmision as dad   
									where ama.serial_ama=reg.serial_ama
									and reg.serial_dad=dad.serial_dad    
									AND aplicacredito = 'SI' 
									and entregado_rgra like 'SI'
									and serial_alu =  ".$alumno."
									and ama.serial_maa = ".$malla."
									group by serial_alu";	*/
			////and entregado_rgra like 'SI'						
			//$rsCreditosRequisitos = $dblink->Execute($sqlCreditosRequisitos);					
		/*	creditos de los requisitos
		
			if($rsCreditosRequisitos->recordCount()>0)
				$creditos= $creditos+$rsCreditosRequisitos->fields['creditos'];			
			*/
		//echo "</p> Creditos FINAL".$creditos;	
		
	//	echo "</p> Creditos FINAL ".$sqlCreditosRequisitos;	
		
	$vector = array($creditos, $matricula, $pasantia,$convalidacion);		
	//echo $vector[0];
	return $vector; 
}






function funCreditosFacturados($malla, $alumno,$carrera){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;
		$creditos=0;	
		$matricula=0;		
		//Para la obtencion de la matricula
		
		$sqlMatricula="select fecini_per,SERIAL_MMAT from materiamatriculada,alumnomalla,malla,periodo where 
						materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu 
						and  alumnomalla.serial_maa=malla.serial_maa and malla.serial_maa=".$malla." and alumnomalla.serial_alu=".$alumno."
						and materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu
						and malla.serial_sec=materiamatriculada.SERIAL_SEC
						and periodo.serial_per=materiamatriculada.SERIAL_PER
						order by fecini_per desc";
						
	//	echo "</p> MATRICULA 1 ".$sqlMatricula;
						
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
				maa.serial_car = ".$carrera." AND
				ama.serial_alu = ".$alumno;	
				
	//echo "</p> MATerias 2 ".$sqlMateriaXmalla."</p>";
				// maa.serial_car=$carrera  and
				//maa.serial_maa = ".$malla." AND
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
							dmat.serial_mat,
							dmat.serial_dmat
						FROM
							materiamatriculada        AS mmat,
							detallemateriamatriculada AS dmat,							
							horario as hrr  
						WHERE
							mmat.serial_mmat = dmat.serial_mmat AND

							hrr.SERIAL_HRR=dmat.serial_hrr AND
							dmat.retiromateria_dmat <> 'SIN COSTO' and 
							seccion_hrr <> 'UBICACION' AND
							dmat.serial_mat = ".$rsMateriaXmalla->fields['serial_mat']." AND
							mmat.serial_alu=".$alumno;
						
						//echo "</p> creditos 3 ".$sqlmateriasXalumno."</p>";						
				
						$rsmateriasXalumno = $dblink->Execute($sqlmateriasXalumno);
						if($rsmateriasXalumno->recordCount()>0){					
							while(!$rsmateriasXalumno->EOF){
									//$creditos =	 $creditos + $rsmateriasXalumno->fields['creditos'];
									$creditos =	 $creditos +  $rsMateriaXmalla->fields['numerocreditos_dma'];
									
							//		echo $rsMateriaXmalla->fields['serial_mat']." -> A ".$alumno." ->C ".$rsmateriasXalumno->fields['creditos'];
						//			echo "</p> Creditos m1 ".$creditos;
								//$matricula=$rsmateriasXalumno->fields['SERIAL_MMAT'];
								
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
							
//							hom.tipo_hom <> 'REVALIDACION' and
							//echo $sqlmateriasHomologadas."</p>";						
							$rsmateriasHomologadas = $dblink->Execute($sqlmateriasHomologadas);
							if($rsmateriasHomologadas->recordCount()>0){						
								while(!$rsmateriasHomologadas->EOF){
										$creditos =	 $creditos + $rsMateriaXmalla->fields['numerocreditos_dma'];
										//echo "</p> Creditos H ".$creditos;
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
			
			//echo "Total".$creditos;
			//			echo "</p>";
			/*******PASANTIAS***********/
			$sqlPasantia="select nombre_dad,reg.entregado_rgra
							from alumnomalla as ama, requisitosgraduacion as reg, documentosadmision as dad
							where ama.serial_ama=reg.serial_ama
							and reg.serial_dad=dad.serial_dad
							and nombre_dad like '%pasantia%'
							and ama.serial_maa = ".$malla."
							and serial_alu = ".$alumno;
							
			$rsPasantia = $dblink->Execute($sqlPasantia);					
			
			if($rsPasantia->recordCount()>0)
				$pasantia=$rsPasantia->fields['entregado_rgra'];
			else
				$pasantia='NO';		
				
				
				
			/*************SUMA LOS CREDITOS DE LOS REQUISITOS****************/
			$sqlCreditosRequisitos="select  sum(ncreditos) as creditos
									from alumnomalla as ama, requisitosgraduacion as reg
									, documentosadmision as dad   
									where ama.serial_ama=reg.serial_ama
									and reg.serial_dad=dad.serial_dad    
									AND aplicacredito = 'SI' 
									and entregado_rgra like 'SI'
									and serial_alu =  ".$alumno."
									and ama.serial_maa = ".$malla."
									group by serial_alu";	
			////and entregado_rgra like 'SI'						
			$rsCreditosRequisitos = $dblink->Execute($sqlCreditosRequisitos);					
		/*	creditos de los requisitos
		
			if($rsCreditosRequisitos->recordCount()>0)
				$creditos= $creditos+$rsCreditosRequisitos->fields['creditos'];			
			*/
//		echo "</p> Creditos FINAL".$creditos;	
		
	//	echo "</p> Creditos FINAL ".$sqlCreditosRequisitos;	
		
	$vector = array($creditos, $matricula, $pasantia);		
	//echo $vector[0];
	return $vector; 
}
function funBecas($serial_alu,$periodo){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;

	$becaCompleta="SELECT
    caf.serial_caf,
	caf.serial_alu,
	caf.serial_per,
	caf.serial_mmat,caf.fecha_caf,caf.estado_caf,numero_caf
FROM
	cabecerafactura AS caf,
	detallefactura  AS dfa,
	detallearancel  AS dar 
WHERE
	caf.serial_caf=dfa.serial_caf AND
	dfa.serial_dar = dar.serial_dar AND
	dar.serial_dar = 412 AND
	caf.serial_alu = ".$serial_alu." AND
	caf.serial_mmat IN(
                        SELECT
                            serial_mmat 
                        FROM
                            materiamatriculada AS mmat,
                            periodo             AS per 
                        WHERE
                            mmat.SERIAL_PER=per.serial_per".$periodo.") 
      AND estado_caf <> 'ANULADO'";
						//echo "</p>".$becaCompleta;
						$rsbecaCompleta = $dblink->Execute($becaCompleta);
						if($rsbecaCompleta->recordCount()>0){	
							$tieneBecaCmpleta = "SI";
							//while(!$rsbecaCompleta->EOF){
									//$creditos =	 $creditos + $rsmateriasXalumno->fields['creditos'];
									//$creditos =	 $creditos +  $rsMateriaXmalla->fields['numerocreditos_dma'];
									
							//		echo $rsMateriaXmalla->fields['serial_mat']." -> A ".$alumno." ->C ".$rsmateriasXalumno->fields['creditos'];
						//			echo "</p> Creditos m1 ".$creditos;
								//$matricula=$rsmateriasXalumno->fields['SERIAL_MMAT'];
								
							//$rsbecaCompleta->MoveNext();
							
							//}
						}else{
							$tieneBecaCmpleta = "NO";
						}
										
		return $tieneBecaCmpleta;								

}

function funJornada($malla, $alumno,$periodo){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;

	$jornada="SELECT
	fecini_per,
	materiamatriculada.SERIAL_MMAT,
	horario.seccion_hrr 
FROM
	materiamatriculada,
	alumnomalla,
	malla,
	periodo,
	detallemateriamatriculada,
	horario 
WHERE
	materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu AND
	detallemateriamatriculada.serial_mmat=materiamatriculada.SERIAL_MMAT AND
	detallemateriamatriculada.serial_hrr=horario.SERIAL_HRR AND
	alumnomalla.serial_maa=malla.serial_maa AND
	malla.serial_maa=".$malla." AND
	alumnomalla.serial_alu=".$alumno." AND
	materiamatriculada.SERIAL_ALU=alumnomalla.serial_alu AND
	malla.serial_sec=materiamatriculada.SERIAL_SEC AND
	periodo.serial_per=materiamatriculada.SERIAL_PER ".$periodo."
group by seccion_hrr
ORDER BY
	fecini_per DESC";
	
	
							//echo "</p> ".$jornada;
						$rsjornada = $dblink->Execute($jornada);
						if($rsjornada->recordCount()>1){	
							$jornadaEstudios = "OTROS";
							
						}else{
							$jornadaEstudios = $rsjornada->fields['seccion_hrr'];
						}
										
		return $jornadaEstudios;								

}

?>


