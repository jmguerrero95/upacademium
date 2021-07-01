<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FORMULARIO DE REGISTRO</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<form name="reporte" method="post" action="omnisoftPeriodosRegistradosTotal.php">
<input type="hidden" name="serial_sec" id="serial_sec"  value="<? echo $_REQUEST['serial_sec']; ?>"/>
<input type="hidden" name="sede" id="sede"  value="<? echo $_REQUEST['serial_suc']; ?>"/>
<input type="hidden" name="fecha_ini" id="fecha_ini"  value="<? echo $_REQUEST['fecha_ini']; ?>"/>
<input type="hidden" name="fecha_fin" id="fecha_fin"  value="<? echo $_REQUEST['fecha_fin']; ?>"/>

<?php
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
	    require('../../config2/config.inc.php');

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
	
	/**********************	FILTRA SEDE*******************/
		
		if(empty($_REQUEST['sede'])){	
			 $serial_suc1 = $_REQUEST['serial_suc'];
			 			
		}else{
			 $serial_suc1 = $_REQUEST['sede'];			  
			
		}
		
		$serial_sec = $_REQUEST['serial_sec'];
		$fecha_ini = $_REQUEST['fecha_ini'];
		$fecha_fin = $_REQUEST['fecha_fin'];
		
		$sedes = '';
		
		if($serial_suc1 <> 'T'){
			$sedes = " and alumno.serial_suc = ".$serial_suc1;			
		}
		
		/***********FILTRA ALUMNO******************/
		
		if(empty($_REQUEST['alumno'])){
			$serial_alu = "";
		}else{
			$serial_alu = $_REQUEST['alumno'];	
		}

		
		if($serial_alu <> 'T' and  $serial_alu <> ''){
			$serial_alu = " and alumno.serial_alu = ".$_REQUEST['alumno'];				
		}
		else
			$serial_alu = "";
				
		/***********FILTRA SEXO******************/		
		if(empty($_REQUEST['sexo'])){
			$serial_sex = "";
		}else{
			$serial_sex = $_REQUEST['sexo'];	
		}

		
		if($serial_sex <> 'T' and  $serial_sex <> ''){
			$serial_sex = " and alumno.serial_sex = ".$_REQUEST['sexo'];				
		}
		else
			$serial_sex = "";
			
			
		//VALIDAR SECCION;		
		if(empty($_REQUEST['programa'])){
			$serial_sec = "";
		}else{
			$serial_sec = $_REQUEST['programa'];	
		}

		
		if($serial_sec <> 'T' and  $serial_sec <> ''){
			$serial_sec = " and alumno.serial_sec = ".$_REQUEST['programa'];				
		}
		else
			$serial_sec = "";	

		/***************FILTRA LA FACULTAD*******************/

		if(empty($_REQUEST['facultad'])){
			$serial_fac = "";
		}else{
			$serial_fac = $_REQUEST['facultad'];	
		}


		
		if($serial_fac <> 'T' and  $serial_fac <> ''){
			$serial_fac = " and carrera.serial_fac = ".$_REQUEST['facultad'];				
		}
		else
			$serial_fac = "";
			

		/***************FILTRA LA CARRERA********************/
		
		if(empty($_REQUEST['carrera1'])){
			$serial_car = "";
		}else{
			$serial_car = $_REQUEST['carrera1'];	
		}

		
		if($serial_car <> 'T' and  $serial_car <> ''){
			$serial_car = " and malla.serial_car = ".$_REQUEST['carrera1'];				
		}
		else
			$serial_car = "";
			
	
						
		//validacion estudia si o no
		if(!empty($_REQUEST['study'])){
			switch ($_REQUEST['study']){
				case 'T': 
					$studySql = "";
					$studyActiveT = "selected='selected'"; 
					$studyActiveY = ""; 
					$studyActiveN = "";
					$studyActiveD = "";
					$egresadoHaving ="";
				break;
				case 'Y': 
					$studySql = " and (fecegresamiento_ama='0000-00-00' and fectitulacion_ama='0000-00-00')";									
					$studyActiveT = ""; 
					$studyActiveY = "selected='selected'"; 
					$studyActiveN = "";			
					$studyActiveD = "";
					$egresadoHaving ="";

				break;
				case 'N': 
					$studySql = " and (fecegresamiento_ama<>'0000-00-00' OR fectitulacion_ama<>'0000-00-00')";	
					$studyActiveT = ""; 
					$studyActiveY = ""; 
					$studyActiveN = "selected='selected'";			
					$studyActiveD = "";
					$egresadoHaving ="";
				break;
				
				case 'D': 
					$studySql = " and (fecegresamiento_ama='0000-00-00' and fectitulacion_ama='0000-00-00')";	
					$studyActiveT = ""; 
					$studyActiveY = ""; 
					$studyActiveN = "";			
					$studyActiveD = "selected='selected'";
					$egresadoHaving =" having anios > 1";
				break;
			}
		}else{
			$studySql = "";
		}		


