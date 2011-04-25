<!DOCTYPE html> 
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Jobportal API</title>
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
	</style>
</head>
<body>
<div id="main">

<h1>Jobportal API Docs</h1>

<p>Das <a href="<?php echo $this->createUrl('job/index'); ?>">Jobportal</a> stellt eine <em>read-only</em> API zur Verfügung. Das 
	einzig unterstützte Format bisher ist <a href="http://www.json.org/">JSON</a>.</p>

<div class="apifunction">
<p><strong><a href="<?php echo $this->createUrl('/api/version') ?>"><?php echo $this->createUrl('/api/version') ?></a></strong> 
	<br><br>Version</p>
	<pre><code>
{
    "version" : "0.1.0", 
    "date" : 1303681634,
}
	</code></pre>
</div>

<div class="apifunction">
<p><strong><a href="<?php echo $this->createUrl('/api/summary') ?>"><?php echo $this->createUrl('/api/summary') ?></a></strong> 
	<br><br>Überblick</p>
	<pre><code>
{
    "jobs" : 811, 
    "active_jobs" : 272,
    "requests" : 91822,
    "first_request" : 1291714497,
    "last_request" : 1303736281,
    "homepage" : "http://www.uni-leipzig.de/jobportal",
    "info" : "(C) 2010 - 2011 Jobportal des Career Centers der Universität Leipzig",
    "address" : "Career Center, Universität Leipzig, Burgstraße 21, 1. Etage, 04109 Leipzig",
    "email" : "martin.czygan@gmail.com, claudia.schoder@uni-leipzig.de",
    "phone" : "0049 341 9730030",
    "fax" : "0049 341 9730069"
}
</code></pre>	
</div>

<div class="apifunction">
<p><strong><a href="<?php echo $this->createUrl('/api/jobs') ?>"><?php echo $this->createUrl('/api/jobs') ?></a></strong> 
	<br><br>
	Liste der letzten Angebote, geordnet nach Datum der Einstellung. Maximale
	Größe der Ergebnismenge: 400 Elemente.
</p>

<h3>Parameter</h3>

<p><strong>max_id</strong> ID ... <a href="<?php echo $this->createUrl('/api/jobs', array('max_id' => '23')) ?>"><?php echo $this->createUrl('/api/jobs', array('max_id' => '23')) ?></a></p>
<p><strong>since_id</strong> ID ... <a href="<?php echo $this->createUrl('/api/jobs', array('since_id' => '23')) ?>"><?php echo $this->createUrl('/api/jobs', array('since_id' => '23')) ?></a></p>
<p><strong>max_ts</strong> TIMESTAMP ... <a href="<?php echo $this->createUrl('/api/jobs', array('max_ts' => time())) ?>"><?php echo $this->createUrl('/api/jobs', array('max_ts' => time())) ?></a></p>
<p><strong>since_ts</strong> TIMESTAMP ... <a href="<?php echo $this->createUrl('/api/jobs', array('since_ts' => time())) ?>"><?php echo $this->createUrl('/api/jobs', array('since_ts' => time())) ?></a></p>
<p><strong>q</strong> QUERYSTRING ... <a href="<?php echo $this->createUrl('/api/jobs', array('q' => 'marketing')) ?>"><?php echo $this->createUrl('/api/jobs', array('q' => 'marketing')) ?></a></p>
<p><strong>size</strong> INT &#8804; 100 ... <em>(400)</em> ... <a href="<?php echo $this->createUrl('/api/jobs', array('size' => '100')) ?>"><?php echo $this->createUrl('/api/jobs', array('size' => '100')) ?></a></p>
<p><strong>expired</strong> [0|1] ... <em>(0)</em> ... <a href="<?php echo $this->createUrl('/api/jobs', array('expired' => '1')) ?>"><?php echo $this->createUrl('/api/jobs', array('expired' => '1')) ?></a></p>

<pre><code>

[{"id":"171","title":"Online Media Associate Summer Internship
Program","company":"Google","city":"Dublin\/Breslau",
"date_added":"15.12.2010",
"attachment":"http:\/\/localhost:10000\/job\/download\/171.pdf"},
{"id":"267","title":"Praktikum bei REGIOCAST - Deutsches Radiounternehmen - in Leipzig",
"company":"REGIOCAST GmbH & Co. KG","city":"Leipzig",
"date_added":"05.01.2011",
"attachment":"http:\/\/localhost:10000\/job\/download\/267.pdf"}, ... ]

</code></pre>

</div>

