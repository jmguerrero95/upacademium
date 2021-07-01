<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

	$params=explode('|',$sql);

  global $DBConnection;

//      $dblink = NewADOConnection($DBConnection);

//      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
//      $resultSet=$dblink->Execute('select serial_paralu, apellido_alu,nombre_alu,numeromatricula_paralu,fechamatricula_paralu,nombre_per, nombre_sec, nombre_niv, nombre_par,periodo.serial_per,seccion.serial_sec,nivel.serial_niv,alumno.serial_alu from periodo,seccion,nivel,paralelo,alumno,paralelo_alumno where periodo.serial_per=paralelo.serial_per and seccion.serial_sec=nivel.serial_sec and nivel.serial_niv=paralelo.serial_niv and alumno.serial_alu=paralelo_alumno.serial_alu and paralelo.serial_par=paraleloalumno.serial_par and paraleloalumno.serial_paralu='.$serial_paralu);

  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'CERTIFICADO DE MATRICULA','COMPANIA DE JESUS');


//    $foto=(strlen(trim($resultSet->fields['FOTO_EPL']))==0 ) ? 'SINFOTO.JPG':$resultSet->fields['FOTO_EPL'];
//    $printOBJ->addColumn('',45,"../../fotos/".$foto,5,5,"image");

    $printOBJ->addColumn('REPUBLICA DEL ECUADOR',25,'',100,5);
    $printOBJ->addColumn($omnisoftNombreEmpresa,25,'',100,15);
	$printOBJ->addColumn('MATRICULA NUMERO:',25,$params[2],40,25);
    $printOBJ->addColumn('ANO LECTIVO:',18,substr($params[3],16,9),100,25);
	$printOBJ->addColumn('La secretarìa del '.$omnisoftNombreEmpresa.' de la ciudad de '.$omnisoftCiudad.' declara que el(la) alumno(a):',84,'',40,35);
	$printOBJ->addColumn($params[7],100,'',80,40);
	$printOBJ->addcolumn('previo cumplimiento de los correspondientes requisitos legales y reglamentarios se matriculó en el',100,'',40,45);
	$printOBJ->addcolumn('Plantel para realizar sus estudios correspondientes al ciclo, grado y año lectivo que a continuacion',100,'',40,50);
	$printOBJ->addColumn('se mencionan:',18,'',40,55);
	$printOBJ->addcolumn('SECCION: ',18,$params[4],80,60);
	$printOBJ->addcolumn('CURSO: ',18,$params[5],80,65);
	$printOBJ->addcolumn('AÑO LECTIVO: ',18,substr($params[3],16,9),80,70);
	$printOBJ->addcolumn('FOLIO: ',18,$params[2],80,75);
	$printOBJ->addcolumn('La matrícula queda incrita con el No. '.$params[2].' del folio No. '.$params[2].' del registro respectivo, mismos que',100,'',40,80);
	$printOBJ->addColumn('reposan en la Institución.',30,'',40,85);
	$printOBJ->addColumn('Para constancia se expide esta certificación en la ciudad de '.$omnisoftCiudad.' el '.$params[1],100,'',40,90);
	$printOBJ->addColumn('____________________________________',40,'',40,105);
	$printOBJ->addColumn('____________________________________',40,'',90,105);
	$printOBJ->addColumn($omnisoftRector,40,'',50,110);
	$printOBJ->addColumn($omnisoftSecretario,40,'',100,110);
	//$printOBJ->addColumn('NOMBRE RECTOR',40,'',50,110);
	//$printOBJ->addColumn('NOMBRER SECRETARIO',40,'',100,110);
	$printOBJ->addColumn('RECTOR(A)',10,'',55,115);
	$printOBJ->addColumn('SECRETARIO(A)',15,'',105,115);
/*    $printOBJ->addColumn('CARGO:    ',25,$resultSet->fields['NOMBRE_CAR'],25,10);
    $printOBJ->addColumn('SUCURSAL:    ',25,$resultSet->fields['NOMBRE_SUC'],25,15);
    $printOBJ->addColumn('DEPARTAMENTO:    ',25,$resultSet->fields['DESCRIPCION_DEP'],25,20);
    $printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,25);

    $printOBJ->addColumn('  ',25,'INGRESOS',5,30);
    $printOBJ->addColumn('  ',25,'EGRESOS',105,30);
    $totalIngresos=0;
    $totalEgresos=0;

    $rsIngresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp);

    $posYING=35;
    while (!$rsIngresos->EOF) {
     $printOBJ->addColumn(' ',40,$rsIngresos->fields['NOMBRE_RGR'],5,$posYING);
     $printOBJ->addColumn(' ',45,$rsIngresos->fields['VALOR_DRP'],45,$posYING);
     $totalIngresos+= $rsIngresos->fields['VALOR_DRP'];
     $posYING+=5;
     $rsIngresos->MoveNext();
    }

   $rsEgresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp);

    $posYEGR=35;
    while (!$rsEgresos->EOF) {
     $printOBJ->addColumn(' ',40,$rsEgresos->fields['NOMBRE_RGR'],105,$posYEGR);
     $printOBJ->addColumn(' ',45,$rsEgresos->fields['VALOR_DRP'],145,$posYEGR);
     $totalEgresos+= $rsEgresos->fields['VALOR_DRP'];
     $posYEGR+=5;
     $rsEgresos->MoveNext();
    }
    $posY=($posYING>$posYEGR)? $posYING:$posYEGR;
    $printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,$posY);
     $posY+=5;
     $printOBJ->addColumn(' ',40,'TOTAL INGRESOS',5,$posY);
     $printOBJ->addColumn(' ',45,$totalIngresos,45,$posY);
     $printOBJ->addColumn(' ',40,'TOTAL EGRESOS',105,$posY);
     $printOBJ->addColumn(' ',45,$totalEgresos,145,$posY);
     $printOBJ->addColumn('NETO A RECIBIR:',40,$totalIngresos-$totalEgresos,55,$posY+=5);

    $printOBJ->addColumn(' ',45,'______________________________________________________',5,$posY+=20);
     $printOBJ->addColumn(' ',40,'RECIBI CONFORME',5,$posY+=5);
     $printOBJ->addColumn(' ',40,$resultSet->fields['APELLIDO_EPL']." ".$resultSet->fields['NOMBRE_EPL'],5,$posY+=5);
  */
  $printOBJ->showIt();


?>