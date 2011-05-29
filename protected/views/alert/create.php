<style type="text/css" media="screen">
	table.aq-table {
		font-size: 12px;
	}

	table.aq-table tr {
	}

	table.aq-table tr td {
		padding: 10px 10px 0 10px;
	}
	
	input {
		font-size: 12px;
	}
	
	.aq-action {
		margin: 10px 0 0 0;
	}	
	.aq-preview {
		padding: 20px;
		background: #EFEFEF;
	}
	.aq-list {
		list-style: none;
		font-size: 12px;
		margin: 0;
		padding: 0;
	}

	.aq-list li {
		margin: 2px 0 2px 0;
		padding: 2px 10px 2px 10px;
	}

	.aq-list li:nth-child(even) {
		background: #FAFAFA;
	}
	
	.aq-list li:nth-child(odd) {
		background: #ffffff;
	}

</style>

<div id="main-container">
<div id="main">	

	<div id="generic-header">
		<h1>E-Mail Alert einrichten</h1>
		<p>Lassen Sie sich interessante Angebot einfach in Ihr Postfach kommen.</p>
		<p>
			Sie können sich per E-Mail über neue Jobangebote, die
			Sie interessieren, informieren lassen. Kurz nachdem ein
			neues Angebot bei uns eingegangen ist, prüfen wir, ob es
			zu den von Ihnen angegebenen Suchbegriffen paßt &mdash; wenn es
			paßt senden wir Ihnen eine kurze E-Mail mit dem Link zu dem 
			Angebot auf unserem Jobportal.	
		</p>
		<p>
			Geben Sie in dem folgenden Feld ihre gewünschten Suchbegriffe
			ein. Durch das Klicken auf <strong>Test-Suche</strong> sehen Sie eine Vorschau
			von aktuellen Angeboten. Über solche und ähnliche würden
			Sie informiert werden.
		</p>
		<p>
			<form action="<?php echo $this->createUrl('alert/create'); ?>" method="get" accept-charset="utf-8">
				<label for="aq">Suchfilter</label>
				<input class="search" size="70" type="text" name="aq" value="<?php echo $aq; ?>" id="aq">
				<input class="searchbutton" type="submit" value="Test-Suche">
			</form>
		</p>
		
		<?php if (isset($aq) && isset($models)): ?>
			<div class="aq-preview">
				<p>Ihre Suche <strong><?php echo $aq ?></strong> paßt auf <?php echo $total; ?> 
					
					<?php if (1 == $total): ?>
						aktuelles Angebot
					<?php else: ?>
						 aktuelle Angebote
					<?php endif ?>
					
					<?php if ($total > 10): ?>
						(Es werden nur die 10 aktuellsten angezeigt &mdash; um alle Angebote zu sehen, <a href="<?php echo $this->createUrl('job/index', array('q' => $aq)); ?>">wiederholen
						Sie die Suche auf unserer Homepage</a>).
					<?php endif ?>
				</p>
				<br>
			<ul class="aq-list">
			<?php foreach ($models as $model): ?>
				<li><span style="color:black;"><?php echo $model->title ?></span><br>
					<span style="font-style:italic; font-size:10px; color: gray;"><?php echo $model->city ?></span> &middot; <span style="color: #666666; font-size: 10px; font-weight: bold;"><?php echo $model->company ?></span></li>
			<?php endforeach ?>
			</ul>			
			</div>
			
			<?php if ($total > 0): ?>
				
			<div class="aq-action">
				<p>Wenn Sie passende Keywords gefunden haben, tragen Sie bitte Ihre
					E-Mail-Addresse in das folgende Feld ein und klicken Sie 
					<strong>Alert einrichten</strong>. Wir senden Ihnen einen 
					Aktivierungslink auf Ihr E-Mail-Account. Nachdem Sie den 
					Alert aktiviert haben, ist Ihr persönlicher Alert aktiv.
					Sie können Ihren Alert jederzeit abmelden. Wir senden Ihnen dazu
					in jeder E-Mail zusätzlich zu Ihren Angeboten 
					einen Deaktivierungslink. Ihre E-Mail-Addresse
					wird ausschließlich für diesen Service genutzt und nicht an 
					Dritte weitergegeben.</p>

			<form action="<?php echo $this->createUrl('alert/create'); ?>" method="post" accept-charset="utf-8">
				<input type="hidden" name="query" value="<?php echo $aq ?>" id="query">
				<table class="aq-table" border="0" cellspacing="5" cellpadding="15">
					<tr><td width="20%">Filter</td><td><?php echo $aq ?></td></tr>
					<tr><td><label for="email">E-Mail-Addresse</label></td>
						<td><input class="search" size="70" type="text" name="email" value="" id="email"></td>
					</tr>
					<tr><td>Sicherheitsfrage</td><td><?php echo get_captcha_html() ?></td></tr>
					<tr><td></td><td><input class="searchbutton" type="submit" value="Alert einrichten"></td></tr>
				</table>
			</form>

			</div>
			
			<?php endif ?>
			

		<?php endif ?>
	</div>
	
	<div id="main-content">
	</div>

</div> <!-- main -->
</div> <!-- main-container -->


<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/shared/_sidebar_contact'); ?>
		<?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
		<?php $this->renderPartial('/shared/_sidebar_fb'); ?>
		<?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
	</div>	
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("#aq").focus();
	});
</script>