$sql_alumnos="SELECT alumno.serial_alu
,concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre
,carrera.nombre_car as carrera
, alumno.fechaInscripcion_alu as inscripcion
, MAX(per.fecini_per) AS ultimoregistro
, MAX(periodo.fecini_per) AS ultimoregistro1
, sum(numerocreditos_dmat+creditosequivalentes_dmat) as creditos
, totalcreditos_maa as totalcreditos
, round(DATEDIFF(now(),max(per.fecini_per))/365) as anios
, codigoIdentificacion_alu as identificacion
, concat_ws(' / ',telefodomic_alu, celular_alu) as telefono
, mailuniv_alu as correo
, fecestado_hac as retiro
, concat_ws(' ',motivos_hac,descmotivos_hac) as motivo 
FROM sucursal, notasalumnos, carrera , materia
JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu 
JOIN periodo ON periodo.serial_per=materiamatriculada.serial_per
left join historicoacademico on historicoacademico.serial_alu=alumno.serial_alu
JOIN alumnomalla on alumnomalla.serial_alu=alumno.serial_alu  
JOIN malla on malla.serial_maa=alumnomalla.serial_maa and serial_maa_p=0
JOIN materiamatriculada as mat 
					ON mat.SERIAL_ALU=alumno.serial_alu 
JOIN periodo as per
					ON per.serial_per=mat.serial_per 
WHERE notasalumnos.serial_dmat=detallemateriamatriculada.serial_dmat and estado_nal='APRUEBA'
and materia.serial_mat=detallemateriamatriculada.serial_mat
and malla.serial_car= carrera.serial_car
and sucursal.serial_suc =  alumno.serial_suc
and periodo.fecini_per >='".$fecha_ini."-01-01' and periodo.fecini_per<'".$fecha_fin."-12-31'
".$sedes."
".$serial_sec."
".$serial_sex."
".$studySql."
".$serial_car."
".$serial_fac."
".$serial_alu."
and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu<>'COMUNIDAD')
group by alumno.serial_alu, malla.serial_maa".$egresadoHaving;


$rsalumnos=$dblink->Execute($sql_alumnos);

//echo '</p>'.'</p>'.$sql_alumnos;

//Asignar valores a asignar a un arreglo, como tambien los nombres de los estudiantes

$serial_alu=array();
$nombre=array();
$carrera=array();
$inscripcion=array();
$ultimoregistro=array();
$creditos=array();
$totalcreditos=array();
$anios=array();
$identificacion=array();
$telefono=array();
$motivo=array();
//$anios_retito=array();

$bandera=0;

