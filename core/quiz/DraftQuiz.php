<?php

namespace core\quiz;

/**
 * class DraftQuiz
 * 
 */
class DraftQuiz extends \core\Quiz
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
		$this->type=2;
	} // end of member function __construct





} // end of DraftQuiz
?>
