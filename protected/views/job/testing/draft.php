<div id="main-container">
	<div id="main">	
		<div id="generic-header"></div>
		<div id="main-content">
			<?php $this->renderPartial('testing/_form', array("model" => $model)); ?>
		</div> <!-- main-content -->
	</div> <!-- main -->
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
	$('.content').click(function() { editor.activate($(this)); });
	$('.content').trigger('click');
	$('#first_focus').focus();
});
</script>
