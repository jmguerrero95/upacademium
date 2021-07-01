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
		2	=>	"ESPECIALISTA",
		3	=>	"DIPLOMADO",
		4	=>	"IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		5	=>	"III DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		6	=>	"TERCER NIVEL",
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
		0 => "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		1 => "III DOCTOR EN JURISPRUDENCIA O FILOSOFIA",
		2 => "TERCER NIVEL",
		3 => "TECNOLOGO",
		4 => "TECNICO SUPERIOR"			 
	);
//Prioridad Cuarto Nivel
$arrCuartoNivel = 
	array(
		0 => "DOCTORADO",
		1 => "MAGISTER",
		2 => "ESPECIALISTA",
		3 => "DIPLOMADO"			 
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
//SubAreas de la Unesco
$arrUnesco[0]['titulo']='ABOGADO';$arrUnesco[0]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[1]['titulo']='ABOGADO DE LOS JUZGADOS Y TRIBUNALES DE LA REPUBLICA';$arrUnesco[1]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[2]['titulo']='ABOGADO DE LOS TRIBUNALES DE LA REPÚBLICA';$arrUnesco[2]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[3]['titulo']='ABOGADO DE LOS TRIBUNALES Y JUZGADOS DE LA REPUBLICA';$arrUnesco[3]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[4]['titulo']='ABOGADO DE LOS TRIBUNALES Y JUZGADOS DE LA REPUBLICA DEL ECUADOR';$arrUnesco[4]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[5]['titulo']='ABOGADODE LOS TRIBUNALES Y JUZGADOSDE LA REPUBLICA';$arrUnesco[5]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[6]['titulo']='ARQUITECTO';$arrUnesco[6]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Arquitectura y construccion';
$arrUnesco[7]['titulo']='BACHELOR OF SCIENCE IN ACCOUNTING';$arrUnesco[7]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[8]['titulo']='DIPLOMA SUPERIOR EN DERECHO CONSTITUCIONAL Y DERECHO FUNDAMENTAL';$arrUnesco[8]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[9]['titulo']='DIPLOMA SUPERIOR EN DOCENCIA Y EVALUACION EN EDUCACION SUPERIOR';$arrUnesco[9]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[10]['titulo']='DIPLOMA SUPERIOR EN ECONOMIA DEL ECUADOR Y DEL MUN';$arrUnesco[10]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[11]['titulo']='DIPLOMA SUPERIOR EN EDUCACION UNIVERSITARIA POR COMPETENCIAS';$arrUnesco[11]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[12]['titulo']='DIPLOMA SUPERIOR EN EVALUACION ACREDITACION DE EDUCACION SUPERIOR';$arrUnesco[12]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[13]['titulo']='DIPLOMA SUPERIOR EN INVESTIGACION SOCIOEDUCATIVA';$arrUnesco[13]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[14]['titulo']='DIPLOMA SUPERIOR EN NEGOCIACION INTERNACIONAL';$arrUnesco[14]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[15]['titulo']='DIPLOMA SUPERIOR GESTION PARA EL APRENDIZAJE UNIVERSITARIO';$arrUnesco[15]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[16]['titulo']='DIPLOMADO CAMPAÑAS ELECTORALES';$arrUnesco[16]['unesco']='SALUD Y SERVICIOS SOCIALES-Medicina';
$arrUnesco[17]['titulo']='DIPLOMADO EN ADMINISTRACION DE EMPRESAS';$arrUnesco[17]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[18]['titulo']='DIPLOMADO EN CONTADURIA PUBLICA Y FINANZAS CON APLICACION EN INFORMATICA';$arrUnesco[18]['unesco']='CIENCIAS-Informatica';
$arrUnesco[19]['titulo']='DIPLOMADO EN DERECHO NOTARIAL Y REGISTRAL';$arrUnesco[19]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[20]['titulo']='DIPLOMADO EN DERECHO PROCESAL PENAL';$arrUnesco[20]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[21]['titulo']='DIPLOMADO EN DISEÑO CURRICULAR';$arrUnesco[21]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[22]['titulo']='DIPLOMADO EN DOCENCIA SUPERIOR';$arrUnesco[22]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[23]['titulo']='DIPLOMADO RECURSOS HUMANOS';$arrUnesco[23]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[24]['titulo']='DIPLOMADO SUPERIOR EN APLICACION Y DISEÑO DE MODELOS EDUCATIVOS';$arrUnesco[24]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[25]['titulo']='DIPLOMADO SUPERIOR EN DERECHO CONSTITUCIONAL Y DERECHOS';$arrUnesco[25]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[26]['titulo']='DIPLOMADO SUPERIOR EN FINANZAS MERCADO DE VALORES Y NEGOCIOS FIDU';$arrUnesco[26]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[27]['titulo']='DIPLOMADO SUPERIOR EN MODELOS EDUCATIVOS';$arrUnesco[27]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[28]['titulo']='DIPLOMADO SUPERIOR EN PROSPECTIVA ESTRATEGICA';$arrUnesco[28]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[29]['titulo']='DISENADOR MECANICO';$arrUnesco[29]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Ingenieria y profesiones afines';
$arrUnesco[30]['titulo']='DOCTOR EN CIENCIAS POLITICAS';$arrUnesco[30]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[31]['titulo']='DOCTOR EN ECONOMIA';$arrUnesco[31]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[32]['titulo']='DOCTOR EN FILOSOFIA';$arrUnesco[32]['unesco']='HUMANIDADES Y ARTES-Artes';
$arrUnesco[33]['titulo']='DOCTOR EN FILOSOFIA PHD EN FISICO MATEMATICO';$arrUnesco[33]['unesco']='CIENCIAS-Matematicas y estadistica';
$arrUnesco[34]['titulo']='DOCTOR EN INVESTIGACION EN METODOLOGIAS DE BIOMONITORAMIENTO';$arrUnesco[34]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[35]['titulo']='DOCTOR EN JURISPRUDENCIA Y ABOGADO DE LOS TRIBUNALES DE JUSTICIA';$arrUnesco[35]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[36]['titulo']='DOCTOR PHD EN INGENIERIA DE SOFTWARE';$arrUnesco[36]['unesco']='CIENCIAS-Informatica';
$arrUnesco[37]['titulo']='DOCTORA EN GEOGRAFIA E HISTORIA';$arrUnesco[37]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[38]['titulo']='DOCTORADO EN CIENCIAS ECONOMICAS';$arrUnesco[38]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[39]['titulo']='DOCTORADO EN DERECHO TRIBUTARIO';$arrUnesco[39]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[40]['titulo']='ECONOMISTA';$arrUnesco[40]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[41]['titulo']='ESPECIALISTA EN ANALISIS DE SISTEMAS';$arrUnesco[41]['unesco']='CIENCIAS-Informatica';
$arrUnesco[42]['titulo']='ESPECIALISTA EN BIOETICA';$arrUnesco[42]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[43]['titulo']='ESPECIALISTA EN DERECHO AMBIENTAL';$arrUnesco[43]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[44]['titulo']='ESPECIALISTA EN DERECHO AMBIENTAL Y DESARROLLO SUSTENTABLE';$arrUnesco[44]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[45]['titulo']='ESPECIALISTA EN DERECHO ECONOMICO';$arrUnesco[45]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[46]['titulo']='ESPECIALISTA EN DERECHO EMPRESARIAL';$arrUnesco[46]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[47]['titulo']='ESPECIALISTA EN DERECHO PENAL Y JUSTICIA INDIGENA';$arrUnesco[47]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[48]['titulo']='ESPECIALISTA EN DERECHO TRIBUTARIO';$arrUnesco[48]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[49]['titulo']='ESPECIALISTA EN DOCENCIA UNIVERSITARIA';$arrUnesco[49]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[50]['titulo']='ESPECIALISTA EN GERENCIA DE MERCADO';$arrUnesco[50]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[51]['titulo']='ESPECIALISTA EN PEDAGOGIA';$arrUnesco[51]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[52]['titulo']='ESPECIALISTA EN SISTEMAS JURIDICOS DE PROTECCION A LOS DERECHOS H';$arrUnesco[52]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[53]['titulo']='ESPECIALISTA EN TRIBUTACION';$arrUnesco[53]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[54]['titulo']='ESPECIALISTA SUPERIOR EN DERECHO ADMINISTRATIVO';$arrUnesco[54]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[55]['titulo']='ESPECIALISTA SUPERIOR EN DERECHO PROCESAL';$arrUnesco[55]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[56]['titulo']='EXPERTO EN PROCESOS ELEARNING';$arrUnesco[56]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[57]['titulo']='INGENIERA COMERCIAL';$arrUnesco[57]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[58]['titulo']='INGENIERA EN ECOTURISMO';$arrUnesco[58]['unesco']='SERVICIOS-Proteccion del medio ambiente';
$arrUnesco[59]['titulo']='INGENIERO AMBIENTAL';$arrUnesco[59]['unesco']='SERVICIOS-Proteccion del medio ambiente';
$arrUnesco[60]['titulo']='INGENIERO COMERCIAL';$arrUnesco[60]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[61]['titulo']='INGENIERO COMERICAL';$arrUnesco[61]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[62]['titulo']='INGENIERO EN ADMINISTRACION BANCARIA';$arrUnesco[62]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[63]['titulo']='INGENIERO EN EJECUCION INFORMATICA';$arrUnesco[63]['unesco']='CIENCIAS-Informatica';
$arrUnesco[64]['titulo']='INGENIERO EN ELECTRONICA Y CONTROL';$arrUnesco[64]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Ingenieria y profesiones afines';
$arrUnesco[65]['titulo']='INGENIERO EN SISTEMAS';$arrUnesco[65]['unesco']='CIENCIAS-Informatica';
$arrUnesco[66]['titulo']='INGENIERO QUIMICO';$arrUnesco[66]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[67]['titulo']='LICENCIADA EN CIENCIAS DE LA EDUCACION MENCION PSICOLOGIA EDUCATI';$arrUnesco[67]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[68]['titulo']='LICENCIADA EN CIENCIAS SOCIALES Y POLITICAS';$arrUnesco[68]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[69]['titulo']='LICENCIADA EN COMUNICACION ENFASIS PUBLICIDAD';$arrUnesco[69]['unesco']='HUMANIDADES Y ARTES-Artes';
$arrUnesco[70]['titulo']='LICENCIADA EN ENFERMERIA';$arrUnesco[70]['unesco']='SALUD Y SERVICIOS SOCIALES-Medicina';
$arrUnesco[71]['titulo']='LICENCIADA EN TURISMO';$arrUnesco[71]['unesco']='SERVICIOS-Servicios personales';
$arrUnesco[72]['titulo']='LICENCIADO ADMINISTRACION DE EMPRESAS-MARKETING';$arrUnesco[72]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[73]['titulo']='LICENCIADO EN ADMINISTRACION DE EMPRESAS';$arrUnesco[73]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[74]['titulo']='LICENCIADO EN CIENCIAS DE LA EDUCACION MENCION EDUCACION INFANTIL';$arrUnesco[74]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[75]['titulo']='LICENCIADO EN CIENCIAS JURDICAS';$arrUnesco[75]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[76]['titulo']='LICENCIADO EN CIENCIAS NAVALES Y MARITIMAS';$arrUnesco[76]['unesco']='CIENCIAS-Ciencias fisicas';
$arrUnesco[77]['titulo']='LICENCIADO EN CIENCIAS POLITICAS Y SOCIALES';$arrUnesco[77]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[78]['titulo']='LICENCIADO EN CIENCIAS PUBLICAS Y SOCIALES';$arrUnesco[78]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[79]['titulo']='LICENCIADO EN COMUNICACION SOCIAL';$arrUnesco[79]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[80]['titulo']='LICENCIADO EN TURISMO Y HOTELERIA';$arrUnesco[80]['unesco']='SERVICIOS-Servicios personales';
$arrUnesco[81]['titulo']='MAESTRA EN ECONOMIA Y GESTION EMPRESARIAL';$arrUnesco[81]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[82]['titulo']='MAESTRO EN CIENCIAS POLITICAS';$arrUnesco[82]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[83]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS';$arrUnesco[83]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[84]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS (MBA)';$arrUnesco[84]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[85]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS ESPECIALIZACION FINANZAS';$arrUnesco[85]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[86]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS MENCION FINANZAS';$arrUnesco[86]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[87]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS MENCION NEG INT';$arrUnesco[87]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[88]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS MENCION NEGOCIOS INTERNACI';$arrUnesco[88]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[89]['titulo']='MAGISTER EN ADMINISTRACION DE EMPRESAS MENCION RRHH Y MARKETIG';$arrUnesco[89]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[90]['titulo']='MAGISTER EN ADMINISTRACION DE NEGOCIOS';$arrUnesco[90]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[91]['titulo']='MAGISTER EN ADMINISTRACION Y DIRECCION DE EMPRESAS';$arrUnesco[91]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[92]['titulo']='MAGISTER EN ADMINISTRACION Y GERENCIA DE TRANSPORTE';$arrUnesco[92]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[93]['titulo']='MAGISTER EN ADMINISTRACION Y MARKETING';$arrUnesco[93]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[94]['titulo']='MAGISTER EN ADMINSITRACION DE EMPRESAS';$arrUnesco[94]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[95]['titulo']='MAGISTER EN ADMINSITRACION DE SISTEMAS DE CLAIDAD';$arrUnesco[95]['unesco']='CIENCIAS-Informatica';
$arrUnesco[96]['titulo']='MAGISTER EN ADMINSTRACION DE EMPRESAS';$arrUnesco[96]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[97]['titulo']='MAGISTER EN ADMNISTRACION DE EMPRESAS ESPECIALIZACION FINANZAS';$arrUnesco[97]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[98]['titulo']='MAGISTER EN ASESORIA JURIDICA DE EMPRESAS';$arrUnesco[98]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[99]['titulo']='MAGISTER EN CIENCIAS CON MENCION EN ECONOMIA Y GESTION EMPRESARIAL';$arrUnesco[99]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[100]['titulo']='MAGISTER EN CIENCIAS INTERNACIONALES Y DIPLOMACIA';$arrUnesco[100]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[101]['titulo']='MAGISTER EN COMERCIO EXTERIOR MENCION GESTION ADUANERA';$arrUnesco[101]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[102]['titulo']='MAGISTER EN CONTABILIDAD Y AUDITORIA-CONTADOR PUBLICO';$arrUnesco[102]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[103]['titulo']='MAGISTER EN DERECHO';$arrUnesco[103]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[104]['titulo']='MAGISTER EN DERECHO ECONOMICO';$arrUnesco[104]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[105]['titulo']='MAGISTER EN DERECHO EMPRESARIAL';$arrUnesco[105]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[106]['titulo']='MAGISTER EN DERECHO INTERNACIONAL Y RELACIONES INTERNACIONALES';$arrUnesco[106]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[107]['titulo']='MAGISTER EN DERECHO PENAL Y CRIMINOLOGIA';$arrUnesco[107]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[108]['titulo']='MAGISTER EN DERECHO PROCESAL';$arrUnesco[108]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[109]['titulo']='MAGISTER EN DESARROLLO DE FINANZAS APLICADAS A LA MICROEMPRESA';$arrUnesco[109]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[110]['titulo']='MAGISTER EN DESARROLLO DE LA INTELIGENCIA Y EDUCACION';$arrUnesco[110]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[111]['titulo']='MAGISTER EN DESARROLLO DEL PENSAMIENTO Y EDUCACION';$arrUnesco[111]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[112]['titulo']='MAGISTER EN DIRECCION COMERCIAL Y MARKETING DEL INSTITUTO';$arrUnesco[112]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[113]['titulo']='MAGISTER EN DOCENCIA E INVESTIGACION EDUCATIVA';$arrUnesco[113]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[114]['titulo']='MAGISTER EN DOCENCIA UNIVERSITARIA E INVESTIGACION EDUCATIVA';$arrUnesco[114]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[115]['titulo']='MAGISTER EN DOCENCIA Y CURRICULO PARA LA EDUCACION SUPERIOR';$arrUnesco[115]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[116]['titulo']='MAGISTER EN ECONOMIA';$arrUnesco[116]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[117]['titulo']='MAGISTER EN ECONOMIA Y DIRECCION DE EMPRESAS';$arrUnesco[117]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[118]['titulo']='MAGISTER EN FINANZAS';$arrUnesco[118]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[119]['titulo']='MAGISTER EN GESTION TECNOLOGICA';$arrUnesco[119]['unesco']='CIENCIAS-Informatica';
$arrUnesco[120]['titulo']='MAGISTER EN INVESTIGACION DE MERCADOS';$arrUnesco[120]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[121]['titulo']='MAGISTER EN NEGOCIACIONES INTERNACIONALES Y COMERCIO EXTERIOR';$arrUnesco[121]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[122]['titulo']='MAGISTER EN PROCESOS';$arrUnesco[122]['unesco']='SECCTOR NO ESPECIFICADO-SECTORES DESCONOCIDOS O NO ESPECIFICADOS';
$arrUnesco[123]['titulo']='MAGISTER EN SISTEMA DE INFORMACION GERENCIAL';$arrUnesco[123]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[124]['titulo']='MAGISTER EN TELEMATICA';$arrUnesco[124]['unesco']='CIENCIAS-Informatica';
$arrUnesco[125]['titulo']='MAGISTER EN TEOLOGIA';$arrUnesco[125]['unesco']='HUMANIDADES Y ARTES-Humanidades';
$arrUnesco[126]['titulo']='MAGISTER UNIVERSITARIO EN DERECHO DE LA UNION EUROPA';$arrUnesco[126]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[127]['titulo']='MASTER EN ADMINISTRACION DE EMPRESA';$arrUnesco[127]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[128]['titulo']='MASTER EN ADMINISTRACION DE EMPRESAS';$arrUnesco[128]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[129]['titulo']='MASTER EN ADMINISTRACION DE EMPRESAS MENCION NEGOCIOS INTENACIONA';$arrUnesco[129]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[130]['titulo']='MASTER EN ADMINISTRACION DE EMPRESAS PARA EL DESARROLLO EMPRESARI';$arrUnesco[130]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[131]['titulo']='MASTER EN ADMINISTRACION INDUSTRIAL Y DE LA TECNOLOGIA';$arrUnesco[131]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[132]['titulo']='MASTER EN CIENCIAS ECONOMICAS';$arrUnesco[132]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[133]['titulo']='MASTER EN CIENCIAS EN OCEANOGRAFIA ESPECIALIDAD EN GEOLOGIA MARINA';$arrUnesco[133]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[134]['titulo']='MASTER EN CIENCIAS INTERNACIONALES';$arrUnesco[134]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[135]['titulo']='MASTER EN CIENCIAS SOCIALES';$arrUnesco[135]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[136]['titulo']='MASTER EN COMPUTACION CON ENFASIS EN SISTEMAS DE INFORMACION';$arrUnesco[136]['unesco']='CIENCIAS-Informatica';
$arrUnesco[137]['titulo']='MASTER EN DERECHO';$arrUnesco[137]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[138]['titulo']='MASTER EN DERECHO EMPRESARIAL';$arrUnesco[138]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[139]['titulo']='MASTER EN DERECHO MENCIÓN DERECHO TRIBUTARIO';$arrUnesco[139]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[140]['titulo']='MASTER EN DERECHO PROCESAL CIVIL Y DERECHO DE FAMILIA';$arrUnesco[140]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Derecho';
$arrUnesco[141]['titulo']='MASTER EN DIRECCION COMERCIAL Y MARKETING';$arrUnesco[141]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[142]['titulo']='MASTER EN DIRECCION DE EMPRESAS CONSTRUCTORAS E INMOBILIARIAS';$arrUnesco[142]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[143]['titulo']='MASTER EN ECONOMIA EMPRESARIAL';$arrUnesco[143]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[144]['titulo']='MASTER EN ECONOMIA MARITIMA Y ECONOMIA DEL TRANSPORTE';$arrUnesco[144]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[145]['titulo']='MASTER EN FINANZAS';$arrUnesco[145]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[146]['titulo']='MASTER EN GEOCIENCIA';$arrUnesco[146]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[147]['titulo']='MASTER EN GESTION Y DIRECCION DE RECURSOS HUMANOS';$arrUnesco[147]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[148]['titulo']='MASTER EN INGENIERIA DE PUERTOS Y NAVES';$arrUnesco[148]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Ingenieria y profesiones afines';
$arrUnesco[149]['titulo']='MASTER EN INGENIERIA SANITARIA';$arrUnesco[149]['unesco']='CIENCIAS-Ciencias de la vida';
$arrUnesco[150]['titulo']='MASTER EN INTERPRETACION Y TRADUCCION INGLES - ESPAÑOL-ITALIANO';$arrUnesco[150]['unesco']='HUMANIDADES Y ARTES-Humanidades';
$arrUnesco[151]['titulo']='MASTER EN OCEANOGRAFIA FISICA';$arrUnesco[151]['unesco']='CIENCIAS-Ciencias fisicas';
$arrUnesco[152]['titulo']='MASTER EN PEDAGOGIA PROFESIONAL';$arrUnesco[152]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[153]['titulo']='MASTER EN SEGURIDAD Y DESARROLLO CON MENCION EN GESTION PUBLICA Y';$arrUnesco[153]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Arquitectura y construccion';
$arrUnesco[154]['titulo']='MASTER EN SEGURIDAD Y DESARROLLO CON MENCIÓN EN GESTIÓN PUBLICA Y';$arrUnesco[154]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Arquitectura y construccion';
$arrUnesco[155]['titulo']='MASTER EN TRANSPORTE Y DIRECCION MARITIMA';$arrUnesco[155]['unesco']='INGENIERIA INDUSTRIA Y CONSTRUCCION-Arquitectura y construccion';
$arrUnesco[156]['titulo']='MASTER EXCECUTIVE EN TECNOLOGIA Y GESTION MEDIO AMBIENTAL';$arrUnesco[156]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[157]['titulo']='MASTER FINANZAS Y GERENCIA INTERENACIONAL';$arrUnesco[157]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[158]['titulo']='MASTER IN BUSINESS ADMINISTRATION';$arrUnesco[158]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[159]['titulo']='MASTER INTERNACIONAL EN DESARROLLO LOCAL Y RURAL';$arrUnesco[159]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Ciencias sociales y del comportamiento';
$arrUnesco[160]['titulo']='MASTER MBA EN DIRECCION EMPRESARIAL Y MARKETING';$arrUnesco[160]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[161]['titulo']='MASTER OF BUSINESS ADMINISTRATION';$arrUnesco[161]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[162]['titulo']='MASTER OF LIBERAL ARTS';$arrUnesco[162]['unesco']='HUMANIDADES Y ARTES-Artes';
$arrUnesco[163]['titulo']='MASTER PLANIFICACION Y GESTION EMPRESARIAL';$arrUnesco[163]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[164]['titulo']='MASTER UNIVERSITARIO EN INVESTIGACION EN ADMINISTRACION Y DIR...';$arrUnesco[164]['unesco']='CIENCIAS SOCIALES EDUCACION COMERCIAL Y DERECHO-Educacion comercial y administracion';
$arrUnesco[165]['titulo']='PROFESIONAL DEUG DE EDUCACION FISICA';$arrUnesco[165]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[166]['titulo']='PROFESOR DE EDUCACION FISICA';$arrUnesco[166]['unesco']='EDUCACION-Formacion de personal docente y ciencias de la educacion';
$arrUnesco[167]['titulo']='PSICOLOGO CLINICO';$arrUnesco[167]['unesco']='SALUD Y SERVICIOS SOCIALES-Medicina';

//Sueldos del 2011
$arrSueldo2011[0]['id']='1705090817';$arrSueldo2011[0]['sueldo']='360';
$arrSueldo2011[1]['id']='102025244';$arrSueldo2011[1]['sueldo']='571';
$arrSueldo2011[2]['id']='102597515';$arrSueldo2011[2]['sueldo']='411';
$arrSueldo2011[3]['id']='102054475';$arrSueldo2011[3]['sueldo']='267';
$arrSueldo2011[4]['id']='102183803';$arrSueldo2011[4]['sueldo']='482';
$arrSueldo2011[5]['id']='103804951';$arrSueldo2011[5]['sueldo']='307';
$arrSueldo2011[6]['id']='102420627';$arrSueldo2011[6]['sueldo']='180';
$arrSueldo2011[7]['id']='102529179';$arrSueldo2011[7]['sueldo']='82,8';
$arrSueldo2011[8]['id']='102068855';$arrSueldo2011[8]['sueldo']='3384';
$arrSueldo2011[9]['id']='103991873';$arrSueldo2011[9]['sueldo']='579';
$arrSueldo2011[10]['id']='101034213';$arrSueldo2011[10]['sueldo']='210';
$arrSueldo2011[11]['id']='1707599757';$arrSueldo2011[11]['sueldo']='232,23';
$arrSueldo2011[12]['id']='101830164';$arrSueldo2011[12]['sueldo']='209,6';
$arrSueldo2011[13]['id']='102916236';$arrSueldo2011[13]['sueldo']='987';
$arrSueldo2011[14]['id']='101614766';$arrSueldo2011[14]['sueldo']='303,05';
$arrSueldo2011[15]['id']='102249455';$arrSueldo2011[15]['sueldo']='293,3';
$arrSueldo2011[16]['id']='102056843';$arrSueldo2011[16]['sueldo']='180';
$arrSueldo2011[17]['id']='104512298';$arrSueldo2011[17]['sueldo']='323,84';
$arrSueldo2011[18]['id']='103564001';$arrSueldo2011[18]['sueldo']='285,66';
$arrSueldo2011[19]['id']='102283561';$arrSueldo2011[19]['sueldo']='419,14';
$arrSueldo2011[20]['id']='102045994';$arrSueldo2011[20]['sueldo']='586';
$arrSueldo2011[21]['id']='100868603';$arrSueldo2011[21]['sueldo']='237,12';
$arrSueldo2011[22]['id']='102807823';$arrSueldo2011[22]['sueldo']='1509';
$arrSueldo2011[23]['id']='102809340';$arrSueldo2011[23]['sueldo']='591';
$arrSueldo2011[24]['id']='101995090';$arrSueldo2011[24]['sueldo']='203,77';
$arrSueldo2011[25]['id']='103572202';$arrSueldo2011[25]['sueldo']='266,2';
$arrSueldo2011[26]['id']='103891719';$arrSueldo2011[26]['sueldo']='210';
$arrSueldo2011[27]['id']='101982494';$arrSueldo2011[27]['sueldo']='208,8';
$arrSueldo2011[28]['id']='103099883';$arrSueldo2011[28]['sueldo']='201,24';
$arrSueldo2011[29]['id']='102353612';$arrSueldo2011[29]['sueldo']='180';
$arrSueldo2011[30]['id']='102632148';$arrSueldo2011[30]['sueldo']='1758';
$arrSueldo2011[31]['id']='102815842';$arrSueldo2011[31]['sueldo']='386,4';
$arrSueldo2011[32]['id']='101668374';$arrSueldo2011[32]['sueldo']='23,04';
$arrSueldo2011[33]['id']='102394780';$arrSueldo2011[33]['sueldo']='180';
$arrSueldo2011[34]['id']='AM016854';$arrSueldo2011[34]['sueldo']='527,47';
$arrSueldo2011[35]['id']='100326719';$arrSueldo2011[35]['sueldo']='1798';
$arrSueldo2011[36]['id']='103352274';$arrSueldo2011[36]['sueldo']='180';
$arrSueldo2011[37]['id']='101251494';$arrSueldo2011[37]['sueldo']='655';
$arrSueldo2011[38]['id']='102417250';$arrSueldo2011[38]['sueldo']='180';
$arrSueldo2011[39]['id']='102329794';$arrSueldo2011[39]['sueldo']='165,6';
$arrSueldo2011[40]['id']='102058690';$arrSueldo2011[40]['sueldo']='172,8';
$arrSueldo2011[41]['id']='103803532';$arrSueldo2011[41]['sueldo']='197,51';
$arrSueldo2011[42]['id']='102495561';$arrSueldo2011[42]['sueldo']='270';
$arrSueldo2011[43]['id']='102448990';$arrSueldo2011[43]['sueldo']='110,4';
$arrSueldo2011[44]['id']='102645553';$arrSueldo2011[44]['sueldo']='1798';
$arrSueldo2011[45]['id']='102416559';$arrSueldo2011[45]['sueldo']='180';
$arrSueldo2011[46]['id']='102711645';$arrSueldo2011[46]['sueldo']='705';
$arrSueldo2011[47]['id']='102131968';$arrSueldo2011[47]['sueldo']='300';
$arrSueldo2011[48]['id']='101795144';$arrSueldo2011[48]['sueldo']='282,6';
$arrSueldo2011[49]['id']='103877379';$arrSueldo2011[49]['sueldo']='907';
$arrSueldo2011[50]['id']='103363354';$arrSueldo2011[50]['sueldo']='433,82';
$arrSueldo2011[51]['id']='102327004';$arrSueldo2011[51]['sueldo']='211,2';
$arrSueldo2011[52]['id']='101797025';$arrSueldo2011[52]['sueldo']='719';
$arrSueldo2011[53]['id']='102616422';$arrSueldo2011[53]['sueldo']='1085';
$arrSueldo2011[54]['id']='102616539';$arrSueldo2011[54]['sueldo']='386,35';
$arrSueldo2011[55]['id']='103416228';$arrSueldo2011[55]['sueldo']='200';
$arrSueldo2011[56]['id']='107305831';$arrSueldo2011[56]['sueldo']='270';
$arrSueldo2011[57]['id']='905174322';$arrSueldo2011[57]['sueldo']='480';
$arrSueldo2011[58]['id']='911399145';$arrSueldo2011[58]['sueldo']='338,33';
$arrSueldo2011[59]['id']='911146611';$arrSueldo2011[59]['sueldo']='670';
$arrSueldo2011[60]['id']='910555432';$arrSueldo2011[60]['sueldo']='180';
$arrSueldo2011[61]['id']='902238765';$arrSueldo2011[61]['sueldo']='270';
$arrSueldo2011[62]['id']='911377596';$arrSueldo2011[62]['sueldo']='670';
$arrSueldo2011[63]['id']='909160442';$arrSueldo2011[63]['sueldo']='218,57';
$arrSueldo2011[64]['id']='1710583160';$arrSueldo2011[64]['sueldo']='360';
$arrSueldo2011[65]['id']='102455367';$arrSueldo2011[65]['sueldo']='279';
$arrSueldo2011[66]['id']='908654841';$arrSueldo2011[66]['sueldo']='676';
$arrSueldo2011[67]['id']='916664246';$arrSueldo2011[67]['sueldo']='360';
$arrSueldo2011[68]['id']='917975286';$arrSueldo2011[68]['sueldo']='467';
$arrSueldo2011[69]['id']='901790626';$arrSueldo2011[69]['sueldo']='225';
$arrSueldo2011[70]['id']='911174043';$arrSueldo2011[70]['sueldo']='216';
$arrSueldo2011[71]['id']='914933023';$arrSueldo2011[71]['sueldo']='180';
$arrSueldo2011[72]['id']='912639226';$arrSueldo2011[72]['sueldo']='216';
$arrSueldo2011[73]['id']='901248021';$arrSueldo2011[73]['sueldo']='387,27';
$arrSueldo2011[74]['id']='908785702';$arrSueldo2011[74]['sueldo']='255';
$arrSueldo2011[75]['id']='916581374';$arrSueldo2011[75]['sueldo']='112';
$arrSueldo2011[76]['id']='1701674770';$arrSueldo2011[76]['sueldo']='308,57';
$arrSueldo2011[77]['id']='900831298';$arrSueldo2011[77]['sueldo']='375';
$arrSueldo2011[78]['id']='912556867';$arrSueldo2011[78]['sueldo']='753';
$arrSueldo2011[79]['id']='915982979';$arrSueldo2011[79]['sueldo']='0';
$arrSueldo2011[80]['id']='1726625179';$arrSueldo2011[80]['sueldo']='1486';
$arrSueldo2011[81]['id']='908885635';$arrSueldo2011[81]['sueldo']='210';
$arrSueldo2011[82]['id']='904792843';$arrSueldo2011[82]['sueldo']='1510';
$arrSueldo2011[83]['id']='921481917';$arrSueldo2011[83]['sueldo']='286,36';
$arrSueldo2011[84]['id']='923864508';$arrSueldo2011[84]['sueldo']='180';
$arrSueldo2011[85]['id']='1101083655';$arrSueldo2011[85]['sueldo']='267,5';
$arrSueldo2011[86]['id']='911554095';$arrSueldo2011[86]['sueldo']='261,82';
$arrSueldo2011[87]['id']='904359676';$arrSueldo2011[87]['sueldo']='370';
$arrSueldo2011[88]['id']='902071067';$arrSueldo2011[88]['sueldo']='473,45';
$arrSueldo2011[89]['id']='703220319';$arrSueldo2011[89]['sueldo']='182';
$arrSueldo2011[90]['id']='906990700';$arrSueldo2011[90]['sueldo']='1169';
$arrSueldo2011[91]['id']='902193119';$arrSueldo2011[91]['sueldo']='1849';
$arrSueldo2011[92]['id']='913799862';$arrSueldo2011[92]['sueldo']='546';
$arrSueldo2011[93]['id']='909551327';$arrSueldo2011[93]['sueldo']='138';
$arrSueldo2011[94]['id']='908549678';$arrSueldo2011[94]['sueldo']='458,18';
$arrSueldo2011[95]['id']='909016073';$arrSueldo2011[95]['sueldo']='362,45';
$arrSueldo2011[96]['id']='911962231';$arrSueldo2011[96]['sueldo']='512';
$arrSueldo2011[97]['id']='921482980';$arrSueldo2011[97]['sueldo']='864';
$arrSueldo2011[98]['id']='909160368';$arrSueldo2011[98]['sueldo']='207,33';
$arrSueldo2011[99]['id']='908932957';$arrSueldo2011[99]['sueldo']='293,33';
$arrSueldo2011[100]['id']='904296449';$arrSueldo2011[100]['sueldo']='210';
$arrSueldo2011[101]['id']='902664036';$arrSueldo2011[101]['sueldo']='213,75';
$arrSueldo2011[102]['id']='913439303';$arrSueldo2011[102]['sueldo']='546,18';
$arrSueldo2011[103]['id']='902248681';$arrSueldo2011[103]['sueldo']='210';
$arrSueldo2011[104]['id']='908892342';$arrSueldo2011[104]['sueldo']='310';
$arrSueldo2011[105]['id']='950770032';$arrSueldo2011[105]['sueldo']='1663';
$arrSueldo2011[106]['id']='912252129';$arrSueldo2011[106]['sueldo']='178,33';
$arrSueldo2011[107]['id']='910949957';$arrSueldo2011[107]['sueldo']='210';
$arrSueldo2011[108]['id']='916671555';$arrSueldo2011[108]['sueldo']='285,5';
$arrSueldo2011[109]['id']='1702643287';$arrSueldo2011[109]['sueldo']='270';
$arrSueldo2011[110]['id']='913747325';$arrSueldo2011[110]['sueldo']='984';
$arrSueldo2011[111]['id']='906794854';$arrSueldo2011[111]['sueldo']='203,4';
$arrSueldo2011[112]['id']='1709533820';$arrSueldo2011[112]['sueldo']='390';
$arrSueldo2011[113]['id']='908828791';$arrSueldo2011[113]['sueldo']='180';
$arrSueldo2011[114]['id']='930377734';$arrSueldo2011[114]['sueldo']='180';
$arrSueldo2011[115]['id']='922728415';$arrSueldo2011[115]['sueldo']='315';
$arrSueldo2011[116]['id']='906236617';$arrSueldo2011[116]['sueldo']='300';
$arrSueldo2011[117]['id']='906045562';$arrSueldo2011[117]['sueldo']='909';
$arrSueldo2011[118]['id']='1708968472';$arrSueldo2011[118]['sueldo']='210';
$arrSueldo2011[119]['id']='908463698';$arrSueldo2011[119]['sueldo']='210';
$arrSueldo2011[120]['id']='911195030';$arrSueldo2011[120]['sueldo']='180';
$arrSueldo2011[121]['id']='920255783';$arrSueldo2011[121]['sueldo']='285';
$arrSueldo2011[122]['id']='913066296';$arrSueldo2011[122]['sueldo']='432,56';
$arrSueldo2011[123]['id']='908198021';$arrSueldo2011[123]['sueldo']='210';
$arrSueldo2011[124]['id']='900196270';$arrSueldo2011[124]['sueldo']='247,5';
$arrSueldo2011[125]['id']='907734222';$arrSueldo2011[125]['sueldo']='180';
$arrSueldo2011[126]['id']='916047384';$arrSueldo2011[126]['sueldo']='277,5';
$arrSueldo2011[127]['id']='912706348';$arrSueldo2011[127]['sueldo']='316,25';
$arrSueldo2011[128]['id']='915660815';$arrSueldo2011[128]['sueldo']='231,56';
$arrSueldo2011[129]['id']='913919387';$arrSueldo2011[129]['sueldo']='744';
$arrSueldo2011[130]['id']='917566309';$arrSueldo2011[130]['sueldo']='210';
$arrSueldo2011[131]['id']='904906716';$arrSueldo2011[131]['sueldo']='195';
$arrSueldo2011[132]['id']='701728925';$arrSueldo2011[132]['sueldo']='285';
$arrSueldo2011[133]['id']='1714001821';$arrSueldo2011[133]['sueldo']='134,29';
$arrSueldo2011[134]['id']='1712091170';$arrSueldo2011[134]['sueldo']='771';
$arrSueldo2011[135]['id']='1712636602';$arrSueldo2011[135]['sueldo']='307,29';
$arrSueldo2011[136]['id']='1708956394';$arrSueldo2011[136]['sueldo']='1227';
$arrSueldo2011[137]['id']='1700538869';$arrSueldo2011[137]['sueldo']='2203';
$arrSueldo2011[138]['id']='1701590927';$arrSueldo2011[138]['sueldo']='1051';
$arrSueldo2011[139]['id']='1702373695';$arrSueldo2011[139]['sueldo']='180';
$arrSueldo2011[140]['id']='1705506978';$arrSueldo2011[140]['sueldo']='298';
$arrSueldo2011[141]['id']='1703144616';$arrSueldo2011[141]['sueldo']='1777';
$arrSueldo2011[142]['id']='1704141686';$arrSueldo2011[142]['sueldo']='360';
$arrSueldo2011[143]['id']='1704934395';$arrSueldo2011[143]['sueldo']='214';
$arrSueldo2011[144]['id']='1707981104';$arrSueldo2011[144]['sueldo']='230';
$arrSueldo2011[145]['id']='1704691300';$arrSueldo2011[145]['sueldo']='0';
$arrSueldo2011[146]['id']='1709895484';$arrSueldo2011[146]['sueldo']='820';
$arrSueldo2011[147]['id']='1801031996';$arrSueldo2011[147]['sueldo']='180';
$arrSueldo2011[148]['id']='1700610262';$arrSueldo2011[148]['sueldo']='196';
$arrSueldo2011[149]['id']='1724899412';$arrSueldo2011[149]['sueldo']='1785';
$arrSueldo2011[150]['id']='1708198831';$arrSueldo2011[150]['sueldo']='297';
$arrSueldo2011[151]['id']='1705300505';$arrSueldo2011[151]['sueldo']='1806';
$arrSueldo2011[152]['id']='1706468244';$arrSueldo2011[152]['sueldo']='249';
$arrSueldo2011[153]['id']='1700591702';$arrSueldo2011[153]['sueldo']='623,17';
$arrSueldo2011[154]['id']='1704160033';$arrSueldo2011[154]['sueldo']='579';
$arrSueldo2011[155]['id']='1716400740';$arrSueldo2011[155]['sueldo']='450';
$arrSueldo2011[156]['id']='1709136137';$arrSueldo2011[156]['sueldo']='1934';
$arrSueldo2011[157]['id']='1700258096';$arrSueldo2011[157]['sueldo']='0';
$arrSueldo2011[158]['id']='1704207354';$arrSueldo2011[158]['sueldo']='538';
$arrSueldo2011[159]['id']='1709132094';$arrSueldo2011[159]['sueldo']='229,78';
$arrSueldo2011[160]['id']='F890592';$arrSueldo2011[160]['sueldo']='375';
$arrSueldo2011[161]['id']='1713500856';$arrSueldo2011[161]['sueldo']='156';
$arrSueldo2011[162]['id']='1712593720';$arrSueldo2011[162]['sueldo']='420';
$arrSueldo2011[163]['id']='1723198147';$arrSueldo2011[163]['sueldo']='291';
$arrSueldo2011[164]['id']='1709150427';$arrSueldo2011[164]['sueldo']='300';
$arrSueldo2011[165]['id']='907011548';$arrSueldo2011[165]['sueldo']='604';
$arrSueldo2011[166]['id']='1704449436';$arrSueldo2011[166]['sueldo']='232,5';
$arrSueldo2011[167]['id']='1707007694';$arrSueldo2011[167]['sueldo']='281';
$arrSueldo2011[168]['id']='1711253185';$arrSueldo2011[168]['sueldo']='723';
$arrSueldo2011[169]['id']='1713853305';$arrSueldo2011[169]['sueldo']='472,5';
$arrSueldo2011[170]['id']='1705325320';$arrSueldo2011[170]['sueldo']='153,33';
$arrSueldo2011[171]['id']='1705526562';$arrSueldo2011[171]['sueldo']='364,44';
$arrSueldo2011[172]['id']='1722832654';$arrSueldo2011[172]['sueldo']='150';
$arrSueldo2011[173]['id']='1708596950';$arrSueldo2011[173]['sueldo']='911';
$arrSueldo2011[174]['id']='801107988';$arrSueldo2011[174]['sueldo']='176';
$arrSueldo2011[175]['id']='1707590582';$arrSueldo2011[175]['sueldo']='315';
$arrSueldo2011[176]['id']='1714162292';$arrSueldo2011[176]['sueldo']='161';
$arrSueldo2011[177]['id']='1713422028';$arrSueldo2011[177]['sueldo']='150';
$arrSueldo2011[178]['id']='1708265762';$arrSueldo2011[178]['sueldo']='405';
$arrSueldo2011[179]['id']='1717884777';$arrSueldo2011[179]['sueldo']='270';
$arrSueldo2011[180]['id']='1709210353';$arrSueldo2011[180]['sueldo']='828';
$arrSueldo2011[181]['id']='1709343188';$arrSueldo2011[181]['sueldo']='258';
$arrSueldo2011[182]['id']='1709252934';$arrSueldo2011[182]['sueldo']='705';
$arrSueldo2011[183]['id']='1000047587';$arrSueldo2011[183]['sueldo']='252';
$arrSueldo2011[184]['id']='1724317738';$arrSueldo2011[184]['sueldo']='997';
$arrSueldo2011[185]['id']='1700064254';$arrSueldo2011[185]['sueldo']='390';
$arrSueldo2011[186]['id']='1705940508';$arrSueldo2011[186]['sueldo']='2856';
$arrSueldo2011[187]['id']='1705309381';$arrSueldo2011[187]['sueldo']='298';
$arrSueldo2011[188]['id']='1708873763';$arrSueldo2011[188]['sueldo']='2666';
$arrSueldo2011[189]['id']='1707478499';$arrSueldo2011[189]['sueldo']='194';
$arrSueldo2011[190]['id']='911018497';$arrSueldo2011[190]['sueldo']='248,56';
$arrSueldo2011[191]['id']='1302672017';$arrSueldo2011[191]['sueldo']='201';
$arrSueldo2011[192]['id']='300441508';$arrSueldo2011[192]['sueldo']='523';
$arrSueldo2011[193]['id']='1703579522';$arrSueldo2011[193]['sueldo']='220';
$arrSueldo2011[194]['id']='1707611727';$arrSueldo2011[194]['sueldo']='2625';
$arrSueldo2011[195]['id']='1750983155';$arrSueldo2011[195]['sueldo']='2712';
$arrSueldo2011[196]['id']='1704096153';$arrSueldo2011[196]['sueldo']='174';
$arrSueldo2011[197]['id']='1703551125';$arrSueldo2011[197]['sueldo']='328';
$arrSueldo2011[198]['id']='1711617215';$arrSueldo2011[198]['sueldo']='180';
$arrSueldo2011[199]['id']='102006996';$arrSueldo2011[199]['sueldo']='584';
$arrSueldo2011[200]['id']='1705054821';$arrSueldo2011[200]['sueldo']='400';


//Validacion si el usuario no pone ninguna Fecha
if(strlen($fecha_ini)<=0 or strlen($fecha_fin)<=0){
	$fecha_ini = $fecha_act;
	$fecha_fin = $fecha_act;
}
//sucursal
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = "and periodo.serial_suc = ".$serial_suc;
}
//	DATEDIFF( DATE_FORMAT('".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( max(periodo.fechafin_per), '%Y-%m-%d' ) ) /365 AS tiempo_sin_clases,
$campos_comunes = "
    DISTINCT (hrr.SERIAL_EPL) AS serial_epl,
    documentoidentidad_epl,
    concat_ws(' ',apellido_epl,nombre_epl) AS nombre,
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,	
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	max(periodo.serial_per) as periodomax,
	max(fecfin_per) as fecha_fin_cal,
	nombre_per,	
    DATEDIFF( DATE_FORMAT('".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( max(fecfin_per), '%Y-%m-%d' ) ) /365 AS tiempo_sin_clases,
	nombre_tct,
    epl.serial_tct,
    fechanacimiento_epl,
    email_epl,
    emailuniv_epl,
    FECHANACIMIENTO_EPL,                                                                                      
    sexo_epl,
    fechaingreso_epl,
	formaContrato_epl,
    nombre_fac,
    formacontrato_epl,
    fingresonomina_epl,
    nombre_car,
    niv.nombre_nac,
    nna.nombre_nac,
	formaContrato_epl,
    nombre_fac,
    periodo.serial_suc,
    nombre_suc,
    UPPER(direccion_suc) AS direccion_suc,
    periodo.serial_sec,
	periodo.nombre_per 
";

//Sql Pregrado
$sqlPregrado = "
SELECT
	".$campos_comunes."
FROM
    area,
    facultad,
    materia,
    periodo,
    empleado AS epl,
    horario  AS hrr,
    sucursal AS suc 
        LEFT JOIN formacionacademica AS foa 
        ON foa.SERIAL_EPL = epl.SERIAL_EPL 
        AND foa.mayortitulo_foa = 'SI' 
        LEFT JOIN nivelacademico AS niv 
        ON foa.serial_nac = niv.serial_nac 
        LEFT JOIN nacionalidad AS nna 
        ON epl.serial_nac = nna.serial_nac 
        LEFT JOIN tipocontratostrabajo AS tct 
        ON epl.serial_tct = tct.serial_tct 
        LEFT JOIN escalafones AS esc 
        ON esc.serial_esc = epl.serial_esc 
        LEFT JOIN cargos AS car 
        ON car.serial_car = esc.serial_car 
        LEFT JOIN tipoescalafones AS tes 
        ON tes.serial_tes = esc.serial_tes 
WHERE
    hrr.serial_epl=epl.serial_epl 
    AND materia.serial_mat=hrr.serial_mat 
    AND area.serial_are=materia.serial_are 
    AND area.serial_fac=facultad.serial_fac 
    AND periodo.serial_per=hrr.serial_per 
    AND periodo.serial_suc = suc.serial_suc 
    AND tipoEmpleado_epl = 'PROFESOR' 
    AND prospecto_epl = 'NO' 
    AND fechaingreso_epl<='".$fecha_fin."' 
    AND fecini_per >='".$fecha_ini."' 
    AND fecini_per<='".$fecha_fin."' 
    AND estado_hrr='ACTIVO' 
    AND hrr.serial_hrr IN(  SELECT
                                serial_hrr 
                            FROM
                                detallemateriamatriculada 
    )
    AND periodo.serial_sec = 1 
	AND hrr.seccion_hrr NOT IN('AVANZADA','UBICACION')	
	".$sucursal."
	
GROUP BY
    hrr.serial_epl 
";
//and hrr.serial_epl = 582
//and nombre_fac =  'FACULTAD DE NEGOCIOS Y ECONOMIA'
//and hrr.serial_epl = 1682
//and hrr.serial_epl = 1682
$sqlPostgrado = "
SELECT
	".$campos_comunes."
FROM
    area,
    facultad,
    materia,
    periodo,
    empleado AS epl,
    horario  AS hrr,
    sucursal AS suc 
        LEFT JOIN formacionacademica AS foa 
        ON foa.SERIAL_EPL = epl.SERIAL_EPL 
        AND foa.mayortitulo_foa = 'SI' 
        LEFT JOIN nivelacademico AS niv 
        ON foa.serial_nac = niv.serial_nac 
        LEFT JOIN nacionalidad AS nna 
        ON epl.serial_nac = nna.serial_nac 
        LEFT JOIN tipocontratostrabajo AS tct 
        ON epl.serial_tct = tct.serial_tct 
        LEFT JOIN escalafones AS esc 
        ON esc.serial_esc = epl.serial_esc 
        LEFT JOIN cargos AS car 
        ON car.serial_car = esc.serial_car 
        LEFT JOIN tipoescalafones AS tes 
        ON tes.serial_tes = esc.serial_tes 
WHERE
    hrr.serial_epl=epl.serial_epl 
    AND materia.serial_mat=hrr.serial_mat 
    AND area.serial_are=materia.serial_are 
    AND area.serial_fac=facultad.serial_fac 
    AND periodo.serial_per=hrr.serial_per 
    AND periodo.serial_suc = suc.serial_suc 
    AND tipoEmpleado_epl = 'PROFESOR' 
    AND prospecto_epl = 'NO' 
    AND fechaingreso_epl<='".$fecha_fin."' 
    AND fechorario_hrr >='".$fecha_ini."' 
    AND fechorario_hrr<='".$fecha_fin."' 
    AND estado_hrr='ACTIVO' 
    AND hrr.serial_hrr IN(  SELECT
                                serial_hrr 
                            FROM
                                detallemateriamatriculada 
    )
    AND periodo.serial_sec = 2
	".$sucursal." 
GROUP BY
    hrr.serial_epl

";

$sqlTodas = "
SELECT
	".$campos_comunes."
FROM
    area,
    facultad,
    materia,
    periodo,
    empleado AS epl,
    horario  AS hrr,
    sucursal AS suc 
        LEFT JOIN formacionacademica AS foa 
        ON foa.SERIAL_EPL = epl.SERIAL_EPL 
        AND foa.mayortitulo_foa = 'SI' 
        LEFT JOIN nivelacademico AS niv 
        ON foa.serial_nac = niv.serial_nac 
        LEFT JOIN nacionalidad AS nna 
        ON epl.serial_nac = nna.serial_nac 
        LEFT JOIN tipocontratostrabajo AS tct 
        ON epl.serial_tct = tct.serial_tct 
        LEFT JOIN escalafones AS esc 
        ON esc.serial_esc = epl.serial_esc 
        LEFT JOIN cargos AS car 
        ON car.serial_car = esc.serial_car 
        LEFT JOIN tipoescalafones AS tes 
        ON tes.serial_tes = esc.serial_tes 
WHERE
    hrr.serial_epl=epl.serial_epl 
    AND materia.serial_mat=hrr.serial_mat 
    AND area.serial_are=materia.serial_are 
    AND area.serial_fac=facultad.serial_fac 
    AND periodo.serial_per=hrr.serial_per 
    AND periodo.serial_suc = suc.serial_suc 
    AND tipoEmpleado_epl = 'PROFESOR' 
    AND prospecto_epl = 'NO' 
    AND fechaingreso_epl<='".$fecha_fin."' 
    AND fecini_per >='".$fecha_ini."' 
    AND fecini_per<='".$fecha_fin."' 
    AND estado_hrr='ACTIVO' 
    AND hrr.serial_hrr IN(  SELECT
                                serial_hrr 
                            FROM
                                detallemateriamatriculada 
    )
    AND periodo.serial_sec = 1 
	AND hrr.seccion_hrr NOT IN('AVANZADA','UBICACION')
	
	".$sucursal."
GROUP BY
    hrr.serial_epl
UNION
SELECT
	".$campos_comunes."
FROM
    area,
    facultad,
    materia,
    periodo,
    empleado AS epl,
    horario  AS hrr,
    sucursal AS suc 
        LEFT JOIN formacionacademica AS foa 
        ON foa.SERIAL_EPL = epl.SERIAL_EPL 
        AND foa.mayortitulo_foa = 'SI' 
        LEFT JOIN nivelacademico AS niv 
        ON foa.serial_nac = niv.serial_nac 
        LEFT JOIN nacionalidad AS nna 
        ON epl.serial_nac = nna.serial_nac 
        LEFT JOIN tipocontratostrabajo AS tct 
        ON epl.serial_tct = tct.serial_tct 
        LEFT JOIN escalafones AS esc 
        ON esc.serial_esc = epl.serial_esc 
        LEFT JOIN cargos AS car 
        ON car.serial_car = esc.serial_car 
        LEFT JOIN tipoescalafones AS tes 
        ON tes.serial_tes = esc.serial_tes 
WHERE
    hrr.serial_epl=epl.serial_epl 
    AND materia.serial_mat=hrr.serial_mat 
    AND area.serial_are=materia.serial_are 
    AND area.serial_fac=facultad.serial_fac 
    AND periodo.serial_per=hrr.serial_per 
    AND periodo.serial_suc = suc.serial_suc 
    AND tipoEmpleado_epl = 'PROFESOR' 
    AND prospecto_epl = 'NO' 
    AND fechaingreso_epl<='".$fecha_fin."' 
    AND fechorario_hrr >='".$fecha_ini."' 
    AND fechorario_hrr<='".$fecha_fin."' 
    AND estado_hrr='ACTIVO' 
    AND hrr.serial_hrr IN(  SELECT
                                serial_hrr 
                            FROM
                                detallemateriamatriculada 
    )
    AND periodo.serial_sec = 2 
    AND hrr.serial_epl NOT IN ( SELECT
                                    DISTINCT (hrr.SERIAL_EPL) AS serial_epl 
                                FROM
                                    area,
                                    facultad,
                                    materia,
                                    periodo,
                                    empleado AS epl,
                                    horario  AS hrr,
                                    sucursal AS suc 
                                    LEFT JOIN formacionacademica AS foa 
                                    ON foa.SERIAL_EPL = epl.SERIAL_EPL 
                                    AND foa.mayortitulo_foa = 'SI' 
                                    LEFT JOIN nivelacademico AS niv 
                                    ON foa.serial_nac = niv.serial_nac 
                                    LEFT JOIN nacionalidad AS nna 
                                    ON epl.serial_nac = nna.serial_nac 
                                    LEFT JOIN tipocontratostrabajo AS tct 
                                    ON epl.serial_tct = tct.serial_tct 
                                    LEFT JOIN escalafones AS esc 
                                    ON esc.serial_esc = epl.serial_esc 
                                    LEFT JOIN cargos AS car 
                                    ON car.serial_car = esc.serial_car 
                                    LEFT JOIN tipoescalafones AS tes 
                                    ON tes.serial_tes = esc.serial_tes 
                                WHERE
                                    hrr.serial_epl=epl.serial_epl 
                                    AND materia.serial_mat=hrr.serial_mat 
                                    AND area.serial_are=materia.serial_are 
                                    AND area.serial_fac=facultad.serial_fac 
                                    AND periodo.serial_per=hrr.serial_per 
                                    AND periodo.serial_suc = suc.serial_suc 
                                    AND tipoEmpleado_epl = 'PROFESOR' 
                                    AND prospecto_epl = 'NO' 
                                    AND fechaingreso_epl<='".$fecha_fin."' 
                                    AND fecini_per >='".$fecha_ini."' 
                                    AND fecini_per<='".$fecha_fin."' 
                                    AND estado_hrr='ACTIVO' 
                                    AND hrr.serial_hrr IN(  SELECT
                                                                serial_hrr 
                                                            FROM
                                                                detallemateriamatriculada 
                                    )
                                    AND periodo.serial_sec = 1 
									AND hrr.seccion_hrr NOT IN('AVANZADA','UBICACION')
									".$sucursal."
                                GROUP BY
                                    hrr.serial_epl 
    )
".$sucursal."
GROUP BY
    hrr.serial_epl
"
;
switch($serial_sec){
	case '1': 
			$sqlProf = $sqlPregrado;
			//echo "<br>PRE<br>";
		break;
	case '2':			
			$sqlProf = $sqlPostgrado;
			//echo "<br>POS<br>";
		break;
	case 'T':
			$sqlProf = $sqlTodas;
			//echo "<br>TODAS<br>";
		break;
}

//		and hrr.serial_epl = 471
//and hrr.serial_epl = 538
//and hrr.serial_epl = 212
//	and hrr.serial_epl in (1563,1557,590,525,629)
echo "<br>sqlProf: ".$sqlProf."<br>";
exit(0);
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
			//echo "<br>FORMACION TERCER NIVEL : ".$arrForm['nivel']."<br>";
			if($arrForm['nivel'] == "III DOCTOR EN JURISPRUDENCIA O FILOSOFIA" or $arrForm['nivel'] == "IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"){
				$arrMain[$i]['nivel_tn'] = "DOCTOR EN FILOSOFIA O JURISPRUDENCIA";
			}else{
				$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
			}
			$arrMain[$i]['titulo_tn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_tn'] = $arrForm['institucion'];
			$arrMain[$i]['fechafin_foa'] = $arrForm['fecha'];			
			$arrMain[$i]['pais_tn'] = strtoupper($arrForm['pais']);
			//quit
			//$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
			$arrMain[$i]['registro_tn'] = $arrForm['registro'];
		}else{
			$arrMain[$i]['titulo_tn'] = "SIN TITULO DE TERCER NIVEL";
			$arrMain[$i]['institucion_tn'] = "NO CORRESPONDE";
			$arrMain[$i]['fechafin_foa'] = "";			
			$arrMain[$i]['nivel_tn'] = "SIN TITULO DE TERCER NIVEL";
			$arrMain[$i]['pais_tn'] = "NO CORRESPONDE";
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
						$arrMain[$i]['nivel_cn'] = "MAGISTER";	
					break;
				case "DOCTORADO":	
						$arrMain[$i]['nivel_cn'] = "DOCTOR PH.D";	
					break;				
				default: $arrMain[$i]['nivel_cn'] = $arrForm['nivel'];			
			}
			$arrMain[$i]['titulo_cn'] = $arrForm['titulo'];
			$arrMain[$i]['institucion_cn'] = $arrForm['institucion'];
			//if($arrMain[$i]['titulo_tn']<>"SIN TITULO DE TERCER NIVEL"){
			$arrMain[$i]['fechafin_foa'] = $arrForm['fecha'];
			//}
			//quit
			//$arrMain[$i]['nivel_cn'] = $arrForm['nivel'];						
			$arrMain[$i]['pais_cn'] =strtoupper($arrForm['pais']);
			$arrMain[$i]['registro_cn'] = $arrForm['registro'];
		}else{
			$arrMain[$i]['titulo_cn'] = "";
			$arrMain[$i]['institucion_cn'] = "&nbsp;";
			$arrMain[$i]['nivel_cn'] = "SIN TITULO DE CUARTO NIVEL";
			if($arrMain[$i]['titulo_tn']=="SIN TITULO DE TERCER NIVEL"){
				$arrMain[$i]['fechafin_foa'] = "";
			}
			$arrMain[$i]['pais_cn'] = "&nbsp;";
			$arrMain[$i]['registro_cn'] = "&nbsp;";		
		}
		//Set SubareaUnesco 
		$SubUnesco = getSubUnesco($arrMain[$i]['titulo_tn'],$arrMain[$i]['titulo_cn']);
		if($SubUnesco){
			$arrMain[$i]['unesco'] = $SubUnesco;
		}else{
			$arrMain[$i]['unesco'] = "&nbsp;";
		}
		//Set Sueldo 2011 
		if($fecha_ini == '2011-01-01'  and $fecha_fin == '2011-12-31'){
			$sueldo2011 = getSueldo2011($arrMain[$i]['documentoidentidad_epl']);
			if($sueldo2011){
				$arrMain[$i]['sueldo2011'] = $sueldo2011;
			}else{
				$arrMain[$i]['sueldo2011'] = "&nbsp;";
			}
		}

		//Set del nivel de formacio General por prioridad
		$arr = evalFormProf($arrMain[$i]['serial_epl'],$dblink);
		if($arr){
			//$arrMain[$i]['nombre_nac'] = $arr; ant
			$arrMain[$i]['nombre_nac'] = $arr[0]['nombre_nac'];
			//$arrMain[$i]['fechafin_foa'] = $arr[0]['fechafin_foa'];

			//Tablas dinamicas por formacion general del profesor
			//$arrMain[$i]['formaciongen'] = $arr; ant
			$arrMain[$i]['formaciongen'] = $arr[0]['nombre_nac'];
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

		$arrHoraAcademica = gethorasAcadNew($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$fecha_ini,$fecha_fin,$dblink);
				//gethorasAcadNew($serial_epl,$serial_sec,$fecha_ini,$fecha_fin,$dblink){
		if($arrHoraAcademica){			
			//echo "<br> HORA ACADEMICA: ".$arrHoraAcademica[0]['numero_horas_materia'];
			
			$arrMain[$i]['totalhoraprofesor'] = $arrHoraAcademica[0]['totalhoraprofesor'];
			$arrMain[$i]['horaacademica'] = $arrHoraAcademica[0]['numero_horas_materia'];
			$arrMain[$i]['tothoraobs'] = $arrHoraAcademica[0]['tothoraobs'];
		}else{
			$arrMain[$i]['horaacademica'] = 0;
		}
			//Set Horas Academicas con el Calculo antiguo
		$hAcad = HorasAcad($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$dblink);
		if($hAcad){			
			$arrMain[$i]['horaacademicaant'] = $hAcad;
		}else{
			$arrMain[$i]['horaacademicaant'] = 0;
		}
		
		$arrMain[$i]['horaacademica'] = round($arrMain[$i]['horaacademica'],0);				
		//Set Horas Investigacion 
		$hInv = getHorasInvestigacion($arrMain[$i]['serial_epl'],$dblink);
		if($hInv){			
			$arrMain[$i]['horainvestigacion'] = $hInv;
		}else{
			$arrMain[$i]['horainvestigacion'] = 0;
		}
		$arrMain[$i]['horainvestigacion'] = round($arrMain[$i]['horainvestigacion'],0);				
		//Set Horas Vinculacion
		$hVinc = getHorasVinculacion($arrMain[$i]['serial_epl'],$dblink);
		if($hVinc){			
			$arrMain[$i]['horavinculacion'] = $hVinc;
		}else{
			$arrMain[$i]['horavinculacion'] = 0;
		}
		$arrMain[$i]['horavinculacion'] = round($arrMain[$i]['horavinculacion'],0);				
		//Set Horas Administrativas		
		if(getHorasAdministrativa($arrMain[$i]['documentoidentidad_epl'],$dblink)){
			$hAdm = number_format(40 -($arrMain[$i]['horaacademica']+$arrMain[$i]['horainvestigacion'] +$arrMain[$i]['horavinculacion']),2);
			$arrMain[$i]['horaadministrativa'] = $hAdm;
		}else{
			$arrMain[$i]['horaadministrativa'] = 0;
		}
		$arrMain[$i]['horaadministrativa'] = round($arrMain[$i]['horaadministrativa'],0);				
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
		//Set Materias Dictadas
		$arrMatDict = getMatDictProfesor($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$fecha_ini,$fecha_fin,$dblink);
		if($arrMatDict){
			$arrMain[$i]['matdict'] = $arrMatDict[0]['cad'];
		}else{
			$arrMain[$i]['matdict'] = '';
		}
		//Set Materia con mas horas y Promedio de horas Materia
		$arrMasHoras = getMatMasHoras($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$fecha_ini,$fecha_fin,$dblink);
		if($arrMasHoras){
			$arrMain[$i]['matmashoras'] = $arrMasHoras[0]['nombre_mat'];
			$arrMain[$i]['numero_horas_materia'] = $arrMasHoras[0]['numero_horas_materia'];			
		}else{
			$arrMain[$i]['matmashoras'] = '';
		}
		//set publicaciones		
		$arrPublicaciones = getPublicaciones($arrMain[$i]['serial_epl'],$fecha_ini,$fecha_fin,$dblink);
		if($arrPublicaciones){
			/*
			1	Publicados en revistas internacionales no indexadas
			2	Publicados en revistas nacionales indexadas
			3	Publicados en revistas nacionales no indexadas
			4	Publicados con ISBN
			5	Publicados sin ISBN
			7	Publicados en revistas internacionales indexadas
			*/
			$arrMain[$i]['PII'] = $arrPublicaciones[0][7];
			$arrMain[$i]['PINI'] = $arrPublicaciones[0][1];
			$arrMain[$i]['PNI'] = $arrPublicaciones[0][2];
			$arrMain[$i]['PNNI'] = $arrPublicaciones[0][3];
			$arrMain[$i]['PCI'] = $arrPublicaciones[0][4];
			$arrMain[$i]['PSI'] = $arrPublicaciones[0][5];		
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
	//echo "<strong> INInio ".$arrMain[$i]['nombre']." <--> ".$arrMain[$i]['formaciongen']."ser: ".$arrMain[$i]['serial_epl']." KEY: ".$key." <strong><br>";
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
									//echo "<br>key: ".$key."<br>";
									if($key == 'MAGISTER'){
										//echo "<strong> NOMBRE: ".$arrMain[$i]['nombre']." FORMACION: ".$arrMain[$i]['formaciongen']."SERIAL: ".$arrMain[$i]['serial_epl']." KEY: ".$key." <strong><br>";								
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
		$horaAcadem =  round($arrMain[$i]['horaacademica'],0);
		$arrMain[$i]['horadedicacionround'] = round($arrMain[$i]['horadedicacion'],0);
		//echo round(3.6, 0);
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
<title>Profesores PEI con FILTRO</title>

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
	//Open modal form listado form
	$(function() {
		$( "#horaslistado-form" ).dialog({
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

		$( "#create_horaslistado" )
			.button()
			.click(function() {
				$( "#horaslistado-form" ).dialog( "open" );
			});
	});
	</script>
	

	<script>
	//Open modal form listado form
	$(function() {
		$( "#edadlistado-form" ).dialog({
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

		$( "#create_listadoedad" )
			.button()
			.click(function() {
				$( "#edadlistado-form" ).dialog( "open" );
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
	<th scope="col">Institucion</th>
	<th scope="col">Provincia</th>
	<th scope="col">Canton</th>
	<th scope="col">parroquia</th>
	<th scope="col">Direccion</th>
	<th scope="col">Cedula</th>
	<th scope="col">Apellido Paterno</th>
	<th scope="col">Apellido Materno</th>
	<th scope="col">Nombres</th>
	<th scope="col">Sexo</th>
	<th scope="col">Nacionalidad</th>
	<th scope="col">Fecha Nacimiento</th>
	<th scope="col">Titulo TN</th>
	<th scope="col">Universidad_TITULO_TN</th>
	<th scope="col">Nivel_TITULO_TN</th>
	<th scope="col">PAIS_TITULO_TN</th>
	<th scope="col">REGISTRO_CONESUP_TN</th>
	<th scope="col">TITULO_CN</th>
	<th scope="col">UNIVERSIDAD_TITULO_CN</th>
	<th scope="col">NIVEL_TITULO_CN</th>
	<th scope="col">PAIS_TITULO_CN</th>
	<th scope="col">REGISTRO_CONESUP_CN</th>
	<th scope="col"><p>SUBAREA_TITULO_PROFE</p>	  </th>
	<th scope="col">MATERIAS_IMPARTE</th>
	<th scope="col">MATERIA_MAYOR_HORAS </th>
	<th scope="col">NUMERO_HORAS_MATERIA </th>
	<th scope="col">FECHA_INGRESO_IES</th>
	<th scope="col">RELACION_TRABAJO_IES</th>
	<th scope="col">INGRESO_CONCURSO </th>
	<th scope="col">CARGO_ADMI_O_ACADEMICO</th>
	<th scope="col">CARGO_AUTORIDAD </th>
	<th scope="col">CATEGORIA</th>
	<th scope="col">CATEGORIA_UBICACION </th>
	<th scope="col">SUELDO_2011 </th>
	<th scope="col">DEDICACION</th>
	<th scope="col">UNIDAD_ACADEMICA</th>
	<th scope="col">HORAS_ACADEM</th>
	<th scope="col">HORAS_ADMINIST</th>
	<th scope="col">HORAS_INVESTIG</th>	
	<th scope="col">HORAS_VS</th>	
	<th scope="col">SIST_EVAL_DOCENTE</th>
	<th scope="col">PART_EVENT_ACADEMICOS</th>
	<th scope="col">AUSPICIO_SEMINARIO </th>
	<th scope="col">AFILACION_ASOCIACION </th>
	<th scope="col">BENEFICIO_ASCENSO </th>
	<th scope="col">PERIODO_SABATICO</th>
	<th scope="col">ACAD_EXTRANJERO</th>
	<th scope="col">INVESTIGADOR_PERM</th>
	<th scope="col">INVESTIGADOR_ESP</th>
	<th scope="col">PUBLICACION_R_INTERNACIONALES_INDEXADAS</th>
	<th scope="col">UBLICACION_R_INTERNACIONALES_NO_INDEXADAS</th>
	<th scope="col">PUBLICACION_R_NACIONALES_INDEXADAS </th>
	<th scope="col">PUBLICACION_R_NACIONALES_NO_INDEXADAS </th>
	<th scope="col">NUMERO_LIBROS_PUBLICADOS_CON_ISBN </th>
	<th scope="col">NUMERO_LIBROS_PUBLICADOS_SIN_ISBN </th>
	<th scope="col">NIVEL_DOC_TN</th>
	<th scope="col">NIVEL_DOC_CN</th>
	<th scope="col">EMAIL</th>	  
	<th scope="col">FECHA_TITULo </th>
	<th scope="col">OBSERVACIONES</th>
	<th scope="col">FORMA CONTRATO </th>
	<th scope="col">HORA REAL </th>
	<th scope="col">TH /prof </th>	  
	</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="row">Total</th>
				<td colspan="62"><?php echo $totAll." PROFESORES";?></td>
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
			<th scope="row" id="<?php echo "r".$i+1;?>"><a href="#" ><?php echo $arrMain[$i]['codigo_institucion']." - ".$arrMain[$i]['serial_epl'];?></a></th>
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
				<td><?php echo $arrMain[$i]['unesco'] ?></td>
				<td><?php echo $arrMain[$i]['matdict'] ?></td>
				<td><?php echo $arrMain[$i]['matmashoras'] ?></td>
				<td><?php echo $arrMain[$i]['numero_horas_materia'] ?></td>
				<td><?php echo $arrMain[$i]['fechaingresoinstitucion'] ?></td>
				<td><?php echo strtoupper($arrMain[$i]['nombre_tct']); ?></td>
				<td><?php echo "NO";?></td>
				<td><?php echo $arrMain[$i]['cargo']; ?></td>
				<td><?php echo $arrMain[$i]['cargoautoridad']; ?></td>
				<td><?php echo $arrMain[$i]['catprof_epl']; ?></td>
				<td><?php echo "NO";?></td>
				<td><?php echo $arrMain[$i]['sueldo2011'];?></td>
				<td><?php echo $arrMain[$i]['horadedicacionround'];?></td>
				<td><?php echo $arrMain[$i]['nombre_suc'];?></td>
				<td><?php echo $arrMain[$i]['horaacademica']; ?></td>
				<td><?php echo $arrMain[$i]['horaadministrativa'];?></td>
				<td><?php echo $arrMain[$i]['horainvestigacion'];?></td>
				<td><?php echo $arrMain[$i]['horavinculacion'];?></td>
				<td><?php echo $arrMain[$i]['sistevaldocente']; ?></td>
				<td><?php echo $arrMain[$i]['eventoacademico']; ?></td>
				<td><?php echo "NO";?></td>
				<td><?php echo "NO";?></td>
				<td><?php echo "NO";?></td>
				<td><?php echo $arrMain[$i]['periodosabatico'] ?></td>
				<td><?php echo $arrMain[$i]['academicoextranjero'];?></td>
				<td><?php echo $arrMain[$i]['investigadorpermanente'];?></td>
				<td><?php echo $arrMain[$i]['investigadoresporadico'];?></td>
				<td><?php echo $arrMain[$i]['PII'];?></td>
				<td><?php echo $arrMain[$i]['PINI'];?></td>
				<td><?php echo $arrMain[$i]['PNI'];?></td>
				<td><?php echo $arrMain[$i]['PNNI'];?></td>
				<td><?php echo $arrMain[$i]['PCI'];?></td>
				<td><?php echo $arrMain[$i]['PSI'];?></td>
				<td><?php echo $arrMain[$i]['niveldoctn'];?></td>
				<td><?php echo $arrMain[$i]['niveldoccn']; ?></td>
				<td><?php echo strtolower($arrMain[$i]['email_epl']); ?></td>
				<td><?php echo strtolower($arrMain[$i]['fechafin_foa']); ?></td>
				<td><?php /*echo "&nbsp;";*//*echo $arrMain[$i]['nombre_nac']*/echo $arrMain[$i]['formaContrato_epl']." / ".$arrMain[$i]['horaacademicaant']." / ".$arrMain[$i]['tothoraobs'];?></td>
				<td><?php echo $arrMain[$i]['formaContrato_epl'];?></td>
				<td><?php echo $arrMain[$i]['horaacademicaant'];?></td>
				<td><?php echo $arrMain[$i]['totalhoraprofesor']?></td>
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
        <td><?php echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+ $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+ $totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'] + $totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+ $totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'] + $totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'] + $totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+ $totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'] + $totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php  echo $totFormMasNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContConRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContSinRelDep['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemConvenio['III DOCTOR EN JURISPRUDENCIA O FILOSOFIA'] + $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
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
        <td><?php echo $totFormMasNomb['MAGISTER'];// + $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemNomb['MAGISTER'];// + $totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContConRelDep['MAGISTER'];// + $totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContConRelDep['MAGISTER'];// + $totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasContSinRelDep['MAGISTER']; //+ $totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemContSinRelDep['MAGISTER'];// + $totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasConvenio['MAGISTER'];// + $totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormFemConvenio['MAGISTER'];// + $totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
        <td><?php echo $totFormMasNomb['MAGISTER']+$totFormFemNomb['MAGISTER']+$totFormMasContConRelDep['MAGISTER']+$totFormFemContConRelDep['MAGISTER']+$totFormMasContSinRelDep['MAGISTER']+$totFormFemContSinRelDep['MAGISTER']+$totFormMasConvenio['MAGISTER']+$totFormFemConvenio['MAGISTER'];//+ $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContConRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemContSinRelDep['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormMasConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA']+$totFormFemConvenio['IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA'];?></td>
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
            <td colspan="5"><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $sumCont;?></strong> no se procesaron: <strong><? echo $sumOtrosTwo;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $sumCont + $sumOtrosTwo ;?></strong> Prof.
              <input name="create_horaslistado" id="create_horaslistado" type="button" value="...">
            </div></td>
          </tr>
          <tr>
            <td>0-19 hrs.  &quot;Cat A&quot; </td>
            <td>20-29    hrs.  &quot;Cat C&quot; </td>
            <td>30-39    hrs. &quot;Cat D&quot; </td>
            <td>40    hrs &quot;Cat E&quot; </td>
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
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"]+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"]+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"]+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"]+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
            <td><strong><?php echo $sumPrior["III DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]+ $sumPrior["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
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
            <td><?php echo $contClase["MAGISTER"]["A"]; //+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["A"];?></td>
            <td><?php echo $contClase["MAGISTER"]["C"]; //+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["C"];?></td>
            <td><?php echo $contClase["MAGISTER"]["D"]; //+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["D"];?></td>
            <td><?php echo $contClase["MAGISTER"]["E"]; //+ $contClase["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"]["E"];?></td>
			<td><strong><?php echo $sumPrior["MAGISTER"]; //+ $sumPrior["IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA"];?></strong></td>
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
            <td><div align="center">De un total de : <strong><?php echo $totAll;?></strong> Prof. se procesaron: <strong><?php echo $totAll - $edadError; ?></strong> no se procesaron: <strong><? echo $edadError;?></strong> sumando los procesados y no procesados dan un Total de: <strong>: <?php echo $edadError + ($totAll -$edadError);?></strong> Prof. 
              <input name="create_listadoedad" id="create_listadoedad" type="button" value="...">
            </div></td>
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

<!--LISTADO FORMACION NIVEL-->
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
					<td>".$arrMain[$i]["nombre_nac"]."</td>
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

<!--LISTADO FORMACION HORAS-->
<?php $tot = count($arrMain);?>
<div id="horaslistado-form" title="Principal Formacion horas">
	<p class="validateTips">Listado de <?php echo count($arrMain); ?> Listado Horas</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Nombre</th>				
				<th>Formacion</th>
				<th>Categoria</th>
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
					<td>".$arrMain[$i]["nombre_nac"]."</td>
					<td>".$arrMain[$i]["hdcategoria"]."</td>
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

<!--LISTADO EDAD-->
<?php $tot = count($arrMain);?>
<div id="edadlistado-form" title="Principal Listado Edad">
	<p class="validateTips">Listado de <?php echo count($arrMain); ?> Listado Edad</p>
	<form>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>No</th>
				<th>Nombre</th>				
				<th>Edad</th>
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
					<td>".$arrMain[$i]["edad"]."</td>
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
									'IV DOCTOR EN JURISPRUDENCIA O FILOSOFIA',
									'III DOCTOR EN JURISPRUDENCIA O FILOSOFIA')";						
		$arrPrior = $GLOBALS['arrTercerNivel'];		
		break;
	case 'CUARTO NIVEL':
		$tipo = "AND nombre_nac in ('MAGISTER',
									'CUARTO NIVEL',
									'ESPECIALISTA',
									'DOCTORADO',
									'DIPLOMADO')";						
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
				"fecha" => $arrForm[$formPos]['fechafin_foa'],
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
/*
* Nueva funcion de calculo de horas acad
*/
function gethorasAcadNew($serial_epl,$serial_sec,$fecha_ini,$fecha_fin,$dblink){
	switch($serial_sec){
		case '1': 
				$fec = "fecini_per";
			break;
		case '2':
				$fec = "fechorario_hrr";	
			break;
	}
	$sqlGet = "
		SELECT
			nombre_mat,
			nombre_per,
			nombrehorario_hrr,
			nts.ntotalclases_nts 
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			materia                   AS mat,
			horario                   AS hrr,
			notas                     AS nts 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND mmat.serial_per = per.serial_per 
			AND hrr.serial_hrr = dmat.serial_hrr 
			AND dmat.serial_mat = mat.serial_mat 
			AND nts.serial_hrr = hrr.serial_hrr 
			AND ".$fec.">='".$fecha_ini."' 
			AND ".$fec."<='".$fecha_fin."' 
			AND per.serial_sec = ".$serial_sec." 
			AND estado_hrr = 'ACTIVO' 
			AND hrr.serial_epl = ".$serial_epl." 
		GROUP BY
			hrr.serial_hrr 
		ORDER BY
			ntotalclases_nts DESC
	";		 
	$cad = "";
	//echo "<br>SQL GET Mas Horas: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		//print "<pre>";print_r($arr);print "<pre>";
		$cont = 0;
		$tot = count($arr);
		//echo "<br>COUNT: ".$tot;
		for($i=0;$i<$tot;$i++){
			$cont = $cont + $arr[$i]['ntotalclases_nts'];		
		}		
		$arrNew[0]['totalhoraprofesor'] = $cont ;
		$arrNew[0]['numero_horas_materia'] = number_format(($cont/32),2);
				//echo "<br>ANTES: ".number_format(($cont/32),2);
		$arrNew[0]['tothoraobs'] = $cont;
		return $arrNew;  
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
			nombre_nac,
			fechafin_foa
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
			//echo "<strong>".$arr[$pos]['nombre_nac']."-------<strong>";
			$arrRet[0]['nombre_nac'] = $arr[$pos]['nombre_nac'];
			$arrRet[0]['fechafin_foa'] = $arr[$pos]['fechafin_foa'];
			return $arrRet;
			//return $arr[$pos]['nombre_nac'];
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
/*
* Funcion que devuelve un string de las materias que ha dictado un profesor en un rango de fechas
*/
function getMatDictProfesor($serial_epl,$serial_sec,$fecha_ini,$fecha_fin,$dblink){
	switch($serial_sec){
		case '1': 
				$fec = "fecini_per";
			break;
		case '2':
				$fec = "fechorario_hrr";	
			break;
	}
	$sqlGet = "
		SELECT					
			nombre_mat 
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			materia                   AS mat,
			horario                   AS hrr 
		WHERE
					mmat.serial_mmat = dmat.serial_mmat 
					AND mmat.serial_per = per.serial_per 
					AND hrr.serial_hrr = dmat.serial_hrr 
					AND dmat.serial_mat = mat.serial_mat      
					AND ".$fec." >='".$fecha_ini."' 
					AND ".$fec." <='".$fecha_fin."'  
					AND per.serial_sec = ".$serial_sec."
					AND hrr.serial_epl = ".$serial_epl." 
				GROUP BY
					mat.serial_mat
			";		 


	$cad = "";

	//echo "<br>SQLGET: ".$sqlGet."<br>";
	
	$arrCad = array();
	if($arr = $dblink->GetAll($sqlGet)){
		//print "<pre>";print_r($arr);print "<pre>";
		for($i=0;$i<count($arr);$i++){
			if(strlen($cad)==0){
				$cad = $cad.$arr[$i]['nombre_mat'];
			}else{
				$cad = $cad . " - ".$arr[$i]['nombre_mat']." ";
			}
		}
		
		$arrCad[0]['cad'] = trim($cad);
		return $arrCad;
	}else{
		return false;
	}

}

/*
* Funcion que devuelve un la materia con mas horas
*/
function getMatMasHoras($serial_epl,$serial_sec,$fecha_ini,$fecha_fin,$dblink){
	switch($serial_sec){
		case '1': 
				$fec = "fecini_per";
			break;
		case '2':
				$fec = "fechorario_hrr";	
			break;
	}
	$sqlGet = "
		SELECT
			nombre_mat,
			nombre_per,
			nombrehorario_hrr,
			nts.ntotalclases_nts 
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			materia                   AS mat,
			horario                   AS hrr,
			notas                     AS nts 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND mmat.serial_per = per.serial_per 
			AND hrr.serial_hrr = dmat.serial_hrr 
			AND dmat.serial_mat = mat.serial_mat 
			AND nts.serial_hrr = hrr.serial_hrr 
			AND ".$fec.">='".$fecha_ini."' 
			AND ".$fec."<='".$fecha_fin."' 
			AND per.serial_sec = ".$serial_sec." 
			AND estado_hrr = 'ACTIVO' 
			AND hrr.serial_epl = ".$serial_epl." 
		GROUP BY
			hrr.serial_hrr 
		ORDER BY
			ntotalclases_nts DESC
	";		 
	$cad = "";
	//echo "<br>SQL GET Mas Horas: ".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){		
		/*$cont = 0;
		for($i=0;$i<count($arr);$i++){
			$cont = $cont + $arr[$i]['ntotalclases_nts'];		
		}*/
		$arrNew[0]['nombre_mat'] = $arr[0]['nombre_mat'];
		//$arrNew[0]['numero_horas_materia'] = $arr[0]['ntotalclases_nts']; 
		$arrNew[0]['numero_horas_materia'] = number_format(5,2);
		//$arrNew[0]['numero_horas_materia'] = number_format(($cont/32),2);
		return $arrNew;  
	}else{
		return false;
	}

}
function getNumHorasMat($serial_mat,$dblink){

}

/*
Funcion que devuelve todas las publicaciones de un profesor
*/

function getPublicaciones($serial_epl,$fecha_ini,$fecha_fin,$dblink){
	$sqlTipo = "
		SELECT
			serial_pmod,
			descripcion_pmod 
		FROM
			publicacionmodalidad 
		WHERE
			serial_pmod IN(1,7,2,3,4,5)
	";
	if($arrTipo = $dblink->GetAll($sqlTipo)){
		for($i=0;$i<count($arrTipo);$i++){
			///
			$sqlGet = "
				SELECT
					serial_pbl,
					nombre_pbl,
					fecha_pbl,
					forma_pbl,
					concat_ws(' ',nombre_pti,descripcion_pmod)AS tipo,
					descripcion_pmod,
					observacion_pbl,
					publicacionesprofesor.serial_pmod,
					serial_epl 
				FROM
					publicacionesprofesor,
					publicaciontipo,
					publicacionmodalidad 
				WHERE
					publicacionmodalidad.serial_pti=publicaciontipo.serial_pti 
					AND publicacionesprofesor.serial_pmod=publicacionmodalidad.serial_pmod 
					AND fecha_pbl >='".$fecha_ini."' 
					AND fecha_pbl <='".$fecha_fin."' 
					AND serial_epl = ".$serial_epl."
					AND publicacionmodalidad.serial_pmod = ".$arrTipo[$i]['serial_pmod']."
			";
			//echo "<br>".$sqlGet."<br>";		 	
			if($arr = $dblink->GetAll($sqlGet)){
				for($j=0;$j<count($arr);$j++){
					if(strlen($arrNew[0][$arrTipo[$i]['serial_pmod']])==0){
						$arrNew[0][$arrTipo[$i]['serial_pmod']] = $arrNew[0][$arrTipo[$i]['serial_pmod']].$arr[$j]['nombre_pbl'];
					}else{
						$arrNew[0][$arrTipo[$i]['serial_pmod']] = $arrNew[0][$arrTipo[$i]['serial_pmod']]. " - ".$arr[$j]['nombre_pbl'];
					}
					
				}
			}			
		}
		//print "<pre>";print_r($arrMain);print "<pre>";
		return $arrNew;  
		
	}else{
		return false;
	}
}
/*
funcion que pone el area subunesco
*/
function getSubUnesco($titulo_tn,$titulo_cn){
	
	$arr = $GLOBALS['arrUnesco'];
	$sw = 0;
	$tot = count($arr);
	//echo "<br>TITULO TN: ". $titulo_tn;
	//echo "<br>TITULO CN: ". $titulo_cn;
	//echo "<br>TAMAÑO CN: ". strlen(trim($titulo_cn));
	if(strlen(trim($titulo_cn))>0){
		$titulo = $titulo_cn;		
	}else{
		$titulo = $titulo_tn;
	}
	
	//echo "<br>TITULO 1: ". $titulo;
	//echo "<br>TAMAÑO 1: ". strlen($titulo);
	//echo "<br>TITULO 2: ". $arr[150]['titulo'];
	//echo "<br>TAMAÑO 2: ". strlen($arr[150]['titulo']);
	for ($i=0;$i<$tot;$i++){		
	$a = str_replace(' ', '', $titulo);
	$b = str_replace(' ', '', $arr[$i]['titulo']);

		if($a==$b){
			//echo "<br>COMPARA: ". strcasecmp(trim($arr[$i]['titulo']),trim($titulo));
			$sw = 1;
			return $arr[$i]['unesco'];
		}	
	}
	if ($sw == 0){
		return false;
	}

}

function getSueldo2011($cedula){
	
	$arr = $GLOBALS['arrSueldo2011'];
	$sw = 0;
	$tot = count($arr);
	for ($i=0;$i<$tot;$i++){		
		$a = str_replace(' ', '', $cedula);
		$b = str_replace(' ', '', $arr[$i]['id']);
		if($a==$b){
			//echo "<br>COMPARA: ". strcasecmp(trim($arr[$i]['titulo']),trim($titulo));
			$sw = 1;
			return $arr[$i]['sueldo'];
		}	
	}
	if ($sw == 0){
		return false;
	}

}




?>

