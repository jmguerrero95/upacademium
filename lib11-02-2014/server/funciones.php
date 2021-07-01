<?php

function SI($condicion,$verdadero,$falso){
return($condicion?$verdadero:$falso);
}

function REDONDEAR($numero,$decimales=0){
return(round($numero,$decimales));
}

function construirFormula($pformula,$serial_per,$dblink) {
    $formula=strtoupper($pformula);

	$sql="SELECT abrevia_acal FROM aportescalificacion where tipo_acal<>'DIGITADO'";

    /*$sql="select codigo_prc from trimestre,parcial where parcial.serial_tri=trimestre.serial_tri and tipo_prc<>'DIGITADO' and serial_per=".$serial_per.' order by orden_prc';*/
    echo "Formula general=".$formula."=>".$sql."<br>";
    $rsParcial=$dblink->Execute($sql);

    while (!$rsParcial->EOF ) {
           $codigo_prc=$rsParcial->fields[0];
    //       echo "codigo_prc=".$codigo_prc."<br>";
    	   if (stristr($formula,$codigo_prc)!=FALSE) {
               $sql="select formula_prc from trimestre,parcial where parcial.serial_tri=trimestre.serial_tri and codigo_prc='".$codigo_prc."' and serial_per=".$serial_per;

               $rsParcialFormula=$dblink->Execute($sql);
               $formula_prc="(".$rsParcialFormula->fields[0].")";
    //            echo $sql."formula_prc=".$formula_prc."<br>";

              // echo "formula=".$formula_prc."<br>";
               $formula=str_replace($codigo_prc,$formula_prc,$formula);
      //         echo "formula=".$formula."<br>";
          }
    $rsParcial->MoveNext();
    }


  return $formula;

}

function evaluarFormula($serial_alu,$serial_mat,$serial_matpro,$pformula,$serial_per,$dblink){
$sql1='select codigo_prc from trimestre,parcial where parcial.serial_tri=trimestre.serial_tri and serial_per='.$serial_per.' order by orden_prc';
$rsParcialAux=$dblink->Execute($sql1);
//echo $sql1 .' <br>';
		 if ($pformula=='')
             return 0;
         if (is_numeric($pformula))
               return $pformula;


        $formula=construirFormula($pformula,$serial_per,$dblink);
        //echo $formula;

    	while (!$rsParcialAux->EOF ) {

            $codigo_prc=$rsParcialAux->fields[0];

//		echo "Codigo=".$rsParcialAux->fields[0]."formula=$formula<br>";
			if (stristr($formula,$codigo_prc)!=FALSE) {

			$sql='select serial_prccri,nota_prccri,criterio.serial_cri from trimestre,parcial,criterio,alumno,materia_alumno,materia_nivel,materia_profesor,nota_trimestre,nota_parcial,parcial_criterio where criterio.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and parcial_criterio.serial_nprc=nota_parcial.serial_nprc and  nota_parcial.serial_prc=parcial.serial_prc and parcial_criterio.serial_cri=criterio.serial_cri and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu and materia_alumno.serial_matpro='.$serial_matpro.' and nota_trimestre.serial_tri=trimestre.serial_tri and trimestre.serial_tri= parcial.serial_tri and alumno.serial_alu='.$serial_alu.' and nota_parcial.serial_prc=parcial.serial_prc  and materia_nivel.serial_mat='.$serial_mat. " and parcial.codigo_prc='".$codigo_prc."'";
//			echo $sql."<br>";
		     $rsNotaParcial=$dblink->Execute($sql);

			 if ($rsNotaParcial && $rsNotaParcial->RecordCount()>0) {
                $formula=str_replace($codigo_prc,$rsNotaParcial->fields[1],$formula);
	//			echo $formula ."<br>";
			 }
			 else  {
                $formula=str_replace($codigo_prc,"0",$formula);
			//	return 0;

			 }
			 }
             $rsParcialAux->MoveNext();

    }
//	 echo $formula.'<br>';
	 $resultado=eval("return $formula;");
	 $resultado=round($resultado,0);
	 //echo $resultado;
	return $resultado;
}


