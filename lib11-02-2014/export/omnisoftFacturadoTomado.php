<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
</head>
<body>
<style type="text/css">
<!--


.style4 {
	color: #FF0033;
	font-weight: bold;
	font-size: 8px;
}
-->
</style>
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
		$fecha_ini=$_GET['fecha_ini'];
		$fecha_fin=$_GET['fecha_fin'];
		$serial_per=$_GET['serial_per'];
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];	
		
		/*$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];
 		$fecha_ini=$periodo_ini[1];*/
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		/*$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];*/





		
		//$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas from periodo where serial_per=".$serial_per);
		//$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per);
		
		
		
		
		if($fecha_ini != 0 || $fecha_ini != ''){
				$bperiodo = " and ((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."'))";
				$bperiodo_fac=" and ((fecha_caf >='".$fecha_ini."' AND	fecha_caf<='".$fecha_fin."') )";
				
				$rsPeriodo_ini=$dblink->Execute("select serial_per, nombre_per, concat_ws(' hasta ',fecini_per,fecfin_per) as fechas from periodo where fecini_per >= '".$fecha_ini."' and serial_suc = ".$serial_suc." and serial_sec = ".$serial_sec." order by fecini_per asc limit 1");		
				$rsPeriodo_fin=$dblink->Execute("select serial_per, nombre_per, concat_ws(' hasta ',fecini_per,fecfin_per) as fechas from periodo where fecfin_per <= '".$fecha_fin."' and serial_suc = ".$serial_suc." and serial_sec = ".$serial_sec." order by fecfin_per desc limit 1");
		}else{
				$bperiodo = " and per.serial_per = ".$serial_per;
				$bperiodo_fac = " and per.serial_per = ".$serial_per;
				$rsPeriodo_ini=$dblink->Execute("select nombre_per, fecini_per as fechas from periodo where serial_per=".$serial_per);
				$rsPeriodo_fin=$dblink->Execute("select nombre_per, fecfin_per as fechas  from periodo where serial_per=".$serial_per);				
		}

			



if ($serial_suc!='T')
	$sucursal= " and alu.serial_suc = ".$serial_suc;	
else
	$sucursal= "";

if ($serial_sec!='T')
	$seccion= " and alu.serial_sec = ".$serial_sec;	
else
	$seccion= "";


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
,'Efectivizado' as estado,'Efectivizado' as costo ,sum(creditos_dcpt) as creditos,mmat.SERIAL_MMAT as matri,nombre_fac,nombre_crp as carrera
from cabeceracreditosportomar as cpt, detallecreditoportomar as dcpt, materiamatriculada as mmat,alumno as alu,periodo as per
	     join malla on alu.serial_sec=malla.serial_sec and serial_maa_p=0  
		 join alumnomalla on alumnomalla.serial_alu=alu.serial_alu and malla.serial_maa=alumnomalla.serial_maa 
        left join carrera on carrera.serial_car=malla.serial_car 
        left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
        left join facultad on facultad.serial_fac=carrera.serial_fac
where cpt.serial_cpt=dcpt.serial_cpt
and dcpt.serial_mmat=mmat.SERIAL_MMAT
and mmat.SERIAL_ALU = alu.serial_alu
and mmat.SERIAL_PER=per.serial_per
".$seccion."
".$sucursal."
".$bperiodo."
group by alu.serial_alu
union
select 
 per.serial_per,alu.serial_alu
,concat_ws(' ', alu.apellidopaterno_alu, alu.apellidomaterno_alu , alu.nombre1_alu,alu.nombre2_alu) AS nombre
,'Facturado' as estado,'facturado' as costo,sum(dfa.cantidad_dfa) as creditos,mmat.serial_mmat as matri,nombre_fac,nombre_crp as carrera
from  detallefactura as dfa,alumno as alu,detallearancel as dar, aranceles as ara,cabecerafactura as caf
		  join malla on alu.serial_sec=malla.serial_sec and serial_maa_p=0  
		 join alumnomalla on alumnomalla.serial_alu=alu.serial_alu and malla.serial_maa=alumnomalla.serial_maa 
        left join carrera on carrera.serial_car=malla.serial_car 
        left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
        left join facultad on facultad.serial_fac=carrera.serial_fac
		left JOIN materiamatriculada AS mmat ON caf.serial_mmat=mmat.serial_mmat
		LEFT JOIN periodo AS per ON mmat.SERIAL_PER=per.serial_per  
