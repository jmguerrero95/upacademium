<?php
//------------------------------------------------------------------------------------------------------------------------
//  PROYECTO: Librerias para manejo de Reportes en PDF
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: OmnisoftGrid.php
//  DESCRIPCIÓN: Archivo que contiene la clase de creación de PDFs
//  FECHA DE CREACIÓN: 07-Agosto-2005
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------

//define('FPDF_FONTPATH','C:\\Archivos de programa\\Apache Group\\Apache\\htdocs\\OmnisoftGrid\\lib\\fpdf\\font');

//require('adodb/adodb.inc.php');

include "charts.php";

//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftChart {

               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $dsn;              // CHAR, database source name
               var $SQLCommand;        // CHAR, comando sql a ejecutar
               var $resultSet;           // OBJECT, resultados de la consulta
               var $dblink;             // OBJECT, enlace base datos
               var $record;             // OBJECT, registro actual
               var $columnCount;                  // INT, numero de columnas
               var $columnArray; // OBJECT, arreglo de todas las columnas
               var $chart=array();
               var $labels=array();
               var $values=array();
               var $records=array();




                //  NOMBRE:  OmnisoftPDF
                //  DESCRIIPCIÓN:  Crea un reporte PDF
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  2)       Atitle              char        25            nombre de la pagina que invoca al grid
                //  3)       Aform              char        25            nombre del formulario de ingreso y edicion de datos
                //  4)       Adsn               char        100           cadena de conexion a la base de datos
                //  5)       Atable             char        100           tabla a afectar
                //  6)       ASQLCommand        char        100           comando sql para la seleccion de datos
                //  7)       Aheight            int        25             alto del grid
                //  8)       Awidth             int        25             ancho del grid
                //  9)       Afont              char        25            fuente de las letras
                //  10)       AbackgroundColor   char        25            color del fondo del grid
                //  VALOR RETORNO:   objeto de la clase OmnisoftGrid

                function __construct($Atitle,$AsHeader,$AsFooter,$Afont='Arial',$AtitleFontSize=20,$aFontColor=0xf,$AbackgroundColor=0x0)
                {
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->spageSize=$ApageSize;
                 $this->sfontColor=$AfontColor;
                 $this->spageOrientation=$pageOrientation;
                 $this->columnCount=0;
                 $this->records=split('[|]',$_GET['data']);
                    $this->labels[]='';
                    $this->values[]='Barras';
                  $this->chart['chart_data'] = array ();
                  $this->chart['chart_data'][0]=array('','Barras');
                  $i=1;
                 foreach( $this->records as $value) {
                    $aux=split('[~]',$value);
                    $this->labels[]=$aux[0];
                    $this->values[]=$aux[1];
                    $this->chart['chart_data'][$i++]=array($aux[0],$aux[1]);

                 }

                //  $this->chart['chart_data'] = array ($this->labels,$this->values);

                 $this->chart['grid_h'] = array (   'thickness'  =>  2, 'color'      =>  "000000",   'alpha'      =>  15,  'type'       =>  "dotted" );
                 $this->chart['pref'] = array ( 'rotation_x'=>30 );
                 $this->chart[ 'chart_rect' ] = array ( 'x'=>180, 'y'=>60, 'width'=>350, 'height'=>300, 'positive_alpha'=>0 );
                 $this->chart[ 'chart_transition' ] = array ( 'type'=>"spin", 'delay'=>0, 'duration'=>.1, 'order'=>"category" );
                 $this->chart[ 'chart_type' ] = "Stacked 3d column";
                 $this->chart[ 'chart_value' ] = array ( 'color'=>"000000", 'alpha'=>65, 'font'=>"arial", 'bold'=>true, 'size'=>8, 'position'=>"inside", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );

                 $this->chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"44aaff", 'alpha'=>90, 'size'=>30, 'x'=>5, 'y'=>350, 'width'=>250, 'height'=>50, 'text'=>"$this->stitle", 'h_align'=>"center", 'v_align'=>"middle" )) ;


                 $this->chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'bullet'=>"circle", 'font'=>"arial", 'bold'=>true, 'size'=>8, 'color'=>"000066", 'alpha'=>85 );
                 $this->chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>25, 'width'=>50, 'height'=>220, 'margin'=>10, 'fill_color'=>"ffffff", 'fill_alpha'=>10, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
                 $this->chart[ 'legend_transition' ] = array ( 'type'=>"drop", 'delay'=>0, 'duration'=>0 );

                 $this->chart[ 'series_color' ] = array ( "00ff88", "ffaa00","44aaff", "aa00ff","99aaff","88ff88" );
                 $this->chart[ 'series_explode' ] = array ( 10, 15, 5, 10,5,10 );





                 }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno


                function draw() {
                 SendChartData ($this->chart);

                }

}
   $objChart=new omnisoftChart('nutrileche','cabecera','pie');

   $objChart->draw();






?>
