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
	public function __construct( $text = null,  $id = null ) {
			
		$this->driver = \core\Registry::getConnection();
		$this->db = new \core\data\QuestionData($this->driver);
				
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


	/**
	 * 
	 *
	 * @param array $params 

	 * @return 
	 * @access public
	 */
	public function save( $params ) {
		$this->db->save($params);
		return $this->db->getLastId();
	} // end of member function save
	
	/**
	 * 
	 *
	 * @param int id 

	 * @return 
	 * @access private
	 */
	private function init( $id ) {
		$quest = $this->db->find($this->type, $id);
		$this->id = $id;
		$this->text = $quest[0]["text"];
	} // end of member function init	


} // end of Question
?>
