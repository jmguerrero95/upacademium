<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_dar_n=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function omnisoftCopiarDetalleArancel($serial_ara,$serial_dar,$valor_dar,$descripcion_dar) {
 global $serial_dar_n;
 global $dblink;
  // $actualizacion=false;
  
  //$sfecha=explode('-',$fecha);
	 /*  echo"----------------------------------------------";
	  echo ' <br> sucursal '.$sucursal; 
	  echo '<br>  minimo_inscritos '.$numero_inscritos;
	    echo '<br>  periodo '.$periodo;
	   echo '<br>  seccion '.$seccion;
	    echo '<br>  observaciones '.$observaciones;
	 echo '<br>  serial_mabbbbbbb ';
	   echo $numero;   */
	
     $SQLCmd_generar=" insert into detallearancel select 
0,".$serial_ara.", serial_sec, serial_niv, serial_par, serial_alu, ".$valor_dar.", serial_plc, '".$descripcion_dar."', serial_plce, serial_plcbd, serial_plcbh, serial_plcfd, serial_plcfh, serial_plcnch, serial_plcncd, comentario_dar, serial_plctjd, serial_plctjh, serial_plcctjd, serial_plcctjh
from detallearancel where serial_dar=".$serial_dar;
 //echo "<br> SQLCmd_generar: ".$SQLCmd_generar. "<br>";
  
  
	$dblink->Execute($SQLCmd_generar);
	$serial_dar_n=(strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
  
 }
 
 
   
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
    // echo $params[0];
  	 /*echo ' <br><br><br> sucursal '.$params[0]; 
	   //echo '<br>  minimo_inscritos nada';
	   echo '<br>  periodo '.$params[1];
	   echo '<br>  seccion '.$params[2];
	   echo '<br>  observaciones '.$params[3]; */  
	//  $serial=$params[4];
	//settype($serial,"integer");
 	//echo '<br>  serial '.$serial;
  
       omnisoftCopiarDetalleArancel($params[0],$params[1],$params[2],$params[3]);
	   echo $serial_dar_n."|";
	   
?>