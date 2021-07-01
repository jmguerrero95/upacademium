<?php
	$serial_alu = $_GET['serial_alu'];
	$serial_sec = $_GET['serial_sec'];
	$serial_car = $_GET['serial_car'];
	
	
?>

<title class='style2'></title>
<script>
		function fbuscar(){
			var query='omnisoftNotasAlumnoPeriodoFM.php?serial_alu=<?php echo $serial_alu;?>&serial_sec=<?php echo $serial_sec;?>&serial_car=<?php echo $serial_car;?>';
			var attributes='width=1020,height=650,scrollbars=yes,resizable=no,toolbar=no,location=no,status=no,menubar=no';
			window.open(query,"mat","width=850,height=650,scrollbars=YES"); 
		}
</script>

</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$sqlAlu = "
SELECT
	codigoIdentificacion_alu,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,
	nombre2_alu) AS alumno,
	direcciondomic_alu,
	lugartrabajo_alu,
	direcciontrabajo_alu,
	mail_alu,
	mailuniv_alu,
	telefodomic_alu,
	telefotrabajo_alu,
	nombre_maa,
	celular_alu,
	creditomax_maa,
	nombre_crp
FROM
	alumno,
	alumnomalla,
	malla 
	LEFT JOIN carrera ON carrera.serial_car=malla.serial_car 
	LEFT JOIN carreraprincipal ON carreraprincipal.serial_crp=carrera.serial_crp 
	LEFT JOIN facultad ON facultad.serial_fac=carrera.serial_fac 
WHERE
	alumno.serial_alu = alumnomalla.serial_alu 
	AND alumnomalla.serial_maa = malla.serial_maa 
	AND serial_maa_p = 0 
	AND malla.serial_sec = ".$serial_sec." 
	AND alumno.serial_alu = ".$serial_alu."
	AND malla.serial_car = ".$serial_car."
";
$arrAlu = $dblink->GetAll($sqlAlu);

//echo "ALUMNO: <br>".$sqlAlu."<br>";

//Get Materias tomadas de la malla 
$sqlMain = "
SELECT
	detallemateriamatriculada.serial_mat,
	notasalumnos.serial_dmat,
	codigo_mat,
	nombre_mat AS materia,
	dnal_1.nota_dnal AS actividades_clase,
	dnal_2.nota_dnal AS trabajos,
	dnal_3.nota_dnal AS ex_parcial,
	dnal_4.nota_dnal AS ex_final,
	(dnal_1.nota_dnal + dnal_2.nota_dnal +dnal_3.nota_dnal + dnal_4.nota_dnal) AS TOTAL,
	notatotal_nal,
	notaalfabetica_nal,
	'' as notanumerica,
	'' as creditomalla,
	'' as tipomateria,
	estado_nal,
	nombre_per,
	periodo.serial_sec,
	numerocreditos_dmat creditosmateria,
	(numerocreditos_dmat+creditosequivalentes_dmat) creditostomados,
	notasalumnos.serial_cale, case  seccion_hrr when 'AVANZADA' then seccion_hrr when 'UBICACION' then seccion_hrr else ' ' end as seccion_hrr, serial_nts
FROM
	notasalumnos ,
	materia,
	materiamatriculada,
	detallemateriamatriculada,
	periodo,
	alumno,horario
	JOIN detallenotasalumnos AS dnal_1 ON dnal_1.serial_nal = notasalumnos.serial_nal AND dnal_1.serial_acal=1 	
    JOIN detallenotasalumnos AS dnal_2 ON dnal_2.serial_nal = notasalumnos.serial_nal AND dnal_2.serial_acal=2 
	JOIN detallenotasalumnos AS dnal_3 ON dnal_3.serial_nal = notasalumnos.serial_nal AND dnal_3.serial_acal=3 
	JOIN detallenotasalumnos AS dnal_4 ON dnal_4.serial_nal = notasalumnos.serial_nal AND dnal_4.serial_acal=4
WHERE
	materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
	AND detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
	AND materiamatriculada.serial_alu = alumno.serial_alu 
	AND periodo.serial_per = materiamatriculada.serial_per 
	AND materiamatriculada.serial_alu = ".$serial_alu." 
	AND periodo.serial_sec = ".$serial_sec."
	AND horario.serial_hrr=detallemateriamatriculada.serial_hrr
	AND estado_hrr = 'ACTIVO'
	AND (fecharetiro_dmat ='000-00-00' 
	AND retiromateria_dmat <>'SIN COSTO') 
	AND materia.serial_mat=detallemateriamatriculada.serial_mat 
	AND detallemateriamatriculada.serial_mat in (
        SELECT	
            mat.serial_mat
        FROM
            malla       AS maa,
            alumnomalla  AS ama,
            detallemalla AS dma,
            materia     AS mat 
        WHERE
            maa.serial_maa = ama.serial_maa 
            AND dma.serial_maa = maa.serial_maa 
            AND mat.serial_mat = dma.serial_mat 
            AND ama.serial_alu = ".$serial_alu." 
            and maa.serial_sec = ".$serial_sec."
			and maa.serial_car = ".$serial_car." 		

	)	

ORDER BY
	fecini_per,
	materia

";

//echo "MATERIA: <b   r>".$sqlMain."<br>";
$arrMain = $dblink->GetAll($sqlMain);
$totAll = count($arrMain); // Cuenta el totla de materias



//TRATAMIENTO HOMOLOGACIONES




