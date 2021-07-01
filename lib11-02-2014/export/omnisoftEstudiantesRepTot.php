<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE GRADUACION DE ESTUDIANTES</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
	require('../adodb/adodb.inc.php');
	require('../../config/config.inc.php');
	global $DBConnection;
    $dblink = NewADOConnection($DBConnection);
	$serial_alu = $_REQUEST['serial_alu'];
	
	//COnsulta del Periodo Academico Inicial
	//Fechas
				$sqlAlumnos = " select 
								concat_ws(' ',apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu) 								as nombre
								,tipoIdentificacion_alu
								,codigoIdentificacion_alu
								,fecnac_alu
								,direcciondomic_alu
								,ciudadvive_alu
								,direcciontrabajo_alu
								,lugartrabajo_alu
								,mail_alu
								,mailuniv_alu
								,telefodomic_alu
								,telefotrabajo_alu
								,celular_alu
								,busRetorno_alu
								,conQuienVive_alu
								,fechaInscripcion_alu
								,fecharegistro_alu
								,fechamatricula_alu
								,observacion_alu
								,fechaObs_alu
								,foto_alu
								,estado_alu
								,paseObs_alu
								,cursoAprobado_alu
								,seccionAprobado_alu
								,id_alumno
								,proceso_alu
								,titulo_alu
								,fuenteInformacion_alu
								,intercambio_alu
								,serial_dde
								,nummaxcreditos_alu
								,codigo_alu
								,clave_alu
								,fecegreso_alu
								,fectitulo_alu
								,alu.serial_usr
								,cargo_alu
								,sueldo_alu
								,esposa_alu
								,notagradocol_alu
								,fechagraduacioncol_alu
								,modalidad_alu
								,nac.nombre_nac
								,prv.NOMBRE_PRV
								,pai.NOMBRE_PAI
								,ciu.NOMBRE_CIU
								,par.NOMBRE_PAR
								,sex.descripcion_sex
								,eci.nombre_eci
								,tra.empresa_tra
								,tra.cargo_tra
								,nombre_suc
								,nombre_caa
								FROM alumno alu 
								left join sucursal suc on suc.serial_suc = alu.serial_suc 
								left join nacionalidad nac on nac.serial_nac = alu.serial_nac 
								left join colegios col on col.serial_col = alu.serial_col 
								left join universidades as univ on univ.serial_univ = alu.serial_univ 
								left join sexo as sex on sex.serial_sex = alu.serial_sex 
								left join trabajos as tra on tra.serial_tra = alu.serial_tra 
								left join canton as can on can.serial_can = alu.serial_can 
								left join pais as pai on pai.serial_pai = alu.serial_pai 
								left join provincia prv  on prv.serial_prv = alu.serial_prv 
								left join ciudad ciu on ciu.serial_ciu = alu.serial_ciu 
								left join parroquia par on par.serial_par = alu.serial_par 
								left join estadocivil eci on eci.serial_eci = alu.serial_eci
								left join periodo per on per.serial_per = alu.serial_per
								left join informacionfuentes inf on inf.serial_inf = alu.serial_inf
								left join seccion sec on sec.serial_sec = alu.serial_sec
								left join calificacionequivalencia cale on cale.serial_cale = alu.serial_cale
								left join categoriaalumno caa on caa.serial_caa = alu.serial_caa
								where alu.serial_alu = ".$serial_alu;
			
	//echo "<br>".$sqlAlumnos."<br>";
	$rsAlumnos = $dblink->Execute($sqlAlumnos); 


//mssql_free_result($resultado);
//COnsulta del Periodo Academico Inicial

