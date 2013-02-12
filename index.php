<?php 
/*
 * Application root path
 */
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
ini_set('display_errors','On');
define('ROOT_PATH', dirname(__FILE__));
//date_default_timezone_set('America/New_York');

/*
 * Magic quotes off
 */

//set_magic_quotes_runtime(false);
if (get_magic_quotes_gpc()) {
    function stripslashes_gpc(&$value)
    {
        $value = stripslashes($value);
    }
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}
/*
ini_set('include_path', ROOT_PATH . '/lib');
require_once('Zend/Loader/Autoloader.php');

Zend_Loader_Autoloader::getInstance();

Zend_Session::setOptions(array('save_path' => ROOT_PATH . '/cache/session', 'remember_me_seconds' => 8600));
Zend_Session::start();



$request_uri = explode('/', $_SERVER["REQUEST_URI"]);
$app = 'site';
if($arr[1] == 'admin') {
    $app = 'admin';
    unset($arr[1]);
}

$request_uri = implode('/', $request_uri);
*/
ini_set('include_path', ROOT_PATH . '/lib');
require_once('Cms/Application.php');

$application = new Cms_Application();
$application->bootstrap()
            ->run();
?>