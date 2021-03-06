<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//Parametros Globales
$arrMainPrior = 
	array
	(
		0	=>	"DOCTORADO",
		1	=>	"MAGISTER",
		2	=>	"IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		3	=>	"ESPECIALISTA",
		4	=>	"DIPLOMADO",
		5	=>	"TERCER NIVEL",
		6	=>	"III DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		7	=>	"TECNOLOGO",
		8	=>	"TECNICO SUPERIOR",
		9	=>	"TITULO TEMPORAL",
		10	=>	"SIN TITULO"	
	 );
//Prioridad Tercer Nivel
$arrTercerNivel = 
	array(
		0 => "III DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		1 => "TERCER NIVEL",
		2 => "TECNOLOGO",
		3 => "TECNICO SUPERIOR"			 
	);
//Prioridad Cuarto Nivel
$arrCuartoNivel = 
	array(
		0 => "DOCTORADO",
		1 => "IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		2 => "MAGISTER",
		3 => "DIPLOMADO",			 
		4 => "ESPECIALISTA"			 
	);
$fecha_ini = "2010-01-01";
$fecha_fin = "2010-12-31";
$facultad = "";
$periodo = "and fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."' ";
$sucursal = "";
$seccion = "";
$fecha_act = date("Y")."-".date("m")."-".date("d");	
$sqlProf = "
SELECT 
	distinct (hrr.SERIAL_EPL) as serial_epl,
	'' as codigo_institucion,
	'' as provincia,
	'' as canton,
	'' as parroquia,
	documentoidentidad_epl, 
	apellido_epl,
	'' as apellido_paterno,
	'' as apellido_materno,
	nombre_epl,
	direccion_epl,
	nombre_tct,
	fechanacimiento_epl,
	email_epl,
	'' as titulo_tn,
	'' as institucion_tn,
	'' as nivel_tn,
	'' as pais_tn,
	'' as registro_tn,
	'' as titulo_cn,
	'' as institucion_cn,
	'' as nivel_cn,
	'' as pais_cn,
	'' as registro_cn,
	'' as cargo,
	'' as formacontrato,
	'' as unidadacademica,	
	'' as horaacademica,
  	DATEDIFF(DATE_FORMAT('".$fecha_fin."','%Y-%m-%d'),DATE_FORMAT(FECHAINGRESO_EPL,'%Y-%m-%d'))/365 as tiempo,
	DATEDIFF( DATE_FORMAT( '".$fecha_act."', '%Y-%m-%d' ) ,DATE_FORMAT( FECHANACIMIENTO_EPL, '%Y-%m-%d' ) ) /365 AS edad,
	FECHANACIMIENTO_EPL as fnacimiento,
	sexo_epl,
	nombre_fac,
	formacontrato_epl,	
	fingresonomina_epl,
	nombre_car,
	niv.nombre_nac,
    nna.nombre_nac as nacionalidad,
	formaContrato_epl,
	nombre_fac,
	periodo.serial_suc,
	nombre_suc,
	periodo.serial_sec

FROM
  	area,facultad,materia,periodo,empleado as epl, horario as hrr,sucursal as suc
	left join formacionacademica as foa on foa.SERIAL_EPL = epl.SERIAL_EPL and foa.mayortitulo_foa = 'SI'
	left join nivelacademico as niv on foa.serial_nac = niv.serial_nac	
	left join nacionalidad as nna on epl.serial_nac = nna.serial_nac
	left join tipocontratostrabajo as tct ON epl.serial_tct = tct.serial_tct
	left join escalafones as esc ON esc.serial_esc = epl.serial_esc
	left join cargos as car ON car.serial_car = esc.serial_car 
	left join tipoescalafones as tes ON tes.serial_tes = esc.serial_tes

WHERE
	hrr.serial_epl=epl.serial_epl
	and materia.serial_mat=hrr.serial_mat
	and area.serial_are=materia.serial_are
	and area.serial_fac=facultad.serial_fac
	and periodo.serial_per=hrr.serial_per
	and epl.serial_suc = suc.serial_suc
	and tipoEmpleado_epl = 'PROFESOR' 
	and prospecto_epl = 'NO' 
	".$facultad."
	".$periodo."
	and estado_hrr='ACTIVO'
	".$sucursal."
	".$seccion."
	and hrr.SERIAL_EPL in (259)
