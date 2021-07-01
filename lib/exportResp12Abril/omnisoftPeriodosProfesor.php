<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO PROFESOR POR PERIODO</title>
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
 		$fecha_ini=$periodo_ini[1];
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];
		
		if($serial_per_ini==$serial_per_fin){
			$periodoigual = " periodo.serial_per=".$serial_per_ini." ";
		}else{
			$periodoigual = " fecini_per >='".$fecha_ini."' and fecini_per<'".$fecha_fin."' ";
		}
		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
			//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$fecha_act = date("Y")."-".date("m")."-".date("d");	
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per between '".$fecha_ini."' and '".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");
// and intensivo_per='".$tipo."' 
//COnsulta 
//echo "<br>".$inicio_carrera;	
//,carrera  --, nombre_car --and facultad.serial_fac=carrera.serial_fac
$sql_profesores="select distinct (hrr.SERIAL_EPL) as emp,DOCUMENTOIDENTIDAD_EPL, concat_ws(' ',epl.APELLIDO_EPL, epl.NOMBRE_EPL) nombre,EMAIL_EPL, FECHAINGRESO_EPL,
  DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad, FECHANACIMIENTO_EPL as fnacimiento,
SEXO_EPL,niv.nombre_nac,formaContrato_epl,nombre_fac

from  area,facultad,materia,periodo,empleado as epl, horario as hrr
left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
left join nivelacademico as niv on foa.serial_nac = niv.serial_nac
 where   
hrr.serial_epl=epl.serial_epl
and materia.serial_mat=hrr.serial_mat
and area.serial_are=materia.serial_are
and area.serial_fac=facultad.serial_fac
and periodo.serial_per=hrr.serial_per
and ".$periodoigual."
and estado_hrr='ACTIVO'
and periodo.serial_suc=".$serial_suc."
and periodo.serial_sec=".$serial_sec."
order by nombre";

echo $sql_profesores;
$rsprofesores=$dblink->Execute($sql_profesores); 


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
    <th colspan="2">PROFESORES TITULADOS POR A&Ntilde;OS DE SERVICIO Y POR UNIDAD ACADEMICA </th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde <? echo $rsPeriodo_ini->fields['fechas'];?>&lt;=&gt;desde <? echo $rsPeriodo_fin->fields['fechas'];?> </th>
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
          <th width="1%"  style="">Nro.</th>
          <th width="5%">Identificación</th>
		  <th width="20%">Profesor </th>
		  <th width="10%">Correo</th>
		  <th width="10%">Sexo</th>
		  <th width="10%">Fnac</th>
		  <th width="10%">Edad</th>
		  <th width="10%">Fecha de Ingreso </th>
		  <th width="10%">Tiempo(Años)</th>
		  <th width="10%">Nivel Acad&eacute;mico</th>
		  <th width="10%">Titulados/Contratados</th>
		  <th width="10%">Facultad</th>
        </tr>
        
		<? $i=1;
			
			while (!$rsprofesores->EOF) {
			 
			   //echo $alumnos."<br>"; 
			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['DOCUMENTOIDENTIDAD_EPL'];?></span></td>
				<td nowrap="nowrap"><span class="style2"><? echo $rsprofesores->fields['nombre'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['EMAIL_EPL'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['SEXO_EPL'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['fnacimiento'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['edad'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['FECHAINGRESO_EPL'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['tiempo'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['nombre_nac'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['formaContrato_epl'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['nombre_fac'];?></span></td>
				</tr>
			
		<?
		$i++;
				$rsprofesores->MoveNext();
		}
		?>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>

</body>
</html>