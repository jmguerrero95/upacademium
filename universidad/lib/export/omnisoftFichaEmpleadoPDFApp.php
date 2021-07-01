<?php

        require('omnisoftPDFIndividual.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);

		global $DBConnection;
		//$serial_epl=$_GET['serial_epl'];
      	$dblink = NewADOConnection($DBConnection);

      		if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
	 	  	$resultSet=$dblink->Execute('select apellido_epl, nombre_epl, tipoempleado_epl, fechanacimiento_epl, ciudad_epl, parroquia_epl, documentoidentidad_epl, tipodocumento_epl, sexo_epl, documentomilitar_epl, estadocivil_epl, carnetiess_epl, telefonopersonal_epl, telefonotrabajo_epl, extension_epl, celular_epl, email_epl, fechaingreso_epl, fechasalida_epl, estadoempleado_epl, formacontrato_epl, fechavencimientocontrato_epl, comisiones_epl, foto_epl, contrato_epl, copiacedula_epl, copiapapeleta_epl, copialibreta_epl, copiacarnet_epl, copiatitulo_epl, copiasreferencias_epl, tipocuentabanco_epl, numerocuentabanco_epl, porcentajecostoacumulado_epl, porcentajecentrocostoacumulado_epl, diasvacaciones_epl, estado_epl, elaboradopor_epl, modificadopor_epl, fechamodificacion_epl, aprobadopor_epl, fechaaprobacion_epl, sistemasalarioneto_epl, aportaiess_epl, generarol_epl, horasmes_epl, asistencia_epl, codigoanterior_epl, direccion_epl, tipolicencia_epl, numerocasa_epl, sueldo_epl, prospecto_epl, horasdia_epl, discapacitado_epl, nombre_ifi, nombre_tur, nombre_tct from empleado,  tipocontratostrabajo as tct, turnos as tur, institucionesfinancieras as ifi where empleado.serial_ifi=ifi.serial_ifi and tur.serial_tur=empleado.serial_tur and tct.serial_tct=empleado.serial_tct and empleado.serial_epl='.$serial_epl);


  $printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",$omnisoftNombreEmpresa,'HOJA DE VIDA DE '.$resultSet->fields['apellido_epl']." ".$resultSet->fields['nombre_epl'],'INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');

	$serial_epl=$_GET['serial_epl'];
      $foto=(strlen(trim($resultSet->fields['foto_epl']))==0 ) ? 'SINFOTO.JPG':$resultSet->fields['foto_epl'];

	$printOBJ->addColumn('',45,"../../fotos/".$foto,120,13,"image");
  	$printOBJ->addColumn('GENERO:                 ',50,$resultSet->fields['sexo_epl'],25,5);
	$printOBJ->addColumn('FECHA DE NACIMIENTO:    ',50,$resultSet->fields['fechanacimiento_epl'],25,10);
    $printOBJ->addColumn('ESTADO CIVIL:           ',50,$resultSet->fields['estadocivil_epl'],25,15);
	$printOBJ->addColumn('ESTADO:                 ',50,$resultSet->fields['estado_epl'],25,20);
	$printOBJ->addColumn('SUELDO:                 ',50,$resultSet->fields['sueldo_epl'],25,25);
	$printOBJ->addColumn('TIPO LICENCIA:          ',50,$resultSet->fields['tipolicencia_epl'],25,30);
	$printOBJ->addColumn('DISCAPACITADO:          ',50,$resultSet->fields['discapacitado_epl'],25,35);
	$printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,40);



	$printOBJ->addColumn('CEDULA MILITAR:            ',50,$resultSet->fields['documentomilitar_epl'],25,45);
	$printOBJ->addColumn('CARNET IESS:               ',50,$resultSet->fields['carnetiess_epl'],25,50);
    $printOBJ->addColumn('TIPO DE IDENTIFICACION:    ',50,$resultSet->fields['tipodocumento_epl'],25,55);
	$printOBJ->addColumn('DOCUMENTO DE IDENTIFICACION:    ',50,$resultSet->fields['documentoidentidad_epl'],25,60);


	$printOBJ->addColumn('BANCO:                     ',50,$resultSet->fields['nombre_ifi'],25,65);
	$printOBJ->addColumn('CUENTA BANCARIA:           ',50,$resultSet->fields['tipocuentabanco_epl'],25,70);
	$printOBJ->addColumn('NUMERO DE CUENTA:          ',50,$resultSet->fields['numerocuentabanco_epl'],25,75);
	$printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,80);

	$printOBJ->addColumn('DIRECCION:                 ',50,$resultSet->fields['direccion_epl'],25,85);
	$printOBJ->addColumn('NUMERO DE CASA:            ',50,$resultSet->fields['numerocasa_epl'],25,90);
    $printOBJ->addColumn('E-MAIL:                    ',50,$resultSet->fields['email_epl'],25,95);
	$printOBJ->addColumn('TELEFONO CASA:             ',50,$resultSet->fields['telefonopersonal_epl'],25,100);
	$printOBJ->addColumn('TELEFONO OFICINA:          ',50,$resultSet->fields['telefonotrabajo_epl'],25,105);
	$printOBJ->addColumn('EXTENSION:                 ',50,$resultSet->fields['extension_epl'],25,110);
	$printOBJ->addColumn('CELULAR:                   ',50,$resultSet->fields['celular_epl'],25,115);
	$printOBJ->addColumn('PAIS/PROVINCIA:            ',50,$resultSet->fields['parroquia_epl'],25,120);
	$printOBJ->addColumn('CIUDAD:                    ',50,$resultSet->fields['ciudad_epl'],25,125);
	$printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,130);

	$printOBJ->addColumn('FECHA INGRESO:             ',50,$resultSet->fields['fechaingreso_epl'],25,135);
	$printOBJ->addColumn('FECHA SALIDA:              ',50,$resultSet->fields['fechasalida_epl'],25,140);
    $printOBJ->addColumn('TIPO EMPLEADO:             ',50,$resultSet->fields['tipoempleado_epl'],25,145);	
	$printOBJ->addColumn('DEPARTAMENTO:              ',50,$resultSet->fields['telefonotrabajo_epl'],25,150);
	$printOBJ->addColumn('GENERAL ROL:               ',50,$resultSet->fields['generarol_epl'],25,155);
	$printOBJ->addColumn('APORTA AL IESS:            ',50,$resultSet->fields['aportaiess_epl'],25,160);
	$printOBJ->addColumn('SALARIOO NETO:             ',50,$resultSet->fields['sistemasalarioneto_epl'],25,165);
	$printOBJ->addColumn('TURNO:                     ',50,$resultSet->fields['nombre_tur'],25,170);
	$printOBJ->addColumn('COMISIONES:                ',50,$resultSet->fields['comisiones_epl'],25,175);
	$printOBJ->addColumn(' ',150,'_____________________________________________________________________________________________________________________________________________________________________________________',5,180);
	
	$printOBJ->addColumn('TIPO CONTRATO:             ',50,$resultSet->fields['nombre_tct'],25,185);
	$printOBJ->addColumn('FORMA CONTRATO:            ',50,$resultSet->fields['formacontrato_epl'],25,190);
    $printOBJ->addColumn('FECHA VENCIMIENTO:         ',50,$resultSet->fields['fechaVencimientoContrato_epl'],25,195);
	$printOBJ->addColumn('CEDULA:                    ',50,$resultSet->fields['copiacedula_epl'],25,200);
	$printOBJ->addColumn('PAPELETA:                  ',50,$resultSet->fields['copiapapeleta_epl'],25,205);
	$printOBJ->addColumn('LIBRETA:                   ',50,$resultSet->fields['copialibreta_epl'],25,210);
	$printOBJ->addColumn('CARNET:                    ',50,$resultSet->fields['copiacarnet_epl'],25,215);
	$printOBJ->addColumn('TITULO:                    ',50,$resultSet->fields['copiatitulo_epl'],25,220);
	$printOBJ->addColumn('HORAS AL MES:    			 ',50,$resultSet->fields['horasMes_epl'],25,225);
	$printOBJ->addColumn('HORAS AL DIA:    			 ',50,$resultSet->fields['horasdias_epl'],25,230);




