<?php if ($_SERVER['SERVER_NAME'] === "uni-leipzig.de" || $_SERVER['SERVER_NAME'] === "www.uni-leipzig.de"): ?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />	
	<title>Jobportal, Career Center, Universität Leipzig, 2010 - 2011</title>
		<meta http-equiv="refresh" content="0;url=http://wwwdup.uni-leipzig.de/jobportal">
	<style media="screen">
		#progress-indicator { font-family: Verdana; font-size: 12px; background: #ff0; padding: 5px; }
		#progress-indicator a { color: black; text-decoration: none; font-weight: bold; }
		body, #pi-container { margin-left: 0px; }
		body { background: white; }
	</style>
</head>
<body>
	<div id="pi-container">
		<span id="progress-indicator">Redirecting to <a href="http://wwwdup.uni-leipzig.de/jobportal">http://wwwdup.uni-leipzig.de/jobportal</a> ...</span>
	</div>
</body>
</html>	

<?php else: ?>

<?php 
// development hosts
// using development configuration (see config/main.dev.php)
$devhosts = array("chiba", "chiba.local", 
	"wlan0355.rz.uni-leipzig.de", 
	"wlan0613.rz.uni-leipzig.de",
	"wlan1589.rz.uni-leipzig.de",
	"wlan0715.rz.uni-leipzig.de",
	"wlan1595.rz.uni-leipzig.de");

if (in_array(gethostname(), $devhosts)) {
	// development environment
	$yii = '/Users/ronit/src/yii-1.1.4.r2429/framework/yii.php';
	$config = dirname(__FILE__) . '/protected/config/main.dev.php';
} else {
	// production environment
	$yii = dirname(__FILE__) . '/../src/yii-1.1.4.r2429/framework/yii.php';
	$config = dirname(__FILE__) . '/protected/config/main.php';
	define('YII_DEBUG', true);
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
