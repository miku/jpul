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


<div style="border-top: solid thin gray; border-bottom: solid thin gray; margin-top: 60px; background: #EFEFEF; padding: 10px 10px 10px 10px;">
					<p>
					<a href="<?php echo $this->createUrl('job/index'); ?>">Job Listing</a><br>
					<?php if (Yii::app()->user->getId() != NULL): ?>
						<?php if (Yii::app()->user->isAdmin()): ?>
							<a href="<?php echo $this->createUrl('job/create'); ?>">Neues Angebot einstellen</a><br>
							<a href="<?php echo $this->createUrl('site/options'); ?>">Einstellungen</a><br>
						<?php endif; ?>
						Logged in as <a href="#"><?php echo Yii::app()->user->getUsername(); ?></a> | 
						<a href="<?php echo $this->createUrl('site/logout'); ?>">Logout</a><br>					
					<?php else: ?>
						<a href="<?php echo $this->createUrl('job/draft'); ?>">Neues Angebot erstellen</a><br>
						<a href="<?php echo $this->createUrl('site/login'); ?>">Login</a><br>
					<?php endif; ?>

				</p>

</div>				

</div>

</body>
</html>
