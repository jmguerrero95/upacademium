<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

  global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      $serial_rop=$_GET['serial_rop'];

      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $rsEmpleado=$dblink->Execute('select * from sucursal,departamentos,sucursaldepartamentos,cargos,escalafones,periodorol,rolpagosgeneral,empleado,empleadorolpagos where sucursal.serial_suc=sucursaldepartamentos.serial_suc and departamentos.serial_dep=sucursaldepartamentos.serial_dep and sucursaldepartamentos.serial_desc=empleado.serial_desc and cargos.serial_car=escalafones.serial_car and escalafones.serial_esc=empleado.serial_esc and empleado.serial_epl=empleadorolpagos.serial_epl and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol and serial_rop='.$serial_rop." and estadoEmpleado_epl='ACTIVO' and generaRol_epl='SI'  order by apellido_epl,nombre_epl");

  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'ROL DE PAGOS DE '.$rsEmpleado->fields['DESCRIPCION_PERROL'],'Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]','Arial',18,0xf,0x0,35,OMNISOFT_HORIZONTAL);

    $printOBJ->addColumn('  ',25,'EMPLEADO',5,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'INGRESOS',60,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'EGRESOS',150,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'TOTAL A RECIBIR',210,8,"string","left",'Arial','8',true);

    $rsIngresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol and desplegarrol_rgr='SI' and serial_rop=".$serial_rop);
    $posX=60;
    while (!$rsIngresos->EOF) {
    $printOBJ->addColumn(' ',10,$rsIngresos->fields[0],$posX,13,"string","left",'Arial','5',true);
    $posX+=10;
    $rsIngresos->MoveNext();

    }
    $printOBJ->addColumn(' ',10,'TOTAL',$posX+5,13,"string","left",'Arial','5',true);

    $rsEgresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol and desplegarrol_rgr='SI' and serial_rop=".$serial_rop);
    $posX=120;
    while (!$rsEgresos->EOF) {
    $printOBJ->addColumn(' ',10,$rsEgresos->fields[0],$posX,13,"string","left",'Arial','5',true);
    $posX+=10;
    $rsEgresos->MoveNext();

    }
    $printOBJ->addColumn(' ',10,'TOTAL',$posX+=5,13,"string","left",'Arial','5',true);

    $totalIngresos=0;
    $totalEgresos=0;
    $posY=16;
    $numepl=0;
    while (!$rsEmpleado->EOF ){


    $tingresosempleado=0;
    $tegresosempleado=0 ;
    if ($numepl++ >43) {

    $printOBJ->addColumn(' ',40,' ',5,$posY,"string","left",'Arial','6',false,true);
    $printOBJ->addColumn('  ',25,'EMPLEADO',5,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'INGRESOS',60,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'EGRESOS',150,8,"string","left",'Arial','8',true);
    $printOBJ->addColumn('  ',25,'TOTAL A RECIBIR',210,8,"string","left",'Arial','8',true);

    $rsIngresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol and desplegarrol_rgr='SI' and serial_rop=".$serial_rop);
    $posX=60;
    while (!$rsIngresos->EOF) {
    $printOBJ->addColumn(' ',10,$rsIngresos->fields[0],$posX,13,"string","left",'Arial','5',true);
    $posX+=10;
    $rsIngresos->MoveNext();

    }
    $printOBJ->addColumn(' ',10,'TOTAL',$posX+5,13,"string","left",'Arial','5',true);

    $rsEgresos=$dblink->Execute("select distinct codigo_rgr from periodorol,rolpagosgeneral,rubrogeneralrolpagos,empleadorolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and periodorol.serial_perrol=empleadorolpagos.serial_perrol and empleadorolpagos.serial_perrol=rolpagosgeneral.serial_perrol and desplegarrol_rgr='SI' and serial_rop=".$serial_rop);
    $posX=120;
    while (!$rsEgresos->EOF) {
    $printOBJ->addColumn(' ',10,$rsEgresos->fields[0],$posX,13,"string","left",'Arial','5',true);
    $posX+=10;
    $rsEgresos->MoveNext();

    }
    $printOBJ->addColumn(' ',10,'TOTAL',$posX+=5,13,"string","left",'Arial','5',true);



    $numepl=0;
    $posY=16;

    }
    $printOBJ->addColumn(' ',40,$rsEmpleado->fields['APELLIDO_EPL']."  ".$rsEmpleado->fields['NOMBRE_EPL'],5,$posY,"string","left",'Arial','6',false,false);


    $serial_erp=$rsEmpleado->fields['SERIAL_ERP'];

    $rsIngresos->MoveFirst();
    $posXING=60;
    while (!$rsIngresos->EOF) {
     $rsIngresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='INGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and desplegarrol_rgr='SI' and serial_erp=".$serial_erp." and codigo_rgr='".$rsIngresos->fields[0]."'" );
     if ($rsIngresosVal && $rsIngresosVal->RecordCount()>0) {
     $printOBJ->addColumn(' ',10,$rsIngresosVal->fields['VALOR_DRP'],$posXING,$posY,"number","right",'Arial','5',true);
     $totalIngresos+= $rsIngresosVal->fields['VALOR_DRP'];
     $tingresosempleado+=$rsIngresosVal->fields['VALOR_DRP'];
     }
     $posXING+=10;
     $rsIngresos->MoveNext();
    }

    $printOBJ->addColumn(' ',10,$tingresosempleado,$posXING+=5,$posY,"number","right",'Arial','5',true);


    $rsEgresos->MoveFirst();
    $posXEGR=120;
    while (!$rsEgresos->EOF) {
     $rsEgresosVal=$dblink->Execute("select * from rubrogeneralrolpagos,detallerolpagos where valor_drp>0 and tipo_rgr='EGRESO' and rubrogeneralrolpagos.serial_rgr=detallerolpagos.serial_rgr and desplegarrol_rgr='SI' and serial_erp=".$serial_erp." and codigo_rgr='".$rsEgresos->fields[0]."'" );
     if ($rsEgresosVal && $rsEgresosVal->RecordCount()>0) {
     $printOBJ->addColumn(' ',10,$rsEgresosVal->fields['VALOR_DRP'],$posXEGR,$posY,"number","right",'Arial','5',true);
     $totalEgresos+= $rsEgresosVal->fields['VALOR_DRP'];
     $tegresosempleado+=$rsEgresosVal->fields['VALOR_DRP'];
     }
     $posXEGR+=10;
     $rsEgresos->MoveNext();
    }

    $printOBJ->addColumn(' ',10,$tegresosempleado,$posXEGR+=5,$posY,"number","right",'Arial','5',true);
    $printOBJ->addColumn(' ',10,$tingresosempleado-$tegresosempleado,$posXEGR+=20,$posY,"number","right",'Arial','5',true);


     $rsEmpleado->MoveNext();
     $posY+=3;
    }
    $printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________________',5,$posY,'string','right','Arial','6',true);
     $posY+=5;
     $printOBJ->addColumn(' ',40,'TOTAL INGRESOS',5,$posY,'string','right','Arial','8',true);
     $printOBJ->addColumn(' ',45,number_format($totalIngresos,2),$posXING,$posY,'string','right','Arial','8',true);
     $printOBJ->addColumn(' ',40,'TOTAL EGRESOS',120,$posY,'string','right','Arial','8',true);
     $printOBJ->addColumn(' ',45,number_format($totalEgresos,2),$posXEGR-20,$posY,'string','right','Arial','8',true);
     $printOBJ->addColumn(' ',40,number_format($totalIngresos-$totalEgresos,2),$posXEGR,$posY,'string','right','Arial','8',true);

  $printOBJ->showIt();


?>