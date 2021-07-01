<?php
    $CADUCADO = "Su sesión ha caducado. Ingrese de nuevo al sistema";
	// Revisión de que la sesión se haya iniciado
	session_start();
	if(empty($_SESSION[serial_usr]))
	{ 
		$destinoURL = "../index.php";
		if(!empty($_SESSION['codigoModuloBitacora']))
		{
			switch($_SESSION['codigoModuloBitacora'])
			{
				case 'mod001' : $destinoURL = "../administrador.php"; break;
				case 'modCON' : $destinoURL = "../contabilidad/modulocontabilidad.php"; break;
				case 'modPRE' : $destinoURL = "../index.php"; break;
				case 'modTES' : $destinoURL = "../index.php"; break;
				case 'modFAC' : $destinoURL = "../index.php"; break;
				case 'modNOM' : $destinoURL = "../index.php"; break;
				case 'modROL' : $destinoURL = "../index.php"; break;
				case 'modINV' : $destinoURL = "../index.php"; break;
				case 'modPAR' : $destinoURL = "../index.php"; break;
				default: break;
			}
		}
	?>
		<script>
			alert('<?= $CADUCADO ?>');
			document.location='<?= $destinoURL ?>';
		</script>
	<? } ?>