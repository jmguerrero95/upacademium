<?php
  require_once('excel/Worksheet.php');
  require_once('excel/Workbook.php');
  require_once('adodb/adodb.inc.php');
  require('../config/config.inc.php');

  $monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftExcel
//  DESCRIPCIÓN: Clase General para crear una hoja Excel
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftExcel {
               var $slogo;              // CHAR nombre del logo
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
               var $activeColumnArray; // OBJECT, arreglo de todas las columnas
               var $workbook;
               var $worksheet;
               var $titleFormat;
               var $rowCount;
                //  NOMBRE:  OmnisoftExcel
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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$Adsn,$ASQLCommand,$Afont='Arial',$AtitleFontSize=20,$AfontColor="yellow",$AbackgroundColor="navy")
                {
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->dsn=$Adsn;
                 $this->SQLCommand=$ASQLCommand;
                 $this->sfont=$Afont;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->sfontColor=$AfontColor;
                 $this->columnCount=0;
                 $this->rowCount=5;

                 $this->connectDB();

                 $this->workbook = new Workbook("-");
                 $this->worksheet =& $this->workbook->add_worksheet('Baldoré');


                }

                //  NOMBRE:  addColumn
                //  DESCRIIPCIÓN:  asigna las caracteristicas de la fila actual seleccionada
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function addColumn($AdisplayColumnName,$AtableColumnName, $Awidth=20,$Atype="string",$Aalign="left",$Acalc="",$AbackgroundColor="navy")
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
                 global $monthDay,$weekDay;

                 //$this->worksheet->insert_bitmap(0,1, 'logo_movistar.bmp');

                 $this->titleFormat =& $this->workbook->add_format();
                 $this->titleFormat->set_size(8);   //$this->stitleFontSize);
                 $this->titleFormat->set_align('center');
                 $this->titleFormat->set_color($this->sfontColor);
                 $this->titleFormat->set_pattern();
                 $this->titleFormat->set_fg_color($this->sbackgroundColor);

                  $d="Quito, ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y")." a las ".date("H:i:s");

                  $this->worksheet->write_string(0,0,$this->stitle,$this->titleFormat);
                  $this->titleFormat->set_size(8); //$this->stitleFontSize-2);
                  $this->worksheet->write_string(2,0,$this->sHeader,$this->titleFormat);
                  $this->titleFormat->set_size(8); //$this->stitleFontSize-4);
                  $this->worksheet->write_string(3,0,$d,$this->titleFormat);
                }

                function Footer()
                {
                 $this->rowCount+=3;
                 $this->worksheet->write_string($this->rowCount,2,$this->sFooter,$this->titleFormat);


                }


          function printSheet() {
                 $this->titleFormat =& $this->workbook->add_format();
                 $this->titleFormat->set_size(8); //$this->stitleFontSize);
                 $this->titleFormat->set_align('center');
                 $this->titleFormat->set_color($this->sfontColor);
                 $this->titleFormat->set_pattern();
                 $this->titleFormat->set_fg_color($this->sbackgroundColor);


                  $this->titleFormat->set_size(8); //$this->stitleFontSize-6);
                  $i=0;
               foreach($this->activeColumnArray as $key => $arrayElement)
                  $this->worksheet->write_string($this->rowCount,$i++,$arrayElement["displayColumnName"],$this->titleFormat);

               $this->resultSet=$this->dblink->Execute($this->SQLCommand);

               $this->rowCount++;
               $this->resultSet->MoveFirst();

              while (!$this->resultSet->EOF)
              {
                 $this->rowCount++;
                 $i=0;
                 $this->titleFormat->set_size(8); //$this->stitleFontSize);
 
                foreach($this->activeColumnArray as $key => $arrayElement)
                  if  ( $arrayElement["type"]!="number")
                          $this->worksheet->write_string($this->rowCount,$i++, $this->resultSet->fields[$arrayElement["tableColumnName"]],$this->cellFormat);
                  else
                          $this->worksheet->write_number($this->rowCount,$i++, $this->resultSet->fields[$arrayElement["tableColumnName"]],$this->cellFormat);
                  $this->resultSet->MoveNext();
            }

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


             //    $this->dblink = NewADOConnection($this->dsn);


                 if (!$this->dblink)
                     die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

                }

          function showIt() {
           //$this->Header();
           $this->printSheet();
   //        $this->Footer();
           $this->workbook->close();

          }

}


?>