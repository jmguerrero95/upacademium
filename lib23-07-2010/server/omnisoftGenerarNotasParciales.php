<?php


include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

$dblink='';

function omnisoftConnectDB() {
global $DBConnection,$dblink;

$dblink = NewADOConnection($DBConnection);

}


function omnisoftProcesarNotasParciales($serial_per,$serial_pro,$serial_matpro,$serial_tri,$serial_prc) {

  global $dblink;

   $actualizacion=false;


   $SQLCmd="select serial_matniv,serial_par from materia_profesor where serial_matpro=".$serial_matpro;
 //  echo $SQLCmd. "<br>";;
   $rsMateriaProfesor=$dblink->Execute($SQLCmd);

   if (!$rsMateriaProfesor || $rsMateriaProfesor->RecordCount()<=0) {
    echo "Error No existe la materia para el profesor seleccionado!|0";
    return false;
   }

   $serial_matniv=$rsMateriaProfesor->fields[0];
   $serial_par=$rsMateriaProfesor->fields[1];

     $SQLCmd="select serial_alu from paralelo_alumno where activo_paralu='S'  and serial_par=".$serial_par;
//     echo $SQLCmd. "<br>";;

     $rsParaleloAlumno=$dblink->Execute($SQLCmd);
     while (!$rsParaleloAlumno->EOF) {
         $SQLVerifica="select serial_matalu from materia_alumno where serial_alu=".$rsParaleloAlumno->fields[0]." and serial_matpro=".$serial_matpro;
       //echo $SQLVerifica. "<br>";

         $rsVerMateriaAlumno=$dblink->Execute($SQLVerifica);
         if (!$rsVerMateriaAlumno || $rsVerMateriaAlumno->RecordCount()<=0) {
             $SQLInsert="insert into materia_alumno (serial_matalu, serial_alu, serial_matpro, total_matalu, nmin_matalu, aproba_matalu, disc_matalu, supletorio_matalu, nfinal_matalu, examenGrado_matalu, finjust_matalu, fjust_matalu, atraso_matalu) values (0,".$rsParaleloAlumno->fields[0].",".$serial_matpro.",0,0,'NO',0,0,0,0,0,0,0)";
             // echo $SQLCmdInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsParaleloAlumno->MoveNext();
     }

   /*} */

  /*
      // Procesa Notas Trimestrales
   $SQLCmd="select serial_ntri from nota_trimestre where serial_matalu=".$serial_matalu. " and serial_tri=".$serial_tri;

  // echo $SQLCmd. "<br>";;
   $rsNotaTrimestre=$dblink->Execute($SQLCmd);

   if (!$rsNotaTrimestre || $rsNotaTrimestre->RecordCount()<=0) {
  */
     $SQLCmd="select serial_matalu from materia_alumno where serial_matpro=".$serial_matpro;
 //    echo $SQLCmd. "<br>";;

     $rsMateriaAlumno=$dblink->Execute($SQLCmd);
     while (!$rsMateriaAlumno->EOF) {
         $SQLVerifica="select serial_ntri from materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matalu=".$rsMateriaAlumno->fields[0]." and serial_tri=".$serial_tri;
        //echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_trimestre (serial_ntri, serial_matalu, serial_tri, nota_ntri, base_ntri, porcentaje_ntri, observacion_ntri, disc_ntri, ptrabajado_ntri, pasistido_ntri, finjust_ntri, fjust_ntri, atraso_ntri) values (0,".$rsMateriaAlumno->fields[0].",".$serial_tri.",0,0,0,'',0,0,0,0,0,0)";
         //     echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsMateriaAlumno->MoveNext();
     }
  /* } */


     $SQLCmd="select serial_ntri,serial_prc from parcial,materia_alumno,nota_trimestre where nota_trimestre.serial_matalu=materia_alumno.serial_matalu and serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=parcial.serial_tri and parcial.serial_prc=".$serial_prc;
     // echo $SQLCmd. "<br>";;

     $rsNotaTrimestre=$dblink->Execute($SQLCmd);
     while (!$rsNotaTrimestre->EOF) {
         $SQLVerifica="select serial_nprc from nota_parcial where serial_prc=".$serial_prc." and serial_ntri=".$rsNotaTrimestre->fields[0];
        //echo $SQLVerifica. "<br>";

         $rsVerNotaTrimestre=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaTrimestre || $rsVerNotaTrimestre->RecordCount()<=0) {
             $SQLInsert="insert into nota_parcial (serial_nprc, serial_ntri, serial_prc, nota_nprc, base_nprc, porcentaje_nprc, observacion_nprc, disc_nprc, aclase_nprc, disciplinaInspector_nprc, disciplinaFinal_nprc, finjust_nprc, fjust_nprc, atraso_nprc) values (0,".$rsNotaTrimestre->fields[0].",".$serial_prc.",0,0,0,'',0,0,0,0,0,0,0)";
             //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaTrimestre->MoveNext();
     }


     $SQLCmd="select serial_nprc,serial_cri from criterio,materia_alumno,materia_profesor,nota_trimestre,nota_parcial where criterio.serial_matniv=materia_profesor.serial_matniv and materia_profesor.serial_matpro=materia_alumno.serial_matpro and nota_parcial.serial_ntri=nota_trimestre.serial_ntri and nota_trimestre.serial_matalu=materia_alumno.serial_matalu and materia_alumno.serial_matpro=".$serial_matpro." and nota_trimestre.serial_tri=".$serial_tri;
     // echo $SQLCmd. "<br>";;

     $rsNotaParcial=$dblink->Execute($SQLCmd);
     while (!$rsNotaParcial->EOF) {
         $SQLVerifica="select serial_prccri from parcial_criterio where serial_nprc=".$rsNotaParcial->fields[0]." and serial_cri=".$rsNotaParcial->fields[1];
        //echo $SQLVerifica. "<br>";

         $rsVerNotaParcial=$dblink->Execute($SQLVerifica);
         if (!$rsVerNotaParcial || $rsVerNotaParcial->RecordCount()<=0) {
             $SQLInsert="insert into parcial_criterio (serial_prccri, serial_nprc, serial_cri, numero_prccri, nota_prccri, base_prccri, nprueba_prccri) values (0,".$rsNotaParcial->fields[0].",".$rsNotaParcial->fields[1].",0,0,0,0)";
              //echo $SQLInsert. "<br>";;
                $dblink->Execute($SQLInsert);
         }
      $rsNotaParcial->MoveNext();
     }


   // echo $serial_per."|";
}


   $query = $_POST['query'];

   $query=str_replace("\"", "'",$query);
   $query=str_replace("\'", "'",$query);
   $query=str_replace("\x5C", "\x5C\x5C",$query);

    omnisoftConnectDB();
    $params=explode('|',$query);


    $SQLCmd="select serial_per from  periodo where activo_per='SI'";

       $rsPeriodo=$dblink->Execute($SQLCmd);

       if (!$rsPeriodo || $rsPeriodo->RecordCount() <=0)
          echo "Error: No existe un periodo activo!|0";
       else {

         omnisoftProcesarNotasParciales($rsPeriodo->fields[0],$params[0],$params[1],$params[2],$params[3]);


   }
      echo $params[2]."|";

?>
