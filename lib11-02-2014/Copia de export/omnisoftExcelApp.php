<?php
require('omnisoftExcel.php');

	$sql=str_replace("\"", "'",$_POST['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);



header("Content-Type: application/x-msexcel");

  $fields=$_POST['fields'];
  $excelOBJ=new OmnisoftExcel($imagePath.'/logo.jpg',$omnisoftNombreEmpresa,'Sistema de Informacion INGENIUM',$omnisoftNombreEmpresa,$sql);
  $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields) ; $i++) {
    $field=explode('~',$sFields[$i]);

    $excelOBJ->addColumn($field[0],$field[1]);
   }
  $excelOBJ->showIt();

 $fname = tempnam("c:\\tmp", "omnisoftExcelApp.xls");
 $fh=fopen($fname, "rb");
 fpassthru($fh);
 unlink($fname);
?>