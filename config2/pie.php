<?php
print"<br><table width=95% border=1 cellspacing=0 cellpadding=0 align=center bordercolordark=#FFFFFF bordercolorlight=#000000><tr>
          <td height=64>
            <div align=center>$LETRA<font size=1><br><br><b>PREPARADO</b></font></div>
          </td>
          <td height=64>
            <div align=center>$LETRA<font size=1><br><br><b>REVISADO</b></font></div>
          </td>
          <td height=64>
            <div align=center>$LETRA<font size=1><br><br><b>AUTORIZADO</b></font></div>
          </td>
          <td height=64>
            <div align=center>$LETRA<font size=1><br><br><b>CONTROL INTERNO</b></font></div>
          </td>";

 print"</tr></table>";
  print "<br><center><table border=1 cellspacing=0 cellpadding=0 bordercolorlight=#OOOOOO bordercolordark=#FFFFFF width=95%><tr><td>";
  print "<table width=95%>";
  print "<tr><td><font color=$coltex_dertab face=$letra size=1>&nbsp;&nbsp;Impreso:".date(Y)."-".date(m)."-".date(d)."</font></td></tr>";
  print "</table>";
  print "</td></tr></table></center>";
?>