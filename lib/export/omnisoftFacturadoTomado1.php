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
	
	/*	$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];*/
		
		$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];
 		$fecha_ini=$periodo_ini[1];
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];
		
		if($serial_per_ini == $serial_per_fin){
			$bperiodo = "and per.serial_per = ".$serial_per_fin;
				
		}else{
			$bperiodo = " and ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."'))";
	//		$bperiodo = "and per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."'";
		}
//		$anio_ini=$_GET['anio_ini'];
//		$anio_fin=$_GET['anio_fin'];

		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];			


$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per_ini);

$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas   from periodo where serial_per=".$serial_per_fin);

if ($serial_suc!='TODOS')
	$sucursal= "and per.serial_suc = ".$serial_suc;	
else
	$sucursal= "";

/*$repetidos = "select  mmat.SERIAL_ALU,concat_ws(' ', alu.apellidopaterno_alu,alu.apellidomaterno_alu, nombre1_alu, nombre2_alu) as nombre
, dmat.serial_mat, mat.nombre_mat, per.SERIAL_PER, per.nombre_per, count(*) as matricula, per.fecini_per as anio
from  materiamatriculada as mmat, detallemateriamatriculada as dmat, alumno as alu, materia as mat, periodo as per
where mmat.SERIAL_MMAT = dmat.serial_mmat
and mmat.SERIAL_ALU = alu.serial_alu
and mmat.SERIAL_PER = per.serial_per
and dmat.serial_mat = mat.serial_mat
and per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."' 
".$sucursal." 
and per.serial_sec = ".$serial_sec."
group by alu.serial_alu, mat.serial_mat
HAVING count(*) > 1
order by mat.nombre_mat, matricula desc, nombre";*/

$materias = "select per.serial_per,alu.serial_alu
,concat_ws(' ', alu.apellidopaterno_alu, alu.apellidomaterno_alu , alu.nombre1_alu,alu.nombre2_alu) AS nombre
,'Efectivizado' as estado,'Efectivizado' as costo ,creditos_dcpt as creditos
from cabeceracreditosportomar as cpt, detallecreditoportomar as dcpt, materiamatriculada as mmat,alumno as alu,periodo as per
where cpt.serial_cpt=dcpt.serial_cpt
and dcpt.serial_mmat=mmat.SERIAL_MMAT
and mmat.SERIAL_ALU = alu.serial_alu
and mmat.SERIAL_PER=per.serial_per
and mmat.SERIAL_SEC =1
and alu.serial_suc = 2
and ((fecini_per >='2008-01-01' and fecini_per<='2011-12-31') or (fecfin_per >='2008-01-01' and fecfin_per<='2011-12-31'))
union
select 
 per.serial_per,alu.serial_alu
,concat_ws(' ', alu.apellidopaterno_alu, alu.apellidomaterno_alu , alu.nombre1_alu,alu.nombre2_alu) AS nombre
,'Facturado' as estado,'facturado' as costo,sum(dfa.cantidad_dfa) as creditos
from  detallefactura as dfa,alumno as alu,detallearancel as dar, aranceles as ara, periodo as per ,cabecerafactura as caf
left JOIN materiamatriculada AS mmat 
		ON caf.serial_mmat=mmat.serial_mmat
where caf.serial_caf=dfa.serial_caf
and alu.serial_alu=caf.serial_alu
and dfa.serial_dar=dar.serial_dar
and mmat.SERIAL_PER=per.serial_per
and dar.serial_ara=ara.serial_ara
and ara.credito_ara = 'SI'
and mmat.SERIAL_SEC =1
and alu.serial_suc = 2
and ((fecini_per >='2008-01-01' and fecini_per<='2011-12-31') or (fecfin_per >='2008-01-01' and fecfin_per<='2011-12-31'))
group by alu.serial_alu
union
SELECT
	per.serial_per ,
	alu.serial_alu,
	concat_ws(' ', alu.apellidopaterno_alu, alu.apellidomaterno_alu , alu.nombre1_alu,alu.nombre2_alu) AS nombre,	
	if(dmat.retiromateria_dmat = ' ', 'Tomada','Retirado')                                             
	AS estado ,
	dmat.retiromateria_dmat                                                                            
	AS costo,	
	sum(numerocreditos_dmat + creditosequivalentes_dmat)                                                  
	AS creditos 
