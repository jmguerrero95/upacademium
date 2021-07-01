<?php
 header("Expires: Tue, 21 May 1999 12:34:56 GMT ");
 header('Content-Type: text/xml');
 header('Content-Disposition: attachment; filename="omnisoft.xml"');
 header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
 header("Pragma: public");


require ("omnisoftXML.php");

 $sql=str_replace("\"", "'",$_POST['query']);
 $sql=str_replace("\'", "'",$sql);
 $sql=str_replace("\x5C", "\x5C\x5C",$sql);

 $xml = new OmnisoftXML($sql);
 $xml->exportToScreen();

?>
