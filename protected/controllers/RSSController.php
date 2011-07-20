<?php 

Yii::import('application.helpers.*');
require_once('Utils.php');
require_once('SearchHub.php');
require_once('TabHelper.php');
Yii::import('ext.feed.*');

class RSSController extends Controller
{
	
	public function actionIndex() {
		if (isset($_GET['q'])) {
			$this->redirect($this->createUrl('rss/feed', array('q' => $_GET['q'])));
		} else {
			$this->redirect($this->createUrl('rss/feed'));
		}
	}

	public function actionFeed() {

		$current_time = time();
		$viewName = "default";

		if (isset($_GET['q'])) {
			$original_query = $_GET['q'];
		} else {
			$original_query = '';
		}
		
		 if (isset($_GET['tab'])) {
			$tab = $_GET['tab'];
		} else {
			$tab = 'all';
		}
		
		if ($original_query == '') {
			$viewName = "default";
		} else {
			$viewName = "search";
		}

		if ($viewName == "search") {
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

			$options = array("q" => $query, "tab" => $tab,
				"limit" => 20, "offset" => 0);

			$result = getResultSetAndSize($options);
			$models = $result["models"];

		} else {
			
			$criteria = new CDbCriteria;
			$criteria->order = 'date_added DESC';
			$criteria->limit = 20;
			// just show the public offers, which are not expired ...
	        $criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
	        $criteria->params=array(':status_id' => 2, ':current_time' => $current_time);

			if ($tab == 'all') {
				// just go
			} elseif ($tab == '-internship') {
				$criteria->condition .= get_fragment('MINUS_INTERNSHIP');            
			} elseif ($tab == 'internship') {
				$criteria->condition .= get_fragment('INTERNSHIP');
			} elseif ($tab == 'international') {
				$criteria->condition .= get_fragment('I18N');
			}
			
			$models = Job::model()->findAll($criteria);
		}

		$serverPrefix = 'http://' . Yii::app()->request->serverName;
		if (Yii::app()->request->serverPort != 80) {
			$serverPrefix .= ':' . Yii::app()->request->serverPort;
		}

		$feed = new EFeed(EFeed::RSS1);
 
		// IMPORTANT : No need to add id for feed or channel. It will be automatically created from link.
		if ($viewName == 'default') {
			$feed->title = 'Jobportal Universität Leipzig (' . $tab . ')';
			$feed->link = $serverPrefix . $this->createUrl('job/index', array('tab' => $tab));
		} else {
			$feed->title = 'Jobportal Universität Leipzig (' . $tab . ', ' . $original_query . ')';
			$feed->link = $serverPrefix . $this->createUrl('job/index', array('tab' => $tab, 'q' => $original_query));
		}

 		$feed->addChannelTag('languge', 'de');
		$feed->addChannelTag('pubDate', date(DATE_RSS, $current_time));
		
		foreach ($models as $key => $value) {
			$item = $feed->createNewItem();
			$item->title = $value["title"] . " (" . $value["company"] . ")";
			$item->link  = $serverPrefix . $this->createUrl('job/view', array('id' => $value["id"]));			
			// we can also insert well formatted date strings
			$item->date = $value["date_added"];
			$item->description = mb_substr($value["description"], 0, 400) . ' ...';
			$feed->addItem($item);
		}
 
		$feed->generateFeed();
	}
}

?>