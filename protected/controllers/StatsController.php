<?php

Yii::import('application.helpers.*');
require_once('Utils.php');

class StatsController extends Controller
{
	
	public function actionIndex() {
		$this->render("index");
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
			$request->tracking_version = "2"; // version "1" was untagged
			
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
			$request->request_uri = $b;
			$request->request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
			$request->http_referer = $ref; // and the page before the previous page
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
		} catch (Exception $e) {
			Yii::log("Failed to record request: " . $e, CLogger::LEVEL_INFO, "beforeAction");
		}
	}
}
