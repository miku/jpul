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
				<p>Stats - Referer / 15.12.2010 &mdash; <?php echo date("d.m.Y") ?></p>
		</div>
		<div id="main-content">

			<div class="col-by-total">
			<?php foreach ($stats as $key => $value): ?>
				<li><?php echo $value['cnt']; ?> <a href="<?php echo ($value['referer']); ?>"><?php echo cut_text($value['referer'], 80); ?></a></li>
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

