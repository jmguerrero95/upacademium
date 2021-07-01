<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
        require('numeroLetras.php');



  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",'','','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');
  $query=str_replace("\"", "'",$_GET['query']);
  $query=str_replace("\'", "'",$query);
  $query=str_replace("\x5C", "\x5C\x5C",$query);
  $params=explode('|',$query);

   global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

    $serial_caf=$params[3];

    $sql="SELECT serial_caf, nombre_mes, nombre_sec,nombre_niv,nombre_par,numero_caf, fecha_caf, direcc_alu,apellido_alu, nombre_alu, apellido_pad,nombre_pad,codigoIdentificacion_pad,total_caf, abono_caf, estado_caf, cabecerafactura.serial_paralu, mes_caf, alumno.serial_alu FROM seccion, nivel, paralelo, meses, alumno,padres,padres_alumno, cabecerafactura, paralelo_alumno WHERE padres_alumno.serial_alu=alumno.serial_alu and padres.serial_pad=padres_alumno.serial_pad and seccion.serial_sec = nivel.serial_sec  AND nivel.serial_niv = paralelo.serial_niv and paralelo.serial_par=paralelo_alumno.serial_par AND paralelo_alumno.serial_paralu = cabecerafactura.serial_paralu AND alumno.serial_alu = paralelo_alumno.serial_alu AND meses.serial_mes = cabecerafactura.mes_caf and cabecerafactura.serial_caf=".$serial_caf;

    $resultSet=$dblink->Execute($sql);
    $numero=$params[4];
    $fecha=$params[6];
    $cantidad=numerosDecimal($params[8]);
    $concepto=$params[5];

    $printOBJ->addColumn('RECIBO DE COBRO',45,'',85,1,"string","left",'Arial','12');
    $printOBJ->addColumn('Numero:          ',45,$numero,25,10,"string","left",'Arial','8');
    $printOBJ->addColumn('Recibi de:       ',45,$resultSet->fields['nombre_pad'].' '.$resultSet->fields['apellido_pad'] ,25,15,"string","left",'Arial','8');
    $printOBJ->addColumn('La cantidad  de: ',45,$cantidad." (".$params[8]." USD)" ,25,20,"string","left",'Arial','8');
    $printOBJ->addColumn('Por Concepto de: ',45,$concepto ,25,25,"string","left",'Arial','8');
    $printOBJ->addColumn('de la alumna:    ',45,$resultSet->fields['nombre_alu'].' '.$resultSet->fields['apellido_alu'] ,25,30,"string","left",'Arial','8');
    $printOBJ->addColumn('del:             ',45,$resultSet->fields['nombre_niv'].' '.$resultSet->fields['nombre_par'] ,25,35,"string","left",'Arial','8');
    $printOBJ->addColumn('Correspondiente a la factura: ',45,trim($resultSet->fields['numero_caf']),25,40,"string","left",'Arial','8');

    $printOBJ->addColumn('____________________________________',90,"     ____________________________________" ,25,60,"string","left",'Arial','8');
    $printOBJ->addColumn('            RECIBI CONFORME         ',90,"                  ENTREGADO POR" ,25,68,"string","left",'Arial','8');



  $printOBJ->showIt();


?>