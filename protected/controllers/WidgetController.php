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
	
	public function actionGet($tab = 'all', $limit = 10) {
		
		Yii::log("Widget-Request from " . isset($_SERVER["REMOTE_ADDR"]) 
			? $_SERVER["REMOTE_ADDR"] : '', CLogger::LEVEL_INFO, __FUNCTION__);

		$current_time = time();

		// Determine the view to use ...
		$viewName = "default";
		$original_query = '';
		
		if (!is_numeric($limit)) {
			$limit = 10;
		} elseif ($limit > 50 || $limit < 3) {
			$limit = 10;
		}

		if (isset($_GET['q']) && $_GET['q'] != '') {
			$viewName = "search";
		}

		if ($viewName == "search") {
			$original_query = $_GET['q'];

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

		$this->layout = 'plain';
		$this->render('get', array('models' => $models, 'original_query' => $original_query));		
	}
}

?>
