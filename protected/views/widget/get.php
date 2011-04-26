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
?>

<style>
	div#ccul_jobportal_widget {
		width:400px; padding:10px; border:dashed thin #ABABAB; font-size:75%; font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
	}
	div#ccul_jobportal_widget ul {
		margin:0; padding:0; list-style:none;
	}
	div#ccul_jobportal_widget ul li {
		padding: 2px;
	}
	div#ccul_jobportal_widget ul li a {
		text-decoration: none;
	}
	div#ccul_jobportal_widget .ccul_date {
		font-size: 60%; color: gray;
	}
	div#ccul_jobportal_widget img {
		border: none;
	}
</style>

<div id="ccul_jobportal_widget" style="">

<p>Universität Leipzig | Jobportal<br>
	<a href="http://wwwdup.uni-leipzig.de<?php echo urldecode($this->createUrl('job/index', $params_headline_link)); ?>">Aktuelle Jobangebote<?php if (isset($original_query) && $original_query != ''): ?> für <em><?php echo cut_text($original_query, 25); ?></em><?php endif ?></a><br>
</p>

<?php if ($models): ?>
<ul style="">
	<?php foreach ($models as $index => $model): ?>
	<li style="<?php if ($index % 2 == 0) { echo 'background: aliceblue'; } ?>"><a style="" href="http://wwwdup.uni-leipzig.de<?php echo $this->createUrl('job/view', array('id' => $model->id)); ?>">
				<?php echo cut_text($model->title, 40); ?></a> <span class="ccul_date" style="">
				<?php echo strftime("%d.%m.%Y", $model->date_added); ?></span></li>
	<?php endforeach ?>
</ul>
<br>
<?php endif ?>

<a href="http://www.zv.uni-leipzig.de/studium/career-center.html"><img style="" src="http://wwwdup.uni-leipzig.de/jobportal/images/v2/cc_logo.gif" width="100px" alt="Career Center" /></a>
</div>
