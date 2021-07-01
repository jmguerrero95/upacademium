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
		1 => "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		2 => "MAGISTER",
		3 => "DIPLOMADO",			 
		4 => "ESPECIALISTA"			 
	);
$arrCat = 
	array(
		0 => "A",
		1 => "B",
		2 => "C",				
		3 => "D",
		4 => "E"		
	);

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
	$seccion = "";		
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
	email_epl,
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
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	FECHANACIMIENTO_EPL as fnacimiento,
	sexo_epl,
	nombre_fac,
	formacontrato_epl,	
	fingresonomina_epl,
	nombre_car,
	niv.nombre_nac,
    nna.nombre_nac as nacionalidad,
	formaContrato_epl,
	nombre_fac,
	periodo.serial_suc,
	nombre_suc,
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
	
GROUP BY
	hrr.serial_epl
ORDER BY
	apellido_epl	
";
// and hrr.SERIAL_EPL in (360,1783,362,112) vacias sin hacad
//and hrr.SERIAL_EPL in (1773,1805,1144,356,1469) sin formacion
//and hrr.SERIAL_EPL in (1773,1805,1144,356,1469)	
//echo "<br>".$sqlProf."<br>";
//	and hrr.SERIAL_EPL in (219,94,259,1374)
$arrMain = $dblink->GetAll($sqlProf);
$totAll = count($arrMain);
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
		//Set Codigo Institucion
		$arrMain[$i]['codigo_institucion'] = $codigoInstitucion." => ".$arrMain[$i]['serial_epl'];
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
			$arrMain[$i]['titulo_tn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_tn'] = $arrForm['institucion'];
			$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
			$arrMain[$i]['pais_tn'] = $arrForm['pais'];
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
			$arrMain[$i]['titulo_cn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_cn'] = $arrForm['institucion'];
			$arrMain[$i]['nivel_cn'] = $arrForm['nivel'];
			$arrMain[$i]['pais_cn'] = $arrForm['pais'];
			$arrMain[$i]['registro_cn'] = $arrForm['registro'];
		}else{
			$arrMain[$i]['titulo_cn'] = "&nbsp;";
			$arrMain[$i]['institucion_cn'] = "&nbsp;";
			$arrMain[$i]['nivel_cn'] = "&nbsp;";
			$arrMain[$i]['pais_cn'] = "&nbsp;";
			$arrMain[$i]['registro_cn'] = "&nbsp;";		
		}
		//Set del nivel de formacio General por prioridad
		$arr = evalFormProf($arrMain[$i]['serial_epl'],$dblink);
		if($arr){
			$arrMain[$i]['nombre_nac'] = $arr;
		}else{
			$arrMain[$i]['nombre_nac']='';
		}

		//Cargo Administrativo
		if(trim($arrMain[$i]['nombre_car'])!=""){
			$arrMain[$i]['cargo'] = $arrMain[$i]['nombre_car'];		
		}else{
			$arrMain[$i]['cargo'] = "";		
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
		//
		//Set Email
		if(trim($arrMain[$i]['email_epl'])!=""){
			$arrMain[$i]['email_epl'] = $arrMain[$i]['email_epl'];		
		}else{
			$arrMain[$i]['email_epl'] = "";		
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
	$totFormMasCont[$key] = 0;	
	$totFormFemCont[$key] = 0;	
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

$nombramiento = "NOMBRAMIENTO - Con relacion de dependencia";
$contrato = "CONTRATO - Sin relacion de dependencia";
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
$sumOtrosCat = 0;
$totSinGen = 0;
$sumSinCat = 0;
$swCat = 0;
$sumConCat = 0;
$edadError = 0;
for($i=0;$i<$totAll;$i++){	
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
	if($key == "" or $key == "TITULO TEMPORAL" or $key == "SIN TITULO" or $arrMain[$i]['serial_tct']==1 or  $arrMain[$i]['serial_tct']==2 or $arrMain[$i]['serial_tct']==3 or $arrMain[$i]['serial_tct']==4 or $arrMain[$i]['serial_tct']==5 or $arrMain[$i]['serial_tct']==6 or $arrMain[$i]['serial_tct']==7){
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
				
				if($arrMain[$i]['nombre_tct']==$nombramiento or $arrMain[$i]['nombre_tct']==$contrato){
					switch($arrMain[$i]['nombre_tct']){
						case $nombramiento: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasNomb[$key]++;
									break;	 	
								case "FEMENINO": 
									$totFormMasNomb[$key]++; 
									break;	
							}
							break;
						case $contrato: 
							switch($arrMain[$i]['sexo_epl']){
								case "MASCULINO": 
									$totFormMasNomb[$key]++;
									break;	 	
								case "FEMENINO": 
									$totFormMasNomb[$key]++; 
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
	}else{	
		$horaAcadem =  $arrMain[$i]['horaacademica'];
		for($k=0;$k<$totForm;$k++){
			if($key == $arrMainPrior[$k]){
				if($horaAcadem>=0 and $horaAcadem<10){
					$contClase[$key]["A"]++;				
				}
				if($horaAcadem>=10 and $horaAcadem<20){
					$contClase[$key]["B"]++;							
				}
				if($horaAcadem>=20 and $horaAcadem<30){
					$contClase[$key]["C"]++;	
				}
				if($horaAcadem>=30 and $horaAcadem<40){
					$contClase[$key]["D"]++;				
				}
				if($horaAcadem>=40){
					$contClase[$key]["E"]++;							
				}	
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
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Profesores PEI</title>

<link rel="stylesheet" type="text/css" href="jqueryuin/css/defpei.css" media="screen" />
	<link rel="stylesheet" href="jqueryuin/development-bundle/themes/base/jquery.ui.all.css">	
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
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true
		});
	});
	</script>
</head><body>

<div id="content">
<div id="itsthetable">
<a href="#resumen">Resumen</a>
<a name="inicio"></a>
<table summary="Profesores PEI">
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
	
	</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="40"><?php echo $totAll." PROFESORES";?></td>
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
				<td><?php echo $arrMain[$i]['direccion_epl']; ?></a></td>
				<td><?php echo $arrMain[$i]['documentoidentidad_epl']; ?></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['apellido_paterno'];?></a></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['apellido_materno'];?></a></td>
				<td><a href="#" title="Nombre"><?php echo $arrMain[$i]['nombre_epl'] ?></a></td>
				<td><?php echo $arrMain[$i]['sexo_epl'] ?></td>
				<td><?php echo $arrMain[$i]['nacionalidad'] ?></td>
				<td><?php echo $arrMain[$i]['fechanacimiento_epl'] ?></td>
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
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo $arrMain[$i]['cargo']; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo $arrMain[$i]['horaacademica']; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo "&nbsp;"; ?></td>
				<td><?php echo $arrMain[$i]['email_epl'] ?></td>


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
        <td colspan="6" ><div align="center"><strong>N&uacute;mero    total de profesores(as) por tipo de relaci&oacute;n laboral y nivel de formaci&oacute;n    .</strong></div></td>
      </tr>
      <tr>
        <td rowspan="3"><?php echo "Profesores Desde: <strong>".$fecha_ini."</strong>Hasta: <strong>".$fecha_fin."</strong>"; ?></td>
        <td colspan="5"><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $totAll - $sumSinCat; ?></strong> no se procesaron: <strong><? echo $sumSinCat;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $sumSinCat + ($totAll - $sumSinCat);?></strong> Prof. </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Nombramiento</div></td>
        <td colspan="2"><div align="center">Contrato</div></td>
        <td rowspan="2"><div align="center">TOTAL</div></td>
      </tr>
      <tr>
        <td><div align="center">H</div></td>
        <td><div align="center">M</div></td>
        <td><div align="center">H</div></td>
        <td><div align="center">M</div></td>
      </tr>
      <tr>
        <td>T&eacute;cnico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasCont['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemCont['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR']+$totFormFemNomb['TECNICO SUPERIOR']+$totFormMasCont['TECNICO SUPERIOR']+$totFormFemCont['TECNICO SUPERIOR'];?> </td>
      </tr>
      <tr>
        <td>Tecnol&oacute;gico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasCont['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemCont['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasNomb['TECNOLOGO']+$totFormFemNomb['TECNOLOGO']+$totFormMasCont['TECNOLOGO']+$totFormFemCont['TECNOLOGO'];?></td>
      </tr>
      <tr>
        <td>Tercer Nivel</td>
        <td><?php echo $totFormMasNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasCont['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemCont['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasNomb['TERCER NIVEL']+$totFormFemNomb['TERCER NIVEL']+$totFormMasCont['TERCER NIVEL']+$totFormFemCont['TERCER NIVEL'];?></td>
      </tr>
      <tr>
        <td>Doctor en    jurisprudencia o filosof&iacute;a (III Doctor) </td>
        <td><?php echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasCont['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemCont['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasCont['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemCont['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
      </tr>
      <tr>
        <td>Diplomado    Superior</td>
        <td><?php echo $totFormMasNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasCont['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemCont['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasNomb['DIPLOMADO']+$totFormFemNomb[' DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasCont['DIPLOMADO']+$totFormFemCont['DIPLOMADO'];?></td>
      </tr>
      <tr>
        <td>Especialista</td>
        <td><?php echo $totFormMasNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasCont['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemCont['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasNomb['ESPECIALISTA']+$totFormFemNomb['ESPECIALISTA']+$totFormMasCont['ESPECIALISTA']+$totFormFemCont['DIPLOMADO'];?></td>
      </tr>
      <tr>
        <td>Maestr&iacute;a (+IV Doctor) </td>
        <td><?php echo $totFormMasNomb['MAGISTER'] + $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['MAGISTER'] + $totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasCont['MAGISTER'] + $totFormMasCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemCont['MAGISTER'] + $totFormFemCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasNomb['MAGISTER']+$totFormFemNomb['MAGISTER']+$totFormMasCont['MAGISTER']+$totFormFemCont['MAGISTER'] + $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasCont['MAGISTER']+$totFormFemCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
      </tr>
      <tr>
        <td>Ph.D</td>
        <td><?php echo $totFormMasNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormFemNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormMasCont['DOCTORADO'];?></td>
        <td><?php echo $totFormFemCont['DOCTORADO'];?></td>
        <td><?php echo $totFormMasNomb['DOCTORADO']+$totFormFemNomb['DOCTORADO']+$totFormMasCont['DOCTORADO']+$totFormFemCont['DOCTORADO'];?></td>
      </tr>
      <tr>
        <td>No estan en Ninguna Categoria </td>
        <td colspan="5"><div align="center"><?php echo $sumSinCat;?> <input name="create-cat" id="create-cat" type="button" value="..."></div></td>
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
        <td>
		  <div align="center"><strong>
		    <?php
		$totMasCont = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totMasCont = $totMasCont + $totFormMasCont[$key];				
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
			$totFemCont = $totFemCont + $totFormFemCont[$key];				
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
            <td colspan="6"><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $sumCont;?></strong> no se procesaron: <strong><? echo $sumOtrosTwo;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $sumCont + $sumOtrosTwo ;?></strong> Prof.</div></td>
          </tr>
          <tr>
            <td>0-9 hrs.  </td>
            <td>10-19    hrs.  </td>
            <td>20-29    hrs.  </td>
            <td>30-39    hrs.</td>
            <td>40    hrs</td>
			 <td>TOT</td>
          </tr>
          <tr>
            <td>Técnico    Superior   </td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["A"]; ?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["B"];?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["C"];?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["D"];?></td>
            <td><?php echo $contClase["TECNICO SUPERIOR"]["E"];?></td>
            <td><strong><?php  echo $sumPrior["TECNICO SUPERIOR"];?></strong></td>
          </tr>
          <tr>
            <td>Tecnológico    Superior </td>
            <td><?php echo $contClase["TECNOLOGO"]["A"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["B"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["C"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["D"];?></td>
            <td><?php echo $contClase["TECNOLOGO"]["E"];?></td>
		    <td><strong><?php  echo $sumPrior["TECNOLOGO"];?></strong></td>			
          </tr>
          <tr>
            <td>Tercer    Nivel </td>
            <td><?php echo $contClase["TERCER NIVEL"]["A"];?></td>
            <td><?php echo $contClase["TERCER NIVEL"]["B"];?></td>
            <td><?php echo $contClase["TERCER NIVEL"]["C"];?></td>
            <td><?php echo $contClase["TERCER NIVEL"]["D"];?></td>
	        <td><?php echo $contClase["TERCER NIVEL"]["E"];?></td>
		    <td><strong><?php echo $sumPrior["TERCER NIVEL"];?></strong></td>
          </tr>
          <tr>
            <td>Doctor en    jurisprudencia o filosofía (III Doctor)</td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["B"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
            <td><strong><?php echo $sumPrior["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
		  </tr>
          <tr>
            <td>Diplomado    Superior </td>
            <td><?php echo $contClase["DIPLOMADO"]["A"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["B"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["C"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["D"];?></td>
            <td><?php echo $contClase["DIPLOMADO"]["E"];?></td>
			<td><strong><?php echo $sumPrior["DIPLOMADO"];?></strong></td>
          </tr>
          <tr>
            <td>Especialista </td>
            <td><?php echo $contClase["ESPECIALISTA"]["A"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["B"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["C"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["D"];?></td>
            <td><?php echo $contClase["ESPECIALISTA"]["E"];?></td>
			<td><strong><?php echo $sumPrior["ESPECIALISTA"];?></strong></td>
          </tr>
          <tr>
            <td>Maestría (+IV Doctor)</td>
            <td><?php echo $contClase["MAGISTER"]["A"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["MAGISTER"]["B"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["B"];?></td>
            <td><?php echo $contClase["MAGISTER"]["C"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["MAGISTER"]["D"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["MAGISTER"]["E"] + $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
			<td><strong><?php echo $sumPrior["MAGISTER"] + $sumPrior["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
          </tr>
          <tr>
            <td>Ph.D</td>
            <td><?php echo $contClase["DOCTORADO"]["A"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["B"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["C"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["D"];?></td>
            <td><?php echo $contClase["DOCTORADO"]["E"];?></td>
            <td><strong><?php echo $sumPrior["DOCTORADO"];?></strong></td>
          </tr>
          <tr>
            <td>En ninguna categoria </td>
            <td colspan="6"><?php echo $sumOtrosTwo;?>
            <input name="create-user" id="create-user" type="button" value="..."></td>
          </tr>
          <tr>
            <td>Total</td>
            <td><strong>
            <?php echo $sumCat["A"];?>
            </strong></td>
            <td><strong>
            <?php echo $sumCat["B"];?>
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
			$arrFormMay = array(
				"titulo" => $arrForm[$formPos]['descripcion_foa'], 				
				"institucion" => $arrForm[$formPos]['institucion_foa'],
				"nivel" => $arrForm[$formPos]['nombre_nac'],
				"pais" => $arrForm[$formPos]['nombre_pai'],
				"registro" => $arrForm[$formPos]['fecregconesup_foa']	
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
	
	EJEMPLOS:
		* 1)Un profesor dicto 3 creditos en varios periodos regulares obtener
		  	el numero de horas semanales.		
		 	3 creditos = 16*3 = 48 horas;
			(48 horas) dividido para (11 semanas) = 4.36 horas/semanas. 			
		 
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
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		$sumPerReg = 0;
		$sumPerInt = 0;
		for($i=0;$i<count($arr);$i++){
			$mat = getMat($arr[$i]['serial_mat'],$arr[$i]['serial_sec'],$dblink);
			if($mat){
				$arr[$i]['tcredito'] = $mat[0]['numerocreditos_dma'];					
			}else{
				$arr[$i]['tcredito'] = 0;
			}
			//echo $arr[$i]['intensivo_per']."<br>";
			if($arr[$i]['intensivo_per']== "NO"){
				$sumPerReg = $sumPerReg + $arr[$i]['tcredito'];				
			}else{
				$sumPerInt = $sumPerInt + $arr[$i]['tcredito'];				
			}	
		}
		//echo "<pre>".print_r($arr)."<pre>";
		if($sumPerReg==0 or $sumPerInt==0){
			$div = 1;
		}else{
			$div = 2;
		}
		$prom = (($sumPerReg * 1.45)+($sumPerInt * 3.20))/$div;				
		return $prom;
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
?>

