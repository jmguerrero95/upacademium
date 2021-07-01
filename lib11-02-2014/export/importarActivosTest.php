<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

/*
PARAMETRIZACION CLASES
CLASE					SERIAL
===============================
Muebles y Enseres		1
Equipo Médico			2
Software				3
Maquinaria				4
Vehículos				5
Equipo de Oficina		6
Equipo de Computación	7
Edificios				8
Robos					9
================================
*/
/*
PARAMETRIZACION DEPARTAMENTOS
serial_dep	departamento						Sede
=============================================================
3			CONSOLIDADO SI - Nivel Central		Nivel Central
8			CONSOLIDADO UIO - Quito				Quito
24			CONSOLIDADO GYE - Guayaquil			Guayaquil
244			CONSOLIDADO CUE - Cuenca			Cuenca
=============================================================
*/

/*
PARAMETRIZACION TIPO PARTE

SERIAL_TAP	DESCRIPCION_TAP
===========================
1	CPU
2	MONITOR
3	TECLADO
4	MOUSE
5	ACTIVO
6	COMPUTADOR
===========================
*/

/*
PARAMETRIZACION TIPO ACTIVO PRODUCTO
========================
1              CPU                
2              MONITOR            
3              TECLADO            
*/
$arrTipoActivo = 
	array(
		0 => "1",
		1 => "2",
		2 => "3"		
	);



/*VARIABLES GLOBALES*/
//Cabecera

$fecha_act = date("Y")."-".date("m")."-".date("d");	
$dcontable_cbf = 0;
$control_cbf = NULL;
$valor_dep = NULL;

//Detalle

$recordCab = array(); 
$recordDet = array(); 
$sqlCab = "
	SELECT
		* 
	FROM
		cabeceraactivo 
	WHERE
		serial_cbf = -1
";
$sqlDet = "
	SELECT
		* 
	FROM
		detalleactivo 
	WHERE
		serial_daf = -1
";

$rsCab = $dblink->Execute($sqlCab); 
$rsDet = $dblink->Execute($sqlDet); 
$dat = procesar($dblink);		
if($dat){
	$totDat = count($dat);
	for ($i=0;$i<$totDat;$i++){	
		//Insert Cabecera
		$recordCab['serial_cla'] = $dat[$i]['SERIAL_CLA']; // si esta parametrizado pero falta ligar en el sistema  a evelyn para todas la parametrizaciones primero hay que crear en sistema luego en excel
		$recordCab['serial_com'] = "3"; //campo descriptivo no se puede ligar con comprobantes : imprica cambio quitarle enlace de comprobante a activo para activos anteriores a 2010 3 es desconoc
		$recordCab['serial_pvd'] = "-99"; //campo descriptivo no se puede ligar con proveedores : imprica cambio quitarle enlace de prov a activo para activos anteriores a 2010 -99 proveedor general
		$recordCab['nombre_cbf'] = $dat[$i]['NOMBRE_DAF']; 
		$nombre_daf = $dat[$i]['NOMBRE_DAF'];
		$recordCab['nfactura_cbf'] = ""; //numero de factura ficticio esta ok
		$recordCab['fadquisicion_cbf'] = $dat[$i]['FREGISTRO_DAF'];// falta poner la fecha del activo 
		$recordCab['costo_cbf'] = $dat[$i]['VALOR_AF']; //
		$recordCab['codigo_cbf'] = $dat[$i]['CODIGO_BARRAS']; //
		$recordCab['codbarras_cbf'] = $dat[$i]['CODIGO_BARRAS']; //
		$recordCab['dcontable_cbf'] = $dcontable_cbf;
		$recordCab['observaciones_cbf'] = "";
		$recordCab['control_cbf'] = "SI"; //Por defecto poner todos si
		$recordCab['valordept_cbf'] = "";
		$insertSqlCab = $dblink->GetInsertSQL($rsCab,$recordCab);
		$dblink->Execute($insertSqlCab); 
		echo "<br>".$insertSqlCab."<br>";				
		$idDet = $dblink->Insert_ID(); 

		if($dat[$i]['SERIAL_CLA'] ==  "7" and $dat[$i]['Computadores'] = "Computador"){
			//echo "insertar tres veces<br>";
			for($j=0;$j<3;$j++){
				//Insert Detalle
				$recordDet["serial_cbf" ] = $idDet;
				$recordDet["serial_ubi" ] = "1"; // parametrizacion con uno desconocido el 1 es DESCONOCIDO
				$recordDet["serial_dep" ] = $dat[$i]['SERIAL_DEP']; // evelyn va a colocar de los departamentos que corresponde CONSOLIDADOS		
				$recordDet["serial_epl" ] = "15" ; // parametrizacion con uno desconocido hasta la toma fisica (DOCTORA es el serial_epl 15)
				$recordDet["serial_tap" ] = $arrTipoActivo[$j]; //poner por defecto a todos el 5 - ACTIVO excepto a computadores 6-
				$recordDet["nombre_daf" ] = $nombre_daf; 
				$recordDet["codigo_daf" ] = "" ;
				$recordDet["control_daf" ] = "";
				$recordDet["estado_daf" ] = ""; // poner un vacio
				$recordDet["serie_daf" ] = ""; //poner en vacio hasta la toma fisica
				$recordDet["tangible_daf" ] = "SI"; // poner por defecto todos si 
				$recordDet["marca_daf" ] = ""; // vacio hasta la toma fisica
				$recordDet["modelo_daf" ] = ""; // vacio hasta la toma fisica
				$recordDet["fdepreciacion_daf" ] = $dat[$i]['FREGISTRO_DAF'];  //poner fecha de adquisicion de activo ;
				$recordDet["depacumulada_daf" ] = ""; 
				$recordDet["fdepacumulada_daf" ] = "";
				$recordDet["tipodepreciacion_daf" ] = "";
				$recordDet["depinicial_daf" ] = "";
				$recordDet["observaciones_daf" ] = "TOMA FISICA";
				$recordDet["fregistro_daf" ] = $dat[$i]['FREGISTRO_DAF']; // fecha del computador para vienes en combo
				$recordDet["vidautil_daf" ] = ""; 
				$insertSqlDet = $dblink->GetInsertSQL($rsDet, $recordDet);
				$dblink->Execute($insertSqlDet);
				echo "<br>".$insertSqlDet."<br>";		 		
					
			}
		}else{
			//Insert Detalle
			$recordDet["serial_cbf" ] = $idDet;
			$recordDet["serial_ubi" ] = "1"; // parametrizacion con uno desconocido
			$recordDet["serial_dep" ] = $dat[$i]['SERIAL_DEP']; // evelyn va a colocar de los departamentos que corresponde CONSOLIDADOS		
			$recordDet["serial_epl" ] = 15; // parametrizacion con uno desconocido hasta la toma fisica
			$recordDet["serial_tap" ] = "5"; //poner por defecto a todos el 5 - ACTIVO excepto a computadores 6-
			$recordDet["nombre_daf" ] = $nombre_daf; 
			$recordDet["codigo_daf" ] = "" ;
			$recordDet["control_daf" ] = "";
			$recordDet["estado_daf" ] = ""; // poner un vacio
			$recordDet["serie_daf" ] = ""; //poner en vacio hasta la toma fisica
			$recordDet["tangible_daf" ] = "SI"; // poner por defecto todos si 
			$recordDet["marca_daf" ] = ""; // vacio hasta la toma fisica
			$recordDet["modelo_daf" ] = ""; // vacio hasta la toma fisica
			$recordDet["fdepreciacion_daf" ] = $dat[$i]['FREGISTRO_DAF'];  //poner fecha de adquisicion de activo ;
			$recordDet["depacumulada_daf" ] = ""; 
			$recordDet["fdepacumulada_daf" ] = "";
			$recordDet["tipodepreciacion_daf" ] = "";
			$recordDet["depinicial_daf" ] = "";
			$recordDet["observaciones_daf" ] = "";
			$recordDet["fregistro_daf" ] = $dat[$i]['FREGISTRO_DAF']; // fecha del computador para vienes en combo
			$recordDet["vidautil_daf" ] = ""; 
			$insertSqlDet = $dblink->GetInsertSQL($rsDet, $recordDet);
			$dblink->Execute($insertSqlDet);
			echo "<br>".$insertSqlDet."<br>";		 		
		}
   	}
}


