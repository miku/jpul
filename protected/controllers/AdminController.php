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
	const PAGE_SIZE = 20;
	// 6 * 7 * 24 * 60 * 60 = six weeks
	const DEFAULT_EXPIRATION_SECONDS = 3628800; 	

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

		$total = count(Job::model()->findAll($criteria));
		
		$number_of_pages = ceil($total / self::PAGE_SIZE);
		
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
			
			$sanitized_post = array_strip_tags($_POST['Job']);
			
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
					$this->redirect(array('index'));
				}
			}
		}
		$this->render('create', array('model' => $model));
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
}
