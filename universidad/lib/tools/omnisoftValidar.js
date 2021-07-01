
  function dateDifference(fecha1,fecha2) {

  return Math.ceil((fecha1.getTime()-fecha2.getTime())/(1000*60*60*24));
   }

var currentElement=0;
var highlightcolor="#9cf"

var ns6=document.getElementById&&!document.all
var previous=''
var eventobj

//Regular expression to highlight only form elements
var intended=/INPUT|TEXTAREA|SELECT|OPTION/

//Function to check whether element clicked is form element
function checkel(which){
if (which.style&&intended.test(which.tagName)){
if (ns6&&eventobj.nodeType==3)
eventobj=eventobj.parentNode.parentNode
return true
}
else
return false
}

//Function to highlight form element
function highlight(e){
eventobj=ns6? e.target : event.srcElement
if (previous!=''){
if (checkel(previous))
previous.style.backgroundColor=''
previous=eventobj
if (checkel(eventobj))
eventobj.style.backgroundColor=highlightcolor
}
else{
if (checkel(eventobj))
eventobj.style.backgroundColor=highlightcolor
previous=eventobj
}
}

function onKeyDownHandler( blCheckEnter )
{
    if ( event.keyCode == 116 ) // f5 key code is 116, cancel event
    {
        event.keyCode = 0;
        event.cancelBubble = true;
        event.returnValue = false;
    }
    else
    {
        event.cancelBubble = false;
        event.returnValue = true;
    }
}



function attachFormHandlers()
{
  if (document.getElementsByTagName)
  {
      var objField = document.getElementsByTagName('input');
      for (var iFieldCounter=0; iFieldCounter<objField.length; iFieldCounter++)
        if (objField[iFieldCounter].type=="text") {
        //alert(objField[iFieldCounter].name);
        objField[iFieldCounter].onBlur=function() {esconderToolTip();}
        }



    var objForm = document.getElementsByTagName('form');

    for (var iCounter=0; iCounter<objForm.length; iCounter++)
      objForm[iCounter].onsubmit = function(){return checkForm(this);}

 }
}

