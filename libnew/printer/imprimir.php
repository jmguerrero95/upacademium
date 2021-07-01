<?php
$handle = printer_open("\\\\DESARROLLO\\EPSON ");
printer_write($handle, "Factura");
printer_close($handle);
?>

?>