<?php
include "../config/bdd.inc";
$speriodo = $HTTP_COOKIE_VARS["speriodo"];
$sql="select nombre_per from periodo where serial_per=$speriodo";
//print"$sql";
$rs = $db->Execute($sql);
$nombre_periodo=$rs->fields['nombre_per'];
?>
<table width="65%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#999999">
  <tr> 
    <td width="1" height="104" rowspan="5">&nbsp;</td>
    <td width="597" height="50"><table width="107%" height="72" border="0" align="center">
        <tr> 
          <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="6"> 
              The British School</font></strong></font></div></td>
        </tr>
        <tr> 
          <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><strong><font color="#000000" size="2">Quito-Ecuador</font></strong></font></div></td>
        </tr>
        <tr> 
          <td height="21"><div align="center"><font color="#000000" size="3" face="Verdana, Arial, Helvetica, sans-serif">A&ntilde;o 
              lectivo:<?php echo $nombre_periodo?> </font></font></div></td>
        </tr>
      </table></td>
    <td width="1" rowspan="5">&nbsp;</td>
  </tr>
  <tr> 
    <td><font color="#FFFFFF">&nbsp;</font>
<div align="center"> 
        <table width="98%" border="0">
          <tr> 
            
          </tr>
        </table>
      </div></td>
  </tr>
  
</table>
<table width="75%" border="0" align="center">
  <tr>
  <hr>
  </tr>
  <tr> 
    <td width="50%"><?php echo "".letra1."" ?>Direccion: <?php echo $DIRECCION?>&nbsp;</td>
    <td width="19%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td width="31%"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo "".letra1."" ?>Casilla: 
      <?php echo $CASILLA?> </font></td>
  </tr>
  <tr> 
    <td><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo "".letra1."" ?>Telefonos: <?php echo $TELEFONO?></font></td>
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo "".letra1."" ?>Fax: <?php echo $FAX?></font></td>
  </tr>
  <tr> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo "".letra1."" ?>E-Mail: <?php echo $EMAIL?></font></td>
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; </font></td>
  </tr>
</table>
<table width="75%" border="0" align="center">
  <tr>
  <hr>
  </tr>
</table>
<p align="center">&nbsp;</p>
