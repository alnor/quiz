<?php

/**
 * class Loader
 * 
 */
class Loader
{
	
	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public static function loading( $class ) {
		$path = str_replace("\\", "/", $class);

		if (!file_exists($path.".php")){
			throw new \Exception("error path");
		}
		
		require_once $path.".php";
		
		if (!class_exists($class)){
			throw new \Exception("error class");	
		}		
		
	} // end of member function loading
		
}

function __autoload( $class ) {
	Loader::loading( $class );
} 
?>