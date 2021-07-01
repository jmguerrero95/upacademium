<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
include('omnisoftSecuenciaDocumentos.php');
function omnisoftConnectDB() {
	global $DBConnection;
	$dblink = NewADOConnection($DBConnection);	
	return $dblink;
}

function omnisoftExecuteUpdate(){
   //global $serial_tic;
	$query = $_POST['query']; ///defecto
	//$query = $_GET['query'];
	
	//echo $query."|0|";

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   $dblink=omnisoftConnectDB();
   $params=explode('|',$query);
  
  $serial_cpt=($params[0]=='')?0:$params[0];

  //echo "</p>".$serial_cpt;
  
   	if($serial_cpt>0){		
	
		$comprobante="select dfa.valor_aal, dcpt.creditos_dcpt,cpt.serial_cpt,dcpt.serial_com
					from cabeceracreditosportomar as cpt, detallecreditoportomar as dcpt, aranceles as ara, detallefactura as dfa
					, cabecerafactura as caf, alumno as alu 
					where cpt.serial_ara =  ara.serial_ara 
					and cpt.serial_cpt = dcpt.serial_cpt
					and cpt.serial_dfa = dfa.serial_dfa 
					and dfa.serial_caf = caf.serial_caf 
					and caf.serial_alu = alu.serial_alu
					and dcpt.serial_com = 0
					and cpt.serial_cpt = ".$params[0];
					
		$retcomprobante=$dblink->Execute($comprobante);
		
		
		if($retcomprobante->RecordCount()>0){
					while(!$retcomprobante->EOF ){
					
					echo $retcomprobante->fields['creditos_dcpt']."|0|"; 
					
					$retcomprobante->MoveNext();
					}
		}
					 
					 
		/*CONSULTA LOS CREDITOS A FAVOR QUE TIENE EL ESTUDIANTE*/		
		//$CreditosAfavor = "select afavor_cpt from cabeceracreditosportomar where serial_cpt = ".$params[0];
		//$retCreditosAfavor=$dblink->Execute($CreditosAfavor);
//echo  "</p>".$CreditosAfavor;	
		/*CONSULTA LOS CREDITOS QUE TOMO EL ESTUDIANTE*/
		//$CreditosPorTomar="select sum(creditos_dcpt) as totalCreditos from detallecreditoportomar where serial_cpt = ".$params[0]." group by serial_cpt";
		//$retCreditosPorTomar=$dblink->Execute($CreditosPorTomar);	
		
		
        /*$prueba="update cabeceracreditosportomar set afavor_cpt = 30 where serial_cpt = 3";
		$retprueba=$dblink->Execute($prueba);	*/
		
//echo  "</p>".$CreditosPorTomar;

		/*if($retCreditosPorTomar->fields['totalCreditos'] == $retCreditosAfavor->fields['afavor_cpt']){
			$SQLCmd="update cabeceracreditosportomar set estado_cpt = 'CERRADA' where serial_cpt = ".$params[0];		
		    
			echo  "</p>".$SQLCmd;			
			$dblink->Execute($SQLCmd);			
		}	
		else{
			if($retCreditosPorTomar->fields['totalCreditos'] > $retCreditosAfavor->fields['afavor_cpt'])
				echo "El No de Creditos es mayor a los que tiene a Favor el Estudiante"."|0|";
		}*/		
		
	} 

}

	

  
omnisoftExecuteUpdate();
//return;

?>
