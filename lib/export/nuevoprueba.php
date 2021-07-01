 <? require('omnisoftNotasAlumno.php');
     if (!$accion = 'insertar'){?>
           <formulario>
     <? }else{
          if ( insertarCliente($txtNombre, $txtApellidos, $txtNif) ){
               echo "cliente insertado";
          }else{
               echo "Algo ha fallado";
          }
		  }
	 ?>


