<h1>Angebotsvorschau und Verwaltung</h1>

<?php if ($model->status_id == 1): ?>
<p>
	Sie sehen auf der linken Seite eine Vorschau Ihres Angebotes. <strong>Wenn
	Sie zufrieden sind, brauchen Sie nichts weiter zu machen - das Angebot
	wird durch unsere Mitarbeiter geprüft und in Kürze freigeschaltet.</strong> 
</p>
<?php endif ?>

<p>
	Noch nicht perfekt? Sie möchten Ihr Angebot noch einmal bearbeiten? 
	Nutzen sie folgenden Link:<br>
	<strong><a href="<?php echo $this->createUrl('ukey/edit', array('id' => $id)) ?>">Dieses Angebot überarbeiten</a></strong>.
</p>
<p>
	Sie möchten das Angebot gänzlich löschen? Nutzen sie folgenden Link:<br>
	<a style="color:red; font-weight:bold;" 
		onclick="return confirm('Diese Aktion läßt sich nicht rückgängig machen. Angebot jetzt wirklich löschen?')"
		href="<?php echo $this->createUrl('ukey/delete', array('id' => $model->ukey)) ?>">Angebot löschen</a>.<br>
</p>
<p>Sie möchten ein weiteres Angebot einstellen? Nutzen Sie den 
	folgenden Link:<br>
	<strong><a href="<?php echo $this->createUrl('job/draft') ?>">Weiteres Angebot einstellen</a></strong>.
</p>
<p>
	Hinweis: Wenn Sie sich die <a href="<?php echo $this->createUrl('ukey/preview', array('id' => $id)) ?>" title="<?php echo Yii::app()->request->serverName . $this->createUrl('ukey/preview', array('id' => $id)) ?>">aktuelle URL in Ihrer URL-Leiste</a> abspeichern (oder 'bookmarken'), können
	Sie jederzeit wieder auf diese Seite gelangen, um Änderungen an Ihrem Angebot
	vorzunehmen, z.B. um es vorzeitig zu löschen und auch um es zu verlängern. 
	Bitte beachten Sie, daß <strong>nach jeder Ihrer Änderungen eine Freischaltung durch
	das Career Center nötig ist</strong>. 
</p>
<p>
	
</p>
