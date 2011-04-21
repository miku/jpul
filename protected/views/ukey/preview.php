<!-- jv:1 -->
<div id="main-container">
	<div id="main">
		<div id="view-content">

			<div id="view-header">

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

			<div id="view-description">
				<?php echo text_to_links(textilize($model->description)) ?>
				<?php if ($model->degree): ?>
					<p><strong>Abschluß:</strong> <?php echo $model->degree->name ?></p>
				<?php endif ?>
			</div>
			
			<?php if ($model->attachment): ?>
				<div id="view-download">
					<a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">PDF dieser Anzeige</a>
				</div>
			<?php endif; ?>


			<?php if ($model->how_to_apply): ?>
				<div id="view-howtoapply">
					<p id="how-to-apply">Bewerbungsweg</p>
					<p><?php echo text_to_links(textilize($model->how_to_apply)) ?></p>
				</div>
			<?php endif ?>



			<div id="view-deadline">
				<span class="fat">Bewerbungsschluss: <span class="sticky"><?php echo date("d.m.Y", $model->expiration_date); ?></span></span>
			</div>
			
			<?php if (isset($view_count)): ?>
			<div id="view-count">
				<p>Dieses Angebot wurde 
					<?php echo ($view_count == 0) ? 1 : $view_count; ?> 
				mal angesehen.</p>
			</div>				
			<?php endif ?>
			
		</div>  
	</div>
</div>

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_status', array('model' => $model, 'id' => $id)); ?>		
		<?php $this->renderPartial('_sidebar_actions', array('model' => $model, 'id' => $id)); ?>		
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>				
	</div>	
</div>

