<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">

<style type="text/css">

H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }
 
-->
</style>
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		$serial_suc = $_GET['serial_suc'];
		$serial_sec = $_GET['serial_sec'];
		$serial_per = $_GET['serial_per'];
		$fecha_ini = $_GET['fecha_ini'];
		$fecha_fin = $_GET['fecha_fin'];
		$serial_fac = $_GET['serial_fac'];
		$serial_epl = $_GET['serial_epl'];
		$perch = explode('*',$serial_per);			
		$perok = $perch[0];
		//MPC: validacion para todos los registro 
		//periodo o rango de fechas
		if(strlen($fecha_ini)<=0 or strlen($fecha_fin)<=0){
			//echo "PERIODO:".$serial_per;
			$per = explode('*',$serial_per);			
			$periodo = "and hrr.serial_per = ".$per[0];
			$periodoPost = "and hrr.serial_per = ".$per[0];
		}else{
			$periodo = "and fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' ";
			$periodoPost = "and fechorario_hrr >='".$fecha_ini."' and fechorario_hrr<='".$fecha_fin."' ";			
		}
		
		//profesor
		if($serial_epl=="T"){
			$empleado = "";		
		}else{
			$empleado = "and epl.serial_epl = ".$serial_epl;
		}
		//sucursal
		if($serial_suc=="T"){
			$sucursal = "";		
		}else{
			$sucursal = "and per.serial_suc = ".$serial_suc;
		}
		//facultad
		if($serial_fac != ''){			
			if($serial_fac=="T"){
				$facultad = "";		
			}else{
				$facultad = "and facultad.serial_fac = ".$serial_fac;
			}
		}else{
			$facultad = "";
		}
		//seccion
		if($serial_sec=="T"){
			$seccion = "";		
		}else{
			$seccion = "and per.serial_sec = ".$serial_sec;
		}
			
		$fecha_act = date("Y")."-".date("m")."-".date("d");	

/*$sql_profesores="
SELECT 
	distinct (hrr.SERIAL_EPL) as emp,
	DOCUMENTOIDENTIDAD_EPL, 
	concat_ws(' ',epl.APELLIDO_EPL, epl.NOMBRE_EPL) nombre,EMAIL_EPL, FECHAINGRESO_EPL,
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	FECHANACIMIENTO_EPL as fnacimiento,
	SEXO_EPL,
	niv.nombre_nac,
	formaContrato_epl,
	nombre_fac,
	nombre_suc

FROM
  	area,facultad,materia,periodo,empleado as epl, horario as hrr,sucursal as suc
	left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
	left join nivelacademico as niv on foa.serial_nac = niv.serial_nac
WHERE
	hrr.serial_epl=epl.serial_epl
	and materia.serial_mat=hrr.serial_mat
	and area.serial_are=materia.serial_are
	and area.serial_fac=facultad.serial_fac
	and periodo.serial_per=hrr.serial_per
	and epl.serial_suc = suc.serial_suc
	".$facultad."
	".$periodo."
	and estado_hrr='ACTIVO'
	".$sucursal."
	".$seccion."
GROUP BY
	hrr.serial_epl
ORDER BY
	nombre
";*/

//echo $periodo;
//exit(0);
$sql_profesores="SELECT  hrr.SERIAL_HRR,
	epl.serial_epl,
	CONCAT_WS(' ', APELLIDO_EPL,NOMBRE_EPL)AS nombre,
	concat_ws(' ',nombre_mat,'(',hrr.seccion_hrr,')') as nombre_mat,
	nombre_per,
	nombrehorario_hrr,
	tothoras_hrr,
	suc.NOMBRE_SUC,
	FORMACONTRATO_EPL,
	tct.NOMBRE_TCT		 
FROM
	materiamatriculada        AS mmat,
	detallemateriamatriculada AS dmat,
	periodo                   AS per,
	materia                   AS mat,
	horario                   AS hrr,
	empleado                  AS epl,
	sucursal                  AS suc
	left join tipocontratostrabajo as tct
	on epl.SERIAL_TCT=tct.SERIAL_TCT 
