<?php

namespace core;

/**
 * class Answer
 * 
 */
class Answer
{

	/** Aggregations: */

	/** Compositions: */
	var $m_;

	 /*** Attributes: ***/


	/**
	 * 
	 *
	 * @param string text 

	 * @param int id 

	 * @return 
	 * @access public
	 */
	public function __construct( $text = null,  $id = null ) {
		if (!is_null($id)){
			$this->init($id);
		}
		
		if (!is_null($text)){
			$this->text = $text;
		}
	} // end of member function __construct





} // end of Answer
?>
