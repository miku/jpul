<?php
    $f = '.';
    $io = popen ( '/usr/bin/du -ks ' . $f, 'r' );
    $output = fgets ( $io, 4096);
    $result = preg_split('/\s/', $output);
	$size = $result[0];
    pclose ( $io );

	$size_in_gb = $size / 1048576;
	// du output in kB 

	$directory = "./uploads/";
	$filecount = 0;
	if (glob("$directory*.pdf") != false) {
	 	$filecount = count(glob("$directory*.pdf"));
	}
	
	echo $filecount;
	
	// Jobs added
	$_30d = 2592000;
	$sql = "select count(*) as jobs_added_last_30_d from job where 
			date_added > " . (time() - $_30d) . " and date_added < " . time() . " ;";
	
	$connection = Yii::app()->db;
	$command = $connection->createCommand($sql);
	
	$dataReader = $command->queryRow();
	
	$jobs_added_last_30_d = $dataReader["jobs_added_last_30_d"];
	
	// 2.5 is 2.5GB -- the critical threshold at the moment
	$runway = $filecount / $size_in_gb * 2.5 / $jobs_added_last_30_d * 30;
	
?>

<h1 class="spacetop">Speicherbelegung</h1>
	<?php if ($size_in_gb <= 1): ?>
		<p><span style="color: green"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php elseif ($size_in_gb > 1 && $size_in_gb <= 2): ?>
		<p><span style="color: orange"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php elseif ($size_in_gb > 2): ?>
		<p><span style="color: red; font-weight: bold"><?php echo sprintf('%.5f', ($size / 1048576)) . " GB" ?></span></p>
	<?php endif ?>
	<p class="dimmed">Es gibt ein Quota von 3GB auf dem Host-Rechner.
		Eine Erhöhung des Quota für den Account 'jobp' kann beim URZ beantragt werden. 
		Kontakt: <a href="mailto:heiko.schwarzenberg@uni-leipzig.de">Heiko Schwarzenberg</a> (Stand Juli 2011)</p>

	<p class="dimmed">Runway: <?php echo sprintf('%.3f', $runway) ?> Tage</p>
