<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class AlertController extends Controller
{
	
	public function actionCreate($aq = null) {
		
		$models = null;
		$total = null;
		
		if ($aq != null) {
			
			$current_time = time();
			$criteria = new CDbCriteria;		
			// just show the public offers, which are not expired ...
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
			
			$index = new Zend_Search_Lucene($this->getSearchIndexStore());
			Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);

			$original_query = $aq;
			$query = $original_query;

			
			Yii::log("Q: " . $query, CLogger::LEVEL_INFO, __FUNCTION__);
			
			try {
				$results = $index->find($query);
			} catch (Exception $e) {
				Yii::log("Failed Query: '" . $query . "' - Exception: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
				$this->redirect(array('index'));
			}

			$pks = array();
 			foreach ($results as $result) {
				$pks[] = $result->pk;
			}

			$total = count(Job::model()->cache(600)->findAllByAttributes(array('id' => $pks), $criteria));

			$criteria->limit = 10;
			$criteria->offset = 0;

			$models = Job::model()->cache(600)->findAllByAttributes(array('id' => $pks), $criteria);
		}	

		$this->render('create', array("aq" => $aq, "models" => $models, "total" => $total));
		
	}
	
} // EOF

