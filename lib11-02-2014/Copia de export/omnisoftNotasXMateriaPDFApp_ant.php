<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
        require('../server/funciones.php');

	$serial_nts=$_GET['serial_nts'];
	//echo "serial_nts:.... ".$serial_nts. "<br>";  
	$serial_sec=$_GET['serial_sec'];
	//echo "serial_sec:.... ".$serial_sec. "<br>";  
 	$nombre_sec=$_GET['nombre_sec'];
	//echo "nombre_sec:.... ".$nombre_sec. "<br>";  
    $serial_per=$_GET['serial_per'];
	//echo "serial_per:.... ".$serial_per. "<br>";  
    $nombre_per=$_GET['nombre_per'];
	//echo "nombre_per:.... ".$nombre_per. "<br>";  
    $serial_mat=$_GET['serial_mat'];
	//echo "serial_mat:.... ".$serial_mat. "<br>";  
    $nombre_mat=$_GET['nombre_mat'];
	//echo "nombre_mat:.... ".$nombre_mat. "<br>";  
    $apellido_epl=$_GET['apellido_epl'];
	//echo "apellido_epl:.... ".$apellido_epl. "<br>";  
    $nombre_epl=$_GET['nombre_epl'];
	//echo "nombre_epl:.... ".$nombre_epl. "<br>";  
    $serial_suc=$_GET['serial_suc'];
	//echo "serial_suc:.... ".$serial_suc. "<br>";  
    $fecini_per=$_GET['fecini_per'];
	//echo "fecini_per:.... ".$fecini_per. "<br>";  
    $fecfin_per=$_GET['fecfin_per'];
	//echo "fecfin_per:.... ".$fecfin_per. "<br>";  
    $ntotalclases_nts=$_GET['ntotalclases_nts'];
    //echo "ntotalclases_nts:.... ".$ntotalclases_nts. "<br>";  
	$serial_hrr=$_GET['serial_hrr'];
    //echo "serial_hrr:.... ".$serial_hrr. "<br>";  
  global $DBConnection;

  $dblink = NewADOConnection($DBConnection);
  if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,' ','ACADEMIUM','Arial',13,0xf,0x0,35,'P');

	
	$sql='SELECT notasalumnos.serial_nal, apellidopaterno_alu, apellidomaterno_alu, nombre1_alu, nombre2_alu, notatotal_nal, notaalfabetica_nal, observaciones_nal, notasalumnos.serial_nts, notasalumnos.serial_dmat, detallemateriamatriculada.serial_mmat, materiamatriculada.serial_alu FROM notasalumnos JOIN detallemateriamatriculada ON detallemateriamatriculada.serial_dmat = notasalumnos.serial_dmat JOIN materiamatriculada ON materiamatriculada.serial_mmat = detallemateriamatriculada.serial_mmat JOIN alumno ON materiamatriculada.serial_alu = alumno.serial_alu WHERE notasalumnos.serial_nts = '.$serial_nts.' ORDER BY apellidopaterno_alu, apellidomaterno_alu';
   $rsAlumno=$dblink->Execute($sql);
   //echo "<br> rsAlumno: ".$sql. "<br>";
	
   //echo $sql;
  // despliega la materia de acuerdo al profesor
   /* $rsMateria=$dblink->Execute('select materia.serial_mat,materia_profesor.serial_matpro,materia_nivel.serial_matniv,abre_mat from materia,materia_nivel,materia_profesor where materia.serial_mat=materia_nivel.serial_mat and materia_nivel.serial_matniv=materia_profesor.serial_matniv and   materia_profesor.serial_matpro='.$serial_matpro);*/


    $printOBJ->addColumn(' ',35,'ACTAS DE CALIFICACIONES DEL '.$nombre_per,35,0,"string","center",'Arial','9',true);
	$printOBJ->addColumn('FECHA :             ',25,'DEL '.$fecini_per.' AL '.$fecfin_per,5,4,"string","center",'Arial','8',true);
    $printOBJ->addColumn('PROGRAMA :    ',25,$nombre_sec,5,8,"string","center",'Arial','8',true);
    $printOBJ->addColumn('MATERIA :      ',25,$nombre_mat,90,8,"string","center",'Arial','8',true);
	$printOBJ->addColumn('PROFESOR :     ',25,$nombre_epl." ".$apellido_epl,5,12,"string","center",'Arial','8',true);
	$printOBJ->addColumn('CREDITOS :     ',25,$ntotalclases_nts,90,12,"string","center",'Arial','8',true);
	$printOBJ->addColumn(' ',20,'A: Act. en clases  T: Trabajos  EP: Examen Parcial  EF: Examen Final',24,17,"string","center",'Arial','6',true);	
    $printOBJ->addColumn(' ',10,'No.',5,20,"string","center",'Arial','7',false);
    $printOBJ->addColumn(' ',34,'ALUMNOS',34,20,"string","center",'Arial','7',false);
	$printOBJ->addColumn(' ',80,'APORTES',80,20,"string","center",'Arial','7',false);
	$printOBJ->addColumn(' ',111,'TOTAL',111,20,"string","center",'Arial','7',false);
	$printOBJ->addColumn(' ',124,'PROMEDIO',124,20,"string","center",'Arial','7',false);
	$printOBJ->addColumn(' ',141,'ALFABETICA',141,20,"string","center",'Arial','7',false);
    
