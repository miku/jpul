<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
  		$("#search").focus();
	});
</script>

<div id="main">

<div id="main-header">
	<div id="searchbox">
		<form action="<?php echo $this->createUrl('job/search') ?>" method="get" accept-charset="utf-8">
			<input size="60" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search">
			<input type="submit" value="Suchen" class="button">
		</form>
	</div>
</div>


<div id="main-content">
	<!-- <h3>Aktuelle Jobangebote <?php if (isset($original_query)) echo 'für ' . $original_query ?></h3> -->

	<?php if (Yii::app()->user->isAdmin()): ?>
	<div class="admin-index-extras small">
		<?php if (Yii::app()->session['showexpired'] == 0): ?>
			<a href="<?php echo $this->createUrl('job/index', array('showexpired' => 1)) ?>">Alle anzeigen</a>
		<?php else: ?>
			<a href="<?php echo $this->createUrl('job/index', array('showexpired' => 0)) ?>">Nur aktuelle anzeigen</a>
		<?php endif ?>
	</div>
	<?php endif ?> 


	<div id="listing">
		<?php 
			foreach ($models as $i => $model) {
				if (Yii::app()->user->isAdmin()) {
					$this->renderPartial('_teaser_admin', array('model' => $model, 'index' => $i));		
				} else {
					$this->renderPartial('_post', array('model' => $model, 'index' => $i));
				}
			}
		?>
	</div>




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
</div>
</div>