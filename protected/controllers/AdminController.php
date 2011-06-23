<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports
require_once('recaptcha-php-1.11/recaptchalib.php'); // recaptcha

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class AdminController extends Controller
{
	// jobs per page, defaults to 30
	const PAGE_SIZE = 20; // unused TODO
	// 6 * 7 * 24 * 60 * 60 = six weeks
	const DEFAULT_EXPIRATION_SECONDS = 3628800; 	
		
	/**
	 * Yii filters
	 * @return Our request filters
	 */
	public function filters()
	{
		return array('adminOnly');
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


	public function actionFilter($filter = "") {

		if (Yii::app()->session['adminindexfilter'] == null) {
			Yii::app()->session['adminindexfilter'] = "";
		}
		
		$adminIndexFilter = Yii::app()->session['adminindexfilter'];
		
		Yii::log("current filter = " . $adminIndexFilter . ", new filter = " . $filter, CLogger::LEVEL_INFO, "actionFilter");

		if (contains($adminIndexFilter, $filter)) {
			$adminIndexFilter = str_replace($filter, "", $adminIndexFilter);
		} else {
			$adminIndexFilter .= $filter;
		}

		Yii::log($adminIndexFilter, CLogger::LEVEL_INFO, "actionFilter");		
		Yii::app()->session['adminindexfilter'] = $adminIndexFilter;

		$this->redirect("index");
	}
	

	public function actionIndex($page = 1, $sort = "d", $filter = "d", $term = "") {
		
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
			case 's':
				$criteria->order = 'status_id, date_added DESC';
				break;
			default:
				$criteria->order = 'date_added DESC';
				break;
		}
		
		// get the adminIndexFilter session variable, which is just
		// a string, representing active filters, e.g. 'pder' would mean:
		// show [p]ublic, [d]rafts, [e]xpired and a[r]chived
		$adminIndexFilter = Yii::app()->session['adminindexfilter'];
		
		$_status_conditions = array();
		$_params = array();
		
		if (contains($adminIndexFilter, "p")) {
			array_push($_status_conditions, 'status_id=:public');
			$_params[':public'] = 2;
		}
		
		if (contains($adminIndexFilter, "d")) {
			array_push($_status_conditions, 'status_id=:draft');
			$_params[':draft'] = 1;
		}
		
		if (contains($adminIndexFilter, "r")) {
			array_push($_status_conditions, 'status_id=:archived');
			$_params[':archived'] = 3;
		}

		if (count($_status_conditions) > 0) {
			$_condition_string = '(' . trim(implode(" OR ", $_status_conditions)) . ')';
		} else {
			$_condition_string = "";
		}
				
		if (!contains($adminIndexFilter, "e")) {
			if ($_condition_string !== "") {
				$_condition_string .= ' AND expiration_date > :current_time';
			} else {
				$_condition_string .= 'expiration_date > :current_time';
			}
			$_params[':current_time'] = $current_time;
		}
		
		$criteria->condition = $_condition_string;
		$criteria->params = $_params;
		
		Yii::log("Rendering with condition: " . $_condition_string, CLogger::LEVEL_INFO, "actionIndex");

		// if we have a term query ...
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore());
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
			$criteria->limit = $this->items_per_page; # self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * $this->items_per_page; # self::PAGE_SIZE;;
			// $criteria->limit = self::PAGE_SIZE;
			// $criteria->offset = ($page - 1) * self::PAGE_SIZE;;
			
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
		} else {
			
			$total = count(Job::model()->findAll($criteria));

			// fix number of offers per page ...
			// fix number of offers per page ...
			$criteria->limit = $this->items_per_page; # self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * $this->items_per_page; # self::PAGE_SIZE;;
			// 
			// $criteria->limit = self::PAGE_SIZE;
			// $criteria->offset = ($page - 1) * self::PAGE_SIZE;;

			// just the default index action ...
			$models = Job::model()->findAll($criteria);
			
			$original_query = null;
		}

		$number_of_pages = ceil($total / self::PAGE_SIZE);
		
		$this->render('index', array(
			'models'=>$models, 
			'total' => $total,
			'page' => $page,
			'number_of_pages' => $number_of_pages,
			'sort' => $sort,
			'original_query' => $original_query) 
		);
	}
		
	/**
	 * Create a new job posting.
	 */
	public function actionCreate()
	{
		$model = new Job;

		if(isset($_POST['Job'])) {
			
			Yii::log("Company Homepage before adjustments: " . $_POST['Job']['company_homepage'], CLogger::LEVEL_INFO, "actionCreate");
			$company_homepage = $_POST['Job']['company_homepage'];
			if ($company_homepage != "" && !startsWith($company_homepage, "http://")) {
				$company_homepage = "http://" . $company_homepage;
				$_POST['Job']['company_homepage'] = $company_homepage;
			}
			Yii::log("Company Homepage after adjustments: " . $_POST['Job']['company_homepage'], CLogger::LEVEL_INFO, "actionCreate");
			
			$sanitized_post = array_strip_tags($_POST['Job'], '<br>');
			
			// $model->attributes = $_POST['Job']; // mass assignment
			$model->attributes = $sanitized_post; 
			$model->date_added = time();
			$model->job_version = $_POST['Job']['job_version'];
			
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

			$model->author_id = 0;

			$model->attachment=CUploadedFile::getInstance($model,'attachment');

			if ($model->validate()) {
				if ($model->save()) {
					if (isset($model->attachment)) {
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					$this->updateSearchIndex($model, "default");
					$this->updateSearchIndex($model, "admin");
					$this->updateSearchIndex($model, "api");
					
					$this->redirect(array('index'));
				}
			}
		}
		$this->render('create', array('model' => $model));
	}
	
	
	/**
	 * Update a new job posting.
	 */
	public function actionUpdate($id)
	{
		$model = Job::model()->findByPk($id);
		
		if (!$model) {
			Yii::log("No such model: " . $id, CLogger::LEVEL_INFO, "actionUpdate");
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}

		// store current value ...
		$model_attachment = $model->attachment;

		if(isset($_POST['Job']))
		{

			// Sanitize homepage URL ...
			$_POST['Job']['company_homepage'] = sanitize_url($_POST['Job']['company_homepage']);
			$sanitized_post = $_POST['Job']; // array_strip_tags($_POST['Job'], '<br>');

			// $model->attributes = $_POST['Job'];
			$model->attributes = $sanitized_post;
			
			// Keep the original date
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
			$model->author_id = 0; // default; TODO: adjust
			
			$model->attachment = CUploadedFile::getInstance($model, 'attachment');

			if ($model->attachment == null && isset($_POST['keep_file'])) {
				Yii::log("keep_file: " . $_POST['keep_file'], CLogger::LEVEL_INFO, __FUNCTION__);
				$model->attachment = $model_attachment;
			} else {
				$_POST['keep_file'] = false;
			}

			if ($model->validate()) {				
				if ($model->save()) {
					if (isset($model->attachment) && !$_POST['keep_file']) {
						
						Yii::log("Storing uploaded file...", CLogger::LEVEL_INFO, __FUNCTION__);
						
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					$this->updateSearchIndex($model, "default");
					$this->updateSearchIndex($model, "admin");
					$this->updateSearchIndex($model, "api");
					
					$this->redirect(array('admin/view', 'id' => $id));
				}
			}
		}
		
		$this->render('v' . $model->job_version . '/update', array('model' => $model));
	}
	
	public function actionSetStatus($id, $status_id) {
		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(400, Yii::t('app', 'Your request is not valid.'));
		}
		$previous_status_id = $model->status_id;
		$model->status_id = $status_id;
		$model->saveAttributes(array('status_id'));
		
		Yii::log("Changed status of job id " . $id . 
			" from " . $previous_status_id . 
			" to " . $model->status_id, 
			CLogger::LEVEL_INFO, __FUNCTION__);

		if ($model->status_id == 2 && isset($model->ukey) && $model->ukey != null) {
			// In debug mode for now
			// find the first row using the specified SQL statement
			$notification_event = EventLog::model()->findBySql("SELECT * FROM event_log WHERE name = :name AND message LIKE :message", 
				array('name' => 'job-activation-notification-sent', 'message' => '%job_id:' . $model->id . ";%"));
			
			if ($notification_event == null) {
				Yii::log("Preparing notification e-mail.", CLogger::LEVEL_INFO, __FUNCTION__);
				// send the actual e-mail
				$this->mailOnActivation($model);
				// create an entry in out event log
				
				Yii::log("Make a note in our event log.", CLogger::LEVEL_INFO, __FUNCTION__);
				$notification_event = new EventLog;
				$notification_event->timestamp = time();
				$notification_event->name = 'job-activation-notification-sent';
				$notification_event->message = 'job_id:' . $model->id . ";to:" . $model->publisher_email . ";";
				if ($notification_event->save()) {
					Yii::log("event_log saved.", CLogger::LEVEL_INFO, __FUNCTION__);
				} else {
					Yii::log("event_log FAILED.", CLogger::LEVEL_INFO, __FUNCTION__);
				}
			} else {
				Yii::log("This is a repost. Not sending out another message for now.", 
					CLogger::LEVEL_INFO, __FUNCTION__);
			}
		}
		
		$this->updateSearchIndex($model, "default");
		$this->updateSearchIndex($model, "admin");
		$this->updateSearchIndex($model, "api");
		
		$this->redirect(array('admin/view', 'id' => $id));
	}
	
	public function actionFeedback() {
		
		$criteria = new CDbCriteria;
		$criteria->order = 'date_added DESC';
		
		$models = Feedback::model()->findAll($criteria);
		$this->render('feedback', array('models' => $models));
	}

	/**
	 * Job details.
	 */
	public function actionView($id)
	{
		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
		}
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, "actionView");
		$this->render('v' . $model->job_version . '/view', array('model' => $model));
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
		$this->removeFromSearchIndex($model, "admin");
		
		if ($model->save(false)) {
			Yii::log("Set status of record id: " . $model->id . " to: " . $model->status_id . " (deleted)", CLogger::LEVEL_INFO, "default");	
		} else {
			Yii::log("Deleting failed on: " . $model->id, CLogger::LEVEL_INFO, "default");	
			throw new CHttpException(500, Yii::t('app', 'Your request is not valid.'));
		}

		$this->redirect(array('index'));
	}

	
	
	// Lucene related stuff ... //

	protected function removeFromSearchIndex($model, $useIndex = "default") {
		if ($useIndex === "admin") {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore(), false);
		} else {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore(), false);
		}
		
		foreach ($index->find('pk:' . $model->id) as $hit) {
    		$index->delete($hit->id);
		}		
	}
	
	public function actionRebuildAllSearchIndices() {
		
		Yii::log("Checking presence of directories ...", CLogger::LEVEL_INFO, __FUNCTION__);
		if (file_exists($this->getSearchIndexStore())) {
			Yii::log("[OK] => " . $this->getSearchIndexStore(), CLogger::LEVEL_INFO, __FUNCTION__);	
		} else {
			Yii::log("[EE] => " . $this->getSearchIndexStore() . " does not exist.", 
				CLogger::LEVEL_INFO, __FUNCTION__);
		}

		if (file_exists($this->getApiSearchIndexStore())) {
			Yii::log("[OK] => " . $this->getApiSearchIndexStore(), CLogger::LEVEL_INFO, __FUNCTION__);	
		} else {
			Yii::log("[EE] => " . $this->getApiSearchIndexStore() . " does not exist.", 
				CLogger::LEVEL_INFO, __FUNCTION__);

			$oldumask = umask(0);
			if (mkdir($this->getApiSearchIndexStore(), 0777)) {
				Yii::log("Successfully created " . $this->getApiSearchIndexStore() . " with mode 0777.", 
					CLogger::LEVEL_INFO, __FUNCTION__);
			} else {
				Yii::log("Failed to create directory: " . $this->getApiSearchIndexStore(), 
					CLogger::LEVEL_INFO, __FUNCTION__);
			}
			umask($oldumask);
		}

		if (file_exists($this->getAdminSearchIndexStore())) {
			Yii::log("[OK] => " . $this->getAdminSearchIndexStore(), CLogger::LEVEL_INFO, __FUNCTION__);	
		} else {
			Yii::log("[EE] => " . $this->getAdminSearchIndexStore() . " does not exist.", 
				CLogger::LEVEL_INFO, __FUNCTION__);
		}
		
		
		$this->rebuildSearchIndex("default");
		$this->rebuildSearchIndex("admin");
		// $this->rebuildSearchIndex("api");
		$this->redirect(array('index'));
	}
	
	public function actionRebuildSearchIndex($index = "default") {
		if ($index == "default" || $index == "admin" || $index == "api") {
			$this->rebuildSearchIndex($index);
		}
		$this->redirect(array('index'));
	}
	
	/**
	 * Rebuild search index.
	 */	
	public function rebuildSearchIndex($useIndex = "default") {
		
		$current_time = time();
		
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		
		if ($useIndex == "default") {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore(), true);
		} elseif ($useIndex == "api") {
			$index = new Zend_Search_Lucene($this->getApiSearchIndexStore(), true);
		} elseif ($useIndex == "admin") {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore(), true);
		}
		
		$criteria=new CDbCriteria;

		if ($useIndex == "default") {
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		} elseif ($useIndex == "api") {
			$criteria->condition = 'status_id=:status_id';
			$criteria->params=array(':status_id' => 2);			
		}

		$models = Job::model()->findAll($criteria);
		
		foreach ($models as $model) {

			if ($useIndex == "default") {
				// only include public and not expired 
				if ($model->status_id != 2 || $model->isExpired()) { continue; }
			}
			
			if ($useIndex == "api") {
				if ($model->status_id != 2) { continue; }
			}

			$doc = new Zend_Search_Lucene_Document();
 
			// store job primary key to identify it in the search results
			$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));

			// index job fields
			$doc->addField(Zend_Search_Lucene_Field::Text('id', $model->id, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('cc', purify($model->company, ''), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('title', $model->title, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('company', $model->company, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('in', $model->city, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('description', $model->description, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Text('shadowtags', $model->shadowtags, 'utf-8'));

			$index->addDocument($doc);
			
			Yii::log("Added document id: " . $model->id, 
				CLogger::LEVEL_INFO, __FUNCTION__);
		}

		$index->commit();
		
		// optimize index
		// http://framework.zend.com/manual/en/zend.search.lucene.best-practice.html#zend.search.lucene.best-practice.indexing-performance
		Yii::log("Optimizing index...", CLogger::LEVEL_INFO, __FUNCTION__);
		$index->optimize();
		
		Yii::log("Rebuild complete.", CLogger::LEVEL_INFO, __FUNCTION__);
	}
	
	public function mailOnActivation($model) {		
		if ($model->ukey == null || $model->ukey == '') { return; }
		$newline = chr(13) . chr(10);
		
		if (Yii::app()->request->serverPort == 80) {
			$serverPrefix = 'http://' . Yii::app()->request->serverName;
		} else {
			$serverPrefix = 'http://' . Yii::app()->request->serverName . ':' . Yii::app()->request->serverPort;
		}

		$to      = 'martin.czygan@gmail.com'; // for production: $model->publisher_email;
		$subject = '[Jobportal Universität Leipzig | Job ID ' . $model->id . '] Ihre Ausschreibung wurde veröffentlicht';

		$message = $this->renderPartial('_activation_notification_email', array('model' => $model, 'serverPrefix' => $serverPrefix), true);
		$headers = 'From: careercenter@uni-leipzig.de' . "\r\n" .
		$headers .= 'Reply-To: careercenter@uni-leipzig.de' . "\r\n" .
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/plain; charset=ISO-8859-1' . "\r\n";
		// $headers .= 'Content-Transfer-Encoding: 8bit'. "\n\r\n";

		Yii::log("Message:\n" . $message, CLogger::LEVEL_INFO, __FUNCTION__);

		if (mail($to, $subject, $message, $headers)) {
			Yii::log("Notification-Mail queued. " . $to, CLogger::LEVEL_INFO, __FUNCTION__);
		} else {
			Yii::log("Notification-Mail NOT queued.", CLogger::LEVEL_INFO, __FUNCTION__);
		}
	}

}
