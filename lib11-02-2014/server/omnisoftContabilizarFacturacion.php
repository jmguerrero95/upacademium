<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftContabilidad.inc.php');

$dblink='';
function omnisoftConnectDB() {
global $DBConnection;

$dblink = NewADOConnection($DBConnection);

return $dblink;
}

   function consultarPeriodoFecha($fecha){

                     global $dblink;
                     $consulta="select serial_per from periodoContable where '$fecha' between inicio_per and fin_per";
                     $rsconsulta=$dblink->Execute($consulta);

                     if(!$rsconsulta->EOF){
                        $serial_per=$rsconsulta->fields[0];
                        return $serial_per;
                     }else{
                         return 0;
                     }

                 }

  function consultarUltimoNumeroComprobantePorTipo($serial_tic,$serial_age){

                     global $dblink;
                     $consulta="SELECT numero_com FROM comprobante WHERE serial_tic=\"$serial_tic\" AND serial_age=\"$serial_age\"
					 			ORDER BY codigo_com";
					// echo $consulta;
                     $rsconsulta=$dblink->Execute($consulta);
                     if(!$rsconsulta->EOF){
                        $rsconsulta->MoveLast();
			$numero=$rsconsulta->fields[0];
						return $numero+1;
                     }else{
						$sql_tic="select numero_ntc from detalleTipoComprobante, tipoComprobante where tipoComprobante.serial_tic=\"$serial_tic\" and ";
						$sql_tic.="detalleTipoComprobante.serial_tic=tipoComprobante.serial_tic and detalleTipoComprobante.estado_ntc=\"A\"";
						$rs_num=$dblink->Execute($sql_tic);
						if (!$rs_num->EOF)
							$numero=$rs_num->fields[0];
						return $numero+1;
                     }
               }


function actualizarSecuenciaTipoComprobante($dblink,$tipo,$numero_tic) {

   $SQLSecuencia="update tipocomprobante set numero_tic=".$numero_tic." where serial_tic=".$tipo;
   //echo $SQLSecuencia."<br>";
   $dblink->Execute($SQLSecuencia);

   return (strlen($dblink->ErrorMsg())<=0);

}




function insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$monto_com,$estado_com,$numero_com,$serial_tic,$serial_usr,$serial_age,$siglas='FAC') {
   $afecha=explode("-",$fecha_com);
   $anio=substr($afecha[0],2,2);
   $mes=$afecha[1];
   $snumero=str_pad($numero_com, 10, "0", STR_PAD_LEFT);
   $serial_per=consultarPeriodoFecha($fecha_com);
   $codigo_com=$siglas.$anio.$mes.$snumero;
   //echo $codigo_com."<br>";
   if ($monto_com=='') $monto_com=0;
   $SQLCommand="insert into comprobante (serial_com,fecha_com,concepto_com,monto_com,estado_com,numero_com,usuario_com,serial_tic,modulo_com,generado_com,codigo_com,serial_per,serial_age) values (0,'".$fecha_com."','" .$concepto_com."',".$monto_com.",'".$estado_com."',".$numero_com.",".$serial_usr.",".$serial_tic.",'PENSIONES','A','".$codigo_com."',".$serial_per.",".$serial_age.")";
//  echo $SQLCommand."<br>";

   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();

}


function insertarDetalleComprobante($dblink,$serial_com,$serial_plc,$debe,$haber,$descripcion,$referencia,$serial_dep) {

   if ($debe=='')$debe=0;
   if ($haber=='')$haber=0;

   $SQLCommand="insert into detallecomprobante (serial_det, serial_plc, serial_com, debe_det, haber_det, descripcion_det, referencia_det, serial_dep) values (0,'".$serial_plc."','" .$serial_com."',".$debe.",".$haber.",'".$descripcion."','".$referencia."','".$serial_dep."')";

   //echo $SQLCommand."<br>";
   $dblink->Execute($SQLCommand);


   return (strlen($dblink->ErrorMsg())>0)?0:$dblink->Insert_ID();
}


