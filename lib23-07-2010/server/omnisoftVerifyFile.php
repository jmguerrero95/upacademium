<html>
<head>


</head>

<body background="../../images/bg_blue_v.jpg">
<form name="fImportar" method="post">
<table><tr>
<td>
Archivo:</td><td><input type="text" name="archivo" readonly  size=100></td>
</tr>
<tr><td>
Importando:</td>
<td><input type="text" name="mensaje" readonly size=100></td>
</table>

<?php

include('../../config/config.inc.php');

function omnisoftVerifyFile() {
  global  $_FILES,$_POST;

$serial_emp=$_POST['serial_emp'];
$serial_suc=$_POST['serial_suc'];
$dir_empresa=$_SERVER['DOCUMENT_ROOT'].'/seguros/archivos/'.$serial_emp;
$dir_sucursal=$_SERVER['DOCUMENT_ROOT'].'/seguros/archivos/'.$serial_emp.'/'.$serial_suc;

if (!is_dir($dir_empresa) && !@mkdir($dir_empresa,0755)) {
    echo "<script>document.fImportar.mensaje.value='Error: No se puede crear el directorio de la institucion por favor consulte con el administrador de la red';</script>";
    return 0;
}


if (!is_dir($dir_sucursal) && !@mkdir($dir_sucursal,0755)) {
   echo "<script>document.fImportar.mensaje.value='Error: No se puede crear el directorio de la sucursal por favor consulte con el administrador de la red';</script>";
    return 0;
}



$archivo=$dir_sucursal.'/'.$_FILES['archivo_mtr']['name'];
echo "<script>document.fImportar.archivo.value='".$_FILES['archivo_mtr']['name']."';</script>";


if (is_uploaded_file($_FILES['archivo_mtr']['tmp_name'])) {
    copy($_FILES['archivo_mtr']['tmp_name'], $archivo);
} else {
   echo "<script>document.fImportar.mensaje.value='Error: No se puede verificar el archivo:".$_FILES['archivo_mtr']['name']."';</script>";
    return  0;
}



    if (!($fp = fopen($archivo, "r"))) {
   echo "<script>document.fImportar.mensaje.value='Error: No se puede abrir el archivo:".$_FILES['archivo_mtr']['name']."';</script>";

      return 0;
     }


     $contenido=fread($fp,108);
     if (strlen($contenido)!=108) {
         echo "<script>document.fImportar.mensaje.value='Error:Formato de archivo no reconocido';</script>";
         return 0;
     }


     $idRegistro_ctran=substr($contenido,0,1);
     $codigoEmpresa_ctran=substr($contenido,1,4);
     $tipoIdentificacion_ctran=substr($contenido,5,1);
     $identificacion_ctran=substr($contenido,6,13);
     $email_ctran=substr($contenido,19,30);
     $numeroTotalRegistros_ctran=substr($contenido,49,8);
     $montoTotalCobranza_ctran=substr($contenido,57,13);
     $fechaEnvio_ctran=substr($contenido,70,8);
     $concepto_ctran=substr($contenido,78,30);
     echo "<script>document.fImportar.mensaje.value='Registros=".$numeroTotalRegistros_ctran."Monto=".$montoTotalCobranza_ctran."';</script>";

    $nregistros=0;
    $sumaDebito=0;
     while (!feof($fp)) {
        $contenido = fread($fp, 170);
        if (strlen($contenido)==170) {
          $contenido=trim($contenido);
          $nregistros++;
           $IDREGISTRO_TRA=substr($contenido,0,1);
           $SECUENCIAL_TRA=substr($contenido,1,6);
           $USUARIO_TRA=substr($contenido,7,41);
           $TIPOUSUARIO_TRA=substr($contenido,48,1);
           $NUMEROIDUSUARIO_TRA=substr($contenido,49,13);
           $TIPODEBITO_TRA=substr($contenido,62,1);
           $EMAIL_TRA=substr($contenido,63,30);
           $CONTRAPARTIDA_TRA=substr($contenido,93,20);
           $IFI_TRA=substr($contenido,113,5);
           $NUMEROCUENTA_TRA=substr($contenido,118,20);
           $TIPOCUENTA_TRA=substr($contenido,138,2);
           $VALORDEBITO_TRA=substr($contenido,140,13);
           $MONEDA_TRA=substr($contenido,153,3);
           $FECHA_TRA=substr($contenido,156,8);
           $FECVEN_TRA=substr($contenido,164,4);
           $ESTADO_TRA='0';
           $VALOR_TRA='0';
           $FECHAAPLICACION_TRA='00000000';
           $sumaDebito+=$VALORDEBITO_TRA;
         echo "<script>document.fImportar.mensaje.value='TIPO DEBITO=".$TIPODEBITO_TRA.",VALOR DEBITADO=".$VALORDEBITO_TRA."';</script>";
        }

     }

   fclose($fp);

  if ($nregistros!=$numeroTotalRegistros_ctran) {
   echo "<script> alert('Error: El numero de registros  no coincide con el total de la cabecera' ); </script>";
    return 0;
  }

    if ($sumaDebito!=$montoTotalCobranza_ctran) {
   echo "<script> alert('Error: El monto total de la cabecera  no coincide con el valor de los registros procesados' ); </script>";
   return 0;
  }


 echo "<script>document.fImportar.mensaje.value='Registros=".$nregistros.",Monto=".$sumaDebito."';</script>";


  return 1;
}


  if (omnisoftVerifyFile()==1)
   echo "<script> alert('Verificacion terminada exitosamente'); </script>";
  else
   echo "<script> alert('Errores en la verificacion, por favor revise el archivo e intente nuevamente' ); </script>";




?>
			<center><div align="center" id="divGuardar" style="visibility:visible"><a href="#" onClick="javascript:window.close();"><img src="../../images/aceptar.gif" width="52" height="49" border="0" align="left"></a></div></center>
</form>
</body>
</html>
