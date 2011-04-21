<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">
			<h1>Neues Angebot erstellen</h1>
			<p>Hier können Sie ein neues Jobangebot selbständig einstellen.
				Folgende Felder sind Pflichtfelder (*): Titel, Beschreibung,
				Name des Unternehmens, Stadt, Ablaufdatum 
				und Ihre Kontaktdaten (Name, Telefon und E-Mail).</p>
			<p>Nachdem Sie die Form ausgefüllt haben, kommen Sie auf eine Vorschauseite.</p>
		</div>

		<div id="main-content">

		<?php $this->renderPartial('_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
	</div>	
</div>
