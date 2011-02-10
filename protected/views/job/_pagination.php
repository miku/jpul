<?php if ($models): ?>
	<div id="pagination">

	<span class="total">Insgesamt <?php echo $total ?> Angebote.</span>

		<?php if ($page > 1): ?>
			<?php
				$_params = array();
				if (isset($original_query)) { $_params['q'] = $original_query; }
				if (isset($sort)) { $_params['sort'] = $sort; }
				$_params['page'] = $page - 1;
			?>
			<a href="<?php echo $this->createUrl('job/index', $_params); ?>">&lt; Vorherige</a>
			
			<!-- shortcut -->
			<?php $_params['page'] = 1; ?>
			<a href="<?php echo $this->createUrl('job/index', $_params); ?>">1</a>
			
		<?php else: ?>
			<span class="inactive">&lt; Vorherige</span>
		<?php endif; ?>

		<?php
			$_params = array();
			if (isset($original_query)) { $_params['q'] = $original_query; }
			if (isset($sort)) { $_params['sort'] = $sort; }
			$_params['page'] = $page;
		?>
		<a class="current-page" href="<?php echo $this->createUrl('job/index', $_params) ?>"><?php echo $page ?></a>

		<?php if ($current_end < $total): ?>
			<?php
				$_params = array();
				if (isset($original_query)) { $_params['q'] = $original_query; }
				if (isset($sort)) { $_params['sort'] = $sort; }
				$_params['page'] = $page + 1;
			?>
			<a href="<?php echo $this->createUrl('job/index', $_params) ?>">Nächste &gt;</a>
		<?php else: ?>
			<span class="inactive">Nächste &gt;</span>
		<?php endif; ?>
	</div>
<?php endif; ?>
