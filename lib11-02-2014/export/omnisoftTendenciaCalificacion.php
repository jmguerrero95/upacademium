<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style1 {
	color: #CC0000;
	font-weight: bold;
}
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
//Gets
$serial_alu = $_GET['serial_alu'];
$serial_sec = $_GET['serial_sec'];
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$serial_crp = $_GET['serial_crp'];
//$serial_per = $_GET['serial_per'];
$serial_suc=$_GET['serial_suc'];
//$per = explode('*',$serial_per);
//$serial_per = $per[0];

//Encabezados
if($serial_suc <> "T"){
	$sqlSuc = "select nombre_suc from sucursal where serial_suc = " . $serial_suc;
	$arrSuc = $dblink->GetAll($sqlSuc);	
	$nombre_suc = $arrSuc[0]['nombre_suc'];
}else{
	$nombre_suc = "TODAS";
}
if($serial_sec <> "T"){
	$sqlSec = "select nombre_sec from seccion where serial_sec = " . $serial_sec;
	$arrSec = $dblink->GetAll($sqlSec);	
	$nombre_sec = $arrSec[0]['nombre_sec'];

}else{
	$nombre_sec = "TODAS";
}
//Validaciones
if(strlen($fecha_ini)>0 and strlen($fecha_fin)>=0){
	//$periodo = " AND per.fecini_per >= '".$fecha_ini."' AND per.fecini_per <= '".$fecha_fin."'";
	
	$periodo = "((fecini_per >='".$fecha_ini."' and fecini_per<='".$fecha_fin."') or (fecfin_per >='".$fecha_ini."' and fecfin_per<='".$fecha_fin."')) ";
	$fechas = "FECHAS: DESDE: ".$fecha_ini." HASTA: ".$fecha_fin;
	$final = $fecha_fin;
	$inicial=$fecha_ini;
}else{	//$periodo = " AND per.serial_per = ".$serial_per; 
	//$sqlPer = "select nombre_per,fecini_per,fecfin_per from periodo where serial_per = " . $serial_per;
	//$arrPer = $dblink->GetAll($sqlPer);	
	//$fechas = $arrPer[0]['nombre_per']."  =>  DESDE: ".$arrPer[0]['fecini_per']." HASTA: ".$arrPer[0]['fecfin_per'];
	//$final = $arrPer[0]['fecfin_per'];	
	//$inicial=$arrPer[0]['fecini_per'];
	$periodo="";;
}
if($serial_suc=="T"){
	$sucursal = "";		
}else{
	$sucursal = " per.serial_suc = ".$serial_suc." AND "; 
}
if($serial_sec=="T"){
	$seccion = "";		
}else{
	$seccion = "per.serial_sec = ".$serial_sec. " AND ";
}
//Carrera
if($serial_sec == 2){
	$carrera = "AND car.serial_car = ".$serial_crp;
}else{
	$carrera = "AND crp.serial_crp = ".$serial_crp;
}
if($serial_crp== 'T'){
	$carrera = "";
}

?>

<style type="text/css">

.style1 {font-size:10px}
.style2 {font-size:12px}
.style3 {font-size:14px}
/*.td ¨{font-size:14px}*/


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

<table width="90%" align="center">
  <tr bgcolor="#FFFFFF">
    <td width="29%" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="180" height="81" /></td>
    <td width="71%" bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
        <th >
          <p class=""> CURVA DE CALIFICACIONES</p></th>
      </tr>
	  <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_suc;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $nombre_sec;?> </span></th>
      </tr>
      <tr bgcolor="#FFFFFF">
        <th ><span class=""><? echo $fechas;?></span></th>
      </tr>
      
    </table></td>
  </tr>
 
          <?php  		
		$vecTendencia = tendenciaGeneral($periodo,$sucursal,$seccion);	
		$vecNotasAlfa=$vecTendencia[0];
		$vecTotal=$vecTendencia[1];
			
			if((count($vecNotasAlfa,0))>0)	
				$count = (count($vecNotasAlfa,1)/count($vecNotasAlfa,0))-1;
			
			/*$notaA=$vecTendencia[0];
			$notaB=$vecTendencia[1];
			$notaC=$vecTendencia[2];
			$notaD=$vecTendencia[3];
			$notaE=$vecTendencia[4];
			$notaF=$vecTendencia[5];*/
			