<div class="apifunction">

<p><strong><a href="<?php echo $this->createUrl('/api/job', array('id' => 1000)) ?>"><?php echo $this->createUrl('/api/job', array('id' => 1000)) ?></a></strong> 
	<br><br>
	Detailinformationen zu Job (ID)
</p>
<pre><code>

{"id":"1000","title":"Motivredakteur Onsite-Marketing in
Leipzig","description":"Die Herausforderung\r\nDu tr\u00e4gst die
Verantwortung f\u00fcr die Auswahl und Platzierung von aktuellen und
originellen T-Shirt Motiven auf die daf\u00fcr vorgesehenen Fl\u00e4chen
unserer Plattform.\r\nMedien, News & Stories sind deine Leidenschaft. Du ahnst
schon das Wunder, wenn Lena noch nicht in Oslo angekommen ist? Trotz Ernst der
Lage findest du Spr\u00fcche wie \u201eDr. Copy & Paste\u201c oder
\u201eDioxin, jetzt in jedem 7. Ei\u201c so cool, dass du sie gleich
weiterverbreiten w\u00fcrdest.\r\nDie perfekte Voraussetzung, um aktuelle
Themen und Trends fr\u00fchzeitig zu erkennen und in Form ansprechender und
\u00fcberzeugender T-Shirt Motive auf unserer Plattform zu
promoten.\r\n\r\nDeine Aufgaben im Detail\r\n* Du recherchierst trendige und
aktuelle Themen f\u00fcr verschiedene L\u00e4nder mit Hilfe verschiedener
Medien und interner Reports.\r\n* Du w\u00e4hlst originelle u. ansprechende
Motive aus unserem Bestand aus und organisierst bei Bedarf die Erstellung
fehlender Motive, immer unter den Gesichtspunkten des Copy\r\nRights im
Hinterkopf.\r\n* Du koordinierst und platzierst die Motive
regelm\u00e4\u00dfig auf den daf\u00fcr vorgesehenen Fl\u00e4chen unserer
Plattform und unterst\u00fctzt das Marketing Team mit deinen
Selektionen\r\nbei weiteren Aktionen.\r\n* Du dokumentierst deine
Ma\u00dfnahmen, wertest Statistiken aus und leitest daraus
Optimierungspotentiale f\u00fcr zuk\u00fcnftige\r\nThemensetzungen und
Auswahlkriterien ab.\r\n\r\nUnsere Anforderungen\r\n* Du hast Dein Studium,
vorzugsweise mit dem\r\nSchwerpunkt Marketing, gerade abgeschlossen.\r\n* Du
bist internetaffin, modebewusst und hast ein gutes Gesp\u00fcr f\u00fcr Trends
in allen Bereichen.\r\n* Du kennst Dich sehr gut in der Medien-, Marken- und
Promiwelt aus. \r\n* Du kannst gut argumentieren und Dinge auf den Punkt
bringen.\r\n* Du bist ein Organisationstalent, kannst analytisch denken und
hast eine sehr gute Auffassungsgabe.\r\n* Du verf\u00fcgst \u00fcber sehr gute
Englisch- und bestenfalls Franz\u00f6sischkenntnisse.\r\n\r\nVon Vorteil\r\n*
Grafische Grundkenntnisse und sicher im Umgang mit g\u00e4ngiger
Grafiksoftware.\r\n* Vorerfahrungen in der Medien- und
Kommunikationsbranche.","how_to_apply":"Wir freuen uns \u00fcber Deine
aussagekr\u00e4ftige Bewerbung unter Angabe der Referenznummer X01-S50, Deines
fr\u00fchestm\u00f6glichen Eintrittstermins und Deinen Gehaltsvorstellungen
bevorzugt per E-Mail an jobs@spreadshirt.net. F\u00fcr\r\nR\u00fcckfragen
steht Dir Theresa Kretzschmar gern zur Verf\u00fcgung.\r\nsprd.net AG,
Gie\u00dferstra\u00dfe 27, 04229 Leipzig","company":"sprd.net
AG","company_homepage":"","zipcode":"","city":"Leipzig","state":"",
"country":"","job_version":"1","expiration_date":"01.06.2011",
"expiration_date_ts":"1306879200","date_added":"20.04.2011",
"date_added_ts":"1303312665","view_count":"24",
"attachment":"http:\/\/wwwdup.uni-leipzig.de\/jobportal\/job\/download\/1000.pdf"}

</code></pre>
	
	
</div>

</div></body></html>

		
		
		
		
		
