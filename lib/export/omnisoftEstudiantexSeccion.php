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
 		$serial_per = $_GET['serial_per'];
		$serial_sec = $_GET['serial_sec'];
		$serial_fac = $_GET['serial_fac'];
		$fecha_ini = $_GET['fecha_ini'];
		$fecha_fin = $_GET['fecha_fin'];
		$serial_suc = $_GET['serial_suc'];
		
		//Parametrizacion
		if($serial_suc=="T"){
			$sucursal = "";
		}else{
			$sucursal = " and alu.serial_suc =".$serial_suc;
		}
		if($serial_sec==2){
			$carrera=" concat_ws('-',nombre_crp,nombre_car) as carrera ";			
		}else{
			$carrera=" concat_ws('-',nombre_crp) as carrera ";
		}
		//echo "<br>".$serial_fac."<br>";	
		if ($serial_fac == "T"){
			$facultad = "";
			//echo "entro";
		}else{
			if($serial_sec==2)
				$facultad = " and carrera.serial_car = ".$serial_fac;
			else	
				$facultad = " and facultad.serial_fac = ".$serial_fac;				
			
		}
		//echo "<br>COUNT: ".count($fecha_ini)."<br>";
		//echo "<br>STRLEN: ".strlen($fecha_ini)."<br>";
		//if((strlen($fecha_ini)>0  and strlen($fecha_fin)>0) or $serial_suc == "T"){
		if($serial_per =='' or $serial_suc == "T" or (strlen($fecha_ini)>0 and strlen($fecha_fin)>0)){
			$periodo = "and fecini_per>='".$fecha_ini."' and fecini_per<='".$fecha_fin."'";
		}else{			
			$periodo = " and ama.serial_per = ".$serial_per;	
		}
		$sqlAlumno = "
			SELECT
				alu.serial_alu,
				concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, 
				nombre2_alu) AS nombre,
				codigoIdentificacion_alu                                                        
				AS identificacion,
				concat_ws(' / ',telefodomic_alu, celular_alu)                                   
				AS telefono,
				codigo_alu,
				nombre_suc,
				mmat.serial_sec,
				sex.descripcion_sex                                                             
				AS sexo,
				nombre_maa,
				alu.serial_sex,
				concat_ws(' / ',mailuniv_alu,mail_alu)                                          
				AS mailuniv_alu,
				nombre_fac,
				".$carrera.",
				concat_ws(' - ',nombre_suc, nombre_crp)                                         
				AS carrera_sede 
			FROM
				alumno             AS alu,
				malla              AS maa,
				alumnomalla        AS ama,
				sexo               AS sex,
				periodo            AS per,
				sucursal           AS suc,
				materiamatriculada AS mmat,
				seccion as sec
					LEFT JOIN carrera 
					ON carrera.serial_car=maa.serial_car 
					LEFT JOIN carreraprincipal 
					ON carreraprincipal.serial_crp=carrera.serial_crp 
					LEFT JOIN facultad 
					ON facultad.serial_fac=carrera.serial_fac 
			WHERE    
				mmat.serial_alu = alu.serial_alu 
				AND ama.serial_per = per.serial_per
				and mmat.serial_sec = maa.serial_sec 
				AND maa.serial_maa = ama.serial_maa 
				AND alu.serial_alu = ama.serial_alu 
				AND alu.serial_sex = sex.serial_sex 
				AND suc.serial_suc = alu.serial_suc 
				AND maa.serial_maa_p = 0 
				AND (intercambio_alu<>'VIENE INTERCAMBIO' 
				AND intercambio_alu<>'COMUNIDAD') 
				AND mmat.serial_sec = ".$serial_sec." 
				".$periodo."				
				".$sucursal."  
				".$facultad."				
				
			GROUP BY
			   mmat.serial_alu 
			ORDER BY
				nombre ASC
		";
	echo "<br>".$sqlAlumno."<br>";
	//and alu.serial_alu = 6546
	//and alu.serial_alu = 6546
	//and alu.serial_alu = 6262
	$rsalumnos = $dblink->Execute($sqlAlumno);
//Consulta del Periodo Academico
	$rsPeriodo=$dblink->Execute('select serial_per, nombre_per, fecini_per, fecfin_per from periodo where serial_per = '.$serial_per);



?>
<style type="text/css">
<!--
.style1 {font-size:18px}
.style2 {font-size:8px}
.style3 {font-size:12px}
.textovertical {writing-mode: tb-rl; filter: flipv fliph}
 H1.SaltoDePagina
 {
     PAGE-BREAK-AFTER: always
 }

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

