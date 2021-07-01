<?php
$FILASPORPAGINA = 10;
$gHost="localhost";
$gUsuarioBD="root";
$gPasswordBD="mysql";
$gBaseDatos="upacifico";
include_once('./lib/adodb/adodb.inc.php');
include_once('./lib/adodb/tohtml.inc.php');
include_once('./lib/adodb/adodb-pager.inc.php');
$gConexionDB = NewADOConnection('mysql');
$gConexionDB->pConnect($gHost,$gUsuarioBD,$gPasswordBD,$gBaseDatos);
?>
