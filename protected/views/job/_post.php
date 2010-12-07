<!-- <div class="post post-highlighted">	 -->
<div class="post">
	<a class="fav-toggle" href="#"></a>
	<p class="post-title">
		<?php if (isset($original_query) && $original_query !== ""): ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id, 'from' => $original_query)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 50); ?></a> 
		<?php else: ?>
			<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 50); ?></a> 
		<?php endif ?>
				
		<span class="post-company"><?php echo cut_text($model->company, 40) ?></span>
		<span class="post-posted"><?php echo time_since($model->date_added) ?></span>
	</p>
	<p class="post-location">
		<?php echo format_model_location($model); ?>		
	</p>
	<p class="post-description-teaser"><?php echo cut_text($model->description, 100) ?></p>
</div>
