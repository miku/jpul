<?php $this->pageTitle=Yii::app()->name . ' - Error'; ?>

<div id="main">

<div id="generic-header">
	<p>Sorry, something went wrong.</p>
</div>

<div style="margin: 10px; padding: 10px; background: aliceblue;" id="main-content">

	<p>Diese Seite existiert nicht oder ist nicht verfügbar &mdash; HTTP Status <?php echo $code; ?>.</p>

	<a href="<?php echo $this->createUrl('job/index') ?>">Zur Homepage</a>

</div>	
</div>
