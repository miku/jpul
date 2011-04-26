<?php 

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class WidgetController extends Controller
{
	public function actionIndex() {
		$original_query = null;
		$width = null;
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$original_query = strip_tags($_GET['q']);
		}
		if (isset($_GET['width']) && $_GET['width'] != '') {
			$width = strip_tags($_GET['width']);
		}
		$this->layout = 'v2/plain';
		$this->render('index', 
			array('original_query' => $original_query, 'width' => $width));
	}
	
	public function actionGet() {
		
		Yii::log("Widget-Request from " . isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '', 
			CLogger::LEVEL_INFO, __FUNCTION__);
		
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

		$current_time = time();
		$criteria = new CDbCriteria;
		$criteria->order = 'date_added DESC';
	
		$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
		$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		$criteria->limit = 10; # self::PAGE_SIZE;

		// Determine the view to use ...
		$viewName = "default";
		$original_query = '';

		if (isset($_GET['q']) && $_GET['q'] != '') {
			$viewName = "search";
		}

		if ($viewName == "search") {
			$index = new Zend_Search_Lucene($this->getSearchIndexStore());
			$original_query = $_GET['q'];

			if (preg_match("/( OR | AND |\"|:|~|-|\*| NOT )/", $original_query) == 0) {
				$query = trim($original_query) . '*';
				$query = preg_replace("/\s+/", "* AND ", $query);
			} else {
				$query = $original_query;
			}
			
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
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
		}	
		
		// if the user neither searched or requested her favs, use the default view ...	
		if ($viewName == "default") {
			$models = Job::model()->findAll($criteria);
		}

		$this->layout = 'v2/plain';
		$this->render('get', array('models' => $models, 'original_query' => $original_query));		
	}
}

?>