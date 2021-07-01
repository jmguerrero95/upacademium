<?php
  require_once('Worksheet.php');
  require_once('Workbook.php');

  // Creating a workbook
  $workbook = new Workbook("-");
  // Creating the first worksheet
  $worksheet =& $workbook->add_worksheet('ejecutivos');

  $formatoTitulo =& $workbook->add_format();
  $formatoTitulo->set_size(16);
  $formatoTitulo->set_align('center');
  $formatoTitulo->set_color('white');
  $formatoTitulo->set_pattern();
  $formatoTitulo->set_fg_color('navy');

  // Format for the headings
  $formatot =& $workbook->add_format();
  $formatot->set_size(10);
  $formatot->set_align('center');
  $formatot->set_color('white');
  $formatot->set_pattern();
  $formatot->set_fg_color('navy');
  //$worksheet2->insert_bitmap(0,1, 'c:\tmp\logo_movistar.bmp');

  $worksheet->write_string(0,2,"Ejecutivos Movistar",$formatoTitulo);


  $worksheet->set_column(0,0,15);
  $worksheet->set_column(1,2,30);
  $worksheet->set_column(3,3,15);
  $worksheet->set_column(4,4,10);

  $worksheet->write_string(3,0,"Id",$formatot);
  $worksheet->write_string(3,1,"Name",$formatot);
  $worksheet->write_string(3,2,"Adress",$formatot);
  $worksheet->write_string(3,3,"Phone Number",$formatot);
  $worksheet->write_string(3,4,"Salary",$formatot);

  $worksheet->write(4,0,"22222222-2");
  $worksheet->write(4,1,"John Smith");
  $worksheet->write(4,2,"Main Street 100");
  $worksheet->write(4,3,"02-5551234");
  $worksheet->write(4,4,100);
  $worksheet->write(5,0,"11111111-1");
  $worksheet->write(5,1,"Juan Perez");
  $worksheet->write(5,2,"Los Paltos 200");
  $worksheet->write(5,3,"03-5552345");
  $worksheet->write(5,4,110);
  $worksheet->write_string(6,0,"11111111-1");
  $worksheet->write_string(6,1,"Another Guy");
  $worksheet->write_string(6,2,"Somewhere 300");
  $worksheet->write_string(6,3,"03-5553456");
  $worksheet->write(6,4,108);


  // Calculate some statistics
  $worksheet->write(7, 0, "Average Salary:");
  $worksheet->write_formula(7, 4, "= AVERAGE(E4:E6)");
  $worksheet->write(8, 0, "Minimum Salary:");
  $worksheet->write_formula(8, 4, "= MIN(E4:E6)");
  $worksheet->write(9, 0, "Maximum Salary:");
  $worksheet->write_formula(9, 4, "= MAX(E4:E6)");

  //$worksheet2->insert_bitmap(0, 0, "some.bmp",10,10);

  $workbook->close();


  //añadir

  header("Content-Type: application/x-msexcel");
 $fname = tempnam("/tmp", "merge2.xls");
 $fh=fopen($fname, "rb");
 fpassthru($fh);
  unlink($fname);

?>