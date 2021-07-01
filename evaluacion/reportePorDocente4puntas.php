
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
.style1 {font-size: 17px}
.style2 {font-size: 12px}
.style3 {font-size: 12px; font-weight:bold}

H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }
 
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body>
<?
/*****************saca nombre de la sede y el periodo********************************/
$dblink = NewADOConnection($DBConnection);
$url=$_GET['query1'];		
$par = explode("|",$url);	
$sede='SELECT nombre_suc from sucursal where serial_suc ='.$par[3];	
$retsede=$dblink->Execute($sede);
//echo '</p>'.$sede;
$periodo='SELECT nombre_per from periodo where serial_per ='.$par[0];	
$retperiodo=$dblink->Execute($periodo);

if($par[1]!='TODOS'){
	$profesorP=" AND ce.SERIAL_EPL = ".$par[1];
}else
	$profesorP="";

if($par[2]!='TODOS'){
	$materiaP=" AND ce.SERIAL_MAT = ".$par[2];
}else
	$materiaP="";
	
//echo "</p>".$materiaP."-*-".$par[2];	


	


//$seccion = "select serial_sec from periodo where serial_per = ".$par[0];			
//$retseccion=$dblink->Execute($seccion);
		
//$nombreSeccion = "select nombre_sec from seccion where serial_sec = ".$retseccion->fields['serial_sec'];
//$retnombreSeccion=$dblink->Execute($nombreSeccion);

?>



<?php	
			
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
					 '.$profesorP.'			 
					 '.$materiaP.'			 
					 GROUP BY ce.serial_mat, ce.serial_epl
					 order by apellido_epl';						
		//echo "Pro: ".$profesores."</p>";
				$retprofesor=$dblink->Execute($profesores);
				$bandera =0;
				 while(!$retprofesor->EOF ){								
					if($bandera>0)echo "<H1 class=SaltoDePagina> </H1>";
					
				/*	if($retseccion->fields['serial_sec']==2)
						echo $retnombreSeccion->fields['nombre_sec'];
					else
						echo $retprofesor->fields['nombre_fac'];*/					
					
					//echo "<td class='style2' align='right'>".$retprofesor->fields['cuantosce']."</td>";
?>
<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td rowspan="2" bgcolor="#FFFFFF"><img src="../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th colspan="2"><span class="style1">Resultados de la Evaluación a Profesores</span></th>
  </tr>
  <tr bgcolor="#FFFFFF">     
	<th><span class="style2">Sede: <? echo $retsede->fields['nombre_suc']; ?></span></th>
	<th><span class="style2">Periodo: <? echo $retperiodo->fields['nombre_per']; ?></span></th>
  </tr>
</table>

<p>&nbsp;</p>
<table align="center" width="80%" border="1">
<tr>
	<td colspan="10">  <HR SIZE=2 WIDTH="100%" COLOR="#000000" align="center" ></td>
</tr> 
<tr>
	<td class="style3">PROFESOR:</td>
	<td ><?php echo $retprofesor->fields['nombre_epl']; ?></td>
	<td class="style3">MATERIA:</td>
	<td ><?php echo $retprofesor->fields['nombre_mat'];?></td>
</tr>

<tr>	
	<td class="style3">FACULTAD:</td>
	<td ><?php echo $retprofesor->fields['nombre_fac']; ?></td>
	<td class="style3">SECCIÓN:</td>
	<td ><?php echo $retprofesor->fields['seccion_hrr']; ?></td>
</tr>

<tr>
	<td colspan="10"> <HR SIZE=2 WIDTH="100%" COLOR="#000000" align="center" ></td>
</tr>
</table> 

	  <? $vecTotales = consulta($retprofesor->fields['serial_epl'],$par[0],$retprofesor->fields['serial_mat']); 
		$total=$vecTotales[0];
		$totalAreas=$vecTotales[1];
		
	?>

	<br><br>
	<table align="center" width="80%" border="1">
<tr>	
	<td class="style3" colspan="4"><?php echo $retprofesor->fields['cuantosce']." Evaluadores"; ?></td>
</tr>
<p> </p>
<tr>	
	<td align="center" class="style3" colspan="3">EVALUACIONES</td>
	<td align="center" class="style3">TOTALES</td>
</tr>

<tr>	
	<td class="style3" colspan="3">Estudiantes:</td>
	<td align="right"><?php echo number_format($totalAreas[1],2); ?></td>
</tr>

<tr>	
	<td class="style3" colspan="3">Profesores:</td>
	<td align="right"><?php echo number_format($totalAreas[2],2); ?></td>
</tr>	
<tr>
	<td class="style3" colspan="3">Decanatura:</td>
	<td align="right"><?php echo number_format($totalAreas[2],2); ?></td>
</tr>
<tr>	
	<td class="style3" colspan="3">Jefe de Area:</td>
	<td align="right"><?php echo number_format($totalAreas[4],2); ?></td>		
</tr>	
<tr>
	<td align="right" class="style3" colspan="3">PROMEDIO PONDERADO:</td>
	<td align="right" class="style3"><?php echo number_format($total,2); ?></td>
	
</tr>	
</table>

    <p>&nbsp;</p>
    <HR SIZE=2 WIDTH="80%" COLOR="#000000" align="center" > 

<table align="center" width="80%">
	<tr>
		<td class="style3">LEYENDA</td>
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





  <?php
	$bandera = 1;
  	$retprofesor->MoveNext();					
}
  ?>
	
 

