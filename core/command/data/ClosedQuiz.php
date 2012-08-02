<?php

namespace core\command\data;

/**
 * class ClosedQuiz
 * 
 */
class ClosedQuiz extends \core\command\QuizData
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
	public function __construct( $id=null ) {
		parent::__construct( $id );
		$this->type=3;
	} // end of member function __construct





} // end of ClosedQuiz
?>
