<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');


  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'FACTURA','INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');
  $numerofactura=$_GET['numerofactura'];

      global $DBConnection;

      $dblink = NewADOConnection($DBConnection);
      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select ordenpedido.*,cliente.* from cliente,ordenpedido where cliente.serial_cli=ordenpedido.serial_cli and ordenpedido.serial_orp='.$numerofactura);
    if ($resultSet->fields['SERIAL_CLI']==-1)
    $printOBJ->addColumn(' ',45,$resultSet->fields['cedula_orp']."-".$resultSet->fields['nombre_orp'],25,5);
    else
    $printOBJ->addColumn(' ',45,$resultSet->fields['DOCUMENTOIDENTIDAD_CLI']."-".$resultSet->fields['RAZONSOCIAL_CLI'],25,5);

    $printOBJ->addColumn(' ',20,$resultSet->fields['FECHA_ORP'],5,10);

    $printOBJ->addColumn(' ',45,$resultSet->fields['DIRECCION_CLI'],120,5);
     $printOBJ->addColumn(' ',20,$resultSet->fields['TELEFONOCOM1_CLI'],120,10);

     $printOBJ->addColumn(' ',20,$resultSet->fields['FECHAVENCIMIENTO_ORP'],5,15);

     $printOBJ->addColumn(' ',20,'CUENCA',120,15);


     $printOBJ->addColumn('PRODUCTO',20,' ',5,25);
     $printOBJ->addColumn('UNIDAD',20,'',45,25);
     $printOBJ->addColumn('EMBALAJE',20,'',45,28);

     $printOBJ->addColumn('UNIDADES',20,'',60,25);
     $printOBJ->addColumn('SOLICITADAS',20,'',62,28);

     $printOBJ->addColumn('COMPENSACION',20,'',80,25);
     $printOBJ->addColumn('TOTAL',20,'',100,25);
     $printOBJ->addColumn('UNIDADES',20,'',97,28);
     $printOBJ->addColumn('PRECIO C/U',20,'',113,25);
     $printOBJ->addColumn('SUBTOTAL',20,'',135,25);
     $printOBJ->addColumn('IVA 12%',15,'',152,25);
     $printOBJ->addColumn('TOTAL',20,'',170,25);
//echo     "select serial_dorp, nombre_prd, cantidad_dorp, cantidadunidades_dorp,cantidaddespachar_dorp,round(cantidaddespachar_dorp*descuento_dca,0) as compensacion,valor_lpr, descuentounidades_dca, descuento_dca,ice_dorp,valorIva12_dorp,valorIva0_dorp, (cantidaddespachar_dorp*(1-descuento_dca)*valor_lpr) as total,producto.serial_prd,comision_dorp FROM listaprecios,detalleordenpedido,producto,cliente left join descuentocanal on descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd and  descuentocanal.serial_tpr=cliente.serial_tpr and cliente.serial_cli=".$resultSet->fields['SERIAL_CLI']." WHERE producto.serial_prd=detalleordenpedido.serial_prd and   descuentocanal.serial_prd is NOT NULL and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and detalleordenpedido.serial_orp=".$numerofactura;

