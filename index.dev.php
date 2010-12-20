<?php

$main = "main.dev.mysql.php";

// development hosts
// using development configuration (see config/main.dev.php)
$devhosts = array("chiba", "chiba.local", 
	"wlan0104.rz.uni-leipzig.de",
	"wlan0355.rz.uni-leipzig.de", 
	"wlan0466.rz.uni-leipzig.de",
	"wlan0613.rz.uni-leipzig.de",
	"wlan0715.rz.uni-leipzig.de",
	"wlan1589.rz.uni-leipzig.de",
	"wlan1595.rz.uni-leipzig.de",
	"wlan1976.rz.uni-leipzig.de",
	"wlan2033.rz.uni-leipzig.de",
	"wlan0094.rz.uni-leipzig.de"
);

if (in_array(gethostname(), $devhosts)) {
	// development environment
	$yii = '/Users/ronit/src/yii-1.1.4.r2429/framework/yii.php';
	$config = dirname(__FILE__) . '/protected/config/' . $main;
} else {
	// production environment
	$yii = dirname(__FILE__) . '/../src/yii-1.1.4.r2429/framework/yii.php';
	$config = dirname(__FILE__) . '/protected/config/main.php';
	define('YII_DEBUG', false);
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
