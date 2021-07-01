
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<htm>
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

<script type="text/javascript" src="../lib/fisheyes/jquery.js"></script>
<script type="text/javascript" src="../lib/fisheyes/interface.js"></script>

<!--<script language="javascript1.2" src="../lib/omnisoft.js"></script><script language="javascript1.2" src="../lib/zpmenu/utils/utils.js"></script>-->
<script language="javascript1.2" src="../lib/zpmenu/src/menu.js"></script>

<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
		require('../lib/adodb/adodb.inc.php');
        require('../config/config.inc.php');		
?>
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
	$todos = "select SERIAL_EPL, SERIAL_MAT
			from cabecera_evaluacion 
			where SERIAL_TEVA = ".$par[3]." and SERIAL_PER = ".$par[0]."
			group by SERIAL_EPL, SERIAL_MAT
			order by SERIAL_MAT";
			//echo "</p> todo: ".$todos;
			$rettodos=$dblink->Execute($todos);			
			//$numeritos=0;						
}
else{

/*echo " per  ".$par[0];//periodo		
			echo " pro ".$par[1];//profesor
			echo " mat ".$par[2];//materia
			
		echo " tipo eva ".$par[3];//tipo evaluadores
		echo " suc ".$par[4];//sucursal
*/
		
$todos = "select SERIAL_EPL, SERIAL_MAT 
			from cabecera_evaluacion 
			where SERIAL_TEVA = ".$par[3]."
			and SERIAL_PER = ".$par[0]." 
			and SERIAL_EPL = ".$par[1]."
			and SERIAL_MAT =".$par[2]."
			group by SERIAL_EPL
			order by SERIAL_MAT";			
			//echo "</p> todo: ".$todos;
			$rettodos=$dblink->Execute($todos);			

}
			
	if($rettodos->RecordCount()>0){
					$bandera =0;
					 while(!$rettodos->EOF ){
					//echo "</p> num".$numeritos=$numeritos+1;						
					
						//echo "<p> empleado: ".$rettodos->fields['SERIAL_EPL'];
						//echo "<p> materia: ".$rettodos->fields['SERIAL_MAT'];
						if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";
					
					if	($par[1]=='TODOS'){	
						$empleado=$rettodos->fields['SERIAL_EPL'];
						$materia=$rettodos->fields['SERIAL_MAT'];
					}
					else{
					$empleado=0;
					$materia=0;
					}
					
$result = consulta(1,$empleado,$materia) 
?>
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td rowspan="2" bgcolor="#FFFFFF"><img src="../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th colspan="2"><span class="style1">Reportes de Evaluaciones a Docentes</span></th>
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
	<td class="style3">Materia:</td>
    <td class="style2"><? echo $result->fields['nombre_mat']; ?></td>
	<td class="style3">Facultad:</td>
    <td class="style2"><? echo $result->fields['nombre_fac']; ?></td>
  </tr> 
  <tr>
	<td class="style3">Área:</td>
    <td class="style2"><? echo $result->fields['nombre_are']; ?></td>
	<td class="style3">Fecha:</td>
    <td class="style2"><? echo  date(d."-".m."-".Y);  ?>  </td>
  </tr> 
  <tr>
	<td class="style3">Sección:</td>
    <td class="style2"><? echo $result->fields['seccion_hrr'];?>
	</td>
  </tr>   
</table>


<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center"> 

<table align="center" width="80%" >
<tr>
	<td class="style3">PRIMERA SECCIÓN:</td>
</tr>  

<tr>
	<td class="style3">ÁREAS DE EVALUACIÓN:</td>
	<td class="style3" align="right">EVALUACIÓN POR <? echo $result->fields['tipo_teva']; ?>:</td>	
</tr>  
</table>

<table align="center" width="80%" border="1" cellspacing="0" cellpadding="5" bordercolordark="#000000">
	<tr>
		<td>
	  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<? consulta(2,$empleado,$materia) ?>
			</table>	
		</td>
	</tr>
</table>

<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 
<table align="center" width="80%">
<tr>
	<td class="style3">SEGUNDA SECCIÓN:</td>
</tr>  

	<? consultaConsolidada($result->fields['serial_are'],$result->fields['serial_fac']) ?>	

</table>
<HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 

<table align="center" width="80%">
	<tr>
		<td class="style3">TERCERA SECCIÓN:</td>
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
<p>&nbsp;</p>
<table align="center" width="25%">
<tr><td> <HR SIZE=0 WIDTH="100%" COLOR="#c0c0c0" align="center"></td></tr>
<tr><td class="style2" align="center"> Cordinación Académica</td></tr>

</table>

<?	$bandera =1;
					$rettodos->MoveNext();
				 }
			} 
