<?php

        require('omnisoftHorasExtrasPDF.php');


  $fechaInicio=$_GET['fechaInicio'];
  $fechaFin=$_GET['fechaFin'];

  $sql="select serial_epl,codigoAnterior_epl,apellido_epl,nombre_epl from empleado where prospecto_epl='NO' order by apellido_epl,nombre_epl" ;
  $title="REPORTE DE HORAS EXTRAS DEL ".$fechaInicio ." AL ".$fechaFin;
  $printOBJ=new OmnisoftHorasExtrasPDF($imagePath.'/logo.jpg',$omnisoftNombreEmpresa,$title,'INGENIUM',$sql,$fechaInicio,$fechaFin,'P');

  $printOBJ->showIt();

?>