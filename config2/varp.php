<?

$colegio='colegio EXPERIMENTAL BILINGUE METROPOLITANO';
$DIRECCION='Av. Le�n Febres Cordero s/n y Los Rosales - San Juan de Cumbay�';
$TELEFONO='(593)02 2893-906/2896-848/2896-885';
$FAX='(593)02 2897-055 ';
$WEB='www.colegiometropolitano.edu.ec';
$EMAIL='info@colegiometropolitano.edu.ec';
$pais='Ecuador';
$ciudad='Quito';

$fotos="../fotos/";
$colegio2='colegio METROPOLITANO';
$textoActaMatricula='En conformidad con lo que dispone el Art.223 del Reglamento General de la Ley de Educaci�n vigente, los suscritos Rector y Secretaria(o), procedimos a revisar las documentaciones, listas y matr�culas de los alumnos del '.ucwords(strtolower($colegio)).' de Pichincha, cant�n Quito.';

//------------------CONSEJO DIRECTIVO
//COLORES
define('blanco', '#ffffff');
define('negro', '#000066');
define('letra', '<font face=Verdana, Arial, Helvetica, sans-serif size=1>');
define('letra1', '<font face=Verdana, sans-serif size=2>');
define('letra2', '<font face=Verdana, Times, serif size=3>');
define('letra3', '<font face=Verdana, Times, serif size=4>');

//COLORES DE TABLAS
//define('colore', '#336699');
define('colore', '#525F8B');
define('colorf', '#C9DAEF');
define('colorc', '#F5EBE9');
define('colort', '#E3C5C1');
define('colora', '#E3C5C1');

//COLORES DE LETRAS
define('colora', '#FF6600');
define('colorletra', '#000066');
define('colorlink', '#FF6600');
define('coloractivo', '#D2A09B');


//-----------ARREGLOS--------------------//
$CONSEJO = array("r"=>"Rector(a)","e"=>"Coordinador(a) Preescolar","i"=>"Coordinador(a) Primaria","v"=>"Vicerector(a)","1"=>"Primer Vocal","2"=>"Segundo Vocal","3"=>"Tercer Vocal","s"=>"Secretaria");
$PADRES = array("P"=>"Padre","M"=>"Madre","A"=>"Padre/Madre","D"=>"Padrastro/Madre","S"=>"Padre/Madrastra","F"=>"Otro Familiar");
$SI_NO = array("S"=>"Si","N"=>"No");
$PROVEEDOR = array("B"=>"Bellsouth","P"=>"Porta","A"=>"Alegro","O"=>"Otro");
$TIPOIDENTIFICACION = array("N"=>"Ninguna","C"=>"C�dula","P"=>"Pasaporte");
$NIVELES = array("Pre-B�sica"=>"Pre-B�sica","B�sica"=>"B�sica","Bachillerato"=>"Bachillerato");
$CICLO = array("N"=>"Ninguno","CAA"=>"Adaptaci�n/Aprestamiento","PR"=>"Propede�tico","BI"=>"Bachillerato Integrado");
$ESTADO_ALUMNO = array("v"=>"Vigente","n"=>"Nuevo","t"=>"En tr�nsito","p"=>"Repitente","c"=>"Viene con pase","s"=>"Sale con pase","e"=>"Reingreso","r"=>"Retirado");
$REPORTESMATRICULAS = array("MAT"=>"Matr�culas","CERMA"=>"Certificado de Matr�culas","LISMA"=>"Lista de Matriculados","ACTMA"=>"Acta de Matr�cula","MAGEN"=>"Matriculas por G�nero","MAXMOD"=>"Matricula Por Modalidad"); 
$FORMAPAGO = array("CTA"=>"D�bito Cuenta","REC"=>"Recaudaci�n");
$TIPODECUENTA = array("CTA"=>"D�bito Cuenta","CTE"=>"Cuenta Corriente","AHO"=>"Cuenta de Ahorros");


$mes_rub[1]="Enero";
$mes_rub[2]="Febrero";
$mes_rub[3]="Marzo";
$mes_rub[4]="Abril";
$mes_rub[5]="Mayo";
$mes_rub[6]="Junio";
$mes_rub[7]="Julio";
$mes_rub[8]="Agosto";
$mes_rub[9]="Septiembre";
$mes_rub[10]="Octubre";
$mes_rub[11]="Noviembre";
$mes_rub[12]="Diciembre";
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
$TSERIAL_SEX_ALU='G�nero';
$TSERIAL_TRA_ALU='Bus de Ida';
$TNOMBRE_ALU='Nombres';
$TAPELLIDO_ALU='Apellidos';
$TTIPOIDENTIFICACION_ALU='Tipo de Indentificaci�n';
$TCODIGOIDENTIFICAION_ALU='C�digo de Indentificaci�n';
$TFECNAC_ALU='Fecha de Nacimiento (AAAA-mm-dd)';
$TLUGAR_ALU='Lugar de Nacimiento';
$TDIRECC_ALU='Direcci�n ';
$TMAIL_ALU='E-Mail ';
$TTELEFONO_ALU='Tel�fono';
$TNACIONALIDAD_ALU='Nacionalidad';
$TAPROBADO_ALU='';
$TBUSRETORNO_ALU='Bus de Retorno';
$TCONQUIENVIVE_ALU='Con qui�n vive';
$TFECHAINGRESO_ALU='Fecha de Ingreso (AAAA-mm-dd)';
$TOBSERVACION_ALU='Observaci�n';
$TFECHAOBS_ALU='Fecha Ingreso a Secundaria (AAAA-mm-dd)';
$TFOTO_ALU='Foto ';
$TPASEOBS_ALU='Pase';


