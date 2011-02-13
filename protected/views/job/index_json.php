<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');	
	
	$payload = array();
	foreach ($models as $model) {
		$item = array();
		$item["id"] = $model->id;
		$item["title"] = $model->title;
		$item["url"] = Yii::app()->request->hostInfo . $this->createUrl('job/view', array('id' => $model->id));
		array_push($payload, $item);
	}
	echo json_encode($payload);
	
?>