<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//Parametros Globales
$arrMainPrior = 
	array
	(
		0	=>	"DOCTORADO",
		1	=>	"MAGISTER",
		2	=>	"IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		3	=>	"ESPECIALISTA",
		4	=>	"DIPLOMADO",
		5	=>	"TERCER NIVEL",
		6	=>	"III DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		7	=>	"TECNOLOGO",
		8	=>	"TECNICO SUPERIOR",
		9	=>	"TITULO TEMPORAL",
		10	=>	"SIN TITULO"	
	 );

//Prioridad Sniese
$arrMainSniese = 
	array
	(
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
	 );
//Prioridad Tercer Nivel
$arrTercerNivel = 
	array(
		0 => "III DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		1 => "TERCER NIVEL",
		2 => "TECNOLOGO",
		3 => "TECNICO SUPERIOR"			 
	);
//Prioridad Cuarto Nivel
$arrCuartoNivel = 
	array(
		0 => "DOCTORADO",
		1 => "MAGISTER",
		2 => "ESPECIALISTA",
		3 => "DIPLOMADO",			 
		4 => "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"			 
	);
$arrCat = 
	array(
		0 => "A",
		1 => "B",
		2 => "C",				
		3 => "D",
		4 => "E"		
	);


//Profesores Investigadores por tipo
$arrProfInvPerm [0]['serial_epl'] = 250;
$arrProfInvPerm [0]['nombre'] = 'CESAR OSWALDO WEBSTER COELLO';
$arrProfInvPerm [0]['tipo'] = 'PERMANENTE';
$arrProfInvPerm [1]['serial_epl'] = 259;
$arrProfInvPerm [1]['nombre'] = 'JUAN PABLO CARVALLO VEGA';
$arrProfInvPerm [1]['tipo'] = 'PERMANENTE';
$arrProfInvPerm [2]['serial_epl'] = 538;
$arrProfInvPerm [2]['nombre'] = 'MARIANA DE JESUS PAULINA TERAN GONZALEZ';
$arrProfInvPerm [2]['tipo'] = 'PERMANENTE';
$arrProfInvPerm [3]['serial_epl'] = 722;
$arrProfInvPerm [3]['nombre'] = 'ALVARO DANILO GORTAIRE JATIVA';
$arrProfInvPerm [3]['tipo'] = 'PERMANENTE';
$arrProfInvPerm [4]['serial_epl'] = 1846;
$arrProfInvPerm [4]['nombre'] = 'LUIS RAMON MIRANDA VALDES';
$arrProfInvPerm [4]['tipo'] = 'PERMANENTE';
$arrProfInvEspo [0]['serial_epl'] = 1562;
$arrProfInvEspo [0]['nombre'] = 'JAVIER ALFREDO VALDIVIEZO ORTIZ';
$arrProfInvEspo [0]['serial_epl'] = 356;
$arrProfInvEspo [0]['tipo'] = 'ESPORADICO';
$totalSemana = 48;
$creditoDefaultMallaCero = 3;
$serial_suc = $_GET['serial_suc'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$fecha_act = date("Y")."-".date("m")."-".date("d");	
if(strlen($fecha_ini)>0 or strlen($fecha_fin)>0){
	$periodo = "and fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' ";
}else{
	$fecha_ini = $fecha_act;
	$fecha_fin = $fecha_act;
}	
//sucursal
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = "and periodo.serial_suc = ".$serial_suc;
}
if($serial_sec=="T"){
	$seccion = " and periodo.serial_sec in (1,2) ";		
}else{
	$seccion = "and periodo.serial_sec = ".$serial_sec;
}

$facultad = "";
$sqlProf = "
SELECT 
	distinct (hrr.SERIAL_EPL) as serial_epl,
	'' as codInstitucion,
	'' as provincia,
	'' as canton,
	'' as parroquia,
	documentoidentidad_epl, 
	apellido_epl,
	'' as apellido_paterno,
	'' as apellido_materno,
	nombre_epl,
	concat_ws(' ',apellido_epl,nombre_epl) as nombre,
	direccion_epl,
	nombre_tct,
	epl.serial_tct,
	fechanacimiento_epl,
	'' as fechanacimiento,
	email_epl,
	emailuniv_epl,
	'' as titulo_tn,
	'' as institucion_tn,
	'' as nivel_tn,
	'' as pais_tn,
	'' as registro_tn,
	'' as titulo_cn,
	'' as institucion_cn,
	'' as nivel_cn,
	'' as pais_cn,
	'' as registro_cn,
	'' as cargo,
	'' as formacontrato,
	'' as unidadacademica,	
	'' as horaacademica,
	'' as horainvestigacion,
	'' as horavinculacion,
	'' as horaadministrativa,
	'' as horadedicacion,
	'' as hdcategoria,
	'' as sistevaldocente,
	'' as periodosabatico,
	'' as eventoacademico,
	'' as academicoextranjero,
	'' as investigadorpermanente,
	'' as investigadoresporadico,
	'' as niveldoctn,
	'' as niveldoccn,
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	FECHANACIMIENTO_EPL as fnacimiento,
	'' as sexo,
	sexo_epl,
	fechaingreso_epl,
	'' as fechaingresoinstitucion,
	concat_ws('|',catprof_epl,formaContrato_epl) as catprof_epl,
	nombre_fac,
	'' as formaciongen,
	formacontrato_epl,	
	fingresonomina_epl,
	nombre_car,
	niv.nombre_nac,
    nna.nombre_nac as nacionalidad,
	formaContrato_epl,
	nombre_fac,
	periodo.serial_suc,
	nombre_suc,
	UPPER(direccion_suc) as direccion_suc, 
	periodo.serial_sec

FROM
  	area,facultad,materia,periodo,empleado as epl, horario as hrr,sucursal as suc
	left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
	left join nivelacademico as niv on foa.serial_nac = niv.serial_nac	
	left join nacionalidad as nna on epl.serial_nac = nna.serial_nac
	left join tipocontratostrabajo as tct ON epl.serial_tct = tct.serial_tct
	left join escalafones as esc ON esc.serial_esc = epl.serial_esc
	left join cargos as car ON car.serial_car = esc.serial_car 
	left join tipoescalafones as tes ON tes.serial_tes = esc.serial_tes

WHERE
	hrr.serial_epl=epl.serial_epl
	and materia.serial_mat=hrr.serial_mat
	and area.serial_are=materia.serial_are
	and area.serial_fac=facultad.serial_fac
	and periodo.serial_per=hrr.serial_per
	and periodo.serial_suc = suc.serial_suc
	and tipoEmpleado_epl = 'PROFESOR' 
	and prospecto_epl = 'NO' 
	".$facultad."
	".$periodo."
	and estado_hrr='ACTIVO'
	".$sucursal."
	".$seccion."
	and hrr.serial_hrr in(select serial_hrr from detallemateriamatriculada)
GROUP BY
	hrr.serial_epl
ORDER BY
	nombre_suc	
