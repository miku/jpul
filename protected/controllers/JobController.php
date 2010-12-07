<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports
require_once('recaptcha-php-1.11/recaptchalib.php'); // recaptcha

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class JobController extends Controller
{
	// jobs per page, defaults to 30
	const PAGE_SIZE = 5;
	// 6 * 7 * 24 * 60 * 60 = six weeks
	const DEFAULT_EXPIRATION_SECONDS = 3628800; 		
	
	/**
	 * Get the path to the uploaded job attachments.
	 * @return Job attachments upload path
	 */
	public function getSearchIndexStore()
	{
		return Yii::app()->basePath . '/runtime/search';
	}

	/**
	 * Get the path to the uploaded job attachments.
	 * @param string name of the model (here 'job')
	 * @param integer id of the model instance
	 * @param string file extension, defaults to 'pdf'
	 * @return Job attachments upload path for a particular model
	 */
	public function getUploadFilePath($modelName, $id, $extension = 'pdf')
	{
		return $this->getUploadPath() . '/Attachment_' . $modelName . '_' . $id . '.' . $extension;
	}


	/**
	 * Yii filters
	 * @return Our request filters
	 */
	public function filters()
	{
		return array('adminOnly + create, update, delete');
	}


	/**
	 * Index action. Default page is 0.
	 */
	public function actionIndex($page = 1, $sort = null) {

		$current_time = time();

		// catch negative page numbers
		if ($page < 1) { $this->redirect(array('index', 'page' => 1)); }
		
		$criteria = new CDbCriteria;

		switch ($sort) {
			case 't': // order by job title
				$criteria->order = 'title';
				break;
			case 'u': // order by company
				$criteria->order = 'company';
				break;
			case 'o': // order by city name
				$criteria->order = 'city';
				break;
			default:
				$criteria->order = 'date_added DESC';
				break;
		}
		
		// just show the public offers, which are not expired ...
		$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
		$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
				
		// if we have a term query ...
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore());
			$original_query = $_GET['q'];
			$query = trim($original_query) . '*';
		
			try {
				$results = $index->find($query);
			} catch (Exception $e) {
				$this->redirect(array('index'));
			}
		
			$pks = array();
 			foreach ($results as $result) {
				$pks[] = $result->pk;
			}

			$total = count(Job::model()->findAllByAttributes(array('id' => $pks), $criteria));

			// fix number of offers per page ...
			$criteria->limit = self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * self::PAGE_SIZE;;
			
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
			$current_start = ($page - 1) * self::PAGE_SIZE;;
			$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;
		} else {
			
			$total = count(Job::model()->findAll($criteria));

			// fix number of offers per page ...
			$criteria->limit = self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * self::PAGE_SIZE;;

			// just the default index action ...
			$models = Job::model()->findAll($criteria);
			
			$original_query = null;
		}

		$number_of_pages = ceil($total / self::PAGE_SIZE);
		$current_start = ($page - 1) * self::PAGE_SIZE;;
		$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;			
		
		$this->render('index', array(
			'models'=>$models, 
			'total' => $total,
			'current_start' => $current_start, 
			'current_end' => $current_end,
			'page' => $page,
			'number_of_pages' => $number_of_pages,
			'sort' => $sort,
			'original_query' => $original_query) 
		);
	}

	/**
	 * Download job attachment.
	 * @param integer the id of the model, whose attachment is requested
	 */
	public function actionDownload($id)
	{
		$model = Job::model()->findByPk($id);
		if ($model) {
			$fname = $this->getUploadFilePath('job', $id);
			$this->renderPartial('download', array('fname'=>$fname), false, true);
		} else {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
	}


	/**
	 * Create a new job posting.
	 */
	public function actionDraft()
	{
		$current_time = time();
		$model = new Job;

		if(isset($_POST['Job'])) {
						
			$sanitized_post = array_strip_tags($_POST['Job']);
			
			// $model->attributes = $_POST['Job']; // mass assignment
			$model->attributes = $sanitized_post; 
			$model->date_added = time();
			$model->status_id = 1; // needs review
			
			if (!isset($sanitized_post['expiration_date']) || $sanitized_post['expiration_date'] === '') {
				$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
			} else {
				Yii::log("Expiration set manually: " . $sanitized_post['expiration_date'], CLogger::LEVEL_INFO, "actionCreate");
				$epoch_or_false = strtotime($sanitized_post['expiration_date']);
				if ($epoch_or_false) {
					
					$model->expiration_date = $epoch_or_false;
				} else {
					$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
				}
			}

			$model->author_id = 1000;

			$model->attachment=CUploadedFile::getInstance($model,'attachment');

			if ($model->validate()) 
			{
				if ($model->save() && captcha_passed($_POST)) {
					if (isset($model->attachment)) {
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					// $this->updateSearchIndex($model);
					$this->mailOnDraft($model);
					
					Yii::app()->user->setFlash('success', "Ihr Angebot wurde für ein Review vorbereitet. Wenn Sie eine E-Mail Adresse für die Benachrichtigung eingerichtet haben, bekommen Sie auf diese eine Nachricht zugesandt, sobald das Jobangebot geprüft und freigeschaltet wurde; falls nicht, können Sie mit einer Freischaltung in maximal drei Tagen rechnen.");
					
					$this->redirect(array('index'));
				}
			}
		}
		
		$this->render('draft', array('model' => $model));
	}
	
	
	protected function mailOnDraft($model) {
		
		$email_model = Options::model()->findByAttributes(array("option" => "on-draft-notification-email-addresses"));
		
		$emails = $email_model->value;
		
		if ($emails != '') {
			$to      = $emails;
			$subject = '[CC-Jobportal] Neues Jobangebot erstellt (Unternehmen: ' . $model->company . ')';
			$message = 'Neues Jobangebot erstellt\n' .
						'Unternehmen: ' . $model->company . ')' .
						'Ort: ' . $model->city . '\n' .
						'Ablauf der Bewerbungsfrist: ' . date("d.m.Y", $model->expiration_date) . '\n\n' .
						'URL im Jobportal: ' . Yii::app()->request->baseUrl . $this->createUrl('job/view', array('id' => $model->id));
						
			$headers = 'From: careercenter@uni-leipzig.de' . "\r\n" .
	    		'Reply-To: careercenter@uni-leipzig.de' . "\r\n" .
	    		'X-Mailer: PHP/' . phpversion();

			if (mail($to, $subject, $message, $headers)) {
				Yii::log("Draft-Mail accepted", CLogger::LEVEL_INFO, "mailOnDraft");
			} else {
				Yii::log("Draft-Mail NOT accepted", CLogger::LEVEL_INFO, "mailOnDraft");
			}			
		}
	}


	/**
	 * Update a new job posting.
	 */
	public function actionUpdate($id)
	{
		$model = Job::model()->findByPk($id);
		
		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}

		if(isset($_POST['Job']))
		{

			Yii::log("Company Homepage before adjustments: " . $_POST['Job']['company_homepage'], CLogger::LEVEL_INFO, "actionUpdate");
			$company_homepage = $_POST['Job']['company_homepage'];
			if ($company_homepage != "" && !startsWith($company_homepage, "http://")) {
				$company_homepage = "http://" . $company_homepage;
				$_POST['Job']['company_homepage'] = $company_homepage;
			}
			Yii::log("Company Homepage after adjustments: " . $_POST['Job']['company_homepage'], CLogger::LEVEL_INFO, "actionUpdate");
			
			
			$sanitized_post = array_strip_tags($_POST['Job']);

			// $model->attributes = $_POST['Job'];			
			$model->attributes = $sanitized_post;
			$model->date_added = time();

			if (!isset($sanitized_post['expiration_date']) || $sanitized_post['expiration_date'] === '') {
				$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
			} else {
				Yii::log("Expiration set manually: " . $sanitized_post['expiration_date'], CLogger::LEVEL_INFO, "actionCreate");
				$epoch_or_false = strtotime($sanitized_post['expiration_date']);
				if ($epoch_or_false) {
					$model->expiration_date = $epoch_or_false;
				} else {
					$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
				}
			}

			$model->author_id = 0; // default; TODO: adjust

			$model->attachment = CUploadedFile::getInstance($model, 'attachment');

			if ($model->validate()) {
				if ($model->save()) {
					if (isset($model->attachment)) {
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					$this->updateSearchIndex($model);
					$this->redirect(array('index'));
				}
			}
		}
		$this->render('update', array('model' => $model));
	}

	/**
	 * Job details.
	 */
	public function actionView($id)
	{
		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, "actionView");
		$this->render('view', array('model' => $model));
	}

	/**
	 * Delete a job; it just gets archived.
	 */
	public function actionDelete($id)
	{
		$model = Job::model()->findByPk($id);

		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
		$model->status_id = 3;
		
		$this->removeFromSearchIndex($model);
		
		if ($model->save(false)) {
			Yii::log("Set status of record id: " . $model->id . " to: " . $model->status_id . " (deleted)", CLogger::LEVEL_INFO, "default");	
		} else {
			Yii::log("Deleting failed on: " . $model->id, CLogger::LEVEL_INFO, "default");	
			throw new CHttpException(500, Yii::t('app', 'Your request is not valid.'));
		}

		$this->redirect(array('index'));
	}
	
} // EOF


