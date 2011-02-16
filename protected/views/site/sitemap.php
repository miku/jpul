<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php $current_time = time(); ?>
	<url>
		<!-- . ':' . Yii::app()->request->port -->
		<loc><?php echo 'http://' . Yii::app()->request->serverName  . Yii::app()->request->baseUrl . $this->createUrl('job/index'); ?></loc>
		<lastmod><?php echo strftime("%Y-%m-%d"); ?></lastmod>
		<priority>1.0</priority>
	</url>

	<?php foreach ($models as $model): ?>
		<url>
			<!-- . ':' . Yii::app()->request->port -->
			<loc><?php echo 'http://' . Yii::app()->request->serverName  . Yii::app()->request->baseUrl . $this->createUrl('job/view', array('id' => $model->id)); ?></loc>
			<lastmod><?php echo strftime("%Y-%m-%d", $model->date_added); ?></lastmod>
			<priority><?php if ($model->expiration_date < $current_time): ?>0.1<?php else: ?>0.8<?php endif ?></priority>
		</url>
	<?php endforeach ?>
</urlset>