
<?php
	session_start();
	?>
<?php
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
	    require('../../config2/config.inc.php');

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);		
	if(empty($_REQUEST['data2'])){
			$serial_car = "";
		}else{
			$serial_car = $_REQUEST['data2'];	
		}

$rsalumnos=$dblink->Execute($sql_alumnos);

//echo '</p>'.'</p>'.$sql_alumnos;

//Asignar valores a asignar a un arreglo, como tambien los nombres de los estudiantes

//$anios_retito=array();

$bandera=0;

?>
  <?PHP 
		
			if($_POST){
				//var_dump($_POST);
				$identificacion=$_POST["identificacion"];
				//var_dump($identificacion);
			
				if($identificacion==""){
				$msgidentificacion ="Ingrese el Numero de Cedula";
							}
				else {
					$alu="select serial_alu, nombre1_alu, nombre2_alu, apellidopaterno_alu, apellidomaterno_alu  from alumno where codigoIdentificacion_alu=".$identificacion;
					$retalu=$gConexionDB->Execute($alu);
					
					$serial_alu= $retalu->fields['serial_alu'];
					$nombre_alu=$retalu->fields['nombre1_alu']." ".$retalu->fields['nombre2_alu'];
					$apellido_alu=$retalu->fields['apellidopaterno_alu']." ".$retalu->fields['apellidomaterno_alu'];
										
												}
										}
	
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.error {

border:solid 4px red;}

-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
</head>

<body>
<?PHP
	$v=0;
	if(isset($_GET["seccion"]))$v=$_GET["seccion"];
	//echo $v;
$identificacion="";
	if(isset($_POST["identificacion"]))$identificacion=$_POST["identificacion"];
	
?>

<form id="reporte" name="reporte" method="post" action="">
<input type="hidden" name="serial_sec" id="serial_sec"  value="<? echo $_REQUEST['seccion'];?>"/>
<input type="hidden" name="sede" id="sede"  value="<? echo $_REQUEST['serial_suc']; ?>"/>
<input type="hidden" name="fecha_ini" id="fecha_ini"  value="<? echo $_REQUEST['fecha_ini']; ?>"/>
<input type="hidden" name="fecha_fin" id="fecha_fin"  value="<? echo $_REQUEST['fecha_fin']; ?>"/>
<input type="hidden" name="serial_car" id="serial_car"  value="<? echo $_REQUEST['data2']; ?>"/>
<input type="hidden" name="serial_alu" id="serial_alu"  value="<? echo $serial_alu; ?>"/>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
-->
</style>
<script>
function consolidar(){


	 var query='omnisoftNotasAlumnoPeriodo.php?serial_alu='+document.reporte.serial_alu.value+'&serial_sec='+document.reporte.serial_sec.value+'&serial_car='+document.reporte.serial_car.value;
       var attributes='width=1020,height=650,scrollbars=yes,resizable=no,toolbar=no,location=no,status=no,menubar=no';
           omnisoftNewWindow=window.open(query,'omnisoftConsultaNotas',attributes);
           if (window.focus) {omnisoftNewWindow.focus()}

}



function sede1(){
	//
	//alert(document.reporte.sede.value)
	
	document.reporte.action="omnisoftConsultaNotas.php"
	document.reporte.submit();
		//	document.reporte.sede.value
}

function hideboton() {
	document.getElementById('boton').style.visibility='hidden';  
}
//...........................................................
function showboton() {
	document.getElementById('boton').style.visibility='visible';
}
function imprimir() {
 print ();
/*  if (factory.printing.Print(true)){
    //factory.printing.WaitForSpoolingComplete()
	cerrarV();
	}*/
 }
 
