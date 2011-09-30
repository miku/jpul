<html>
<head>
	<meta charset="utf-8">
<style>
	body {
		margin-top: 30px;
		padding: 0;
		color: #333;
		font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
		background: #fff;
		min-width:700px;
		max-width:700px;
		font-size:11pt;	
		margin: auto;
	}
	#main-container {
		margin-top: 15px;
	}
	
	a { text-decoration: none; color: gray; font-weight: bold;}

	.col-by-total {
		font-size: 12px;
	}
	.col-by-total li {
		list-style: none;
	}
	.small {
		font-size: 10px;
	}
	.dimmed {
		color: gray;
	}
	.activity-item {
		background: #EFEFEF;
		padding: 5px;
		margin: 8px 0 8px 0;
	}
	.hilite {
/*		font-weight: bold;*/
		color: green;
	}
	.referer {
		margin: 3px 0 3px 0;
		padding: 3px 0 3px 0;
		border-top: solid thin #DEDEDE;
		border-bottom: solid thin #DEDEDE;
	}
	.addr { color: black;}
	.recent { background: white; border: solid thin #CDCDCD; }
	.fresh { background: #FFF380; }
	.alignleft {
	float: left;
	}

	.alignright {
	float: right;
	}
	.clear { clear: both;}

</style>

<script language="javascript">

	var countdown;
	var countdown_number;

	function countdown_init() {
	    countdown_number = 31;
	    countdown_trigger();
	}

	function countdown_trigger() {
	    if(countdown_number > 0) {
	        countdown_number--;
	        document.getElementById('countdown_text').innerHTML = countdown_number;
	        if(countdown_number > 0) {
	            countdown = setTimeout('countdown_trigger()', 1000);
	        } else {
				reload_page();
			}
	    }
	}
	
	function reload_page() {
		window.location.href = '<?php echo $this->createUrl("stats/activity"); ?>';
	}
	
	function pause() {
		countdown_clear();
		document.getElementById('switch').innerHTML = "Restart";
		document.getElementById('switch').onclick = reload_page;
		return false;
	}

	function countdown_clear() {
	    clearTimeout(countdown);
	}

</script>
</head>

<?php 
	$current_time = time();
	$_30s = 30;
	$_30m = 1800;
	$threshold = $current_time - $_30m;
	$threshold_recent = $current_time - $_30s;
	
 ?>
<body onload="countdown_init();">

<div id="main-container">
	<div id="main">
		<div id="main-header">
				<p><a href="<?php echo $this->createUrl('stats/index'); ?>">Stats</a> - Activity</p>
				<p class="small countdown">Diese Seite wird in <span id="countdown_text">30</span> Sekunden neu geladen. <a id="switch" href="#" onclick="pause();">Pause</a></p>
		</div>
		<div id="main-content">

			<div class="col-by-total">
			<?php foreach ($stats as $key => $value): ?>
				<div class="activity-item 
					<?php 
						if ($value['request_time'] > $threshold_recent) { echo 'fresh'; } 
						elseif ($value['request_time'] > $threshold) { echo 'recent'; }
					 ?>
				">
					
					<div class="top-row">
					<div class="uri alignleft">
						<?php echo preg_replace('/^(http:\/\/[^\/]*)(.*)/', '$1<strong>$2</strong>', $value['request_uri']); ?>
					</div>
					<div class="alignright"><span class="hilite small"><?php echo time_since($value['request_time']); ?></span> </div>
					<div class="clear"></div>
					</div>
					
					<div class="referer small dimmed">
						<?php if ($value['http_referer'] != ''): ?>
							From: <span class="small dimmed"><?php echo preg_replace('/([^\/]*\/\/)([^\/]*)(.*)/', '$1<strong>$2</strong>$3', $value['http_referer']); ?> </span>
						<?php else: ?>
							&empty; HTTP_REFERER
						<?php endif ?>
					</div>
					<div class="small dimmed">
						
						<span class="addr"><a href="http://freegeoip.net/json/<?php echo $value['remote_addr']; ?>"><?php echo $value['remote_addr']; ?></a> </span>
						
						| <?php echo $value['bt_os']; ?> 
						& <?php echo $value['bt_browser']; ?> <?php echo $value['bt_version']; ?>
						| <?php echo $value['id']; ?> 
					</div> 	
				</div>
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>
	
</body>
</html>

