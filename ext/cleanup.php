<?php
// Cleanup /protected/runtime/cache/*
header("Content-Type: text/plain");
$directory = '../protected/runtime/cache';
if ($handle = opendir($directory)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
			$filepath = $directory . '/' . $file;
            echo $filepath . "\n";
			unlink($filepath);
        }
    }
    closedir($handle);
}	

?>