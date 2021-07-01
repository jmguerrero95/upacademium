var formularioGrabado=true;

function omnisoftTab(id) {
  frames['iframeDatos'].location.href=id;
}
function omnisoftGrabar() {
   return checkForm(document.PaginaDatos);
}

function omnisoftCancelar() {

 if (formularioGrabado==true || ((formularioGrabado==false) && (confirm('Desea perder las modificaciones que realizó?')==true))) {
     opener.omniObj.grid.refresh();
     window.close();
 }

}

function omnisoftProcesarCambios() {
   formularioGrabado=false;


}
function omnisoftImportarArchivo(archivo) {
  var result=0;
  var req = new AW.HTTP.Request;
      req.setURL("../lib/server/omnisoftImportFile.php");
      req.setRequestMethod("POST");
//      alert(archivo.value);
      req.setParameter("file",archivo.value);
      req.request();
      req.response=function(data) {
        var datos=data.split('|');
       if (datos[0]!='')
           alert(datos[0]);
       else       result=datos[1];
      }
    return result;
}



function omnisoftExecuteUpdate(sqlCommand,objForm) {
  var result='0|';
  var req = new AW.HTTP.Request;
      req.setURL("../lib/server/omnisoftDataManager.php");
      req.setRequestMethod("POST");
      req.setParameter("query",sqlCommand);
      req.request();

      req.response=function(data) {
        var datos=data.split('|');
       if (datos[0]!='')
           alert(datos[0]);
       else {
      result=datos[0]+'|'+datos[1];
      if (top.opener.omniObj.grid.action=='insert') {
          top.opener.omniObj.lastPage();
//          if (omniObj!=undefined )
  //            omniObj.grid.masterKeyValue= datos[1];
   //           alert(omniObj.grid.masterKeyValue);
      }
      else {
                    top.opener.omniObj.processPage();

      //        var row=top.opener.omniObj.grid.selectedRow;
      //         opener.omniObj.grid.updateData(objForm,row);


      }
          window.close();
       }
      }
    return result;
}


function validateComboBox(strValue)
{
  return (typeof strValue == 'string' && strValue != '' );

//  return (typeof strValue == 'string' && strValue != '' && isNaN(strValue));
}


function isDate(fld) {
 var fecha=fld.split('-');
 if (fecha.length!=3)
     return false;
 var anio=(fecha[0]>=1900);
 var mes= (fecha[1]>=1 && fecha[1] <=12) ;
 var dia=(fecha[2]>=1 && fecha[2]<=31);
     if (mes && dia  && fecha[1]==2 && fecha[2]>29)
     dia=false;

     if (mes && dia  && (fecha[1]==4 ||fecha[1]==6 ||fecha[1]==9 ||fecha[1]==11) && fecha[2]>30)
     dia=false;


 return anio && mes && dia;
}


function isString(strValue)
{
  return (typeof strValue == 'string' && strValue != '' && isNaN(strValue));
}

