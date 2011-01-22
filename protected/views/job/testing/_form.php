<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>
	
	<div class="errorSummary">
		<!-- 
		<?php if ($form->errorSummary($model)): ?>
			<?php echo $form->errorSummary($model); ?>
		<?php endif ?>		 
		-->
	</div>

	<div class="form_item_head"><?php echo $form->error($model,'title'); ?></div>
	
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'title'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'title', array('size' => '60')); ?></div>
	</div>

	<div class="form_item_head">Die Beschreibung der Ausschreibung, Profil Ihres Wunschkandidaten, formale Qualifikationen,
		Aufgabengebiet, etc.
		<?php echo $form->error($model,'description'); ?></div>
	<div class="form-item">
		<div class="form_item_label">
			<?php echo $form->labelEx($model,'description'); ?>
		</div>
		<div class="form_item_field"><?php echo $form->textArea($model,'description', array("rows" => "35", "cols" => "60")); ?></div>
	</div>

	<div class="form_item_head">Der Name des Unternehmens oder der Institution. <?php echo $form->error($model,'company'); ?></div>
	<div class="form-item">		
		<div class="form_item_label"><?php echo $form->labelEx($model,'company'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'company', array("size" => "60", "cols" => "60")); ?></div>
	</div>
		
	<div class="form_item_head">Homepage Ihres Unternehmens oder Ihrer Institution. <?php echo $form->error($model,'company_homepage'); ?></div>
	<div class="form-item">				
		<div class="form_item_label"><?php echo $form->labelEx($model,'company_homepage'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'company_homepage', array('size' => '60')); ?></div>
	</div>

	<div class="form-item">
		<div class="form_item_label">
		<?php echo $form->labelEx($model,'degree_id'); ?>
		</div>
		<div class="form_item_field"><?php echo $form->dropDownList($model, 'degree_id', CHtml::listData(Degree::model()->findAll(), 'id', 'name'), array('prompt' => 'Akademischer Abschluß')); ?></div>
	</div>	

	<div class="form_item_head"><?php echo $form->error($model,'zipcode'); ?></div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'zipcode'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'zipcode'); ?></div>		
	</div>

	<div class="form_item_head"><?php echo $form->error($model,'city'); ?></div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'city'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'city', array('size' => '60')); ?></div>
	</div>

	<div class="form_item_head"><?php echo $form->error($model,'state'); ?></div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'state'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'state', array('size' => '60')); ?></div>
	</div>

	<div class="form_item_head"><?php echo $form->error($model,'country'); ?></div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'country'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'country', array('size' => '60')); ?></div>
	</div>

<!--
	<div class="form-item"><?php echo $form->checkBox($model,'is_telecommute'); ?> <?php echo $form->labelEx($model,'is_telecommute'); ?></div>
	<div class="form-item"><?php echo $form->checkBox($model,'is_nation_wide'); ?> <?php echo $form->labelEx($model,'is_nation_wide'); ?></div>
-->

<!--
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'study'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'study', array('size' => '60')); ?></div>
		<?php echo $form->error($model,'study'); ?>
	</div>

	
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'sector'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'sector', array('size' => '60')); ?></div>
		<?php echo $form->error($model,'sector'); ?>
	</div>
-->

	<div class="form_item_head">
		<?php echo $form->error($model,'how_to_apply'); ?>
	</div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'how_to_apply'); ?></div>
		<div class="form_item_field"><?php echo $form->textArea($model,'how_to_apply', array("rows" => "10", "cols" => "40")); ?></div>
	</div>

	<div class="form_item_head"> PDF-Datei mit Ihrer Ausschreibung oder weiteren Informationen. <?php echo $form->error($model,'attachment'); ?></div>
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'attachment'); ?></div>
		<div class="form_item_field"><?php echo $form->fileField($model,'attachment'); ?></div>
	</div>


	<div class="form_item_head">
		Standardlaufzeit: 6 Wochen. Optional können Sie taggenau
		eine Ablauffrist Ihrer Anzeige im Format <strong>TT.MM.YYYY</strong>
		angeben, z.B. 31.12.2010.  
		<?php echo $form->error($model,'expiration_date'); ?>
	</div>
	
	<div class="form-item">
		<div class="form_item_label"><?php echo $form->labelEx($model,'expiration_date'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'expiration_date', array('value' => date('d.m.Y', time() + (6 * 7 * 24 * 60 * 60)))); ?></div>
	</div>

	<div class="form-item">
		<div class="form_item_label required"><label for="captcha_challenge">Sicherheitsfrage</label></div>
		<div class="form_item_field"><?php echo get_captcha_html(); ?></div>
	</div>
		 	
	<div class="form-item" style="font-size: 12px;">
		<?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?>.</a>
	</div>

	<?php $this->endWidget(); ?>	
</div><!-- form -->
