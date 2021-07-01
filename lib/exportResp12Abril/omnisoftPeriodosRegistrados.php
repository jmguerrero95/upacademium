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
		//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");
// and intensivo_per='".$tipo."' 
//COnsulta 
$inicio_carrera="";
if(!empty($chkRegistros))
	$inicio_carrera="and alumno.serial_per=".$serial_per_ini;
	
//echo "<br>".$inicio_carrera;	

$sql_alumnos="
SELECT 
	materiamatriculada.serial_alu,
	concat_ws(' ', nombre1_alu,nombre2_alu,apellidopaterno_alu,apellidomaterno_alu) as nombre,
	concat_ws(' ', nombre1_alu,nombre2_alu) as snombre,
	concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu) as sapellido,
	codigoIdentificacion_alu as identificacion, 
	telefodomic_alu as telefono1, 
	celular_alu as telefono2, 
	mailuniv_alu as correo, 
	materiamatriculada.serial_per,
	direcciondomic_alu as direccion,
	sum(numerocreditos_dmat+creditosequivalentes_dmat) creditos, 
	fecini_per inicio,
	fecegreso_alu egreso,
	fectitulo_alu titulo,
	DATEDIFF(fectitulo_alu,fecini_per)/365 as anios,
	totalcreditos_maa,
	nombre_fac, 
	nombre_crp,
	sexo.descripcion_sex 
FROM 
	materiamatriculada,periodo,detallemateriamatriculada,alumno,alumnomalla,malla 
	left join carrera on carrera.serial_car=malla.serial_car
	left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
	left join facultad on facultad.serial_fac=carrera.serial_fac
	left join sexo on alumno.serial_sex = sexo.serial_sex 
WHERE
	materiamatriculada.SERIAL_MMAT=detallemateriamatriculada.serial_mmat 
	and alumno.serial_alu=materiamatriculada.SERIAL_ALU  
	".$inicio_carrera." 
	and periodo.serial_per=materiamatriculada.serial_per 
	
	and periodo.serial_suc=".$serial_suc." 
	and periodo.serial_sec=".$serial_sec."
	and malla.serial_sec=".$serial_sec." 
	and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')	
	and alumno.serial_alu=alumnomalla.serial_alu
	".$peri."
	and alumnomalla.serial_maa=malla.serial_maa
	and serial_maa_p=0
GROUP BY 
	serial_alu,
	serial_per
ORDER BY
	sapellido,
	fecini_per
