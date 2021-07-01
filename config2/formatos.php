<?php
function titulo($titulo) {
        echo "<center><font face=\"Arial, Helvetica, sans-serif\" size=\"4\" color=\"#OOOOOO\"><b>".ucwords($titulo)."</b></font></center><br>";
        }

function nota($nota,$salto=0) {
        if($salto==0) echo "<br><br>";
        echo "<center><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=\"#OOOOOO\"><i>".ucfirst($nota)."</i></font></center><br>";
        }

//	FUNCION PARA EL FORMATO DE IMPRECION DE VALORES MONETARIOS.
function numberFormat($valor,$decimales)
{
	$cantidad=number_format($valor,$decimales, ',', '.');
	return($cantidad);
}
?>