//			$notaTotal=$vecTendencia[6];
			
/*			$porcentajeA=($notaA*100)/$notaTotal;
			$porcentajeB=($notaB*100)/$notaTotal;
			$porcentajeC=($notaC*100)/$notaTotal;
			$porcentajeD=($notaD*100)/$notaTotal;
			$porcentajeE=($notaE*100)/$notaTotal;
			$porcentajeF=($notaF*100)/$notaTotal;*/
			
			
		?>

  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><br>
      <table align="center" width="100%" border="1" cellpadding="0" cellspacing="0" vspace="0">               
       	<tr>
			<td>
				<table width="100%" align="center">
					<tr>
					  <th colspan="4" class="style2">Calificaciones Encontradas Total En Todas las Facultades <? echo $notaTotal ?></th>
					</tr> 
					
				<?php
						for($x=1;$x<=$count;$x++){						
							//$notaF=$vecTendencia[5];
							$porcentaje=($vecNotasAlfa[2][$x]*100)/$vecTotal;
							$notaAlfa=$vecNotasAlfa[1][$x];							
							$totalEncontradas=$vecNotasAlfa[2][$x];
							//echo "</p> ".$porcentaje." ---- ".$notaAlfa."----------".$totalEncontradas;
				?>					
					<tr>				
					  <th class="style2"> <?php echo $notaAlfa; ?></th>
				   	  <td  align="left" class="style2"><? echo number_format($porcentaje,2)."% en ".$totalEncontradas." Calificaciones obtenidas.";?></td>
					  

					</tr>
							
				<?php							
						}
			
				
				?>
				
					
					
					  
					
					
				</table>
			</td>
			
			
		</tr>
		
		<tr>
			<td>
				<table width="100%" align="center">
					<tr>
					  <th class="style3">Calificaciones Encontradas Por Facultad</th>
					</tr> 
				<?php 
					$rsFacultad=facultades($periodo,$sucursal,$seccion);

				if($rsFacultad->recordCount()>0){
						while(!$rsFacultad->EOF){
						$facultad=$rsFacultad->fields['serial_fac'];
						$vecTendenciaFacultad = tendenciaXfacultad($periodo,$sucursal,$seccion,$facultad);
				?>
					<tr>
					  <td class="style1"> <? echo $rsFacultad->fields['nombre_fac'];?></td>
					</tr>
				<?php
						
						$notaA=$vecTendenciaFacultad[0];
						$notaB=$vecTendenciaFacultad[1];
						$notaC=$vecTendenciaFacultad[2];
						$notaD=$vecTendenciaFacultad[3];
						$notaE=$vecTendenciaFacultad[4];
						$notaF=$vecTendenciaFacultad[5];
						
						$notaTotal=$vecTendenciaFacultad[6];
						
						$porcentajeA=($notaA*100)/$notaTotal;
						$porcentajeB=($notaB*100)/$notaTotal;
						$porcentajeC=($notaC*100)/$notaTotal;
						$porcentajeD=($notaD*100)/$notaTotal;
						$porcentajeE=($notaE*100)/$notaTotal;
						$porcentajeF=($notaF*100)/$notaTotal;
				?>		
					<tr>
						<td>
							<table width="100%" align="center">
					<tr>
					  <th colspan="4" class="style2">Calificaciones Encontradas en la Facultad <? echo $notaTotal ?></th>
					</tr> 
					<tr>
					  <th class="style2"> A</th>
				   	  <td  align="left" class="style2"><? echo number_format($porcentajeA,2)."% en ".$notaA." Calificaciones obtenidas.";?></td>
					  <th class="style2"> B</th>
					  <td  align="left" class="style2"><? echo number_format($porcentajeB,2)."% en ".$notaB." Calificaciones obtenidas.";?></td>

					</tr>
					
					<tr>
					  <th class="style2"> C</th >
  					  <td  align="left" class="style2"><? echo number_format($porcentajeC,2)."% en ".$notaC." Calificaciones obtenidas.";?></td>
				      <th class="style2"> D</th>
				      <td  align="left" class="style2"><? echo number_format($porcentajeD,2)."% en ".$notaD." Calificaciones obtenidas.";?></td>
					</tr>
					
					<tr>
					   <th class="style2"> E</th>
   					   <td  align="left" class="style2"><? echo number_format($porcentajeE,2)."% en ".$notaE." Calificaciones obtenidas.";?></td>
				       <th class="style2"> F</th>
				       <td  align="left" class="style2"><? echo number_format($porcentajeF,2)."% en ".$notaF." Calificaciones obtenidas.";?></td>
					</tr>					
				</table>
						
						</td>
						

					</tr>
					
				<?php
						$rsFacultad->MoveNext();			
						}
				}
				?>	
					
					
				</table>
			</td>
        </tr>    
        
		 
      </table>
       </td>
	   
	   </tr>
