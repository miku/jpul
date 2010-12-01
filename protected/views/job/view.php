<div style="margin-top: 10px"></div>

<!-- <a class="small-font" href="<?php echo $this->createUrl('job/index'); ?>">Zurück zur Übersicht</a> -->

<div class="top-actions small">
	<a href="javascript:history.go(-1)">Zurück zur Übersicht</a>
	<?php if (Yii::app()->user->getId() != NULL && Yii::app()->user->isAdmin()): ?>
		<a href="<?php echo $this->createUrl('job/update', array('id' => $model->id)); ?>">Angebot bearbeiten</a>
		<a class="destructive" href="<?php echo $this->createUrl('job/delete', array('id' => $model->id)); ?>">Angebot archivieren</a>
	<?php endif; ?>	
</div>


<div class="view-job-header">

	<div class="view-job-title"><?php echo $model->title ?></div>

		<span class="view-job-company"><?php echo $model->company ?></span> in <span class="view-job-location"><?php echo $model->city ?></span>
		<?php if ($model->company_homepage): ?>
			<br><span class="view-job-company-homepage"><a href="<?php echo $model->company_homepage ?>"><?php echo $model->company_homepage?></a></span>
		<?php endif; ?>
</div>

<p><?php echo textilize($model->description) ?></p>

<div class="blue-line"></div>

<?php if ($model->how_to_apply): ?>
	<p><strong>Bewerbungsweg</strong></p>
	<p><?php echo textilize($model->how_to_apply) ?></p>
<?php endif ?>

<?php if ($model->attachment): ?>
	<p>PDF der Anzeige: <a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">Download</a></p>
<?php endif; ?>

<br>
<br>

<?php if ($model->is_telecommute): ?>
	Telearbeit möglich.<br>
<?php endif ?>

<?php if ($model->is_nation_wide): ?>
	Arbeitsort ist bundesweit.<br>
<?php endif ?>


<?php if ($model->study): ?>
	<p>Studienrichtungen: <?php echo $model->study ?></p>
<?php endif ?>

<?php if ($model->degree): ?>
	<p>Abschluß: <?php echo $model->degree->name ?></p>
<?php endif ?>


<p class="sticky">Bewerbungsschluss: <strong><?php echo date("d.m.Y", $model->expiration_date); ?></strong></p>

<div class="line"></div>

<p class="small">Anzeige eingestellt am <?php echo strftime('%d.%m.%Y', $model->date_added) ?></p>
