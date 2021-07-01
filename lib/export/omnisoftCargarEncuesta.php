<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
session_start();  

$sw = 0;
if ($_REQUEST["action"] == "save") {
	//Generar el insert de la encuesta	
	$rsEncuesta = array(); 
	$sqlEncuesta = "
		SELECT
			* 
		FROM
			seguimientograduado 
		WHERE
			serial_seg = -1
	";	
	$rsEncuesta = $dblink->Execute($sqlEncuesta); 

	$arr = $_SESSION['enc'];
		//Validar la actualización en la tabla alumno
	if(strlen($arr['direcciondomic_alu'])<=0){
		$direccion = "";
	}else{
		$direccion = "direcciondomic_alu = '".$arr['direcciondomic_alu']."',";
	}
	if(strlen($arr['mail_alu'])<=0){
		$mail = "";
	}else{
		$mail = "mail_alu = '".$arr['mail_alu']."',";
	}
	if(strlen($arr['telefodomic_alu'])<=0){
		$telefonoLocal = "";
	}else{
		$telefonoLocal = "telefodomic_alu = '".$arr['telefodomic_alu']."',";
	}
	if(strlen($arr['celular_alu'])<=0){
		$telefonoCelular = "";
	}else{
		$telefonoCelular = "celular_alu = '".$arr['celular_alu']."',";
	}
	$sqlUpdAlumno = "
		UPDATE
			alumno 
		SET
			".$direccion."
			".$mail."
			".$telefonoLocal."
			".$telefonoCelular."
			serial_eci = '".$arr['serial_eci']."'
		WHERE
			serial_alu = ".$arr['serial_alu']."	
	";
	//echo "<br>SQLUPD: ".$sqlUpdAlumno;
	$aluUpd = $dblink->Execute($sqlUpdAlumno); 
	if(!isset($aluUpd)){
		echo "<br>Problemas con la actualización en la tabla base Alumnos...<br>";
	}else{
		$sqlInsert = $dblink->GetInsertSQL($rsEncuesta,$arr);
		$ok = $dblink->Execute($sqlInsert); 
		if(!isset($ok)){
			echo "<br>Problemas con la inserción en la tabla seguimiento graduado...<br>";
		}else{
			//echo "<br>MENSAJE SIFA: La encuesta se importó correctamente...<br>";
			echo "<script>alert('MENSAJE SIFA: La encuesta se importó correctamente...');window.close();</script>";
		}
	}
	$sw = 1;	
}


