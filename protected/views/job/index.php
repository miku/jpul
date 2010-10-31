<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#search").focus();
	});
</script>

<div id="searchbox">
	<form action="<?php echo $this->createUrl('job/search') ?>" method="get" accept-charset="utf-8">
		<input size="40" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search"><input type="submit" value="Search">
	</form>
</div>


<h3>Aktuelle Jobangebote <?php if (isset($original_query)) echo 'für ' . $original_query ?></h3>

<table border="0" cellspacing="2" cellpadding="4">
<?php 
foreach ($models as $i => $model) {
	$this->renderPartial('_teaser', array('model' => $model, 'index' => $i));
}
?>
</table>

<?php if ($models): ?>
	<div class="line"></div>

	<div class="pagination">
		
		<?php if ($page > 1): ?>
		
		 	<?php if (isset($original_query)): ?>
				<a href="<?php echo $this->createUrl('job/search', array('page' => $page - 1, 'q' => $original_query)) ?>">Vorherige</a>
			<?php else: ?>
		 		<a href="<?php echo $this->createUrl('job/index', array('page' => $page - 1)) ?>">Vorherige</a>
		 	<?php endif ?>
		
		<?php else: ?>
			<span class="inactive">Vorherige</span>
		<?php endif; ?>

		 <?php if (isset($original_query)): ?>			
			<a class="current-page" href="<?php echo $this->createUrl('job/search', array('page' => $page, 'q' => $original_query)) ?>"><?php echo $page ?></a>
		<?php else: ?>
			<a class="current-page" href="<?php echo $this->createUrl('job/index', array('page' => $page)) ?>"><?php echo $page ?></a>
		<?php endif ?>

		<?php if ($current_end < $total): ?>
			<?php if (isset($original_query)): ?>
				<a href="<?php echo $this->createUrl('job/search', array('page' => $page + 1, 'q' => $original_query)) ?>">Nächste</a>
			<?php else: ?>
				<a href="<?php echo $this->createUrl('job/index', array('page' => $page + 1)) ?>">Nächste</a>
			<?php endif; ?>
			
		<?php else: ?>
			<span class="inactive">Nächste</span>
		<?php endif; ?>
		
	</div>
<?php else: ?>
	<p>Keine Ergebnisse gefunden. Zurück zur <a href="<?php echo $this->createUrl('job/index'); ?>">Homepage</a>.</p>
<?php endif; ?>
