<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {color: #CC0000}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//Get Materias tomadas de la malla 
if ($_REQUEST["action"] == "save") {
	$sqlDelMain	= "
		SELECT
		cabecera_evaluacion.serial_ceva 
		FROM
		cabecera_evaluacion 
		WHERE
		serial_ceva NOT IN (SELECT
								serial_ceva 
							FROM
								detalle_evaluacion 
		)
	";
	$arrDelMain = $dblink->GetAll($sqlDelMain);
	$totDelMain = count($arrDelMain);
	for($i=0;$i<$totDelMain;$i++){	
		$sqlDel = "
			DELETE
			FROM
				cabecera_evaluacion 
			WHERE
				serial_ceva = ".$arrDelMain[$i]['serial_ceva']." 
			";	
		$arrDel = $dblink->Execute($sqlDel);
	}

	echo "<script>alert('MENSAJE SIFA: Se eliminaron todas las encuestas no concluidas...');window.close();</script>";
	
}else{

}

$sqlMain = "
SELECT
	FECHA_CEVA,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,
	nombre2_alu)AS nombre,
	nombre_suc 
FROM
	cabecera_evaluacion 
		LEFT JOIN alumno AS alu 
		ON alu.serial_alu = cabecera_evaluacion.serial_alu 
		LEFT JOIN sucursal AS suc 
		ON suc.serial_suc = alu.serial_suc 
WHERE
	serial_ceva NOT IN (SELECT
							serial_ceva 
						FROM
							detalle_evaluacion 
	)
ORDER BY
	FECHA_CEVA DESC
";
//echo "<br>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain);


?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:10px}

-->
</style>


<script>
function save()
{
 ventana = confirm("Borrar todas las evaluaciones no concluidas?");
 if (ventana) {
 	document.getElementById('action').value = "save"; 
	document.getElementById('main').submit(); 
 }
}

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

<form action="omnisoftBorrarEvaluacionNoConcluida.php" method="post" enctype="multipart/form-data" id="main" name="main">
<input name="action" id="action" type="hidden" value="" />


<table width="80%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <th >
          <p class="">EVALUACIONES NO CONCLUIDAS </p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th >&nbsp;</th>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th align="right">&nbsp;<script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></th>
      </tr>
    </table></td>
  </tr>
  
  <tr>
          <th colspan="4" ><div align="center"><input type="button" name="Submit2" value="Eliminar Elementos" onClick="save()"></div></th>
	    </tr>
  <tr>
  
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="9%">Nº.</th>
            <th width="26%">Fecha Encuesta  </th>
		    <th width="40%">Alumno</th>
		    <th width="25%">Sucursal </th>
	    </tr>
        
        <?php  		   
		 for($i=0;$i<$totAll;$i++){	
		?>
        
        <tr>
          <td  align="left" nowrap><? echo $i + 1; ?></td>
               <td align="left" nowrap><? echo $arrMain[$i]['FECHA_CEVA'];?> </td>		   	
		       <td align="right"><? echo $arrMain[$i]['nombre']; ?> </td>
		       <td align="right"><? echo $arrMain[$i]['nombre_suc'];?></td>
        </tr>
        
        <?php 
			}
			?> 
      
        
        
        <tr>
          <th colspan="4" ><div align="center"><input type="button" name="Submit2" value="Eliminar Elementos" onClick="save()"></div></th>
	    </tr>
        <!-- <tr>
          <th colspan="7" ><div align="right">PROMEDIO / 100: </div></th>
		  <th ><?php  //echo $promedioSobreCien; ?> </th>
		  <th >&nbsp; </th>
		  <th >&nbsp;</th>
		  <th >&nbsp; </th>
		  </tr>	-->
      </table>
        <BR><BR>
      <br /></td></tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>
</form>

</body>
</html>

