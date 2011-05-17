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
	<li><a href="<?php echo $this->createUrl('job/index', array("src" => "eq", "q" => "marketing")); ?>">Marketing</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "öffentlichkeitsarbeit+OR+'public+relation'"))); ?>">PR Jobs</a></li>
	<li><a href="<?php echo $this->createUrl('job/index', array("src" => "eq", "q" => "sport")); ?>">Jobs im Sport</a></li>
	</ul>
	</div>

	<div class="column-200">
	
	<ul class="example-searches">
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "mathematik"))); ?>">Mathematik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "physik"))); ?>">Physik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "biolog*"))); ?>">Biologie</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "geolog*+OR+geograph*+OR+mineralog*+OR+kristallo*+OR+meteo*"))); ?>">Geowissenschaften</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "chemie"))); ?>">Chemie</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "informatik+software+hardware"))); ?>">Informatik</a></li>
	</ul>

	</div>


	<div class="column-200">
	
	<ul class="example-searches">
	
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "kultur"))); ?>">Kultur</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "musik"))); ?>">Musik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "politik"))); ?>">Politik</a></li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "jura+OR+jurist*+OR+rechtswissenschaft"))); ?>">Jura</a></li>
	<li>&mdash;</li>
	<li><a href="<?php echo urldecode($this->createUrl('job/index', array("src" => "eq", "q" => "SHK"))); ?>">Studentische Hilfskraft</a></li>
	</ul>

	</div>



	<div class="clear"></div>
	

</li>
	</ul>
	

<br>
<!-- <p><strong>Suchoperatoren</strong> &middot;
	Ausschluß: -suchbegriff &middot; AND, OR, NOT &middot; Position: "nach Vereinbarung",  Fuzzy: suchbegriff~
</p> -->
<br>
<p><strong>Nano&mdash;Jobportal</strong> &middot;
	<a href="<?php echo $this->createUrl('widget/index'); ?>">Jobportal Widget</a>
</p>
	