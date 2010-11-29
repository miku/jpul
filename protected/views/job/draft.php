<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>


<div class="form">
	
	<h3>Neues Angebot erstellen</h3>

<?php $form=$this->beginWidget('CActiveForm', 
	array(	'id'=>'job-create-form', 
			'htmlOptions'=>array('enctype'=>'multipart/form-data'))); 
?>

	<?php echo $form->errorSummary($model); ?>
	
	<table border="0" cellspacing="2" cellpadding="4">

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'title'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'title', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'title'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'description'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textArea($model,'description', array("rows" => "35", "cols" => "60")); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'description'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'company'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'company', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'company'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->labelEx($model,'company_homepage'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'company_homepage', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'company_homepage'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'degree_id'); ?> <?php echo $form->dropDownList($model, 'degree_id', CHtml::listData(Degree::model()->findAll(), 'id', 'name'),array('prompt' => 'Akademischer Abschluß')); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'zipcode'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'zipcode'); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'zipcode'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'city'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'city', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'city'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'state'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'state', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'state'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'country'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'country', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'country'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->checkBox($model,'is_telecommute'); ?> <?php echo $form->labelEx($model,'is_telecommute'); ?></td></tr>
		<tr class="even-dark"><td><?php echo $form->checkBox($model,'is_nation_wide'); ?> <?php echo $form->labelEx($model,'is_nation_wide'); ?></td></tr>


		<tr class="even-dark"><td><?php echo $form->labelEx($model,'study'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'study', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'study'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'sector'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'sector', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'sector'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'how_to_apply'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textArea($model,'how_to_apply', array("rows" => "10", "cols" => "40")); ?></td></tr>
		<tr class="even"><td><?php echo $form->error($model,'how_to_apply'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'attachment'); ?></td></tr>		
		<tr class="even help"><td>Erlaubtes Format: PDF</td></tr>		
		
		<tr class="even"><td><?php echo $form->fileField($model,'attachment'); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'attachment'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->labelEx($model,'expiration_date'); ?></td></tr>
		<tr class="even help"><td>Optional im Format TT.MM.YYYY (Standardlaufzeit: 6 Wochen)</td></tr>		
		<tr class="even"><td><?php echo $form->textField($model,'expiration_date', array('value' => date('d.m.Y', time() + (6 * 7 * 24 * 60 * 60)))); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'expiration_date'); ?></td></tr>
		


		<tr class="even-dark"><td><?php echo $form->labelEx($model,'Sicherheitsfrage'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField('captcha_challenge', array('size' => '60')); ?></td></tr>
	
		
		<tr class="even"><td><?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?></a></td></tr>
		
	</table>


<?php $this->endWidget(); ?>

</div><!-- form -->