WHERE
	mmat.serial_mmat = dmat.serial_mmat AND
	mmat.serial_per = per.serial_per AND
	hrr.serial_hrr = dmat.serial_hrr AND
	dmat.serial_mat = mat.serial_mat AND
	epl.serial_epl=hrr.serial_epl AND
	per.serial_suc=suc.SERIAL_SUC AND
	estado_hrr = 'ACTIVO' 
	".$periodo." 
	".$sucursal."
	".$seccion."
	".$empleado."
GROUP BY
	hrr.serial_hrr 
UNION
SELECT hrr.SERIAL_HRR,
	epl.serial_epl,
	CONCAT_WS(' ', APELLIDO_EPL,NOMBRE_EPL) AS nombre,
	concat_ws(' ',nombre_mat,'(',hrr.seccion_hrr,')') as nombre_mat,
	nombre_per,
	nombrehorario_hrr,
	tothoras_hrr,
	suc.NOMBRE_SUC,
	FORMACONTRATO_EPL,
	tct.NOMBRE_TCT 
FROM
	materiamatriculada        AS mmat,
	detallemateriamatriculada AS dmat,
	periodo                   AS per,
	materia                   AS mat,
	horario                   AS hrr,
	empleado                  AS epl,
	sucursal                  AS suc 
	left join tipocontratostrabajo as tct
	on epl.SERIAL_TCT=tct.SERIAL_TCT 
WHERE
	mmat.serial_mmat = dmat.serial_mmat AND
	mmat.serial_per = per.serial_per AND
	hrr.serial_hrr = dmat.serial_hrr AND
	dmat.serial_mat = mat.serial_mat AND
	per.serial_suc=suc.SERIAL_SUC AND
	epl.serial_epl=hrr.serial_epl AND
    estado_hrr = 'ACTIVO' 
	".$periodoPost." 
	".$sucursal."
	".$seccion."
	".$empleado."
GROUP BY
	hrr.serial_hrr 
ORDER BY
	nombre,
	nombre_per,	
	nombre_mat";

//echo $sql_profesores;
$rsprofesores=$dblink->Execute($sql_profesores); 


