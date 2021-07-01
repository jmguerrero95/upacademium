
//------------------------------------------------------------------------------------------------------------------------
//  OCL Omnnisoft Component Library
//  PROYECTO: Librerias para el mantenimiento de base de datos
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//  VERSION:  2.1
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: omnisoftGrid.js
//  DESCRIPCIÓN: Archivo que contiene la clase omnisoftGrid para la gestion de base de datos
//  FECHA DE CREACIÓN: 18-Diciembre-2007
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------


omnisoftComboBox=function(aObjName,alistName,aSQLCommand,sWidth,aCheck,aValue,aAll,aOnChange) {
 this.ObjName=aObjName;
 this.SQLCommand=aSQLCommand;
 this.listName=alistName;
 this.width=sWidth;
 this.check=(aCheck==undefined)?true:aCheck;
 this.digitos=10; //cantidad de digitos buscados
 this.puntero=0;
 this.buffer=new Array(this.digitos); //declaración del array Buffer
 this.cadena="";
 this.seleccion=(aAll==undefined)?'':aAll;
 this.onchange=(aOnChange==undefined)?'':aOnChange;
 this.value=(aValue==undefined)?'':aValue;
 this.objDBComando=new omnisoftDB(this.SQLCommand,"../lib/server/omnisoftSQLData.php",this.ObjName+'.comboBoxData');

 this.create=function() {
    with (document) {
      if (this.check)
   write('<select class="combobox" name="'+this.listName+'" STYLE="width: '+this.width+'" id="'+this.listName+'"  onKeypress='+this.ObjName+'.search(this) onblur='+this.ObjName+'.empty()>');
   else
   write('<select  name="'+this.listName+'" STYLE="width: '+this.width+'" id="'+this.listName+'"  onKeypress='+this.ObjName+'.search(this) onblur='+this.ObjName+'.empty()>');
   write(' </select>');
   }
 }
 this.show=function() {
     this.create();
     eval(this.ObjName+'.objDBComando.executeQuery()');

 }

 this.comboBoxData=function(strOptions) {
  var lst = document.getElementById(this.listName);
   var aOptionPairs = strOptions.split('|');
   var j=1;

     lst.options.length = 0;

      if (this.seleccion!='') {
      lst.options[0] = new Option(this.seleccion, this.seleccion);
      j++;
      }

  for( var i = j; i < aOptionPairs.length-1; i++ )

    if (aOptionPairs[i].indexOf('~') != -1) {
      var aOptions = aOptionPairs[i].split('~');
      lst.options[i-1] = new Option(aOptions[1], aOptions[0]);
      if ( aOptions[0].split('¬')[0]==this.value)
         lst.options.selectedIndex=i-1;

    }
    if (this.onchange!='') {
        lst.onchange=this.onchange;
        lst.onclick=this.onchange;

        setTimeout(lst.onchange,0);
    }

 }

 this.search=function(obj) {
   var letra = String.fromCharCode(event.keyCode);
   if(this.puntero >= this.digitos){
       this.cadena="";
       this.puntero=0;
    }
   //si se presiona la tecla ENTER, borro el array de teclas presionadas y salto a otro objeto...
   if (event.keyCode == 13)
       this.empty();

   //sino busco la cadena tipeada dentro del combo...
   else{
       this.buffer[this.puntero]=letra;
       //guardo en la posicion puntero la letra tipeada
       this.cadena=this.cadena+this.buffer[this.puntero]; //armo una cadena con los datos que van ingresando al array
       this.puntero++;

       //barro todas las opciones que contiene el combo y las comparo la cadena...
       for (var opcombo=0;opcombo < obj.length;opcombo++){
          if(obj[opcombo].text.substr(0,this.puntero).toLowerCase()==this.cadena.toLowerCase()){
          obj.selectedIndex=opcombo;
          }
       }
    }
   event.returnValue = false; //invalida la acción de pulsado de tecla para evitar busqueda del primer caracter

 }

 this.empty=function() {
     this.cadena="";
     this.puntero=0;

 }


}
