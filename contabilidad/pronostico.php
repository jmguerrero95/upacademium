<?  
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');	
?>
<script>
function salir(){	
	window.close();
}	


/*function calcular(){
	alert(" vec " + document.presupuesto.vec[][].value)
	document.presupuesto.parametro[][].value = document.presupuesto.vec[][].value
	alert(" Para " + document.presupuesto.parametro[][].value)
	document.presupuesto.bandera.value = 1; 
	document.presupuesto.submit();
	
	
}*/	


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
	//echo "2- ".$par1[2]."</p>";//a�o
	//echo "3- ".$par1[2]."</p>";//departamento
	
	/*****valiada que se ingrese una sola ves por a�o y por sede*******/

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
		echo "El presupuesto para la sede ".$retvalidar->fields['nombre_suc']."  para el a�o ".$par1[2]." ya fue generada anteriormente ,";
		echo "<br> Ingrese para un a�o diferente o elija otra sede";							
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
	
	//****los periodod de un determinado a�o**********//
	
	$sucursal = $par[1]; // sede		
//	$periodoYa�o=$par[2]; // periodo + fecha

	$periodoYa�o = explode("*",$par[2]); //periodo + fecha
	
//	$a�o = $periodoYa�o[1];
	
	$a�o = explode("-",$periodoYa�o[1]);

	$periodo_unificado = $periodoYa�o[0];
	$a�o =	$a�o[0];
	
	
	echo "A�OOO".$a�o[0]."</p>";
	
	//echo $periodo_unificado;
	
	/*creacion de tabla temporal*/
/*	$tabla = "CREATE TEMPORARY TABLE temporalMaterias(
			alumno int(10) NOT NULL						
			, materia int(10)
			, sede int(1)
			) ENGINE=MEMORY;";
	$dblink->Execute($tabla);*/
////////$retalumno->MoveNext();	

//$anio=$par[3];

$fecha_ini = $a�o."-01-01"; //fecha del a�o sigueinte
$fecha_fin = $a�o."-12-31"; //fecha del a�oa siguiente

/*$calendario = "select cun.serial_per, per.fecini_per, per.fecfin_per 
							from calendariounificado as cun, periodo as per
							where cun.serial_per = per.serial_per
							and per.fecini_per > '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."'
							and per.serial_suc = ".$sucursal."
							group by cun.serial_per
							order by per.fecini_per asc";	*/
							
	$fecha_periodo = "select fecini_per from periodo where serial_per = ".$periodo_unificado;								
	$retfecha_periodo=$dblink->Execute($fecha_periodo);
/////////////////////////////////////////////////////////////////////////////////////////////////
	//$anio=date("Y");
	$anio="2009";
				$fecha_ini = $anio."-01-01"; //fecha del a�oa actual
				$fecha_fin = $anio."-12-31"; //fecha del a�oa actual				
//echo "---------------------$per .- </p>";	
				/*$alumno="select mmat.serial_alu, per.serial_per, alu.serial_per
				from materiamatriculada as mmat, periodo as per, alumno as alu 
				where mmat.SERIAL_PER = per.serial_per 
				and mmat.SERIAL_ALU = alu.serial_alu
				and per.fecini_per >= '".$fecha_ini."' and per.fecini_per <= '".$fecha_fin."'
				and per.serial_suc = ".$sucursal."
				group by SERIAL_ALU
				order by SERIAL_ALU";						*/
				
				/*SACA LOS ALUMNOS QUE ESTUDIARON EL EN PERIODO ACTUAL*/
				$alumno = "select mmat.serial_alu, per.serial_per, alu.serial_per, (valor_dar * dde.porcentaje_dde) as costo 
							from materiamatriculada as mmat, periodo as per, alumno as alu, 
							detalle_descuento as dde, detallearancel as dar  
							where mmat.SERIAL_PER = per.serial_per 
							and mmat.SERIAL_ALU = alu.serial_alu 
							and alu.serial_caa = dde.serial_caa
							and dde.serial_dar = dar.serial_dar
							and per.fecini_per >= '".$fecha_ini."' 
							and per.fecini_per <= '".$fecha_fin."' 
							and per.serial_suc = ".$sucursal." 
							group by SERIAL_ALU 
							order by SERIAL_ALU";
	

				//echo "$alu .- ".$alumno."</p>";
				$retalumno=$dblink->Execute($alumno);													
				

//if($retcalendario->RecordCount()>0){					
		$totalAlumnos=0;
		$i=1;
//		while (!$retcalendario->EOF){		
				$per = $periodo_unificado;
				//$per = $retcalendario->fields['serial_per'];
				$fechaInicio = $retfecha_periodo->fields['fecini_per'];
