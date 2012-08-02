<?php

namespace core\command\data;

/**
 * class ActiveQuiz
 * 
 */
class ActiveQuiz extends \core\command\QuizData
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
		$this->type=1;
	} // end of member function __construct


} // end of ActiveQuiz
?>
