

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
 		$serial_maa = $_GET['serial_maa'];
		$serial_alu = $_GET['serial_alu'];
		//echo "<br>SERIAL ALU:".$serial_alu;
		//echo($serial_maa);
$sqlAlumnoDato = "
SELECT 
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as alumno 
FROM 
	alumno
WHERE
	serial_alu = ".$serial_alu."
";
$rsAlumnoDato = $dblink->Execute($sqlAlumnoDato);

$result=$dblink->Execute('SELECT maa.serial_maa, codigo_maa, nombre_maa, nombre_fac, nombre_esp, nombre_car, totalcreditostitulo_maa, fecini_maa, fecfin_maa, activo_maa, observaciones_maa, car.serial_car, esp.serial_esp,fac.serial_fac,serial_sec FROM malla AS maa,  facultad as fac, carrera AS car, especialidad AS esp WHERE car.serial_car = maa.serial_car AND esp.serial_esp = maa.serial_esp and fac.serial_fac=car.serial_fac and maa.serial_maa='.$serial_maa);

//COnsulta de areas de acuerdo a la malla
$rsArea=$dblink->Execute('SELECT distinct nombre_are,are.serial_are FROM area AS are, nivel AS niv, detallemalla AS dma, materia AS mat, malla as maa, especialidad as esp WHERE are.serial_are = mat.serial_are AND niv.serial_niv = dma.serial_niv AND mat.serial_mat = dma.serial_mat AND maa.serial_maa=dma.serial_maa AND esp.serial_esp=maa.serial_esp and dma.serial_maa='.$serial_maa.' order by ubicacion_are');
//Consulta de Niveles
$rsNivel=$dblink->Execute('SELECT nombre_niv,anio_niv,serial_niv FROM nivel AS niv order by codigo_niv');

//COnsulta de Materias de acuerdo a la malla y al area
	$rsMaterias=$dblink->Execute('SELECT mat.serial_mat,mat.serial_are,codigo_mat,nombre_mat, niv.serial_niv,numerocreditos_dma FROM area AS are, materia as mat, detallemalla as dtm, malla as maa, nivel as niv WHERE are.serial_are = mat.serial_are AND dtm.serial_maa=maa.serial_maa AND dtm.serial_niv=niv.serial_niv AND dtm.serial_mat=mat.serial_mat AND maa.serial_maa='.$serial_maa);
?>
<style type="text/css">
<!--
.style1 {font-size: 36px}
.style2 {font-size: 13px}

-->
</style>
<table width="100%">
  <tr bgcolor="#FFFFFF">
    <td rowspan="4" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>
    <th><strong><? echo $rsAlumnoDato->fields['alumno'];?></strong></th>
  </tr>
  <tr>
    <th><? echo $result->fields['nombre_fac'];?></th>
  </tr>
  <tr>
    <th><? echo $result->fields['nombre_maa'];?></th>
  </tr>
  <tr>
    <th>ESPECIALIZACION:<? echo $result->fields['nombre_esp'];?></th>
  </tr>
</table>
<br />
<br />
<table width="100%" border="1">
  <tr>
    <th >UBICACI&Oacute;N</td>
	<? while (!$rsArea->EOF)
		{
		?>
    <th  align="center"><? echo $rsArea->fields['nombre_are'];?></th>
	<? 
	$rsArea->MoveNext();
	}
	?>
  </tr>
  
  <? while (!$rsNivel->EOF)
	  {
		?>
	<tr>
    <th><? echo $rsNivel->fields['nombre_niv']; ?></th>
	<? 
	 $rsArea->MoveFirst();
	 while (!$rsArea->EOF)
	  {	
		  $rsMaterias->MoveFirst(); 
		  $mat="";
		  $num = 0;
		  while (!$rsMaterias->EOF)
		  {
		  $i++;
			if($rsNivel->fields['serial_niv']==$rsMaterias->fields['serial_niv'] && $rsArea->fields['serial_are']==$rsMaterias->fields['serial_are'] ){
			 	$mat = $mat . $rsMaterias->fields['codigo_mat']."-".$rsMaterias->fields['nombre_mat']."(".$rsMaterias->fields['numerocreditos_dma'].")<br>";
				//inicio
				if($mat!=""){
					$sqlMatAp = "
					SELECT 
						detallemateriamatriculada.serial_mat,
						nombre_mat as materia, 
						estado_nal
					FROM notasalumnos , materia 
						JOIN detallenotasalumnos as dnal_1 on dnal_1.serial_nal = notasalumnos.serial_nal 
							and dnal_1.serial_acal=1 
						JOIN detallenotasalumnos as dnal_2 on dnal_2.serial_nal = notasalumnos.serial_nal 
							and dnal_2.serial_acal=2 
						JOIN detallenotasalumnos as dnal_3 on dnal_3.serial_nal = notasalumnos.serial_nal 
							and dnal_3.serial_acal=3 
						JOIN detallenotasalumnos as dnal_4 on dnal_4.serial_nal = notasalumnos.serial_nal 
							and dnal_4.serial_acal=4 
						JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
						JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
						JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu 
						JOIN periodo ON periodo.serial_per=materiamatriculada.serial_per 
					WHERE 
						materiamatriculada.serial_alu =".$serial_alu." 						
						AND (fecharetiro_dmat ='000-00-00' and retiromateria_dmat <>'SIN COSTO') 
						AND materia.serial_mat=detallemateriamatriculada.serial_mat 
						AND detallemateriamatriculada.serial_mat =".$rsMaterias->fields['serial_mat']." 
						AND estado_nal='APRUEBA'
						AND periodo.serial_sec = ".$result->fields['serial_sec']." 
					
					UNION 
					select  dhom.serial_mat,nombre_mat as materia, 'APRUEBA' as estado_nal
											from homologacion hom,detallehomologacion dhom , materia mat
											where  hom.serial_hom=dhom.serial_hom and
												dhom.serial_mat=".$rsMaterias->fields['serial_mat']." and
												dhom.serial_mat=mat.serial_mat AND
												serial_alu = ".$serial_alu." AND
												hom.serial_sec = ".$result->fields['serial_sec']."  	
					ORDER BY 
						materia							
					";
				
					//echo "<br>".$sqlMatAp."<br>";
					$rsMatAp = $dblink->Execute($sqlMatAp);
				 	$num = $rsMatAp->RecordCount();
				 	if($num == 1){				 		
						while(!$rsMatAp->EOF){
							$resMat = $rsMatAp->fields['estado_nal'];							 
							$rsMatAp->MoveNext();
						}
						if($resMat == "APRUEBA"){
							//echo "<br>".$sqlMatAp."<br>";
							//$mat = "<strong><font color='blue' face='Comic Sans MS,arial,verdana'>".$mat."</font></strong>";
							//$mat = "<strong><font color='blue' face='Comic Sans MS,arial,verdana'>( APRUEBA )</font></strong><br>";
							$mat = $mat."<strong><font color='blue' face='Comic Sans MS,arial,verdana'>( APROBADA )</font></strong><br>";
						}
					}
				}			

				
				//fin
				
				}

				
	  	    $rsMaterias->MoveNext();
		 }
		 
		 if($mat!="")
			echo "<span class='style2'><td align='center' nowrap>".$mat."</td></span>";
		 else
		   echo "<td>&nbsp;</td>";
		   
		  $rsArea->MoveNext();
		 }
		$rsNivel->MoveNext();
		?>
  </tr>
		<?
	  }
	?>
  
</table>
