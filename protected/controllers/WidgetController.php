<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');
require_once('SearchHub.php');


class WidgetController extends Controller
{
	public function actionIndex() {
		$original_query = null;
		$width = null;
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$original_query = detoxify(strip_tags($_GET['q']));
		}
		if (isset($_GET['width']) && $_GET['width'] != '') {
			$width = detoxify(strip_tags($_GET['width']));
		}
		$this->layout = 'plain';
		$this->render('index', 
			array('original_query' => $original_query, 'width' => $width));
	}
	
	public function actionBeta() {
		$original_query = null;
		$width = null;
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$original_query = detoxify(strip_tags($_GET['q']));
		}
		if (isset($_GET['width']) && $_GET['width'] != '') {
			$width = detoxify(strip_tags($_GET['width']));
		}
		$this->layout = 'plain';
		$this->render('beta', 
			array('original_query' => $original_query, 'width' => $width));
	}


	public function actionGetJSONP($q = null, $tab = 'all', $limit = 10, $callback = 'ccul_widget_callback') {
		Yii::log("Widget-Request from " . isset($_SERVER["REMOTE_ADDR"]) 
			? $_SERVER["REMOTE_ADDR"] : '', CLogger::LEVEL_INFO, __FUNCTION__);

		$result = $this->getModelsAndOriginalQuery(urldecode($q), $tab, $limit);
		$models = $result["models"];
		$original_query = $result["original_query"];
		
		// turn the query result into an array, with only the key we actually
		// need for the widget
		$stripped = array();
		foreach ($models as $key => $value) {
			$stripped[$key] = array(
				"id" => $value["id"],
				"title" => $value["title"],
				"date_added" => strftime("%d.%m.%Y", $value["date_added"])
			);
		}

		$this->layout = 'plain';
		$this->render('getJSONP', array(
			'models' => $stripped, 
			'original_query' => $original_query,
			'callback' => $callback)
		);		
	}

	
	public function actionGetJSON($q = null, $tab = 'all', $limit = 10) {
		Yii::log("Widget-Request from " . isset($_SERVER["REMOTE_ADDR"]) 
			? $_SERVER["REMOTE_ADDR"] : '', CLogger::LEVEL_INFO, __FUNCTION__);

		$result = $this->getModelsAndOriginalQuery(urldecode($q), $tab, $limit);
		$models = $result["models"];
		$original_query = $result["original_query"];
		
		// turn the query result into an array, with only the key we actually
		// need for the widget
		$stripped = array();
		foreach ($models as $key => $value) {
			$stripped[$key] = array(
				"id" => $value["id"],
				"title" => $value["title"],
				"date_added" => strftime("%d.%m.%Y", $value["date_added"])
			);
		}

		$this->layout = 'plain';
		$this->render('getJSON', array(
			'models' => $stripped, 
			'original_query' => $original_query)
		);		
	}
	
	public function actionGet($q = null, $tab = 'all', $limit = 10) {
		Yii::log("HTML-Widget-Request from " . isset($_SERVER["REMOTE_ADDR"]) 
			? $_SERVER["REMOTE_ADDR"] : '', CLogger::LEVEL_INFO, __FUNCTION__);
		$result = $this->getModelsAndOriginalQuery($q, $tab, $limit);		
		$this->layout = 'plain';
		$this->render('get', array(
			'models' => $result["models"], 
			'original_query' => $result["original_query"])
		);		
	}
	
	protected function getModelsAndOriginalQuery($q = null, $tab = 'all', $limit = 15) {

		$current_time = time();
		$original_query = '';

		// Determine the view to use ...
		$viewName = "default";

		if ($q != null && $q != '') {
			$viewName = "search";
		} 
		
		if (!is_numeric($limit)) {
			$limit = 15;
		} elseif ($limit > 50 || $limit < 3) {
			$limit = 15;
		}

		if ($viewName == "search") {
			$original_query = $q;

			// If the user does not use anything from the extended search
			// syntax, append kleene star to terms
			if (preg_match("/( OR | AND |\"|:|~|-|\*| NOT )/", $original_query) == 0) {
			    $query = trim($original_query) . '*';
			    $query = preg_replace("/\s+/", "* ", $query);
			} else {
			    $query = $original_query;
			}

			// Correct the user input to the query we are actually executing.
			$original_query = $query;

			$options = array("q" => $query, "tab" => $tab);
			$options["offset"] = 0;
            $options["limit"] = $limit;

			$result = getResultSetAndSize($options);
			$models = $result["models"];

		} elseif ($viewName == "default") {

			$criteria = new CDbCriteria;
			$criteria->order = 'date_added DESC';	
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
			$criteria->limit = $limit;
			
			$models = Job::model()->findAll($criteria);
		}
		return array("models" => $models, "original_query" => $original_query);
	}

}

?>
