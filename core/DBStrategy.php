<?php

namespace core;

/**
 * class DBStrategy
 * 
 */
class DBStrategy
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access protected
	 */
	protected $dbConfig;


	/**
	 * 
	 *
	 * @param dbConfig 

	 * @return 
	 * @access public
	 */
	public function __construct( $dbConfig ) {
		$this->dbConfig = $dbConfig;
	} // end of member function __construct

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function get( ) {
		switch ($this->dbConfig["driver"]){
			case "mysqli":
			case "mysql":
				return new \core\db\MySQL($this->dbConfig);
				break;
		}
	} // end of member function get	

} // end of DBStrategy
?>
