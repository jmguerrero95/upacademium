<?php
$gHost="localhost";
$gUsuarioBD="root";
$gPasswordBD="mysql";
$gBaseDatos="upacifico";
$direccionArchivos='/usr/local/apachessl/htdocs/maauxgyearchivos/';
//$direccionArchivos='/usr/local/apacheserver/accell/';
$fotos_empleados="../fotos/";
include_once('../../lib/adodb/adodb.inc.php');
include_once('../../lib/adodb/tohtml.inc.php');
include_once('../../lib/adodb/adodb-pager.inc.php');
$gConexionDB = NewADOConnection('mysql');
$gConexionDB->pConnect($gHost,$gUsuarioBD,$gPasswordBD,$gBaseDatos);
?>