$sqlHom = "
	SELECT
		hom.serial_hom,
		dhom.serial_mat,
		serial_alu,
		tipo_hom,
		hom.serial_sec,
		nombre_mat,
		revalida_hom,
		'' as creditohom,
		'' as notaalfabeticah,
		'' as notanumericah,
		'' as estadoh,
		'' as tipo,
		fecha_hom,
		codigo_mat,
		notafinal_dhom, per.nombre_per
	FROM
		homologacion        AS hom,
		detallehomologacion AS dhom,
		materia             AS mat,
		periodo 			as per
	WHERE
		hom.serial_hom = dhom.serial_hom 
		AND mat.serial_mat = dhom.serial_mat 
		and per.serial_per=hom.serial_per
		AND hom.serial_alu = ".$serial_alu."
		AND hom.serial_sec = ".$serial_sec."
		AND hom.serial_car = ".$serial_car."
";

//echo $sqlHom;

$arrHom = $dblink->GetAll($sqlHom);
$totHom = count($arrHom);
//echo $sqlHom;


if($totAll<=0  and $totHom <=0){

	echo "<br>El alumno no tiene registro alguno de notas en su vida académica...<br>";
	exit(0);
}






//Parametrizacion materias 
for($i=0;$i<$totAll;$i++){	
	$arr = getEq($arrMain[$i]['serial_cale'],$arrMain[$i]['notaalfabetica_nal'],$dblink);
	if($arr){
		$arrMain[$i]['notanumerica'] = $arr[0]['numerica_dcale'];
	}
	$arr = getCredito($serial_alu,$arrMain[$i]['serial_mat'],$serial_sec,$dblink);
	if($arr){
		$arrMain[$i]['creditomalla'] = $arr[0]['numerocreditos_dma'];
		//echo "DEL LA MALLA";
		$arrMain[$i]['tipomateria'] = "DM";
	}else{
		$arrMain[$i]['creditomalla'] = $arrMain[$i]['creditosmateria'];
		//echo "DEL REGISTRO";
		$arrMain[$i]['tipomateria'] = "FM";
	}
}

//Contabilizar
$totalCreditosRegistro = 0;
$totalCreditosRegistroHom = 0;
$totalCreditosMalla = 0;
$totalNotaNumericaPorCredito = 0;
$totalNotaNumericaPorCreditoHom = 0;
$totalNotaFinal = 0;
$totalNotasAprueba = 0;
$totalCreditosHomologados = 0;
$totalCreditosExamenAvanzada=0;
$totalCreditosRevalidados = 0;
$totalCreditosEspeciales = 0;
$totalCreditosNormales = 0;
$totalCreditosAprueba = 0;
$totalCreditosReprueba = 0;
$totalCreditos = 0;
$totalRestarCredito = 0;
$totalRestarMultiplicacion = 0;
$totalNotaSobreCuatro = 0;
$totalCreditosMalla = 0;
$totalIRA = 0;
//if($totAll<=0  and $totHom <=0{
/*$arr = getRepMat();
if($arr){
	//print "<pre>";print_r($arr);print "<pre>";
	for($i=0;$i<count($arr);$i++){
			$totalRestarCredito = $totalRestarCredito + $arr[$i]['devengarcreditos'];
			$totalRestarMultiplicacion = $totalRestarMultiplicacion + $arr[$i]['devengartotal'];
//desactivar				
// echo "</p>"."----------------".$arr[$i]['devengarcreditos']."......   ".$arr[$i]['devengartotal'];
	
	}
		
	//echo "</p>"." creditos no aprovados".$totalRestarCredito;
				//echo "</p>"." nota no aprovada ".$totalRestarMultiplicacion;			
}*/

for($i=0;$i<count($arr);$i++){
	if(strlen($arr[$i]['indiceok'])>0){
		$num = strlen($arr[$i]['posicion']);		
		$num = $num -1;
		$newCad = substr($arr[$i]['posicion'],0,$num);
		$arr[$i]['posicion'] = $newCad;		
		$posiciones  = explode('.',$arr[$i]['posicion']);
		//print "<pre>";print_r($posiciones);print "<pre>";
		$indice = $arr[$i]['indiceok'];		
		foreach($posiciones as $value){ 
			if (key($posiciones)!= $indice){
				//echo "<br>MARCAR: ".$posiciones[key($posiciones)]."<br>";
				$marcar = $posiciones[key($posiciones)];
				$arrMain[$marcar]['materia'] = "<font color='red'> ".$arrMain[$marcar]['materia']." (Materia Repetida.)"."</font>";	
			}
			next($posiciones); 
		} 
	
	}
	
	//echo "i: ".$i."<br>";

}	
//echo "<br>TCREDITOS: ".$totalRestarCredito."<br>";
//echo "<br>A RESTAR: ".$totalRestarMultiplicacion."<br>";
$w=0;
for($i=0;$i<$totAll;$i++){		
	$w++;
		switch($arrMain[$i]['estado_nal']){
		case 'APRUEBA':
		//echo $arrMain[$i]['creditomalla'];
			$totalCreditosRegistro = $totalCreditosRegistro + $arrMain[$i]['creditomalla'];
			$totalCreditosMalla = $totalCreditosMalla + $arrMain[$i]['creditomalla'];	
			$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito +($arrMain[$i]['creditomalla']*$arrMain[$i]['notanumerica']);
			//$ban1=mejorPromedio($i,$arrMain,$totAll);
			$totalNotaFinal = $totalNotaFinal + $arrMain[$i]['notatotal_nal']; // Total  nota final
			$totalNotaSobreCuatro = $totalNotaSobreCuatro +  $arrMain[$i]['notanumerica'];	// Total nota numerica aprobada
			$totalCreditosAprueba = $totalCreditosAprueba + $arrMain[$i]['creditomalla'];	// total creditos aprobados
			//echo "</p>"."  totalNotaFinal  ".$totalNotaFinal."  totalNotaSobreCuatro  ".$totalNotaSobreCuatro."  totalCreditosAprueba  ".$totalCreditosAprueba;	
			$totalNotasAprueba++; // contador de aprobadas
			break;
		case 'REPRUEBA':
			$pos =$pos+1;
			$array[$pos]['pos']=$pos;
			$array[$pos]['codigo_mat']=$arrMain[$i]['codigo_mat'];
		
			//echo "</p>".$array[$pos]['codigo_mat'];
			$array[$pos]['notatotal_nal']=$arrMain[$i]['notatotal_nal'];
			$array[$pos]['estado_nal']= $arrMain[$i]['estado_nal'];
			$array[$pos]['notanumerica']= $arrMain[$i]['notanumerica'];
			$array[$pos]['creditomalla']= $arrMain[$i]['creditomalla'];
			$array[$pos]['materia']= $arrMain[$i]['materia'];
			$totalCreditosReprueba = $totalCreditosReprueba + $arrMain[$i]['creditomalla'];	
			break;			
	}	
}

