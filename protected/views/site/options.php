<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#emails").focus();
	});
</script>


<div id="main">

<div id="generic-header">
<p>Einstellungen</p>	
</div>

<div id="main-content">

<div class="form">
	<table border="0" cellspacing="2" cellpadding="4">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'site-options-form')); ?>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'Emails'); ?></td></tr>
		<tr class="even"><td class="small">E-Mail-Adresse oder E-Mail-Adressen (kommasepariert), an
			die eine Notifikation geschickt werden soll, falls ein neues Jobangebot von
			einem Benutzer eingestellt wurde.
		</td></tr>	
		<tr class="even"><td><?php echo $form->textField($model,'value', array('size' => '80')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'option'); ?></td></tr>

		<tr class="even-dark"><td><input type="submit" value="Speichern"> <span style="font-size:12px;">oder</span> <a style="font-size: 12px" href="<?php echo $this->createUrl('admin/index'); ?>">Abbrechen</a></td></tr>

	<?php $this->endWidget(); ?>
	</table>
</div><!-- form -->

</div>	
</div>








