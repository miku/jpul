<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-item">
		<?php echo $form->error($model,'title'); ?>
		<div class="form-item-label"><?php echo $form->labelEx($model,'title'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'title', array('size' => '60')); ?></div>
	</div>

	<div class="form-item">
		<?php echo $form->error($model,'description'); ?>		
		<div class="form-item-label">
			<?php echo $form->labelEx($model,'description'); ?>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="form_item_field"><?php echo $form->textArea($model,'description', array("rows" => "35", "cols" => "60")); ?></div>
	</div>

	<div class="form-item">
		<?php echo $form->error($model,'company'); ?>		
		<div class="form-item-label"><?php echo $form->labelEx($model,'company'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'company', array("size" => "60", "cols" => "60")); ?></div>
	</div>
		
	<div class="form-item">
		<?php echo $form->error($model,'company_homepage'); ?>		
		<div class="form-item-label"><?php echo $form->labelEx($model,'company_homepage'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'company_homepage', array('size' => '60')); ?></div>
	</div>

	<div class="form-item">
		<div class="form-item-label">
		<?php echo $form->labelEx($model,'degree_id'); ?>
		</div>
		<div class="form_item_field"><?php echo $form->dropDownList($model, 'degree_id', CHtml::listData(Degree::model()->findAll(), 'id', 'name'), array('prompt' => 'Akademischer Abschluß')); ?></div>
	</div>	

	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'zipcode'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'zipcode'); ?></div>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'city'); ?></div>
		<div class="form_item_field"><?php echo $form->textField($model,'city', array('size' => '60')); ?></div>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'state'); ?></div>
		<?php echo $form->textField($model,'state', array('size' => '60')); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'country'); ?></div>
		<?php echo $form->textField($model,'country', array('size' => '60')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="form-item"><?php echo $form->checkBox($model,'is_telecommute'); ?> <?php echo $form->labelEx($model,'is_telecommute'); ?></dic>
	<div class="form-item"><?php echo $form->checkBox($model,'is_nation_wide'); ?> <?php echo $form->labelEx($model,'is_nation_wide'); ?></div>

	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'study'); ?></div>
		<?php echo $form->textField($model,'study', array('size' => '60')); ?>
		<?php echo $form->error($model,'study'); ?>
	</div>

	
	<div class="form-item">
		<div class="form-item-label"><?php echo $form->labelEx($model,'sector'); ?></div>
		<?php echo $form->textField($model,'sector', array('size' => '60')); ?>
		<?php echo $form->error($model,'sector'); ?>
	</div>
	
	<div class="form-item">
		<?php echo $form->labelEx($model,'how_to_apply'); ?>
		<?php echo $form->textArea($model,'how_to_apply', array("rows" => "10", "cols" => "40")); ?>
		<?php echo $form->error($model,'how_to_apply'); ?>
	</div>

	<div class="form-item">
		<?php echo $form->labelEx($model,'attachment'); ?>		
		Erlaubtes Format: PDF		

		<?php echo $form->fileField($model,'attachment'); ?>
		<?php echo $form->error($model,'attachment'); ?>
	</div>


	<div class="form-item">
		<?php echo $form->labelEx($model,'expiration_date'); ?>
		Optional im Format TT.MM.YYYY (Standardlaufzeit: 6 Wochen)		
		<?php echo $form->textField($model,'expiration_date', array('value' => date('d.m.Y', time() + (6 * 7 * 24 * 60 * 60)))); ?>
		<?php echo $form->error($model,'expiration_date'); ?>
	</div>


	<div class="form-item">
		<label for="captcha_challenge">Sicherheitsfrage</label> 
		
			<?php echo get_captcha_html(); ?>
	</div>
		 	

	<div class="form-item">
		<?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?></a>
	</div>

	<?php $this->endWidget(); ?>
	
</div><!-- form -->