</body>
</html>           

<?php


function consulta($empleado,$periodo,$materia){
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);					
					
								
								$promedio='SELECT ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval, eva.PORCENTAJE_EVA,
	eva.PORCENTAJE_EVA,SUBSTR(TIPO_TEVA,1,3) 
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, evaluacion as eva, tipo_evaluadores as teva 
								WHERE de.serial_ceva = ce.serial_ceva
								and ce.SERIAL_EVA = eva.SERIAL_EVA
								AND ce.SERIAL_TEVA = teva.SERIAL_TEVA 
								AND ce.serial_epl ='.$empleado.'
								AND ce.serial_per ='.$periodo.'
								AND ce.serial_mat ='.$materia.' 
								and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva
								order by SERIAL_TEVA';
								
						
	
					$retpromedio=$dblink->Execute($promedio);
					
					
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
														
					/*for($i=1;$i<=4;$i++){
						echo "<td align='right' class='style3'>"; 
							if(empty($porcentajeArea5[$i])) echo "&nbsp;"; else echo number_format($porcentajeArea5[$i],2);
						echo "</td>";						
						
					}*/
										
										
										
					$total = ($porcentaje * 5)/100;
					//echo "---------------------".$total."</p>";
					
					//echo "<td align='right' class='style3'>".number_format($total,2) ."</td>";										
					
				 	
				 
				 $vector = array($total, $porcentajeArea5);			
				 return $vector;
				 						 
}

/*function consulta(){
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$url=$_GET['query1'];
		$par = explode("|",$url);
		
		$seccion = "select serial_sec from periodo where serial_per = ".$par[0];			
		$retseccion=$dblink->Execute($seccion);
		
		$nombreSeccion = "select nombre_sec from seccion where serial_sec = ".$retseccion->fields['serial_sec'];
		$retnombreSeccion=$dblink->Execute($nombreSeccion);
		
		//echo "</p> ES: ".$seccion." ".$retnombreSeccion->fields['serial_sec'];
		
		
		
			
		////////////////Saca todos los profesores del periodo escogido///////////////////
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
				AND ce.SERIAL_EPL=94
				AND ce.SERIAL_MAT=390					 
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
						echo "<td class='style2'>".$retprofesor->fields['nombre_epl']."</td>";
					}
//va sacando el Total de de cada uno de los profesores filtrado por profesoress y materia
					$profe=$retprofesor->fields['serial_epl'];
					
					
								
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
								
						
	
					$retpromedio=$dblink->Execute($promedio);
					echo "<td class='style2'>".$retprofesor->fields['nombre_mat']."</td>";
					
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
						
					}
										
										
										
					$total = ($porcentaje * 5)/100;
					//echo "---------------------".$total."</p>";
					
					echo "<td align='right' class='style3'>".number_format($total,2) ."</td>";					
					
					echo "</tr>";
				 	$retprofesor->MoveNext();					
				 }
				 
				 $vector = array($nombrePeriodo, $FechaInicio);			
				 return $vector;
				 						 
}*/
?>