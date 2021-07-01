<?php


require_once 'omnisoftExcelReader.php';
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');

function cargarValorFactura($fecha,$codigo_alu,$valor)
{
 global $DBConnection;

 $dblink = NewADOConnection($DBConnection);


$sqlcommand = "select serial_caf, total_caf from alumno, paralelo_alumno, cabecerafactura where paralelo_alumno.serial_alu=alumno.serial_alu and cabecerafactura.serial_paralu=paralelo_alumno.serial_paralu and alumno.id_alumno='".$codigo_alu."' and year(fecha_caf)=year('".$fecha."') and month(fecha_caf)=month('".$fecha."')";
 
echo $sqlcommand.'<br>';
 
$rsfactura=$dblink->Execute($sqlcommand);
 
if($rsfactura->fields[1]>$valor) 
	$sqlupdate = "update cabecerafactura set abono_caf=abono_caf+".$valor." where serial_caf=".$rsfactura->fields[0];

echo $sqlupdate.'<br>'; 

$rsfactura=$dblink->Execute($sqlupdate);
}
 
 function procesar($fila,$ncols,$obj) {
//  echo "fila=$fila col=$ncols $obj<br>";
  $datos=explode('|',$obj);

//  for ($i=0; $i <$ncols; $i++) { 
   if ($fila>2){
   $registro=explode("~",$datos[0]);
	   $codigo=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];
   $registro=explode("~",$datos[5]);
	   $fecha=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];
   $registro=explode("~",$datos[4]);
	   $valor=($registro[1]=='unknown')?procesarFecha($registro[0]):$registro[0];
	   
	cargarValorFactura($fecha,$codigo,$valor);
	 echo $fila."  ".$i."  ".$valor."<br>";
  }	


 }


  $filename=$_GET['filename'];
  $excelOBJ=new OmnisoftExcelReader($filename,"procesar");

  $excelOBJ->readSheet();

?>
