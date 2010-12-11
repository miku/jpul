<?php if (isset(Yii::app()->session['ufk__v3']) && count(Yii::app()->session['ufk__v3']) > 0): ?>
	<?php if (isset($fav_view) && ($fav_view)): ?>
		<a class="fav-link" href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Übersicht</a>
	<?php else: ?>
		<a class="fav-link" href="<?php echo $this->createUrl('job/index', array('s' => "favs")) ?>">Meine Favoriten anzeigen (<?php echo count(Yii::app()->session['ufk__v3']) ?>)</a>			
	<?php endif ?>
<?php endif ?>

