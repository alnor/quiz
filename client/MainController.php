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
	 * Главная страница сайта.
	 * @access public
	 */
	
	function index(){	
	}// end of member function index

	/**
	 * 
	 * Страница прохождения опроса.
	 * @access public
	 */

	function startQuiz(){								
		
		$qarr=array();
	
		$quizObj = new \core\command\data\ActiveQuiz();
		$quiz = $quizObj->find();
		
		if (!empty($quiz)){
			$this->set("has_active", 1);
		} else {
			$this->set("has_active", 0);
		}		
		    
		$questionObj = new \core\command\QuestionData();
		$questions = $questionObj->find(array("quiz_id"=>$quiz[0]["id"]));

		$ansObj = new \core\command\AnswerData();
		foreach($questions as $key=>$question){
			$qarr[] = array("question"=>$question, "answers"=>$ansObj->find(array("question_id"=>$question["id"])));
		}
		
		$result = array("quiz"=>$quiz[0], "data"=>$qarr);
	
		$this->set("result", $result);

	}// end of member function startQuiz
			
	
	/**
	 * 
	 * Обработка и сохранение результатов опроса.
	 * @access public
	 */
	
	function make(){								
		
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			$quizObj = new \core\command\data\ActiveQuiz($this->form["quiz"]);
			$quizObj->update(array("id"=>$this->form["quiz"]), array("count"=>$quizObj->getCount()+1));
			
			foreach($this->form["required"] as $questionId=>$value){				
				if ($value && !($this->form["ans"][$questionId])){
					$this->error[] = "You need to answer the mandatory questions";
				}				
			}
			
			foreach($this->form["ans"] as $questionId=>$value){		

				if (!is_array($value)){
					$value = array($value);
				}
				
				foreach($value as $k=>$v){
					$ansObj = new \core\command\AnswerData($v);
					$ansObj->update(array("id"=>$v), array("count"=>$ansObj->getCount()+1));
				}
			}
			
			if (!empty($this->error)){
				$this->setView("error", false);
				$this->setBlankTheme();
				$this->set("error", $this->error);
				return;
			}		

			$this->form["id"] = $this->form["quiz"];
			$this->form["type"] = "active";		
			$this->setView("result", false);
			$this->result();			
			
		}

	}// end of member function make	

	
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
