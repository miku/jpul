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
		
		Yii::log($adminIndexFilter . ", filter = " . $filter, CLogger::LEVEL_INFO, "actionFilter");

		if (contains($adminIndexFilter, $filter)) {
			$adminIndexFilter = str_replace($filter, "", $adminIndexFilter);
		} else {
			$adminIndexFilter .= $filter;
		}

		Yii::log($adminIndexFilter, CLogger::LEVEL_INFO, "actionFilter");		
		Yii::app()->session['adminindexfilter'] = $adminIndexFilter;

		$this->redirect("index");
	}
	

	public function actionIndex($page = 1, $sort = "d", $filter = "pd", $term = "") {
		
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
		
		Yii::log($_condition_string, CLogger::LEVEL_INFO, "actionIndex");

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
			$current_start = ($page - 1) * self::PAGE_SIZE;;
			$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;
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
		$current_start = ($page - 1) * self::PAGE_SIZE;;
		$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;
		
		$this->render('index', array(
			'models'=>$models, 
			'total' => $total,
			'current_start' => $current_start, 
			'current_end' => $current_end,
			'page' => $page,
			'number_of_pages' => $number_of_pages,
			'sort' => $sort) 
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
					$this->updateSearchIndex($model);
					$this->updateSearchIndex($model, "admin");
					
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
			$model->date_added = time();

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
					$this->updateSearchIndex($model);
					$this->updateSearchIndex($model, "admin");
					$this->redirect(array('index'));
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
		$model->status_id = $status_id;
		$model->save();
		
		$this->updateSearchIndex($model);
		$this->updateSearchIndex($model, "admin");
		
		$this->redirect(array('admin/view', 'id' => $id));
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
		$this->actionRebuildSearchIndex("default");
		$this->actionRebuildSearchIndex("admin");
	}
	
	/**
	 * Rebuild search index.
	 */	
	public function actionRebuildSearchIndex($useIndex = "default") {
		
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		

		if ($useIndex === "admin") {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore(), true);
		} else {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore(), true);
		}
		
		$criteria=new CDbCriteria;

		if ($useIndex !== "admin") {
			$criteria->condition = 'status_id=:status_id';
			$criteria->params=array(':status_id'=>2);
		}

		$models = Job::model()->findAll($criteria);
		
		foreach ($models as $model) {

			if ($useIndex !== "admin") {
				// only include public and not expired 
				if ($model->status_id != 2 || $model->isExpired()) { continue; }
			}

			$doc = new Zend_Search_Lucene_Document();
 
			// store job primary key to identify it in the search results
			$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));

			// index job fields
			$doc->addField(Zend_Search_Lucene_Field::UnStored('id', $model->id, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('cc', purify($model->company, ''), 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('title', $model->title, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('company', $model->company, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('in', $model->city, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $model->description, 'utf-8'));

			$index->addDocument($doc);
			
			Yii::log("Added document id: " . $model->id, CLogger::LEVEL_INFO, "actionRebuildSearchIndex");
		}

		$index->commit();
		$this->redirect(array('index'));
	}
}