if(!empty($rsalumnos)){
	$bandera=1; //PARA QUE FUNCIONE EL FOREACH
	//echo '</p>Salio: '.$bandera;
	while (!$rsalumnos->EOF){
		$creditos_alumnos[$rsalumnos->fields['serial_alu']][$rsalumnos->fields['serial_per']]=$rsalumnos->fields['creditos'];
		if (!in_array($rsalumnos->fields['nombre'],$nombre)){
			$nombre[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['nombre'];
			$carrera[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['carrera'];
			$inscripcion[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['inscripcion'];
			$ultimoregistro[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['ultimoregistro'];
			$creditos[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['creditos'];
			$totalcreditos[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['totalcreditos'];
			$anios[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['anios'];
			$identificacion[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['identificacion'];
			$telefono[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['telefono'];
			$motivo[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['motivo'];		
			$serial_alu[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['serial_alu'];
			//$anios_retito[$rsalumnos->fields['serial_alu']]=$rsalumnos->fields['anios_retito'];
			}
		$rsalumnos->MoveNext();
	}
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

function sede1(){
	//
	//alert(document.reporte.sede.value)
	document.reporte.action="omnisoftPeriodosRegistradosTotal.php"
	document.reporte.submit();
//	document.reporte.sede.value
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
<BR>
<BR>
<BR>
<BR>
<table width="100%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="21%" rowspan="5" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <th colspan="2"><span class="style1">CREDITOS DE ESTUDIANTES </span></th>
  </tr>
  <tr >
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="2">  Desde el año: <? echo $fecha_ini;?> Hasta el año: <? echo $fecha_fin;?> </th>
  </tr>
  <tr>
    <th width="18%" align="right">SEDE:</th>
    <th width="61%" align="left"><span class='style3'><?php echo $rsalumnos->fields['nombre_suc'] ?> <script>//document.write(getURLParam('alumno')+'<br>');
		//document.write(window.opener.document.PaginaDatos.serial_suc.options[window.opener.document.PaginaDatos.serial_suc.selectedIndex].text);
		</script></span></th>
  </tr>
  <tr>
    <th align="right">PROGRAMA:</th>
    <th align="left"><span class='style3'> <script>//document.write(getURLParam('alumno')+'<br>');
		document.write(window.opener.document.PaginaDatos.serial_sec.options[window.opener.document.PaginaDatos.serial_sec.selectedIndex].text);
		</script> </span></th>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center"><strong>Filtros </strong></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  ><table width="372" border="1">
      <tr>
     <!--   <td width="73">Matriculado</td>
        <td width="128"><select name="select">
          <option value="todos">Todos</option>
          <option value="matriculados">Matriculados</option>
          <option value="nomatriculados">No Matriculados</option>
        </select>        </td>
	---->
		
    <td width="50">Sede</td>
       
	    <td width="93">
		
        <? 			global $_FILES;
					global $gConexionDB;					
				    $sucursal= "select * from sucursal where serial_suc <> 1"; 
					$retsucursal=$gConexionDB->Execute($sucursal);
				?>
        <select name="sede"  onchange="sede1()">
          <option value="T" >Todos</option>
          <? while (!$retsucursal->EOF ){ 
			if($_POST['sede']==$retsucursal->fields['SERIAL_SUC']){?>
          <option value="<? echo $retsucursal->fields['SERIAL_SUC']; ?>" selected="selected"> <? echo $retsucursal->fields['NOMBRE_SUC']; ?> </option>
          <? } else {?>
          <option value="<? echo $retsucursal->fields['SERIAL_SUC']; ?>" > <? echo $retsucursal->fields['NOMBRE_SUC']; ?> </option>
          <? }$retsucursal->MoveNext(); 
					} ?>
        </select></td>	  
	  <td>fecha</td>
	  <td><?				
	  
				
				if(!empty($_REQUEST['programa'])){
					if($_REQUEST['sede'] !="T" and $_REQUEST['programa'] !="T"){											
						$fecha_ini= "select year(fecini_per) anio, fecini_per from periodo where serial_suc = ".$_REQUEST['sede']." and serial_sec = ".$_REQUEST['programa']."  group by year(fecini_per)";						

						
						$retFecha_ini=$gConexionDB->Execute($fecha_ini);						
					}
					
					if($_REQUEST['sede'] !="T" and $_REQUEST['programa'] =="T"){									
					$fecha_ini= "select year(fecini_per) anio, fecini_per from periodo where serial_suc = ".$_REQUEST['sede']." group by year(fecini_per)";
					
						$retFecha_ini=$gConexionDB->Execute($fecha_ini);
					}
					
					if($_REQUEST['sede'] =="T" and $_REQUEST['programa'] !="T"){									
					$fecha_ini= "select year(fecini_per) anio, fecini_per from periodo where serial_sec = ".$_REQUEST['programa']." group by year(fecini_per)";
						$retFecha_ini=$gConexionDB->Execute($fecha_ini);
						
					}
					
					if($_REQUEST['sede'] =="T" and $_REQUEST['programa'] =="T"){									
					$fecha_ini= "select year(fecini_per) anio, fecini_per from periodo group by year(fecini_per)";
					
						$retFecha_ini=$gConexionDB->Execute($fecha_ini);
					}
				
			?>
        
        <select name="fecha_ini" onchange="sede1()">		  

          <option value="T">Todos</option>
		  
          <? //if(!empty($retcarrera)){
		  while (!$retFecha_ini->EOF ){ 
		  if ($_REQUEST['fecha_ini']==$retFecha_ini->fields['anio']){?>
		            <option value="<? echo $retFecha_ini->fields['anio']; ?>" selected="selected"> <? echo $retFecha_ini->fields['anio']; ?> </option>
		<? } else { ?>
          <option value="<? echo $retFecha_ini->fields['anio']; ?>"> <? echo $retFecha_ini->fields['anio']; ?> </option>
          <? } $retFecha_ini->MoveNext(); 
			} 
			}			
			?>
        </select>      </td>
		
	  <td>fecha</td>
	  <td>
	  <?				
				
				//if(!empty($_REQUEST['facultad'])){
					if($_REQUEST['sede'] !="T" and $_REQUEST['programa'] !="T"){											
						$fecha_fin= "select year(fecini_per) anio, fecini_per from periodo where serial_suc = ".$_REQUEST['sede']." and serial_sec = ".$_REQUEST['programa']." and year(fecini_per) >= ".$_REQUEST['fecha_ini']." group by year(fecini_per)";						
						$retFecha_fin=$gConexionDB->Execute($fecha_fin);						
					}
					
					if($_REQUEST['sede'] !="T" and $_REQUEST['programa'] =="T"){									
					$fecha_fin= "select year(fecini_per) anio, fecini_per from periodo where serial_suc = ".$_REQUEST['sede']." and year(fecini_per) >= ".$_REQUEST['fecha_ini']." group by year(fecini_per)";
						$retFecha_fin=$gConexionDB->Execute($fecha_fin);
					}
					
					if($_REQUEST['sede'] =="T" and $_REQUEST['programa'] !="T"){									
					$fecha_fin= "select year(fecini_per) anio, fecini_per from periodo where serial_sec = ".$_REQUEST['programa']." and year(fecini_per) >= ".$_REQUEST['fecha_ini']." group by year(fecini_per)";
						$retFecha_fin=$gConexionDB->Execute($fecha_fin);
					}
					
					if($_REQUEST['sede'] =="T" and $_REQUEST['programa'] =="T"){									
					$retFecha_fin= "select year(fecini_per) anio, fecini_per from periodo where year(fecini_per) >= ".$_REQUEST['fecha_ini']." group by year(fecini_per)";
					
						$retFecha_fin=$gConexionDB->Execute($retFecha_fin);
					}
					

				//}
			?>
        
        <select name="fecha_fin" onchange="sede1()">		  

          <option value="T">Todos</option>
		  
          <? if(!empty($retFecha_fin)){
		  while (!$retFecha_fin->EOF ){ 
		  if ($_REQUEST['fecha_fin']==$retFecha_fin->fields['anio']){?>
		            <option value="<? echo $retFecha_fin->fields['anio']; ?>" selected="selected"> <? echo $retFecha_fin->fields['anio']; ?> </option>
		<? } else { ?>
          <option value="<? echo $retFecha_fin->fields['anio']; ?>"> <? echo $retFecha_fin->fields['anio']; ?> </option>
          <? } $retFecha_fin->MoveNext(); 
			} 
			}?>
        </select>

	  </td>
		  
		 	<!-----------CARRERA-------------------------------------------------------->
	  	  	          
        <td width="93">Carrera</td>
		<td><?				
				
				if(!empty($_REQUEST['facultad'])){
					if($_REQUEST['facultad'] !="T"){
						$carrera1= "select serial_car, nombre_car from carrera where serial_fac =  ".$_REQUEST['facultad']."  order by nombre_car";
						$retcarrera=$gConexionDB->Execute($carrera1);
					}else{
						$carrera1= "select serial_car, nombre_car from carrera order by nombre_car";
						$retcarrera=$gConexionDB->Execute($carrera1);
					}
				}
			?>
        
        <select name="carrera1" onchange="sede1()">		  

          <option value="T">Todos</option>
		  
          <? if(!empty($retcarrera)){
		  while (!$retcarrera->EOF ){ 
		  if ($_REQUEST['carrera1']==$retcarrera->fields['serial_car']){?>
		            <option value="<? echo $retcarrera->fields['serial_car']; ?>" selected="selected"> <? echo $retcarrera->fields['nombre_car']; ?> </option>
		<? } else { ?>
          <option value="<? echo $retcarrera->fields['serial_car']; ?>"> <? echo $retcarrera->fields['nombre_car']; ?> </option>
          <? } $retcarrera->MoveNext(); 
			} }?>
        </select>      </td>
 
		  
		<!------------------------SEXO-------------------------------------------->        
		<td width="93">Sexo</td>
        <td width="93">
		<select name="sexo" onchange="sede1()" id="sexo" >
            <option value="T">Todos</option>
            <?php 
			//M@PC
			$sqlSex = "
						SELECT 
							serial_sex,descripcion_sex 
						FROM 
						sexo
						"; 
			$retSex = $gConexionDB->Execute($sqlSex);
			while (!$retSex->EOF ){ 
				if($_REQUEST['sexo']==$retSex->fields['serial_sex']){?>
	            <option value="<? echo $_REQUEST['sexo'];?>" selected="selected"> <? echo $retSex->fields['descripcion_sex']; ?> </option>
			<?php 	}else {?>	
            <option value="<?php echo $retSex->fields['serial_sex']; ?>" > <? echo $retSex->fields['descripcion_sex']; ?> </option>
            <?php }
				$retSex->MoveNext(); 
			}
			?>
          </select>	</td>


	</tr>
	
<!------------------------SECCION-------------------------------------------->        	


	<tr>	
    <td> Programa</td>
	<td>
		<select name="programa" onchange="sede1()" id="programa" >
            <option value="T">Todos</option>
            <?php 
			//M@PC
			$programa = "select serial_sec, nombre_sec from seccion"; 
			$retPrograma = $gConexionDB->Execute($programa);
			while (!$retPrograma->EOF ){ 
				if($_REQUEST['programa']==$retPrograma->fields['serial_sec']){?>
	            <option value="<? echo $_REQUEST['programa'];?>" selected="selected"> <? echo $retPrograma->fields['nombre_sec']; ?> </option>
			<?php 	}else {?>	
            <option value="<?php echo $retPrograma->fields['serial_sec']; ?>" > <? echo $retPrograma->fields['nombre_sec']; ?> </option>
            <?php }
				$retPrograma->MoveNext(); 
			}
			?>
          </select>
	</td>
	<!-------------FACULTAD----------------------------------------------------->	  

		<td width="93">Facultad</td>
        <td colspan="3" width="93">
		<select name="facultad" onchange="sede1()" id="facultad" >
            <option value="T">Todos</option>
            <?php 
			//M@PC
			$facultad = "select serial_fac, nombre_fac from facultad"; 
			$retfacultad = $gConexionDB->Execute($facultad);
			while (!$retfacultad->EOF ){ 
				if($_REQUEST['facultad']==$retfacultad->fields['serial_fac']){?>
	            <option value="<? echo $_REQUEST['facultad'];?>" selected="selected"> <? echo $retfacultad->fields['nombre_fac']; ?> </option>
			<?php 	}else {?>	
            <option value="<?php echo $retfacultad->fields['serial_fac']; ?>" > <? echo $retfacultad->fields['nombre_fac']; ?> </option>
            <?php }
				$retfacultad->MoveNext(); 
			}
			?>
          </select>	    </td>

	  <!------------ESTADO------------>	    
        <td width="93">Estado</td>
        <td width="93">
		<select name="study" id="study" on onchange="sede1()">
          <option value="T"<?php echo $studyActiveT; ?>>TODOS</option>
          <option value="Y" <?php echo $studyActiveY; ?>>ESTUDIA</option>
          <option value="N"  <?php echo $studyActiveN; ?>>EGRE-GRADUADO</option>
		  <option value="D"  <?php echo $studyActiveD; ?>>DESERTADOS</option>
        </select>		
		</td>
	  
	  
		<!----------FILTRA ALUMNO----------------------------------------------------->		
		<td>Alumno:</td>
	  
      <td><?				
				global $_FILES;
				global $gConexionDB;
				

				
					$sedeAlumno="";
					$carreraAlumno="";
					$facultadAlumno="";
					
					if($_REQUEST['sede'] !="T"  and  $_REQUEST['sede'] != ''){
						$sedeAlumno=" and alumno.serial_suc = ".$_REQUEST['sede'];

					}
					
					if($_REQUEST['carrera1'] !="T" and $_REQUEST['carrera1'] != ''){
						$carreraAlumno=" and carrera.serial_car = ".$_REQUEST['carrera1'];

					}
					
					if($_REQUEST['facultad'] !="T" and $_REQUEST['facultad'] != ''){
						$facultadAlumno=" and carrera.serial_fac = ".$_REQUEST['facultad'];

					}
					
					if($_REQUEST['sexo'] !="T" and $_REQUEST['sexo'] != ''){
						$sexoAlumno=" and alumno.serial_sex = ".$_REQUEST['sexo'];

					}		
							
							$cliente= "SELECT alumnomalla.serial_alu
							, concat_ws(' ', apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) as nombre 
							, carrera.nombre_car, carrera.serial_fac
							, round(DATEDIFF(now(),max(per.fecini_per))/365) as anios							
							FROM notasalumnos, carrera , materia 
							JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat 
							JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat 
							JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu 
							JOIN periodo ON periodo.serial_per=materiamatriculada.serial_per 
							left join historicoacademico on historicoacademico.serial_alu=alumno.serial_alu 
							JOIN alumnomalla on alumnomalla.serial_alu=alumno.serial_alu 
							JOIN malla on malla.serial_maa=alumnomalla.serial_maa and serial_maa_p=0 
							JOIN materiamatriculada as mat 
							ON mat.SERIAL_ALU=alumno.serial_alu 
							JOIN periodo as per
							ON per.serial_per=mat.serial_per 
							WHERE notasalumnos.serial_dmat=detallemateriamatriculada.serial_dmat 
							and estado_nal='APRUEBA' 
							and materia.serial_mat=detallemateriamatriculada.serial_mat 
							and malla.serial_car= carrera.serial_car 							
							".$sedeAlumno.$carreraAlumno.$facultadAlumno.$sexoAlumno.$studySql."
							and periodo.fecini_per >='".$_REQUEST['fecha_ini']."-01-01' and periodo.fecini_per<'".$_REQUEST['fecha_fin']."-12-31' 
							".$serial_sec."
							and (intercambio_alu<>'INTERCAMBIO' and intercambio_alu <>'COMUNIDAD') 
							group by alumno.serial_alu".$egresadoHaving;
							
									
							//echo '</p>'.$cliente;	
						$retcliente=$gConexionDB->Execute($cliente);
					
					
			?>
        
        <select name="alumno" onchange="sede1()">		  

          <option value="T">Todos</option>
		  
          <? if(!empty($retcliente)){
		  $contAlu=0;
		  while (!$retcliente->EOF ){ 
		  $contAlu++;
		  if($_REQUEST['alumno']==$retcliente->fields['serial_alu']){?>
		            <option value="<? echo $retcliente->fields['serial_alu']; ?>" selected="selected"> <? echo $contAlu.".- ".$retcliente->fields['nombre']; ?> </option>
		<? } else { ?>
          <option value="<? echo $retcliente->fields['serial_alu']; ?>"> <? echo $contAlu.".- ".$retcliente->fields['nombre']; ?> </option>
          <? } $retcliente->MoveNext(); 
			} 
			}?>
        </select>      </td>
    
	 <!--   <td width="93"><input type="submit" name="Submit" value="Search" /></td>
        <td width="93"><input name="Clear" type="button" value="Clear" /></td>
	--->	
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><table width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">
        <tr>
          <th width="1%"  style="">Nro.</th>
   		 <td width="1%" class="textovertical"><span class="style2">Estado De Cuenta</span></td>
          <th width="5%">Alumno</th>
		  <th width="20%">Carrera </th>
		  <th width="10%">Fecha Primera Inscripción</th>
		  <th width="10%">Ultimo Periodo </th>
		  <th width="10%">Créditos Tomados</th>
		  <th width="10%">Créditos de la malla</th>
		<td width="1%" class="textovertical"><span class="style2">Anios</span></td>
		<td width="1%" class="textovertical"><span class="style2">Identificación</span></td>
		<td width="10%" class="textovertical"><span class="style2">Teléfono</span></td>
		<td width="1%" class="textovertical"><span class="style2">Motivo</span></td>						
        </tr>
        
		<? 
		$i=1;
			$cod_alumno=0;			
			$aux_alumno=0;
			$alu_tiempo_completo='';
			$j=0;
			if($bandera==1){
			//echo "alumno----- ".$alumnos."periodo----- ".$periodos;
			
			if(!empty($creditos_alumnos)){
			foreach($creditos_alumnos as $alumnos=>$periodos){
			?>
				<tr> 
				<!-- <td><span class="style2"><? echo "<a href='#' target='_blank'>".$serial_alu[$alumnos]."</a>";?></span></td>
			-->
				<td NOWRAP><span class="style2"><? echo $i;?></span></td>
				<td NOWRAP> <span class="style2"><? echo "<a href='omnisoftReporteGenAluEstadoCuenta.php?serial_alu=".$serial_alu[$alumnos]."' target='_blank'>".'$$';?></span></td>
				<td NOWRAP><span class="style2"><? echo "<a href='omnisoftEstudiantesRepTot.php?serial_alu=".$serial_alu[$alumnos]."' target='_blank'>".$nombre[$alumnos]."</a>";?></span></td>
				<td NOWRAP> <span class="style2"><? echo $carrera[$alumnos];?></span></td>
				<td NOWRAP> <span class="style2"><? echo $inscripcion[$alumnos];?></span></td>
				<td NOWRAP> <span class="style2"><? echo $ultimoregistro[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $creditos[$alumnos];?></span></td>				
				<td NOWRAP><span class="style2"><? echo $totalcreditos[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $anios[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $identificacion[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $telefono[$alumnos];?></span></td>
				<td NOWRAP><span class="style2"><? echo $motivo[$alumnos];?></span></td>				
								
				
				<?				
			
			?>
				
				</tr>
				
			<? 		 
				$i=$i+1;
			}
		}	
		}	
		 	
		?>
		
    </table>    </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
</table>
</form>
</body>
</html>