
<script type="text/javascript" src="../lib/fisheyes/jquery.js"></script>
<script type="text/javascript" src="../lib/fisheyes/interface.js"></script>

<!--<script language="javascript1.2" src="../lib/omnisoft.js"></script><script language="javascript1.2" src="../lib/zpmenu/utils/utils.js"></script>-->
<script language="javascript1.2" src="../lib/zpmenu/src/menu.js"></script>

<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
		require('../lib/adodb/adodb.inc.php');
        require('../config/config.inc.php');		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<htm>-->
<style type="text/css">
<!--
.style1 {font-size: 20px}
.style2 {font-size: 13px}
.style3 {font-size: 13px; font-weight:bold}
.style4 {font-size: 13px; font-weight:bold; color:#FFFFFF}
H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?
/*****************saca nombre de la sede y el periodo********************************/
$dblink = NewADOConnection($DBConnection);
$url=$_GET['query1'];		
$par = explode("|",$url);	
$sede='SELECT nombre_suc from sucursal where serial_suc ='.$par[4];	
$retsede=$dblink->Execute($sede);
$periodo='SELECT nombre_per from periodo where serial_per ='.$par[0];	
$retperiodo=$dblink->Execute($periodo);
/*select ce.SERIAL_CEVA, ce.SERIAL_EPL  
from cabecera_evaluacion as ce, empleado AS epl
where SERIAL_PER = 273
group by ce.SERIAL_EPL
order by epl.APELLIDO_EPL*/
?>
<? 
$url=$_GET['query1'];		
		$par = explode("|",$url);			
//Pone en cero los parametros de periodo empleado materia y tipo de evaluacion si esque se pasa un valor vacio PARA QUE NO DE ERROR LA CONSULTA
		for($i=0;$i<=4;$i++){		  
		  if($par[$i]=="")
		  $par[$i]=0;		
		}
		
			//echo " pro ".$par[1];//profesor
			//echo " mat ".$par[2];//materia

if	($par[1]=='TODOS'){	
	$todos = "select ce.SERIAL_CEVA, ce.SERIAL_EPL  
				from cabecera_evaluacion as ce, empleado AS epl
				where SERIAL_PER = ".$par[0]." 
				group by ce.SERIAL_EPL
				order by epl.APELLIDO_EPL";
			//echo "</p> todo: ".$todos;
			$rettodos=$dblink->Execute($todos);			
			//$numeritos=0;						
}
else{		
			$todos = "select ce.SERIAL_CEVA, ce.SERIAL_EPL, SERIAL_TEVA
						from cabecera_evaluacion as ce, empleado AS epl
						where SERIAL_PER = ".$par[0]."
						and ce.SERIAL_EPL = ".$par[1]."
						group by ce.SERIAL_EPL
						order by epl.APELLIDO_EPL";			
			//echo "</p> todo: ".$todos;
			$rettodos=$dblink->Execute($todos);			

}
			
	if($rettodos->RecordCount()>0){
					$bandera=0;
					 while(!$rettodos->EOF ){
						//echo "</p> num".$numeritos=$numeritos+1;	
					
						//echo "<p> empleado: ".$rettodos->fields['SERIAL_EPL'];
						//echo "<p> materia: ".$rettodos->fields['SERIAL_MAT'];
						if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";
					
					if	($par[1]=='TODOS'){	
						$empleado=$rettodos->fields['SERIAL_EPL'];
						//$materia=$rettodos->fields['SERIAL_MAT'];
					}
					else{
					$empleado=0;
					//$materia=0;
					}
$result = consulta(1,$empleado) ?>
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td rowspan="2" bgcolor="#FFFFFF"><img src="../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th colspan="2"><span class="style1">Promedio Total por Docentes</span></th>
  </tr>
  
</table>
<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 

<table align="center" width="80%">
  <tr>
	<td class="style3">Profesor:</td>
    <td class="style2"><? echo $result->fields['docente']; ?></td>
	<td class="style3">Periodo:</td>
    <td class="style2"><? echo $result->fields['nombre_per']; ?></td>
  </tr> 
  <tr>
	<td class="style3">Fecha:</td>
    <td class="style2"><? echo  date(d."-".m."-".Y);  ?>  </td>
  </tr>	
</table>


<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 

<table align="center" width="80%" >
<tr>
	<td class="style3">PRIMERA SECCIÓN:</td>
</tr>  

<tr>
	<td class="style3">ÁREAS DE EVALUACIÓN:</td>
	<td class="style3" align="right">PROMEDIOS:</td>	
</tr>  
</table>

<table align="center" width="80%" border="1" cellspacing="0" cellpadding="5" bordercolordark="#000000">
	<tr>
		<td>
	  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<? consulta(2,$empleado) ?>
			</table>	
		</td>
	</tr>
</table>

<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 
<table align="center" width="80%">
<tr>
	<!--<td class="style3">SEGUNDA SECCIÓN:</td>-->
</tr>  

	<? //consultaConsolidada($result->fields['serial_are'],$result->fields['serial_fac']) ?>	

</table>
<!--<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > -->

<table align="center" width="80%">
	<tr>
		<td class="style3">SEGUNDA SECCIÓN:</td>
	</tr>  
</table>

<table width="80%" border="1" align="center" cellspacing="0" cellpadding="5" bordercolor="#000000">
<tr>
	<td>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="style2" width="10%" align="center"> Nivel 1</td>
			<td class="style2">4,69 a 5,00</td>
			
		</tr>
		<tr>
			<td class="style2" width="10%" align="center" >Nivel 2</td>
			<td class="style2">3,75 a 4,68</td>
			
		</tr>
		<tr>
			<td class="style2" width="10%" align="center" >Nivel 3</td>
			<td class="style2" >3,13 a 3,74</td>		
		</tr>
		<tr>
			<td colspan="2" class="style2">  •	Los profesores que se encuentran en el nivel 3 estarán condicionados a capacitación y mejoramiento  </td>
		</tr>
		<tr>
			<td colspan="2" class="style2">  •	No se renueva contratación a aquellos con evaluación 3,12 hacia abajo  </td>
		</tr>
	  </table>
	</td>
</tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" width="25%">
<tr><td> <HR SIZE=0 WIDTH="100%" COLOR="#c0c0c0" align="center"></td></tr>
<tr><td class="style2" align="center"> Cordinación Académica</td></tr>
</table>

<?	
					$bandera=1;
					$rettodos->MoveNext();
				 }
			} 
?>
</body>
</html>           
<?php

function consulta($seccion,$empleado){
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$url=$_GET['query1'];	
		
		
		$par = explode("|",$url);	
		
		//Pone en cero los parametros de periodo empleado materia y tipo de evaluacion 			          si esque se pasa un valor vacio PARA QUE NO DE ERROR LA CONSULTA
		for($i=0;$i<=4;$i++){		  
		  if($par[$i]=="")
		  $par[$i]=0;		
		}
		
		if($par[1]=='TODOS'){	
			$par[1]=$empleado;			
		}
					
		/*$profesores='SELECT eva.PORCENTAJE_EVA as porcentaje ,sum( de.valor_rsp )as suma, count(*) as numpreguntas, ce.serial_teva, count(ce.serial_teva) as tipos, ce.serial_ceva, epl.serial_epl, epl.nombre_epl, mat.serial_mat, nombre_mat, count( DISTINCT arev.serial_arev ) AS numdeareas, max(rsp.valor_rsp) as maximovalor
					FROM cabecera_evaluacion ce, empleado AS epl, materia AS mat, horario AS hrr, detalle_evaluacion as de, pregunta_evaluacion AS prg, area_evaluacion AS arev, respuesta as rsp, evaluacion as eva 
					WHERE ce.serial_ceva = de.serial_ceva
					AND de.serial_prg = prg.serial_prg
					AND prg.serial_arev = arev.serial_arev
                    and ce.serial_mat = mat.serial_mat
					AND ce.serial_epl = epl.serial_epl
					AND ce.serial_hrr = hrr.serial_hrr
					and de.serial_rsp = rsp.serial_rsp
					and ce.SERIAL_EVA = eva.SERIAL_EVA
					and de.NA_RSP <> "SI"
					AND ce.serial_per ='.$par[0].'
					AND ce.serial_epl ='.$par[1].'					
					group by de.serial_ceva';	
																			*/
					$profesores = "select pev.SERIAL_AREV, serial_epl,count( DISTINCT cev.SERIAL_CEVA ) as num_eval, cev.SERIAL_CEVA, cev.serial_epl,cev.SERIAL_TEVA,eva.PORCENTAJE_EVA, sum(dev.VALOR_RSP) as suma ,aev.NOMBRE_AREV
						, count(cev.SERIAL_CEVA) as num_area, eva.PORCENTAJE_EVA/eva.PORCENTAJE_EVA
						from cabecera_evaluacion as cev, evaluacion as eva
						, detalle_evaluacion as dev, pregunta_evaluacion as pev, area_evaluacion aev  
						where cev.SERIAL_CEVA = dev.SERIAL_CEVA
						and cev.SERIAL_EVA = eva.SERIAL_EVA
						and dev.SERIAL_PRG = pev.SERIAL_PRG
						and pev.SERIAL_AREV = aev.SERIAL_AREV
						and cev.SERIAL_PER = ".$par[0]."
						AND cev.serial_epl =".$par[1]."
						and dev.NA_RSP <> 'SI'
						group by cev.serial_epl,cev.SERIAL_TEVA, pev.SERIAL_AREV
						order by cev.serial_epl,cev.SERIAL_TEVA";
										
				$retprofesor = $dblink->Execute($profesores);
				/////////////////////////////////////////////////
				echo "</p> SQL 1 ".$profesores."</p>";
				$cont=0;
				$areas=0;				
				
				////////////if($retprofesor->RecordCount()>0){
				 while(!$retprofesor->EOF ){				 
					 if ($retprofesor->fields['num_eval']>0){
					// $num_preguntas = "select * from detalle_evaluacion where SERIAL_CEVA = ".$retprofesor->fields['SERIAL_CEVA'];
					 $num_preguntas = "select count(*) as num_preguntas from detalle_evaluacion where SERIAL_CEVA = ".$retprofesor->fields['SERIAL_CEVA']." group by SERIAL_CEVA";
				 $retnum_preguntas = $dblink->Execute($num_preguntas);
					 
	//echo "profe: ".$retprofesor->fields['serial_epl']." area: ".$retprofesor->fields['SERIAL_AREV']." porcentaje: ".$retprofesor->fields['PORCENTAJE_EVA']." suma :".$retprofesor->fields['suma']." numero evaluaciones: ".$retprofesor->fields['num_area']/$retprofesor->fields['num_eval']." ".$retprofesor->fields['num_area']." /  ".$retprofesor->fields['num_eval']." num_preguntas :".$retnum_preguntas->fields['num_preguntas']."</p>";
					
	
					/*$valorMaximoXpregunta = 100/$retnum_preguntas->fields['num_preguntas'];
					//echo "VMP: ".$valorMaximoXpregunta."</p>";					
					$totalSumaXarea = $retprofesor->fields['suma']/$retprofesor->fields['num_eval'];
					//echo "TSA: ".$totalSumaXarea."</p>";					
					$valorMaximoXarea = $valorMaximoXpregunta*($retprofesor->fields['num_area']/$retprofesor->fields['num_eval']);
					//echo "VMA: ".$valorMaximoXarea."</p>";										
					$resul = ($totalSumaXarea*100)/$valorMaximoXarea;
					//echo "Result: ".$resul."</p>";					
					$resul = ($resul*5)/100;
					echo "Result 5%:  ".$resul."</p>";	
					*/
					
					
					$puntos = 100;
					$porcentaje=5;

					$suma = $retprofesor->fields['suma']/$retprofesor->fields['num_eval'];
					//echo "suma: ".$suma."</p>";
					
					echo "TOT : ".$retprofesor->fields['suma']."/".$retprofesor->fields['num_eval']."</p>"; 
					
					$valor = ($retprofesor->fields['PORCENTAJE_EVA'] * $suma)/$puntos;
					//echo "result : ".$result."</p>";					
													
					$result = ($porcentaje*$retprofesor->fields['PORCENTAJE_EVA'])/$puntos;
										//echo "5% : ".$result."</p>";
						
					$result = 	($result * $valor)/$retprofesor->fields['PORCENTAJE_EVA'];						                                                                                                                                                        echo "TOT : ".$result."</p>";    	
						
					}
						 
						
						
						
						
//						echo $retprofesor->fields['suma']."</p>";
						
				 				 
				/* if ($retprofesor->fields['maximovalor'] >0){
						$cont=$cont + 1; //numero de evaluaciones
						$resultado= 'SELECT count( * ) as numpreguntaxarea, 				                                     de.serial_rsp, sum( valor_rsp ) as sumaxarea, arev.nombre_arev,	arev.serial_arev 
									FROM detalle_evaluacion AS de, pregunta_evaluacion AS prg, area_evaluacion AS arev
									WHERE serial_ceva ='.$retprofesor->fields['serial_ceva'].' and NA_RSP <> "SI"
									AND de.serial_prg = prg.serial_prg
									AND prg.serial_arev = arev.serial_arev
									GROUP BY prg.serial_arev
									order by arev.nombre_arev';						
									
//						echo $resultado."</p>";								
						$retresultado=$dblink->Execute($resultado);	

						$i=1;
						
							while(!$retresultado->EOF){						
								if($retresultado->fields['numpreguntaxarea']>0){
									$i=$retresultado->fields['serial_arev']; //asignamos el numero de area para guardar en un vectot vi
	
//formula para calcular la suma que da por cada area multiplicado para 100 todo eso dividido para la divicion de 100 para el numero de preguntas total multiplicado para el numero de preguntas por area

							//echo "</p> SUMA X AREA ".$retresultado->fields['sumaxarea']."</p>";
							
					 
						
						$porcentaje_evaluadores = (((100*$retresultado->fields['sumaxarea'])/(($retprofesor->fields['maximovalor'])*$retresultado->fields['numpreguntaxarea'])) * $retprofesor->fields['porcentaje'])/100;
						
						$porcentaje_cinco = $porcentaje_evaluadores;
						
						$total[1][$i] = $total[1][$i] + $porcentaje_cinco;
						
						echo "</p> Total ".(((100*$retresultado->fields['sumaxarea'])/(($retprofesor->fields['maximovalor'])*$retresultado->fields['numpreguntaxarea'])) * $retprofesor->fields['porcentaje'])/100 ."  ----  ".$i."</p>";
						//echo "$total[1][$i] + ((100*$retresultado->fields['sumaxarea'])/(($retprofesor->fields['maximovalor'])*$retresultado->fields['numpreguntaxarea']))";
						
					//	echo "</p> suma area: ".$retresultado->fields['sumaxarea'];
						//echo "</p> maximo valor: ".$retprofesor->fields['maximovalor'];
						//echo "</p> numero de preguntas: ".$retresultado->fields['numpreguntaxarea']." </p> ";
//$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;			
				                        
									//echo "|";
								$total[2][$i] = $retresultado->fields['serial_arev'];
							}		
								$retresultado->MoveNext();							
																
						}
					}		*/	
						$retprofesor->MoveNext();
						
				   }
				  //} 
				 //}
				 					 
				 $datosprofesor='SELECT ce.serial_epl, concat_ws(" ",apellido_epl, nombre_epl) as docente, de.serial_prg, prg.serial_arev, de.serial_deva, de.serial_ceva, ce.serial_teva, arev.nombre_arev, per.nombre_per
FROM detalle_evaluacion AS de, cabecera_evaluacion ce, empleado as epl, pregunta_evaluacion as prg, area_evaluacion as arev, facultad as fac, periodo as per
					 WHERE de.serial_ceva = ce.serial_ceva 					 
					 and ce.serial_epl = epl.serial_epl 					 
                     and de.serial_prg = prg.serial_prg
                     and arev.serial_arev = prg.serial_arev                     					 
					 and per.serial_per = ce.serial_per 
					 and de.NA_RSP <> "SI"   
					 AND ce.serial_per ='.$par[0].'
					 AND ce.serial_epl ='.$par[1].'					 
					 GROUP BY prg.serial_arev
					 order by arev.nombre_arev';	
					 
					 //echo "</p>".$datosprofesor."</p>";					 
					 				 
					 $retcalculos=$dblink->Execute($datosprofesor);	
					 $retdatosprofesor=$dblink->Execute($datosprofesor);	
					 
					 //echo "</p> datos profe".$datosprofesor;
					 if($retcalculos->RecordCount()>0){
					 while(!$retcalculos->EOF){
					 		if ($seccion==2){
								echo "<tr>";						
								   echo "<td class='style2'>".$retcalculos->fields['nombre_arev']."</td>";
								  // echo "<td class='style2'>".$retdatosprofesor->fields['serial_arev']."</td>";
								  
								  //saca el total de filas en el vector
								  	   	$vec = (count($total,1)/count($total,0))-1;	 																			
										
										for ($i=1;$i<=$vec;$i++){
												if($total[2][$i]==$retcalculos->fields['serial_arev']){													
													echo "<td class='style2' align='center'>".$tot = number_format((($total[1][$i]/$cont)*5)/100,2)."</td>";													
													$tot1 =$tot1+$tot;
												
												}																				
																								
										}		
																																										   								echo "</tr>";																																											                                 echo "<tr>";
									echo '<td>'.'<HR SIZE=0 WIDTH="100%" COLOR="#c0c0c0" align="center" >'.'</td>';	
									echo '<td>'.'<HR SIZE=0 WIDTH="100%" COLOR="#c0c0c0" align="center" >'.'</td>';																			
								 echo "</tr>";
							}
								
							//echo "</p>";
					 		$retcalculos->MoveNext();							
								
							
					 }	
					 }						 
					 if($vec!=0){
					 echo "<tr>";
					 echo "<td class='style3'>"."Total Parcial"."</td>";
					 echo "<td class='style4' align='center'  bgcolor='#000000'>".number_format($tot1/$vec,2)."</td>";
					 echo "</tr>";
						//echo $tot1/$vec;
				}
	return $retdatosprofesor;			 	
				 
}

function consultaConsolidada($area,$facultad){
  //echo "consolidado";
  global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$url=$_GET['query1'];
		//echo "consolidada:".$url;
		
		$par = explode("|",$url);	
		
		for($i=0;$i<=4;$i++){		  
		  if($par[$i]=="")
		  $par[$i]=0;
		  //echo "</p>".$i."->  ".$par[$i];			  
		}
		if($area=="")
			$area = 0;

		if($facultad=="")
			$facultad = 0;	
		
		//echo $facultad;
		/*echo"|";
		echo $par[2];
		echo"|";
		echo $par[0];*/
		
		/********va sacando el Total de todos de los profesores filtrado por area y periodo************/					
		
					
					$promedio='select ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval, eva.PORCENTAJE_EVA 
								from cabecera_evaluacion ce, detalle_evaluacion de, horario hrr, evaluacion as eva
								where ce.SERIAL_HRR = hrr.SERIAL_HRR
								and ce.serial_ceva = de.serial_ceva
								and ce.SERIAL_TEVA = eva.SERIAL_TEVA
								and ce.serial_per = '.$par[0].' 
								and de.NA_RSP <> "SI"
								and hrr.serial_are = '.$area.' 
								GROUP BY ce.serial_teva';
			
								
					$retpromedio=$dblink->Execute($promedio);
/////////////////////////echo "</p>".$promedio."</p>";
					$porcentaje = 0;
					echo "</tr>";
					//echo "</p> Contador: ".$retpromedio->RecordCount();
					
				if($retpromedio->RecordCount()>0){	
				
					while(!$retpromedio->EOF ){						
						
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							                        
						
					  $retpromedio->MoveNext();
					}	
				}														
					$total = ($porcentaje * 5)/100; 							
					echo "<td class='style2'>Promedio por Áreas:</td>";
					echo "<td align='right' class='style3'>".number_format($total,2) ."<td>";
					echo "</tr>";
					
/********va sacando el Total de de todos profesores filtrado por facultad y periodo************/					
			
								
						$promediofacultad='select ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) as num_eval, eva.PORCENTAJE_EVA
							from cabecera_evaluacion as ce, detalle_evaluacion as de, horario as hrr, evaluacion as eva 
							WHERE de.serial_ceva = ce.serial_ceva 
							and hrr.serial_hrr=ce.serial_hrr
							and ce.SERIAL_TEVA = eva.SERIAL_TEVA
							AND ce.serial_per ='.$par[0].'
							and serial_fac = '.$facultad.'
							and de.NA_RSP <> "SI" 
							group by ce.serial_teva';
							
					//echo "FAC :".$promediofacultad;					
					$retpromediofacultad=$dblink->Execute($promediofacultad);
					$porcentajef = 0;
					echo "</tr>";
					echo "</p>";
					while(!$retpromediofacultad->EOF ){	
						
							$porcentajef = $porcentajef + ($retpromediofacultad->fields['PORCENTAJE_EVA'] * ($retpromediofacultad->fields['suma']/$retpromediofacultad->fields['num_eval']))/100;			
							//}
					  $retpromediofacultad->MoveNext();
					}														
					$totalf = ($porcentajef * 5)/100; 							
					echo "<td class='style2'>Promedio por Facultad:</td>";
					echo "<td align='right' class='style3'>".number_format($totalf,2) ."<td>";
					echo "</tr>";					
					
					
					
					/********va sacando el Total de todos los profesores filtrado por Periodo************/					
			
						
						
						
						$promedioperiodo='select ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) as num_eval, eva.PORCENTAJE_EVA
							from cabecera_evaluacion as ce, detalle_evaluacion as de, horario as hrr, evaluacion as eva
							WHERE de.serial_ceva = ce.serial_ceva 
							and hrr.serial_hrr=ce.serial_hrr
							and ce.SERIAL_TEVA = eva.SERIAL_TEVA
							AND ce.serial_per ='.$par[0].'
							and de.NA_RSP <> "SI" 
							group by ce.serial_teva';


								
					$retpromedioperiodo=$dblink->Execute($promedioperiodo);
					$porcentajef = 0;
					echo "</tr>";
					echo "</p>";
					while(!$retpromedioperiodo->EOF ){						
						
							$porcentajep = $porcentajep +	($retpromedioperiodo->fields['PORCENTAJE_EVA'] * ($retpromedioperiodo->fields['suma']/$retpromedioperiodo->fields['num_eval']))/100;			
						
					  $retpromedioperiodo->MoveNext();
					}														
					$totalp = ($porcentajep * 5)/100; 							
					echo "<td class='style2'>Promedio de Sede Periodo de Evaluación:</td>";
					echo "<td align='right' class='style3'>".number_format($totalp,2) ."<td>";
					echo "</tr>";					
					
				 
}
?>