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



function omnisoftGenerarMateriaProfesor($serial_sec,$serial_niv,$serial_matniv,$serial_par,$serial_pro) {

  global $dblink;

   $actualizacion=false;


   $SQLCmd='SELECT serial_matpro FROM nivel, materia_nivel, materia_profesor WHERE nivel.serial_niv=materia_nivel.serial_niv and materia_profesor.serial_matniv=materia_nivel.serial_matniv ';

   if ($serial_sec != 'TODOS' AND strlen($serial_sec)>0)
    $SQLCmd.= ' AND nivel.serial_sec='.$serial_sec;

   if ($serial_niv != 0 AND strlen($serial_niv)>0)
   	$SQLCmd.=' AND materia_nivel.serial_niv='.$serial_niv;

   if ($serial_par != 'TODOS' AND strlen($serial_par)>0)
   $SQLCmd.=' AND materia_profesor.serial_par='.$serial_par;

   if ($serial_matniv != 'TODOS' AND strlen($serial_matniv)>0)
   $SQLCmd.= ' AND materia_nivel.serial_matniv='.$serial_matniv ;

      if ($serial_pro != 'TODOS' AND strlen($serial_pro)>0)
   $SQLCmd.= ' AND materia_profesor.serial_pro='.$serial_pro;


  // echo $SQLCmd. "<br>";
   $resultSet=$dblink->Execute($SQLCmd);

   if ($resultSet && $resultSet->RecordCount() >0)   {

    while (!$resultSet->EOF) {
     $SQLDeleteCmd= 'delete from materia_profesor where serial_matpro='.$resultSet->fields[0];
     //echo $SQLDeleteCmd  . "<br>";
     $dblink->Execute($SQLDeleteCmd);
      $resultSet->MoveNext();
    }

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
               //echo $SQLCmd. "<br>";

		$rsMatNiv=$dblink->Execute($SQLCmd);

		while(!$rsMatNiv->EOF){


		if ($serial_par != 'TODOS' AND strlen($serial_par)>0)
		   $SQLCmd='SELECT serial_par FROM paralelo,materia_nivel WHERE paralelo.serial_par='.$serial_par.'  and materia_nivel.serial_niv=paralelo.serial_niv and paralelo.serial_niv='.$rsNivel->fields[0].' AND serial_matniv='.$rsMatNiv->fields[0];
		else
	       $SQLCmd='SELECT serial_par FROM paralelo,materia_nivel WHERE materia_nivel.serial_niv=paralelo.serial_niv and paralelo.serial_niv='.$rsNivel->fields[0].' AND serial_matniv='.$rsMatNiv->fields[0];
               //echo $SQLCmd. "<br>";

		$rsParalelo=$dblink->Execute($SQLCmd);

                while (!$rsParalelo->EOF) {

			$sqlMatPro="INSERT INTO materia_profesor (serial_matpro, serial_matniv, serial_pro, serial_par) VALUES (0,". 	  	 	 	             $rsMatNiv->fields[0].",'".$serial_pro."','".$rsParalelo->fields[0]."')";
			//echo $sqlMatPro."<br>";
			$dblink->Execute($sqlMatPro);
                        $rsParalelo->MoveNext();

                }

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

   omnisoftGenerarMateriaProfesor($params[0],$params[1],$params[2],$params[3],$params[4]);



?>