//Set Ubicacion de Encuesta
$destino = "../../encuestas/";
$nombre = $_GET['arch'];
if(isset($nombre)){	
	$file = $destino.$nombre;
	//Read el archivo
	include('../server/excel_reader2.php');
	$excel_reader = new Spreadsheet_Excel_Reader();
	$excel_reader->read($file);
	//Validacion Modificacion
	$row = $excel_reader->sheets[0]['numRows'];
	$column = $excel_reader->sheets[0]['numCols'];
	if ($row != 428 or $column != 3){
		echo "<br>Filas o Columnas modificadas, Favor revisar archivo Excel...";
	}
	$data = new Spreadsheet_Excel_Reader($file);
	//Identificacion en la Bd
	$serial_alu = $excel_reader->sheets[0]['cells'][2][3];	
	$sqlAlumno = "
		SELECT
			serial_alu,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,
			nombre2_alu) AS nombre 
		FROM
			alumno 
		WHERE
			serial_alu = ".$serial_alu."
	";
	$alumno = $dblink->Execute($sqlAlumno); 
	if(empty($alumno)){
		echo "<br>MENSAJE SIFA: <br> No se puede obtener  el código del alumno en el Archivo Excel: <strong>".$nombre."</strong><br> Verifique el campo Código entrevista en el archivo de la encuesta...";
		//echo "<script>alert('MENSAJE SIFA: No se puede obtener en el excel el código del alumno...');window.close();<script>";
		$sw = 1;
	}else{
		$arrAlumno = $dblink->GetAll($sqlAlumno);			
		$encuesta['serial_alu'] = $arrAlumno[0]['serial_alu']; 
		$encuesta['nombre'] = $arrAlumno[0]['nombre']; 
	}
	//Cargar los datos basicos 
	$encuesta['direcciondomic_alu'] =  addslashes(trim($excel_reader->sheets[0]['cells'][4][3]));	
	$encuesta['mail_alu'] =  addslashes(trim($excel_reader->sheets[0]['cells'][5][3]));	
	$encuesta['telefodomic_alu'] =  addslashes(trim($excel_reader->sheets[0]['cells'][6][3]));	
	$encuesta['celular_alu'] =  addslashes(trim($excel_reader->sheets[0]['cells'][7][3]));	
	$encuesta['serial_eci'] =  addslashes(trim($excel_reader->sheets[0]['cells'][8][3]));	
	switch($encuesta['serial_eci']){
		case 'SOLTERO':
			$encuesta['serial_eci'] = 1;	
			break;
		case 'CASADO':
			$encuesta['serial_eci'] = 2;	
			break;
		case 'VIUDO':
			$encuesta['serial_eci'] = 5;	
			break;
		case 'DIVORCIADO':
			$encuesta['serial_eci'] = 3;	
			break;
		case 'UNION LIBRE':
			$encuesta['serial_eci'] = 4;	
			break;
		default: 
			$encuesta['serial_eci'] = 6;		
	}
	$fecha_actual = date("Y")."-".date("m")."-".date("d");	
	list($year,$mon,$day) = explode('-',$fecha_actual);
	$fecha_final = date('Y-m-d',mktime(0,0,0,$mon,$day,$year+1));
	//Cargar los datos de la encuesta
	$encuesta['tipoencuestaanterior_seg'] = "PRIMERA";
	$encuesta['fechaencuesta_seg'] = $fecha_actual;
	$encuesta['fechaencuestaant_seg'] = $fecha_final;
	$encuesta['tiempoEncuesta_seg'] = "";
	$encuesta['tiempotardoprimertrabajodgraduado_seg'] = repCad($excel_reader->sheets[0]['cells'][11][3]);
	$encuesta['tiempotardoprimeremprendgraduado_seg'] = repCad($excel_reader->sheets[0]['cells'][12][3]);
	$encuesta['ingresoanualalprimeraniograduado_seg'] = repCad($excel_reader->sheets[0]['cells'][13][3]);
	$encuesta['montosalarialprimertrabajodgraduado_seg'] = repCad($excel_reader->sheets[0]['cells'][14][3]);	
	$encuesta['relacionDependencia_seg'] = repCad($excel_reader->sheets[0]['cells'][17][3]);
	switch($encuesta['relacionDependencia_seg']){
		case 'EMPLEADO/PROPIETARIO':			
			//PROPIETARIO
			//parte A
			$encuesta['aniosEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][21][3]);
			$encuesta['nEmpresasInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][22][3]);
			$encuesta['nEmpresasActual_seg'] = repCad($excel_reader->sheets[0]['cells'][23][3]);
			$encuesta['nEmpleadosInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][24][3]);
			$encuesta['nEmpleadosActual_seg'] = repCad($excel_reader->sheets[0]['cells'][25][3]);
			$encuesta['rVentasEmpresaInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][26][3]);
			$encuesta['rVentasEmpresaActual_seg'] = repCad($excel_reader->sheets[0]['cells'][27][3]);
			$encuesta['ventasHanVenido_seg'] = repCad($excel_reader->sheets[0]['cells'][28][3]);
			$encuesta['tasaCrecimientoActivos_seg'] = repCad($excel_reader->sheets[0]['cells'][29][3]);
			$encuesta['rangoCrecimientoActivos_seg'] = repCad($excel_reader->sheets[0]['cells'][30][3]);
			$encuesta['nivelContactoEmpresarial_seg'] = repCad($excel_reader->sheets[0]['cells'][31][3]);
			$encuesta['nivelContactoRedesVienen_seg'] = repCad($excel_reader->sheets[0]['cells'][32][3]);
			$encuesta['nInstitucionesAlianzas_seg'] = repCad($excel_reader->sheets[0]['cells'][33][3]);
			$encuesta['apoyoInstitucional_seg'] = repCad($excel_reader->sheets[0]['cells'][34][3]);
			$encuesta['apoyoInstitucionalDesde_seg'] = repCad($excel_reader->sheets[0]['cells'][35][3]);
			$encuesta['apoyoInsitucionalConsiste_seg'] = repCad($excel_reader->sheets[0]['cells'][36][3]);
			$encuesta['esAccionista_seg'] = repCad($excel_reader->sheets[0]['cells'][37][3]);
			$encuesta['porcentajeAccion_seg'] = repCad($excel_reader->sheets[0]['cells'][38][3]);
			$encuesta['formaJuridica_seg'] = repCad($excel_reader->sheets[0]['cells'][39][3]);
			$encuesta['logoEmpresaWebUpac_seg'] = repCad($excel_reader->sheets[0]['cells'][40][3]);
			$encuesta['nombreEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][41][3]);
			$encuesta['direccionEmpresa_seg'] = $excel_reader->sheets[0]['cells'][42][3];
			$encuesta['telefonoEmpresa_seg'] = $excel_reader->sheets[0]['cells'][43][3];
			$encuesta['ciudadEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][44][3]);
			//PARTE B
			$encuesta['nSociosFundadoresInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][47][3]);
			$encuesta['nSociosFundadoresActual_seg'] = repCad($excel_reader->sheets[0]['cells'][48][3]);
			$encuesta['actividadComercialInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][49][3]);
			$encuesta['actividadComercialActual_seg'] = repCad($excel_reader->sheets[0]['cells'][50][3]);
			$encuesta['tPropuestaInicial_seg'] = repCad($excel_reader->sheets[0]['cells'][51][3]);
			$encuesta['tPropuestaActual_seg'] = repCad($excel_reader->sheets[0]['cells'][52][3]);
			$encuesta['tClientesInicio_seg'] = repCad($excel_reader->sheets[0]['cells'][53][3]);
			$encuesta['tClientesActual_seg'] = repCad($excel_reader->sheets[0]['cells'][54][3]);
			$encuesta['experienciaLaboral_seg'] = repCad($excel_reader->sheets[0]['cells'][55][3]);
			$encuesta['fuenteOportunidadNegocio_seg'] = repCad($excel_reader->sheets[0]['cells'][56][3]);
			$encuesta['fuenteFinanciamiento_seg'] = repCad($excel_reader->sheets[0]['cells'][57][3]);
			$encuesta['interesadoPasantias_seg'] = repCad($excel_reader->sheets[0]['cells'][58][3]);
			$encuesta['interesadoMentor_seg'] = repCad($excel_reader->sheets[0]['cells'][59][3]);
			$encuesta['documentarEmpresaCNegocio_seg'] = repCad($excel_reader->sheets[0]['cells'][60][3]);
			$encuesta['asociacionGraduados_seg'] = repCad($excel_reader->sheets[0]['cells'][61][3]);
			$encuesta['sugerenciaAsociacion_seg'] = $excel_reader->sheets[0]['cells'][62][3];
			$encuesta['productosNuevos_seg'] = $excel_reader->sheets[0]['cells'][63][3];
			$encuesta['opinionDeUniversidad_seg'] = $excel_reader->sheets[0]['cells'][64][3];
			$encuesta['publicidadUpacEnEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][65][3]);
			$encuesta['testimonioEmpresaUpac_seg'] = repCad($excel_reader->sheets[0]['cells'][66][3]);
			//EMPLEADO
			$encuesta['aniosTrabajandoEmpresa_seg'] = "";
			$encuesta['nEmpresasLaborado_seg'] = "";
			$encuesta['tipoMando_seg'] = "";
			$encuesta['areaAporteEmpleado_seg'] = "";
			$encuesta['nproyectosDiversificacionEmpresa_seg'] = "";
			$encuesta['frecuenciaInnovaciones_seg'] = "";
			$encuesta['aportadoDiversificacion_seg'] = "";
			$encuesta['nProyectosAmpliacion_seg'] = "";
			$encuesta['impactoGeneracionEmpleo_seg'] = "";
			$encuesta['puestosGenerados_seg'] = "";
			$encuesta['creceVentas_seg'] = "";
			$encuesta['aporteIncrementoVentas_seg'] = "";
			$encuesta['nproyectosAmpliacionMercado_seg'] = "";
			$encuesta['frecuenciaPropuestaNuevoMercado_seg'] = "";
			$encuesta['aporteExpansionMercado_seg'] = "";
			$encuesta['tiempoConseguirEmpleo_seg'] = "";
			break;			
		case 'RELACION DE DEPENDENCIA':
			//PROPIETARIO
			//parte A
			$encuesta['aniosEmpresa_seg'] = "";
			$encuesta['nEmpresasInicio_seg'] = "";
			$encuesta['nEmpresasActual_seg'] = "";
			$encuesta['nEmpleadosInicio_seg'] = "";
			$encuesta['nEmpleadosActual_seg'] = "";
			$encuesta['rVentasEmpresaInicio_seg'] = "";
			$encuesta['rVentasEmpresaActual_seg'] = "";
			$encuesta['ventasHanVenido_seg'] = "";
			$encuesta['tasaCrecimientoActivos_seg'] = "";
			$encuesta['rangoCrecimientoActivos_seg'] = "";
			$encuesta['nivelContactoEmpresarial_seg'] = "";
			$encuesta['nivelContactoRedesVienen_seg'] = "";
			$encuesta['nInstitucionesAlianzas_seg'] = "";
			$encuesta['apoyoInstitucional_seg'] = "";
			$encuesta['apoyoInstitucionalDesde_seg'] = "";
			$encuesta['apoyoInsitucionalConsiste_seg'] = "";
			$encuesta['esAccionista_seg'] = "";
			$encuesta['porcentajeAccion_seg'] = "";
			$encuesta['formaJuridica_seg'] = "";
			$encuesta['logoEmpresaWebUpac_seg'] = "";
			$encuesta['nombreEmpresa_seg'] = "";
			$encuesta['direccionEmpresa_seg'] = "";
			$encuesta['telefonoEmpresa_seg'] = "";
			$encuesta['ciudadEmpresa_seg'] = "";
			//PARTE B
			$encuesta['nSociosFundadoresInicio_seg'] = "";
			$encuesta['nSociosFundadoresActual_seg'] = "";
			$encuesta['actividadComercialInicio_seg'] = "";
			$encuesta['actividadComercialActual_seg'] = "";
			$encuesta['tPropuestaInicial_seg'] = "";
			$encuesta['tPropuestaActual_seg'] = "";
			$encuesta['tClientesInicio_seg'] = "";
			$encuesta['tClientesActual_seg'] = "";
			$encuesta['experienciaLaboral_seg'] = "";
			$encuesta['fuenteOportunidadNegocio_seg'] = "";
			$encuesta['fuenteFinanciamiento_seg'] = "";
			$encuesta['interesadoPasantias_seg'] = "";
			$encuesta['interesadoMentor_seg'] = "";
			$encuesta['documentarEmpresaCNegocio_seg'] = "";
			$encuesta['asociacionGraduados_seg'] = "";
			$encuesta['sugerenciaAsociacion_seg'] = "";
			$encuesta['productosNuevos_seg'] = "";
			$encuesta['opinionDeUniversidad_seg'] = "";
			$encuesta['publicidadUpacEnEmpresa_seg'] = "";
			$encuesta['testimonioEmpresaUpac_seg'] = "";
			//EMPLEADO
			$encuesta['aniosTrabajandoEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][69][3]);
			$encuesta['nEmpresasLaborado_seg'] = repCad($excel_reader->sheets[0]['cells'][70][3]);
			$encuesta['tipoMando_seg'] = repCad($excel_reader->sheets[0]['cells'][71][3]);
			$encuesta['areaAporteEmpleado_seg'] = repCad($excel_reader->sheets[0]['cells'][72][3]);
			$encuesta['nproyectosDiversificacionEmpresa_seg'] = repCad($excel_reader->sheets[0]['cells'][73][3]);
			$encuesta['frecuenciaInnovaciones_seg'] = repCad($excel_reader->sheets[0]['cells'][74][3]);
			$encuesta['aportadoDiversificacion_seg'] = repCad($excel_reader->sheets[0]['cells'][75][3]);
			$encuesta['nProyectosAmpliacion_seg'] = repCad($excel_reader->sheets[0]['cells'][76][3]);
			$encuesta['impactoGeneracionEmpleo_seg'] = repCad($excel_reader->sheets[0]['cells'][77][3]);
			$encuesta['puestosGenerados_seg'] = repCad($excel_reader->sheets[0]['cells'][78][3]);
			$encuesta['creceVentas_seg'] = repCad($excel_reader->sheets[0]['cells'][79][3]);
			$encuesta['aporteIncrementoVentas_seg'] = repCad($excel_reader->sheets[0]['cells'][80][3]);
			$encuesta['nproyectosAmpliacionMercado_seg'] = repCad($excel_reader->sheets[0]['cells'][81][3]);
			$encuesta['frecuenciaPropuestaNuevoMercado_seg'] = repCad($excel_reader->sheets[0]['cells'][82][3]);
			$encuesta['aporteExpansionMercado_seg'] = repCad($excel_reader->sheets[0]['cells'][83][3]);
			$encuesta['tiempoConseguirEmpleo_seg'] = repCad($excel_reader->sheets[0]['cells'][84][3]);
			$encuesta['observacionesGenerales_seg'] = "MIGRADO AUTOMATICO";
			$encuesta['documentoEncuesta_seg']= repCad($nombre);
			break;			
	}
	$encuesta['observacionesGenerales_seg'] = "MIGRADO AUTOMATICO";
	$encuesta['documentoEncuesta_seg'] = repCad($nombre);
	$_SESSION['enc'] = $encuesta; 
}
?>

<html>
<head>
<script language="Javascript">
function save()
{
 ventana = confirm("Importar la encuesta a la base de datos");
 if (ventana) {
 	document.getElementById('action').value = "save"; 
	document.getElementById('main').submit(); 
 }
}
</script>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
<?php 
	if($sw == 0){		
	
?>
<form action="omnisoftCargarEncuesta.php" method="post" enctype="multipart/form-data" id="main" name="main">
<input name="action" type="hidden" value="" />
<input name="sql" type="hidden" value="" />

<table width="155" border="0">
  <tr>
    <td width="149"><input type="button" name="Submit2" value="IMPORTAR ENCUESTA" onClick="save()"></td>
 
  </tr>
 
</table>

<table class="excel" cellspacing=0><thead>
	<tr>
		<th>&nbsp</th>
		<th style="width:18.3985998687px;">A</th>
		<th style="width:558.43360315px;">B</th>
		<th style="width:330.430977904px;">C</th></tr></thead>
<tbody>

	<tr style="height:21px;">
		<th>1</th>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#333399;color:#FFFFFF;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:2px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;" colspan=3><nobr>DATOS DE SEGUIMIENTO GRADUADO</nobr></td></tr>

	<tr style="height:21px;">
		<th>2</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>C&oacute;digo Entrevista:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['serial_alu']."/".$encuesta['nombre'];?></nobr></td></tr>

	<tr style="height:21px;">
		<th>3</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>A</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>ACTUALIZAR DATOS BASICOS</nobr></td>
		<td style=""><nobr>&nbsp;</nobr></td></tr>


	<tr style="height:21px;">
		<th>4</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Direcci&oacute;n Domicilio:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['direcciondomic_alu'];?></nobr></td></tr>

	<tr style="height:21px;">
		<th>5</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>2</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Email Personal:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['mail_alu'];?></nobr></td>
	</tr>

	<tr style="height:21px;">
		<th>6</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>3</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tel&eacute;fono Local:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['telefodomic_alu']?></nobr></td></tr>

	<tr style="height:21px;">
		<th>7</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>4</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tel&eacute;fono Celular:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['celular_alu'];?></nobr></td></tr>	

	<tr style="height:21px;">
		<th>8</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>5</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Estado Civil:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['serial_eci'];?></nobr></td></tr>

	<tr style="height:21px;">
		<th>9</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>10</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>B</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>SEGUIMIENTO AL GRADUADO</nobr></td>
		<td style=""><nobr></nobr></td>
	</tr>

	<tr style="height:21px;">
		<th>11</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tiempo que tardo en conseguir su primer trabajo despues de graduado:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tiempotardoprimertrabajodgraduado_seg']; ?></nobr></td>
	</tr>

	<tr style="height:21px;">
		<th>12</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>2</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tiempo que le tardo organizar su primer emprendiemiento despues de graduado:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tiempotardoprimeremprendgraduado_seg']; ?></nobr></td>
	</tr>

	<tr style="height:21px;">
		<th>13</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>3</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Ingresos anuales al primer a&ntilde;o de graduado, o en el primer a&ntilde;o de su emprendimiento :</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><?php echo $encuesta['ingresoanualalprimeraniograduado_seg']; ?></td>
	</tr>

	<tr style="height:21px;">
		<th>14</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>4</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Monto Salarial en el primer trabajo luego de graduado :</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><?php echo $encuesta['montosalarialprimertrabajodgraduado_seg']; ?></td>
	</tr>

	<tr style="height:21px;">
		<th>15</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>16</th>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#333399;color:#FFFFFF;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;" colspan=3><nobr>ENCUESTA DE IMPACTO ACAD&Eacute;MICO PRODUCTIVO Y SOCIAL</nobr></td></tr>

	<tr style="height:21px;">
		<th>17</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Usted actualmente se desempe&ntilde;a como:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['relacionDependencia_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>18</th>
		<td style="font-family:Calibri;text-align:center;font-size:11px;background-color:#99CCFF;color:#003366;font-weight:bold;border-left:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-top-color:#000000;border-bottom-color:#000000;" colspan=3><nobr>NOTA: Si la respuesta ha sido EMPLEADO/PROPIETARIO procedase a llenar los apartados A y B. Si la respuesta ha sido Relaci&oacute;n de Dependencia proceda con el apartado C </nobr></td></tr>

	<tr style="height:21px;">
		<th>19</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>20</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>A</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>RENDIMIENTO EMPRESARIAL</nobr></td>
		<td style=""><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>21</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos a&ntilde;os tiene su empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['aniosEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>22</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>2</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantas empresas pose&iacute;a al inicio de su actividad como empresario:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nEmpresasInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>23</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>3</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantas empresas posee actualmente:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nEmpresasActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>24</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>4</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos Empleados tuvo su empresa o empresas en su comienzos:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nEmpleadosInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>25</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>5</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos Empleados tiene su empresa o empresas actualmente:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nEmpleadosActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>26</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>6</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cu&aacute;l era su rango promedio de ventas anuales  el primer a&ntilde;o de su actividad empresarial:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['rVentasEmpresaInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>27</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>7</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cu&aacute;l es su rango promedio de ventas anuales  actualmente:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['rVentasEmpresaActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>28</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>8</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Considera Usted que las ventas de su empresa han venido:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['ventasHanVenido_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>29</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>9</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>La tasa promedio de crecimiento de activos de su empresa es:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tasaCrecimientoActivos_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>30</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>10</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>El rango de crecimiento de sus activos se aproxima a: </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['rangoCrecimientoActivos_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>31</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>11</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Su nivel de contactos empresariales y redes o clusters es:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nivelContactoEmpresarial_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>32</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>12</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Su nivel de contactos empresariales y redes personales proviene de:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nivelContactoRedesVienen_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>33</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>13</nobr></td>

		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>El n&uacute;mero de instituciones con las que Usted mantiene alianzas estrat&eacute;gicas actualmente es de:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nInstitucionesAlianzas_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>34</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>14</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Usted ha recibido apoyo institucional:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['apoyoInstitucional_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>35</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>15</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Su apoyo institucional ha venido desde:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['apoyoInstitucionalDesde_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>36</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>16</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>En que consistio el apoyo institucional:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['apoyoInsitucionalConsiste_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>37</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>17</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Es usted Accionista de su empresa si es asi especifique con que porcentaje:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['esAccionista_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>38</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>18</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Porcentaje de Acci&oacute;n:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['porcentajeAccion_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>39</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>19</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Forma juridica del negocio o de la empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['formaJuridica_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>40</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>20</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Estar&iacute;a de acuerdo en que, en la pagina web de la Universidad del Pacifico se incluya el logo de su empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['logoEmpresaWebUpac_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>41</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>21</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Nombre de la Empresa:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['nombreEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>42</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>22</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Direccion:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['direccionEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>43</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>23</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tel&eacute;fono:</nobr></td>
		<td style=""><nobr><?php echo $encuesta['telefonoEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>44</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>24</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Ciudad:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['ciudadEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>45</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>46</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>B</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>CRITERIOS INFORMATIVOS GENERALES</nobr></td>
		<td style=""><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>47</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>N&uacute;mero de socios fundadores:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nSociosFundadoresInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>48</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>2</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>N&uacute;mero de socios actuales:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nSociosFundadoresActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>49</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>3</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Sector de actividad empresarial en sus or&iacute;genes:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['actividadComercialInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>50</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>4</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Sector o sectores de actividad empresarial actualmente:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['actividadComercialActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>51</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>5</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tipo de propuesta comercial en sus inicios:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tPropuestaInicial_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>52</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>6</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tipo de propuesta comercial actualmente:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tPropuestaActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>53</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>7</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tipo de clientes iniciales:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tClientesInicio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>54</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>8</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Tipo de clientes actuales:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tClientesActual_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>55</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>9</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Experiencia laboral previa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['experienciaLaboral_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>56</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>10</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Fuente de identificaci&oacute;n de la oportunidad  de negocios:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['fuenteOportunidadNegocio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>57</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>11</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Fuentes de financiamiento:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['fuenteFinanciamiento_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>58</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>12</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Est&aacute; interesado que estudiantes de la Universidad hagan pasant&iacute;as en su empresa:      </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['interesadoPasantias_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>59</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>13</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Est&aacute; interesado en ser MENTOR de estudiantes de la Universidad:  </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['interesadoMentor_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>60</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>14</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Est&aacute; interesado en Documentar como caso acad&eacute;mico su negocio:  </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['documentarEmpresaCNegocio_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>61</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>15</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Esta interesado en ser miembro de la Asociaci&oacute;n de Graduados: </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['asociacionGraduados_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>62</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>16</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Qu&eacute; sugerencias nos puede ofrecer para servicios de valor que podr&iacute;a brindarle dicha asociaci&oacute;n :   </nobr></td>
		<td style=""><nobr><?php echo $encuesta['sugerenciaAsociacion_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>63</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>17</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Productos nuevos que deba ofrecer la Universidad:   </nobr></td>
		<td style=""><nobr><?php echo $encuesta['productosNuevos_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>64</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>18</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Qu&eacute; opini&oacute;n tiene acerca de la campa&ntilde;a de la Universidad:  </nobr></td>
		<td style=""><nobr><?php echo $encuesta['opinionDeUniversidad_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>65</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>19</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Estar&iacute;a de acuerdo en tener publicidad de la Universidad en su empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['publicidadUpacEnEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>66</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>20</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Estar&iacute;a de acuerdo en que la publicidad de la Universidad salga su empresa o personal como testimonio: </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['testimonioEmpresaUpac_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>67</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#99CCFF;color:#000000;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>68</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>C</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;font-weight:bold;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>INTRAEMPRENDIMIENTO (Emprendimiento en Relaci&oacute;n de Dependencia)</nobr></td>
		<td style=""><nobr>&nbsp;</nobr></td></tr>

	<tr style="height:21px;">
		<th>69</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>1</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos a&ntilde;os tiene trabajando para su empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['aniosTrabajandoEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>70</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>2</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>En cuantas empresas a prestado sus servicios:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nEmpresasLaborado_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>71</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>3</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cu&aacute;l es su nivel jer&aacute;rquico equivalente en la empresa en la que presta sus servicios:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tipoMando_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>72</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>4</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>En que &aacute;rea considera su aporte a la organizacion en la que trabaja:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['areaAporteEmpleado_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>73</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>5</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos proyectos o propuestas de innovaci&oacute;n / diversificaci&oacute;n en su &aacute;rea de trabajo a generado para la empresa en la que  trabaja:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nproyectosDiversificacionEmpresa_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>74</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>6</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Con que frecuenciapresenta Usted Innovaciones en procesos, m&eacute;todos o sistemas: </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['frecuenciaInnovaciones_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>75</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>7</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Considera Usted que ha aportado a la diversificaci&oacute;n de producto / servicio o la apertura de nuevas propuestas comerciales:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['aportadoDiversificacion_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>76</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>8</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos proyectos o propuestas de amplaci&oacute;n / diversificaci&oacute;n ha presentado a su organizaci&oacute;n:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nProyectosAmpliacion_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>77</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>9</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Considera Usted que el impacto de su labor se ha reflejado en la generac&iacute;on de empleo en su organizaci&oacute;n:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['impactoGeneracionEmpleo_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>78</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>10</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos  puestos de trabajo que se han generado a trav&eacute;s de su aporte como empleado a la empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['puestosGenerados_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>79</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>11</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Considera Usted que las ventas de su empresa se han incrementado gracias a su aporte:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['creceVentas_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>80</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>12</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>El aporte que Usted ha brindado a su organizaci&oacute;n se ha reflejado en las ventas a un promedio anual de incremento de: </nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['aporteIncrementoVentas_seg']; ?></nobr></td></tr>

	<tr style="height:42px;">
		<th>81</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>13</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Cuantos proyectos o propuestas de exportaci&oacute;n / ampliaci&oacute;n de mercado en su &aacute;rea de trabajo ha generado para la empresa en la que  trabaja</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['nproyectosAmpliacionMercado_seg']; ?></nobr></td></tr>

	<tr style="height:21px;">
		<th>82</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>14</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Con que frecuencia presenta Usted propuestas de nuevos mercados para la empresa:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><?php echo $encuesta['frecuenciaPropuestaNuevoMercado_seg']; ?><nobr></nobr></td>
	</tr>

	<tr style="height:42px;">
		<th>83</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>15</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Considera Usted que ha aportado al crecimiento y expansi&oacute;n de mercado de la empresa en la que trabaja:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['aporteExpansionMercado_seg']; ?></nobr></td>
	</tr>

	<tr style="height:22px;">
		<th>84</th>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:2px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>16</nobr></td>
		<td style="font-family:Calibri;font-size:12px;background-color:#99CCFF;color:#000000;border-left:1px solid;border-right:1px solid;border-top:1px solid;border-bottom:2px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr>Que tiempo se tardo en conseguir su &uacute;ltimo empleo:</nobr></td>
		<td style="font-family:Calibri;text-align:center;font-size:12px;background-color:#FFFFFF;color:#000000;font-weight:bold;border-left:1px solid;border-right:2px solid;border-top:1px solid;border-bottom:2px solid;border-left-color:#000000;border-right-color:#000000;border-top-color:#000000;border-bottom-color:#000000;"><nobr><?php echo $encuesta['tiempoConseguirEmpleo_seg']; ?></nobr></td></tr>

	<tr style="height:0px;">
		<th>85</th>
		<td style=""><nobr>&nbsp;</nobr></td>
		<td style=""><nobr>&nbsp;</nobr>
		  <label>
		  <input type="button" name="Submit" value="IMPORTAR ENCUESTA" onClick="save()">
	    </label></td>
		<td style=""><nobr>&nbsp;</nobr></td></tr>
</tbody></table>
</form>
<?php 
}
?>
</body>
</html>
<?php
function repCad($cad){ 
    $cad = strtolower($cad); 
    $b = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ","'"); 
    $c = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","ni","."); 
    $cad = str_replace($b,$c,$cad);
	$cad = strtoupper($cad);
    return $cad; 
}  

?>
