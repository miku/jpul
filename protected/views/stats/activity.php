<html>
<head>
<style>
	body {
		margin: 10px;
		padding: 0;
		color: #333;
		font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
		background: #fff;
		min-width:985px;
		max-width:985px;
		font-size:11pt;	
	}

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
		font-weight: bold;
		color: green;
	}
	.referer {
		margin: 3px 0 3px 0;
		padding: 3px 0 3px 0;
		border-top: solid thin #BCBCBC;
		border-bottom: solid thin #BCBCBC;
	}
	.addr { color: black;}
	.recent { background: white; border: dashed thin #ABABAB; }
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
	$_30m = 1800;
	$threshold = $current_time - $_30m;
 ?>
<body onload="countdown_init();">

<div id="main-container">
	<div id="main">
		<div id="main-header">
				<p>Stats - Activity</p>
				<p class="small">Diese Seite wird in <span id="countdown_text">30</span> Sekunden neu geladen. <a id="switch" href="#" onclick="pause();">Pause</a></p>
		</div>
		<div id="main-content">

			<div class="col-by-total">
			<?php foreach ($stats as $key => $value): ?>
				<div class="activity-item <?php if ($value['request_time'] > $threshold) { echo 'recent'; } ?>">
					<span class="uri"><?php echo $value['request_uri']; ?></span>
					<div class="referer small dimmed">
						<?php if ($value['http_referer'] != ''): ?>
							From: <span class="small dimmed"><?php echo $value['http_referer']; ?> </span>
						<?php else: ?>
							&empty; HTTP_REFERER
						<?php endif ?>
					</div>
					<div class="small dimmed">
						
						<span class="addr"><?php echo $value['remote_addr']; ?> </span>
						| <span class="hilite"><?php echo time_since($value['request_time']); ?></span> 
						
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

