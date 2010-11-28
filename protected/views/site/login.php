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

<h3>Login</h3>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'login-form')); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<table border="0" cellspacing="2" cellpadding="4">

	<tr class="even-dark"><td><?php echo $form->labelEx($model,'username'); ?></td></tr>
	<tr class="even"><td><?php echo $form->textField($model,'username'); ?></td></tr>
	<tr class="even"><td><?php echo $form->error($model,'username'); ?></td></tr>

	<tr class="even-dark"><td><?php echo $form->labelEx($model,'password'); ?></td></tr>
	<tr class="even"><td><?php echo $form->passwordField($model,'password'); ?></td></tr>
	<tr class="even"><td><?php echo $form->error($model,'password'); ?></td></tr>

	<tr class="even-dark"><td><?php echo CHtml::submitButton('Login'); ?></td></tr>

	<tr class="even"><td><a href="#">Forgot your password?</a></td></tr>

	</table>

<?php $this->endWidget(); ?>
</div><!-- form -->
