<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#emails").focus();
	});
</script>
<style type="text/css" media="screen">
	input { font-size: 12px; }
	.help {
		font-size: 10px;
		color: gray;
	}
</style>


<div id="main">

<div id="generic-header">
<h3>Einstellungen</h3>	
</div>

<div id="main-content">

<div class="form">
<ol style="list-style: none;">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'site-options-form')); ?>
		<fieldset>
		<legend>E-Mail Notifikationen</legend>
		<li>
			<?php echo $form->labelEx($model,'E-Mail'); ?>
			<?php echo $form->textField($model,'value', array('size' => '100')); ?>
			<?php echo $form->error($model,'option'); ?>
		</li>
		
		<div class="help">Kommaseparierte Liste von E-Mail-Addressen, an die eine
			Notifikation gesendet werden soll, wenn ein neues Angebot von 
			einem Arbeitgeber eingestellt wurde.</div>
	</fieldset>
	<?php echo CHtml::submitButton('Speichern', array("class" => "searchbutton")); ?> <span style="font-size:12px;">oder</span> <a style="font-size: 12px" href="<?php echo $this->createUrl('admin/index'); ?>">Abbrechen</a></td>
	<?php $this->endWidget(); ?>
</ol>
</div><!-- form -->

</div>	
</div>









	
