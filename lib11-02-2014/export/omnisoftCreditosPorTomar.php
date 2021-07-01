
<?php
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
// $DBConnection="mysql://root:mysql@localhost/upacifico?persist";
$dblink = NewADOConnection($DBConnection);


/*EXTRAER VARIABLES*/
$serial_cpt = $_GET['serial_cpt'];


$creditoPorTomar ="SELECT
	dcpt.serial_dcpt,
	afavor_cpt,
	creditos_dcpt,
	observaciones_cpt,
	dcpt.serial_mmat,
	nombre_ara,
	numero_caf ,
	concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu, nombre2_alu) as nombre,
	dcpt.fecha_dcpt,codigoIdentificacion_alu,NOMBRE_SUC
FROM
	detallecreditoportomar  AS dcpt,
	cabeceracreditosportomar AS cpt,
	aranceles                AS ara,
	detallefactura           AS dfa,
	cabecerafactura          AS caf,
	alumno                   AS alu,
	sucursal 				 as suc 
WHERE
	dcpt.serial_cpt=cpt.serial_cpt AND
	cpt.serial_ara=ara.serial_ara AND
	cpt.serial_dfa=dfa.serial_dfa AND
	dfa.serial_caf=caf.serial_caf AND
	caf.serial_alu=alu.serial_alu AND
	alu.serial_suc=suc.SERIAL_SUC and 
	cpt.serial_cpt = ".$serial_cpt;


echo "<br>".$creditoPorTomar."<br>";

$rscreditoPorTomar = $dblink->Execute($creditoPorTomar);
$numAlum = $rscreditoPorTomar->recordCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

<div id="content">
<div id="itsthetable">
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

 <p>&nbsp;</p>
&nbsp;
<table border="1" align="center" width="90%">	
	
    <tr>
      <td scope="col" width="10%">Nombre: </td>
      <td scope="col"><?php echo $rscreditoPorTomar->fields['nombre'];?></td>
      <th scope="col">Factura: </th>
      <td scope="col"><?php echo $rscreditoPorTomar->fields['numero_caf'];?></td>	  
    </tr>
	
	
	<tr>
      <td scope="col" width="10%">Identificación: </td>
      <td scope="col"><?php echo $rscreditoPorTomar->fields['codigoIdentificacion_alu'];?></td>
	   <td scope="col" width="10%">Sede: </td>
      <td scope="col"><?php echo $rscreditoPorTomar->fields['NOMBRE_SUC'];?></td>
	        
    </tr>
	
</table>    

&nbsp;
<table border="1" align="center" width="90%">	  
    <tr>
      <th>No</th>
	  <th>Matricula</th>
  	  <th>Fecha</th>        
      <th>Detalle</th>        
	  <th>Cantidad</th>        
    </tr>
    <?php 
		
	$i=0;
	$total=0;
	$rscreditoPorTomar->MoveFirst();
	if($rscreditoPorTomar->recordCount()>0){
	while(!$rscreditoPorTomar->EOF){
	$i++;
	?>	
	 <tr>
      	<th><?php echo $i;?></th>
		<td ><?php echo $rscreditoPorTomar->fields['serial_mmat'];?></td>
      	<td ><?php echo $rscreditoPorTomar->fields['fecha_dcpt'];?></td>
		<td ><?php echo $rscreditoPorTomar->fields['nombre_ara'];?></td>
		<td align="right" ><?php echo $rscreditoPorTomar->fields['creditos_dcpt'];?></td>
		
    </tr>
	
	<?php
			$total=	$total + $rscreditoPorTomar->fields['creditos_dcpt'];
			$afavor=$rscreditoPorTomar->fields['afavor_cpt'];
			if($rscreditoPorTomar->fields['observaciones_cpt']<>'')
			{$observaciones=$rscreditoPorTomar->fields['observaciones_cpt'];}
			
			$rscreditoPorTomar->MoveNext();
			
		}
		?>
		<tr>
		<th colspan="4" align="right">Total</th>
		<th align="right"><?php echo $total;?></th>
		</tr>
		<tr>
		<th colspan="4" align="right">Saldo</th>
		
		<th align="right"><?php echo $afavor;?></th>
		</tr>
	<?php 	
	}
	else
	echo "No se encontraron Alumnos";
	?>	
  </table>
  <?php
  echo "Los Siguientes Creditos fueron acreditados al saldo: <br>";
  //if (!empty($rscreditoPorTomar->fields['observaciones_cpt']));
  //$datos = explode("|",$rscreditoPorTomar->fields['observaciones_cpt']);
  echo $rscreditoPorTomar->fields['observaciones_cpt'];
  $pizza  = $observaciones;
//echo  $pizza;
$pieces = explode("|",$pizza);
for($i=0;$pieces[$i];$i++) 
      echo $pieces[$i],"<br>";
    ?>
</div>
</div>
</body>
</html>




