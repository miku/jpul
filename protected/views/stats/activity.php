<style>
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
		margin: 5px 0 5px 0;
	}
	.hilite {
		color: green;
	}
</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		function refresh() {
			window.location.href = '<?php $this->createUrl("stats/activity"); ?>';
		}
		setTimeout(refresh, 30000); 
	});
</script>


<div id="main-container">
	<div id="main">
		<div id="main-header">
				<p>Stats - Activity</p>
				<p class="small">Diese Seite wird automatisch aller 30 Sekunden neu geladen.</p>
		</div>
		<div id="main-content">

			<div class="col-by-total">
			<?php foreach ($stats as $key => $value): ?>
				<div class="activity-item">
					<?php echo $value['request_uri']; ?> &larr; <span class="small dimmed"><?php echo $value['http_referer']; ?> </span>
					<div class="small dimmed"><?php echo $value['id']; ?> 
						| <?php echo $value['remote_addr']; ?> 
						| <span class="hilite"><?php echo time_since($value['request_time']); ?></span> 
						| <?php echo $value['bt_os']; ?> 
						& <?php echo $value['bt_browser']; ?> <?php echo $value['bt_version']; ?>
					</div> 	
				</div>
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

