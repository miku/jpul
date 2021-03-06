<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php $current_time = time(); ?>
<url>
<loc>http://wwwdup.uni-leipzig.de/jobportal/docs/2011_04_21_Einstellung_eines_Angebotes_im_Jobportal.pdf</loc>
<lastmod>2011-04-21</lastmod>
<priority>0.5</priority>
</url>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName .  $this->createUrl('job/index'); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d"); ?></lastmod>
<priority>1.0</priority>
</url>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName .  $this->createUrl('widget/index'); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d"); ?></lastmod>
<priority>1.0</priority>
</url>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName .  $this->createUrl('list/cities'); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d"); ?></lastmod>
<priority>1.0</priority>
</url>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName .  $this->createUrl('list/companies'); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d"); ?></lastmod>
<priority>1.0</priority>
</url>
<?php foreach ($models as $model): ?>
<?php if ($model->status_id == 2): ?>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName  . $this->createUrl('job/view', array('id' => $model->id)); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d", $model->date_added); ?></lastmod>
<priority><?php if ($model->expiration_date < $current_time): ?>0.1<?php else: ?>0.8<?php endif ?></priority>
</url>
<?php if ($model->attachment != null || $model->attachment != ''): ?>
<url>
<loc><?php echo 'http://' . Yii::app()->request->serverName  . $this->createUrl('job/download', array('id' => $model->id)); ?></loc>
<lastmod><?php echo strftime("%Y-%m-%d", $model->date_added); ?></lastmod>
<priority><?php if ($model->expiration_date < $current_time): ?>0.1<?php else: ?>0.8<?php endif ?></priority>
</url>	
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
</urlset>
