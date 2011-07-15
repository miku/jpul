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
    li {
        color: gray;
    }
</style>

<div id="main-container">
    <div id="main">
        <div id="generic-header">
                <p><?php echo count($dataReader); ?> Unternehmen und Institutionen haben aktuelle Angebote auf unserem Portal veröffentlicht</p>
                <p class="small">Sortieren 
                    <a href="<?php echo $this->createUrl('list/companies', array('sort' => 'name')); ?>">nach Name</a>, 
                    <a href="<?php echo $this->createUrl('list/companies', array('sort' => 'count')); ?>">nach Anzahl der Angebote</a>
                </p>
        </div>

        <div id="main-content">
            <div class="col-by-total">
                <?php foreach ($dataReader as $key => $value): ?>
                    <li style="padding: 3px 0 3px 10px; margin: 0;"><a href="<?php echo urldecode($this->createUrl('job/index', array('q' => 'cc:' . purify($value["company"], '') ))); ?>"><?php echo $value["company"] ?></a>
                        <span style="font-size: 9px">(~ <?php echo $value["total"] ?> Angebot<?php if ($value["total"] > 1) { echo "e"; } ?>)</span>
                    </li>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<div id="sidebar-container">
    <div id="sidebar">
        <?php $this->renderPartial('/shared/_sidebar_contact'); ?>
        <?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
        <?php $this->renderPartial('/shared/_sidebar_fb'); ?>
        <?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
    </div>	
</div>
