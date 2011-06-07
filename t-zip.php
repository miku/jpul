Zip installed?

<?php
    $zip = new ZipArchive();
    $filename = "./t-zip-test.zip";

    if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    $zip->addFile("./t-zip.php");
    echo "numfiles: " . $zip->numFiles . "\n";
    echo "status:" . $zip->status . "\n";
    $zip->close();
    
?>