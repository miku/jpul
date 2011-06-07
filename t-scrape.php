<?php

    include("t-simple-html-dom.php");
    $html = file_get_html('http://www.zv.uni-leipzig.de/studium/career-center/aktuelles.html');
    $offers = array();
    foreach($html->find('p') as $e) {
        if (strpos($e->innertext, "qualifizierungsangebote")) { 
            array_push($offers, $e->innertext); 
        }
    }

    print_r($offers);

?>
 