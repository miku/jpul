<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>	
<?php echo $form->hiddenField($model,'job_version', array('value' => '3')); ?>
<ol>
<fieldset>
	<legend>Jobbezeichnung, Beschreibung und Bewerbungsweg</legend>	
		<!-- Title -->
		<li>
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->textField($model,'title', array('size' => '70')); ?>
			<div class="help">Titel des Angebots, z.B. 
				<em>Praktikant im Bereich Marketing/BWL</em>, 
				<em>Softwareentwickler/Software-Entwickler Java/PHP (m/w)</em>, etc.
			</div>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'title'); ?></div>
		</li>

		<!-- Description -->
		<li>
			<a name="description-example"></a>
			<?php echo $form->labelEx($model,'description'); ?>
			
			<div class="textarea">
				<div id="Job_description_buttons"></div>
					<?php echo $form->textArea($model,'description', array("rows" => "40", "cols" => "75")); ?>
			</div>

			<div class="help">
				<p><strong>Formattierungshinweise</strong>: Das obige Textfeld unterstützt keine WYSIWYG Formattierung, dennoch ist
				es über ein <em>Markup</em> möglich, Elemente Ihrer Anzeige (z.B. die Sektionen "Voraussetzungen", "Ihre Aufgaben", etc.) 
				hervorzuheben. Folgende zwei Markup-Hilfen stehen Ihnen zur Verfügung:</p>

				<p>Text zwischen Sternchen, also z.B. *dieser Text*, wird <strong>fett</strong> ausgegeben.</p>
				<p>Sie können eine Liste ebenfalls mit Sternchen erstellen. Beispiel:
					<pre><code>
* Hello
* World

</code></pre></p>
		
				<p>Sie möchten ein Beispiel sehen? Kopieren Sie einen <a href="#description-example" id="example-formatting">Beispieltext</a>
					in das Textfeld.</p>				
			</div>
			<div class="form-error"><?php echo $form->error($model,'description'); ?></div>
		</li>

		<!-- How to apply -->
		<li>
			<?php echo $form->labelEx($model,'how_to_apply'); ?>
			<div class="textarea">
				<div id="Job_how_to_apply_buttons"></div>
				<?php echo $form->textArea($model,'how_to_apply', array("rows" => "10", "cols" => "75")); ?>
			</div>
			<div class="help">
				<p><strong>Formattierungshinweise</strong>: Das obige Textfeld unterstützt keine WYSIWYG Formattierung, dennoch ist
				es über ein <em>Markup</em> möglich, Elemente Ihrer Anzeige (z.B. die Sektionen "Voraussetzungen", "Ihre Aufgaben", etc.) 
				hervorzuheben. Das Markup entspricht dem des Textfeldes für die <strong>Beschreibung</strong>.</p>
			</div>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'how_to_apply'); ?></div>
		<li>
</fieldset>

<fieldset>
	<legend>Ihr Unternehmen</legend>
		<li>
			<?php echo $form->labelEx($model,'company'); ?>
			<?php echo $form->textField($model,'company', array("size" => "70")); ?>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'company'); ?></div>
		</li>
				
		<li>
			<?php echo $form->labelEx($model,'company_homepage'); ?>
			<?php echo $form->textField($model,'company_homepage', array('size' => '70')); ?>
			<div class="help"><p>Homepage des Unternehmens, alternativ können 
				Sie auf einen Link auf Ihre Anzeige setzen, sofern sich Ihre
				Ausschreibung auf Ihrer Webseite befindet.</p>
			</div>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'company_homepage'); ?></div>
		</li>
</fieldset>

