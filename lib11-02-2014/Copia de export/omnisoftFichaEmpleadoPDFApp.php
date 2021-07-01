<?php

        require('omnisoftPDFIndividualGeneral.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);

		global $DBConnection;
		$serial_epl=$_GET['serial_epl'];
      	$dblink = NewADOConnection($DBConnection);

      		if (!$dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
	 	  	$resultSet=$dblink->Execute('select apellido_epl, nombre_epl, tipoempleado_epl, fechanacimiento_epl, ciudad_epl, parroquia_epl, documentoidentidad_epl, tipodocumento_epl, sexo_epl, documentomilitar_epl, estadocivil_epl, carnetiess_epl, telefonopersonal_epl, telefonotrabajo_epl, extension_epl, celular_epl, email_epl, fechaingreso_epl, fechasalida_epl, estadoempleado_epl, formacontrato_epl, fechavencimientocontrato_epl, comisiones_epl, foto_epl, contrato_epl, copiacedula_epl, copiapapeleta_epl, copialibreta_epl, copiacarnet_epl, copiatitulo_epl, copiasreferencias_epl, tipocuentabanco_epl, numerocuentabanco_epl, porcentajecostoacumulado_epl, porcentajecentrocostoacumulado_epl, diasvacaciones_epl, estado_epl, elaboradopor_epl, modificadopor_epl, fechamodificacion_epl, aprobadopor_epl, fechaaprobacion_epl, sistemasalarioneto_epl, aportaiess_epl, generarol_epl, horasmes_epl, asistencia_epl, codigoanterior_epl, direccion_epl, tipolicencia_epl, numerocasa_epl, sueldo_epl, prospecto_epl, horasdia_epl, discapacitado_epl, nombre_ifi, nombre_tur, nombre_tct, nombre_ciu, nombre_prv, nombre_pai, descripcion_dep from sucursaldepartamentos, departamentos, tipocontratostrabajo as tct, turnos as tur, institucionesfinancieras as ifi, empleado left join ciudad on ciudad.serial_ciu=empleado.ciudad_epl left join provincia on provincia.serial_prv=ciudad.serial_prv left join pais on pais.serial_pai=provincia.serial_pai where departamentos.serial_dep=sucursaldepartamentos.serial_dep and sucursaldepartamentos.serial_desc=empleado.serial_desc and empleado.serial_ifi=ifi.serial_ifi and tur.serial_tur=empleado.serial_tur and tct.serial_tct=empleado.serial_tct and empleado.serial_epl='.$serial_epl);
			
$printOBJ=new OmnisoftPDFIndividual($imagePath."/logo.jpg",'','','Velasco 24-38 y Veloz    Telef:(593-3) 2961 506 / 2961 507    Fax:(593-3) 2961506 ext 111     Aptdo: 06-01-105   [www.sfelipeneri.edu.ec]');

	$serial_epl=$_GET['serial_epl'];
    $foto=(strlen(trim($resultSet->fields['foto_epl']))==0 ) ? 'SINFOTO.JPG':$resultSet->fields['foto_epl'];

  	$printOBJ->addColumn(' ',40,trim($resultSet->fields['apellido_epl'])." ".$resultSet->fields['nombre_epl'],1,1,"string","center",'Arial','10',true);
	$printOBJ->addColumn('',45,"../../fotos/".$foto,120,1,"image");

 	$printOBJ->addColumn('DATOS GENERALES: ','','',1,10,"string","center",'Arial','9',true);
 	$printOBJ->addColumn('Género:               ',35,$resultSet->fields['sexo_epl'],1,15,"string","center",'Arial','8');
	$printOBJ->addColumn('Fecha de Nacimiento:  ',35,$resultSet->fields['fechanacimiento_epl'],1,20,"string","center",'Arial','8');
    $printOBJ->addColumn('Estado Civil:         ',35,$resultSet->fields['estadocivil_epl'],100,20,"string","center",'Arial','8');
	$printOBJ->addColumn('Estado:               ',35,$resultSet->fields['estado_epl'],1,25,"string","center",'Arial','8');
	$printOBJ->addColumn('Sueldo:               ',35,$resultSet->fields['sueldo_epl'],100,25,"string","center",'Arial','8');
	$printOBJ->addColumn('Discapacitado:        ',35,$resultSet->fields['discapacitado_epl'],1,30,"string","center",'Arial','8');

	$printOBJ->addColumn('IDENTIFICACION: ','','',1,40,"string","center",'Arial','9',true);
	$printOBJ->addColumn('Cédula Militar:            ',35,trim($resultSet->fields['documentomilitar_epl']),1,45,"string","center",'Arial','8');
	$printOBJ->addColumn('Carnet IESS:               ',35,trim($resultSet->fields['carnetiess_epl']),100,45,"string","center",'Arial','8');
    $printOBJ->addColumn('Tipo de Identificación:    ',35,$resultSet->fields['tipodocumento_epl'].'   No.  '.$resultSet->fields['documentoidentidad_epl'],1,50,"string","center",'Arial','8');
	$printOBJ->addColumn('Tipo Licencia:        ',35,$resultSet->fields['tipolicencia_epl'],100,50,"string","center",'Arial','8');
	$printOBJ->addColumn('Banco:                     ',35,$resultSet->fields['nombre_ifi'],1,55,"string","center",'Arial','8');
	$printOBJ->addColumn('Cuenta Bancaria:           ',35,$resultSet->fields['tipocuentabanco_epl'].'   No.  '.$resultSet->fields['numerocuentabanco_epl'],100,55,"string","center",'Arial','8');

    $printOBJ->addColumn('LOCALIZACION: ','','',1,65,"string","center",'Arial','9',true);
	$printOBJ->addColumn('Dirección:                 ',35,$resultSet->fields['direccion_epl'].'  No. '.$resultSet->fields['numerocasa_epl'],1,70,"string","center",'Arial','8');
    $printOBJ->addColumn('Correo Electrónico:        ',35,$resultSet->fields['email_epl'],1,75,"string","center",'Arial','8');
	$printOBJ->addColumn('Télefono Casa:             ',35,$resultSet->fields['telefonopersonal_epl'],100,75,"string","center",'Arial','8');
	$printOBJ->addColumn('Télefono Oficina:          ',35,$resultSet->fields['telefonotrabajo_epl'].'    Extensión: '.$resultSet->fields['extension_epl'],1,80,"string","center",'Arial','8');
	$printOBJ->addColumn('Celular:                   ',35,$resultSet->fields['celular_epl'],100,80,"string","center",'Arial','8');
	$printOBJ->addColumn('País/Provincia/Ciudad:     ',35,$resultSet->fields['nombre_pai'].' - '.$resultSet->fields['nombre_prv'].' - '.$resultSet->fields['nombre_ciu'],1,85,"string","center",'Arial','8');

    $printOBJ->addColumn('INFORMACION LABORAL: ','','',1,95,"string","center",'Arial','9',true);
	$printOBJ->addColumn('Fecha Ingreso:             ',35,$resultSet->fields['fechaingreso_epl'],1,100,"string","center",'Arial','8');
    $printOBJ->addColumn('Fecha Salida:              ',35,$resultSet->fields['fechasalida_epl'],100,100,"string","center",'Arial','8');	
	$printOBJ->addColumn('Tipo de Empleado:          ',35,$resultSet->fields['tipoempleado_epl'],1,105,"string","center",'Arial','8');	
	$printOBJ->addColumn('Departamento:              ',35,$resultSet->fields['descripcion_dep'],100,105,"string","center",'Arial','8');
	$printOBJ->addColumn('General Rol:               ',35,$resultSet->fields['generarol_epl'],1,110,"string","center",'Arial','8');
	$printOBJ->addColumn('Aporta al IESS:            ',35,$resultSet->fields['aportaiess_epl'],100,110,"string","center",'Arial','8');
	$printOBJ->addColumn('Salario Neto:             ',35,$resultSet->fields['sistemasalarioneto_epl'],1,115,"string","center",'Arial','8');
	$printOBJ->addColumn('Turno:                     ',35,$resultSet->fields['nombre_tur'],100,115,"string","center",'Arial','8');
	$printOBJ->addColumn('Comisiones:                ',35,$resultSet->fields['comisiones_epl'],1,120,"string","center",'Arial','8');

    $printOBJ->addColumn('INFORMACION CONTRACTUAL: ','','',1,130,"string","center",'Arial','9',true);
	$printOBJ->addColumn('Tipo Contrato:             ',35,$resultSet->fields['nombre_tct'],1,135,"string","center",'Arial','8');
	$printOBJ->addColumn('Forma Contrato:            ',35,$resultSet->fields['formacontrato_epl'],100,135,"string","center",'Arial','8');
    $printOBJ->addColumn('Fecha Vencimiento:         ',35,$resultSet->fields['fechaVencimientoContrato_epl'],1,140,"string","center",'Arial','8');
	$printOBJ->addColumn('Cédula:                    ',35,$resultSet->fields['copiacedula_epl'],1,145,"string","center",'Arial','8');
	$printOBJ->addColumn('Papeleta:                  ',35,$resultSet->fields['copiapapeleta_epl'],100,145,"string","center",'Arial','8');
	$printOBJ->addColumn('Libreta:                   ',35,$resultSet->fields['copialibreta_epl'],1,150,"string","center",'Arial','8');
	$printOBJ->addColumn('Carnet:                    ',35,$resultSet->fields['copiacarnet_epl'],100,150,"string","center",'Arial','8');
	$printOBJ->addColumn('Titulo:                    ',35,$resultSet->fields['copiatitulo_epl'],1,155,"string","center",'Arial','8');
	$printOBJ->addColumn('Horas al Mes:    			 ',35,$resultSet->fields['horasMes_epl'],1,160,"string","center",'Arial','8');
	$printOBJ->addColumn('Horas al día:    			 ',35,$resultSet->fields['horasdias_epl'],100,160,"string","center",'Arial','8');


//cargas familiares
$rsCargas=$dblink->Execute('SELECT serial_caf, nombre_caf,apellido_caf, fechaNacimiento_caf, sexo_caf, beneficiario_caf,parentesco_caf,edad_caf, e.serial_epl FROM empleado e, cargasfamiliares cf WHERE e.serial_epl=cf.serial_epl and e.serial_epl='.$serial_epl);	
	  
 	$printOBJ->addColumn('CARGAS FAMILIARES','','',1,170,"string","center",'Arial','8',true);	
	$printOBJ->addColumn('Nombres','','',1,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Apellidos','','',40,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('F. Nacimiento','','',70,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Sexo','','',100,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Beneficiario','','',110,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Parentesco','','',140,175,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Edad','','',170,175,"string","center",'Arial','8',true);
	$posYING=175;
	while (!$rsCargas->EOF) {   
     	$printOBJ->addColumn(' ',35,$rsCargas->fields['nombre_caf'],13,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',35,$rsCargas->fields['apellido_caf'],43,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',35,$rsCargas->fields['fechaNacimiento_caf'],73,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',10,$rsCargas->fields['sexo_caf'],103,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',20,$rsCargas->fields['beneficiario_caf'],123,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',20,$rsCargas->fields['parentesco_caf'],133,$posYING,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',10,$resultSet->fields['edad_caf'],163,$posYING,"string","center",'Arial','8');
	    $posYING+=5;
     	$rsCargas->MoveNext();
    }
	
//FORMACION ACADEMICA
 $rsFormacion=$dblink->Execute('SELECT serial_foa, tipoTitulo_foa,descripcion_foa,institucion_foa,fechaInicio_foa,fechaFin_foa,nivel_foa, e.serial_epl FROM empleado e, formacionacademica f WHERE e.serial_epl=f.serial_epl and e.serial_epl='.$serial_epl.' order by fechaInicio_foa desc');	

	$printOBJ->addColumn('FORMACIÓN ACADÉMICA','','',1,1,"string","center",'Arial','8',true,true);
	$printOBJ->addColumn('Tipo Título','','',10,5,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Nombre Carrera','','',43,5,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Institución','','',77,5,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Inicio','','',110,5,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Fin','','',135,5,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Nivel','','',150,5,"string","center",'Arial','8',true);
	$posYING1=10;
	$contador=0;
	while (!$rsFormacion->EOF and $contador<10) {   
     
	 	$printOBJ->addColumn(' ',30,$rsFormacion->fields['tipotitulo_foa'],10,$posYING1,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',35,$rsFormacion->fields['descripcion_foa'],45,$posYING1,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',30,$rsFormacion->fields['institucion_foa'],80,$posYING1,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsFormacion->fields['fechainicio_foa'],110,$posYING1,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsFormacion->fields['fechafin_foa'],135,$posYING1,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',20,$rsFormacion->fields['nivel_foa'],153,$posYING1,"string","center",'Arial','8');
	    $posYING+=5;
		$contador++;
    	$rsFormacion->MoveNext();
    }
	
//experiencia	
$rsExperiencia=$dblink->Execute('SELECT serial_exp, empresa_exp, cargo_exp, telefono_exp,  tipoinstitucion_exp,fechaingreso_exp, fechasalida_exp,descripcion_exp,afectaRol_exp, e.serial_epl FROM empleado e, experienciaprofesional ep WHERE e.serial_epl=ep.serial_epl and e.serial_epl='.$serial_epl.' order by fechaingreso_exp desc');	

	$printOBJ->addColumn('EXPERIENCIA','','',1,60,"string","center",'Arial','8',true);	
	$printOBJ->addColumn('Empresa','','',10,65,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Cargo','','',40,65,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Teléfono','','',65,65,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Tipo Institución','','',85,65,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Fecha Ingreso','','',115,65,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Fecha Salida','','',140,65,"string","center",'Arial','8',true);
	$posYING2=70;
	$contador=0;
	while (!$rsExperiencia->EOF and $contador<10) {   

     	$printOBJ->addColumn(' ',30,$rsExperiencia->fields['empresa_exp'],13,$posYING2,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',30,$rsExperiencia->fields['cargo_exp'],43,$posYING2,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['telefono_exp'],68,$posYING2,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',20,$rsExperiencia->fields['tipoinstitucion_exp'],88,$posYING2,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['fechaingreso_exp'],118,$posYING2,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsExperiencia->fields['fechasalida_exp'],143,$posYING2,"string","center",'Arial','8');
	    $posYING2+=5;
		$contador++;
     	$rsExperiencia->MoveNext();
    }

//capacitacion
$rsCapacitacion=$dblink->Execute('select descripcion_cap,instructor_cap, institucion_cap, nombrecertificado_cap, duracion_cap, costo_cap, tipo_cap, fechainicio_cap,fechafin_cap, ciudad_cap,beca_cap from empleado, capacitacionPersonal as cp where cp.serial_epl=empleado.serial_epl and empleado.serial_epl='.$serial_epl.' order by fechainicio_cap');	

	$printOBJ->addColumn('CAPACITACION','','',1,120,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Curso/Carrera','','',10,125,"string","center",'Arial','8',true);	
	$printOBJ->addColumn('Institución','','',50,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Certificado','','',85,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Duración','','',105,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Costo','','',120,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Tipo','','',135,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Inicio','','',155,125,"string","center",'Arial','8',true);
	$printOBJ->addColumn('Fin','','',170,125,"string","center",'Arial','8',true);
	$posYING3=130;
	$contador=0;
	while (!$rsCapacitacion->EOF) {   

     	$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['descripcion_cap'],10,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['institucion_cap'],53,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['nombrecertificado_cap'],88,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['duracion_cap'],108,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['costo_cap'],123,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',30,$rsCapacitacion->fields['tipo_cap'],138,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['fechainicio_cap'],155,$posYING3,"string","center",'Arial','8');
		$printOBJ->addColumn(' ',15,$rsCapacitacion->fields['fechafin_cap'],170,$posYING3,"string","center",'Arial','8');
	    $posYING+=5;
		$contador++;
     	$rsCapacitacion->MoveNext();
    }

$printOBJ->showIt();

?>