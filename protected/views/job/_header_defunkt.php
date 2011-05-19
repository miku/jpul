
	
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
			 <span style="border-bottom: solid red 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox', 'q' => $original_query)) ?>">einblenden</a>
		<?php else: ?>
			 <span style="border-bottom: solid red 1px">Praktika</span> <a href="<?php echo $this->createUrl('job/index', array('src' => 'topbox')) ?>">einblenden</a>
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
			echo "Im Career Center: " . strip_tags($item, "<a><strong>");
		} else { ?>
			Finden Sie passende Angebote über Suchbegriffe, z.B.
			<?php $this->renderPartial('_snippet_example_searches') ?>
	  <?php }
		error_reporting(E_ALL);
	 ?>

<?php endif ?>

</p>
<p class="alignright">
<?php if ($total == 0): ?>
	&#8709;
<?php else: ?>
	<strong><span style="background: gray; color: white; padding:2px;">
	<?php echo $total; ?></span></strong> Ergebnis<?php if ($total > 1) { echo "se"; } ?></p>
<?php endif ?>

<div class="clear"></div>
