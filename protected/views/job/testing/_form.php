<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>

<div class="shadow">
<div class="fi">
	<div class="fi-l"><?php echo $form->labelEx($model,'title'); ?></div>
	<div class="fi-e"><?php echo $form->error($model,'title'); ?></div>
	<div class="fi-f"><?php echo $form->textField($model,'title', array('size' => '60')); ?></div>
</div>

<div class="fi bb">
	<div class="fi-l"><?php echo $form->labelEx($model,'description'); ?></div>
	<div class="fi-h">Hier können Sie Ihre Jobangebot beschreiben. Voraussetzungen,
		Informationen über Ihr Unternehmen, Bewerbungsweg, etc. Zur Formatierung
		können Sie die folgengen Buttons verwenden (Kursiv, Fett, Liste, Link).</div>
	<div class="fi-e"><?php echo $form->error($model,'description'); ?></div>
	
	<div class="hidden">
		<?php echo $form->textArea($model,'description', array("encode" => false, "rows" => "35", "cols" => "60", "class" => "contentDescriptionHidden")); ?>
	</div>
	
	<div class="content" id="contentDescription">
		<?php 
			// Get the initial value out of the model. Will contain a 
			// limited set of HTML markup.
			$text = CHtml::resolveValue($model, 'description'); 
			if ($text == "") {
				echo "<br><br><br>";
			} else {
				echo $text;
			}
		?>
	</div>
</div>



<div class="hsep"></div>

<div class="bb bt">
	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'company'); ?></div>
		<div class="fi-e"><?php echo $form->error($model,'company'); ?></div>
		<div class="fi-f"><?php echo $form->textField($model,'company', array('size' => '60', 'placeholder' => 'Name Ihres Unternehmens oder Institution')); ?></div>
	</div>

	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'company_homepage'); ?></div>
		<div class="fi-e"><?php echo $form->error($model,'company_homepage'); ?></div>
		<div class="fi-f"><?php echo $form->textField($model,'company_homepage', array('size' => '60', 'placeholder' => 'http://example.com')); ?></div>
	</div>
</div>



<div class="hsep"></div>

<div class="fi bb bt">
	<div class="fi-l"><?php echo $form->labelEx($model,'zipcode'); ?>  <?php echo $form->labelEx($model,'city'); ?></div>
	<div class="fi-e"><?php echo $form->error($model,'zipcode'); ?> <?php echo $form->error($model,'city'); ?></div>
	<div class="fi-h">
		Postleitzahl und Ort der Arbeitsstelle sind zwei Pflichtfelder.
		Falls es dieser Job Reisenbereitschaft erfordert, wählen Sie zusätzlich
		das entsprechende Häkchen aus.
	</div>
	<div class="fi-f">
		<?php echo $form->textField($model,'zipcode', array('size' => '8', 'style' => 'margin-right:10px;', 'placeholder' => '01234')); ?>
		<?php echo $form->textField($model,'city', array('size' => '60', 'placeholder' => 'Leipzig')); ?>
	</div>
	<div class="fi-f horizontal">
		<br>
		
		<?php echo $form->checkBox($model, 'is_nation_wide')?><?php echo $form->labelEx($model,'is_nation_wide'); ?>
	</div>
</div>


<div class="hsep"></div>


