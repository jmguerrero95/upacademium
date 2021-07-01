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

include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');



function omnisoftConnectDB() {
global $DBConnection;
$dblink = NewADOConnection($DBConnection);

return $dblink;
}


function omnisoftImportResultFile() {
  global  $_FILES,$_POST;

$serial_emp=$_POST['serial_emp'];
$serial_suc=$_POST['serial_suc'];
//$serial_emp=1;
//$serial_suc=1;

$dir_empresa=$_SERVER['DOCUMENT_ROOT'].'/seguros/resultados/'.$serial_emp;
$dir_sucursal=$_SERVER['DOCUMENT_ROOT'].'/seguros/resultados/'.$serial_emp.'/'.$serial_suc;

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
   echo "<script>document.fImportar.mensaje.value='Error: No se puede cargar el archivo:".$_FILES['archivo_mtr']['name']."';</script>";
    return  0;
}


   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);

    if (!($fp = fopen($archivo, "r"))) {
   echo "<script>document.fImportar.mensaje.value='Error: No se puede abrir el archivo:".$_FILES['archivo_mtr']['name']."';</script>";

      return 0;
     }

//        $InsertCmd="insert into mastertransaccion (SERIAL_MTR, FECHA_MTR, ARCHIVO_MTR, serial_suc) values (0,'".$_POST['fecha_mtr']."','".$_FILES['archivo_mtr']['name']."',".$_POST['serial_suc'].")";
        $dblink->StartTrans();

  //      $dblink->Execute($InsertCmd);
        $serial_mtr=$dblink->Insert_ID();

