<?php $form=$this->beginWidget('CActiveForm', 
	array('id'=>'job-draft-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); 
	
	$publickey = "6Lc0Lb8SAAAAABowOzl_yZ6KXaMVOmTBFbd1-pfF"; // you got this from the signup page
	echo recaptcha_get_html($publickey);

?>

<?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> 

<?php $this->endWidget(); ?>

