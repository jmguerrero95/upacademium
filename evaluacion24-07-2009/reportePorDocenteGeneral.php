
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
<table width="75%" align="center">
  <tr bgcolor="#FFFFFF">
    <td rowspan="2" bgcolor="#FFFFFF"><img src="../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th colspan="2"><span class="style1">Resultados de la Evaluación de Profesores</span></th>
  </tr>
  <tr bgcolor="#FFFFFF">     
	<th><span class="style2">Sede: <? echo $retsede->fields['nombre_suc']; ?></span></th>
	<th><span class="style2">Periodo: <? echo $retperiodo->fields['nombre_per']; ?></span></th>
  </tr>
</table>
<HR SIZE=5 WIDTH="75%" COLOR="#000000" align="center" > 
<table align="center" width="75%">
<tr>
	<td class="style3">PROFESOR:</td>
	<td class="style3">MATERIA:</td>
	<td class="style3">SECCIÓN:</td>
	<td class="style3">PROMEDIO:</td>
  </tr>  
<tr>
	<td colspan="5" align="left">  <HR SIZE=5 WIDTH="100%" COLOR="#000000" align="center" ></td>
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
		//*******Saca todos los profesores del periodo escogido****************/
		$profesores='SELECT de.serial_ceva, count( * ) , sum( de.valor_rsp ) , ce.serial_epl, ce.serial_mat, nombre_mat, concat_ws(" ",apellido_epl,nombre_epl) as nombre_epl, hrr.seccion_hrr
					 FROM detalle_evaluacion AS de, cabecera_evaluacion ce, empleado as epl, materia as mat, horario as hrr
					 WHERE de.serial_ceva = ce.serial_ceva 
					 and ce.serial_mat = mat.serial_mat 
					 and ce.serial_epl = epl.serial_epl 
					 and ce.serial_hrr = hrr.serial_hrr
					 and de.NA_RSP <> "SI"
					 AND ce.serial_per ='.$par[0].'
					 GROUP BY ce.serial_mat, ce.serial_epl
					 order by apellido_epl';						
					// echo $profesores;
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
/*va sacando el Total de de cada uno de los profesores filtrado por profesoress y materia*/
					$profe=$retprofesor->fields['serial_epl'];
					
					/*$promedio='SELECT ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce
								WHERE de.serial_ceva = ce.serial_ceva
								AND ce.serial_epl ='.$retprofesor->fields['serial_epl'].'
								AND ce.serial_per ='.$par[0].'
								AND ce.serial_mat ='.$retprofesor->fields['serial_mat'].' and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva';*/
								
								$promedio='SELECT ce.serial_teva, sum( valor_rsp ) as suma, count( DISTINCT ce.serial_ceva ) AS num_eval, eva.PORCENTAJE_EVA
								FROM detalle_evaluacion AS de, cabecera_evaluacion AS ce, evaluacion as eva
								WHERE de.serial_ceva = ce.serial_ceva
								and ce.SERIAL_TEVA = eva.SERIAL_TEVA
								AND ce.serial_epl ='.$retprofesor->fields['serial_epl'].'
								AND ce.serial_per ='.$par[0].'
								AND ce.serial_mat ='.$retprofesor->fields['serial_mat'].' and de.NA_RSP <> "SI"
								GROUP BY ce.serial_teva';
								
								//echo "</p>".$promedio."</p>";								
								
	// coje la suma por profesor y materia la suma y multiplica por su porcentaje 
	//echo "<p>".$promedio;
					$retpromedio=$dblink->Execute($promedio);
					$porcentaje = 0;
					while(!$retpromedio->EOF ){						
						/*if($retpromedio->fields['serial_teva']==1){
						//50
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;						
						}
						if($retpromedio->fields['serial_teva']==2){
						//10
							$porcentaje = $porcentaje + ($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;
						}
						if($retpromedio->fields['serial_teva']==3){
						//20
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							                        }
						*/	
						//if($retpromedio->fields['serial_teva']==4){
						//20
							$porcentaje = $porcentaje +	($retpromedio->fields['PORCENTAJE_EVA'] * ($retpromedio->fields['suma']/$retpromedio->fields['num_eval']))/100;							                        
							//}
							
						//echo "</p> % : ".$retpromedio->fields['PORCENTAJE_EVA'];
					  $retpromedio->MoveNext();					  
					}
														
					echo "<td class='style2'>".$retprofesor->fields['nombre_mat']."</td>";
					echo "<td class='style2'>".$retprofesor->fields['seccion_hrr']."</td>";					
					$total = ($porcentaje * 5)/100;
					echo "<td align='right' class='style3'>".number_format($total,2) ."<td>";					
					echo "</tr>";					
				 	$retprofesor->MoveNext();					
				 }						 
}
?>