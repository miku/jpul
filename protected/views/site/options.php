<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#emails").focus();
	});
</script>

<h3>Einstellungen</h3>

<table border="0" cellspacing="2" cellpadding="4">

<?php $form=$this->beginWidget('CActiveForm', array('id'=>'site-options-form')); ?>

	<tr class="even-dark"><td><?php echo $form->labelEx($model,'Emails'); ?></td></tr>
	<tr class="even"><td class="small">E-Mail-Adresse oder E-Mail-Adressen (kommasepariert), an
		die eine Notifikation geschickt werden soll, falls ein neues Jobangebot von
		einem Benutzer eingestellt wurde.
	</td></tr>	
	<tr class="even"><td><?php echo $form->textField($model,'value', array('size' => '60')); ?></td></tr>
	<tr class="even error"><td><?php echo $form->error($model,'option'); ?></td></tr>

	<tr class="even-dark"><td><input type="submit" value="Speichern"></td></tr>

<?php $this->endWidget(); ?>




</table>

