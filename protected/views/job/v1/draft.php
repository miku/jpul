<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<p style="font-size:10px; width: 300px; margin: 10px; padding: 5px; background: #FFF380;">Sie können Ihr Angebot in einer ansprechenderen Maske eingeben, wenn Sie einen modernen Browser, wie z.B.
			Firefox, Safari oder Chrome verwenden.
		</p>
		<div id="generic-header">Neues Angebot erstellen</div>
		<div id="main-content">

		<?php $this->renderPartial('v1/_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
	</div>	
</div>
