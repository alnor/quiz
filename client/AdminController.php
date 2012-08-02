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


	function quiz(){								
		$activeQuizObj = new \core\command\data\ActiveQuiz();
		$activeQuiz = $activeQuizObj->getQuiz();
		
		$draftQuizObj = new \core\command\data\DraftQuiz();
		$draftQuiz = $draftQuizObj->getQuiz();
		
		$closedQuizObj = new \core\command\data\ClosedQuiz();
		$closedQuiz = $closedQuizObj->getQuiz();

		if (!empty($activeQuiz)){
			$this->set("has_active", 1);
		} else {
			$this->set("has_active", 0);
		}

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
			
			$quizObj = new \core\command\data\ActiveQuiz();
			$quizid = $quizObj->save($this->form["quiz"]);

			foreach($this->form["question"] as $key=>$question){
				$question["quiz_id"] = $quizid;
				$questionObj = new \core\command\QuestionData();
				$questionid = $questionObj->save($question);
				
				foreach($this->form["answer"][$key] as $k=>$answer){
					$answer["question_id"] = $questionid;
					$answerObj = new \core\command\AnswerData();
					$answerid = $answerObj->save($answer);					
				}
			}

			//$this->redirect("/admin/result");
		}			

	}
	
	function result(){			
		
		$qarr=array();
		
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			switch($this->form["type"]){
				case "active":
					$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
					break;
				case "draft":
					$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
					break;
				case "closed":
					$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
					break;										
			}
			
			$questionObj = new \core\command\QuestionData();
			$questions = $questionObj->find(array("quiz_id"=>$quizObj->getId()));

			$ansObj = new \core\command\AnswerData();
			foreach($questions as $key=>$question){
				$qarr[] = array("question"=>$question, "answers"=>$ansObj->find(array("question_id"=>$question["id"])));
			}
			
			$result = array("quiz"=>$quizObj, "data"=>$qarr);
			
			$this->setBlankTheme();			
			$this->set("result", $result);
		}		
		
		return false;
	}	
	
	function close(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		switch($this->form["type"]){
			case "active":
				$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
				break;
			case "draft":
				$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
				break;
			case "closed":
				$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
				break;										
		}		

		$quizObj->update(array("id"=>$this->form["id"]), array("type"=>3));
		
		print("Quiz successfully closed");
	}	
	
	function activate(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		switch($this->form["type"]){
			case "active":
				$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
				break;
			case "draft":
				$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
				break;
			case "closed":
				$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
				break;										
		}		

		$quizObj->update(array("id"=>$this->form["id"]), array("type"=>1));
		
		print("Quiz successfully activate");
	}		
	
	function delete(){
		$form = \core\Registry::getRequest()->form();	

		if ($form){
			switch($form["type"]){
				case "active":
					$quizObj = new \core\command\data\ActiveQuiz($form["id"]);
					$quizObj->delete();
					break;
			}
		}
		print("Quiz successfully deleted");
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
		
		if (empty($this->form["question"])){
			return;
		}
		
		foreach($this->form["question"] as $key=>$question){
			if ($question["required"]){
				$requiredCount++;
			}
		}
		
		if ($requiredCount==0){
			$this->error[] = "In quiz must be at least 1 required question";	
		}		
	}		
	
	
	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function menuMaker( ) {
		
		$menu = array(	array("title"=>"Main", "href"=>"/"),
						array("title"=>"Add quiz", "href"=>"/admin/add"),
						array("title"=>"Quiz list", "href"=>"/admin/quiz")
					);
					
		$this->set("menu", $menu);
		
	} // end of member function menuMaker	
					
} // end of AdminController
?>
