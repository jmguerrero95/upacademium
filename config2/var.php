<?
$COLEGIO='THE BRITISH SCHOOL';
$CIUDAD='Quito - Ecuador';
$DIRECCION='Cununyacu, Km 2.5, Tumbaco.';
$TELEFONO='(593-2) 237-4651';
$FAX='(593-2) 237-4650';
$CASILLA= '17-21-52';
$WEB='www.';
$EMAIL='bsq@bsq.edu.ec';
$fotos="../fotos/";
$colegio2='THE BRITISH SCHOOL';
$pais ='Ecuador';
$ciudad='Quito';
//------------------CONSEJO DIRECTIVO
    include "../config/bdd.inc";
	$query = "select CONCAT(nombre_cli,' ',apellido_cli) as rector from consejo_directivo as condir,cliente as cli,empleado as empl,periodo as per
			  where condir.serial_empl=empl.serial_empl and empl.serial_cli=cli.serial_cli and tipo_condir='r' and per.serial_per=$speriodo";
	$rs=$db->Execute($query);
	$Rector=$rs->fields['rector'];
	$query = "select CONCAT(nombre_cli,' ',apellido_cli) as secre from consejo_directivo as condir,cliente as cli,empleado as empl,periodo as per
			  where condir.serial_empl=empl.serial_empl and empl.serial_cli=cli.serial_cli and tipo_condir='s' and per.serial_per=$speriodo";
	$rs=$db->Execute($query);
	$secretaria=$rs->fields['secre'];
//------------------CONSEJO DIRECTIVO


//COLORES
define('blanco', '#ffffff');
define('negro', '#000066');
define('letra', '<font face=Verdana, Arial, Helvetica, sans-serif size=1>');
define('letra1', '<font face=Verdana, sans-serif size=2>');
define('letra2', '<font face=Verdana, Times, serif size=3>');
define('letra3', '<font face=Verdana, Times, serif size=6>');
define('letra4', '<font face=Verdana, Times, serif size=7>');

//COLORES DE TABLAS
//define('colore', '#336699');
define('colore', '#525F8B');
define('colorf', '#C9DAEF');
define('colorc', '#F7F5E1');
define('colort', '#E3C5C1');
define('colora', '#E3C5C1');

//COLORES DE LETRAS
define('colora', '#FF6600');
define('colorletra', '#000066');
define('colorlink', '#FF6600');
define('coloractivo', '#D2A09B');

$valor_promedio=0.7;
$valor_examen=0.3;

//-----------ARREGLOS--------------------//
$CONSEJO = array("r"=>"Rector(a)","v"=>"Vicerector(a)","1"=>"Primer Vocal","2"=>"Segundo Vocal","3"=>"Tercer Vocal","s"=>"Secretaria");
$PADRES = array("P"=>"Padre","M"=>"Madre","A"=>"Padre/Madre","D"=>"Padrastro/Madre","S"=>"Padre/Madrastra","F"=>"Otro Familiar");
$SI_NO = array("S"=>"Si","N"=>"No");
$PROVEEDOR = array("B"=>"Bellsouth","P"=>"Porta","A"=>"Alegro","O"=>"Otro");
$TIPOIDENTIFICACION = array("N"=>"Ninguna","C"=>"Cédula","P"=>"Pasaporte");
$NIVELES = array("Pre-Básica"=>"Pre-Básica","Básica"=>"Básica","Bachillerato"=>"Bachillerato");
$CICLO = array("N"=>"Ninguno","CAA"=>"Adaptación/Aprestamiento","PR"=>"Propedeútico","BI"=>"Bachillerato Integrado");
$ESTADO_ALUMNO = array("v"=>"Vigente","n"=>"Nuevo","t"=>"En tránsito","p"=>"Repitente","c"=>"Viene con pase","s"=>"Sale con pase","e"=>"Reingreso","r"=>"Retirado");
$REPORTESMATRICULAS = array("CERMA"=>"Certificado de Matrículas","CERASIS"=>"Certificado de Asistencia","LISMA"=>"Lista de Matriculados","MAGEN"=>"Matriculas por Género","MAXMOD"=>"Matricula Por Modalidad"); //,"LISMA"=>"Lista de Matriculados","LIGA"=>"Lista General de Alumnos","ACTMA"=>"Acta de Matrícula","MAGEN"=>"Matriculas por Género","MAXMOD"=>"Matricula Por Modalidad"
$FORMAPAGO = array("CTA"=>"Débito Cuenta","REC"=>"Recaudación");
$TIPODECUENTA = array("CTA"=>"Débito Cuenta","CTE"=>"Cuenta Corriente","AHO"=>"Cuenta de Ahorros");
$REPORTESALUMNOS = array("LIST"=>"Lista","LIGA"=>"Lista General de Alumnos","ALID"=>"Alumnos - Idiomas","LAMA"=>"Alumnos - Email","ALPA"=>"Alumnos - Padres","ALDT"=>"Alumnos - Direcciones/Teléfonos","ALPR"=>"Alumnos - Procedencia","PAFA"=>"Padrón Familiar");
$REPORTESPADRES = array("EMPR"=>"Empresas","PROF"=>"Profesiones");
$IDIOMAS = array("1"=>"Español","2"=>"Inglés","3"=>"Inglés-Español","4"=>"Otros");

