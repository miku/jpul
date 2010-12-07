<div id="main-container">
	<div id="main">	
		<div id="generic-header">Neues Angebot erstellen</div>
		<div id="main-content">

		<?php $this->renderPartial('_form_2c', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<?php $this->renderPartial('_sidebar'); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>
