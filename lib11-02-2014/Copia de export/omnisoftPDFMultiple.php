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

         class OmnisoftPDFIndividualMultiple extends FPDF {
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
               var $rsMaster;
               var $rsDetail;
               var $dblink;
               var $masterKey;
               var $sqlMaster;
               var $sqlDetail;
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

                function __construct($masterKey,$sqlMaster,$sqlDetail,$Alogo,$Atitle,$AsHeader,$AsFooter,$Afont='Arial',$AtitleFontSize=18,$aFontColor=0xf,$AbackgroundColor=0x0,$ApageSize=35,$ApageOrientation=OMNISOFT_VERTICAL)
                {
                 parent::__construct(P,mm,Array(190,140));
                 global $DBConnection;

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
                 $this->masterKey=$masterKey;
                 $this->sqlMaster=$sqlMaster;
                 $this->sqlDetail=$sqlDetail;
                 $this->PosX=0;
                 $this->PosY=0;

                  if ($this->spageOrientation==OMNISOFT_VERTICAL)
                     $this->spageWidth=OMNISOFT_VERTICAL_WIDTH;
                  else
                     $this->spageWidth=OMNISOFT_HORIZONTAL_WIDTH;
                      $this->AliasNbPages();

                  $this->dblink = NewADOConnection($DBConnection);
                  if (!$this->dblink) die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");
                      }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName, $Awidth=20,$AtableColumnName=0,$posX=0,$posY=0,$Atype="string",$Aalign="left")
                {
                 $this->activeColumnArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "columnName"=>$AtableColumnName,
                                               "posX"=>$posX,
                                               "posY"=>$posY);
                      $this->columnCount++;
                }

                function addColumnDetail($AdisplayColumnName,$Awidth=20,$AtableColumnName, $posX=0,$posY=0,$Atype="string",$Aalign="left",$Acalc="")
                {
                 $this->activeColumnDetailArray[]=array(
                                               "idColumn"=>$this->columnCount,
                                               "displayColumnName"=>$AdisplayColumnName,
                                               "columnName"=>$AtableColumnName,
                                               "width"=>$Awidth,
                                               "type"=>$Atype,
                                               "align"=>$Aalign,
                                               "calc"=>$Acalc,
                                               "value"=>0,
                                               "posX"=>$posX,
                                               "posY"=>$posY);
                      $this->columnDetailCount++;
                }


                function Header()
                {
                }

                function Footer()
                {
                }



function printPage() {


               $sqlDet=$this->sqlDetail;
               $sqlDet=  str_replace( '_masterkey_',$this->rsMaster->fields[$this->masterKey],$sqlDet);
               $this->rsDetail=$this->dblink->Execute($sqlDet);
               $this->AddPage();
               $this->SetFont($this->sfont,'B',$this->stitleFontSize-10);
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


                         //cabecera
                           foreach($this->activeColumnArray as $key => $arrayElement) {

                             $this->SetY($posY+$arrayElement["posY"]);
                             $this->SetX($posX+$arrayElement["posX"]);
                             $width=strlen($arrayElement["displayColumnName"])*3;
                             if ($width>$arrayElement["width"]) {
                               $width=$arrayElement["width"];
                             }
                             $this->Cell($width,7,$arrayElement["displayColumnName"],1,0,'L',0);

                             $width=$arrayElement["width"];
			     $rec=substr($arrayElement["columnName"],0,$width);
                             $value=$this->rsMaster->fields[$rec];
                                  if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"],6,$value,'LR',0,'L',$fill);
                                  else
                                         $this->Cell($arrayElement["width"],6,number_format($value),'LR',0,'L',$fill);
                            }
                           //detalle
                           $offset=0;
                           while (!$this->rsDetail->EOF) {
                           foreach($this->activeColumnDetailArray as $key => $arrayElement) {
                             $this->SetY($posY+$arrayElement["posY"]+$offset);
                             $this->SetX($posX+$arrayElement["posX"]);

                             $width=strlen($arrayElement["displayColumnName"])*3;

                             if ($width>$arrayElement["width"]) {
                               $width=$arrayElement["width"];
                             }
                             $this->Cell($width,7,$arrayElement["displayColumnName"],1,0,'L',0);

                             $width=$arrayElement["width"];
			     $rec=substr($arrayElement["columnName"],0,$width);

			     $value=$this->rsDetail->fields[$rec];

      			     if ($arrayElement["calc"]!="")

       			         $this->activeColumnDetailArray[$key]["value"]=$this->activeColumnDetailArray[$key]["value"]+$value;
                             if  ( $arrayElement["type"]!="number")
                                         $this->Cell($arrayElement["width"],6,$value,'LR',0,'L',$fill);
                            else
                                         $this->Cell($arrayElement["width"],6,number_format($value),'LR',0,'R',$fill);
                            }
                            $offset+=5;
                            $this->rsDetail->MoveNext();
                           }
                                $this->SetY($posY+$arrayElement["posY"]+$offset);
                                $this->SetX($posX);
                                $this->Cell($arrayElement["width"],6,'SUBTOTAL','LR',0,'R',$fill);

                            foreach($this->activeColumnDetailArray as $key => $arrayElement) {

                                $this->SetY($posY+$arrayElement["posY"]+$offset);
                                $this->SetX($posX+$arrayElement["posX"]-30);

                                if ($arrayElement["calc"]!="")
                                 $this->Cell($arrayElement["width"]+3,6,number_format($arrayElement["value"]),'LR',0,'R',$fill);


                               }
                                //$offset+=5;
                                $this->SetY($posY+$arrayElement["posY"]+$offset);
                                $this->SetX($posX+60);
                                $this->Cell(20,6,'IVA 0%','LR',0,'R',$fill);
                                $this->Cell(10,6,'0','LR',0,'R',$fill);

                                $this->Cell(20,6,'   IVA 12%','LR',0,'R',$fill);
                                $this->Cell(10,6,'0','LR',0,'R',$fill);

                               // $offset+=5;
                                $this->SetY($posY+$arrayElement["posY"]+$offset);
                                $this->SetX($posX+120);
                                $this->Cell($arrayElement["width"],6,'TOTAL','LR',0,'R',$fill);
                            foreach($this->activeColumnDetailArray as $key => $arrayElement) {

                          //      $this->SetY($posY+$arrayElement["posY"]+$offset);
                          //      $this->SetX($posX+$arrayElement["posX"]+120);

                                if ($arrayElement["calc"]!="")
                                 $this->Cell($arrayElement["width"]+3,6,number_format($arrayElement["value"]),'LR',0,'R',$fill);
       			         $this->activeColumnDetailArray[$key]["value"]=0;


                               }


                 $this->SetDrawColor(0x0,0x0,0x33);
                 $this->SetLineWidth(0.4);
                 $this->SetDrawColor(255);

}




            function ShowIt() {
              //$this->SetAutoPageBreak(false);
               $this->rsMaster=$this->dblink->Execute($this->sqlMaster);

              while (!$this->rsMaster->EOF) {
                  $this->printPage();
                  $this->rsMaster->MoveNext();
              }

              $this->Output();
            }



}
?>