function checkForm(objForm,process)
{
//  alert('entro a check form');

  var arClass, bValid;
  var objField = objForm.getElementsByTagName('input');
  var message='';


  for (var iFieldCounter=1; iFieldCounter<objField.length; iFieldCounter++)
  {
	arClass = objField[iFieldCounter].className.split(' ');

    for (var iClassCounter=0; iClassCounter<arClass.length; iClassCounter++)
    {
//      alert(objField[iFieldCounter].name+'='+arClass[iClassCounter]);
      switch (arClass[iClassCounter])
      {
        case 'string':
           bValid = isString(objField[iFieldCounter].value.replace(/^\s*|\s*$/g, ''));
           message='<strong >Advertencia:</strong> este campo debe empezar con una letra y acepta unicamente los siguientes caracteres: letras mayusculas (A..Z), letras minusculas (a..z) o numeros luego de una letra (0..9)';
           break;

        case 'text':
           bValid = isText(objField[iFieldCounter].value);
           message='<strong >Advertencia:</strong> este campo acepta unicamente los siguientes caracteres: letras mayusculas (A..Z), letras minusculas (a..z) o numeros luego de una letra (0..9)';
           break;


        case 'integer' :
        case 'double' :

        //   alert(objField[iFieldCounter].value);
           bValid = isNumber(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente numeros (0..9)';
           break;

         case 'emptystring':
           bValid = (objField[iFieldCounter].value=='') || (isString(objField[iFieldCounter].value.replace(/^\s*|\s*$/g, '')));
           message='<strong >Advertencia:</strong> este campo acepta unicamente los siguientes caracteres: letras mayusculas (A..Z), letras minusculas (a..z) o numeros luego de una letra (0..9)';
           break;

        case 'emptyinteger' :
        case 'emptydouble' :

           bValid = (objField[iFieldCounter].value=='') || isNumber(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente numeros (0..9)';

           break;

        case 'email' :
           bValid = isEmail(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta un nombre seguido del caracter @ y un dominio registrado, por ejemplo: juan.perez@telefonica.com.ec';

             break;

//        case 'date' :
          // bValid = isDate(objField[iFieldCounter].value);

//           message='<strong>Advertencia:</strong> este campo acepta fechas en el formato (aaaa-mm-dd), por ejemplo: 2008-03-23';

//             break;
        case 'emptydate' :
           bValid = (objField[iFieldCounter].value=='') || isDate(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta fechas en el formato (aaaa-mm-dd), por ejemplo: 2008-03-23';

             break;

        case 'emptyemail' :
           bValid = (objField[iFieldCounter].value=='') ||isEmail(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta un nombre seguido del caracter @ y un dominio registrado, por ejemplo: juan.perez@telefonica.com.ec';

             break;

        case 'cedula' :
        case 'ruc' :
           bValid =  isCedulaRUC(objField[iFieldCounter].value);

           message='<strong>Advertencia:</strong> este campo acepta unicamente cedulas o rucs validos, ej: 1706853627001';

           break;

        case 'emptycedula' :
        case 'emptyruc' :
           bValid =  (objField[iFieldCounter].value=='') ||isCedulaRUC(objField[iFieldCounter].value);

           message='<strong>Advertencia:</strong> este campo acepta unicamente cedulas o rucs validos, ej: 1706853627001';

           break;

        case 'autosuggest' :
        var serial='';
        if (frames['iframeDatos']==undefined)
             serial=document.getElementById(objField[iFieldCounter].serial);
         else
			  serial=frames['iframeDatos'].document.getElementById(objField[iFieldCounter].serial);
           bValid =  (serial.value!='' && objField[iFieldCounter].value.length>=3);
           message='<strong>Advertencia:</strong> debe seleccionar un item de la lista desplegable';
           break;


       case 'hour':
		      bValid=isHour(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta horas en el formato 99:99 por ejemplo: 13:33,08:38';
           break;

       case 'emptyhour':
		      bValid=(objField[iFieldCounter].value=='') || isHour(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta horas en el formato 99:99 por ejemplo: 13:33,08:38';
           break;

        case 'ipaddress' :

           bValid =  isIpAddress(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente el direcciones IP, ej: 200.24.208.16';

           break;

        case 'emptyipaddress' :

           bValid = (objField[iFieldCounter].value=='') || isIpAddress(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente el direcciones IP, ej: 200.24.208.16';

           break;

        case 'mask' :

           bValid =  isIpAddress(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente mascaras de direcciones IP, ej: 255.255.255.0';

           break;

        case 'emptymask' :

           bValid = (objField[iFieldCounter].value=='') || isIpAddress(objField[iFieldCounter].value);
           message='<strong>Advertencia:</strong> este campo acepta unicamente mascaras de direcciones IP, ej: 255.255.255.0';

           break;

        case 'password':

            bValid= (objField[iFieldCounter].value.length>=8)
            message='<strong>Advertencia:</strong> el password debe contener al menos 8 caracteres';
			break;

        case 'cuenta':
		   bValid = isNumber(objField[iFieldCounter].value) || isString(objField[iFieldCounter].value);
           message='<strong >Advertencia:</strong> este campo acepta unicamente los siguientes caracteres: números (0..9) o puntos después de números';

        default:
           bValid = true;
      }
//	alert(objField[iFieldCounter].className);
      if (bValid == false)
      {
         // alert('error');
        objField[iFieldCounter].select();
        objField[iFieldCounter].focus();
        currentElement=objField[iFieldCounter];
        //mostrarToolTip('Por favor revise el valor ingresado en '+objField[iFieldCounter].name, 300);
        mostrarToolTip(message, 300);


        return false;
      }
    }

}
  if (process==undefined)
  return omnisoftDataProcess(objForm);
  else return true;

}




function isString(strValue)
{
  return (typeof strValue == 'string' && strValue != '' && isNaN(strValue));
}

function isNumber(strValue)
{
  return (!isNaN(strValue) && strValue != '');
}

function isEmail(strValue)
{
  var objRE = /^[\w-\.\']{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,}$/;

  return (strValue != '' && objRE.test(strValue));
}

function isHour(strValue)
{

  var objRE = /\d{1,2}:\d{1,2}:\d{1,2}/;
  return (strValue != '' && objRE.test(strValue));
}

function isIpAddress(strValue)
{

  var objRE = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/;
  return (strValue != '' && objRE.test(strValue));
}

/*
function getY( oElement )
{
  var iReturnValue = 0;
  while( oElement != null ) {
    iReturnValue += oElement.offsetTop;
    oElement = oElement.offsetParent;
  }
  return iReturnValue;



}


function getX( oElement )
{
  var iReturnValue = 0;
  while( oElement != null ) {
    iReturnValue += oElement.offsetLeft;
    oElement = oElement.offsetParent;
  }
  return iReturnValue;
}

*/

function getX(obj)
  {
    var curleft = 0;
    if(obj.offsetParent)
        while(1)
        {
          curleft += obj.offsetLeft;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.x)
        curleft += obj.x;
    return curleft;
  }

  function getY(obj)
  {
    var curtop = 0;
    if(obj.offsetParent)
        while(1)
        {
          curtop += obj.offsetTop;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.y)
        curtop += obj.y;
    return curtop;
  }


var offsetfromcursorX=12 //Customize x offset of tooltip
var offsetfromcursorY=10 //Customize y offset of tooltip

var offsetdivfrompointerX=10 //Customize x offset of tooltip DIV relative to pointer image
var offsetdivfrompointerY=14 //Customize y offset of tooltip DIV relative to pointer image. Tip: Set it to (height_of_pointer_image-1).

document.write('<div id="dhtmltooltip"></div>') //write out tooltip DIV
document.write('<img id="dhtmlpointer" src="../images/arrow2.gif">') //write out pointer image

var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
var showedtip=false;
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""
if (ie||ns6)
var formaDatos=document.all? document.all["div_insertar"] : document.getElementById? document.getElementById("div_insertar") : ""

var pointerobj=document.all? document.all["dhtmlpointer"] : document.getElementById? document.getElementById("dhtmlpointer") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function mostrarToolTip(thetext, thewidth, thecolor){
if (ns6||ie) {

if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor

tipobj.innerHTML=thetext

enabletip=true
showedtip=false
return false
}
}



function positiontip(e){

if (enabletip && !showedtip){
  showedtip=true;
var nondefaultpos=false;
var scrollX=(ns6)?e.pageX : ietruebody().scrollLeft;
var scrollY=(ns6)?e.pageY : ietruebody().scrollTop;
var idelement=currentElement;

//alert(currentElementId);
//var curX= document.getElementById(idelement).offsetLeft+document.PaginaDatos.offsetLeft+ietruebody().scrollLeft;
//var curY= document.getElementById(idelement).offsetTop+document.PaginaDatos.offsetTop+ietruebody().scrollTop;

//var curX= getX(document.getElementById(idelement));
//var curY= getY(document.getElementById(idelement))+85;
if (top.document.frames[0]!=undefined)
   scrollY+=85;
var curX= getX(currentElement)+scrollX;
var curY= getY(currentElement)+scrollY;




if (document.activeElement.getAttribute('type')!='text')
   curY+=20;

//alert(curY);
//alert('Active Element='+document.documentElement.clientWidth);

var winwidth=ie&&!window.opera? ietruebody().clientWidth : window.innerWidth-20
var winheight=ie&&!window.opera? ietruebody().clientHeight : window.innerHeight-20

var rightedge=ie&&!window.opera? winwidth-event.clientX-offsetfromcursorX : winwidth-e.clientX-offsetfromcursorX
var bottomedge=ie&&!window.opera? winheight-event.clientY-offsetfromcursorY : winheight-e.clientY-offsetfromcursorY

var leftedge=(offsetfromcursorX<0)? offsetfromcursorX*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth){
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=curX-tipobj.offsetWidth+"px"
pointerobj.style.left=curX-tipobj.offsetWidth+"px"
nondefaultpos=true

}
else if (curX<leftedge)
tipobj.style.left="5px"
else{
 // alert(curX+' < '+leftedge);
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetfromcursorX-offsetdivfrompointerX;
var leftside=parseInt(tipobj.style.left.split('px')[0])+parseInt(tipobj.style.width.split('px')[0]);
if (leftside > document.documentElement.clientWidth)
    tipobj.style.left=parseInt(tipobj.style.left.split('px')[0])-parseInt(leftside-document.documentElement.clientWidth)-10;
pointerobj.style.left=curX+offsetfromcursorX+"px";
}

//same concept with the vertical position
//alert(bottomedge+ '< ' + tipobj.offsetHeight);
/*if (bottomedge<tipobj.offsetHeight){
tipobj.style.top=curY-tipobj.offsetHeight-offsetfromcursorY+"px"
pointerobj.style.top=curY-tipobj.offsetHeight-offsetfromcursorY-14+"px";

nondefaultpos=true
}
else{ */
tipobj.style.top=curY+offsetfromcursorY+offsetdivfrompointerY+"px"

pointerobj.style.top=curY+offsetfromcursorY+offsetdivfrompointerY-14+"px"
//}
tipobj.style.visibility="visible"
//if (!nondefaultpos)
pointerobj.style.visibility="visible"
//else
//pointerobj.style.visibility="hidden"
}
}

function esconderToolTip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
pointerobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip