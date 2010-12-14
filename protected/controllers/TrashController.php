<?php

Yii::import('application.vendors.*');

require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports
require_once('recaptcha-php-1.11/recaptchalib.php'); // recaptcha

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

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
	
	public function actionTracker() {

		$addr = $_SERVER["REMOTE_ADDR"];
		$request_time = time();
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		$referer = $_SERVER["HTTP_REFERER"];		
		$request_path = $_SERVER['REQUEST_URI'];
		$request_method = $_SERVER['REQUEST_METHOD'];
		$http_accept = $_SERVER['HTTP_ACCEPT'];
		
		if (isset(Yii::app()->session['tracker'])) {
			Yii::log("We got you", CLogger::LEVEL_INFO, "actionTracker");
			foreach (Yii::app()->session['tracker'] as $key => $value) {
				Yii::log("k, v: " . $key . " => " . $value, CLogger::LEVEL_INFO, "actionTracker");
			}
			// Yii::log("First access: " . time_since(Yii::app()->session['tracker']['first-access']));
			$xtrack = Yii::app()->session['tracker'];
			
			Yii::log($xtrack['last-access'], CLogger::LEVEL_INFO, "actionTracker");
			$xtrack['last-access'] = time();
			Yii::app()->session['tracker'] = $xtrack;
			
		} else {
			Yii::log("New trackable.", CLogger::LEVEL_INFO, "actionTracker");
			Yii::app()->session['tracker'] = array("id" => uniqid(), "first-access" => time(), "last-access" => time());
		}
		
		Yii::log("[[ track ]] " . $addr, CLogger::LEVEL_INFO, "actionTracker");
		Yii::log("[[ track ]] " . $user_agent, CLogger::LEVEL_INFO, "actionTracker");
		Yii::log("[[ track ]] " . $request_path, CLogger::LEVEL_INFO, "actionTracker");
		Yii::log("[[ track ]] " . $referer, CLogger::LEVEL_INFO, "actionTracker");
		Yii::log("[[ track ]] " . $request_method, CLogger::LEVEL_INFO, "actionTracker");
		Yii::log("[[ track ]] " . $http_accept, CLogger::LEVEL_INFO, "actionTracker");
		
		

	}
}