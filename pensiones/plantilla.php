<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<link  href="Css/estilo.css" rel="stylesheet" type="text/css"/>
<body>
	<div id="contenedor">
		<div id="header">
		  <?php
		echo $document.PaginaDatos.nombre.value;
		?>
		</div>
		<div id="main">
		<form method="POST" enctype="multipart/form-data"  name="PaginaDatos" onClick="highlight(event)" onKeyUp="highlight(event)">
			<table width="940" height="49" border="1" cellpadding="0" cellspacing="0"  bordercolordark="#FFFFFF" bordercolorlight="#000000" class="formtable">
			<td width="119" height="24"  class="inputtitle">Fecha :</td>
            <td width="91"><input name="fecha_caf" type="text" id="fecha_caf" class="date" size="10" maxlength="10"  onBlur="esconderToolTip()" ></td>
            <td width="112" class="inputtitle"><input type="radio" name="seleccion" value="alumno" checked="checked" onClick="deshabilitar()"> Alumno:</td>
            <td width="141"class="inputtitle"><input type="radio" name="seleccion" value="cliente" onClick="deshabilitar()"> Cliente</td>
            <td width="107" class="inputtitle">Numero Factura :</td><td width="185" class="inputtitle">
			<input name="numero_caf" type="text" id="numero_caf" class="integer" size="17" maxlength="15"  onBlur="esconderToolTip()" tipo="FAC"></td>
            <td width="147" rowspan="2" class="inputtitle"><div align="center"><span id="spanTotal" class="totales">0.00 </span></div>            </td>
            <td width="1" class="inputtitle"></td>
          </tr>
		  <tr> <td height="22" class="inputtitle">Cliente</td>
		  		<td><input name="nombre1_alu" type="text" id="nombre1_alu"  size="20" maxlength="20"  onBlur="esconderToolTip()" readonly="yes">
			    <td> <input name="codigo_alu" type="text" id="codigo_alu"  size="10" maxlength="20"  onBlur="esconderToolTip()" readonly="yes">
				<td class="inputtitle">Programa:</td>
            	<td class="inputtitle"><input name="nombre_sec" type="text" id="nombre_sec"  size="25" maxlength="25"  onBlur="esconderToolTip()" ></td>
            	<td class="inputtitle"></td>
          </tr>
		  <tr>
                 <td height="22" class="inputtitle">Representante</td> <td height="22" colspan="3"><span class="inputtitle">                                  
                   <input name="cliente_caf" type="text" id="cliente_caf"  size="70" maxlength="50"  onBlur="esconderToolTip();ValidaDatosCliente(document.PaginaDatos.codigo_alu.value);"></span></td>
                 <td height="22" class="inputtitle">C&eacute;dula/RUC:</td> <td height="22" colspan="2"><span class="inputtitle">
                   <input name="cedula_caf" type="text" id="cedula_caf"  size="20" maxlength="20"  onBlur="esconderToolTip();ValidaDatosCliente(document.PaginaDatos.codigo_alu.value);" > </span>               
                 <td height="22"></td>
          </tr>
          <tr>  <td height="22"class="inputtitle">Departamento: </td> <td height="22" class="inputtitle">Malla:</td> <td height="22" colspan="2">
                <span class="inputtitle"> <input name="nombre_maa" type="text" id="nombre_maa"  size="40" maxlength="40"  onBlur="esconderToolTip()" readonly="yes"> </span>
                <td height="22"></td>
          </tr>
          <tr><td height="22" class="inputtitle">No de Matricula:</td><td colspan="3">
			 	<input type="text" name="serial_mmat" id="serial_mmat" size="9" class="integer"><span height="22" class="inputtitle"> Cr?ditos: </span>
		 	    <input type="text" name="creditos"  id="creditos" onBlur="esconderToolTip()" size="3" readonly="yes"></td>	
			    <td height="22" class="inputtitle">Observaciones:</td><td height="22" colspan="2">
              <input name="observaciones_caf" type="text" id="observaciones_caf" class="emptytext" size="70" maxlength="200"  onBlur="esconderToolTip()"  >
             <td height="22"></td>
          </tr>
		  <tr>	 <td height="22" class="inputtitle">Notas de Cr?dito: </td><td height="22" colspan="3">
			<td height="22" class="inputtitle">Estado: </td> <td height="22" colspan="3"><img  src="../images/camporequerido.gif" alt="">
              <select name="estado_caf" id="estado_caf" class="combobox"><option value="FACTURADO" selected="selected">FACTURADO</option>
                <option value="PAGADO">PAGADO</option> <option value="ANULADO">ANULADO</option> </select> </td>
		  </tr>
		  <tr> <td height="25" colspan=8>
			</td>
          </tr>
		</table>
	      </form>
			
		</div>
		<div id="centro">
			<table class="tabla">
			<tr>
			<th>No.</th>
			<th>Arancel</th>
			<th>Cantidad</th>
			<th>Valor</th>
			<th>Descuento</th>
			<th>Subtotal</th>
			<tr><td>ddfholaa</td>
		</table>
		</div>
		<div id="foot">
		</div>
	
	</div>

</body>
</html>