<!-- jv:1 -->
<div id="main-container">
    <div id="main">
        <div id="view-content">

            <div id="view-header">

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
                            console.log("Hi");
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
            
            <?php if (isset($view_count)): ?>
            <div id="view-count">
                <p>Dieses Angebot wurde 
                    <?php echo ($view_count == 0) ? 1 : $view_count; ?> 
                mal angesehen.</p>
            </div>              
            <?php endif ?>
            
            <div id="bottom-nav">   
                
                <a href="javascript:history.go(-1)">Zurück zur Übersicht</a>
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

