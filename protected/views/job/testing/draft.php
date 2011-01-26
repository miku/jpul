<div id="main-container">
		<div id="main-content">
			<?php $this->renderPartial('testing/_form', array("model" => $model)); ?>
		</div> <!-- main-content -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_supporter'); ?>
	</div>	
</div>

<script>
$(function() {
	window.editor = new Proper();
	$('.content').click(function() { 
		editor.activate($(this)); 
		editor.bind('changed', function() {
			console.log(editor.content());
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
