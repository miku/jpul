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
		padding: 10px 0 10px 0;
	}
	.option-name {
		font-weight: bold;
		font-size: 12px;
		padding: 10px 0 10px 0;
	}
	#site-options-form li {
		padding: 10px;
		background: #EFEFEF;
		border-bottom: solid thin #ABABAB;
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
		<legend>Einstellungen</legend>
		
			<?php foreach($options as $i=>$option): ?>
			<li>		
				<div class="option-name"><?php echo $option->option_human ?></div>
				<?php echo CHtml::activeTextField($option,"[$i]value", array('size' => '110')); ?>
				<div class="help"><?php echo $option->help ?></div>
			</li>
			<?php endforeach; ?>
		
	</fieldset>
	<?php echo CHtml::submitButton('Speichern', array("class" => "searchbutton")); ?> <span style="font-size:12px;">oder</span> <a style="font-size: 12px" href="<?php echo $this->createUrl('admin/index'); ?>">Abbrechen</a></td>
	<?php $this->endWidget(); ?>
</ol>
</div><!-- form -->

</div>	
</div>









	
