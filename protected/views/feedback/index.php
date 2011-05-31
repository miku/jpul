<div id="main-container">
<div id="main">	

	<div id="generic-header">
		<h3>Feedback</h3>
		<p>Wir freuen uns über Ihre Kommentare und Kritik.</p>
	</div>
	
	<div id="main-content">
		<?php $form=$this->beginWidget('CActiveForm', array('id' => 'job-create-form')); ?>	
		<ol>
			<fieldset>
				<legend>Feedback</legend>	
				<!-- Title -->
		<li>
			<?php echo $form->labelEx($model,'text'); ?>
			<?php echo $form->textArea($model,'text', array('rows' => 20, 'cols' => 50)); ?>
			<div class="help">Kritik, Kommentare, Ideen, inhaltliche Fehler, uns interessiert alles.</div>
			<div class="form-error"><?php echo $form->error($model,'text'); ?></div>
		</li>

		<li>
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email', array('size' => 70)); ?>
			<div class="help">Optional Ihre E-Mail Addresse, damit wir Sie kontaktieren können.</div>
			<div class="form-error"><?php echo $form->error($model,'email'); ?></div>
		</li>

		<li>
			<label for="captcha"><!-- 0 --></label>
			<?php echo get_captcha_html(); ?>
			<div class="form-error"><?php if ($captcha_error == true) { echo "Bitte beantworten Sie die Sicherheitsfrage."; }; ?></div>
		</li>
		
		<li>
			<label for="submit"><!-- 0 --></label>
			<?php echo CHtml::submitButton('Absenden'); ?> 
			<?php echo Yii::t('app', 'or') ?> 
			<a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?></a>.
		</li>
		</fieldset>

		</ol>
		<?php $this->endWidget(); ?>
		
	</div>
	
	
</div> <!-- main -->
</div> <!-- main-container -->


<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
		<?php $this->renderPartial('/shared/_sidebar_fb'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
	</div>	
</div>


<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$("#Feedback_text").focus();
	});
</script>
