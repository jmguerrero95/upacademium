<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE GRADUACION DE ESTUDIANTES</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
	require('../adodb/adodb.inc.php');
	require('../../config/config.inc.php');
	global $DBConnection;
    $dblink = NewADOConnection($DBConnection);
	$fecha_ini = $_GET['fecha_ini'];
	$fecha_fin = $_GET['fecha_fin'];	
	$serial_suc=$_GET['serial_suc'];
	$serial_sec = $_GET['serial_sec'];
	$serial_crp = $_GET['serial_crp'];
	$per = explode('*',$_GET['serial_per']);
	$serial_per = $per[0];
	//COnsulta del Periodo Academico Inicial
	$sqlPer1 = "
		SELECT  nombre_per,
				concat_ws(' hasta ',fecini_per,fecfin_per) fechas,
				fecini_per  
		FROM 
				periodo 
		WHERE  
				serial_per = ".$serial_per;
				
	$rsPeriodo_ini=$dblink->Execute($sqlPer1);	
	//Fechas
	if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
			$periodo = "and fecini_per>='".$fecha_ini."' and fecini_per<='".$fecha_fin."'";
		}else{			
			$periodo = " and alumnomalla.serial_per = ".$serial_per;	
		}
	//Sucursal
	if($serial_suc=="T"){
		$sucursal = "";		
	}else{
		$sucursal = "and alumno.serial_suc=".$serial_suc;
	}	
	//Carrera
	if($serial_crp=="T"){		
			$carrera = "";
	}else{
		if($serial_sec==2){
			$carrera = " AND carrera.serial_car = ".$serial_crp;
		}else{
			$carrera = " AND carreraprincipal.serial_crp = ".$serial_crp;
		}
		
	}
	$sqlAlumnos = "
		SELECT 
			alumno.serial_alu,codigo_alu,concat_ws(' ', apellidopaterno_alu,
														apellidomaterno_alu,
														nombre1_alu,
														nombre2_alu) as nombre,
			codigoIdentificacion_alu as identificacion, 
			concat_ws(' / ',telefodomic_alu, celular_alu) as telefono, 
			mailuniv_alu as correo,
			fecini_per inicio,
			fecegresamiento_ama egreso,
			fectitulacion_ama titulo,			
			ROUND(DATEDIFF(fectitulacion_ama,fecini_per)/365) as anios,
			ROUND(DATEDIFF(fecegresamiento_ama,fecini_per)/365) as anios_egreso,
			nombre_fac,
			nombre_crp,
			sexo.descripcion_sex,
			sucursal.nombre_suc 
		FROM periodo,alumno,sucursal
			left join alumnomalla on alumnomalla.serial_alu=alumno.serial_alu
			left join malla on malla.serial_maa=alumnomalla.serial_maa and serial_maa_p=0 and malla.serial_sec=".$serial_sec." 
			left join carrera on carrera.serial_car=malla.serial_car
			left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp".$carrera."
			left join facultad on facultad.serial_fac=carrera.serial_fac
			left join sexo on alumno.serial_sex = sexo.serial_sex 
		WHERE 
			alumnomalla.serial_per=periodo.serial_per
			and alumno.serial_suc = sucursal.serial_suc
			".$periodo."
			".$sucursal."
			and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')
		ORDER BY
		anios desc,nombre";
	echo "<br>".$sqlAlumnos."<br>";
	$rsalumnos=$dblink->Execute($sqlAlumnos); 


