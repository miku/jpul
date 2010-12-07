<?php $this->pageTitle=Yii::app()->name . ' - Error'; ?>

<div id="main">

<div id="generic-header">
<p>Login</p>	
</div>

<div id="main-content">

<p>Diese Seite existiert nicht oder ist nicht verfügbar &mdash; HTTP Status <?php echo $code; ?>.</p>

<a href="<?php echo $this->createUrl('job/index') ?>">Zur Homepage</a>

</div>	
</div>
