<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
defined('YII_DEBUG') or define('YII_DEBUG',true);
require_once(dirname(__FILE__).'/framework/yii.php');
Yii::createWebApplication(dirname(__FILE__).'/protected/config/local.php')->run();