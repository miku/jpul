<h1 class="spacetop">Kontakt</h1>
	<p>
	<?php if ($model->publisher_name): ?>
		<?php echo $model->publisher_name; ?>
	<?php else: ?>
		N.N.
	<?php endif ?>
	<br>
	<?php if ($model->publisher_phone): ?>
		<?php echo $model->publisher_phone; ?>
	<?php else: ?>
		N.N.
	<?php endif ?>
	<br>
	<?php if ($model->publisher_email): ?>
		<a href="mailto:<?php echo $model->publisher_email; ?>"><?php echo $model->publisher_email; ?></a>
	<?php else: ?>
		N.N.
	<?php endif ?>
	
	
	</p>