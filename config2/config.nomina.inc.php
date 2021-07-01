<?php
$FILASPORPAGINA = 10;  //numero de filas desplegadas por pantalla
$TIPOSCUENTA=array("CC"=>"Cuenta Corriente","AH"=>"Cuenta de Ahorros");
$TIPOROL=array("N"=>"Rol Normal","P"=>"Rol Provisiones","A"=>"Rol Anticipos");
$TIPOSANGRE= array("O+","O-","A+","A-","B+","B-","AB+","AB-"); //tipo de sangre de un empleado
$TIPODOCUMENTO = array("C"=>"Cedula","R"=>"Ruc","E"=>"Extranjero"); //tipo de Documentos que se pueden almacenar
$TIPOIDENTIFICACION= array("C"=>"Cedula","R"=>"Ruc","E"=>"Extranjero"); //estado de un empleado
//$TIPOCONTRATO= array("A"=>"A prueba","F"=>"Fijo","I"=>"Indefinido","H"=>"Honorarios");// relacion laboral del empleado
$RELACIONLABORAL= array("D"=>"Directa","T"=>"Tercerizacion");// relacion laboral del empleado
$TIPOCARGO=array("1"=>"Docente","2"=>"Administrativo","3"=>"Servicios");//tipo de cargo del empleado
$ESTADOEMPLEADO = array("A"=>"Activo","I"=>"Inactivo","C"=>"Cancelado"); //estado de un empleado
$ESTADORUBROSROL = array("A"=>"Activo","I"=>"Inactivo"); //estado de un Rubro
$ESTADOTEST = array("A"=>"Activado","D"=>"Desactivado"); //estado de un empleado
$SI_NO=array("S"=>"Si","N"=>"No");//estado verdadero o falso
$ESTADOPERMISO = array("A"=>"Activo","T"=>"Terminado","C"=>"Cancelado"); //estado de un permiso
$OPCIONLETRAS=array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E","6"=>"F","7"=>"G","8"=>"H","9"=>"I","10"=>"J");//arreglo de opciones para preguntas de relacion 
//Tipos de respuesta para las preguntas del test
$UNICARESPUESTA=1;
$MULTIPLERESPUESTA=2;
$RELACION=3;
$RELLENO=4;
//Tipos de preguntas para el test
$TIPOPREGUNTA=array("1"=>"Eleccion Multiple (Unica Respuesta)","2"=>"Eleccion Multiple (Multiple Respuesta)","3"=>"Relacionar","4"=>"Rellenar los huecos ");//Tipos de preguntas
$FRECUENCIA=array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12");// frecuencia de cobro del rubro
//NO ---$TIPOCARGO=array("N"=>"Ninguna","4"=>"Cuarta","5"=>"Quinta","6"=>"Sexta","7"=>"Séptima","8"=>"Octava","9"=>"Novena","0"=>"Décima");
$SECCIONES=array("0"=>"Primaria","1"=>"Secundaria Matutina","2"=>"Secundaria Vespertina");
//PARA LOS COLEGIOS
//$NIVELES=array("N"=>"Ninguna","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","13"=>"13","14"=>"14");
$PORCENTAJES=array("25"=>"25%","50"=>"50%","100"=>"100%");
?>