//mssql_free_result($resultado);
//COnsulta del Periodo Academico Inicial

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
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">TASA DE GRADUACI&Oacute;N DE ACUERDO AL PERIODO O FECHAS SELECCIONADAS </th>
  </tr>
  <tr >
    <th colspan="2">  
	<? 
	   //Periodo 		
	   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "&nbsp;";
	   }else{
			echo "PERIODO: ".$rsPeriodo_ini->fields['nombre_per'];
	   }
	?> 
	 </th>
  </tr>
  <tr>
    <th colspan="2"> <?
	   //rangos de Fechas
	   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "FECHAS DESDE : ".$fecha_ini." <==> ";
			echo " HASTA : ".$fecha_fin;
	   }else{
			echo "&nbsp;";	
	   }
	
	 ?>
	  </th>
  </tr>
  <tr>
    <th width="26%" align="right">SEDE:</th>
    <th width="53%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
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
 	      <th width="5%">Código</th>
		  <th width="20%">Alumnos </th>
		  <th width="10%">Teléfono </th>
		  <th width="10%">Correo </th>
	    <th width="10%">Sexo </th>
		<td width="10%" class="textovertical"><span class="style2">INICIO</span></td>
		<td width="1%" class="textovertical"><span class="style2">EGRESO</span></td>
		<td width="1%" class="textovertical"><span class="style2">TITULACION</span></td>
		<td width="1%" class="textovertical"><span class="style2">AÑOS DE ESTUDIO</span></td>
		<td width="1%" class="textovertical"><span class="style2">AÑOS EGRESAMIENTO</span></td>
		<td width="1%" class="textovertical"><span class="style2">FACULTAD</span></td>
		<td width="1%" class="textovertical"><span class="style2">CARRERA</span></td>
		<td width="1%" class="textovertical"><span class="style2">SUCURSAL</span></td>
		</tr>
        
		<? $i=1;
			
			$AnosGraduados=array();
			$AnosEgresados=array();
			$Carrera=array();
			$IngresaronxCarrera=array();
			while (!$rsalumnos->EOF) {
			   //echo $alumnos."<br>"; 
			  
			?>
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				
				<td ><span class="style2"><? echo $rsalumnos->fields['identificacion'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['codigo_alu']?></span></td>
				<td NOWRAP><span class="style2"><? echo $rsalumnos->fields['nombre'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['telefono'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['correo'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['descripcion_sex'];?></span></td>
				<td ><span class="style2"><? if($rsalumnos->fields['inicio']!='0000-00-00') echo $rsalumnos->fields['inicio'];?></span></td>
				<td ><span class="style2"><? if($rsalumnos->fields['egreso']!='0000-00-00') echo $rsalumnos->fields['egreso'];?></span></td>
				<td ><span class="style2"><? if($rsalumnos->fields['titulo']!='0000-00-00') echo $rsalumnos->fields['titulo'];?></span></td>
				
				<td class="style2"><? echo $rsalumnos->fields['anios'];?></td>
				<td class="style2"><? echo $rsalumnos->fields['anios_egreso'];?></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_fac'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_crp'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_suc'];?></span></td>
				</tr>
				
			<?
				
				$IngresaronxCarrera[$rsalumnos->fields['nombre_crp']]=$IngresaronxCarrera[$rsalumnos->fields['nombre_crp']]+1;
				//SOLAMENTE SUMA LOS ALUNOS QUE SE HAN TITULADO EL TIEMPO OFICIAL 4 AÑOS MAS 2 AÑOS
				if(is_numeric($rsalumnos->fields['anios'])>=4 && is_numeric($rsalumnos->fields['anios'])<=6)$Carrera[$rsalumnos->fields['nombre_crp']]=$Carrera[$rsalumnos->fields['nombre_crp']]+1;
				
				$AnosGraduados[$rsalumnos->fields['anios']]=$AnosGraduados[$rsalumnos->fields['anios']]+1;
				if(is_numeric($rsalumnos->fields['anios_egreso']) && empty($rsalumnos->fields['anios']))
					$AnosEgresados[$rsalumnos->fields['anios_egreso']]=$AnosEgresados[$rsalumnos->fields['anios_egreso']]+1;
			
			$i++;
			$rsalumnos->MoveNext();
	  	}
			?>
		
    </table>    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" align="center"><table width="80%" border="1">
      <tr>
        <td colspan="4" align="center">PROMEDIO DE TITULACION </td>
        </tr>
      <tr>
        <th align="center">Duraci&oacute;n de carrera en Años </th>
        <th align="center">N&uacute;mero de Estudiantes </th>
        <th align="center">Promedio</th>
        </tr>
	  <?  foreach ($AnosGraduados as $anio=>$valor){ 
	  	$promedio=($valor/($i-1))*100;
	  ?>
     
      <tr>
        <td width="25%" align="center"><? if (is_numeric($anio)) echo $anio; else echo "NO GRADUADO";  ?></td>
        <td width="25%"><? echo $valor; ?></td>
        <td width="25%"><? echo number_format($promedio,2)."%"; ?></td>
		<? 		if (is_numeric($anio))
					$total_g=$total_g+$valor;
						}	
							//break;?>
      </tr>
	   <tr>
        <th align="center">TOTAL</th>
        <th><? echo $total_g; ?></th>
        <th>&nbsp;</th>
      </tr>
    </table>
      <table width="80%" border="1">
        <tr>
          <td colspan="5" align="center">TASA DE TITULACION OFICIAL (4 a&ntilde;os)POR CARRERA </td>
        </tr>
        <tr>
          <th width="34%" align="center">Carrera</th>
          <th align="center"># Estudiantes Registrados </th>
          <th align="center"># Estudiantes Titulados </th>
          <th align="center">Tasa de titulaci&oacute;n </th>
        </tr>
        <?  
		 $valor_ing=0;
		 $tot_ing=0;
		 $tot_tit=0;
		 foreach ($Carrera as $car=>$valor){ 
	  		 $valor_ing=$IngresaronxCarrera[$car];
			$promedio=($valor/($valor_ing))*100;
			$tot_ing=$tot_ing+$valor_ing;
			$tot_tit=$tot_tit+$valor;
	  ?>
        <tr>
          <td align="center"><? echo $car;  ?></td>
          <td width="38%"><? echo $valor_ing; ?></td>
          <td width="38%"><? echo $valor; ?></td>
          <td width="28%"><? echo number_format($promedio,2)."%"; ?></td>
          <? 		/*if (is_numeric($anio))
					$total_g=$total_g+$valor;*/
					
						}	
							//break;?>
        </tr>
        <tr>
          <th align="center">TOTAL</th>
          <th><? echo $tot_ing; ?></th>
          <th><? echo $tot_tit; ?></th>
          <th><? echo number_format(($tot_tit/($tot_ing))*100,2)."%";?></th>
        </tr>
      </table>
    <p>&nbsp;</p></td>
    <td bgcolor="#FFFFFF" align="center"><table width="80%" border="1">
      <tr>
        <td colspan="4" align="center">PROMEDIO DE EGRESAMIENTO </td>
      </tr>
      <tr>
        <th align="center">Duraci&oacute;n de egresamiento en A&ntilde;os </th>
        <th align="center">N&uacute;mero de Estudiantes </th>
        <th align="center">Promedio</th>
      </tr>
      <?  foreach ($AnosEgresados as $anio=>$valor){ 
	  	$promedio=($valor/$i)*100;
	  ?>
      <tr>
        <td width="25%" align="center"><? if (is_numeric($anio)) echo $anio; else echo "NO EGRESADO";  ?></td>
        <td width="25%"><? echo $valor; ?></td>
        <td width="25%"><? echo number_format($promedio,2)."%"; ?></td>
        <? 			
			$total_e=$total_e+$valor;
						}	
							//break;?>
      </tr>
	  <tr>
        <th align="center">TOTAL</th>
        <th><? echo $total_e; ?></th>
        <th>&nbsp;</th>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>