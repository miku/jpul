<!-- jv:3 -->
<style type="text/css" media="screen">
    .expiration-wrapper {
    	opacity : 0.4;
    	filter: alpha(opacity=40); // msie
    	background-color: #555;
    }
</style>
<div id="main-container">
    <div id="main">

        <?php if ($model->expiration_date < time()): ?>
            <p style="text-align: center; background: #EFEFEF; padding: 10px; font-size: 12px;">Der Bewerbungsschluss für dieses Angebot endete <?php echo time_since($model->expiration_date) ?>.</p>
        <?php endif ?>

        <div id="view-content" <?php if ($model->expiration_date < time()): ?>class="expiration-wrapper"<?php endif ?>>

            <div id="view-header">

<?php if($this->beginCache("job_details_header_testing_" . $model->id, array('duration'=>3600))) { ?>

                <div id="mini-nav">
                    <?php
                        $kvlist = explode('&', urldecode(Yii::app()->request->queryString));
                        $params = array("page" => 1);
                        foreach ($kvlist as $index => $kvitem) {
                            $kv = explode('=', $kvitem);
                            if (count($kv) == 2) {
                                $params[$kv[0]] = $kv[1];
                            }
                        }
                    ?>

                    <?php if (isset($params['src']) && $params['src'] == 'widget'): ?>
                        <a href="<?php echo $this->createUrl('job/index'); ?>">Zurück zur Übersicht</a>
                    <?php else: ?>
                        <a href="javascript:history.go(-1)">Zurück zur Übersicht</a>
                    <?php endif ?>

                    | <a href="<?php echo $this->createUrl('job/print', array('id' => $model->id)); ?>">Druckansicht</a>
                    <script type="text/javascript" charset="utf-8">
                        $(document).ready(function(){
                            $.get("<?php echo $this->createUrl('job/searchHits'); ?>?q=cc:<?php echo purify($model->company, '') ?>", function(data) {
                                if (data > 1) {
                                    $("#more-from-company").show();
                                    $("#more-from-company").append(" <span style='color:gray'>(" + data + ")</span>");
                                }
                            });
                        });
                    </script>

                    <span id="more-from-company" style="display:none">| Mehr Angebote von <a href="<?php echo urldecode($this->createUrl('job/index', array('q' => 'cc:' . purify($model->company, ''), 'src' => 'more-from-company' ))); ?>"><?php echo cut_text($model->company, 30); ?></a></span>
                </div>


                <div id="view-job-title"><?php echo $model->title ?></div>

                <div id="view-job-subtitle">
                    Eingestellt am <?php echo strftime('%d.%m.%Y', $model->date_added) ?>,
                    von
                    <?php if ($model->company_homepage): ?>
                        <span class="view-job-company"><a href="<?php echo $model->company_homepage ?>"><?php echo $model->company ?></a></span>.
                    <?php else: ?>
                        <span class="view-job-company"><?php echo $model->company ?></span>.
                    <?php endif; ?>
                    <?php echo format_model_location($model); ?>
                </div>
            </div>

<?php $this->endCache(); } ?>
<?php if($this->beginCache("job_details_rest_testing_" . $model->id, array('duration'=>3600))) { ?>

            <div id="view-description">
                <?php echo text_to_links(textilize($model->description)) ?>
                <?php if ($model->degree): ?>
                    <p><strong>Abschluß:</strong> <?php echo $model->degree->name ?></p>
                <?php endif ?>
            </div>

            <?php if ($model->attachment): ?>
                <div id="view-download">
                    <a href="<?php echo $this->createUrl('job/download', array('id'=>$model->id)); ?>">PDF dieser Anzeige</a>
                </div>
            <?php endif; ?>


            <?php if ($model->how_to_apply): ?>
                <div id="view-howtoapply">
                    <p id="how-to-apply">Bewerbungsweg</p>
                    <p><?php echo text_to_links(textilize($model->how_to_apply)) ?></p>
                </div>
            <?php endif ?>



            <div id="view-deadline">
                <span class="fat">Bewerbungsschluss: <span class="sticky"><?php echo date("d.m.Y", $model->expiration_date); ?></span></span>
            </div>

<?php $this->endCache(); } ?>

            <div id="view-count">
                <p>Dieses Angebot wurde
                    <span id="view-count-data">...</span>
                mal angesehen.</p>
            </div>

            <div id="bottom-nav">

                <a href="javascript:history.go(-1)">Zurück zur Übersicht</a>

                <?php if (isset(Yii::app()->session["idlist"]) &&
                    Yii::app()->session["idlist"] != null &&
                    count(Yii::app()->session["idlist"]) > 0): ?>
                    <span class="alignright" style="color: #767676">Tip: Mit <strong>&larr;</strong> und <strong>&rarr;</strong> können Sie in ihren Suchergebnissen navigieren.</span>
                <?php endif ?>

            </div>

        </div>
    </div>
</div>

<div id="sidebar-container">
    <div id="sidebar">

        <?php if($this->beginCache("job_view_sidebar", array('duration'=>86400))) { ?>

            <?php $this->renderPartial('/shared/_sidebar_contact'); ?>
            <?php $this->renderPartial('/shared/_sidebar_feedback'); ?>
            <?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
            <?php $this->renderPartial('/shared/_sidebar_fb'); ?>
            <?php $this->renderPartial('/shared/_sidebar_supporter'); ?>

        <?php $this->endCache(); } ?>

        <?php if (Yii::app()->user->isAdmin()): ?>
            <h1 class="spacetop">Admin</h1>
            <p><a href="<?php echo $this->createUrl('admin/update', array('id' => $model->id)) ?>">Dieses Angebot bearbeiten</a></p>
        <?php endif ?>

    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        key("right, j, l", function(){
            $("#flash-message").html("Nächstes Angebot...");
            $.get("<?php echo $this->createUrl('job/nextId'); ?>?c=<?php echo $model->id ?>", function(data) {
                if (data == -1) { $("#flash-message").html(""); return false; }
                var url = "<?php echo $this->createUrl('job/view', array('id' => '__ID__', 'src' => 'kb')); ?>".replace('__ID__', data);
                window.location.replace(url);
            });
        });
        key("left, h, k", function(){
            $("#flash-message").html("Vorheriges Angebot...");
            $.get("<?php echo $this->createUrl('job/previousId'); ?>?c=<?php echo $model->id ?>", function(data) {
                if (data == -1) { $("#flash-message").html(""); return false; }
                var url = "<?php echo $this->createUrl('job/view', array('id' => '__ID__', 'src' => 'kb')); ?>".replace('__ID__', data);
                window.location.replace(url);
            });
        });
        key("esc, q, z", function(){ $("#flash-message").html("Übersicht..."); history.go(-1); });

		var url = "<?php echo $this->createUrl('job/viewCount', array('id' => '__ID__')); ?>".replace('__ID__', '<?php echo $model->id ?>');
		$.get(url, function(data) {
			if (data < 1) {
				$("#view-count-data").html("1");
			} else {
				$("#view-count-data").html(data);
			}
        });
    });
</script>
