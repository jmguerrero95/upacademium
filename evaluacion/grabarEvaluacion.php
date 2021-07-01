
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<htm>
<style type="text/css">
<!--
.style1 {font-size: 20px}
.style2 {font-size: 13px}
.style3 {font-size: 13px; font-weight:bold}
.style4 {font-size: 13px; font-weight:bold; color:#FFFFFF}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>guardando Evaluación</title>
</head>
<body>
<?
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');		
/*****************saca nombre de la sede y el periodo********************************/
$dblink = NewADOConnection($DBConnection);
foreach($_GET["resp"] as $valor)
{
	//echo "preg".$valor."<br>";
	$gpendiente = explode("|", $valor);
//	echo $gpendiente[0];
	$preg_serial=$gpendiente[1];
	$resp_serial=$gpendiente[2];
	$resp_valor=$gpendiente[3];

	//echo "0)".$gpendiente[0]."1)".$gpendiente[1]."2)".$gpendiente[2]."3)".$gpendiente[3];
	//echo "<br>";
	$SQLCommand="";
	 if($resp_serial=='NA'){	
					  	$SQLCommand	=' INSERT INTO DETALLE_EVALUACION (SERIAL_CEVA, SERIAL_PRG,SERIAL_RSP, VALOR_RSP,NA_RSP) VALUES('.$_GET["serial_ceva"].','.$preg_serial.','.$_GET["serial_resp_help"].',0,\'SI\')';	  
					  }else {
					  		 $SQLCommand=' INSERT INTO DETALLE_EVALUACION (SERIAL_CEVA, SERIAL_PRG,SERIAL_RSP, VALOR_RSP) VALUES('.$_GET["serial_ceva"].','.$preg_serial.','.$resp_serial.','.$resp_valor.')';
					  }
					  
					  echo $SQLCommand."<br>";
	$rs_respuesta=$dblink->Execute($SQLCommand);
}

?>
<script>
	window.opener.ProcesarEvaluacion(window.opener.document.PaginaDatos.cedula.value);
	window.close();

</script>
</body>
</html>           
