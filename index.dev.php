<?php

$main = "main.dev.mysql.php"; // main config
$yii = '/Users/ronit/src/yii-1.1.7.r3135/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/' . $main;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
