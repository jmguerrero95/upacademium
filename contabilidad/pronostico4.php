<?  
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');	
?>
<script>
function salir(){	
	window.close();
}	


function calcular(){
	alert(" vec " + document.presupuesto.vec[][].value)
	document.presupuesto.parametro[][].value = document.presupuesto.vec[][].value
	alert(" Para " + document.presupuesto.parametro[][].value)
	document.presupuesto.bandera.value = 1; 
	document.presupuesto.submit();
	
	<? echo IVAAAAAA; ?>
}	


function aceptar(){	
	alert ("entro");	
}	
</script>
<body bgcolor="#79addd">
<? 
	$dblink = NewADOConnection($DBConnection);	
	$url = $_GET['query1'];
	$par1 = explode("|",$url);
	//echo "0- ".$par1[0]."</p>";// sucursal 
	//echo "1- ".$par1[1]."</p>";//sucursal
	//echo "2- ".$par1[2]."</p>";//año
	//echo "3- ".$par1[2]."</p>";//departamento
	
	/*****valiada que se ingrese una sola ves por año y por sede*******/

	/*$validar =  "select suc.nombre_suc 
				from presupuestooperativo as pop,  subrubrosgrupospresupuestarios_departamentos AS srpd, 
				subgruposrubrospresupuestarios AS srp, departamentos AS dep, gruposrubrospresupuestarios as grp, 
				tiposrubrospresupuestarios as trp, sucursal as suc 
				WHERE srpd.SERIAL_SRPD = pop.SERIAL_SRPD 
				and srpd.serial_sgrp = srp.serial_sgrp 
				AND srpd.serial_dep = dep.serial_dep 
				and srp.SERIAL_GRP = grp.SERIAL_GRP
				and grp.SERIAL_TRP = trp.SERIAL_TRP
				and suc.serial_suc = pop.serial_suc
				and (trp.TIPO_TRP like 'INGRESO' and trp.automatico_trp like 'SI')
				and pop.ANIO_POP = ".$par1[2]."
				and pop.SERIAL_SUC = ".$par1[1];*/
				
	//$retvalidar=$dblink->Execute($validar);
	/*if($retvalidar->RecordCount()>0){
		echo "<table align='center'> <tr><td align='center'>";
		echo "El presupuesto para la sede ".$retvalidar->fields['nombre_suc']."  para el año ".$par1[2]." ya fue generada anteriormente ,";
		echo "<br> Ingrese para un año diferente o elija otra sede";							
		echo " </td></tr></table>";	
	}else{generarapresupuesto();}*/
	
?>	
<form name="presupuesto" method="get" action="pronostico.php">
	<?
	if ($_GET['bandera']==0){
		$vec = generarapresupuesto();				
	}
	?>	
	
<table align="center"><tr><td>			
		<input type="button" name "salir" value="Salir" onClick="salir()" />
		
</td></tr></table>
</form>




</body>
<?


function generarapresupuesto(){
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');	
	$dblink = NewADOConnection($DBConnection);
	
	$url = $_GET['query1'];
	$par = explode("|",$url);
	
	//****los periodod de un determinado año**********//
	
	$sucursal = $par[1];	
	/*creacion de tabla temporal*/
	$tabla = "CREATE TEMPORARY TABLE temporalMaterias(
			alumno int(10) NOT NULL						
			, materia int(10)
			) ENGINE=MEMORY;";		
	$dblink->Execute($tabla);
////////$retalumno->MoveNext();	

$anio=$par[2];

$fecha_ini = $anio."-01-01"; //fecha del año sigueinte
$fecha_fin = $anio."-12-31"; //fecha del añoa siguiente

$calendario = "select cun.serial_per, per.fecini_per, per.fecfin_per 
							from calendariounificado as cun, periodo as per
							where cun.serial_per = per.serial_per
							and per.fecini_per > '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."'
							and per.serial_suc = ".$sucursal."
							group by cun.serial_per
							order by per.fecini_per asc";	
	
$retcalendario=$dblink->Execute($calendario);

	$anio=date("Y");
	//$anio="2008";
				$fecha_ini = $anio."-01-01"; //fecha del añoa actual
				$fecha_fin = $anio."-12-31"; //fecha del añoa actual				
//echo "---------------------$per .- </p>";	
				$alumno="select mmat.serial_alu, per.serial_per, alu.serial_per
				from materiamatriculada as mmat, periodo as per, alumno as alu 
				where mmat.SERIAL_PER = per.serial_per 
				and mmat.SERIAL_ALU = alu.serial_alu
				and per.fecini_per >= '".$fecha_ini."' and per.fecini_per <= '".$fecha_fin."'
				and per.serial_suc = ".$sucursal."
				group by SERIAL_ALU
				order by SERIAL_ALU";						
	

