<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#Job_title").focus();
	});
</script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
// tinyMCE.init({
// 	mode : "textareas",
// 	theme : "simple",
});

// tinyMCE.init({
// 	// General options
// 	mode : "textareas",
// 	theme : "advanced",
// 	plugins : "safari,style,fullscreen",
// 
// 	// Theme options
// 	// theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect",
// 	theme_advanced_buttons1 : "bold,italic,underline,justifyleft,justifycenter,fontsizeselect",
// 	// theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
// 	// theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
// 	// theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
// 	theme_advanced_toolbar_location : "top",
// 	theme_advanced_toolbar_align : "left",
// 	// theme_advanced_statusbar_location : "bottom",
// 	// theme_advanced_resizing : true,
// 
// 	// Example content CSS (should be your site CSS)
// 	// content_css : "css/example.css",
// 
// 	// Drop lists for link/image/media/template dialogs
// 	// template_external_list_url : "js/template_list.js",
// 	// external_link_list_url : "js/link_list.js",
// 	// external_image_list_url : "js/image_list.js",
// 	// media_external_list_url : "js/media_list.js",
// 
// 	// Replace values for the template plugin
// 	// template_replace_values : {
// 	// 	username : "Some User",
// 	// 	staffid : "991234"
// 	// }
// });
</script>




<div class="form">
	
	<h3>Neues Angebot erstellen</h3>

<?php $form=$this->beginWidget('CActiveForm', 
	array(	'id'=>'job-create-form', 
			'htmlOptions'=>array('enctype'=>'multipart/form-data'))); 
?>

	<?php echo $form->errorSummary($model); ?>
	
	<table border="0" cellspacing="2" cellpadding="4">

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'title'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'title', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'title'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->labelEx($model,'description'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textArea($model,'description', array("rows" => "35", "cols" => "60")); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'description'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'company'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'company', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'company'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->labelEx($model,'company_homepage'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'company_homepage', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'company_homepage'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'degree_id'); ?> <?php echo $form->dropDownList($model, 'degree_id', CHtml::listData(Degree::model()->findAll(), 'id', 'name'),array('prompt' => 'Akademischer Abschluß')); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'zipcode'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'zipcode'); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'zipcode'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'city'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'city', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'city'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'state'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'state', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'state'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'country'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'country', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'country'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->checkBox($model,'is_telecommute'); ?> <?php echo $form->labelEx($model,'is_telecommute'); ?></td></tr>
		<tr class="even-dark"><td><?php echo $form->checkBox($model,'is_nation_wide'); ?> <?php echo $form->labelEx($model,'is_nation_wide'); ?></td></tr>


		<tr class="even-dark"><td><?php echo $form->labelEx($model,'study'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'study', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'study'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'sector'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textField($model,'sector', array('size' => '60')); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'sector'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'how_to_apply'); ?></td></tr>
		<tr class="even"><td><?php echo $form->textArea($model,'how_to_apply', array("rows" => "10", "cols" => "40")); ?></td></tr>
		<tr class="even"><td><?php echo $form->error($model,'how_to_apply'); ?></td></tr>

		<tr class="even-dark"><td><?php echo $form->labelEx($model,'attachment'); ?></td></tr>		
		<tr class="even help"><td>Erlaubtes Format: PDF</td></tr>		
		
		<tr class="even"><td><?php echo $form->fileField($model,'attachment'); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'attachment'); ?></td></tr>
		
		<tr class="even-dark"><td><?php echo $form->labelEx($model,'expiration_date'); ?></td></tr>
		<tr class="even help"><td>Optional im Format TT.MM.YYYY (Standardlaufzeit: 6 Wochen)</td></tr>		
		<tr class="even"><td><?php echo $form->textField($model,'expiration_date', array('value' => date('d.m.Y', time() + (6 * 7 * 24 * 60 * 60)))); ?></td></tr>
		<tr class="even error"><td><?php echo $form->error($model,'expiration_date'); ?></td></tr>
		


		<tr class="even-dark"><td><label for="captcha_challenge">Sicherheitsfrage</label></td></tr> 
		<tr class="even"><td>
			<?php echo get_captcha_html(); ?>
		</td></tr> 
		<tr class="even error"><td></td></tr> 	
		
		<tr class="even"><td><?php echo CHtml::submitButton(Yii::t('app', 'Submit')); ?> <?php echo Yii::t('app', 'or') ?> <a href="<?php echo $this->createUrl('job/index') ?>"><?php echo Yii::t('app', 'cancel'); ?></a></td></tr>
		
	</table>


<?php $this->endWidget(); ?>

</div><!-- form -->