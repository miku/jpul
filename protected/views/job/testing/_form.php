<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>

<div class="shadow">
<div class="fi">
	<div class="fi-l"><?php echo $form->labelEx($model,'title'); ?></div>
	<div class="fi-e"><?php echo $form->error($model,'title'); ?></div>
	<div class="fi-f"><?php echo $form->textField($model,'title', array('size' => '60')); ?></div>
</div>

<div class="fi bb">
	<div class="fi-l"><?php echo $form->labelEx($model,'description'); ?></div>
	<div class="content">
		<p>Wir suchen Sie. Sie sind ein Arbeitgeber, der</p>
		<br>
		<p><ul>
			<li>eine Arbeitsstelle, Praktikum oder Volontariat inserieren möchte,</li>
			<li>sich über einen kostenlosen Service der Universität Leipzig freut und</li>
			<li>über 20000 Studenten ein interessantes Angebot anbieten kann.</li>
		</ul></p>
		<br>
		<p><strong>Interessiert?</strong></p>
		<br>
		<p>Sie sind nur noch wenige Schritte von der Veröffentlichung Ihrer Anzeige entfernt.
			Bitte editieren Sie diesen Text und füllen Sie die restlichen Felder aus. Absenden.
			Fertig.
		</p>
		<br>
	</div>
</div>



<div class="hsep"></div>

<div class="bb bt">
	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'company'); ?></div>
		<div class="fi-f"><?php echo $form->textField($model,'company', array('size' => '60')); ?></div>
	</div>

	<div class="fi">
		<div class="fi-l"><?php echo $form->labelEx($model,'company_homepage'); ?></div>
		<div class="fi-f"><?php echo $form->textField($model,'company_homepage', array('size' => '60', 'placeholder' => 'http://example.com')); ?></div>
	</div>
</div>



<div class="hsep"></div>

<div class="fi bb bt">
	<div class="fi-l"><?php echo $form->labelEx($model,'zipcode'); ?>  <?php echo $form->labelEx($model,'city'); ?></div>
	<div class="fi-h">
		Postleitzahl und Ort der Arbeitsstelle sind zwei Pflichtfelder.
		Falls es dieser Job Reisenbereitschaft erfordert, wählen Sie zusätzlich
		das entsprechende Häkchen aus.
	</div>
	<div class="fi-f">
		<?php echo $form->textField($model,'zipcode', array('size' => '8', 'style' => 'margin-right:10px;')); ?>
		<?php echo $form->textField($model,'city', array('size' => '60')); ?>
	</div>
	<div class="fi-f horizontal">
		<br>
		<input type="checkbox" name="12" value="" id="12"><label for="12">Bundesweit/Reise</label><br>
	</div>
</div>


<div class="hsep"></div>


<div class="fi bb bt">
	<div class="fi-l"><?php echo $form->labelEx($model,'degree_id'); ?></div>

	<div class="fi-h">Mehrfachauswahl möglich. Auswahl optional.</div>

	<div class="fi-f horizontal">
		<input type="checkbox" name="1" value="" id="1"><label for="1">Student</label>
		<input type="checkbox" name="2" value="" id="2"><label for="2">Bachelor</label>
		<input type="checkbox" name="3" value="" id="3"><label for="3">Master</label>
		<input type="checkbox" name="4" value="" id="4"><label for="4">M.A.</label>
		<input type="checkbox" name="5" value="" id="5"><label for="5">PhD</label>
		<input type="checkbox" name="6" value="" id="6"><label for="6">Postdoc</label>
	</div>
	<br>

	<div class="fi-l"><?php echo $form->labelEx($model,'jobtype'); ?></div>
	<div class="fi-h">Um was für eine Stelle handelt es sich? Mehrfache Auswahl ist möglich. Falls
		keine der Optionen zutrifft, brauchen Sie nichts auszuwählen.</div>
		<div class="fi-f horizontal">
			<input type="checkbox" name="1" value="" id="7"><label for="7">Vollzeit</label>
			<input type="checkbox" name="2" value="" id="8"><label for="8">Teilzeit</label>
			<input type="checkbox" name="3" value="" id="9"><label for="9">Praktikum</label>
			<input type="checkbox" name="3" value="" id="10"><label for="10">Werksstudent/in</label>
			<input type="checkbox" name="4" value="" id="11"><label for="11">Volontariat</label>
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
	<div class="fi" style="font-size: 12px;">
		<?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?>.</a>
	</div>
</div>

</div>
<?php $this->endWidget(); ?>	