?>

</body>
</html>           
<?php

function consulta($seccion,$empleado,$materia){
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$url=$_GET['query1'];		
		$par = explode("|",$url);			
//Pone en cero los parametros de periodo empleado materia y tipo de evaluacion si esque se pasa un valor vacio PARA QUE NO DE ERROR LA CONSULTA
		for($i=0;$i<=4;$i++){		  
		  if($par[$i]=="")
		  $par[$i]=0;		
		}
		
		if($par[1]=='TODOS'){	
			$par[1]=$empleado;
			$par[2]=$materia;
		}
		//LE	
		/*echo " per  ".$par[0];//periodo		
			echo " pro ".$par[1];//profesor
			echo " mat ".$par[2];//materia
			
		echo " tipo eva ".$par[3];//tipo evaluadores
		echo " suc ".$par[4];//sucursal*/
		
		
		$profesores='SELECT sum( de.valor_rsp )as suma, count(*) as numpreguntas, ce.serial_teva, count(serial_teva) as tipos, ce.serial_ceva, epl.serial_epl, epl.nombre_epl, mat.serial_mat, nombre_mat, count( DISTINCT arev.serial_arev ) AS numdeareas,max(rsp.valor_rsp) as maximovalor
					FROM cabecera_evaluacion ce, empleado AS epl, materia AS mat, horario AS hrr, detalle_evaluacion as de, pregunta_evaluacion AS prg, area_evaluacion AS arev, respuesta as rsp
					WHERE ce.serial_ceva = de.serial_ceva
					AND de.serial_prg = prg.serial_prg
					AND prg.serial_arev = arev.serial_arev
                    and ce.serial_mat = mat.serial_mat
					AND ce.serial_epl = epl.serial_epl
					AND ce.serial_hrr = hrr.serial_hrr
					and de.serial_rsp = rsp.serial_rsp
					and de.NA_RSP <> "SI"
					AND ce.serial_per ='.$par[0].'
					AND ce.serial_epl ='.$par[1].'
					AND ce.serial_mat ='.$par[2].'
					AND ce.serial_teva ='.$par[3].'
					group by de.serial_ceva';						
					 
				$retprofesor=$dblink->Execute($profesores);
				//echo "</p> SQL 1   ".$profesores;
				$cont=0;
				$areas=0;				
				//$numerito=0;
				if($retprofesor->RecordCount()>0){
				 while(!$retprofesor->EOF ){
				 //echo "</p>".$numerito = $numerito+1 ."</p>";					
						$cont=$cont + 1; //numero de evaluaciones
						$resultado= 'SELECT count( * ) as numpreguntaxarea, 				                                     de.serial_rsp, sum( valor_rsp ) as sumaxarea,                                     arev.nombre_arev,	arev.serial_arev 
									FROM detalle_evaluacion AS de, pregunta_evaluacion AS prg, area_evaluacion AS arev
									WHERE serial_ceva ='.$retprofesor->fields['serial_ceva'].' and NA_RSP <> "SI"
									AND de.serial_prg = prg.serial_prg
									AND prg.serial_arev = arev.serial_arev
									GROUP BY prg.serial_arev
									order by arev.nombre_arev';
														
						$retresultado=$dblink->Execute($resultado);	
						//echo "</p> SQL 2".$resultado;
//		echo "</p> SQL 2 :".$resultado;
						$i=1;
						if($retresultado->RecordCount()>0){
							while(!$retresultado->EOF){						
			
									$i=$retresultado->fields['serial_arev']; //asignamos el numero de area para guardar en un vectot vi
	
//formula para calcular la suma que da por cada area multiplicado para 100 todo eso dividido para la divicion de 100 para el numero de preguntas total multiplicado para el numero de preguntas por area
  
						$total[1][$i] = $total[1][$i] + ((100*$retresultado->fields['sumaxarea'])/(($retprofesor->fields['maximovalor'])*$retresultado->fields['numpreguntaxarea']));
									//echo "|";
								$total[2][$i] = $retresultado->fields['serial_arev'];
									
								$retresultado->MoveNext();							
							}									
						}			
						$retprofesor->MoveNext();
						
				 }
				 }
				 $datosprofesor='SELECT ce.serial_epl, ce.serial_mat, nombre_mat, concat_ws(" ",apellido_epl, nombre_epl) as docente, hrr.seccion_hrr, de.serial_prg, prg.serial_arev, de.serial_deva, de.serial_ceva, ce.serial_teva, arev.nombre_arev, teva.tipo_teva, fac.nombre_fac, per.nombre_per, are.nombre_are,hrr.seccion_hrr, are.serial_are, fac.serial_fac
FROM detalle_evaluacion AS de, cabecera_evaluacion ce, empleado as epl, materia as mat, horario as hrr, pregunta_evaluacion as prg, area_evaluacion as arev,facultad as fac, periodo as per,area as are, tipo_evaluadores as teva
					 WHERE de.serial_ceva = ce.serial_ceva 
					 and ce.serial_mat = mat.serial_mat 
					 and ce.serial_epl = epl.serial_epl 
					 and ce.serial_hrr = hrr.serial_hrr
                     and de.serial_prg = prg.serial_prg
                     and arev.serial_arev = prg.serial_arev
                     and fac.serial_fac = hrr.serial_fac
					 and are.serial_are = hrr.serial_are
					 and per.serial_per = ce.serial_per
					 and teva.serial_teva = ce.serial_teva    
					 AND ce.serial_per ='.$par[0].'
					 AND ce.serial_epl ='.$par[1].'
					 AND ce.serial_mat ='.$par[2].'
					 AND ce.serial_teva ='.$par[3].'
					 GROUP BY prg.serial_arev
					 order by arev.nombre_arev';					 
					 $retcalculos=$dblink->Execute($datosprofesor);	
					 $retdatosprofesor=$dblink->Execute($datosprofesor);	
					 
					 //echo "</p> datos profe".$datosprofesor;
					 
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
		
					/*$promedio='SELECT ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) AS num_eval, nombre_epl, nombre_mat, hrr.seccion_hrr, are.nombre_are
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, empleado AS epl, materia AS mat, horario AS hrr, area AS are
								WHERE de.serial_ceva = ce.serial_ceva
								AND ce.serial_epl = epl.serial_epl
								AND mat.serial_mat = ce.serial_mat
								AND hrr.serial_hrr = ce.serial_hrr
								AND hrr.serial_are = are.serial_are
								AND ce.serial_per ='.$par[0].'
								AND ce.serial_mat ='.$par[2].'
								AND hrr.serial_are ='.$area.' 
								and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva';*/
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
						/*if($retpromedio->fields['serial_teva']==1){
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;													
						}
						if($retpromedio->fields['serial_teva']==2){
							$porcentaje = $porcentaje	+ ($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							
						}
						if($retpromedio->fields['serial_teva']==3){
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							            			}							
							*/
						//if($retpromedio->fields['serial_teva']==4){
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							                        
							//}
					  $retpromedio->MoveNext();
					}	
				}														
					$total = ($porcentaje * 5)/100; 							
					echo "<td class='style2'>Promedio por Áreas:</td>";
					echo "<td align='right' class='style3'>".number_format($total,2) ."<td>";
					echo "</tr>";
					
