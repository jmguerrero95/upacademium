<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$sucursal=0;
$programa=0;
$periodo=0;
$horario=0;
$empleado=0;
$serial_nts=0;
$ntotalclases=0;
$dblink='';

function omnisoftConnectDB(){
global $DBConnection,$dblink;
$dblink = NewADOConnection($DBConnection);
}

	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
  $query = $_REQUEST['query'];	
// $query = $_POST['query'];
 
 
  $query=str_replace("\"", "'",$query);
  $query=str_replace("\'", "'",$query);
  $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);

   // omnisoftProcesarAlumnosNotas($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
   omnisoftProcesarAlumnosNotas($params[0]);
	///echo  "aa".$vect[1];  
//	return;
//echo "|".$params[4]."|";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function omnisoftProcesarAlumnosNotas($serial_dmat) 
{
 global $dblink;
   $actualizacion=false;
   $aux="";	
   $sqlretiro= "select retiromateria_dmat from detallemateriamatriculada where serial_dmat".$serial_dmat;
   $rsretiro=$dblink->Execute($sqlretiro);
   if($rsretiro->fields['retiromateria_dmat']==''){  
   
   $sqlnumcreditos="select *from detallemateriamatriculada where serial_dmat=".$serial_dmat;
//echo  $sqlnumcreditos;
   $rsestudiatesRetiro=$dblink->Execute($sqlnumcreditos);
     
   
	$sqldetallecreditosxtomar="SELECT
    dcxtomar.serial_mmat,
    ccxtomar.* 
FROM
    detallecreditoportomar dcxtomar,
    cabeceracreditosportomar ccxtomar 
WHERE ccxtomar.serial_cpt=dcxtomar.serial_cpt AND serial_mmat= (SELECT
  mmat.SERIAL_MMAT 
FROM
    detallemateriamatriculada dmat,
    materiamatriculada mmat,
    detallecreditoportomar dcpt ,
    cabeceracreditosportomar ccpt 
WHERE
    dmat.serial_mmat=mmat.SERIAL_MMAT 
    AND mmat.SERIAL_MMAT=dcpt.serial_mmat 
    AND ccpt.serial_cpt=dcpt.serial_cpt 
    AND dmat.serial_dmat=".$serial_dmat.")";
	//echo "<br>".$sqldetallecreditosxtomar;
	
	
		$rscreditoportomar=$dblink->Execute($sqldetallecreditosxtomar);
		
		if($rscreditoportomar->recordCount()>0){
				
					if($rsestudiatesRetiro->fields['creditosequivalentes_dmat']==0)
					{
						$auxcreditos=$rsestudiatesRetiro->fields['numerocreditos_dmat'];
					
					}else{ $auxcreditos=$rsestudiatesRetiro->fields['creditosequivalentes_dmat'];}
					
		if($rscreditoportomar->fields['observaciones_cpt']==''){
			$retirosRealizados=" No.".$rscreditoportomar->fields['serial_mmat'].' con '.$auxcreditos."creditos";
			}else{
				$retirosRealizados=$rscreditoportomar->fields['observaciones_cpt']."|"." No.".$rscreditoportomar->fields['serial_mmat'].' con '.$auxcreditos." creditos";
				}
		
		$creditopendiente="update cabeceracreditosportomar set afavor_cpt = afavor_cpt+".$auxcreditos.", estado_cpt='ABIERTA', observaciones_cpt='".$retirosRealizados."' WHERE serial_cpt=" .$rscreditoportomar->fields['serial_cpt'];
				//echo "<br>".$creditopendiente;
					$rseditarCreditos=$dblink->Execute($creditopendiente);
					
			}
		else {
				
				
				$aux=$aux.$rsestudiatesRetiro->fields['serial_mmat'];
				
		}
		echo $aux;
		return  $aux;
		//$rsestudiatesRetiro->MoveNext();
		}
		
else{	
$aux="YA EXISTE RETIRO SIN COSTO";	
 echo $aux;
		return  $aux;
		}
}
?>