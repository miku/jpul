<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class ApiController extends Controller
{

	public function actionIndex() {		
		$this->render('index');
	}
	
}

?>