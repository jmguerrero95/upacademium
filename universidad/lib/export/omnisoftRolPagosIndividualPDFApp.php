<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

  global $DBConnection;

      $dblink = NewADOConnection($DBConnection);

      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select * from sucursal,departamentos,sucursaldepartamentos,cargos,escalafones,periodorol,empleado,empleadorolpagos where sucursal.serial_suc=sucursaldepartamentos.serial_suc and departamentos.serial_dep=sucursaldepartamentos.serial_dep and sucursaldepartamentos.serial_desc=empleado.serial_desc and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_erp='.$serial_erp);

  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'ROL DE PAGOS DE '.$resultSet->fields['APELLIDO_EPL']." ".$resultSet->fields['NOMBRE_EPL'],'INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');
  $serial_epl=$_GET['serial_epl'];
  $serial_erp=$_GET['serial_erp'];


    $foto=(strlen(trim($resultSet->fields['FOTO_EPL']))==0 ) ? 'SINFOTO.JPG':$resultSet->fields['FOTO_EPL'];
    $printOBJ->addColumn('',45,"../../fotos/".$foto,5,5,"image");

    $printOBJ->addColumn('PERIODO:  ',25,$resultSet->fields['DESCRIPCION_PERROL'],25,5);
    $printOBJ->addColumn('CARGO:    ',25,$resultSet->fields['NOMBRE_CAR'],25,10);
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

  $printOBJ->showIt();


?>