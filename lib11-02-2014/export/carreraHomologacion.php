
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);



$sqlAlumnoMallaMatricula = "select serial_hom,serial_alu,serial_per from homologacion where serial_car = 0 and serial_hom not in(193,332)";

$rsAlumnoMalla = $dblink->Execute($sqlAlumnoMallaMatricula);
//$numAlum = $rsAlumnoMalla->recordCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Alumnos MTN</title>

<link rel="stylesheet" type="text/css" href="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/css/defpei.css" media="screen" />
<link rel="stylesheet" href="file://///172.20.3.236/htdocs/upacifico/upacademium/lib/export/jqueryuin/development-bundle/themes/base/jquery.ui.all.css">	
	

<body>

<table>

    <tr>
      <th scope="col">Homologacion</th>
      <th scope="col">Alumno</th>
      <th scope="col">carrera</th>      
    </tr>

	
	
    <?php 	
	
	//if($rsAlumnoMalla->recordCount()>0){
		while(!$rsAlumnoMalla->EOF){			
			$carrera="select serial_car from malla where serial_maa in(select serial_maa from alumnomalla where serial_alu=".$rsAlumnoMalla->fields['serial_alu'].") and serial_car<>68";
			$rscarrera = $dblink->Execute($carrera);
	?>	
			
	 <tr>
	   	<td><?php echo $rsAlumnoMalla->fields['serial_hom'];?></td>
		<td><?php echo $rsAlumnoMalla->fields['serial_alu'];?></td>
		<td><?php echo $rscarrera->fields['serial_car'];?></td>
		
		<?php
		$actualizar = "update homologacion set serial_car = ".$rscarrera->fields['serial_car']." where serial_hom=".$rsAlumnoMalla->fields['serial_hom'];
		$dblink->Execute($actualizar);
		
		?>
		<td><?php echo $actualizar;?></td>
		

	
    </tr>

		
		
	<?php	
			$rsAlumnoMalla->MoveNext();		
		}
	/*}
	else
	echo "No se encontraron Alumnos";*/
	?>	
  </table>

	
  
</body>
</html>
<?php