for($r=1;$r<=$pos;$r++)
			//while($r<=$pos)
			{
				for($i=0;$i<$totAll;$i++)
				{
						if($array[$r]['codigo_mat']==$arrMain[$i]['codigo_mat'])
					 	if($arrMain[$i]['estado_nal']=='APRUEBA')
						{
							for($k=$r;$k<=$pos;$k++)
							{
									$array[$k]['pos']=$k;
									$array[$k]['codigo_mat']=$array[$k+1]['codigo_mat'];
									$array[$k]['notatotal_nal']=$array[$k+1]['notatotal_nal'];
									$array[$k]['estado_nal']= $array[$k+1]['estado_nal'];
									$array[$k]['notanumerica']= $array[$k+1]['notanumerica'];
									$array[$k]['creditomalla']= $array[$k+1]['creditomalla'];
									$array[$k]['materia']= $array[$k+1]['materia'];	
							}
							$pos=$pos-1;
							$i=$totAll;
							$r=$r-1;	
							
						}// fin if
					}//fin if	
					//$r=$r+1;					 
			 	}
$sumpromreprobado=0;
$totcre=0;
for ( $i=1;$i<=$pos;$i++){	
								$prom=$array[$i]['notanumerica']*$array[$i]['creditomalla'];
				$sumpromreprobado=$sumpromreprobado+$prom;
				$totcre=$array[$i]['creditomalla']+$totcre;
				} 

	

for($i=0;$i<$totHom;$i++){		
	$arr = getCredito($arrHom[$i]['serial_alu'],$arrHom[$i]['serial_mat'],$arrHom[$i]['serial_sec'],$dblink);
	if($arr){
		$arrHom[$i]['creditohom'] = $arr[0]['numerocreditos_dma'];		
	}
	$arr = getNotaHomologada($arrHom[$i]['serial_alu'],$arrHom[$i]['notafinal_dhom'],$dblink);
	if($arr){
		$arrHom[$i]['notaalfabeticah'] = $arr[0]['notaalfabeticah'];		
		$arrHom[$i]['notanumericah'] = $arr[0]['notanumericah'];		
		$arrHom[$i]['estadoh'] = $arr[0]['estadoh'];		
	}	

	switch($arrHom[$i]['tipo_hom']){
		case 'HOMOLOGACION':
			$totalCreditosHomologados = $totalCreditosHomologados + $arrHom[$i]['creditohom'];		
			$arrHom[$i]['tipo'] = 'HM->HOM';
			for($j=1;$j<=$pos;$j++){
						if($array[$j]['codigo_mat']==$arrHom[$i]['codigo_mat']){
									
									$promh=$array[$j]['notanumerica']*$array[$j]['creditomalla'];
									$sumpromreprobado=$sumpromreprobado-$promh;
									$totcre=$totcre-$array[$j]['creditomalla'];
									//echo " Pomediorepro ".$promh."tot cre ".$array[$j]['creditomalla']."</p> total suma rep ".$sumpromreprobado."Total suma cre rep ".$totcre;
									}
								}
			break;
		case 'EXAMENAVANZADO':
			$totalCreditosExamenAvanzada = $totalCreditosExamenAvanzada + $arrHom[$i]['creditohom'];		
			$arrHom[$i]['tipo'] = 'EA->EXA';
			break;				
			
		case 'REVALIDACION':
			if($arrHom[$i]['revalida_hom']=='NO'){
				$arrHom[$i]['estadoh'] = 'APRUEBA';
				$arrHom[$i]['notaalfabeticah'] = "";		
				$arrHom[$i]['notanumericah'] = "";	
				$arrHom[$i]['notafinal_dhom'] = "";	
			}			
			$totalCreditosRevalidados = $totalCreditosRevalidados + $arrHom[$i]['creditohom'];				
			$arrHom[$i]['tipo'] = 'HM->RVL'.'/'.$arrHom[$i]['revalida_hom'];
			break;	
				
	}
	
}

////
//Tratamiento de los creditos de graduacion
$totalCreditosGraduacionMalla = 0;
$totArrGradMalla = 0;
$arrCreditoGraduacionMalla = getCreditosGraduacionMalla($serial_alu,$serial_sec,$dblink);
if($arrCreditoGraduacionMalla){
	$totalCreditosGraduacionMalla = $arrCreditoGraduacionMalla['ncred']['ncred'];			
	//echo "entro";
	$totArrGradMalla = count($arrCreditoGraduacionMalla);
}else{
	$totalCreditosGraduacionMalla = 0;
	$totArrGradMalla = 0;
	
			
	
}
//INCLUSION DE CALCULO DE PROMEDIOS DE NOTAS DE HOMOLOGADAS
for($i=0;$i<$totHom;$i++){		
	if($arrHom[$i]['tipo_hom'] == 'HOMOLOGACION' or ($arrHom[$i]['tipo_hom'] == 'REVALIDACION') and ($arrHom[$i]['revalida_hom']=='SI') or $arrHom[$i]['tipo_hom'] == 'EXAMENAVANZADO'){
		$totalCreditosRegistroHom = $totalCreditosRegistroHom + $arrHom[$i]['creditohom'];		
		$totalNotaNumericaPorCreditoHom = $totalNotaNumericaPorCreditoHom +($arrHom[$i]['creditohom']*$arrHom[$i]['notanumericah']);			
	}
}