where caf.serial_caf=dfa.serial_caf
and alu.serial_alu=caf.serial_alu
and dfa.serial_dar=dar.serial_dar
and dar.serial_ara=ara.serial_ara
and ara.credito_ara = 'SI'
and caf.tipo_caf = 'FAC'
".$seccion."
".$sucursal."
".$bperiodo_fac."
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
	AS creditos, mmat.serial_mmat as matri,nombre_fac,nombre_crp as carrera
	 
FROM
	alumno             AS alu,
	materiamatriculada AS mmat,
	detallemateriamatriculada dmat ,	
	periodo            AS per 
	    join malla on alu.serial_sec=malla.serial_sec and serial_maa_p=0  
		join alumnomalla on alumnomalla.serial_alu=alu.serial_alu and malla.serial_maa=alumnomalla.serial_maa 
        left join carrera on carrera.serial_car=malla.serial_car 
        left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
        left join facultad on facultad.serial_fac=carrera.serial_fac
WHERE
	alu.serial_alu = mmat.serial_alu AND
	mmat.serial_mmat = dmat.serial_mmat AND
	mmat.SERIAL_PER = per.serial_per AND 
	serial_mat not in(375,578,579) 	
".$bperiodo."
	".$seccion." 
    ".$sucursal."
group by alu.serial_alu,estado
union select 0,0,'zzzzzzzzzzzzzzzzzzzz',0,0,0,0,'zzzzzzzzzzzzzzzzzzzz','zzzzzzzzzzzzzzzzzzzz'
ORDER BY carrera,nombre_fac,nombre";

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
    <th colspan="2"> FECHAS DE LOS PERIODOS desde: <? echo $rsPeriodo_ini->fields['fechas'];?>&lt;=&gt;hasta: <? echo $rsPeriodo_fin->fields['fechas'];?> </th>
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
		 					<th width="2%">No</th>
							<th width="10%">Carrera</th>			
							<th width="25%">Facultad</th>			
          					<th width="25%">Estudiante</th>		  											
							<!--<th width="1%"  style="">Nro.</th>
					        <th width="30%">Estado</th>		-->  											
							<th width="10%">Cr&eacute;ditos Facturados</th>							
							<th width="10%">Cr&eacute;ditos Devengados </th>						
							<th width="10%">Cr&eacute;ditos Tomado</th>				
							<th width="10%"># Registro </th>
							<th width="10%">Retiro Con Costo</th>		
							<th width="10%">Retiro Sin Costo</th>
							<th width="15%">Debe Facturar</th>							  												  																	  												  							
							<th width="15%"> A Favor ó Debe Realizar Notas de Crédito</th>				
			</tr>	
        
		<? $i='';
		  
		  $cod_materia=0;
		  $bandera = 0;
		  $matricula = 0;
		  
		  $alumno = "";
		  //$facturados=0;
		  //$efectivizados=0;
		  //$tomados=0;
		  //$estado=0;
		  
		$creditosF="";
		$creditosE="";
		$creditosT="";
		$creditosCC="";
		$creditosCS="";	
		$matricula="";
		//$notaOfactura="";
		  