//mssql_free_result($resultado);
//COnsulta del Periodo Academico Inicial
if(strlen($fecha_ini)>0 and strlen($fecha_fin)>0){
$impPer = "";
$fPer = "FECHAS DESDE: ".$fecha_ini." HASTA: ".$fecha_fin; 

}else{
	$pIni= "
	select 
		nombre_per,  
		concat_ws(' hasta ',fecini_per,fecfin_per) fechas  
	from 
		periodo 
	where 
		serial_per=".$perok;
	$rsPeriodo_ini=$dblink->Execute($pIni);

$rsPeriodo_fin=$dblink->Execute($pFin);
$impPer = "PERIODO: ".$rsPeriodo_ini->fields['nombre_per'];
$fPer = "FECHA DEL PERIODO: ".$rsPeriodo_ini->fields['fechas'];
}
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


	
	
        
		<? 	$i=1;
			$j=0;
			$emp = 0;			
			$bandera=0;
			$horas=0;
			while (!$rsprofesores->EOF) {		
			?>
			
				<?php if($emp!=$rsprofesores->fields['serial_epl']){ 
						if($bandera<>0){
								?>
								<!------------------------fin DE LA TABLA POR PROFESOR-------------->
								<tr>
									<td colspan="5" align="right">Total Horas</span></td>
									<td><span class="style2"><? echo $horas;?></span></td>
								</tr>								
								</table>
								&nbsp;&nbsp;&nbsp;								
								<?php
								$horas=0;
						}
					if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";	
				?>				
				<p><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></p>
				<p>&nbsp;</p>
								
					<table width="100%" align="center">
							<!------------------------------------------------------------------------------------------------------------------------>
							  <tr bgcolor="#FFFFFF">
								<td width="20%" rowspan="6" bgcolor="#FFFFFF">&nbsp;</td>
								<th colspan="4">HORAS ACADEMICAS DEL PROFESOR </th>
							  </tr>
							  <tr >
								<th colspan="4"> <? echo $rsprofesores->fields['nombre']; ?></th>
							  </tr>
							  
							  <tr >
								<th colspan="4"> <? echo $impPer;?></th>
							  </tr>
							  <tr>
								<th colspan="4"><?php echo $fPer;?> </th>
							  </tr>
							  <tr>
								<th width="11%" align="right">SEDE:</th>
								<th width="13%" align="left"><span class='style3'> 
							    <script>//document.write(getURLParam('alumno')+'<br>');
									document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
									</script></span></th>
									
								<th width="21%" align="left">FORMA DE CONTRATO:</th>
								<th width="35%" align="left"><?php echo $rsprofesores->fields['FORMACONTRATO_EPL']; ?></th>
										
							  </tr>
							 
							  <tr>
								<th align="right">PROGRAMA:</th>
								<th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
									document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
									</script> </span></th>
									
								<th width="21%" align="left">TIPO DE CONTRATO:</th>
								<th width="35%" align="left"><?php echo $rsprofesores->fields['NOMBRE_TCT']; ?></th>	
									
							  </tr>
							  <tr>
								<td colspan="5" bgcolor="#FFFFFF"  >&nbsp;</td>
							  </tr>
</table>
							
					<!------------------------------------------------------------------------------------------------------------------------>
					
					<table width="100%" align="center">
									<tr>
										<td align="center" colspan="3"  style="">FORMACION ACADEMICA</td>
									</tr>									
									<tr>
										<th>Formación en:</th>																																	
										<th>Nivel Académico:</th>																																					
										<th>País:</th>
									</tr>	
									
									<?php 
									$formacionAcademica= "SELECT
															DESCRIPCION_FOA,
															nombre_nac,
															NOMBRE_PAI 
														FROM
															formacionacademica AS foa,
															nivelacademico      AS nac,
															pais                AS pai 
														WHERE
															foa.serial_nac=nac.serial_nac AND
															foa.SERIAL_PAI=pai.SERIAL_PAI AND
															SERIAL_EPL = ".$rsprofesores->fields['serial_epl'];
															
									$rsformacionAcademica=$dblink->Execute($formacionAcademica); 									
									
									while (!$rsformacionAcademica->EOF) {
									?>	
									
									<tr>
										<td><span class="style2"><? echo $rsformacionAcademica->fields['DESCRIPCION_FOA'];?></span></td>																								
										<td><span class="style2"><? echo $rsformacionAcademica->fields['nombre_nac'];?></span></td>																										
										<td><span class="style2"><? echo $rsformacionAcademica->fields['NOMBRE_PAI'];?></span></td>
									</tr>								
									
									<?php
										$rsformacionAcademica->MoveNext();
									}						
									?>	
									
									
</table>
					
					<!------------------------------------------------------------------------------------------------------------------------>
					&nbsp;
							
					<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
					<tr>
						<td align="center" colspan="6"  style="">HORAS POR MATERIA</td>
					</tr>									
					<tr>
					  <th width="1%"  style="">Nro.</th>
					  <th width="5%">Sucursal</th>
					  
					  <th width="1%">Nro</th>
			
					   <th width="20%">Materia</th>
					   <th width="10%">Periodo</th>
					   <th width="4%">Horas</th>
					</tr>														
				<tr> 		
					<td><span class="style2"><? echo $i;//echo $rsForm->fields['EMAIL_EPL'];?></span></td>
					<td><span class="style2"><? echo $rsprofesores->fields['NOMBRE_SUC'];?></span></td>			
					
				<?php $j=1;
				$bandera=1;
				$i++;			
				} 
				else{ 
				$j++;
				?>
					<tr> 		
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					
				
				<?php	
				}	
				?>
				
				<td><span class="style2"><? echo $j;?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['nombre_mat'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['nombre_per'];?></span></td>
				<td><span class="style2"><? echo $rsprofesores->fields['tothoras_hrr'];?></span></td>	
				
				</tr>
			
		<?				
		$emp=$rsprofesores->fields['serial_epl'];
		$horas=$horas+$rsprofesores->fields['tothoras_hrr'];			
		
						
			$rsprofesores->MoveNext();
		}
		?>
   <!-----------------Para la Ultima consulta---------------------->
						   <tr>
							<td align="right" colspan="5">Total Horas</span></td>
							<td><span class="style2"><? echo $horas;?></span></td>
						</tr>
			    </table>
				
				
		<!------------------------------------------------------------------------------------------------->						
				
				
				
				
	
 

                    
</body>
</html>