$totalCreditosMalla = $totalCreditosHomologados + $totalCreditosRevalidados + $totalCreditosAprueba + $totalCreditosGraduacionMalla+$totalCreditosExamenAvanzada;
//Restar Creditos de Materias Repetidas solo se toma la nota aprobada
//echo "</p>"."- resta materias rep".$totalRestarCredito;
$totalCreditosRegistro = $totalCreditosRegistro+ $totcre;
//Sumar Creditos de Homologación
$totalCreditosRegistro = $totalCreditosRegistro + $totalCreditosRegistroHom; 
//Restar Creditos de Materias Repetidas solo se toma la nota aprobada
//echo "</p>"."- total multiplicaión".$totalRestarMultiplicacion;
$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito+ $sumpromreprobado;
//Sumar Total NotaNumerica por Credito de Homologacion
$totalNotaNumericaPorCredito = $totalNotaNumericaPorCredito +  $totalNotaNumericaPorCreditoHom;
//Format
//echo "promedio ". $totalNotaNumericaPorCredito."gg  ".$totalCreditosRegistro;
if($totalCreditosRegistro>0) 	$promedioSobreCuatro = number_format($totalNotaNumericaPorCredito/$totalCreditosRegistro,3);
if($totalNotasAprueba>0)		$promedioSobreCien = number_format($totalNotaFinal/$totalNotasAprueba,2);
							 	$totalCreditosAprueba = number_format($totalCreditosAprueba,2);
								$totalCreditosReprueba = number_format($totalCreditosReprueba,2);
								$totalCreditosNormales = number_format(($totalCreditosReprueba + $totalCreditosAprueba),2);
if($totalCreditosAprueba>0)	$totalIRA = number_format($totalNotaSobreCuatro/$totalCreditosAprueba,3);
//Resumen
$totalCreditosHomologados = number_format($totalCreditosHomologados,2);
$totalCreditosExamenAvanzada = number_format($totalCreditosExamenAvanzada,2);
$totalCreditosRevalidados = number_format($totalCreditosRevalidados,2);
$totalCreditosExn = number_format($totalCreditosExn,2);
$totalCreditosEspeciales = number_format(($totalCreditosHomologados + $totalCreditosRevalidados + $totalCreditosExamenAvanzada),2);
$totalCreditos = number_format(($totalCreditosEspeciales + $totalCreditosNormales),2);
$totalCreditosMalla = number_format(($totalCreditosMalla),2);
//Materias retiradas
$sqlMatRetiradas = "
SELECT
	serial_alu,
	nombre_per,
	codigo_mat,
	nombre_mat,
	numerocreditos_dmat,
	fecharetiro_dmat,
	retiromateria_dmat,
	per.serial_sec 
FROM
	materiamatriculada AS mmat,
	detallemateriamatriculada dmat,
	periodo            AS per,
	materia            AS mat 
WHERE
	mmat.serial_mmat = dmat.serial_mmat 
	AND mat.serial_mat = dmat.serial_mat 
	AND mmat.serial_per = per.serial_per 
	AND (fecharetiro_dmat <>'000-00-00' 
	AND retiromateria_dmat ='SIN COSTO') 
	AND mmat.serial_sec = ".$serial_sec." 
	AND mmat.serial_alu = ".$serial_alu."
	AND dmat.serial_mat in (
        SELECT	
            mat.serial_mat
        FROM
            malla       AS maa,
            alumnomalla  AS ama,
            detallemalla AS dma,
            materia     AS mat 
        WHERE
            maa.serial_maa = ama.serial_maa 
            AND dma.serial_maa = maa.serial_maa 
            AND mat.serial_mat = dma.serial_mat 
            AND ama.serial_alu = ".$serial_alu." 
            and maa.serial_sec = ".$serial_sec." 		

	)
";
$arrMatRetiradas = $dblink->GetAll($sqlMatRetiradas);
$totMatRetiradas = count($arrMatRetiradas);

?>
<style type="text/css">
<!--
.style1 {font-size:8px}

.style2 {font-size:7px; font-weight: bold}
.style3 {font-size:6px}

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

