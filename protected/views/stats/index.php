<style>
	.col-by-total {
		font-size: 12px;
	}
	.col-by-total li {
		list-style: none;
	}
	.small {
		font-size: 10px;
	}
</style>

<div id="main-container">
	<div id="main">
		<div id="main-header">
				<p>Stats / 15.12.2010 &mdash; <?php echo date("d.m.Y") ?></p>
		</div>
		<div id="main-content">


			<div class="col-by-total">
			<?php foreach ($stats as $key => $value): ?>
				<li><?php echo $key; ?>: <?php echo $value; ?></li>
			<?php endforeach ?>
			</div>

			<div style="margin-top: 20px;" class="browser-chart col-by-total">
				<li>Browser type distribution:</li>
				<img src="<?php echo $gcurl_browser; ?>" alt="Browser vendor distibution not available." />	
			</div>

			<div style="margin-top: 20px;" class="browser-chart col-by-total">
				<li>OS distribution:</li>
				<img src="<?php echo $gcurl_os; ?>" alt="OS distibution not available." />	
			</div>

		</div>
	</div>
</div>

