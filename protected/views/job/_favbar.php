<?php if (isset(Yii::app()->session[Yii::app()->params['favStore']])): ?>		
	<?php if (mb_strlen($_SERVER['QUERY_STRING']) > 0 && (preg_match("/s=favs/i", $_SERVER['QUERY_STRING']) > 0 || preg_match("/s=favs/i", $_SERVER['HTTP_REFERER']) > 0)): ?>
		<?php if (count(Yii::app()->session[Yii::app()->params['favStore']]) == 0): ?>
			<a class="fav-link" href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Übersicht</a>
		<?php else: ?>
			<a class="fav-link" href="<?php echo $this->createUrl('job/index', array('s' => "favs")) ?>">Meine Favoriten anzeigen (<strong><?php echo count(Yii::app()->session[Yii::app()->params['favStore']]) ?></strong>)</a>
			| <a href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Übersicht</a>
		<?php endif ?>
	<?php else: ?>
		<?php if (count(Yii::app()->session[Yii::app()->params['favStore']]) > 0): ?>
			<a class="fav-link" href="<?php echo $this->createUrl('job/index', array('s' => "favs")) ?>">Meine Favoriten anzeigen (<strong><?php echo count(Yii::app()->session[Yii::app()->params['favStore']]) ?></strong>)</a>			
		<?php endif ?>
	<?php endif ?>
<?php endif ?>
