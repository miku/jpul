<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$("#search").focus();

	$("a.fav-toggle").click(function(){
		if ($(this).hasClass("isfav")) {
			$(this).removeClass("isfav");
		} else {
			$(this).addClass("isfav");
		}
	});
	
	$("#sort").change(function() {
		var sortOrder = $("#sort option:selected").text();
		var value = sortOrder.substr(0, 1).toLowerCase();
		var c = $("#sort").attr("baseurl") + "sort=" + value;
		window.location.replace(c);
	});

});
</script>

<div id="main-container">
<div id="main">
	<div id="main-header">
		<div id="searchbox">
			<form action="<?php echo $this->createUrl('job/index') ?>" method="get" accept-charset="utf-8">
				<input size="60" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search">
				<input type="submit" value="Suchen" class="button">
			</form>
		</div>
		
		<div id="sortmenu">
			sortieren nach: 
			<?php if (isset($original_query)): ?>
				<select baseurl="<?php echo $this->createUrl('job/index', array('q' => $original_query)) ?>&" id="sort" name="sort">
			<?php else: ?>
				<select baseurl="<?php echo $this->createUrl('job/index') ?>?" id="sort" name="sort">
			<?php endif ?>
				<option <?php if ($sort === "d"): ?>selected="selected" <?php endif; ?> value="d">Datum</option>
				<option <?php if ($sort === "t"): ?>selected="selected" <?php endif; ?> value="d">Title</option>
				<option <?php if ($sort === "u"): ?>selected="selected" <?php endif; ?> value="d">Unternehmen</option>
				<option <?php if ($sort === "o"): ?>selected="selected" <?php endif; ?> value="d">Ort</option>															
			</select>
		</div>

		
	</div>
	<div id="main-content">

		<div id="listing">
			<?php 
			foreach ($models as $i => $model) {
				$this->renderPartial('_post', array('model' => $model, 'index' => $i));
			}
			?>
		</div>


	<?php if ($models): ?>
		<div id="pagination">

			<?php if ($page > 1): ?>

				<?php if (isset($original_query)): ?>
					<a href="<?php echo $this->createUrl('job/search', array('page' => $page - 1, 'q' => $original_query)) ?>">< Vorherige</a>
				<?php else: ?>
					<a href="<?php echo $this->createUrl('job/index', array('page' => $page - 1)) ?>">< Vorherige</a>
				<?php endif ?>

			<?php else: ?>
				<span class="inactive">< Vorherige</span>
			<?php endif; ?>

			<?php if (isset($original_query)): ?>			
				<a class="current-page" href="<?php echo $this->createUrl('job/search', array('page' => $page, 'q' => $original_query)) ?>"><?php echo $page ?></a>
			<?php else: ?>
				<a class="current-page" href="<?php echo $this->createUrl('job/index', array('page' => $page)) ?>"><?php echo $page ?></a>
			<?php endif ?>

			<?php if ($current_end < $total): ?>
				<?php if (isset($original_query)): ?>
					<a href="<?php echo $this->createUrl('job/search', array('page' => $page + 1, 'q' => $original_query)) ?>">Nächste ></a>
				<?php else: ?>
					<a href="<?php echo $this->createUrl('job/index', array('page' => $page + 1)) ?>">Nächste ></a>
				<?php endif; ?>

			<?php else: ?>
				<span class="inactive">Nächste ></span>
			<?php endif; ?>

		</div>
	<?php endif; ?>
	</div>
</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_for_employer'); ?>
	</div>	
</div>

