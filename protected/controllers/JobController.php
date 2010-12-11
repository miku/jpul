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
	const PAGE_SIZE = 20;
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
		// if ($page < 1) { $this->redirect(array('index', 'page' => 1)); }
		
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
		
		$useDefaultView = true;
		$viewName = null;
				
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
			
			$number_of_pages = ceil($total / self::PAGE_SIZE);
			
			Yii::app()->session['snapBackSearchTerm'] = $original_query;
			$useDefaultView = false;
			
			Yii::app()->session['detailSnapBackUrl'] = $this->createUrl('job/index', array('q' => $original_query, 'page' => $page));
		}	
		
		// special pages, likes favorite filter
		if (isset($_GET['s']) && $_GET['s'] != '' && 
			isset(Yii::app()->session['ufk__v3'])) {
				
			if (count(Yii::app()->session['ufk__v3']) == 0) {
				$this->redirect('index');
			}

			$favList = Yii::app()->session['ufk__v3'];
			$models = array();
			foreach ($favList as $key => $value) {
				Yii::log($key . " => " . $value['id'], CLogger::LEVEL_INFO, "actionIndex");
				array_push($models, Job::model()->findByPk($value['id']));
			}
			
			$total = count($models);
			
			$page = 1;
			// fix number of offers per page ...
			// $criteria->limit = self::PAGE_SIZE;
			// $criteria->offset = ($page - 1) * self::PAGE_SIZE;;

			$original_query = null;
			$viewName = "favs";
			$useDefaultView = false;
			
			$number_of_pages = 1;
			$current_start = 0;
			$current_end = $total;

			
			Yii::app()->session['detailSnapBackUrl'] = $this->createUrl('job/index', array('s' => 'favs'));
		}
			
		if ($useDefaultView) {

			$total = count(Job::model()->findAll($criteria));

			// fix number of offers per page ...
			$criteria->limit = self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * self::PAGE_SIZE;;

			// just the default index action ...
			$models = Job::model()->findAll($criteria);
			
			$original_query = null;
			Yii::app()->session['snapBackSearchTerm'] = '';
			Yii::app()->session['detailSnapBackUrl'] = $this->createUrl('job/index', array('page' => $page));
			
			$viewName = "default";
			
			$number_of_pages = ceil($total / self::PAGE_SIZE);
			$current_start = ($page - 1) * self::PAGE_SIZE;;
			$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;			

		}
		
		Yii::app()->session['snapBackPage'] = $page;
		
		$this->render('index', array(
			'models'=>$models, 
			'total' => $total,
			'current_start' => $current_start, 
			'current_end' => $current_end,
			'page' => $page,
			'number_of_pages' => $number_of_pages,
			'sort' => $sort,
			'original_query' => $original_query,
			'viewName' => $viewName) 
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
	
	public function actionJobTitle($id) {
		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, "actionView");
		$this->renderPartial('_job_title', array('model' => $model));
	}
	
	public function actionToggleFavorite($id) {
		
		$userFavsKey = "ufk__v3";
		if (!isset(Yii::app()->session[$userFavsKey])) {
			Yii::app()->session[$userFavsKey] = array();
		}
		
		$userFavs = Yii::app()->session[$userFavsKey];
		$removed = false;
		foreach ($userFavs as $key => $value) {
			if ($value["id"] == $id) {
				unset($userFavs[$key]);
				$removed = true;
			}
		}
		
		if (!$removed) {
			$model = Job::model()->findByPk($id);
			if (!$model) {
				throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
			} else {
				array_push($userFavs, 
					array(
						"id" => $id, 
						"title" => $model->title, 
						"url" => $this->createUrl('view', array('id' => $id))
					)
				);
			}
		}
		
		Yii::app()->session[$userFavsKey] = $userFavs;
		
		$data = "Bogus!"; // implode(", ", $userFavs);
		
		// $userFavsArray = split(",", $userFavs);
		// 
		// foreach ($userFavsArray as $key => $value) {
		// 	Yii::log("userFavsArray, Key, Value: " . $key . " => " . $value, CLogger::LEVEL_INFO, "actionToggleFavorite");
		// }
		// 
		// if (in_array($id, $userFavsArray)) {
		// 	unset($userFavsArray[$id]);
		// } else {
		// 	$id; // doesn't really matter
		// }
		// Yii::log("User favorites: " . count($userFavsArray), CLogger::LEVEL_INFO, "actionToggleFavorite");
		// 
		// Yii::app()->session[$userFavsKey] = implode(",", $userFavsArray);		
		// $data = Yii::app()->session[$userFavsKey];
		
		// $this->renderPartial('_sidebar_user_favorites', array('data'=>$data), false, true);
		$this->renderPartial('_favbar');
		// $this->render('_toggle_favorite');
		
	}

	/**
	 * Create a new job posting.
	 */
	public function actionDraft()
	{
		$current_time = time();
		$model = new Job;

		if(isset($_POST['Job'])) {
						
			$sanitized_post = array_strip_tags($_POST['Job'], '<br>');
			
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
		
		$newline = chr(13) . chr(10);
		
		$email_model = Options::model()->findByAttributes(array("option" => "on-draft-notification-email-addresses"));
		
		$emails = $email_model->value;
		
		if ($emails != '') {
			$to      = $emails;
			$subject = '[CC-Jobportal] Neues Jobangebot erstellt (Unternehmen: ' . $model->company . ')';
			$message = 'Neues Jobangebot erstellt' . $newline . 
						'Unternehmen: ' . $model->company . $newline . 
						'Ort: ' . $model->city . $newline .
						'Ablauf der Bewerbungsfrist: ' . date("d.m.Y", $model->expiration_date) . $newline . $newline .
						'URL im Jobportal: http://wwwdup.uni-leipzig.de' . $this->createUrl('job/view', array('id' => $model->id));
						
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
	 * Job details.
	 */
	public function actionView($id, $from = '')
	{
		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, "actionView");
		$this->render('view', array('model' => $model));
	}
	
} // EOF

