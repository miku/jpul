<?php

// production environment
$yii = dirname(__FILE__) . '/../src/yii-1.1.4.r2429/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
define('YII_DEBUG', false);
// define('YII_DEBUG', true);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