function evaluarNotasTerminales($serial_alu,$global_mat,$serial_prc,$dblink){



			$sql='select sum(nota_prccri*ponderacion_mat) as nota,sum(ponderacion_mat) as ponderacion from trimestre,parcial,criterio,materia,alumno,materia_alumno,materia_nivel,materia_profesor,nota_trimestre,nota_parcial,parcial_criterio where criterio.serial_matniv=materia_profesor.serial_matniv and materia_nivel.serial_matniv=materia_profesor.serial_matniv and materia_alumno.serial_matpro=materia_profesor.serial_matpro and parcial_criterio.serial_nprc=nota_parcial.serial_nprc and  nota_parcial.serial_prc=parcial.serial_prc and parcial_criterio.serial_cri=criterio.serial_cri and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and alumno.serial_alu=materia_alumno.serial_alu and materia_profesor.serial_matniv=materia_nivel.serial_matniv and nota_trimestre.serial_tri=trimestre.serial_tri and trimestre.serial_tri= parcial.serial_tri and alumno.serial_alu='.$serial_alu.' and nota_parcial.serial_prc=parcial.serial_prc  and materia_nivel.serial_mat=materia.serial_mat and materia.global_mat='.$global_mat. " and parcial.serial_prc='".$serial_prc."' and nota_prccri>0";
//			echo $sql."<br>";
  		        $rsNotaParcial=$dblink->Execute($sql);

	 $resultado=($rsNotaParcial->fields[1]<1)?0:round($rsNotaParcial->fields[0],0);
	 //echo $resultado;
	return $resultado;
}

function esMateriaConsolidada($serial_mat) {
global $dblink;

 $sqlCommand="select serial_mat from materia where global_mat=".$serial_mat;
// echo $sqlCommand."<br>";
 $rsMat=$dblink->Execute($sqlCommand);

 $resultado=(!$rsMat || $rsMat->RecordCount() <=0)? false:true;
 return $resultado;


}

function actualizarNotas($serial_prccri,$nota) {
  global $dblink;
 $sqlCommand="update parcial_criterio set nota_prccri=".$nota." where serial_prccri=".$serial_prccri ;
// echo $sqlCommand."<br>";
 $dblink->Execute($sqlCommand);

}


