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
	
	// The number of items per page (only 10, 20 or 50 as possible at the moment!)
	public $items_per_page = 10;
	
	/**
	 * Simple authentication filter. Make sure the user has the role 'admin'
	 * @return Result of the filter chain
	 */
	public function filterAdminOnly($filterChain)
	{	
		$userId = Yii::app()->user->getId();
		if (isset($userId)) {
			$user = User::model()->findByPk($userId);
			Yii::log("User role: " . $user->role, CLogger::LEVEL_INFO, __FUNCTION__);
			if ($user->role != 'admin') {
				throw new CHttpException(400, Yii::t('app','Your request is not valid.'));
			}
		} else {
			throw new CHttpException(400, Yii::t('app','Your request is not valid.'));
		}
		return $filterChain->run();
	}	
	
	protected function beforeAction($action) {

		Yii::log("Entering beforeAction: " . $action->getId(), CLogger::LEVEL_INFO, __FUNCTION__);		

		// // See if the user agent is Googlebot and
		// // try to avoid ugly URLs like
		// // wwwdup.uni-leipzig.de/jobportal/index.php/job/137?PHPSESSID ...
		// $isGoogle = stripos($_SERVER['HTTP_USER_AGENT'], 'Googlebot');
		// // If it is, use ini_set to only allow cookies for the session variable
		// if ($isGoogle !== false) {
		// 	Yii::log("Hello Googlebot!", CLogger::LEVEL_INFO, __FUNCTION__);
		// 	ini_set('session.use_only_cookies', '1');
		// 	// experimental ...
		// 	ini_set('session.use_trans_sid', false);
		// 	ini_set("url_rewriter.tags",""); 			
		// } 
		// 
		// // No '*' after required fields
		// CHtml::$afterRequiredLabel = '';
		
		// This section provides a helper GET parameter, to test new views
		// Simply put ?useLayout=<layoutname> into your request url, to 
		// switch over to a new view for this session.
		// <layoutname> should be 16 chars long or less.

		if (isset($_GET['useLayout'])) {
			Yii::app()->session['useLayout'] = $_GET['useLayout'];
		}
		if (isset(Yii::app()->session['useLayout'])) {
			$useLayout = Yii::app()->session['useLayout'];
			if (preg_match("/[a-zA-z\/]{1,16}/", $useLayout)) {
				Yii::log("Setting Layout for this session to " . $useLayout, 
					CLogger::LEVEL_INFO, __FUNCTION__);
				$this->layout = "//layouts/" . $useLayout;
			} else {
				$this->layout = "//layouts/v2/main";
			}
		}
		
		// Adjust items per page
		if (isset($_GET['size'])) {
			$allowed = array("10", "20", "50");
			if (in_array($_GET['size'], $allowed)) {
				Yii::app()->session['items_per_page'] = $_GET['size'];
			} else {
				Yii::app()->session['items_per_page'] = 10;
			}
		}
		if (isset(Yii::app()->session['items_per_page'])) {
			$items_per_page = Yii::app()->session['items_per_page'];			
			if (preg_match("/[\d]{1,3}/", $items_per_page)) {
				Yii::log("Setting items_per_page for this session to " . $items_per_page, 
					CLogger::LEVEL_INFO, __FUNCTION__);
				$this->items_per_page = $items_per_page;
			} else {
				$this->items_per_page = $items_per_page;
			}
		}
		
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

	public function getApiSearchIndexStore() {
		return Yii::app()->basePath . '/runtime/apisearch';
	}

	
	/**
	 * Update search index.
	 */	
	protected function updateSearchIndex($model, $useIndex = "default") {
		
		Yii::log("Updating lucene search index <" . $useIndex . "> ...", 
			CLogger::LEVEL_INFO, __FUNCTION__);
		
		if ($useIndex == "admin") {
			$index = new Zend_Search_Lucene($this->getAdminSearchIndexStore(), false);
		} elseif ($useIndex == "api") {
			$index = new Zend_Search_Lucene($this->getApiSearchIndexStore(), false);
		} elseif ($useIndex == "default") {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore(), false);
		} else {
			Yii::log("Unknown search index requested: " . $useIndex, 
				CLogger::LEVEL_INFO, __FUNCTION__);
			return;
		}
	
		foreach ($index->find('pk:' . $model->id) as $hit) {
			$index->delete($hit->id);
		}

		if ($useIndex == "api") {
			if ($model->status_id != 2) { 
				Yii::log("No index changes needed in index <" . $useIndex . "> since job is not public.", 
					CLogger::LEVEL_INFO, __FUNCTION__);
				return; 
			}
		}
	
		if ($useIndex == "default") {
			if ($model->status_id != 2 || $model->isExpired()) { 
				Yii::log("No index changes needed in index <" . $useIndex . "> since job is neither public nor expired.", 
					CLogger::LEVEL_INFO, __FUNCTION__);
				return; 
			}
		}
		
		$doc = new Zend_Search_Lucene_Document();
		// store job primary key to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $model->id));
		// index job fields
		$doc->addField(Zend_Search_Lucene_Field::UnStored('cc', purify($model->company, ''), 'utf-8'));		
		$doc->addField(Zend_Search_Lucene_Field::UnStored('title', $model->title, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('company', $model->company, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('city', $model->city, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $model->description, 'utf-8'));
		
		$doc->addField(Zend_Search_Lucene_Field::UnStored('sector', $model->sector, 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('study', $model->study, 'utf-8'));
	
		$index->addDocument($doc);
		$index->commit();
		
		Yii::log("Optimizing index...", CLogger::LEVEL_INFO, __FUNCTION__);
		$index->optimize();
		
		Yii::log("Updated <" . $useIndex . "> search index for document id: " . $model->id, CLogger::LEVEL_INFO, __FUNCTION__);		
	}
	

	
}