<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class ApiController extends Controller
{
	
	const LAST_MODIFIED = 1303681634;
	const MAX_SIZE = 400;

	public function actionIndex() {		
		$this->layout = 'v2/plain';
		$this->render('index');
	}
	
	public function actionVersion() {
		$this->layout = 'v2/plain';
		$this->render('version', array('date' => self::LAST_MODIFIED));
	}

	public function actionSummary() {
		
		$current_time = time();
		$data = array();
		
		$sql = "select count(*) as job_count from job where status_id = 2";
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['jobs'] = $dataReader['job_count'];

		$sql = "select count(*) as active_job_count from job where status_id = 2 and expiration_date > " . $current_time;
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['active_jobs'] = $dataReader['active_job_count'];


		// $sql = "select count(*) as request_count from request";
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['requests'] = $dataReader['request_count'];

		// $sql = "select count(*) as request_count from request where request_time > " . ($current_time - 86400);
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['requests_24h'] = $dataReader['request_count'];
		// 
		// $sql = "select count(*) as request_count from request where request_time > " . ($current_time - 604800);
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['requests_7d'] = $dataReader['request_count'];

		$sql = "select count(*) as request_count from request where request_time > " . ($current_time - 2592000);
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['requests_30d'] = $dataReader['request_count'];

		// $sql = "select count(distinct tracking_id) as tid from request";
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['visitors'] = $dataReader['tid'];

		// $sql = "select count(distinct tracking_id) as tid from request where request_time > " . ($current_time - 86400);
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['visitors_24h'] = $dataReader['tid'];
		// 
		// $sql = "select count(distinct tracking_id) as tid from request where request_time > " . ($current_time - 604800);
		// Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		// $connection = Yii::app()->db;
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->queryRow();
		// $data['visitors_7d'] = $dataReader['tid'];

		$sql = "select count(distinct tracking_id) as tid from request where request_time > " . ($current_time - 2592000);
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['visitors_30d'] = $dataReader['tid'];

		$sql = "select request_time as first_request from request order by request_time limit 1";
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['first_request'] = $dataReader['first_request'];

		$sql = "select request_time as last_request from request order by request_time desc limit 1";
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['last_request'] = $dataReader['last_request'];

		$sql = "select request_time as last_request from request order by request_time desc limit 1";
		Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryRow();
		$data['last_request'] = $dataReader['last_request'];

		
		$this->layout = 'v2/plain';
		$this->render('summary', array('data' => $data));		
	}

	public function actionJobs(
		$since_id = null, 
		$max_id = null, 
		$since_ts = null,
		$max_ts = null, 
		$q = null, 
		$size = self::MAX_SIZE, 
		$expired = false) {

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
		
		$current_time = time();
		$criteria = new CDbCriteria;
		
		if ($size < 0 || $size > self::MAX_SIZE) {
			throw new CHttpException(404, Yii::t('app', 'Wrong size parameter. Must be between 1 and 100.'));
		}

		// just show the public offers, which are not expired ...
		if ($expired == 'true' || $expired == true 
			|| $expired == 1 || $expired == '1') {
			$expired = true;			
			$criteria->condition = 'status_id=:status_id';
			$criteria->params=array(':status_id' => 2);
		} else {
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		}
		
		$criteria->limit = $size;

		// Determine the 'view' to use ...
		if ($q == null) {
			$viewName = "default";
		} else {
			$viewName = "search";
		}



		$criteria->order = 'date_added DESC';
		
		if ($max_id != null) {
			$criteria->order = 'id DESC';
			$criteria->condition .= ' AND id < :max_id';				
			$criteria->params[':max_id'] = $max_id;
		}
		
		if ($since_id != null) {
			$criteria->order = 'id';				
			$criteria->condition .= ' AND id > :since_id';				
			$criteria->params[':since_id'] = $since_id;
		}

		if ($max_ts != null) {
			$criteria->order = 'date_added DESC';
			$criteria->condition .= ' AND date_added < :max_ts';				
			$criteria->params[':max_ts'] = $max_ts;
		}
		
		if ($since_ts != null) {
			$criteria->order = 'date_added';				
			$criteria->condition .= ' AND date_added > :since_ts';				
			$criteria->params[':since_ts'] = $since_ts;
		}

		if ($viewName == "default") {

			$models = Job::model()->findAll($criteria);
			
		}

		// if we have a term query ...
		if ($viewName == "search") {
			
			if ($expired) {
				$index = new Zend_Search_Lucene($this->getApiSearchIndexStore());
			} else {
				$index = new Zend_Search_Lucene($this->getSearchIndexStore());
			}
			
			$original_query = $q;

			if (preg_match("/( OR | AND |\"|:|~|-|\*| NOT )/", $original_query) == 0) {
				$query = trim($original_query) . '*';
				$query = preg_replace("/\s+/", "* AND ", $query);
			} else {
				$query = $original_query;
			}
			
			try {
				$results = $index->find($query);
			} catch (Exception $e) {
				Yii::log("Failed Query: '" . $query . "' - Exception: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
				throw new CHttpException(500, Yii::t('app', 'Search Query failed.'));
			}

			$pks = array();
 			foreach ($results as $result) {
				$pks[] = $result->pk;
			}

			// $total = count(Job::model()->findAllByAttributes(array('id' => $pks), $criteria));
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);

		}
		
		
		$this->layout = 'v2/plain';
		$this->render('jobs', array('models' => $models));			
		
	}
	
	public function actionJob($id) {
		$model = Job::model()->findByPk($id);
		
		if (!$model) {
			throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
		}

		if ($model->status_id != 2) {
			throw new CHttpException(404, 'Kein Angebot mit dieser ID gefunden.');
		}
		
		try {
			// $sql = "select distinct COUNT(tracking_id) as view_count 
			// from request where (tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL 
			// AND request_uri_wo_qs_and_hostname = '" . $this->createUrl('job/view', array("id" => $id)) . "';";

			$sql = "select count(*) as view_count from (
				select distinct tracking_id, request_uri_wo_qs_and_hostname from 
				request where
					(tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL AND
            		request_uri_wo_qs_and_hostname LIKE '%". $this->createUrl('job/view', array("id" => $id)) . "') as Q;";

			Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
			
			// Yii::log($sql, CLogger::LEVEL_INFO, "actionView");
			
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$dataReader = $command->queryRow();
			$view_count = $dataReader['view_count'];
		} catch (Exception $e) {
			Yii::log($e, CLogger::LEVEL_INFO, __FUNCTION__);
			$view_count = null;
		}

		$this->layout = 'v2/plain';
		$this->render('job', array('model' => $model, 'view_count' => $view_count));
	}
}

?>