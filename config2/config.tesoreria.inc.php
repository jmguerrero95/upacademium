<?php
$NUMERODECIMALES=2;
$NUMERODECIMALESL=4;
$FILASPORPAGINA = 10;  //numero de filas desplegadas por pantalla

//--------------ARRAY PARA EL CAMPO tipo_pag DE LA TABLA PAGOS--------------
$TIPOPAGOS=array("R"=>"Rol de Pagos","X"=>"Décimo Tercero","V"=>"Décimo Cuarto","T"=>"Tesorería","A"=>"Anticipos");
//--------------------------------------------------------------------------

$CODIGOSDELIVA=array("0"=>"0","1"=>"10","2"=>"12","3"=>"14");//NO CAMBIAR PORQUE ESTA ESTATICO EN LA PROGRAMACION

$TIPOCUENTA = array("A"=>"Ahorros",
					"C"=>"Corriente",
					"V"=>"Virtual"
					);
					
				   
$SECUENCIALTRANSACCION=array("01"=>"Compra a proveedor con RUC",
				   			 "02"=>"Compra a proveedor Cédula de Indentidad",
				   			 "03"=>"Compra a proveedor Pasaporte",
				  			 "04"=>"Venta a Cliente con Ruc",
				  			 "05"=>"Venta a cliente Cedula de Identidad",
				  			 "06"=>"Venta a cliente Pasaporte",
				  			 "07"=>"Venta a cliente Consumidor Final",
				  			 "08"=>"Importación",
				  			 "09"=>"Exportación",
				  			 ); //Seleccion tipo de factura

$TIPOCOMPROBANTE=array("01"=>"Factura",
				   	   "02"=>"Nota o boleta de venta",
				   	   "03"=>"Liquidacion de compra de Bienes o Prestación de servicios",
					   "04"=>"Nota de credito",
					   "05"=>"Nota de debito",
					   "06"=>"Boletos o entradas a espectaculos publicos",
					   "08"=>"Tiquetes o vales emitidos por maquinas registradoras",
					   "10"=>"Comprobante de Venta autorizados en el Art. 10",
					   "11"=>"Pasajes expedidos por empresas de aviacion",
					   "12"=>"Documentos emitidos por instituciones financieras",
					   "13"=>"Documentos emitidos por companias de seguros",
					   "14"=>"Comprobantes emitidos por empresas de telecomunicaciones",
					   "15"=>"Comprobante de Venta emitido en el exterior",
					   "19"=>"Comprobantes de Pago de Cuotas o Aportes",
					   "20"=>"Documentos por Servicios Administrativos emitidos por Inst. del Estado",
					   "41"=>"Comprobante de Venta Emitido por Reembolso"

				   	   ); //Seleccion tipo de COMPROBANTE

$CREDITOTRIBUTARIO=array("00"=>"No aplica",
				   		 "01"=>"Compras netas de servicios y bienes distintos de inventarios y activos fijos que sustentan credito tributario",
				  		 "02"=>"Compras netas de servicios y bienes distintos de inventarios y activos fijos que NO sustentan credito tributario",
				  		 "03"=>"Compras netas de activos fijos que sustentan credito tributario",
				  		 "04"=>"Compras netas de activos fijos que NO sustentan credito tributario",
				  		 "05"=>"Liquidacion de gastos de viaje a nombre de empleados y no de la empresa",
				  		 "06"=>"Compras netas de inventarios que sustentan credito tributario",
				 		 "07"=>"Compras netas de inventarios que NO sustentan credito tributario",
						 "08"=>"Valor pagado o recibido por Reembolso de gastos",
						 "09"=>"Reembolso por gastos medicos y medicina prepagada"
				  		 ); //Seleccion tipo de factura

$APROBADO = array("A"=>"Si",
				  "N"=>"No"
				  ); //almacena si esta aprobado o no

$IVA='iva'; //código del Impuesto al valor agregado
include_once "../parametros/sCategoriaFlujoCaja.php";
$rscfc=sConsultarCategoriaFlujoCaja();
$i=0;
while(!$rscfc->EOF){
   $CATFLUJOCAJA[$rscfc->fields['codigo_cfc']]=$rscfc->fields['nombre_cfc'];   
   $rscfc->MoveNext();
}

$PORCENTAJESICE = array("0"=>"0% ICE",
						"1"=>"77.25% CIGARRILLOS RUBIOS",
						"2"=>"18.54% CIGARRILLOS NEGROS",
						"3"=>"30.9% CERVEZA",
						"4"=>"10.3% GASEOSAS",
						"5"=>"26.78% ALCOHOL",
						"6"=>"5.15% VEHICULOS MOTORIZADOS",
						"7"=>"10.3% AVIONES, TRICARES, YATES",
						"8"=>"15% TELECOMUNICACIONES",
						"9"=>"98% CIGARRILLOS RUBIOS",
						"10"=>"32% ALCOHOL"
						);

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
