<?php

        require('omnisoftHorasExtrasPDF.php');


  $fechaInicio=$_GET['fechaInicio'];
  $fechaFin=$_GET['fechaFin'];
  $serial_epl=$_GET['serial_epl'];
  $nombre_epl=$_GET['nombre_epl'];

  $sql="select serial_epl,codigoAnterior_epl,apellido_epl,nombre_epl from empleado where prospecto_epl='NO' and serial_epl=". $serial_epl."  order by apellido_epl,nombre_epl" ;
  $title='REPORTE DE HORAS EXTRAS DE '.$nombre_epl." DEL ".$fechaInicio." AL ".$fechaFin;
  
  $printOBJ=new OmnisoftHorasExtrasPDF($imagePath.'/logo.jpg',$omnisoftNombreEmpresa,$title,'INGENIUM',$sql,$fechaInicio,$fechaFin,'P');

  $printOBJ->showIt();

?>