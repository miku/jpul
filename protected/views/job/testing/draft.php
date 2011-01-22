<!-- Assume jquery is loaded -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/underscore.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sanitize.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/proper.min.js"></script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">Neues Angebot erstellen</div>
		<div id="main-content">
			
			Hello new FORM!
			<?php $this->renderPartial('testing/_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_supporter'); ?>
	</div>	
</div>
