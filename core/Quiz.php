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
	 * @access private
	 */
	private $driver;	
	
	/**
	 * 
	 * @access private
	 */
	private $db;	


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
		$this->db = new \core\QuizData($this->driver);
				
		if (!is_null($id)){
			$this->init($id);
		}

		if (!is_null($text)){
			$this->text = $text;
		}
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
	 * @param int type 

	 * @return 
	 * @access public
	 */
	public function getText( ) {
		return $this->text;
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
		$quiz = $this->db->find($id);
		$this->text = $quiz["text"];
		$questions = $this->db->findQuestions($id);
		$this->setQuestions($questions);
	} // end of member function init



} // end of Quiz
?>
