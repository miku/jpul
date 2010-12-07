<h1>Filter</h1>
<div class="filterbox">

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'd')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'd')): ?>filter-option-active<?php endif ?>">
			Entwürfe anzeigen
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'p')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'p')): ?>filter-option-active<?php endif ?>">
			Aktive anzeigen
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'r')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'r')): ?>filter-option-active<?php endif ?>">
			Archivierte anzeigen
		</div>
	</a>

	<a class="no-underline" href="<?php echo $this->createUrl('admin/filter', array('filter' => 'e')); ?>">
		<div class="filter-option <?php if (contains(Yii::app()->session['adminindexfilter'], 'e')): ?>filter-option-active<?php endif ?>">
			Abgelaufene anzeigen
		</div>
	</a>
</div>