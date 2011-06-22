<?php
	header("Content-Type: text/plain");
    $f = '.';
    $io = popen ( '/usr/bin/du -ks ' . $f, 'r' );
    $output = fgets ( $io, 4096);
    $result = preg_split('/\s/', $output);
	$size = $result[0];
    pclose ( $io );
	// du output in kB 
    echo $f . ' => ' . $size / 1048576;
?>