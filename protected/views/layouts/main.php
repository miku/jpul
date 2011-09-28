<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="Jobportal des Career Centers der Universität Leipzig.">
    <meta name="author" content="Career Center, careercenter@uni-leipzig.de">
    <meta name="keywords" content="Arbeitsangebote, Job, Studenten, Absolventen, Hochschule, Jobportal, Listing">

    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="P-Sv0jsBB44YjC-6whsD8npmjnUHBRubEvdGNBiU5yc" />

    <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- <link rel="apple-touch-icon" href="/apple-touch-icon.png"> -->

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.min.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/wysiwym/wysiwym.min.css" />

    <!-- CSS : implied media="all" -->
    <!-- Suppress built-in jquery.js -->
    <?php Yii::app()->clientScript->scriptMap=array('jquery.js'=>false, 'jquery.min.js'=>false); ?>

    <!-- Uncomment if you are specifically targeting less enabled mobile browsers
    <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

    <!-- jQuery CDN + fallback recipe

     	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
        <script>google.load("jquery", "1.6");</script>
        <script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAAwZHBf7XN4DXK4QBh4sq4rxSq_2kWzEPveyg2_i9v3i3ALbSyFhRlqWoPkNMIMdTjcY7d2DNMQ5vRsg"></script>
        <script>
            if (typeof jQuery == 'undefined') {
                document.write(unescape("%3Cscript src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.6.1.min.js'
                type='text/javascript'%3E%3C/script%3E"));
            }
        </script>
    -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <!--
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.6.1.min.js"></script>
    -->

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.color.e95e088.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.url.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wysiwym/wysiwym.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/keymaster.min.js"></script>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tracker.min.js"></script>
    <script>$(document).ready(function() {
        ccul_track('<?php echo $this->createUrl("stats/track"); ?>');
    });
    </script>
</head>
<body>
    <div class="container" id="page">
	    <noscript><div id="broadcast">Um die volle Funktionalität dieser Website nutzen zu können, aktivieren Sie bitte Javascript.</div></noscript>
    
        <div id="title">
            <div id="title-nav">

                <div id="title-nav-left">
                    <ul>
                        <li><a href="<?php echo $this->createUrl('job/index'); ?>">Jobportal Homepage</a></li>
                        <li><a class="outbound" href="http://www.zv.uni-leipzig.de/studium/career-center.html">Career Center</a></li>
                        <li><span id="flash-message" style="color:black; background: #EFEFEF;"></span></li>
                    </ul>
                </div>

                <div id="title-nav-right">
                    <ul>

                        <?php if (Yii::app()->user->getId() != NULL): ?>
                            <?php if (Yii::app()->user->isAdmin()): ?>
                                <li><a href="<?php echo $this->createUrl('site/options'); ?>">Einstellungen</a></li>
                            <?php endif; ?>
                            <li style="color: #CACACA; ">
                                <?php if (Yii::app()->user->isAdmin()): ?>
                                    Eingeloggt als <span> <a style="background: white; color: black; font-weight: bold;" href="<?php echo $this->createUrl('admin/index'); ?>"><?php echo Yii::app()->user->getUsername(); ?></a></span>
                                <?php else: ?>
                                    Eingeloggt als <span style="font-weight: bold"> <?php echo Yii::app()->user->getUsername(); ?></span>
                                <?php endif; ?>
                            </li>
                            <li><a style="background: white; color: black; font-weight: bold;" href="<?php echo $this->createUrl('site/logout'); ?>">Logout</a></li>
                        <?php else: ?>
                            <li><a style="color: white" href="<?php echo $this->createUrl('site/login'); ?>">Intranet</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div id="title-logo">
                <a class="outbound" href="http://www.uni-leipzig.de" title="Universität Leipzig"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/logo.jpg" alt="Universität Leipzig" /></a>
            </div>

            <div id="title-border">&nbsp;</div>

        </div> <!-- title -->

        <div class="clear"></div>


        <div id="content">
            <?php echo $content; ?>
        </div>

        <div class="clear"></div>
    </div>
</body>
</html>
