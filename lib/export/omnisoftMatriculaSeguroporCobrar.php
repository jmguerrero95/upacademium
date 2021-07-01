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

		

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
		
		$fecha=$_GET['fecha'];

		$serial_suc=$_GET['serial_suc'];
		$serial_sec=$_GET['serial_sec'];	
		$buscar=$_GET['buscar'];	
		$estado=$_GET['estado'];
		

			

if ($serial_suc!='T')
	$sucursal= " and alu.serial_suc = ".$serial_suc;	
else
	$sucursal= "";

if ($serial_sec!='T')
	$seccion= " and alu.serial_sec = ".$serial_sec;	
else
	$seccion= "";



if($estado=='F'){
$alumnos = "SELECT
	caf.serial_alu,	
    concat_ws(' ',alu.apellidopaterno_alu,alu.apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre,
	MAX(fecha_caf) fecha_caf,
    datediff(DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d'),DATE_FORMAT(MAX(fecha_caf),'%Y-%m-%d')) / 365  as anios  

FROM	
	cabecerafactura    AS caf,	
    alumno as alu ,
	detallefactura  AS dfa,
	detallearancel   AS dar 
					WHERE
						caf.serial_alu=alu.serial_alu AND
						caf.serial_caf=dfa.serial_caf AND
						dfa.serial_dar=dar.serial_dar AND
						descripcion_dar LIKE '".$buscar."' AND
						caf.estado_caf <> 'ANULADO' 						
						AND caf.SERIAL_ALU NOT IN (SELECT
								serial_alu 
							FROM
								alumnomalla 
							WHERE
								fecegresamiento_ama <> '0000-00-00'	)
	AND caf.estado_caf <> 'ANULADO'
    ".$sucursal."
    ".$seccion."
    group by caf.serial_alu order by nombre";
	$factor=1;
}else{
$alumnos = "SELECT
	serial_alu,
	concat_ws(' ',alu.apellidopaterno_alu,alu.apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre	
FROM	
	alumno AS alu 
WHERE		
	SERIAL_ALU NOT IN (	SELECT	serial_alu 	FROM alumnomalla WHERE fecegresamiento_ama <> '0000-00-00')	
    and serial_alu not in (SELECT caf.serial_alu	
								FROM
									cabecerafactura AS caf,
									detallefactura  AS dfa,
									detallearancel  AS dar 
								WHERE
									caf.serial_caf=dfa.serial_caf AND
									dfa.serial_dar=dar.serial_dar AND	
									descripcion_dar  like '".$buscar."%' AND
									caf.estado_caf <> 'ANULADO')
    ".$sucursal."
    ".$seccion."
GROUP BY
	serial_alu 
ORDER BY
	nombre";
	$factor=0;
}

$rsAlumnos=$dblink->Execute($alumnos);
//echo "</p> Script Alumno: ".$alumnos;
//echo $materias;

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
    <th colspan="2">MATRICULAS Y SEGUROS POR COBRAR </th>
  </tr>
  <tr >
    <th colspan="2"><script> var f = new Date(); 

				document.write(f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate()) 
				</script></th>
  </tr>
  <tr>
    <th colspan="2">&nbsp;</th>
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
          					<th width="25%">Estudiante</th>		  											
							
							<th width="10%">Ultima Fecha de Pago</th>							
							<th width="10%">hece Aproximadamente (A&ntilde;os) </th>								
			</tr>	
        
		<? $i='';		  
//		  $rsMaterias->Movefirst();
			while(!$rsAlumnos->EOF){				
			//echo "</p> Alumno: ".$rsAlumnos->fields['serial_alu'];
			/*if($estado=='F'){
			$matricula="SELECT caf.SERIAL_ALU,caf.numero_caf, 
						descripcion_dar,max(fecha_caf) as fecha_caf,
						datediff(DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d'),DATE_FORMAT(max(fecha_caf),'%Y-%m-%d')) / 365  as anios  
					FROM
						cabecerafactura AS caf,
						detallefactura  AS dfa,
						detallearancel   AS dar 
					WHERE
						caf.serial_caf=dfa.serial_caf AND
						dfa.serial_dar=dar.serial_dar AND
						caf.serial_alu = ".$rsAlumnos->fields['serial_alu']." AND
						descripcion_dar LIKE '".$buscar."%' AND
						caf.estado_caf <> 'ANULADO' 						
						GROUP BY caf.SERIAL_ALU
						order by fecha_caf";
					$factor=1;
					}else{
						$matricula="select serial_alu, '' as fecha_caf,1 as anios from alumno where serial_alu = ".$rsAlumnos->fields['serial_alu'];
						$factor=0;
					}
					
				$rsMatricula=$dblink->Execute($matricula);			*/
//				AND	fecha_caf <= '".$fecha."'
				//echo '</p> MATRICULA: '.$matricula;
				$i++;
			/*	while(!$rsMatricula->EOF){
				
						if($rsMatricula->fields['anios']>=1){*/
						//."|".$rsAlumnos->fields['serial_alu']
				?>	

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $rsAlumnos->fields['nombre']; ?></td>
							<td><?php echo $rsAlumnos->fields['fecha_caf']; ?></td>
							<td><?php echo $rsAlumnos->fields['anios']*$factor; ?></td>
						</tr>		
				<?php
						/*}
					$rsMatricula->MoveNext();
				}*/
				
			?>	
				
							
		<?								
		
			$rsAlumnos->MoveNext();
		}
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