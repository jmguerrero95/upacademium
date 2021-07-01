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

      if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
      $resultSet=$dblink->Execute('select  id_alumno,direcc_alu,nombre_prv,nombre_ciu,nombre_nac,fecnac_alu,telefo_alu,nombre_col,descripcion_prt,hermanos_alu,puesto_alu,hermanosCentro_alu,codigoIdentificacion_alu from nacionalidad,parentesco,provincia,ciudad,alumno left join colegios on colegios.serial_col=alumno.serial_col where nacionalidad.serial_nac=alumno.serial_nac and provincia.serial_prv=ciudad.serial_prv and ciudad.serial_ciu=alumno.serial_ciu and parentesco.serial_prt=alumno.conQuienVive_alu and serial_alu='.$params[0]);

//    echo "  select  id_alumno,direcc_alu,nombre_prv,nombre_ciu,nombre_nac,fecnac_alu,telefo_alu,nombre_col,descripcion_prt,hermanos_alu,puesto_alu,hermanosCentro_alu from nacionalidad,parentesco,provincia,ciudad,alumno left join colegios on colegios.serial_col=alumno.serial_col where nacionalidad.serial_nac=alumno.serial_nac and provincia.serial_prv=ciudad.serial_prv and ciudad.serial_ciu=alumno.serial_ciu and parentesco.serial_prt=alumno.conQuienVive_alu and serial_alu=".$params[0];


  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",'','','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');


    $fila=5;

    $printOBJ->addColumn('MATRICULA OFICIAL',80,'',70,1,"string","center",'Arial','16');
    $printOBJ->addColumn('MATRICULA:',30,$params[4],30,$fila+4,"string","left",'Arial','12');
    $printOBJ->addColumn('Tomo:',30,$params[5],90,$fila+4,"string","left",'Arial','10');
    $printOBJ->addColumn('Folio:',30,$params[6],130,$fila+4,"string","left",'Arial','10');
    $printOBJ->addColumn('Año Lectivo:',20,substr($params[7],16,9),70,$fila+9,"string","left",'Arial','10');
    $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y");
    $printOBJ->addColumn($d,200,'',60,$fila+14,"string","left",'Arial','8');




    $printOBJ->addColumn('Código:',20,$resultSet->fields[0],10,$fila+25,"string","left",'Arial','8');
    $printOBJ->addColumn('Cédula:',20,$resultSet->fields[12],120,$fila+25,"string","right",'Arial','8');
    $printOBJ->addColumn('Alumno/a:',20,substr($params[11],0,50),10,$fila+30,"string","left",'Arial','8');
    $printOBJ->addColumn('Año:',45,$params[9]. ' "'.$params[10].'"',10,$fila+37,"string","right",'Arial','8');
    $printOBJ->addColumn('Años en el mismo curso:',45,"1",120,$fila+37,"string","right",'Arial','8');
    $printOBJ->addColumn('Lugar de nacimiento:',30,$resultSet->fields[3],10,$fila+45,"string","left",'Arial','8');
    $printOBJ->addColumn('Provincia:',30,$resultSet->fields[2],120,$fila+45,"string","right",'Arial','8');
    $printOBJ->addColumn('Nacionalidad:',30,$resultSet->fields[4],10,$fila+50,"string","left",'Arial','8');
    $printOBJ->addColumn('Fecha de Nacimiento:',30,$resultSet->fields[5],120,$fila+50,"string","right",'Arial','8');
    $printOBJ->addColumn('Domicilio:',40,$resultSet->fields[1],10,$fila+55,"string","left",'Arial','8');
    $printOBJ->addColumn('Teléfono:',50,$resultSet->fields[6],120,$fila+55,"string","right",'Arial','8');
    $printOBJ->addColumn('Plantel de Procedencia:',40,$resultSet->fields[7],10,$fila+63,"string","left",'Arial','8');
    $printOBJ->addColumn('Hermanos Incluido el Alumno:',40,$resultSet->fields[9],10,$fila+68,"string","left",'Arial','8');
    $printOBJ->addColumn('Lugar que ocupa:',30,$resultSet->fields[10],120,$fila+68,"string","left",'Arial','8');
    $printOBJ->addColumn('Hermanos en la Unidad Educativa:',60,$resultSet->fields[11],10,$fila+73,"string","left",'Arial','8');
    $printOBJ->addColumn('Vive con:',50,$resultSet->fields[8],120,$fila+73,"string","left",'Arial','8');


    $rsRepresentante=$dblink->Execute("select  apellido_pad,nombre_pad,nombre_cpr, direccion_pad,telefono_pad,nombre_emp,' ',' ',representante_palu,descripcion_prt,fallecido_pad from parentesco,codigoprofesion,padres,padres_alumno where parentesco.serial_prt=padres.serial_prt and codigoprofesion.serial_cpr=padres.serial_cpr and padres.serial_pad=padres_alumno.serial_pad and padres_alumno.serial_alu=".$params[0]. " order by descripcion_prt DESC");
    if (!$rsRepresentante || $rsRepresentante->RecordCount()<=0)  {

    $printOBJ->addColumn('Error: Por favor registre los datos del padre y la madre:',50,' ',10,82,"string","left",'Arial','10');

    }

    else {
    $printOBJ->addColumn($rsRepresentante->fields[9],50,' ',10,$fila+90,"string","left",'Arial','7');

    if ($rsRepresentante->fields[10]=='SI')
    $printOBJ->addColumn('Nombre:',30,'(+) '. $rsRepresentante->fields[0]." ".$rsRepresentante->fields[1],10,$fila+95,"string","left",'Arial','7');
    else
    $printOBJ->addColumn('Nombre:',30,$rsRepresentante->fields[0]." ".$rsRepresentante->fields[1],10,$fila+95,"string","left",'Arial','7');

    $printOBJ->addColumn('Profesión:',20,$rsRepresentante->fields[2],10,$fila+100,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields[3],10,$fila+105,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',20,$rsRepresentante->fields[4],10,$fila+110,"string","left",'Arial','7');
    $printOBJ->addColumn('Lugar - Trabajo:',25,$rsRepresentante->fields[5],10,$fila+115,"string","left",'Arial','7');
//    $printOBJ->addColumn('Dirección Trabajo:',25,$rsRepresentante->fields[6],10,$fila+120,"string","left",'Arial','7');
//    $printOBJ->addColumn('Teléfono Trabajo:',25,$rsRepresentante->fields[7],10,$fila+125,"string","left",'Arial','7');
    $representante=($rsRepresentante->fields[8]=='SI')?2:-1;

    $rsRepresentante->MoveNext();
    if (!$rsRepresentante->EOF) {
    $printOBJ->addColumn($rsRepresentante->fields[9],50,' ',110,$fila+90,"string","left",'Arial','7');

    if ($rsRepresentante->fields[10]=='SI')
    $printOBJ->addColumn('Nombre:',30,'(+) '.$rsRepresentante->fields[0]." ".$rsRepresentante->fields[1],110,$fila+95,"string","left",'Arial','7');
    else
    $printOBJ->addColumn('Nombre:',30,$rsRepresentante->fields[0]." ".$rsRepresentante->fields[1],110,$fila+95,"string","left",'Arial','7');

    $printOBJ->addColumn('Profesión:',20,$rsRepresentante->fields[2],110,$fila+100,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields[3],110,$fila+105,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',20,$rsRepresentante->fields[4],110,$fila+110,"string","left",'Arial','7');
    $printOBJ->addColumn('Lugar - Trabajo:',20,$rsRepresentante->fields[5],110,$fila+115,"string","left",'Arial','7');
//    $printOBJ->addColumn('Dirección Trabajo:',25,$rsRepresentante->fields[6],110,$fila+120,"string","left",'Arial','7');
//    $printOBJ->addColumn('Teléfono Trabajo:',25,$rsRepresentante->fields[7],110,$fila+125,"string","left",'Arial','7');
    $representante=($rsRepresentante->fields[8]=='SI')?1:-1;

    }

    if ($representante!=1)
        $rsRepresentante->MoveFirst();

//    $printOBJ->addColumn('Representante:',50,' ',10,152,"string","left",'Arial','10');

    $printOBJ->addColumn('Nombre:',20,$rsRepresentante->fields[0]. "  ".$rsRepresentante->fields[1],10,$fila+145,"string","left",'Arial','7');
    $printOBJ->addColumn('Domicilio:',20,$rsRepresentante->fields[3],10,$fila+150,"string","left",'Arial','7');
    $printOBJ->addColumn('Teléfono:',15,$rsRepresentante->fields[4],150,$fila+150,"string","left",'Arial','7');


	$printOBJ->addColumn($rsRepresentante->fields[1]. " ".$rsRepresentante->fields[0],40,'',10,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn($omnisoftRector,40,'',75,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn($omnisoftSecretario,40,'',150,$fila+215,"string","left",'Arial','7');
	$printOBJ->addColumn('REPRESENTANTE',10,'',15,$fila+220,"string","left",'Arial','9');
	$printOBJ->addColumn('RECTOR',10,'',85,$fila+220,"string","left",'Arial','9');
	$printOBJ->addColumn('SECRETARIA',15,'',155,$fila+220,"string","left",'Arial','9');

    }

  $printOBJ->showIt();


?>