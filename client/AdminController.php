<?php

namespace client;

/**
 * class AdminController
 * 
 */


class AdminController extends \core\Common
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access private
	 */
	private $error=array();	
	
	/**
	 * 
	 * @access private
	 */
	private $form=array();	


	function quiz(){								
		$activeQuizObj = new \core\quiz\ActiveQuiz();
		$activeQuiz = $activeQuizObj->getQuiz();
		
		$draftQuizObj = new \core\quiz\DraftQuiz();
		$draftQuiz = $draftQuizObj->getQuiz();
		
		$closedQuizObj = new \core\quiz\ClosedQuiz();
		$closedQuiz = $closedQuizObj->getQuiz();		

		$this->set("active", $activeQuiz);	
		$this->set("draft", $draftQuiz);	
		$this->set("closed", $closedQuiz);
	}
	
	/**
	 * 
	 * Adding quiz
	 */
	
	function add(){	

		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			
			$this->validateQuizFields( );		
			$this->validateQuestionFields( );		
			$this->validateAnswerFields( );		
			$this->validateRequiredCount( );			

			if (!empty($this->error)){
				$this->setView("error", false);
				$this->setBlankTheme();
				$this->set("error", $this->error);
				return;
			}	
			
			$quizObj = new \core\quiz\ActiveQuiz($this->form["quiz"]["text"]);
			$quizid = $quizObj->save($this->form["quiz"]);

			foreach($this->form["question"] as $key=>$question){
				$question["quiz_id"] = $quizid;
				$questionObj = new \core\Question($question["text"]);
				$questionid = $questionObj->save($question);
				
				foreach($this->form["answer"][$key] as $k=>$answer){
					$answer["question_id"] = $questionid;
					$answerObj = new \core\Answer($answer["text"]);
					$answerid = $answerObj->save($answer);					
				}
			}			
		}			

	}
	
	function result(){								
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			switch($this->form["type"]){
				case "active":
					$quizObj = new \core\quiz\ActiveQuiz(null, $this->form["id"]);
					break;
			}
			
			$questions = $quizObj->getQuestionsCollection();
		}		
	}	
	
	function close(){
		$form = \core\Registry::getRequest()->form();						
		print($form["id"]);
	}	
	
	function delete(){
		$form = \core\Registry::getRequest()->form();	

		if ($form){
			switch($form["type"]){
				case "active":
					$quizObj = new \core\quiz\ActiveQuiz(null, $form["id"]);
					$quizObj->delete();
					break;
			}
		}
		print($form["id"]);
	}	
	
	private function validateQuizFields( ){
		if (!$this->form["quiz"]["text"]){
			$this->error[] = "Quiz name needed";
		}		
	}
	
	private function validateQuestionFields( ){
				
		foreach($this->form["question"] as $key=>$val){
			if (empty($val["text"])){
				unset($this->form["question"][$key]);
			}
		}

		if (empty($this->form["question"])){
			$this->error[] = "Question name needed";	
		}		
			
	}	
	
	private function validateAnswerFields( ){
				
		foreach($this->form["question"] as $key=>$question){
			
			foreach($this->form["answer"][$key] as $k=>$answer){
				if (empty($answer["text"])){
					unset($this->form["answer"][$key][$k]);
				}
			}
			if (empty($this->form["answer"][$key]) || (count($this->form["answer"][$key])<2)){
				$this->error[] = "Question '".$question["text"]."' must have at least two answer";	
			}						
			
		}		
	}	
	
	private function validateRequiredCount( ){
		
		$requiredCount = 0;
		
		foreach($this->form["question"] as $key=>$question){
			if ($question["required"]){
				$requiredCount++;
			}
		}
		
		if ($requiredCount==0){
			$this->error[] = "In quiz must be at least 1 required question";	
		}		
	}		
	
					
} // end of AdminController
?>
