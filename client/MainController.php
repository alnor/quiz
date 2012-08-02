<?php

namespace client;

/**
 * class MainController
 * 
 */


class MainController extends \core\Common
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access private
	 */
	private $error=array();	


	function startQuiz(){								
		
		$qarr=array();
	
		$quizObj = new \core\command\data\ActiveQuiz();
		$quiz = $quizObj->find();
		    
		$questionObj = new \core\command\QuestionData();
		$questions = $questionObj->find(array("quiz_id"=>$quiz[0]["id"]));

		$ansObj = new \core\command\AnswerData();
		foreach($questions as $key=>$question){
			$qarr[] = array("question"=>$question, "answers"=>$ansObj->find(array("question_id"=>$question["id"])));
		}
		
		$result = array("quiz"=>$quiz[0], "data"=>$qarr);
	
		$this->set("result", $result);

	}

	
} // end of MainController
?>
