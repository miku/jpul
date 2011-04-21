<div id="main-container">
	<div id="main">
		<div id="main-header"><h1>Noch nicht freigegebene Angebote</h1></div>
			<div id="main-content">

<ul style="list-style:none">
<?php foreach ($models as $idx => $model): ?>
	<li>
		<span style="color: gray; font-size: 10px"><?php echo time_since($model->date_added); ?></span>
		<span style=""><?php echo $model->company; ?></span>
	</li>
<?php endforeach ?>
</ul>
		
			</div>
		</div>
	</div>
</div>