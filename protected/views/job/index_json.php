<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');	
	
	$payload = array();
	foreach ($models as $model) {
		$item = array();
		$item["id"] = $model->id;
		$item["title"] = $model->title;
		$item["url"] = Yii::app()->request->hostInfo . $this->createUrl('job/view', array('id' => $model->id));
		$item["date"] = strftime("%d.%m.%Y", $model->date_added);
		array_push($payload, $item);
	}
	echo json_encode($payload);
	
?>