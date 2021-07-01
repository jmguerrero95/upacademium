<?php 
//MPC: ultima modificacion si selecciona el mismo periodo inicial 
//     y final se consulte por el serial del periodo no por fechas
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style2 {color: #000000}
.style3 {color: #990000}
.style4 {color: #FF0000}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		include('../server/funciones.php');
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];		
 		$fecha_ini=$periodo_ini[1];
		if(strlen($serial_per_ini)<=0){
			echo "<br><center><strong>Error: Seleccione correctamente los parametros para generar el reporte...</strong></center><br>";
			exit(1);
		}
		$serial_suc = $_GET['serial_suc'];
		$serial_sec = $_GET['serial_sec'];
		$chkRegistros = $_GET['chkRegistros'];
		$tipo_reporte = $_GET['tipo_reporte'];
		switch($tipo_reporte){
			case "HRR":
				$tipoGroup = "hrr.serial_hrr";
				$tittle = "Horario";
				$tittlePrin = "HORARIO";
				break;
			case "MAT":
				$tipoGroup = "dmat.serial_mat";
				$tittle = "Materia";
				$tittlePrin = "MATERIA";
				break;
		}
		//echo $tipoGroup;
		//echo "Periodo que ingreso:".$chkRegistros;
		//echo($serial_maa);
// concat_ws(\' \',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu)
	$pr = "
	SELECT
		fecini_per,
		fecfin_per,
		nombre_per 
	FROM 
		periodo
	WHERE
		periodo.serial_per=".$serial_per_ini."
	";
	$result_periodos = $dblink->Execute($pr);
	//Principal
		//echo "<br>MAIN: ".$pr;
	$sqlMain = "
	SELECT
	    dmat.serial_mat,
		hrr.serial_hrr,
	    nombrehorario_hrr,
		nombre_mat as materia,
		count(*) as nalumnos
	FROM
		materiamatriculada as mmat,
		detallemateriamatriculada as dmat,
		periodo as per,
		alumno as alu,
		materia as mat,
		sucursal as suc,
		horario as hrr
	WHERE 
		mmat.serial_per=per.serial_per
		and mmat.serial_mmat=dmat.serial_mmat
		and mmat.serial_alu = alu.serial_alu
		and dmat.serial_mat = mat.serial_mat
		and mmat.serial_suc = suc.serial_suc
		and hrr.serial_hrr = dmat.serial_hrr
		and per.serial_suc = ".$serial_suc." 
		and per.serial_sec = ".$serial_sec." 
		and per.serial_per = ".$serial_per_ini." 
		and dmat.fecharetiro_dmat = '0000-00-00'
	GROUP BY
		".$tipoGroup."
	ORDER BY
		nombre_mat
	";
	$rsMain = $dblink->Execute($sqlMain); 
	//echo "<br>MAIN: ".$sqlMain;
	//Alumnos

/*	$numReg = $rsAlumnos->RecordCount();
	if($numReg<=0){
		$msg = "
		<br>
		<center>
		<strong>
				Alerta: No se hallaron registros con la seleccion...
		</strong>
		</center>
		<br>
		";
		echo $msg;
			exit;
	}
*/
?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:9px; font:Arial, Helvetica, sans-serif}
.style3 {font-size:12px}
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
    <th colspan="2">ALUMNOS POR <?php echo $tittlePrin?>  DE UN PERIODO </th>
  </tr>
  <tr >
    <th colspan="2"><?php while(!$result_periodos->EOF){ ?> PERIODO: <? echo $result_periodos->fields['nombre_per'];?> </th>
  </tr>
  <tr>
    <th colspan="2"> FECHAS: desde <? echo $result_periodos->fields['fecini_per'];?> hasta <? echo $result_periodos->fields['fecfin_per'];?> <?php $result_periodos->MoveNext();}?></th>
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
          <th width="1%" bgcolor="#999999"  style=""><span class="style2">Nro.</span></th>
          <th width="5%" bgcolor="#999999"><span class="style2"><?php echo $title;?></span></th>
          <th width="10%" bgcolor="#999999"><span class="style2">Credito</span></th>
		  <th width="20%" bgcolor="#999999"><span class="style2">Alumnos </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Fecha Matricula </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Fecha Inscripción</span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Email Personal</span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">Categoria</span></th>
		</tr>
        	
				<tr> 
				<?php 
					$i = 1;
					$j = 0;
					$k = 1;
					$contError = 0;
					
					while (!$rsMain->EOF) {
							$totalAl = $rsMain->fields['nalumnos'];
							/*echo "<td>a</td>";
							echo "<td>b</td>";
							echo "<td>c</td>";
							echo "<td>d</td>";*/
							switch($tipo_reporte){
							case "HRR":
								$agregarTipo = " and hrr.serial_hrr = ".$rsMain->fields['serial_hrr'];
								$imprimir = $rsMain->fields['nombrehorario_hrr'];
								break;
								
							case "MAT":
								$agregarTipo = " and dmat.serial_mat = ".$rsMain->fields['serial_mat'];
								$imprimir = $rsMain->fields['materia'];
								break;
							}
							$sqlAlumnos = "
							SELECT
								dmat.serial_mat,
								hrr.serial_hrr,
								nombrehorario_hrr,
								mmat.serial_mmat,
								nombre_mat,
								concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre,
								fechamatricula_mmat,
								alu.serial_caa,
								alu.fechaInscripcion_alu,
								LOWER(mail_alu)
							FROM
								materiamatriculada as mmat,
								detallemateriamatriculada as dmat,
								periodo as per,
								alumno as alu,
								materia as mat,
								sucursal as suc,
								horario as hrr
							WHERE 
								mmat.serial_per=per.serial_per
								and mmat.serial_mmat=dmat.serial_mmat
								and mmat.serial_alu = alu.serial_alu
								and dmat.serial_mat = mat.serial_mat
								and mmat.serial_suc = suc.serial_suc
								and hrr.serial_hrr = dmat.serial_hrr
								and per.serial_suc = ".$serial_suc." 
								and per.serial_sec = ".$serial_sec." 
								and per.serial_per = ".$serial_per_ini." 
								".$agregarTipo."
								and dmat.fecharetiro_dmat = '0000-00-00'
							ORDER BY
								nombre_mat
							";
						//echo "<br>Det: ".$sqlAlumnos;
						$rsAlumnos = $dblink->Execute($sqlAlumnos); 
						while (!$rsAlumnos->EOF) {												

				?>
				<td><span class="style2"><?php  if($j==0){ echo $i; }else{ echo "&nbsp;";}?></span></td>
				<td NOWRAP><span class="style2">
				  <?php  //if($j==0){echo $imprimir."  ( ".$rsMain->fields['nalumnos']." Alumnos) ";$i++;}else{echo "&nbsp;";}?>
				  <?php  if($j==0){echo $imprimir;$i++;}else{echo "&nbsp;";}?>
				</span></td>
				<?php 
					$fecha_periodo = $fecha_ini;//--$rsPeriodo->fields['fecini_per'];
					$fecha_inicio = "2011-07-01";//fecha sobre la cual se tomo referencia para la validacion 
					if($fecha_periodo >= $fecha_inicio){
						//Validar												
						$showList = verificarPagoCreditos($rsAlumnos->fields['serial_mmat'],$dblink);					
						if($showList[0]['show'] == "SI"){
							$aluString = "
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['']."</span></td>
								<td NOWRAP><span class='style2'>".$k.".-".$rsAlumnos->fields['nombre']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['fechamatricula_mmat']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['fechaInscripcion_alu']."</span></td>								
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['LOWER(mail_alu)']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['serial_caa']."</span></td>";
							echo $aluString;
							
						}else{
							$aluString = "
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['serial_maa']."</span></td>
								<td NOWRAP><span class='style2'>".$k.".-".$rsAlumnos->fields['nombre']." -> ".$rsAlumnos->fields['serial_mmat']."</span><span class='style4'>  Problema Financiero!!!    </span><a href='#' title='".$showList[0]['msg']."'>Ver problema (MouseOver)</a></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['fechamatricula_mmat']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['fechaInscripcion_alu,']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['LOWER(mail_alu)']."</span></td>
								<td NOWRAP><span class='style2'>".$rsAlumnos->fields['serial_caa']."</span></td>
																
							";
							$contError++;
							echo $aluString;
						}
						$k++;
						//echo "<span class='style2'>NOTA: Los Estudiantes que tengan obligaciones pendientes con Financiero serán excluidos de este listado...</span>";
					}else{
						//No validar
						//echo "entro aca<br>";
						$aluString = "
							<td NOWRAP><span class='style2'>".$k.".-".$rsAlumnos->fields['nombre']."</span></td>
							<td NOWRAP><span class='style2'>".$rsAlumnos->fields['fechamatricula_mmat']."</span></td>
							<td NOWRAP><span class='style2'>".$rsAlumnos->fields['LOWER(serial_caa)']."</span></td>
							<td NOWRAP><span class='style2'>".$rsAlumnos->fields['LOWER(mail_alu)']."</span></td>
							
						";
						echo $aluString;
						$k++;					
					}
				
				?>
				<?php
					$rsAlumnos->MoveNext();
					$j++;
					echo "</tr>";
					//echo "";	
					}//fin del recorset de anidado
					$rsMain->MoveNext();
					$j=0;
					$k=1;
					echo
					"<tr>
						<td colspan='5' NOWRAP><span class='style2'><strong> MATERIA: ".$imprimir." / TOTAL REGISTRADOS: ".$totalAl." / CON PROBLEMAS: ".$contError." / EN LISTA: ".($totalAl - $contError)."</strong></span></td>
					</tr>";
					$contError = 0;
					//echo "</tr>";	
					}
				?>	
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><span class="style4"></span></td>
  </tr>
</table>
</body>
</html>