GROUP BY
	hrr.serial_epl
ORDER BY
	apellido_epl
";
//	and hrr.SERIAL_EPL in (259,1374)	
//echo "<br>".$sqlProf."<br>";
$rsProf = $dblink->Execute($sqlProf);
$arrMain = $dblink->GetAll($sqlProf);
$numProf = $rsProf->recordCount();
$totAll = count($arrMain);
if($arrMain){
	//DO ARRAY
	//Set Codigo Institucion
	$arrMain[$i]['codigo_institucion'] = $codigoInstitucion." => ".$arrMain[$i]['serial_epl'];
	//Set Provincia/Canton/Parroquia
	for($i=0;$i<$totAll;$i++){	
		switch($arrMain[$i]['nombre_suc']){
			case 'QUITO': 
					$arrMain[$i]['provincia'] = $infUio['provincia'];
					$arrMain[$i]['canton'] = $infUio['canton'];
					$arrMain[$i]['parroquia'] = $infUio['parroquia'];
					break;
			case 'GUAYAQUIL':
					$arrMain[$i]['provincia'] = $infGye['provincia'];
					$arrMain[$i]['canton'] = $infGye['canton'];
					$arrMain[$i]['parroquia'] = $infGye['parroquia'];
					break;
			case 'CUENCA':
					$arrMain[$i]['provincia'] = $infCue['provincia'];
					$arrMain[$i]['canton'] = $infCue['canton'];
					$arrMain[$i]['parroquia'] = $infCue['parroquia'];
					break;
		}	
	}
  	//Set Apellidos
	$apellido = explode(' ',$arrMain[$i]['apellido_epl']);
	$arrMain[$i]['apellido_paterno'] = trim($apellido[0]);
	$arrMain[$i]['apellido_materno'] = trim($apellido[1]);
	if(strlen($arrMain[$i]['apellido_materno'])<=0)
		$apellido_materno = "&nbsp;";
	//Set Formacion 
	//Tercer Nivel
	$arrForm = formacionProf($arrMain[$i]['serial_epl'],"TERCER NIVEL",$dblink);
	if($arrForm<>-1){
		$arrMain[$i]['titulo_tn'] = $arrForm['titulo'];
		$arrMain[$i]['institucion_tn'] = $arrForm['institucion'];
		$arrMain[$i]['nivel_tn'] = $arrForm['nivel'];
		$arrMain[$i]['pais_tn'] = $arrForm['pais'];
		$arrMain[$i]['registro_tn'] = $arrForm['registro'];
	}else{
		$arrMain[$i]['titulo_tn'] = "&nbsp;";
		$arrMain[$i]['institucion_tn'] = "&nbsp;";
		$arrMain[$i]['nivel_tn'] = "&nbsp;";
		$arrMain[$i]['pais_tn'] = "&nbsp;";
		$arrMain[$i]['registro_tn'] = "&nbsp;";		
	}
	//Cuarto Nivel
	$arrForm = formacionProf($arrMain[$i]['serial_epl'],"CUARTO NIVEL",$dblink);
	if($arrForm<>-1){
		$arrMain[$i]['titulo_cn'] = $arrForm['titulo'];
		$arrMain[$i]['institucion_cn'] = $arrForm['institucion'];
		$arrMain[$i]['nivel_cn'] = $arrForm['nivel'];
		$arrMain[$i]['pais_cn'] = $arrForm['pais'];
		$arrMain[$i]['registro_cn'] = $arrForm['registro'];
	}else{
		$arrMain[$i]['titulo_cn'] = "&nbsp;";
		$arrMain[$i]['institucion_cn'] = "&nbsp;";
		$arrMain[$i]['nivel_cn'] = "&nbsp;";
		$arrMain[$i]['pais_cn'] = "&nbsp;";
		$arrMain[$i]['registro_cn'] = "&nbsp;";		
	}
	//Cargo Administrativo
  	if(trim($arrMain[$i]['nombre_car'])!=""){
		$arrMain[$i]['cargo'] = $arrMain[$i]['nombre_car'];		
	}else{
		$arrMain[$i]['cargo'] = "&nbsp;";		
	}
	//Set FormaContrato
  	if(trim($arrMain[$i]['formacontrato_epl'])!=""){
		$arrMain[$i]['formacontrato'] = $arrMain[$i]['formacontrato_epl'];		
	}else{
		$arrMain[$i]['formacontrato'] = "&nbsp;";		
	}
  	//Set Unidad Academica
	if(trim($arrMain[$i]['nombre_fac'])!=""){
		$arrMain[$i]['unidadacademica'] = $arrMain[$i]['nombre_fac'];		
	}else{
		$arrMain[$i]['unidadacademica'] = "&nbsp;";		
	}
	//Set Horas Academicas
  	$hAcad = HorasAcad($arrMain[$i]['serial_epl'],$arrMain[$i]['serial_sec'],$arrMain[$i]['serial_suc'],$dblink);
	if($hAcad){			
		$arrMain[$i]['horaacademica'] = $hAcad;
	}else{
		$arrMain[$i]['horaacademica'] = "&nbsp;";
	}
	//
	//Set Email
  	if(trim($arrMain[$i]['email_epl'])!=""){
		$arrMain[$i]['email_epl'] = $arrMain[$i]['email_epl'];		
	}else{
		$arrMain[$i]['email_epl'] = "&nbsp;";		
	}
}else{
	
	echo "<br>No se puede Mostrar la lista<br>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PEI</title>
</head>

<body>
<div align="center"><strong>PEI - PROFESORES<?php echo " (".$numProf.") ";?></strong>
</div>
<form name="main" id="main">
  <table cellspacing="1" border="1" cellpadding="1">
    <tr>
      <td><em><strong>INSTITUCION</strong></em></td>
      <td><em><strong>PROVINCIA</strong></em></td>
      <td><em><strong>CANTON</strong></em></td>
      <td><em><strong>PARROQUIA</strong></em></td>
      <td><em><strong>DIRECCION</strong></em></td>
      <td><em><strong>CEDULA</strong></em></td>
      <td><em><strong>APELLIDO_PATERNO</strong></em></td>
      <td><em><strong>APELLIDO_MATERNO</strong></em></td>
      <td><em><strong>NOMBRES</strong></em></td>
      <td><em><strong>SEXO</strong></em></td>
      <td><em><strong>NACIONALIDAD</strong></em></td>
      <td><em><strong>FECHA_NACIMIENTO</strong></em></td>
      <td><em><strong>TITULO_TN</strong></em></td>
      <td><em><strong>UNIVERSIDAD_TITULO_TN</strong></em></td>
      <td><em><strong>NIVEL_TITULO_TN</strong></em></td>
      <td><em><strong>PAIS_TITULO_TN</strong></em></td>
      <td><em><strong>REGISTRO_CONESUP_TN</strong></em></td>
      <td><em><strong>TITULO_CN</strong></em></td>
      <td><em><strong>UNIVERSIDAD_TITULO_CN</strong></em></td>
      <td><em><strong>NIVEL_TITULO_CN</strong></em></td>
      <td><em><strong>PAIS_TITULO_CN</strong></em></td>
      <td><em><strong>REGISTRO_CONESUP_CN</strong></em></td>
      <td><em><strong>FECHA_INGRESO_IES</strong></em></td>
      <td><em><strong>RELACION_TRABAJO_IES</strong></em></td>
      <td><em><strong>CARGO_ADMI_O_ACADEMICO</strong></em></td>
      <td><em><strong>CATEGORIA</strong></em></td>
	  <td><em><strong>DEDICACION</strong></em></td>
	  <td><em><strong>UNIDAD_ACADEMICA</strong></em></td>
	  <td><em><strong>HORAS_ACADEM</strong></em></td>
	  <td><em><strong>HORAS_ADMINIST</strong></em></td>
	  <td><em><strong>HORAS_INVESTIG</strong></em></td>
	  <td><em><strong>HORAS_VS</strong></em></td>
	  <td><em><strong>SIST_EVAL_DOCENTE</strong></em></td>
	  <td><em><strong>PART_EVENT_ACADEMICOS</strong></em></td>
	  <td><em><strong>PERIODO_SABATICO</strong></em></td>
	  <td><em><strong>ACAD_EXTRANJERO</strong></em></td>
	  <td><em><strong>INVESTIGADOR_PERM</strong></em></td>
	  <td><em><strong>INVESTIGADOR_ESP</strong></em></td>
	  <td><em><strong>NIVEL_DOC_TN</strong></em></td>
	  <td><em><strong>NIVEL_DOC_CN</strong></em></td>
	  <td><em><strong>EMAIL</strong></em></td>	  
	
		  
    </tr>
    <?php 
	?>
	<tr>
  
	
 
  </table>
<?php
//Contar Hombres Mujeres
$totMasculino = 0;
$totFemenino = 0;
for($i=0;$i<count($arrMain);$i++){	
	if($arrMain[$i]['sexo_epl']=="MASCULINO"){
		$totMasculino++;
	}else{
		$totFemenino++;
	}
}

//Encerando contadores 
for($i=0;$i<count($arrMainPrior);$i++){
	$key = $arrMainPrior[$i];
	$totFormMasNomb[$key] = 0;	
	$totFormFemNomb[$key] = 0;	
	$totFormMasCont[$key] = 0;	
	$totFormFemCont[$key] = 0;	
}
$nombramiento = "NOMBRAMIENTO - Con relacion de dependencia";
$contrato = "CONTRATO - Sin relacion de dependencia";
$sumOtros = 0;
$swSearch = 0;
for($i=0;$i<count($arrMain);$i++){	
	//Search del nivel de formacio por prioridad
	$arr = evalFormProf($arrMain[$i]['serial_epl'],$dblink);
	if($arr){
		$arrMain[$i]['nombre_nac'] = $arr;
	}else{
		$arrMain[$i]['nombre_nac']='';
	}
	//echo "<br>".$arrMain[$i]['nombre_nac']."<br>";

	$key = $arrMain[$i]['nombre_nac'];		
	$totForm = count($arrMainPrior);
	for($j=0;$j<$totForm;$j++){		
		if($key == $arrMainPrior[$j]){			
			if($arrMain[$i]['nombre_tct']==$nombramiento or $arrMain[$i]['nombre_tct']==$contrato){
				switch($arrMain[$i]['nombre_tct']){
					case $nombramiento: 
						if($arrMain[$i]['sexo_epl']=="MASCULINO"){				
							$totFormMasNomb[$key]++; 
						}else{
							$totFormFemNomb[$key]++; 
						}
						break;	
					case $contrato: 
						if($arrMain[$i]['sexo_epl']=="MASCULINO"){				
							$totFormMasCont[$key]++; 
						}else{
							$totFormFemCont[$key]++; 
						}
						break;									
				}
				$j = $totForm;
				$swSearch = 1;				
			}	
			//echo "Comp: ".$key."====".$arrMainPrior[$j]."sumar: ".$totFormacion[$key]."<br>";		
		}	
	}
	
	if($swSearch == 0){
		$sumOtros ++; 
	}
	$swSearch = 0;
		
}


?>
<table border="0">
  <tr>   
    <td width="540"><div align="center"><strong>RESUMENES</strong></div></td>
  </tr>
   <tr>   
    <td>
	<!--BEGIN-->
	
	<table border="1">
	  
	  <tr >
		<td colspan="2" ><div align="left"><strong>Profesores por Genero</strong></div>
		  <div align="center"><?php echo "Desde: ".$fecha_ini."Hasta: ".$fecha_fin; ?></div></td>
		</tr>
	  <tr >
		<td >Hombres</td>
		<td><?php echo $totMasculino; ?></td>
	  </tr>
	  <tr >
		<td >Mujeres</td>
		<td><?php echo $totFemenino; ?></td>
	  </tr>
	  <tr >
		<td>Total</td>
		<td><?php echo $numProf; ?></td>
	  </tr>
	</table>

	<!--END-->
	</td>
  </tr>
<tr>
	
	<td>
	<!--BEGIN-->	
	<table width="526" cellpadding="0" cellspacing="0" border="1">
      <col width="203" />
      <col width="47" span="5" />
      <tr height="20">
        <td colspan="6" height="20"><div align="center"><strong>N&uacute;mero    total de profesores(as) por tipo de relaci&oacute;n laboral y nivel de formaci&oacute;n    .</strong></div></td>
      </tr>
      <tr height="20">
        <td rowspan="3" height="60" width="211">&nbsp;</td>
        <td colspan="5"><div align="center"><?php echo "Desde: ".$fecha_ini."Hasta: ".$fecha_fin; ?></div></td>
      </tr>
      <tr height="20">
        <td colspan="2" height="20"><div align="center">Nombramiento</div></td>
        <td colspan="2"><div align="center">Contrato</div></td>
        <td rowspan="2" width="76"><div align="center">TOTAL</div></td>
      </tr>
      <tr height="20">
        <td height="20" width="47"><div align="center">H</div></td>
        <td width="47"><div align="center">M</div></td>
        <td width="47"><div align="center">H</div></td>
        <td width="47"><div align="center">M</div></td>
      </tr>
      <tr height="20"><!--	0	=>	"DOCTORADO",
		1	=>	"MAGISTER",
		2	=>	"IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		3	=>	"ESPECIALISTA",
		4	=>	"DIPLOMADO",
		5	=>	"TERCER NIVEL",
		6	=>	"III DOCTOR EN JURISPRUDENCIA O FILOSOF?A",
		7	=>	"TECNOLOGO",
		8	=>	"TECNICO SUPERIOR",
		9	=>	"TITULO TEMPORAL",
		10	=>	"SIN TITULO"-->
        <td height="20">T&eacute;cnico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemNomb['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasCont['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormFemCont['TECNICO SUPERIOR'];?></td>
        <td><?php echo $totFormMasNomb['TECNICO SUPERIOR']+$totFormFemNomb['TECNICO SUPERIOR']+$totFormMasCont['TECNICO SUPERIOR']+$totFormFemCont['TECNICO SUPERIOR'];?> </td>
      </tr>
      <tr height="20">
        <td height="20">Tecnol&oacute;gico    Superior</td>
        <td><?php echo $totFormMasNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemNomb['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasCont['TECNOLOGO'];?></td>
        <td><?php echo $totFormFemCont['TECNOLOGO'];?></td>
        <td><?php echo $totFormMasNomb['TECNOLOGO']+$totFormFemNomb['TECNOLOGO']+$totFormMasCont['TECNOLOGO']+$totFormFemCont['TECNOLOGO'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Tercer Nivel</td>
        <td><?php echo $totFormMasNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemNomb['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasCont['TERCER NIVEL'];?></td>
        <td><?php echo $totFormFemCont['TERCER NIVEL'];?></td>
        <td><?php echo $totFormMasNomb['TERCER NIVEL']+$totFormFemNomb['TERCER NIVEL']+$totFormMasCont['TERCER NIVEL']+$totFormFemCont['TERCER NIVEL'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Doctor en    jurisprudencia o filosof&iacute;a</td>
        <td><?php echo $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A'];?></td>
        <td><?php echo $totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A'];?></td>
        <td><?php echo $totFormMasCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A'];?></td>
        <td><?php echo $totFormFemCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A'];?></td>
        <td><?php echo $totFormMasNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A']+$totFormFemNomb['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A']+$totFormMasCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A']+$totFormFemCont['IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Diplomado    Superior</td>
        <td><?php echo $totFormMasNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemNomb['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasCont['DIPLOMADO'];?></td>
        <td><?php echo $totFormFemCont['DIPLOMADO'];?></td>
        <td><?php echo $totFormMasNomb['DIPLOMADO']+$totFormFemNomb['DIPLOMADO']+$totFormMasCont['DIPLOMADO']+$totFormFemCont['DIPLOMADO'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Especialista</td>
        <td><?php echo $totFormMasNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemNomb['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasCont['ESPECIALISTA'];?></td>
        <td><?php echo $totFormFemCont['ESPECIALISTA'];?></td>
        <td><?php echo $totFormMasNomb['ESPECIALISTA']+$totFormFemNomb['ESPECIALISTA']+$totFormMasCont['ESPECIALISTA']+$totFormFemCont['DIPLOMADO'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Maestr&iacute;a</td>
        <td><?php echo $totFormMasNomb['MAGISTER'];?></td>
        <td><?php echo $totFormFemNomb['MAGISTER'];?></td>
        <td><?php echo $totFormMasCont['MAGISTER'];?></td>
        <td><?php echo $totFormFemCont['MAGISTER'];?></td>
        <td><?php echo $totFormMasNomb['MAGISTER']+$totFormFemNomb['MAGISTER']+$totFormMasCont['MAGISTER']+$totFormFemCont['MAGISTER'];?></td>
      </tr>
      <tr height="20">
        <td height="20">Ph.D</td>
        <td><?php echo $totFormMasNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormFemNomb['DOCTORADO'];?></td>
        <td><?php echo $totFormMasCont['DOCTORADO'];?></td>
        <td><?php echo $totFormFemCont['DOCTORADO'];?></td>
        <td><?php echo $totFormMasNomb['DOCTORADO']+$totFormFemNomb['DOCTORADO']+$totFormMasCont['DOCTORADO']+$totFormFemCont['DOCTORADO'];?></td>
      </tr>
      <tr height="20">
        <td height="20">No estan en Ninguna Categoria </td>
        <td colspan="5"><div align="center"><?php echo $sumOtros;?></div></td>
        </tr>
      <tr height="20">
        <td height="20"><strong>Total</strong></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totHomNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totHomNomb = $totHomNomb + $totFormMasNomb[$key];				
		}
		echo $totHomNomb;
		?>
		    </strong> </div></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totFemNomb = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemNomb = $totFemNomb + $totFormFemNomb[$key];				
		}
		echo $totFemNomb;
		?>
		    </strong> </div></td>
        <td>
		  <div align="center"><strong>
		    <?php
		$totMasCont = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totMasCont = $totMasCont + $totFormMasCont[$key];				
		}
		echo $totMasCont;
		?>
		    </strong> </div></td>
        <td>
		  <div align="center"><strong>
		    <?php 
		$totFemCont = 0;
		for($i=0;$i<count($arrMainPrior);$i++){
			$key = $arrMainPrior[$i];
			$totFemCont = $totFemCont + $totFormFemCont[$key];				
		}
		echo $totFemCont;
		?>
		    </strong></div></td>
        <td><div align="center"><?php echo $totHomNomb + $totFemNomb + $totMasCont + $totFemCont + $sumOtros; ?></div></td>
      </tr>
    </table>
		<!--END-->
	</td>
</tr>

</table>

</form>
</body>
</html>




<?php

/*
	Funcion que extrae todo el listado de formacion por 
	tiopo de nivel academico TERCER O CUARTO NIVEL.
*/
function formacionProf($serial_epl,$tipo,$dblink){
	switch($tipo){
	case 'TERCER NIVEL':
		$tipo = "AND nombre_nac in ('TERCER NIVEL',
									'TECNICO SUPERIOR',
									'TECNOLOGO',
									'III DOCTOR EN JURISPRUDENCIA O FILOSOF?A')";						
		break;
	case 'CUARTO NIVEL':
		$tipo = "AND nombre_nac in ('MAGISTER',
									'CUARTO NIVEL',
									'ESPECIALISTA',
									'DOCTORADO',
									'DIPLOMADO',
									'IV DOCTOR EN JURISPRUDENCIA O FILOSOF?A')";						
		break;
	
	}
	$sqlForm = "
	SELECT 
		serial_foa,
		tipoTitulo_foa, 
		descripcion_foa,  
		institucion_foa,
		fechainicio_foa, 
		fechafin_foa, 
		aniograduacion_foa, 
		nombre_nac, 
		regconesup_foa,  
		nombre_pai, 
		fecregconesup_foa, 
		formacionacademica.mayortitulo_foa, 
		formacionacademica.serial_pai, 
		formacionacademica.serial_epl, 
		formacionacademica.serial_nac 
	FROM 
		pais, formacionacademica, empleado, nivelacademico 
	WHERE 
		empleado.serial_epl = formacionacademica.serial_epl 
		AND formacionacademica.serial_nac = nivelacademico.serial_nac 
		AND formacionacademica.serial_pai = pais.serial_pai 
		AND formacionacademica.serial_epl = ".$serial_epl."
		".$tipo."
	";
	//echo "<br>".$sqlForm."<br>";
	if($arrForm = $dblink->GetAll($sqlForm)){
		if($tipo=='TERCER NIVEL'){
			$arrPrior = $arrPrior = $GLOBALS['arrTercerNivel'];
		}else{
			$arrPrior = $arrPrior = $GLOBALS['arrCuartoNivel'];
		}
		$nReg = count($arrForm);
		$nPrior = count($arrPrior);
		$sw = 0;
		if($nReg>1){
			for($i=0;$i<$nPrior;$i++){
					for($j=0;$j<$nReg;$j++){
						 //echo $arrForm[$j]['nombre_nac']." => ".$arrPrior[$i]."<br>";
						 if($arrForm[$j]['nombre_nac']==$arrPrior[$i]){
							$formPos = $j;
							$sw = 1;
							$j = $nReg;
							$i = $nPrior;
						 }					 
					}			
			}
		}else{
			return -1;
		}	
		if($sw==1){
			$arrFormMay = array(
				"titulo" => $arrForm[$formPos]['descripcion_foa'], 				
				"institucion" => $arrForm[$formPos]['institucion_foa'],
				"nivel" => $arrForm[$formPos]['nombre_nac'],
				"pais" => $arrForm[$formPos]['nombre_pai'],
				"registro" => $arrForm[$formPos]['fecregconesup_foa']	
			);
			return $arrFormMay;
		}else{
			return -1;
		}		
	}else{
		return -1;
	}
}
/* 
	Funcion que seleccion el nivel academico del profesor
	por nivel el nivel de formacion dado un arreglo de formacion
*/

function EvaluarForm($arrForm,$tipo){
	/*echo "<script>alert('".$tipo."');</script>";*/
}
/*
	Obtiene las horas academicas basadas en el calculo 
	de la documentacion
*/
function HorasAcad($serial_epl,$serial_sec,$serial_suc,$dblink){
	$sqlGet = "
		SELECT
			hrr.serial_hrr,
			dmat.serial_dmat,
			mmat.serial_mmat,
			mat.serial_mat,
			mat.nombre_mat,
			hrr.serial_epl,
			'' as tcredito,
			concat_ws(' ',apellido_epl,nombre_epl)                                          
			AS empleado,
			mmat.serial_alu,
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, 
			nombre2_alu) AS alumno,	
			nombre_per,
			nombre_suc,
			activo_mmat,
			intensivo_per,
			mmat.serial_sec
		FROM
			materiamatriculada        AS mmat,
			detallemateriamatriculada AS dmat,
			periodo                   AS per,
			materia                   AS mat,
			empleado                  AS epl,
			horario                   AS hrr,
			sucursal                  AS suc,
			alumno                    AS alu 
		WHERE
			mmat.serial_mmat = dmat.serial_mmat 
			AND mmat.serial_per = per.serial_per 
			AND dmat.serial_mat = mat.serial_mat 
			AND dmat.serial_hrr = hrr.serial_hrr 
			AND hrr.serial_epl = epl.serial_epl 
			AND mmat.serial_alu = alu.serial_alu 
			AND suc.serial_suc = mmat.serial_suc 
			AND per.serial_sec = ".$serial_sec."
			AND per.serial_suc = ".$serial_suc."
			AND epl.serial_epl = ".$serial_epl." 
			AND mmat.activo_mmat = 'SI' 
			AND fecini_per >='".$GLOBALS['fecha_ini']."' 
			AND fecini_per <='".$GLOBALS['fecha_fin']."' 
			AND estado_hrr = 'ACTIVO' 
		GROUP BY
			hrr.serial_hrr 
		ORDER BY
			tcredito	
		";
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		$sumPerReg = 0;
		$sumPerInt = 0;
		for($i=0;$i<count($arr);$i++){
			$mat = getMat($arr[$i]['serial_mat'],$arr[$i]['serial_sec'],$dblink);
			if($mat){
				$arr[$i]['tcredito'] = $mat[0]['numerocreditos_dma'];					
			}else{
				$arr[$i]['tcredito'] = 0;
			}
			//echo $arr[$i]['intensivo_per']."<br>";
			if($arr[$i]['intensivo_per']== "NO"){
				$sumPerReg = $sumPerReg + $arr[$i]['tcredito'];				
			}else{
				$sumPerInt = $sumPerInt + $arr[$i]['tcredito'];				
			}	
		}
		//echo "<pre>".print_r($arr)."<pre>";
		if($sumPerReg==0 or $sumPerInt==0){
			$div = 1;
		}else{
			$div = 2;
		}
		$prom = (($sumPerReg * 1.45)+($sumPerInt * 3.20))/$div;		
		
				
		return $prom;
	}else{
		return false;
	}	

}

/*
	Funcion que Retorna una materia con su credito 
	de la malla, ya que todas las materias de cualquier malla
	tienen la misma cantidad de creditos
*/
function getMat($serial_mat,$serial_sec,$dblink){
	$sqlGet = "
	SELECT
		DISTINCT dmat.serial_mat,
		mat.nombre_mat,
		dmat.numerocreditos_dma 
	FROM
		materia      AS mat,
		detallemalla AS dmat,
		malla        AS maa 
	WHERE
		mat.serial_mat = dmat.serial_mat AND		
		maa.serial_maa = dmat.serial_maa AND
		maa.serial_sec = ".$serial_sec." AND
		dmat.serial_mat = ".$serial_mat."
	ORDER BY
		nombre_mat	
	";	
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){
		return $arr;
	}else{
		return false;
	}
}

/*
	Funcion que evalua la formacion del profesor segun prioridad 
	sin importar el tipo TERCER O CUARTO nivel;
*/
function evalFormProf($serial_epl,$dblink){
	$sqlGet = "
		SELECT 
			serial_foa,
			empleado.serial_epl,
			nombre_nac 
		FROM 
			pais, formacionacademica, empleado, nivelacademico 
		WHERE 
			empleado.serial_epl = formacionacademica.serial_epl 
			AND formacionacademica.serial_nac = nivelacademico.serial_nac 
			AND formacionacademica.serial_pai = pais.serial_pai 
			AND formacionacademica.serial_epl = ".$serial_epl."	
	";		
	//echo "<br>".$sqlGet."<br>";
	if($arr = $dblink->GetAll($sqlGet)){						
		$arrPrior = $GLOBALS['arrMainPrior'];
		$nPrior = count($arrPrior);
		$nReg = count($arr);
		$sw = 0;
		for($i=0;$i<$nPrior ;$i++){
			for($j=0;$j<$nReg;$j++){
			 	//echo $arr[$j]['nombre_nac']." => ".$arrPrior[$i]."<br>";
				if($arr[$j]['nombre_nac'] == $arrPrior[$i]){
					$pos = $j;
					$sw = 1;
					$j = $nReg;
					$i = $nPrior;
				}					 
			}			
		}
		if($sw==1){
			return $arr[$pos]['nombre_nac'];
		}else{
			return false;
		}			
	}else{
		return false;
	}
}
?>

