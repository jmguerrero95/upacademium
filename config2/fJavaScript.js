
// JavaScript Document
//funciones para bloquear el chick derecho

function bloquear_click_derecho(){
 if(document.layers)document.captureEvents(Event.MOUSEDOWN);
 document.onmousedown=evento_click_derecho;
}

function evento_click_derecho(k){
 var mensaje='Acción no permitida';
 if((document.layers&&k.which!=1) || (document.all&&event.button!=1))
  alert(mensaje);
 return true;
}

//FUNCION QUE PERMITE VALIDAR EL AÑO
function validarAnio(anio){
        cadena=/^[0-9]{4}$/;
    if(cadena.test(anio))
                return 1;
        else
                return 0;
}

//FUNCION QUE PERMITE VALIDAR EL E-MAIL
function validarMail(mail){  
    cadena=/^([a-zA-Z0-9\._-]+)@([a-zA-Z0-9\._-]+)\.([a-zA-Z0-9\._-]+)$/;  
	if(cadena.test(mail))
                return 1;
        else
                return 0;
}
//FUNCION QUE PERMITE VALIDAR UNA CANTIDAD ENTERA O DECIMAL
function validarValor(valor){
        cadena=/^[0-9]+(\.+[0-9]+)*$/;
    if(cadena.test(valor))
                return 1;
        else
                return 0;
}

//FUNCION QUE PERMITE VALIDAR UN ENTERO
function validarCantidad(cant){
        cadena=/^[0-9]*$/;
    if(cadena.test(cant))
                return 1;
        else
                return 0;
}

//FUNCION QUE PERMITE VALIDAD EL NUMERO DE CEDULA
function validarCedula(cedula){	
	cadena=/^[0-9]{10}$/;
	sumaprod=0;
	coef='212121212';
    if(cadena.test(cedula)){		
		i=0;
		while(i<9){				
			if(i==0){
			  numruc=cedula.substr(0,1);		
			  numcoef=coef.substr(0,1);	  		 
			}
			else{
			  numruc=cedula.substr(i,1);		
			  numcoef=coef.substr(i,1);	  
			}		
			product=numruc*numcoef;		
			if (product>=10){			
			  product1=String(product);	  			
			  num1=product1.substr(0,1);		 
			  num2=product1.substr(1,1);			
			  product=Number(num1)+Number(num2);	 
			}
			 sumaprod=sumaprod+product;				 		 
			 i=i+1;		
		}		
		resid=sumaprod%10;	
		if(resid==0)
		 digverf=0;
		else
		digverf=10-resid;
		digverfced=cedula.substr(9,1);
		if(Number(digverfced)==Number(digverf)) {
		 return 1;	 
		 }
		else {
		 return 0;	         
		} 
	}
	else {
	 return 0;	 
	 }
}


function validarRucPN(rucpn){
	cadena=/^[0-9]{13}$/;
	sumaprod=0;
	coef='212121212';		
	if(cadena.test(rucpn)&&(rucpn.substr(10,3))=='001'&&(Number(rucpn.substr(2,1)))<6&&(Number(rucpn.substr(0,2)))>=1&&(Number(rucpn.substr(0,2)))<=22){		
		i=0;
		while(i<9){				
			if(i==0){
			  numruc=rucpn.substr(0,1);		
			  numcoef=coef.substr(0,1);	  		 
			}
			else{
			  numruc=rucpn.substr(i,1);		
			  numcoef=coef.substr(i,1);	  
			}		
			product=numruc*numcoef;		
			if (product>=10){			
			  product1=String(product);	  			
			  num1=product1.substr(0,1);		 
			  num2=product1.substr(1,1);			
			  product=Number(num1)+Number(num2);	 
			}
			 sumaprod=sumaprod+product;				 		 
			 i=i+1;		
		}			
		resid=sumaprod%10;
		if(resid==0)
		 digverf=0;
		else
		 digverf=10-resid;
		digverfced=rucpn.substr(9,1);
		if(Number(digverfced)==Number(digverf)) {
		 return 1;	 
		 }
		else {
		 return 0;	          
		 }
	}
	else
	 return 0;	 
}
function validarRucSP(rucsp){
	cadena=/^[0-9]{13}$/;
	sumaprod=0;
	coef='32765432';
	if(cadena.test(rucsp)&&(rucsp.substr(9,4))=='0001'&&(Number(rucsp.substr(2,1)))==6&&(Number(rucsp.substr(0,2)))>=1&&(Number(rucsp.substr(0,2)))<=22){		
		i=0;
		while(i<8){				
			if(i==0){
			  numruc=rucsp.substr(0,1);		
			  numcoef=coef.substr(0,1);	  		 
			}
			else{
			  numruc=rucsp.substr(i,1);		
			  numcoef=coef.substr(i,1);	  
			}		
			product=numruc*numcoef;					
            sumaprod=sumaprod+product;				 		 
		    i=i+1;		
		}		
		resid=sumaprod%11;
		if(Number(resid)==0){
			digverf=0;
		}
		else{
			digverf=11-resid;
		}
		digverfruc=rucsp.substr(8,1);
		if(Number(digverfruc)==Number(digverf)) {		
		 return 1;	 
		 }
		else {
		 return 0; 
		 }
	}
	else
	 return 0;	 
}