<fieldset>
	<legend>Arbeitsort</legend>
	<li>
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode', array('size' => '10')); ?>
		<!-- TODO ... -->
		<div class="form-error"><?php echo $form->error($model,'zipcode'); ?></div>
	</li>
	<li>
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city', array('size' => '70')); ?>
		<!-- TODO ... -->
		<div class="form-error"><?php echo $form->error($model,'city'); ?></div>
	</li>
	<li>
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state', array('size' => '70')); ?>
		<!-- TODO ... -->
		<div class="form-error"><?php echo $form->error($model,'state'); ?></div>
	</li>
	<li>
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country', array('size' => '70')); ?>
		<!-- TODO ... -->
		<div class="form-error"><?php echo $form->error($model,'country'); ?></div>
	</li>
	
	<div class="help">Geben Sie, falls möglich Postleitzahl und Ort an. Falls der
		Arbeitsort in Deutschland liegt, können Sie die Angabe <strong>Land</strong>
		weglassen. Bezieht sich das Angebot auf verschiedene Arbeitsorte, so
		geben Sie die Städtenamen kommasepariert an, z.B. <em>Leipzig, Berlin</em>.
		Liegt ein Arbeitsort außerhalb Deutschlands, so geben Sie bitte das 
		entsprechende Land mit an, bzw. bei verschiedenen Ländern eine kommaseparierte
		Liste der Länder, z.B. <em>Deutschland, Schweiz, Frankreich</em>.
	</div>		
</fieldset>

<fieldset>
	<legend>Abschluß</legend>	
		<li><?php echo $form->labelEx($model,'degree_student'); ?> <?php echo $form->checkBox($model, 'degree_student')?></li>
		<li><?php echo $form->labelEx($model,'degree_bachelor'); ?> <?php echo $form->checkBox($model, 'degree_bachelor')?></li>
		<li><?php echo $form->labelEx($model,'degree_master'); ?> <?php echo $form->checkBox($model, 'degree_master')?></li>
		<li><?php echo $form->labelEx($model,'degree_ma'); ?> <?php echo $form->checkBox($model, 'degree_ma')?></li>
		<li><?php echo $form->labelEx($model,'degree_diploma'); ?> <?php echo $form->checkBox($model, 'degree_diploma')?></li>
		<li><?php echo $form->labelEx($model,'degree_phd'); ?> <?php echo $form->checkBox($model, 'degree_phd')?></li>
		<li><?php echo $form->labelEx($model,'degree_postdoc'); ?> <?php echo $form->checkBox($model, 'degree_postdoc')?></li>
		<div class="help">Optional können sie hier einen oder mehrere erwartete akademische Grade angeben. </div>
</fieldset>
<fieldset>
	<legend>Art des Angebotes</legend>
		<li><?php echo $form->labelEx($model,'is_fulltime'); ?> <?php echo $form->checkBox($model, 'is_fulltime')?></li>
		<li><?php echo $form->labelEx($model,'is_parttime'); ?> <?php echo $form->checkBox($model, 'is_parttime')?></li>
		<li><?php echo $form->labelEx($model,'is_internship'); ?> <?php echo $form->checkBox($model, 'is_internship')?></li>
		<li><?php echo $form->labelEx($model,'is_working_student'); ?> <?php echo $form->checkBox($model, 'is_working_student')?></li>
		<li><?php echo $form->labelEx($model,'is_thesis'); ?> <?php echo $form->checkBox($model, 'is_thesis')?></li>
		<li><?php echo $form->labelEx($model,'is_scholarship'); ?> <?php echo $form->checkBox($model, 'is_scholarship')?></li>	
		<div class="help">Optional können sie hier einen oder mehrere Eigenschaften Ihres Angebots angeben. </div>
</fieldset>
	
<fieldset>
	<legend>PDF Version Ihrer Anzeige und Ablaufdatum</legend>
		<li>
			<?php echo $form->labelEx($model,'attachment'); ?>
			<?php echo $form->fileField($model,'attachment'); ?>
			<div class="help">Optional können Sie hier eine PDF-Version Ihres Angebotes hochladen. Es werden keine
				Format ausser PDF akzeptiert; die maximale Dateigröße beträgt 2MB.
			</div>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'attachment'); ?></div>
		</li>
		
		<li>
			<?php echo $form->labelEx($model,'expiration_date'); ?>
			<?php echo $form->textField($model,'expiration_date', 
				array(
					'value' => date('d.m.Y', time() + (4 * 7 * 24 * 60 * 60)),
					'size' => '10')); ?>
			<div class="help">
				Format: <strong>TT.MM.YYYY</strong> &mdash; Die maximale Laufzeit der Anzeige beträgt sechs Wochen. 
			</div>
			<!-- TODO ... -->
			<div class="form-error"><?php echo $form->error($model,'expiration_date'); ?></div>
		</li>
