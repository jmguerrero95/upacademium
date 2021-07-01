<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE DESERCION DE ESTUDIANTES</title>
<style type="text/css">
<!--


.style4 {
	color: #FF0033;
	font-weight: bold;
	font-size: 18px;
}
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
			$periodo = "and periodo.fecini_per>='".$fecha_ini."' and periodo.fecini_per<='".$fecha_fin."'";
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
			periodo.fecini_per inicio,
			 MAX(per1.fecini_per) ultimo_periodo,
             fecestado_hac retiro,
			trim(concat_ws(' ',motivos_hac,descmotivos_hac)) motivo,			
			round(DATEDIFF(now(),MAX(per1.fecini_per))/365) AS anios,
			SUM(numerocreditos_dmat+creditosequivalentes_dmat) creditos,
            count(distinct(per1.serial_per)) as numperiodos,
            SUM(numerocreditos_dmat+creditosequivalentes_dmat)/(Count(distinct(materiamatriculada.serial_per))) as Promedio,
			nombre_fac,
			if(malla.serial_sec=1,nombre_crp,nombre_car) AS carrera,			sexo.descripcion_sex,
			sucursal.nombre_suc,fectitulacion_ama,fecegresamiento_ama
		FROM periodo,alumno,sucursal,materiamatriculada,detallemateriamatriculada,periodo per1
			left join alumnomalla on alumnomalla.serial_alu=alumno.serial_alu
			join malla on malla.serial_maa=alumnomalla.serial_maa and serial_maa_p=0 and malla.serial_sec=".$serial_sec." 
			left join carrera on carrera.serial_car=malla.serial_car
			left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp".$carrera."
			left join facultad on facultad.serial_fac=carrera.serial_fac
			left join sexo on alumno.serial_sex = sexo.serial_sex 
			LEFT JOIN historicoacademico ON historicoacademico.serial_alu=alumno.serial_alu 
		WHERE 
			alumnomalla.serial_per=periodo.serial_per
			and alumno.serial_suc = sucursal.serial_suc
			".$periodo."
			".$sucursal."
			and materiamatriculada.serial_mmat=detallemateriamatriculada.serial_mmat
            and materiamatriculada.SERIAL_ALU=alumno.serial_alu
            and materiamatriculada.SERIAL_PER=per1.serial_per
			and (intercambio_alu<>'VIENE INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')
           
			
        group by alumno.serial_alu
		ORDER BY
		anios desc,nombre";
	echo "<br>".$sqlAlumnos."<br>";
	$rsalumnos=$dblink->Execute($sqlAlumnos); 

