<!--<html>
<head>
</head>
<body>

<form method="post" action="enviarCorreo.php">
<fieldset>
<label for="nombre"> Nombre.
<input type="text" name="nombre" id="nombre" size="25"/></label><br />
<label for="correo"> Correo.
<input type="text" name="correo" id="correo"/></label><br />
<label for="asunto"> Asunto.
<input type="text" name="asunto" id="asunto"/></label><br />
<label for="mensaje"> Mensaje.</label><br />
<textarea cols="25" rows="10" name="mensaje" id="mensaje"></textarea>
<input type="submit" value="Enviar" />

</fieldset>
</form>

</body>
</html>
-->

<?php 
$attachment = array ("http://sifa.upacifico.edu.ec/upacifico/upacademium/images/logo.jpg"); 
$destinatario = "maria.yumbay@upacifico.edu.ec"; 
$asunto = "Este mensaje de prueba"; 
$texto = str_replace("\n.", "\n..", $texto);
$cuerpo = '
<html> 
<head> 
<title>Prueba de correo electronico</title> 
</head> 
<body> 
<h1>'.$texto.'</h1> 
<p> 
<b>Correo electrónico de prueba PARA ENVIAR ROLES</b>
<b>ENVIADO DESDE EL SERVIDOR DE PRUEBAS SIFA</b>
</p> 
</body> 
</html> 
'; 

//Envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//Dirección del remitente 
$headers .= "From: ivan.jacome@upacifico.edu.ec\r\n"; 

//Dirección de respuesta (Puede ser una diferente a la de pepito@mydomain.com)
$headers .= "Reply-To: ivan.jacome@upacifico.edu.ec\r\n"; 

//Ruta del mensaje desde origen a destino 
//$headers .= "Return-path: ivan.jacome@upacifico.edu.ec\r\n"; 

//direcciones que recibián copia 
//$headers .= "Cc: maria.yumbay@upacifico.edu.ec,evelyn.gomez@upacifico.edu.ec,cristina.hidalgo@upacifico.edu.ec\r\n"; 

//Direcciones que recibirán copia oculta 
//$headers .= "Bcc: ivan.jacome@upacifico.edu.ec, ivan.jacome@upacifico.edu.ec\r\n"; 

mail($destinatario,$asunto,$cuerpo,$headers) 


//phpinfo();
?>
