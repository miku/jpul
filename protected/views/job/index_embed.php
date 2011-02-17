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
	if (isset($params["page"])) {
		if ($params["page"] < 1) {
			$params["page"] = 1;
		}
		$params["page"] = preg_replace("/[^\d]/", "", $params["page"]);
		if ($params["page"] > ($total / $this->items_per_page)) {
			$params["page"] = ceil($total / $this->items_per_page);
		}
	}
	if (isset($params["size"])) {
		unset($params["size"]);
	}
	
	$number_of_pages = ceil($total / $this->items_per_page);
	$current_page = $params["page"];
?>

<?php
	$params_headline_link = $params;
	if (isset($params_headline_link["v"])) {
		unset($params_headline_link["v"]);
	}
 ?>

<?php if (count($models) > 0): ?>
	<style type="text/css" media="screen">
	.ul-jobportal-box {
		font: normal 10pt Verdana,"Helvetica Neue",Arial,Tahoma,sans-serif;
		font-size: 75%;
		width: 350px;
		border: dashed thin #ABABAB;
		padding: 10px;
	}
	.ul-jobportal-box .date {
		font-size: 50%;
		color: gray;
	}
	.ul-jobportal-box ul, li {
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.ul-jobportal-box a {
		text-decoration: none;
	}
	.ul-jobportal-box p {
		font-weight: bold;
	}
	.ul-jobportal-box li {
		padding: 2px 0 2px 0;
	}
	.ul-jobportal-box li.even {
		background: aliceblue;
	}
	.ul-jobportal-box img {
		border: none;
	}

</style>

<div class="ul-jobportal-box">
	<p>Universität Leipzig | Jobportal<br><a href="<?php echo urldecode($this->createUrl('job/index', $params_headline_link)); ?>">
		Aktuelle Jobangebote <?php if (isset($original_query) && $original_query != ''): ?>
			für <em><?php echo $original_query ?></em>
		<?php endif ?>
		</a><br>
	</p>
	<ul>
	<?php foreach ($models as $index => $model): ?>
		<li class="<?php if ($index % 2 == 0) { echo 'even'; } ?>"><a href="<?php echo Yii::app()->request->hostInfo . $this->createUrl('job/view', array('id' => $model->id)); ?>">
			<?php echo cut_text($model->title, 40); ?></a> <span class="date"><?php echo strftime("%d.%m.%Y", $model->date_added); ?></span></li>
	<?php endforeach ?>
	</ul>
	<br>
		<a href="http://www.zv.uni-leipzig.de/studium/career-center.html">
			<img src="http://wwwdup.uni-leipzig.de/jobportal/images/v2/cc_logo.gif" width="100px" alt="Career Center" />
	</a>
</div>
<?php endif ?>