echo "$alu .- ".$alumno."</p>";
				$retalumno=$dblink->Execute($alumno);													
				

if($retcalendario->RecordCount()>0){					
		$totalAlumnos=0;
		$i=1;
		while (!$retcalendario->EOF){		
				$per = $retcalendario->fields['serial_per'];
				$fechaInicio = $retcalendario->fields['fecini_per'];
/*				$anio=date("Y");
	//$anio="2008";
				$fecha_ini = $anio."-01-01"; //fecha del añoa actual
				$fecha_fin = $anio."-12-31"; //fecha del añoa actual				
//echo "---------------------$per .- </p>";	
				$alumno="select mmat.serial_alu, per.serial_per, alu.serial_per
				from materiamatriculada as mmat, periodo as per, alumno as alu 
				where mmat.SERIAL_PER = per.serial_per 
				and mmat.SERIAL_ALU = alu.serial_alu
				and per.fecini_per >= '".$fecha_ini."' and per.fecini_per <= '".$fecha_fin."'
				and per.serial_suc = ".$sucursal."
				group by SERIAL_ALU
				order by SERIAL_ALU";						
					
				
echo "$alu .- ".$alumno."</p>";			

				$retalumno=$dblink->Execute($alumno);*/
				
				
			$totalAlumnos = $totalAlumnos + $retalumno->RecordCount();
			if($retalumno->RecordCount()>0){	
				$retalumno->MoveFirst();
					while (!$retalumno->EOF){							
							$alu = $retalumno->fields['serial_alu'];//Asigna serial de  cada alumno que studio el en año actual																								
							
									//$vec[$i][1]=$alu;
									//$vec[$i][2]=$per;
									//$vec[$i][3]=$fechaInicio;
									
									//creditos($alu,$per,$totalAlumnos);
									
									$porTomar="select dcun.serial_mat, cun.serial_cun 
												from calendariounificado as cun inner join detallecalendariounificado as dcun 
												on  cun.serial_cun = dcun.serial_cun
												where serial_per = ".$per." 
												and dcun.serial_mat in (select dma.serial_mat 
																		from detallemalla as dma inner join malla as mall 
																		on dma.serial_maa = mall.serial_maa
																		where mall.serial_maa in (select serial_maa 
																								from alumnomalla 
																								where serial_alu = ".$alu.")
																		and dma.serial_mat not in(select dmat.serial_mat 
																								from materiamatriculada as mmat
																								inner join 
																								detallemateriamatriculada as dmat 
																								on mmat.SERIAL_MMAT 
																								= dmat.serial_mmat
																								where mmat.SERIAL_ALU = ".$alu." 
																								group by dmat.serial_mat 
																								order by dmat.serial_mat) 
																		group by dma.serial_mat) 							
												and dcun.serial_mat not in(select materia from temporalMaterias where alumno = ".$alu.")																
												group by dcun.serial_mat order by dcun.serial_mat 
												limit 5";			
												
												
			
												
							
									//echo " ".$porTomar."</p>";																			
												
						$retporTomar=$dblink->Execute($porTomar);
									
									/*Saca el valor del alumno por categoria*/
									$valorCredito="select valor_dar,caa.nombre_caa,dde.porcentaje_dde, 
															(valor_dar * dde.porcentaje_dde) as costo   
															from detallearancel as dar, detalle_descuento as dde, 
															categoriaalumno as caa
															where dde.serial_dar = dar.serial_dar
															and dde.serial_caa = caa.serial_caa
															and dde.serial_caa in (select serial_caa from alumno 
																					where serial_alu = ".$alu.")";																					
															
															$retvalorCredito=$dblink->Execute($valorCredito);												
															$valor = $retvalorCredito->fields['costo'];	
															$cat = $retvalorCredito->fields['nombre_caa'];	
														
												//if($retporTomar->RecordCount()>0){	
													while (!$retporTomar->EOF){
															$mat=$retporTomar->fields['serial_mat'];
															$insert="INSERT INTO temporalMaterias
																		(materia, alumno) 
																		values(".$mat.",".$alu.")";															
															$dblink->Execute($insert);
															
															////Creditos por materia//////
															$numCreditos = "select numerocreditos_dma ,max(serial_dma) 
																			from detallemalla where serial_mat = ".$mat." group by serial_mat";																
															$retnumCreditos=$dblink->Execute($numCreditos);												
															$cred = $retnumCreditos->fields['numerocreditos_dma'];	
													
															////valor por alumno del credito incluido el decuemto/////
															
															
															$totalValor=$totalValor+($valor*$cred);
															$totalCreditos = $totalCreditos + $cred;
															
	echo $per."  A*  ".$alu." M* ".$mat." C* ".$cred." V* ".$valor." C* ".$cat." TC* ".$totalCreditos." V* ".$totalValor."</p>";							
															$retporTomar->MoveNext();				
													}									
									
									
									$i=$i+1;						
									
								
						$retalumno->MoveNext();
				}				
			}	
		
		$retcalendario->MoveNext();
	}
}		
?>

