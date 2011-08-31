<div id="main-container">
<div id="main">

    <div id="generic-header">
    <?php $this->renderPartial('_header',
        array("original_query" => $original_query, "total" => $total,"tab" => $tab)) ?>
    </div>

    <div id="main-content">

        <div id="listing">
            <?php
            foreach ($models as $i => $model) {
                if (isset($original_query) && $original_query !== "") {
                    $this->renderPartial('_post', array('model' => $model, 'index' => $i, 'original_query' => $original_query));
                } else {
                    $this->renderPartial('_post', array('model' => $model, 'index' => $i));
                }
            }
            ?>

            <?php if (!$models): ?>
                <div style="text-align:center; color: gray; font-size: 40px; margin: 0; padding:0;">&#8709;</div>
                <p class="noresults-box" >
                    Keine Ergebnisse gefunden. Versuchen Sie bitte weniger spezifische Suchbegriffe.
                    Um wieder <a href="<?php echo $this->createUrl('job/index'); ?>">alle Angebote</a> zu sehen, löschen Sie bitte Ihre Eingabe aus dem Suchfeld und drücken Sie &lt;ENTER&gt;.
                    </p>
            <?php endif ?>
        </div>

        <?php
            $this->renderPartial('_pagination', array(
                'models' => $models, 'total' => $total));
        ?>

    </div>


    <div id="footer">
        <?php $this->renderPartial('/shared/_footer', array('original_query' => $original_query, 'tab' => $tab)) ?>
    </div>

</div> <!-- main -->
</div> <!-- main-container -->

<?php if($this->beginCache("job_index_sidebar", array('duration'=>86400))) { ?>

<div id="sidebar-container">
    <div id="sidebar">
        <?php $this->renderPartial('/shared/_sidebar_contact'); ?>
        <?php $this->renderPartial('/shared/_sidebar_for_employer'); ?>
        <?php $this->renderPartial('/shared/_sidebar_feedback'); ?>
        <?php $this->renderPartial('/shared/_sidebar_fb'); ?>
        <?php $this->renderPartial('/shared/_sidebar_supporter'); ?>
    </div>
</div>

<?php $this->endCache(); } ?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $("#search").focus();

        $("a.fav-toggle").click(function(){
            if ($(this).hasClass("isfav")) {
                $(this).removeClass("isfav");
            } else {
                $(this).addClass("isfav");
            }
        });

        $("#sort").change(function() {
            var sortOrder = $("#sort option:selected").text();
            var value = sortOrder.substr(0, 1).toLowerCase();
            var c = $("#sort").attr("baseurl") + "sort=" + value;
            window.location.replace(c);
        });

        // intern is a class added by T3 - it may change!
        $("a.outbound, a.intern").click(function(){
            var text = $(this).text();
            var url = $(this).attr("href");
            $.get("<?php echo $this->createUrl('stats/outbound'); ?>",
                { "url":encodeURIComponent(url), "text": text, "location": encodeURIComponent(document.location.href) });
        });

    });
</script>
