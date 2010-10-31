<?php
header('Content-type: application/pdf');
// header('Content-type: application/octet-stream');
header('Content-Disposition: inline; filename="'.$fname.'"');
readfile($fname);
?> 