//	$printOBJ->addColumn(' ',125,'ALFABETICA',125,20,"string","center",'Arial','7',false);
   /* $rsTrimestre=$dblink->Execute('select serial_tri,nombre_tri from trimestre where serial_per='.$serial_per.' order by fecini_tri');*/

    $posX=47;
    $i=0;
 //   while (!$rsTrimestre->EOF) {
    //$printOBJ->addColumn(' ',25,$rsTrimestre->fields[1],$posX,15,"string","center",'Arial','8',false);
    $posX+=40;
	
		$SQLCmd="SELECT serial_acal, abrevia_acal FROM aportescalificacion WHERE tipo_acal = 'DIGITADO' and activo_acal='SI'";
			//echo $SQLCmd."<br>";
	$rsAporte=$dblink->Execute($SQLCmd); 			 
//echo $rsAporte;
    //$rsParcial=$dblink->Execute("select serial_prc,abreviatura_prc,tipo_prc, formula_prc from parcial where  serial_tri=".$rsTrimestre->fields[0].' order by orden_prc');

    $posX1=150+70*$i;
    while (!$rsAporte->EOF) {
    $printOBJ->addColumn(' ',10,$rsAporte->fields[1],$posX1-80,24,"string","center",'Arial','7'); //posicion abreviaturas de los aportes
    $posX1+=9; //espacio entre las letras de los aportes

     $rsAporte->MoveNext();
    }

    $i++;
  //  $rsTrimestre->MoveNext();
  //  }
