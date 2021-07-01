<? 
    include "../config/bdd.inc";
  	$codigo = $HTTP_POST_VARS["loginadministrador"];
	$passw = $HTTP_POST_VARS["passwordadministrador"];
	$sql="select * from usuario where login_usr='$codigo' and password_usr='$passw'";
	$result = $db->Execute($sql);
	//	USUARIO EXISTENTE
   if 	(($codigo!='') and ($passw!=''))
   {
	  if(!$result->EOF)
	  {
		$clave=trim($result->fields[1]);
		$serial_usr=$result->fields['serial_usr'];
		$nombre_usr=$result->fields['nombre_usr'];
		$apellido_usr=$result->fields['apellido_usr'];
		session_start();

		$_SESSION['usuario_sess'] = $serial_usr;
		$_SESSION['nombre_usr'] = $nombre_usr;
		$_SESSION['apellido_usr'] = $apellido_usr;

		//	CLAVE CORRECTA
        if($serial_usr==1)		
			echo "<script language=\"JavaScript\">document.location = \"../modulos.html\";</script>";
		if($serial_usr==2)
			echo "<script language=\"JavaScript\">document.location = \"../modulos.php\";</script>";
	  }//termina if
	  else
	  {
		echo "<script language=\"JavaScript\">alert('No existe usuario');history.go(-1);</script>";
	  }
    }
	else
	{
		echo "<script language=\"JavaScript\">alert('Ingrese código y clave');history.go(-1);</script>";
	}
?>