<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


  $printOBJ=new OmnisoftPDFIndividual($imagePath."logo.jpg",$omnisoftNombreEmpresa,'FACTURA','INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');
  $numerofactura=$_GET['numerofactura'];

      global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select alumno.*,cabecerafactura.* from cabecerafactura,alumno where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$numerofactura);
//      echo 'select alumno.*,cabecerafactura.*,padres.* from cabecerafactura,alumno left join padres_alumno,padres on padres_alumno.serial_alu=alumno.serial_alu and padres.serial_pad=padres_alumno.serial_pad where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$numerofactura;
   //   echo 'select alumno.*,cabecerafactura.* from alumno,cabecerafactura where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$numerofactura;
$y=20;
$fila=5;
$columna=20;
  $printOBJ->addColumn('CLIENTE:',$y,$resultSet->fields['apellidopaterno_alu']." ".$resultSet->fields['apellidomaterno_alu']." ".$resultSet->fields['nombre1_alu']." ".$resultSet->fields['nombre2_alu'],$columna,$fila,"string","center",'Arial','7',true);
  $printOBJ->addColumn('R.U.C./C.I.:',$y,$resultSet->fields['codigoIdentificacion_alu'],$columna+100,$fila,"string","center",'Arial','7',true);
  $fila=$fila+5;
  $printOBJ->addColumn('FECHA: ',$y,$resultSet->fields['fecha_caf'],$columna,$fila,"string","center",'Arial','7',true);
  $printOBJ->addColumn('TELFS:',$y,$resultSet->fields['telefodomic_alu'],$columna+100,$fila,"string","center",'Arial','7',true);
  $fila=$fila+5;
  $printOBJ->addColumn('DIRECCION:',$y,$resultSet->fields['direcciondomic_alu'],$columna,$fila,"string","center",'Arial','7',true);

   // $printOBJ->addColumn(' ',45,$resultSet->fields['direcciondomic_alu'],10,15,"string","center",'Arial','9',true);
    

   //  $printOBJ->addColumn(' ',20,$resultSet->fields['fechapago_caf'],28,15,"string","center",'Arial','9',true);


$fila=25;
$columna=20;

     $printOBJ->addColumn('____________________________________________',20,'',$columna,$fila-6);
     $printOBJ->addColumn('ARANCEL',20,'',$columna+10,$fila,"string","center",'Arial','6',true);
     $printOBJ->addColumn('CANTIDAD',20,'',$columna+70,$fila,"string","center",'Arial','6',true);
     $printOBJ->addColumn('VALOR',20,'',$columna+100,$fila,"string","center",'Arial','6',true);
     $printOBJ->addColumn('SUBTOTAL',20,'',$columna+130,$fila,"string","center",'Arial','6',true);
	 $printOBJ->addColumn('____________________________________________',20,'',$columna,$fila);
    // $printOBJ->addColumn(' ',20,'_______________________________________________________________________________________________________________________________________________________________________________________',$columna,$fila+20);

    $sql="select serial_dfa, nombre_ara,    cantidad_dfa,valor_aal,cantidad_dfa*valor_aal as subtotal,cantidad_dfa*valor_aal as total,detallefactura.serial_caf, detallearancel.serial_dar from aranceles,detallearancel,detallefactura where detallearancel.serial_dar=detallefactura.serial_dar  and aranceles.serial_ara=detallearancel.serial_ara and detallefactura.serial_caf=".$numerofactura." order by nombre_ara ";
    $resultSet2=$dblink->Execute($sql);

    $fila=35;
    $totalgeneral=0;
    $totaliva12=0;
    $totaliva0=0;
    $descuentos12=0;
    $descuentos0=0;
    $iva12=0;
    $baseimponible0=0;
    $baseimponible12=0;
	$cont=0;
    while(!$resultSet2->EOF) {
    $printOBJ->addColumn(' ',40,$resultSet2->fields['nombre_ara'],$columna,$fila,"string","center",'Arial','6',true);
    $printOBJ->addColumn(' ',10,number_format($resultSet2->fields['cantidad_dfa'],0),$columna+65,$fila,"number","right",'Arial','8',true);
    $printOBJ->addColumn(' ',15,number_format($resultSet2->fields['valor_aal'],3),$columna+95,$fila,"number","right",'Arial','8',true);
    $printOBJ->addColumn(' ',15,number_format($resultSet2->fields['subtotal'],2),$columna+125,$fila,"number","right",'Arial','8',true);
//    $printOBJ->addColumn(' ',15,number_format($resultSet2->fields['valorIva12_dorp'],2),152,$fila,"string","center",'Arial','8',true);
//    $printOBJ->addColumn(' ',15,number_format($resultSet2->fields['total'],2),170,$fila,"string","center",'Arial','8',true);
    $totalgeneral+=$resultSet2->fields['total'];
    $subtotalgeneral+=$resultSet2->fields['subtotal'];

    if ( $resultSet2->fields['iva_ara']=='SI')   {
    $baseimponible12+=$resultSet2->fields['subtotal'];
    $totaliva12+=$resultSet2->fields['valorIva12_dorp'];
    $descuentos12+=$resultSet2->fields['descuento'];
    }
    else {
    $totaliva0+=$resultSet2->fields['valorIva0_dorp'];
    $baseimponible0+=$resultSet2->fields['subtotal'];
    $descuentos0+=$resultSet2->fields['descuento'];
    } 
	$fila+=5;
	$cont++;
    $resultSet2->MoveNext();
    }
	while($cont<=8){
	 $printOBJ->addColumn(' ',15,$cont,$columna+125,$fila,"number","right",'Arial','8',true);
	}
   //  $printOBJ->addColumn(' ',150,'_______________________________________________________________________________________________________________________________________________________________________________________',40,$fila);
    $printOBJ->addColumn('              SUBTOTAL:',55,number_format($subtotalgeneral,2),115,$fila+10,"string","right",'Arial','8',true);
    //$printOBJ->addColumn('    DESCUENTOS IVA 12%:',55,number_format($descuentos12,2),123,$fila+15,"string","right",'Arial','9',true);
    $printOBJ->addColumn('BASE IMPONIBLE IVA 12%:',55,number_format($baseimponible12,2),115,$fila+15,"string","right",'Arial','8',true);
  //  $printOBJ->addColumn('     DESCUENTOS IVA 0%:',55,number_format($descuentos0,2),123,$fila+25,"string","right",'Arial','9',true);
    $printOBJ->addColumn(' BASE IMPONIBLE IVA 0%:',55,number_format($baseimponible0,2),115,$fila+20,"string","right",'Arial','8',true);
    $printOBJ->addColumn('               IVA 12%:',55,number_format($totaliva12,2),115,$fila+25,"string","right",'Arial','8',true);
    $totalglobal=$totalgeneral+$totaliva12-$descuentos12-$descuentos0;
    $printOBJ->addColumn('                 TOTAL:',55,number_format($totalglobal,2),115,$fila+30,"string","right",'Arial','8',true);


  $printOBJ->showIt();


?>