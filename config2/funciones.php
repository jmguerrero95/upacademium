<?php
	function actualizarHijosPadre($serial_pad,$tipoPadre,$direccionpad,$telefonopad){
    //consulta por el serial_pad toddos los alumnos y luego a cada uno los va actualizando
		include "bdd.inc";
		$sql = "select alu.serial_alu as serial_alu
				from alumno as alu,padres_alumno as padalu,parentesco as paren
				where padalu.serial_pad=$serial_pad and alu.serial_alu=padalu.serial_alu and paren.serial_par=padalu.serial_par and conQuienVive_alu='$tipoPadre' and codigo_par='$tipoPadre'";
		$rs=$db->Execute($sql);
		$nr=$rs->RecordCount();
		if ($nr>0){
			while(!$rs->EOF){
			   $serialalu=$rs->fields['serial_alu'];
			   $query = "update alumno set direcc_alu=\"$direccionpad\",telefo_alu=\"$telefonopad\" where serial_alu=$serialalu";
			   $db->Execute($query);
			   $rs->MoveNext();
			}
		} 
	} 


	function actualizarPadreTodosHijos($conQuienVivepro,$serial_alu,$direccionpro,$telefonopro){
		include "bdd.inc";
		//consulto el padre del alumno
		$sql = "select padalu.serial_pad as serial_pad 
				from alumno as alu,padres_alumno as padalu,parentesco as paren
				where alu.serial_alu=$serial_alu and alu.serial_alu=padalu.serial_alu and padalu.serial_par=paren.serial_par and codigo_par='$conQuienVivepro'";
		$rs=$db->Execute($sql);
		$nr=$rs->RecordCount();
		if ($nr==1){
		   $serial_pad=$rs->fields['serial_pad'];
		   $query = "update padres set direccion_pad=\"$direccionpro\",telefono_pad=\"$telefonopro\" where serial_pad=$serial_pad";
		   $db->Execute($query);
		   //-----------consulta los hijos que viven con el padre/madre
		$sql = "select alu.serial_alu as serial_alu
				from alumno as alu,padres_alumno as padalu,parentesco as paren
				where padalu.serial_pad=$serial_pad and alu.serial_alu=padalu.serial_alu and paren.serial_par=padalu.serial_par and conQuienVive_alu='$conQuienVivepro' and codigo_par='$conQuienVivepro'";
		   
/*			$sql = "select alu.serial_alu as serial_alu
					from alumno as alu,padres_alumno as padalu
					where padalu.serial_pad=$serial_pad and alu.serial_alu=padalu.serial_alu and conQuienVive_alu='$conQuienVivepro'";*/
			$rs=$db->Execute($sql);
			$nr=$rs->RecordCount();
			if ($nr>0){
				while(!$rs->EOF){
				   $serialalu=$rs->fields['serial_alu'];
				   $query = "update alumno set direcc_alu=\"$direccionpro\",telefo_alu=\"$telefonopro\" where serial_alu=$serialalu";
				   $db->Execute($query);
				   $rs->MoveNext();
				}
			} 
		   //------------termina consulta los hijos que viven con el padre					   
		}//termina if ($nr==1)
	} 

/*    function mesLetras($aux){
		switch($aux){
		case '1': $aux='Enero'; break;
		case '2': $aux='Febrero'; break;
		case '3': $aux='Marzo'; break;
		case '4': $aux='Abril'; break;
		case '5': $aux='Mayo'; break;
		case '6': $aux='Junio'; break;
		case '7': $aux='Julio'; break;
		case '8': $aux='Agosto'; break;
		case '9': $aux='Septiembre'; break;
		case '10': $aux='Octubre'; break;
		case '11': $aux='Noviembre'; break;
		case '12': $aux='Diciembre'; break;
		}
    return($aux);
	}
*/	

function edadAnioMes($fnac,$factual){
   $fecAct=split("-",$factual);
   $fecIng=split("-",$fnac);
   $diaIng=$fecIng[2];
   $mesIng=$fecIng[1];
   $anioIng=$fecIng[0];      

   $diaAct=$fecAct[2];   
   $mesAct=$fecAct[1];   
   $anioAct=$fecAct[0];
            
   if ($diaIng>$diaAct){
     $diaAct+=30;
     $mesAct-=1;
   }
   $dias=$diaAct-$diaIng;
   
   if ($mesIng>$mesAct){
     $mesAct+=12;
     $anioAct-=1;
   }
   $meses=$mesAct-$mesIng;
   $anios=$anioAct-$anioIng;
   $edad=$anios.'.'.$meses;
  return($edad);
}
	
function numeroFolio($periodo){
   $pos=strrpos($periodo,'-');
   $pos+=2;
   $anio=substr($periodo,$pos);
   $anio=(int)$anio;
   $folio=sprintf("%05d",$anio);
   return ($folio);
}

function numeroMatricula($numero){
 $numMatricula=sprintf("%06d",$numero);										
 return ($numMatricula);
}
	
?>
