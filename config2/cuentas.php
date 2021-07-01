<?php
  //Cuentas Contables

  //AHORROS
  $ctaAhorrosDebe="4.1.01.15.05.01.08";
  $ctaAhorrosHaber="2.5.01.05.05.01.08";

  //CERTIFICADOS
  $ctaCertificadosDebe="4.1.01.15.05.01.32";
  $ctaCertificadosHaber="2.5.01.05.05.01.16";

  //DEPOSITOS
  $ctaDepositosDebe="4.1.01.15.05.01.32";
  $ctaDepositosHaber="2.5.01.05.05.01.16";


  //INACTIVACIÓN DE CUENTAS
  $ctaInactivacionDebe="2.1.01.05.05.01.08";
  $ctaInactivacionHaber="2.1.01.10.05.01.08";
  
  //IMPUESTOS
  //IMPUESTO A LA RENTA
  $ctaImpRentaDebe="4.5.04.05.05.01.08";
  $ctaImpRentaHaber="2.5.04.05.05.01.08";
  
  //IMPUESTO IVA
//  $ctaImpIvaDebe="";  
  $ctaImpIvaHaber="2.5.05.90.05.01.16";    
  
  
  
  //TRANSFERENCIA DE MATERIALES DE OFICINA
  $ctaTransferenciaInterna=array("1"=>"1.9.08.05.05.01.08","2"=>"1.9.08.05.05.01.40","4"=>"1.9.08.05.05.01.16","5"=>"1.9.08.05.05.01.32","6"=>"1.9.08.05.05.01.48","7"=>"1.9.08.05.05.01.24"); //van al debe o al haber dependiento quién envìa y quien recibe
  $ctaProveeduriaBienesConsumo='1.9.06.15.05.01.08';

  //INGRESO DE MATERIAL FUNGIBLE POR MEDIO DE FACTURA (INVENTARIOS)
  $ctaGastoProveeduriaBienesConsumoDebe="4.04.10";//'4.5.07.05.05.01.08';
  $ctaCuentasPorPagarHaber="2.1.04.01";//"2.5.90.90.05.01.08";
  $ctaRetencionIva="2.1.03.01";//"2.5.05.90.05.01.16";
  $ctaRetencionIrfHaber="2.1.03.02";//"2.5.04.05.05.01.08";

    //  *********************** MODULO DE CARTERA ******************************
  // Ctas. para temporalizacion de Cartera
  //Creditos de Consumo
  $CTACONSUMO=array("g1"=>"1.4.02.05.05.01.08", "g2"=>"1.4.02.10.05.01.08","g3"=>"1.4.02.15.05.01.08","g4"=>"1.4.02.20.05.01.08","g5"=>"1.4.02.25.05.01.08");
  //Creditos para Vivienda
  $CTAVIVIENDA=array("g1"=>"1.4.03.05.05.01.08","g2"=>"1.4.03.10.05.01.08","g3"=>"1.4.03.15.05.01.08","g4"=>"1.4.03.20.05.01.08","g5"=>"1.4.03.25.05.01.08");
  //Creditos para Microempresa
  $CTAMICROEMPRESA=array("g1"=>"1.4.04.05.05.01.08","g2"=>"1.4.04.10.05.01.08","g3"=>"1.4.04.15.05.01.08","g4"=>"1.4.04.20.05.01.08","g5"=>"1.4.04.25.05.01.08");


?>