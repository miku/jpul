<!doctype html> 
 <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
 
  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
 
  <title>Wireframe v2</title>
  <meta name="description" content="Wireframe for v2">
  <meta name="author" content="Martin Czygan <martin.czygan@gmail.com">
 
  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <!-- <link rel="apple-touch-icon" href="/apple-touch-icon.png"> -->
  
  <!-- CSS : implied media="all" -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/v2/style.css" />	
 
  <!-- Uncomment if you are specifically targeting less enabled mobile browsers                                                                       
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  --> 
</head>
<body>
	<div class="container" id="page">
		<div id="title">
			<div id="title-nav">
				<div id="title-nav-left">
					<ul>
						<li><a href="http://uni-leipzig.de/jobportal">Jobportal Homepage</a></li>
						<li><a href="http://uni-leipzig.de/jobportal">Career Center</a></li>
						<li><a href="http://www.zv.uni-leipzig.de/service/presse.html">Für Unternehmen</a></li>
					</ul>
				</div>
				<div id="title-nav-right">
					<ul>
						<li><a href="http://www.zv.uni-leipzig.de/">Intranet</a></li>
					</ul>
				</div>
			</div>
			<div id="title-logo">
				<a href="http://www.uni-leipzig.de" title="Universität Leipzig"><img src="/images/v2/logo.jpg" alt="Universität Leipzig" /></a>
			</div>			 
      		<div id="title-border">&nbsp;</div> 
		</div>
		<div class="clear"></div>
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div>
</body>
</html>
