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
		
		$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];
 		$fecha_ini=$periodo_ini[1];
	//	echo "serial_per:".$serial_per_ini;
	//	echo "fecha_ini:".$fecha_ini;
		$periodo_fin=explode("*",$_GET['fecha_fin']);
		$serial_per_fin=$periodo_fin[0];
		$fecha_fin=$periodo_fin[1];
		
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
			//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
$result_periodos=$dblink->Execute("select serial_per,serial_suc,nombre_per  from periodo 
where fecini_per between '".$fecha_ini."' and '".$fecha_fin."' and serial_suc=".$serial_suc." and serial_sec=".$serial_sec." 
order by fecini_per");
// and intensivo_per='".$tipo."' 
//COnsulta 
//echo "<br>".$inicio_carrera;	
//,carrera  --, nombre_car --and facultad.serial_fac=carrera.serial_fac

/*$sql_profesores="select distinct (hrr.SERIAL_EPL) as emp,DOCUMENTOIDENTIDAD_EPL, concat_ws(' ',epl.APELLIDO_EPL, epl.NOMBRE_EPL) nombre,EMAIL_EPL, FECHAINGRESO_EPL,
  DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
SEXO_EPL,niv.nombre_nac,formaContrato_epl,nombre_fac,nombre_are

from  area,facultad,materia,periodo,empleado as epl, horario as hrr
left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
left join nivelacademico as niv on foa.serial_nac = niv.serial_nac
 where   
hrr.serial_epl=epl.serial_epl
and materia.serial_mat=hrr.serial_mat
and area.serial_are=materia.serial_are
and area.serial_fac=facultad.serial_fac

and periodo.serial_per=hrr.serial_per
and fecini_per between '".$fecha_ini."' and '".$fecha_fin."'
and periodo.serial_suc=".$serial_suc."
and periodo.serial_sec=".$serial_sec."
";
//echo $sql_profesores;
$rsprofesores=$dblink->Execute($sql_profesores); 
//mssql_free_result($resultado);*/
//COnsulta del Periodo Academico Inicial
$rsPeriodo_ini=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas  from periodo where serial_per=".$serial_per_ini);

$rsPeriodo_fin=$dblink->Execute("select nombre_per,  concat_ws(' hasta ',fecini_per,fecfin_per) fechas   from periodo where serial_per=".$serial_per_fin);

/*$alulas ="select per.serial_per, per.nombre_per as periodo, mat.nombre_mat as materia, aul.nombre_aul as aula
, count(mmat.SERIAL_ALU) as alumnos, per.fecini_per as inicio, per.fecfin_per as final
from materia as mat, detallemateriamatriculada as dmat, materiamatriculada as mmat
, horario as hrr, periodo as per, aulas as aul
where mat.serial_mat = dmat.serial_mat
and dmat.serial_dmat = mmat.SERIAL_MMAT
and hrr.SERIAL_HRR = dmat.serial_hrr
and mmat.SERIAL_PER = per.serial_per
and hrr.SERIAL_AUL = aul.serial_aul
and per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."'
and per.serial_suc = ".$serial_suc."
and per.serial_sec = ".$serial_sec."
group by mmat.SERIAL_PER, dmat.serial_mat, hrr.SERIAL_AUL
order by per.serial_per, dmat.serial_mat, hrr.SERIAL_AUL";*/
if($serial_per_ini==$serial_per_fin){
   $periodoigual = " per.serial_per=".$serial_per_ini." ";
  }else{
   $periodoigual = " fecini_per >='".$fecha_ini."' and fecini_per<'".$fecha_fin."' ";
  }

//per.fecini_per between '".$fecha_ini."' and '".$fecha_fin."'
$alulas ="select hrr.SERIAL_HRR, hrr.SERIAL_PER as hrrper, per.serial_per as permat, per.nombre_per as periodo, mat.serial_mat, mat.nombre_mat as materia, aul.nombre_aul as aula 
, count(mmat.SERIAL_ALU) as alumnos, per.fecini_per as inicio, per.fecfin_per as final, aul.serial_aul, codigo_mat,seccion_hrr
from materiamatriculada as mmat,detallemateriamatriculada as dmat,horario as hrr,aulas as aul
, periodo as per, alumno as alu,materia as mat
where hrr.serial_hrr=dmat.serial_hrr
and hrr.SERIAL_PER = per.serial_per
and mmat.serial_mmat = dmat.serial_mmat 
and hrr.serial_aul = aul.serial_aul
and alu.serial_alu = mmat.SERIAL_ALU
and dmat.serial_mat = mat.serial_mat
and".$periodoigual."
and per.serial_suc = ".$serial_suc."
and per.serial_sec = ".$serial_sec." 
group by hrr.SERIAL_PER, dmat.serial_mat, hrr.SERIAL_AUL
order by per.serial_per, mat.nombre_mat, hrr.SERIAL_AUL";
$rsAlulas=$dblink->Execute($alulas);

//echo $alulas;

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
    <th colspan="2">Estudiantes por Aula </th>
  </tr>
  <tr >
    <th colspan="2">PERIODOS:  <? echo $rsPeriodo_ini->fields['nombre_per'];?> &lt;=&gt; <? echo $rsPeriodo_fin->fields['nombre_per'];?></th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS DE LOS PERIODOS: desde: <? echo $fecha_ini;?>&lt;=&gt;hasta: <? echo $fecha_fin;?> </th>
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
	<tr>
          					<th width="1%"  style="">Nro.</th>
							<th width="5%">Código</th>
					        <th width="25%">Materia</th>
		  					<th width="10%">Número de Estudiantes</th>
		  					<th width="20%">Aula</th>
							<th width="20%">Periodo</th>
		 				</tr>	
        		 
		 
        
		<? $i=1;
		  $per = 0;
		  $bandera = 0;		  
		  
		  $total = $rsAlulas->RecordCount();
		  
		  //echo "T : ".$total;
		  
			while (!$rsAlulas->EOF) {
			   //echo $alumnos."<br>"; 
			   
			 
			?>
				<? 
					if($rsAlulas->fields['serial_per']!=$per){					
						if($bandera == 1){
				?>
						<tr>
						<td colspan="3" ><span class="style4"><? echo "Total de Alumnos:  ".$totalAlumnos;?></span></td>
						<td colspan="2" ><span class="style4"><? echo "Promedio de Alumno por Aula:  ".number_format($totalAlumnos/$i,1);?></span></td>						
						</tr>
						<?
						}
						?>	
						<tr>
						<td align="center" colspan="5"><span class="style1"><? echo $rsAlulas->fields['periodo']." Inició: ".$rsAlulas->fields['inicio'].""." Finalizó: ".$rsAlulas->fields['final'];
						$i=1;
						$totalAlumnos = 0;
						?></span></td>
						<tr>
							 
				<?	
					}		
					
						
									
					$per = $rsAlulas->fields['serial_per'];
				?>
				
				<tr> 
				<td><span class="style2"><? echo $i;?></span></td>
				<td><span class="style2"><? echo $rsAlulas->fields['codigo_mat'];?></span></td>				
				<td><span class="style2"><? echo $rsAlulas->fields['materia']."=>".$rsAlulas->fields['seccion_hrr'];?></span></td>
				<td nowrap="nowrap"><span class="style2"><? echo $rsAlulas->fields['alumnos'];?></span></td>
				<td><span class="style2"><? echo $rsAlulas->fields['aula'];?></span></td>				
				<td><span class="style2"><? echo $rsAlulas->fields['periodo'];?></span></td>				
				</tr>				
				
			
		<?
//		echo "<td>".$rsAlulas->CurrentRow()."---".$total."</td>";
				
		
		
		$bandera=1;
		$totalAlumnos =  $totalAlumnos + $rsAlulas->fields['alumnos'];
		$i++;
		
		
		if($rsAlulas->CurrentRow()==$rsAlulas->RecordCount()-1){
		//	 echo "<td>"."Salio"."</td>";
		?>	 
			 <tr>
						<td colspan="3" ><span class="style4"><? echo "Total de Alumnos:  ".$totalAlumnos;?></span></td>
						<td colspan="3" ><span class="style4"><? echo "Promedio de Alumno por Aula:  ".number_format($totalAlumnos/$i,1);?></span></td>						
						</tr>
			
		<?	 
		}
				$rsAlulas->MoveNext();
		}
		
	//if ($rsAlulas->MoveLast()==1)
			  // echo $rsAlulas->EOF."<- </p>";

		
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

</body>
</html>