//-----------ARREGLOS--------------------//



//MENSAJE
function message($msg,$n){
echo( "<script language='JavaScript'>" .
      "alert(\"$msg\");" .
      "if($n==1) history.back();" .
      "if($n==2) window.close();" .	  
      "</script>");
}

//TEXTO DE LA TABLA ALUMNO
$TSERIAL_COL_ALU='Procedencia';
$TSERIAL_SEX_ALU='Género';
$TSERIAL_TRA_ALU='Bus de Ida';
$TNOMBRE_ALU='Nombres';
$TAPELLIDO_ALU='Apellidos';
$TALIAS_ALU='Nombre más conocido';
$TTIPOIDENTIFICACION_ALU='Tipo de Indentificación';
$TCODIGOIDENTIFICAION_ALU='Código de Indentificación';
$TFECNAC_ALU='Fecha de Nacimiento (AAAA-mm-dd)';
$TLUGAR_ALU='Pais de Nacimiento';
$TDIRECC_ALU='Dirección ';
$TMAIL_ALU='E-Mail ';
$TTELEFONO_ALU='Teléfono';
$TNACIONALIDAD_ALU='Nacionalidad';
$TAPROBADO_ALU='';
$TBUSRETORNO_ALU='Bus de Retorno';
$TCONQUIENVIVE_ALU='Con quién vive';
$TFECHAINGRESO_ALU='Fecha de Ingreso (AAAA-mm-dd)';
$TOBSERVACION_ALU='Observación';
$TFECHAOBS_ALU='Fecha Ingreso a Secundaria (AAAA-mm-dd)';
$TFOTO_ALU='Foto ';
$TPASEOBS_ALU='Motivo Retiro/Pase';
$TIDIOMA_ALU='Idioma';
$TFECHARETIRO_ALU='Fecha Retiro/Pase';

//TEXTO DE LA TABLA PADRES
$TSERIAL_EMP_PAD='Empresa';
$TSERIAL_ECI_PAD='Estado Civil';
$TSERIAL_PAR_PAD='Parentesco';
$TNOMBRE_PAD='Nombres';
$TAPELLIDO_PAD='Apellidos';
$TTIPOIDENTIFICACION_PAD='Tipo de Indentificación';
$TCODIGOIDENTIFICAION_PAD='Código de Indentificación';
$TLUGARNACIMIENTO_PAD='Lugar de Nacimiento';
$TFECHANACIMIENTO_PAD='Fecha de Nacimiento (AAAA-mm-dd)';
$TNACIONALIDAD_PAD='Nacionallidad';
$TSERIAL_CPR_PAD='Titulo Académico';
$TCELULAR_PAD='Celular';
$TPROVEEDOR_PAD='Proveedor';
$TTELEFONO_PAD='Teléfono';
$TCARGO_PAD='Cargo';
$TMAIL_PAD='E-Mail';
$TDIRECCION_PAD='Dirección';
$TSUELDO_PAD='Sueldo';
$TTIPOVEHICULO_PAD='Tipo de Vehículo';
$TANIOVEHICULO_PAD='Año del Vehículo';
$TAVALUOVEHICULO_PAD='Avalúo del Vehículo';
$REFERENCIABAN1_PAD='Referencia Bancaria 1';
$REFERENCIABAN2_PAD='Referencia Bancaria 2';
$TCUENTABAN1_PAD='Cuenta Bancaria 1';
$TCUENTABAN2_PAD='Cuenta Bancaria 2';
$TNTARJETETACREDITO1_PAD='No. Tarjeta de Crédito 1';
$TNTARJETETACREDITO2_PAD='No. Tarjeta de Crédito 2';
$TFALLECIDO_PAD='Fallecido';
$TNUMERODEPENDIENTES_PAD='Número de Dependientes';
$TANTIGUEDAD_PAD='Antiguedad';
$TOTROSINGRESOS_PAD='Otros Ingresos';
$TTOTALINGRESOS_PAD='Total de Ingresos';

$TREPRESENTANTE='Representante';
$TREPRESENTANTEECONOMICO='Representante Económico';




