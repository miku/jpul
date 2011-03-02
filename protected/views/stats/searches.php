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
				
			<span class="alignleft"><p>Stats - Searches / 15.12.2010 &mdash; <?php echo date("d.m.Y") ?></p></span>
			<span class="alignright"><a href="<?php echo $this->createUrl('stats/index') ?>">Zurück zur Übersicht</a></span>
			<div class="clear"></div>

		</div>
		<div id="main-content">

			
			<div class="col-by-total">
				<p>Letzte Suchanfragen</p><br>
			<?php foreach ($recent as $key => $value): ?>
				<li><?php echo time_since($value['request_time']); ?> 
					<a href="<?php echo ($value['uri']); ?>"><?php echo preg_replace('/(.*)(q=)(.*)/', '$3', $value['uri']); ?></a>
				</li>
			<?php endforeach ?>
			</div>

			<div class="line"></div>

			<div class="col-by-total">
				<p>Suchen nach Häufigkeit</p><br>
			<?php foreach ($searches as $key => $value): ?>
				<li><?php echo $value['cnt']; ?> 
					<a href="<?php echo ($value['uri']); ?>"><?php echo preg_replace('/(.*)(q=)(.*)/', '$3', $value['uri']); ?></a>
				</li>
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