function omnisoftContabilizarFacturacion() {

  global  $_POST,$omnisoftCOMPROBANTEFACTURACION,$dblink;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->StartTrans();

   $params=explode('|',$query);
   $concepto_com='CIERRE FIN DE DIA FACTURACION '.$params[0].' AL '.$params[1];
   $fecha_com=$params[0];

   $serial_age=$_COOKIE['serial_age'];
   $serial_suc=$_COOKIE['serial_suc'];
/*$SQLCommand="SELECT detallearancel.serial_plcfd, sum((cantidad_dfa*valor_aal)*if(porcentaje_dde is NULL,1,porcentaje_dde)) as subtotal_dfa,nombre_ara,detallearancel.serial_plcfh,serial_dep,categoriaalumno.serial_caa FROM aranceles,cabecerafactura,detallefactura,detallearancel,categoriaalumno,alumno left join detalle_descuento on  detalle_descuento.serial_caa=alumno.serial_caa and detalle_descuento.serial_dar=detallefactura.serial_dar where  alumno.serial_alu=cabecerafactura.serial_alu    and detallefactura.serial_caf = cabecerafactura.serial_caf and detallearancel.serial_dar=detallefactura.serial_dar and categoriaalumno.serial_caa=alumno.serial_caa and aranceles.serial_ara=detallearancel.serial_ara and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and alumno.serial_suc=".$serial_age;*/

//echo "<br>serial_age:".$serial_age;
//echo "<br>serial_suc:".$serial_suc;

	$SQLCommand="SELECT serial_dfa,detallefactura.serial_plc,(cantidad_dfa*valor_aal) as subtotal_dfa, if(valorajuste_aal>0,((cantidad_dfa*valor_aal)*if(valorajuste_aal>0,valorajuste_aal,1)),0) as descuento_dfa,
	nombre_ara,detallefactura.serial_plce,serial_dep,detallefactura.serial_caa, categoriaalumno.serial_plc as serial_plc_cat
	FROM aranceles,cabecerafactura,detallefactura,detallearancel
	left join categoriaalumno on categoriaalumno.serial_caa=detallefactura.serial_caa
	where detallefactura.serial_caf = cabecerafactura.serial_caf 
	and detallearancel.serial_dar=detallefactura.serial_dar
	and aranceles.serial_ara=detallearancel.serial_ara and fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."' and cabecerafactura.serial_suc=".$serial_suc."  AND estado_caf='FACTURADO' order by serial_dfa asc";

//$SQLCommand_debe=$SQLCommand." GROUP BY serial_dep,detallearancel.serial_plc";
  // echo $SQLCommand."<br>";
   $rsMonto=$dblink->Execute($SQLCommand);

   $total=$rsMonto->fields[1];
   $total=0;	
   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
   $numero_com=consultarUltimoNumeroComprobantePorTipo($omnisoftCOMPROBANTEFACTURACION,$serial_age);
  //echo "numero_com=".$numero_com."<br>";
   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$total,'P',$numero_com,$omnisoftCOMPROBANTEFACTURACION,$serial_usr,$serial_age);

   if ($serial_com==0) { echo "!Error: ". $dblink->ErrorMsg(); return;  }

   while (!$rsMonto->EOF) {
   	  //ASIENTO DEBE	
	 //CUANDO EL RUBRO TENGA DESCUENTO POR CATEGORIA 	
	 if($rsMonto->fields['descuento_dfa']>0){
	     $serial_debe=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plce'],$rsMonto->fields['subtotal_dfa']-$rsMonto->fields['descuento_dfa'],0,$rsMonto->fields['nombre_ara'],$numero_com,$rsMonto->fields['serial_dep']);
		 if ($serial_debe==0) { echo "!Error: ". $dblink->ErrorMsg(); return;   }
		 //ASIENTO DEL DESCUENTO POR CATEGORIA
		 $serial_descuento=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plc_cat'],$rsMonto->fields['descuento_dfa'],0,$rsMonto->fields['nombre_ara'],$numero_com,$rsMonto->fields['serial_dep']);
		 if ($serial_descuento==0) { echo "!Error: ". $dblink->ErrorMsg(); return;   }
	 }else{
	 	 $serial_debe=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plce'],$rsMonto->fields['subtotal_dfa'],0,$rsMonto->fields['nombre_ara'],$numero_com,$rsMonto->fields['serial_dep']);
		 if ($serial_debe==0) { echo "!Error: ". $dblink->ErrorMsg(); return;   }
	 }
	 //ASIENTO HABER
   	 $serial_haber=insertarDetalleComprobante($dblink,$serial_com,$rsMonto->fields['serial_plc'],0,$rsMonto->fields['subtotal_dfa'],$rsMonto->fields['nombre_ara'],$numero_com,$rsMonto->fields['serial_dep']);
	 if ($serial_haber==0) { echo "!Error: ". $dblink->ErrorMsg(); return;   }

   $rsMonto->MoveNext();
  }
  	//ACTUALIZA LAS FACTURAS CON EL COMPROBANTE CONTABLE QUE SE CONTABILIZO
	$SQLUpdate="update cabecerafactura set serial_com=".$serial_com."  where fecha_caf>='".$params[0]."' and fecha_caf<='".$params[1]."'";
	$rsupdate=$dblink->Execute($SQLUpdate);
	
    $dblink->CompleteTrans();

    $resultData=$resultData.$serial_com."|";

    echo $resultData;
}



