<?php
$ref="</a>";
$principal='';
$salir='';
$ayuda="<a href=\"#\" target=\"_blank\">";
if($_SESSION['codigoModuloBitacora']=='mod001'){
	$principal="<a href=\"../administrador.php\">";
	$salir="<a href=\"../administrador.php\">";	
}
else {	
	$principal="<a href=\"../modulos.php\">";
	$salir="<a href=\"../index.php\">";	
}

include_once('../seguridades/sVerificacionSubmodulos.php');

if(isset($HTTP_GET_VARS['codigoProcesoPerfil']))
{
  $codigo=$HTTP_GET_VARS['codigoProcesoPerfil']; 
}else
{  
	$codigo=$_SESSION['codigoProcesoPerfil'];
}
$rsaccion=sUsuariosPerfilSumodulosPorAccion($_SESSION['serial_usr'],$_SESSION['session_cco'],$codigo);
if($rsaccion!='') {
	$oknavegar=in_array("accnavegar",$rsaccion);
	$okinsertar=in_array("accinsertar",$rsaccion);
	$okguardar=in_array("accguardar",$rsaccion);
	$okeditar=in_array("acceditar",$rsaccion);
	$okeliminar=in_array("acceliminar",$rsaccion);
	$okcancelar=in_array("acccancelar",$rsaccion);
	$okbuscar=in_array("accbuscar",$rsaccion);
	$okimprimir=in_array("accimprimir",$rsaccion);
	$okayuda=in_array("accayuda",$rsaccion);
	$oksalir=in_array("accsalir",$rsaccion);
	$okprincipal=in_array("accinicio",$rsaccion);
	$okanular=in_array("accanular",$rsaccion);
}
//echo $_SESSION['codigoModuloBitacora'];
//$okprincipal="1";
//$principal="<a href=\"../modulos.php\">";
//$salir="<a href=\"../index.php\">";
if($_SESSION['codigoModuloBitacora'] == "mod001") {
	$principal="<a href=\"../administrador.php\">";
	$salir="<a href=\"../administrador.php\">";
}	
else {
	$principal="<a href=\"../modulos.php\">";
	$salir="<a href=\"../index.php\">";
}

?>
<table width="100%" height="37" border="0" cellpadding="0" cellspacing="0" background="../imagenes/interna_02.gif">
  <tr> 
    <td width="5%"> 
      <div align="center"></div></td>
    <td width="5%"> 
      <?php if(($inicio!='') and (!empty($oknavegar))) { ?>
      <div align="center"><? echo $inicio ?><img src="../imagenes/bot_inicio.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="6%"> 
      <?php if(($anterior!='') and (!empty($oknavegar))) { ?>
      <div align="center"><? echo $anterior ?><img src="../imagenes/bot_anterior.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="5%"> 
      <?php if(($siguiente!='') and (!empty($oknavegar))) { ?>
      <div align="center"><? echo $siguiente ?><img src="../imagenes/bot_siguiente.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="6%"> 
      <?php if(($ultimo!='') and (!empty($oknavegar))) { ?>
      <div align="center"><? echo $ultimo ?><img src="../imagenes/bot_ultimo.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="5%"> 
      <?php if(($insertar!='') and (!empty($okinsertar))) { ?>
      <div align="center"><? echo $insertar ?><img src="../imagenes/bot_insertar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="7%"> 
      <?php if(($guardar!='') and (!empty($okguardar))) { ?>
      <div align="center"><? echo $guardar ?><img src="../imagenes/bot_guardar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="5%"> 
      <?php if(($editar!='') and (!empty($okeditar))) { ?>
      <div align="center"><? echo $editar ?><img src="../imagenes/bot_editar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="5%"> 
      <?php if(($anular!='') and (!empty($okanular))) { ?><div align="center"><? echo $anular ?><img src="../imagenes/bot_anular.gif" width="50" height="33" border="0"><? echo $ref ?></div><? } ?></td>
    <td width="7%"> 
      <?php if(($eliminar!='') and (!empty($okeliminar))) { ?>
      <div align="center"><? echo $eliminar ?><img src="../imagenes/bot_eliminar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="7%"> 
      <?php if(($cancelar!='') and (!empty($okcancelar))) { ?>
      <div align="center"><? echo $cancelar ?><img src="../imagenes/bot_cancelar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="7%"> 
      <?php if(($buscar!='') and (!empty($okbuscar))) { ?>
      <div align="center"><? echo $buscar ?><img src="../imagenes/bot_buscar.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="6%"> 
      <?php if(($imprimir!='') and (!empty($okimprimir))) { ?>
      <div align="center"><? echo $imprimir ?><img src="../imagenes/bot_imprimir.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="6%"> 
      <?php if(($ayuda!='') and (!empty($okayuda))) { ?>
      <div align="center"><? echo $ayuda ?><img src="../imagenes/bot_ayuda.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="7%"> 
      <?php if(($salir!='') and (!empty($oksalir))) { ?>
      <div align="center"><? echo $salir ?><img src="../imagenes/bot_salir.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="6%"> 
      <?php if(($principal!='') and (!empty($okprincipal))) { ?>
      <div align="center"><? echo $principal ?><img src="../imagenes/bot_home.gif" width="53" height="22" border="0"><? echo $ref ?></div>
      <? } ?></td>
    <td width="10%"> 
      <div align="center"></div></td>
  </tr>
</table>