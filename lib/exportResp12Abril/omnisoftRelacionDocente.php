<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
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
		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
			//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)


if ($serial_suc!='TODOS')
	$sucursal= "and per.serial_suc = ".$serial_suc;	
else
	$sucursal= "";
	
		
	
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per between '".$fecha_ini."' and '".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");

//COnsulta del Periodo Academico Inicial
$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per_ini);

$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas   from periodo where serial_per=".$serial_per_fin);

//PROFESORES EN UN RANGO DE PERIODOS
$total_profesores="select COUNT(DISTINCT epl.DOCUMENTOIDENTIDAD_EPL) as profesores
from horario as hrr, empleado as epl, periodo as per
where hrr.serial_epl = epl.serial_epl
and hrr.serial_per=per.serial_per
and TIPOEMPLEADO_EPL='PROFESOR'
and per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."' 
".$sucursal." 
AND PER.SERIAL_SEC = ".$serial_sec;
$rsTotal_profesores=$dblink->Execute($total_profesores);

echo $total_profesores;

//total Docentes
/*$todoDocente = "select COUNT(DISTINCT hrr.SERIAL_EPL) as profesores 
from horario as hrr, empleado as epl, periodo as per 
where hrr.serial_epl = epl.serial_epl 
and hrr.serial_per=per.serial_per 
and per.fecini_per between '1998-06-29' and '2002-07-08' 
and per.serial_suc = 2 
AND PER.SERIAL_SEC = 1 
and TIPOEMPLEADO_EPL='PROFESOR'";
$rsTodoDocente=$dblink->Execute($todoDocente);*/

//NUMERO DE PROFESORES TIEMPO COMPLETO
$total_profesores_completo="select COUNT(DISTINCT SERIAL_EPL) as profesoresTC from empleado where DOCUMENTOIDENTIDAD_EPL in (select DOCUMENTOIDENTIDAD_EPL
from horario as hrr, empleado as epl, periodo as per
where hrr.serial_epl = epl.serial_epl
and hrr.serial_per=per.serial_per
aand per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."' 
".$sucursal." 
AND PER.SERIAL_SEC = ".$serial_sec.") 
and FORMACONTRATO_EPL like 'TIEMPO COMPLETO'";

$rsTotal_profesores_completo=$dblink->Execute($total_profesores_completo);
//echo $total_profesores_completo;

$total_profesores_NO_adm = "select COUNT(DISTINCT hrr.SERIAL_EPL) as profesores
from horario as hrr, empleado as epl, periodo as per
where hrr.serial_epl = epl.serial_epl
and hrr.serial_per=per.serial_per
and per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."' 
".$sucursal."
AND PER.SERIAL_SEC = ".$serial_sec."
and TIPOEMPLEADO_EPL='PROFESOR'
and DOCUMENTOIDENTIDAD_EPL not in (select DOCUMENTOIDENTIDAD_EPL
from empleado
where TIPOEMPLEADO_EPL<>'PROFESOR')";
$rsTotal_profesores_NO_adm=$dblink->Execute($total_profesores_NO_adm);
//echo $total_profesores_NO_adm;

// profesores que  no trabajan en la universidad
$total_profesores_completo_NO_adm="select COUNT(DISTINCT hrr.SERIAL_EPL) as profesores
from horario as hrr, empleado as epl, periodo as per
where hrr.serial_epl = epl.serial_epl
and hrr.serial_per=per.serial_per
and per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."' 
".$sucursal." 
AND PER.SERIAL_SEC = ".$serial_sec."
and TIPOEMPLEADO_EPL='PROFESOR'
and FORMACONTRATO_EPL like 'TIEMPO COMPLETO'
and DOCUMENTOIDENTIDAD_EPL not in (select DOCUMENTOIDENTIDAD_EPL
from empleado
where TIPOEMPLEADO_EPL<>'PROFESOR')";
$rsTotal__profesores_completo_NO_adm=$dblink->Execute($total_profesores_completo_NO_adm);


// numero de estudiante matriculados
$alumnos="select count(distinct mmat.SERIAL_ALU) as alumnos
from materiamatriculada as mmat, detallemateriamatriculada as dmat, periodo as per, alumno as alu
where mmat.SERIAL_MMAT = dmat.serial_mmat
and per.serial_per = mmat.SERIAL_PER
and mmat.SERIAL_ALU = alu.serial_alu
and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')  
and per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."' 
".$sucursal." 
and mmat.SERIAL_SEC = ".$serial_sec."";
$rsAlumnos=$dblink->Execute($alumnos);

//echo $alumnos;