//                                  (@totaldespachar:=if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp =0,@totalunidades,cantidaddespachar_dorp)) as cantidaddespachar_dorp,format(valor_lpr,2) as valor_lpr, format(@totaldespachar*valor_lpr,2) as subtotal,format((@descuento:=@compensacion*valor_lpr),2) as descuento,format((@iva12:=if (grabaiva_prd =\'SI\',0.12*@unidades*valor_lpr,0)),2) as valorIva12_dorp, format((@iva12+@totaldespachar*valor_lpr-@descuento),2) as total,producto.serial_prd,comision_dorp FROM listaprecios,detalleordenpedido,producto,cliente left join descuentocanal on descuentocanal.serial_tpr=cliente.serial_tpr and descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd  and descuento_dca is NOT NULL WHERE producto.serial_prd=detalleordenpedido.serial_prd and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and  cliente.serial_cli='+cliente_orp+' and detalleordenpedido.serial_orp=masterkey

    $sql="select serial_dorp, nombre_prd,  (@cajas:=if(cantidad_dorp is NULL or cantidad_dorp=0,if(cantidaddespachar_dorp is NULL or cantidaddespachar_dorp=0,cantidadunidades_dorp,cantidaddespachar_dorp)/unidadesembalaje_prd,cantidad_dorp )) as cantidad_dorp, (@unidades:=if(cantidad_dorp is NULL or cantidad_dorp=0,if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp=0,cantidadunidades_dorp,cantidaddespachar_dorp),cantidad_dorp*unidadesembalaje_prd))as cantidadunidades_dorp,(@compensacion:=round(@unidades*if(descuento_dca is NULL,0,descuento_dca),0)) as compensacion_dorp,(@totalunidades:=@unidades+@compensacion) as totalunidades_dorp,(@totaldespachar:=if (cantidaddespachar_dorp is NULL or cantidaddespachar_dorp =0,@totalunidades,cantidaddespachar_dorp)) as cantidaddespachar_dorp,format(valor_lpr,4) as valor_lpr, (@totaldespachar*valor_lpr) as subtotal,format((@descuento:=@compensacion*valor_lpr),2) as descuento,format((@iva12:=if (grabaiva_prd ='SI',0.12*@unidades*valor_lpr,0)),2) as valorIva12_dorp, ((@totaldespachar*valor_lpr)) as total,producto.serial_prd,comision_dorp,grabaiva_prd FROM listaprecios,detalleordenpedido,producto,cliente left join descuentocanal on descuentocanal.serial_tpr=cliente.serial_tpr and descuentocanal.serial_can=cliente.serial_can and descuentocanal.serial_prd=producto.serial_prd  WHERE producto.serial_prd=detalleordenpedido.serial_prd and  listaprecios.serial_prd=producto.serial_prd and listaprecios.serial_tpr=cliente.serial_tpr and  cliente.serial_cli=".$resultSet->fields['SERIAL_CLI']." and detalleordenpedido.serial_orp=".$numerofactura;
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
    while(!$resultSet2->EOF) {
    $printOBJ->addColumn(' ',40,$resultSet2->fields['nombre_prd'],5,$fila);
    $printOBJ->addColumn(' ',10,$resultSet2->fields['cantidad_dorp'],53,$fila);
    $printOBJ->addColumn(' ',10,$resultSet2->fields['cantidadunidades_dorp'],65,$fila);
    $printOBJ->addColumn(' ',10,$resultSet2->fields['compensacion_dorp'],78,$fila);
    $printOBJ->addColumn(' ',10,$resultSet2->fields['totalunidades_dorp'],102,$fila);
    $printOBJ->addColumn(' ',15,$resultSet2->fields['valor_lpr'],113,$fila);
    $printOBJ->addColumn(' ',15,$resultSet2->fields['subtotal'],135,$fila);
    $printOBJ->addColumn(' ',15,$resultSet2->fields['valorIva12_dorp'],152,$fila);
    $printOBJ->addColumn(' ',15,$resultSet2->fields['total'],170,$fila);
    $totalgeneral+=$resultSet2->fields['total'];
    $subtotalgeneral+=$resultSet2->fields['subtotal'];

    if ( $resultSet2->fields['grabaiva_prd']=='SI')   {
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
    $resultSet2->MoveNext();
    }
     $printOBJ->addColumn(' ',150,'_______________________________________________________________________________________________________________________________________________________________________________________',40,$fila);
    $printOBJ->addColumn('              SUBTOTAL:',30,number_format($subtotalgeneral,2),123,$fila+10);
    $printOBJ->addColumn('    DESCUENTOS IVA 12%:',30,number_format($descuentos12,2),123,$fila+15);
    $printOBJ->addColumn('BASE IMPONIBLE IVA 12%:',30,number_format($baseimponible12,2),123,$fila+20);
    $printOBJ->addColumn('     DESCUENTOS IVA 0%:',30,number_format($descuentos0,2),123,$fila+25);
    $printOBJ->addColumn(' BASE IMPONIBLE IVA 0%:',30,number_format($baseimponible0,2),123,$fila+30);
    $printOBJ->addColumn('               IVA 12%:',30,number_format($totaliva12,2),123,$fila+35);
    $totalglobal=$totalgeneral+$totaliva12-$descuentos12-$descuentos0;
    $printOBJ->addColumn('                 TOTAL:',30,number_format($totalglobal,2),123,$fila+40);


  $printOBJ->showIt();


?>