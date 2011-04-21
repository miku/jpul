<?php $this->pageTitle=Yii::app()->name . ' - Error'; ?>

<div id="main">

<div style="margin: 10px; padding: 10px;" id="main-content">
	
<div style="margin: 0px 0px 10px 0px">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_o_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_h_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_n_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_o_1_sm.gif" alt="" width="120px"/>
</div>

<p style="font-size: 80px">We call it <?php echo $code; ?>.</p><br>
		
	<p style="font-size: 16px">&bdquo;Diese Seite existiert nicht oder ist nicht verfügbar.&ldquo;
		<a href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Homepage</a>?</p>
</div>	

</div>
