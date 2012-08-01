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
	private $id;	

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
		$this->db = new \core\data\QuizData($this->driver);
				
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
	public function getQuestionsCollection( ) {
		return $this->questions;
	} // end of member function getQuestions

	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function setQuestions(  ) {
		
		//$questions = 
		
		foreach($questions as $key=>$val){
			$this->questions[] = new \core\Question(null, $val["id"]);
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
	 * @param array $params 

	 * @return 
	 * @access public
	 */
	public function delete( ) {
		return $this->db->delete($this->id);
	} // end of member function save	


	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getQuiz( ) {
		return $this->db->find($this->type);
	} // end of member function deleteQuestion	

	/**
	 * 
	 *
	 * @param int id 

	 * @return 
	 * @access private
	 */
	private function init( $id ) {
		$quiz = $this->db->find($this->type, $id);
		$this->id = $id;
		$this->text = $quiz[0]["text"];
		$this->setQuestions();
	} // end of member function init



} // end of Quiz
?>
