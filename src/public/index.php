<?php	
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = $_GET['url'];

require_once (ROOT . DS . 'Library' . DS . 'Bootstrap.php');
