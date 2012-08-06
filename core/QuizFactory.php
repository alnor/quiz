<?php

namespace core;

/**
 * class DBFactory
 * 
 */
class QuizFactory
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access private
	 */
	private $type;
	
	/**
	 * 
	 * @access private
	 */
	private $id;	


	/**
	 * 
	 *
	 * @param type
	 * @param id

	 * @return 
	 * @access public
	 */
	public function __construct( $type, $id=null ) {
		$this->type = $type;
		$this->id = $id;
	} // end of member function __construct

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function get( ) {
		switch($this->type){
			case "active":
				return new \core\command\data\ActiveQuiz($this->id);
				break;
			case "draft":
				return new \core\command\data\DraftQuiz($this->id);
				break;
			case "closed":
				return new \core\command\data\ClosedQuiz($this->id);
				break;										
		}
	} // end of member function get	

} // end of QuizFactory
?>
