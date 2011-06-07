<?php ob_start("ob_gzhandler"); ?>
    Hello, am I gzipped yet?
<?php ob_end_flush(); ?>
