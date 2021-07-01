
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
<htm>
<style type="text/css">
<!--
.style1 {font-size: 26px}
.style2 {font-size: 13px}
.style3 {font-size: 13px; font-weight:bold}
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
?>
<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td rowspan="2" bgcolor="#FFFFFF"><img src="../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th colspan="2"><span class="style1">Resultados de la Evaluación de Profesores</span></th>
  </tr>
  <tr bgcolor="#FFFFFF">     
	<th><span class="style2">Sede: <? echo $retsede->fields['nombre_suc']; ?></span></th>
	<th><span class="style2">Periodo: <? echo $retperiodo->fields['nombre_per']; ?></span></th>
  </tr>
</table>

<table align="center" width="100%" border="1">
<tr>
	<td colspan="10">  <HR SIZE=5 WIDTH="100%" COLOR="#000000" align="center" ></td>
</tr>  
<tr>
	<td class="style3">PROFESOR:</td>
	<td class="style3">MATERIA:</td>
	<td class="style3">FACULTAD:</td>
	<td class="style3">SECCIÓN:</td>
	<td class="style3">EVALUADORES:</td>
	<td class="style3">ALUMNO:</td>
	<td class="style3">AUTOEVALUACION:</td>
	<td class="style3">PAR ACADEMICO:</td>
	<td class="style3">DIRECTIVO:</td>		
	<td class="style3">PROMEDIO PONDERADO:</td>
  </tr>  
<tr>
	<td colspan="10">  <HR SIZE=5 WIDTH="100%" COLOR="#000000" align="center" ></td>
</tr>    
	<? consulta() ?>
</table> 

</body>
</html>           

<?php

