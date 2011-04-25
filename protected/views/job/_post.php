<!-- <div class="post post-highlighted">	 -->
<div class="post" name="post-<?php echo $model->id; ?>">
	
<!-- <a class="fav-toggle" href="<?php echo $this->createUrl('job/toggleFavorite', array('id' => $model->id));?>"></a> -->


<?php if (isset(Yii::app()->session[Yii::app()->params['favStore']]) && in_array_2($model->id, Yii::app()->session[Yii::app()->params['favStore']])): ?>
	<?php echo CHtml::ajaxLink("", 
                              $this->createUrl('job/toggleFavorite', array('id' => $model->id)), 
                              array('update' => '#fav-subbar'),
							  array('class' => 'fav-toggle isfav', 'href' => '#post' . $model->id, 'title' => "Aus der Favoritenliste entfernen" )); ?>
<?php else: ?>
	<?php echo CHtml::ajaxLink("", 
                              $this->createUrl('job/toggleFavorite', array('id' => $model->id)), 
                              array('update' => '#fav-subbar'),
							  array('class' => 'fav-toggle', 'href' => '#post' . $model->id, 'title' => "Zu meinen Favoriten hinzufügen" )); ?>
<?php endif ?>


	
	<p class="post-title">
		<?php if (isset($original_query) && $original_query !== ""): ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id, 'from' => $original_query)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 65); ?></a> 
		<?php else: ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 65); ?></a> 
		<?php endif ?>
				
		
		<span class="post-posted"><?php echo time_since($model->date_added) ?></span>
	</p>
	<p>
		<span class="post-location"><?php echo cut_text(format_model_location($model), 80); ?> &middot;</span>
		<span class="post-company"><?php echo cut_text($model->company, 40) ?></span>
	</p>
	<p class="post-description-teaser">
		<?php if ($model->attachment != null): ?>
			<a href="<?php echo $this->createUrl('job/download', array('id' => $model->id)); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/pdf_icon_6.jpg" height="12px" alt="[]" 
					title="PDF-Anhang herunterladen" /></a>
		<?php endif ?>
		
		<?php echo cut_text(strip_tags($model->description), 90) ?>
	</p>
</div>
