<?php
date_default_timezone_set('Asia/Saigon');
define('_APP_PATH_', dirname(__FILE__));

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/admin.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once(_APP_PATH_.'/protected/components/SMSGWApplication.php');
$app = new SMSGWApplication($config);
$app->run();