<?php

/*function creararchivo($filename)
{
   include "config.inc.php";
   $fp = fopen($direccionArchivos.$filename,"w");
   fputs ($fp, $docum);
   fclose ($fp);
}

function informacion($filename,$registro)
{
   include "config.inc.php";
   $fp = fopen($direccionArchivos.filename,"w");
   fputs ($fp, $registro);
   fclose ($fp);
}
*/
function informacion($filename,$registro)
{
      include_once "config.inc.php";
	  $nombrearhivo=$direccionArchivos.$filename;
      $fp=fopen("$nombrearhivo","w");
      fputs($fp,stripslashes($registro));
      fclose($fp);
}
?>
