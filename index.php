<?php
	
	define("CORE_PATH", dirname(__FILE__).DIRECTORY_SEPARATOR."core");
	define("APP_PATH", dirname(__FILE__).DIRECTORY_SEPARATOR."client");
	define("DOCUMENT_ROOT", dirname(__FILE__));
	
	ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.CORE_PATH.PATH_SEPARATOR.APP_PATH.PATH_SEPARATOR.DOCUMENT_ROOT);
	
	require_once CORE_PATH .'/Loader.php';
	
	$controller = \core\AppController::getInstance();
	$controller->init();
	$controller->dispatch();
	
?>