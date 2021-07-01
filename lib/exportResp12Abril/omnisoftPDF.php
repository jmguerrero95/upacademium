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

  require('../adodb/adodb.inc.php');
  require('fpdf/fpdf.php');
  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');



//------------------------------------------------------------------------------------------------------------------------
//  CONSTANTES
//  CONSTANTES PARA EL MANEJO DE EVENTOS
//------------------------------------------------------------------------------------------------------------------------

define(OMNISOFT_VERTICAL,'P');
define(OMNISOFT_HORIZONTAL,'L');

define(OMNISOFT_VERTICAL_WIDTH,210);
define(OMNISOFT_HORIZONTAL_WIDTH,297);


$monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftPDF
//  DESCRIPCIÓN: Clase General para crear un report PDF
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftPDF extends FPDF {
               var $slogo;              // CHAR nombre del logo
               var $stitle;               // CHAR titulo
               var $stitleFontSize;        // INTtamaño de la fuente del titulo
               var $sHeader;         // CHAR cabecera
               var $sFooter;           // CHAR pie de pagina
               var $sfont;              // CHAR tipo de letra
               var $sbackgroundColor;   // INT,color del fondo
               var $sfontColor;   //  INT,color de la letra
               var $SQLCommand;        // CHAR, comando sql a ejecutar var $
               var $resultSet;           // OBJECT, resultados de la consulta var $
               var $dblink;             // OBJECT, enlace base datos var $record;
               // OBJECT, registro actual
                var $spageSize;                // INT,
               //tamaño de la pagina
               var $spageOrientation;                // INT,
               //tamaño de la pagina
               var $columnCount;                  // INT,
               //numero de columnas
               var $activeColumnArray; // OBJECT, arreglo de
               //todas las columnas

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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$ASQLCommand,$ApageOrientation='',$Afont='Arial',$AtitleFontSize=17,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=35)
                {
                 parent::__construct($ApageOrientation);
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->SQLCommand=$ASQLCommand;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->spageSize=$ApageSize;
                 $this->sfontColor=$AfontColor;
                 $this->spageOrientation=$ApageOrientation;
                 $this->columnCount=0;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)  {
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                     $this->spageSize=35;

                  }
                  else {
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                     $this->spageSize=24;

                  }
                      $this->AliasNbPages();
                      $this->connectDB();
                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName,$AtableColumnName, $Awidth=20,$Atype="string",$Aalign="left",$Acalc="",$AbackgroundColor="")
                {
                 $this->activeColumnArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "tableColumnName"=>$AtableColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "calc"=>$Acalc,
                                               "backgroundColor"=>$AbackgroundColor);
                      $this->columnCount++;
                }


                function Header()
                {
                 global $title,$monthDay,$weekDay,$omnisoftCiudad;

                 $this->Image($this->slogo,150,10,40,15);

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize);
                 if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $w=$this->GetStringWidth($this->stitle)+20;
                 else
                     $w=$this->GetStringWidth($this->stitle)+20;

                 $this->SetX(($this->spageWidth-$w)/2);
                 $this->SetTextColor(0x0,0x0,0x33);

                 $this->MultiCell(0,10,$this->stitle,'C');

                  $d=$omnisoftCiudad.",".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y")." a las ".date("H:i:s");
                  $w=$this->GetStringWidth($d);
                  if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $this->SetX(($this->spageWidth-$w)/2+25);
                  else
                     $this->SetX(($this->spageWidth-$w)/2+40);


                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
                 $this->Cell(0,10,$d);
                 $this->Ln();
                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 $this->SetFont($this->sfont,'B',$this->stitleFontSize-5);
                 $w=$this->GetStringWidth($this->sHeader);
//                 $this->SetY(20);
                $this->SetX(($this->spageWidth-$w)/2);
                  $this->MultiCell(0,3,$this->sHeader);


                //$this->Line(10,30,200,30);

                }

                function Footer()
                {

                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);

                 if ($this->spageOrientation==OMNISOFT_VERTICAL) {

                 $this->Line(10,270,$this->spageWidth,270);
                 $this->SetY(270);
                 }
                 else {
                 $this->Line(10,190,$this->spageWidth,190);
                 $this->SetY(190);
                 }



                 $this->SetFont($this->sfont,'',$this->stitleFontSize-10);

                 $this->Cell(0,10,"Página ".$this->PageNo()." de ".'{nb}',0,0,'C');
                  $this->Ln();

                 //$this->Cell(0,10,$this->sFooter,0,0,'C');
                 $this->SetX(10);
                 $this->Cell(0,10,'Ingenium, producto desarrollado por Soluciones Integrales Omnisoft',0,0,'L');
                 $this->SetX(160);
                 $this->Cell(0,10,'http://www.omnisoft.cc',0,0,'R');




                }


function printPage() {

               $this->AddPage();
               $this->SetFont($this->sfont,'',$this->stitleFontSize-10);
            //   $this->Ln(2);
               $this->SetFillColor(0x0,0x33,0x99);
               $this->SetTextColor(255);
               $this->SetDrawColor(255);
               $this->SetLineWidth(.3);

               $this->SetY(33);
               $this->SetX(20);

               foreach($this->activeColumnArray as $key => $arrayElement)
                  $this->Cell($arrayElement["width"]*2,5,$arrayElement["displayColumnName"],1,0,'C',1);
                   $this->Ln();


                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);

                $fill=0;
                $rowno=0;
//               $this->resultSet->MoveFirst();


              while ($rowno <$this->spageSize && !$this->resultSet->EOF)
                     {
                          $this->SetX(20);

                           foreach($this->activeColumnArray as $key => $arrayElement) {
						   $rec=substr($this->resultSet->fields[$arrayElement["tableColumnName"]],0,$arrayElement["width"]);
                                  if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"]*2,5,$rec,'LR',0,'L',$fill);
                                  else
                                         $this->Cell($arrayElement["width"]*2,5,number_format($rec),'LR',0,'L',$fill);
                            }
                           $this->Ln();
                           $fill=!$fill;
                            $rowno++;
                           $this->resultSet->MoveNext();
                      }

}

             function ShowIt() {


              $this->resultSet=$this->dblink->Execute($this->SQLCommand);
              while (!$this->resultSet->EOF)
                      $this->printPage();

              $this->Output();
            }


                //  NOMBRE:  connectDB
                //  DESCRIIPCIÓN:  despliega el Grid
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function connectDB()
                {

                                global $DBConnection;

                 $this->dblink = NewADOConnection($DBConnection);



                 if (!$this->dblink)
                     die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

                }


}
?>
