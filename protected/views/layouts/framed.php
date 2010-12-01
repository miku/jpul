<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />	

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.4.3.min.js"charset="utf-8"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<style type="text/css" media="screen">
		#main-content {
			width: 500px;
		}
	</style>
</head>

<body>

<div id="main-content">
<?php echo $content; ?>
</div>
				
</body>
</html>
