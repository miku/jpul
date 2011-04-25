<?php header('Content-type: application/json'); 
$items = array();
foreach ($models as $model) {
	$item = array();
	$item['id'] = $model->id;
	$item['title'] = $model->title;	
	$item['company'] = $model->company;
	$item['city'] = $model->city;
	$item['date_added'] = strftime('%d.%m.%Y', $model->date_added);
	if ($model->attachment != null) {
		if (Yii::app()->request->serverPort == 80) {
			$item['attachment'] = 'http://' . Yii::app()->request->serverName . $this->createUrl('job/download', array('id' => $model->id));
		} else {
			$item['attachment'] = 'http://' . Yii::app()->request->serverName . ':' . Yii::app()->request->serverPort .  $this->createUrl('job/download', array('id' => $model->id));
		}
	}		
	array_push($items, $item);
}
echo json_encode($items); 
?>
