<?php
use Diagnostics as dd;

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
	throw new SystemException("Magic Quotes Must be turned off!!!");
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
	throw new SystemException("Register Globals must be turned off!!!");
    }
}

/** Main Call Function **/

function callHook() {
	global $url;

	$urlArray = array();
	$urlArray = explode("/",$url);

	if(count($urlArray) < 2)
	{
		throw new SystemException("Invalid MVC Wire request");
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
		throw new SystemException("Invalid Controller called");
	}
}

/** Autoload any classes that are required **/

function autoLoader($class) {
	$className = end(explode('\\', $class));	
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

// Configure RedBean
// http://www.redbeanphp.com/api/
function configOrm()
{
	global $DB_CONSTRING;
	global $DB_USER;
	global $DB_PASSWORD;
	
	require_once(ROOT . DS . 'Library' . DS . 'ORM' . DS . 'redbean' . DS . 'rb.php');
	\R::setup($DB_CONSTRING, $DB_USER, $DB_PASSWORD);	
	if(!DEVELOPMENT_ENVIRONMENT)
	{
		// Freeze the schema in production
		R::freeze();
	}
}

// Configure PHPIDS
// http://phpids.org/docs/
function configIDS()
{
	  require_once(ROOT . DS . 'Library' . DS . 'IDS' . DS . 'lib' . DS . 'IDS' . DS . 'Init.php');
	  $request = array(
      'REQUEST' => $_REQUEST,
      'GET' => $_GET,
      'POST' => $_POST,
      'COOKIE' => $_COOKIE
	  );
	  
	  $initialDir = getcwd();
	  chdir(ROOT . DS . 'Library' . DS . 'IDS' . DS . 'lib');
	  $init = \IDS_Init::init(ROOT . DS . 'Library' . DS . 'IDS' . DS . 'lib' . DS . 'IDS' . DS . 'Config' . DS . 'Config.ini.php');
	  
	  $config = $init->getConfig();
	  
	  $config['General']['base_path'] = ROOT . DS . 'Library' . DS . 'IDS' . DS . 'lib' . DS . 'IDS' . DS;
	  $config['General']['use_base_path'] = TRUE;
	  
	  $config['Logging']['path'] = ROOT . DS . 'tmp' . DS . 'logs' . DS . 'php-ids.log';
	  $config['Logging']['recipients'][0] = IDS_EMAIL_TO;
	  $config['Logging']['subject'] = IDS_EMAIL_SUBJECT;
	  $config['Logging']['header'] = "From: " . IDS_EMAIL_FROM; 
	  
	  // Disable database logging
	  unset($config['Logging']['wrapper']); 
	  unset($config['Logging']['user']);
	  unset($config['Logging']['password']);
	  unset($config['Logging']['table']);
	  
	  // Disable database caching
	  unset($config['Caching']['wrapper']); 
	  unset($config['Caching']['user']);
	  unset($config['Caching']['password']);
	  unset($config['Caching']['table']);
	  
	  $init->setConfig($config, TRUE);
	  //Utils::DumpVar($config);
	    
	  $ids = new \IDS_Monitor($request, $init);
	  $result = $ids->run();
	
	  if (!$result->isEmpty()) {
	   
	   Response::Write("<div style=\"width:500px; height:400px; position:absolute; top:50%; left:50%; margin:-200px 0 0 -250px; 
	   					display:block;overflow:auto;padding: 2em; 
	   					font-family: 'Arial Black'; background-color: #f90017; color: #ffffff; 
	   					border-width: .4em; border-style: double; border-color: #ffffff; \">
	   					IDS WARNING:<br/><br/>
	   					$result<br/>
	   					Request Aborted!!!
	   					</div>");
						throw new SystemException("Request aborted by IDS");
	  }
	  
	  chdir($initialDir);
}
function registerRequestHandlers()
{
	Request::Register();
}

setReporting(); 
spl_autoload_register("autoLoader", TRUE);
registerRequestHandlers();
configIDS();
checkMagicQuotes();
checkRegisterGlobals();
configOrm();
callHook();