<? 	
	/*$j=0;	
	while (!$rshorario_temp->EOF) {
	if($j>0) echo "<H1 class=SaltoDePagina> </H1>";*/
	?>
<BR>

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="6" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">LISTA DE ALUMNOS INGRESADOS POR PERIODO</span></th>
  </tr>
  <tr >
    <th colspan="2"><?
	   if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "&nbsp;";
	   }else{
			echo "PERIODO: " . $rsPeriodo->fields['nombre_per'];
	   }
	
	 ?></th>
  </tr>
  <tr>
    <th colspan="2"> <?
		if(strlen($fecha_ini)>0  and strlen($fecha_fin)>0){
	   		echo "FECHAS DESDE : ".$fecha_ini." <==> ";
			echo " HASTA : ".$fecha_fin;
	   }else{	   
			echo "FECHAS DESDE : ".$rsPeriodo->fields['fecini_per']." <==> ";
			echo " HASTA : ".$rsPeriodo->fields['fecfin_per'];
	   }	
	?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">PROGRAMA:</th>
    <th width="61%" align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">SUCURSAL:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
	
  </tr>
  

  <tr>
    <td colspan="3" bgcolor="#FFFFFF">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
   		 <tr>
		  <th width="1%"  style=""><? echo "No"; ?></th>		 
          <th width="20%"><? echo "Nombre."; ?></th>
		  <th width="7%">E-mail</th>
		  <th width="7%">Teléfonos</th>
          <th width="4%" >Identificación</th>		 
          <th width="4%" >Código</th>
          <th width="4%" >Sexo</th>      
		   <th width="4%" >Malla</th>         
		  <th width="20%" >Facultad</th>
          <th width="20%" >Carrera</th>
          <th width="20%" >Sede</th>  
		   	<?php
				if($rsalumnos->fields['serial_sec']==7){
				?>	
		  <th width="20%" >Estado</th>
		  
		 <? //$i=1;
		 }
		 
		$m = 0;
		$f = 0;
		$i=0;
		$contAprueba = 0;
		$contReprueba = 0;
		$contOtro = 0;
		$rsalumnos->MoveFirst();
		while (!$rsalumnos->EOF) {
		$i=$i+1;
			//if($i==1){
		?> 
        </tr>
			<?
			//}
			//if($rshorario_temp->fields['mes']==$rshorario->fields['mes']){
			?>
		
				<tr> 
				<td ><span class="style2"><? echo $i;?></span></td>
				<td nowrap="nowrap" ><span class="style2"><? echo $rsalumnos->fields['nombre'];?></span></td>
				<td ><span class="style2"><? echo strtolower($rsalumnos->fields['mailuniv_alu']);?></span></td>
				<td ><span class="style2"><? echo strtolower($rsalumnos->fields['telefono']);?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['identificacion'];?> </span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['codigo_alu'];?> </span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['sexo'];?></span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_maa'];?> </span> </td>				
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_fac'];?></span> </td>
				<td ><span class="style2"><? echo $rsalumnos->fields['carrera'];?></span></td>
				<td ><span class="style2"><? echo $rsalumnos->fields['nombre_suc'];?></span></td>
				
				<?php
					if($rsalumnos->fields['serial_sec']==7){
						$estado = preUniversitario($rsalumnos->fields['serial_alu'],$rsalumnos->fields['serial_sec']);
				?>	
					<td ><span class="style2">
					<? 
					echo $estado;
						if(strlen(strpos($estado,"APRUEBA"))>0){
							$contAprueba++;	
						}else{
							if(strlen(strpos($estado,"REPRUEBA"))>0){
							$contReprueba++;
							}else{						
								$contOtro++;
							}						
						}
						
					?></span></td>					
				<?php	
					}
					
				 if ($rsalumnos->fields['serial_sex']==1){
				 	$m=$m+1;
				 }else 	$f=$f+1;
				?>
				 
				
			
		<? 
			//}
			//$i=$i+1;
			$rsalumnos->MoveNext();
	  	}
		?>
    </table>
    </td>
  </tr>
 
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>

          <td width="51%" align="center"><div align="left">
			<p>TOTAL MUJERES : <? echo " ".$f;?></p>
            <p>TOTAL VARONES:  <? echo " ".$m;?></p>            
			<p>TOTAL APROBADOS : <? echo " ".$contAprueba;?></p>
			<p>TOTAL REPROBADOS : <? echo " ".$contReprueba;?></p>
			<p>TOTAL OTROS : <? echo " ".$contOtro;?></p>
			<p>TOTAL : <? echo " ".$i;?></p>
          </div></td>
          <td width="49%" align="center"><div align="left">REVISADO POR: </div></td>
        </tr>
      </table></td>
  </tr>
  