";
//echo "<br>".$sql_alumnos."<br>";
$rsalumnos=$dblink->Execute($sql_alumnos); 
$numReg = $rsalumnos->RecordCount();
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
$nombres_alumnos=array();
$snombre=array();
$sapellido=array();
$telefono1=array();
$telefono2=array();
$correo=array();
$direccion=array();
$identificacion=array();
$periodo_inicio=array();
$periodo_egreso=array();
$periodo_titulo=array();
$anios_estudio=array();
$malla_creditos=array();
$facultad=array();
$carrera=array();
$sexo=array();
while (!$rsalumnos->EOF) {
	$creditos_alumnos[$rsalumnos->fields['serial_alu']][$rsalumnos->fields['serial_per']]=$rsalumnos->fields['creditos'];
	if (!in_array($rsalumnos->fields['nombre'],$nombres_alumnos)){
		$nombres_alumnos[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['nombre'];
		$snombre[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['snombre'];
		$sapellido[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['sapellido'];
		$telefono1[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['telefono1'];
		$telefono2[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['telefono2'];
		$correo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['correo'];
		$direccion[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['direccion'];
		$identificacion[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['identificacion'];
		$periodo_inicio[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['inicio'];
		$periodo_egreso[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['egreso'];
		$periodo_titulo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['titulo'];
		$anios_estudio[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['anios'];
		$malla_creditos[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['totalcreditos_maa'];
		$facultad[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['nombre_fac'];
		$carrera[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['nombre_crp'];
		$sexo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['descripcion_sex'];
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
<BR>
<BR>
<BR>
<BR>
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">CREDITOS DE ESTUDIANTES POR PERIODO </span></th>
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
		  <th width="20%" bgcolor="#999999">Nombre</th>
		  <th width="20%" bgcolor="#999999"><span class="style2">Apellido </span></th>
		  <th width="10%" bgcolor="#999999">Telf Dom </th>
		  <th width="10%" bgcolor="#999999">Tel. Cel </th>
		  <th width="10%" bgcolor="#999999">Dir</th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Correo </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Sexo </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Malla(Créditos)</span></th>
		  <? $celdas="";
		while (!$result_periodos->EOF) {?>
          <th width="1%" bgcolor="#999999"  class="textovertical"><span class='style2'><? echo $result_periodos->fields['nombre_per'];?> </span> </th>
		  <? 
		  	$celdas=$celdas."<td >&nbsp;</td>";
			$result_periodos->MoveNext();
	  	}
		?>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">TOTAL CREDITOS</span></td>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">PROMEDIO</span></td>
		<td width="10%" bgcolor="#999999" class="textovertical"><span class="style2">INICIO</span></td>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">EGRESO</span></td>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">TITULACION</span></td>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">AÑOS DE ESTUDIO</span></td>
		<td width="1%" bgcolor="#999999" class="textovertical"><span class="style2">FACULTAD</span></td>
		<td width="1%" class="textovertical"><span class="style2">CARRERA</span></td>
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
			$alu_tiempo_completo='';
			$j=0;

			foreach($creditos_alumnos as $alumnos=>$periodos){ 
			   //echo $alumnos."<br>"; 
			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				
				<td NOWRAP ><span class="style2"><? echo $identificacion[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $snombre[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $sapellido[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $telefono1[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $telefono2[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $direccion[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $correo[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $sexo[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $malla_creditos[$alumnos];?></span></td>
				<?
				$total_creditos_alu=0;
				$num_periodos=0;
				$cont_per=0;
			   $result_periodos->MoveFirst();
				while (!$result_periodos->EOF) {
					 $encontro=0;
					 foreach ($periodos as $periodo=>$creditos){  
						 //echo $perido." => ".$creditos."<br>"; 
						if($result_periodos->fields['serial_per']==$periodo){
							echo "<td class='style2'>".$creditos."</td>";
							$encontro=1;
							$num_periodos=$num_periodos+1;
							$total_creditos_alu=$total_creditos_alu+$creditos;
						}	
							//break;
					}
					if($encontro==0){ $cont_per++; echo "<td >&nbsp;</td>";}
					
					$result_periodos->MoveNext();
				}
				$promedio=number_format($total_creditos_alu/$num_periodos,0);
				$suma_anios=$suma_anios+$anios_estudio[$alumnos];
				
			?>
				<td class="style2"><? echo $total_creditos_alu;?></td>
				<td class="style2"><? echo $promedio;?></td>
				<td class="style2"><? echo $periodo_inicio[$alumnos];?></td>
				<td class="style2"><? if($periodo_egreso[$alumnos]!='0000-00-00') echo $periodo_egreso[$alumnos];?></td>
				<td class="style2"><? if($periodo_titulo[$alumnos]!='0000-00-00') echo $periodo_titulo[$alumnos];?></td>
				<td class="style2"><? if($anios_estudio[$alumnos]!=''){ echo $anios_estudio[$alumnos]; $j++; }?> </td>
				<td class="style2"><? echo $facultad[$alumnos];?></td>
				<td class="style2"><? echo $carrera[$alumnos];?></td>
				</tr>
				
			<? 
			
			 if ($promedio>=11 && $cont_per<=5){
			 	 if($aux_alumno==0)
				 	$alu_tiempo_completo=$alumnos; 				
				 else
				 	$alu_tiempo_completo=$alu_tiempo_completo.','.$alumnos;
					
					$aux_alumno=1;
				}
				$i=$i+1;
			}
		 	/*	echo "<br>NUM. TITULADOS:".$j;
				if($j>0)
				echo "<br>PROMEDIO:".$suma_anios/$j;*/
				
			//echo "<br> tiempo_completo".$alu_tiempo_completo."<br>";
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