</table>

</body>
</html>

<?php 

function tendenciaGeneral($periodo,$sucursal,$seccion){

require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

	$tendencia=	"SELECT	
	nal.notaalfabetica_nal,
	COUNT(SERIAL_mat) as materias 
FROM
	materiamatriculada       AS mmat,
	detallemateriamatriculada AS dmat,
	periodo                   AS per,
	notasalumnos              AS nal 
WHERE
	mmat.SERIAL_MMAT=dmat.serial_mmat AND
	mmat.SERIAL_PER= per.serial_per AND
	dmat.serial_dmat=nal.serial_dmat AND
	 per.serial_sec <> 7 and 
	".$sucursal."
	".$seccion."
	".$periodo."	
	
GROUP BY
	notaalfabetica_nal 
ORDER BY
	notaalfabetica_nal";

//echo $tendencia;
	
	//$arrMain = $dblink->GetAll($tendencia);			
	$rsTendencia = $dblink->Execute($tendencia);
	//$bandera=0;
	if($rsTendencia->recordCount()>0){
	$notaA=0;
	$notaB=0;
	$notaC=0;
	$notaD=0;
	$notaE=0;
	$notaF=0;
	$j=0;
		while(!$rsTendencia->EOF){
			$j++;		
			//echo $rsTendencia->fields['notaalfabetica_nal'];
			$notaAlfa=$rsTendencia->fields['notaalfabetica_nal'];
			$total=$rsTendencia->fields['materias'];
			

			$matrizNotas[1][$j]=$notaAlfa;
			$matrizNotas[2][$j]=$total;
			
			/*if($nota == 'A' or $nota == 'A+' or $nota == 'A-'){				
				$notaA = $notaA+$rsTendencia->fields['materias'];					

			}	
			
			if($nota == 'B' or $nota == 'B+' or $nota == 'B-'){				
				$notaB = $notaB+$rsTendencia->fields['materias'];				
			}	

			if($nota == 'C' or $nota == 'C+' or $nota == 'C-'){				
				$notaC = $notaC+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'D' or $nota == 'D+' or $nota == 'D-'){				
				$notaD = $notaD+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'E' or $nota == 'E+' or $nota == 'E-'){				
				$notaE = $notaE+$rsTendencia->fields['materias'];				
			}			
			if($nota == 'F' or $nota == 'F+' or $nota == 'F-'){				
				$notaF = $notaF+$rsTendencia->fields['materias'];				
			}*/				
			
			
		$rsTendencia->MoveNext();			
		}
	}
	
	
	$totalNotas = 1492;
	
	
	$vector = array($matrizNotas,$totalNotas);		
	//echo $vector[0];
	return $vector; 						
}