function consulta(){
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$url=$_GET['query1'];
		$par = explode("|",$url);
		
		$seccion = "select serial_sec from periodo where serial_per = ".$par[0];			
		$retseccion=$dblink->Execute($seccion);
		
		$nombreSeccion = "select nombre_sec from seccion where serial_sec = ".$retseccion->fields['serial_sec'];
		$retnombreSeccion=$dblink->Execute($nombreSeccion);
		
		//echo "</p> ES: ".$seccion." ".$retnombreSeccion->fields['serial_sec'];
		
		
		
			
		//*******Saca todos los profesores del periodo escogido****************/
		$profesores='SELECT de.serial_ceva, count( * ) as cuantos , count(DISTINCT ce.SERIAL_CEVA) as cuantosce ,sum( de.valor_rsp ) , ce.serial_epl, ce.serial_mat, nombre_mat, concat_ws(" ",apellido_epl,nombre_epl) as nombre_epl, hrr.seccion_hrr, nombre_fac
					 FROM detalle_evaluacion AS de, cabecera_evaluacion ce, empleado as epl, materia as mat, horario as hrr left join facultad  AS fac 
					on hrr.SERIAL_FAC=fac.serial_fac
					 WHERE de.serial_ceva = ce.serial_ceva 
					 and ce.serial_mat = mat.serial_mat 
					 and ce.serial_epl = epl.serial_epl 
					 and ce.serial_hrr = hrr.serial_hrr					 
					 and de.NA_RSP <> "SI"
					 AND ce.serial_per ='.$par[0].'
					 and estado_hrr="ACTIVO"
					 GROUP BY ce.serial_mat, ce.serial_epl
					 order by apellido_epl';						
		//echo "Pro: ".$profesores."</p>";
				$retprofesor=$dblink->Execute($profesores);
				 while(!$retprofesor->EOF ){					
					echo "<tr>";				 
					if ($profe==$retprofesor->fields['serial_epl']){
						echo "<td class='style2'>"." "."</td>";						
						//echo "<td class='style2'>"."&nbsp"."</td>";
					}
					else{
						echo "<td class='style2'>".$retprofesor->fields['nombre_epl']/*."/ ".$retprofesor->fields['serial_epl']*/."</td>";
					}
/*va sacando el Total de de cada uno de los profesores filtrado por profesoress y materia*/
					$profe=$retprofesor->fields['serial_epl'];
					
					/*$promedio='SELECT ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce
								WHERE de.serial_ceva = ce.serial_ceva
								AND ce.serial_epl ='.$retprofesor->fields['serial_epl'].'
								AND ce.serial_per ='.$par[0].'
								AND ce.serial_mat ='.$retprofesor->fields['serial_mat'].' and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva';*/
								
								$promedio='SELECT ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval, eva.PORCENTAJE_EVA,
	eva.PORCENTAJE_EVA,SUBSTR(TIPO_TEVA,1,3) 
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, evaluacion as eva,
    tipo_evaluadores as teva 
								WHERE de.serial_ceva = ce.serial_ceva
								and ce.SERIAL_EVA = eva.SERIAL_EVA
								AND ce.SERIAL_TEVA = teva.SERIAL_TEVA 
								AND ce.serial_epl ='.$retprofesor->fields['serial_epl'].'
								AND ce.serial_per ='.$par[0].'
								AND ce.serial_mat ='.$retprofesor->fields['serial_mat'].' and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva
								order by SERIAL_TEVA';
								
						//echo "PROME ".$promedio."</p>";								
								
	// coje la suma por profesor y materia la suma y multiplica por su porcentaje 
	//echo "<p>".$promedio;
	
	/*	if ($profe == 219 and $retprofesor->fields['serial_mat'] == 180){
							echo $porcentaje." + (".$retpromedio->fields['PORCENTAJE_EVA']." * (".$retpromedio->fields['suma']."/".$retpromedio->fields['num_eval']."))/ 100"."</p>";
							echo "Pro: ".$profesores."</p>";
							echo "PROME ".$promedio."</p>";
							}*/
	
					$retpromedio=$dblink->Execute($promedio);
					echo "<td class='style2'>".$retprofesor->fields['nombre_mat']./*" / ".$retprofesor->fields['serial_mat'].*/"</td>";
					
					if($retseccion->fields['serial_sec']==2)
						echo "<td class='style2'>".$retnombreSeccion->fields['nombre_sec']."</td>";
					else
						echo "<td class='style2'>".$retprofesor->fields['nombre_fac']."</td>";
					
					echo "<td class='style2'>".$retprofesor->fields['seccion_hrr']."</td>";
					echo "<td class='style2' align='right'>".$retprofesor->fields['cuantosce']."</td>";
					$porcentajeArea=0; 
					$porcentajeArea5=array(); 
					$porcentaje = 0;
					while(!$retpromedio->EOF ){
											
						$porcentajeArea = ($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;													                        										
						$porcentaje = $porcentaje +	$porcentajeArea;
						$porcentajeArea5[$retpromedio->fields['serial_teva']]= $porcentajeArea*5/$retpromedio->fields['PORCENTAJE_EVA'];
																									
						//echo "<td align='right' class='style3'>".$porcentajeArea[$retpromedio->fields['serial_teva']]."<td>";
						
					  $retpromedio->MoveNext();					  
					}
														
					for($i=1;$i<=4;$i++){
						echo "<td align='right' class='style3'>"; 
							if(empty($porcentajeArea5[$i])) echo "&nbsp;"; else echo number_format($porcentajeArea5[$i],2);
						echo "</td>";	
						
						/*echo "ARRARYYYY: ".in_array($i, $porcentajeArea).'<br>';
						
						if(in_array($i, $porcentajeArea)==0){
							echo "<td align='right' class='style3'>".$porcentajeArea[$i]."</td>";												
						}else{
							echo "<td align='right' class='style3'>yyy</td>";
						}*/

						
						
					}
										
										
										
					$total = ($porcentaje * 5)/100;
					//echo "---------------------".$total."</p>";
					
					echo "<td align='right' class='style3'>".number_format($total,2) ."</td>";					
					
					echo "</tr>";
				 	$retprofesor->MoveNext();					
				 }						 
}
?>