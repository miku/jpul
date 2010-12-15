<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports


/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	// public $layout='//layouts/column1';
	public $layout='//layouts/v2/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
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
				throw new CHttpException(400, Yii::t('app','Your request is not valid.'));
			}
		} else {
			throw new CHttpException(400, Yii::t('app','Your request is not valid.'));
		}
		return $filterChain->run();
	}	
	
	protected function beforeAction($action) {
		
		
		// simple request tracking ...
		try {
			$request = new Request();
			$request->addr = $_SERVER["REMOTE_ADDR"];
			$request->request_time = time();
			$request->user_agent = $_SERVER["HTTP_USER_AGENT"];
			$request->request_path = $_SERVER['REQUEST_URI'];
			$request->save();
		} catch (Exception $e) {
			Yii::log("failed to record request: " . $e, CLogger::LEVEL_INFO, "beforeAction");
		}
		
		CHtml::$afterRequiredLabel = '';
		
		Yii::log("beforeAction: " . $action->getId(), CLogger::LEVEL_INFO, "beforeAction");

		if (isset($_GET['uselayout'])) {
			Yii::app()->session['uselayout'] = $_GET['uselayout'];
		}
		
		if (isset(Yii::app()->session['uselayout'])) {
			$this->layout = "//layouts/" . Yii::app()->session['uselayout'];
		}
		
		Yii::log("Layout now: " . Yii::app()->layout, CLogger::LEVEL_INFO, "beforeAction");
		return parent::beforeAction($action);
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
	

	public function getUploadFileSize($modelName, $id, $extension = 'pdf')
	{
		$filepath = $this->getUploadFilePath($modelName, $id, $extension);
		if (file_exists($filepath)) {
			return formatBytes(filesize($filepath));
		} else {
			// return "Could not determine size for: $filepath";
			return "";
		}
	}
	
	
	/**
	 * Get the path to the uploaded job attachments.
	 * @return Job attachments upload path
	 */
	public function getSearchIndexStore()
	{
		return Yii::app()->basePath . '/runtime/search';
	}
	
	public function getAdminSearchIndexStore() {
		return Yii::app()->basePath . '/runtime/adminsearch';
	}

	
	/**
	 * Update search index.
	 */	
	protected function updateSearchIndex($model, $useIndex = "default") {
		
		if ($useIndex === "admin") {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore(), false);
		} else {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore(), false);
		}

		foreach ($index->find('pk:' . $model->id) as $hit) {
    		$index->delete($hit->id);
		}

		if ($useIndex !== "admin") {
			if ($model->status_id != 2 || $model->isExpired()) { return; }
		}
		
		$doc = new Zend_Search_Lucene_Document();
		// store job primary key to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));
		// index job fields
		$doc->addField(Zend_Search_Lucene_Field::UnStored('position', $model->title, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('company', $model->company, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('location', $model->city, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $model->description, 'utf-8'));
		
		$doc->addField(Zend_Search_Lucene_Field::UnStored('sector', $model->sector, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('study', $model->study, 'utf-8'));

		$index->addDocument($doc);
		$index->commit();
		Yii::log("Updated search index for document id: " . $model->id, CLogger::LEVEL_INFO, "updateSearchIndex");		
	}


	
}