//Personal administrativo
$administrativos="select count(*) as administrativos
from empleado
where categoria_epl = 'Administrativo'
".$sucursal." 
and ESTADO_EPL = 'ACTIVO'";

$rsAdministrativos=$dblink->Execute($administrativos);
//personal Directivos
$directores="select count(*) as directores
from empleado
where categoria_epl = 'Director'
".$sucursal." 
and ESTADO_EPL = 'ACTIVO'";

$rsDirectores=$dblink->Execute($directores);

//administrativos que no son docentes
$administrativos_no_profesores = "select count(*) as administrativos from empleado where categoria_epl = 'Administrativo' 
and SERIAL_SUC = ".$serial_suc."
and ESTADO_EPL = 'ACTIVO'
and DOCUMENTOIDENTIDAD_EPL not in (select DOCUMENTOIDENTIDAD_EPL from empleado where TIPOEMPLEADO_EPL like 'PROFESOR'
order by DOCUMENTOIDENTIDAD_EPL)";
$rsAdministrativos_no_profesores=$dblink->Execute($administrativos_no_profesores);

//echo $administrativos_no_profesores;

//directores no profesores
$directores_no_profesores = "select count(*) as directores from empleado where categoria_epl = 'Director' 
and SERIAL_SUC = ".$serial_suc."
and ESTADO_EPL = 'ACTIVO'
and DOCUMENTOIDENTIDAD_EPL not in (select DOCUMENTOIDENTIDAD_EPL from empleado where TIPOEMPLEADO_EPL like 'PROFESOR'
order by DOCUMENTOIDENTIDAD_EPL)";


$empleados = "select count(distinct epl.SERIAL_EPL) as empleados from empleadorolpagos as erol, empleado as epl
where erol.SERIAL_EPL = epl.SERIAL_EPL
and epl.ESTADO_EPL = 'ACTIVO'
and epl.SERIAL_SUC = ".$serial_suc;
$rsEmpleados=$dblink->Execute($empleados);

?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
.style4 {font-size:14px; font-family:Arial, Helvetica, sans-serif}
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
    <td width="38%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">Relación Docentes </th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS: <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde: <? echo $fecha_ini;?>&lt;=&gt;hasta: <? echo $fecha_fin;?> </th>
  </tr>
  <tr>
    <th width="11%" align="right">SEDE:</th>
    <th width="51%" align="left"><span class='style3'>
      <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script>
    </span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'>
      <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script>
    </span></th>
  </tr>
  <tr>
    <td colspan="1" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
        <td colspan="4" align="center" class="style4">Docente -> Estudiante </td>
