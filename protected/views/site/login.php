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

<div id="main-header">
<p>Login</p>	
</div>

<div id="main-content">

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'login-form')); ?>

<table border="0" cellspacing="2" cellpadding="3">

	<tr>
		
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'username'); ?></td>
		<td><?php echo $form->textField($model,'username', array("class" => "default-input")); ?></td>
		<td><?php echo $form->error($model,'username'); ?></td>
	</tr>
		
	<tr>
		
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'password'); ?></td>
		<td><?php echo $form->passwordField($model,'password', array("class" => "default-input")); ?></td>
		<td><?php echo $form->error($model,'password'); ?></td>
	</tr>

	<tr><td></td><td><?php echo CHtml::submitButton('Login', array("class" => "button")); ?></td></tr>

</table>

<?php $this->endWidget(); ?>
</div><!-- form -->

</div>	
</div>

