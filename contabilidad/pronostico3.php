<?  
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');	
?>
<script>
function salir(){	
	window.close();
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
	$validar =  "select suc.nombre_suc 
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
				and pop.SERIAL_SUC = ".$par1[1];
	$retvalidar=$dblink->Execute($validar);
	if($retvalidar->RecordCount()>0){
		echo "<table align='center'> <tr><td align='center'>";
		echo "El presupuesto para la sede ".$retvalidar->fields['nombre_suc']."  para el año ".$par1[2]." ya fue generada anteriormente ,";
		echo "<br> Ingrese para un año diferente o elija otra sede";							
		echo " </td></tr></table>";	
	}else{generarapresupuesto();}			
				
		
?>	
<table align="center"><tr><td>			
		<input type="button" name "salir" value="Salir" onClick="salir()" />
</td></tr></table>
</body>
<?

function generarapresupuesto(){
	require('../lib/adodb/adodb.inc.php');
	require('../config/config.inc.php');	
	$dblink = NewADOConnection($DBConnection);
	
	$url = $_GET['query1'];
	$par = explode("|",$url);
	
	//****los periodod de un determinado año**********//
	$anio=date("Y");
	//$anio="2008";
	$fecha_ini = $anio."-01-01"; //fecha del añoa actual
	$fecha_fin = $anio."-12-31"; //fecha del añoa actual
	
	$costoalternativo = "select valor_dar, fecha_ara from aranceles as ara, detallearancel as dar, detallefactura as dfa, 
							cabecerafactura as caf
							where ara.serial_ara = dar.serial_ara 
							and dar.serial_dar = dfa.serial_dar
							and caf.serial_caf= dfa.serial_caf
							and nombre_ara like 'credit%'
							and (fecha_ara > '".$fecha_ini."' and fecha_ara < '".$fecha_fin."')
							and fecha_ara
							limit 1";
					
							
	
	$retcostoalternativo = $dblink->Execute($costoalternativo);						
	$costoalternativo = $retcostoalternativo->fields['valor_dar'];
	$sucursal = $par[1]; 
	$generer = $par[3];
	
	/*$periodos = "select serial_per, fecini_per, fecfin_per
					from periodo as per
					where per.fecini_per > '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."'
					and per.serial_suc = ".$sucursal."
					and activo_per like 'SI'					
					order by per.fecini_per asc";								*/
					
	$periodos = "select per.serial_per, fecini_per from materiamatriculada as mmat, periodo as per  
					where mmat.SERIAL_PER=per.serial_per
					and (per.fecini_per >= '".$fecha_ini."' and per.fecini_per <= '".$fecha_fin."')
					and mmat.SERIAL_SUC = ".$sucursal."
					group by mmat.serial_per
					order by per.fecini_per";
	
	//$anio=date("Y");
	$anio=$par[2];
	$fecha_ini = $anio."-01-01"; //fecha del año sigueinte
	$fecha_fin = $anio."-12-31"; //fecha del añoa siguiente
								
	//***********************Los periodos del Calendario Unificado*******************************///
	$periodocalendario = "select cun.serial_per, per.fecini_per, per.fecfin_per from calendariounificado as cun, periodo as per
							where cun.serial_per = per.serial_per
							and per.fecini_per > '".$fecha_ini."' and per.fecini_per < '".$fecha_fin."'
							and per.serial_suc = ".$sucursal."
							group by cun.serial_per
							order by per.fecini_per asc";
	
	
	$retperiodos=$dblink->Execute($periodos);
	$retperiodocalendario=$dblink->Execute($periodocalendario);
	$i=0; //varialble pa recorre el vector en donde se guardan los resultados
	if($retperiodos->RecordCount()>0){
	$aux =0;
		while (!$retperiodos->EOF or !$retperiodocalendario->EOF){
			$total=0;
			$periodo = $retperiodos->fields['serial_per'];
			$periodocalendariou = $retperiodocalendario->fields['serial_per'];
			$guardarfecha = $retperiodocalendario->fields['fecini_per'];
			
			$fechaper = $retperiodos->fields['fecini_per'];
					
	/*******************SACA LOS ALUMNOS DE UN DETERMINADO PERIODO****************/
			if($periodo==""){
				$periodo=0;
			}
/*			if($periodocalendariou==""){
				$periodocalendariou=0;
			}*/
			
			$alumnos="select SERIAL_ALU, per.serial_per, per.fecini_per
					from materiamatriculada as mmat, periodo as per
					where mmat.SERIAL_PER = per.serial_per
					and mmat.SERIAL_PER = ".$periodo."
					order by SERIAL_ALU";
			echo $alumnos."</p>";		
			$retalumnos=$dblink->Execute($alumnos);		
			if($retalumnos->RecordCount()>0){		
				
				while (!$retalumnos->EOF ){					
					$alumno = $retalumnos->fields['SERIAL_ALU'];					
					
						//$total_costo=creditos($alumno,$periodo,$periodocalendariou,$costoalternativo);
						matriculas($alumno,$periodo,$periodocalendariou,$costoalternativo);												
						$total = $total + $total_costo;
					
					$retalumnos->MoveNext();					
					
				}
				              
				echo "*ToTal**$total***calendario****$periodocalendariou****periodo*****$periodo************************</p>";
			}
			//echo "</p>****".$total."********".$guardarfecha."***********".$periodo."</p>";					
			$i++;
			$vec[$i][0] = $total;			
			$vec[$i][1] = $guardarfecha;	
			
			//echo "-".$vec[$i][0]." == ".$total;			
			//echo "->".$vec[$i][1]." == ".$guardarfecha."</p>";			
			
			$retperiodos->MoveNext();
			$retperiodocalendario->MoveNext();
		}
		if($retperiodos->RecordCount()>$retperiodocalendario->RecordCount()){
			$numper = $retperiodos->RecordCount();//cuantos periodos encontro
		}else{
			$numper = $retperiodocalendario->RecordCount();//cuantos periodos encontro
		}
		
	}
	
	/**************************************************GUARDAR INGRESO**************************************************/
			for ($i=1;$i<=$numper;$i++){	
	//				for ($i=1;$i<=2;$i++){						
					//echo $mes[1]."</p>";
					
			//echo " tot: ".$vec[$i][0];
			//echo " fec: ".$vec[$i][1]."</p>";	
			
					for($n=1;$n<=12;$n++){
						$mes = explode("-",$vec[$i][1]);
						//$año=$mes[0];
						$año=$par[2];
						//echo $año;
						if ($mes[1]	== $n){						 
							 $presupuestomes [$n][1]= 1;										 	
									$presupuestomes [$n][2] = $presupuestomes [$n][2] + $vec[$i][0]; // valor						
//							echo	"entro  ";
								
						}
						
					//	echo	"</p> ";
					}							
			}
				 
		//echo "/////////////".$presupuestomes [4][2]."</p>";		
			for($j=1;$j<=12;$j++){					
						if($presupuestomes[$j][2] == ""){
							$presupuestomes[$j][2] = 0; //valor
						}
						if($presupuestomes[$j][1] == ""){
							$presupuestomes[$j][1] = 0;//cantidad
						}					
						//echo "# ".$j."-".$presupuestomes[$j][1]."-".$presupuestomes[$j][2]."</p>";				
						$totalaño=$totalaño + $presupuestomes[$j][2];																
						
			}		
		//	echo $año;		
	$producto='SELECT srpd.serial_srpd, descripcion_sgrp 
					FROM subrubrosgrupospresupuestarios_departamentos AS srpd, 
					subgruposrubrospresupuestarios AS srp, 
					departamentos AS dep, gruposrubrospresupuestarios as grp, 
					tiposrubrospresupuestarios as trp
					WHERE srpd.serial_sgrp = srp.serial_sgrp 
					AND srpd.serial_dep = dep.serial_dep 
					and srp.SERIAL_GRP = grp.SERIAL_GRP
					and grp.SERIAL_TRP = trp.SERIAL_TRP
					AND srpd.serial_dep = '.$par[4].' 
					and (trp.TIPO_TRP like "INGRESO" and trp.automatico_trp like "SI")
					ORDER BY descripcion_sgrp';
	
			$retproducto=$dblink->Execute($producto);
							if($retproducto->RecordCount()>0){														
									$fechaActual = date(Y."-".m."-".d);								
									$var = $retproducto->fields['serial_srpd'];								
									
								 $presupuesto = "insert into presupuestooperativo
								 (SERIAL_SRPD,CANTENERO_POP,VALORENERO_POP,CANTFEBRERO_POP,VALORFEBRERO_POP,
								 CANTMARZO_POP,VALORMARZO_POP,CANTABRIL_POP,VALORABRIL_POP,						 													 	 						 CANTMAYO_POP,VALORMAYO_POP,CANTJUNIO_POP,VALORJUNIO_POP,
								 CANTJULIO_POP,VALORJULIO_POP, CANTAGOSTO_POP,VALORAGOSTO_POP,
								 CANTSEPTIEMBRE_POP,VALORSEPTIEMBRE_POP,CANTOCTUBRE_POP,VALOROCTUBRE_POP,
								 CANTNOVIEMBRE_POP,VALORNOVIEMBRE_POP,CANTDICIEMBRE_POP,VALORDICIEMBRE_POP,
								 ANIO_POP,VALOR_POP, FECHAREALIZADA_POP,SERIAL_SUC,aprobado_pop) 
								
								 values (".$var.",".$presupuestomes[1][1].",".$presupuestomes[1][2].","
								 .$presupuestomes[2][1].",".$presupuestomes[2][2].",".$presupuestomes[3][1].",".$presupuestomes[3][2].","
								 .$presupuestomes[4][1].",".$presupuestomes[4][2].",".$presupuestomes[5][1].",".$presupuestomes[5][2]
								 .",".$presupuestomes[6][1].",".$presupuestomes[6][2].",".$presupuestomes[7][1].",".$presupuestomes[7][2]
								 .",".$presupuestomes[8][1].",".$presupuestomes[8][1].",".$presupuestomes[9][1].",".$presupuestomes[9][2]
								 .",".$presupuestomes[10][1].",".$presupuestomes[10][2].",".$presupuestomes[11][1].",".$presupuestomes[11][2]
								 .",".$presupuestomes[12][1].",".$presupuestomes[12][2].",".$año.",".$totalaño.",'".$fechaActual."',"
								 .$sucursal.",'NO')";
								//echo $presupuesto;
//*******	$dblink->Execute($presupuesto);
								echo "<html>";
								echo "<table align='center'> <tr><td align='center'>";
								echo "Se Genero el Presupuesto";						
								echo " </td></tr></table>";
							}
							else{			
									echo "<table align='center'> <tr><td align='center'>";
									echo "No se pudo generar el presupuesto automático";						
									echo " </td></tr></table>";
							}
							
							//echo "</p>".$presupuesto."</p>";						
	}
	


/**********************************************************************************/

function creditos($alumno,$periodo,$periodocalendariou,$costoalternativo){		

require('../lib/adodb/adodb.inc.php');
require('../config/config.inc.php');	
$dblink = NewADOConnection($DBConnection);
																		
			/************************Las que Tomo el periodo anterior ***********************/		
			//echo "-> ".$periodocalendariou."</p>";
			
					$tomadas = "select mmat.SERIAL_ALU,mmat.SERIAL_MMAT, mmat.SERIAL_PER,dmat. serial_dmat,count(dmat.serial_mat),
						sum(dmat.numerocreditos_dmat) as creditostomados
						from materiamatriculada as mmat, detallemateriamatriculada as dmat
						where mmat.SERIAL_MMAT = dmat.serial_mmat
						and mmat.SERIAL_PER = ".$periodo."
						and mmat.SERIAL_ALU = ".$alumno."
						group by SERIAL_ALU
						order by mmat.SERIAL_ALU";
	//echo $tomadas."</p>";						
					$rettomadas=$dblink->Execute($tomadas);
														
					if($rettomadas->RecordCount()>0){				
						$creditostomados = $rettomadas->fields['creditostomados'];										
						echo "CREDITOS: ".$rettomadas->fields['creditostomados']."</p>";
					}else{$creditostomados=0;}				
													
	///////****************Saca el valor por alumno del credito***********////							
					$valor = "select alu.serial_alu, caa.nombre_caa, dde.porcentaje_dde, 
								dar.valor_dar, (dde.porcentaje_dde * dar.valor_dar) as decuento, 
								dar.valor_dar - (dde.porcentaje_dde * dar.valor_dar) as valor
								from alumno as alu, categoriaalumno as caa, detalle_descuento as dde,
								aranceles as ara, detallearancel as dar
								where alu.serial_caa = caa.serial_caa
								and caa.serial_caa = dde.serial_caa
								and alu.serial_per = ara.serial_per
								and ara.serial_ara = dar.serial_ara
								and alu.serial_alu = ".$alumno."
								and ara.credito_ara like 'SI'";
	///echo $valor."</p>";											
					$retvalor=$dblink->Execute($valor);				
									$aux = $aux + 1;
					if($retvalor->RecordCount()>0){				
						$valorcredito = $retvalor->fields['valor_dar'];		
					}else{
						$valorcredito = $costoalternativo;					
					}
								
					echo "valor: ".$valorcredito."</p>";
					if($periodocalendariou == ""){
					 //echo "es nulo";
					 	$periodocalendariou = 0;
					 
					}					
		//***************Las del Calendario Unificado que le falten por tomar**************************************/
					$calendario="select dcun.serial_dcun, per.serial_per, dcun.serial_mat, mat.nombre_mat, dma.numerocreditos_dma
									from calendariounificado as cun, periodo as per, detallecalendariounificado as dcun,
									materia as mat, detallemalla as dma
									where cun.serial_per = per.serial_per
									and cun.serial_cun = dcun.serial_cun
									and dcun.serial_mat = mat.serial_mat
									and mat.serial_mat = dma.serial_mat	
									and per.SERIAL_PER = ".$periodocalendariou."				
									and mat.serial_mat in (select dma.serial_mat
															from malla as maa, detallemalla as dma
															where maa.serial_maa = dma.serial_maa
															and maa.serial_maa in (select serial_maa
																				   from alumnomalla
																					where serial_alu = ".$alumno.")
																					AND dma.serial_mat not in(select dmat.serial_mat 
																							from detallemateriamatriculada as dmat,
																							 materiamatriculada as mmat
																							 where dmat.serial_mmat = mmat.serial_mmat
																							 and mmat.SERIAL_ALU = ".$alumno."																								 																						 and dmat.estadomateria_dmat = 'APROBADO')
															)
									group by dcun.serial_mat
									order by per.serial_per";
									//echo "alendario ".$calendario."</p>";	
					$retcalendario=$dblink->Execute($calendario);
					
	
//echo "Periodo: ".$retperiodos->RecordCount();
//echo "Calendario: ".$retperiodocalendario->RecordCount();

					if($retcalendario->RecordCount()>0){
						$portomar=$retcalendario->RecordCount();								
						$creditosportomar = 0;					
						while (!$retcalendario->EOF ){
							$creditosportomar = $creditosportomar + $retcalendario->fields['numerocreditos_dma'];						
							$retcalendario->MoveNext();	
							//echo "alum "										
							}
					}else{$creditosportomar = 0;}								
					
				/** Coge el número menor **/						
					 if($creditosportomar < $creditostomados){
							$subtotal = ($creditosportomar * $valorcredito);
							//echo "Por Tomar"."$subtotal = ($creditosportomar * $valorcredito);".$subtotal."=".$creditosportomar."*".$valorcredito."</p>"; 										 		
					 }else{
							$subtotal = ($creditostomados * $valorcredito);
							//echo "Tomados"."$subtotal = ($creditostomados * $valorcredito);".$subtotal."=".$creditostomados."*".$valorcredito."</p>"; 										 		
						   }							
					$total = $total + $subtotal;								 				
					//echo "->".$total."</p>";	
					return $total;		
									
} 

function matriculas($alumno,$periodo,$periodocalendariou,$costoalternativo){
		
		echo $alumno." * ".$periodo." * ".$periodocalendariou." * ".$costoalternativo."</p>";
			
}
?>


