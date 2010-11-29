<?php

Yii::import('application.vendors.*');

require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports
require_once('recaptcha-php-1.11/recaptchalib.php'); // recaptcha

class TrashController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionRecaptcha()
	{
		Yii::log($_POST, CLogger::LEVEL_INFO, "actionRecaptcha");
		
		if(isset($_POST["recaptcha_challenge_field"])) {
		
		
			$privatekey = Yii::app()->params['rc_privatekey'];
	  		$resp = recaptcha_check_answer($privatekey,
	                                $_SERVER["REMOTE_ADDR"],
	                                $_POST["recaptcha_challenge_field"],
	                                $_POST["recaptcha_response_field"]);

			if (!$resp->is_valid) {
				Yii::app()->user->setFlash('success', "The reCAPTCHA wasn't entered correctly. Go back and try it again.");
	  		} else {
				Yii::app()->user->setFlash('success', "OKOKOK.");
	  		}
		} 
		
		$this->render('recaptcha');

	}
}