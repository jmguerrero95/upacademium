<?php
/*
	

    $status = "";
    if ($_POST["action"] == "upload") {
        // obtenemos los datos del archivo
        $tamano = $_FILES["archivo"]['size'];
        $tipo = $_FILES["archivo"]['type'];
        $archivo = $_FILES["archivo"]['name'];
        $prefijo = substr(md5(uniqid(rand())),0,6);
       
        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino =  "archivo/".$prefijo."_".$archivo;
            if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                $status = "Archivo subido: <b>".$archivo."</b>";
            } else {
                $status = "Error al subir el archivo";
            }
        } else {
            $status = "Error al subir archivo";
        }
    }
*/

?>


<?php 
/*	$tit = "El nombre fue encontrado en la posicion: ";
	
	$nombre = array();
	$nombre[0]['nombre'] = "PABLO";
	$nombre[1]['nombre'] = "DIEGO";
	$nombre[2]['nombre'] = "IVAN";
	$nombre[3]['nombre'] = "pAty";	
	for($i=0;$i<count($nombre);$i++){
		if(strtoupper($nombre[$i]['nombre']) == "PATY"){					
			echo "<br>$tit".$i;			
		}		
	}
	
*/
?>


<!-----
<html>
<body>
    <form action="test.php" method="post" enctype="multipart/form-data">
      <input name="archivo" type="file" size="35" />
      <input name="enviar" type="submit" value="Upload File" />
      <input name="action" type="hidden" value="upload" />     
    </form>
</body>
</html>
--->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-ar" lang="es-ar">

<head>
<title>File mounter 0.1</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!-- Control de versión 0.1 -- Diego F González -- http://im7.blogspirit.com -->

</head>

<body>

<?php

if ($File) {

    print ("<p>Archivo: $File_name<br />");
    print ("Tamaño: $File_size</p>");
/////////////////////// en caso de que no se escriba un nombre de carpeta, se crea sola
    if ( $ruta == "" ) {
          $ruta = "sin_nombre";
          }
/////////////////////// se fija si la carpeta existe, y luego crea la carpeta y nos avisa si existe o no 
    if (file_exists($ruta)) {
        echo "La ruta - $ruta - YA existe";
    } else {
        mkdir($ruta, 0755); // re agrega permiso a la carpeta
        echo "La ruta - $ruta - NO existe";
    }
/////////////////////// 
    if (copy ($File, "$ruta/$File_name" )) {
          chmod("$ruta/$File_name", 0755);
        print ("<p class=\"error\">Tu archivo se cargó exitosamente en el servidor.</p>");
        echo "<a href=$ruta>Ver Carpeta</a>";
/////////////////////// copia el archivo "ver_listado.php" a la nueva carpeta y lo renombra por index.php
        $file = 'ver_listado.php';
        $newfile = $ruta.'/index.php';

        if (!copy($file, $newfile)) {
        echo "<br>Error al copiar $file...";
        }
        else{
         echo "<br>Index creado correctamente: $newfile";
}
///////////////////////

    } else {
    
        print ("<p class=\"error\">Falló el montaje del archivo al servidor.</p>");
    
    }
    
    unlink ($File);
    
}
?>

<h1>Montar archivos</h1><br>

<form action="test.php" method="post" enctype="multipart/form-data">

    <a>Crear Carpeta</a><br>
    <input type="ruta" name="ruta" /><br>
    <a>Ruta de la foto a subir</a><br>
    <input type="file" name="File" /><br>
    <br>
    <a>Montar archivo en el servidor</a><br>
    <input type="submit" value="Subir archivo" /><br>

</form>

</body>
</html>




<?php 
/*
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

//$nombre = ''


exit(1);

$sqlHom = "
	SELECT
		serial_hom,
		serial_alu,
		serial_sec		
	FROM
		homologacion 		
	ORDER BY
		serial_alu
";
/*
$sqlHom = "
	SELECT
		serial_hom,
		serial_alu,
		serial_sec		
	FROM
		homologacion 
	WHERE 
		serial_hom IN (1355,1711,1714,1756,1757)
	ORDER BY
		serial_alu
";
*/

