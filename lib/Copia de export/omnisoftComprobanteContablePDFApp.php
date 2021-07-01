<?php

       //require('omnisoftPDFIndividual.php');
        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",'','','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');

 $serial_com=$_GET['serial_com'];
//$serial_com = 51;

      global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

//cabecera de recibo
 
$resultSet=$dblink->Execute('select comprobante.*,tipocomprobante.DESCRIPCION_TIC from tipocomprobante,comprobante where tipocomprobante.serial_tic=comprobante.serial_tic and comprobante.serial_com = '.$serial_com);

    $printOBJ->addColumn(' ',45,$resultSet->fields['DESCRIPCION_TIC'],60,3,"string","center",'Arial','16');
    $printOBJ->addColumn('No.: ',10,$resultSet->fields['NUMERO_COM'],95,15,"string","center",'Arial','12');
    $printOBJ->addColumn('CONCEPTO: ',25,$resultSet->fields['CONCEPTO_COM'],1,30,"string","center",'Arial','10');
    $printOBJ->addColumn('FECHA: ',15,$resultSet->fields['FECHA_COM'],160,30,"string","center",'Arial','10');
  
  $printOBJ->addColumn('CODIGO',80,'',1,50,"string","center",'Arial','10');
  $printOBJ->addColumn('CUENTA CONTABLE',80,'',20,50,"string","center",'Arial','10');
  $printOBJ->addColumn('REFERENCIA',80,'',100,50,"string","center",'Arial','10');
 // $printOBJ->addColumn('DETALLE',80,'',130,50,"string","center",'Arial','10');
  $printOBJ->addColumn('DEBE',80,'',150,50,"string","center",'Arial','10');
  $printOBJ->addColumn('HABER',80,'',170,50,"string","center",'Arial','10');



//detalle del recibo
 $resultSet2=$dblink->Execute('select detallecomprobante.*, plancontable.* from plancontable, detallecomprobante where plancontable.serial_plc=detallecomprobante.serial_plc and detallecomprobante.serial_com = '.$serial_com);

$fila=5;
$debe=0;
$haber=0;

   while(!$resultSet2->EOF)
    {
	 
	 $debe=$debe+$resultSet2->fields['DEBE_DCO'];
	 $haber=$haber+$resultSet2->fields['HABER_DCO'];
	 
     $printOBJ->addColumn(' ',20,trim($resultSet2->fields['CODIGO_PLC']),1,$fila+60,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',20,trim($resultSet2->fields['NOMBRE_PLC']),20,$fila+60,"string","left",'Arial','8');
	 $printOBJ->addColumn(' ',10,trim($resultSet2->fields['REFERENCIA_DCO']),100,$fila+60,"string","left",'Arial','8');
//    $printOBJ->addColumn(' ',10,trim($resultSet2->fields['DESCRIPCION_DCO']),130,$fila+60,"string","left",'Arial','8');
	 $printOBJ->addColumn(' ',15,number_format(trim($resultSet2->fields['DEBE_DCO']), 2, ',', '.'),150,$fila+60,"number","right",'Arial','8');  
	 $printOBJ->addColumn(' ',15,number_format(trim($resultSet2->fields['HABER_DCO']), 2, ',', '.'),170,$fila+60,"number","right",'Arial','8');  	 

   
 $fila=$fila+5;
 $resultSet2->MoveNext();
 }
 
 $printOBJ->addColumn(' ',200,'______________________________________________________',1,$fila+63);

 
 $printOBJ->addColumn('TOTAL: ',15,'',130,$fila+70,"string","right",'Arial','8');  
 $printOBJ->addColumn(' ',15,number_format($debe, 2, ',', '.'),150,$fila+70,"number","right",'Arial','8');  
 $printOBJ->addColumn(' ',15,number_format($haber, 2, ',', '.'),170,$fila+70,"number","right",'Arial','8');  
 
 $printOBJ->addColumn(' ',200,'______________________________________________________',1,$fila+72);


  $printOBJ->addColumn('PREPARADO',80,'',20,$fila+110,"string","center",'Arial','10');
  $printOBJ->addColumn('REVISADO',80,'',60,$fila+110,"string","center",'Arial','10');
  $printOBJ->addColumn('AUTORIZADO',80,'',100,$fila+110,"string","center",'Arial','10');
  $printOBJ->addColumn('CONTROL INTERNO',80,'',140,$fila+110,"string","center",'Arial','10');


  $printOBJ->showIt();


?>