//aqui lineas horizontales de titulos
    $printOBJ->addColumn(' ',$posX1-32,0.1,5,23,"line","center",'Arial','5',true);

    $printOBJ->addColumn(' ',$posX1-32,0.1,5,20,"line","center",'Arial','5',true);

    $posY=28;

    $posX=45;
    $numero=0;
    $filas=($rsAlumno->RecordCount()+1)*3+5;
    while (!$rsAlumno->EOF ) {
    $posX1=75;
    $numero++;

    $printOBJ->addColumn(' ',6,$numero.'.',5,$posY,"number","right",'Arial','7');
	

   $apellido1=explode(' ',$rsAlumno->fields[1]);
   $apellido2=explode(' ',$rsAlumno->fields[2]);
   $nombre1=explode(' ',$rsAlumno->fields[3]);
   $nombre2=explode(' ',$rsAlumno->fields[4]);

	$printOBJ->addColumn(' ',65,$apellido1[0].' '.$apellido2[0].' '.$nombre1[0].' '.$nombre2[0],8,$posY,"string","center",'Arial','7',false,false,1);

/*$sql_NotaTotal='SELECT serial_nfa, notatotal_nfa, alfabetica_dcale, numerica_dcale, relativa_dcale, estado_dcale FROM notafinal_alumno as nfa left join detallecalificacionequivalencia as dcale on nfa.serial_dcale = dcale.serial_dcale WHERE serial_suc ='.$serial_suc.' AND serial_sec ='.$serial_sec.' AND serial_per ='.$serial_per.' and serial_alu ='.$rsAlumno->fields[0].' AND serial_matpro ='.$serial_matpro.' AND serial_mat ='.$serial_mat.' AND serial_cale ='.$rsAlumno->fields[11].'';
	   echo "<br> sql_NotaTotal: ".$sql_NotaTotal. "<br>";
					$rsNotaTotal=$dblink->Execute($sql_NotaTotal);	*/
					
		$sql_Suma=' SELECT notasalumnos.serial_dmat, serial_nts, sum( nota_dnal ) AS TOTAL FROM detallenotasalumnos
		JOIN notasalumnos ON notasalumnos.serial_nal = detallenotasalumnos.serial_nal
		WHERE notasalumnos.serial_nts = '.$serial_nts.'
		and serial_dmat= '.$rsAlumno->fields['serial_dmat'].'
		GROUP BY notasalumnos.serial_dmat';
//echo "<br> sql_Suma: ".$sql_Suma. "<br>";
					$rsSuma=$dblink->Execute($sql_Suma);
//echo "suma:.... ".$rsSuma->fields[2|]. "<br>";											

    //$notatrimestre=0;
    //$nparciales=0;
    //$rsTrimestre=$dblink->Execute('select serial_tri,nombre_tri from trimestre where serial_per='.$serial_per.' order by fecini_tri');

    $posX=45;
    $i=0;
   // while (!$rsTrimestre->EOF) {
     //$serial_tri=$rsTrimestre->fields[0];

    $rsAporte=$dblink->Execute("SELECT serial_acal, abrevia_acal FROM aportescalificacion WHERE tipo_acal = 'DIGITADO' and activo_acal='SI'");
    //$posX1=75+70*$i;
	
	//lineas de la cabecera de alumnos-notas
	$posX1=150+70*$i;
    
	
	while (!$rsAporte->EOF) {

//    if ($rsParcial->fields[2]=='CALCULADO')
//        omnisoftVerificarNotasParciales($serial_per,$serial_pro,$rsMateria->fields[1],$serial_tri,$rsParcial->fields[0],$rsAlumno->fields[0]);
	/*$sql_nota='SELECT serial_dnal, nota_dnal FROM detallenotasalumnos as dnal left join notasalumnos as nal on nal.serial_nal = dnal.serial_nal where serial_suc ='.$serial_suc.' and serial_sec='.$serial_sec.' and serial_per ='.$serial_per.' and serial_mat ='.$serial_mat.' and serial_matpro ='.$serial_matpro.' and serial_acal = '.$rsAporte->fields[0].' and serial_dmat='.$rsAlumno->fields[6]; 
	  echo "sql_nota:.... ".$sql_nota."<br>";
	  $rsNotaParcial=$dblink->Execute(sql_nota);*/
$sql_NotaParcial='SELECT serial_dnal, serial_nal, serial_acal, nota_dnal, observaciones_dnal 
								 FROM detallenotasalumnos 
								 WHERE serial_acal = '.$rsAporte->fields['serial_acal'].'
								 and serial_nal ='.$rsAlumno->fields['serial_nal'].'';	  
$rsNotaParcial=$dblink->Execute($sql_NotaParcial);
   //echo "<br> rsAlumno: ".$sql_NotaParcial. "<br>";
          $nota=($rsNotaParcial->fields['nota_dnal']==0 || $rsNotaParcial->fields['nota_dnal']=='  ')? '  ':$rsNotaParcial->fields['nota_dnal'];
	 $snota=($nota!='  ')?sprintf('%01.2f',$nota):'  ';

   /* if ($rsAport88e->fields[1]<>'ER' || !esMateriaConsolidada($rsMateria->fields[0])  )*/
    $printOBJ->addColumn(' ',4,$snota,$posX1-82,$posY,"string","center",'Arial','7'); // ncolumnas de los aportes
    $posX1+=9; //espacio entre notas aportes
         $rsAporte->MoveNext();
    }
    $printOBJ->addColumn(' ',$filas,0.16,$posX1-62,20,"linev","center",'Arial','5',true);

    $i++;

    $posY+=2;
    $printOBJ->addColumn(' ',$posX1-32,0.2,5,$posY+1,"line","center",'Arial','5',true); // lineas horizontales de las notas
    $posY+=1;
	
 $notaTotal=($rsAlumno->fields[5]==0 || $rsAlumno->fields[5]=='')? '':$rsAlumno->fields[5];
	 $snotaTotal=($notaTotal!='')?sprintf('%01.2f',$notaTotal):'';
//aqui notas promedio
$printOBJ->addColumn(' ',4,$snotaTotal,$posX1-59,$posY-3,"string","center",'Arial','7');
    $posX1+=5;
	

$notaSuma=($rsSuma->fields[2]==0 || $rsSuma->fields[2]=='')? '':$rsSuma->fields[2];
	 $notaSuma=($notaSuma!='')?sprintf('%01.2f',$notaSuma):'';
//aqui
$printOBJ->addColumn(' ',4,$notaSuma,$posX1-79,$posY-3,"string","center",'Arial','7');
    $posX1+=5;	


 //$nombre2=explode(' ',$rsAlumno->fields[4]);	
 //$notaTotal_A=($rsNotaTotal->fields[1]==0 || $rsNotaTotal->fields[4]=='')? '':$rsNotaTotal->fields[4];
 $notaTotal_A=explode(' ',$rsAlumno->fields[6]);
 $printOBJ->addColumn(' ',65,$notaTotal_A[0].'  ',147,$posY-3,"string","center",'Arial','7',false,false,1);
	 //$snotaTotal=($notaTotal_A!='')?sprintf('%02d',$notaTotal_A):'';
//aqui
//$printOBJ->addColumn(' ',4,$snotaTotal,$posX1+65,$posY-3,"string","center",'Arial','7');

    $posX1+=25;

    $rsAlumno->MoveNext();
    }

	//lineas verticales últimas
    $printOBJ->addColumn(' ',$filas,0.1,5,20,"linev","center",'Arial','5',true);
	$printOBJ->addColumn(' ',$filas,0.1,110,20,"linev","center",'Arial','5',true);
	$printOBJ->addColumn(' ',$filas,0.1,141,20,"linev","center",'Arial','5',true);
	$printOBJ->addColumn(' ',$filas,0.1,159,20,"linev","center",'Arial','5',true);

    $posY+=20;


	
  $printOBJ->addColumn(' ',17,'OBSERVACIONES :',7,$posY-15,"string","center",'Arial','9',true);
  $printOBJ->addColumn(' ',17,'________________________________________________________________________________',7,$posY-12,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'________________________________________________________________________________',7,$posY-9,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'________________________________________________________________________________',7,$posY-6,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'PROFESOR',18,$posY+9,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'______________________',5,$posY+5,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'COORDINACION ACADEMICA',120,$posY+9,"string","center",'Arial','10',true);
  $printOBJ->addColumn(' ',17,'__________________________',120,$posY+5,"string","center",'Arial','10',true);


    $printOBJ->showIt();


?>