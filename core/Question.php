<?php

namespace core;

/**
 * class Question
 * 
 */
class Question
{

	/** Aggregations: */

	/** Compositions: */
	var $m_;

	 /*** Attributes: ***/

	/**
	 * 
	 * @access private
	 */
	private $text;

	/**
	 * 
	 * @access private
	 */
	private $answers;


	/**
	 * 
	 *
	 * @param string text 

	 * @param int id 

	 * @return 
	 * @access public
	 */
	public function __construct( $text,  $id = null ) {
		if (!is_null($id)){
			$this->init($id);
		}
		
		$this->text = $text;
	} // end of member function __construct

	/**
	 * 
	 *
	 * @param Answer answer 

	 * @return 
	 * @access public
	 */
	public function addAnswer( \core\Answer $answer ) {
		$this->answers[] = $answer;
	} // end of member function addAnswer

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function getAnswers( ) {
		return $this->answers;
	} // end of member function getAnswers





} // end of Question
?>