function omnisoftContabilizarRecibosCobro() {

  global  $_POST,$omnisoftCOMPROBANTEINGRESO,$dblink;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->StartTrans();

   $params=explode('|',$query);
   $concepto_com='CIERRE FIN DE DIA RECAUDACION '.$params[0].' AL '.$params[1];
   $fecha_com=$params[0];



$SQLCommand="SELECT sum(valor_dre) FROM cabecerarecibo,detallerecibo where detallerecibo.serial_cre=cabecerarecibo.serial_cre and  estado_cre<>'CONTABILIZADO' and fecha_cre>='".$params[0]."' and fecha_cre<='".$params[1]."'";


//   echo $SQLCommand."<br>";
   $rsMonto=$dblink->Execute($SQLCommand);

   $total=$rsMonto->fields[0];

   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
   $serial_age=$_COOKIE['serial_age'];
   $serial_age=3;
   $serial_dep=23;
   $numero_com=consultarUltimoNumeroComprobantePorTipo($omnisoftCOMPROBANTEINGRESO,$serial_age);
  //echo "numero_com=".$numero_com."<br>";
   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$total,'P',$numero_com,$omnisoftCOMPROBANTEINGRESO,$serial_usr,$serial_age,'ING');

   if ($serial_com==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;

   }

    $sCuentaCaja=omnisoftLeerParametro($dblink,"ctaCaja");
    $cuentaCaja=omnisoftLeerSerialCuentaContable($dblink,$sCuentaCaja);

    $sCuentaAnticiposClientes=omnisoftLeerParametro($dblink,"ctaPagosAnticipados");
    $cuentaAnticiposClientes=omnisoftLeerSerialCuentaContable($dblink,$sCuentaAnticiposClientes);

      $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaCaja,$rsMonto->fields[0],0,'ANTICIPOS DE CLIENTES',$numero_com,$serial_dep);

   if ($serial_det==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;
   }

      $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaAnticiposClientes,0,$rsMonto->fields[0],'ANTICIPOS DE CLIENTES',$numero_com,$serial_dep);
   if ($serial_det==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;
   }

    echo $resultData;
}

function omnisoftContabilizarPagosVencidos() {

  global  $_POST,$omnisoftCOMPROBANTEINGRESO,$dblink;

   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $dblink->StartTrans();

   $params=explode('|',$query);
   $concepto_com='CIERRE FIN DE DIA PAGOS VENCIDOS '.$params[0].' AL '.$params[1];
   $fecha_com=$params[0];



$SQLCommand="SELECT sum(valor_dre) FROM cabecerarecibo,detallerecibo where detallerecibo.serial_cre=cabecerarecibo.serial_cre and  estado_cre='VENCIDO' and estado_cre<>'CONTABILIZADO' and fecha_cre>='".$params[0]."' and fecha_cre<='".$params[1]."'";


//   echo $SQLCommand."<br>";
   $rsMonto=$dblink->Execute($SQLCommand);

   $total=$rsMonto->fields[0];

   $serial_usr=(strlen($_COOKIE['serial_usr'])>0)? $_COOKIE['serial_usr']:1;
   $serial_age=$_COOKIE['serial_age'];
   $serial_age=3;
   $serial_dep=23;
   $numero_com=consultarUltimoNumeroComprobantePorTipo($omnisoftCOMPROBANTEINGRESO,$serial_age);
  //echo "numero_com=".$numero_com."<br>";
   $serial_com=insertarCabeceraComprobante($dblink,$fecha_com,$concepto_com,$total,'P',$numero_com,$omnisoftCOMPROBANTEINGRESO,$serial_usr,$serial_age,'ING');

   if ($serial_com==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;

   }

    $sCuentaCaja=omnisoftLeerParametro($dblink,"ctaCaja");
    $cuentaCaja=omnisoftLeerSerialCuentaContable($dblink,$sCuentaCaja);

    $sCuentaAnticiposClientes=omnisoftLeerParametro($dblink,"ctaCuentasXCobrar");
    $cuentaAnticiposClientes=omnisoftLeerSerialCuentaContable($dblink,$sCuentaAnticiposClientes);

      $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaCaja,$rsMonto->fields[0],0,'PAGOS VENCIDOS DE CLIENTES',$numero_com,$serial_dep);

   if ($serial_det==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;
   }

      $serial_det=insertarDetalleComprobante($dblink,$serial_com,$cuentaAnticiposClientes,0,$rsMonto->fields[0],'PAGOS VENCIDOS DE CLIENTES',$numero_com,$serial_dep);
   if ($serial_det==0) {
       echo "!Error: ". $dblink->ErrorMsg();
       return;
   }

    echo $resultData;
}


omnisoftContabilizarFacturacion();
//omnisoftContabilizarRecibosCobro();

?>