//cargas familiares


$rsCargas=$dblink->Execute('SELECT serial_caf, nombre_caf,apellido_caf, fechaNacimiento_caf, sexo_caf, beneficiario_caf,parentesco_caf,edad_caf, e.serial_epl FROM empleado e, cargasfamiliares cf WHERE e.serial_epl=cf.serial_epl and e.serial_epl='.$serial_epl);	
	  
	$printOBJ->addColumn(' ',150,'CARGAS FAMILIARES',5,235);	
	$printOBJ->addColumn('  ',50,'NOMBRE',10,20);
	$printOBJ->addColumn('  ',50,'APELLIDO',40,20);
	$printOBJ->addColumn('  ',50,'FECHA NACIMIENTO',70,20);
	$printOBJ->addColumn('  ',10,'SEXO',100,20);
	$printOBJ->addColumn('  ',5,'BENEFICIARIO',120,20);
	$printOBJ->addColumn('  ',20,'PARENTESCO',130,20);
	$printOBJ->addColumn('  ',10,'EDAD',160,20);
	$posYING=30;
	while (!$rsCargas->EOF) {   

     	$printOBJ->addColumn(' ',50,$rsCargas->fields['nombre_caf'],13,$posYING);
		$printOBJ->addColumn(' ',50,$rsCargas->fields['apellido_caf'],43,$posYING);
		$printOBJ->addColumn(' ',50,$rsCargas->fields['fechaNacimiento_caf'],73,$posYING);
		$printOBJ->addColumn(' ',10,$rsCargas->fields['sexo_caf'],103,$posYING);
		$printOBJ->addColumn(' ',20,$rsCargas->fields['beneficiario_caf'],123,$posYING);
		$printOBJ->addColumn(' ',20,$rsCargas->fields['parentesco_caf'],133,$posYING);
		$printOBJ->addColumn(' ',10,$resultSet->fields['edad_caf'],163,$posYING);
	    $posYING+=5;
     	$rsCargas->MoveNext();
    }
	

 $rsFormacion=$dblink->Execute('SELECT serial_foa, tipoTitulo_foa,descripcion_foa,institucion_foa,fechaInicio_foa,fechaFin_foa,nivel_foa, e.serial_epl FROM empleado e, formacionacademica f WHERE e.serial_epl=f.serial_epl and e.serial_epl='.$serial_epl);	
