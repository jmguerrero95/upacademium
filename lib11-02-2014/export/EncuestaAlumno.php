<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #003366;
}
.style2 {
	color: #003366;
	font-weight: bold;
}
.style3 {color: #003366}
-->
</style>
</head>
<body background="../../images/upa.jpg">			
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 
if(isset($HTTP_POST_VARS['Guardar'])){	
   $sql1="INSERT
INTO
     actualizaciongraduados(
        cedula_agra,
        nombres_agra,
        apellidos_agra,
        telefonoCasa_agra,
        telefonoCel_agra,
        direccionDomiciliaria_agra,
        email_agra,
        lugarTrabajo_agra,
		direccionTrabajo_agra,
		correoInstitucional_agra,
        telefonoOficina_agra,
        cargoCompania_agra,
        nombreContactoenAusencia,
        telefonoContacto_agra,
        celularContacto_agra
    )
VALUES
    ('".$HTTP_POST_VARS['cedula_agra']."','".$HTTP_POST_VARS['nombres_agra']."','".$HTTP_POST_VARS['apellidos_agra']."','".$HTTP_POST_VARS['telefonoCasa_agra']."','".$HTTP_POST_VARS['telefonoCel_agra']."','".$HTTP_POST_VARS['direccionDomiciliaria_agra']."','".$HTTP_POST_VARS['email_agra']."','".$HTTP_POST_VARS['lugarTrabajo_agra']."','".$HTTP_POST_VARS['direccionTrabajo_agra']."','".$HTTP_POST_VARS['correoInstitucional_agra']."','".$HTTP_POST_VARS['telefonoOficina_agra']."','".$HTTP_POST_VARS['cargoCompania_agra']."','".$HTTP_POST_VARS['nombreContactoenAusencia']."','".$HTTP_POST_VARS['telefonoContacto_agra']."','".$HTTP_POST_VARS['celularContacto_agra']."')";
//die("Los datos han sido introducidos satisfactoriamente");
}
//$rsSql=$dblink->Execute($sql1);


?>

<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px}

-->
</style>
<script>
function hideboton() {
	document.getElementById('boton').style.visibility='hidden';  
}
//...........................................................
function showboton() {
	document.getElementById('boton').style.visibility='visible';
}
//Función que permite solo Números
function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
//funcion que permite solo letras
function txNombres() {
 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
  event.returnValue = false;
}
 
function visualizar(){
	//
	var cedula="<? 
	echo "Holaaaaaa";
	//echo $HTTP_POST_VARS["cedula_agra"]; ?>"; 
alert(cedula);
}
</script>

<form name="reporte" method="post" action="EncuestaAlumno.php">


