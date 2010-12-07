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
		var c = $("#sort").attr("baseurl") + "?sort=" + value;
		window.location.replace(c);
	});
});
</script>

<div id="main-container">
<div id="main">
	<div id="main-header">
		<div id="searchbox">
			<form action="<?php echo $this->createUrl('admin/index') ?>" method="get" accept-charset="utf-8">
				<input size="60" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search">
				<input type="submit" value="Suchen" class="button">
			</form>
		</div>
		
		<div id="sortmenu">
			sortieren nach: 
			<select baseurl="<?php echo $this->createUrl('admin/index') ?>" id="sort" name="sort">
				<option <?php if ($sort === "d"): ?>selected="selected" <?php endif; ?> value="d">Datum</option>
				<option <?php if ($sort === "t"): ?>selected="selected" <?php endif; ?> value="d">Title</option>
				<option <?php if ($sort === "u"): ?>selected="selected" <?php endif; ?> value="d">Unternehmen</option>
				<option <?php if ($sort === "o"): ?>selected="selected" <?php endif; ?> value="d">Ort</option>															
			</select>
		</div>

		
	</div>	
	<div id="main-content">
		<!-- <h3>Aktuelle Jobangebote <?php if (isset($original_query)) echo 'für ' . $original_query ?></h3> -->

		<div id="listing">
			<?php 
		foreach ($models as $i => $model) {
			if (Yii::app()->user->isAdmin()) {
				$this->renderPartial('_post', array('model' => $model, 'index' => $i));		
			} else {
				$this->renderPartial('_post', array('model' => $model, 'index' => $i));
			}
		}
		?>
	</div>


	<?php if ($models): ?>
		<div id="pagination">

			<?php if ($page > 1): ?>
				<?php
					$_params = array();
					if (isset($original_query)) { $_params['q'] = $original_query; }
					if (isset($sort)) { $_params['sort'] = $sort; }
					$_params['page'] = $page - 1;
				?>
				<a href="<?php echo $this->createUrl('admin/index', $_params); ?>">&lt; Vorherige</a>
			<?php else: ?>
				<span class="inactive">&lt; Vorherige</span>
			<?php endif; ?>

			<?php
				$_params = array();
				if (isset($original_query)) { $_params['q'] = $original_query; }
				if (isset($sort)) { $_params['sort'] = $sort; }
				$_params['page'] = $page;
			?>
			<a class="current-page" href="<?php echo $this->createUrl('admin/index', $_params) ?>"><?php echo $page ?></a>

			<?php if ($current_end < $total): ?>
				<?php
					$_params = array();
					if (isset($original_query)) { $_params['q'] = $original_query; }
					if (isset($sort)) { $_params['sort'] = $sort; }
					$_params['page'] = $page + 1;
				?>
				<a href="<?php echo $this->createUrl('admin/index', $_params) ?>">Nächste &gt;</a>
			<?php else: ?>
				<span class="inactive">Nächste &gt;</span>
			<?php endif; ?>

		</div>
	<?php endif; ?>
	</div>
</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_filter'); ?>
		<?php $this->renderPartial('_sidebar_index_actions'); ?>
	</div>
</div>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$(".filter-option > input").click(function(){
		$(this).attr("name")
	});
});
</script>

