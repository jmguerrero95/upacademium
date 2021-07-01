<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$serial_epl=0;
$serial_erp=0;
$serial_rgr=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}



function omnisoftGenerarCriterios($serial_sec,$serial_cri,$serial_niv,$serial_matniv,$nombre_cri, $descripcion_cri, $codigo_cri, $porcentaje_cri, $activo_cri) {

  global $dblink;

   $actualizacion=false;


   $SQLCmd='SELECT serial_cri FROM criterio, materia_nivel, nivel, materia WHERE materia_nivel.serial_matniv=criterio.serial_matniv AND materia.serial_mat=materia_nivel.serial_mat AND nivel.serial_niv=materia_nivel.serial_niv';

   if ($serial_sec != 'TODOS' AND strlen($serial_sec)>0)
    $SQLCmd.= ' AND nivel.serial_sec='.$serial_sec;

   if ($serial_cri != 0 AND strlen($serial_cri)>0)
   	$SQLCmd.=' AND criterio.serial_cri='.$serial_cri;

   if ($serial_niv != 'TODOS' AND strlen($serial_niv)>0)
   $SQLCmd.=' AND materia_nivel.serial_niv='.$serial_niv;

   if ($serial_matniv != 'TODOS' AND strlen($serial_matniv)>0)
   $SQLCmd.= ' AND materia_nivel.serial_matniv='.$serial_matniv ;

   //echo $SQLCmd. "<br>";
   $resultSet=$dblink->Execute($SQLCmd);

   if ($resultSet->RecordCount() >0)   {


    $SQLDeleteCmd= 'delete from criterio where serial_cri IN('.$SQLCmd.')';
   //echo $SQLCmd  . "<br>";
   $dblink->Execute($SQLDeleteCmd);

   }



	if ($serial_sec=='TODOS' || strlen($serial_sec)==0)
		$SQLCmd='SELECT serial_niv FROM nivel ';
	else {
	    $SQLCmd='SELECT serial_niv FROM nivel WHERE serial_sec='.$serial_sec;

		if ($serial_niv != 'TODOS' AND strlen($serial_niv)>0)
			 $SQLCmd.=' AND nivel.serial_niv='.$serial_niv;

	}
	$rsNivel=$dblink->Execute($SQLCmd);

	while (!$rsNivel->EOF){
		//echo $rsNivel->fields[0].'<BR>';
		if ($serial_matniv != 'TODOS' AND strlen($serial_matniv)>0)
		   $SQLCmd='SELECT serial_matniv FROM materia_nivel WHERE serial_niv='.$rsNivel->fields[0].' AND serial_matniv='.$serial_matniv;
		else
	       $SQLCmd='SELECT serial_matniv FROM materia_nivel WHERE serial_niv='.$rsNivel->fields[0];

		$rsMatNiv=$dblink->Execute($SQLCmd);
		while(!$rsMatNiv->EOF){
			$rsCriterio="INSERT INTO criterio (serial_cri, serial_matniv, nombre_cri, descripcion_cri, codigo_cri, porcentaje_cri, activo_cri) VALUES (0,". 	  	 	 	             $rsMatNiv->fields[0].",'".$nombre_cri."','".$descripcion_cri."','".$codigo_cri."','".$porcentaje_cri."','".$activo_cri."' )";
			//echo $rsCriterio;
			$dblink->Execute($rsCriterio);
			$rsMatNiv->MoveNext();
			
		
		}
		$rsNivel->MoveNext();

		
	}
	 echo $dblink->ErrorMsg().'|1';
}
 
    
   $query = $_POST['query'];
	//echo $query;
   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
   omnisoftGenerarCriterios($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);



?>
