<?php
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
		// try {
			$request = new Request();
			$request->addr = $_SERVER["REMOTE_ADDR"];
			$request->request_time = time();
			$request->user_agent = $_SERVER["HTTP_USER_AGENT"];
			$request->request_path = $_SERVER['REQUEST_URI'];
			$request->save();
		// } catch (Exception $e) {
		// 	// die gracefully ... 
		// }
		
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

	
}