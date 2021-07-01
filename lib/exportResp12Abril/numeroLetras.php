<?

function numeros($numero){

 $frase='';

 while ($numero>0){

         if($numero >= 1  and $numero <= 999){
                    $palabra='';
                    $operac=$numero;
                    $frase=letras($operac,$frase);
                    $numero=0;
         }

        if($numero >= 1000 and $numero <= 9999){
                    $palabra='MIL ';
                    $operac=(int)($numero/1000);
                    if($operac>1)
                     $frase=letras($operac,$frase);
                    $numero=$numero-$operac*1000;
               }

        if($numero >= 10000 and $numero <= 99999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;
               }
        if($numero >= 100000 and $numero <= 999999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;

               }
        if($numero >= 1000000 and $numero <= 9999999){

                     if ($numero>=1000000 and $numero<2000000){
                       $palabra='MILLON ';  }
                     else {
                     $palabra='MILLONES ';}
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 10000000 and $numero <= 99999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 100000000 and $numero <= 999999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }

  $frase=$frase.$palabra;
}
  return "$frase";
}

function numerosDecimal($numero){

 $frase='';
 $arr_num=split("[.]",$numero);
 $numero=$arr_num[0];
 while ($numero>0){

         if($numero >= 1  and $numero <= 999){
                    $palabra='';
                    $operac=$numero;
                    $frase=letras($operac,$frase);
                    $numero=0;
         }

        if($numero >= 1000 and $numero <= 9999){
                    $palabra='MIL ';
                    $operac=(int)($numero/1000);
                    if($operac>1)
                     $frase=letras($operac,$frase);
                    $numero=$numero-$operac*1000;
               }

        if($numero >= 10000 and $numero <= 99999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;
               }
        if($numero >= 100000 and $numero <= 999999){

                     $palabra='MIL ' ;
                     $operac=(int)($numero/1000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000;

               }
        if($numero >= 1000000 and $numero <= 9999999){

                     if ($numero>=1000000 and $numero<2000000){
                       $palabra='MILLON ';  }
                     else {
                     $palabra='MILLONES ';}
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 10000000 and $numero <= 99999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }
        if($numero >= 100000000 and $numero <= 999999999){

                     $palabra='MILLONES ';
                     $operac=(int)($numero/1000000);
                     $frase=letras($operac,$frase);
                     $numero=$numero-$operac*1000000;
               }

  $frase=$frase.$palabra;
}
  $operac=$arr_num[1];
  /*if($operac>0)
  	$decimales=" CON ".letras($operac,'')." CENT.";
  else
  	$decimales=" CON 0 CENT.";*/
	$decimales=" CON ".$arr_num[1]."/100";
  $frase.=$decimales;
  return "$frase";
}


function letras($operac,$frase){

 $aux_operac=$operac;

 while ($aux_operac>0) {

        if ($aux_operac==1){
          $pal='UN ';
          $aux_operac=$aux_operac-1;
          }

        if($aux_operac==2){
          $pal='DOS ';
          $aux_operac=$aux_operac-2 ;
          }

        if($aux_operac==3){
          $pal='TRES ';
          $aux_operac=$aux_operac-3;
          }

        if($aux_operac==4){
          $pal='CUATRO ';
          $aux_operac=$aux_operac-4;
          }

        if($aux_operac==5){
          $pal='CINCO ';
          $aux_operac=$aux_operac-5;
          }

       if($aux_operac==6){
          $pal='SEIS ';
          $aux_operac=$aux_operac-6;
          }

       if($aux_operac==7){
          $pal='SIETE ';
          $aux_operac=$aux_operac-7;
          }

        if($aux_operac==8){
          $pal='OCHO ' ;
          $aux_operac=$aux_operac-8;
          }

        if($aux_operac==9){
          $pal='NUEVE ';
          $aux_operac=$aux_operac-9;
          }

        if($aux_operac==10){
          $pal='DIEZ ';
          $aux_operac=$aux_operac-10;
          }

        if($aux_operac==11){
          $pal='ONCE ';
          $aux_operac=$aux_operac-11 ;
          }

        if($aux_operac==12){
          $pal='DOCE ';
          $aux_operac=$aux_operac-12;
          }

        if($aux_operac==13){
          $pal='TRECE ';
          $aux_operac=$aux_operac-13;
          }

        if($aux_operac==14){
          $pal='CATORCE ';
          $aux_operac=$aux_operac-14;
          }

        if($aux_operac==15){
          $pal='QUINCE ';
          $aux_operac=$aux_operac-15;
          }

        if($aux_operac==16){
          $pal='DIECISEIS ';
          $aux_operac=$aux_operac-16 ;
          }
        if($aux_operac==17){
          $pal='DIECISIETE ';
          $aux_operac=$aux_operac-17;
          }

        if($aux_operac==18){
          $pal='DIECIOCHO ';
          $aux_operac=$aux_operac-18 ;
          }

        if($aux_operac==19){
          $pal='DIECINUEVE ';
          $aux_operac=$aux_operac-$aux_operac;
          }

        if($aux_operac >= 20 and $aux_operac <= 29){
          $pal='VEINTE Y ';
          $aux_operac=$aux_operac-20;
          }

        if($aux_operac>= 30 and $aux_operac<= 39){
          $pal='TREINTA Y ';
          $aux_operac=$aux_operac-30;
         }

        if($aux_operac>= 40 and $aux_operac<= 49){
          $pal='CUARENTA Y ';
          $aux_operac=$aux_operac-40 ;
          }

        if($aux_operac>= 50 and $aux_operac <= 59){
          $pal='CINCUENTA Y ';
          $aux_operac=$aux_operac-50;

          }

        if($aux_operac>= 60 and $aux_operac<= 69){
          $pal='SESENTA Y ' ;
          $aux_operac=$aux_operac-60;
          }

        if($aux_operac>= 70 and $aux_operac<= 79){
          $pal='SETENTA Y ' ;
          $aux_operac=$aux_operac-70 ;
          }

        if($aux_operac>= 80 and $aux_operac<= 89){
          $pal='OCHENTA Y ' ;
          $aux_operac=$aux_operac-80 ;
          }

        if($aux_operac>= 90 and $aux_operac<= 99){
          $pal='NOVENTA Y ' ;
          $aux_operac=$aux_operac-90 ;
          }

        if($aux_operac>= 100 and $aux_operac<= 199){
          if ($aux_operac==100){
              $pal='CIEN '; }
          else {  $pal='CIENTO '; }
          $aux_operac=$aux_operac-100;
          }

        if($aux_operac>= 200 and $aux_operac<= 299){
          $pal='DOSCIENTOS ';
          $aux_operac=$aux_operac-200;
          }

        if($aux_operac>= 300 and $aux_operac<= 399){
          $pal='TRESCIENTOS ';
          $aux_operac=$aux_operac-300 ;
          }

        if($aux_operac>= 400 and $aux_operac<= 499){
          $pal='CUATROCIENTOS ';
          $aux_operac=$aux_operac-400 ;
          }

        if($aux_operac>= 500 and $aux_operac<= 599){
          $pal='QUINIENTOS ';
          $aux_operac=$aux_operac-500;
          }

        if($aux_operac>= 600 and $aux_operac<= 699){
          $pal='SEISCIENTOS ';
          $aux_operac=$aux_operac-600;
          }

        if($aux_operac>= 700 and $aux_operac<= 799){
          $pal='SETECIENTOS ';
          $aux_operac=$aux_operac-700 ;
          }

        if($aux_operac>= 800 and $aux_operac <= 899){
          $pal='OCHOCIENTOS ';
          $aux_operac=$aux_operac-800 ;
          }

        if($aux_operac>= 900 and $aux_operac <= 999){
          $pal='NOVECIENTOS ';
          $aux_operac=$aux_operac-900 ;
          }

   $frase=$frase.$pal;

    }

 $longitud=strlen($frase);
 $v=substr($frase,-2);

 if($v == 'Y '){
  $frase=substr($frase,0,$longitud-2);
 }

  return "$frase";

 }

 ?>