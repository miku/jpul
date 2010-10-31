<?php
$this->pageTitle=Yii::app()->name . ' - Error';

?>

<p>Diese Seite existiert nicht oder ist nicht verfügbar &mdash; HTTP Status <?php echo $code; ?>.</p>

<a href="<?php echo $this->createUrl('job/index') ?>">Zur Homepage</a>

<!-- <div class="error">
<?php echo CHtml::encode($message); ?>
</div> -->