<?php

// Zend Lucene Imports
Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php');

// Textile subset
Yii::import('application.helpers.*');
require_once('Utils.php');

class JobController extends Controller
{
	// jobs per page, defaults to 30
	const PAGE_SIZE = 30;
	// 6 * 7 * 24 * 60 * 60 = six weeks
	const DEFAULT_EXPIRATION_SECONDS = 3628800; 		
	
	
	// public function textilize($text) {
	// 	$t = new TextiLite;
	// 	return $t->process($text);
	// }

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
	 * @return Job attachments upload path
	 */
	public function getUploadPath()
	{
		return Yii::app()->basePath . '/../uploads';
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
	 * Cut the text, without splitting within words.
	 * @param string the text to be splitted
	 * @param integer cut to this length (maximum)
	 * @param string replacement, defaults to '...'
	 * @return Job attachments upload path
	 */
	public static function limitText($string, $length, $replacer = '...') 
	{ 
		if(strlen($string) > $length) 
			return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer; 
		return $string; 
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
	 * Simple authentication filter. Make sure the user has the role 'admin'
	 * @return Result of the filter chain
	 */
	public function filterAdminOnly($filterChain)
	{	
		$userId = Yii::app()->user->getId();
		if (isset($userId)) {
			$user = User::model()->findByPk($userId);

			Yii::log("User role: " . $user->role, CLogger::LEVEL_INFO, "filterAdminOnly");

			if ($user->role != 'admin') {
				throw new CHttpException(400, Yii::t('yii','Your request is not valid.'));
			}
		} else {
			throw new CHttpException(400, Yii::t('yii','Your request is not valid.'));
		}
		return $filterChain->run();
	}	

	/**
	 * Index action. Default page is 0.
	 */
	public function actionIndex($page = 1) {
		
		if ($page < 1) {
			$this->redirect(array('index', 'page' => 1));
		}
		
		$criteria = new CDbCriteria;
		$criteria->order = 'date_added DESC';
		$criteria->condition = 'status_id=:status_id';
		$criteria->params=array(':status_id' => 2);

		$total = count(Job::model()->findAll($criteria));
		
		$criteria->limit = self::PAGE_SIZE;
		$criteria->offset = ($page - 1) * self::PAGE_SIZE;;

		$models = Job::model()->findAll($criteria);
		
		$current_start = ($page - 1) * self::PAGE_SIZE;;
		$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;

		$this->render('index', array(
			'models'=>$models, 
			'total' => $total,
			'current_start' => $current_start, 
			'current_end' => $current_end,
			'page' => $page) );
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
			throw new CHttpException(400, Yii::t('yii', 'Your request is not valid.'));
		}
	}

	/**
	 * Create a new job posting.
	 */
	public function actionCreate()
	{
		$model = new Job;

		if(isset($_POST['Job'])) {
			
			$sanitized_post = array_strip_tags($_POST['Job']);
			
			// $model->attributes = $_POST['Job']; // mass assignment
			$model->attributes = $sanitized_post; 
			$model->date_added = time();
			$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
			$model->author_id = 0;

			$model->attachment=CUploadedFile::getInstance($model,'attachment');

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
		$this->render('create', array('model' => $model));
	}

	/**
	 * Update a new job posting.
	 */
	public function actionUpdate($id)
	{
		$model = Job::model()->findByPk($id);
		
		if (!$model) {
			throw new CHttpException(400, Yii::t('yii', 'Your request is not valid.'));
		}

		if(isset($_POST['Job']))
		{

			$sanitized_post = array_strip_tags($_POST['Job']);

			// $model->attributes = $_POST['Job'];			
			$model->attributes = $sanitized_post;
			$model->date_added = time();
			$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
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
			throw new CHttpException(400, Yii::t('yii', 'Your request is not valid.'));
		}
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, "actionView");
		$this->render('view', array('model' => $model));
	}

	/**
	 * Delete a job, it just gets archived.
	 */
	public function actionDelete($id)
	{
		$model = Job::model()->findByPk($id);

		if (!$model) {
			throw new CHttpException(400, Yii::t('yii', 'Your request is not valid.'));
		}
		$model->status_id = 4;
		if ($model->save(false)) {
			Yii::log("Set status of record id: " . $model->id . " to: " . $model->status_id . " (deleted)", CLogger::LEVEL_INFO, "default");	
		} else {
			Yii::log("Deleting failed on: " . $model->id, CLogger::LEVEL_INFO, "default");	
			throw new CHttpException(500, Yii::t('yii', 'Your request is not valid.'));
		}
		
		
		$this->redirect(array('index'));
	}

	
	/**
	 * Search jobs.
	 */	
	public function actionSearch($page = 1) 
	{
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

			$criteria = new CDbCriteria;
			$criteria->order = 'date_added DESC';
			$criteria->condition = 'status_id=:status_id';
			$criteria->params=array(':status_id' => 2);

			$total = count($models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria));

			$criteria->limit = self::PAGE_SIZE;
			$criteria->offset = ($page - 1) * self::PAGE_SIZE;;
			
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
			
			$current_start = ($page - 1) * self::PAGE_SIZE;;
			$current_end = ($page - 1) * self::PAGE_SIZE + self::PAGE_SIZE;
	
        	$this->render('index', array(
				'models' => $models, 
				'total' => $total,
				'current_start' => $current_start,
				'current_end' => $current_end,
				'page' => $page,
				'original_query' => $original_query));
		} else {
			$this->redirect(array('index'));
		}
	}

	/**
	 * Update search index.
	 */	
	protected function updateSearchIndex($model) {
		
		$index = new Zend_Search_Lucene($this->getSearchIndexStore(), false);
		foreach ($index->find('pk:' . $model->id) as $hit) {
    		$index->delete($hit->id);
		}
		
		$doc = new Zend_Search_Lucene_Document();
		// store job primary key to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));
		// index job fields
		$doc->addField(Zend_Search_Lucene_Field::UnStored('position', $model->title, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('company', $model->company, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('location', $model->city, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $model->description, 'utf-8'));

		$index->addDocument($doc);
		$index->commit();
		Yii::log("Updated search index for document id: " . $model->id, CLogger::LEVEL_INFO, "updateSearchIndex");		
	}

	
	/**
	 * Rebuild search index.
	 */	
	public function actionRebuildSearchIndex() {

		$index = new Zend_Search_Lucene($this->getSearchIndexStore(), true);
		
		$criteria=new CDbCriteria;
		$criteria->condition = 'status_id=:status_id';
		$criteria->params=array(':status_id'=>2);
		$models = Job::model()->findAll($criteria);
		
		foreach ($models as $model) {

			$doc = new Zend_Search_Lucene_Document();
 
			// store job primary key to identify it in the search results
			$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));

			// index job fields
			$doc->addField(Zend_Search_Lucene_Field::UnStored('position', $model->title, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('company', $model->company, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('location', $model->city, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $model->description, 'utf-8'));

			$index->addDocument($doc);
			
			Yii::log("Added document id: " . $model->id, CLogger::LEVEL_INFO, "actionRebuildSearchIndex");
		}

		$index->commit();
		$this->redirect(array('index'));
	}
	
} // EOF


