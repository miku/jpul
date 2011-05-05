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
	.line {
		margin: 10px 0 10px 0;
		border-bottom: solid thin gray;
	}
</style>

<div id="main-container">
	<div id="main">
		<div id="main-header">
				
			<span class="alignleft"><p>Stats - Outbound</p></span>
			<span class="alignright"><a href="<?php echo $this->createUrl('stats/index') ?>">Zurück zur Übersicht</a></span>
			<div class="clear"></div>

		</div>
		<div id="main-content">

			<div class="col-by-total">
			<?php foreach ($outbound as $key => $value): ?>
				<li>
					<?php echo time_since($value['request_time']); ?> | <a href="<?php echo ($value['url']); ?>"><?php echo ($value['url']); ?></a> | <?php echo ($value['text']); ?>
				</li>
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

