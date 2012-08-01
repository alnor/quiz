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
		$activeQuiz = new \core\quiz\ActiveQuiz(\core\Registry::getRequest()->getParam("id"));
	}
	
	/**
	 * 
	 * Adding quiz
	 */
	
	function add(){	

		$form = \core\Registry::getRequest()->form();
		
		if ($form){

			if (!$form["quiz"]["text"]){
				$this->error[] = "Quiz name needed";
			}
			
			foreach($form["question"] as $key=>$val){
				if (empty($val["text"])){
					unset($form["question"][$key]);
				}
			}

			if (empty($form["question"])){
				$this->error[] = "Question name needed";	
			}		

			if (!empty($this->error)){
				$this->setView("error", false);
				$this->setBlankTheme();
				$this->set("error", $this->error);
				return;
			}	
			
			$quizObj = new \core\quiz\ActiveQuiz($form["quiz"]["text"]);
			$quizId = $quizObj->save($form["quiz"]);
			echo $quizid;	

			foreach($form["question"] as $key=>$val){
				$questionObj = new \core\Question($form["question"]["text"]);
				$questionId = $quizObj->save($form["quiz"]);
			}			
		}			

	}
	
	function result(){								
	
	}	
	
} // end of QuizController
?>