/*				$anio=date("Y");
	//$anio="2008";
				$fecha_ini = $anio."-01-01"; //fecha del a�oa actual
				$fecha_fin = $anio."-12-31"; //fecha del a�oa actual				
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
							$alu = $retalumno->fields['serial_alu'];//Asigna serial de  cada alumno que studio el en a�o actual																								
							
									//$vec[$i][1]=$alu;
									//$vec[$i][2]=$per;
									//$vec[$i][3]=$fechaInicio;
									
									//creditos($alu,$per,$totalAlumnos);
									
									/*$porTomar="select dcun.serial_mat, cun.serial_cun 
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
										*/
										
									$porTomar = "select dcun.serial_mat, cun.serial_cun 
													from calendariounificado as cun, detallecalendariounificado as dcun, detallemalla as dma, alumnomalla as ama 
													where cun.serial_cun = dcun.serial_cun
													and ama.serial_maa = dma.serial_maa
													and dcun.serial_mat = dma.serial_mat
													and serial_per = ".$per."
													and ama.serial_alu = ".$alu."
													and dma.serial_mat not in(select dmat.serial_mat 
																			  from materiamatriculada as mmat inner join
																			  detallemateriamatriculada as dmat 
																			  on mmat.SERIAL_MMAT = dmat.serial_mmat 
																			  where mmat.SERIAL_ALU = ".$alu."
																		  group by dmat.serial_mat order by dmat.serial_mat)       	                                    and dcun.serial_mat not in(select serial_mat from pronostico where serial_alu = ".$alu.") 
													group by dcun.serial_mat order by dcun.serial_mat limit 5";			
							
									//echo " ".$porTomar."</p>";																			
												
						$retporTomar=$dblink->Execute($porTomar);
															
									/*Saca el valor del alumno por categoria*/
								/*	$valorCredito="select valor_dar,caa.nombre_caa,dde.porcentaje_dde, 
															(valor_dar * dde.porcentaje_dde) as costo   
															from detallearancel as dar, detalle_descuento as dde, 
															categoriaalumno as caa
															where dde.serial_dar = dar.serial_dar 
															and dde.serial_caa = caa.serial_caa
															and dde.serial_caa in (select serial_caa from alumno 
																					where serial_alu = ".$alu.")";																											                                  */
															
															//$retvalorCredito=$dblink->Execute($valorCredito);												
															//$valor = $retvalorCredito->fields['costo'];																
															//$cat = $retvalorCredito->fields['nombre_caa'];	
															
														$valor = $retalumno->fields['costo'];																
												//echo "$alu .- ".$valorCredito."</p>";
												
												//if($retporTomar->RecordCount()>0){	
												while (!$retporTomar->EOF){
															$mat=$retporTomar->fields['serial_mat'];
															/*$insert="INSERT INTO temporalMaterias
																		(materia, alumno, sede) 
																		values(".$mat.",".$alu.",".$sucursal.")";															*/
															$insert="INSERT INTO pronostico
																		(serial_alu, serial_mat, serial_per, anio) 
																		values(".$alu.",".$mat.",".$per.",".$a�o.")";															
																
																															
															$dblink->Execute($insert);
															
															////Creditos por materia//////
															$numCreditos = "select numerocreditos_dma ,max(serial_dma) 
																			from detallemalla where serial_mat = ".$mat." group by serial_mat";																
															$retnumCreditos=$dblink->Execute($numCreditos);												
															
															$cred = $retnumCreditos->fields['numerocreditos_dma'];
													
															////valor por alumno del credito incluido el decuemto/////															
															
															$totalValor=$totalValor+($valor*$cred);
															
																													
															$totalCreditos = $totalCreditos + $cred;															
//echo $per."  A*  ".$alu." M* ".$mat." C* ".$cred." V* ".$valor." C* ".$cat." TC* ".$totalCreditos." V* ".$totalValor."</p>";															
															$retporTomar->MoveNext();				
													}																		
									$i=$i+1;								
						$retalumno->MoveNext();
				}			
			}	
			$mes = explode("-",$fechaInicio);
			$fechaActual= date("Y-n-j");
			$producto='SELECT srpd.serial_srpd, descripcion_sgrp 
					FROM subrubrosgrupospresupuestarios_departamentos AS srpd, 
					subgruposrubrospresupuestarios AS srp, 
					departamentos AS dep, gruposrubrospresupuestarios as grp, 
					tiposrubrospresupuestarios as trp
					WHERE srpd.serial_sgrp = srp.serial_sgrp 
					AND srpd.serial_dep = dep.serial_dep 
					and srp.SERIAL_GRP = grp.SERIAL_GRP
					and grp.SERIAL_TRP = trp.SERIAL_TRP
					AND srpd.serial_dep = '.$par[3].' 
					and (trp.TIPO_TRP like "INGRESO" and trp.automatico_trp like "SI")
					ORDER BY descripcion_sgrp';
			
			$meses[1][1]="CANTENERO_POP";		
			$meses[2][1]="CANTFEBRERO_POP";		
			$meses[3][1]="CANTMARZO_POP";		
			$meses[4][1]="CANTABRIL_POP";		
			$meses[5][1]="CANTMAYO_POP";		
			$meses[6][1]="CANTJUNIO_POP";		
			$meses[7][1]="CANTJULIO_POP";		
			$meses[8][1]="CANTAGOSTO_POP";		
			$meses[9][1]="CANTSEPTIEMBRE_POP";		
			$meses[10][1]="CANTOCTUBRE_POP";		
			$meses[11][1]="CANTNOBIEMBRE_POP";		
			$meses[12][1]="CANTDICIEMBRE_POP";
			
			$meses[1][2]="VALORENERO_POP";		
			$meses[2][2]="VALORFEBRERO_POP";		
			$meses[3][2]="VALORMARZO_POP";		
			$meses[4][2]="VALORABRIL_POP";		
			$meses[5][2]="VALORMAYO_POP";		
			$meses[6][2]="VALORJUNIO_POP";		
			$meses[7][2]="VALORJULIO_POP";		
			$meses[8][2]="VALORAGOSTO_POP";		
			$meses[9][2]="VALORSEPTIEMBRE_POP";		
			$meses[10][2]="VALOROCTUBRE_POP";		
			$meses[11][2]="VALORNOBIEMBRE_POP";		
			$meses[12][2]="VALORDICIEMBRE_POP";
			
					
			$retproducto=$dblink->Execute($producto);
				if($retproducto->RecordCount()>0){						
					//echo $producto;
					$var = $retproducto->fields['serial_srpd'];
//					select * from presupuestooperativo where ANIO_POP = 2009 and SERIAL_SUC = 2

				$control = "select * from presupuestooperativo where ANIO_POP = ".$a�o." and SERIAL_SUC = ".$sucursal;
				
					$retcontrol=$dblink->Execute($control);
									
					for($n=1;$n<=12;$n++){					
						if ($n==$mes[1]){
							if($retcontrol->RecordCount()>0){
							
								$existente="select ".$meses[$n][2]." as valor, ".$meses[$n][1]." as credito 
								from presupuestooperativo 
								where ANIO_POP = ".$a�o." 
								and SERIAL_SUC = ".$sucursal."
								and ".$meses[$n][2]." > 0";
								//echo $existente;
								$retexistente=$dblink->Execute($existente);		
			echo "Num cred:  ".$totalCreditos."  valor:  ".$totalValor." Mes: ".$mes[1]."fech per".$fechaInicio." A�O: ".$a�o."</p>";	
								if($retexistente->RecordCount()>0){
									$totalValor = $totalValor + $retexistente->fields['valor'];	
									$totalCreditos = $totalCreditos + $retexistente->fields['credito'];																									
								}				
								
								
								 $presupuesto = "update presupuestooperativo set ".$meses[$n][2]." = ".$totalValor.", ".$meses[$n][1]." = ".$totalCreditos." where SERIAL_SUC = ".$sucursal." and ANIO_POP = ".$a�o;
								
								//echo "update:  ".$presupuesto;		
							}else																	
								$presupuesto = "insert into presupuestooperativo
								 (SERIAL_SRPD, ".$meses[$n][1].",".$meses[$n][2].",
								 ANIO_POP, FECHAREALIZADA_POP,SERIAL_SUC,aprobado_pop) 								
								 values (".$var.",".$totalCreditos.",".$totalValor
								 .",".$a�o.",'".$fechaActual."',"
								 .$sucursal.",'NO')";
								 
								//echo " insert:  ".$presupuesto;	
								
									
							}
													
					}
					$dblink->Execute($presupuesto);
					
					$cantidadTotal=0;
					$valorTotal=0;
					for($j=1;$j<=12;$j++){
						
						$total="select ".$meses[$j][2]." as valor, ".$meses[$j][1]." as credito 
						from presupuestooperativo 
						where ANIO_POP = ".$a�o." 
						and SERIAL_SUC = ".$sucursal."
						and ".$meses[$j][2]." > 0";

						$rettotal=$dblink->Execute($total);	
						
						$valorTotal = $valorTotal + $rettotal->fields['valor'];
						$cantidadTotal = $cantidadTotal + $rettotal->fields['credito'];						
					}
					
					$upadeteTotales = "update presupuestooperativo set VALOR_POP = ".$valorTotal.", CANTIDAD_POP = ".$cantidadTotal.", APROBADO_POP = 'NO' where SERIAL_SUC = ".$sucursal." and ANIO_POP = ".$a�o;
					$retupadeteTotales=$dblink->Execute($upadeteTotales);
					
					
					
					echo "<html>";
					echo "<table align='center'> <tr><td align='center'>";
					echo "Se Genero el Presupuesto";						
					echo " </td></tr></table>";			
				
				}else{
					echo "<table align='center'> <tr><td align='center'>";
					echo "No se pudo generar el presupuesto autom�tico";						
					echo "</td></tr></table>";
				}
				
					
			
						
		echo "Num cred:  ".$totalCreditos."  valor:  ".$totalValor." Mes: ".$mes[1]."fech per".$fechaInicio." A�O: ".$a�o."</p>";	
		
		
		//$retcalendario->MoveNext();
	}
//}		
?>

<?
	//$destruir="DROP TABLE temporalMaterias";
	
	//$dblink->Execute($destruir);
	//$vec[0][0]=$totalAlumnos;
	//return $vec;
	
//}
/**********************************************************************************/


?>
