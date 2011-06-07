<?php
    // WHUT?
    $s = "313";
    for ($i = 0; $i < mb_strlen($s); $i++) {
        echo "<script>document.write(\"" . mb_substr($s, $i, 1) . "\");</script>" . "\n";
    }
    
?>