/********va sacando el Total de de todos profesores filtrado por facultad y periodo************/					
			
						/*$promediofacultad='SELECT ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) AS num_eval, nombre_epl, nombre_mat, hrr.seccion_hrr, fac.nombre_fac, fac.serial_fac
						FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, empleado AS epl, materia AS mat, horario AS hrr, facultad AS fac
						WHERE de.serial_ceva = ce.serial_ceva
						AND ce.serial_epl = epl.serial_epl
						AND mat.serial_mat = ce.serial_mat
						AND hrr.serial_hrr = ce.serial_hrr
						AND hrr.serial_fac = fac.serial_fac
						AND ce.serial_per ='.$par[0].'
						AND ce.serial_mat ='.$par[2].'
						AND hrr.serial_fac ='.$facultad.' and de.NA_RSP <> "SI"
						GROUP BY ce.serial_teva';*/
						
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
						/*if($retpromediofacultad->fields['serial_teva']==1){
							$porcentajef = $porcentajef + ($retpromediofacultad->fields['PORCENTAJE_EVA'] * ($retpromediofacultad->fields['suma']/$retpromediofacultad->fields['num_eval']))/100;				
																
						}
						if($retpromediofacultad->fields['serial_teva']==2){
							$porcentajef = $porcentajef	+ ($retpromediofacultad->fields['PORCENTAJE_EVA'] * ($retpromediofacultad->fields['suma']/$retpromediofacultad->fields['num_eval']))/100;
							}
						if($retpromediofacultad->fields['serial_teva']==3){
							$porcentajef = $porcentajef + ($retpromediofacultad->fields['PORCENTAJE_EVA'] * ($retpromediofacultad->fields['suma']/$retpromediofacultad->fields['num_eval']))/100;			
							}*/
						//if($retpromediofacultad->fields['serial_teva']==4){
							$porcentajef = $porcentajef + ($retpromediofacultad->fields['PORCENTAJE_EVA'] * ($retpromediofacultad->fields['suma']/$retpromediofacultad->fields['num_eval']))/100;			
							//}
					  $retpromediofacultad->MoveNext();
					}														
					$totalf = ($porcentajef * 5)/100; 							
					echo "<td class='style2'>Promedio por Facultad:</td>";
					echo "<td align='right' class='style3'>".number_format($totalf,2) ."<td>";
					echo "</tr>";					
					
					
					
					/********va sacando el Total de todos los profesores filtrado por Periodo************/					
			
						/*$promedioperiodo='SELECT ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) AS num_eval, nombre_epl, nombre_mat, hrr.seccion_hrr, fac.nombre_fac, fac.serial_fac
						FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, empleado AS epl, materia AS mat, horario AS hrr, facultad AS fac
						WHERE de.serial_ceva = ce.serial_ceva
						AND ce.serial_epl = epl.serial_epl
						AND mat.serial_mat = ce.serial_mat
						AND hrr.serial_hrr = ce.serial_hrr
						AND hrr.serial_fac = fac.serial_fac
						AND ce.serial_per ='.$par[0].'
						AND ce.serial_mat ='.$par[2].'
						AND hrr.serial_fac ='.$facultad.' and de.NA_RSP <> "SI"
						GROUP BY ce.serial_teva	';*/
						
						
						$promedioperiodo='select ce.serial_teva, sum( valor_rsp ) AS suma, count( DISTINCT ce.serial_ceva ) as num_eval, eva.PORCENTAJE_EVA
							from cabecera_evaluacion as ce, detalle_evaluacion as de, horario as hrr, evaluacion as eva
							WHERE de.serial_ceva = ce.serial_ceva 
							and hrr.serial_hrr=ce.serial_hrr
							and ce.SERIAL_TEVA = eva.SERIAL_TEVA
							AND ce.serial_per ='.$par[0].'
							and de.NA_RSP <> "SI" 
							group by ce.serial_teva';

