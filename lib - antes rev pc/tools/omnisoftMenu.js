var moduloContabilidad=1;
var moduloInventarios=2;
var moduloEvaluacion=3;
var moduloRRHH=4;
var moduloPensiones=5;
var moduloSistema=6;
var moduloAcademico=8;
var moduloAdmisiones=7;
var moduloMantenimiento=11;
var moduloActivosFijos=9;
var moduloAdquisiciones=10;


var curModulo="";



function node(type){return document.createElement(type)};
function text(value){return document.createTextNode(value)};

function addOption(name,url,iconUrl)  {

    var containerElement=node('a');

        containerElement.setAttribute("href",url);

        if (iconUrl)   {
            var img=node('img');

           img.setAttribute("src",iconUrl)
           img.setAttribute("border",0);
           containerElement.appendChild(img);
        }
        containerElement.appendChild(text(name));
        containerElement.appendChild(text('  '));
     var liObject=node('li');
         liObject.appendChild(containerElement);
     return liObject;

}
function omnisoftLoadAcciones(data) {
 omnisoftLoadAccion(data);
setCookie('acciones',data);
}

function omnisoftLoadAccion(data)
{
 var acciones=data.split('|')[1].split('~');
 var elemento;
 if (acciones[1]=='SI') {
    elemento=document.getElementById('divInsertar');
    if (elemento!=undefined)
    elemento.style.visibility='visible';
 }

 if (acciones[2]=='SI') {
    elemento=document.getElementById('divEditar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

  if (acciones[3]=='SI') {
    elemento=document.getElementById('divBuscar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

  if (acciones[4]=='SI') {
    elemento=document.getElementById('divEliminar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[5]=='SI') {
    elemento=document.getElementById('divCorreo');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[6]=='SI') {
    elemento=document.getElementById('divGraficar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[7]=='SI') {
    elemento=document.getElementById('divImprimir');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[8]=='SI') {
    elemento=document.getElementById('divAyuda');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

    if (acciones[9]=='SI') {
    elemento=document.getElementById('divAcerca');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[10]=='SI') {
    elemento=document.getElementById('divSalir');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
   if (acciones[11]=='SI') {
    elemento=document.getElementById('divHome');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[12]=='SI') {
    elemento=document.getElementById('divInicio');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[13]=='SI') {
    elemento=document.getElementById('divAnterior');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

   if (acciones[14]=='SI') {
    elemento=document.getElementById('divSiguiente');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

    if (acciones[15]=='SI') {
    elemento=document.getElementById('divFin');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }

    if (acciones[16]=='SI') {
    elemento=document.getElementById('divExcel');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
    if (acciones[17]=='SI') {
    elemento=document.getElementById('divXML');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
  if (acciones[18]=='NO') {
    elemento=document.getElementById('divFiltro');
    if (elemento!=undefined)

    elemento.style.visibility='hidden';
 }
  if (acciones[19]=='SI') {
    elemento=document.getElementById('divGuardar');
    if (elemento!=undefined) {
    elemento.style.visibility='visible';
    }
 }
  if (acciones[20]=='SI') {
    elemento=document.getElementById('divCancelar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
  if (acciones[21]=='SI') {
    elemento=document.getElementById('divNavegar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
    if (acciones[22]=='SI') {
    elemento=document.getElementById('divAprobar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
    if (acciones[23]=='SI') {
    elemento=document.getElementById('divCupo');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
    if (acciones[24]=='SI') {
    elemento=document.getElementById('divAnularComprobante');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[25]=='SI') {
    elemento=document.getElementById('divReversar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[26]=='SI') {
    elemento=document.getElementById('divConsolidar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[27]=='SI') {
    elemento=document.getElementById('divMayorizar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[28]=='SI') {
    elemento=document.getElementById('divAbrirPresupuesto');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[29]=='SI') {
    elemento=document.getElementById('divPresupuestoAnual');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[30]=='SI') {
    elemento=document.getElementById('divPresupuestoPeriodo');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[31]=='SI') {
    elemento=document.getElementById('divCerrarPresupuesto');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[32]=='SI') {
    elemento=document.getElementById('divBajarExcel');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[33]=='SI') {
    elemento=document.getElementById('divSubirExcel');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[34]=='SI') {
    elemento=document.getElementById('divFichaPersonal');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[35]=='SI') {
    elemento=document.getElementById('divDepositar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[36]=='SI') {
    elemento=document.getElementById('divEfectivizar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[37]=='SI') {
    elemento=document.getElementById('divProtestar');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[38]=='SI') {
    elemento=document.getElementById('divDepositoEfectivo');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
}
     if (acciones[39]=='SI') {
    elemento=document.getElementById('divAnular');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[40]=='SI') {
    elemento=document.getElementById('divMoroso');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[41]=='SI') {
    elemento=document.getElementById('divImprimirComprobante');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[42]=='SI') {
    elemento=document.getElementById('divImprimirCheque');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
     if (acciones[43]=='SI') {
    elemento=document.getElementById('divAnularCheque');
    if (elemento!=undefined)

    elemento.style.visibility='visible';
 }
    elemento=document.getElementById('imgFoto');
    if (elemento!=undefined) {
    elemento.src='../fotos/'+acciones[0];
    }

}

function omnisoftLoadMenuData(data)
{
//alert(data);
  var registros=data.split('|');

  var item; //  =registros[1].split('~');
  var itemText; //=''; //item[0].split('-');
  var moduloActual=''//itemText[0];
  var subModuloActual='';
  var subSubModuloActual='';
  var ulObject=document.getElementById('myMenu');

  var liFirstLevel; //=addOption(moduloActual,'../contabilidad/'+item[1],'../lib/zpmenu/themes/icon/icon_new.gif');
  var liSecondLevel;
  var liThirdLevel;
  var liFourthLevel;
  var i=1;

  while (   i < registros.length-1 ) {

         item=registros[i].split('~');
         itemText=item[0].split('-');

         if (moduloActual!=itemText[0]) {
             moduloActual=itemText[0];
             liFirstLevel=addOption(moduloActual,'../'+curModulo+'/'+item[1],'../lib/zpmenu/themes/icon/blue/Services_blue.gif');
             subModuloActual='';

             if (itemText.length>1) {

             liSecondLevel=node('ul');
              while( moduloActual==itemText[0] && i < registros.length-1)  {



                      if (subModuloActual!=itemText[1]) {
                          subModuloActual=itemText[1];
                           liThirdLevel=addOption(subModuloActual,'../'+curModulo+'/'+item[1],'../lib/zpmenu/themes/icon/blue/Services_blue.gif');

                          if (itemText.length>2) {
                              liFourthLevel=node('ul');
                             while( subModuloActual==itemText[1] && i < registros.length-1)  {
                                         liFourthLevel.appendChild(addOption(itemText[2],'../'+curModulo+'/'+item[1],'../lib/zpmenu/themes/icon/blue/Services_blue.gif'));
                                         i++;
                                 item=registros[i].split('~');
                                 itemText=item[0].split('-');

                                  }
                              liThirdLevel.appendChild(liFourthLevel);

                          i--;

                          }
                          liSecondLevel.appendChild(liThirdLevel);
                      }
                i++;
                item=registros[i].split('~');
                     itemText=item[0].split('-');

               }
              liFirstLevel.appendChild(liSecondLevel);
              i--;
             }

             ulObject.appendChild(liFirstLevel);

         }
       i++;

  }

   var menu = new Zapatec.Menu('myMenu',{glide:false, slide:false,fade:false,drag:false,wipe:false,dropShadow:2,hideDelay:20,showDelay:10});

}

function asignarModulo(modulo) {


switch(modulo) {
  case moduloContabilidad:
       curModulo="contabilidad";
  break;
   case moduloInventarios:
       curModulo="inventarios";

  break;

case moduloEvaluacion:
       curModulo="evaluacion";

  break;

case  moduloRRHH:
       curModulo="nomina";

  break;

case moduloPensiones:
       curModulo="pensiones";

  break;

case  moduloSistema:
       curModulo="sistema";

  break;
case  moduloAcademico:
       curModulo="academico";

  break;  
case  moduloAdmisiones:
       curModulo="admisiones";

  break;

case  moduloMantenimiento:
       curModulo="mantenimiento";

  break;


case  moduloActivosFijos:
       curModulo="activosfijos";

  break;

case  moduloAdquisiciones:
       curModulo="adquisiciones";

  break;

}

}

function OmnisoftPerfilUsuario(modulo) {
 var serial_usr=getCookie('serial_usr');
         asignarModulo(modulo);

   if (serial_usr==null) {

       alert('Error Grave:  Usuario NO autorizado!');
       window.location.href='../index.html';
       return;
   }


   else {

          var sPath = window.location.pathname;
          var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);

       objDBComando=new omnisoftDB("SELECT nombre_prc,url_prc FROM  upaccionproceso,upmodulos, upprocesos,upusuario WHERE serial_usr="+serial_usr+" and  upaccionproceso.serial_pfl =upusuario.serial_pfl and upprocesos.serial_prc=upaccionproceso.serial_prc and upmodulos.serial_mod = upprocesos.serial_mod and navegar_acp='SI' and upmodulos.serial_mod="+modulo+" order by upmodulos.serial_mod, upprocesos.codigo_prc","../lib/server/omnisoftSQLData.php",'omnisoftLoadMenuData');
       setTimeout('objDBComando.executeQuery()',500);

//       objDBAcciones=new omnisoftDB("SELECT foto_usr,insertar_acp,editar_acp,buscar_acp,eliminar_acp,envioCorreo_acp,graficar_acp,imprimir_acp,ayuda_acp,acercaDe_acp,salir_acp,inicio_acp,principio_acp,anterior_acp,siguiente_acp,ultimo_acp,envioExcel_acp,envioXML_acp,filtrar_acp,guardar_acp,cancelar_acp,navegar_acp,aprobarDocumento_acp,aprobarCupoPlazo_acp,anular_acp,reversarComprobantes_acp,consolidarCierrePeriodo_acp,mayorizarPresupuesto_acp,abrirPresupuesto_acp,presupuestoAnual_acp,presupuestoPeriodo_acp,cerrarPresupuesto_acp,bajarExcel_acp,subirExcel_acp,fichaPersonal_acp,depositar_acp,efectivizar_acp,protestar_acp,depositoEfectivo_acp, anularDocumento_acp, clienteMoroso_acp, imprimirComprobante_acp imprimirCheque_acp, anularCheque_acp FROM procesos,accionproceso,usuario WHERE serial_usr="+serial_usr+" and accionproceso.serial_pfl=usuario.serial_pfl and accionproceso.serial_prc=procesos.serial_prc and url_prc='"+sPage+"'",'omnisoftLoadAcciones');
//       setTimeout('objDBComando.executeQuery()',500);
 }

}


function OmnisoftPerfilUsuarioFormulario() {
 var serial_usr=getCookie('serial_usr');

   if (serial_usr==null) {

       alert('Error Grave:  Usuario NO autorizado!');
       window.location.href='../index.html';
       return;
   }


   else {


       var acciones=getCookie('acciones');
           omnisoftLoadAccion(acciones);


 }

}


