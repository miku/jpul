<div id="main-container">
		<div id="main-content">
			<?php $this->renderPartial('v2/_form', array("model" => $model, "captcha_error" => $captcha_error)); ?>
		</div> <!-- main-content -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
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
