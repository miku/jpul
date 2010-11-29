<?php if ($model->isExpired()): ?>
	<tr class="tr-expired">
<?php else: ?>
	<tr class="tr-<?php echo strtolower($model->status->status) ?>">
<?php endif ?>
	<td class="job-date-added"><?php echo strftime('%d.%m.%Y', $model->date_added) ?></td>		
	<td class="job-title">
		<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>" title="<?php echo cut_text($model->description, 300) ?>">
			<?php echo cut_text($model->title, 40) ?>
		</a>
	</td>
	<td class="job-company"><?php echo cut_text($model->company, 200) ?></td>

	<?php if (Yii::app()->user->isAdmin()): ?>
		<?php if ($model->isExpired()): ?>
			<td class="small status-expired ?>"><?php echo $model->status->status ?></td>
		<?php else: ?>
			<td id="<?php echo ($model->id) ?>" class="small td-status status-<?php echo strtolower($model->status->status) ?>"><?php echo $model->status->status ?></td>
		<?php endif ?>

	<?php endif ?>

		
</tr>