FROM
	alumno             AS alu,
	materiamatriculada AS mmat,
	detallemateriamatriculada dmat ,	
	periodo            AS per 
WHERE
	alu.serial_alu = mmat.serial_alu AND
	mmat.serial_mmat = dmat.serial_mmat AND
	mmat.SERIAL_PER = per.serial_per AND
	((fecini_per >='2008-01-01' and fecini_per<='2011-12-31') or (fecfin_per >='2008-01-01' and fecfin_per<='2011-12-31')) and
	mmat.serial_sec = 1 
    and alu.serial_suc = 2
group by alu.serial_alu,estado
ORDER BY nombre";

$rsMaterias=$dblink->Execute($materias);

echo $materias;

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
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2">CREDITOS FACTURADOS Y TOMADOS </th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS desde: <? echo $fecha_ini;?>&lt;=&gt;hasta: <? echo $fecha_fin;?> </th>
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
      <td colspan="3" bgcolor="#FFFFFF"> <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        		 
		 <tr>
          					<th width="35%">Alumno</th>		  											
							<!--<th width="1%"  style="">Nro.</th>-->
					        <th width="30%">Estado</th>		  											
							<th width="17%">Facturado</th>							
							<th width="17%">Tomado</th>							
							<th width="10%">Retirado Con Costo</th>					
							<th width="10%">Retirado Sin Costo</th>											  												  																	  												  											
			</tr>	
        
		<? $i=1;
		  $alumno = "";
		  $cod_materia=0;
		  $bandera = 0;
		  $matricula = 0;
		  $rsMaterias->Movefirst();
			while(!$rsMaterias->EOF){				
			?>
				<?
					if($rsMaterias->fields['serial_alu'] != $alumno){					
						if($bandera == 1){								
				?>
						<!--<tr>				
						<td colspan="7"> <span class="style4"><? echo "Total Materias: ".($i - 1)?> </span></td>														
						
						</tr>
						-->
						<!--<tr>
							<td colspan="7">
							 </br>
							 </br>
							</td>
						</tr>
						-->
						<?
						
						}
						
						$i=1;
						$totalAlumnos = 0;
						?>
					<!--	<tr>
          					<th width="35%">Alumno</th>		  											
							<th width="1%"  style="">Nro.</th>
					        <th width="30%">Estado</th>		  											
							<th width="17%">Costo</th>							
							<th width="10%">Créditos</th>											  												  											
		 				</tr>	 
					-->	
				<?	
					}																	
					
				?>				
				<tr> 
				<? if($rsMaterias->fields['serial_alu'] != $alumno){ ?>
					<td><span class="style2"><? echo $rsMaterias->fields['nombre'];?></span></td>
				<? }else echo "<td></d>" ?>
				
				<!-- <td><span class="style2"><? echo $i;?></span></td>	-->
							
				<td><span class="style2"><? echo $rsMaterias->fields['estado'];?></span></td>
				
				
				<?php if($rsMaterias->fields['estado']== 'Facturado'){?>						
						<td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
				<?php }if($rsMaterias->fields['estado']== 'Efectivizado'){?>						
						<td><span class="style2"> </span></td>
						<td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>				
				<?php }if($rsMaterias->fields['estado']== 'Tomada'){?>						
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
				<?php }if($rsMaterias->fields['costo']== 'CON COSTO'){ ?>					
					<td><span class="style2"> </span></td>
					<td><span class="style2"> </span></td>
					<td><span class="style2"> </span></td>
					<td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>
					<td><span class="style2"> </span></td>

				<?php } if($rsMaterias->fields['costo']== 'SIN COSTO'){?>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"> </span></td>
						<td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td>				
						
				<?php } ?>
						
				<!-- <td><span class="style2"><? echo $rsMaterias->fields['creditos'];?></span></td> -->

				</tr>		
				
				
							
		<?		
		$alumno = $rsMaterias->fields['serial_alu'];
					//$matricula=$rsRepetidos->fields['matricula'];
					//$cod_materia=$rsRepetidos->fields['serial_mat'];
		$bandera=1;

		$i++;
		
		if($rsMaterias->CurrentRow()==$rsMaterias->RecordCount()-1){
		
		?>	 
			 		<!--	<tr>				
						
							<td colspan="7"> <span class="style4"><? echo "Total Estudiantes: ".($i - 1)?> </span></td>											
												
						</tr>
					-->	
			
		<?	 
		}
		
				$rsMaterias->MoveNext();
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