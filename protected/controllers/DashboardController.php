<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class DashboardController extends Controller
{
	
	// jobs per page, defaults to 30
	const PAGE_SIZE = 20; // unused TODO

	/**
	 * Yii filters
	 * @return Our request filters
	 */
	public function filters()
	{
		return array('adminOnly');
	}

	public function actionIndex($page = 1) {
				
		$criteria = new CDbCriteria;
		$criteria->order = 'date_added DESC';
		$criteria->condition = 'status_id = :1';
		$criteria->params = array(':1' => 1);
		
		// get the adminIndexFilter session variable, which is just
		// a string, representing active filters, e.g. 'pder' would mean:
		// show [p]ublic, [d]rafts, [e]xpired and a[r]chived
		$adminIndexFilter = Yii::app()->session['adminindexfilter'];
		
		$this->items_per_page = 1000;
		
		$criteria->limit = $this->items_per_page; 
		$criteria->offset = ($page - 1) * $this->items_per_page;
		$models = Job::model()->findAll($criteria);
		
		$this->render('index', array('models'=>$models));
	}

}
