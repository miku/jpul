<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />	

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.4.3.min.js"charset="utf-8"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<div class="container" id="page">
		<div id="stripe">
			<ul id="menu">
				<li><a href="http://www.zv.uni-leipzig.de/">Startseite</a></li>
				<li><a href="http://www.zv.uni-leipzig.de/service/kontakte.html">Service</a></li>
				<li><a href="http://www.zv.uni-leipzig.de/service/presse.html">Presse</a></li>
				<li><a href="http://www.zv.uni-leipzig.de/sitemap.html">Sitemap</a></li>
				<li><a href="http://www.zv.uni-leipzig.de/service/impressum.html">Impressum</a></li>
				<li><a href="http://www.zv.uni-leipzig.de/">Intranet</a></li>
			</ul>
		</div>
		<div id="header">
			<a href="http://www.zv.uni-leipzig.de/jubilaeumsseiten.html">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/uni/scraped_header_bg.png" alt="" />			
			</a>
		</div>
		<div id="header_bottom"></div>
		
		<div id="wrapper">
			<div id="left">
				<ul id="column-nav">
					<li><a href="http://www.zv.uni-leipzig.de/studium.html" class="active">Studium</a>
						<ul><li><a href="http://www.zv.uni-leipzig.de/studium/angebot.html">Angebot und Beratung</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/bewerbung.html">Bewerbung und Immatrikulation</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/studium-international.html">Studium International</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/studienorganisation.html">Studienorganisation</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/e-learning.html">E-Learning</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/promotion.html">Promotion</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/lebenslanges-lernen.html">Lebenslanges Lernen</a></li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/career-center/aktuelles.html"  class="active">Career Center</a>
								<ul><li><a href="http://www.zv.uni-leipzig.de/studium/career-center/aktuelles.html">Aktuelles</a></li>									
									<li><a href="http://www.zv.uni-leipzig.de/studium/career-center/angebote-fuer-studierende.html">Angebote für Studierende</a></li>
									<li><a href="http://www.zv.uni-leipzig.de/studium/career-center/service-fuer-firmen.html">Angebote für Unternehmen</a></li>
									<li><a href="http://www.zv.uni-leipzig.de/studium/career-center/tutorinnen-qualifizierung.html">Tutor(inn)en-Qualifizierung</a></li>
									<li><a href="http://www.zv.uni-leipzig.de/studium/career-center/ansprechpartnerinnen.html">Team</a></li>
									<li class="active">Jobportal</li>									
								</ul>
							</li>
							<li><a href="http://www.zv.uni-leipzig.de/studium/alumni.html">Alumni</a></li>
						</ul>
					</li>
					<li><a href="http://www.zv.uni-leipzig.de/forschung.html">Forschung</a></li>
					<li><a href="http://www.zv.uni-leipzig.de/uni-stadt/universitaet.html">Uni &amp; Stadt Leipzig</a></li>
					<li><a href="http://www.zv.uni-leipzig.de/service/kontakte.html">Service</a></li>
				</ul>
			</div>
			
			<div id="main">
				<div id="breadcrumbs">
					Sie sind hier: 
					<a href="http://www.zv.uni-leipzig.de/studium.html">Studium</a> &raquo; 
					<a href="http://www.zv.uni-leipzig.de/studium/career-center.html">Career Center</a> &raquo; 
					Jobportal
				</div>
				<a href="<?php echo $this->createUrl('job/index'); ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/uni/jobportal_banner.png" alt="" />
				</a>
				<?php echo $content; ?>
				
			</div>
			
			
			<div id="right">
				<h3>Kontakt</h3>
				<p><strong>Career Center</strong><br>
					Universität Leipzig<br>
					Burgstraße 21, 1. Etage<br>
					04109 Leipzig<br>
				</p>
				<p>
					Telefon: +49 341 97-30030<br>
					Telefax: +49 341 97-30069<br>
					<a href="mailto:careercenter@uni-leipzig.de">E-Mail</a>
				</p>
				<p>
					<strong>Servicezeiten:</strong><br>
					Mo. 13:00 &mdash; 17:00 Uhr<br>
					Di. bis Do. 9:00 &mdash; 17:00 Uhr<br>
					Fr. 9:00 &mdash; 15:00 Uhr<br>
				</p>
				<p>
					<a href="http://www.zv.uni-leipzig.de/studium/career-center/angebote-fuer-studierende/beratung.html">Informationen zu Beratungszeiten</a>
				</p>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/uni/cc_logo.gif" alt="" />
				
				<h3>Links</h3>
				<p>
					<a href="<?php echo $this->createUrl('job/index'); ?>">Job Listing</a><br>
					<?php if (Yii::app()->user->getId() != NULL): ?>
						<?php if (Yii::app()->user->isAdmin()): ?>
							<a href="<?php echo $this->createUrl('job/create'); ?>">Neues Angebot einstellen</a><br>
						<?php endif; ?>
						Logged in as <a href="#"><?php echo Yii::app()->user->getUsername(); ?></a> | 
						<a href="<?php echo $this->createUrl('site/logout'); ?>">Logout</a><br>					
					<?php else: ?>
					<a href="<?php echo $this->createUrl('site/login'); ?>">Login</a><br>
					<?php endif; ?>

				</p>

			</div>			
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>