//////////////////////////echo "</p>".$promedioperiodo."</p>";
								
					$retpromedioperiodo=$dblink->Execute($promedioperiodo);
					$porcentajef = 0;
					echo "</tr>";
					echo "</p>";
					while(!$retpromedioperiodo->EOF ){						
						/*if($retpromedioperiodo->fields['serial_teva']==1){
							$porcentajep = $porcentajep +	($retpromedioperiodo->fields['PORCENTAJE_EVA'] * ($retpromedioperiodo->fields['suma']/$retpromedioperiodo->fields['num_eval']))/100;				
																
						}
						if($retpromedioperiodo->fields['serial_teva']==2){
							$porcentajep = $porcentajep	+ ($retpromedioperiodo->fields['PORCENTAJE_EVA'] * ($retpromedioperiodo->fields['suma']/$retpromedioperiodo->fields['num_eval']))/100;
							}
						if($retpromedioperiodo->fields['serial_teva']==3){
							$porcentajep = $porcentajep +	($retpromedioperiodo->fields['PORCENTAJE_EVA'] * ($retpromedioperiodo->fields['suma']/$retpromedioperiodo->fields['num_eval']))/100;			
							}*/
						//if($retpromedioperiodo->fields['serial_teva']==4){
							$porcentajep = $porcentajep +	($retpromedioperiodo->fields['PORCENTAJE_EVA'] * ($retpromedioperiodo->fields['suma']/$retpromedioperiodo->fields['num_eval']))/100;			
							//}
					  $retpromedioperiodo->MoveNext();
					}														
					$totalp = ($porcentajep * 5)/100; 							
					echo "<td class='style2'>Promedio de Sede Periodo de Evaluación:</td>";
					echo "<td align='right' class='style3'>".number_format($totalp,2) ."<td>";
					echo "</tr>";					
					
				 
}
?>