<table width="56%" border="0" align="center" bgcolor="#FFFFFF" >
  <tr bgcolor="#FFFFFF">
    <td height="95" colspan="4" bgcolor="#FFFFFF"><table width="100%" border="0">
      
      <tr bgcolor="#FFFFFF">
        <th width="77%" ><span class="style1">DATOS PERSONALES </span></th>
          <th width="23%" ><img src="../../images/themes/csg/logo.jpg" width="195" height="88" /></th>
	    </tr>
      
    </table></td>
    </tr>
  
  <tr>
    <td width="25%" bgcolor="#FFFFFF"><strong><span class="style3">C&Eacute;DULA:</span></strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><label>
      <input type="text" name="cedula_agra" id="cedula_agra"size="10" maxlength="20" />
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong><span class="style3">NOMBRES:</span></strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="nombres_agra" id="nombres_agra"size="50" maxlength="100" onkeypress="txNombres()" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong><span class="style3">APELLIDOS:</span></strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="apellidos_agra"size="50" id="apellidos_agra" maxlength="100" onkeypress="txNombres()" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong><span class="style3">TEL&Eacute;FONO DE CASA: </span></strong></td>
    <td width="25%" bgcolor="#FFFFF"><input type="text" name="telefonoCasa_agra"size="15" id="telefonoCasa_agra" maxlength="20" onkeypress="ValidaSoloNumeros()"/></td>
	<td width="24%" bgcolor="#FFFFFF"><strong>TEL&Eacute;FONO CELULAR: </strong></td>
	<td width="26%" bgcolor="#FFFFF"><input type="text" name="telefonoCel_agra"size="10" id="telefonoCel_agra" maxlength="20" onkeypress="ValidaSoloNumeros()" /></td>
  </tr>
    <tr>
    <td bgcolor="#FFFFFF"><strong><span class="style3">DIRECCI&Oacute;N DOMICILIARIA</span>: </strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="direccionDomiciliaria_agra"size="80" id="direccionDomiciliaria_agra" maxlength="150" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>CORREO ELECTR&Oacute;NICO: </strong></td>
    <td colspan="3" bgcolor="#FFFFF"><input type="text" name="email_agra"size="50" id="email_agra" maxlength="100" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>LUGAR DE TRABAJO:</strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="lugarTrabajo_agra"size="80" id="lugarTrabajo_agra" maxlength="100" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>DIRECCI&Oacute;N DEL TRABAJO: </strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="direccionTrabajo_agra"size="80" id="direccionTrabajo_agra" maxlength="100" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>CORREO INSTITUCIONAL </strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="correoInstitucional_agra"size="50" id="correoInstitucional_agra" maxlength="100" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>TEL&Eacute;FONO DE OFICINA:</strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="telefonoOficina_agra"size="15" id="telefonoOficina_agra" maxlength="20" onkeypress="ValidaSoloNumeros()"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>CARGO EN COMPA&Ntilde;&Iacute;A:</strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="cargoCompania_agra"size="80" id="cargoCompania_agra" maxlength="150" /></td>
  </tr>
  <tr>
    <td bgcolor="#003366"><strong>NOMBRE DE CONTACTO EN CASO DE AUSENCIA: </strong></td>
    <td colspan="3" bgcolor="#FFFFFF"><strong>
      <input type="text" name="nombreContactoenAusencia"size="80" id="nombreContactoenAusencia" maxlength="150" />
    </strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><strong>TEL&Eacute;FONO DE CONTA
      CTO</strong>:</td>
    <td bgcolor="#FFFFFF"><input type="text" name="telefonoContacto_agra"size="15" id="telefonoContacto_agra" maxlength="20" onkeypress="ValidaSoloNumeros()"/></td>
	<td bgcolor="#003366"><strong>CELULAR DE CONTACTO</strong></td>
	<td bgcolor="#FFFFFF"><input type="text" name="celularContacto_agra"size="15" id="celularContacto_agra" maxlength="20" onkeypress="ValidaSoloNumeros()"/></td>
  </tr>
  
  <tr>
    <td height="47" bgcolor="#FFFFFF"><span class="p1" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103">
     
    </span> <input type="submit" name="Imprimir"  id="Imprimir" value="Imprimir" class="b" onclick= "visualizar()"/></td>
	<input type="submit" name="Guardar" Onclick="visualizar();confirm('Son correctos los datos?');" value="Guardar"/>
		
  </tr>
</table>
</form>

</body>
</html>
<?php

if(isset($HTTP_POST_VARS['Guardar'])){
        
?><div align="justify" style="border:0px solid #B10; margin: 10px auto; height: 280px; width: 500px" > 
<?php echo "<b>CI:</b> " . $HTTP_POST_VARS["cedula_agra"] ."<br>"."<b>Nombres: " .$HTTP_POST_VARS["nombres_agra"]." ".$HTTP_POST_VARS["apellidos_agra"]."<br>".
						" <b>Teléfono Casa: " . $HTTP_POST_VARS["telefonoCasa_agra"] ."<br>"." <b>Teléfono Celular: " . $HTTP_POST_VARS["telefonoCel_agra"] ."<br>";
						
	  echo "<b>Dirección domiciliaria:</b> " . $HTTP_POST_VARS["direccionDomiciliaria_agra"] ."<br>"."<b> Correo Electrónico: " .$HTTP_POST_VARS["email_agra"]."<br>"." <b>Lugar de Trabajo: " .$HTTP_POST_VARS["lugarTrabajo_agra"]."<br>".
						"<b>Direccion de Trabajo: " . $HTTP_POST_VARS["direccionTrabajo_agra"] ."<br>"."<b>Correo Institucional: " . $HTTP_POST_VARS["correoInstitucional_agra"] ."<br>";
	
	echo "<b>Teléfono Oficina:</b> " . $HTTP_POST_VARS["telefonoOficina_agra"] ."<br>"."<b>Cargo en Compañía: " .$HTTP_POST_VARS["cargoCompania_agra"]." ".$HTTP_POST_VARS["nombreContactoenAusencia"]."<br>".
						"<b> Teléfono de Contacto: " . $HTTP_POST_VARS["telefonoContacto_agra"] ."Celular: " . $HTTP_POST_VARS["celularContacto_agra"] ."<br>";				
						?> 


<div>

<?php } ?>