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
		
		pre {
			padding: 10px;
			background: white;
		}
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
    "jobs" : 809, 
    "requests" : 91022,
    "first_request" : 1291714497,
    "last_request" : 1303735984,
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


</div>

<div class="apifunction">

<p><strong><a href="<?php echo $this->createUrl('/api/job', array('id' => 1000)) ?>"><?php echo $this->createUrl('/api/job', array('id' => 1000)) ?></a></strong> 
	<br><br>
	Detailinformationen zu Job (ID)
</p>
	
	
</div>

</div></body></html>

		
		
		
		
		
