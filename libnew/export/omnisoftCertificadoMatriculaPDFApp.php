<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

	$params=explode('|',$sql);

  global $DBConnection;


    $dblink = NewADOConnection($DBConnection);
	$resultset=$dblink->Execute($sql);

  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'','Velasco 24-38 y Veloz       Tlfno: (593-3)2961 506/507       Fax: (593-3)2961 506 ext. 111       Aptdo: 06-01-105 [www.sfelipeneri.edu.ec]');

$posY=0;
while (!$resultset->EOF)
{
	$printOBJ->addColumn('CERTIFICADO DE MATRICULA',84,'',60,$posY+20,"string","center",'Arial','16');
	$printOBJ->addColumn('AÑO LECTIVO: ',30,trim($resultset->fields['codigo_per']),80,$posY+35,"string","center",'Arial','10');
	$printOBJ->addColumn('M A T R I C U L A: ',45,trim($resultset->fields['numeromatricula_paralu']),70,$posY+45,"string","center",'Arial','14');
	$printOBJ->addColumn('CERTIFICO QUE: ',30,strtoupper(trim($resultset->fields['apellido_alu'])).' '.strtoupper(trim($resultset->fields['nombre_alu'])).', previa la presentación de los',20,$posY+70,"string","center",'Arial','10');
    $fechaMatricula=explode("-",$resultset->fields['fechamatricula_paralu']);
	$printOBJ->addColumn('requisitos legales y reglamentarios se matriculó en el',85,trim($resultset->fields['nombre_niv']),20,$posY+75,"string","center",'Arial','10');
 	$printOBJ->addColumn('paralelo "',15,trim($resultset->fields['nombre_par']).'" el '.$fechaMatricula[2]."/".$fechaMatricula[1]."/".$fechaMatricula[0],20,$posY+80,"string","center",'Arial','10');	
	$printOBJ->addColumn('Así consta en el Tomo No. ',44,trim($resultset->fields['tomo_paralu']).' de los libros respectivos de matrícula.',20,$posY+90,"string","center",'Arial','10');
	$cadena = substr($omnisoftCiudad,0,1).strtolower(substr($omnisoftCiudad,1,100));
	$printOBJ->addColumn(''.$cadena.', '.date("d")." de ".$monthDay[date("n")]." del ".date("Y"),100,'',20,$posY+115,"string","center",'Arial','10');
	$printOBJ->addColumn($omnisoftRector,20,'',25,$posY+140,"string","center",'Arial','10');
	$printOBJ->addColumn($omnisoftSecretario,40,'',125,$posY+140,"string","center",'Arial','10');
	$printOBJ->addColumn('Rector',10,'',45,$posY+145,"string","center",'Arial','10');
	$printOBJ->addColumn('Secretaria General',15,'',135,$posY+145,"string","center",'Arial','10');
  
$printOBJ->columnCount=0; 
$printOBJ->columnDetailCount=0; 
$printOBJ->printPage();  
$resultset->MoveNext();
}

$printOBJ->ShowIt();


?>