<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);


  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'FORMULARIO DE CONTROL DE MOVIMIENTOS DE ACTIVOS FIJOS Y BIENES DE CONTROL','INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');
  $fields=$_GET['fields'];

    $sFields = explode('|',$fields);

       $field=explode('~',$sFields[4]);

      global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select activosfijos.*,plancontable.codigo_plc from activosfijos,tipoactivofijo,familiaactivofijo,plancontable where tipoactivofijo.serial_taf=activosfijos.serial_taf and familiaactivofijo.serial_faf=tipoactivofijo.serial_faf and plancontable.serial_plc=familiaactivofijo.serial_plc and serial_acf='.$field[1]);
//echo 'select activosfijos.*,plancontable.codigo_plc from activosfijos,tipoactivofijo,familiaactivofijo,plancontable where tipoactivofijo.serial_taf=activosfijos.serial_taf and familiaactivofijo.serial_faf=tipoactivofijo.serial_taf and plancontable.serial_plc=familiaactivofijo.serial_plc and serial_acf='.$field[1];


   $field=explode('~',$sFields[6]); $printOBJ->addColumn('        Ubicación:',45,$field[1],5,5);

    $field=explode('~',$sFields[8]); $printOBJ->addColumn('Fecha de Entrega:',45,$field[1],5,10);
    $field=explode('~',$sFields[9]);
    if ($field[1]=='BUENO' or $field[1]=='REGULAR' or $field[1]=='MALO')
     $printOBJ->addColumn('Tipo de Custodia:',45,'Custodia Interna',5,15);
    else
     $printOBJ->addColumn('Tipo de Custodia:',45,$field[1],5,15);

    $field=explode('~',$sFields[0]); $printOBJ->addColumn('Custodio Entrega:',45,$field[1],5,20);
    $field=explode('~',$sFields[2]); $printOBJ->addColumn('Custodio Recepción:',45,$field[1],5,25);
    $field=explode('~',$sFields[9]); $printOBJ->addColumn('Estado del Bien:',45,$field[1],5,30);

     $printOBJ->addColumn('Codigo de Control:',45,$resultSet->fields[4],5,35);
     $printOBJ->addColumn('Codigo de Barras: ',45,$resultSet->fields[5],5,40);
     $printOBJ->addColumn('Codigo Contable:  ',45,$resultSet->fields[39],5,45);
     $printOBJ->addColumn('Nombre:           ',45,$resultSet->fields[6],5,50);
     $printOBJ->addColumn('Descripcion:      ',45,$resultSet->fields[7],5,55);
     $printOBJ->addColumn('Serie:            ',45,$resultSet->fields[13],5,60);
     $printOBJ->addColumn('Marca:            ',45,$resultSet->fields[11],5,65);
     $printOBJ->addColumn('Modelo:           ',45,$resultSet->fields[12],5,70);

     $printOBJ->addColumn('Costo Historico:',45,$resultSet->fields[8],5,75);
     $printOBJ->addColumn('Depreciación Acumulada:',45,$resultSet->fields[21],5,80);
     $printOBJ->addColumn('Valor Neto:       ',45,$resultSet->fields[8]-$resultSet->fields[21],5,85);
     $printOBJ->addColumn('Valor Reposición: ',45,$resultSet->fields[19],5,90);

     $field=explode('~',$sFields[5]);   $printOBJ->addColumn('         Garantia:',45,$field[1],5,95);

     $printOBJ->addColumn('Observaciones: ',100,$resultSet->fields[37],5,100);

     $printOBJ->addColumn('Custodio que entrega:',100,'_________________________________________________',5,110);
    $field=explode('~',$sFields[0]); $printOBJ->addColumn('f.',50,$field[1],70,115);

     $printOBJ->addColumn('Custodio que recibe: ',100,'_________________________________________________',5,125);
    $field=explode('~',$sFields[2]); $printOBJ->addColumn('f.',50,$field[1],70,130);

//     $rsSet=$dblink->Execute("select concat(jefearea.documentoidentidad_epl,' ',jefearea.apellido_epl,' ',jefearea.nombre_epl) as nombre from empleado, empleado as jefearea where tipoactivofijo.serial_taf=activosfijos.serial_taf and familiaactivofijo.serial_faf=tipoactivofijo.serial_faf and plancontable.serial_plc=familiaactivofijo.serial_plc and serial_acf='.$field[1]);


     $printOBJ->addColumn('Jefe de Area:        ',100,'_________________________________________________',5,140);
    $field=explode('~',$sFields[0]); $printOBJ->addColumn('f.',50,$field[1],70,115);


  $printOBJ->showIt();


?>