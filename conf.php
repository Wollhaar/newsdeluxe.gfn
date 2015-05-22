<?php
require_once 'vendor/autoload.php';

$conn = array(
    'default' => array(
        'driver' => 'pdo_mysql',
        'dbname' => 'newsdeluxe_doctrine',
        'host' => 'localhost',
        'user' => 'root',
        'password' => ''
    )
);

$app = array(
    'debug_mode' => true
);

$em = Webmasters\Doctrine\Bootstrap::getInstance($conn, $app)->getEm();

define('BASE_PATH', 'NewsDeluxe_login');
define('VIEW_PATH', 'view/');
define('IMAGE_PATH', VIEW_PATH.'image/');
define('CSS_PATH', VIEW_PATH.'css/');
define('JS_PATH', VIEW_PATH.'js/');

ini_set('session.use_only_cookies', 1);
session_start();
session_regenerate_id();


/*
define('DEBUG_MODE', false);
define('IMAGE_PATH', 'image/');
require_once 'model/DBManager.php';
require_once './view/viewHelper.php';
require_once 'model/News.php';
require_once 'model/Newsmapper.php';

function getDbDebugger($dbh, $stmt = false) {
    if (DEBUG_MODE) {
        echo '<pre>';
        print_r($dbh->errorInfo());
        print_r($stmt->errorInfo());
        echo '</pre>';
    }
}

function getDebug($value) {
    if (DEBUG_MODE) {

        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}
*/