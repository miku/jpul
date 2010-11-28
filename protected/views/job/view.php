<div style="margin-top: 10px"></div>

<!-- <a class="small-font" href="<?php echo $this->createUrl('job/index'); ?>">Zurück zur Übersicht</a> -->
<a class="small-font" href="javascript:history.go(-1)">
	<div class="micro-nav">Zurück zur Übersicht</div>
</a>

<h3><?php echo $model->title ?></h3>

<p>
	<strong><?php echo $model->company ?>, <?php echo $model->city ?> </strong>
	<?php if ($model->company_homepage): ?>
		<br><span class="small-font"><a style="color: gray; text-decoration:none" href="<?php echo $model->company_homepage ?>"><?php echo $model->company_homepage?></a></span>
	<?php endif; ?>
</p>

<p><?php echo textilize($model->description) ?></p>

<p><?php echo textilize($model->how_to_apply) ?></p>


<?php if ($model->attachment): ?>
	<p>PDF der Anzeige: <a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">Download</a></p>
<?php endif; ?>

<br>
<br>

<?php if ($model->study): ?>
	<p>Studienrichtungen: <?php echo $model->study ?></p>
<?php endif ?>

<?php if ($model->degree): ?>
	<p>Abschluß: <?php echo $model->degree->name ?></p>
<?php endif ?>



<p>Bewerbungsschluss: <?php echo date("d.m.Y", $model->expiration_date); ?></p>

<div class="line"></div>

<p class="small">Anzeige erstellt am <?php echo strftime('%d.%m.%Y', $model->date_added) ?></p>

<?php if (Yii::app()->user->getId() != NULL && Yii::app()->user->isAdmin()): ?>
	<div class="buttonlike">
		<a href="<?php echo $this->createUrl('job/update', array('id' => $model->id)); ?>">Angebot bearbeiten</a>
		<a href="<?php echo $this->createUrl('job/delete', array('id' => $model->id)); ?>">Angebot löschen</a>
	</div><br>
<?php endif; ?>