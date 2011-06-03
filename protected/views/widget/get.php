<?php
	// https://developer.mozilla.org/En/Server-Side_Access_Control
	header('Access-Control-Allow-Origin: *');
	header('Content-type: text/html');	
?>
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
<?php
	$params_headline_link = $params;
	if (isset($params_headline_link["v"])) {
		unset($params_headline_link["v"]);
	}
	$params_headline_link['src'] = 'widget';
?>

<style>
	div#ccul_jobportal_widget_box {
		margin: 5px 0 5px 0; padding:10px; border:dashed thin #ABABAB; font-size:75%; font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
	}
	div#ccul_jobportal_widget_box ul {
		margin:0; padding:0; list-style:none;
	}
	div#ccul_jobportal_widget_box ul li {
		padding: 2px; list-style:none;
	}
	div#ccul_jobportal_widget_box ul li a {
		text-decoration: none;
	}
	div#ccul_jobportal_widget_box .ccul_date {
		font-size: 75%; color: gray;
	}
	div#ccul_jobportal_widget_box img {
		border: none;
	}
</style>

<div id="ccul_jobportal_widget_box" style="">

<p>Universität Leipzig | Jobportal<br>
	<a target="_blank" href="http://wwwdup.uni-leipzig.de<?php echo urldecode($this->createUrl('job/index', $params_headline_link)); ?>">Aktuelle Jobangebote<?php if (isset($original_query) && $original_query != ''): ?> für <em><?php echo cut_text($original_query, 25); ?></em><?php endif ?></a><br>
</p>

<?php if ($models): ?>
<ul style="">
	<?php foreach ($models as $index => $model): ?>
	<li style="<?php if ($index % 2 == 0) { echo 'background: aliceblue'; } ?>"><a target="_blank" style="" href="http://wwwdup.uni-leipzig.de<?php echo $this->createUrl('job/view', array('id' => $model->id, 'src' => 'widget')); ?>">
		<?php echo cut_text($model->title, 60); ?></a> <span class="ccul_date" style="">
		<?php echo strftime("%d.%m.%Y", $model->date_added); ?></span></li>
	<?php endforeach ?>
</ul>
<br>
<?php endif ?>

<a target="_blank" href="http://www.zv.uni-leipzig.de/studium/career-center.html"><img style="" src="http://wwwdup.uni-leipzig.de/jobportal/images/v2/cc_logo.gif" width="100px" alt="Career Center" /></a>
</div>
