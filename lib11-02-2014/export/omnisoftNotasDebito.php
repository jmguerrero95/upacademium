<!DOCTYPE html PUBLIC "-//W3C//Dth XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dth/xhtml1-transitional.dth">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FACTURA</title>
<style type="text/css">
<!--
INPUT.b 
{
	 FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; BACKGROUND-COLOR: #ffcc00; color:#CC0000; border-style:solid; border-color:#FFFFFF; font-style:italic;
}
th 
{
font-family:Arial;
font-size:11px;
color:#000000; 
}
th.r
{font-family: Arial;
font-size:11px;
color:#000000; 
text-align:right; 
}
@page 
{ 
   margin-left:2cm;
   margin-top:5.9cm;
   
}
#Layer1 {
	position:absolute;
	width:634px;
	height:92px;
	z-index:1;
	left: 15px;
	top: 330px;
}
#Layer2 {
	position:absolute;
	width:316px;
	height:100px;
	z-index:2;
	left: 337px;
	top: 512px;
}
-->
</style>
</head>


<body>
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
		require('numeroLetras.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 	 	 $numerofactura=$_GET['numerofactura'];
		 $serial_caf=$_GET['serial_caf'];
		//echo "provi:".$provision;
//echo "<H1 class='SaltoDePagina'></H1>";	
			$resultEmpresa=$dblink->Execute('select * from empresa');
			
			
$resultSede=$dblink->Execute('select * from cabecerafactura,alumno,sucursal,secuenciadocumentos
left join alumnomalla on alumno.serial_alu=alumnomalla.serial_alu
left join malla on alumnomalla.serial_maa=malla.serial_maa and serial_maa_p=0
where alumno.serial_alu=cabecerafactura.serial_alu and cabecerafactura.serial_caf='.$serial_caf.' and cabecerafactura.serial_suc=sucursal.serial_suc and sucursal.serial_suc=secuenciadocumentos.serial_suc');


//echo $sql;
  $resultSetFactura=$dblink->Execute('select serial_dfa, nombre_ara, cantidad_dfa,valor_aal,(cantidad_dfa*valor_aal) as subtotal, descuento_dfa,detallefactura.serial_caf, detallearancel.serial_dar,iva_ara from aranceles,detallearancel,detallefactura where detallearancel.serial_dar=detallefactura.serial_dar  and aranceles.serial_ara=detallearancel.serial_ara and detallefactura.serial_caf='.$serial_caf.' order by nombre_ara');
   
  //echo "echo".$resultSetFactura->RecordCount();
 	
 //$sub=$resultSetFactura->fields[4];	
 //echo "subbbbbbbbbb:". $sub; 
 
	$baseimponible=0;
	$descuentos=0;
//    $totalgeneral=0;
//	$subtotalgeneral=0;
$rsIngCaja=$dblink->Execute('select serial_cre,numero_cre from cabecerarecibo where serial_caf='.$serial_caf);
$numero_caja='';
  while(!$rsIngCaja->EOF){
  
  		$numero_caja=$numero_caja.$rsIngCaja->fields['numero_cre']." - ";
		
  	$rsIngCaja->MoveNext();
  }

		?>
<table width="642" height="300"  align="left"  >
 <!-- <tr bgcolor="#FFFFFF">
    <th width="191" bgcolor="#FFFFFF">&nbsp;</th>
    <th colspan="3" align="left" >&nbsp;</th>
  </tr>
  
  <tr>
    <th width="191" bgcolor="#FFFFFF">&nbsp;</th>
    <th width="199" height="23" align="left"  >&nbsp;</th>
    <th width="199" align="center" nowrap="nowrap"  >&nbsp;</th>
    <th align="center" >&nbsp;</th>
  </tr>
  --->
  <tr>
    <th width="191" height="112" bgcolor="#FFFFFF">&nbsp;</th>
    <th height="112" colspan="2" align="center"  >&nbsp;</th>
    <th width="60" height="112" align="left" >&nbsp;</th>
  </tr>
  
  <tr >
    <th height="180" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
          <tr>
            <th width="19%" height="15" align="left" valign="bottom" >&nbsp;</th>
            <th width="65%" height="0" align="left" valign="bottom" ><? echo $resultSede->fields['nombre_maa']; ?></th>
            <th width="16%" height="0" align="center" valign="bottom" >
			<? 
				$resultClienteUpac=$dblink->Execute("SELECT caf.serial_cliu, cliu.razonsocial_cliu FROM cabecerafactura as caf, cliente_upac as cliu WHERE caf.serial_cliu = cliu.serial_cliu and serial_caf = ".$serial_caf);
				
				if($resultClienteUpac->fields['serial_cliu'] > 0){
					echo '';	
				}else{
					echo $resultSede->fields['codigo_alu']; 
				}
				
			?></th>
          </tr>
          <tr>
            <th height="15" align="left" valign="bottom" >&nbsp;</th>
            <th height="0" align="left" valign="bottom" >
				<? 
					
//					echo "---".$serial_caf;
					if($resultClienteUpac->fields['serial_cliu'] > 0){
						echo $resultClienteUpac->fields['razonsocial_cliu'];
					}else{
						echo $resultSede->fields['cliente_caf']; 
					}
					
				?>			</th>
            <th height="0" align="center" valign="bottom" >
				<? 
					//ruc_cliu
					//echo $resultSede->fields['cedula_caf']; 
					
					if($resultClienteUpac->fields['serial_cliu'] > 0){
						echo $resultClienteUpac->fields['ruc_cliu'];
					}else{
						echo $resultSede->fields['codigoIdentificacion_alu']; 
					}
					
				?>
				</th>
          </tr>
          
          <tr>
            <th height="15" align="left" valign="bottom" >&nbsp;</th>
            <th height="0" align="left" valign="bottom" ><? echo $resultSede->fields['fecha_caf']; ?></th>
            <th height="0" align="center" valign="bottom" ><? echo "FAC: ".$resultSede->fields['numero_caf'];//$numero_caja; ?></th>
          </tr>
          <tr>
            <th height="15" align="left" valign="bottom" >&nbsp;</th>
            <th height="0" align="left" valign="bottom" ><? echo $resultSede->fields['direcciondomic_alu']; ?></th>
            <th height="0" align="center" valign="bottom" ><? echo $resultSede->fields['telefodomic_alu']; ?></th>
          </tr>
        </table></th>
      </tr>
     <tr>
        <th width="8%" height="30" >&nbsp;</th>
        <th width="51%" height="30" >&nbsp;</th>
        <th width="12%" height="30" >&nbsp;</th>
        <th width="13%" height="30" >&nbsp;</th>
        <th width="16%" height="30" >&nbsp;</th>
      </tr>
	  
	
      <? 
			  $cont=0;
			  while(!$resultSetFactura->EOF){
				   ?>
      <tr>
        <th align="left" >&nbsp;</th>
        <th height="20" align="left" ><? echo $resultSetFactura->fields['nombre_ara']; ?></th>
        <th height="20"  align="right"><? echo $resultSetFactura->fields['cantidad_dfa']; ?></th>
        <th height="20" align="right" ><? echo number_format($resultSetFactura->fields['valor_aal'],2); ?></th>
        <th height="20" align="right" ><? echo number_format($resultSetFactura->fields[4],2); ?></th>
      </tr>
      <?
			  $totalgeneral+=$resultSetFactura->fields[4];
			  $subtotalgeneral+=$resultSetFactura->fields[4];
		
		 		$baseimponible+=$resultSetFactura->fields[4];
				//echo "base:".$baseimponible;
				$descuentos+=$resultSetFactura->fields['descuento_dfa'];
			 
			$cont++;
			$resultSetFactura->MoveNext();
    	}
		//$total=number_format($baseimponible+$descuentos,2);
		$total=$baseimponible+$descuentos;
			while($cont<=11){
			  ?>
      <tr>
        <th align="left" >&nbsp;</th>
        <th height="20" align="left" >&nbsp;</th>
        <th height="20" >&nbsp;</th>
        <th height="20" >&nbsp;</th>
        <th height="20" >&nbsp;</th>
      </tr>
      <? $cont++; }?>
    </table></th>
  </tr>
</table>

<div id="Layer1">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
   <!-- <tr>
      <th height="30" colspan="2" align="left" valign="top" >&nbsp;</th>
      <th width="14%" height="30">&nbsp;</th>
      <th width="13%" height="30" align="left" >&nbsp;</th>
      <th width="13%" height="30" align="right" valign="bottom" >-</th>
    </tr>
-->	
    <tr>
      <th height="0" colspan="2" rowspan="4" align="left" valign="top" >&nbsp;
        <?  echo numerosDecimal($total);?>
USD</th>
      <th height="18">&nbsp;</th>
      <th height="0" align="left" >&nbsp;</th>
      <th height="0" align="right" valign="bottom" ><? echo number_format($baseimponible,2); ?></th>
    </tr>
    <tr>
      <th height="18">&nbsp;</th>
      <th height="0" align="left" >&nbsp;</th>
      <th height="0" align="right" valign="bottom" ><? echo "0";//number_format($descuentos,2); ?></th>
    </tr>
    <tr>
      <th height="18">&nbsp;</th>
      <th height="0" align="left" >&nbsp;</th>
      <th height="0" align="right" valign="bottom" ><? echo "0";//number_format(-1*$total,2); ?></th>
    </tr>
   
    <tr>
      <th height="18">&nbsp;</th>
      <th height="0" align="left" >&nbsp;</th>
      <th height="0" align="right" valign="bottom" ><? echo number_format($total,2); ?></th>
    </tr>
  </table>
</div>
<!--<div id="Layer2">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <th width="72%" height="0" align="left">&nbsp;</th>
      <th width="28%" height="0" align="right" valign="bottom"><? //echo number_format(-1*$total,2); ?></th>
    </tr>
    <tr>
      <th height="0" align="left">&nbsp;</th>
      <th height="0" align="right" valign="bottom"></th>
    </tr>
    <tr>
      <th height="0" align="left">&nbsp;</th>
      <th height="0" align="right" valign="bottom"></th>
    </tr>
  </table>
</div>
-->
</body>
</html>