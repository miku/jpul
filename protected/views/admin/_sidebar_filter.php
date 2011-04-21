<h1>Filter</h1>
<div class="filterbox">

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'd')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'd')): ?>filter-option-active<?php endif ?>">
			<input type="checkbox"
				<?php if (contains(Yii::app()->session['adminindexfilter'], 'd')): ?> checked <?php endif ?> >
			</input> Entwürfe anzeigen
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'p')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'p')): ?>filter-option-active<?php endif ?>">

			<input type="checkbox" 
				<?php if (contains(Yii::app()->session['adminindexfilter'], 'p')): ?> checked <?php endif ?> >
			</input> Aktive anzeigen

			
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'r')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'r')): ?>filter-option-active<?php endif ?>">

			<input type="checkbox" 
				<?php if (contains(Yii::app()->session['adminindexfilter'], 'r')): ?> checked <?php endif ?> >
			</input> Archivierte anzeigen

			
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'e')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'e')): ?>filter-option-active<?php endif ?>">

			<input type="checkbox" 
				<?php if (contains(Yii::app()->session['adminindexfilter'], 'e')): ?> checked <?php endif ?> >
			</input> Abgelaufene anzeigen

			
		</div>
	</a>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('input[type=checkbox]').click(function(){
			window.location.href = $(this).parent().parent().attr("href");
			console.log("Filter changed to ...");
		});
	});
</script>