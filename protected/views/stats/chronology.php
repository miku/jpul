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
				<p>Stats - Chronology</p>
		</div>
		<div id="main-content">
			
			<div class="col-by-total">
			<?php $index = 0 ?>
			<?php foreach ($stats as $key => $value): ?>
				<li <?php if ($index % 2 == 0): ?>style="background: aliceblue"<?php endif ?>><strong><?php echo $key; ?></strong>: <?php echo $value; ?></li>
				<?php $index += 1; ?>
				
				<?php if ($index % 3 == 0): ?>
					<div style="border-bottom: solid thin black; margin: 5px"></div>
				<?php endif ?>
				
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

