<?php
$NUMERODECIMALES=2;
$NUMERODECIMALESL=4;
$FILASPORPAGINA = 10;  //numero de filas desplegadas por pantalla
$TIPODOCUMENTO = array("C"=>"Cedula",
					   "R"=>"Ruc"
					   ); //tipo de Documentos que se pueden almacenar
$NATURALEZA = array("N"=>"Natural",
					"J"=>"Jurídico"
					); //tipo de empresa
$DEPRECIABLE = array("S"=>"Si",
					 "N"=>"No"
					 ); //tipo de rubro que puede ser o no depreciable 
$PORC_RETENCION = array("0"=>"0",
						"1"=>"30",
						"2"=>"70",
						"3"=>"100"
						); //tipos de porcentajes de retención

$TIPOSRETENCION = array ("IVA"=>"IVA",
						 "IRF"=>"IRF",
						 "IRFA"=>"IRFA",
						 "IRFB"=>"IRFB",
						 "IRFH"=>"IRFH",
						 "IRFS"=>"IRFS"
						 );// TIPOS DE RETNCION

$TIPORUBRO = array("A"=>"Activo Fijo",
				   "M"=>"Material Fungible",
				   "D"=>"Activos Diferidos"
				   ); //tipos de rubro

$SINO = array("1"=>"Si",
			  "0"=>"No"
			  ); //Seleccion tipo si o no

$SECUENCIALTRANSACCION=array("01"=>"Compra a proveedor con RUC",
				   "02"=>"Compra a proveedor Cédula de Indentidad",
				   "03"=>"Compra a proveedor Pasaporte",
				   "04"=>"Venta a Cliente con Ruc",
				   "05"=>"Venta a cliente Cédula de Identidad",
				   "06"=>"Venta a cliente Pasaporte",
				   "07"=>"Venta a cliente Consumidor Final",
				   "08"=>"Importación",
				   "09"=>"Exportación",
				   ); //Seleccion tipo de factura

$TIPOCOMPROBANTE=array("01"=>"Factura",
				   	   "02"=>"Nota o boleta de venta",
				   	   "03"=>"Liquidación de compra de Bienes o Prestación de servicios",
					   "04"=>"Nota de crédito",
					   "05"=>"Nota de débito",
					   "06"=>"Boletos o entradas a espectáculos públicos",
					   "08"=>"Tiquetes o vales emitidos por máquinas registradoras",
					   "10"=>"Comprobante de Venta autorizados en el Art. 10",
					   "11"=>"Pasajes expedidos por empresas de aviación",
					   "12"=>"Documentos emitidos por instituciones financieras",
					   "13"=>"Documentos emitidos por compañías de seguros",
					   "14"=>"Comprobantes emitidos por empresas de telecomunicaciones",
					   "15"=>"Comprobante de Venta emitido en el exterior",
					   "19"=>"Comprobantes de Pago de Cuotas o Aportes",
					   "20"=>"Documentos por Servicios Administrativos emitidos por Inst. del Estado",
				   	   ); //Seleccion tipo de COMPROBANTE

$CREDITOTRIBUTARIO=array("00"=>"No aplica",
				   		 "01"=>"Crédito Tributario para declaración de IVA",
				  		 "02"=>"Costo o Gasto para declaración de IR",
				  		 "03"=>"Activo Fijo - Crédito Tributario para declaración de IVA",
				  		 "04"=>"Activo Fijo - Costo o Gasto para declaración de IR",
				  		 "05"=>"Liquidación Gastos de Viaje, hospedaje y alimentación Gastos IR",
				  		 "06"=>"Inventario - Crédito Tributario para declaración de IVA",
				 		 "07"=>"Inventario - Costo o Gasto para declaración de IR",
				  		 ); //Seleccion tipo de factura
$IVA='iva'; //código del Impuesto al valor agregado

$APROBADO = array("A"=>"Si",
				  "N"=>"No"
				  ); //almacena si esta aprobado o no

$BUSQUEDAMF = array("1"=>"Rubro",
					"2"=>"Item",
					"3"=>"Material Fungible"
					);

$BUSQUEDAAC = array("1"=>"Ubicación",
					"2"=>"Custodio",
					"3"=>"Estado",
					"4"=>"Rubro",
					"5"=>"Item",
					"6"=>"Activo Fijo");

$BUSQUEDAEGR = array("1"=>"Rubro",
					 "2"=>"Item",
					 "3"=>"Material Fungible",
					 "4"=>"Departamento",
					 "5"=>"Empleado"
					 );

$IVA='iva'; //código del Impuesto al valor agregado
include "../parametros/sCategoriaFlujoCaja.php";
$rscfc=sConsultarCategoriaFlujoCaja();
$i=0;
while(!$rscfc->EOF){
   $CATFLUJOCAJA[$rscfc->fields['codigo_cfc']]=$rscfc->fields['nombre_cfc'];   
   $rscfc->MoveNext();
}

/*$CATFLUJOCAJA= array ("1"=>"TAXES",
					  "2"=>"FEES",
					  "3"=>"DIESEL GASOLINA",
					  "4"=>"CHEMICALS",
					  "5"=>"CATERING",
					  "6"=>"SECURITY",
					  "7"=>"VEHICLES MANTEINANCE & MATERIALS",
					  "8"=>"MANTEINANCE & OPERATION SERVICES",
					  "9"=>"MANTEINANCE & OPERATION MATERIALS",
					  "10"=>"FLIGHT TRANSPORTATION",
					  "11"=>"COMMUNICATIONS",
					  "12"=>"SELLING EXPENSES",
					  "13"=>"IT EQUIPEMENT & SOFTWARE",
					  "14"=>"PAYROLL COL",
					  "15"=>"PAYROLL 3º PARTY",
					  "16"=>"PROFESSIONAL SERVICES",
					  "17"=>"FINANCIAL & ADMIN SERVICES  (CONSULTORES)",
					  "18"=>"CUSTOMS & TRANSPORT",
					  "19"=>"SOTE",
					  "20"=>"RODA",
					  "21"=>"OFFICE EXPENSES",
					  "22"=>"WORKOVER & COMPL",
					  "23"=>"DRILLING",
					  "24"=>"SEISMIC",
					  "25"=>"VARIOUS / MISELLANEOUS",
					  "26"=>"P P & E",
					  "27"=>"COMMUNITY RELATIONS",
					  "28"=>"INSURANCE",
					  "29"=>"PRODUCTION FACILITIES",
					  "30"=>"FINANCIAL & BANK EXPENCES",
					  "31"=>"AEC",
					  "35"=>"FIDUCIA SISMICA",
					  "36"=>"FIDUCIA PERFORACION",
					  "37"=>"TUBERIA Y CABEZALES",
					  );*/
?>