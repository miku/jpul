<div id="main-container">
<div id="main">

	<div id="main-header">
		Feedback
	</div>	

	<div id="main-content">
		<ul style="list-style: none">
		<?php foreach ($models as $model): ?>
			<li><span style="font-size: 10px; color: gray"><?php echo time_since($model->date_added) ?></span> 
				<span style="font-size: 10px;"><?php echo $model->email; ?> | </span> 
				<?php if ($model->context): ?>
					<span style="font-size: 10px;"><?php echo $model->context; ?> | </span>
				<?php endif ?>
				<span style="font-size: 12px"><?php echo $model->text ?></span>
				<br>
				</li>
		<?php endforeach ?>
		</ul>
	</div>

</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_filter'); ?>
		<?php $this->renderPartial('_sidebar_index_actions'); ?>
		<?php $this->renderPartial('_sidebar_index_misc'); ?>
	</div>
</div>