<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <td class='style1'>
          <p  >CERTIFICACION DE MATERIAS REGISTRADAS</p></td>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <td class='style1'><span class=""><? echo $arrAlu[0]['nombre_crp'];?> </span></td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <td class='style1' align="right">&nbsp;
          <script> var now = new Date(); document.write(now.getDate() + "/" + (now.getMonth() +1) + "/" + now.getFullYear());</script></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1">
      <tr>
        <td width="15%" class='style2' align="right">C&eacute;dula #: </td>
        <td width="35%" class='style2'><span class='style2'><? echo $arrAlu[0]['codigoIdentificacion_alu'];?> </span></td>
        <td width="17%" align="right" class='style2'>Fono Casa: </td>
        <td width="33%"><span class="style2"><? echo $arrAlu[0]['telefodomic_alu'];?></span></td>
      </tr>
      <tr>
        <td align="right" class='style2'>Nombre:</td>
        <td><span class="style2"><? echo $arrAlu[0]['alumno'];?></span></td>
        <td align="right" class='style2'>Celular:</td>
        <td><span class="style2"><? echo $arrAlu[0]['celular_alu'];?></span></td>
      </tr>
      <tr>
        <td align="right" class='style2'>Direcci&oacute;n:</td>
        <td><span class="style2"><? echo $arrAlu[0]['direcciondomic_alu'];?></span></td>
        <td align="right" class='style2'>Email:</td>
        <td><span class="style2"><? echo $arrAlu[0]['mailuniv_alu']."<br>". $arrAlu[0]['mail_alu'];?></span></td>
      </tr>
      <tr>
        <td align="right" class='style2'>Malla: </td>
        <td align="right"><div align="left"><span class="style2"><? echo $arrAlu[0]['nombre_maa'];?></span></div></td>
        <td align="right" class='style2'>Ver Itinerario:</td>
        <td><a href="#" onClick="fbuscar()"><img src="../../images/buscar.png" alt="Mostrar Materias Fuera de la Malla" width="20" height="20" border="0" /></a></td>
      </tr>
    </table>
	<br>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <td colspan="9" class='style2'>CREDITOS REGISTRO MALLA</td>
        </tr>
        <tr>
          <td width="1%" class='style2'>Nº.</td>
          <td width="20%" class='style2'>Periodo</td>
          <td width="10%" class='style2'>Cod. </td>
		  <td width="25%" class='style2'>Materia </td>
		  <td width="2%" class='style2'>Nota Final </td>
		  <td width="2%" class='style2'>Nota Alfa </td>
  		  <td width="2%" class='style2'>Nota Num </td>
		  <td width="2%" class='style2'>Cre Malla </td>
  		  <td width="2%" class='style2'>Estado </td>
		  <!--<td width="7%" class='style2'>Tipo</td>-->
	    </tr>
   
		<?php  
		 $total_creditos_materia = 0;
		 $tot = 0;
		 $totreprobados = 0;
		 $num_mat=0;
		 $nota_final = 0;
		 $total_aprueba=0;
		   
		 for($i=0;$i<$totAll;$i++){	
		 					
							/*ACTA DE NOTAS*/							
							$actaNotas="select acta_nts from notas where serial_nts=".$arrMain[$i]['serial_nts'];
							$resultactaNotas=$dblink->Execute($actaNotas);
							
							$acta=$resultactaNotas->fields['acta_nts'];

			?>
		   <tr>

			 <td  align="left" class="style3"><a href="javascript:verActaNotas(<? echo "'".$acta."'"; ?>);"><? echo $i + 1; ?></a> </td>
             <td  align="left" class="style3"><?  echo $arrMain[$i]['nombre_per'];?></td>
             <td  align="left" class="style3"><? echo $arrMain[$i]['codigo_mat']; ?> </td>
		     <td align="left" class="style3"><? echo $arrMain[$i]['materia'];?> </td>		   	
		     <td align="right" class="style3"><? echo $arrMain[$i]['notatotal_nal']; ?> </td>
		     <td align="right" class="style3"><? echo $arrMain[$i]['notaalfabetica_nal'];?></td>
		     <td align="right" class="style3"><? echo $arrMain[$i]['notanumerica'];?></td>
		     <td  align="left" class="style3"><? echo $arrMain[$i]['creditomalla'];?> </td>		 
		     <td align="right" class="style3"><? echo $arrMain[$i]['estado_nal'];?></td>
			 <!--
		     <td align="right" class="style3"><? echo $arrMain[$i]['tipomateria']." <font color='red'>".$arrMain[$i]['seccion_hrr']."</font>";?></td>
			 -->
		  </tr>
				
			<?php 
			}
			?> 
		<!--MATERIA HOMOLOGADAS-->		    

		<?php 
			if($totHom>0){			
		?>
		<tr>
	   	        <td colspan="9"  align="left" class='style2'><div align="center"><strong>CREDITOS HOMOLOGACIONES</strong> </div></td>
        </tr>
		     <tr>
          <td class='style2'>Nº.</td>
          <td class='style2'>Periodo</td>
          <td class='style2'>Cod. </td>
		  <td class='style2'>Materia </td>
		  <td class='style2'>Nota Final </td>
		  <td class='style2'>Nota Alfa </td>
  		  <td class='style2'>Nota Num </td>
		  <td class='style2'>Cre Malla </td>
  		  <td class='style2'>Estado </td>
		  <!--<td class='style2'>Tipo</td>-->
	    </tr>
		<?php 
			}
		?>    
		<?php 
		$sw = $i+1;
		 for($j=0;$j<$totHom;$j++){	
		?>
	   	      
	   	 <tr>
		    <td  align="left" class="style3"><? echo $sw; ?></td>
			<? if($arrHom[$j]['tipo_hom']=='EXAMENAVANZADO' or $arrHom[$j]['tipo_hom']=='EXAMENUBICACION'){
			?>
				<td  align="left" class="style3"><?  echo $arrHom[$j]['nombre_per']."(".$arrHom[$j]['tipo_hom'].")";?></td>
			<?php
			}else{
			?>	
			<td  align="left" class="style3"><?  echo $arrHom[$j]['fecha_hom'];?></td>	
		    <?php 
			}
			?>
			
		    <td  align="left" class="style3"><? echo $arrHom[$j]['codigo_mat'];?></td>
		    <td align="left" class="style3"><? echo $arrHom[$j]['nombre_mat'];?></td>
		    <td align="right" class="style3"><? echo $arrHom[$j]['notafinal_dhom']; ?></td>
		    <td align="right" class="style3"><? echo $arrHom[$j]['notaalfabeticah'];?></td>
		    <td align="right" class="style3"><? echo $arrHom[$j]['notanumericah'];?></td>
		    <td  align="left" class="style3"><? echo $arrHom[$j]['creditohom'];?></td>
		    <td align="right" class="style3"><? echo $arrHom[$j]['estadoh'];?></td>
		    <!--<td align="right" class="style3"><? echo $arrHom[$j]['tipo'];?></td>-->
	   		 </tr>   

		<?php 
			$sw++;
		}			
		?>
		<!--MATERIA RETIRADAS-->
		<?php 
			if($totMatRetiradas>0){			
		?>

		<tr>
	        <td colspan="9"  align="left" class='style2'><div align="center" class='style2'><strong>CREDITOS RETIROS </strong></div></td>
        </tr>
		  <tr>
          <td class='style2'>Nº.</td>
          <td class='style2'>Periodo</td>
          <td class='style2'>Cod. </td>
		  <td class='style2'>Materia </td>
		  <td class='style2'>Nota Final </td>
		  <td class='style2'>Nota Alfa </td>
  		  <td class='style2'>Nota Num </td>
		  <td class='style2'>Cre Malla </td>
  		  <td class='style2'>Estado </td>
		  <!--<td class='style2'>Tipo</td>-->
	    </tr>
		<?php 
			}
		?>

				    
		<?php 
		$sw2 = $sw;
		 for($f=0;$f<$totMatRetiradas;$f++){	
		?>
	      
	    
	      <tr>
		    <td  align="left" class="style3"><? echo $sw2; ?></td>
			
		    <td  align="left" class="style3"><?  echo $arrMatRetiradas[$f]['nombre_per'];?></td>
			
		    <td  align="left" class="style3"><? echo $arrMatRetiradas[$f]['codigo_mat']; ?></td>
		    <td align="left" class="style3"><? echo $arrMatRetiradas[$f]['nombre_mat'];?></td>
		    <td align="right" class="style3"><? echo 0; ?></td>
		    <td align="right" class="style3"><? echo 0;?></td>
		    <td align="right" class="style3"><? echo 0;?></td>
		    <td  align="left" class="style3"><? echo $arrMatRetiradas[$f]['numerocreditos_dmat'];?></td>
		    <td align="right" class="style3"><? echo "ABANDONO";?></td>
		    <!-- <td align="right" class="style3"><? echo "W";?></td>-->
	    </tr>   
		<?php 
			$sw2++;
		}			
		?>
		
		<?php 
			if($totArrGradMalla>0){			
		?>

        <tr>
          <td colspan="9" class='style2' >CREDITOS ADICIONALES </td>
        </tr>
		       <tr>
          <td>Nº.</td>
          <td colspan="5" class='style2'>Requerimiento</td>
          <td class='style2'>Creditos</td>
  		  <td class='style2'>Se suma cr&eacute;dito  </td>
		  <td class='style2'>Tipo</td>
	    </tr>

		<?php 
			}
		?>
		
		<?php 
		$sw3 = $sw2;
		 for($g=0;$g<$totArrGradMalla;$g++){	
		?>
        <tr>
          <td  align="left" class='style3'><? echo $sw3; ?></td>
          <td colspan="5"  align="left" class='style3'><? echo $arrCreditoGraduacionMalla[$g]['nombre_dad'];?></td>
          <td  align="left" class='style3'><? echo $arrCreditoGraduacionMalla[$g]['ncreditos'];?></td>
          <td  align="left" class='style3'><? echo $arrCreditoGraduacionMalla[$g]['aplicacredito'];?></td>
          <td  align="left" class='style3'><? echo "Ad";?></td>
        </tr>
		<?php 
			$sw3++;
		}			
		?>

        <tr>
          <td colspan="7" class='style2' ><div align="right">PROMEDIO / 4 : </div></td>
		  <td class='style3'><?php echo $promedioSobreCuatro; ?></td>
		  <td>&nbsp;</td>
	    </tr>
		 <!-- <tr>
          <td colspan="7" ><div align="right">PROMEDIO / 100: </div></td>
		  <td ><?php  //echo $promedioSobreCien; ?> </td>
		  <td >&nbsp; </td>
		  <td >&nbsp;</td>
		  <td >&nbsp; </td>
		  </tr>	-->	 
		  <tr>
		    <td colspan="7" class='style2'><div align="right">Total Créditos Homologados:  </div></td>
		    <td  class='style3'><?php echo $totalCreditosHomologados;?></td>
		    <td >&nbsp;</td>
	    </tr>
		<tr>
		    <td colspan="7" class='style2'><div align="right">Total Créditos Examenes de Avanzada:  </div></td>
		    <td  class='style3'><?php echo $totalCreditosExamenAvanzada;?></td>
		    <td >&nbsp;</td>
	    </tr>
		
		  <tr>		  
		    <td colspan="7" class='style2'><div align="right">Total Créditos Revalidados:  </div></td>
		    <td  class='style3'><?php echo $totalCreditosRevalidados;?></td>
		    <td >&nbsp;</td>
	    </tr>
		  <tr>
          <td colspan="7" class='style2'><div align="right">Total Créditos Aprobados:  </div></td>
		  <td  class='style3'><?php echo $totalCreditosAprueba;?> </td>
		  <td >&nbsp;</td>
		  </tr>
		  <tr>
          <td colspan="7" class='style2'><div align="right">Total Créditos Reprobados:  </div></td>
		  <td  class='style3'><?php echo $totalCreditosReprueba; ?> </td>
		  <td >&nbsp;</td>
		  </tr>
		   <tr>
          <td colspan="7" class='style2'><div align="right">Indice I.R.A.:  </div></td>
		  <td  class='style3'><?php echo $totalIRA;?> </td>
		  <td >&nbsp;</td>
		  </tr>
		   <tr>
		     <td colspan="7" class='style2' ><div align="right">Total Créditos Adicionales:</div></td>
		     <td  class='style3'><?php echo $totalCreditosGraduacionMalla;?></td>
		     <td >&nbsp;</td>
        </tr>
		   <tr>
		     <td colspan="7" class='style2'><div align="right">Total CréditosS Tomados (Aprobados / Reprobados/Homologados/Revalidados) </div></td>
		     <td  class='style3'><?php echo $totalCreditos; ?></td>
		     <td >&nbsp;</td>
        </tr>
	      <tr>
          <td colspan="7" class='style2'><div align="right">Total Créditos Malla(Total): </div></td>
		  <td  class='style3'><?php echo $totalCreditosMalla; ?>/<?php echo $arrAlu[0]['creditomax_maa'];?> </td>
		  <td >&nbsp;</td>
		  </tr>
    </table>
      <div align="center"><BR>
        <BR>
        <br />
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
</table>

