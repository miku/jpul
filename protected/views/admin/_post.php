<!-- <div class="post post-highlighted">	 -->

<?php if ($model->isExpired() || $model->status_id == 3 || $model->status_id == 4): ?>
	<div class="post-expired" name="post-<?php echo $model->id; ?>">
<?php else: ?>
	<div class="post" name="post-<?php echo $model->id; ?>">
<?php endif ?>

	
	<p class="post-title">
		<?php if (isset($original_query) && $original_query !== ""): ?>
			<a href="<?php echo $this->createUrl('admin/view', array('id' => $model->id, 'from' => $original_query)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 65); ?></a> 
		<?php else: ?>
			<a href="<?php echo $this->createUrl('admin/view', array('id' => $model->id)); ?>" title="<?php echo $model->title; ?>">
				<?php echo cut_text($model->title, 65); ?></a> 
		<?php endif ?>
				
		
		<span class="post-posted-admin status-tag-<?php echo strtolower($model->status->status); ?>"><strong><?php echo time_since($model->date_added) ?></strong></span>
	</p>
	<p>
		<span class="post-location"><?php echo cut_text(format_model_location($model), 80); ?> &middot;</span>
		<span class="post-company"><?php echo cut_text($model->company, 40) ?></span>
	</p>
	<p>
		<span class="post-status status-tag-<?php echo strtolower($model->status->status); ?>">
			<?php echo $model->status->status ?>
		</span>
		<span style="font-size: 10px; color: gray; padding: 0 0 0 10px;">
			<?php if ($model->ukey != null || $model->ukey != ''): ?>
				<?php echo 'http://' . Yii::app()->request->serverName . $this->createUrl('ukey/preview', array('id' => $model->ukey)); ?>
			<?php endif ?>
		</span>
	</p>
</div>