//FORMACION ACADEMICA
	$printOBJ->addColumn(' ',150,'FORMACIÓN ACADÉMICA',5,235);
	$printOBJ->addColumn('  ',30,'TIPO TITULO',10,20);
	$printOBJ->addColumn('  ',30,'NOMBRE CARRERA',43,20);
	$printOBJ->addColumn('  ',30,'INSTITUCION',77,20);
	$printOBJ->addColumn('  ',50,'INICIO',110,20);
	$printOBJ->addColumn('  ',15,'FIN',135,20);
	$printOBJ->addColumn('  ',20,'NIVEL',150,20);
	$posYING=30;
	while (!$rsFormacion->EOF) {   

     	$printOBJ->addColumn(' ',30,$rsFormacion->fields['tipotitulo_foa'],10,$posYING);
		$printOBJ->addColumn(' ',50,$rsFormacion->fields['descripcion_foa'],45,$posYING);
		$printOBJ->addColumn(' ',30,$rsFormacion->fields['institucion_foa'],80,$posYING);
		$printOBJ->addColumn(' ',15,$rsFormacion->fields['fechainicio_foa'],110,$posYING);
		$printOBJ->addColumn(' ',15,$rsFormacion->fields['fechafin_foa'],135,$posYING);
		$printOBJ->addColumn(' ',20,$rsFormacion->fields['nivel_foa'],153,$posYING);
	    $posYING+=5;
     	$rsFormacion->MoveNext();
    }
	
	
	//experiencia	
	
	$rsExperiencia=$dblink->Execute('SELECT serial_exp, empresa_exp, cargo_exp, telefono_exp,  tipoinstitucion_exp,fechaingreso_exp, fechasalida_exp,descripcion_exp,afectaRol_exp, e.serial_epl FROM empleado e, experienciaprofesional ep WHERE e.serial_epl=ep.serial_epl and e.serial_epl='.$serial_epl);	

	$printOBJ->addColumn(' ',150,'EXPERIENCIA',5,235);	
	$printOBJ->addColumn('  ',30,'EMPRESA',10,20);
	$printOBJ->addColumn('  ',30,'CARGO',40,20);
	$printOBJ->addColumn('  ',15,'TELEFONO',65,20);
	$printOBJ->addColumn('  ',20,'TIPO INSTITUCION',85,20);
	$printOBJ->addColumn('  ',15,'FECHA INGRESO',115,20);
	$printOBJ->addColumn('  ',15,'FECHA SALIDA',140,20);
	$posYING=30;
	while (!$rsExperiencia->EOF) {   

     	$printOBJ->addColumn(' ',30,$rsExperiencia->fields['empresa_exp'],13,$posYING);
		$printOBJ->addColumn(' ',30,$rsExperiencia->fields['cargo_exp'],43,$posYING);
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['telefono_exp'],68,$posYING);
		$printOBJ->addColumn(' ',20,$rsExperiencia->fields['tipoinstitucion_exp'],88,$posYING);
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['fechaingreso_exp'],118,$posYING);
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['fechasalida_exp'],143,$posYING);
	    $posYING+=5;
     	$rsExperiencia->MoveNext();
    }

