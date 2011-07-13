<p>(C) 2010 &mdash; 
	<?php echo date("Y"); ?> Jobportal des <a href="http://www.zv.uni-leipzig.de/studium/career-center.html">Career Centers</a> 
	der Universität Leipzig | 
	<a href="<?php echo $this->createUrl('feedback/index', array('context' => Yii::app()->request->url)); ?>">Feedback</a>
</p>

<br>

<p><strong>Listen</strong> &middot;
	<a href="<?php echo $this->createUrl('list/companies'); ?>">Liste der Unternehmen</a> &middot;
	<a href="<?php echo $this->createUrl('list/cities'); ?>">Liste der Regionen</a>
</p>

<br>

<p><strong>Beispielsuchen</strong></p>
	
	<div class="column-200">	
		<ul class="example-searches">
			<li><a href="<?php echo $this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "english OR englisch")); ?>">Englischkenntnisse</a></li>
			<li><a href="<?php echo $this->createUrl('job/index', 
			array("tab" => $tab, "src" => "eq", "q" => 
				"french OR französisch OR spanish OR spanisch OR chinese OR chinesisch OR russian OR russisch OR turkish OR türkisch OR polish OR polnisch OR czech OR tschechisch OR serbian OR serbisch OR italian OR italienisch OR hungarian OR ungarisch OR swedish OR schwedisch OR norwegian OR norwegisch OR finnish OR finnisch OR estonian OR estnisch OR bulgarian OR bulgarisch OR romanian OR rumänisch OR ukrainian OR ukrainisch OR arabic OR arabisch OR farsi OR persisch")); ?>">Sprachen außer Englisch</a></li>
		
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "übersetz*+OR+translate+OR+translation"))); ?>">Übersetzung</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "philologie+OR+anglistik+OR+amerikanistik+OR+germanistik+OR+kanadistik+OR+romanistik+OR+slawistik+OR+slavistik+OR+lusitanistik+OR+afrikanistik+OR+ägyptologie+OR+indologie+OR+judaistik+OR+japanologie+OR+skandinavistik+OR+hungarologie+OR+fennistik+OR+russistik+OR+polonistik+OR+keltologie+OR+sprachwissenschaft"))); ?>">Philologien</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "bildung*+OR+erziehungs*+OR+pädagog*"))); ?>">Erziehung und Bildung</a></li>
		</ul>
	</div>

	<div class="column-200">
		<ul class="example-searches">
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "mathematik"))); ?>">Mathematik</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "physik"))); ?>">Physik</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "biolog*"))); ?>">Biologie</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "chemie"))); ?>">Chemie</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "geolog*+OR+geograph*+OR+mineralog*+OR+kristallo*+OR+meteo*"))); ?>">Geowissenschaften</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "informatik+OR+software+OR+hardware"))); ?>">Informatik</a></li>
		</ul>
	</div>


	<div class="column-200">
		<ul class="example-searches">
	
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "kultur+OR+theater+OR+verlag+OR+geisteswiss*+OR+kulturwiss*+OR+NGO+OR+redaktion"))); ?>">Kultur</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "journalis*+OR+redaktion+OR+presse"))); ?>">Journalistik</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "politik"))); ?>">Politik</a></li>
			<li><a href="<?php echo $this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "marketing")); ?>">Marketing</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "öffentlichkeitsarbeit+OR+'public+relation'"))); ?>">PR Jobs</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "BWL+OR+VWL"))); ?>">BWL/VWL</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "SAP"))); ?>">SAP</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "consult*"))); ?>">Consulting</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "jura+OR+jurist*+OR+rechtswissenschaft"))); ?>">Jura</a></li>
		</ul>
	</div>

	<div class="clear"></div>
	

	<div class="column-200">
		<ul class="example-searches">		
			<li><a href="<?php echo $this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "sport")); ?>">Jobs im Sport</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "medizin"))); ?>">Medizin</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "psycholo*"))); ?>">Psychologie</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "arzt+OR+ärztin+OR+assistenzarzt+OR+assistenzärztin+OR+AIP"))); ?>">Ärztin, Arzt</a></li>
		</ul>
	</div>
	
	<div class="column-200">	
		<ul class="example-searches">
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "Microsoft+OR+Excel+OR+Access+OR+Word+OR+Powerpoint+OR+MSOffice"))); ?>">Microsoft Office</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "SPSS+OR+'stata'+OR+statistik*"))); ?>">SPSS, stata, Statistik</a></li>
	
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "MySQL+PHP"))); ?>">PHP/MySQL</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "java+-javascript"))); ?>">Java</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "HTML+OR+CSS"))); ?>">HTML/CSS</a></li>
	
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "linux+OR+AIX+OR+solaris+OR+freebsd+OR+irix+OR+GNU"))); ?>">Unix</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "Android+OR+iOS+OR+iPhone+OR+ObjectiveC+OR+ObjC+OR+iPad+OR+mobile+OR+apps"))); ?>">Apps/Mobile</a></li>
		</ul>
	</div>

	<div class="column-200">
		<ul class="example-searches">
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "praktik*+OR+werkstudent+OR+volontariat+OR+shk"))); ?>">Praktika</a>,
				<a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "werkstudent"))); ?>">Werkstudent</a>
				<!-- <a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "nebenjob* OR honorar* OR freelanc* "))); ?>">Nebenjob</a></li> -->

			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "SHK"))); ?>">Studentische Hilfskraft</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "bachelorarbeit+OR+masterarbeit+OR+diplomarbeit+OR+abschlussarbeit"))); ?>">Abschlussarbeit</a></li>
			<li><a href="<?php echo urldecode($this->createUrl('job/index', array("tab" => $tab, "src" => "eq", "q" => "trainee"))); ?>">Trainee</a></li>
		</ul>
	</div>

	<div class="clear"></div>

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
	<?php if (isset($original_query) && $original_query !== ""): ?>
		&#9733; <a href="<?php echo $this->createUrl('widget/index', array('q' => $original_query)); ?>">Widget für die aktuelle Suche
			<span style="font-style: italic; font-weight: bold"><?php echo cut_text($original_query, 30); ?></span></a>
	<?php endif ?>	
</p>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".example-searches > li > a").each(function(index, item) {
			var url = $.url(item.href);
			var current_url = $.url();
			var tab = current_url.param('tab');
			$.get("<?php echo $this->createUrl('job/searchHits'); ?>?q=" + url.param('q') + "&tab=" + tab, function(data) {
				$('<span style="margin-left: 3px; font-size:8px;">' + data + '</span>').insertAfter(item);
			});
		});
	});
</script>