";
//echo "<br>".$sqlProf."<br>";
//	and hrr.serial_epl = 125
//	and hrr.serial_epl = 504
//and hrr.SERIAL_EPL = 1783 en cuenca
// and hrr.SERIAL_EPL in (360,1783,362,112) vacias sin hacad
//and hrr.SERIAL_EPL in (1773,1805,1144,356,1469) sin formacion
//and hrr.SERIAL_EPL in (1773,1805,1144,356,1469)	
//echo "<br>".$sqlProf."<br>";
//	and hrr.SERIAL_EPL in (219,94,259,1374)
$arrMain = $dblink->GetAll($sqlProf);
$totAll = count($arrMain);
//print "<pre>";print_r($arrMain);print "<pre>";
/**
* Fill de datos en el propio array
*/
if($arrMain){

	//DO ARRAY
	for($i=0;$i<$totAll;$i++){	
		switch($arrMain[$i]['nombre_suc']){
			case 'QUITO': 
					$arrMain[$i]['provincia'] = $infUio['provincia'];
					$arrMain[$i]['canton'] = $infUio['canton'];
					$arrMain[$i]['parroquia'] = $infUio['parroquia'];
					break;
			case 'GUAYAQUIL':
					$arrMain[$i]['provincia'] = $infGye['provincia'];
					$arrMain[$i]['canton'] = $infGye['canton'];
					$arrMain[$i]['parroquia'] = $infGye['parroquia'];
					break;
			case 'CUENCA':
					$arrMain[$i]['provincia'] = $infCue['provincia'];
					$arrMain[$i]['canton'] = $infCue['canton'];
					$arrMain[$i]['parroquia'] = $infCue['parroquia'];
					break;
		}
		//Set Sexo
		switch($arrMain[$i]['sexo_epl']){
			case 'MASCULINO':
				$arrMain[$i]['sexo'] = 'HOMBRE';
				break;
			case 'FEMENINO':
				$arrMain[$i]['sexo'] = 'MUJER';
				break;
		}
		//set Fecha Ingreso Instituaicon
		//fechaingreso_epl fechaingresoinstitucion
		if($arrMain[$i]['fechaingreso_epl']<>'0000-00-00'){
			$arrMain[$i]['fechaingresoinstitucion'] = strftime("%d/%m/%Y",strtotime($arrMain[$i]['fechaingreso_epl']));
		}/*else{
			$arrMain[$i]['fechaingresoinstitucion'] = $arrMain[$i]['fechaingreso_epl'];
		}*/

		//Set Fecha Nacimiento		
		if($arrMain[$i]['fechanacimiento_epl']<>'0000-00-00'){
			$arrMain[$i]['fechanacimiento'] = strftime("%d/%m/%Y",strtotime($arrMain[$i]['fechanacimiento_epl']));
		}
		
		//Set Codigo Institucion
		//$arrMain[$i]['codigo_institucion'] = $codigoInstitucion." => ".$arrMain[$i]['serial_epl'];
		$arrMain[$i]['codigo_institucion'] = $codigoInstitucion;
		//Set Provincia/Canton/Parroquia
		//Set Apellidos
		$apellido = explode(' ',$arrMain[$i]['apellido_epl']);
		$arrMain[$i]['apellido_paterno'] = trim($apellido[0]);		
		if(trim(strlen($apellido[1]))>0){
			$arrMain[$i]['apellido_materno'] = trim($apellido[1]);
		}else{
			$arrMain[$i]['apellido_materno'] = "";
		}

		//Set Formacion 
		//Tercer Nivel
		$arrForm = formacionProf($arrMain[$i]['serial_epl'],"TERCER NIVEL",$dblink);
		if($arrForm<>-1){
			if($arrForm['nivel'] == "III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"){
				$arrMain[$i]['nivel_tn'] = "DOCTOR EN FILOSOFIA O JURISPRUDENCIA";
			}else{
				$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
			}
			$arrMain[$i]['titulo_tn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_tn'] = $arrForm['institucion'];			
			$arrMain[$i]['pais_tn'] = $arrForm['pais'];
			//quit
			//$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
			$arrMain[$i]['registro_tn'] = $arrForm['registro'];
		}else{
			$arrMain[$i]['titulo_tn'] = "&nbsp;";
			$arrMain[$i]['institucion_tn'] = "&nbsp;";
			$arrMain[$i]['nivel_tn'] = "&nbsp;";
			$arrMain[$i]['pais_tn'] = "&nbsp;";
			$arrMain[$i]['registro_tn'] = "&nbsp;";		
		}
		//Cuarto Nivel
		$arrForm = formacionProf($arrMain[$i]['serial_epl'],"CUARTO NIVEL",$dblink);
		if($arrForm<>-1){
			switch($arrForm['nivel']){
				case "DIPLOMADO":
						$arrMain[$i]['nivel_cn'] = "DIPLOMA SUPERIOR";	
					break;
				case "MAGISTER":	
						$arrMain[$i]['nivel_cn'] = "MAESTRIA";	
					break;
				case "DOCTORADO":	
						$arrMain[$i]['nivel_cn'] = "DOCTOR PH.D";	
					break;
				case "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA":
						$arrMain[$i]['nivel_cn'] = "DOCTOR EN JURISPRUDENCIA O FILOSOFIA";	
					break;
				
				default: $arrMain[$i]['nivel_cn'] = $arrForm['nivel'];			
			}
			$arrMain[$i]['titulo_cn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_cn'] = $arrForm['institucion'];
			//quit
			//$arrMain[$i]['nivel_cn'] = $arrForm['nivel'];						
			$arrMain[$i]['pais_cn'] = $arrForm['pais'];
			$arrMain[$i]['registro_cn'] = $arrForm['registro'];
		}else{
			$arrMain[$i]['titulo_cn'] = "&nbsp;";
			$arrMain[$i]['institucion_cn'] = "&nbsp;";
			$arrMain[$i]['nivel_cn'] = "SIN TITULO DE CUARTO NIVEL";
			$arrMain[$i]['pais_cn'] = "&nbsp;";
			$arrMain[$i]['registro_cn'] = "&nbsp;";		
		}
		//Set del nivel de formacio General por prioridad
		$arr = evalFormProf($arrMain[$i]['serial_epl'],$dblink);
		if($arr){
			$arrMain[$i]['nombre_nac'] = $arr;
			//Tablas dinamicas por formacion general del profesor
			$arrMain[$i]['formaciongen'] = $arr;
			switch($arrMain[$i]['formaciongen'] ){				
				case "III DOCTOR EN JURISPRUDENCIA O FILOSOFIA":
					$arrMain[$i]['formaciongen'] = "DOCTOR EN FILOSOFIA O JURISPRUDENCIA";						
					break;
				case "DIPLOMADO":
					$arrMain[$i]['formaciongen'] = "DIPLOMA SUPERIOR";	
					break;
				case "MAGISTER":	
					$arrMain[$i]['formaciongen'] = "MAESTRIA";	
					break;
				case "DOCTORADO":	
					$arrMain[$i]['formaciongen'] = "DOCTORADO";	
					break;
				case "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA":
					$arrMain[$i]['formaciongen'] = "DOCTOR EN FILOSOFIA O JURISPRUDENCIA";	
					break;			
			}			
		}else{
			$arrMain[$i]['nombre_nac'] = '';
			$arrMain[$i]['formaciongen'] = '';
			
		}
		//Cargo Administrativo
		if(trim($arrMain[$i]['nombre_car'])!=""){
			$arrMain[$i]['cargo'] = $arrMain[$i]['nombre_car'];		
		}else{
			$arrMain[$i]['cargo'] = "SIN CARGO";		
		}
		//Set FormaContrato
		if(trim($arrMain[$i]['formacontrato_epl'])!=""){
			$arrMain[$i]['formacontrato'] = $arrMain[$i]['formacontrato_epl'];		
		}else{
			$arrMain[$i]['formacontrato'] = "";		
		}
		//Set Categoria
		$arrMain[$i]['nombre_tct'] = trim($arrMain[$i]['nombre_tct']);

		//Set Unidad Academica
		if(trim($arrMain[$i]['nombre_fac'])!=""){
			$arrMain[$i]['unidadacademica'] = $arrMain[$i]['nombre_fac'];		
		}else{
			$arrMain[$i]['unidadacademica'] = "";		
		}
		//Set Horas Academicas
		$hAcad = HorasAcad($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$dblink);
		if($hAcad){			
			$arrMain[$i]['horaacademica'] = $hAcad;
		}else{
			$arrMain[$i]['horaacademica'] = 0;
		}
		//Set Horas Investigacion 
		$hInv = getHorasInvestigacion($arrMain[$i]['serial_epl'],$dblink);
		if($hInv){			
			$arrMain[$i]['horainvestigacion'] = $hInv;
		}else{
			$arrMain[$i]['horainvestigacion'] = 0;
		}
		//Set Horas Vinculacion
		$hVinc = getHorasVinculacion($arrMain[$i]['serial_epl'],$dblink);
		if($hVinc){			
			$arrMain[$i]['horavinculacion'] = $hVinc;
		}else{
			$arrMain[$i]['horavinculacion'] = 0;
		}				
		//Set Horas Administrativas		
		if(getHorasAdministrativa($arrMain[$i]['documentoidentidad_epl'],$dblink)){
			$hAdm = number_format(40 -($arrMain[$i]['horaacademica']+$arrMain[$i]['horainvestigacion'] +$arrMain[$i]['horavinculacion']),2);
			$arrMain[$i]['horaadministrativa'] = $hAdm;
		}else{
			$arrMain[$i]['horaadministrativa'] = 0;
		}
		//Set Hora Dedicacion
		$arrMain[$i]['horadedicacion'] = $arrMain[$i]['horaacademica']+$arrMain[$i]['horaadministrativa']+$arrMain[$i]['horainvestigacion'] +$arrMain[$i]['horavinculacion'];
		//Set Sist Eval Docentes
		$arrMain[$i]['sistevaldocente'] = 'SI';
		//Set Periodo Sabatico
		$arrMain[$i]['periodosabatico']	= 'NO';		
		//Set Eventos academicos
		//set Eventos Academico
		$evAcad = getEventoAcademico($arrMain[$i]['serial_epl'],'SOLOEVENTO',$dblink);
		//echo "<br> SOLOEVENTO: ".$evAcad;
		if($evAcad){
			$arrMain[$i]['eventoacademico'] = 'SI';
		}else{
			$arrMain[$i]['eventoacademico'] = 'NO';
		}
		//Set Academico Extranjero
		$evExt = getEventoAcademico($arrMain[$i]['serial_epl'],'INTERNACIONAL',$dblink);
		if($evExt){
			$arrMain[$i]['academicoextranjero'] = 'SI';
		}else{
			$arrMain[$i]['academicoextranjero'] = 'NO';
		}
		//set Investigador Permanente
		$profInv = getTipoProfesorInvestigadorPermanente($arrMain[$i]['serial_epl']);
		if($profInv){
			$arrMain[$i]['investigadorpermanente'] = 'SI';
		}else{
			$arrMain[$i]['investigadorpermanente'] = 'NO';
		}
		//Set Investigador  Esporadico
		if($arrMain[$i]['serial_epl'] == $arrProfInvEspo[0]['serial_epl']){
			$arrMain[$i]['investigadoresporadico'] = 'SI';
		}else{
			$arrMain[$i]['investigadoresporadico'] = 'NO';
		}
		//set Nivel Doc Tn
		//echo "<br>SERIAL SEC: ".$serial_sec."<br>";
		switch($arrMain[$i]['serial_sec']){
			case '1': 
				$arrMain[$i]['niveldoctn'] = "SI"; 
				$arrMain[$i]['niveldoccn'] = "NO"; 
				break;
			case '2':
				$arrMain[$i]['niveldoctn'] = "NO"; 
				$arrMain[$i]['niveldoccn'] = "SI"; 
				break;
			default:
				$arrMain[$i]['niveldoctn'] = "NO"; 
				$arrMain[$i]['niveldoccn'] = "NO"; 
		}
		//Set Email
		if(trim($arrMain[$i]['email_epl'])!=""){
			$arrMain[$i]['email_epl'] = $arrMain[$i]['email_epl'];		
		}else{
			if(trim($arrMain[$i]['emailuniv_epl'])!=""){
				$arrMain[$i]['email_epl'] = $arrMain[$i]['emailuniv_epl'];		
			}else{
				$arrMain[$i]['email_epl'] = "";		
			}
			
		}
	}
}else{
	echo "<br>No se puede Mostrar la lista<br>";	
}
?>

<?php
/**
* Resumenes para tablas
*/

/**
* Encerar vector contador
*/

for($i=0;$i<count($arrMainPrior);$i++){
	$key = $arrMainPrior[$i];
	$totFormMasNomb[$key] = 0;	
	$totFormFemNomb[$key] = 0;	
	$totFormMasContSinRelDep[$key] = 0;	
	$totFormFemContSinRelDep[$key] = 0;	
	$totFormMasContConRelDep[$key] = 0;	
	$totFormFemContConRelDep[$key] = 0;	
	$totFormMasConvenio[$key] = 0;	
	$totFormFemConvenio[$key] = 0;	
}

$totArrMainPrior = count($arrMainPrior);
$totArrCat = count($arrCat);
for($i=0;$i<$totArrCat;$i++){
	$cat = $arrCat[$i];			
	$sumCat[$cat] = 0;
}
for($i=0;$i<$totArrMainPrior;$i++){
	$key = $arrMainPrior[$i];
	$sumPrior[$key] = 0;		
	for($j=0;$j<$totArrCat;$j++){
		$cat = $arrCat[$j];
		$contClase[$key][$cat] = 0;
	}	
}

//Count Sniesce

for($i=0;$i<count($arrMainSniese);$i++){
	$key = $arrMainSniese[$i];
	$totFormSniese[$key] = 0;	
}


$nombramiento = "NOMBRAMIENTO";
$contratoSinRelDep = "CONTRATO - Sin relacion de dependencia";
$contratoConRelDep = "CONTRATO - Con relacion de dependencia";
$convenio = "CONVENIO";

