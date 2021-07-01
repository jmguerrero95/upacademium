<?php
	$dbdriver='mysql'; 
	$server='localhost';
	$user='root';
	$password='mysql';
	$database='upacifico';

	include('../lib/adodb2/adodb.inc.php');
	$db = ADONewConnection($dbdriver); # eg 'mysql' or 'postgres'
	$db->Connect($server, $user, $password, $database);

	if($db == 0) {	echo " <head><title>Fatal error</title></head>
				<body bgcolor=\"#000000\" text=\"#ffffff\">
				<h1>No se ha podido realizar la conexión a la base de datos</h1>";
		exit;
	}
	else
		$db->Execute("set dateformat ymd");

?>
