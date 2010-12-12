<!-- <div class="post post-highlighted">	 -->
<?php if ($model->isExpired()): ?>
	<div class="post post-expired">
<?php else: ?>
	<div class="post status-<?php echo strtolower($model->status->status); ?>">
<?php endif ?>

	<p class="post-title">
		<span class="post-status status-tag-<?php echo strtolower($model->status->status); ?>"><?php echo $model->status->status ?></span>
		<?php if ($model->isExpired()): ?>
			<span class="post-status">Expired</span>
		<?php endif ?>

		<a href="<?php echo $this->createUrl('admin/view', array('id' => $model->id)); ?>" 
			title="<?php echo $model->title; ?>"><?php echo cut_text($model->title, 50); ?></a> 
		<span class="post-company"><?php echo cut_text($model->company, 40) ?></span>
		<span class="post-posted"><?php echo time_since($model->date_added) ?></span>
	</p>
	<p class="post-location">
		<?php echo format_model_location($model); ?>		
	</p>
	<p class="post-description-teaser"><?php echo cut_text($model->description, 100) ?></p>
	<?php if ($model->attachment): ?>
		Attachment: <a href="<?php echo $this->createUrl('job/download', array('id' => $model->id)); ?>"><?php echo $model->attachment ?></a>
	<?php endif ?>
	<p></p>
</div>
