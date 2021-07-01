<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Listado de Stickers</title>
</head>
<body>

<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
$serial_dep = $_GET['serial_dep'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_cla = $_GET['serial_cla'];
?>
<table width='100%' align='center'>
    <tr>
    <td>
  <?php 
	$nCols = 6;	
	$sw = 0;
	$arrAct = procesarActivos($serial_dep,$fecha_ini,$fecha_fin,$serial_cla,$dblink);			
	if($arrAct){		
		$totAll = count($arrAct);
		$nRows = getRows($totAll);				
		echo "<table width='857' border='0'>";	
		for ($i=0;$i<$nRows;$i++){			
			echo "<tr>";
			for ($j = 0; $j < $nCols ; $j++){
				if($sw <= $totAll){
					$pImprimir = "<div align='center'><font face='C39HrP72DmTt' size='+9'>".$arrAct[$sw]['codigo_cbf']." </font> </div>";				
				}else{
					$pImprimir = "&nbsp;";
				}				
				echo "<td>".$pImprimir."</td>";		 				
				$sw++;
			}
		}							
	  echo "</table>";

	}else{
		echo "No se puede generar los stickers de los Activos";
	}
  ?>	</td> 
  </tr>
</table>
<?php 
function procesarActivos($serial_dep,$fecha_ini,$fecha_fin,$serial_cla,$dblink){
	if($serial_dep == "T"){
		$departamento = "";	
	}else{
		$departamento = "AND serial_dep = ".$serial_dep;
	}
	if($serial_cla == "T"){
		$clase = "";	
	}else{
		$clase = "AND claseactivo.serial_cla = ".$serial_cla;
	}
	if(strlen($fecha_ini)>0 and strlen($fecha_fin)>0){
		$periodo = "AND FADQUISICION_CBF >='".$fecha_ini."' and FADQUISICION_CBF<='".$fecha_fin."'";
	}else{
		$periodo = "";
	}
	$sqlMain = "
		SELECT
			cabeceraactivo.serial_cbf,
			detalleactivo.serial_daf,
			cabeceraactivo.serial_cla,
			nombre_cbf,    
			nombre_daf,	    
			nombre_plc,
			codigo_cbf,
			codbarras_cbf	
		FROM
			cabeceraactivo,
			detalleactivo,
			claseactivo,
			plancontable,
			comprobante,
			proveedor 
		WHERE
			cabeceraactivo.serial_cla = claseactivo.serial_cla 
			AND cabeceraactivo.serial_cbf = detalleactivo.serial_cbf
			AND claseactivo.serial_plc = plancontable.serial_plc 
			AND cabeceraactivo.serial_com = comprobante.serial_com 
			AND cabeceraactivo.serial_pvd = proveedor.serial_pvd
			".$clase."			
			".$departamento."
			".$periodo."
	";	
	//echo "<br>".$sqlMain."<br>";
	if($arr = $dblink->GetAll($sqlMain)){
		return $arr;
	}else{
		return false;
	}

}

function getRows($totAll){
		$swRows = 0;
		$rows = 1;		
		while($swRows == 0){		
			$res = $GLOBALS['nCols'] - $totAll;		
			if ($res<0){
				$rows++;
				$totAll = $res*(-1);
			}else{
				$swRows = 1;
			}	
		}
		return $rows;
}

?>
</body>
</html>