<?
	$destruir="DROP TABLE temporalMaterias";
	$dblink->Execute($destruir);
	$vec[0][0]=$totalAlumnos;
	return $vec;
	
}
/**********************************************************************************/

function creditos($alu,$per,$totalAlumnos){

$dblink = NewADOConnection($DBConnection);
//$totalAlumnos=$vec[0][0];
//echo $totalAlumnos;
//echo "saliooooooooooooo222222";
//for($n=1;$n<=$totalAlumnos;$n++){
	//echo "saliooooooooooooo333";
	//$alu=$alu;
	//$per=$per;
	
	
							$porTomar="select dcun.serial_mat, cun.serial_cun 
												from calendariounificado as cun inner join detallecalendariounificado as dcun 
												on  cun.serial_cun = dcun.serial_cun
												where serial_per = ".$per." 
												and dcun.serial_mat in (select dma.serial_mat 
																		from detallemalla as dma inner join malla as mall 
																		on dma.serial_maa = mall.serial_maa
																		where mall.serial_maa in (select serial_maa 
																								from alumnomalla 
																								where serial_alu = ".$alu.")
																		and dma.serial_mat not in(select dmat.serial_mat 
																								from materiamatriculada as mmat
																								inner join 
																								detallemateriamatriculada as dmat 
																								on mmat.SERIAL_MMAT 
																								= dmat.serial_mmat
																								where mmat.SERIAL_ALU = ".$alu." 
																								group by dmat.serial_mat 
																								order by dmat.serial_mat) 
																		group by dma.serial_mat) 							
												and dcun.serial_mat not in(select materia from temporalMaterias where alumno = ".$alu.")																
												group by dcun.serial_mat order by dcun.serial_mat 
												limit 5";			
												
												
			
												
							
									//echo " ".$porTomar."</p>";																			
												
						$retporTomar=$dblink->Execute($porTomar);
									
									/*Saca el valor del alumno por categoria*/
									$valorCredito="select valor_dar,caa.nombre_caa,dde.porcentaje_dde, 
															(valor_dar * dde.porcentaje_dde) as costo   
															from detallearancel as dar, detalle_descuento as dde, 
															categoriaalumno as caa
															where dde.serial_dar = dar.serial_dar
															and dde.serial_caa = caa.serial_caa
															and dde.serial_caa in (select serial_caa from alumno 
																					where serial_alu = ".$alu.")";																					
															
															$retvalorCredito=$dblink->Execute($valorCredito);												
															$valor = $retvalorCredito->fields['costo'];	
															$cat = $retvalorCredito->fields['nombre_caa'];	
														
												//if($retporTomar->RecordCount()>0){	
													while (!$retporTomar->EOF){
															$mat=$retporTomar->fields['serial_mat'];
															$insert="INSERT INTO temporalMaterias
																		(materia, alumno) 
																		values(".$mat.",".$alu.")";															
															$dblink->Execute($insert);
															
															////Creditos por materia//////
															$numCreditos = "select numerocreditos_dma ,max(serial_dma) 
																			from detallemalla where serial_mat = ".$mat." group by serial_mat";																
															$retnumCreditos=$dblink->Execute($numCreditos);												
															$cred = $retnumCreditos->fields['numerocreditos_dma'];	
													
															////valor por alumno del credito incluido el decuemto/////
															
															
															$totalValor=$totalValor+($valor*$cred);
															$totalCreditos = $totalCreditos + $cred;
															
			echo $per."  A*  ".$alu." M* ".$mat." C* ".$cred." V* ".$valor." C* ".$cat." TC* ".$totalCreditos." V* ".$totalValor."</p>";							
															$retporTomar->MoveNext();				
													}
													
													
													
												//}																												
																
							//echo $tomadas."</p>";						
	
		
//}

	
	
}

?>
