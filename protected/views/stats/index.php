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
</style>

<div id="main-container">
<div id="main">
	<div id="main-header">
			<p>Stats / 15.12.2010 &mdash;</p>
	</div>
<div id="main-content">


<div class="col-by-total">
<?php foreach ($stats as $key => $value): ?>
	<li><?php echo $key; ?>: <?php echo $value; ?></li>
<?php endforeach ?>
</div>

</div></div></div>

<div id="sidebar-container">
	<div id="sidebar">
		<?php $this->renderPartial('/job/_sidebar_contact'); ?>
		<?php $this->renderPartial('/job/_sidebar_for_employer'); ?>
		<?php $this->renderPartial('/job/_sidebar_fb'); ?>
		<?php $this->renderPartial('/job/_sidebar_supporter'); ?>
	</div>	
</div>
