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
	
	function index(){	
		echo 11;
	}


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
	
	function make(){								
		
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			$quizObj = new \core\command\data\ActiveQuiz($this->form["quiz"]);
			$quizObj->update(array("id"=>$this->form["quiz"]), array("count"=>$quizObj->getCount()+1));
			
			foreach($this->form["ans"] as $questionId=>$value){
				$ansObj = new \core\command\AnswerData($value);
				$ansObj->update(array("id"=>$value), array("count"=>$ansObj->getCount()+1));
			}
		}
		$this->setView("/admin/result", false);
	}	

	
	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function menuMaker( ) {
		
		$menu = array(	array("title"=>"Start quiz", "href"=>"/startQuiz")
					);
					
		$this->set("menu", $menu);
		
	} // end of member function menuMaker	
} // end of MainController
?>
