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
				<input size="50" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search">
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
				<option <?php if ($sort === "t"): ?>selected="selected" <?php endif; ?> value="d">Titel</option>
				<option <?php if ($sort === "u"): ?>selected="selected" <?php endif; ?> value="d">Unternehmen</option>
				<option <?php if ($sort === "o"): ?>selected="selected" <?php endif; ?> value="d">Ort</option>															
			</select>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div id="fav-subbar" style="font-size: 10px; margin: 0 10px 0 10px; padding: 10px 10px 10px 10px; background: aliceblue;">
		<?php if (isset(Yii::app()->session['ufk__v3']) && count(Yii::app()->session['ufk__v3']) > 0): ?>
			<?php if (isset($fav_view) && ($fav_view)): ?>
				<a class="fav-link" href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Übersicht</a>
			<?php else: ?>
				<a class="fav-link" href="<?php echo $this->createUrl('job/index', array('s' => "favs")) ?>">Meine Favoriten anzeigen (<?php echo count(Yii::app()->session['ufk__v3']) ?>)</a>			
			<?php endif ?>
		<?php else: ?>
		<?php endif ?>
	</div>
		


	<div id="main-content">

		<div id="listing">
			<?php 
			foreach ($models as $i => $model) {
				if (isset($original_query) && $original_query !== "") {
					$this->renderPartial('_post', array('model' => $model, 'index' => $i, 'original_query' => $original_query));
				} else {
					$this->renderPartial('_post', array('model' => $model, 'index' => $i));
				}
				
			}
			?>
			<?php if (!$models): ?>
				<p class="noresults-box">
					Keine Ergebnisse gefunden. Versuchen Sie bitte weniger spezifische Suchbegriffe.
					Um wieder alle Angebote zu sehen, löschen Sie bitte Ihre Eingabe aus dem Suchfeld und drücken Sie &lt;ENTER&gt;.
					</p>
			<?php endif ?>
		</div>

	<?php if ($models): ?>
		<div id="pagination">
			
			<span class="total">Insgesamt <?php echo $total ?> Angebote.</span>
			

			<?php if ($page > 1): ?>
				<?php
					$_params = array();
					if (isset($original_query)) { $_params['q'] = $original_query; }
					if (isset($sort)) { $_params['sort'] = $sort; }
					$_params['page'] = $page - 1;
				?>
				<a href="<?php echo $this->createUrl('job/index', $_params); ?>">&lt; Vorherige</a>
			<?php else: ?>
				<span class="inactive">&lt; Vorherige</span>
			<?php endif; ?>

			<?php
				$_params = array();
				if (isset($original_query)) { $_params['q'] = $original_query; }
				if (isset($sort)) { $_params['sort'] = $sort; }
				$_params['page'] = $page;
			?>
			<a class="current-page" href="<?php echo $this->createUrl('job/index', $_params) ?>"><?php echo $page ?></a>

			<?php if ($current_end < $total): ?>
				<?php
					$_params = array();
					if (isset($original_query)) { $_params['q'] = $original_query; }
					if (isset($sort)) { $_params['sort'] = $sort; }
					$_params['page'] = $page + 1;
				?>
				<a href="<?php echo $this->createUrl('job/index', $_params) ?>">Nächste &gt;</a>
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
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_for_employer'); ?>
		<?php $this->renderPartial('_sidebar_supporter'); ?>
	</div>	
</div>

