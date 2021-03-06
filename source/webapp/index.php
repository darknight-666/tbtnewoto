<?php

// change the following paths if necessary   
$yii = dirname(__FILE__) . '/../yii-1.1.14.f0fee9/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TBTENV') or define('YII_TBTENV', 2); // 1:生产环境 2:开发测试环境 3:准生产环境
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