$sumOtros = 0;
$swSearch = 0;
$swSearchTwo = 0;
$sumOtrosTwo = 0;
$totMasculino = 0;
$totFemenino = 0;
$totNoDef = 0;
$totForm = count($arrMainPrior);
$arrSinForm = array();
$arrSinSex = array();
$arrSinCat = array();
$$arrFormSnieseTit = array();
$sumOtrosCat = 0;
$totSinGen = 0;
$sumSinCat = 0;
$swCat = 0;
$sumConCat = 0;
$edadError = 0;
$countFormSniese = count($arrMainSniese);
$swFormSniese = 0;
$swFormSnieseNull = 0;

for($i=0;$i<$totAll;$i++){	
	//Count por formacion Sniesce
	$key = $arrMain[$i]['formaciongen'];
	for($j=0;$j<$countFormSniese;$j++){		
		if($key == $arrMainSniese[$j]){
			//Asignar al arreglo
			/*
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMADO SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

			*/
			$tipo = $totFormSniese[$key];
			switch($arrMain[$i]['formaciongen'] ){
				
				case "TECNICO SUPERIOR":
					$arrFormSnieseTit0[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit0[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit0[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit0[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit0[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit0[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];	
					break;
				case "TECNOLOGICO SUPERIOR":
					$arrFormSnieseTit1[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit1[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit1[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit1[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit1[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit1[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];	
					break;
				case "TERCER NIVEL":
					$arrFormSnieseTit2[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit2[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit2[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit2[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit2[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit2[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];	
					break;	
				case "DOCTOR EN FILOSOFIA O JURISPRUDENCIA":
					$arrFormSnieseTit3[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit3[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit3[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit3[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit3[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit3[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];						
					break;
				case "DIPLOMA SUPERIOR":
					$arrFormSnieseTit4[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit4[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit4[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit4[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit4[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit4[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];											
					break;
				case "MAESTRIA":	
					$arrFormSnieseTit5[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit5[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit5[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit5[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit5[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit5[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];																
					break;
				case "ESPECIALISTA":	
					$arrFormSnieseTit6[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit6[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit6[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit6[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit6[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit6[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];																					
					break;
				case "DOCTORADO":	
					$arrFormSnieseTit7[$tipo]['serial_epl'] = $arrMain[$i]['serial_epl'];
					$arrFormSnieseTit7[$tipo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
					$arrFormSnieseTit7[$tipo]['categoria'] = $arrMain[$i]['nombre_tct'];
					$arrFormSnieseTit7[$tipo]['formacion'] = $arrMain[$i]['formaciongen'];
					$arrFormSnieseTit7[$tipo]['genero'] = $arrMain[$i]['sexo_epl'];
					$arrFormSnieseTit7[$tipo]['sucursal'] = $arrMain[$i]['nombre_suc'];																										
					break;					
			}				
			$totFormSniese[$key]++;
			$swFormSniese = 1;
			$j = $countFormSniese;			
		}
	}
	if($swFormSniese==0){
		$arrFormSnieseTit8[$swFormSnieseNull]['serial_epl'] = $arrMain[$i]['serial_epl'];
		$arrFormSnieseTit8[$swFormSnieseNull]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
		$arrFormSnieseTit8[$swFormSnieseNull]['categoria'] = $arrMain[$i]['nombre_tct'];
		$arrFormSnieseTit8[$swFormSnieseNull]['formacion'] = $arrMain[$i]['formaciongen'];
		$arrFormSnieseTit8[$swFormSnieseNull]['genero'] = $arrMain[$i]['sexo_epl'];
		$arrFormSnieseTit8[$swFormSnieseNull]['sucursal'] = $arrMain[$i]['nombre_suc'];
		$swFormSnieseNull++;
	}
	$swFormSniese = 0;	
	//Count por Genero
	switch($arrMain[$i]['sexo_epl']){
		case "MASCULINO": 
			$totMasculino++;
			break;
		case "FEMENINO":
			$totFemenino++;
			break;
		case "";
			//Indentificar los que no estan sin genero
			$arrSinSex[$totNoDef]['serial_epl'] = $arrMain[$i]['serial_epl'];
			$arrSinSex[$totNoDef]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
			$arrSinSex[$totNoDef]['genero'] = $arrMain[$i]['sexo_epl'];
			$arrSinSex[$totNoDef]['sucursal'] = $arrMain[$i]['nombre_suc'];
			$totNoDef++;			
	}	
	$key = $arrMain[$i]['nombre_nac'];
	if($key == "" or $key == "TITULO TEMPORAL" or $key == "SIN TITULO" or $arrMain[$i]['serial_tct']==1 or  $arrMain[$i]['serial_tct']==2 or $arrMain[$i]['serial_tct']==3 or $arrMain[$i]['serial_tct']==4 or $arrMain[$i]['serial_tct']==5 or $arrMain[$i]['serial_tct']==6 or $arrMain[$i]['serial_tct']==7 or $arrMain[$i]['serial_tct']== -99){
		$arrSinCat[$sumSinCat]['serial_epl'] = $arrMain[$i]['serial_epl'];
		$arrSinCat[$sumSinCat]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
		$arrSinCat[$sumSinCat]['categoria'] = $arrMain[$i]['nombre_tct'];
		$arrSinCat[$sumSinCat]['formacion'] = $arrMain[$i]['nombre_nac'];
		$arrSinCat[$sumSinCat]['genero'] = $arrMain[$i]['sexo_epl'];
		$arrSinCat[$sumSinCat]['sucursal'] = $arrMain[$i]['nombre_suc'];
		$sumSinCat++;			
	}else{
		for($j=0;$j<$totForm;$j++){		
			if($key == $arrMainPrior[$j]){	
				
				if($arrMain[$i]['nombre_tct'] == $nombramiento or $arrMain[$i]['nombre_tct'] == $contratoSinRelDep or $arrMain[$i]['nombre_tct'] == $contratoConRelDep or $arrMain[$i]['nombre_tct'] == $convenio){
					/*
						//DE LA BASE
						$nombramiento = "NOMBRAMIENTO";
						$contratoSinRelDep = "CONTRATO - Sin relacion de dependencia";
						$contratoConRelDep = "CONTRATO - Con relacion de dependencia";
						$convenio = "CONVENIO";
						//TOTALES
						$totFormMasNomb[$key] = 0;	
						$totFormFemNomb[$key] = 0;	
						$totFormMasContSinRelDep[$key] = 0;	
						$totFormFemContSinRelDep[$key] = 0;	
						$totFormMasContConRelDep[$key] = 0;	
						$totFormFemContConRelDep[$key] = 0;	
						$totFormMasConvenio[$key] = 0;	
						$totFormFemConvenio[$key] = 0;							
					*/
					switch($arrMain[$i]['nombre_tct']){
						case $nombramiento: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasNomb[$key]++;
									break;	 	
								case "FEMENINO": 
									$totFormFemNomb[$key]++; 
									break;	
							}
							break;
						case $contratoSinRelDep: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasContSinRelDep[$key]++;
									if($key == 'III DOCTOR EN JURISPRUDENCIA O FILOSOFIA' ){
										echo "<strong> *** ".$arrMain[$i]['nombre']." *** <strong><br>";
									}
									
									break;	 	
								case "FEMENINO": 
									$totFormFemContSinRelDep[$key]++; 
									break;	
			
							}
							break;				
						case $contratoConRelDep: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasContConRelDep[$key]++;
									break;	 	
								case "FEMENINO": 
									$totFormFemContConRelDep[$key]++; 
									break;	
			
							}
							break;				
						case $convenio: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasConvenio[$key]++;
									break;	 	
								case "FEMENINO": 
									$totFormFemConvenio[$key]++; 
									break;	
			
							}
							break;				
							
					}
					$j = $totForm;
					$swSearch = 1;				
				}
			}	
		}
	}
	if($swSearch == 0){
		$sumOtros++;	
	}
	$swSearch = 0;	
	//Conteo por horas de relacion laboral
	$key = $arrMain[$i]['nombre_nac'];
	if($key == "" or $key == "TITULO TEMPORAL" or $key == "SIN TITULO"){
		$arrSinForm[$sumOtrosTwo]['serial_epl'] = $arrMain[$i]['serial_epl'];
		$arrSinForm[$sumOtrosTwo]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
		$arrSinForm[$sumOtrosTwo]['sucursal'] = $arrMain[$i]['nombre_suc'];
		$arrSinForm[$sumOtrosTwo]['formacion'] = $arrMain[$i]['nombre_nac'];
		$sumOtrosTwo++;
		$cat = "X";
		$arrMain[$i]['hdcategoria'] =  $cat;
	}else{	
		$horaAcadem =  $arrMain[$i]['horadedicacion'];
		for($k=0;$k<$totForm;$k++){
			if($key == $arrMainPrior[$k]){
				if($horaAcadem>=0 and $horaAcadem<10){
					$contClase[$key]["A"]++;
					$cat = "A";				
				}
				if($horaAcadem>=10 and $horaAcadem<20){
					$contClase[$key]["A"]++;
					$cat = "A";											
				}
				if($horaAcadem>=20 and $horaAcadem<30){
					$contClase[$key]["C"]++;
					$cat = "C";					
				}
				if($horaAcadem>=30 and $horaAcadem<40){
					$contClase[$key]["D"]++;
					$cat = "D";									
				}
				if($horaAcadem>=40){
					$contClase[$key]["E"]++;	
					$cat = "E";															
				}	
				$arrMain[$i]['hdcategoria'] =  $cat;
				$k=$totForm;	
			}	
		}
	}
	//Conteo por edad del sexo, todos, error
	switch($arrMain[$i]['sexo_epl']){
		case "MASCULINO":
			$edadHombres = $edadHombres + $arrMain[$i]['edad'];					
		break;
		case "FEMENINO":
			$edadMujeres = $edadMujeres + $arrMain[$i]['edad'];	
		break;
	}	
	$edadTodos = $edadTodos + $arrMain[$i]['edad'];		
	if($arrMain[$i]['edad']<=0){
		$arrSinEdad[$edadError]['serial_epl'] = $arrMain[$i]['serial_epl'];
		$arrSinEdad[$edadError]['nombre'] = $arrMain[$i]['apellido_epl']." ".$arrMain[$i]['nombre_epl'];
		$arrSinEdad[$edadError]['edad'] = $arrMain[$i]['edad'];
		$arrSinEdad[$edadError]['sucursal'] = $arrMain[$i]['nombre_suc'];
		$edadError++;
	}
	if($arrMain[$i]['horaacademica']<=0){
		$horasError++;
	}

}
/**
* Promedio edad M,F,T;
*/

/**
* validacion divizion por 0
*/
$totTodos = $totAll;
if($totMasculino == 0){
	$totM = 1;
}else{
	$totM = $totMasculino;
}
if($totFemenino == 0){
	$totF = 1;
}else{
	$totF = $totFemenino;
}

if($totTodos == 0){
	$totT = 1;
}else{
	$totT = $totAll; 
}
$edadHombres = $edadHombres / $totM;
$edadMujeres = $edadMujeres / $totF;
$edadTodos = $edadTodos / $totT;

/**
*Totalizar contadores
*/
$sumCont = 0;
$sumCol = 0;
//Count xCategorias
for($i=0;$i<$totArrCat;$i++){
	$cat = $arrCat[$i];			
	for($j=0;$j<$totArrMainPrior;$j++){
		$key = $arrMainPrior[$j];
		$sumCat[$cat] = $sumCat[$cat] + $contClase[$key][$cat];
	}
}
for($i=0;$i<$totArrCat;$i++){
	$cat = $arrCat[$i];			
	$sumCont = $sumCont + $sumCat[$cat];
}
//Count por nivel de formacion
for($i=0;$i<$totArrMainPrior;$i++){
	$key = $arrMainPrior[$i];
	for($j=0;$j<$totArrCat;$j++){
		$cat = $arrCat[$j];			
		$sumPrior[$key] = $sumPrior[$key] + $contClase[$key][$cat];
	}
}
for($i=0;$i<$totArrMainPrior;$i++){
	$key = $arrMainPrior[$i];
	$sumCol = $sumCol + $sumPrior[$key];
}
$sumFormSn = 0;
//Sum de Formacion Sniese
for($i=0;$i<count($arrMainSniese);$i++){
	$key = $arrMainSniese[$i];
	$sumFormSn = $sumFormSn+ $totFormSniese[$key];	
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Profesores PEI</title>

<link rel="stylesheet" type="text/css" href="jqueryuin/css/defpei.css" media="screen" />
	<link rel="stylesheet" href="jqueryuin/development-bundle/themes/base/jquery.ui.all.css">	
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>-->


	<script src="jqueryuin/development-bundle/jquery-1.5.1.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.accordion.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.button.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.resizable.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="jqueryuin/development-bundle/ui/jquery.effects.core.js"></script>
		<script type="text/javascript" src="../jqinc/jquery.quicksearch.js"></script>
	<script type="text/javascript">
			$(function () {
				$('input#id_search').quicksearch('table#tablequick tbody tr');				
			});
	</script>


	<!--<link rel="stylesheet" href="jqueryui/development-bundle/demos/demos.css">-->
	<!--JQUERY FUNCTIONS-->
	<script>
	//Open modal form profesores sin formacion
	$(function() {
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form profesores sin genero
	$(function() {
		$( "#sex-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-sex" )
			.button()
			.click(function() {
				$( "#sex-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form profesores sin categoria
	$(function() {
		$( "#cat-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-cat" )
			.button()
			.click(function() {
				$( "#cat-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form profesores sin edad
	$(function() {
		$( "#edad-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-edad" )
			.button()
			.click(function() {
				$( "#edad-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form otros
	$(function() {
		$( "#otros-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_otros" )
			.button()
			.click(function() {
				$( "#otros-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form doctorado
	$(function() {
		$( "#doctorado-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_doctorado" )
			.button()
			.click(function() {
				$( "#doctorado-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form especialista
	$(function() {
		$( "#especialista-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_especialista" )
			.button()
			.click(function() {
				$( "#especialista-form" ).dialog( "open" );
			});
	});
	</script>
	<script>
	//Open modal form magister
	$(function() {
		$( "#magister-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_magister" )
			.button()
			.click(function() {
				$( "#magister-form" ).dialog( "open" );
			});
	});
	</script>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->
	<script>
	//Open modal form diplomasuperior
	$(function() {
		$( "#diplomado-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_diplomado" )
			.button()
			.click(function() {
				$( "#diplomado-form" ).dialog( "open" );
			});
	});
	</script>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
-->
	<script>
	//Open modal form doctorfilosofia
	$(function() {
		$( "#doctorfilosofia-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_doctorfilosofia" )
			.button()
			.click(function() {
				$( "#doctorfilosofia-form" ).dialog( "open" );
			});
	});
	</script>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
-->

	<script>
	//Open modal form tecernivel
	$(function() {
		$( "#tercernivel-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_tercernivel" )
			.button()
			.click(function() {
				$( "#tercernivel-form" ).dialog( "open" );
			});
	});
	</script>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
-->
	<script>
	//Open modal form tecnologicosuperior
	$(function() {
		$( "#tecnologicosuperior-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_tecnologicosuperior" )
			.button()
			.click(function() {
				$( "#tecnologicosuperior-form" ).dialog( "open" );
			});
	});
	</script>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
-->
	<script>
	//Open modal form tecnicosuperior
	$(function() {
		$( "#tecnicosuperior-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_tecnicosuperior" )
			.button()
			.click(function() {
				$( "#tecnicosuperior-form" ).dialog( "open" );
			});
	});
	</script>

<!--mainlistado-form-->
<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"
-->
	<script>
	//Open modal form listado form
	$(function() {
		$( "#mainlistado-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 600,
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create_mainlistado" )
			.button()
			.click(function() {
				$( "#mainlistado-form" ).dialog( "open" );
			});
	});
	</script>



	<script>
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true
		});
	});
	</script>
	<script> 
	function pulsar(e) { 
	  tecla = (document.all) ? e.keyCode :e.which; 
	  return (tecla!=13); 
	} 
	</script> 

</head><body>

<div id="content">
<div id="itsthetable">
<a href="#resumen">Resumen</a>
<a name="inicio"></a>
		<form action="#">
			<fieldset>
				<input type="text" name="search" value="" id="id_search" placeholder="Search" autofocus onkeypress="return pulsar(event)" />
				* Digite el elemento a buscar dentro de la lista puede digitar varios criterios con espacios
			</fieldset>
		</form>

<table id="tablequick" summary="Profesores PEI" >
	<caption>
	Listado Profesores PEI<?php echo " ( ".$totAll." ) ";?>
	</caption>
	<thead>
	<tr>
	<th scope="col">COD_Institucion</th>
	<th scope="col">Provincia</th>
	<th scope="col">Canton</th>
	<th scope="col">parroquia</th>
	<th scope="col">Direccion</th>
	<th scope="col">Cedula</th>
	<th scope="col">Apellido Paterno</th>
	<th scope="col">Apellido Materno</th>
	<th scope="col">Nombre</th>
	<th scope="col">Sexo</th>
	<th scope="col">Nacionalidad</th>
	<th scope="col">Fecha Nacimiento</th>
	<th scope="col">Titulo TN</th>
	<th scope="col">Universidad TN</th>
	<th scope="col">Nivel TN</th>
	<th scope="col">Pais TN</th>
	<th scope="col">Registro CNSUP TN</th>
	<th scope="col">Titulo CN</th>
	<th scope="col">Universidad CN</th>
	<th scope="col">Nivel CN</th>
	<th scope="col">Pais CN</th>
	<th scope="col">Reg CNSUP CN</th>
	<th scope="col">Fecha Ing Iess</th>
	<th scope="col">Relac Trab Iess</th>
	<th scope="col">Cargo Adm o Acad</th>
	<th scope="col">Categoria</th>
	<th scope="col">Dedicacion</th>
	<th scope="col">Unidad Academ</th>
	<th scope="col">Horas Acad</th>
	<th scope="col">Horas Admin</th>
	<th scope="col">Horas Invest</th>	
	<th scope="col">Horas Vs</th>	
	<th scope="col">Sist Eval Docent</th>
	<th scope="col">PART EVENT ACAD</th>
	<th scope="col">PER SABAT</th>
	<th scope="col">ACAD EXTRANJ</th>
	<th scope="col">INVES PERM</th>
	<th scope="col">INVES ESP</th>
	<th scope="col">NIVEL DOC TN</th>
	<th scope="col">NIVEL DOC CN</th>
	<th scope="col">Email</th>	  
	<th scope="col">Observaciones</th>	  
	
	</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="41"><?php echo $totAll." PROFESORES";?></td>
		</tr>
	</tfoot>
	<tbody>
		<?php 
		for($i=0;$i<$totAll;$i++){	
			if($i%2==0){
				$class = "";		
			}else{
				$class = " class=\"odd\"";
			}
		
		?>
		<tr<?php echo $class;//?>>
			<th scope="row" id="<?php echo "r".$i+1;?>"><a href="#" ><?php echo $arrMain[$i]['codigo_institucion'];?></a></th>
				<td><a href="#"><?php echo $arrMain[$i]['provincia']; ?></a></td>
				<td><?php echo $arrMain[$i]['canton']; ?></td>
				<td><?php echo $arrMain[$i]['parroquia']; ?></td>
				<td><?php echo $arrMain[$i]['direccion_suc']; ?></a></td>
				<td><?php echo $arrMain[$i]['documentoidentidad_epl']; ?></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['apellido_paterno'];?></a></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['apellido_materno'];?></a></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['nombre_epl'] ?></a></td>
				<td><?php echo $arrMain[$i]['sexo'] ?></td>
				<td><?php echo $arrMain[$i]['nacionalidad'] ?></td>
				<td><?php echo $arrMain[$i]['fechanacimiento'] ?></td>
				<td><?php echo $arrMain[$i]['titulo_tn'] ?></td>
				<td><?php echo $arrMain[$i]['institucion_tn'] ?></td>
				<td><?php echo $arrMain[$i]['nivel_tn'] ?></td>
				<td><?php echo $arrMain[$i]['pais_tn'] ?></td>
				<td><?php echo $arrMain[$i]['registro_tn'] ?></td>
				<td><?php echo $arrMain[$i]['titulo_cn'] ?></td>
				<td><?php echo $arrMain[$i]['institucion_cn'] ?></td>
				<td><?php echo $arrMain[$i]['nivel_cn'] ?></td>
				<td><?php echo $arrMain[$i]['pais_cn'] ?></td>
				<td><?php echo $arrMain[$i]['registro_cn'] ?></td>
				<td><?php echo $arrMain[$i]['fechaingresoinstitucion'] ?></td>
				<td><?php echo $arrMain[$i]['nombre_tct']; ?></td>
				<td><?php echo $arrMain[$i]['cargo']; ?></td>
				<td><?php echo $arrMain[$i]['catprof_epl']; ?></td>
				<td><?php echo $arrMain[$i]['horadedicacion'];?></td>
				<td><?php echo $arrMain[$i]['nombre_suc'];?></td>
				<td><?php echo $arrMain[$i]['horaacademica']; ?></td>
				<td><?php echo $arrMain[$i]['horaadministrativa'];?></td>
				<td><?php echo $arrMain[$i]['horainvestigacion'];?></td>
				<td><?php echo $arrMain[$i]['horavinculacion'];?></td>
				<td><?php echo $arrMain[$i]['sistevaldocente']; ?></td>
				<td><?php echo $arrMain[$i]['eventoacademico']; ?></td>
				<td><?php echo $arrMain[$i]['periodosabatico'] ?></td>
				<td><?php echo $arrMain[$i]['academicoextranjero'];?></td>
				<td><?php echo $arrMain[$i]['investigadorpermanente'];?></td>
				<td><?php echo $arrMain[$i]['investigadoresporadico'];?></td>
				<td><?php echo $arrMain[$i]['niveldoctn'];?></td>
				<td><?php echo $arrMain[$i]['niveldoccn']; ?></td>
				<td><?php echo $arrMain[$i]['email_epl']; ?></td>
				<td><?php echo "&nbsp;";//echo $arrMain[$i]['nombre_nac'] ?></td>

		</tr>
		<?php
		}
		?>

	</tbody>
</table>
</div>
<p>
</div>
<p>

<!--BEGIN ACCORDION-->
<div class="demo">
<a name="resumen"></a>
<a href="#inicio">Inicio</a>
<div id="accordion">
	<h3><a href="#">PROFESORES POR GENERO</a></h3>
	<div>
		<p>
		<!--BEGIN SEXO-->
	  <!--BEGIN GENERO-->
<div id="content">
<div id="itsthetable">
<table summary="Profesores PEI">
	<caption>Profesores por Genero <?php echo "Desde:  ".$fecha_ini."Hasta:  ".$fecha_fin; ?></caption>
	<thead>
	<tr>
	<th scope="col">Hombres</th>
	<th scope="col">Mujeres</th>
	<th scope="col">No Identificados</th>
	
	</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="21"><?php echo $totAll; ?></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="odd">
			<th scope="row" id=""><a href="#"><?php echo $totMasculino; ?></a></th>
				<td><a href="#"><?php echo $totFemenino; ?></a></td>
				<td><a href="#"><?php echo $totNoDef;?>
				  
				</a><input name="create-sex" id="create-sex" type="button" value="..."></td>
		</tr>
	</tbody>
</table>

</div>
</div>


<!--END GENERO-->

		<!--END SEXO-->
		</p>
	</div>
	<h3><a href="#">PROFESORES POR RELACION LABORAL Y TIPO</a></h3>
	<div>
		<p>
		<!--BEGIN RELACION LAB-->
	<table border="0">
      <col  />
      <col span="5" />
      <tr >
        <td colspan="10" ><div align="center"><strong>N&uacute;mero    total de profesores(as) por tipo de relaci&oacute;n laboral y nivel de formaci&oacute;n    .</strong>
          <input name="create_mainlistado" id="create_mainlistado" type="button" value="...">
        </div></td>
      </tr>
      <tr>
        <td rowspan="3"><?php echo "Profesores Desde: <strong>".$fecha_ini."</strong>Hasta: <strong>".$fecha_fin."</strong>"; ?></td>
        <td colspan="9"><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $totAll - $sumSinCat; ?></strong> no se procesaron: <strong><? echo $sumSinCat;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $sumSinCat + ($totAll - $sumSinCat);?></strong> Prof. </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Nombramiento</div></td>
        <td colspan="2"><div align="center">Contrato con Relacion de Dependencia </div></td>
        <td colspan="2"><div align="center">Contrato Sin Relacion de Dependencia </div></td>
        <td colspan="2"><div align="center">Convenio</div></td>
        <td rowspan="2"><div align="center">TOTAL</div></td>
      </tr>
      <tr>
        <td><div align="center">Hombres</div></td>
        <td><div align="center">Mujeres</div></td>
        <td><div align="center">Hombres</div></td>
        <td><div align="center">Mujeres</div></td>
        <td><div align="center">Hombres</div></td>
        <td><div align="center">Mujeres</div></td>
        <td><div align="center">Hombres</div></td>
        <td><div align="center">Mujeres</div></td>
      </tr>
      <tr>
        <td>T&eacute;cnico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasContConRelDep['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemContConRelDep['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasContSinRelDep['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemContSinRelDep['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasConvenio['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemConvenio['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR']+$totFormFemNomb['TECNICO SUPERIOR']+$totFormMasContConRelDep['TECNICO SUPERIOR']+$totFormFemContConRelDep['TECNICO SUPERIOR']+$totFormMasContSinRelDep['TECNICO SUPERIOR']+$totFormFemContSinRelDep['TECNICO SUPERIOR']+$totFormMasConvenio['TECNICO SUPERIOR']+$totFormFemConvenio['TECNICO SUPERIOR'];?> </td>
      </tr>
      <tr>
        <td>Tecnol&oacute;gico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasContConRelDep['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemContConRelDep['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasContSinRelDep['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemContSinRelDep['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasConvenio['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemConvenio['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasNomb['TECNOLOGO']+$totFormFemNomb['TECNOLOGO']+$totFormMasContConRelDep['TECNOLOGO']+$totFormFemContConRelDep['TECNOLOGO']+$totFormMasContSinRelDep['TECNOLOGO']+$totFormFemContSinRelDep['TECNOLOGO']+$totFormMasConvenio['TECNOLOGO']+$totFormFemConvenio['TECNOLOGO'];?></td>
      </tr>
      <tr>
        <td>Tercer Nivel</td>
        <td><?php echo $totFormMasNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasContConRelDep['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemContConRelDep['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasContSinRelDep['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemContSinRelDep['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasConvenio['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemConvenio['TERCER NIVEL'];?></td>
        <td><?php  echo $totFormMasNomb['TERCER NIVEL']+$totFormFemNomb['TERCER NIVEL']+$totFormMasContConRelDep['TERCER NIVEL']+$totFormFemContConRelDep['TERCER NIVEL']+$totFormMasContSinRelDep['TERCER NIVEL']+$totFormFemContSinRelDep['TERCER NIVEL']+$totFormMasConvenio['TERCER NIVEL']+$totFormFemConvenio['TERCER NIVEL'];?></td>
      </tr>
      <tr>
        <td>Doctor en    jurisprudencia o filosof&iacute;a (III Doctor) </td>
        <td><?php echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php  echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
      </tr>
      <tr>
        <td>Diplomado    Superior</td>
        <td><?php echo $totFormMasNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasContConRelDep['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemContConRelDep['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasContSinRelDep['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemContSinRelDep['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasConvenio['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemConvenio['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasNomb['DIPLOMADO']+$totFormFemNomb['DIPLOMADO']+$totFormMasContConRelDep['DIPLOMADO']+$totFormFemContConRelDep['DIPLOMADO']+$totFormMasContSinRelDep['DIPLOMADO']+$totFormFemContSinRelDep['DIPLOMADO']+$totFormMasConvenio['DIPLOMADO']+$totFormFemConvenio['DIPLOMADO'];?></td>
      </tr>
      <tr>
        <td>Especialista</td>
        <td><?php echo $totFormMasNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasContConRelDep['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemContConRelDep['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasContSinRelDep['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemContSinRelDep['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasConvenio['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemConvenio['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasNomb['DIPLOMADO']+$totFormFemNomb['ESPECIALISTA']+$totFormMasContConRelDep['ESPECIALISTA']+$totFormFemContConRelDep['ESPECIALISTA']+$totFormMasContSinRelDep['ESPECIALISTA']+$totFormFemContSinRelDep['ESPECIALISTA']+$totFormMasConvenio['ESPECIALISTA']+$totFormFemConvenio['ESPECIALISTA'];?></td>
      </tr>
      <tr>
        <td>Maestr&iacute;a (+IV Doctor) </td>
        <td><?php echo $totFormMasNomb['MAGISTER'] + $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['MAGISTER'] + $totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContConRelDep['MAGISTER'] + $totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContConRelDep['MAGISTER'] + $totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContSinRelDep['MAGISTER'] + $totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContSinRelDep['MAGISTER'] + $totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasConvenio['MAGISTER'] + $totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemConvenio['MAGISTER'] + $totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasNomb['MAGISTER']+$totFormFemNomb['MAGISTER']+$totFormMasContConRelDep['MAGISTER']+$totFormFemContConRelDep['MAGISTER']+$totFormMasContSinRelDep['MAGISTER']+$totFormFemContSinRelDep['MAGISTER']+$totFormMasConvenio['MAGISTER']+$totFormFemConvenio['MAGISTER']+ $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
      </tr>
      <tr>
        <td>Ph.D</td>
        <td><?php echo $totFormMasNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormFemNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormMasContConRelDep['DOCTORADO'];?></td>
        <td><?php echo $totFormFemContConRelDep['DOCTORADO'];?></td>
        <td><?php echo $totFormMasContSinRelDep['DOCTORADO'];?></td>
        <td><?php echo $totFormFemContSinRelDep['DOCTORADO'];?></td>
        <td><?php echo $totFormMasConvenio['DOCTORADO'];?></td>
        <td><?php echo $totFormFemConvenio['DOCTORADO'];?></td>
        <td><?php echo $totFormMasNomb['DOCTORADO']+$totFormFemNomb['DOCTORADO']+$totFormMasContConRelDep['DOCTORADO']+$totFormFemContConRelDep['DOCTORADO']+$totFormMasContSinRelDep['DOCTORADO']+$totFormFemContSinRelDep['DOCTORADO']+$totFormMasConvenio['DOCTORADO']+$totFormFemConvenio['DOCTORADO'];?></td>
      </tr>
      <tr>
        <td>No estan en Ninguna Categoria </td>
        <td colspan="9"><div align="center"><?php echo $sumSinCat;?> <input name="create-cat" id="create-cat" type="button" value="..."></div></td>
        </tr>
      <tr>
        <td><strong>Total</strong></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totHomNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totHomNomb = $totHomNomb + $totFormMasNomb[$key];				
		}
		echo $totHomNomb;
		?>
		    </strong> </div></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totFemNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemNomb = $totFemNomb + $totFormFemNomb[$key];				
		}
		echo $totFemNomb;
		?>
		    </strong> </div></td>
        <td><strong>
          <?php 
		$totHomNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totHomNomb = $totHomNomb + $totFormMasContConRelDep[$key];				
		}
		echo $totHomNomb;
		?>
        </strong></td>
        <td><strong>
          <?php 
		$totFemNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemNomb = $totFemNomb + $totFormFemContConRelDep[$key];				
		}
		echo $totFemNomb;
		?>
        </strong></td>
        <td><strong>
          <?php 
		$totHomNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totHomNomb = $totHomNomb + $totFormMasContSinRelDep[$key];				
		}
		echo $totHomNomb;
		?>
        </strong></td>
        <td><strong>
          <?php 
		$totFemNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemNomb = $totFemNomb + $totFormFemContSinRelDep[$key];				
		}
		echo $totFemNomb;
		?>
        </strong></td>
        <td>
		  <div align="center"><strong>
		    <?php
		$totMasCont = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totMasCont = $totMasCont + $totFormMasConvenio[$key];				
		}
		echo $totMasCont;
		?>
		    </strong> </div></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totFemCont = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemCont = $totFemCont + $totFormFemConvenio[$key];				
		}
		echo $totFemCont;
		?>
		    </strong></div></td>
        <td><div align="center"><?php echo $totAll - $sumSinCat; ?></div></td>
      </tr>
    </table>


		<!--END RELACION LAB-->
		</p>
	</div>
		<h3><a href="#">HORAS POR NIVEL DE TITULACION</a></h3>
	<div>
		<p>
		<!--BEGIN RELACION LAB-->

		<!--END RELACION LAB-->
		</p>
	    <table cellspacing="0" cellpadding="0">
          <col >
          <col span="5">
          <tr>
            <td rowspan="2" ><?php echo "Profesores Desde: <strong>".$fecha_ini."</strong>Hasta: <strong>".$fecha_fin."</strong>"; ?></td>
            <td colspan="5"><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $sumCont;?></strong> no se procesaron: <strong><? echo $sumOtrosTwo;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $sumCont + $sumOtrosTwo ;?></strong> Prof.</div></td>
          </tr>
          <tr>
            <td>0-19 hrs.  </td>
            <td>20-29    hrs.  </td>
            <td>30-39    hrs.</td>
            <td>40    hrs</td>
			 <td>TOT</td>
          </tr>
          <tr>
            <td>Técnico    Superior   </td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["A"]; ?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["C"];?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["D"];?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["E"];?></td>
            <td><strong><?php  echo $sumPrior["TECNICO SUPERIOR"];?></strong></td>
          </tr>
          <tr>
            <td>Tecnológico    Superior </td>
            <td><?php echo $contClase["TECNOLOGO"]["A"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["C"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["D"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["E"];?></td>
		    <td><strong><?php  echo $sumPrior["TECNOLOGO"];?></strong></td>			
          </tr>
          <tr>
            <td>Tercer    Nivel </td>
            <td><?php echo $contClase["TERCER NIVEL"]["A"];?></td>
            <td><?php echo $contClase["TERCER NIVEL"]["C"];?></td>
            <td><?php echo $contClase["TERCER NIVEL"]["D"];?></td>
	        <td><?php echo $contClase["TERCER NIVEL"]["E"];?></td>
		    <td><strong><?php echo $sumPrior["TERCER NIVEL"];?></strong></td>
          </tr>
          <tr>
            <td>Doctor en    jurisprudencia o filosofía (III Doctor)</td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
            <td><strong><?php echo $sumPrior["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
		  </tr>
          <tr>
            <td>Diplomado    Superior </td>
            <td><?php echo $contClase["DIPLOMADO"]["A"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["C"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["D"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["E"];?></td>
			<td><strong><?php echo $sumPrior["DIPLOMADO"];?></strong></td>
          </tr>
          <tr>
            <td>Especialista </td>
            <td><?php echo $contClase["ESPECIALISTA"]["A"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["C"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["D"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["E"];?></td>
			<td><strong><?php echo $sumPrior["ESPECIALISTA"];?></strong></td>
          </tr>
          <tr>
            <td>Maestría (+IV Doctor)</td>
            <td><?php echo $contClase["MAGISTER"]["A"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["MAGISTER"]["C"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["MAGISTER"]["D"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["MAGISTER"]["E"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
			<td><strong><?php echo $sumPrior["MAGISTER"] + $sumPrior["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
          </tr>
          <tr>
            <td>Ph.D</td>
            <td><?php echo $contClase["DOCTORADO"]["A"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["C"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["D"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["E"];?></td>
            <td><strong><?php echo $sumPrior["DOCTORADO"];?></strong></td>
          </tr>
          <tr>
            <td>En ninguna categoria </td>
            <td colspan="5"><?php echo $sumOtrosTwo;?>
            <input name="create-user" id="create-user" type="button" value="..."></td>
          </tr>
          <tr>
            <td>Total</td>
            <td><strong>
            <?php echo $sumCat["A"];?>
            </strong></td>
            <td><strong>
            <?php echo $sumCat["C"];?>
            </strong></td>
            <td><strong>
            <?php echo $sumCat["D"];?>
            </strong></td>
            <td><strong>
            <?php echo $sumCat["E"];?>
            </strong></td>
			 <td><strong><?php echo $sumCont;?></strong></td>
          </tr>
        </table>
	</div>

	<h3><a href="#">EDAD PROMEDIO DE PROFESORES </a></h3>
	<div>
		<table>
          <col  span="2">
          <tr>
            <td><?php echo "Profesores Desde: <strong>".$fecha_ini."</strong>Hasta: <strong>".$fecha_fin."</strong>"; ?></td>
            <td><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $totAll - $edadError; ?></strong> no se procesaron: <strong><? echo $edadError;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $edadError + ($totAll -$edadError);?></strong> Prof. </div></td>
          </tr>
          <tr>
            <td>Hombres</td>
            <td><?php echo number_format($edadHombres, 2); ?></td>
          </tr>
          <tr>
            <td>Mujeres</td>
            <td><?php echo number_format($edadMujeres, 2); ?></td>
          </tr>
		  <tr>
            <td>Hombres y Mujeres </td>
            <td><?php echo number_format($edadTodos, 2); ?></td>
          </tr>
		  		  <tr>
            <td>Profesores sin edad </td>
            <td><?php echo $edadError; ?><input name="create-edad" id="create-edad" type="button" value="..."></td>
		  		  </tr>
        </table>
		<p>&nbsp;</p>
	</div>

	<h3><a href="#">PROFESORES POR FORMACION LISTADO</a></h3>
	<div>
		<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMADO",
		5	=>	"MAGISTER",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

		-->
		<table>
          <col  span="2">
          <tr>
            <td><?php echo "Profesores Desde: <strong>".$fecha_ini."</strong>Hasta: <strong>".$fecha_fin."</strong>"; ?></td>
            <td><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $totAll - $edadError; ?></strong> no se procesaron: <strong><? echo $swFormSnieseNull;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $swFormSnieseNull + ($totAll - $swFormSnieseNull);?></strong> Prof. </div></td>
          </tr>
          <tr>
            <td>TECNICO SUPERIOR</td>
            <td>
            <input name="create_tecnicosuperior" id="create_tecnicosuperior" type="button" value="<?php echo $totFormSniese['TECNICO SUPERIOR']; ?>"></td>
          </tr>
          <tr>
            <td>TECNOLOGICO SUPERIOR</td>
            <td>
            <input name="create_tecnologicosuperior" id="create_tecnologicosuperior" type="button" value="<?php echo $totFormSniese['TECNOLOGICO SUPERIOR']; ?>"></td>
          </tr>
		  <tr>
		    <td>TERCER NIVEL</td>
		    <td>
	        <input name="create_tercernivel" id="create_tercernivel" type="button" value="<?php echo $totFormSniese['TERCER NIVEL']; ?>"></td>
	      </tr>
		  <tr>
		    <td>DOCTOR EN FILOSOFIA O JURISPRUDENCIA</td>
		    <td>
	        <input name="create_doctorfilosofia" id="create_doctorfilosofia" type="button" value="<?php echo $totFormSniese['DOCTOR EN FILOSOFIA O JURISPRUDENCIA']; ?>"></td>
	      </tr>
		  <tr>
            <td>DIPLOMA SUPERIOR</td>
            <td>
            <input name="create_diplomado" id="create_diplomado" type="button" value="<?php echo $totFormSniese['DIPLOMA SUPERIOR']; ?>"></td>
          </tr>
		  		  <tr>
		  		    <td>MAGISTER</td>
		  		    <td>
	  		        <input name="create_magister" id="create_magister" type="button" value="<?php echo $totFormSniese['MAESTRIA']; ?>"></td>
	      </tr>
		  		  <tr>
		  		    <td>ESPECIALISTA</td>
		  		    <td>
	  		        <input name="create_especialista" id="create_especialista" type="button" value="<?php echo $totFormSniese['ESPECIALISTA']; ?>"></td>
	      </tr>
		  		  <tr>
		  		    <td>DOCTORADO</td>
		  		    <td>
	  		        <input name="create_doctorado" id="create_doctorado" type="button" value="<?php echo $totFormSniese['DOCTORADO']; ?>"></td>
	      </tr>
		  		  <tr>
            <td>OTROS</td>
            <td><input name="create_otros" id="create_otros" type="button" value="<?php echo $swFormSnieseNull; ?>"></td>
		  		  </tr>
				  <tr>
				  <td>Total Profesores</td>
				  <td><?php echo $sumFormSn + $swFormSnieseNull; ?></td>
				  </tr>
        </table>
		<p>&nbsp;</p>
	</div>

</div>

</div><!-- End demo -->



<!--END ACCORDION-->

<!--modal-->



<?php $tot = count($arrSinForm);?>
<div id="dialog-form" title="Profesores sin Formacion">

	<p class="validateTips">Se encontraron <?php echo $tot; ?> Profesores sin Formación.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrSinForm[$i]["serial_epl"]."</td>
					<td>".$arrSinForm[$i]["nombre"]."</td>
					<td>".$arrSinForm[$i]["formacion"]."</td>
					<td>".$arrSinForm[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>
<!--SEXO-->
<?php $tot = count($arrSinSex);?>
<div id="sex-form" title="Prof sin Genero">
	<p class="validateTips">Listado de <?php echo $tot; ?> Prof sin Genero.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Genero</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrSinSex[$i]["serial_epl"]."</td>
					<td>".$arrSinSex[$i]["nombre"]."</td>
					<td>".$arrSinSex[$i]["genero"]."</td>
					<td>".$arrSinSex[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<?php $tot = count($arrSinCat);?>
<div id="cat-form" title="Prof sin Categoria">
	<p class="validateTips">Listado de <?php echo $tot; ?> Prof sin Categoria.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Categoria</th>
				<th>Formacion</th>
				<th>Genero</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrSinCat[$i]["serial_epl"]."</td>
					<td>".$arrSinCat[$i]["nombre"]."</td>
					<td>".$arrSinCat[$i]["categoria"]."</td>
					<td>".$arrSinCat[$i]["formacion"]."</td>
					<td>".$arrSinCat[$i]["genero"]."</td>
					<td>".$arrSinCat[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<?php $tot = count($arrSinEdad);?>
<div id="edad-form" title="Prof sin Genero">
	<p class="validateTips">Listado de <?php echo $tot; ?> Prof sin Edad.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Edad</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrSinEdad[$i]["serial_epl"]."</td>
					<td>".$arrSinEdad[$i]["nombre"]."</td>
					<td>".$arrSinEdad[$i]["edad"]."</td>
					<td>".$arrSinEdad[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>
<!--Sin formacion Sniese-->
<?php $tot = count($arrFormSnieseTit8);?>
<div id="otros-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Prof sin Form Sniese.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit8[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit8[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit8[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit8[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--DOCTORADO-->
<?php $tot = count($arrFormSnieseTit7);?>
<div id="doctorado-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Doctores PHD.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit7[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit7[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit7[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit7[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--ESPECIALISTA-->
<?php $tot = count($arrFormSnieseTit6);?>
<div id="especialista-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Especialistas.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit6[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit6[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit6[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit6[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--MAGISTER-->
<?php $tot = count($arrFormSnieseTit5);?>
<div id="magister-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Magisters.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit5[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit5[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit5[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit5[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->
<!--DIPLOMA SUPERIOR-->
<?php $tot = count($arrFormSnieseTit4);?>
<div id="diplomado-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Diplomados.</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit4[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit4[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit4[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit4[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->
<!--DOCTOR EN FILOSOFIA O JURISPRUDENCIA-->
<?php $tot = count($arrFormSnieseTit3);?>
<div id="doctorfilosofia-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Doctores en Filosofia o J..</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit3[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit3[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit3[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit3[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->
<!--TERCER NIVEL-->
<?php $tot = count($arrFormSnieseTit2);?>
<div id="tercernivel-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> Tercer Nivel</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit2[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit2[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit2[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit2[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->
<!--TECNOLOGICO SUPERIOR-->
<?php $tot = count($arrFormSnieseTit1);?>
<div id="tecnologicosuperior-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> TECNOLOGICO SUPERIOR</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit1[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit1[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit1[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit1[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--
		0	=>	"TECNICO SUPERIOR",
		1	=>	"TECNOLOGICO SUPERIOR",
		2	=>	"TERCER NIVEL",
		3	=>	"DOCTOR EN FILOSOFIA O JURISPRUDENCIA",
		4	=>	"DIPLOMA SUPERIOR",
		5	=>	"MAESTRIA",
		6	=>	"ESPECIALISTA",
		7	=>	"DOCTORADO"

-->

<!--TECNICO SUPERIOR-->
<?php $tot = count($arrFormSnieseTit0);?>
<div id="tecnicosuperior-form" title="Formacion Sniese">
	<p class="validateTips">Listado de <?php echo $tot; ?> TECNOLOGICO SUPERIOR</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Id</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Sucursal</th>
			</tr>
		</thead>
		<tbody>

				<?php $j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrFormSnieseTit0[$i]["serial_epl"]."</td>
					<td>".$arrFormSnieseTit0[$i]["nombre"]."</td>
					<td>".$arrFormSnieseTit0[$i]["formacion"]."</td>
					<td>".$arrFormSnieseTit0[$i]["sucursal"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>

<!--TECNICO SUPERIOR-->
<?php $tot = count($arrMain);?>
<div id="mainlistado-form" title="Principal Formacion por Tipo de Relación Laboral">
	<p class="validateTips">Listado de <?php echo count($arrMain); ?> Listado General</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Nombre</th>
				<th>Formacion</th>
				<th>Contrato</th>
				<th>Sexo</th>
			</tr>
		</thead>
		<tbody>

				<?php 				
				
				$j=1;				
				for($i=0;$i<$tot;$i++){
					echo "
					<tr>
					<td>".$j."</td>
					<td>".$arrMain[$i]["nombre"]."</td>
					<td>".$arrMain[$i]["formaciongen"]."</td>
					<td>".$arrMain[$i]["nombre_tct"]."</td>
					<td>".$arrMain[$i]["sexo_epl"]."</td>
					</tr>		
					";
					$j++;
				}
				?>
			
		</tbody>
	</table>

	</form>
</div>



<!--<button id="create-user">Create new user</button>-->





<!--modal-->



</body>
</html>

<?php
/**
* Funciones PHP
*/

/**
	Función que retorna un array con todos los datos nivel de formación  		
	de acuerdo a un tipo de formacion enviado comparandolos con una prioridad 
	definida atenriormente.
	
	* @author	MPC
	* @version	1.0
	* @date     28/03/2011
	* @return 	array o -1 si no hay datos
	* @param 	string $serial_epl serial del empleado
	* @param 	string $tipo tercero o cuarto nivel 	
	* @param 	mixed $dblink mantiene conexion a la bd		
*/
function formacionProf($serial_epl,$tipo,$dblink){
	switch($tipo){
	case 'TERCER NIVEL':
		$tipo = "AND nombre_nac in ('TERCER NIVEL',
									'TECNICO SUPERIOR',
									'TECNOLOGO',
									'III DOCTOR EN JURISPRUDENCIA O FILOSOFIA')";						
		$arrPrior = $GLOBALS['arrTercerNivel'];		
		break;
	case 'CUARTO NIVEL':
		$tipo = "AND nombre_nac in ('MAGISTER',
									'CUARTO NIVEL',
									'ESPECIALISTA',
									'DOCTORADO',
									'DIPLOMADO',
									'IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA')";						
		$arrPrior = $GLOBALS['arrCuartoNivel'];
		break;
	
	}
	$sqlForm = "
	SELECT 
		serial_foa,
		tipoTitulo_foa, 
		descripcion_foa,  
		institucion_foa,
		fechainicio_foa, 
		fechafin_foa, 
		aniograduacion_foa, 
		nombre_nac, 
		regconesup_foa,  
		nombre_pai, 
		fecregconesup_foa, 
		formacionacademica.mayortitulo_foa, 
		formacionacademica.serial_pai, 
		formacionacademica.serial_epl, 
		formacionacademica.serial_nac 
	FROM 
		pais, formacionacademica, empleado, nivelacademico 
	WHERE 
		empleado.serial_epl = formacionacademica.serial_epl 
		AND formacionacademica.serial_nac = nivelacademico.serial_nac 
		AND formacionacademica.serial_pai = pais.serial_pai 
		AND formacionacademica.serial_epl = ".$serial_epl."
		".$tipo."
	";		
	//echo "<br>".$sqlForm."<br>";
	if($arrForm = $dblink->GetAll($sqlForm)){
		$nReg = count($arrForm);
		$nPrior = count($arrPrior);
		$sw = 0;		
		if($nReg>=1){
			for($i=0;$i<$nPrior;$i++){
					for($j=0;$j<$nReg;$j++){
						 //echo "<br>COMPARACION: ".$arrForm[$j]['nombre_nac']." => ".$arrPrior[$i]."<br>";
						 if($arrForm[$j]['nombre_nac']==$arrPrior[$i]){
							$formPos = $j;
							$sw = 1;
							$j = $nReg;
							$i = $nPrior;
						 }					 
					}			
			}
		}else{
			return -1;
		}	
		if($sw==1){			
		//	if(strcmp($arrForm[$formPos]['descripcion_foa'],$arrForm[$formPos]['tipoTitulo_foa']) == 0){
				$tituloTemp = $arrForm[$formPos]['tipoTitulo_foa'];
			/*}else{
				$tituloTemp = $arrForm[$formPos]['descripcion_foa']." - ".$arrForm[$formPos]['tipoTitulo_foa'];
			}*/
			$arrFormMay = array(
				"titulo" =>$tituloTemp, 				
				"institucion" => $arrForm[$formPos]['institucion_foa'],
				"nivel" => $arrForm[$formPos]['nombre_nac'],
				"pais" => $arrForm[$formPos]['nombre_pai'],
				"registro" => $arrForm[$formPos]['regconesup_foa']	
			);
			return $arrFormMay;
		}else{
			return -1;
		}		
	}else{
		return -1;
	}
}

/**
	Función que retorna las horas académicas dictadas por un profesor
	relacion hora/semana basandose en los periodos que ha dictado clases
	
	REGLAS
		* 1 credito = 16 horas, 
		  Periodo Regular 	: 11 semanas
		  Periodo Intensivo : 5 semanas		  
		  16*30
	
	EJEMPLOS:
		* 1)Un profesor dicto 3 creditos en varios periodos regulares obtener
		  	el numero de horas semanales.		
		 	3 creditos = 16*3 = 48 horas;
			(48 horas) dividido para (11 semanas) = 4.36 horas/semanas. 			
			1 es 16 horas trimestrales
			
		 
		* 2) Un profesor dicto 3 creditos regulares y 3 mas en periodos intensivos
		     obtener el numero de horas por semana
			 3 creditos = 16*3 = 48
			 Periodo Regular:
			 	(48 horas) dividido para (11 semanas) = 4.36 horas/semanas. 			
			 Periodo Intensivo:
			 	(48 horas) dividido para (5 semanas) = 9.6 horas/semanas. 			 
		   	 pàra el total se obtiene el promedio
			 	(4.36 + 9.6	) /2 = 6.98 horas/semana		
		
	
	* 	@author		MPC 
	* 	@version	1.0
	* 	@date     	28/03/2011
	* 	@return 	float o false si no hay datos
	* 	@param 		string $serial_epl serial del empleado
	* 	@param 		string $serial_sec seccion del empleado 	
	* 	@param 		string $serial_suc sucursal evaluar
	* 	@param 		mixed $dblink mantiene conexion a la bd		
*/

function HorasAcad($serial_epl,$serial_sec,$dblink){
	$sqlGet = "
		SELECT
			hrr.serial_hrr,
			dmat.serial_dmat,
			mmat.serial_mmat,
			mat.serial_mat,
			mat.nombre_mat,
			hrr.serial_epl,
			'' as tcredito,
			concat_ws(' ',apellido_epl,nombre_epl)                                          
			AS empleado,
			mmat.serial_alu,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, 
			nombre2_alu) AS alumno,	
			nombre_per,
			nombre_suc,
			activo_mmat,
			intensivo_per,
			mmat.serial_sec
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			materia                   AS mat,
			empleado                  AS epl,
			horario                   AS hrr,
			sucursal                  AS suc,
			alumno                    AS alu 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND mmat.serial_per = per.serial_per 
			AND dmat.serial_mat = mat.serial_mat 
			AND dmat.serial_hrr = hrr.serial_hrr 
			AND hrr.serial_epl = epl.serial_epl 
			AND mmat.serial_alu = alu.serial_alu 
			AND suc.serial_suc = mmat.serial_suc 
			AND per.serial_sec = ".$serial_sec."
			AND epl.serial_epl = ".$serial_epl." 
			AND mmat.activo_mmat = 'SI' 
			AND fecini_per >='".$GLOBALS['fecha_ini']."' 
			AND fecini_per <='".$GLOBALS['fecha_fin']."' 
			AND estado_hrr = 'ACTIVO' 
		GROUP BY
			hrr.serial_hrr 
		ORDER BY
			tcredito	
		";
	$swCountPerRegulares = 0;
	$swCountPerIntensivo = 0;
	if($arr = $dblink->GetAll($sqlGet)){
		$sumPerReg = 0;
		$sumPerInt = 0;
		for($i=0;$i<count($arr);$i++){
			$mat = getMat($arr[$i]['serial_mat'],$arr[$i]['serial_sec'],$dblink);
			if($mat){
				if($mat[0]['numerocreditos_dma'] == 0){
					$arr[$i]['tcredito'] = $creditoDefaultMallaCero = 3;
				}else{
					$arr[$i]['tcredito'] = $mat[0]['numerocreditos_dma'];					
				}
			}else{
				$arr[$i]['tcredito'] = 0;
			}
			if($arr[$i]['intensivo_per']== "NO"){
				$sumPerReg = $sumPerReg + $arr[$i]['tcredito'];				
				$swCountPerRegulares++;
			}else{
				$sumPerInt = $sumPerInt + $arr[$i]['tcredito'];				
				$swCountPerIntensivo++;				
			}	
		}
		//print "<pre>"; print_r($arr); print "<pre>";
		if($sumPerReg==0 or $sumPerInt==0){
			$div = 1;
		}else{
			$div = 2;
		}
		if($swCountPerRegulares == 0){			
			$divRegulares = 1;
		}else{
			$divRegulares = $swCountPerRegulares;
		}
		if($swCountPerIntensivo == 0){
			$divIntensivos = 1;
		}else{
			$divIntensivos = $swCountPerIntensivo;
		}
		$periodoRegular = ($sumPerReg * 1.62 )/ $divRegulares;
		$periodoIntensivo = ($sumPerInt * 3.2) / $divIntensivos;
		$prom = ($periodoRegular + $periodoIntensivo)/$div;				
		return number_format($prom,2);
	}else{
		return false;
	}	

}
/**
	Funcion que Retorna una materia con su credito 
	de la malla, ya que todas las materias de cualquier malla
	tienen la misma cantidad de creditos, subfuncion utilizada 
	dentro de la fucion de HorasAcad()
	
	* @author	MPC
	* @version	1.0
	* @date     28/03/2011
	* @return 	array o -1 si no hay datos
	* @param 	string $serial_mat serial de la materia
	* @param 	string $serial_sec serial de la seccion 	
	* @param 	mixed $dblink mantiene conexion a la bd		
*/
function getMat($serial_mat,$serial_sec,$dblink){
	$sqlGet = "
	SELECT
		DISTINCT dmat.serial_mat,
		mat.nombre_mat,
		dmat.numerocreditos_dma 
	FROM
		materia      AS mat,
		detallemalla AS dmat,
		malla        AS maa 
	WHERE
		mat.serial_mat = dmat.serial_mat AND		
		maa.serial_maa = dmat.serial_maa AND
		maa.serial_sec = ".$serial_sec." AND
		dmat.serial_mat = ".$serial_mat."
	ORDER BY
		nombre_mat	
	";	
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		return $arr;
	}else{
		return false;
	}
}

/**
	Funcion que Retorna el nivel de formacion mayor de un 
	empleado evaluando de una lista de criterios 
	previamente definida
	
	* @author	MPC
	* @version	1.0
	* @date     28/03/2011
	* @return 	string o false si no hay datos
	* @param 	string $serial_epl serial del empleado
	* @param 	mixed $dblink mantiene conexion a la bd		
*/
function evalFormProf($serial_epl,$dblink){
	$sqlGet = "
		SELECT 
			serial_foa,
			empleado.serial_epl,
			nombre_nac 
		FROM 
			pais, formacionacademica, empleado, nivelacademico 
		WHERE 
			empleado.serial_epl = formacionacademica.serial_epl 
			AND formacionacademica.serial_nac = nivelacademico.serial_nac 
			AND formacionacademica.serial_pai = pais.serial_pai 
			AND formacionacademica.serial_epl = ".$serial_epl."	
	";		
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){						
		$arrPrior = $GLOBALS['arrMainPrior'];
		$nPrior = count($arrPrior);
		$nReg = count($arr);
		$sw = 0;
		for($i=0;$i<$nPrior ;$i++){
			for($j=0;$j<$nReg;$j++){
			 	//echo $arr[$j]['nombre_nac']." => ".$arrPrior[$i]."<br>";
				if($arr[$j]['nombre_nac'] == $arrPrior[$i]){
					$pos = $j;
					$sw = 1;
					$j = $nReg;
					$i = $nPrior;
				}					 
			}			
		}
		if($sw==1){
			return $arr[$pos]['nombre_nac'];
		}else{
			return false;
		}			
	}else{
		return false;
	}
}

/**
* Funcion que retorna el total de horas de investigacion de un profesor
	* @author	MPC
	* @version	1.0
	* @date     12/04/2011
	* @return 	float o false si no hay datos
	* @param 	string $serial_epl serial del empleado
	* @param 	mixed $dblink mantiene conexion a la bd		

*/
function getHorasInvestigacion($serial_epl,$dblink){
	$sqlGet = "
		SELECT
			serial_epl,
			sum(horasdedicacion_inv) as thoras
		FROM
			investigacionesprofesor
		WHERE
			serial_epl = ".$serial_epl."
			AND fecha_inv>= '".$GLOBALS['fecha_ini']."' 
			AND fecha_inv<= '".$GLOBALS['fecha_fin']."' 			
		GROUP BY 
			serial_epl
		ORDER BY 
			thoras
	";
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		return number_format($arr[0]['thoras']/$GLOBALS['totalSemana'],2); 
	}else{
		return false;
	}
}

/**
* Funcion que retorna el total de horas de Vinculacion de un profesor
	* @author	MPC
	* @version	1.0
	* @date     12/04/2011
	* @return 	float o false si no hay datos
	* @param 	string $serial_epl serial del empleado
	* @param 	mixed $dblink mantiene conexion a la bd		

*/
function getHorasVinculacion($serial_epl,$dblink){
	$sqlGet = "
		SELECT
			serial_epl,
			sum(horadedicacion_vcp) as thoras
		FROM
			vincucomunidadprofesor 
		WHERE
			serial_epl = ".$serial_epl."
			AND fecha_vcp>= '".$GLOBALS['fecha_ini']."' 
			AND fecha_vcp<= '".$GLOBALS['fecha_fin']."' 			
		group by 
			serial_epl
		order by 
			thoras
	";
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		return number_format($arr[0]['thoras']/$GLOBALS['totalSemana'],2); 
	}else{
		return false;
	}
}
/**
* Funcion que busca si el profesor es tambien empleado administrativo
	* @author	MPC
	* @version	1.0
	* @date     12/04/2011
	* @return 	true o false si no hay datos
	* @param 	string $id celula del empleado
	* @param 	mixed $dblink mantiene conexion a la bd		

*/
function getHorasAdministrativa($id,$dblink){
	$sqlGet = "
		SELECT
			serial_epl,
			COUNT(*) nveces
		FROM
			empleado 
		where
		DOCUMENTOIDENTIDAD_EPL = '".$id."'
		group by 
		DOCUMENTOIDENTIDAD_EPL

	";
	if($arr = $dblink->GetAll($sqlGet)){
		if($arr[0]['nveces']>=2){
			return true;
		}else{
			return false;
		}		
	}else{
		return false;
	}
}

/**
* Funcion que retorna el total de horas de Vinculacion de un profesor
	* @author	MPC
	* @version	1.0
	* @date     12/04/2011
	* @return 	float o false si no hay datos
	* @param 	string $serial_epl serial del empleado
	* @param 	mixed $dblink mantiene conexion a la bd		

*/
function getEventoAcademico($serial_epl,$tipo,$dblink){
	$sqlGet = "
		SELECT
			serial_epl,
			tcap.descripcion_tcap 
		FROM
			capacitacionpersonal AS cap,
			tipocapacitacion     AS tcap 
		WHERE
			cap.serial_tcap = tcap.serial_tcap 
			AND serial_epl = ".$serial_epl." 
			AND fechainicio_cap>= '".$GLOBALS['fecha_ini']."' 
			AND fechainicio_cap<= '".$GLOBALS['fecha_fin']."' 
		ORDER BY
			tcap.serial_tcap
	";	
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		switch($tipo){
			case "SOLOEVENTO":
				return true;
				break;
			case "INTERNACIONAL":
				$tRows = count($arr);
				$swSearch = 0;
				for($i=0;$i<$tRows;$i++){				
					//strpos($mystring, $findme);
					$searchExt = ereg("INTERNACIONAL",strtoupper($arr[$i]['descripcion_tcap']));
					if($searchExt){					
						$i = $tRows;
						$swSearch = 1;					
					}				
				}
				if($swSearch==1){
					return true;
				}else{
					return false;
				}
				break;
		}		
	}else{
		return false;
	}
}
/*
*
*/
function getTipoProfesorInvestigadorPermanente($serial_epl){
	$arr = $GLOBALS['arrProfInvPerm'];
	$totArr = count($arr);
	$sw = 0;
	for($i=0;$i<$totArr;$i++){
		if($serial_epl == $arr[$i]['serial_epl']){
			$sw = 1;
			$i = $totArr;
		}
	}
	if($sw == 1){
		return true;
	}else{
		return false;
	}
}

?>

