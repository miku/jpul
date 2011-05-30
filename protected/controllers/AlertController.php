<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class AlertController extends Controller
{
	
	public function create_queue_entries_for_job($id) {
		$alerts = Alert::model()->findAll();
		foreach ($alerts as $alert) {
			$queueEntry = new QueueEntry;
			$queueEntry->priority = 1;
			$queueEntry->func = "check_if_match";
			$queueEntry->args = $alert->id . ", " . $id;
			$queueEntry->date_added = time();
		}
	}

	public function delete_queue_entries_for_job($id) {
		$queueEntries = QueueEntry::model()->findAll();
		foreach ($queueEntries as $queueEntry) {
			if ($queueEntry->func == 'check_if_match' && 
				$queueEntry->args == $id) {
					$queueEntry->delete();
			}
		}
	}

	public function check_if_match($alert_id, $job_id) {
		Yii::log("Inside check_if_match: " . $alert_id . ", " . $job_id, 
			CLogger::LEVEL_INFO, __FUNCTION__);
	}
	
	public function actionCreated() {
		$this->render('created');
	}
	
	public function actionVerify($id) {
		
	}
		
	public function actionCreate($aq = null) {
		
		$models = null;
		$total = null;
		$alert = new Alert;
		$captcha_error = false;
		
		if (isset($_POST['Alert'])) {
			$alert->attributes = $_POST['Alert']; // mass assignment
			$alert->date_added = time();
			$alert->alert_key = gen_uuid(); // used for verification and cancelation
			if ($alert->validate()) {
				if (captcha_passed($_POST) && $alert->save()) {
					Yii::log("Captcha passed. Model saved.", CLogger::LEVEL_INFO, __FUNCTION__);					
					// send verification email here ...
					$this->redirect(array('alert/created'));
				} else {
					$captcha_error = true;
				}
			}
		} 

		if ($aq != null) {

			Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    			new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
			Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
			Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);

			$current_time = time();
			$criteria = new CDbCriteria;		
			// just show the public offers, which are not expired ...
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		
			$index = new Zend_Search_Lucene($this->getSearchIndexStore());

			$original_query = $aq;
			$query = $original_query;
		
			Yii::log("Q: " . $query, CLogger::LEVEL_INFO, __FUNCTION__);
		
			try {
				$results = $index->find($query);
			} catch (Exception $e) {
				Yii::log("Failed Query: '" . $query . "' - Exception: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
				$this->redirect(array('job/index'));
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

		$this->render('create', array(
			"aq" => $aq, 
			"alert" => $alert,
			"captcha_error" => $captcha_error,
			"models" => $models, 
			"total" => $total));
		
	}
	
} // EOF