</table>

<p>&nbsp;</p>
<?php 
	$vector=funEstadistica($rsalumnos);

	$alumnoXcarrera=$vector[0];
	//asort($alumnoXcarrera);	
	$cuantos = (count($alumnoXcarrera,1)/count($alumnoXcarrera,0))-1; // cuantas filas tiene el vector	
?>
<table align="center">
  <tr>  	
  	<td>Carrera</td>
  	<td>Hombres</td>
	<td>Mujeres</td>
	<td>Total Carrera</td>
  </tr>
  <?php 
	$carreras = array();	
  	for($j=0;$j<=$cuantos;$j++){
  		$carreras[$j]['carrera'] = $alumnoXcarrera[1][$j];
		$carreras[$j]['hombres'] = $alumnoXcarrera[3][$j];
		$carreras[$j]['mujeres'] = $alumnoXcarrera[4][$j];
		$carreras[$j]['total'] = $alumnoXcarrera[2][$j];
	}
     $newCarreras =  orderMultiDimensionalArray($carreras,'carrera',false);   	 
	  //print "<pre>";print_r($newCarreras);print "<pre>";
  	
	for($j=0;$j<=$cuantos;$j++){
  ?>	
  <tr>
	<!-- <td><?php //echo $alumnoXcarrera[5][$j];//Sub Area Unesco ?></td> -->
	<td><?php echo $newCarreras[$j]['carrera'];//Carrera ?></td>
  	<td><?php echo $newCarreras[$j]['hombres']; //hombres x carrera ?></td>
	<td><?php echo $newCarreras[$j]['mujeres'];//mujereres x carrera ?></td>
	<td><?php echo $newCarreras[$j]['total'];//Total Alumnos x carrera ?></td>
  </tr>
  <?php
  }
  ?>
    <tr>		    
		<td>Total:</td>
		<td><?php echo $m; ?></td>
		<td><?php echo $f; ?></td>
		<td><?php echo $m + $f; ?></td>
	  </tr>	 
  
</table>

<? 		/*$j++;
		$rshorario_temp->MoveNext();
	  	}*/
		?>
</body>
</html>

<?php
function preUniversitario($alumno,$programa){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $dblink;

$estado='';

	/*$sqlApruebaPre="SELECT
					SERIAL_ALU,
					mmat.SERIAL_MMAT,
					dmat.serial_dmat,
					estado_nal 
				FROM
					materiamatriculada mmat,
					detallemateriamatriculada AS dmat,
					notasalumnos nal 
				WHERE
					mmat.SERIAL_MMAT=dmat.serial_mmat AND
					dmat.serial_dmat=nal.serial_dmat AND
					serial_alu= ".$alumno." AND
					SERIAL_SEC = ".$programa;*/
	$carrera="";
	$sqlCarrera="
	SELECT 
		nombre_crp as carrera
	FROM 
		alumno as alu 
		left join alumnomalla on alumnomalla.serial_alu=alu.serial_alu
        left join malla on malla.serial_maa=alumnomalla.serial_maa 
        left join carrera on carrera.serial_car=malla.serial_car 
        left join carreraprincipal on carreraprincipal.serial_crp=carrera.serial_crp
        left join facultad on facultad.serial_fac=carrera.serial_fac
	WHERE 	alu.serial_alu = ".$alumno."  and  malla.serial_sec<>".$programa;
	//echo $sqlCarrera;
	$rsCarrera = $dblink->Execute($sqlCarrera);	
	if($rsCarrera->recordCount()>0){
		$carrera = $rsCarrera->fields['carrera'];	
	}

	$sqlApruebaPre="
		SELECT
			serial_mat,
			estado_nal 
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			notasalumnos               AS nal 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat AND
			dmat.serial_dmat = nal.serial_dmat AND
			serial_alu = ".$alumno." AND
			mmat.serial_sec = ".$programa." AND
			serial_mat IN(	SELECT
								serial_mat 
							FROM
								alumnomalla  AS ama,
								malla        AS maa,
								detallemalla AS dmaa 
							WHERE
								maa.serial_maa=dmaa.serial_maa AND
								ama.serial_maa = maa.serial_maa AND
								serial_alu = ".$alumno." AND
								serial_sec = ".$programa."
			)"
		;			
		//echo "<br>OTRO: ".$sqlApruebaPre."<br>";
		$contAp = 0;
		$contRep = 0;
		$contOtro = 0;
		if($arr = $dblink->GetAll($sqlApruebaPre)){	
			//print "<pre>";print_r($arr);print "<pre>";
			$tot = count($arr);
			for($i=0;$i<$tot;$i++){
				switch($arr[$i]['estado_nal']){
					case "APRUEBA": 
							$contAp++;
						break;
					case "REPRUEBA": 
							$contRep++;
						break;
					default : $contOtro++;					
				}		
			}
			if($contOtro>0){
				return "Revisar Notas..."." <=> ".$carrera;
			}
			if($contAp == $tot){
				return "APRUEBA"." <=> ".$carrera;
			}else{		
				return "REPRUEBA"." <=> ".$carrera;
			}
		}else{
			return false;
		}
		
		
}

