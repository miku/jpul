<div id="main-container">
	<div id="main">
		<div id="view-content">

			<div id="view-header">
				<div id="mini-nav">
					<a href="<?php echo $this->createUrl('admin/index'); ?>">Zurück zur Übersicht</a>
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
			</div>

			<div id="view-description"><?php echo $model->description ?></div>

			<?php if ($model->attachment): ?>
				<div id="view-download">
					<a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">PDF dieser Anzeige</a>
				</div>
			<?php endif; ?>


			<?php if ($model->how_to_apply): ?>
				<div id="view-howtoapply">
					<p id="how-to-apply">Bewerbungsweg</p>
					<p><?php echo textilize($model->how_to_apply) ?></p>
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


			<div id="view-deadline">
				<span class="fat">Bewerbungsschluss: <span class="sticky"><?php echo date("d.m.Y", $model->expiration_date); ?></span></span>
			</div>
			
			<div id="bottom-nav">
				<a href="<?php echo $this->createUrl('admin/index'); ?>">Zurück zur Übersicht</a>
			</div>
		</div>  
	</div>
</div>


<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_filter'); ?>
		<?php $this->renderPartial('_sidebar_view_actions', array("model" => $model)); ?>
	</div>	
</div>

