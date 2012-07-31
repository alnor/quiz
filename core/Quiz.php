<?php

namespace core;

/**
 * class Quiz
 * 
 */
abstract class Quiz
{

	/** Aggregations: */

	/** Compositions: */
	var $m_;

	 /*** Attributes: ***/

	/**
	 * 
	 * @access protected
	 */
	protected $questions;

	/**
	 * 
	 * @access protected
	 */
	protected $type;

	/**
	 * 
	 * @access private
	 */
	private $text;


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

		$this->db = \core\Registry::getConnection();
					
		$this->text = $text;
	} // end of member function __construct

	/**
	 * 
	 *
	 * @param Question question 

	 * @return 
	 * @access public
	 */
	public function addQuestion( \core\Question $question ) {
		$this->questions[] = $question;
	} // end of member function addQuestion

	/**
	 * 
	 *
	 * @param Question question 

	 * @return 
	 * @access public
	 */
	public function deleteQuestion( $question ) {
		unset($this->questions);
	} // end of member function deleteQuestion

	/**
	 * 
	 *
	 * @param int type 

	 * @return 
	 * @access public
	 */
	public function setType( $type ) {
		$this->type = $type;
	} // end of member function setType

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function getQuestions( ) {
		return $this->questions;
	} // end of member function getQuestions

	/**
	 * 
	 *
	 * @param array _questions 

	 * @return 
	 * @access public
	 */
	public function setQuestion( $_questions ) {
		foreach($_questions as $key=>$val){
			$this->questions[] = new \core\Question($val["id"]);
		}
	} // end of member function setQuestion
	
	/**
	 * 
	 *
	 * @param array $params 

	 * @return 
	 * @access public
	 */
	public function save( $params ) {
		$this->db->saveQuiz($params["quiz"]);
		$this->db->saveQuestion($params["question"], $this->db->getLastId());
	} // end of member function save	



	/**
	 * 
	 *
	 * @param int id 

	 * @return 
	 * @access private
	 */
	private function init( $id ) {
		$quiz = $this->db->findQuiz($id);
		$questions = $this->db->findQuestions($id);
		$this->setQuestions($questions);
	} // end of member function init



} // end of Quiz
?>
