<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

  global $DBConnection;

      $dblink = NewADOConnection($DBConnection);

      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select * from sucursal,departamentos,sucursaldepartamentos,cargos,escalafones,periodorol,empleado,empleadorolpagos where sucursal.serial_suc=sucursaldepartamentos.serial_suc and departamentos.serial_dep=sucursaldepartamentos.serial_dep and sucursaldepartamentos.serial_desc=empleado.serial_desc and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_erp='.$serial_erp);
$omnisoftNombreEmpresa='';
  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'ROL DE PAGOS','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');
  $serial_epl=$_GET['serial_epl'];
  $serial_erp=$_GET['serial_erp'];


    $foto=(strlen(trim($resultSet->fields['FOTO_EPL']))==0 ) ? 'SINFOTO.JPG':$resultSet->fields['FOTO_EPL'];
    $archivo="../../fotos/".$foto;
    if (file_exists($archivo))
    $printOBJ->addColumn('',45,"../../fotos/".$foto,5,5,"image");
    else
     $printOBJ->addColumn('',45,"../../fotos/SINFOTO.JPG",5,5,"image");

    $printOBJ->addColumn(' ',60,$resultSet->fields['APELLIDO_EPL']." ".$resultSet->fields['NOMBRE_EPL'] ,55,8,"string","center",'Arial','12');

    $printOBJ->addColumn('PERIODO:       ',35,$resultSet->fields['DESCRIPCION_PERROL'],25,15,"string","left",'Arial','8');
    $printOBJ->addColumn('CARGO:         ',35,$resultSet->fields['NOMBRE_CAR'],25,20,"string","left",'Arial','8');
    $printOBJ->addColumn('AREA FUNCIONAL:',35,$resultSet->fields['NOMBRE_SUC'],25,25,"string","left",'Arial','8');
    $printOBJ->addColumn('DEPARTAMENTO:  ',35,$resultSet->fields['DESCRIPCION_DEP'],25,30,"string","left",'Arial','8');
    $printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,35,"string","left",'Arial','8');

    $printOBJ->addColumn('  ',25,'INGRESOS',5,40,"string","left",'Arial','8');
    $printOBJ->addColumn('  ',25,'EGRESOS',105,40,"string","left",'Arial','8');
    $totalIngresos=0;
    $totalEgresos=0;

    $rsIngresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and  desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp);

    $posYING=45;
    while (!$rsIngresos->EOF) {
     $printOBJ->addColumn(' ',40,$rsIngresos->fields['NOMBRE_RGR'],5,$posYING,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',45,$rsIngresos->fields['VALOR_DRP'],45,$posYING,"string","left",'Arial','8');
     $totalIngresos+= $rsIngresos->fields['VALOR_DRP'];
     $posYING+=5;
     $rsIngresos->MoveNext();
    }

   $rsEgresos=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and desplegarrol_rgr='SI' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and serial_erp=".$serial_erp);

    $posYEGR=45;
    while (!$rsEgresos->EOF) {
     $printOBJ->addColumn(' ',40,$rsEgresos->fields['NOMBRE_RGR'],105,$posYEGR,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',45,$rsEgresos->fields['VALOR_DRP'],145,$posYEGR,"string","left",'Arial','8');
     $totalEgresos+= $rsEgresos->fields['VALOR_DRP'];
     $posYEGR+=5;
     $rsEgresos->MoveNext();
    }
    $posY=($posYING>$posYEGR)? $posYING:$posYEGR;
    $printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,$posY,"string","left",'Arial','8');
     $posY+=5;
     $printOBJ->addColumn(' ',40,'TOTAL INGRESOS',5,$posY,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',45,number_format($totalIngresos,2),45,$posY,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',40,'TOTAL EGRESOS',105,$posY,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',45,number_format($totalEgresos,2),145,$posY,"string","left",'Arial','8');
     $printOBJ->addColumn('NETO A RECIBIR:',40,number_format($totalIngresos-$totalEgresos,2),105,$posY+=8,"string","right",'Arial','12');

    $printOBJ->addColumn(' ',45,'______________________________________________________',5,$posY+=20,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',40,'RECIBI CONFORME',5,$posY+=5,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',40,$resultSet->fields['APELLIDO_EPL']." ".$resultSet->fields['NOMBRE_EPL'],5,$posY+=5,"string","left",'Arial','8');
     $printOBJ->addColumn(' ',40,'CI:'.$resultSet->fields['DOCUMENTOIDENTIDAD_EPL'],5,$posY+=5,"string","left",'Arial','8');

  $printOBJ->showIt();


?>