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
.style1 {color: #999999}
.style2 {color: #000000}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		$periodo_ini=explode("*",$_GET['fecha_ini']);
		$serial_per_ini=$periodo_ini[0];		
 		$fecha_ini=$periodo_ini[1];
		if(strlen($serial_per_ini)<=0){
			echo "<br><center><strong>Error: Seleccione correctamente los parametros para generar el reporte...</strong></center><br>";
			exit(1);
		}
		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];
		$chkRegistros=$_GET['chkRegistros'];
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
	$sqlMain = "
	SELECT
	     dmat.serial_mat
		 ,hrr.serial_hrr
		,nombre_mat as materia
		,nombrehorario_hrr
		,count(*) as nalumnos
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
		and dmat.serial_hrr = hrr.serial_hrr
		and per.serial_suc = ".$serial_suc." 
		and per.serial_sec = ".$serial_sec." 
		and per.serial_per = ".$serial_per_ini." 
		and dmat.fecharetiro_dmat = '0000-00-00'
	GROUP BY
		".$tipoGroup."
	ORDER BY
		nombre_mat
	";
	//echo "<br>".$sqlMain;
	$rsMain = $dblink->Execute($sqlMain); 
	$numReg = $rsMain->RecordCount();
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
    <th colspan="2">ALUMNOS POR <?php echo $tittlePrin?> DE UN PERIODO </th>
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
          <th width="5%" bgcolor="#999999"><span class="style2">Serie <?php echo $tittle;?> </span></th>
		  <th width="20%" bgcolor="#999999"><span class="style2"><?php echo $tittle;?> </span></th>
		  <th width="10%" bgcolor="#999999"><span class="style2">No. Alumnos </span></th>
		
		</tr>
        	
				<tr> 
				<?php 
					$i = 1;
					while (!$rsMain->EOF) {
							switch($tipo_reporte){
							case "HRR":
								$Tipo = $rsMain->fields['nombrehorario_hrr'];
								$serie = $rsMain->fields['serial_hrr'];								
								break;
								
							case "MAT":
								$Tipo = $rsMain->fields['materia'];
								$serie = $rsMain->fields['serial_mat'];								
								
								break;
							}

				?>
				<td><span class="style2"><?php echo $i;?></span></td>

				<td NOWRAP ><span class="style2">
				<?php  echo $serie;	?> </span></td>
				<td NOWRAP><span class="style2"><?php echo $Tipo;?> </span></td>
				<td NOWRAP><span class="style2"><?php echo $rsMain->fields['nalumnos'];?> </span></td>
				</tr>
				<?php 
					$rsMain->MoveNext();
					$i++;
				}					
				?>		
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>