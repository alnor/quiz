<?php

namespace core\command\data;

/**
 * class DraftQuiz
 * 
 */
class DraftQuiz extends \core\command\QuizData
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
		$this->type=2;
	} // end of member function __construct





} // end of DraftQuiz
?>
