<html>
<head>
 <title> Envio de correo </title>
</head>
<body bgcolor=#CCCCFF>
<?php
if ($_POST['de']) {
        require('omnisoftMailer.php');

	$sql=str_replace("\"", "'",$_POST['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

  $mailerOBJ=new OmnisoftMailer($imagePath.'/logo.jpg',$omnisoftNombreEmpresa,'Datos',$omnisoftNombreEmpresa,$sql,$_POST['para']);
  $fields=$_POST['fields'];

    $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields) ; $i++) {
    $field=explode('~',$sFields[$i]);

    $mailerOBJ->addColumn($field[0],$field[1]);
   }
   $mailerOBJ->showIt();
   echo "<script> window.close(); </script>";

}
else {
?>

<form name='femail' method='POST' action='omnisoftMailerApp.php'>
<?php
echo "<input type=hidden name=fields value='".$_POST['fields']."'>";
echo "<input type=hidden name=query value='".$_POST['query']."'>";

?>

<table>
<tr>    <td>De:</td><td><input type=text name=de value='<?php echo $omnisoftEmail ?>'  size=40> </td> </tr>
<tr>    <td>Para:</td><td><input type=text name=para size=40> </td></tr>
<tr>    <td><input type=submit name=benvio value='Enviar' > </td><td><input type=button name=bcancelar value='Cancelar' onClick='window.close()'> </td></tr>

</table>
<?php
}
?>

</body>
</html>