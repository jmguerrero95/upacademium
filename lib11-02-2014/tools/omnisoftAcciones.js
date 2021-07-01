
var omnisoftNewWindow;

function omnisoftPopUpWindow(sName,sUrl,sWidth,sHeight,sScrollBar,sResizable)
{

  var attributes='';


     attributes=attributes.concat('width=',sWidth,',height=',sHeight,',scrollbars=',sScrollBar,',resizable=',sResizable,',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no');
      omnisoftNewWindow=window.open(sUrl,sName,attributes);
      if (window.focus) {omnisoftNewWindow.focus()}
}

function omnisoftPopUpXYWindow(sName,sUrl,sLeft,sTop,sWidth,sHeight,sScrollBar,sResizable)
{
  var attributes='';
      attributes=attributes.concat('left=',sLeft,',top=',sTop,',width=',sWidth,',height=',sHeight,',scrollbars=',sScrollBar,',resizable=',sResizable,',toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,copyhistory=no,statusbar=no');
      omnisoftNewWindow=window.open(sUrl,sName,attributes);
      if (window.focus) {omnisoftNewWindow.focus()}
}


function OmnisoftInsertarFila(pFormName,xwidth,yheight,scrollBar)
{
 pFormName=pFormName.concat('?dummy=0&action=insert&table=',gridTable);
 if (scrollBar!='yes')
 omnisoftPopUpXYWindow('insertWindow',pFormName,'0','0',xwidth,yheight,'no','no');
 else
 omnisoftPopUpXYWindow('insertWindow',pFormName,'0','0',xwidth,yheight,'yes','no');
}

function OmnisoftEditarFila(pFormName,xwidth,yheight,scrollBar)
{
 var rownum=parseInt(gridObj.getProperty("selection/index"));
 var i=0;

 if (rownum<0)
     alert('Por favor, seleccione una fila para editarla');
  else  {

  pFormName=pFormName.concat('?dummy=0&action=edit&table=',gridTable,'&key=',gridKey);


   for(i=0; i< columnCount ; i++)
     pFormName=pFormName.concat('&',gridDataColumns[i]['physicalColumnName'],'=',dataGrid[rownum][i]);

 if (scrollBar!='yes')
  omnisoftPopUpXYWindow('editWindow',pFormName,'0','0',xwidth,yheight,'no','no');
 else
    omnisoftPopXYUpWindow('editWindow',pFormName,'0','0',xwidth,yheight,'yes','no');

  }
 }

function actualizarPassword(data) {
if (data.length <=0)
   alert('La clave ha sido reseteada, el usuario recibira un correo con la nueva clave');

}

function OmnisoftResetearPassword(pFormName,xwidth,yheight,scrollBar)
{
  var rownum=parseInt(gridObj.getProperty("selection/index"));
  var i=0;
  var serial_eje=0;
  var nuevoPassword;
  var usuario= getCookie('usuario');
    if (rownum < 0)
       alert('Por favor, seleccione un Usuario para resetear el password');
    else {

           if (dataGrid[rownum][1]=='bloquear'){
             alert('Advertencia: '+dataGrid[rownum][3]+' '+dataGrid[rownum][4]+' esta bloqueado, activelo para resetear el password');
            return;
           }
           serial_eje=dataGrid[rownum][0];
           nuevoPassword= omnisoftGeneraPassword();


   jsrsExecute('lib/jsrs/jsrsOmnisoftGridServer.php', actualizarPassword,'omnisoftChangePassword',Array('mysql://root:mysql@localhost/movistar?persist',"update usuario set clave_eje=substring(md5('"+nuevoPassword+"'),1,10) where serial_eje="+serial_eje,nuevoPassword,serial_eje,usuario,'S'));


    }
}

function OmnisoftBuscar(pFormName)
  {
      doFilter();
  }

  function OmnisoftEliminarFila()
{

   omnisoftDeleteRow();
  }

function OmnisoftGraficar(pFormName)
{
 omnisoftPopUpWindow('graphWindow',pFormName,630,520,'no','no');

}

function OmnisoftExcel(pFormName)
{
 omnisoftPopUpWindow('excelWindow',pFormName,980,700,'no','no');

}

function OmnisoftImprimir(pFormName,xwidth,yheight)
{

 if (window.screen) {
 xwidth=window.screen.availWidth;
 yheight=window.screen.availHeight;

 }
 omnisoftPopUpWindow('printWindow',pFormName,xwidth,yheight,'yes','yes');

}

function OmnisoftAcercaDe(pFormName,xwidth,yheight)
{
 omnisoftPopUpWindow('aboutWindow',pFormName,xwidth,yheight,'no','no');

}


function OmnisoftGenerarXML()
{
 omnisoftPopUpWindow('xmlWindow','omnisoftFileDialog.html',550,190,'no','no');

}

function OmnisoftSeguridades(usuario,password,confirmacion) {


}
