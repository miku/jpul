<div id="main-container">
	<div id="main">
		<div id="view-header">
		
			<div id="mini-nav">
				<a href="<?php echo $this->createUrl('admin/index'); ?>">Zurück zur Übersicht</a>
				<a style="background: #3366CC; color: white; padding: 3px;" href="#">Dieses Angebot editieren</a>
				<a style="background: red; color: white; padding: 3px;" href="#">Dieses Angebot endgültig löschen</a>
			</div>
		
			<div id="view-job-title"><?php echo $model->title ?></div>
		
			<div id="view-job-subtitle">
				Eingestellt am <?php echo strftime('%d.%m.%Y', $model->date_added) ?>, 
				von 
				<?php if ($model->company_homepage): ?>
					<span class="view-job-company"><a href="<?php echo $model->company_homepage ?>"><?php echo $model->company ?></a></span>.
				<?php else: ?>
					<span class="view-job-company"><?php echo $model->company ?></span>.
				<?php endif; ?>
				<?php echo format_model_location($model); ?>	
		</div>
	
		<div id="view-content">
			<div id="view-description"><?php echo textilize($model->description) ?></div>
			
			<?php if ($model->attachment): ?>
				<div id="view-download">
					<a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">PDF dieser Anzeige</a>
				</div>
			<?php endif; ?>

		
			<?php if ($model->how_to_apply): ?>
				<div id="view-howtoapply">
					<p class="intext-title">Bewerbungsweg</p>
					<p><?php echo $model->how_to_apply ?></p>
				</div>
			<?php endif ?>

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
		</div>	
	</div>
</div>

	
	