function tendenciaXfacultad($periodo,$sucursal,$seccion,$facultad){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

$tendencia="SELECT
					nal.notaalfabetica_nal,
					count(mat.SERIAL_mat) materias,nombre_mat,ar.serial_are,nombre_are,fac.serial_fac,nombre_fac
				FROM
					materiamatriculada        AS mmat,
					detallemateriamatriculada AS dmat,
					periodo                   AS per,
					notasalumnos              AS nal
					, materia as mat
					, area as ar
					,facultad as fac
				WHERE
					mmat.SERIAL_MMAT=dmat.serial_mmat AND
					mmat.SERIAL_PER= per.serial_per AND
					dmat.serial_dmat=nal.serial_dmat AND
					dmat.serial_mat=mat.serial_mat and 
					mat.serial_are=ar.serial_are and
					ar.serial_fac=fac.serial_fac and 
					".$sucursal."
					".$seccion."
					".$periodo."
					and fac.serial_fac = ".$facultad."
					and per.serial_sec <> 7 				
				group by fac.serial_fac,notaalfabetica_nal
				ORDER BY notaalfabetica_nal";
	//	echo $tendencia;			
	$rsTendencia = $dblink->Execute($tendencia);
	
	$notaA=0;
	$notaB=0;
	$notaC=0;
	$notaD=0;
	$notaE=0;
	$notaF=0;
	
	if($rsTendencia->recordCount()>0){
		while(!$rsTendencia->EOF){
			$nota=$rsTendencia->fields['notaalfabetica_nal'];
			
			if($nota == 'A' or $nota == 'A+' or $nota == 'A-'){				
				$notaA = $notaA+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'B' or $nota == 'B+' or $nota == 'B-'){				
				$notaB = $notaB+$rsTendencia->fields['materias'];				
			}	

			if($nota == 'C' or $nota == 'C+' or $nota == 'C-'){				
				$notaC = $notaC+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'D' or $nota == 'D+' or $nota == 'D-'){				
				$notaD = $notaD+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'E' or $nota == 'E+' or $nota == 'E-'){				
				$notaE = $notaE+$rsTendencia->fields['materias'];				
			}	
			
			if($nota == 'F' or $nota == 'F+' or $nota == 'F-'){				
				$notaF = $notaF+$rsTendencia->fields['materias'];				
			}				
		
		$rsTendencia->MoveNext();			
		}
	}
	$totalNotas = $notaA + $notaB + $notaC + $notaD + $notaE + $notaF;	
	$vector = array($notaA,$notaB,$notaC,$notaD,$notaE,$notaF,$totalNotas);		
	//echo $vector[0];
	return $vector;
					
}

function facultades($periodo,$sucursal,$seccion){
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
	$facultad="SELECT
					fac.serial_fac,nombre_fac
				FROM
					materiamatriculada        AS mmat,
					detallemateriamatriculada AS dmat,
					periodo                   AS per,
					notasalumnos              AS nal
					, materia as mat
					, area as ar
					,facultad as fac
				WHERE
					mmat.SERIAL_MMAT=dmat.serial_mmat AND
					mmat.SERIAL_PER= per.serial_per AND
					dmat.serial_dmat=nal.serial_dmat AND
					dmat.serial_mat=mat.serial_mat and 
					mat.serial_are=ar.serial_are and
					ar.serial_fac=fac.serial_fac and 
					per.serial_sec <> 7 and 
					".$sucursal."
					".$seccion."
					".$periodo." 
					
				group by fac.serial_fac
				ORDER BY fac.serial_fac";
			
			//echo $facultad;
			$rsFacultad = $dblink->Execute($facultad);
	
	return 	$rsFacultad;


}

?>