//capacitacion

$rsCapacitacion=$dblink->Execute('select descripcion_cap,instructor_cap, institucion_cap, nombrecertificado_cap, duracion_cap, costo_cap, tipo_cap, fechainicio_cap,fechafin_cap, ciudad_cap,beca_cap from empleado, capacitacionPersonal as cp where cp.serial_epl=empleado.serial_epl and empleado.serial_epl='.$serial_epl);	

	
	$printOBJ->addColumn(' ',150,'CAPACITACION',5,235);
	
	$printOBJ->addColumn('  ',30,'CURSO/CARRERA',10,20);	
	$printOBJ->addColumn('  ',30,'INSTITUCION',50,20);
	$printOBJ->addColumn('  ',30,'CERTIFICADO',85,20);
	$printOBJ->addColumn('  ',15,'DURACION',105,20);
	$printOBJ->addColumn('  ',15,'COSTO',120,20);
	$printOBJ->addColumn('  ',30,'TIPO',135,20);
	$printOBJ->addColumn('  ',15,'INICIO',155,20);
	$printOBJ->addColumn('  ',15,'FIN',170,20);
	$posYING=30;
	while (!$rsCapacitacion->EOF) {   

     	$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['descripcion_cap'],10,$posYING);
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['institucion_cap'],53,$posYING);
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['nombrecertificado_cap'],88,$posYING);
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['duracion_cap'],108,$posYING);
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['costo_cap'],123,$posYING);
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['tipo_cap'],138,$posYING);
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['fechainicio_cap'],155,$posYING);
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['fechafin_cap'],170,$posYING);
	    $posYING+=5;
     	$rsCapacitacion->MoveNext();
    }



$printOBJ->showIt();

?>