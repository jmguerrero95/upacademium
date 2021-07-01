<?php


require_once 'excel/reader.php';

function leapYear($year) {
  if ($year%4!=0)
     return false;
   if ($year % 100 != 0) { 

       return true;
	}   
   if ($year % 400 != 0) 
                return false; 
    else 
                return true;  
}
function procesarFecha($valor) { 
$year= ($valor/365)+1900;
$month=floatVal(($valor%365)/30);
$day=floatVal(($valor%365)%30);
$v=$valor-($valor%365/30)*$month;
if ($v!=0)
   $day++;
   
if (leapYear($year)) 
    $day++;


$fecha=sprintf("%04d-%02d-%02d",$year,$month,$day);

return $fecha;	


}


 class OmnisoftExcelReader {
               var $filename;        // CHAR, nombre del archivo a leer
               var $record;             // OBJECT, registro actual
               var $columnCount;                  // INT, numero de columnas
               var $rowCount;           //INT, numero de filas
               var $worksheet;           // OBJECT, contiene el objeto para el manejo de la hoja
               var $dataProcess;           // FUNCTION, permite procesar los datos de la hoja excel

                //  NOMBRE:  OmnisoftExcelReader
                //  DESCRIIPCIÓN:  Lee un archivo excel
                //  PARÁMETROS:
                //           NOMBRE             TIPO       LONGITUD         DESCRIPCIÓN
                //  5)       Afilename             char        100           nombre del archivo
                //  VALOR RETORNO:   objeto de la clase OmnisoftExcelReader

                function __construct($Afilename,$AdataProcess)
                {

                 $this->filename=$Afilename;
                 $this->columnCount=0;
                 $this->rowCount=0;
                 $this->worksheet = new Spreadsheet_Excel_Reader();
                 $this->worksheet->setOutputEncoding('CP1251');
                 $this->dataProcess=$AdataProcess;
                }


          function readSheet() {

              $this->worksheet->read($this->filename);

              $this->rowCount=$this->worksheet->sheets[0]['numRows'];
              $this->columnCount=$this->worksheet->sheets[0]['numCols'];
              for ($i = 1; $i <= $this->worksheet->sheets[0]['numRows']; $i++)  {
                  $this->record="";
					
	          for ($j = 1; $j <= $this->worksheet->sheets[0]['numCols']; $j++)   {

                     $this->record.=$this->worksheet->sheets[0]['cells'][$i][$j]."~".$this->worksheet->sheets[0]['cellsInfo'][$i][$j]['type']."|";

                  }

                    $comando=$this->dataProcess."(".$i.",".$this->worksheet->sheets[0]['numCols'].",'".$this->record."');";
                    eval($comando);
              }

          }

}

?>
