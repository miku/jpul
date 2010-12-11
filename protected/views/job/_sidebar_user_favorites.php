<div id="userFavs">
<?php if (isset(Yii::app()->session['ufk__v3']) && count(Yii::app()->session['ufk__v3']) > 0): ?>
	<h1>Favoriten</h1>
	<div style="padding: 4px">
		<ul>
	<?php foreach (Yii::app()->session['ufk__v3'] as $key): ?>
		<li style="margin-left: 20px;"><a href="<?php echo $key['url']; ?>"><?php echo $key['title']; ?></a></li>
	<?php endforeach ?>
	</ul>
	</div>
<?php endif ?>
</div>ta