function isText(strValue)
{
  return (  strValue != '' );
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


function validarCedulaRUC() {

    if (!isCedulaRUC(this.value))
        this.focus();
}

function isCedulaRUC( numero ) {

var suma = 0;
var residuo = 0;
var pri = false;
var pub = false;
var nat = false;
var numeroProvincias = 24;
var modulo = 11;

/* Verifico que el campo no contenga letras */
var ok=1;
if (isNaN(numero)){
alert('El código de la provincia (dos primeros dígitos) es inválido'); return false;
}

/* Aqui almacenamos los digitos de la cedula en variables. */
d1 = numero.substr(0,1);
d2 = numero.substr(1,1);
d3 = numero.substr(2,1);
d4 = numero.substr(3,1);
d5 = numero.substr(4,1);
d6 = numero.substr(5,1);
d7 = numero.substr(6,1);
d8 = numero.substr(7,1);
d9 = numero.substr(8,1);
d10 = numero.substr(9,1);

/* El tercer digito es: */
/* 9 para sociedades privadas y extranjeros */
/* 6 para sociedades publicas */
/* menor que 6 (0,1,2,3,4,5) para personas naturales */

if (d3==7 || d3==8){
alert('El tercer dígito ingresado es inválido');
return false;
}

/* Solo para personas naturales (modulo 10) */
if (d3 < 6){
nat = true;
p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
modulo = 10;
}

/* Solo para sociedades publicas (modulo 11) */
/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
else if(d3 == 6){
pub = true;
p1 = d1 * 3;
p2 = d2 * 2;
p3 = d3 * 7;
p4 = d4 * 6;
p5 = d5 * 5;
p6 = d6 * 4;
p7 = d7 * 3;
p8 = d8 * 2;
p9 = 0;
}

/* Solo para entidades privadas (modulo 11) */
else if(d3 == 9) {
pri = true;
p1 = d1 * 4;
p2 = d2 * 3;
p3 = d3 * 2;
p4 = d4 * 7;
p5 = d5 * 6;
p6 = d6 * 5;
p7 = d7 * 4;
p8 = d8 * 3;
p9 = d9 * 2;
}

suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
residuo = suma % modulo;

/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
digitoVerificador = residuo==0 ? 0: modulo - residuo;

/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
if (pub==true){
if (digitoVerificador != d9){
alert('El ruc de la empresa del sector público es incorrecto.');
return false;
}
/* El ruc de las empresas del sector publico terminan con 0001*/
if ( numero.substr(9,4) != '0001' ){
alert('El ruc de la empresa del sector público debe terminar con 0001');
return false;
}
}
else if(pri == true){
if (digitoVerificador != d10){
alert('El ruc de la empresa del sector privado es incorrecto.');
return false;
}
if ( numero.substr(10,3) != '001' ){
alert('El ruc de la empresa del sector privado debe terminar con 001');
return false;
}
}

else if(nat == true){
if (digitoVerificador != d10){
alert('El número de cédula de la persona natural es incorrecto.');
return false;
}
if (numero.length >10 && numero.substr(10,3) != '001' ){
alert('El ruc de la persona natural debe terminar con 001');
return false;
}
}
return true;
}





function fechaSistema(){

var hoy= new Date();

var mes=hoy.getMonth()+1;

var sfecha = hoy.getYear() + '-' + ((mes<10)?'0'+mes:mes) + '-' + ((hoy.getDate()<10)?'0'+hoy.getDate():hoy.getDate());


return sfecha;

}

function formatCode(codigo,len) {
  for (var i=codigo.length; i < len; i++ ){
      codigo='0'+codigo;
  }
 return codigo;
}

function formatDouble(amount)
{
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2);
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}



function getURLParamGET(strParamName,iframe){
  var strReturn = "";
  var strHref =(iframe==undefined)? unescape(String(window.location.href)):unescape(String(parent.location.href));
  if ( strHref.indexOf("&") > -1 ){
    var strQueryString = strHref.substr(strHref.indexOf("&"));

    var aQueryString = strQueryString.split("&");
//    alert(aQueryString);
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
      if (aQueryString[iParam].indexOf(strParamName + "=") > -1 ){
        var aParam = aQueryString[iParam].split("=");
//        alert(strParamName+'='+aParam[1]);
        strReturn = aParam[1];

        break;
      }
    }
  }
//  alert(strParamName+'='+aQueryString);
   return strReturn;
}



function getURLParam(strParamName,iframe){
if (strParamName=='action')
   return top.opener.omniObj.grid.action;
if (top.opener.omniObj!=undefined) {
var   indice= top.opener.omniObj.grid.getFieldByColumnName(strParamName);
                  if (indice!=-1)
                      return top.opener.omniObj.grid.getCellText(indice,top.opener.omniObj.grid.selectedRow);
}
else return getURLParamGET(strParamName,iframe);

}


function omnisoftProcesarAutoIncrement(data){
var datos=data.split('|');
var fieldid='';
var code='';
//alert(data);
if (datos[0]!='')
   alert('Error: No se puede asignar valor autogenerado al codigo!');
else {
      fieldid=datos[1].split('~')[0];
      code=datos[1].split('~')[1];
          if (isNaN(parseInt(code)))
	  document.getElementById(fieldid).value=1;
	 else document.getElementById(fieldid).value=parseInt(code)+1;
      document.getElementById(fieldid).value=formatCode(document.getElementById(fieldid).value,document.getElementById(fieldid).maxLength);

//alert(datos);
}
}

function omnisoftProcesarMatricula(data){
var datos=data.split('|');
var fieldid='';
var code='';

if (datos[0]!='')
   alert('Error: No se puede asignar el numero de matricula!');
else {
      fieldid=datos[1].split('~')[0];
      code=datos[1].split('~')[1];


      document.getElementById(fieldid).value=code;
}
}


