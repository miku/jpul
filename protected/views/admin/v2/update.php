<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<div id="main-container">
	<div id="main">	
		<div id="generic-header">Angebot bearbeiten</div>
		<div id="main-content">

		<?php $this->renderPartial('v2/_form', array("model" => $model)); ?>

		</div> <!-- main-content -->
	</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_filter'); ?>
	</div>	
</div>

<script>
$(function() {
	window.editor = new Proper();
	$('.content').click(function() { 
		editor.activate($(this)); 
		editor.bind('changed', function() {
			// console.log("Editor content: " + editor.content());
			// console.log("Payload prep: " + $(".contentDescriptionHidden").html());
			$(".contentDescriptionHidden").html(editor.content());
		});
	});
	$('.content').trigger('click');
	
	$('#Job_title').focus();
	

	
	// $('#submitDraft').click(function(){
	// 	var description = $('#contentDescription').html();
	// 	console.log(description);
	// 	console.log(description.length);
	// 	if (description.length < 40) {
	// 		$(".contentDescriptionHidden").children().remove();
	// 		console.log("Content too short.");
	// 	} else {
	// 		console.log("OK");
	// 		$(".contentDescriptionHidden").append(description);
	// 	}
	// 	// return false;
	// });
});
</script>
