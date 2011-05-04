<?php if ($model->ukey): ?>
<h1 class="spacetop">U-key</h1>
	<p>Der U-Key (Unique Key) ist die einzige Zugriffsmöglichkeit
		für Job-Anbieter ihr Angebot nach dem Einstellen noch einmal
		zu bearbeiten. Er ist im
	</p>
	<p>
		<a href="http://<?php echo Yii::app()->request->serverName . $this->createUrl('/ukey/preview', 
			array('id' => $model->ukey)); ?>"><?php echo $model->ukey ?></a>
	</p>	
<?php endif ?>
