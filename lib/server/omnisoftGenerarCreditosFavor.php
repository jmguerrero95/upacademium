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
function omnisoftProcesarAlumnosNotas($serial_hrr) 
{
 global $dblink;
   $actualizacion=false;
   $contmatricula="SELECT
    mmat.SERIAL_MMAT,CONCAT_WS(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS ALUMNO
FROM
    ALUMNO ALU,
    materiamatriculada mmat,
    detallemateriamatriculada dmat,
    horario hrr

WHERE
    alu.serial_alu=mmat.SERIAL_ALU 
    AND mmat.SERIAL_MMAT=dmat.serial_mmat 
    AND dmat.serial_hrr =hrr.SERIAL_HRR 
    AND hrr.SERIAL_HRR=".$serial_hrr." group by serial_mmat";
	
$rsmatricula= $dblink->GetAll($contmatricula);
$totAll = count($rsmatricula);
//echo "jffhjj".$contmatricula;
 //  $rsmatricula=$dblink->Execute($contmatricula);	
   
$concabeceracxt="SELECT
  distinct(dcpt.serial_mmat)
FROM
    detallecreditoportomar dcpt,
    cabeceracreditosportomar ccpt 
WHERE
    dcpt.serial_cpt=ccpt.serial_cpt 
    AND dcpt.serial_mmat IN (   SELECT
                                    mmat.SERIAL_MMAT 
                                FROM
                                    ALUMNO ALU,
                                    materiamatriculada mmat,
                                    detallemateriamatriculada dmat,
                                    horario hrr 
                                WHERE
                                    alu.serial_alu=mmat.SERIAL_ALU 
                                    AND mmat.SERIAL_MMAT=dmat.serial_mmat 
                                    AND dmat.serial_hrr =hrr.SERIAL_HRR 
                                    AND hrr.SERIAL_HRR=".$serial_hrr."
    )";
	

//echo $concabeceracxt;	
$rscontcreditoxt= $dblink->GetAll($concabeceracxt);

$totAll1 = count($rscontcreditoxt);
//echo "1:".$totAll1."2.. ".$totAll1;
if($totAll==$totAll1){
	
	//echo "Ingreso";	
	$Estudiantes="SELECT
    dmat.serial_dmat, numerocreditos_dmat,
    dmat.serial_mmat ,dmat.retiromateria_dmat
FROM
    horario hrr,
    detallemateriamatriculada dmat 
WHERE
    hrr.serial_hrr=dmat.serial_hrr 
    AND dmat.serial_hrr=".$serial_hrr;
	
  	//echo $Estudiantes;
	$rsestudiatesRetiro=$dblink->Execute($Estudiantes);	
		//$i=0;
	while(!$rsestudiatesRetiro->EOF)
	{
		$sqldetallecreditosxtomar="SELECT
    dcxtomar.serial_mmat, dcxtomar.serial_cpt,
    ccxtomar.* 
FROM
    detallecreditoportomar dcxtomar,
    cabeceracreditosportomar ccxtomar 
WHERE ccxtomar.serial_cpt=dcxtomar.serial_cpt AND serial_mmat=".$rsestudiatesRetiro->fields['serial_mmat'];
	//echo "<br>".$sqldetallecreditosxtomar;
	$rscreditoportomar=$dblink->Execute($sqldetallecreditosxtomar);
		
					if($rsestudiatesRetiro->fields['creditosequivalentes_dmat']==0){
						$auxcreditos=$rsestudiatesRetiro->fields['numerocreditos_dmat'];
						}
					else {$auxcreditos=$rsestudiatesRetiro->fields['creditosequivalentes_dmat'];}
			
			if($rscreditoportomar->fields['observaciones_cpt']==''){
			$retirosRealizados=" No.".$rscreditoportomar->fields['serial_mmat'].' con '.$auxcreditos." creditos ";
			}else{
				$retirosRealizados=$rscreditoportomar->fields['observaciones_cpt']."|"." No.".$rscreditoportomar->fields['serial_mmat'].' con '.$auxcreditos." creditos";
				}
					
					
					
					if($rsestudiatesRetiro->fields['retiromateria_dmat']==''){
					
					$creditopendiente="update cabeceracreditosportomar ,detallemateriamatriculada dmat set afavor_cpt = afavor_cpt+".$auxcreditos.", estado_cpt='ABIERTA',observaciones_cpt='".$retirosRealizados."', dmat.retiromateria_dmat='SIN COSTO',dmat.fecharetiro_dmat=(select curdate()) WHERE serial_cpt=" .$rscreditoportomar->fields['serial_cpt']." and dmat.serial_dmat=".$rsestudiatesRetiro->fields['serial_dmat'];
					//echo "<br>".$creditopendiente;
					$rseditarCreditos=$dblink->Execute($creditopendiente);
					}
					
				
	$rsestudiatesRetiro->MoveNext();
		}
	}	

else {
		$aux="";	
	for($i=0;$i<$totAll;$i++)
	{
	//echo "fdsfss".$rsmatricula[$i]['SERIAL_MMAT'];
	$num=0;
	for($j=0;$j<$totAll;$j++){
		if($rsmatricula[$i]['SERIAL_MMAT']==$rscontcreditoxt[$j]['serial_mmat']){
		$num=1;
		}
		
		}	
		
		if($num==0)$aux=$aux.$rsmatricula[$i]['SERIAL_MMAT']." ".$rsmatricula[$i]['ALUMNO']." | ";	
	}
	echo $aux;
	return  $aux;
}

 

	
 
}

?>