/*
echo $sqlHom;


$arrHom = $dblink->GetAll($sqlHom);
$totAll = count($arrHom );
echo "<br>TOTAL HOMOLOGACIONES: $totAll";

echo "<table width='200' border='1'>
  <tr>
    <td>No</td>
	<td>serial_hom</td>
    <td>serial_car</td>
    <td>Alumno</td>
	<td>Carrera</td>
  </tr>
";

//Parametrizacion
for($i=0;$i<$totAll;$i++){	
	$arr = getCarrera($arrHom[$i]['serial_alu'],$arrHom[$i]['serial_sec'],$dblink);
	$serial_hom = $arrHom[$i]['serial_hom'];
	$serial_car = "N/A";
	$nombre_alu = "N/A";
	$nombre_car = "N/A";	
	if($arr){
		$serial_hom = $arrHom[$i]['serial_hom']; 
		$serial_car = $arr[0]['serial_car'];
		$nombre_alu = $arr[0]['nombre_alu'];
		$nombre_car = $arr[0]['nombre_car'];
		//echo "hola";
		$sqlUpdate = "
			UPDATE
				homologacion 
			SET
				serial_car =  ".$serial_car."
			WHERE
				serial_hom = ".$serial_hom."
		";
		echo "<br>".$sqlUpdate;
		$dblink->Execute($sqlUpdate);
	}
	echo"
		<tr>
			<td>".($i+1)."</td>
			<td>".$serial_hom."</td>
			<td>".$serial_car."</td>
			<td nowrap='nowrap'>".$nombre_alu."</td>
			<td nowrap='nowrap'>".$nombre_car."</td>
	  </tr>
	";

}
echo "</table>";


/*Obtener el serial Car*/
/*
function getCarrera($serial_alu,$serial_sec,$dblink){
	$sqlMain = "
		SELECT
			alumno.serial_alu,
			carrera.serial_car,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre_alu,
			nombre_car 
		FROM
			alumno,
			alumnomalla,
			malla 
				LEFT JOIN carrera 
				ON carrera.serial_car=malla.serial_car 
				LEFT JOIN carreraprincipal 
				ON carreraprincipal.serial_crp=carrera.serial_crp 
				LEFT JOIN facultad 
				ON facultad.serial_fac=carrera.serial_fac 
		WHERE
			alumno.serial_alu = alumnomalla.serial_alu 
			AND alumnomalla.serial_maa = malla.serial_maa 
			AND serial_maa_p = 0 
			AND malla.serial_sec = ".$serial_sec." 
			AND alumno.serial_alu = ".$serial_alu."
	";
	//echo "<br>$sqlMain";
	if($arr = $dblink->GetAll($sqlMain)){						
		return $arr;
		
	}else{
		return false;

	}
}



/*function getCar($serial_alu,$serial_sec,$dblink){
	$sqlGetOther = "
		SELECT
			ama.serial_ama,
			nombre_maa,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu, nombre1_alu,nombre2_alu) as nombre_alu,
			serial_car
		FROM
			malla        AS maa,
			alumnomalla  AS ama,
			sucursal     AS suc,
			alumno       AS alu,
			detallemalla AS dma,
			materia      AS mat 
		WHERE
			maa.serial_maa = ama.serial_maa 
			AND dma.serial_maa = maa.serial_maa 
			AND mat.serial_mat = dma.serial_mat 
			AND alu.serial_alu = ama.serial_alu 
			AND alu.serial_suc = suc.serial_suc 
			AND maa.serial_maa_p = 0 
			AND ama.serial_alu = ".$serial_alu." 
			AND maa.serial_sec = ".$serial_sec."    
		GROUP BY
			serial_ama	
	";


	if($arrOther = $dblink->GetAll($sqlGetOther)){				
		$arrOther[0]['serial_car'] = $arrOther[0]['serial_car'];					
		$arrOther[0]['nombre_car'] = $arrOther[0]['nombre_car'];					
		$arrOther[0]['nombre_alu'] = $arrOther[0]['nombre_alu'];					
		return $arrOther;
		
	}else{
		return false;

	}

}*/


?>

