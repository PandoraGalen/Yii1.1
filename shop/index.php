<?php
error_reporting(E_ALL);
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//引入已经定义好的系统常量
 // require_once (dirname(__FILE__).'/protected/config/constant.php');
define('SITE_URL', 'http://yiishop.local/');


define('CSS_URL', SITE_URL."assets/default/css/");    //前台样式目录地址
define('IMG_URL', SITE_URL."assets/default/images/");    //前台图片目录地址

define('HOUTAI_CSS_URL', SITE_URL."assets/admin/css/");    //后台样式目录地址
define('HOUTAI_IMG_URL', SITE_URL."assets/admin/images/");    //后台图片目录地址

require_once($yii);
Yii::createWebApplication($config)->run();