function validarRucSPE(rucspe){	
	cadena=/^[0-9]{13}$/;
	sumaprod=0;	
	coef='432765432';	
	if(cadena.test(rucspe)&&(rucspe.substr(10,3))=='001'&&(Number(rucspe.substr(2,1)))==9&&(Number(rucspe.substr(0,2)))>=1&&(Number(rucspe.substr(0,2)))<=22){					
		i=0;
		while(i<9){				
			if(i==0){
			  numruc=rucspe.substr(0,1);		
			  numcoef=coef.substr(0,1);	  		 
			}
			else{
			  numruc=rucspe.substr(i,1);		
			  numcoef=coef.substr(i,1);	  
			}		
			product=numruc*numcoef;					
            sumaprod=sumaprod+product;
		    i=i+1;		
		}
		resid=sumaprod%11;
		if(Number(resid)==0){
			digverf=0;			
		}
		else{
			digverf=11-resid;
		}
		digverfruc=rucspe.substr(9,1);	
		if(Number(digverfruc)==Number(digverf)) {	
		 return 1;	 
		 }
		else {
		 return 0; 
		 }
	}
	else
	 return 0;	 
}

//FUNCION QUE PERMITE VALIDAR UNA FECHA
function validarFecha(fecha){
        cadena=/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    if(cadena.test(fecha))
                return 1;
        else
                return 0;
}

//FUNCION QUE PERMITE VALIDAR LA HORA
function validarHora(hora){
        cadena=/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/;
    if(cadena.test(hora))
                return 1;
        else
                return 0;
}

function mensaje(mensaje,accion){
    switch (mensaje){
           case 1:  txt='Los campos con * son requeridos';      break;
           case 2:  txt='Valor incorrecto';      break;
           case 3:  txt='Indique el valor del crèdito';      break;
           case 4:  txt='El valor del campo debe ser vacio';      break;
           case 5:  txt='Año Incorrecto';      break;
           case 6:  txt='Número de cédula no válido';      break;
           case 7:  txt='Valor incorrecto de antiguedad por años';      break;
           case 8:  txt='Fecha Incorrecta';      break;
           case 9:  txt='Número no valido de cargas familiares';      break;
           case 10:  txt='Número de Documento Incorrecto';     break;
           case 11:  txt='Valor incorrecto de antiguedad por meses';      break;
           case 12:  txt='Ingrese código o cédula, no los dos'; break;
		   case 13:  txt='Días de crédito incorrecto'; break;
	       case 14:  txt='E-mail incorrecto'; break;
		   case 15:  txt='Días de vida útil incorrecto'; break;		 
 	       case 16:  txt='Indique el valor del arriendo'; break;
 	       case 17:  txt='Indique el valor del Monto dividendo mesual '; break;
		   case 18:  txt='Indique el plazo por vencer de la hipoteca '; break;
		   case 19:  txt='El campo debe ser vacio en valor del arriendo'; break;
		   case 20:  txt='El campo debe ser vacio en valor del monto del dividendo mensual';  break;
		   case 21:  txt='El campo debe ser vacio en plazo por vencer';  break;
		   case 22:  txt='Campo del R.U.C o C.I. Incorrecto';     break;
		   case 23:  txt='Hora Incorrecta';     break;		   		   		   
		   case 24:  txt='Los dias ingresados son mayores que los acumulados';     break;		   		   		   		   
		   case 25:  txt='Los asientos no estan cuadrados, verifique antes de aprobar';     break;
		   case 26:  txt='El valor tiene que ser menor a 15';     break;

           default : txt='Ha ocurrido un error. Consulte con el administrador' ;}

       alert(txt);
       if(accion==1) history.back();
       if(accion==2) window.close();
}