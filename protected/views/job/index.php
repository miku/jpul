<div id="main-container">
<div id="main">	
	<div id="main-header">
		<div id="searchbox">
				<form action="<?php echo $this->createUrl('job/index') ?>" method="get" accept-charset="utf-8">
				<input size="40" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search">
				<?php if ($f == '-internship'): ?>
					<input type="hidden" name="f" value="<?php echo $f ?>" id="f">
				<?php endif; ?>
				<input type="submit" value="Suchen" class="button">
			</form>
		</div>
		
		<div id="sortmenu">
			<p style="padding: 8px 0 0 0; font-size:10px">
				
				
				<?php if ($f == '-internship'): ?>

					<?php if (isset($original_query)): ?>
						<strong>&#x03c0;</strong> <span style="border-bottom: solid red 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox', 'q' => $original_query)) ?>">einblenden</a>
					<?php else: ?>
						<strong>&#x03c0;</strong> <span style="border-bottom: solid red 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox')) ?>">einblenden</a>
					<?php endif ?>
					
				
				<?php else: ?>

					<?php if (isset($original_query)): ?>
						&#x2716; <span style="border-bottom: solid green 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox', 'f' => '-internship', 'q' => $original_query)) ?>">ausblenden</a>
					<?php else: ?>
						&#x2716; <span style="border-bottom: solid green 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox', 'f' => '-internship')) ?>">ausblenden</a>
					<?php endif ?>
					
				<?php endif ?>
				
				|
				
				<?php if ($original_query == 'praktik* OR werkstudent OR volontariat OR shk'): ?>
					<a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox')) ?>">Alle anzeigen</a>
				<?php else: ?>
					<a href="<?php echo urldecode($this->createUrl('job/index', array('src' => 'topbox', 'q' => 'praktik*+OR+werkstudent+OR+volontariat+OR+shk'))) ?>">Nur Praktika anzeigen</a>
				<?php endif ?>
				
				 
			</p>
			
			<!-- 
				select * from ____ where ____ like '%?sort=%' and not ____ like '10_6_7' and ____ like '%de%';  
				yields 938 rows of 101488 match, which are 0.92% - so we stash this feature for now
			-->
			
			<!-- sortieren nach: 
			<?php if (isset($original_query)): ?>
				<select baseurl="<?php echo $this->createUrl('job/index', array('q' => $original_query)) ?>&" id="sort" name="sort">
			<?php else: ?>
				<select baseurl="<?php echo $this->createUrl('job/index') ?>?" id="sort" name="sort">
			<?php endif ?>
				<option <?php if ($sort === "d"): ?>selected="selected" <?php endif; ?> value="d">Datum</option>
				<option <?php if ($sort === "t"): ?>selected="selected" <?php endif; ?> value="d">Titel</option>
				<option <?php if ($sort === "u"): ?>selected="selected" <?php endif; ?> value="d">Unternehmen</option>
				<option <?php if ($sort === "o"): ?>selected="selected" <?php endif; ?> value="d">Ort</option>															
			</select> -->
		</div>
		
		<div class="clear"></div>
	</div>

	<div id="fav-subbar" style="border: solid thin #EFEFEF; font-size: 10px; margin: 0 10px 0 10px; padding: 10px 10px 10px 10px; background: aliceblue;">		
			<?php $this->renderPartial('_favbar') ?>
	</div>
		
	<div id="info-subbar">
		<p class="alignleft">
			<?php $adslot = rand(1, 100); ?>
			
			<?php if ($adslot > 70): ?>
			
				Finden Sie passende Angebote über Suchbegriffe, z.B.
				<?php $this->renderPartial('_snippet_example_searches') ?>			
			
			<?php elseif ($adslot > 30): ?>				
				<strong>09.-13. Mai 2011</strong> <a class="outbound" href="http://www.zv.uni-leipzig.de/studium/career-center/karrierewoche.html">Karrierewoche der Universität Leipzig | Workshops | Berufseinstiegstag | und mehr ...</a>
			
			<?php else: ?>
			
				<?php
					include_once("t-simple-html-dom.php");
					error_reporting(0);
					$html = file_get_html('http://www.zv.uni-leipzig.de/studium/career-center/aktuelles.html');
					
					$offers = array();
					foreach($html->find('p') as $e) {
						if (strpos($e->innertext, "qualifizierungsangebote")) { 
							array_push($offers, preg_replace("/href=\"studium/", "href=\"http://www.zv.uni-leipzig.de/studium", $e->innertext)); 
						}
					}
					
					if (count($offers) > 0) {
						$item = $offers[array_rand($offers)];
						$item = preg_replace("/<br[^>]*>/", " ", $item);
						echo "Aktuelle Qualifizierungsangebote: " . strip_tags($item, "<a><strong>");
					} else { ?>
						Finden Sie passende Angebote über Suchbegriffe, z.B.
						<?php $this->renderPartial('_snippet_example_searches') ?>
				  <?php }
					error_reporting(E_ALL);
				 ?>
			
			<?php endif ?>
			
		</p>
		<p class="alignright"><strong><span style="background: gray; color: white; padding:2px;">
			<?php echo $total; ?></span></strong> Ergebnis<?php if ($total > 1) { echo "se"; } ?></p>
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
					<br>
						Hier ein paar exemplarische Suchbegriffe:
						<?php $this->renderPartial('_snippet_example_searches') ?>					
					</p>
			<?php endif ?>
		</div>

		<?php
			$this->renderPartial('_pagination', array(
				'models' => $models, 'total' => $total));
		?>
	
	</div>
	
	
	<div id="footer">
		<p>(C) 2010 &mdash; <?php echo date("Y"); ?> Career Center der Universität Leipzig</p>

		<br>
		<p><strong>Listenansichten</strong> &middot;
		
			<a href="<?php echo $this->createUrl('list/companies'); ?>">Liste der Unternehmen</a> &middot;
			<a href="<?php echo $this->createUrl('list/cities'); ?>">Liste der Orte</a>
		</p>
		<br>
		<p><strong>Beispielsuchen</strong> &middot;
			<a href="<?php echo $this->createUrl('job/index', array("q" => "english OR englisch")); ?>">Englischkenntnisse</a> &middot;
			<a href="<?php echo $this->createUrl('job/index', 
				array("q" => 
					"french OR französisch OR spanish OR spanisch OR chinese OR chinesisch OR russian OR russisch OR turkish OR türkisch OR polish OR polnisch OR czech OR tschechisch OR serbian OR serbisch OR italian OR italienisch OR hungarian OR ungarisch OR swedish OR schwedisch OR norwegian OR norwegisch OR finnish OR finnisch OR estonian OR estnisch OR bulgarian OR bulgarisch OR romanian OR rumänisch OR ukrainian OR ukrainisch")); ?>">Sprachen außer Englisch</a> &middot;
			<a href="<?php echo urldecode($this->createUrl('job/index', array("q" => "übersetz*+OR+translate+OR+translation"))); ?>">Übersetzung</a> &middot;
			<a href="<?php echo $this->createUrl('job/index', array("q" => "public relation")); ?>">PR Jobs</a> &middot;
			<a href="<?php echo $this->createUrl('job/index', array("q" => "sport")); ?>">Jobs im Sport</a> &middot;
			<a href="<?php echo urldecode($this->createUrl('job/index', array("q" => "informatik+-praktik*"))); ?>">Informatik (ohne Praktika)</a>
		</p>
		<br>
		<p><strong>Suchoperatoren</strong> &middot;
			Ausschluß: -suchbegriff &middot; AND, OR, NOT &middot; Position: "nach Vereinbarung",  Fuzzy: suchbegriff~
		</p>
		<br>
		<p><strong>Unser Jobportal in klein für Ihre Webseite</strong> &middot;
			<a href="<?php echo $this->createUrl('widget/index'); ?>">Jobportal Widget</a>
		</p>
			
	</div>
	
</div> <!-- main -->
</div> <!-- main-container -->


<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
		<?php $this->renderPartial('/shared/_sidebar_fb'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
	</div>	
</div>

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
		
		// intern is a class added by T3 - it may change!
		$("a.outbound, a.intern").click(function(){
			var text = $(this).text();
			var url = $(this).attr("href");
			$.get("<?php echo $this->createUrl('stats/outbound'); ?>", 
				{ "url":encodeURIComponent(url), "text": text, "location": encodeURIComponent(document.location.href) });
		});
	});
</script>