//		  $rsMaterias->Movefirst();
			while(!$rsMaterias->EOF){				
			?>				
				<tr> 
				<? if($rsMaterias->fields['serial_alu'] != $alumno){ 
					$tomados= ($creditosT + $creditosCC + $creditosCS);
					if($tomados==0) $tomados='';
					
				?>
					<td><span class="style2"><? echo $i;?></span></td>	
					<td><span class="style2"><? echo $carrera;?></span></td>
					<td><span class="style2"><? echo $facultad;?></span></td>
									
					<td><span class="style2"><? echo $nombre;?></span></td>					
					<td><span class="style2"><? echo $creditosF;?></span></td>
					<td><span class="style2"><? echo $creditosE;?></span></td>
					<td><span class="style2"><? echo $tomados;?></span></td>
					<td><span class="style4"><? echo $matricula;?></span></td>
					<td><span class="style2"><? echo $creditosCC;?></span></td>
					<td><span class="style2"><? echo $creditosCS;?></span></td>			
					
					<? 
					$TotalCreditosE = $TotalCreditosE + $creditosF;
					$TotalCreditosF = $TotalCreditosF + $creditosE;
					$TotalTomados = $TotalTomados + $tomados;
					$TotalCreditosCC = $TotalCreditosCC + $creditosCC;
					$TotalCreditosCS = $TotalCreditosCS + $creditosCS;
					
					$notaOfactura=(($creditosT + $creditosCC + $creditosCS)-$creditosCS)-($creditosF+$creditosE); 
					
					if($notaOfactura>0){
					?>					
						<th width="10%"><? echo $notaOfactura;?></th>							  												  																	  												  						<th width="10%"></th>
					<? 
						$TotalFactura= $TotalFactura + $notaOfactura;
					} 
						if($notaOfactura<0){?>
						<th width="10%"></th>							  												  																	  												  						<th width="10%"><? echo $notaOfactura*(-1);?></th>								
						
					<?	$TotalNota= $TotalNota + $notaOfactura;
					}					
						if($notaOfactura==0){?>
						<th width="10%"></th>							  												  																	  												  						<th width="10%"></th>								
						
					<?
					}
				$i=$i+1;	
				$alumno = $rsMaterias->fields['serial_alu'];
				$nombre = $rsMaterias->fields['nombre'];
				$matricula=$rsMaterias->fields['matri'];
				$carrera=$rsMaterias->fields['carrera'];
				$facultad=$rsMaterias->fields['nombre_fac'];
				$creditosF="";
				$creditosE="";
				$creditosT="";
				$creditosCC="";
				$creditosCS="";	
						if($rsMaterias->fields['estado']== 'Facturado'){												
									  $creditosF=$creditosF+$rsMaterias->fields['creditos'];									  
						} if($rsMaterias->fields['estado']== 'Efectivizado'){	  
									  $creditosE=$creditosE+$rsMaterias->fields['creditos'];									  	
						}if($rsMaterias->fields['estado'] == 'Tomada'){								 
									  $creditosT=$creditosT+$rsMaterias->fields['creditos'];									  
						}if($rsMaterias->fields['costo']== 'CON COSTO'){									 
									  $creditosCC=$creditosCC+$rsMaterias->fields['creditos'];
						}if($rsMaterias->fields['costo']== 'SIN COSTO'){									  
									  $creditosCS=$creditosCS+$rsMaterias->fields['creditos'];
						}
					 
				}else{				
						if($rsMaterias->fields['estado']== 'Facturado'){									 
									  $creditosF=$creditosF+$rsMaterias->fields['creditos'];									  
						} if($rsMaterias->fields['estado']== 'Efectivizado'){	  
									  $creditosE=$creditosE+$rsMaterias->fields['creditos'];									  	
						}if($rsMaterias->fields['estado'] == 'Tomada'){								 
									  $creditosT=$creditosT+$rsMaterias->fields['creditos'];									  
						}if($rsMaterias->fields['costo']== 'CON COSTO'){									 
									  $creditosCC=$creditosCC+$rsMaterias->fields['creditos'];
						}if($rsMaterias->fields['costo']== 'SIN COSTO'){									  
									  $creditosCS=$creditosCS+$rsMaterias->fields['creditos'];
						}								
				
				} 
				?>
				</tr>
							
		<?		
						
		
			$rsMaterias->MoveNext();
		}
		?>
<tr>					
  					<th><span class="style2"><? echo "-";?></span></th>					
					<th align="right" colspan="3"><? echo "TOTALES";?></span></th>					
					<th><? echo $TotalCreditosE;?></span></th>
					<th><? echo $TotalCreditosF;?></span></th>
					<th><? echo $TotalTomados;?></span></th>
					<th>&nbsp;</th>
					<th><? echo $TotalCreditosCC;?></span></th>
					<th><? echo $TotalCreditosCS;?></span></th>							
					<th><? echo $TotalFactura;?></span></th>		
					<th><? echo $TotalNota * (-1);?></span></th>		
</tr>
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