//        echo $InsertCmd;

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
     $montoTotalCobranza_ctran=substr($contenido,57,13)/100;
     $fechaEnvio_ctran=substr($contenido,70,8);
     $concepto_ctran=substr($contenido,78,30);
     echo "<script>document.fImportar.mensaje.value='Registros=".$numeroTotalRegistros_ctran."Monto=".$montoTotalCobranza_ctran."';</script>";

    $selectCmd="select serial_ctran from cabeceratransaccion  where  idRegistro_ctran='".$idRegistro_ctran."' and codigoEmpresa_ctran='". $codigoEmpresa_ctran."' and  tipoIdentificacion_ctran='". $tipoIdentificacion_ctran."' and  identificacion_ctran='". $identificacion_ctran."' and email_ctran='".$email_ctran."' and  numeroTotalRegistros_ctran='". $numeroTotalRegistros_ctran."' and  montoTotalCobranza_ctran='". $montoTotalCobranza_ctran."' and  fechaEnvio_ctran='". $fechaEnvio_ctran."' and  concepto_ctran='".$concepto_ctran."'";
     //echo "<script>document.fImportar.mensaje.value='".$selectCmd."';</script>";

    //echo $InsertCmd;
        $rs=$dblink->Execute($selectCmd);

        $serial_ctran=$rs->fields[0];
        if ($serial_tran<0) {
     echo "<script>document.fImportar.mensaje.value='Error no se puede encontrar transacciones ya importadas';</script>";
        return;
        }
    $nregistros=0;
    $sumaDebito=0;
     while (!feof($fp)) {
        $contenido = fread($fp, 196);
        if (strlen($contenido)==196) {
          $contenido=trim($contenido);
          $nregistros++;
           $IDREGISTRO_TRA=trim(substr($contenido,0,1));
           $SECUENCIAL_TRA=trim(substr($contenido,1,6));
           $USUARIO_TRA=trim(substr($contenido,7,41));
           $TIPOUSUARIO_TRA=trim(substr($contenido,48,1));
           $NUMEROIDUSUARIO_TRA=trim(substr($contenido,49,13));
           $TIPODEBITO_TRA=trim(substr($contenido,62,1));
           $EMAIL_TRA=trim(substr($contenido,63,30));
           $CONTRAPARTIDA_TRA=trim(substr($contenido,93,20));
           $IFI_TRA=trim(substr($contenido,113,5));
           $NUMEROCUENTA_TRA=trim(substr($contenido,118,20));
           $TIPOCUENTA_TRA=trim(substr($contenido,138,2));
           $VALORDEBITO_TRA=trim(substr($contenido,140,13))/100;
           $MONEDA_TRA=trim(substr($contenido,153,3));
           $FECHA_TRA=trim(substr($contenido,156,8));
           $FECVEN_TRA=trim(substr($contenido,164,4));
           $ESTADO_TRA=trim(substr($contenido,168,5));
           $VALOR_TRA=trim(substr($contenido,173,13))/100;
           $FECHAAPLICACION_TRA=trim(substr($contenido,186,8));
           $sumaDebito+=$VALORDEBITO_TRA;
         echo "<script>document.fImportar.mensaje.value='TIPO DEBITO=".$TIPODEBITO_TRA.",VALOR DEBITADO=".$VALORDEBITO_TRA."';</script>";
         if ($FECVEN_TRA!='')
         $selectCmd="select serial_tra from transaccion where serial_ctran=".$serial_ctran." and IDREGISTRO_TRA='".$IDREGISTRO_TRA."' and  SECUENCIAL_TRA='". $SECUENCIAL_TRA."' and USUARIO_TRA='".$USUARIO_TRA."' and  TIPOUSUARIO_TRA='".$TIPOUSUARIO_TRA."' and  NUMEROIDUSUARIO_TRA='".$NUMEROIDUSUARIO_TRA."' and  TIPODEBITO_TRA='".$TIPODEBITO_TRA."' and  EMAIL_TRA='".$EMAIL_TRA ."' and CONTRAPARTIDA_TRA='".$CONTRAPARTIDA_TRA."' and  IFI_TRA='".$IFI_TRA."' and  NUMEROCUENTA_TRA='".$NUMEROCUENTA_TRA."' and  TIPOCUENTA_TRA='".$TIPOCUENTA_TRA."' and  VALORDEBITO_TRA='".$VALORDEBITO_TRA."' and  MONEDA_TRA='".$MONEDA_TRA."' and  FECHA_TRA='".$FECHA_TRA."' and  FECVEN_TRA='".$FECVEN_TRA."'";
         else
         $selectCmd="select serial_tra from transaccion where serial_ctran=".$serial_ctran." and IDREGISTRO_TRA='".$IDREGISTRO_TRA."' and  SECUENCIAL_TRA='". $SECUENCIAL_TRA."' and USUARIO_TRA='".$USUARIO_TRA."' and  TIPOUSUARIO_TRA='".$TIPOUSUARIO_TRA."' and  NUMEROIDUSUARIO_TRA='".$NUMEROIDUSUARIO_TRA."' and  TIPODEBITO_TRA='".$TIPODEBITO_TRA."' and  EMAIL_TRA='".$EMAIL_TRA ."' and CONTRAPARTIDA_TRA='".$CONTRAPARTIDA_TRA."' and  IFI_TRA='".$IFI_TRA."' and  NUMEROCUENTA_TRA='".$NUMEROCUENTA_TRA."' and  TIPOCUENTA_TRA='".$TIPOCUENTA_TRA."' and  VALORDEBITO_TRA='".$VALORDEBITO_TRA."' and  MONEDA_TRA='".$MONEDA_TRA."' and  FECHA_TRA='".$FECHA_TRA."'";

         //echo "<script>document.fImportar.mensaje.value='".$selectCmd."';</script>";

         $rs=$dblink->Execute($selectCmd);
         if ($rs->fields[0]>0) {
           $serial_tra=$rs->fields[0];
          $updateCmd="update transaccion set ESTADO_TRA='".$ESTADO_TRA."', VALOR_TRA='".$VALOR_TRA."', FECHAAPLICACION_TRA='".$FECHAAPLICACION."' where serial_tra=".$serial_tra;
//           echo "<script>document.fImportar.mensaje.value='".$updateCmd."';</script>";

//         echo "<script>prompt('test',".$updateCmd+");</script>";

          $dblink->Execute($updateCmd);

         }

//         echo $InsertCmd."<br>";
        }

     }

   fclose($fp);

  if ($nregistros!=$numeroTotalRegistros_ctran) {
      $dblink->FailTrans();
   echo "<script> alert('Error: El numero de registros  no coincide con el total de la cabecera' ); </script>";
    return 0;
  }

    if ($sumaDebito!=$montoTotalCobranza_ctran) {
      $dblink->FailTrans();
   echo "<script> alert('Error: El monto total de la cabecera  no coincide con el valor de los registros procesados' ); </script>";
   return 0;
  }

 $dblink->CompleteTrans();

 if ($dblink->HasFailedTrans()) {
   echo "<script> alert('Error:No se pudo importar el archivo,".$dblink->ErrorMsg()."' ); </script>";

     return 0;
 }
 echo "<script>document.fImportar.mensaje.value='Registros=".$nregistros.",Monto=".$sumaDebito."';</script>";


  return 1;
}


  if (omnisoftImportResultFile()==1)
   echo "<script> alert('Importacion terminada exitosamente'); </script>";
  else
   echo "<script> alert('Errores en la importacion, por favor revise el archivo e intente nuevamente' ); </script>";




?>
			<center><div align="center" id="divGuardar" style="visibility:visible"><a href="#" onClick="javascript:window.close();"><img src="../../images/aceptar.gif" width="52" height="49" border="0" align="left"></a></div></center>
</form>
</body>
</html>
