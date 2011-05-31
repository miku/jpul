<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class FeedbackController extends Controller
{

	public function actionIndex($context = null) {
		
		$model = new Feedback;
		$captcha_error = false;
		
		if(isset($_POST['Feedback'])) {
			$model->attributes = $_POST['Feedback'];
			$model->date_added = time();
			$model->context = $context;
			
			if ($model->validate()) {
				if (captcha_passed($_POST) && $model->save()) {					
					$this->redirect($this->createUrl('feedback/thanks'));
				} else {
					Yii::log("Captcha error or failed to save model.", CLogger::LEVEL_INFO, __FUNCTION__);
					$captcha_error = true;
				}
			}
		}	
		$this->render('index', array('model' => $model, 'captcha_error' => $captcha_error));
	}
	
	public function actionThanks() {
		$this->render('thanks');
	}
}

?>
