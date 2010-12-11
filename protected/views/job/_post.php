<!-- <div class="post post-highlighted">	 -->
<div class="post" name="post-<?php echo $model->id; ?>">
	
<!-- <a class="fav-toggle" href="<?php echo $this->createUrl('job/toggleFavorite', array('id' => $model->id));?>"></a> -->


<?php if (isset(Yii::app()->session[Yii::app()->params['favStore']]) && in_array_2($model->id, Yii::app()->session[Yii::app()->params['favStore']])): ?>
	<?php echo CHtml::ajaxLink("", 
                              $this->createUrl('job/toggleFavorite', array('id' => $model->id)), 
                              array('update' => '#fav-subbar'),
							  array('class' => 'fav-toggle isfav', 'href' => '#post' . $model->id )); ?>
<?php else: ?>
	<?php echo CHtml::ajaxLink("", 
                              $this->createUrl('job/toggleFavorite', array('id' => $model->id)), 
                              array('update' => '#fav-subbar'),
							  array('class' => 'fav-toggle', 'href' => '#post' . $model->id )); ?>
<?php endif ?>


	
	<p class="post-title">
		<?php if (isset($original_query) && $original_query !== ""): ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id, 'from' => $original_query)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 50); ?></a> 
		<?php else: ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 50); ?></a> 
		<?php endif ?>
				
		<span class="post-company"><?php echo cut_text($model->company, 30) ?></span>
		<span class="post-posted"><?php echo time_since($model->date_added) ?></span>
	</p>
	<p class="post-location">
		<?php echo format_model_location($model); ?>		
	</p>
	<p class="post-description-teaser"><?php echo cut_text($model->description, 100) ?></p>
</div>
