<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">Neues Angebot erstellen</div>
		<div id="main-content">

		<?php $this->renderPartial('_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_supporter'); ?>
	</div>	
</div>
