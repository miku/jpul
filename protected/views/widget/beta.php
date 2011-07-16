<!DOCTYPE html> 
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Jobportal Widget</title>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.6.1.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tracker.min.js"></script>
	<script>$(document).ready(function() { ccul_track('<?php echo $this->createUrl("stats/track"); ?>'); });</script>	
	<style type="text/css" media="screen">
		body {
			background: #EFEFEF;
		}
		#main {
			border: solid thin #D8D8D8;
			background: white;
			font-family: Verdana, sans-serif;
			font-size: 12px;
			padding: 20px;
			width: 750px;
			margin: auto;
		}
		.apifunction { padding: 5px 10px 5px 10px; background: #EFEFEF; margin-bottom: 15px; }
		.apifunction a {
			color: darkorange;
			padding: 5px;
			background: white;
		}
		.apifunction a:hover {
			background: darkorange;
			color: white;
			padding: 5px;
		}

		pre {
			padding: 10px;
			background: white;
		}
		label {
			font-weight: bold;
		}
		p.help {
			font-size: 10px;
			margin: 2px 0 2px 0;
			color: gray;
		}
		.line {
			margin: 16px 0 16px 0;
			border-bottom: solid 3px #EFEFEF;
		}
	</style>
</head>
<body>
<div id="main">

<h1>Jobportal Widget <span style="color: darkorange">Beta</span></h1>

<p><em>Ein Service des <a class="outbound" href="http://www.zv.uni-leipzig.de/studium/career-center.html">Career Centers</a> der Universität Leipzig.</em></p>

<p>Betten Sie aktuelle Jobangebote aus unserem <a href="http://www.uni-leipzig.de/jobportal">Jobportal</a> mit unserem Widget in Ihre Webseite ein.
	Unter <strong>Vorschau</strong> sehen Sie eine Beispielansicht des Widgets, darunter den <strong>Code</strong>, den Sie in
	Ihre Seite einbetten müssen, damit das Widget angezeigt wird. Sie können die 
	angezeigten Jobangebote anpassen, in dem Sie bestimmte Suchbegriffe angeben, z.B. 
	<a href="<?php echo $this->createUrl('widget/index', array('q' => 'informatik')); ?>">informatik</a>,
	<a href="<?php echo $this->createUrl('widget/index', array('q' => 'bwl')); ?>">bwl</a>,
	<a href="<?php echo $this->createUrl('widget/index', array('q' => 'sport')); ?>">sport</a>, etc.
	</p>

<form action="" method="get" accept-charset="utf-8">
	
	<label for="q">Suchbegriffe</label><br>
	<p class="help">Falls Sie nur Jobs für bestimmte
		Suchbegriffe erhalten wollen, geben diese bitte
		hier an. <a href="<?php echo $this->createUrl('widget/index'); ?>">Suche zurücksetzen</a>.</p>
	<input type="text" size="80" name="q" value="<?php echo $original_query; ?>" id="q">
	<br><br>
	<label for="width">Breite des Widgets</label><br>
	<p class="help">Falls Sie die Breite des Widgets eingrenzen möchten,
		geben Sie bitte hier die Breite an, z.B. <a href="<?php echo $this->createUrl('widget/index', array('q' => $original_query, 'width' => '400px')); ?>">400px</a>.
		<a href="<?php echo $this->createUrl('widget/index', array('q' => $original_query)); ?>">Standardbreite wiederherstellen</a>.</p>
	<input type="text" size="10" name="width" value="<?php echo $width; ?>" id="width">
	
	<br><br>	
	<input type="submit" value="Vorschau aktualisieren">
</form>

<div class="line"></div>

<h3>Vorschau</h3>

<div id="snippet">
<script type="text/javascript" charset="utf-8" src="http://wwwdup.uni-leipzig.de/jobportal/js/ccul-jobportal-widget-0.2.0.js"></script><script type="text/javascript" charset="utf-8">ccul_jobportal_load.widget("<?php echo $original_query; ?>");</script>
<?php if ($width != null && $width != ''): ?>
	<div style="width: <?php echo cut_text($width, 10); ?>" id="ccul_jobportal_widget"></div>
<?php else: ?>
	<div id="ccul_jobportal_widget"></div>	
<?php endif ?>
</div>

<div class="line"></div>

<h3>Code</h3>

<p>Fügen Sie einfach dieses Snippet an der Stelle Ihrer Seite ein, wo das Widget erscheinen soll.</p>

<textarea id="code" name="code" rows="8" cols="70">
</textarea>

<div class="line"></div>

<h3>Live Beispiele</h3>

<ul>
	<li><a href="http://wwwdup.uni-leipzig.de/~sportwi/studium/praktikum-und-jobportal">Sportwissenschaftliche Fakultät</a></li>
	<li><a href="http://www.stura.uni-leipzig.de/stura/fachschaften/sportwissenschaftliche-fakultaet/fsr-sportwissenschaften/serviceprojekte/job-portal/">FSR Sportwissenschaften</a></li>
	<li><a href="http://www.informatik.uni-leipzig.de/ifi/kontakt/jobs.html">Institut für Informatik</a></li>
	<li><a href="http://www.wifa.uni-leipzig.de/iufb/jobs.html">Institut für Unternehmensrechnung, Finanzierung und Besteuerung</a></li>
</ul>

<div class="line"></div>

<h3>Kompatibilität</h3>

Das Widget wurde auf folgenden Betriebssystemen und Browsern getestet.

<table border="0" cellspacing="5" cellpadding="5">
	<tr><th></th><th>Windows</th><th>Mac OS X</th><th>Linux</th></tr>
	<tr><td>FF 3.5</td><td>?</td><td></td><td>?</td></tr>
</table>



<div class="line"></div>

<h3>Kontakt</h3>

<p><strong>Career Center</strong>
Universität Leipzig,
Burgstraße 21, 1. Etage,
04109 Leipzig, +49 341 97-30030</p>

<p><a href="<?php echo $this->createUrl('feedback/index', array('context' => 'widget')); ?>">Feedback</a></p>
<!-- <p>Technische Fragen: <a href="mailto:martin.czygan@uni-leipzig.de">martin.czygan@uni-leipzig.de</a></p> -->


</div></body></html>

<script type="text/javascript" charset="utf-8">
	
	function htmlEntities(str) {
    	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	}
	
	$(document).ready(function(){
		$("#code").html(function() {
			var snippet = $("div#snippet").html();
			return htmlEntities(snippet);
		});
		
		$("a.outbound").click(function(){
			var text = $(this).text();
			var url = $(this).attr("href");
			$.get("<?php echo $this->createUrl('stats/outbound'); ?>", 
				{ "url": encodeURIComponent(url), "text": text, "location": encodeURIComponent(document.location.href) });
		});
	});
	// IE innerHTML issues ...
	// document.getElementById("code").innerHTML = document.getElementById("snippet").innerHTML;
</script>
