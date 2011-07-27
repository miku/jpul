<style type="text/css" media="screen">
	#lightbox {
		background: #EFEFEF;
		padding: 40px; 
		margin: 0;
	}
	img {
		margin: 0; padding: 0;
	}
</style>

<div id="main-container">
<div id="main">	

	<div id="generic-header">
		<h3>Vielen Dank!</h3>
		<p>Wir freuen uns über Ihre Kommentare und Kritik. Zurück <a href="<?php echo $this->createUrl('job/index'); ?>">zur Homepage</a>.</p>
		<br>
		<div id="lightbox">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/feedback/feedback_10p.png" alt="" />
		</div>
		
	</div>
	
	<div id="footer">
		<?php $this->renderPartial('/shared/_footer', array("tab" => $tab)) ?>			
	</div>

		
</div> <!-- main -->
</div> <!-- main-container -->


<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
		<?php $this->renderPartial('/shared/_sidebar_fb'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
	</div>	
</div>