// and (fecegresamiento_ama='0000-00-00' and fectitulacion_ama='0000-00-00')
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
    <th colspan="2">TASA DE DESERCION DE ACUERDO AL PERIODO O FECHAS SELECCIONADAS </th>
  </tr>
  <tr >
    <th colspan="2">  
	<? 
	   //Periodo 		
	   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "&nbsp;";
	   }else{
			echo "PERIODO: ".$rsPeriodo_ini->fields['nombre_per'];
	   }	?> 
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
		<td width="1%" class="textovertical"><span class="style2">ULTIMO PERIODO</span></td>
		<td width="1%" class="textovertical"><span class="style2">FECHA DE RETIRO</span></td>
		<td width="1%" class="textovertical"><span class="style2">MOTIVO RETIRO</span></td>
		<td width="1%" class="textovertical"><span class="style2">AÑOS RETIRO</span></td>
		<td width="1%" class="textovertical"><span class="style2">CREDITOS TOMADOS</span></td>
		<td width="1%" class="textovertical"><span class="style2">NUM. PERIODOS</span></td>
		<td width="1%" class="textovertical"><span class="style2">PROM. CRED X PERIODO</span></td>
								
		<td width="1%" class="textovertical"><span class="style2">FACULTAD</span></td>
		<td width="1%" class="textovertical"><span class="style2">CARRERA</span></td>
		<td width="1%" class="textovertical"><span class="style2">SUCURSAL</span></td>
		</tr>
        
		<? $i=1;
			
			$AnosGraduados=array();
			$AnosEgresados=array();
			$Carrera=array();
			$IngresaronxCarrera=array();
			$NoOficial=array();
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
				<td ><span class="style2"><? if($rsalumnos->fields['ultimo_periodo']!='0000-00-00') echo $rsalumnos->fields['ultimo_periodo'];?></span></td>
				<td ><span class="style2"><? if($rsalumnos->fields['retiro']!='0000-00-00') echo $rsalumnos->fields['retiro'];?></span></td>
				<td class="style2"><? echo $rsalumnos->fields['motivo'];?></td>
				<td class="style2"><? echo $rsalumnos->fields['anios'];?></td>
				
				<td class="style2"><? echo $rsalumnos->fields['creditos'];?></td>
				<td class="style2"><? echo $rsalumnos->fields['numperiodos'];?></td>
				<td class="style2"><? echo $rsalumnos->fields['Promedio'];?></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_fac'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['carrera'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_suc'];?></span></td>
				</tr>
				
			<?
				$IngresaronxCarrera[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]=$IngresaronxCarrera[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]+1;
							
						if(!empty($rsalumnos->fields['motivo'])){ 
							//echo "<br>".$rsalumnos->fields['motivo']."---".$i;
							$Carrera[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]=$Carrera[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]+1;
						}else		
							$NoOficial[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]=$NoOficial[$rsalumnos->fields['carrera']][$rsalumnos->fields['descripcion_sex']]+1;
								
					
				if ($rsalumnos->fields['fecegresamiento_ama']!='0000-00-00' || $rsalumnos->fields['fectitulacion_ama']!='0000-00-00'){
					if($rsalumnos->fields['fectitulacion_ama']!='0000-00-00') $AnosGraduados['GRADUADOS']=$AnosGraduados['GRADUADOS']+1;
					else
						$AnosGraduados['EGRESADOS']=$AnosGraduados['EGRESADOS']+1;
				
				}else			
					$AnosGraduados[$rsalumnos->fields['anios']]=$AnosGraduados[$rsalumnos->fields['anios']]+1;
			
			
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
          <td colspan="8" align="center">TASA DE DESERCION POR CARRERA NO REGISTRADOS EN 1 AÑO Y MAS </td>
        </tr>
        <tr>
          <th width="34%" align="center">Carrera</th>
          <th colspan="2" align="center"># Estudiantes no graduados </th>
          <th colspan="2" align="center"># Retirados Oficialmente </th>
          <th colspan="2" align="center">Tasa de desercion</th>
        </tr>
         <tr>
          <td align="center">&nbsp;</td>
          <td>Masculino</td>
          <td>Femenino</td>
          <td>Masculino</td>
          <td>Femenino</td>
          <td>Masculino</td>
          <td>Femenino</td>
        </tr>
		<?  
		//echo '<pre>'; print_r($Carrera); echo '</pre>';
		//echo '<pre>'; print_r($IngresaronxCarrera); echo '</pre>';
		 $valor_ing=0;
		 $tot_ing=0;
		 $tot_tit=0;
		 foreach ($IngresaronxCarrera as $car=>$key){
		 	$valor_ing_m=0;
			$valor_car_m=0;
			$valor_ing_f=0;
			$valor_car_f=0;
			$promedio_p_m=0;
			$promedio_p_f=0;
			
		 	foreach ($key as $sex=>$valor){ 
		 
				switch ($sex) {
					case 'MASCULINO':
						$valor_ing_m=$valor;
						$valor_car_m=$Carrera[$car][$sex];
						$promedio_p_m=($valor_car_m/($valor_ing_m))*100;
						$tot_ing_m=$tot_ing_m+$valor_ing_m;
						$tot_tit_m=$tot_tit_m+$valor_car_m;
						break;
					case 'FEMENINO':
						$valor_ing_f=$valor;
						$valor_car_f=$Carrera[$car][$sex];
						$promedio_p_f=($valor_car_f/($valor_ing_f))*100;
						$tot_ing_f=$tot_ing_f+$valor_ing_f;
						$tot_tit_f=$tot_tit_f+$valor_car_f;
						break;
					
				}
				
				//echo "<br>car".$car."ffffffffffffff".$key."   sex".$sex."  valor".$valor;
			}	

			 /*$valor_ing=$IngresaronxCarrera[$car];
			$promedio=($valor/($valor_ing))*100;
			$tot_ing=$tot_ing+$valor_ing;
			$tot_tit=$tot_tit+$valor;*/
	  ?>
       
        <tr>
          <td align="center"><? echo $car;  ?></td>
          <td width="19%"><? echo $valor_ing_m; ?></td>
          <td width="19%"><? echo $valor_ing_f; ?></td>
          <td width="19%"><? echo $valor_car_m; ?></td>
          <td width="19%"><? echo $valor_car_f; ?></td>
          <td width="14%"><? echo number_format($promedio_p_m,2)."%"; ?></td>
          <td width="14%"><? echo number_format($promedio_p_f,2)."%"; ?></td>
          <? 		/*if (is_numeric($anio))
					$total_g=$total_g+$valor;*/
					
		}				
							//break;?>
        </tr>
        <tr>
          <th align="center">TOTAL</th>
          <th><? echo $tot_ing_m; ?></th>
          <th><? echo $tot_ing_f; ?></th>
          <th><? echo $tot_tit_m; ?></th>
          <th><? echo $tot_tit_f; ?></th>
          <th><? echo number_format(($tot_tit_m/($tot_ing_m))*100,2)."%";?></th>
          <th><? echo number_format(($tot_tit_f/($tot_ing_f))*100,2)."%";?></th>
        </tr>
		<tr>
          <th colspan="7" align="center"> <span class="style4"><? echo number_format((($tot_tit_m+$tot_tit_f)/(($tot_ing_m+$tot_ing_f)))*100,2)."%";?></span></th>
        </tr>
      </table>
   </td>
    <td bgcolor="#FFFFFF" align="center"><table width="80%" border="1">
      <tr>
        <td colspan="4" align="center">Años del ultimo periodo de registro </td>
      </tr>
      <tr>
        <th align="center">Años  de último registro </th>
        <th align="center">N&uacute;mero de Estudiantes </th>
        <th align="center">Promedio</th>
      </tr>
      <?  
	  	//sort($AnosGraduados);

		foreach ($AnosGraduados as $anio=>$valor){ 
	  			$promedio=($valor/($i-1))*100;
	  ?>
      <tr>
        <td width="25%" align="center"><? echo $anio;  ?></td>
        <td width="25%"><? echo $valor; ?></td>
        <td width="25%"><? echo number_format($promedio,2)."%"; ?></td>
        <? 		//if (is_numeric($anio))
					$total_g=$total_g+$valor;
						}	
							//break;?>
      </tr>
      <tr>
        <th align="center">TOTAL  </th>
        <th><? echo $total_g; ?></th>
        <th>&nbsp;</th>
      </tr>
      <br />
    </table></td>
  </tr>
</table>

</body>
</html>