</body>
</html>

<script>

function verActaNotas(acta) {

if(acta!=""){
   var attributes='width=800,height=800,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no';

              omnisoftNewWindow=window.open('../../actasnotas/'+acta,'OmnisoftFile',attributes);
				   
				  // omnisoftNewWindow=window.open('E:/actasnotas/'+acta,'OmnisoftFile',attributes);
                   if (window.focus) {omnisoftNewWindow.focus()}
				   
}
else alert("No existe el acta escaneada");				   

}

</script>

<?php 
function getEq($serial_cale,$notaalfabetica_nal,$dblink){
	$sqlGet = "
	SELECT
		numerica_dcale 
	FROM 
		detallecalificacionequivalencia 
	WHERE 
	serial_cale = ".$serial_cale."
	AND alfabetica_dcale ='".$notaalfabetica_nal."'
	";	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

function getCreditoMain($serial_alu,$serial_mat,$dblink){
	$sqlGet = "
	SELECT	
		maa.serial_maa,dma.serial_dma,nombre_maa,dma.serial_mat,mat.nombre_mat,dma.numerocreditos_dma
	FROM
		malla       AS maa,
		alumnomalla  AS ama,
		detallemalla AS dma,
		materia     AS mat 
	WHERE
		maa.serial_maa = ama.serial_maa 
		AND dma.serial_maa = maa.serial_maa 
		AND mat.serial_mat = dma.serial_mat 
		AND ama.serial_alu = ".$serial_alu."
		AND mat.serial_mat = ".$serial_mat."
	";	
	
	//echo "dsfs".$sqlGet;
	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}

function getCredito($serial_alu,$serial_mat,$serial_sec,$dblink){
	$sqlGet = "
	SELECT	
		maa.serial_maa,dma.serial_dma,nombre_maa,dma.serial_mat,mat.nombre_mat,dma.numerocreditos_dma
	FROM
		malla       AS maa,
		alumnomalla  AS ama,
		detallemalla AS dma,
		materia     AS mat 
	WHERE
		maa.serial_maa = ama.serial_maa 
		AND dma.serial_maa = maa.serial_maa 
		AND mat.serial_mat = dma.serial_mat 
		AND ama.serial_alu = ".$serial_alu."
		AND mat.serial_mat = ".$serial_mat."
		AND maa.serial_sec = ".$serial_sec."
	";
	//echo $sqlGet;	
	if($arr = $dblink->GetAll($sqlGet)){		
		return $arr;
	}else{
		return false;
	}
}
function getRepMat(){
	$arr = $GLOBALS['arrMain'];		
	$tot = count($arr);
	$arrMat = array();
	$arrDef = array();
	for($i=0;$i<$tot;$i++){			
		$arrMat[$i] = $arr[$i]['serial_mat'];			
	}	
	$arrNewMat = array_unique($arrMat);	
	$arrDefMat = array_values($arrNewMat);
	$totDef = count($arrDefMat);
	for($i=0;$i<$totDef;$i++){			
		$arrDefMatCont[$arrDefMat[$i]]['nveces'] = 0;
	}		
	for($i=0;$i<$totDef;$i++){			
		$pointerA = $arrDefMat[$i];	
		for($j=0;$j<$tot;$j++){	
			$pointerB =  $arr[$j]['serial_mat'];
			$estado =  $arr[$j]['estado_nal'];
			if($pointerA == $pointerB){								
				$arrDefMatCont[$pointerA]['nveces']++;
				$arrDefMatCont[$pointerA]['materia'] = $pointerB;
				$arrDefMatCont[$pointerA]['nombremateria'] = $arr[$j]['materia']; 
				$arrDefMatCont[$pointerA]['credito'] = $arr[$j]['creditomalla']; 
				$arrDefMatCont[$pointerA]['posicion'] =  $arrDefMatCont[$pointerA]['posicion'].$j.".";
				$arrDefMatCont[$pointerA]['estado'] =  $arrDefMatCont[$pointerA]['estado'].$estado.".";
				$arrDefMatCont[$pointerA]['notanumerica'] = $arrDefMatCont[$pointerA]['notanumerica'] .$arr[$j]['notanumerica'].'*'; ;
				$arrDefMatCont[$pointerA]['devengartotal'] = 0;
				$arrDefMatCont[$pointerA]['devengarcreditos'] = 0;
				$arrDefMatCont[$pointerA]['procesar'] = '';
				$arrDefMatCont[$pointerA]['indiceok'] = '';
			}		
		}						
	}
	$arrFin = array_values($arrDefMatCont);
	$totCont = count($arrFin);
	$sw = 0;

	for($i=0;$i<$totCont;$i++){
		$swAp = 0;
		$swRep = 0;
		$posAp = array();
		$posRep = array();
		$num = strlen($arrFin[$i]['estado']);		
		$num = $num -1;
		$newCad = substr($arrFin[$i]['estado'],0,$num);
		$arrFin[$i]['estado'] = $newCad;
		$est = explode('.',$arrFin[$i]['estado']);
		$notan = explode('*',$arrFin[$i]['notanumerica']);
		$cont = count($est);
		for($j=0;$j<count($est);$j++){   
			$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] + ($arrFin[$i]['credito']*$notan[$j]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] + $arrFin[$i]['credito'];
			switch($est[$j]){
					case 'APRUEBA':
							$posAp[$swAp] = $j;
							$swAp++;				
						break;
					case 'REPRUEBA':
							$posRep[$swRep] = $j;
							$swRep++;							
						break;
				
			}
		}
			
		if($cont == $swAp){
			$arrFin[$i]['procesar'] = 'SI';
			$arrFin[$i]['indiceok'] = $posAp[0];
			$arrFin[$i]['devengartotal'] = $arrFin[$i]['devengartotal'] - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] - $arrFin[$i]['credito'];
			

		}
		if($cont == $swRep){
			$arrFin[$i]['procesar'] = 'NO';
		}
		if($swAp>=1 and $swRep>=1){
			$arrFin[$i]['procesar'] = 'SI';
			
			//echo "</p>"."................1-".$arrFin[$i]['credito']."*".$notan[$posAp[0]];
			$arrFin[$i]['devengartotal'] = 1 - ($arrFin[$i]['credito']*$notan[$posAp[0]]);
			//echo "..Devengar total .........".$arrFin[$i]['devengartotal'];
			
			$arrFin[$i]['devengarcreditos'] = $arrFin[$i]['devengarcreditos'] - $arrFin[$i]['credito'];
	//	echo "</p>"."... devengar creditos".$arrFin[$i]['devengarcreditos']. "-". $arrFin[$i]['credito']."=".$arrFin[$i]['devengarcreditos'];
		}
		
		if($arrFin[$i]['nveces'] > 1 and $arrFin[$i]['procesar'] == 'SI'){
			$arrTot[$sw]['nveces'] = $arrFin[$i]['nveces'];
			$arrTot[$sw]['materia'] = $arrFin[$i]['materia'];
			$arrTot[$sw]['nombremateria'] =  $arrFin[$i]['nombremateria'];
			$arrTot[$sw]['credito'] = $arrFin[$i]['credito'];
			$arrTot[$sw]['posicion'] = $arrFin[$i]['posicion'];
			$arrTot[$sw]['estado'] =  $arrFin[$i]['estado'];
			$arrTot[$sw]['notanumerica'] =  $arrFin[$i]['notanumerica'];
			$arrTot[$sw]['devengartotal'] =  $arrFin[$i]['devengartotal'];
			$arrTot[$sw]['devengarcreditos'] =  $arrFin[$i]['devengarcreditos'];
			$arrTot[$sw]['procesar'] =  $arrFin[$i]['procesar'];
			$arrTot[$sw]['indiceok'] =  $arrFin[$i]['indiceok'];			
			$sw++;
		}				
	}

	return $arrTot;
}

