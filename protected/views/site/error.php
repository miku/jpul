<?php $this->pageTitle = Yii::app()->name . ' - Error'; ?>
<?php $this->layout = 'plain'; ?>


<!DOCTYPE html> 
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="de" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="de" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="de" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="de" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="de" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Jobportal Widget</title>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.6.1.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tracker.min.js"></script>
    <script>$(document).ready(function() { ccul_track('<?php echo $this->createUrl("stats/track"); ?>'); });</script>   
    <style type="text/css" media="screen">
        body {
            background: #EFEFEF;
        }
        #main {
            border: solid thin #D8D8D8;
            background: white;
            font-family: Verdana, sans-serif;
            font-size: 12px;
            padding: 40px;
            width: 650px;
            margin: auto;
            text-align: center;
        }
        .apifunction { padding: 5px 10px 5px 10px; background: #EFEFEF; margin-bottom: 15px; }
        .apifunction a {
            color: darkorange;
            padding: 5px;
            background: white;
        }
        .apifunction a:hover {
            background: darkorange;
            color: white;
            padding: 5px;
        }

        pre {
            padding: 10px;
            background: white;
        }
        label {
            font-weight: bold;
        }
        p.help {
            font-size: 10px;
            margin: 2px 0 2px 0;
            color: gray;
        }
        .line {
            margin: 16px 0 16px 0;
            border-bottom: solid 3px #EFEFEF;
        }
    </style>
</head>
<body>
<div id="main">

<div style="margin: 10px; padding: 10px;" id="main-content">
	
<div style="margin: 0px 0px 10px 0px">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_o_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_h_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_n_1_sm.gif" alt="" width="120px"/>
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/v2/404/code_flag_o_1_sm.gif" alt="" width="120px"/>
</div>

<p style="font-size: 80px">1, 2, 3 ... <?php echo $code; ?>!</p><br>
		
	<p style="font-size: 16px">Diese von Ihnen aufgerufene Seite existiert nicht oder ist nicht verfügbar.
		<a href="<?php echo $this->createUrl('job/index') ?>">Zurück zur Homepage</a>?</p>
</div>	


</div></body></html>
