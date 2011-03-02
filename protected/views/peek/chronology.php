<style>
	.col-by-total {
		font-size: 12px;
	}
	.col-by-total li {
		list-style: none;
		padding: 4px;
	}
	.small {
		font-size: 10px;
	}
</style>

<div id="main-container">
	<div id="main">
		<div id="main-header">
				<span class="alignleft"><p>Stats &mdash; Chronology</p></span>
				<span class="alignright"><a href="<?php echo $this->createUrl('stats/index') ?>">Zurück zur Übersicht</a></span>
				<div class="clear"></div>
		</div>
		<div id="main-content">
			
			<p class="small">Folgende Liste faßt einige Schlüssel-Metriken für
				bestimmte Zeiträume zusammen. <strong>Unique</strong> heißt Unique Visitor,
				d.h. ein identifizierbarer Besucher in einem Zeitfenster von 24h.
				Unter einem <strong>Pageview</strong> wird jeder Seitenaufruf (Index, Jobdetail-Seite, etc.) 
				von einem Browser aus verstanden. <strong>Jobs</strong> gibt die Anzahl der Stellenangebote an,
				die in dem betreffenden Zeitraum neu eingestellt wurden. </p>
			<br>
			<p class="small">Es gibt zwei Zeitäume: <strong>Monate</strong> und <strong>Jahre</strong>. Z.B. ist "2011/3 Unique" 
				die Anzahl der Besucher für März 2011; "2011 Jobs" ist die Anzahl der 
				Stellenangebote, die im Jahr 2011 eingestellt wurden, usw.</p>
			<br>
			<p class="small">Diese Liste wird im Augenblick bei jedem Aufruf neu berechnet und ist chronologisch geordnet,
				mit den aktuellen Zahlen am Anfang.</p>
			
			<br>
			
			<div class="col-by-total">
			<?php $index = 0 ?>
			<?php foreach ($stats as $key => $value): ?>
					
					<?php $index += 1; ?>
										
					<li style="<?php if ($index % 2 == 0): ?>background:aliceblue<?php endif ?> <?php if (strpos($key, '/') === false): ?>;font-size: 18px; color: gray<?php endif ?>">
						<strong>
							<span class="alignleft"><?php echo $key; ?></span>
						</strong>&nbsp;
						<span class="alignright"><?php echo $value; ?></span></li>
				
					<?php if ($index % 3 == 0): ?>
						<div style="border-bottom: solid thin black; margin: 5px"></div>
					<?php endif ?>
					<div class="clear"></div>

				
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

