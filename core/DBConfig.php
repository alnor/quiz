<?php

namespace core;

/**
 * class DBConfig
 * 
 */
class DBConfig
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/


	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public static function get( ) {
		
		require_once 'config/database.ini.php';
		
		return $db;
			
	} // end of member function get





} // end of DBConfig
?>