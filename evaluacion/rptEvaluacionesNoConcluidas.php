<?php
require('../lib/adodb/adodb.inc.php');
require('../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//$serial_alu = $_GET['serial_alu'];
$sqlEva = "
SELECT
	COUNT(serial_ceva) AS num
FROM
	cabecera_evaluacion 
WHERE
	serial_ceva NOT IN (SELECT
							serial_ceva 
						FROM
							detalle_evaluacion
	)
";
$arrEva = $dblink->GetAll($sqlEva);
$numReg = count($arrEva);

?>

<HTML>
<HEAD>
<TITLE>INGENIUM::ERP::ENTERPRISE RESOURCE PLANNING</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<style> body, html {margin:0px; padding: 0px; overflow: hidden;} </style>
<script>
var useBSNns = true;

$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);


window.status='Diseñado y Desarrollado por Omnisoft Cia Ltda http://www.omnisoft.cc';
</script>

<link href='../lib/autosuggest2/css/autosuggest_inquisitor.css' rel="stylesheet" type="text/css">

<script language="javascript" src= "../lib/tools/cookies.js" ></script>
<script language='javascript' src="../lib/tools/omnisoftTools.js"></script>
<script language='javascript' src="../lib/tools/omnisoftMenu.js"></script>
<script language="javascript" src= "../lib/aw/lib/aw.js" ></script>
<link href="../lib/styles/omnisoft.css" rel="stylesheet" type="text/css">
<link href="../lib/tools/omnisoftValidar.css" rel="stylesheet" type="text/css">
<link href="../lib/zpmenu/themes/images.css" rel="stylesheet" type="text/css">
<link href="../lib/grid/styles/omnisoftGrid.css" rel="stylesheet" type="text/css">

<script language='javascript' src="../lib/tools/omnisoftValidar.js"></script>
<script language="javascript" src="../lib/mask/event-listener.js"></script>
<script language="javascript" src="../lib/mask/masked-input.js"></script>
<script language="javascript" src="../lib/mask/enter-as-tab.js"></script>
<script language="javascript" src="../lib/mask/auto-tab.js"></script>

<script language='javascript' src="../lib/grid/omnisoftDB.js"></script>
<script language='javascript' src="../lib/combo/omnisoftComboBox.js"></script>

<script language="javascript1.2" src="../lib/zpmenu/utils/utils.js"></script>
<script language="javascript1.2" src="../lib/zpmenu/src/menu.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="../lib/jscalendar/calendar-blue2.css" title="win2k-cold-1" />
  <script type="text/javascript" src="../lib/jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../lib/jscalendar/lang/calendar-en.js"></script>
  <script type="text/javascript" src="../lib/jscalendar/calendar-setup.js"></script>

<script language="javascript" src="../lib/autosuggest2/js/bsn.AutoSuggest_2.1_comp_grid.js"> </script>
<script language="javascript" src="../lib/autosuggest2/js/bsn.AutoSuggest_2.1_comp.js"> </script>
<script language="javascript" src= "../lib/grid/omnisoftGrid.js" ></script>
<script>

function procesarConsulta() {

	 var query='../lib/export/omnisoftBorrarEvaluacionNoConcluida.php';
       var attributes='width=1020,height=700,scrollbars=yes,resizable=yes,toolbar=yes,location=yes,status=yes,menubar=no';
           omnisoftNewWindow=window.open(query,'OmnisoftEstudiante',attributes);
           if (window.focus) {omnisoftNewWindow.focus()}

}

</script>
</head>




<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</HEAD>
<script> window.status='Diseñado y Desarrollado por Omnisoft Cia Ltda http://www.omnisoft.cc';</script>
<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="100%" height="541" border="0" cellpadding="0" cellspacing="0" >
  <tr>
      <td height="541" valign="top">

  	  </td>
    <td height="541" valign="top">
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>            <td> <div align="right">
                <table width="100%" height="45" border="0" cellpadding="0" cellspacing="0" class="maintoptitle" >
                  <tr valign="top">
                    <td width="222" height="45" valign="bottom" class="ingeniumtoptitle"></td>                    <td width="482"  class="toptitle" > <center>
MODULO
                        DE EVALUACIONES<br>
                        REPORTES<br>
						EVALUACIONES NO CONCLUIDAS 
                    </center></td>
					
                    <td width="40" valign="bottom" ><img id="imgFoto" src="../fotos/foto.jpg" width="37" height="45"></td>
                     <td width="169"  valign="middle" class="toptitle">
                                        <script>document.write(getCookie('nombre_usr')+' '+getCookie('apellido_usr')); </script></td>
                    <td width="128" class="logotoptitle"></td>

                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="../images/ind_01_back.jpg" width="100%" height="7"></td>
                  </tr>
                </table>
              </div></td>
          </tr>
          <tr>  <td height="20" class="menuborder" >
		<ul id="myMenu" class='zpHideOnLoad'>            </ul>        <script>
              OmnisoftPerfilUsuario(moduloEvaluacion);
            </script></td>

          </tr>
          <tr>            
		  <td height="412" valign="top" >
			<div align="center">
                <table  width="100%" height="467"  border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000"class="formtable">
                  <tr>
                    <td height="465" colspan="2" class="inputtitle" >
					
					<table align="center"  height="71" >
                      <tr>
                        <td width="209" height="17"  class="inputtitle">No. de evaluaciones no concluidas :</td>
                        <td width="248"><input type="text" size="15" name="textfield" value="<?php echo $arrEva[0]['num'];?>"></td>                        
                      </tr>
                      
					  <tr>
                        <td height="18"  class="inputtitle">&nbsp;</td>
                        <td> 					 </td>                                              
                       </tr>
					   

                      <tr>					 </tr>
					 </table>
					 
					 <table align="center" >
					 <tr>
                        <td height="34"  class="inputtitle">
						<?php 
							if($arrEva[0]['num']>0){
								$show = "<a href='#' onClick='procesarConsulta()'><img src='../images/buscar.png' alt='Procesar Encuesta' width='64' height='64' border='0'></a>";
								echo $show;							
							}
						?></td>
						<td height="34"  class="inputtitle"><a href="../modulos/modulos.html" ><img src="../images/home.png" alt="Inicio" width="64" height="64" border="0"></a></td>                        
                        
                      </tr>
                    </table>
			</td>
		</tr>
		</table>
		</div>
		</td>
	</tr>
	</table>
	</div>
	</td>
</tr>
</table>
<table width="100%" height="58"  cellpadding="0" cellspacing="0" >
<tr>
<td class="menuborder"> </td>
</tr>
</table>
</form>
</body>
<script>
//	omnisoftLoadData(document.PaginaDatos);
//	OmnisoftPerfilUsuarioFormulario();
</script>

</BODY>

</HTML>

