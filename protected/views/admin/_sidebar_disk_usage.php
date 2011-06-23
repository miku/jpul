<?php
    $f = '.';
    $io = popen ( '/usr/bin/du -ks ' . $f, 'r' );
    $output = fgets ( $io, 4096);
    $result = preg_split('/\s/', $output);
	$size = $result[0];
    pclose ( $io );

	$size_in_gb = $size / 1048576;
	// du output in kB 
?>

<h1 class="spacetop">Speicherbelegung</h1>
	<?php if ($size_in_gb <= 1): ?>
		<p><span style="color: green"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php elseif ($size_in_gb > 1 && $size_in_gb <= 2): ?>
		<p><span style="color: gray"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php elseif ($size_in_gb > 2): ?>
		<p><span style="color: red"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php endif ?>
	<p class="dimmed">Es gibt ein Quota von 3GB auf dem Host-Rechner.
		Eine Erhöhung des Quota für den Account 'jobp' kann beim URZ beantragt werden. 
		Kontakt: Heiko Schwarzenberg (Stand Juli 2011)</p>
	