function omnisoftLoadData(objForm,iframe) {
   var action=top.opener.omniObj.grid.action;
   var indice=0;
        for (var i=0; i < objForm.length; i++)
          if (objForm.elements[i].className!='' && objForm.elements[i].type!='button') {

            if (objForm.elements[i].onchange==null)
                objForm.elements[i].onchange=omnisoftProcesarCambios;


            if (action=='edit') {
                  indice= top.opener.omniObj.grid.getFieldByColumnName(objForm.elements[i].name);
                  if (indice!=-1)
                      objForm.elements[i].value=top.opener.omniObj.grid.getCellText(indice,top.opener.omniObj.grid.selectedRow);
            }
            // alert(objForm.elements[i].name+'='+objForm.elements[i].value);
             switch(objForm.elements[i].className) {
              case 'string':
                             MaskInput(objForm.elements[i], "E^");
                             break;
              case 'integer':
              case 'emptyinteger':
                             MaskInput(objForm.elements[i], "9^");
                             break;
              case 'double':
              case 'emptydouble':
                             MaskInput(objForm.elements[i], "9^.");
                             break;
              case 'ruc':
              case 'cedula':
              case 'emptycedula':
                              objForm.elements[i].onblur=validarCedulaRUC;
                              break;
              case 'matricula':
                          if (top.opener.omniObj.grid.action=='insert' || objForm.elements[i].value=='') {

			  var SQLCommand='select "'+objForm.elements[i].id+'",lpad(concat(if (max('+objForm.elements[i].fieldid+') is NULL,"1",max('+objForm.elements[i].fieldid+')+1),"-09"),7,"0") from '+objForm.elements[i].table;
			  var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarMatricula');
                              objDBComando.executeQuery();
                          }
                              break;


              case 'autoincrement':
                          if (top.opener.omniObj.grid.action=='insert' || objForm.elements[i].value=='') {
			  var SQLCommand='select "'+objForm.elements[i].id+'",max('+objForm.elements[i].fieldid+') from '+objForm.elements[i].table;
//			  prompt('test',SQLCommand);
			  var objDBComando=new omnisoftDB(SQLCommand,"../lib/server/omnisoftSQLData.php",'omnisoftProcesarAutoIncrement');
                              objDBComando.executeQuery();
                          }
                              break;


              case 'date':
              case 'emptydate':
                             MaskInput(objForm.elements[i], "9999-99-99");
                             Calendar.setup({
		inputField     :    objForm.elements[i].name,
		ifFormat       :    "%Y-%m-%d",
		showsTime      :    false,
		button         :    "f_trigger_b",
		singleClick    :    true,
		step           :    1    });

                             break;
              case 'hour':
                             MaskInput(objForm.elements[i], "99:99:99");
                             break;

              case 'autosuggest':
                                var serial=objForm.elements[i].serial;
                                var fieldinfo=objForm.elements[i].info;
                                var fieldname=(objForm.elements[i].fieldname!=undefined)?objForm.elements[i].fieldname:objForm.elements[i].name;
                                var fieldid=(objForm.elements[i].fieldid!=undefined)?objForm.elements[i].fieldid:objForm.elements[i].serial;
                            	var autosuggestoptions = {

		                             script:"../lib/server/omnisoftAutosuggest.php?json=true&table="+objForm.elements[i].table+"&fieldname="+fieldname+"&fieldid="+fieldid+"&fieldinfo="+objForm.elements[i].info+"&",
		                             varname:'input',
		                             json:true,
		                             shownoresults:true,
		                             timeout:360000,
		                             callback: function (obj) {
                                                                        document.getElementById(serial).value = obj.id;
                                                                        if (document.getElementById(fieldinfo)!=undefined)
                                                                           document.getElementById(fieldinfo).value=obj.info;
                                                                      }
	                        };
	                        var as_json = new bsn.OmnisoftAutoSuggest(objForm.elements[i].name, autosuggestoptions);

                             break;

             }
          }

enterAsTab();
autoTab();
}




