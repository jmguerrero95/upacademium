<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
//Evaluacion
$TIPO_RESPUESTA_alfa="ALFABETICA";
$TIPO_RESPUESTA_num="NUMERICA";

$serial_eval=0;
$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}

function omnisoftGenerarValoresEvaluacion($serial_eva,$numpreguntas_eva,$numrespuestas_eva,$serial_trsp) {
 global $serial_eval;
 global $dblink;
 global $TIPO_RESPUESTA_alfa;
 global $TIPO_RESPUESTA_num; 
 
     $SQLCmd_generar="SELECT upper(TIPO_TRSP) as tipo 
			FROM
			tipo_respuesta
			WHERE
			SERIAL_TRSP=".$serial_trsp."
			";
// echo "<br> SQLCmd_generar: ".$SQLCmd_generar. "<br>";
  
   $resultSet=$dblink->Execute($SQLCmd_generar);
   if ($resultSet->RecordCount() >0){

		$SQLCmd_respuesta="select SERIAL_RSP, CODIGO_RSP,ORDEN_RSP from respuesta  where SERIAL_EVA=".$serial_eva." order by ORDEN_RSP DESC ";
		 //echo "<br> SQLCmd_generar: ".$SQLCmd_respuesta. "<br>";
		$rsRespuesta=$dblink->Execute($SQLCmd_respuesta);
		 //VALOR MAXIMO POR PREGUNTA			
	 	$valorMaxP=100/$numpreguntas_eva;
	 
	// echo "registros:".$rsRespuesta->RecordCount();
	 if($resultSet->fields['tipo']==$TIPO_RESPUESTA_num){  
	
			
				 //VALOR INCREMENTAL DE PREGUNTA
				 $valorIncP=$valorMaxP/($numrespuestas_eva-1);
				 $valorPregunta=$valorMaxP;
				 
				 if ($rsRespuesta->RecordCount() >0){
						while (!$rsRespuesta->EOF ) {
							 $SQLCmd_update="update respuesta set valor_rsp=".$valorPregunta." where serial_rsp=".$rsRespuesta->fields["SERIAL_RSP"];
							//  echo "<br> actualizar: ".$SQLCmd_update. "<br>";
							 $dblink->Execute($SQLCmd_update);
							 $valorPregunta=$valorPregunta-$valorIncP;
						  $rsRespuesta->MoveNext();
						}
				}	
	   }
		if($resultSet->fields['tipo']==$TIPO_RESPUESTA_alfa){
		    if ($rsRespuesta->RecordCount() >0){
						while (!$rsRespuesta->EOF ) {
							 $SQLCmd_update="update respuesta set valor_rsp=".$valorMaxP." where upper(NOMBRE_RSP)='SI' AND  serial_rsp=".$rsRespuesta->fields["SERIAL_RSP"];
							//echo "consulta:".$SQLCmd_update."<br>";
							 $dblink->Execute($SQLCmd_update);
							  $SQLCmd_updateNO="update respuesta set valor_rsp=0 where upper(NOMBRE_RSP)='NO' AND  serial_rsp=".$rsRespuesta->fields["SERIAL_RSP"];
							//echo "consulta:".$SQLCmd_update."<br>";
							 $dblink->Execute($SQLCmd_updateNO);
						//	 $valorPregunta=$valorPregunta-$valorIncP;
						  $rsRespuesta->MoveNext();
						}
				}	
		 }
 
 	}
	$serial_eval=$serial_eva;
 }  
   $query = $_POST['query'];
	
  $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

   omnisoftConnectDB();
   $params=explode('|',$query);
    // echo $params[0];
	$par0=$params[0];
	settype($par0,"integer");
	$par1=$params[1];
	settype($par1,"integer");
	$par2=$params[2];
	settype($par2,"integer");
	$par3=$params[3];
	settype($par3,"integer");

   omnisoftGenerarValoresEvaluacion($par0,$par1,$par2,$par3);
    echo $serial_eval."|";
	   
?>