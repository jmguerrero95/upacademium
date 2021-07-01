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

  require('fpdf/fpdf.php');
  require('../../config/config.inc.php');





//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

define(OMNISOFT_VERTICAL,1);
define(OMNISOFT_HORIZONTAL,2);

define(OMNISOFT_VERTICAL_WIDTH,210);
define(OMNISOFT_HORIZONTAL_WIDTH,297);


/*define(OMNISOFT_DELETE_EVENT,3);
define(OMNISOFT_SAVE_EVENT,4);
define(OMNISOFT_SEARCH_EVENT,5);
define(OMNISOFT_LOAD_EVENT,6);
*/
$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftPDFIndividual extends FPDF {
               var $slogo;              // CHAR nombre del logo
               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $spageSize;                // INT, tamaño de la pagina
               var $spageOrientation;                // INT, tamaño de la pagina
               var $columnCount;                  // INT, numero de columnas
               var $activeColumnArray; // OBJECT, arreglo de todas las columnas
               var $columnDetailCount;                  // INT, numero de columnas
               var $activeColumnDetailArray; // OBJECT, arreglo de todas las columnas

                //  NOMBRE:  OmnisoftPDF
                //  DESCRIIPCIÓN:  Crea un reporte PDF
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Alogo              char        25            nombre del grid
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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$Afont='Arial',$AtitleFontSize=18,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=35,$ApageOrientation=OMNISOFT_VERTICAL)
                {
                 parent::__construct();
                 $this->slogo=$Alogo;
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
                 $this->columnDetailCount=0;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                  else
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                      $this->AliasNbPages();
                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName, $Awidth=20,$value=0,$posX=0,$posY=0,$Atype="string",$Aalign="left",$Afont='Arial',$Asize='18')
                {
                 $this->activeColumnArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "value"=>$value,
                                               "posX"=>$posX,
                                               "posY"=>$posY,
												"font"=>$Afont,
												"size"=>$Asize);
                      $this->columnCount++;
                }


                function Header()
                {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;

                 $this->Image($this->slogo,50,6,109,26);

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize);

                 $w=$this->GetStringWidth($this->stitle)+80;
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->SetTextColor(0x0,0x0,0x33);

                 $this->MultiCell(0,10,$this->stitle);

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  $this->SetX(($this->spageWidth-$w)/2+10);

                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 //$this->Cell(0,10,$d);
                 $this->Ln();
                 $this->SetDrawColor(0x0,0x0,0x33);
                 //$this->SetLineWidth(0.4); Descomentar para utilizar la imagen logo.jpg

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize-10);
                 $w=$this->GetStringWidth($this->sHeader)+60;
                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->MultiCell(0,10,$this->sHeader);


                 $this->Line(10,33,200,33);

                }


                function Footer()
                {

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->Line(10,270,200,270);



                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                  $this->SetY(270);

     //            $this->Cell(0,10,"Página ".$this->PageNo()." de ".'{nb}',0,0,'C');
                  $this->Ln();

                 $this->Cell(0,10,$this->sFooter,0,0,'C');

                }




function printPage() {

               $this->AddPage();
               $this->SetFont($this->sfont,'',$this->stitleFontSize-12);
               $posX=5;
               $posY=35;

               $this->Ln($posY);
               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);
               $this->SetDrawColor(255);
               $this->SetLineWidth(.3);

                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);

                $fill=0;
                $rowno=0;


                       $rx=$posX; $ry=$posY;

                           foreach($this->activeColumnArray as $key => $arrayElement) {

                             $this->SetY($posY+$arrayElement["posY"]);
                             $this->SetX($posX+$arrayElement["posX"]);
			     $this->SetFont($arrayElement["font"],'',$arrayElement["size"]);

                             $width=strlen($arrayElement["displayColumnName"])*3;
                             if ($width>$arrayElement["width"]) {
                               $width=$arrayElement["width"];
                             }

                             $this->Cell($width,7,$arrayElement["displayColumnName"],1,0,'L',0);

                             $width=$arrayElement["width"];
			    // $rec=substr($arrayElement["value"],0,$width);
                               $rec=$arrayElement["value"];
     	//			$this->setFont($arrayElement["font"]," ",$arrayElement["size"]);
	                              if  ( $arrayElement["type"]=="string")
                                         $this->Cell($arrayElement["width"]-2,6,$rec,'L',0,'L',$fill);
                                  else  if  ( $arrayElement["type"]=="number")
                                         $this->Cell($arrayElement["width"]-2,6,number_format($rec),'L',0,'L',$fill);
                                  else   $this->Image($rec,$posX+$arrayElement["posX"],$posY+$arrayElement["posY"],18,18);
                            }




                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);


                           //$this->Line(10,100,200,100);
                            // Datos Personales
                            $this->SetY(60);
                             $this->Cell(200,6,'DATOS PERSONALES DEL ALUMNO','LR',0,'C',0);
                             $this->Rect(10,60,190,60);
                             $this->Line(10,65,200,65);
                             $this->Line(10,85,200,85);
                             $this->Line(10,102,200,102);

                            $this->SetY(125);
                             $this->Cell(200,6,'REFERENCIAS FAMILIARES','LR',0,'C',0);
                             $this->Rect(10,125,190,45);
                             $this->Line(10,130,200,130);

                            $this->SetY(175);
                             $this->Cell(200,6,'REPRESENTANTE ACADEMICO','LR',0,'C',0);
                             $this->Rect(10,175,190,30);
                             $this->Line(10,180,200,180);


                             $this->SetDrawColor(255);

}




            function ShowIt() {


              $this->printPage();

              $this->Output();
            }

                function Rectangle($x,$y,$w,$h) {
                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->Line($x,$y,$w,$h);

                }



}
?>
