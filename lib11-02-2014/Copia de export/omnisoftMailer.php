<?php
//------------------------------------------------------------------------------------------------------------------------
//  PROYECTO: Librerias para envio de Correo
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

/*
$headers = "From: myplace@here.com\r\n";
$headers .= "Reply-To: myplace2@here.com\r\n";
$headers .= "Return-Path: myplace@here.com\r\n";
$headers .= "CC: sombodyelse@noplace.com\r\n";
$headers .= "BCC: hidden@special.com\r\n";
*/

  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');

 $monthDay=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 $weekDay=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");

/*
 $MailTo='marco@omnisoft.cc';
 $Subject='Informacion Sistema Financiero Contable';
 $Headers = "Content-type: text/html\r\n";
 $From="FROM: Ingenium (Omnisoft) <marco@omnisoft.cc>\r\n";

 $sql=str_replace("\"", "'",$_GET['query']);
 $sql=str_replace("\'", "'",$sql);
 $sql=str_replace("\x5C", "\x5C\x5C",$sql);

  $fields=$_GET['fields'];

  $sFields = explode('|',$fields);

  $msg='<html><body><img src="http://www.omnisoft.cc/menu1/bot_pg_03_b.jpg">';

   for ($i=0; $i < count($sFields) ; $i++) {

    $field=explode('~',$sFields[$i]);

   // $printOBJ->addColumn($field[0],$field[1]);

   }



 $msg+='</body></html>';



 if(@mail($MailTo, $Subject, $msg,$Headers.$From)){
   echo "envie";
            return true;
        }else{
          echo "error";
            return false;
        }

  */


//------------------------------------------------------------------------------------------------------------------------
//  NOMBRE: OmnisoftMailer
//  DESCRIPCIÓN: Clase General para enviar un correo
//------------------------------------------------------------------------------------------------------------------------

         class OmnisoftMailer  {
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
               var $from;
               var $to;
               var $header;
               var $subject;
               var $content;

               // OBJECT, registro actual
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

                function __construct($Alogo,$Atitle,$AsHeader,$AsFooter,$ASQLCommand,$Ato,$Asubject='Informacion de Sistema Financiero Contable',$Afrom="Ingenium (Omnisoft) <marco@omnisoft.com.ec>\r\n",$Afont='Arial',$AtitleFontSize=17,$aFontColor=0xf,$AbackgroundColor=0x0)
                {
                 $this->slogo=$Alogo;
                 $this->stitle=$Atitle;
                 $this->stitleFontSize=$AtitleFontSize;
                 $this->sHeader=$AsHeader;
                 $this->sFooter=$AsFooter;
                 $this->SQLCommand=$ASQLCommand;
                 $this->sfont=$Afont;
                 $this->sfontColor=$AfontColor;
                 $this->sbackgroundColor=$AbackgroundColor;
                 $this->sfontColor=$AfontColor;
                 $this->columnCount=0;
                 $this->to=$Ato;
                 $this->subject=$Asubject;
                 $this->from=$Afrom;
                 $this->header="Content-type: text/html\r\n";
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
                 global $monthDay,$weekDay,$imagePath,$omnisoftCiudad;

                 $this->content='<html><body><table><tr><td><img src="'.$imagePath.$this->slogo.'"></td>';
                 $this->content.='<td>'.$this->stitle.'</td><tr></table>';

                  $d=$omnisoftCiudad.", ".$weekDay[date("w")]." ".date("d")." de ".$monthDay[date("n")]." del ".date("Y")." a las ".date("H:i:s");
                 $this->content.='<table><tr><td>'.$d.'</td><tr></table>';
                 $this->content.='<table><tr><td>'.$this->sHeader.'</td><tr></table>';
                }

                function Footer()
                {

                 $this->content.='<table><tr><td>'.$this->sFooter.'</td></tr><tr><td><center>  <a href="http://www.omnisoft.cc">www.omnisoft.cc</a></center></td><tr></table></body></html>';

                }


function printPage() {

               $this->content.='<table border="0"  bgcolor="#C0C0C0" ><tr>';
               foreach($this->activeColumnArray as $key => $arrayElement)
                $this->content.='<td>'.  $arrayElement["displayColumnName"].'</td>';
               $this->content.='</tr>';

                $fill=0;

              while (!$this->resultSet->EOF)
                     {
                          if ($fill)
                          $this->content.='<tr bgcolor="#ffffb9">';
                          else
                          $this->content.='<tr bgcolor="#dafafa">';

                           foreach($this->activeColumnArray as $key => $arrayElement) {
						   $rec=substr($this->resultSet->fields[$arrayElement["tableColumnName"]],0,$arrayElement["width"]);
                                  if  ( $arrayElement["type"]!="number")
                                  $this->content.='<td align="left">'.  $rec.'</td>';

                                  else
                                  $this->content.='<td align="right">'.  $rec.'</td>';
                            }
                           $fill=!$fill;
                          $this->content.='</tr>';

                           $this->resultSet->MoveNext();
                      }
                          $this->content.='</table>';

}

             function ShowIt() {


              $this->resultSet=$this->dblink->Execute($this->SQLCommand);
              $this->Header();
                      $this->printPage();
              $this->Footer();
             if(@mail($this->to, $this->subject, $this->content,$this->header."FROM:".$this->from)){
               echo "<script>alert('mensaje enviado exitosamente!');</script>";
                 return true;
            }else{
               echo "<script>alert('Error: No se pudo enviar mensaje, por favor revise el destinatario!');</script>";

                return false;
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



                 if (!$this->dblink)
                     die("Error Fatal: NO SE PUEDE CONECTAR A LA BASE DE DATOS");

                }


}

?>