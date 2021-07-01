<?php

        require('omnisoftGruposPDF.php');

	$sql=str_replace("\"", "'",$_GET['query']);
	$sql=str_replace("\'", "'",$sql);
	$sql=str_replace("\x5C", "\x5C\x5C",$sql);

  $printOBJ=new OmnisoftPDF($imagePath.'/logo.jpg',$_GET['title'],'','Velasco 24-38 y Veloz       Tlfno: (593-3)2961-506/507       Fax: (593-3)2961-506 ext. 111       Aptdo: 06-01-105       www.sfelipeneri.edu.ec',$sql,'P');
  $fields=$_GET['fields'];

    $sFields = explode('|',$fields);


   for ($i=0; $i < count($sFields) ; $i++) {
    $field=explode('~',$sFields[$i]);
    $printOBJ->addColumn($field[0],$field[1],$field[2]);
//   echo $field[0]."-".$field[1]."<br>";
   }

  $printOBJ->showIt();

?>