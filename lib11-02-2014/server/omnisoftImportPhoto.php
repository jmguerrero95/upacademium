<html>
<head>
</head>
<body background="file:///C|/Program Files/Apache Group/Apache/htdocs/upacifico/academiumprueba/images/bg_blue_v.jpg">

<?php if ($_POST['ingresofoto']!=1) { ?>
<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" action="omnisoftImportPhoto.php">
<input name="foto" type="file" id="foto" size="30" maxlength="255"  >
<input name="ingresofoto" type="hidden" id="ingresofoto"  value="1" >
<input name="campofoto" type="hidden" id="campofoto"  value="<?php echo $_GET['campofoto'];?>" >


<input type="submit" value="Cargar Foto">
</form>
<?php
} else {
$archivo='';
function omnisoftImportFile() {
  global  $_FILES,$_GET,$archivo;

  $archivo=$_SERVER['DOCUMENT_ROOT'].'/upacifico/upacademium/fotos/'.$_FILES['foto']['name'];
if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
    copy($_FILES['foto']['tmp_name'], $archivo);
} else
    return  0;

   return 1;
}
  if (!empty($_FILES['foto']))
  if (omnisoftImportFile()==1)   {
    echo '<center><image name="imgfoto" width="180" height="180" src="../../fotos/'.$_FILES['foto']['name'] .'"></center>';
    echo '<script> top.opener.document.PaginaDatos.'.$_POST['campofoto'].'.value="'.$_FILES['foto']['name'].'";top.opener.document.PaginaDatos.imgfoto.src="../fotos/'.$_FILES['foto']['name'].'";</script>';

  }
  else
   echo "<script> alert('Error: No se puede cargar la foto' ); </script>";
}
?>
</body>
</html>
