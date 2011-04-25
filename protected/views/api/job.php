<?php header('Content-type: application/json'); 
$item = array();
$item['id'] = $model->id;
$item['title'] = $model->title;	
$item['description'] = $model->description;
$item['how_to_apply'] = $model->how_to_apply;
$item['company'] = $model->company;
$item['company_homepage'] = $model->company_homepage;
$item['zipcode'] = $model->zipcode;
$item['city'] = $model->city;
$item['state'] = $model->state;
$item['country'] = $model->country;
$item['job_version'] = $model->job_version;

$item['expiration_date'] = strftime('%d.%m.%Y', $model->expiration_date);
$item['expiration_date_ts'] = $model->expiration_date;
$item['date_added'] = strftime('%d.%m.%Y', $model->date_added);
$item['date_added_ts'] = $model->date_added;
$item['view_count'] = $view_count;

if ($model->attachment != null) {
	if (Yii::app()->request->serverPort == 80) {
		$item['attachment'] = 'http://' . Yii::app()->request->serverName . $this->createUrl('job/download', array('id' => $model->id));
	} else {
		$item['attachment'] = 'http://' . Yii::app()->request->serverName . ':' . Yii::app()->request->serverPort .  $this->createUrl('job/download', array('id' => $model->id));
	}
}

echo json_encode($item); 

?>