function funEstadistica($rsalumnos){

$vecCarrera;
$vecAlumnosCarrera;

$hombres=0;
$mujeres=0;
$cuantos=0;
$bandera=0;//activa para ingresar una nueva carrera



		$rsalumnos->MoveFirst();
		while(!$rsalumnos->EOF){						
			
			//ALUMNOS POR CARRERA
			$carrera = $rsalumnos->fields['carrera_sede'];			
			//$subArea = $rsalumnos->fields['subarea_aun'];
			
									
			if($cuantos==0){
				$vecCarrera[1][0]=$carrera;
				$vecCarrera[2][0]=1;
				$carrera ='';								
				if($rsalumnos->fields['serial_sex']==1){
									$vecCarrera[3][0]=1;//hombre
									$vecCarrera[4][0]=0;//mujer
				}
				if($rsalumnos->fields['serial_sex']==2){
									$vecCarrera[4][0]=1;//hombre
									$vecCarrera[3][0]=0;//mujer	
				}
				$vecCarrera[5][0]=$subArea;
				
			}
	if($carrera <> ''){	
			for($i=0;$i<=$cuantos;$i++){			
						if($vecCarrera[1][$i]==$carrera){		
							$vecCarrera[1][$i]=$carrera;
							$vecCarrera[2][$i]=$vecCarrera[2][$i]+1;							
							
								
							if($rsalumnos->fields['serial_sex']==1){
									$vecCarrera[3][$i]=$vecCarrera[3][$i]+1; //hombre
								}
								if($rsalumnos->fields['serial_sex']==2){
									$vecCarrera[4][$i]=$vecCarrera[4][$i]+1; //mujer
								}
							$vecCarrera[5][$i]=$subArea;	
							//$vecCarrera[3][$i]=777;
							$i=$cuantos+5000;
							$bandera=0;	
								
								
						}
						else{ 							
							$bandera=1 ;
						}
						
													
			}
			
			if($bandera==1){	
				$vecCarrera[1][$cuantos]=$carrera;
				$vecCarrera[2][$cuantos]=1;		
									
							if($rsalumnos->fields['serial_sex']==1){
									$vecCarrera[3][$cuantos]=1; //hombre
									$vecCarrera[4][$cuantos]=0;//mujer
							}
							if($rsalumnos->fields['serial_sex']==2){
									$vecCarrera[4][$cuantos]=1;	//hombre
									$vecCarrera[3][$cuantos]=0; //mujer
							}
				$vecCarrera[5][$cuantos]=$subArea;			
				 }
	}						
			$bandera=0;				
			$carrera='';
			
		$cuantos = (count($vecCarrera,1)/count($vecCarrera,0))-1; // cuantas filas tiene el vector			
		///************************FIN ALUMNOS POR CARRERA**************//				
				
			$rsalumnos->MoveNext();
		}
		
	$vector = array($vecCarrera);
	
	return $vector; 

}

function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
    $position = array();  
    $newRow = array();  
    foreach ($toOrderArray as $key => $row) {  
            $position[$key]  = $row[$field];  
            $newRow[$key] = $row;  
    }  
    if ($inverse) {  
        arsort($position);  
    }  
    else {  
        asort($position);  
    }  
    $returnArray = array();  
    foreach ($position as $key => $pos) {       
        $returnArray[] = $newRow[$key];  
    }  
    return $returnArray;  
}  

?>