<?php
    $f = '.';
    $io = popen ( '/usr/bin/du -ks ' . $f, 'r' );
    $output = fgets ( $io, 4096);
    $result = preg_split('/\s/', $output);
	$size = $result[0];
    pclose ( $io );
	// du output in kB 
?>

<h1 class="spacetop">Speicherbelegung</h1>
	<p class="dimmed"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></p>
