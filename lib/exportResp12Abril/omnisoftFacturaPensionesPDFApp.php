<?php

        require('omnisoftPDFIndividualMultiple.php');
        require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
        $query=$_GET['query'];

        $query=explode('|',$query);
        $filtro='';
        $campo='';
        $fecha='';
        $numero='';


  	for ($i=1; $i < count($query); $i++) {
		   $campo=explode('=',$query[$i]);
                   if ( $campo[1]!='' && $campo[1]!='""' && $campo[1]!='"TODOS"' && $campo[1]!='"0.00"' && $campo[1]!='"0000-00-00"' && $campo[1]!='"0"')
                      if ($campo[0]=='serial_mes')
		          $filtro=$filtro.' and '.'meses.'.$query[$i];
                      else
                      if ($campo[0]=='serial_per')
		      $filtro=$filtro.' and '.'paralelo.'.$query[$i];
		      else
                      if ($campo[0]=='serial_sec')
		      $filtro=$filtro.' and '.'nivel.'.$query[$i];
		      else
                      if ($campo[0]=='serial_niv')
		      $filtro=$filtro.' and '.'nivel.'.$query[$i];
		      else
                      if ($campo[0]=='serial_par')
		      $filtro=$filtro.' and '.'paralelo.'.$query[$i];
		      else
                      if ($campo[0]=='serial_alu')
		      $filtro=$filtro.' and '.'alumno.'.$query[$i];
		      else

		      if ($campo[0]=='apellido_alu') {
                       $campos=explode('"',$campo[1]);
                      $filtro=$filtro.' and '.'alumno.'.$campo[0].' like "'.$campos[1].'%"';
                      }
		      else {
                           $fecha=explode('fechaInicio',$campo[0]);
                            $campos=explode('"',$campo[1]);

                            if (count($fecha)>1) {
                               $campos=explode('"',$campo[1]);
		               $filtro=$filtro.' and '.'cabecerafactura.fecha'.$fecha[0].$fecha[1].' >= "'.$campos[1].'"';
		             }

                            else  {
                                   $fecha=explode('fechaFin',$campo[0]);
                                   $campos=explode('"',$campo[1]);
                                   if (count($fecha)>1)
	      	                      $filtro=$filtro.' and '.'cabecerafactura.fecha'.$fecha[0].$fecha[1].' <= "'.$campos[1].'"';
                           else  {
                             $numero=explode('numeroInicio',$campo[0]);
                             $campos=explode('"',$campo[1]);

                             if (count($numero)>1)
		               $filtro=$filtro.' and '.'cabecerafactura.numero'.$numero[0].$numero[1].' >= "'.$campos[1].'"';
                            else  {
                             $numero=explode('numeroFin',$campo[0]);
                             $campos=explode('"',$campo[1]);

                                   if (count($numero)>1)
	      	                      $filtro=$filtro.' and '.'cabecerafactura.numero'.$numero[0].$numero[1]+' <= "'.$campos[1].'"';
                                   else


                           if ($campo[0]=='estado_caf') {
                                        if ($campo[1]=='"VENCIDA"') {
                                       $campos=explode('"',$campo[1]);
		                                 $filtro=$filtro.' and '.'(cabecerafactura.'.$campo[0].' <> \'PAGADA\' and cabecerafactura.'.$campo[0].' <> \'ANULADA\')';
		                                      }
										else {
		                                 $filtro=$filtro.' and '.'cabecerafactura.'.$campo[0].' = "'.$campos[1].'"';
                                                 }
							        }
									else  {
                                                             $campos=explode('"',$campo[1]);

		                                 $filtro=$filtro.' and '.'cabecerafactura.'.$campo[0].' like "'.$campos[1].'%"';
		                                  }
                               }
		               }
		               }
                      }
		}
			//alert(filtro);

  $SQLMaster="SELECT serial_caf, nombre_mes, nombre_sec,nombre_niv,nombre_par,numero_caf, fecha_caf, direcc_alu,apellido_alu, nombre_alu, apellido_pad,nombre_pad,codigoIdentificacion_pad,total_caf, abono_caf, estado_caf, cabecerafactura.serial_paralu, mes_caf, alumno.serial_alu FROM seccion, nivel, paralelo, meses, alumno,padres,padres_alumno, cabecerafactura, paralelo_alumno WHERE padres_alumno.serial_alu=alumno.serial_alu and padres.serial_pad=padres_alumno.serial_pad and seccion.serial_sec = nivel.serial_sec  AND nivel.serial_niv = paralelo.serial_niv and paralelo.serial_par=paralelo_alumno.serial_par AND paralelo_alumno.serial_paralu = cabecerafactura.serial_paralu AND alumno.serial_alu = paralelo_alumno.serial_alu AND meses.serial_mes = cabecerafactura.mes_caf";
  $SQLDetail="select serial_dfa, nombre_ara,   valor_aal FROM aranceles,cabecerafactura,detallefactura where aranceles.serial_ara=detallefactura.serial_ara and cabecerafactura.serial_caf=detallefactura.serial_caf and detallefactura.serial_caf=_masterkey_";
//  echo $SQLMaster."<br>";
//  echo $SQLDetail."<br>";

  $printOBJ=new OmnisoftPDFIndividualMultiple('serial_caf',$SQLMaster,$SQLDetail,$imagePath."/logo.jpg",$omnisoftNombreEmpresa,'FACTURA','INGENIUM - ERP::ENTERPRISE RESOURCE PLANNING');




    $printOBJ->addColumn('Fecha:   ',45,'fecha_caf',5,5);
    $printOBJ->addColumn('Numero:  ',15,'numero_caf',150,5);
    $printOBJ->addColumn('Alumno:  ',55,'apellido_alu',5,10);
    $printOBJ->addColumn(' ',45,'nombre_alu',65,10);
    $printOBJ->addColumn('Seccion:  ',45,'nombre_sec',5,15);
    $printOBJ->addColumn('Curso:  ',45,'nombre_niv',60,15);
    $printOBJ->addColumn('Paralelo:  ',45,'nombre_par',120,15);
    $printOBJ->addColumn('Cliente: ',45,'apellido_pad',5,20);
    $printOBJ->addColumn(' ',45,'nombre_pad',65,20);
    $printOBJ->addColumn('RUC:',30,'codigoIdentificacion_pad',150,20);
    $printOBJ->addColumn('Dirección:',45,'direcc_alu',5,25);
    $printOBJ->addColumn('Mes:       ',45,'nombre_mes',5,30);

    $printOBJ->addColumnDetail(' ',40,'nombre_ara',5,38,'string','right');
    $printOBJ->addColumnDetail(' ',20,'valor_aal',53,38,'number','right','sum');

    $printOBJ->showIt();


?>