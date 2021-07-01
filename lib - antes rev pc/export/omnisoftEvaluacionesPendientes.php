

<link rel="stylesheet" type="text/css" href="../styles/chrome.css">
<?php

//        require('omnisoftPDFIndividualMallas.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');

		/*$sql=str_replace("\"", "'",$_GET['query']);
		$sql=str_replace("\'", "'",$sql);
		$sql=str_replace("\x5C", "\x5C\x5C",$sql);*/

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
 		$serial_alu=$_GET['serial_alu'];
		//echo($serial_maa);

$result=$dblink->Execute('select serial_dmat,nombre_per, nombre_mat from detallemateriamatriculada,materiamatriculada,materia,periodo
where 
materiamatriculada.serial_mmat=detallemateriamatriculada.serial_mmat
and detallemateriamatriculada.serial_mat=materia.serial_mat
and materiamatriculada.SERIAL_PER=periodo.serial_per
and materiamatriculada.serial_alu='.$serial_alu.'
and detallemateriamatriculada.serial_dmat not in (select serial_dmat from cabecera_evaluacion  where SERIAL_TEVA=1)
order by fecini_per desc,nombre_mat asc');
?>
<style type="text/css">
<!--
.style4 {
	font-size: 10px;
	font-family: Arial, Helvetica, sans-serif;
}

-->
</style>
<title>Evaluciones Pendientes</title><table width="100%">
  <tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF"><img src="../../images/themes/csg/logo.jpg" width="231" height="81" />
      <table width="100%" border="1">
        <tr>
          <td >PERIODO</td>
          <td>MATERIA</td>
        </tr>
        <? while (!$result->EOF)
	  {
		?>
        <tr>
          <td class="style4" nowrap><? echo $result->fields['nombre_per']; ?></td>
          <td class="style4" nowrap><? echo $result->fields['nombre_mat']; ?></td>
          <? 
		$result->MoveNext();
		?>
        </tr>
        <?
	  }
	?>
      </table></td>
  </tr>
</table>
<br />
<br />
