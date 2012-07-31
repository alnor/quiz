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
			echo $path.".php", "<br />";
			throw new \core\QuizException("error path");
		}
		
		require_once $path.".php";
		
		if (!class_exists($class)){
			throw new \core\QuizException("error class");	
		}		
		
	} // end of member function loading
		
}

function __autoload( $class ) {
	Loader::loading( $class );
} 
?>