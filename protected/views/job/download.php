<?php
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'. $target_fname . '"');
readfile($fname);
?> 