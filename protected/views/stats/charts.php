<style>
	.col-by-total {
		font-size: 12px;
	}
	.col-by-total li {
		list-style: none;
		padding: 0px;
	}
	.small {
		font-size: 10px;
	}
</style>

<div id="main-container">
	<div id="main">
		<div id="main-header">
				<span class="alignleft"><p>Stats &mdash; Charts</p></span>
				<span class="alignright"><a href="<?php echo $this->createUrl('stats/index') ?>">Zurück zur Übersicht</a></span>
				<div class="clear"></div>
		</div>
		<div id="main-content">
			
			<p class="small">Folgende Liste zeigt, wie beliebt Jobangebote waren, 
				gemessen an der Anzahl der Ansichten.</p>

			<br>
			<br>
			<p>Top 10 der letzen Woche</p>
			<p class="small">Die meist-angesehenen Angebote, die innerhalb der letzten sieben Tage eingestellt wurden.</p>
			<br>

			<div class="col-by-total">
			<?php $index = 0 ?>
			<?php foreach ($models_last_week as $model): ?>
					
					<?php $index += 1; ?>
										
					<li style="<?php if ($index % 2 == 0): ?>background:aliceblue<?php endif ?>">
						
							<span class="alignleft" >
							<a href="<?php echo $this->createUrl('job/view', array('id' => $model->job_id)); ?>"><?php echo $model->job_title; ?></a>
							</span>
						&nbsp;
						<span class="alignright"><?php echo $model->view_count; ?></span></li>
				
					<div class="clear"></div>
				
			<?php endforeach ?>
			</div>

			
			<br>
			<br>
			<p>Top 15 der letzen 30 Tage</p>
			<p class="small">Die meist-angesehenen Angebote, die innerhalb der letzten 30 Tage eingestellt wurden.</p>
			<br>

			<div class="col-by-total">
			<?php $index = 0 ?>
			<?php foreach ($models_last_month as $model): ?>
					
					<?php $index += 1; ?>
										
					<li style="<?php if ($index % 2 == 0): ?>background:aliceblue<?php endif ?>">
						
							<span class="alignleft" >
								
							<a href="<?php echo $this->createUrl('job/view', array('id' => $model->job_id)); ?>"><?php echo $model->job_title; ?></a>
							</span>
						&nbsp;
						<span class="alignright"><?php echo $model->view_count; ?></span></li>
				
					<div class="clear"></div>
				
			<?php endforeach ?>
			</div>

			<br>
			<br>
			<p>All-Time Top 100</p>
			<br>
			
			<div class="col-by-total">
			<?php $index = 0 ?>
			<?php foreach ($models as $model): ?>
					
					<?php $index += 1; ?>
										
					<li style="<?php if ($index % 2 == 0): ?>background:aliceblue<?php endif ?>">
						
							<span class="alignleft">
							<a href="<?php echo $this->createUrl('job/view', array('id' => $model->job_id)); ?>"><?php echo $model->job_title; ?></a>
							</span>
						&nbsp;
						<span class="alignright"><?php echo $model->view_count; ?></span></li>
				
					<div class="clear"></div>

				
			<?php endforeach ?>
			</div>

		</div>
	</div>
</div>

