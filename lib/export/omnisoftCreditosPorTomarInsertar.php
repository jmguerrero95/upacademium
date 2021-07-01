
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
// $DBConnection="mysql://root:mysql@localhost/upacifico?persist";
$dblink = NewADOConnection($DBConnection);


/*EXTRAER VARIABLES*/
$serial_dcpt = $_GET['serial_dcpt'];


$creditoPorTomar ="SELECT
	dcpt.serial_dcpt,
	afavor_cpt,
	creditos_dcpt,
	dcpt.serial_mmat,
	nombre_ara,
	numero_caf ,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, nombre2_alu) as nombre,
	dcpt.fecha_dcpt,
	dcpt.observacion_dcpt, 
	caf.fecha_caf
FROM
	detallecreditoportomar  AS dcpt,
	cabeceracreditosportomar AS cpt,
	aranceles                AS ara,
	detallefactura           AS dfa,
	cabecerafactura          AS caf,
	alumno                   AS alu 
WHERE
	dcpt.serial_cpt=cpt.serial_cpt AND
	cpt.serial_ara=ara.serial_ara AND
	cpt.serial_dfa=dfa.serial_dfa AND
	dfa.serial_caf=caf.serial_caf AND
	caf.serial_alu=alu.serial_alu AND
	dcpt.serial_dcpt = ".$serial_dcpt;


//echo "<br>".$creditoPorTomar."<br>";

$rscreditoPorTomar = $dblink->Execute($creditoPorTomar);
$numAlum = $rscreditoPorTomar->recordCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<title></title>



	<script>
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true
		});
	});
	</script>


</head>
<body>

<table width="90%" align="center" border="1">
  <tr bgcolor="#FFFFFF">
    <td width="18%" rowspan="3" bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" /></td>    
	<th width="82%" colspan="4"><span class="style1">Créditos Debitados</span></th>	
  </tr>  
 
  <tr>
  <th width="18%"><span class="style1">Direccion</span></th>
  <th width="82%"><span class="style1">El Pinar Alto, calle B N48-177</span></th>
	
  </tr>  
  
  <tr>
   <th width="18%"><span class="style1">Teléfonos:</span></th>
   <th width="82%"><span class="style1">(02)2444509/(02)2444510</span></th>
	
  </tr>  
</table>


&nbsp;
 <table border="1" align="center" width="90%">	
  <tr>
      <th colspan="5">DATOS PERSONALES</th>     
  </tr>
	  
 <tr>
      <th  width="12%">Nombre: </th>
      <td  colspan="2"><?php echo $rscreditoPorTomar->fields['nombre'];?></td>        
	  
	  <th >Factura: </th>
      <td ><?php echo $rscreditoPorTomar->fields['numero_caf'];?></td>        
 </tr> 
 <tr>
          	  
	  <th >Fecha de Factura: </th>  
	  
      <td ><?php echo $rscreditoPorTomar->fields['fecha_caf'];?></td>    
	  <th  width="10%">Matricula: </th>
      <td colspan="2" ><?php echo $rscreditoPorTomar->fields['serial_mmat'];?></td>        
   </tr> 
 
   
 </table>
 
 
 
  &nbsp;
  <table  border="1"  align="center" width="90%">
	
	<tr>
      <th colspan="4">Créditos Descargados</th>     
    </tr>

    <tr>
      <th width="5%">No</th>
	  <th> Fecha </th>    
      <th> Detalle </th>        
	  <th> Cantidad </th>        
    </tr>

    <?php 
		
	$i=0;
	$rscreditoPorTomar->MoveFirst();
	if($rscreditoPorTomar->recordCount()>0){
	while(!$rscreditoPorTomar->EOF){
		
	?>	
	 <tr <?php echo $class;?>>
	 <?php $i++;?>
      	<th><?php echo $i;?></th>
		 <td><?php echo $rscreditoPorTomar->fields['fecha_dcpt'];?></td>	
      	<td><?php echo $rscreditoPorTomar->fields['nombre_ara'];?></td>		
		<td><?php echo $rscreditoPorTomar->fields['creditos_dcpt'];?></td>	
    </tr>		
		
	<tr>
      	<th colspan="3" align="right"  >Saldo</th>		
		<td><?php echo $rscreditoPorTomar->fields['afavor_cpt'];?></td>	
    </tr>			
	<?php	
			$obs = $rscreditoPorTomar->fields['observacion_dcpt'];
			$rscreditoPorTomar->MoveNext();			
		}
	?>				
		
	<?php
	}
	else
	echo "No se encontraron Alumnos";
	?>	
  </table>
&nbsp;
	Observaciones:
	<table  border="1"  align="center" width="90%">
		<tr>      	
		<td><?php echo $obs;?></td>	
    	</tr>
	</table>	
</body>
</html>





