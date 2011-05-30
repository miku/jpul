<p>(C) 2010 &mdash; <?php echo date("Y"); ?> <a href="http://www.zv.uni-leipzig.de/studium/career-center.html">Career Center</a> der Universität Leipzig</p>

<br>
<p><strong>Listen</strong> &middot;

	<a href="<?php echo $this->createUrl('list/companies'); ?>">Liste der Unternehmen</a> &middot;
	<a href="<?php echo $this->createUrl('list/cities'); ?>">Liste der Regionen</a>
</p>
<br>
<p><strong>Beispielsuchen</strong></p>
	
	<div class="column-200">
	
	<ul class="example-searches">
		<li><a href="<?php echo $this->createUrl('job/index', array("src" => "eq", "q" => "english OR englisch")); ?>">Englischkenntnisse</a></li>
		<li><a href="<?php echo $this->createUrl('job/index', 
		array("src" => "eq", "q" => 
			"french OR französisch OR spanish OR spanisch OR chinese OR chinesisch OR russian OR russisch OR turkish OR türkisch OR polish OR polnisch OR czech OR tschechisch OR serbian OR serbisch OR italian OR italienisch OR hungarian OR ungarisch OR swedish OR schwedisch OR norwegian OR norwegisch OR finnish OR finnisch OR estonian OR estnisch OR bulgarian OR bulgarisch OR romanian OR rumänisch OR ukrainian OR ukrainisch")); ?>">Sprachen außer Englisch</a></li>
		
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "übersetz*+OR+translate+OR+translation"))); ?>">Übersetzung</a></li>
		</li>
	</ul>
	</div>

	<div class="column-200">
	
	<ul class="example-searches">
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "mathematik"))); ?>">Mathematik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "physik"))); ?>">Physik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "biolog*"))); ?>">Biologie</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "chemie"))); ?>">Chemie</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "geolog*+OR+geograph*+OR+mineralog*+OR+kristallo*+OR+meteo*"))); ?>">Geowissenschaften</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "informatik+OR+software+OR+hardware"))); ?>">Informatik</a></li>
	</ul>

	</div>


	<div class="column-200">
	
	<ul class="example-searches">
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "kultur+OR+theater+OR+verlag+OR+geisteswiss*+OR+kulturwiss*+OR+NGO+OR+redaktion"))); ?>">Kultur</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "journalis*+OR+redaktion+OR+presse"))); ?>">Journalistik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "politik"))); ?>">Politik</a></li>
		<li><a href="<?php echo $this->createUrl('job/index', array("src" => "eq", "q" => "marketing")); ?>">Marketing</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "öffentlichkeitsarbeit+OR+'public+relation'"))); ?>">PR Jobs</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "BWL+OR+VWL"))); ?>">BWL/VWL</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "SAP"))); ?>">SAP</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "consult*"))); ?>">Consulting</a></li>

	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "jura+OR+jurist*+OR+rechtswissenschaft"))); ?>">Jura</a></li>

	</ul>

	</div>

	<div class="clear"></div>
	

	<div class="column-200">
	
	<ul class="example-searches">
		
	<li><a href="<?php echo $this->createUrl('job/index', array("src" => "eq", "q" => "sport")); ?>">Jobs im Sport</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "medizin"))); ?>">Medizin</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "psycholo*"))); ?>">Psychologie</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "arzt+OR+ärztin+OR+assistenzarzt+OR+assistenzärztin+OR+AIP"))); ?>">Ärztin, Arzt</a></li>

	

	</ul>

	</div>
	
	
	
	<div class="column-200">
	
	<ul class="example-searches">

		<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "Microsoft+OR+Excel+OR+Access+OR+Word+OR+Powerpoint+OR+MSOffice"))); ?>">Microsoft Office</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "SPSS+OR+'stata'+OR+statistik*"))); ?>">SPSS, stata, Statistik</a></li>
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "MySQL+PHP"))); ?>">PHP/MySQL</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "java -javascript"))); ?>">Java</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "HTML+OR+CSS"))); ?>">HTML/CSS</a></li>
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "Android+OR+iOS+OR+iPhone+OR+ObjectiveC+OR+ObjC+OR+iPad+OR+mobile+OR+apps"))); ?>">Apps/Mobile</a></li>

	</ul>

	</div>

	<div class="column-200">
	
	<ul class="example-searches">

	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "praktik*+OR+werkstudent+OR+volontariat+OR+shk"))); ?>">Praktika</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "werkstudent"))); ?>">Werkstudent</a>,
		<a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "nebenjob* OR honorar* OR freelanc* "))); ?>">Nebenjob</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "SHK"))); ?>">Studentische Hilfskraft</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "bachelorarbeit+OR+masterarbeit+OR+diplomarbeit+OR+abschlussarbeit"))); ?>">Abschlussarbeit</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "trainee"))); ?>">Trainee</a></li>

	</ul>

	</div>

	<div class="clear"></div>

	

<!-- <p><strong>Suchoperatoren</strong> &middot;
	Ausschluß: -suchbegriff &middot; AND, OR, NOT &middot; Position: "nach Vereinbarung",  Fuzzy: suchbegriff~
</p> -->

<br>

<p>Sie können Favoriten markieren, in dem Sie auf den Stern links neben dem Titel klicken. 
	
	<?php if (isset(Yii::app()->session[Yii::app()->params['favStore']])): ?>
		<?php if (count(Yii::app()->session[Yii::app()->params['favStore']]) > 0): ?>
			Meine Favoriten
			<a href="<?php echo $this->createUrl('job/index', array('s' => 'favs')); ?>">anzeigen</a>.
		<?php endif ?>
	<?php endif ?>
	
</p>

<br>
<p><strong>Micro&mdash;Jobportal</strong> &middot;
	<a href="<?php echo $this->createUrl('widget/index'); ?>">Jobportal Widget</a>
</p>
