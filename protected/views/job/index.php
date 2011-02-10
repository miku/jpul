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
	
	$(".type-filter").click(function() {
		var filter = new Array();
		$(".type-filter").each(function(index, element) {
			// value += "" + ( $(this).attr('checked') ? 1 : 0 ) + ",";
			if ($(this).attr('checked')) {
				filter.push($(this).attr('id'));
			}
		});
		var value = filter.join("~");
		var c = $("#sort").attr("baseurl") + "type=" + value;
		window.location.replace(c);
	});
	
	var activeTypes = new Array();
	
	if ($.url.param('type') != undefined) {
		activeTypes = $.url.param('type').split('~');
		for (var i = activeTypes.length - 1; i >= 0; i--) {
			$('#' + activeTypes[i]).attr('checked', true);
		}
	}

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

<!-- 	 <div id="filter-subbar" style="border-left: solid thin #EFEFEF; border-right: solid thin #EFEFEF; font-size: 10px; margin: 0 10px 0 10px; padding: 10px 10px 10px 10px; background: aliceblue;">
		<input class="type-filter" type="checkbox" name="f-fu" id="frfu"><label style="margin: 0 10px 0 3px;" for="filter-fulltime">Vollzeit</label>
		<input class="type-filter" type="checkbox" name="f-pa" id="frpa"><label style="margin: 0 10px 0 3px;" for="filter-parttime">Teilzeit</label>
		<input class="type-filter" type="checkbox" name="f-in" id="frin"><label style="margin: 0 10px 0 3px;" for="filter-internship">Praktika</label>
		<input class="type-filter" type="checkbox" name="f-wo" id="frwo"><label style="margin: 0 10px 0 3px;" for="filter-working-student">Werkstudenten</label>
		<input class="type-filter" type="checkbox" name="f-sc" id="frsc"><label style="margin: 0 10px 0 3px;" for="filter-scholarship">Stipedien</label>
		<input class="type-filter" type="checkbox" name="f-th" id="frth"><label style="margin: 0 10px 0 3px;" for="filter-thesis">Abschlussarbeiten</label>
	</div> 
	 -->
	<div id="fav-subbar" style="border: solid thin #EFEFEF; font-size: 10px; margin: 0 10px 0 10px; padding: 10px 10px 10px 10px; background: aliceblue;">		
		<?php $this->renderPartial('_favbar') ?>
	</div>
	
	<div id="query-stats">
		<p class="alignleft">
			Finden Sie passende Angebot über Suchbegriffe, z.B.
			<a href="<?php echo $this->createUrl('job/index', array('q' => "marketing")) ?>">marketing</a>,
			<a href="<?php echo $this->createUrl('job/index', array('q' => "software leipzig")) ?>">software leipzig</a>,
			<a href="<?php echo $this->createUrl('job/index', array('q' => "wissenschaft")) ?>">wissenschaft</a>,
			<a href="<?php echo $this->createUrl('job/index', array('q' => "berlin")) ?>">berlin</a>, 
			<a href="<?php echo $this->createUrl('job/index', array('q' => "praktik")) ?>">praktik</a>, etc.
		</p>
		<p class="alignright"><?php echo $total; ?> Ergebnisse.</p>
		<div class="clear"></div>
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

		<?php
			$this->renderPartial('_better_pagination', array(
				'models' => $models, 
				'original_query', $original_query,
				'total' => $total)
			);
		?>
		
	
	
	</div>
</div> <!-- main -->
</div> <!-- main-container -->

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('_sidebar_contact'); ?>
		<?php $this->renderPartial('_sidebar_for_employer'); ?>
		<?php $this->renderPartial('_sidebar_fb'); ?>
		<?php $this->renderPartial('_sidebar_supporter'); ?>
	</div>	
</div>

