<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class UkeyController extends Controller
{

	public function actionEdit($id) {
		
		$ukey = $id;
		
		$model = Job::model()->findBySql("SELECT * FROM job WHERE ukey = :ukey", array('ukey' => $ukey));
		if (!$model) {
			Yii::log("No model with ukey: " . $ukey, CLogger::LEVEL_INFO, __FUNCTION__);
			throw new CHttpException(404, Yii::t('app', 'Page not found.'));
		}
		
		$captcha_error = false;
		// store current value ...
		$model_attachment = $model->attachment;

		if(isset($_POST['Job']))
		{

			// Sanitize homepage URL ...
			$_POST['Job']['company_homepage'] = sanitize_url($_POST['Job']['company_homepage']);
			// $sanitized_post = $_POST['Job']; // array_strip_tags($_POST['Job'], '<br>');
			$sanitized_post = array_strip_tags($_POST['Job'], '<br>');

			// $model->attributes = $_POST['Job'];			
			$model->attributes = $sanitized_post;
			// $model->date_added = time();

			// Expiration date ...
			if (!isset($sanitized_post['expiration_date']) || $sanitized_post['expiration_date'] === '') {
				$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
			} else {				
				Yii::log("Expiration date set manually or per default: " . 
					$sanitized_post['expiration_date'], CLogger::LEVEL_INFO, "actionUpdate");				
				// if we can't parse the date, we set it to the default
				$epoch_or_false = strtotime($sanitized_post['expiration_date']);
				if ($epoch_or_false) {
					$model->expiration_date = $epoch_or_false;
				} else {
					$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
				}
			}

			// 0 means admin, but at the moment, we don't use this value for anything
			$model->author_id = 1000; // default; TODO: adjust
			$model->status_id = 1; // 1 means 'draft' TODO: humanize
			
			$model->attachment = CUploadedFile::getInstance($model, 'attachment');

			if ($model->attachment == null && isset($_POST['keep_file'])) {
				Yii::log("keep_file: " . $_POST['keep_file'], CLogger::LEVEL_INFO, __FUNCTION__);
				$model->attachment = $model_attachment;
			} else {
				$_POST['keep_file'] = false;
			}

			if ($model->validate()) {
				if (captcha_passed($_POST) && $model->save()) {
					if (isset($model->attachment) && !$_POST['keep_file']) {
						
						Yii::log("Storing uploaded file. (Filename: " . 
							$this->getUploadFilePath("job", $model->id) . 
							")", CLogger::LEVEL_INFO, __FUNCTION__);
						
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					$this->updateSearchIndex($model);
					$this->updateSearchIndex($model, "admin");
					$this->redirect($this->createUrl('ukey/preview', array('id' => $model->ukey)));
				} else {
					Yii::log("Captcha error or failed to save model.", CLogger::LEVEL_INFO, __FUNCTION__);
					$captcha_error = true;
				}
			}
		}
		$this->render('edit', array('model' => $model, 'id' => $ukey, 'captcha_error' => $captcha_error));
	}
	
	public function actionPreview($id) {
		
		$ukey = $id;
		
		$model = Job::model()->findBySql("SELECT * FROM job WHERE ukey = :ukey", array('ukey' => $ukey));
		if (!$model) {
			Yii::log("No model with ukey: " . $ukey, CLogger::LEVEL_INFO, __FUNCTION__);
			throw new CHttpException(404, Yii::t('app', 'Page not found.'));
		} else {
			Yii::log("Ukey: " . $ukey . ", " .
				"Title: " . $model->title . ", " .
				"Company: " . $model->company . ", " .
				"Date added: " . strftime('%d.%m.%Y %H:%M', $model->date_added) . " " .
				"(" . time_since($model->date_added) . ")", CLogger::LEVEL_INFO, __FUNCTION__);
		}
		
		$this->render('preview', array('model' => $model, 'id' => $ukey));
	}

}

?>