function omnisoftVerificarNotasParciales($serial_per,$serial_pro,$serial_matpro,$serial_tri,$serial_prc,$serial_alu) {

  global $dblink;

   $actualizacion=false;


   $SQLCmd="select serial_matniv,serial_par from materia_profesor where serial_matpro=".$serial_matpro;
   //echo $SQLCmd. "<br>";;
   $rsMateriaProfesor=$dblink->Execute($SQLCmd);

   if (!$rsMateriaProfesor || $rsMateriaProfesor->RecordCount()<=0) {
    echo "Error No existe la materia para el profesor seleccionado!|0";
    return false;
   }

   $serial_matniv=$rsMateriaProfesor->fields[0];
   $serial_par=$rsMateriaProfesor->fields[1];

         $SQLVerifica="select serial_matalu from materia_alumno where serial_alu=".$serial_alu." and serial_matpro=".$serial_matpro;
        //echo $SQLVerifica. "<br>";

         $rsVerMateriaAlumno=$dblink->Execute($SQLVerifica);
         if (!$rsVerMateriaAlumno || $rsVerMateriaAlumno->RecordCount()<=0) {
             $SQLInsert="insert into materia_alumno (serial_matalu, serial_alu, serial_matpro, total_matalu, nmin_matalu, aproba_matalu, disc_matalu, supletorio_matalu, nfinal_matalu, examenGrado_matalu, finjust_matalu, fjust_matalu, atraso_matalu) values (0,".$rsParaleloAlumno->fields[0].",".$serial_matpro.",0,0,'NO',0,0,0,0,0,0,0)";
              //echo $SQLCmdInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
     $SQLCmd="select serial_matalu from materia_alumno where serial_matpro=".$serial_matpro. " and serial_alu=".$serial_alu;
     //echo $SQLCmd. "<br>";;

     $rsMateriaAlumno=$dblink->Execute($SQLCmd);
    // while (!$rsMateriaAlumno->EOF) {
         $SQLVerifica="select serial_ntri from materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matalu=".$rsMateriaAlumno->fields[0]." and serial_tri=".$serial_tri;
        //echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_trimestre (serial_ntri, serial_matalu, serial_tri, nota_ntri, base_ntri, porcentaje_ntri, observacion_ntri, disc_ntri, ptrabajado_ntri, pasistido_ntri, finjust_ntri, fjust_ntri, atraso_ntri) values (0,".$rsMateriaAlumno->fields[0].",".$serial_tri.",0,0,0,'',0,0,0,0,0,0)";
              //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
    //  $rsMateriaAlumno->MoveNext();
    // }


     $SQLCmd="select serial_ntri,serial_prc from parcial,materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=parcial.serial_tri and parcial.serial_prc=".$serial_prc." and materia_alumno.serial_alu=".$serial_alu;
      //echo $SQLCmd. "<br>";;

     $rsNotaTrimestre=$dblink->Execute($SQLCmd);
     while (!$rsNotaTrimestre->EOF) {
         $SQLVerifica="select serial_nprc from nota_parcial where serial_prc=".$serial_prc." and serial_ntri=".$rsNotaTrimestre->fields[0];
       // echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_parcial (serial_nprc, serial_ntri, serial_prc, nota_nprc, base_nprc, porcentaje_nprc, observacion_nprc, disc_nprc, aclase_nprc, disciplinaInspector_nprc, disciplinaFinal_nprc, finjust_nprc, fjust_nprc, atraso_nprc) values (0,".$rsNotaTrimestre->fields[0].",".$serial_prc.",0,0,0,'',0,0,0,0,0,0,0)";
              //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaTrimestre->MoveNext();
     }


     $SQLCmd="select serial_nprc,serial_cri from criterio,materia_alumno,materia_profesor,nota_trimestre,nota_parcial where criterio.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=".$serial_tri." and materia_alumno.serial_alu=".$serial_alu;
      //echo $SQLCmd. "<br>";;

     $rsNotaParcial=$dblink->Execute($SQLCmd);
     while (!$rsNotaParcial->EOF) {
         $SQLVerifica="select serial_prccri from parcial_criterio where serial_nprc=".$rsNotaParcial->fields[0]." and serial_cri=".$rsNotaParcial->fields[1];
        //echo $SQLVerifica. "<br>";

         $rsVerNotaParcial=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaParcial || $rsVerNotaParcial->RecordCount()<=0) {
             $SQLInsert="insert into parcial_criterio (serial_prccri, serial_nprc, serial_cri, numero_prccri, nota_prccri, base_prccri, nprueba_prccri) values (0,".$rsNotaParcial->fields[0].",".$rsNotaParcial->fields[1].",0,0,0,0)";
//              echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaParcial->MoveNext();
     }


   // echo $serial_per."|";
}

/*
	Funcion que muestra o no un estudiante 
	basado en un numero de registro
*/
function verificarPagoCreditos($registro,$dblink)
{

	$serial_mmat = $registro;	
	
	//echo "<br>Registro#: ".$serial_mmat."<br>";
	
	$intercambio="SELECT
						* 
					FROM
						alumno as alu, materiamatriculada as mmat 
					WHERE alu.serial_alu=mmat.serial_alu and
						intercambio_alu LIKE 'VIENE%' and
						mmat.SERIAL_MMAT=".$serial_mmat;					
						$rsIntercambio = $dblink->Execute($intercambio);		
						$numI = $rsIntercambio->recordCount();
						if($numI>0){						
							$arrLista[0]['show'] = "SI";
							//$arrLista[0]['msg'] = $msg;
							return $arrLista;
						}
	
	
		//Validacion Materia Toelf
	$sqlToefl = "
		SELECT
			mmat.serial_mmat,
			dmat.serial_mat,
			serial_alu
					
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			and mmat.serial_mmat = ".$serial_mmat."

	";
	//echo "<br>TOEFL: ".$sqlToefl."<br>";
	$rsToefl = $dblink->Execute($sqlToefl);
	$matToefl = 0;
	while(!$rsToefl->EOF){
		if($rsToefl->fields['serial_mat'] == 218){
			$matToefl = 1;	
		}		
		$rsToefl->MoveNext();
	}
	if($matToefl==1){
		$msg = "Es la materia TOEFL asi que debe salir obligatoriamente";
		$arrLista[0]['show'] = "SI";
		$arrLista[0]['msg'] = $msg;
		return $arrLista;		
	}

	//Buscar Creditos Tomados con el serial de materia matriculada	
	$sqlCred = "
		SELECT
			mmat.serial_mmat,
			serial_alu,
			sum(numerocreditos_dmat+creditosequivalentes_dmat) as totalcreditos 
		FROM
			materiamatriculada as mmat,
			detallemateriamatriculada as dmat
		WHERE  
			mmat.serial_mmat = dmat.serial_mmat
			AND (fecharetiro_dmat ='000-00-00' 
			AND retiromateria_dmat <>'SIN COSTO')     
			and mmat.serial_mmat = ".$serial_mmat."
			AND serial_mat not in(375,578,579) 	
		GROUP BY
			mmat.serial_mmat

	";
	//echo "<br>CRED TOMADOS: ".$sqlCred."<br>";
	$rsCreditos = $dblink->Execute($sqlCred);
	while(!$rsCreditos->EOF){
		$creditosTomados = $rsCreditos->fields['totalcreditos'];
		$rsCreditos->MoveNext();
	}
	//echo "<br>Creditos Tomados en el registro: ".$creditosTomados."<br>";
	//Verificar  si hay un pago de los creditos tomados
	$sqlCredFac = "
		SELECT 
			* 
		FROM 
			cabecerafactura 
		WHERE 
			serial_mmat = ".$serial_mmat
			;
	//echo "<br>SQL FACTURACION: ".$sqlCredFac."<br>";
	$rsCredFac = $dblink->Execute($sqlCredFac);
	$numRows = $rsCredFac->recordCount();
	if($numRows>0){
		//Verificar si credito tomado y pagado es el mismo
		$sqlCredNorm = "
		SELECT
			caf.serial_mmat,
			ara.nombre_ara,
			caf.serial_caf, 
			dcaf.serial_dar,
			cantidad_dfa as tcreditonormal
		FROM
			cabecerafactura as caf,
			detallefactura as dcaf,
			detallearancel as dar,
			aranceles as ara
		WHERE
			caf.serial_caf = dcaf.serial_caf 
			and dcaf.serial_dar = dar.serial_dar
			and ara.serial_ara = dar.serial_ara
			and caf.serial_mmat = ".$serial_mmat."			
		    and ara.credito_ara = 'SI'
		";
		//echo "<br>SQL Pagados: ".$sqlCredNorm."<br>";
		$creditosPagados = 0;
		$rsCredNorm = $dblink->Execute($sqlCredNorm);
		while(!$rsCredNorm->EOF){
			$creditosPagados = $creditosPagados +$rsCredNorm->fields['tcreditonormal'];
			$rsCredNorm->MoveNext();
		}		
		if($creditosPagados>=$creditosTomados){			
			$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, ha Pagado: ".$creditosPagados." créditos, Los créditos pagados son mayores o iguales que los créditos tomados,  				    En consecuencia SI aparecerá en las listas...";					
			$arrLista[0]['show'] = "SI";
			$arrLista[0]['msg'] = $msg;
			return $arrLista;				
		}else{
			//Verificar si hay cruze para sumar creditos a los creditos ya pagados
			$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			//echo "<br>SQL CRUCE : ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				$totalCreditosAFavor = $creditosDevengados + $creditosPagados;
				if($totalCreditosAFavor>=$creditosTomados){
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados." créditos, ha Pagado: ".$creditosPagados." créditos, ha Cruzado: ".$creditosDevengados." créditos, tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, Los créditos a favor son mayores o iguales que los créditos tomados, En consecuencia SI aparecerá en las listas...";					
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;					
				}else{
					$msg =  "El Estudiante ha Tomado: ".$creditosTomados."créditos,	Ha Pagado: ".$creditosPagados." créditos, Ha Cruzado: ".$creditosDevengados." créditos, Tiene un total de créditos a favor de: ".$totalCreditosAFavor." créditos, Los créditos a favor son menores que los créditos tomados, En consecuencia NO aparecerá en las listas, 
						    Favor Comunicarse con el departamento Financiero...";					
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;	

				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados."créditos, Ha Pagado: ".$creditosPagados." créditos, No registra cruzes de créditos, Los créditos pagados son menores alos créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...";
				$arrLista[0]['show'] = "NO";
				$arrLista[0]['msg'] = $msg;
				return $arrLista;	
				
			}		


		}

	}else{
		//No se hallan datos en cabecera factura verificar el cruce el alumno";
		$sqlCruce = "
				SELECT
					cpt.serial_cpt,
					cpt.estado_cpt,
					sum(dcpt.creditos_dcpt) as creditosdevengados,
					dcpt.serial_mmat 
				FROM
					cabeceracreditosportomar as cpt,
					detallecreditoportomar as dcpt 
				WHERE
					cpt.serial_cpt = dcpt.serial_cpt
					and dcpt.serial_mmat = ".$serial_mmat."
				GROUP BY
					dcpt.serial_mmat
	
			"; 
			//echo "<br>SQL CRUCE: ".$sqlCruce."<br>";
			$rsCruce = $dblink->Execute($sqlCruce);		
			$numR = $rsCruce->recordCount();
			if($numR>0){
				while(!$rsCruce->EOF){
					$creditosDevengados = $rsCruce->fields['creditosdevengados'];
					$rsCruce->MoveNext();
				}
				if($creditosDevengados>=$creditosTomados){
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, Ha cruzado ".$creditosDevengados.", créditos, Los créditos cruzados son mayores o iguales alos créditos tomados, En consecuencia SI aparecerá en las listas...				  	  
					";
					$arrLista[0]['show'] = "SI";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						

				}else{
					$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, Ha cruzado ".$creditosDevengados.", créditos, Los créditos cruzados son menores alos créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...					  	  					";
					$arrLista[0]['show'] = "NO";
					$arrLista[0]['msg'] = $msg;
					return $arrLista;						
				}
			}else{
				$msg = "El Estudiante ha Tomado: ".$creditosTomados." créditos, No ha Pagado directamente créditos de este registro, No tiene registro de créditos cruzados, No ha pagado los créditos tomados, En consecuencia NO aparecerá en las listas, Favor Comunicarse con el departamento Financiero...";
				$arrLista[0]['show'] = "NO";
				$arrLista[0]['msg'] = $msg;
				return $arrLista;						
			}		
	}
}

//////////////

?>