<?php $form=$this->beginWidget('CActiveForm', array('id'=>'job-create-form', 'htmlOptions'=>array('enctype'=>'multipart/form-data'))); ?>

	<div class="fi">
		<div class="fi-l">Jobtitel</div>
		<div class="fi-f"><input size="60" type="text" name="title" placeholder="Title" value="" id="first_focus"></div>
	</div>

	<div class="fi">
		<div class="fi-l">Beschreibung</div>
		<div class="content">
			<p><strong>Wir suchen Sie</strong>. Sie sind ein Arbeitgeber</p>
			<br>
			<p><ul>
				<li>der eine Arbeitsstelle, Praktikum oder Volontariat inserieren möchte,</li>
				<li>sich über einen kostenlosen Service der Universität Leipzig freut</li>
				<li>und über 20000 Studenten ein interessantes Angebot anbieten kann.</li>
			</ul></p>
			<br>
			<p>Sie sind nur noch wenige Schritte von der Veröffentlichung Íhrer Anzeige entfernt.
				Bitte editieren Sie diesen Text und füllen Sie die restlichen Felder aus. Absenden.
				Fertig.
			</p>
		</div>
	</div>


	<div class="hsep"></div>

	<div class="fi">
		<div class="fi-l">Unternehmen</div>
		<div class="fi-f"><input size="60" type="text" name="title" placeholder="Name des Unternehmen" value="" id="some_name"></div>
	</div>

	<div class="fi">
		<div class="fi-l">Homepage des Unternehmens</div>
		<div class="fi-f"><input size="60" type="text" name="title" placeholder="http://enterprise.com" value="" id="some_name"></div>
	</div>



	<div class="hsep"></div>

	<div class="fi">
		<div class="fi-l">Postleitzahl und Ort</div>
		<div class="fi-h">
			Postleitzahl und Ort der Arbeitsstelle sind zwei Pflichtfelder.
			Falls es dieser Job Reisenbereitschaft erfordert, wählen Sie zusätzlich
			das entsprechende Häkchen aus.
		</div>
		<div class="fi-f">
			<input size="8" type="text" name="title" placeholder="PLZ" value="" id="some_name" style="margin-right: 10px;">
			<input size="60" type="text" name="title" placeholder="Ort, z.B. Berlin oder Berlin, Deutschland" value="" id="some_name">
		</div>
		<div class="fi-f">
			<br>
			<input type="checkbox" name="12" value="" id="12"><label for="12">Bundesweit/Reise</label><br>
		</div>
	</div>


	<div class="hsep"></div>

	<div class="fi">
		<div class="fi-l">Ausbildungsgrad</div>

		<div class="fi-h">Mehrfachauswahl möglich. Auswahl optional.</div>

		<div class="fi-f">
			<input type="checkbox" name="1" value="" id="1"><label for="1">Student</label>
			<input type="checkbox" name="2" value="" id="2"><label for="2">Bachelor</label>
			<input type="checkbox" name="3" value="" id="3"><label for="3">Master</label>
			<input type="checkbox" name="4" value="" id="4"><label for="4">M.A.</label>
			<input type="checkbox" name="5" value="" id="5"><label for="5">PhD</label>
			<input type="checkbox" name="6" value="" id="6"><label for="6">Postdoc</label>
		</div>
		<br>

		<div class="fi-l">Art der Stelle</div>
		<div class="fi-h">Um was für eine Stelle handelt es sich? Mehrfache Auswahl ist möglich. Falls
			keine der Optionen zutrifft, brauchen Sie nichts auszuwählen.</div>
			<div class="fi-f">
				<input type="checkbox" name="1" value="" id="7"><label for="7">Vollzeit</label>
				<input type="checkbox" name="2" value="" id="8"><label for="8">Teilzeit</label>
				<input type="checkbox" name="3" value="" id="9"><label for="9">Praktikum</label>
				<input type="checkbox" name="3" value="" id="10"><label for="10">Werksstudent/in</label>
				<input type="checkbox" name="4" value="" id="11"><label for="11">Volontariat</label>
			</div>
		</div>

		<div class="hsep"></div>

		<div class="fi">
			<div class="fi-l">Attachment</div>
			<div class="fi-h">Hier können Sie eine PDF-Datei Ihrer Ausschreibung hochladen. Optional.</div>
			<div class="fi-f"><input style="font-size: 12px" size="60" type="file" name="title" placeholder="Datei" value="" id="some_name"></div>
		</div>

		<div class="hsep"></div>
		
		
		<div class="fi">
			<div class="fi-l">Ablaufdatum der Anzeige</div>
			<div class="fi-h">
				Bis zu welchem Datum soll die Anzeige aktiv sein? Maximum ist sechs Wochen.
				Das Format ist: TT.MM.JJJJ
				</div>
			<div class="fi-f">
				<input value="08.03.2011" name="Job[expiration_date]" id="Job_expiration_date" type="text" />
			</div>
		</div>

		<div class="hsep"></div>


		<div class="fi">
			<div class="fi-l">Willkommen Webbots!</div>
			<div class="fi-h">Es tut uns leid, aber wir benötigen die Antwort 
				auf die folgende Sicherheitsfrage.
				</div>
			<div class="fi-f">
				<?php echo get_captcha_html(); ?>
			</div>
		</div>

		<div class="hsep"></div>



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

			<div class="hsep"></div>
		
				
	<div class="fi" style="font-size: 12px;">
		<?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?>.</a>
	</div>
				
				

<?php $this->endWidget(); ?>	