<div class="fi bb bt">
	<div class="fi-l">Abschluss</div>

	<div class="fi-h">Mehrfachauswahl möglich. Auswahl optional.</div>

	<div class="fi-f horizontal">
		
		
		<?php echo $form->checkBox($model, 'degree_student')?><?php echo $form->labelEx($model,'degree_student'); ?>
		<?php echo $form->checkBox($model, 'degree_bachelor')?><?php echo $form->labelEx($model,'degree_bachelor'); ?>
		<?php echo $form->checkBox($model, 'degree_master')?><?php echo $form->labelEx($model,'degree_master'); ?>
		<?php echo $form->checkBox($model, 'degree_ma')?><?php echo $form->labelEx($model,'degree_ma'); ?>
		<?php echo $form->checkBox($model, 'degree_diploma')?><?php echo $form->labelEx($model,'degree_diploma'); ?>
		<?php echo $form->checkBox($model, 'degree_phd')?><?php echo $form->labelEx($model,'degree_phd'); ?>
		<?php echo $form->checkBox($model, 'degree_postdoc')?><?php echo $form->labelEx($model,'degree_postdoc'); ?>
		
	</div>
	<br>

	<div class="fi-l">Art des Jobs</div>
	<div class="fi-h">Um was für eine Stelle handelt es sich? Mehrfache Auswahl ist möglich. Falls
		keine der Optionen zutrifft, brauchen Sie nichts auszuwählen.</div>
		<div class="fi-f horizontal">
			
			<?php echo $form->checkBox($model, 'is_fulltime')?><?php echo $form->labelEx($model,'is_fulltime'); ?>
			<?php echo $form->checkBox($model, 'is_parttime')?><?php echo $form->labelEx($model,'is_parttime'); ?>
			<?php echo $form->checkBox($model, 'is_internship')?><?php echo $form->labelEx($model,'is_internship'); ?>
			<?php echo $form->checkBox($model, 'is_working_student')?><?php echo $form->labelEx($model,'is_working_student'); ?>
			<?php echo $form->checkBox($model, 'is_thesis')?><?php echo $form->labelEx($model,'is_thesis'); ?>
			<?php echo $form->checkBox($model, 'is_scholarship')?><?php echo $form->labelEx($model,'is_scholarship'); ?>
		</div>
	</div>

	<div class="hsep"></div>

<div class="bb bt">
	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'attachment'); ?></div>
		<div class="fi-h">Hier können Sie eine PDF-Datei Ihrer Ausschreibung hochladen. Optional.</div>
		<div class="fi-f"><input style="font-size: 12px" size="60" type="file" name="title" placeholder="Datei" value="" id="some_name"></div>
	</div>
</div>

	<div class="hsep"></div>

<div class="bb bt">
	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'expiration_date'); ?></div>
		<div class="fi-h">
			Bis zu welchem Datum soll die Anzeige aktiv sein? Maximum ist sechs Wochen.
			Das Format ist: TT.MM.JJJJ
		</div>
		<div class="fi-f">
			<?php echo $form->textField($model,'expiration_date', array('value' => date('d.m.Y', time() + (6 * 7 * 24 * 60 * 60)))); ?>
		</div>
	</div>
</div>

	<div class="hsep"></div>

<div class="bb bt">
	<div class="fi">
		<div class="fi-l"><label>Willkommen Webbots!</label></div>
		<div class="fi-h">Es tut uns leid, aber wir benötigen die Antwort 
			auf die folgende Sicherheitsfrage.
		</div>
		<?php if ($captcha_error): ?>
			<div class="fi-e">Bitte beantworten Sie die Additionsaufgabe.</div>
		<?php endif ?>
		<div class="fi-f">
			<?php echo get_captcha_html(); ?>
		</div>
	</div>
</div>

	<div class="hsep"></div>


<div class="bb bt">
	<div class="fi">
		<div class="fi-h">In den folgenden drei Feldern bitten wir Sie, ihre
			Kontaktdaten zu hinterlassen. Diese helfen uns Sie zu kontaktieren,
			falls wir Fragen zu Ihrem Angebot haben. Vielen Dank. 
		</div>
	</div>

	<div class="fi">
		<div class="fi-l">Name</div>
		<div class="fi-h"></div>
		<div class="fi-f"><input size="60" type="text" name="Name" placeholder="" value="" id="some_name"></div>
	</div>

	<div class="fi">
		<div class="fi-l">Telefon</div>
		<div class="fi-h"></div>
		<div class="fi-f"><input size="60" type="text" name="Telefon" placeholder="" value="" id="some_name"></div>
	</div>

	<div class="fi">
		<div class="fi-l">E-Mail-Adresse</div>
		<div class="fi-h"></div>
		<div class="fi-f"><input size="60" type="text" name="title" placeholder="info@enterprise.com" value="" id="some_name"></div>
	</div>
</div>

	<div class="hsep"></div>

<div class="fs bt">
		
	<div class="buttons" style="min-height: 30px; padding: 10px;">
		
	    <button type="submit" class="positive" name="save" id="submitDraft">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/apply2.png" alt=""/>
	        Speichern
	    </button>

	    <a href="" class="regular"><!-- class="regular"-->
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/textfield_key.png" alt=""/>
	        Vorschau
	    </a>

	    <a href="#" class="negative">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/cross.png" alt=""/>
	        Abbrechen
	    </a>
	
	
	</div>
		
</div>

</div>
<?php $this->endWidget(); ?>	