?>
<style type="text/css">
<!--
.style1 {font-size:14px;
			background:#CACACA;}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.style4 {background:#FFFFFF;}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
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
function imprimir() {
 print ();
/*  if (factory.printing.Print(true)){
    //factory.printing.WaitForSpoolingComplete()
	cerrarV();
	}*/
 }
</script>
<div id="boton" style="position:absolute; left:14px; top:57px; width:63px; height:16px; z-index:103" class="p1">
	<input type="submit" name="imprimir"  id="imprimir" value="Imprimir" class="b" onClick="hideboton(); imprimir(); showboton();">
</div>
<table width="100%" align="center">
	
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">FICHA ALUMNO </th>
  </tr>
  <tr >
    <th colspan="2">  
	
    </th>
  </tr>
  <tr>
    <th colspan="2"> 
    </th>
  </tr>
  <tr>
 
    <th width="26%" align="right">SEDE:</th>
    <th width="53%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script>
    <?php echo $rsAlumnos->fields['nombre_suc']; ?></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script> 
    <?php echo $rsAlumnos->fields['nombre']; ?></span></th>
  </tr>
  
</table>

<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" onClick="" onKeyUp="">

<!--------------------DATOS PERSONALES ------------------>
  <table width="100%"> 
  
  	<tr>
		<td colspan="8" align="center"> DATOS PERSONALES </td>
	</tr>
	<?php 
		while (!$rsAlumnos->EOF ){
	?>	
  	<tr>
		<td class="style1"> <? echo $rsAlumnos->fields['tipoIdentificacion_alu'].":"; ?></td>	
		<td class="style4"> <? echo $rsAlumnos->fields['codigoIdentificacion_alu']; ?></td>	
		<td class="style1"> Sexo: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['descripcion_sex']; ?></td>	
		<td class="style1"> Fecha de Nacimiento:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['fecnac_alu']; ?></td>	
		<td class="style1"> Estado Civil: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['nombre_eci']; ?></td>	
	</tr>
	
	<tr>
		<td class="style1"> Nacionalidad:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['nombre_nac']; ?></td>	
		<td class="style1"> Provincia: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['NOMBRE_PRV']; ?></td>	
		<td class="style1"> Ciudad:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['NOMBRE_CIU']; ?></td>	
		<td class="style1"> Parroquia: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['NOMBRE_PAR']; ?></td>	
	</tr>
		
	<tr>
		<td class="style1"> Mail Personal:</td>	
		<td colspan="3" class="style4"> <? echo $rsAlumnos->fields['mail_alu']; ?></td>	
		<td class="style1"> Mail Institucional : </td>	
		<td colspan="3" class="style4"> <? echo $rsAlumnos->fields['mailuniv_alu']; ?></td>	
	</tr>

  <?php
	  $rsAlumnos->MoveNext(); 
	  }
  ?>		  
  </table>
     <!-------------------- FIN DATOS PERSONALES ------------------>
   <p>&nbsp;</p>  
   <!-------------------- DATOS DOMICILIO ------------------>
      
  <table width="100%">
  	<tr>
		<td colspan="8" align="center"> DATOS DOMICILIO </td>
	</tr>
	<?php 
		$rsAlumnos->MoveFirst();
		while (!$rsAlumnos->EOF ){
	?>		
	
  	<tr>
		<td class="style1"> Ciudad: </td>	
		<td colspan="3" class="style4"> <? echo $rsAlumnos->fields['ciudadvive_alu']; ?></td>	
		<td class="style1"> Dirección: </td>	
		<td  colspan="3" class="style4"> <? echo $rsAlumnos->fields['direcciondomic_alu']; ?></td>			
	</tr>
	
	<tr>
		<td class="style1"> Teléfono:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['telefodomic_alu']; ?></td>	
		<td class="style1"> Celular: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['celular_alu']; ?></td>	
		<td class="style1"> bus de Retorno:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['busRetorno_alu']; ?></td>	
		<td class="style1"> Vive con: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['conQuienVive_alu']; ?></td>	
	</tr>			

  <?php
	  $rsAlumnos->MoveNext(); 
	  }
  ?>
  </table>
  
  <!-------------------- FIN DATOS DOMICILIO ------------------>
  
  
     <p>&nbsp;</p>  
   <!-------------------- DATOS DEL TRABAJO------------------>
      
  <table width="100%">
  	<tr>
		<td colspan="8" align="center"> DATOS DEL TRABAJO </td>
	</tr>
	<?php 
		$rsAlumnos->MoveFirst();
		while (!$rsAlumnos->EOF ){
	?>		
	
  	<tr>
		<td class="style1"> Lugar: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['lugartrabajo_alu']; ?></td>	
		<td class="style1"> Teléfono:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['telefotrabajo_alu']; ?></td>	
		<td class="style1"> Empresa </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['empresa_tra']; ?></td>	
		<td class="style1"> cargo:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['cargo_tra']; ?></td>		
	</tr>
	
	<tr>
		<td class="style1"> Dirección: </td>	
		<td  colspan="7" class="style4"> <? echo $rsAlumnos->fields['direcciontrabajo_alu']; ?></td>			
	</tr>			

  <?php
	  $rsAlumnos->MoveNext(); 
	  }
  ?>
  </table>
  
  <!-------------------- FIN DATOS DEL TRABAJO ------------------>

     <p>&nbsp;</p>  
   <!-------------------- OTROS DATOS------------------>
      
  <table width="100%">
  	<tr>
		<td colspan="8" align="center"> OTROS DATOS </td>
	</tr>
	<?php 
		$rsAlumnos->MoveFirst();
		while (!$rsAlumnos->EOF ){
	?>		
	<!--
fechaInscripcion_alu,fecharegistro_alu,fechamatricula_alu,observacion_alu,fechaObs_alu,foto_alu,estado_alu,paseObs_alu,cursoAprobado_alu,seccionAprobado_alu,id_alumno,proceso_alu,titulo_alu,nummaxcreditos_alu,fecegreso_alu,fectitulo_alu

,fuenteInformacion_alu,intercambio_alu,serial_dde								,codigo_alu,clave_alu,alu.serial_usr,cargo_alu,sueldo_alu,esposa_alu								,notagradocol_alu,fechagraduacioncol_alu,modalidad_alu


,pai.NOMBRE_PAI,ciu.NOMBRE_CIU,par.NOMBRE_PAR,sex.descripcion_sex,eci.nombre_eci,prv.NOMBRE_PRV,nac.nombre_nac,tra.empresa_tra,tra.cargo_tra1

-->
  	<tr>
		<td class="style1"> Fuente de Información: </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['fuenteInformacion_alu']; ?></td>	
		<td class="style1"> Intercambio:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['intercambio_alu']; ?></td>	
		<td class="style1"> Esposa(o) </td>	
		<td class="style4"> <? echo $rsAlumnos->fields['esposa_alu']; ?></td>	
		<td class="style1"> Modalidad de Estudio:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['modalidad_alu']; ?></td>		
		
	</tr>	
			

  <?php
	  $rsAlumnos->MoveNext(); 
	  }
  ?>
  </table>
  
  <!-------------------- FIN OTROS DATOS------------------>
  
  <!--
  <td class="style1"> Categoria:</td>	
		<td class="style4"> <? echo $rsAlumnos->fields['nombre_caa']; ?></td>		
  -->
</form>

</body>
</html>
           
		  