</fieldset>		
	
	<fieldset>
		<legend>Ihre Kontaktdaten</legend>
	
	<li>
		<?php echo $form->labelEx($model,'publisher_name'); ?>
		<?php echo $form->textField($model,'publisher_name', array('size' => '70')); ?>
		<div class="form-error"><?php echo $form->error($model,'publisher_name'); ?></div>
	</li>
	<li>
		<?php echo $form->labelEx($model,'publisher_phone'); ?>
		<?php echo $form->textField($model,'publisher_phone', array('size' => '70')); ?>
		<div class="form-error"><?php echo $form->error($model,'publisher_phone'); ?></div>
	</li>
	<li>
		<?php echo $form->labelEx($model,'publisher_email'); ?>
		<?php echo $form->textField($model,'publisher_email', array('size' => '70')); ?>
		<div class="form-error"><?php echo $form->error($model,'publisher_email'); ?></div>
	</li>
	
	<div class="help">
		Wir bitten Sie die obigen Felder auszufüllen,
		damit wir Sie bei inhaltlichen Fragen zu Ihrem Angebot persönlich
		 kontaktieren können. Diese Angaben werden nicht veröffentlicht
		und nicht an Dritte weitergegeben. An die hier angegebene E-Mail-Adresse
		senden wir Ihnen eine kurze Nachricht, wenn Ihr Angebot veröffentlicht wurde.
	</div>
	
	</fieldset>

<fieldset>
	<legend>Absenden</legend>
		<li>
			<label for="captcha"><!-- 0 --></label>
			<?php echo get_captcha_html(); ?>
			<div class="form-error"><?php if ($captcha_error == true) { echo "Bitte beantworten Sie die Sicherheitsfrage."; }; ?></div>
		</li>
		
		<li>
			<label for="submit"><!-- 0 --></label>
			<?php echo CHtml::submitButton('Vorschau'); ?> 
			<?php echo Yii::t('app', 'or') ?> 
			<a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?></a>.
		</li>
</fieldset>
</ol>
<?php $this->endWidget(); ?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('textarea').addClass("idleField");
	$('textarea').focus(function() {
		$(this).parent().parent().parent().parent().removeClass("idleField").addClass("focusField");
    });

    $('textarea').blur(function() {
    	$(this).parent().parent().parent().parent().removeClass("focusField").addClass("idleField");
    });



    $('input[type="text"], input[type="file"]').addClass("idleField");
	$('input[type="text"], input[type="file"]').focus(function() {
		$(this).parent().parent().removeClass("idleField").addClass("focusField");
    });

    $('input[type="text"], input[type="file"]').blur(function() {
    	$(this).parent().parent().removeClass("focusField").addClass("idleField");
    });

	$('#Job_title').focus();
	
	$('#example-formatting').click(function(){
		$('#Job_description').val('Die ist ein Beispieltext zur Veranschaulichung der Formatierungsoptionen.\n\n*Diese Überschrift wird Fett*\n\nNormaler Text, und noch mehr normaler Text.\n\n* Eine Stichpunktliste\n* wird durch eine Liste von\n* Zeilen dargestellt,\n* die jeweils mit einem Sternchen\n* anfangen.\n\nAuch wenn wir nur wenige Formattierungsoptionen anbieten, hoffen wir, daß Sie Ihre Anzeige ausreichend übersichtlich und strukturiert darstellen können.');
	});
	
	$('#Job_description').wysiwym(Wysiwym.Markdown, {
		"containerButtons" : $("#Job_description_buttons"),
	});

	$('#Job_how_to_apply').wysiwym(Wysiwym.Markdown, {
		"containerButtons" : $("#Job_how_to_apply_buttons"),
	});
	
});
</script>
