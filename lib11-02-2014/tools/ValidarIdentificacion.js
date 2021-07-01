
function ltrim(s) {     return s.replace(/^\s+/, ""); }  
function rtrim(s) {     return s.replace(/\s+$/, ""); }  
function trim(s) {     return rtrim(ltrim(s)); }

function validar_doc(select_tipo_id, texto_id){

//Validación de la cedula
if(document.getElementById(select_tipo_id).value=='CI' || document.getElementById(select_tipo_id).value=='CEDULA'){
		if(validarCedula(document.getElementById(texto_id).value)!=1)
				{
					alert("Número de cédula incorrecto");
					document.getElementById(texto_id).focus(); 
					document.getElementById(texto_id).select(); 
					return false;
				}
}
	//Valida que se RUC
	if((document.getElementById(select_tipo_id).value)=='RUC'){  
   		if((validarRucSPE(document.getElementById(texto_id).value)!=1) && (validarRucPN(document.getElementById(texto_id).value)!=1) && (validarRucSP(document.getElementById(texto_id).value)!=1)){	
			alert("Número de RUC incorrecto");
			document.getElementById(texto_id).focus(); 
			document.getElementById(texto_id).select(); 
			
			return false;
  	 	} 
  	}	
	//Valida que no este vacio
	if(trim(document.getElementById(texto_id).value)==''){
		alert("Número de Identificación incorrecto");
		document.getElementById(texto_id).focus(); 
		document.getElementById(texto_id).select(); 
		return false;
	 }
	 
	 return true;
}		
//FUNCION QUE PERMITE VALIDAR EL NUMERO DE CEDULA
function validarCedula(cedula)
{
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
  	if(digverfced==digverf)
   	return 1;  
  	else
   	return 0;          
 	}
 	else
  	return 0;  
}

/// validacion del ruc para personas naturales
function validarRucPN(rucpn)
{ 
 cadena=/^[0-9]{13}$/;
 sumaprod=0;
 coef='212121212';  
 if(cadena.test(rucpn)&&(rucpn.substr(10,3))==001&&(rucpn.substr(2,1))<6&&(rucpn.substr(0,2))>=1&&(rucpn.substr(0,2))<=22){  
  i=0;
  while(i<9)
  {    
   if(i==0)
   {
     numruc=rucpn.substr(0,1);  
     numcoef=coef.substr(0,1);      
   }
   else
   {
     numruc=rucpn.substr(i,1);  
     numcoef=coef.substr(i,1);   
   }  
   product=numruc*numcoef;  
   if (product>=10)
   {   
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
  if(digverfced==digverf)
   return 1;  
  else
   return 0;           
 }
 else
  return 0;  
}
 
/////   validacion del RUC para sociedades publicas
function validarRucSP(rucsp)
{
 cadena=/^[0-9]{13}$/;
 sumaprod=0;
 coef='32765432';
 if(cadena.test(rucsp)&&(rucsp.substr(9,4))==0001&&(rucsp.substr(2,1))==6&&(rucsp.substr(0,2))>=1&&(rucsp.substr(0,2))<=22){  
  i=0;
  while(i<8)
  {    
   if(i==0)
   {
     numruc=rucsp.substr(0,1);  
     numcoef=coef.substr(0,1);      
   }
   else
   {
     numruc=rucsp.substr(i,1);  
     numcoef=coef.substr(i,1);   
   }  
   product=numruc*numcoef;     
            sumaprod=sumaprod+product;        
      i=i+1;  
  }  
  resid=sumaprod%11;
  if (resid==0)
   digverf=0;
  else
   digverf=11-resid;  
  digverfruc=rucsp.substr(8,1);  
  if(digverfruc==digverf)
   return 1;  
  else
   return 0; 
 }
 else
  return 0;  
}

/// validacion del ruc para sociedades privadas y extranjeros sin cedula 
function validarRucSPE(rucspe)
{ 
 cadena=/^[0-9]{13}$/;
 sumaprod=0; 
 coef='432765432'; 
 if(cadena.test(rucspe)&&(rucspe.substr(10,3))==001&&(rucspe.substr(2,1))==9&&(rucspe.substr(0,2))>=1&&(rucspe.substr(0,2))<=22)
 {   
  i=0;
  while(i<9)
  {    
   if(i==0)
   {
     numruc=rucspe.substr(0,1);  
     numcoef=coef.substr(0,1);      
   }
   else
   {
     numruc=rucspe.substr(i,1);  
     numcoef=coef.substr(i,1);   
   }  
   product=numruc*numcoef;     
            sumaprod=sumaprod+product;        
      i=i+1;  
  }
  resid=sumaprod%11;
  if (resid==0)
   digverf=0;
  else
   digverf=11-resid;  
  digverfruc=rucspe.substr(9,1);  
  if(digverfruc==digverf)
   return 1;  
  else
   return 0; 
 }
 else
  return 0;  
}



