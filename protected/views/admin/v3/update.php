<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">
			<h1>Angebot bearbeiten</h1>
		</div>

		<div id="main-content">

		<?php $this->renderPartial('v3/_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
	</div>	
</div>
