<h1 class="spacetop">Metadaten</h1>

<div class="sidebar-box">
Status <span class="post-status status-tag-<?php echo strtolower($model->status->status); ?>"><?php echo $model->status->status ?></span><br>
ID <?php echo $model->id; ?>
</div>



<?php if ($model->status->status === "Draft"): ?>
	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 2)); ?>">
		<div class="filter-option filter-option-active">
			Angebot freischalten
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 3)); ?>">
		<div class="filter-option filter-option-active">
			Angebot archivieren
		</div>
	</a>

<?php endif ?>

<?php if ($model->status->status === "Public"): ?>
	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 3)); ?>">
		<div class="filter-option filter-option-active">
			Angebot archivieren
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 1)); ?>">
		<div class="filter-option filter-option-active">
			Als Entwurf markieren
		</div>
	</a>

<?php endif ?>


<?php if ($model->status->status === "Archived"): ?>
	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 1)); ?>">
		<div class="filter-option filter-option-active">
			Als Entwurf markieren
		</div>
	</a>
<?php endif ?>


<?php if ($model->status->status === "Deleted"): ?>
	<a class="no-underline" href="<?php echo $this->createUrl('admin/setStatus', array("id" => $model->id, "status_id" => 3)); ?>">
		<div class="filter-option filter-option-active">
			Ins Archiv zurückholen
		</div>
	</a>
<?php endif ?>


<h1 class="spacetop">Bearbeiten</h1>

<a class="no-underline" href="<?php echo $this->createUrl('admin/update', array("id" => $model->id)); ?>">
	<div class="filter-option filter-option-active">
		Angebot editieren
	</div>
</a>


<h1 class="spacetop">Ansicht</h1>

<a class="no-underline" href="<?php echo $this->createUrl('job/view', array("id" => $model->id)); ?>">
	<div class="filter-option filter-option-active">
		Dieses Angebot auf der öffentlichen Seite
	</div>
</a>