</script>
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
		<td width="10%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
		<th colspan="2"><span class="style1"> NOTAS DE ESTUDIANTES </span></th>
  </tr>
  <tr >
    	<th colspan="2">&nbsp;</th>
  </tr>
  <tr>
   		<th colspan="2">  Desde el año: <? echo $fecha_ini;?> Hasta el año: <? echo $fecha_fin;?> </th>
  </tr>
  <tr>
		<th width="18%" align="right">SEDE:</th>
		<th width="61%" align="left"><span class='style3'><?php echo $_REQUEST['serial_sec'] ?>  <tr>
		<td colspan="3" bgcolor="#FFFFFF"><div align="center"><strong>Filtros </strong></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  >
		<table width="697" border="1">
      	<tr>
		
    <!-----------IDENTIFICACIÓN-------------------------------------------------------->
	
	<td width="93">Identificación:</td>
	
    <td width="93"> <input type="text" name="identificacion" id="identificacion" value="<?PHP echo $identificacion; ?>" /></td>
	</td>       
		<td width="93">Seccion</td>
	  <td width="93">
	       <select name="seccion" onchange="sede1()" id="seccion" >
            <option value=""></option>
            <?php 
			$facultad="SELECT
								sec.serial_sec,
								 sec.nombre_sec as nombre
								  
								FROM
								 malla       AS maa,
								 alumnomalla AS ama, 
								seccion as sec
								WHERE
								 maa.serial_maa = ama.serial_maa AND
								 maa.serial_sec = sec.serial_sec and
								 ama.serial_alu =".$serial_alu."  
								GROUP BY
								 sec.serial_sec
								ORDER BY
								 nombre";
								$retfacultad=$gConexionDB->Execute($facultad);	
			
				while (!$retfacultad->EOF ){ 
				if($_REQUEST['seccion']==$retfacultad->fields['serial_sec']){?>
	            <option value="<? echo $_REQUEST['seccion'];?>" selected="selected"> <? echo $retfacultad->fields['nombre']; ?> </option>
			<?php 	}else {?>	
            <option value="<?php echo $retfacultad->fields['serial_sec']; ?>" > <? echo $retfacultad->fields['nombre']; ?> </option>
            <?php }
				$retfacultad->MoveNext(); 
			}
			?>
        </select>

	  <td width="93">Carrera</td>
		<td width="93">
		
		<?				
		if(!empty($_REQUEST['seccion'])){
					$carrera1= "SELECT
										 maa.serial_car,
										 nombre_car AS nombre 
										FROM
										 malla       AS maa,
										 alumnomalla AS ama,
										 carrera     AS car 
										WHERE
										 maa.serial_maa = ama.serial_maa AND
										 maa.serial_car=car.serial_car AND
										 ama.serial_alu = ".$serial_alu. " AND
										 maa.serial_sec = ".$_REQUEST['seccion']."
										GROUP BY
										 maa.serial_car 
										ORDER BY
										 nombre";
						$retcarrera=$gConexionDB->Execute($carrera1);
						//echo $carrera1;
				}
					
			?>
    <select name="data2" onchange="sede1()">		  

          <option value=""> </option>
		  
          <? if(!empty($retcarrera)){
		  while (!$retcarrera->EOF ){ 
		  if ($_REQUEST['data2']==$retcarrera->fields['serial_car']){?>
		            <option value="<? echo $retcarrera->fields['serial_car']; ?>" selected="selected"> <? echo $retcarrera->fields['nombre']; ?> </option>
		<? } else { ?>
          <option value="<? echo $retcarrera->fields['serial_car']; ?>"> <? echo $retcarrera->fields['nombre']; ?> </option>
          <? } $retcarrera->MoveNext(); 
			} }?>
        </select>      </td>
</td>
   <td align="center"><input type="button" value="Consultar" onclick="consolidar()" /></td> 
  </p>
  </tr>
  </table>
 
</form>
 
</body>
</html>
 <p><h1><b>NOMBRE DEL ESTUDIANTE: </b></h1></p>
 <p><?php echo  $nombre_alu." ". $apellido_alu;?></p>

