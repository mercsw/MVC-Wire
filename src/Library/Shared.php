<?php

/** Check if environment is development and display errors **/

function setReporting() {
if (DEVELOPMENT_ENVIRONMENT == true) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function checkMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
#	$_GET    = stripSlashesDeep($_GET   );
#	$_POST   = stripSlashesDeep($_POST  );
#	$_COOKIE = stripSlashesDeep($_COOKIE);
	die("Magic Quotes Must be turned off!!!");
}
}

/** Check register globals and remove them **/

function checkRegisterGlobals() {
    if (ini_get('register_globals')) {
#        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
#        foreach ($array as $value) {
#            foreach ($GLOBALS[$value] as $key => $var) {
#                if ($var === $GLOBALS[$key]) {
#                    unset($GLOBALS[$key]);
#                }
#            }
#        }
	die("Register Globals must be turned off!!!");
    }
}

/** Main Call Function **/

function callHook() {
	global $url;

	$urlArray = array();
	$urlArray = explode("/",$url);

	if(count($urlArray) < 2)
	{
		die("Invalid MVC Wire request");
	}
	// Get Controller name from url
	$controller = $urlArray[0];
	array_shift($urlArray);
	
	// Get Action name from url
	$action = $urlArray[0];
	array_shift($urlArray);

	// What is left is our querystring
	$queryString = $urlArray;

	// Save short controller name
	$controllerName = $controller;
	// Upper case first letter of controller
	$controller = ucwords($controller);
	// Remove the s and that is our model name
	$model = rtrim($controller, 's');
	// Append "Controller" which is our class name
	$controller .= 'Controller';

	// Call the controller
	$dispatch = new $controller($model,$controllerName,$action);

	if ((int)method_exists($controller, $action)) {
		call_user_func_array(array($dispatch,$action),$queryString);
	} else {
		die("Invalid Controller called");
	}
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(ROOT . DS . 'Library' . DS . $className . '.class.php')) {
		require_once(ROOT . DS . 'Library' . DS . $className . '.class.php');
	} else if (file_exists(ROOT . DS . 'App' . DS . 'Controllers' . DS . $className . '.php')) {
		require_once(ROOT . DS . 'App' . DS . 'Controllers' . DS . $className . '.php');
	} else if (file_exists(ROOT . DS . 'App' . DS . 'Models' . DS . $className . '.php')) {
		require_once(ROOT . DS . 'App' . DS . 'Models' . DS . $className . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

setReporting();
checkMagicQuotes();
checkRegisterGlobals();
callHook();
