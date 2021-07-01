<?php 
//MPC: ultima modificacion si selecciona el mismo periodo inicial 
//     y final se consulte por el serial del periodo no por fechas
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {color: #999999}
.style2 {color: #000000}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		//echo "periodo_inicial:".$_GET['fecha_ini']."<br>";
		
		$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];
		//echo "<br>".$serial_per_ini."<br>";		
 		$fecha_ini=$periodo_ini[1];
		if(strlen($serial_per_ini)<=0){
			echo "<br><center><strong>Error: Seleccione correctamente los parametros para generar el reporte...</strong></center><br>";
			exit(1);
		}
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];
		if ($serial_per_ini==$serial_per_fin){
			$peri = "and periodo.serial_per=".$serial_per_ini;
		}else{
			$peri = "and fecini_per >='".$fecha_ini."' and  fecini_per<='".$fecha_fin."'";
		}

		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
		$chkRegistros=$_GET['chkRegistros'];
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");


$sql_alumnos="
SELECT 
    alumno.serial_alu
    ,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre
    ,codigoIdentificacion_alu as identificacion 
	,concat_ws(' / ',telefodomic_alu, celular_alu) as telefono 
	,mailuniv_alu as correo
	,descripcion_sex 
FROM
    alumno, periodo,sucursal,sexo 
WHERE 
    alumno.serial_per = periodo.serial_per
    and alumno.serial_suc = sucursal.serial_suc
	and alumno.serial_sex = sexo.serial_sex
    and proceso_alu = 'INSCRIPCION'
	and periodo.serial_sec = ".$serial_sec."
	and periodo.serial_sec = ".$serial_sec."
    and alumno.serial_suc = ".$serial_suc."    
    ".$peri."
ORDER BY
    nombre
";

$rsAlumnos=$dblink->Execute($sql_alumnos); 
$numReg = $rsAlumnos->RecordCount();
if($numReg<=0){
	$msg = "
	<br>
	<center>
	<strong>
			Alerta: No se hallaron registros con la seleccion...
	</strong>
	</center>
	<br>
	";
	echo $msg;
		exit;
}
//echo "<br>NUMERO DE REGISTROS:".$hell;


//echo $sql_alumnos;
//Asignar valores a asignar a un arreglo, como tambien los nombres de los estudiantes

//mssql_free_result($resultado);
//COnsulta del Periodo Academico Inicial
$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per_ini);

$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas   from periodo where serial_per=".$serial_per_fin);
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
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
<BR>
<BR>
<BR>
<BR>
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">ALUMNOS INSCRITOS </span></th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde <? echo $rsPeriodo_ini->fields['fechas'];?>&lt; MENOR AL PERIODO desde <? echo $rsPeriodo_fin->fields['fechas'];?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">SEDE:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="1%" bgcolor="#999999"  style=""><span class="style2">Nro.</span></th>
          <th width="5%" bgcolor="#999999"><span class="style2">Identificación</span></th>
		  <th width="20%" bgcolor="#999999"><span class="style2">Alumnos </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Teléfono </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Correo </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Sexo </span></th>
		</tr>
        
		<? 
			$i=1;
			while(!$rsAlumnos->EOF){ 

			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				
				<td NOWRAP ><span class="style2"><? echo $rsAlumnos->fields['identificacion'];?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsAlumnos->fields['nombre'];?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsAlumnos->fields['telefono'];?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsAlumnos->fields['correo'];?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsAlumnos->fields['descripcion_sex'];?></span></td>
				
				</tr>
				
			<? 
			$i++;
			$rsAlumnos->MoveNext();		
			}
		?>
		
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>