</tr>
  <!----------tabla central -->
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
		<tr>
        <td colspan="2" align="center" class="style4">Total Docentes / Estudiantes </td>
        
      	</tr>
      <tr>
        <td>Total Docentes</td>
        <td>Total Estudiantes</td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsAlumnos->fields['alumnos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4"> <? echo "Total: ".number_format(($rsTotal_profesores->fields['profesores']/$rsAlumnos->fields['alumnos'])*100,2);?> </span></td>
      </tr>
    </table></td>
    <td colspan="1" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	 <tr>
        <td colspan="2" align="center" class="style4">Docentes Tiempo Completo / Estudiantes </td>
        
     </tr>
      <tr>
        <td>Total Docentes a Tiempo Completo</td>
        <td>Total Estudiantes</td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores_completo->fields['profesoresTC'];?> </span></td>
        <td><span class="style4"> <? echo $rsAlumnos->fields['alumnos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4"> <? echo "Total:  ".number_format(($rsTotal_profesores_completo->fields['profesoresTC']/$rsAlumnos->fields['alumnos'])*100,2);?> </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
      
	  <tr>
        <td colspan="2" align="center" class="style4">Total Docentes (No Administrativos) / Estudiantes</td>
        
     </tr>
	 
	  <tr>
        <td>Total Docentes (No Administrativos) </td>
        <td>Total Estudiantes</td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores_NO_adm->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsAlumnos->fields['alumnos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4"> <? echo "Total : ".number_format(($rsTotal_profesores_NO_adm->fields['profesores']/$rsAlumnos->fields['alumnos'])*100,2);?> </span></td>
      </tr>
    </table></td>
    <td colspan="1" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
      <tr>
        <td colspan="2" align="center" class="style4">Docentes a Tiempo Completo (No Administrativos)  / Estudiantes</td>        
      </tr>
	 
	  <tr>
        <td>Total Docentes a Tiempo Completo (No Administrativos) </td>
        <td>Total Estudiantes</td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal__profesores_completo_NO_adm->fields['profesoresTC'];?> </span></td>
        <td><span class="style4"> <? echo $rsAlumnos->fields['alumnos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4"> <? echo "Total : ".number_format(($rsTotal__profesores_completo_NO_adm->fields['profesoresTC']/$rsAlumnos->fields['alumnos'])*100,2);?> </span></td>
      </tr>
    </table></td>
  </tr>
  <tr> </tr> 
  <tr>
        <td colspan="2" align="center" class="style4">Total Docentes (No Administrativos) / Estudiantes </td>
        
  </tr> 
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
      <tr>
        <td>Total Docentes (No Administrativos) </td>
        <td>Total Administrativos </td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores_NO_adm->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsAdministrativos->fields['administrativos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsAdministrativos->fields['administrativos']>0){
					echo "Total: ".number_format(($rsTotal_profesores_NO_adm->fields['profesores']/$rsAdministrativos->fields['administrativos'])*100,2);
					}
			?>
        </span></td>
      </tr>
    </table></td>
    
  </tr>
</table>
<p>&nbsp;</p>
  <!--------------------------------------------->  
 <table width="955">  
 <tr>
        <td colspan="4" align="center" class="style4">Docente -> Empleado </td>
</tr>		
  <tr>  
   <td width="481" colspan="1" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	 <tr>
        <td colspan="2" align="center" class="style4">Total Docentes (No Administrativos) / Funcionarios </td>
        
     </tr>
      <tr>
        <td>Total Docentes (No Administrativos) </td>
        <td>Total Funcionarios </td>
      </tr>
	  <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores_NO_adm->fields['profesores'];?> </span></td>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores_NO_adm->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsDirectores->fields['directores'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsDirectores->fields['directores']>0){
					echo "Total : ".number_format(($rsTotal__profesores_completo_NO_adm->fields['profesoresTC']/$rsDirectores->fields['directores'])*100,2);
			}
					?>
        </span></td>		
      </tr>
    </table></td>
		
	<td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	 <tr>
        <td colspan="2" align="center" class="style4">Total Docentes  / Empleados </td>
        
     </tr>
      <tr>
        <td>Total Docentes</td>
        <td>Total Empleados </td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsEmpleados->fields['empleados'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsEmpleados->fields['empleados']>0){
					echo "Total : ".number_format(($rsTotal_profesores->fields['profesores']/$rsEmpleados->fields['empleados'])*100,2);
			}
					?>
        </span></td>
      </tr>
    </table></td>
	
	
  </tr>  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	<tr>
        <td colspan="2" align="center" class="style4">Total Docentes / Administrativos (No Docentes) </td>
        
     </tr>
      <tr>
        <td>Total Docentes </td>
        <td>Total Administrativos (No Docentes) </td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsAdministrativos_no_profesores->fields['administrativos'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsAdministrativos_no_profesores->fields['administrativos']>0){
					echo "Total P: ".number_format(($rsTotal_profesores->fields['profesores']/$rsAdministrativos_no_profesores->fields['administrativos'])*100,2);
					}
			?>
        </span></td>
      </tr>
    </table></td>
    <td width="450" colspan="1" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	<tr>
        <td colspan="2" align="center" class="style4">Total Docentes / Total Funcionarios (No Docentes)  </td>
        
     </tr>
      <tr>
        <td width="34%">Total Docentes </td>
        <td width="66%">Total Funcionarios (No Docentes) </td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsTotal_profesores->fields['profesores'];?> </span></td>
        <td><span class="style4"> <? echo $rsDirectores_no_profesores->fields['directores'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsDirectores_no_profesores->fields['directores']>0){
					echo "Total: ".number_format(($rsTotal_profesores->fields['profesores']/$directores_no_profesores->fields['directores'])*100,2);
			}
					?>
        </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
	<tr>
        <td colspan="2" align="center" class="style4">Administrativos  / Docentes a tiempo completo  </td>
        
     </tr>
      <tr>
        <td>Total de Administrativos </td>
        <td>Docentes a tiempo completo </td>
      </tr>
      <tr>
        <td><span class="style4"> <? echo $rsAdministrativos->fields['administrativos'];?> </span></td>
        <td><span class="style4"> <? echo $rsTotal_profesores_completo->fields['profesoresTC'];?> </span></td>
      </tr>
      <tr>
        <td colspan="2"><span class="style4">
          <? 
			if($rsTotal_profesores_completo->fields['profesoresTC']>0){
					echo "Total: ".number_format(($rsAdministrativos->fields['administrativos']/$rsTotal_profesores_completo->fields['profesoresTC'])*100,2);
					}
			?>
        </span></td>
      </tr>
    </table></td>
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