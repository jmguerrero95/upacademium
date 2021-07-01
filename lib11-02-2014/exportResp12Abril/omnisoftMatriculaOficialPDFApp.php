<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
       require('../../config/config.inc.php');


	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

	$params=explode('|',$sql);

  global $DBConnection;



      $dblink = NewADOConnection($DBConnection);
      $resultset=$dblink->Execute($sql);

  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",'','','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');

while (!$resultset->EOF)
{
    $fila=5;

    $printOBJ->addColumn('MATRICULA OFICIAL',80,'',70,1,"string","center",'Arial','16');
    $printOBJ->addColumn('MATRICULA:',30,$resultset->fields['numeromatricula_paralu'],30,$fila+4,"string","left",'Arial','12');
    $printOBJ->addColumn('Tomo:',30,$resultset->fields['tomo_paralu'],90,$fila+4,"string","left",'Arial','10');
    $printOBJ->addColumn('Folio:',30,$resultset->fields['folio_paralu'],130,$fila+4,"string","left",'Arial','10');
    $printOBJ->addColumn('Año Lectivo:',20,$resultset->fields['codigo_per'],70,$fila+9,"string","left",'Arial','10');
    $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y");
    $printOBJ->addColumn($d,200,'',60,$fila+14,"string","left",'Arial','8');

    $printOBJ->addColumn('Código:',20,$resultset->fields['serial_paralu'],10,$fila+25,"string","left",'Arial','8');
    $printOBJ->addColumn('Cédula:',20,$resultset->fields['codigoIdentificacion_alu'],120,$fila+25,"string","right",'Arial','8');
    $printOBJ->addColumn('Alumno/a:',20,$resultset->fields['apellido_alu'].' '.$resultset->fields['nombre_alu'],10,$fila+30,"string","left",'Arial','8');
    $printOBJ->addColumn('Año:',45,$resultset->fields['nombre_niv'].' "'.$resultset->fields['nombre_par'].'"',10,$fila+37,"string","right",'Arial','8');
    $printOBJ->addColumn('Años en el mismo curso:',45,"1",120,$fila+37,"string","right",'Arial','8');

 
   $resultSet=$dblink->Execute('select  id_alumno,direcc_alu,nombre_prv,nombre_ciu,nombre_nac,fecnac_alu,telefo_alu,nombre_col,descripcion_prt,hermanos_alu,puesto_alu,hermanosCentro_alu,codigoIdentificacion_alu from nacionalidad,parentesco,provincia,ciudad,alumno left join colegios on colegios.serial_col=alumno.serial_col where nacionalidad.serial_nac=alumno.serial_nac and provincia.serial_prv=ciudad.serial_prv and ciudad.serial_ciu=alumno.serial_ciu and parentesco.serial_prt=alumno.conQuienVive_alu and serial_alu='.$resultset->fields['serial_paralu']);
  
    $printOBJ->addColumn('Lugar de nacimiento:',30,$resultSet->fields['nombre_ciu'],10,$fila+45,"string","left",'Arial','8');
    $printOBJ->addColumn('Provincia:',30,$resultSet->fields['nombre_prv'],120,$fila+45,"string","right",'Arial','8');
    $printOBJ->addColumn('Nacionalidad:',30,$resultSet->fields['nombre_nac'],10,$fila+50,"string","left",'Arial','8');
    $printOBJ->addColumn('Fecha de Nacimiento:',30,$resultSet->fields['fecnac_alu'],120,$fila+50,"string","right",'Arial','8');
    $printOBJ->addColumn('Domicilio:',40,$resultSet->fields['direcc_alu'],10,$fila+55,"string","left",'Arial','8');
    $printOBJ->addColumn('Teléfono:',50,$resultSet->fields['telefo_alu'],120,$fila+55,"string","right",'Arial','8');
    $printOBJ->addColumn('Plantel de Procedencia:',40,$resultSet->fields['nombre_col'],10,$fila+63,"string","left",'Arial','8');
    $printOBJ->addColumn('Hermanos Incluido el Alumno:',40,$resultSet->fields['hermanos_alu'],10,$fila+68,"string","left",'Arial','8');
    $printOBJ->addColumn('Lugar que ocupa:',30,$resultSet->fields['puesto_alu'],120,$fila+68,"string","left",'Arial','8');
    $printOBJ->addColumn('Hermanos en la Unidad Educativa:',60,$resultSet->fields['hermanosCentro_alu'],10,$fila+73,"string","left",'Arial','8');
    $printOBJ->addColumn('Vive con:',50,$resultSet->fields['descripcion_prt'],120,$fila+73,"string","left",'Arial','8');


    $rsRepresentante=$dblink->Execute("select  apellido_pad,nombre_pad,nombre_cpr, direccion_pad,telefono_pad,nombre_emp,' ',' ',representante_palu,descripcion_prt,fallecido_pad from parentesco,codigoprofesion,padres,padres_alumno where parentesco.serial_prt=padres.serial_prt and codigoprofesion.serial_cpr=padres.serial_cpr and padres.serial_pad=padres_alumno.serial_pad and padres_alumno.serial_alu=".$resultset->fields['serial_paralu']. " order by descripcion_prt DESC");
   
    if (!$rsRepresentante || $rsRepresentante->RecordCount()<=0)  {

	    $printOBJ->addColumn('Error: Por favor registre los datos del padre y la madre:',50,' ',10,82,"string","left",'Arial','10');

    }

    else {
    	$printOBJ->addColumn($rsRepresentante->fields['descripcion_prt'],50,' ',10,$fila+90,"string","left",'Arial','7');

    if ($rsRepresentante->fields['fallecido_pad']=='SI')
    $printOBJ->addColumn('Nombre:',30,'(+) '. $rsRepresentante->fields['apellido_pad']." ".$rsRepresentante->fields['nombre_pad'],10,$fila+95,"string","left",'Arial','7');
    else
    $printOBJ->addColumn('Nombre:',30,$rsRepresentante->fields['apellido_pad']." ".$rsRepresentante->fields['nombre_pad'],10,$fila+95,"string","left",'Arial','7');

    $printOBJ->addColumn('Profesión:',20,$rsRepresentante->fields['nombre_cpr'],10,$fila+100,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields['direccion_pad'],10,$fila+105,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',20,$rsRepresentante->fields['telefono_pad'],10,$fila+110,"string","left",'Arial','7');
    $printOBJ->addColumn('Lugar - Trabajo:',25,$rsRepresentante->fields['nombre_emp'],10,$fila+115,"string","left",'Arial','7');

    $representante=($rsRepresentante->fields['representante_palu']=='SI')?2:-1;

    $rsRepresentante->MoveNext();
    if (!$rsRepresentante->EOF) {
    $printOBJ->addColumn($rsRepresentante->fields['descripcion_prt'],50,' ',110,$fila+90,"string","left",'Arial','7');

    if ($rsRepresentante->fields['fallecido_pad']=='SI')
    $printOBJ->addColumn('Nombre:',30,'(+) '.$rsRepresentante->fields['apellido_pad']." ".$rsRepresentante->fields['nombre_pad'],110,$fila+95,"string","left",'Arial','7');
    else
    $printOBJ->addColumn('Nombre:',30,$rsRepresentante->fields['apellido_pad']." ".$rsRepresentante->fields['nombre_pad'],110,$fila+95,"string","left",'Arial','7');

    $printOBJ->addColumn('Profesión:',20,$rsRepresentante->fields['nombre_cpr'],110,$fila+100,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields['direccion_pad'],110,$fila+105,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',20,$rsRepresentante->fields['telefono_pad'],110,$fila+110,"string","left",'Arial','7');
    $printOBJ->addColumn('Lugar - Trabajo:',20,$rsRepresentante->fields['nombre_emp'],110,$fila+115,"string","left",'Arial','7');
    $representante=($rsRepresentante->fields['representante_palu']=='SI')?1:-1;

    }

    if ($representante!=1)
        $rsRepresentante->MoveFirst();

    $printOBJ->addColumn('Nombre:',20,$rsRepresentante->fields['apellido_pad']. "  ".$rsRepresentante->fields['nombre_pad'],10,$fila+145,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields['direccion_pad'],10,$fila+150,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',15,$rsRepresentante->fields['telefono_pad'],150,$fila+150,"string","left",'Arial','7');
	$printOBJ->addColumn($rsRepresentante->fields['nombre_pad']. " ".$rsRepresentante->fields['apellido_pad'],40,'',10,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn($omnisoftRector,40,'',75,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn($omnisoftSecretario,40,'',150,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn('REPRESENTANTE',10,'',15,$fila+220,"string","left",'Arial','9');
	$printOBJ->addColumn('RECTOR',10,'',85,$fila+220,"string","left",'Arial','9');
	$printOBJ->addColumn('SECRETARIA',15,'',155,$fila+220,"string","left",'Arial','9');

    }

	$printOBJ->columnCount=0; 
	$printOBJ->columnDetailCount=0; 
	$printOBJ->printPage();  
	$resultset->MoveNext();
}

 $printOBJ->showIt();


?>