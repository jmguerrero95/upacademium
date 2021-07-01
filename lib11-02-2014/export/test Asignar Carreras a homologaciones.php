<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);


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