# Inserta el registro en la base de datos
function procesar($dblink){
	$sqlMain = "
		SELECT
			* 
		FROM
			activofijotemp 
		ORDER BY
			id	
	";	
	//echo "<br>".$sqlMain."<br>";
	if($arr = $dblink->GetAll($sqlMain)){
		return $arr;
	}else{
		return false;
	}

}

/*
$valores = array();// representara un registro de la base de datos 

$valores['compania']  = "adsasd"; 
$valores['cod']       = ''; 
$valores['orden']     = ''; 
//... aqui los campos que faltan soy muy vago 
//... 
$valores['fecha_mod'] = '2006-06-16'; 
//parametros de la funcion GetInsertSQL (nombre_tabla,registro_de_valores) 
$insertSQL = $this->db->GetInsertSQL('articulos', $valores); 
$this->db->Execute($insertSQL); 
$id = $this->db->Insert_ID();// funciona correctamente !!!
*/
/*
# Codigo de prueba para UPDATE

$sql = "SELECT * FROM ADOXYZ WHERE id = 1"; 
# Selecciona el registro a actualizar

$rs = $conn->Execute($sql); # Executa la busqueda y obtiene el registro a actualizar.

$record = array(); # Inicializa el arreglo que contiene los datos a modificar

# Asignar el valor de los campos en el registro
# Observa que el nombre de los campos pueden ser mayusculas o minusculas
$record["firstname"] = "Caroline";
$record["LasTnAme"] = "Smith"; # Corrige el apellido de Carolina de Miranda a Smith

# Mandar como parametro el recordset y el arreglo conteniendo los datos a actualizar
# a la funcion GetUpdateSQL. Esta procesara los datos y regresara el enunciado sql del
# update necesario con clausula WHERE correcta.
# Si no se modificaron los datos no regresa nada.
$updateSQL = $conn->GetUpdateSQL($rs, $record);

$conn->Execute($updateSQL); # Actualiza el registro en la base de datos
$conn->Close();

*/
?>

