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
			<h4><?php echo count($dataReader); ?> Firmen haben aktuelle Jobangebote auf unserem Portal veröffentlicht</h4>
			<br>
			<p class="small">Sortieren 
				<a href="<?php echo $this->createUrl('list/companies', array('sort' => 'name')); ?>">nach Name</a>, 
				<a href="<?php echo $this->createUrl('list/companies', array('sort' => 'count')); ?>">nach Anzahl der Angebote</a></p>
	</div>

<div id="main-content">


<div class="col-by-total">
<?php foreach ($dataReader as $key => $value): ?>
	<!-- <li><a href="<?php echo $this->createUrl('job/index', array('q' => preg_replace('/\(|\)|\./', ' ', $value["company"]))); ?>"><?php echo $value["company"] ?></a> (<?php echo $value["total"] ?>)</li> -->
	<li><a href="<?php echo $this->createUrl('job/index', array('q' => 'cc:' . slugify($value["company"], '') )); ?>"><?php echo $value["company"] ?></a> (<?php echo $value["total"] ?>)</li>
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
