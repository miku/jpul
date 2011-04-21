<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">Angebot bearbeiten</div>
		<div id="main-content">

		<?php $this->renderPartial('_form', array("model" => $model, "captcha_error" => $captcha_error)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">		
		<?php $this->renderPartial('_sidebar_actions', array('model' => $model, 'id' => $id)); ?>		
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>		
	</div>	
</div>
