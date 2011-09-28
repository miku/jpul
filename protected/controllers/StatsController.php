<?php

Yii::import('application.helpers.*');
require_once('Utils.php');

class StatsController extends Controller
{

	// public function actionIndex() {
	// 	$this->render("empty");
	// }
	
	public function actionChronology() {
		// Show #pageviews, #visitors and #jobs for the last three month
		$cutoff_timestamp = date('U', mktime(0, 0, 0, 12, 16, 2010));
	
		$current_year = date("Y");
		$current_month = date("n");
		
		$ranges = array();
		
		// Yearly stats
		
		// Upper timestamp
		$upper = date('U', mktime(0, 0, 0, 12, 31, $current_year));
		for ($i = $current_year; $i >= date('Y', $cutoff_timestamp); $i--) { 
			Yii::log("Stats for year: " . $i, CLogger::LEVEL_INFO, __FUNCTION__);
			
			$lower = date('U', mktime(0, 0, 0, 1, 1, $i));
			$item = array("lower" => $lower, "upper" => $upper);
			$ranges[$i] = $item;
			$upper = $lower;
		}
	
		// Monthly stats
		for ($i = $current_year; $i >= date('Y', $cutoff_timestamp); $i--) {
	
			if ($current_year == $i) {
				
				$upper = date('U', mktime(0, 0, 0, $current_month, 31, $i));
				
				for ($j = $current_month; $j >= 1; $j--) { 
					
					if (mktime(0, 0, 0, $j, 31, $i) >= date('U', $cutoff_timestamp)) {
					
						Yii::log("Stats for month: " . $i . "/" .$j, CLogger::LEVEL_INFO, __FUNCTION__);
					
						$lower = date('U', mktime(0, 0, 0, $j, 1, $i));
						$item = array("lower" => $lower, "upper" => $upper);
						$ranges[$i . "/" . $j] = $item;
						$upper = $lower;
					
					} else { break; } 
					
				}
			} else {
				
				$upper = date('U', mktime(0, 0, 0, 12, 31, $i));
				
				for ($j = 12; $j >= 1; $j--) { 
					
					if (mktime(0, 0, 0, $j, 31, $i) >= date('U', $cutoff_timestamp)) {
						
						Yii::log("Stats for month: " . $i . "/" .$j, CLogger::LEVEL_INFO, __FUNCTION__);
						
						$lower = date('U', mktime(0, 0, 0, $j, 1, $i));
						$item = array("lower" => $lower, "upper" => $upper);
						$ranges[$i . "/" . $j] = $item;
						$upper = $lower;
	
					} else { break; }
				}
			
			}
		}
		
		foreach ($ranges as $key => $value) {
			Yii::log($key . ": " . $value['lower'] . " <==> " . $value['upper'], CLogger::LEVEL_INFO, __FUNCTION__);
			
		}
		
		// Now we want to know:
		// - #pageviews
		// - #visitors
		// - #jobs created
	
		// print_r($ranges);
		
		$stats = array();
		
		$key_for_current_month = $current_year . "/" . $current_month;
		$key_for_current_year = $current_year;
		
		foreach ($ranges as $key => $value) {
		
			// $stats["Pageviews " . $key] = $dataReader["pageviews"];
			$stats[$key . " Pageviews"] = Yii::app()->cache->get($key . " Pageviews");
			
			if ($stats[$key . " Pageviews"] === false) {
				
				Yii::log("Not cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);
				
				// Pageviews
				$sql = "select count(*) as pageviews from request where tracking_id is not null 
						and request_time > :lower 
						and request_time < :upper ;";
	
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
			
				$command->bindParam(":lower", $value['lower'], PDO::PARAM_INT);
				$command->bindParam(":upper", $value['upper'], PDO::PARAM_INT);
			
				$dataReader = $command->queryRow();
				$stats[$key . " Pageviews"] = $dataReader["pageviews"];
				
				if ($key != $key_for_current_month && $key != $key_for_current_year) {
					Yii::app()->cache->set($key . " Pageviews", $stats[$key . " Pageviews"]);
				}
			} else {
				Yii::log("Cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);
			}


		
			// Unique Visitors
			
			$stats[$key . " Unique"] = Yii::app()->cache->get($key . " Unique");
			
			if ($stats[$key . " Unique"] === false) {
				
				Yii::log("Not cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);
				
				$sql = "select count(distinct tracking_id) as uniq from request where tracking_id is not null
						and request_time > :lower 
						and request_time < :upper ;";
	
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
			
				$command->bindParam(":lower", $value['lower'], PDO::PARAM_INT);
				$command->bindParam(":upper", $value['upper'], PDO::PARAM_INT);
	
				$dataReader = $command->queryRow();
	
				// $stats["Unique Visitors " . $key] = $dataReader["uniq"];
				$stats[$key . " Unique"] = $dataReader["uniq"];
				
				if ($key != $key_for_current_month && $key != $key_for_current_year) {
					Yii::app()->cache->set($key . " Unique", $stats[$key . " Unique"]);
				}
			} else {
				Yii::log("Cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);
			}	
	
			// Jobs added
			$stats[$key . " Jobs"] = Yii::app()->cache->get($key . " Jobs");
			
			if ($stats[$key . " Jobs"] === false) {
			
				Yii::log("Not cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);

				$sql = "select count(*) as jobs_added from job where 
						date_added > :lower 
						and date_added < :upper ;";
	
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
			
				$command->bindParam(":lower", $value['lower'], PDO::PARAM_INT);
				$command->bindParam(":upper", $value['upper'], PDO::PARAM_INT);
	
				$dataReader = $command->queryRow();
	
				$stats[$key . " Jobs"] = $dataReader["jobs_added"];

				if ($key != $key_for_current_month && $key != $key_for_current_year) {
					Yii::app()->cache->set($key . " Jobs", $stats[$key . " Jobs"]);
				}
			} else {
				Yii::log("Cached: " . $key, CLogger::LEVEL_INFO, __FUNCTION__);
			}
	
		}
	
		krsort($stats);
		$this->layout = "main";
		$this->render("chronology", array('stats' => $stats));
	
	}
	// 
	// 
	public function actionActivity() {
		$sql = "select * from request where request_uri not like '%stats%' and request_uri not like '%activity%' order by request_time desc limit 50;";
	
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryAll();
	
		$this->layout = "plain";
		$this->render("activity", array("stats" => $dataReader));
	
	}
	
	public function actionReferer() {
		$sql = "select count(*) as cnt, http_referer as referer from request where http_referer is NOT null and http_referer != '' and http_referer not like '%wwwdup%' and http_referer not like '%localhost%' group by http_referer order by cnt desc;";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryAll();
	
		$this->layout = "main";
		$this->render("referer", array("stats" => $dataReader));
	
	}
	
	public function actionSearches() {
		$sql = "select count(*) as cnt, request_uri as uri from request where 
			request_uri is NOT null and
			request_uri not like '%q=' and
			request_uri not like '%admin%' and 
			request_uri not like 'localhost%' and 
			request_uri not like '%localhost%' and 
			request_uri like '%q=%' 
			group by request_uri 
			order by cnt desc;";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$searches = $command->queryAll();
	
		$sql = "select request_uri as uri, request_time from request where 
			request_uri is NOT null and
			request_uri not like '%q=' and
			request_uri not like '%admin%' and 
			request_uri not like 'localhost%' and 
			request_uri not like '%localhost%' and 
			request_uri like '%q=%' 
			order by request_time desc limit 25;";
	
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$recent = $command->queryAll();
	
		$this->layout = "main";
		$this->render("searches", array("searches" => $searches, "recent" => $recent));
	
	}
	
	public function actionCharts() {
		
		$current_time = time();
		$_1w = 604800;
		$_30d = 2592000;
				
		$criteria = new CDbCriteria;
		$criteria->order = 'view_count DESC';
		$criteria->limit = 100;		
		$models = JobViewcount::model()->findAll($criteria);
		
		$criteria->condition = 'job_date_added > :time';
		$criteria->params=array(':time' => ($current_time - $_30d));
		$criteria->limit = 15;
		
		$models_last_month = JobViewcount::model()->findAll($criteria);
		
		
		$criteria->condition = 'job_date_added > :time';
		$criteria->params=array(':time' => ($current_time - $_1w));
		$criteria->limit = 10;		
		$models_last_week = JobViewcount::model()->findAll($criteria);

		$this->render('charts', array(
			'models' => $models, 
			'models_last_month' => $models_last_month,
			'models_last_week' => $models_last_week
		));
	}
	
	public function actionRebuildCharts() {

        $criteria = new CDbCriteria;
        $criteria->condition = 'status_id=:status_id';
        $criteria->params=array(':status_id' => 2);
		$criteria->order = 'id';
		$_result = Job::model()->findAll($criteria);

		foreach ($_result as $model) {
	        try {
	            $sql = "select count(*) as view_count from (
	                select distinct tracking_id, request_uri_wo_qs_and_hostname from
	                request where
	                    (tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL AND
	                    request_uri_wo_qs_and_hostname = :url) as Q;";

	            $connection = Yii::app()->db;
	            $command = $connection->createCommand($sql);
	            $command->bindParam(":url", $this->createUrl('job/view', array("id" => $model->id)));
	            $dataReader = $command->queryRow();
	            $view_count = $dataReader['view_count'];

	            $job_viewcount = JobViewcount::model()->findBySql("SELECT * FROM job_viewcount WHERE job_id = :job_id", array('job_id' => $model->id));
	            if (!$job_viewcount) {
	                $job_viewcount = new JobViewcount;
	                $job_viewcount->job_id = $model->id;
	                $job_viewcount->job_title = $model->title;
	                $job_viewcount->job_date_added = $model->date_added;
	            }
	            $job_viewcount->view_count = $view_count;
	            $job_viewcount->date_updated = time();
	            $job_viewcount->save();
	        } catch (Exception $e) {
	            Yii::log($e, CLogger::LEVEL_INFO, __FUNCTION__);
	            $view_count = null;
	        }			
		}
		$this->redirect($this->createUrl('stats/charts'));
	}
	
	public function actionIndex() {
		
		$stats = array();
		$current_time = time();
		
		$_24h = 86400;
		$_48h = 172800;
		$_1w = 604800;
		$_2w = 1209600;
		$_30d = 2592000;
		$_60d = 5184000;
	
		// Events
		$sql = "select count(tracking_id) as events from request where tracking_id is not null;";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Pageviews Total"] = $dataReader["events"];
	
		// Average pageviews
		$sql = "select avg(q.r) as avg from (select distinct tracking_id, count(request_uri) as r from request where tracking_id is not null group by tracking_id) as q;";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Average Page Views"] = $dataReader["avg"];
	
		// Unique Visitors
		$sql = "select count(distinct tracking_id) as uniq from request where tracking_id is not null;";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Unique Visitors Total"] = $dataReader["uniq"];
	
	
		// Unique Visitors 24h
		$sql = "select count(distinct tracking_id) as uniq from request where tracking_id is not null and request_time > ". ($current_time - $_24h) . ";";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Unique Visitors (last 24h)"] = $dataReader["uniq"];
	
	
		// Unique Visitors 1w
		$sql = "select count(distinct tracking_id) as uniq from request where tracking_id is not null and request_time > ". ($current_time - $_1w) . ";";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Unique Visitors (last 7 days)"] = $dataReader["uniq"];
	
		// Unique Visitors 30d
		$sql = "select count(distinct tracking_id) as uniq from request where tracking_id is not null and request_time > ". ($current_time - $_30d) . ";";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Unique Visitors (last 30 days)"] = $dataReader["uniq"];


		// Visitors from widget 30d
		$sql = "select count(*) as from_widget from request where request_uri like '%src=widget%' and request_time > ". ($current_time - $_30d) . ";";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryRow();
	
		$stats["Visits/Pageviews via Widget (last 30 days)"] = $dataReader["from_widget"];
	
		
		// browser distribution		
		$sql = "select (count(*) / 1000) as cnt, bt_browser as browser from request where bt_browser is NOT null and bt_browser != '' group by bt_browser;";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryAll();
		
		$gcurl_browser = "https://chart.googleapis.com/chart?chs=450x200&cht=p3";
		$chd = "";
		$chl = "";
		$resultLength = count($dataReader);
		foreach ($dataReader as $key => $value) {
			$chd .= $value['cnt'];
			$chl .= $value['browser'];
			if ($resultLength - 1 != $key) {
				$chd .= ','; 
				$chl .= '|';
			}
		}
		
		$gcurl_browser .= "&chd=t:" . $chd . "&chl=" . $chl;
	
	
		// OS distribution
		$sql = "select (count(*) / 1000) as cnt, bt_os as os from request where bt_os is NOT null and bt_os != '' group by bt_os;";
		$connection = Yii::app()->db;
		$command = $connection->cache(600)->createCommand($sql);
		$dataReader = $command->queryAll();
		
		$gcurl_os = "https://chart.googleapis.com/chart?chs=450x200&cht=p3";
		$chd = "";
		$chl = "";
		$resultLength = count($dataReader);
		foreach ($dataReader as $key => $value) {
			$chd .= $value['cnt'];
			$chl .= $value['os'];
			if ($resultLength - 1 != $key) {
				$chd .= ','; 
				$chl .= '|';
			}
		}
		
		$gcurl_os .= "&chd=t:" . $chd . "&chl=" . $chl;
	
		$this->layout = "main";
		$this->render("index", array("stats" => $stats, 
			'gcurl_os' => $gcurl_os, 'gcurl_browser' => $gcurl_browser));
	}
	
	public function actionOutboundLinks() {
		$sql = "select * from outbound order by request_time desc limit 100;";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$outbound = $command->queryAll();
		$this->layout = "main";
		$this->render("outbound", array("outbound" => $outbound));
	

	}
	
	public function actionOutbound($location = '', $url = '', $text = '') {
		Yii::log("Outbound link detected on page: " . urldecode($location) . " to: " . urldecode($url) . " (text: " . $text . ")", CLogger::LEVEL_INFO, __FUNCTION__);
		
		if (isset(Yii::app()->session[Yii::app()->params['ccul_stats_v1']])) {
			$beacon = Yii::app()->session[Yii::app()->params['ccul_stats_v1']];			
			$beacon['last-access'] = time();
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = $beacon;
		} else {
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = array(
				"id" => uniqid(), 
				"first-access" => time(), 
				"last-access" => time()
			);
		}
		
		$beacon = Yii::app()->session[Yii::app()->params['ccul_stats_v1']];
		if ( !(isset($beacon)) || $beacon == null ) { return; }

		try {
			$outbound = new Outbound();
		
			$outbound->location = urldecode($location);
			$outbound->url = urldecode($url);
			$outbound->text = $text;
		
			$outbound->tracking_id = $beacon['id'];
		
			$outbound->tracking_version = 2; // version "1" was untagged

			$outbound->remote_addr = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '';
			$outbound->remote_host = isset($_SERVER["REMOTE_HOST"]) ? $_SERVER["REMOTE_HOST"] : '';
			$outbound->request_time = time();
			$outbound->http_user_agent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';		
			$outbound->http_accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
			$outbound->http_accept_charset = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : '';
			$outbound->http_accept_encoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
			$outbound->http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
			$outbound->http_connection = isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] : '';
			$outbound->http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
			$outbound->remote_port = isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : '';			
			$outbound->save();
			// Yii::log("Recorded outbound (tracking id: " . $outbound->tracking_id . ")", CLogger::LEVEL_INFO, __FUNCTION__);
		} catch (Exception $e) {
			Yii::log("Failed to record outbound: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
		} 
	}
		
	public function actionTrack(
		$b = '', $ref= '', $ww = '', $wh = '', 
		$sw = '', $sh= '', $cd = '', $av = '', 
		$btb = '', $btv= '', $btos = '') {		
		// '?b=' + document.location +         // the current URL
		// '&ref=' + document.referrer +       // previous page
		// '&ww=' + $(window).width() +        
		// '&wh=' + $(window).height() +
		// '&sw=' + screen.width + 
		// '&sh=' + screen.height + 
		// '&cd=' + screen.colorDepth + 
		// '&av=' + navigator.appVersion +
		// '&btb=' + BrowserDetect.browser + 
		// '&btv=' + BrowserDetect.version + 
		// '&btos=' + BrowserDetect.OS 
	
		if (isset(Yii::app()->session[Yii::app()->params['ccul_stats_v1']])) {
			$beacon = Yii::app()->session[Yii::app()->params['ccul_stats_v1']];			
			$beacon['last-access'] = time();
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = $beacon;
		} else {
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = array(
				"id" => uniqid(), 
				"first-access" => time(), 
				"last-access" => time()
			);
		}
		
		$beacon = Yii::app()->session[Yii::app()->params['ccul_stats_v1']];
		
		if ( !(isset($beacon)) || $beacon == null ) { return; }
		
		try {
			$request = new Request();
			$request->tracking_version = 2; // version "1" was untagged
	
			$request->remote_addr = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '';
			$request->remote_host = isset($_SERVER["REMOTE_HOST"]) ? $_SERVER["REMOTE_HOST"] : '';
			$request->request_time = time();
			$request->http_user_agent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';
			$request->request_uri = $b; // we want to track the previous page ...
	
			// request url without query string
			$request->request_uri_wo_qs = preg_replace("/([?].*)/", "", $b);
			if (isset($_SERVER['HTTP_HOST'])) {
				$request->request_uri_wo_qs_and_hostname = str_replace("http://" . $_SERVER['HTTP_HOST'], "", $request->request_uri_wo_qs);
			}
	
			$request->tracking_id = $beacon['id'];
			$request->request_uri = urldecode($b);
			$request->request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
			$request->http_referer = urldecode($ref); // and the page before the previous page
			$request->http_accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
			$request->http_accept_charset = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : '';
			$request->http_accept_encoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
			$request->http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
			$request->http_connection = isset($_SERVER['HTTP_CONNECTION']) ? $_SERVER['HTTP_CONNECTION'] : '';
			$request->http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
			$request->remote_port = isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : '';
			$request->window_width = $ww;
			$request->window_height = $wh;
			$request->screen_width = $sw;
			$request->screen_height = $sh;
			$request->screen_colordepth = $cd;
			$request->navigator_appversion = $av;
			$request->bt_browser = $btb;
			$request->bt_version = $btv;
			$request->bt_os = $btos;
	
			$request->save();
			// Yii::log("Recorded request (tracking id: " . $request->tracking_id . ")", CLogger::LEVEL_INFO, __FUNCTION__);
		} catch (Exception $e) {
			Yii::log("Failed to record request: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
		} 
	}
}