function omnisoftDataProcess(objForm) {
	var SQLCommand='';
	var SQLAction='';
	var table=top.opener.omniObj.grid.table;
	var row=top.opener.omniObj.grid.selectedRow;
	var resultData='';
	table=table.replace('#',' ');
	var i=0;
	var nitems=objForm.length-1;

	if (top.opener.omniObj.grid.action=="insert") {
        SQLAction='insert into ';
 		SQLAction=SQLAction.concat(table,' (');

                if (document.getElementById('searchFilter'))
                   nitems-=2;

                for (i=2; i < nitems ; i++) {
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,',');
               }
		if (objForm.elements[i].type=='password' )
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values (");
		else if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
			SQLAction=SQLAction.concat(objForm.elements[i].name,") values ('");
		else SQLAction=SQLAction.concat(") values ('");

		for (i=2; i < nitems; i++) {
			if (objForm.elements[i].type=='password' )
				SQLAction=SQLAction.concat("md5('",objForm.elements[i].value,"'),'");
			else if ((objForm.elements[i].className!='' ) &&  objForm.elements[i+1].type!='password' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"','");
			else if (objForm.elements[i+1].type=='password')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"',");
		}

		if (objForm.elements[i].type=='password' )
			SQLAction=SQLAction.concat('substring(md5(',objForm.elements[i].value,"'),1,10),'");
		else
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].value,"')");


               prompt ('test',SQLAction);
                SQLAction=SQLAction.toUpperCase();

                resultData=omnisoftExecuteUpdate(SQLAction,objForm);

//                setTimeout('opener.omniObj.lastPage()',500);

        }
  	else {
		var  key=top.opener.omniObj.grid.key;
		SQLAction='update ';
		SQLAction=SQLAction.concat(table,' set ');
		for (i=2; i < nitems; i++) {
			if (objForm.elements[i].type=='password' )
				SQLAction=SQLAction.concat(objForm.elements[i].name,"=md5('",objForm.elements[i].value,"'),");
			else

				if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
					SQLAction=SQLAction.concat(objForm.elements[i].name,"= '",objForm.elements[i].value,"',");

		}
		if (objForm.elements[i].type=='password' )
			SQLAction=SQLAction.concat(objForm.elements[i].name,"=md5('",objForm.elements[i].value,"') where ",key,"=",objForm.elements[1].value);
		else
			if (objForm.elements[i].className!='' && objForm.elements[i].className!='autosuggest' && objForm.elements[i].name!='')
				SQLAction=SQLAction.concat(objForm.elements[i].name,"= '",objForm.elements[i].value,"' where ",key,"=",objForm.elements[1].value);
			else
				SQLAction=SQLAction.concat(objForm.elements[1].name,"= '",objForm.elements[1].value,"' where ",key,"=",objForm.elements[1].value);


                SQLAction=SQLAction.toUpperCase();

         //       alert(SQLAction);
                resultData=omnisoftExecuteUpdate(SQLAction,objForm);
//                if (resultData.split('|')[0]=='0') {

//                   opener.omniObj.grid.updateData(objForm,row);

//                }




	}

        return resultData;

}


function omnisoftGeneraPassword()
{
var num;
var contador;
var conNumero;
var password;
var passCod;

password='';
passCod='';
contador=0;
conNumero=0;
while (contador<1)
{
	num=Math.round(Math.random()*1000);
	if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
	{
		if (num!=108 && num!=73)
		{
			contador++;
			password=password+String.fromCharCode(num);
			passCod=passCod+num+'-';
		}
		if (num<100)
		{
			contador++;
			//password=password+String.fromCharCode(num);
			password=password+num
			//passCod=passCod+num+'-';
		}
	}

}
while (contador<7)
{
	if ((contador==7) && (conNumero<1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=48) && (num<=57)))
		{
			contador++;
			conNumero++;
			password=password+String.fromCharCode(num);
			passCod=passCod+num+'-';
		}
	}
	else if ((contador<7) && (conNumero<1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=48) && (num<=57)))
		{
			contador++;
			conNumero++;
			//password=password+String.fromCharCode(num);
			password=password+num
			passCod=passCod+num+'-';

		}
		if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
		{
			if (num!=108 && num!=73)
			{
				contador++;
				password=password+String.fromCharCode(num);
				passCod=passCod+num+'-';
			}
		}
	}
	else if ((contador<7) && (conNumero==1))
	{
		num=Math.round(Math.random()*1000);
		if (((num>=65) && (num<=90)) || ((num>=97) && (num<=122)))
		{
			if (num!=108 && num!=73)
			{
				contador++;
				password=password+String.fromCharCode(num);
				passCod=passCod+num+'-';
			}
		}
	}

}
return password;
}


