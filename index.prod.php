<?php

// Production Environment
$yii = dirname(__FILE__) . '/../src/yii-1.1.7.r3135/framework/yii.php';

// This configuration is not vc'd
$config = dirname(__FILE__) . '/protected/config/main.php';
define('YII_DEBUG', false);
// define('YII_DEBUG', true);
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