//TEXTO DE LA TABLA PADRES
$TSERIAL_EMP_PAD='Empresa';
$TSERIAL_ECI_PAD='Estado Civil';
$TSERIAL_PAR_PAD='Parentesco';
$TNOMBRE_PAD='Nombres';
$TAPELLIDO_PAD='Apellidos';
$TTIPOIDENTIFICACION_PAD='Tipo de Indentificaci�n';
$TCODIGOIDENTIFICAION_PAD='C�digo de Indentificaci�n';
$TLUGARNACIMIENTO_PAD='Lugar de Nacimiento';
$TFECHANACIMIENTO_PAD='Fecha de Nacimiento (AAAA-mm-dd)';
$TNACIONALIDAD_PAD='Nacionallidad';
$TSERIAL_CPR_PAD='Titulo Acad�mico';
$TCELULAR_PAD='Celular';
$TPROVEEDOR_PAD='Proveedor';
$TTELEFONO_PAD='Tel�fono';
$TCARGO_PAD='Cargo';
$TMAIL_PAD='E-Mail';
$TDIRECCION_PAD='Direcci�n';
$TSUELDO_PAD='Sueldo';
$TTIPOVEHICULO_PAD='Tipo de Veh�culo';
$TANIOVEHICULO_PAD='A�o del Veh�culo';
$TAVALUOVEHICULO_PAD='Aval�o del Veh�culo';
$REFERENCIABAN1_PAD='Referencia Bancaria 1';
$REFERENCIABAN2_PAD='Referencia Bancaria 2';
$TCUENTABAN1_PAD='Cuenta Bancaria 1';
$TCUENTABAN2_PAD='Cuenta Bancaria 2';
$TNTARJETETACREDITO1_PAD='No. Tarjeta de Cr�dito 1';
$TNTARJETETACREDITO2_PAD='No. Tarjeta de Cr�dito 2';
$TFALLECIDO_PAD='Fallecido';
$TNUMERODEPENDIENTES_PAD='N�mero de Dependientes';
$TANTIGUEDAD_PAD='Antiguedad';
$TOTROSINGRESOS_PAD='Otros Ingresos';
$TTOTALINGRESOS_PAD='Total de Ingresos';

$TREPRESENTANTE='Representante';
$TREPRESENTANTEECONOMICO='Representante Econ�mico';




//MATRICULA---TEXTO DE LA TABLA PARALELO_ALUMNO
$TSERIAL_BAN_PARALU='Banco';
$TANIOLECTIVO='A�o Lectivo';
$TMATRICULA='Matr�cula No.';
$TFOLIO='Folio No.';
$TFECHAMATRICULA='Fecha de Matr�cula';
$TANIO='A�o ';
$TESPECIALIDAD='Especialidad: ';
$TCICLO='Ciclo ';
$TSECCION='Secci�n ';
$TNIVEL='Nivel';
$ESTADOALUMNO_PARALU='Estado Alumno';
$TOBSERVACION_PARALU='Observaci�n Matr�cula';
$FORMAPAGO_PARALU='Forma de pago';
$TIPOCUENTA_PARALU='Tipo de Cuenta';
$NUMEROCUENTA_PARALU='N�mero de Cuenta';
$TQUIENRETIRA_PARALU='Qui�n retira al alumno';
$TCEDULAQUIEN_PARALU='C�dula';

//TEXTO DE LA TABLA EX-ALUMNOS
$TSERIAL_TRA_EXA='Trabajos en que se ha desempe�ado';
$TSERIAL_HIJ_EXA='Hijos';
$TSERIAL_ECI_EXA='Estado Civil';
$TSERIAL_COT_EXA='Ex-Compa�eros con los que tiene contacto';
$TSERIAL_TIT_EXA='Titulos obtenidos';
$TSERIAL_ETD_EXA='Estudios';
$TNOMBRES_EXA='Nombre';
$TAPELLIDOS_EXA='Apellido';
$TMAIL_EXA='E-mail';
$TTELEFONOCASA_EXA='Domicilio';
$TTELEFONOOFICINA_EXA='Oficina';
$TCELULAR_EXA='Celular';
$TANIOGRADUACION_EXA='A�o de Graduaci&oacute;n';
$TCONYUGUE_EXA='Nombre del Conyugue';
$TDIAHORA_EXA='Dia y hora que seria m&aacute;s f&aacute;cil reunirse';
$TSUGERENCIAS_EXA='Sugerencias';
$TDIRECCION_EXA='Direcci&oacute;n';
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
$TANIO_ETD='A�o';

//TEXTO DE LA TABLA TITULOS
$TSERIAL_TIT='serial';
$TTITULO_TIT='T&iacute;tulo';

//TEXTO DE LA TABLA TRABAJOS
$TSERIAL_TRA='Serial';
$TEMPRESA_TRA='Empresa';
$TCARGO_TRA='Cargo';
$TTIEMPO_TRA='Tiempo';


?>