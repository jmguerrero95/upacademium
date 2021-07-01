<html>
<head>
<link href="../styles/omnisoft.css" rel="stylesheet" type="text/css">
</head>
<body>
<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" action='omnisoftImportarAsistencia.php'>
  <table width="780" border="0" cellspacing="0" cellpadding="0" >
    <tr  >
      <td width="189" height="52"  class="ingeniumtoptitle"></td>
      <td width="487"  class="maintoptitle fonttitle"><center>
          RECURSOS HUMANOS<br>
          IMPORTACION DE MARCAS DEL LECTOR
        </center></td>
      <td width="129"  class="logotoptitle"></td>
    </tr>



<?php

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');


function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

return $dblink;
}
?>

<?php


function omnisoftImportFile() {
  global  $_FILES,$_POST;
  $prefijoslector=Array('','A','B','C');
  $dir_asistencia=$_SERVER['DOCUMENT_ROOT'].'/ingenium2/asistencia';

$archivo=$dir_asistencia.'/'.$_FILES['archivo_asi']['name'];

if (is_uploaded_file($_FILES['archivo_asi']['tmp_name'])) {
    copy($_FILES['archivo_asi']['tmp_name'], $archivo);
} else {
   echo "Error: No se puede cargar el archivo:".$_FILES['archivo_asi']['name']."|";
    return  0;
}


   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);

    if (!($fp = fopen($archivo, "r"))) {
        echo "<script> document.PaginaDatos.mensaje.value='Error: No se puede abrir el archivo:".$_FILES['archivo_asi']['name']."</script>";
        return 0;
     }


//        echo $InsertCmd;


     while (!feof($fp)) {
        $contenido=fgets($fp);
        $registro=explode(',',$contenido);
        $prefijo=intval(substr($registro[3],6,1));

        $codigo_epl=$prefijoslector[$prefijo].substr($registro[3],7,3);

        $hora=trim($registro[5]).":".trim($registro[6]).":00" ;
        $fecha="200".trim($registro[9])."-".trim($registro[7])."-".trim($registro[8]);
        $SQLCmd="select serial_epl from empleado where codigoanterior_epl ='".$codigo_epl."'";
        echo $SQLCmd."<br>";
        $rsEmpleado=$dblink->Execute($SQLCmd);
  //        echo "$codigo_epl-$hora-$fecha <br>";
          if ($rsEmpleado && $rsEmpleado->RecordCount()>0)   {
             $SQLCmd="select serial_asi,entrada_asi,salida_asi from asistencia where serial_epl=".$rsEmpleado->fields[0]. " and fecha_asi='".$fecha."'";
    //         echo $SQLCmd."<br>";
             $rsAsistencia=$dblink->Execute($SQLCmd);
             if ($rsAsistencia && $rsAsistencia->RecordCount()>0) {
      //         echo "asistencia: " .$rsAsistencia->fields[2]."<br>";
                if (strlen($rsAsistencia->fields[2])==0)  {
                $UpdateCmd="update asistencia set salida_asi='".$hora."' where serial_asi=".$rsAsistencia->fields[0];
        //        echo $UpdateCmd."<br>";
                $dblink->Execute($UpdateCmd);
                }
             }
             else {
                 $atraso=0;
                 $InsertCmd="insert into asistencia (SERIAL_ASI, SERIAL_EPL, FECHA_ASI, ENTRADA_ASI, SALIDA_ASI, ESTADO_ASI, atraso_asi, permiso_asi, observaciones_asi) values (0,'";
                 $InsertCmd.= $rsEmpleado->fields[0]."','".$fecha."','".$hora."',NULL,'". $estado."',". $atraso.",0,'')" ;
          //       echo $InsertCmd. "<br>";
                $dblink->Execute($InsertCmd);
          }
          }
     }

   fclose($fp);
  echo "<script> document.PaginaDatos.mensaje.value='Archivo importado exitosamente!'; top.opener.omniObj.lastPage();  </script>";
  return 1;
}

if (isset($_FILES['archivo_asi'])) {
?>

    <tr>
      <td height="30" colspan="3"> <table width="805" height="76" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000"class="formtable">
          <tr>
            <td width="149" height="26"  class="inputtitle">Archivo a Cargar:</td>
            <td width="650">
				<img src="../../images/camporequerido.gif">
				<input type="file" name="archivo_asi" id="archivo_asi" maxlength=255 size=100>
                                		                				</td>
          </tr>
          <tr>
            <td height="24"  class="inputtitle"></td>
            <td >
			<a href="#" onClick="javascript:document.PaginaDatos.submit()"><img src="../../images/importar.png">Importar Marcas</a>
	</td>
          </tr>
          <tr>
            <td height="24"  class="inputtitle">Mensaje</td>
            <td ><input type="text" name="mensaje" id="mensaje" maxlength=255 size=150 readonly="yes">  </td>

          </tr>

      </table></td>
    </tr>
<?php

   omnisoftImportFile();


}
else {
?>
    <tr>
      <td height="30" colspan="3"> <table width="805" height="76" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000"class="formtable">
          <tr>
            <td width="149" height="26"  class="inputtitle">Archivo a Cargar:</td>
            <td width="650">
				<img src="../../images/camporequerido.gif">
				<input type="file" name="archivo_asi" id="archivo_asi" value="test" maxlength=255 size=100>
                                		                				</td>
          </tr>
          <tr>
            <td height="24"  class="inputtitle"></td>
            <td >
			<a href="#" onClick="javascript:document.PaginaDatos.submit()"><img src="../../images/importar.png">Importar Marcas</a>
            </td>
          </tr>
          <tr>
            <td height="24"  class="inputtitle">Mensaje</td>
            <td ><input type="text" name="mensaje" id="mensaje" maxlength=255 size=150 readonly="yes">  </td>

          </tr>

      </table></td>
    </tr>



<?php
}
?>

  </table>
<script>
//      document.PaginaDatos.archivo_asi.value='2008-08-08.log';
</script>
</body>
</html>

