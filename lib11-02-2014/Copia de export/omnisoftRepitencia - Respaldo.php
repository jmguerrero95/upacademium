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
//and per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."'
$repetidos = "select  mmat.SERIAL_ALU,concat_ws(' ', alu.apellidopaterno_alu,alu.apellidomaterno_alu, nombre1_alu, nombre2_alu) as nombre
, dmat.serial_mat, mat.nombre_mat, per.SERIAL_PER, per.nombre_per, count(*) as matricula, per.fecini_per as anio
from  materiamatriculada as mmat, detallemateriamatriculada as dmat, alumno as alu, materia as mat, periodo as per
where mmat.SERIAL_MMAT = dmat.serial_mmat
and mmat.SERIAL_ALU = alu.serial_alu
and mmat.SERIAL_PER = per.serial_per
and dmat.serial_mat = mat.serial_mat
and per.fecini_per >= '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."'
".$sucursal." 
and per.serial_sec = ".$serial_sec."
group by alu.serial_alu, mat.serial_mat
HAVING count(*) > 1
order by mat.nombre_mat, matricula desc, nombre";

$rsRepetidos=$dblink->Execute($repetidos);

//echo $repetidos;

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
    <th colspan="2">Repitencia</th>
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
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        		 
		 
        
		<? $i=1;
		   $j=0;
		   $n=0;
		   $materia = "";
		  $cod_materia=0;
		  $bandera = 0;
		  $matricula = 0;
		  $rsRepetidos->Movefirst();
			while(!$rsRepetidos->EOF){				
			?>
				<?
					if($rsRepetidos->fields['nombre_mat']!=$materia or $rsRepetidos->fields['matricula']!=$matricula){
					//cuantos alumnos tomaron la materia
					$alumnos="select dmat.serial_mat
							,count(distinct mmat.SERIAL_ALU ) as alumnos
							from materiamatriculada as mmat, detallemateriamatriculada as dmat, periodo as per 
							where mmat.SERIAL_MMAT = dmat.serial_mmat 
							and mmat.SERIAL_PER = per.serial_per  
							and per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."' 
							".$sucursal." 
							and per.serial_sec = ".$serial_sec."
							and dmat.serial_mat = ".$cod_materia."
							group by dmat.serial_mat";														
					$rsAlumnos = $dblink->Execute($alumnos);	
				
						if($bandera == 1){		
						
				?>
						<tr>				
						<td colspan="2">
									<table width="100%">
										<tr>
											<? 
												$totalEstudiantes = $i - 1;
												$estudiantesXmateria = $rsAlumnos->fields['alumnos'];
												$tasaRepeticion = number_format((($i - 1)/$rsAlumnos->fields['alumnos'])*100,2);
												$resumen[$n][1]= $materia;
												$resumen[$n][2]= $totalEstudiantes;
												$resumen[$n][3]= $estudiantesXmateria;
												$resumen[$n][4]= $tasaRepeticion;
												$resumen[$n][5]= $matricula; //cuantas matriculas
												$n++;
											?>
											<td> <span class="style4"><? echo "Total Estudiantes: ".$totalEstudiantes;?> </span></td>
											<td> <span class="style4"><? echo "Total de Estudiantes que Tomaron la Materia: ".$estudiantesXmateria; ?></span></td>											
											<td><span class="style4"><? echo "Tasa de Repetición: ".$tasaRepeticion."%";?></span></td>
										</tr>
									</table>	
						</td>						
						
						</tr>
						<tr>
							<td colspan="2">
							 </br>
							 </br>
							</td>
						</tr>
						<?
						
						}
						?>	
						<tr>
						<td align="center" colspan="5"><span class="style1"><? echo $rsRepetidos->fields['nombre_mat']." (".$rsRepetidos->fields['matricula']." Matriculas )";
						$j=$j+($i-1);
						$i=1;
						$totalAlumnos = 0;
						?></span></td>
						</tr>
						<tr>
          					<th width="1%"  style="">Nro.</th>
					        <th width="25%">Estudiante</th>		  											
		 				</tr>	 
				<?	
					}																	
					$materia = $rsRepetidos->fields['nombre_mat'];
					$matricula=$rsRepetidos->fields['matricula'];
					$cod_materia=$rsRepetidos->fields['serial_mat'];
				?>				
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td><span class="style2"><? echo $rsRepetidos->fields['nombre'];?></span></td>
				</tr>		
							
		<?		
		
		$bandera=1;

		$i++;
		
		if($rsRepetidos->CurrentRow()==$rsRepetidos->RecordCount()-1){
		
		?>	 
			 			<tr>				
						<td colspan="2">
									<table width="100%">
										<tr>
											<? 
												$totalEstudiantes = $i - 1;
												$estudiantesXmateria = $rsAlumnos->fields['alumnos'];
												$tasaRepeticion = number_format((($i - 1)/$rsAlumnos->fields['alumnos'])*100,2);
												$resumen[$n][1]= $materia;
												$resumen[$n][2]= $totalEstudiantes;
												$resumen[$n][3]= $estudiantesXmateria;
												$resumen[$n][4]= $tasaRepeticion;
												$resumen[$n][5]= $matricula; //cuantas matriculas												
											?>
											<td> <span class="style4"><? echo "Total Estudiantes: ".$totalEstudiantes?> </span></td>
											<td> <span class="style4"><? echo "Total de Estudiantes que Tomaron la Materia: ".$estudiantesXmateria; ?></span></td>											
											<td><span class="style4"><? echo "Tasa de Repetición: ".$tasaRepeticion."%";?></span></td>
										</tr>
									</table>	
						</td>						
						
						</tr>
						
						
						<tr>				
						<td colspan="2">
									<table width="100%">
										<tr>
											<td> <span class="style4"><? echo "Total Consolidado Estudiantes: ".($j)?> </span></td>
										<!--	<td> <span class="style4"><? echo "Total de Estudiantes que Tomaron la Materia: ".$rsAlumnos->fields['alumnos']; ?></span>-->
										</td>
										<!--	<td><span class="style4"><? echo "Tasa de Repetición: ".number_format((($i - 1)/$rsAlumnos->fields['alumnos'])*100,2)."%";?></span></td>
										-->	
										</tr>
									</table>										
						</td>
						</tr>
			
		<?	 
		}
		
				$rsRepetidos->MoveNext();
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
<p>&nbsp;</p>
<table align="center">
</table>
<?
 	//$vec = (count($resumen,1)/count($resumen,0))-1;			
	
	//echo "</p> ------>  ".count($resumen);	
$repitentes=0;	
$estudiantes=0;	
$tasa=0;

	$cont=0;	
	//COMPARA CON LA SEGUNDA MATRICULA
	for($x=0;$x<=count($resumen);$x++){				
				if($resumen[$x][5]==2){
					$resumen2[$cont][1]=$resumen[$x][1];
					$resumen2[$cont][2]=$resumen[$x][2];
					$resumen2[$cont][3]=$resumen[$x][3];
					$resumen2[$cont][4]=$resumen[$x][4];
					$resumen2[$cont][5]=$resumen[$x][5];
					$cont++;
				}				
			}

	echo "<table align='center'>";	
	
	echo "<tr>";
		echo "<td class='style1' colspan='4'>"."Estudiantes con Segunda Matricula"."</td>";
	echo "<tr>";
	
	echo "<tr>";
	echo "<td>"."Materias"."</td>";
	echo "<td>"."Repitente"."</td>";
	echo "<td>"."Estudiantes que Tomaron"."</td>";
	echo "<td>"."Tasa de Repitencia"."</td>";	
	echo "</tr>";
	
		for($y=0;$y<count($resumen2);$y++){		
			echo "<tr>";
					echo "<td>".$resumen2[$y][1]."</td>";
					echo "<td>".$resumen2[$y][2]."</td>";	
					echo "<td>".$resumen2[$y][3]."</td>";	
					echo "<td>".$resumen2[$y][4]."%</td>";				
					
					$repitentes=$repitentes + $resumen2[$y][2];	
					$estudiantes=$estudiantes + $resumen2[$y][3];	
					$tasa=$tasa + $resumen2[$y][4];
			echo "<tr>";		
		}
		
	echo "<tr>";
		echo "<td>"."Totales: "."</td>";
		echo "<td>".$repitentes."</td>";
		echo "<td>".$estudiantes."</td>";
		if(count($resumen2)>0)
		echo "<td>".number_format(($tasa/count($resumen2)),2)."%"."</td>";
	echo "</tr>";		
	echo "</table>";
	
////////////////////////////////////////////////////////////////////////////////	

echo "<p>&nbsp;</p>";
$repitentes=0;	
$estudiantes=0;	
$tasa=0;

	$cont=0;	
	//COMPARA CON LA tercera MATRICULA
	for($x=0;$x<=count($resumen);$x++){				
				if($resumen[$x][5]==3){
					$resumen3[$cont][1]=$resumen[$x][1];
					$resumen3[$cont][2]=$resumen[$x][2];
					$resumen3[$cont][3]=$resumen[$x][3];
					$resumen3[$cont][4]=$resumen[$x][4];
					$resumen3[$cont][5]=$resumen[$x][5];
					$cont++;
				}				
			}

	echo "<table align='center'>";	
	
	echo "<tr>";
		echo "<td class='style1' colspan='4'>"."Estudiantes con Tercera Matricula"."</td>";
	echo "<tr>";
	
	echo "<tr>";
	echo "<td>"."Materias"."</td>";
	echo "<td>"."Repitente"."</td>";
	echo "<td>"."Estudiantes que Tomaron"."</td>";
	echo "<td>"."Tasa de Repitencia"."</td>";	
	echo "</tr>";
	
		for($y=0;$y<count($resumen3);$y++){		
			echo "<tr>";
					echo "<td>".$resumen3[$y][1]."</td>";
					echo "<td>".$resumen3[$y][2]."</td>";	
					echo "<td>".$resumen3[$y][3]."</td>";	
					echo "<td>".$resumen3[$y][4]."%</td>";				
					
					$repitentes=$repitentes + $resumen3[$y][2];	
					$estudiantes=$estudiantes + $resumen3[$y][3];	
					$tasa=$tasa + $resumen3[$y][4];
			echo "<tr>";		
		}
		
	echo "<tr>";
		echo "<td>"."Totales: "."</td>";
		echo "<td>".$repitentes."</td>";
		echo "<td>".$estudiantes."</td>";
		if(count($resumen3)>0)
		echo "<td>".number_format(($tasa/count($resumen3)),2)."%"."</td>";
	echo "</tr>";		
	echo "</table>";			
	
///////////////////////////////////////////////////////////////////////////////	

echo "<p>&nbsp;</p>";
$repitentes=0;	
$estudiantes=0;	
$tasa=0;

	$cont=0;	
	//COMPARA CON LA mas de cuatro MATRICULA
	for($x=0;$x<=count($resumen);$x++){				
				if($resumen[$x][5]>=4){
					$resumen4[$cont][1]=$resumen[$x][1];
					$resumen4[$cont][2]=$resumen[$x][2];
					$resumen4[$cont][3]=$resumen[$x][3];
					$resumen4[$cont][4]=$resumen[$x][4];
					$resumen4[$cont][5]=$resumen[$x][5];
					$cont++;
				}				
			}

	echo "<table align='center'>";	
	
	echo "<tr>";
		echo "<td class='style1' colspan='4'>"."Estudiantes con mas de Cuatro Matriculas"."</td>";
	echo "<tr>";
	
	echo "<tr>";
	echo "<td>"."Materias"."</td>";
	echo "<td>"."Repitente"."</td>";
	echo "<td>"."Estudiantes que Tomaron"."</td>";
	echo "<td>"."Tasa de Repitencia"."</td>";	
	echo "</tr>";
	
		for($y=0;$y<count($resumen4);$y++){		
			echo "<tr>";
					echo "<td>".$resumen4[$y][1]."</td>";
					echo "<td>".$resumen4[$y][2]."</td>";	
					echo "<td>".$resumen4[$y][3]."</td>";	
					echo "<td>".$resumen4[$y][4]."%</td>";				
					
					$repitentes=$repitentes + $resumen4[$y][2];	
					$estudiantes=$estudiantes + $resumen4[$y][3];	
					$tasa=$tasa + $resumen4[$y][4];
			echo "<tr>";		
		}
		
	echo "<tr>";
		echo "<td>"."Totales: "."</td>";
		echo "<td>".$repitentes."</td>";
		echo "<td>".$estudiantes."</td>";
		if(count($resumen4)>0)
		echo "<td>".number_format(($tasa/count($resumen4)),2)."%"."</td>";
		
	echo "</tr>";		
	echo "</table>";			

 ?> 





</body>
</html>