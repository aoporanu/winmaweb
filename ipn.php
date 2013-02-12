<?php
define('ROOT_PATH', dirname(__FILE__));

ini_set('log_errors', true);
ini_set('error_log', ROOT_PATH.'/ipn_errors.log');

error_log('test');
?>
