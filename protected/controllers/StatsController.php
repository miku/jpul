<?php

Yii::import('application.helpers.*');
require_once('Utils.php');

class StatsController extends Controller
{
	
	public function actionIndex() {
		$this->render("index");
	}
		
	public function actionTrack($b = '', $ref= '', $ww = '', $wh = '') {

		$request_time = time();

		$remote_addr = $_SERVER["REMOTE_ADDR"];
		$http_ua = $_SERVER["HTTP_USER_AGENT"];
		$http_referer = $_SERVER["HTTP_REFERER"];
		
		$request_uri = $_SERVER['REQUEST_URI'];
		$query_string = $_SERVER['QUERY_STRING'];

		// $request_uri_wo_qs = str_replace("?" + $query_string, "", $request_uri);
		$request_uri_wo_qs = preg_replace("/([?].*)/", "", $http_referer);

		$script_filename = $_SERVER['SCRIPT_FILENAME'];

		$request_method = $_SERVER['REQUEST_METHOD'];
		$http_accept = $_SERVER['HTTP_ACCEPT'];

		if (isset(Yii::app()->session['tracker'])) {
			$xtracker = Yii::app()->session[Yii::app()->params['ccul_stats_v1']];			
			$xtracker['last-access'] = time();
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = $xtracker;
		} else {
			Yii::app()->session[Yii::app()->params['ccul_stats_v1']] = array(
				"id" => uniqid(), 
				"first-access" => time(), 
				"last-access" => time()
			);
		}

		Yii::log("---------------- >>>> ", CLogger::LEVEL_INFO, "actionTrack");
		Yii::log("[**] request_uri_wo_qs: " . $request_uri_wo_qs, CLogger::LEVEL_INFO, "actionTrack");
		Yii::log("[**] script_filename: " . $script_filename, CLogger::LEVEL_INFO, "actionTrack");
		Yii::log("[**] query_string: " . $query_string, CLogger::LEVEL_INFO, "actionTrack");
		Yii::log("[**] request-uri: " . $request_uri, CLogger::LEVEL_INFO, "actionTrack");		
		Yii::log("[**] base: " . $b . "; ref: " . $ref . "; dim: " . $ww . "x" . $wh, CLogger::LEVEL_INFO, "actionTrack");

	}
}