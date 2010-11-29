<tr class="<?php if ($index % 2 == 0) { echo 'even'; } else { echo 'odd'; } ?>">
	<td class="job-date-added"><?php echo strftime('%d.%m.%Y', $model->date_added) ?></td>		
	<td class="job-title">
		<a href="<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>" title="<?php echo $this->limitText($model->description, 300) ?>">
			<?php echo $this->limitText($model->title, 40) ?>
		</a>
	</td>
	<td class="job-company"><?php echo $this->limitText($model->company, 20) ?></td>

	<?php if (Yii::app()->user->isAdmin()): ?>
		<?php if ($model->isExpired()): ?>
			<td class="small status-expired ?>"><?php echo $model->status->status ?></td>
		<?php else: ?>
			<td class="small status-<?php echo strtolower($model->status->status) ?>"><?php echo $model->status->status ?></td>
		<?php endif ?>

	<?php endif ?>
</tr>

