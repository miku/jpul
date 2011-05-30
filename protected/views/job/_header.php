<style type="text/css" media="screen">

	#tabs-container {
		margin: 0 0 4px 0;
		font-size: 12px;
	}

	ul#tabs-ul {
		list-style: none;
		display: inline;
		margin: 0 0 5px 0;
		padding: 0;
	}
	ul#tabs-ul li {
		float: left;
		margin: 0 6px 0 0;
		padding: 0;
	}
	ul#tabs-ul li a {
		padding: 4px 8px 4px 8px;
		background: #EFEFEE;
		text-decoration: none;
	}
	ul#tabs-ul li a:hover {
		padding: 4px 8px 4px 8px;
/*		background: #fb8f45;*/
/*		color: white;*/
	}

	ul#tabs-ul li a.active {
		padding: 4px 8px 4px 8px;
		background: #fb8f45;
		color: white;
	}
	
	#searchbox {
		background: #F4F4F4;
		padding: 16px;
		width: 698px;
		
	}
	.search-container {
		margin: 0 0 0 0 ;
	}
	
	
	
	
	
	ul#tabs-ul-right {
		list-style: none;
		display: inline;
		margin: 0 0 5px 0;
		padding: 0;
	}
	ul#tabs-ul-right li {
		float: left;
		margin: 0 0px 0 0;
		padding: 0;
	}
	ul#tabs-ul-right li a {
		padding: 4px 8px 4px 8px;
		background: #EFEFEE;
		text-decoration: none;
	}
	ul#tabs-ul-right li a:hover {
		padding: 4px 8px 4px 8px;
		background:#fb8f45;
		color: white;
	}

	ul#tabs-ul-right li a.active {
		padding: 4px 8px 4px 8px;
		background: #fb8f45;
		color: white;
	}

	
</style>

<div class="search-container">

	<div id="tabs-container">

		<ul id="tabs-ul" class="alignleft">
			
			<?php if ('all' === $tab): ?>

				<?php if (isset($original_query)): ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'all', 'q' => $original_query)) ?>">Alle</a></li>
				<?php else: ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'all')) ?>">Alle</a></li>
				<?php endif ?>

			<?php else: ?>

				<?php if (isset($original_query)): ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'all', 'q' => $original_query)) ?>">Alle</a></li>
				<?php else: ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'all')) ?>">Alle</a></li>
				<?php endif ?>

			<?php endif ?>

			
			<?php if ('-internship' === $tab): ?>
				
				<?php if (isset($original_query)): ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => '-internship', 'q' => $original_query)) ?>">Nur Stellenangebote</a></li>
				<?php else: ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => '-internship')) ?>">Nur Stellenangebote</a></li>
				<?php endif ?>
				
			<?php else: ?>

				<?php if (isset($original_query)): ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => '-internship', 'q' => $original_query)) ?>">Nur Stellenangebote</a></li>
				<?php else: ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => '-internship')) ?>">Nur Stellenangebote</a></li>
				<?php endif ?>
				
			<?php endif ?>
			
			
			<?php if ('internship' === $tab): ?>
				
				<?php if (isset($original_query)): ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'internship', 'q' => $original_query)) ?>">Nur Praktika</a></li>
				<?php else: ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'internship')) ?>">Nur Praktika</a></li>
				<?php endif ?>
				
			<?php else: ?>

				<?php if (isset($original_query)): ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'internship', 'q' => $original_query)) ?>">Nur Praktika</a></li>
				<?php else: ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'internship')) ?>">Nur Praktika</a></li>
				<?php endif ?>

			<?php endif ?>


			<?php if ('i11n' === $tab): ?>
				
				<?php if (isset($original_query)): ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'i11n', 'q' => $original_query)) ?>">International</a></li>
				<?php else: ?>
					<li><a class="active" href="<?php echo $this->createUrl('job/index', array('tab' => 'i11n')) ?>">International</a></li>
				<?php endif ?>
				
			<?php else: ?>

				<?php if (isset($original_query)): ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'i11n', 'q' => $original_query)) ?>">International</a></li>
				<?php else: ?>
					<li><a class="inactive-tab" href="<?php echo $this->createUrl('job/index', array('tab' => 'i11n')) ?>">International</a></li>
				<?php endif ?>
				
			<?php endif ?>
			

		</ul>
		
		<ul id="tabs-ul-right"  class="alignright">
			<?php if (isset($original_query) && $original_query != ''): ?>
				<li><a href="<?php echo $this->createUrl('alert/create', array('aq' => $original_query)); ?>">E-Mail Alert</a></li>
			<?php else: ?>
				<li><a href="<?php echo $this->createUrl('alert/create'); ?>">E-Mail Alert</a></li>
			<?php endif ?>
			
		</ul>
		
		<div class="clear"></div>
		
		
	</div>



	<div id="searchbox">

		<form action="<?php echo $this->createUrl('job/index') ?>" method="get" accept-charset="utf-8">
		<input size="70" type="text" name="q" value="<?php if (isset($original_query)) echo $original_query ?>" id="search" class="search">

			<input type="hidden" name="tab" value="<?php echo $tab ?>" id="f">
		
		<input type="submit" value="Suchen" class="searchbutton">
		</form>

	</div>

</div>


<div id="info-subbar" style="padding: 0 0 12px 0; border-bottom: solid thin #ABABAB;">
	<p class="alignleft" style="font-size: 10px; margin: 10px 0 0 0; width: 600px;">
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
	<div style="font-size: 10px; margin: 10px 0 0 0;" class="alignright">
<?php if ($total == 0): ?>
&#8709;
<?php else: ?>
<strong><span style="background: gray; color: white; padding:2px;">
<?php echo $total; ?></span></strong> Ergebnis<?php if ($total > 1) { echo "se"; } ?>
<?php endif ?>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		
		$("a.inactive-tab").hover(
			function() {
				$(this).animate({"backgroundColor": "#fb8f45", "color" : "white"}, 90);
			},
			function() {
				$(this).animate({"backgroundColor": "#EFEFEE", "color" : "#3366CC"}, 90);
		});
		
	});
</script>


