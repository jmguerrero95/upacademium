<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body>
<!--<link rel="stylesheet" type="text/css" href="../styles/chrome.css">-->
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
		$chkRegistros=$_GET['chkRegistros'];
		//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$result_periodos=$dblink->Execute("select serial_per,serial_suc,concat_ws('<br>',nombre_per,fecini_per) as nombre_per,fecini_per from periodo 
where fecini_per >='".$fecha_ini."' and fecini_per<DATE_ADD('".$fecha_fin."', INTERVAL 360 DAY) and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");
// and intensivo_per='".$tipo."' 
//COnsulta 

$inicio_carrera="";
if(!empty($chkRegistros))
	$inicio_carrera="and alumno.serial_per=".$serial_per_ini;
	
//echo "<br>".$inicio_carrera;	
$sql_alumnos="";

$sql_alumnos="select materiamatriculada.serial_alu,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre,codigoIdentificacion_alu as identificacion, concat_ws(' / ',telefodomic_alu, celular_alu) as telefono, mailuniv_alu as correo, materiamatriculada.serial_per,sum(numerocreditos_dmat+creditosequivalentes_dmat) creditos , periodo1.fecini_per inicio,periodo.fecini_per fecha_registro
from alumno,periodo,periodo as periodo1,materiamatriculada,detallemateriamatriculada
where materiamatriculada.SERIAL_MMAT=detallemateriamatriculada.serial_mmat and alumno.serial_alu=materiamatriculada.SERIAL_ALU and alumno.serial_per=periodo1.serial_per
and periodo1.fecini_per>= '".$fecha_ini."' and periodo1.fecini_per<'".$fecha_fin."' and periodo1.serial_suc=".$serial_suc." and periodo1.serial_sec=".$serial_sec." and periodo.serial_per=materiamatriculada.serial_per and periodo.fecini_per>='".$fecha_ini."' and periodo.fecini_per<DATE_ADD('".$fecha_fin."', INTERVAL 360 DAY) and fecharetiro_dmat='0000-00-00'
and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')
group by serial_alu,serial_per
order by nombre,fecha_registro";
$rsalumnos=$dblink->Execute($sql_alumnos); 
//echo $sql_alumnos;
//Asignar valores a asignar a un arreglo, como tambien los nombres de los estudiantes
$nombres_alumnos=array();
$telefono=array();
$correo=array();
$identificacion=array();
$periodo_inicio=array();
$periodo_registro=array();
//$periodo_egreso=array();
//$periodo_titulo=array();
//$anios_estudio=array();
while (!$rsalumnos->EOF) {
	$creditos_alumnos[$rsalumnos->fields['serial_alu']][$rsalumnos->fields['serial_per']]=$rsalumnos->fields['creditos'];
	if (!in_array($rsalumnos->fields['nombre'],$nombres_alumnos)){
		$nombres_alumnos[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['nombre'];
		$telefono[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['telefono'];
		$correo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['correo'];
		$identificacion[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['identificacion'];
		$periodo_inicio[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['inicio'];
		$periodo_registro[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['fecha_registro'];
		//$periodo_egreso[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['egreso'];
		//**$periodo_titulo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['titulo'];
		//$anios_estudio[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['anios'];
		}
	$rsalumnos->MoveNext();
}
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

<table width="100%" align="center" border="1">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">DESERCION   DE ESTUDIANTES POR PERIODO </span></th>
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
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="1%"  style="">Nro.</th>
          <th width="5%">Identificación</th>
		  <th width="20%">Alumnos </th>
		  <!--<th width="10%">Teléfono </th>
		  <th width="10%">Correo </th>-->
		  <? $celdas="";
		while (!$result_periodos->EOF) {?>
          <th width="1%"  class="textovertical"><span class='style2'><? echo $result_periodos->fields['nombre_per'];?> </span> </th>
		  <? 
		  	$celdas=$celdas."<td >&nbsp;</td>";
			$result_periodos->MoveNext();
	  	}
		?>
		<th width="1%" class="textovertical"><span class="style2">INICIO</span></th>
		<th width="1%" ><span class="style2">TOTAL 1er. PERIODO</span></th>
		<th width="1%" ><span class="style2">TOTAL 2do. PERIODO</span></th>
		<th width="10%" ><span class="style2">TOTAL CREDITOS</span></th>
		<th width="10%" ><span class="style2">TIEMPO COMPLETO</span></th>
		<th width="10%" ><span class="style2">DESERTADOS</span></th>
		</tr>
        
		<? $i=1;
			$cod_alumno=0;
			$contador=count($nombres_alumnos);
			//echo "contador:".$contador."<br>";
			/*foreach($creditos_alumnos as $alumnos=>$periodos){ 
			   echo $alumnos."<br>"; 
			   foreach ($periodos as $perido=>$creditos){  
				 echo $perido." => ".$creditos."<br>"; 
			   } 
			}  */
			$aux_alumno=0;
			$tiempoc=0;
			$tiempod=0;
			$j=0;

			foreach($creditos_alumnos as $alumnos=>$periodos){ 
			   //echo $alumnos."<br>"; 
			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				
				<td NOWRAP ><span class="style2"><? echo $identificacion[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $nombres_alumnos[$alumnos];?></span></td>
				<!--<td NOWRAP><span class="style2"><? echo $telefono[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $correo[$alumnos];?></span></td>-->
				<?
				$total_creditos_1ro=0;
				$total_creditos_2do=0;
				$num_periodos=0;
				$cont_per=0;
				$color="bgcolor='#709BBC'";
				$auxtc='';
			   $result_periodos->MoveFirst();
				while (!$result_periodos->EOF) {
					 $encontro=0;
					 if($result_periodos->fields['fecini_per']<$fecha_fin)
							$color="bgcolor='#709BBC'";
					 else	$color="bgcolor='#FFE084'";			
					 foreach ($periodos as $periodo=>$creditos){  
						 //echo $perido." => ".$creditos."<br>"; 
						if($result_periodos->fields['serial_per']==$periodo){
							echo "<td class='style2' ".$color." align='center'>".$creditos."</td>";
							
							if($result_periodos->fields['fecini_per']<$fecha_fin) 
									$total_creditos_1ro=$total_creditos_1ro+$creditos;
							else	$total_creditos_2do=$total_creditos_2do+$creditos;
								
							$encontro=1;
							$num_periodos=$num_periodos+1;
							
							
						}	
							//break;
					}
					if($encontro==0){ $cont_per++; echo "<td ".$color.">&nbsp;</td>";}
					
					$result_periodos->MoveNext();
				}
				//$promedio=number_format($total_creditos_alu/$num_periodos,0);
				//$suma_anios=$suma_anios+$anios_estudio[$alumnos];
				
			?>
				<td class="style2" nowrap="nowrap"><? echo $periodo_inicio[$alumnos];?></td>
				<td class="style2"  bgcolor='#709BBC' align="center"><? echo $total_creditos_1ro;?></td>
				<td class="style2" bgcolor='#FFE084' align="center"><? echo $total_creditos_2do;?></td>
				<td class="style2" align="center"><? echo $total_creditos_1ro+$total_creditos_2do;?></td>
				<td class="style2" align="center"><strong><? if($total_creditos_1ro>=21){$tiempoc=$tiempoc+1; echo $tiempoc; $auxtc='si';} else{ echo"&nbsp;"; $auxtc='no'; }?></strong></td>
				<td class="style2" align="center"><strong><? if($total_creditos_2do<21 && $auxtc=='si'){$tiempod=$tiempod+1; echo $tiempod;} else echo"&nbsp;";?></strong></td>
				</tr>
				
			<? 
				$i=$i+1;
			}
		 				
			
		?>
		
    </table>    </td>
  </tr>
  
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><table width="50%" border="1">
      <tr>
        <th colspan="2" align="center" bgcolor="#FFCB51">RESUMEN DESERCI&Oacute;N </th>
        </tr>
      <tr>
        <th width="25%">Alumnos </th>
        <th width="25%">N&uacute;mero</th>
        </tr>
      <tr>
        <td width="25%">Del periodo </td>
        <td><? echo $i-1;?></td>
        </tr>
      <tr>
        <td>Tiempo completo </td>
        <td><? echo $tiempoc;?></td>
        </tr>
      <tr>
        <td>Desertados </td>
        <td><? echo $tiempod;?></td>
      </tr>
      <tr>
        <th bgcolor="#FFCB51">Total Deserci&oacute;n: &nbsp;</th>
        <th bgcolor="#FFCB51">
		<? echo number_format(($tiempod/$tiempoc)*100,2);?>%		</th>        
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>