<?php if ($models): ?>

	<div id="pagination">
		
	<?php 
		
		$kvlist = explode('&', urldecode(Yii::app()->request->queryString)); 
		$params = array("page" => 1);

		foreach ($kvlist as $index => $kvitem) {
			$kv = explode('=', $kvitem);
			if (count($kv) == 2) {
				$params[$kv[0]] = $kv[1];
			}
		}

		if (isset($params["page"])) {
			if ($params["page"] < 1) {
				$params["page"] = 1;
			}
			$params["page"] = preg_replace("/[^\d]/", "", $params["page"]);
			if ($params["page"] > ($total / $this->items_per_page)) {
				$params["page"] = ceil($total / $this->items_per_page);
			}
		}

		if (isset($params["size"])) {
			unset($params["size"]);
		}

		if (isset($params["src"])) {
			unset($params["src"]);
		}
		
		$number_of_pages = ceil($total / $this->items_per_page);
		$current_page = $params["page"];

	?>
	
	<p class="alignleft"> 
			<?php
				$params_10 = $params; $params_10["size"] = 10; $params_10["page"] = 1;
				$params_20 = $params; $params_20["size"] = 20; $params_20["page"] = 1; 
				$params_50 = $params; $params_50["size"] = 50; $params_50["page"] = 1; 
			?>
			<a class="<?php if ($this->items_per_page == 10) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_10); ?>">10</a>
			<a class="<?php if ($this->items_per_page == 20) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_20); ?>">20</a>
			<a class="<?php if ($this->items_per_page == 50) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_50); ?>">50</a>
			<span class="dimmed">Angebote pro Seite</span>
	</p>
	
	<p class="alignright">

		<!-- PREVIOUS PAGE -->	
		<?php if ($params["page"] > 1): ?>
			<?php
				$params_for_previous = $params;
				$params_for_previous['page'] -= 1;
			?>
			<a href="<?php echo $this->createUrl('job/index', $params_for_previous); ?>">&lt; Vorherige</a>
			
			<!-- shortcut -->
			<!-- <?php $params_for_first = $params; $params_for_first['page'] = 1; ?>
			<a href="<?php echo $this->createUrl('job/index', $params_for_first); ?>">1</a> -->
			
		<?php else: ?>
			<span class="inactive">&lt; Vorherige</span>
		<?php endif; ?>


		<?php if ($number_of_pages == 1): ?>
			<!-- CURRENT PAGE -->
			<a class="current-page" href="<?php echo $this->createUrl('job/index', $params) ?>"><?php echo $params["page"] ?></a>
			
		<?php elseif ($number_of_pages <= 7): ?>		
			
			<?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
				<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
				<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
				<?php echo $params_for_page["page"] ?></a>
			<?php endfor ?>
		
		<?php elseif ($number_of_pages > 7): ?>

			<!-- LOWER BATCH -->
			<?php if ($current_page < 4): ?>

				<?php for ($i = 1; $i < 5; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>
				
				<span style="">&middot;&middot;&middot;</span>
				
				<?php for ($i = $number_of_pages - 2; $i <= $number_of_pages; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>

			<!-- MIDDLE BATCH -->
			<?php elseif ($current_page > 3 && $current_page < $number_of_pages - 3): ?>

				<?php for ($i = 1; $i < 2; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>

				<span style="">&middot;&middot;&middot;</span>
				
				<?php for ($i = $current_page - 2; $i < $current_page + 3; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>
				
				<span style="">&middot;&middot;&middot;</span>
				
				<?php for ($i = $number_of_pages; $i <= $number_of_pages; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>

			<!-- LAST BATCH -->
			<?php else: ?>

				<?php for ($i = 1; $i < 3; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>
				
				<span style="">&middot;&middot;&middot;</span>
				
				<?php for ($i = $number_of_pages - 4; $i <= $number_of_pages; $i++): ?>
					<?php $params_for_page = $params; $params_for_page["page"] = $i ?>
					<a class="<?php if ($i == $current_page) { echo 'current-page'; } ?>" href="<?php echo $this->createUrl('job/index', $params_for_page) ?>">
					<?php echo $params_for_page["page"] ?></a>
				<?php endfor ?>

			<?php endif ?>
			
		<?php endif ?>

		<!-- NEXT PAGE -->
		<?php $current_end = ($this->items_per_page * ($params["page"] - 1)) + $this->items_per_page; ?>
		
		<?php if ($current_end < $total): ?>
			<?php
				$params_for_next = $params;
				$params_for_next['page'] += 1;
			?>
			<a href="<?php echo $this->createUrl('job/index', $params_for_next) ?>">Nächste &gt;</a>
		<?php else: ?>
			<span class="inactive">Nächste &gt;</span>
		<?php endif; ?>
	</p>
	
	</div> <!-- pagination -->
	
	<div class="clear"></div>
<?php endif; ?>
