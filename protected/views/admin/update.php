<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div class="form">
	<h3>Angebot <?php echo $model->id ?> bearbeiten</h3>
	
	<?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>