function getNotaHomologada($serial_alu,$resultado,$dblink){
	$sqlCale = "
		SELECT
			serial_cale 
		FROM
			alumno 
		WHERE
			serial_alu = ".$serial_alu."	
	";

	$arrCale = $dblink->GetAll($sqlCale);	
	$sqlGet = "
		SELECT
			serial_dcale,
			serial_cale,
			alfabetica_dcale,
			numerica_dcale,
			relativa_dcale,
			rangocalificacionini_dcale,
			rangocalificacionfin_dcale,
			estado_dcale 
		FROM
			detallecalificacionequivalencia 
		WHERE
			serial_cale = ".$arrCale[0]['serial_cale']." 
			AND estado_dcale IS NOT NULL
	";	

	$rsNotaEq=$dblink->Execute($sqlGet);
	while (!$rsNotaEq->EOF) { 
		if($rsNotaEq->fields["rangocalificacionini_dcale"]<=$resultado && $rsNotaEq->fields["rangocalificacionfin_dcale"]>=$resultado){	
			$serial_dcale = $rsNotaEq->fields[0];
			$nota_alfab = $rsNotaEq->fields[2];
	 		$nota_numerica = $rsNotaEq->fields[3];
			$nota_relativa = $rsNotaEq->fields[4];	
			$nota_fin = $rsNotaEq->fields[6];
			$nota_ini = $rsNotaEq->fields[5];
			$estado = $rsNotaEq->fields[7];
			$arr[0]['notaalfabeticah'] = $nota_alfab;
			$arr[0]['notanumericah'] =  $nota_numerica;
			$arr[0]['estadoh'] =  $estado;
		}	
		$rsNotaEq->MoveNext();	
	}
	if($arr){		
		return $arr;
	}else{
		return false;
	}
}


