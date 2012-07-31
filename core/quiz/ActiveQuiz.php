<?php

namespace core\quiz;

/**
 * class ActiveQuiz
 * 
 */
class ActiveQuiz extends \core\Quiz
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
	public function __construct( $text = null,  $id = null ) {
		parent::__construct( $text,  $id );
		$this->type=1;
	} // end of member function __construct





} // end of ActiveQuiz
?>
