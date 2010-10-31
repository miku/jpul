<div style="margin-top: 10px"></div>

<!-- <a class="small-font" href="<?php echo $this->createUrl('job/index'); ?>">Zurück zur Übersicht</a> -->
<a class="small-font" href="javascript:history.go(-1)">Zurück zur Übersicht</a>

<h3><?php echo $model->title ?></h3>

<p>
	<strong><?php echo $model->company ?> </strong>
	<?php if ($model->company_homepage): ?>
		<br><span class="small-font"><a style="color: gray; text-decoration:none" href="<?php echo $model->company_homepage ?>"><?php echo $model->company_homepage?></a></span>
	<?php endif; ?>
	
</p>

<p><?php echo $model->description ?></p>

<p><?php echo $model->how_to_apply ?></p>


<?php if ($model->attachment): ?>
	<p>Attachment: <a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">Download</a></p>
<?php endif; ?>

<p>Datum der Anzeige: <?php echo strftime('%d.%m.%Y', $model->date_added) ?></p>

<br>
<br>

<div class="line"></div>

<?php if (Yii::app()->user->getId() != NULL): ?>
	<a href="<?php echo $this->createUrl('job/update', array('id' => $model->id)); ?>">Angebot bearbeiten</a> | 
	<a href="<?php echo $this->createUrl('job/delete', array('id' => $model->id)); ?>">Angebot löschen</a><br>
<?php endif; ?>