function getCreditosGraduacionMalla($serial_alu,$serial_sec,$dblink){

	$sqlGetOther = "
		SELECT    
			serial_ama,
			nombre_dad,    
			ncreditos, 
			case aplicacredito when 'SI' then aplicacredito else 'NO' end as aplicacredito    
		FROM
			requisitosgraduacion AS rqg,
			documentosadmision   AS dad 
		WHERE
			rqg.serial_dad = dad.serial_dad 
			and entregado_rgra = 'SI'			
			AND rqg.serial_ama IN ( SELECT
										ama.serial_ama 
									FROM
										malla        AS maa,
										alumnomalla  AS ama,
										sucursal     AS suc,
										alumno       AS alu,
										detallemalla AS dma,
										materia      AS mat 
									WHERE
										maa.serial_maa = ama.serial_maa 
										AND dma.serial_maa = maa.serial_maa 
										AND mat.serial_mat = dma.serial_mat 
										AND alu.serial_alu = ama.serial_alu 
										AND alu.serial_suc = suc.serial_suc 
										AND maa.serial_maa_p = 0
										AND ama.serial_alu = ".$serial_alu." 
										AND maa.serial_sec = ".$serial_sec."
										AND maa.serial_car = ".$GLOBALS['serial_car']."
									GROUP BY
										serial_ama 
			)  	
	";
//echo "</p>".$sqlGetOther;
	$ncredOther = 0;
	if($arrOther = $dblink->GetAll($sqlGetOther)){
		for($i=0;$i<count($arrOther);$i++){
			if($arrOther[$i]['aplicacredito']=='SI'){
				$ncredOther = $ncredOther + $arrOther[$i]['ncreditos'];
			}
		}			
		$arrOther['ncred']['ncred'] = $ncredOther;					
		return $arrOther;
		
	}else{
		//echo 'ES FALSO';
		return false;

	}

}




?>