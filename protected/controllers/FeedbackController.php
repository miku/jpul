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
					$this->mailOnFeedback($model);
					$this->redirect($this->createUrl('feedback/thanks'));
				} else {
					Yii::log("Captcha error or failed to save model.", CLogger::LEVEL_INFO, __FUNCTION__);
					$captcha_error = true;
				}
			}
		}	
		$this->render('index', array('model' => $model, 'captcha_error' => $captcha_error));
	}
	
	public function actionThanks($tab = 'all') {
		$this->render('thanks', array("tab" => $tab));
	}
	
	protected function mailOnFeedback($model) {
	
		$newline = chr(13) . chr(10);
	
		// Email addresses are stored as string value in the options table,
		// which is simply a dumb key resp. option-value store. 
		// The key for the 'mailOnDraft' action is:
		//     on-draft-notification-email-addresses
		$email_model = Options::model()->findByAttributes(
				array("option" => "on-feedback-notification-email-addresses"));
	
		$emails = $email_model->value;
	
		if ($emails != null && $emails != '') {
			$to      = $emails;
			$subject = '[CC-Jobportal] Neues Feedback zu Jobportal';
			$message =  'Neues Feedback zum Jobportal' . $newline . $newline . 
						'Datum: ' . strftime('%d.%m.%Y', $model->date_added) . $newline . $newline . 
						'Text: ' . $model->text . $newline . $newline .
						'E-Mail-Addresse des Absenders (falls angegeben): ' . $model->email . $newline;
					
			$headers = 	'From: careercenter@uni-leipzig.de' . "\r\n" .
	    				'Reply-To: careercenter@uni-leipzig.de' . "\r\n";

			if (mail_utf8($to, $subject, $message, $headers)) {
				Yii::log("Feedback-Mail accepted. Sent to: " . $emails, CLogger::LEVEL_INFO, __FUNCTION__);
			} else {
				Yii::log("Feedback-Mail NOT accepted.", CLogger::LEVEL_INFO, __FUNCTION__);
			}
		}
	}

}

?>
