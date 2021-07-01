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


?>