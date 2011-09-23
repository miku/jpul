<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<style>
		body {
			font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
			width: 600px;
			
			font-size: 10px;
			margin-left: 50px;
			line-height: 14px;
		}
		.line {
			border-bottom: solid thin gray;
		}
		.expiration-date {
			border-bottom: solid 3px gray;
		}
	</style>
</head>
<body>
<p>
	<?php 
	$serverPrefix = 'http://' . Yii::app()->request->serverName;
	if (Yii::app()->request->serverPort != 80) {
		$serverPrefix .= ':' . Yii::app()->request->serverPort;
	}
?>
	URL | <a href="<?php echo $serverPrefix . $this->createUrl('job/view', array('id' => $model->id)) ?>"><?php echo $serverPrefix . $this->createUrl('job/view', array('id' => $model->id)) ?></a><br>
	<?php if ($model->attachment): ?>
		Attachment | <a href="<?php echo $serverPrefix . $this->createUrl('job/download', array('id' => $model->id)) ?>"><?php echo $serverPrefix . $this->createUrl('job/download', array('id' => $model->id)) ?></a>		
	<?php endif ?>
</p>
<div class="line"></div>
<h2><?php echo $model->title ?></h2>
<p>Eingestellt am <?php echo strftime('%d.%m.%Y %H:%M', $model->date_added) ?> | <span class="expiration-date">Bewerbungsschluß: <?php echo strftime('%d.%m.%Y', $model->expiration_date) ?></span></p>
<h3><?php echo $model->company ?>, 
<?php 

	if ($model->zipcode) {
		echo $model->zipcode . " ";
	}
	echo $model->city;
	
	if ($model->state) {
		echo ", " . $model->state;
	}
	
	if ($model->country) {
		echo ", " . $model->country;
	}

?></h3>
<?php if ($model->company_homepage): ?>
	<p>Homepage | <a href="<?php echo $model->company_homepage; ?>"><?php echo $model->company_homepage; ?></a></p>
<?php endif ?>

<div class="line"></div>
<p><?php echo text_to_links(textilize($model->description)) ?></p>
<div class="line"></div>
<p><?php echo text_to_links(textilize($model->how_to_apply)) ?></p>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.color.e95e088.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tracker.min.js"></script>
<script>$(document).ready(function() { ccul_track('<?php echo $this->createUrl("stats/track"); ?>'); });</script>
</body>
</html>
