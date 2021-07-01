<?php
  session_start();
  include_once "../parametros/sEmpresa.php";
  include_once "../parametros/sAgencia.php";
  $rsEmpresa=sConsultarEmpresa();
  $nombre_emp=$rsEmpresa->fields[0];
  $direccion_emp=$rsEmpresa->fields[4];
  $telefono_emp=$rsEmpresa->fields[5];
  $email_emp=$rsEmpresa->fields[6];  

?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
  <tr> 
    <td width="15%" height="48" rowspan="6"><img src="../imagenes/colegio.jpg" width="220" height="48"></td>
    <td width="69%" height="50"><p align="center"><strong><font color="#000000" size="4" face="Verdana, Arial, Helvetica, sans-serif"><?php echo strtoupper($nombre_emp) ?></font></strong></p></td>
    <td width="116" rowspan="6">&nbsp;</td>
  </tr>
  <tr> 
    <td><div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        TEL&Eacute;FONO: <?php echo $telefono_emp ?></font></div></td>
  </tr>
  <?php 
  if ($email_emp!=''){ 
  ?>
  <tr> 
    <td><div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        E-MAIL: <?php echo $email_emp ?> </font></div></td>
  </tr>
  <?php }
  if ($direccion_emp!=''){
  ?>
  <tr>
    <td height="7"><div align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">DIRECCI&Oacute;N: 
	<?php echo $direccion_emp ?></font></div></td>
  </tr>
  <?php }?>
  <tr>
    <td height="15" align="center"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">Quito-Ecuador </font></td>
  </tr>
  <tr> 
    <td height="15" align="center"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php $rs_ageCR=sConsultarAgenciaXSerial($_SESSION['session_cco']); echo "<b>".$rs_ageCR->fields['descripcion_age']."</b>";?></font></td>
  </tr>
  <tr> 
    <td height="20" colspan="3"> <div align="center"></div></td>
  </tr>
</table>
