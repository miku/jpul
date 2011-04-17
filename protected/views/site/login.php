<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#LoginForm_username").focus();
	});
</script>

<div id="main">

<div id="generic-header">
<p>Login</p>	
</div>

<div id="main-content">

<?php $form=$this->beginWidget('CActiveForm', array('id'=>'login-form')); ?>

		<?php echo $form->error($model,'username'); ?>
		<?php echo $form->error($model,'password'); ?>
		<br>

		<?php echo $form->labelEx($model,'username'); ?> <?php echo $form->textField($model,'username', array("class" => "default-input hspace-10")); ?>
		<?php echo $form->labelEx($model,'password'); ?> <?php echo $form->passwordField($model,'password', array("class" => "default-input")); ?>

<?php echo CHtml::submitButton('Login', array("class" => "button")); ?>

<?php $this->endWidget(); ?>

</div>	
</div>

