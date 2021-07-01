<?php
//------------------------------------------------------------------------------------------------------------------------
//  PROYECTO: Librerias para manejo de archivos XML
//  DESARROLLADO POR:  Soluciones Integrales OMNISOFT Cia. Ltda.
//  AUTOR:  Marco Hernan Jarrin Lopez
//  EMAIL:  marco@omnisoft.cc
//  WEBSITE:  http://www.omnisoft.cc
//------------------------------------------------------------------------------------------------------------------------
//  TÍTULO: OmnisoftGrid.php
//  DESCRIPCIÓN: Archivo que contiene la clase de creación de PDFs
//  FECHA DE CREACIÓN: 22-Agosto-2005
//  MODIFICACIONES:
//           FECHA       AUTOR               DESCRIPCIÓN
//  1) ------------- -------------  -------------------------


  require('xml/xml_doc.php');
  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');

//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftXML
//  DESCRIPCIÓN: Clase General para crear un archivo XML
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftXML  {
               var $SQLCommand;        // CHAR, comando sql a ejecutar
               var $resultSet;           // OBJECT, resultados de la consulta
               var $dblink;             // OBJECT, enlace base datos
               var $record;             // OBJECT, registro actual
               var $xmlout;             // POINTER, gestor de salida del codigo XML
               var $xmldata;             // POINTER, contiene toda la trama XML generada
                //  NOMBRE:  OmnisoftXML
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

                function __construct($ASQLCommand)
                {

                 $this->SQLCommand=$ASQLCommand;
                 $this->connectDB();
                 $this->xmlout = new xml_doc();
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

               //  NOMBRE:  connectDB
                //  DESCRIIPCIÓN:  despliega el Grid
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  1)       Attributes         char        100            atributos de la fila seleccionada
                //  VALOR RETORNO:   ninguno

                function export()
                {
                      $this->resultSet=$this->dblink->Execute($this->SQLCommand);

                       $this->resultSet->MoveFirst();

                   $root_tag = $this->xmlout->CreateTag('data');

                   $fieldsCount=$this->resultSet->FieldCount();


                    while (!$this->resultSet->EOF)
                     {
                      $record_tag=$this->xmlout->CreateTag('record',array(),' ',$root_tag);

                           for ($i=0; $i< $fieldsCount;$i++)
                               $field_tag=$this->xmlout->CreateTag('column'.$i,array(),empty($this->resultSet->fields[$i])?'0':$this->resultSet->fields[$i],$record_tag);
                               $this->resultSet->MoveNext();
                      }




             $this->xmldata= $this->xmlout->generate();


                }
                function exportToScreen() {
                    $this->export();
                    print "$this->xmldata";

                }

                function exportToFile($file) {

                   $this->export();

                   if (!($fp = fopen($file, "w")))
                        die("no se puede crear el archivo $file");

                     $data = fwrite($fp, $this->xmldata,strlen($this->xmldata));

                     fclose($fp);


                }
}


?>