//MATRICULA---TEXTO DE LA TABLA PARALELO_ALUMNO
$TSERIAL_BAN_PARALU='Banco';
$TANIOLECTIVO='Año Lectivo';
$TMATRICULA='Matrícula No.';
$TFOLIO='Folio No.';
$TFECHAMATRICULA='Fecha de Matrícula';
$TANIO='Año ';
$TESPECIALIDAD='Especialidad: ';
$TCICLO='Ciclo ';
$TSECCION='Sección ';
$TNIVEL='Nivel';
$ESTADOALUMNO_PARALU='Estado Alumno';
$TOBSERVACION_PARALU='Observación Matrícula';
$FORMAPAGO_PARALU='Forma de pago';
$TIPOCUENTA_PARALU='Tipo de Cuenta';
$NUMEROCUENTA_PARALU='Número de Cuenta';
$TQUIENRETIRA_PARALU='Quién retira al alumno';
$TCEDULAQUIEN_PARALU='Cédula';

//TEXTO DE LA TABLA EX-ALUMNOS
$TSERIAL_TRA_EXA='Trabajos en que se ha desempeñado';
$TSERIAL_HIJ_EXA='Hijos';
$TSERIAL_ECI_EXA='Estado Civil';
$TSERIAL_COT_EXA='Ex-Compañeros con los que tiene contacto';
$TSERIAL_TIT_EXA='Titulos obtenidos';
$TSERIAL_ETD_EXA='Estudios';
$TNOMBRES_EXA='Nombre';
$TAPELLIDOS_EXA='Apellido';
$TMAIL_EXA='E-mail';
$TTELEFONOCASA_EXA='Domicilio';
$TTELEFONOOFICINA_EXA='Oficina';
$TCELULAR_EXA='Celular';
$TANIOGRADUACION_EXA='Año de Graduaci&oacute;n';
$TCONYUGUE_EXA='Nombre del Conyugue';
$TDIAHORA_EXA='Dia y hora que seria m&aacute;s f&aacute;cil reunirse';
$TSUGERENCIAS_EXA='Sugerencias';
$TDIRECCION_EXA='Direcci&oacute;n';
$TTITULOS='Títulos Obtenidos ';
$TTITULO1_EXA='1.- ';
$TTITULO2_EXA='2.- ';
$TTITULO3_EXA='3.- ';


//TEXTO DE LA TABLA HIJOS
$TSERIAL_HIJ='Serial';
$TNOMBRE_HIJ='Nombres';
$TAPELLIDO_HIJ='Apellidos';
$TFECHANACIMIENTO_HIJ='Fecha de Nacimiento';
$TEDAD='Edad';

//TEXTO DE LA TBLA ESTUDIOS
$TSERIAL_ETD='Serial';
$TUNIVERSIDAD_ETD='Universidad';
$TCARRERA_ETD='Carrera';
$TANIO_ETD='Año';

//TEXTO DE LA TABLA TITULOS
$TSERIAL_TIT='serial';
$TTITULO_TIT='T&iacute;tulo';

//TEXTO DE LA TABLA TRABAJOS
$TSERIAL_TRA='Serial';
$TEMPRESA_TRA='Empresa';
$TCARGO_TRA='Cargo';
$TTIEMPO_TRA='Tiempo';


//CERTIFICADO MATRICULA------TEXTO DEL DOCUMENTO MATRICULA
$MPARTE0='Certificado de Matrícula';
$MPARTE1='El Alumna(o)';
$MPARTE2=', previo el cumplimiento de los correspondientes';
$MPARTE3='requisitos legales y reglamentarios,';
$MPARTE4='ha sido matriculado en';
$MPARTE5='de la Seccion';
$MPARTE6=', durante el año lectivo';
$MPARTE7='La presente matrícula';
$MPARTE8='esta inscrita en el folio, ';
$MPARTE9='con el número';
$MPARTE10='de fecha';
$MPARTE11='Para constancia';
$MPARTE12='se expide esta certificación';
$MPARTE13='en la fecha de hoy';
$MPARTE14='<em><strong>RECTOR(A)</strong></em>';
$MPARTE15='<em><strong>SECRETARIO(A)</strong></em>';

//CERTIFICADO ASISTENCIA------TEXTO DEL DOCUMENTO ASISTENCIA

$ASPARTE0 = '<strong>Certificado de Asistencia</font></strong>';
$ASPARTE1 = 'EL Alumna(o):';
$ASPARTE2 = ', previo el cumplimiento de los correspondientes requisitos';
$ASPARTE3 = 'legales y reglamentarios, ';
$ASPARTE4 = 'ha sido matriculado en';
$ASPARTE5 = 'de la Secci&oacute;n';
$ASPARTE6 = ', durante el a&ntilde;o lectivo</font>';
$ASPARTE7 = 'y "SU ASISTENCIA A CLASES ES NORMAL" ';
$ASPARTE8 = 'hasta';
$ASPARTE9 = 'Para constancia,';
$ASPARTE10 = 'se expide esta certificaci&ograve;n en la fecha de hoy';
$ASPARTE11 = '<em><strong>RECTOR(A)</strong></em>';
$ASPARTE12 = '<em><strong>SECRETARIO(A)</strong></em>';
?>