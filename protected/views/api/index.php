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
		.apifunction { padding: 5px 10px 5px 10px; background: #f8f8f8; margin-bottom: 5px; }
	</style>
</head>
<body>
<div id="main">

<h1>Jobportal API Docs</h1>

<p>Das <a href="<?php echo $this->createUrl('job/index'); ?>">Jobportal</a> stellt eine <em>read-only</em> API zur Verfügung &mdash; mit
	folgender Spezifikation:</p>

<div class="apifunction">
<p><strong><a href="<?php echo $this->createUrl('/api/version') ?>"><?php echo $this->createUrl('/api/version') ?></a></strong> 
	<br><br>Version</p>
</div>

<div class="apifunction">
<p><strong><a href="<?php echo $this->createUrl('/api/summary') ?>"><?php echo $this->createUrl('/api/summary') ?></a></strong> 
	<br><br>Überblick</p>
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
<p><strong>size</strong> INT &#8804; 100 ... <em>(100)</em> ... <a href="<?php echo $this->createUrl('/api/jobs', array('size' => '100')) ?>"><?php echo $this->createUrl('/api/jobs', array('size' => '100')) ?></a></p>

</div>

<div class="apifunction">

<p><strong><a href="<?php echo $this->createUrl('/api/job', array('id' => 736)) ?>"><?php echo $this->createUrl('/api/job', array('id' => 736)) ?></a></strong> 
	<br><br>
	Detailinformationen zu Job (ID)
</p>
	
	
</div>

</div></body></html>

		
		
		
		
		
