<?php 

    if (@preg_match('/\pL/u', 'a') == 1) {
        echo "PCRE unicode support is turned on.\n";
    } else {
        echo "PCRE unicode support is turned off.\n";
    }

?>