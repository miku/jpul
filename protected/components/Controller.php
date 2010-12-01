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
	public $layout='//layouts/main';
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

	
}